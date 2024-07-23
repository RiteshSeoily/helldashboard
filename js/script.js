/*--chart-start---*/

/*--rfq-chart-start--*/

// document.addEventListener("DOMContentLoaded", function () {
//     var rfqCount = parseInt(document.getElementById('rfq-count').textContent) || 0;
//     var executiveCount = 0;
//     var deletedCount = parseInt(document.getElementById('rfq-deleted-count').textContent) || 0;
//     var modifiedCount = 0;

//     var total = rfqCount + executiveCount + deletedCount + modifiedCount;

//     // Calculate percentages
//     var rfqPercentage = total > 0 ? Math.round((rfqCount / total) * 100) : 0;
//     var executivePercentage = total > 0 ? Math.round((executiveCount / total) * 100) : 0;
//     var deletedPercentage = total > 0 ? Math.round((deletedCount / total) * 100) : 0;
//     var modifiedPercentage = total > 0 ? Math.round((modifiedCount / total) * 100) : 0;

//     // Handle the case when there is no data
//     var series = total > 0 ? [rfqPercentage, executivePercentage, deletedPercentage, modifiedPercentage] : [0, 0, 0, 0];
//     var displayTotal = total > 0 ? "100%" : "0%";

//     var options = {
//         chart: {
//             height: 300,
//             type: "donut"
//         },
//         labels: ["RFQ Raised", "Executed", "Deleted", "Modified"],
//         series: series,
//         colors: ['#ff9400', '#ff4e00', '#959595', '#000'],
//         stroke: {
//             show: false,
//             curve: "straight"
//         },
//         dataLabels: {
//             enabled: true,
//             formatter: function (val, opts) {
//                 return opts.w.config.series[opts.seriesIndex] === 0 ? "0%" : Math.round(val) + "%"; // Display 0% if value is 0
//             }
//         },
//         tooltip: {
//             y: {
//                 formatter: function (val, opts) {
//                     return opts.w.config.series[opts.seriesIndex] === 0 ? "0%" : Math.round(val) + "%"; // Display 0% if value is 0
//                 }
//             }
//         },
//         legend: {
//             show: true,
//             position: "bottom",
//             markers: {
//                 offsetX: -3
//             },
//             itemMargin: {
//                 vertical: 3,
//                 horizontal: 10
//             },
//             labels: {
//                 colors: "#333",
//                 useSeriesColors: false
//             }
//         },
//         plotOptions: {
//             pie: {
//                 donut: {
//                     labels: {
//                         show: true,
//                         name: {
//                             fontSize: "1.5rem",
//                             fontFamily: "Public Sans"
//                         },
//                         value: {
//                             fontSize: "1rem",
//                             color: "#333",
//                             fontFamily: "Public Sans",
//                             formatter: function (e) {
//                                 return e === 0 ? "0%" : Math.round(e) + "%"; // Display 0% if value is 0
//                             }
//                         },
//                         total: {
//                             show: true,
//                             fontSize: "1rem",
//                             color: "#333",
//                             label: "",
//                             formatter: function (e) {
//                                 return displayTotal; // Show 0% if total is zero
//                             }
//                         }
//                     }
//                 }
//             }
//         },
//         responsive: [{
//             breakpoint: 992,
//             options: {
//                 chart: {
//                     height: 380
//                 },
//                 legend: {
//                     position: "bottom",
//                     labels: {
//                         colors: "#333",
//                         useSeriesColors: false
//                     }
//                 }
//             }
//         }, {
//             breakpoint: 576,
//             options: {
//                 chart: {
//                     height: 320
//                 },
//                 plotOptions: {
//                     pie: {
//                         donut: {
//                             labels: {
//                                 show: true,
//                                 name: {
//                                     fontSize: "1.2rem"
//                                 },
//                                 value: {
//                                     fontSize: ".8rem"
//                                 },
//                                 total: {
//                                     fontSize: "1.2rem"
//                                 }
//                             }
//                         }
//                     }
//                 },
//                 legend: {
//                     position: "bottom",
//                     labels: {
//                         colors: "#333",
//                         useSeriesColors: false
//                     }
//                 }
//             }
//         }, {
//             breakpoint: 420,
//             options: {
//                 chart: {
//                     height: 280
//                 },
//                 legend: {
//                     show: false
//                 }
//             }
//         }, {
//             breakpoint: 360,
//             options: {
//                 chart: {
//                     height: 250
//                 },
//                 legend: {
//                     show: false
//                 }
//             }
//         }]
//     };

//     var chart = new ApexCharts(document.querySelector("#rfqchart"), options);
//     chart.render();
// });


document.addEventListener("DOMContentLoaded", function () {
    var rfqCount = parseInt(document.getElementById('rfq-count').textContent) || 0;
    var executiveCount = 0;
    var deletedCount = parseInt(document.getElementById('rfq-deleted-count').textContent) || 0;
    var modifiedCount = parseInt(document.getElementById('rfq-updated-count').textContent) || 0;

    var total = rfqCount;  // Total RFQ count only

    // Prepare the series with the raw numbers
    var series = [rfqCount, executiveCount, deletedCount, modifiedCount];

    var options = {
        chart: {
            height: 300,
            type: "donut",
            events: {
                dataPointMouseEnter: function(event, chartContext, config) {
                    // Zoom in on hover
                    chart.updateOptions({
                        plotOptions: {
                            pie: {
                                expandOnClick: true,
                                donut: {
                                    size: '70%'
                                }
                            }
                        }
                    });
                },
                dataPointMouseLeave: function(event, chartContext, config) {
                    // Reset zoom on hover out
                    chart.updateOptions({
                        plotOptions: {
                            pie: {
                                expandOnClick: false,
                                donut: {
                                    size: '65%'
                                }
                            }
                        }
                    });
                }
            }
        },
        labels: ["RFQ Raised", "Executed", "Deleted", "Modified"],
        series: series,
        colors: ['#ff9400', '#ff4e00', '#959595', '#000'],
        stroke: {
            show: false,
            curve: "straight"
        },
        dataLabels: {
            enabled: true,
            formatter: function (val, opts) {
                return opts.w.config.series[opts.seriesIndex]; // Display raw number
            }
        },
        tooltip: {
            y: {
                formatter: function (val, opts) {
                    return opts.w.globals.labels[opts.seriesIndex] + ': ' + val; // Display label and value
                }
            }
        },
        legend: {
            show: true,
            position: "bottom",
            markers: {
                offsetX: -3
            },
            itemMargin: {
                vertical: 3,
                horizontal: 10
            },
            labels: {
                colors: "#333",
                useSeriesColors: false
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            fontSize: "1.5rem",
                            fontFamily: "Public Sans"
                        },
                        value: {
                            fontSize: "1rem",
                            color: "#333",
                            fontFamily: "Public Sans",
                            formatter: function (val) {
                                return val; // Display raw number
                            }
                        },
                        total: {
                            show: true,
                            fontSize: "1rem",
                            color: "#333",
                            label: "Total",
                            formatter: function (w) {
                                return total; // Display the total number
                            }
                        }
                    }
                }
            }
        },
        responsive: [{
            breakpoint: 992,
            options: {
                chart: {
                    height: 380
                },
                legend: {
                    position: "bottom",
                    labels: {
                        colors: "#333",
                        useSeriesColors: false
                    }
                }
            }
        }, {
            breakpoint: 576,
            options: {
                chart: {
                    height: 320
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    fontSize: "1.2rem"
                                },
                                value: {
                                    fontSize: ".8rem"
                                },
                                total: {
                                    fontSize: "1.2rem"
                                }
                            }
                        }
                    }
                },
                legend: {
                    position: "bottom",
                    labels: {
                        colors: "#333",
                        useSeriesColors: false
                    }
                }
            }
        }, {
            breakpoint: 420,
            options: {
                chart: {
                    height: 280
                },
                legend: {
                    show: false
                }
            }
        }, {
            breakpoint: 360,
            options: {
                chart: {
                    height: 250
                },
                legend: {
                    show: false
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#rfqchart"), options);
    chart.render();
});


/*--rfq-chart-end--*/

/*--amount-spend-graph-start--*/

document.addEventListener("DOMContentLoaded", function () {
    var options = {
        chart: {
            height: 250,
            type: 'radialBar',
        },
        series: [0],
        colors: ['#FF7F00'],
        plotOptions: {
            radialBar: {
                startAngle: -90,
                endAngle: 90,
                track: {
                    background: '#e0e0e0',
                    strokeWidth: '97%',
                    margin: 5,
                },
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        offsetY: -10,
                        fontSize: '22px',
                        color: '#333',
                        fontFamily: "'Jost', sans-serif",
                        formatter: function (val) {
                            return "₹0";
                        }
                    }
                }
            }
        },
        fill: {
            type: 'solid'
        },
        labels: ['Amount Spent'],
    };

    var chart = new ApexCharts(document.querySelector("#gaugeChart"), options);
    chart.render();
});

/*--amount-spend-graph-end--*/

/*--savings-chart-start--*/

document.addEventListener('DOMContentLoaded', function () {
    const cardColor = "#ffffff";
    const textMuted = "#6c757d"; 
    const headingColor = "#343a40";
    const config = {
        colors: {
            primary: "#ff6d00",
        }
    };

    const supportTrackerElement = document.querySelector("#savingsTracker");
    if (supportTrackerElement) {
        const supportTrackerOptions = {
            series: [0], // Percentage value
            labels: [""],
            chart: {
                height: 360,
                type: "radialBar"
            },
            plotOptions: {
                radialBar: {
                    offsetY: 10,
                    startAngle: -140,
                    endAngle: 130,
                    hollow: { size: "65%" },
                    track: { background: cardColor, strokeWidth: "100%" },
                    dataLabels: {
                        name: {
                            offsetY: -20,
                            color: textMuted,
                            fontSize: "22px",
                            fontFamily: "'Jost', sans-serif"
                        },
                        value: {
                            offsetY: 10,
                            color: headingColor,
                            fontSize: "22px",
                            fontFamily: "'Jost', sans-serif",
                            // Update the formatter function to include the rupee symbol before the value
                            formatter: function(val) {
                                return "₹" + val; // Puts the rupee symbol before the value
                            }
                        }
                    }
                }
            },
            colors: [config.colors.primary],
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    shadeIntensity: 0.5,
                    gradientToColors: [config.colors.primary],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 0.6,
                    stops: [30, 70, 100]
                }
            },
            stroke: { dashArray: 10 },
            grid: { padding: { top: -20, bottom: 5 } },
            states: {
                hover: { filter: { type: "none" } },
                active: { filter: { type: "none" } }
            },
            responsive: [
                { breakpoint: 1025, options: { chart: { height: 330 } } },
                { breakpoint: 769, options: { chart: { height: 280 } } }
            ]
        };
        new ApexCharts(supportTrackerElement, supportTrackerOptions).render();
    }
});
/*--savings-chart-end--*/

/*--order-chart-start--*/

document.addEventListener('DOMContentLoaded', function () {
    const textMuted = "#6c757d";
    const config = {
        colors: {
            primary: "#828282",
            label: {
                primary: "#828282"
            }
        }
    };

    const weeklyEarningReportsElement = document.querySelector("#weeklyorders");
    if (weeklyEarningReportsElement) {
        const weeklyEarningReportsOptions = {
            chart: {
                height: 230,
                parentHeightOffset: 0,
                type: "bar",
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    barHeight: "60%",
                    columnWidth: "38%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: true
                }
            },
            grid: {
                show: false,
                padding: { top: -10, bottom: 0, left: 20, right: -10 }
            },
            colors: [
                config.colors.label.primary,
                config.colors.label.primary,
                config.colors.label.primary,
                config.colors.label.primary,
                config.colors.primary,
                config.colors.label.primary,
                config.colors.label.primary
            ],
            dataLabels: { enabled: false },
            series: [{ data: [90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90] }],
            legend: { show: false },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: textMuted, fontSize: "13px", fontFamily: "Public Sans" } }
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: textMuted,
                        fontSize: "13px",
                        fontFamily: "Public Sans"
                    }
                }
            },
            tooltip: { enabled: false },
            responsive: [{ breakpoint: 1025, options: { chart: { height: 199 } } }]
        };
        new ApexCharts(weeklyEarningReportsElement, weeklyEarningReportsOptions).render();
    }
});
/*--order-chart-end--*/

/*--product-order-chart-start--*/
 document.addEventListener("DOMContentLoaded", function () {
            var options = {
                chart: {
                    type: 'bar',
                    height: 160,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        barHeight: '50%',
                        colors: {
                            backgroundBarColors: ['#e0e0e0'],
                            backgroundBarOpacity: 1,
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    data: [0, 0, 0, 0, 0, 0] 
                }],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June'],
                    labels: {
                        style: {
                            colors: ['#333'],
                            fontSize: '12px'
                        },
                        formatter: function (value) {

                            const validTicks = [0, 20, 40, 60, 80, 100];
                            return validTicks.includes(value) ? value : '';
                        }
                    },
                    min: 0, 
                    max: 100, 
                    tickAmount: 5, 
                    tickPlacement: 'on', 
                    tickAmount: undefined, 
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                grid: {
                    show: false,
                    xaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px',
                            colors: ['#333']
                        }
                    }
                },
                colors: ['#ff6d00'],
                tooltip: {
                    enabled: true,
                    y: {
                        formatter: function(value) {
                            return 'Ordered: ' + value;
                        },
                        title: {
                            formatter: function (seriesName, opts) {
                                return opts.w.globals.labels[opts.dataPointIndex] + ': ';
                            }
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#barChart"), options);
            chart.render();
        });

/*--product-order-chart-end--*/

/*--chart-end--*/


/*--admin-dashboard-graph-start--*/

/*--rfq-chart-start--*/

document.addEventListener("DOMContentLoaded", function () {
    var c = document.querySelector("#rfqchartone"),
        d = {
            chart: {
                height: 300,
                type: "donut"
            },
            labels: ["Registered", "Individual", "Company", "Deleted"],
            series: [42, 8, 25, 20],
            colors: ['#ff6d00', '#000', '#ff9400', '#000'],
            stroke: {
                show: false,
                curve: "straight"
            },
            dataLabels: {
                enabled: true,
                formatter: function (e, o) {
                    return parseInt(e, 10) + ""
                }
            },
            legend: {
                show: true,
                position: "bottom",
                markers: {
                    offsetX: -3
                },
                itemMargin: {
                    vertical: 3,
                    horizontal: 10
                },
                labels: {
                    colors: "#333",
                    useSeriesColors: false
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                fontSize: "2rem",
                                fontFamily: "Public Sans"
                            },
                            value: {
                                fontSize: "1.2rem",
                                color: "#333",
                                fontFamily: "Public Sans",
                                formatter: function (e) {
                                    return parseInt(e, 10) + ""
                                }
                            },
                            total: {
                                show: true,
                                fontSize: "1rem",
                                color: "#333",
                                label: "",
                                formatter: function (e) {
                                    return "42"
                                }
                            }
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 992,
                options: {
                    chart: {
                        height: 380
                    },
                    legend: {
                        position: "bottom",
                        labels: {
                            colors: "#333",
                            useSeriesColors: false
                        }
                    }
                }
            }, {
                breakpoint: 576,
                options: {
                    chart: {
                        height: 320
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        fontSize: "1.5rem"
                                    },
                                    value: {
                                        fontSize: "1rem"
                                    },
                                    total: {
                                        fontSize: "1.5rem"
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        position: "bottom",
                        labels: {
                            colors: "#333",
                            useSeriesColors: false
                        }
                    }
                }
            }, {
                breakpoint: 420,
                options: {
                    chart: {
                        height: 280
                    },
                    legend: {
                        show: false
                    }
                }
            }, {
                breakpoint: 360,
                options: {
                    chart: {
                        height: 250
                    },
                    legend: {
                        show: false
                    }
                }
            }]
        };
    if (c !== null) {
        new ApexCharts(c, d).render();
    }
});

/*--rfq-chart-end--*/

/*--rfq-chart-start--*/

document.addEventListener("DOMContentLoaded", function () {
    var c = document.querySelector("#rfqcharttwo"),
        d = {
            chart: {
                height: 300,
                type: "donut"
            },
            labels: ["Distributor", "Manufacturer", "Wholesaler", "Retailer", "Dealer"],
            series: [42, 8, 25, 10, 10],
            colors: ['#ff6d00', '#000', '#ff9400', '#ff6d00', '#000'],
            stroke: {
                show: false,
                curve: "straight"
            },
            dataLabels: {
                enabled: true,
                formatter: function (e, o) {
                    return parseInt(e, 10) + ""
                }
            },
            legend: {
                show: true,
                position: "bottom",
                markers: {
                    offsetX: -3
                },
                itemMargin: {
                    vertical: 3,
                    horizontal: 10
                },
                labels: {
                    colors: "#333",
                    useSeriesColors: false
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                fontSize: "2rem",
                                fontFamily: "Public Sans"
                            },
                            value: {
                                fontSize: "1.2rem",
                                color: "#333",
                                fontFamily: "Public Sans",
                                formatter: function (e) {
                                    return parseInt(e, 10) + ""
                                }
                            },
                            total: {
                                show: true,
                                fontSize: "1rem",
                                color: "#333",
                                label: "",
                                formatter: function (e) {
                                    return "42"
                                }
                            }
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 992,
                options: {
                    chart: {
                        height: 380
                    },
                    legend: {
                        position: "bottom",
                        labels: {
                            colors: "#333",
                            useSeriesColors: false
                        }
                    }
                }
            }, {
                breakpoint: 576,
                options: {
                    chart: {
                        height: 320
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        fontSize: "1.5rem"
                                    },
                                    value: {
                                        fontSize: "1rem"
                                    },
                                    total: {
                                        fontSize: "1.5rem"
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        position: "bottom",
                        labels: {
                            colors: "#333",
                            useSeriesColors: false
                        }
                    }
                }
            }, {
                breakpoint: 420,
                options: {
                    chart: {
                        height: 280
                    },
                    legend: {
                        show: false
                    }
                }
            }, {
                breakpoint: 360,
                options: {
                    chart: {
                        height: 250
                    },
                    legend: {
                        show: false
                    }
                }
            }]
        };
    if (c !== null) {
        new ApexCharts(c, d).render();
    }
});

/*--rfq-chart-end--*/

/*--rfq-chart-start--*/

document.addEventListener("DOMContentLoaded", function () {
    var c = document.querySelector("#rfqchartthree"),
        d = {
            chart: {
                height: 300,
                type: "donut"
            },
            labels: ["RFQ", "On Hold", "In Process", "Deleted"],
            series: [42, 8, 25, 25],
            colors: ['#ff6d00', '#000', '#ff9400', '#000'],
            stroke: {
                show: false,
                curve: "straight"
            },
            dataLabels: {
                enabled: true,
                formatter: function (e, o) {
                    return parseInt(e, 10) + ""
                }
            },
            legend: {
                show: true,
                position: "bottom",
                markers: {
                    offsetX: -3
                },
                itemMargin: {
                    vertical: 3,
                    horizontal: 10
                },
                labels: {
                    colors: "#333",
                    useSeriesColors: false
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                fontSize: "2rem",
                                fontFamily: "Public Sans"
                            },
                            value: {
                                fontSize: "1.2rem",
                                color: "#333",
                                fontFamily: "Public Sans",
                                formatter: function (e) {
                                    return parseInt(e, 10) + ""
                                }
                            },
                            total: {
                                show: true,
                                fontSize: "1rem",
                                color: "#333",
                                label: "",
                                formatter: function (e) {
                                    return "42"
                                }
                            }
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 992,
                options: {
                    chart: {
                        height: 380
                    },
                    legend: {
                        position: "bottom",
                        labels: {
                            colors: "#333",
                            useSeriesColors: false
                        }
                    }
                }
            }, {
                breakpoint: 576,
                options: {
                    chart: {
                        height: 320
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        fontSize: "1.5rem"
                                    },
                                    value: {
                                        fontSize: "1rem"
                                    },
                                    total: {
                                        fontSize: "1.5rem"
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        position: "bottom",
                        labels: {
                            colors: "#333",
                            useSeriesColors: false
                        }
                    }
                }
            }, {
                breakpoint: 420,
                options: {
                    chart: {
                        height: 280
                    },
                    legend: {
                        show: false
                    }
                }
            }, {
                breakpoint: 360,
                options: {
                    chart: {
                        height: 250
                    },
                    legend: {
                        show: false
                    }
                }
            }]
        };
    if (c !== null) {
        new ApexCharts(c, d).render();
    }
});

/*--rfq-chart-end--*/

/*--rfq-chart-start--*/

document.addEventListener("DOMContentLoaded", function () {
    var c = document.querySelector("#rfqchartfour"),
        d = {
            chart: {
                height: 300,
                type: "donut"
            },
            labels: ["Total Profit", "Individual", "Company"],
            series: [42, 8, 25],
            colors: ['#ff6d00', '#000', '#ff9400', '#000'],
            stroke: {
                show: false,
                curve: "straight"
            },
            dataLabels: {
                enabled: true,
                formatter: function (e, o) {
                    return parseInt(e, 10) + ""
                }
            },
            legend: {
                show: true,
                position: "bottom",
                markers: {
                    offsetX: -3
                },
                itemMargin: {
                    vertical: 3,
                    horizontal: 10
                },
                labels: {
                    colors: "#333",
                    useSeriesColors: false
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                fontSize: "2rem",
                                fontFamily: "Public Sans"
                            },
                            value: {
                                fontSize: "1.2rem",
                                color: "#333",
                                fontFamily: "Public Sans",
                                formatter: function (e) {
                                    return parseInt(e, 10) + ""
                                }
                            },
                            total: {
                                show: true,
                                fontSize: "1rem",
                                color: "#333",
                                label: "",
                                formatter: function (e) {
                                    return "42"
                                }
                            }
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 992,
                options: {
                    chart: {
                        height: 380
                    },
                    legend: {
                        position: "bottom",
                        labels: {
                            colors: "#333",
                            useSeriesColors: false
                        }
                    }
                }
            }, {
                breakpoint: 576,
                options: {
                    chart: {
                        height: 320
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        fontSize: "1.5rem"
                                    },
                                    value: {
                                        fontSize: "1rem"
                                    },
                                    total: {
                                        fontSize: "1.5rem"
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        position: "bottom",
                        labels: {
                            colors: "#333",
                            useSeriesColors: false
                        }
                    }
                }
            }, {
                breakpoint: 420,
                options: {
                    chart: {
                        height: 280
                    },
                    legend: {
                        show: false
                    }
                }
            }, {
                breakpoint: 360,
                options: {
                    chart: {
                        height: 250
                    },
                    legend: {
                        show: false
                    }
                }
            }]
        };
    if (c !== null) {
        new ApexCharts(c, d).render();
    }
});

/*--rfq-chart-end--*/

/*--order-chart-start--*/

document.addEventListener('DOMContentLoaded', function () {
    const textMuted = "#6c757d";
    const config = {
        colors: {
            primary: "#ff6d00",
            label: {
                primary: "#828282"
            }
        }
    };

    const weeklyEarningReportsElement = document.querySelector("#adminweeklyorders");
    if (weeklyEarningReportsElement) {
        const weeklyEarningReportsOptions = {
            chart: {
                height: 230,
                parentHeightOffset: 0,
                type: "bar",
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    barHeight: "60%",
                    columnWidth: "38%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: true
                }
            },
            grid: {
                show: false,
                padding: { top: -10, bottom: 0, left: 30, right: -10 }
            },
            colors: [
                config.colors.label.primary,
                config.colors.label.primary,
                config.colors.label.primary,
                config.colors.label.primary,
                config.colors.primary,
                config.colors.label.primary,
                config.colors.label.primary
            ],
            dataLabels: { enabled: false },
            series: [{ data: [40, 65, 50, 45, 90, 55] }],
            legend: { show: false },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "June"],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: textMuted, fontSize: "13px", fontFamily: "Public Sans" } }
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: textMuted,
                        fontSize: "13px",
                        fontFamily: "Public Sans"
                    }
                }
            },
            tooltip: { enabled: false },
            responsive: [{ breakpoint: 1025, options: { chart: { height: 199 } } }]
        };
        new ApexCharts(weeklyEarningReportsElement, weeklyEarningReportsOptions).render();
    }
});
/*--order-chart-end--*/

/*--admin-dashboard-graph-end--*/

(function($) {
    
    "use strict";
    function preloaderLoad() {
        if($('.preloader').length){
            $('.preloader').delay(200).fadeOut(300);
        }
        $(".preloader_disabler").on('click', function() {
            $("#preloader").hide();
        });
    }

    /* ----- Navbar Scroll To Fixed ----- */
    function navbarScrollfixed() {
        $('.navbar-scrolltofixed').scrollToFixed();
        var summaries = $('.summary');
        summaries.each(function(i) {
            var summary = $(summaries[i]);
            var next = summaries[i + 1];
            summary.scrollToFixed({
                marginTop: $('.navbar-scrolltofixed').outerHeight(true) + 10,
                limit: function() {
                    var limit = 0;
                    if (next) {
                        limit = $(next).offset().top - $(this).outerHeight(true) - 10;
                    } else {
                        limit = $('.footer').offset().top - $(this).outerHeight(true) - 10;
                    }
                    return limit;
                },
                zIndex: 999
            });
        });
    }

    /** Main Menu Custom Script Start **/
    $(document).on('ready', function() {
        $("#respMenu").aceResponsiveMenu({
            resizeWidth: '768', // Set the same in Media query
            animationSpeed: 'fast', //slow, medium, fast
            accoridonExpAll: false //Expands all the accordion menu on click
        });
    });    

    function mobileNavToggle() {
        if ($('#main-nav-bar .navbar-nav .sub-menu').length) {
            var subMenu = $('#main-nav-bar .navbar-nav .sub-menu');
            subMenu.parent('li').children('a').append(function () {
                return '<button class="sub-nav-toggler"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>';
            });
            var subNavToggler = $('#main-nav-bar .navbar-nav .sub-nav-toggler');
            subNavToggler.on('click', function () {
                var Self = $(this);
                Self.parent().parent().children('.sub-menu').slideToggle();
                return false;
            });

        };
    }

    /* ----- This code for menu ----- */
    $(window).on('scroll', function() {
        if ($('.scroll-to-top').length) {
            var strickyScrollPos = 100;
            if ($(window).scrollTop() > strickyScrollPos) {
                $('.scroll-to-top').fadeIn(500);
            } else if ($(this).scrollTop() <= strickyScrollPos) {
                $('.scroll-to-top').fadeOut(500);
            }
        };
        if ($('.stricky').length) {
            var headerScrollPos = $('.header-navigation').next().offset().top;
            var stricky = $('.stricky');
            if ($(window).scrollTop() > headerScrollPos) {
                stricky.removeClass('slideIn animated');
                stricky.addClass('stricky-fixed slideInDown animated');
            } else if ($(this).scrollTop() <= headerScrollPos) {
                stricky.removeClass('stricky-fixed slideInDown animated');
                stricky.addClass('slideIn animated');
            }
        };
    });
    
    $(".mouse_scroll").on('click', function() {
        $('html, body').animate({
            scrollTop: $("#feature-property, #property-city").offset().top
        }, 1000);
    });
    /** Main Menu Custom Script End **/

    var dataSpyList = [].slice.call(document.querySelectorAll('[data-bs-spy="scroll"]'))
    dataSpyList.forEach(function (dataSpyEl) {
      bootstrap.ScrollSpy.getInstance(dataSpyEl)
        .refresh()
    })


    function makeTimer() {
    //  var endTime = new Date("20 Dec 2021 9:56:00 GMT+01:00");  
        var endTime = new Date("20 Jun 2023 9:56:00 GMT+01:00");      
        endTime = (Date.parse(endTime) / 1000);
        var now = new Date();
        now = (Date.parse(now) / 1000);
        var timeLeft = endTime - now;
        var days = Math.floor(timeLeft / 86400); 
        var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
        var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
        var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));  
        if (hours < "10") { hours = "0" + hours; }
        if (minutes < "10") { minutes = "0" + minutes; }
        if (seconds < "10") { seconds = "0" + seconds; }
        $(".days").html(days + "<span>Days</span>");
        $(".hours").html(hours + "<span>Hours</span>");
        $(".minutes").html(minutes + "<span>Minutes</span>");
        $(".seconds").html(seconds + "<span>Seconds</span>");
    }
    setInterval(function() { makeTimer(); }, 1000);
    
    /* ----- Blog innerpage sidebar according ----- */
    $(document).on('ready', function() {
        $('.collapse').on('show.bs.collapse', function () {
            $(this).siblings('.card-header').addClass('active');
        });
        $('.collapse').on('hide.bs.collapse', function () {
            $(this).siblings('.card-header').removeClass('active');
        });
        
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    /* ----- Menu Cart Button Dropdown ----- */
    $(document).on('ready', function() {
        // Loop through each nav item
        $('.cart_btn').children('ul.cart').children('li').each(function(indexCount){
            // loop through each dropdown, count children and apply a animation delay based on their index value
            $(this).children('ul.dropdown_content').children('li').each(function(index){
                // Turn the index value into a reasonable animation delay
                var delay = 0.1 + index*0.03;
                // Apply the animation delay
                $(this).css("animation-delay", delay + "s")
            });
        });
    });

    /* ----- Mobile Nav ----- */
    $(function() {
        $('nav#menu').mmenu();
    });
    
    /* ----- Candidate SIngle Page Price Slider ----- */
    $(function() {
        $("#slider-range").slider({
            range: true,
            min: 50,
            max: 150,
            values: [ 50, 120 ],
            slide: function( event, ui ) {
                $("#amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1) );
    });

    /* ----- Employee List v1 page range slider widget ----- */
    $(document).on('ready', function() {
        $(".slider-range").slider({
            range: true,
            min: 0,
            max: 100000,
            values: [ 20, 70987 ],
            slide: function( event, ui ) {
                $( ".amount" ).val( ui.values[ 0 ] );
                $( ".amount2" ).val( ui.values[ 1 ] );
            }
        });
        $(".amount").change(function() {
            $(".slider-range").slider('values',0,$(this).val());
        });
        $(".amount2").change(function() {
            $(".slider-range").slider('values',1,$(this).val());
        });
    });

    /* ----- Pricing Range Slider ----- */
    $(document).on("ready", function() {
        $(".range-example-km").asRange({
          limit: false,
          min: 0,
          max: 150,
          range: false,
          step: 1,
          value: 50,
          format: function(value) {
              return value + '';
          }
        });
        $(".range-uilayouts").asRange({
            limit: false,
            max: 1000,
            min: 0,
            range: true,
            step: 1,
              format: function(value) {
                return '$' + value;
              }
        });
    });


    /* ----- Progress Bar ----- */
    if($('.progress-levels .progress-box .bar-fill').length){
        $(".progress-box .bar-fill").each(function() {
            var progressWidth = $(this).attr('data-percent');
            $(this).css('width',progressWidth+'%');
            $(this).children('.percent').html(progressWidth+'%');
        });
    }

    /* ----- MagnificPopup ----- */
    if (($(".popup-img").length > 0) || ($(".popup-iframe").length > 0) || ($(".popup-img-single").length > 0)) {
        $(".popup-img").magnificPopup({
            type:"image",
            gallery: {
                enabled: true,
            }
        });
        $(".popup-img-single").magnificPopup({
            type:"image",
            gallery: {
                enabled: false,
            }
        });
        $('.popup-iframe').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            preloader: false,
            fixedContentPos: false
        });
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
        });
    };

    /*** ====  Right Side Hidden Sidebar Start ==== ***/
    //Side Content Toggle
    if($('.signin-filter-btn').length){
      //Show Form
      $('.signin-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('signin-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('signin-hidden-sidebar-content');
      });
    } 

    if($('.signup-filter-btn').length){
      //Show Form
      $('.signup-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('singup-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('singup-hidden-sidebar-content');
      });
    }

    if($('.cart-filter-btn').length){
      //Show Form
      $('.cart-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('cart-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('cart-hidden-sidebar-content');
      });
    }

    if($('.descrip-filter-btn').length){
      //Show Form
      $('.descrip-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('descrip-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('descrip-hidden-sidebar-content');
      });
    }

    if($('.spece-filter-btn').length){
      //Show Form
      $('.spece-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('spcfictn-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('spcfictn-hidden-sidebar-content');
      });
    } 

    if($('.repc-filter-btn').length){
      //Show Form
      $('.repc-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('retrnplc-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('retrnplc-hidden-sidebar-content');
      });
    }

    if($('.comqstn-filter-btn').length){
      //Show Form
      $('.comqstn-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('faq-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('faq-hidden-sidebar-content');
      });
    }

    if($('.review-filter-btn, .department-filter-btn').length){
      //Show Form
      $('.review-filter-btn, .department-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('review-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('review-hidden-sidebar-content');
      });
    }

    if($('.menu-filter-btn, .department-filter-btn').length){
      //Show Form
      $('.menu-filter-btn, .department-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('menu-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('menu-hidden-sidebar-content');
      });
    }

    if($('.department-filter-btn').length){
      //Show Form
      $('.department-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('department-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('department-hidden-sidebar-content');
      });
    }

    if($('.all-filter-btn').length){
      //Show Form
      $('.all-filter-btn').on('click', function(e) {
        e.preventDefault();
        $('body').addClass('allfilter-hidden-sidebar-content');
      });
      //Hide Form
      $('.sidebar-close-icon,.hiddenbar-body-ovelay').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('allfilter-hidden-sidebar-content');
      });
    }
    /*** ====  Right Side Hidden Sidebar END ==== ***/

    /*** ====  Perspective Hover Animation Code Start ==== ***/
    var perspectiveHover = function() {
      var $animate_content               = $('.animate_content'),
          $animate_thumb          = $('.animate_thumb'),
          xAngle              = 0,
          yAngle              = 0,
          zValue              = 0,
          xSensitivity        = 15,
          ySensitivity        = 25,
          restAnimSpeed       = 300,
          perspective         = 500;

      $animate_content.on('mousemove', function(element) {
          var $item = $(this),
              // Get cursor coordinates
              XRel = element.pageX - $item.offset().left,
              YRel = element.pageY - $item.offset().top,
              width = $item.width();

          // Build angle val from container width and cursor value
          xAngle = (0.5 - (YRel / width)) * xSensitivity;
          yAngle = -(0.5 - (XRel / width)) * ySensitivity;

          // Container isn't manipulated, only child elements within
          updateElement($item.children($animate_thumb));
      }); 
      // Move element around
      function updateElement(modifyLayer) {
          modifyLayer.css({
              'transform': 'perspective('+ perspective + 'px) translateZ(' + zValue + 'px) rotateX(' + xAngle + 'deg) rotateY(' + yAngle + 'deg)',
              'transition': 'none'
          });
      }
      // Reset element to default state
      $animate_content.on('mouseleave', function() {
          modifyLayer = $(this).children($animate_thumb);
          modifyLayer.css({
              'transform': 'perspective(' + perspective + 'px) translateZ(0) rotateX(0) rotateY(0)',
              'transition': 'transform ' + restAnimSpeed + 'ms linear'
          });
      });
    };
    perspectiveHover();
    /*** ====  Perspective Hover Animation Code End ==== ***/


    // Custom Search Dropdown Script Start
    var showSuggestions = function() {
      $( ".top-search form.form-search .box-search" ).each(function() {
          $( "form.form-search .box-search input" ).on('focus', (function() {
              $(this).closest('.boxed').children('.overlay').css({
                  opacity: '1',
                  display: 'block'
              });
              $(this).parent('.box-search').children('.search-suggestions').css({
                  opacity: '1',
                  visibility: 'visible',
                  top: '50px'
              });
          }));
          $( "form.form-search .box-search input" ).on('blur', (function() {
              $(this).closest('.boxed').children('.overlay').css({
                  opacity: '0',
                  display: 'block'
              });
              $(this).parent('.box-search').children('.search-suggestions').css({
                  opacity: '0',
                  visibility: 'hidden',
                  top: '100px'
              });
          }));
      });

      $( ".top-search.style1 form.form-search .box-search" ).each(function() {
          $( "form.form-search .box-search input" ).on('focus', (function() {
              $(this).closest('.boxed').children('.overlay').css({
                  opacity: '1',
                  display: 'block'
              });
              $(this).parent('.box-search').children('.search-suggestions').css({
                  opacity: '1',
                  visibility: 'visible',
                  top: '100px'
              });
          }));
      });
    }; // Toggle Location
    $(function() {
      showSuggestions();
    });
    // Custom Search Dropdown Script Start

    // Custom Shop item add Option increase decrease home 3
    // $(function() {
    //   (function quantityProducts() {
    //     var $quantityArrowMinus = $(".quantity-arrow-minus");
    //     var $quantityArrowPlus = $(".quantity-arrow-plus");
    //     var $quantityNum = $(".quantity-num");
    //     $quantityArrowMinus.click(quantityMinus);
    //     $quantityArrowPlus.click(quantityPlus);
    //     function quantityMinus() {
    //       if ($quantityNum.val() > 1) {
    //         $quantityNum.val(+$quantityNum.val() - 1);
    //       }
    //     }
    //     function quantityPlus() {
    //       $quantityNum.val(+$quantityNum.val() + 1);
    //     }
    //   })();
    // });
    // $(function() {
    //   (function quantityProducts() {
    //     var $quantityArrowMinus = $(".quantity-arrow-minus2");
    //     var $quantityArrowPlus = $(".quantity-arrow-plus2");
    //     var $quantityNum = $(".quantity-num2");
    //     $quantityArrowMinus.click(quantityMinus);
    //     $quantityArrowPlus.click(quantityPlus);
    //     function quantityMinus() {
    //       if ($quantityNum.val() > 1) {
    //         $quantityNum.val(+$quantityNum.val() - 1);
    //       }
    //     }
    //     function quantityPlus() {
    //       $quantityNum.val(+$quantityNum.val() + 1);
    //     }
    //   })();
    // });
    // $(function() {
    //   (function quantityProducts() {
    //     var $quantityArrowMinus = $(".quantity-arrow-minus3");
    //     var $quantityArrowPlus = $(".quantity-arrow-plus3");
    //     var $quantityNum = $(".quantity-num3");
    //     $quantityArrowMinus.click(quantityMinus);
    //     $quantityArrowPlus.click(quantityPlus);
    //     function quantityMinus() {
    //       if ($quantityNum.val() > 1) {
    //         $quantityNum.val(+$quantityNum.val() - 1);
    //       }
    //     }
    //     function quantityPlus() {
    //       $quantityNum.val(+$quantityNum.val() + 1);
    //     }
    //   })();
    // });

// new add
//     $(function() {
//     (function quantityProducts() {
//         var $quantityArrowMinus = $(".quantity-arrow-minus");
//         var $quantityArrowPlus = $(".quantity-arrow-plus");
//         var $quantityNum = $(".quantity-num");
//         $quantityArrowMinus.click(quantityMinus);
//         $quantityArrowPlus.click(quantityPlus);
//         function quantityMinus(event) {
//             event.preventDefault();
//             if ($quantityNum.val() > 1) {
//                 $quantityNum.val(+$quantityNum.val() - 1);
//             }
//         }
//         function quantityPlus(event) {
//             event.preventDefault();
//             $quantityNum.val(+$quantityNum.val() + 1);
//         }
//     })();
// });

// $(function() {
//     (function quantityProducts() {
//         var $quantityArrowMinus = $(".quantity-arrow-minus2");
//         var $quantityArrowPlus = $(".quantity-arrow-plus2");
//         var $quantityNum = $(".quantity-num2");
//         $quantityArrowMinus.click(quantityMinus);
//         $quantityArrowPlus.click(quantityPlus);
//         function quantityMinus(event) {
//             event.preventDefault();
//             if ($quantityNum.val() > 1) {
//                 $quantityNum.val(+$quantityNum.val() - 1);
//             }
//         }
//         function quantityPlus(event) {
//             event.preventDefault();
//             $quantityNum.val(+$quantityNum.val() + 1);
//         }
//     })();
// });

// $(function() {
//     (function quantityProducts() {
//         var $quantityArrowMinus = $(".quantity-arrow-minus3");
//         var $quantityArrowPlus = $(".quantity-arrow-plus3");
//         var $quantityNum = $(".quantity-num3");
//         $quantityArrowMinus.click(quantityMinus);
//         $quantityArrowPlus.click(quantityPlus);
//         function quantityMinus(event) {
//             event.preventDefault();
//             if ($quantityNum.val() > 1) {
//                 $quantityNum.val(+$quantityNum.val() - 1);
//             }
//         }
//         function quantityPlus(event) {
//             event.preventDefault();
//             $quantityNum.val(+$quantityNum.val() + 1);
//         }
//     })();
// });

// increament decrement  button

//     $(function() {
//     function quantityProducts() {
//         $(".quantity-arrow-minus").click(function(event) {
//             event.preventDefault();
//             var $quantityNum = $(this).siblings(".quantity-num");
//             if ($quantityNum.val() > 1) {
//                 $quantityNum.val(+$quantityNum.val() - 1);
//             }
//         });

//         $(".quantity-arrow-plus").click(function(event) {
//             event.preventDefault();
//             var $quantityNum = $(this).siblings(".quantity-num");
//             $quantityNum.val(+$quantityNum.val() + 1);
//         });
//     }

//     quantityProducts();
// });

///  chekc testing

//     $(function() {
//     function quantityProducts() {
//         $(".quantity-arrow-minus, .quantity-arrow-minus2, .quantity-arrow-minus3").click(function(event) {
//             event.preventDefault();
//             var $quantityNum = $(this).siblings(".quantity-num, .quantity-num2, .quantity-num3");
//             if ($quantityNum.val() > 1) {
//                 $quantityNum.val(+$quantityNum.val() - 1);
//             }
//         });

//         $(".quantity-arrow-plus, .quantity-arrow-plus2, .quantity-arrow-plus3").click(function(event) {
//             event.preventDefault();
//             var $quantityNum = $(this).siblings(".quantity-num, .quantity-num2, .quantity-num3");
//             $quantityNum.val(+$quantityNum.val() + 1);
//         });
//     }

//     quantityProducts();
// });

// cart page
    $(function() {
    function quantityProducts() {
        $(".quantity-arrow-minus").click(function(event) {
            event.preventDefault();
            var $quantityNum = $(this).siblings(".quantity-num");
            var $hiddenQuantityInput = $(this).closest('tr').find('input[name^="shop"][name$="[quantity]"]');
            
            if ($quantityNum.val() > 1) {
                $quantityNum.val(+$quantityNum.val() - 1);
                $hiddenQuantityInput.val($quantityNum.val());
            }
        });

        $(".quantity-arrow-plus").click(function(event) {
            event.preventDefault();
            var $quantityNum = $(this).siblings(".quantity-num");
            var $hiddenQuantityInput = $(this).closest('tr').find('input[name^="shop"][name$="[quantity]"]');
            
            $quantityNum.val(+$quantityNum.val() + 1);
            $hiddenQuantityInput.val($quantityNum.val());
        });
    }

    quantityProducts();
});


// single product page 
// modify 18-06-2024
// $(function() {
    
//     function quantityProducts2() {
        
//         $(".quantity-arrow-minus2").click(function(event) {
//             event.preventDefault();
//             var $quantityNum = $(this).siblings(".quantity-num2");
//             if ($quantityNum.val() > 1) { 
//                 $quantityNum.val(+$quantityNum.val() - 1);
//             }
//         });

        
//         $(".quantity-arrow-plus2").click(function(event) {
//             event.preventDefault();
//             var $quantityNum = $(this).siblings(".quantity-num2");
//             $quantityNum.val(+$quantityNum.val() + 1);
//         });
//     }

//     quantityProducts2(); 
// });


    $(function() {

    function quantityProducts2() {
        
        $(".quantity-arrow-minus2").click(function(event) {
            event.preventDefault();
            var $quantityNum = $(this).siblings(".quantity-num2");
            if ($quantityNum.val() > 1) { 
                $quantityNum.val(+$quantityNum.val() - 1);
            }
        });

        $(".quantity-arrow-plus2").click(function(event) {
            event.preventDefault();
            var $quantityNum = $(this).siblings(".quantity-num2");
            $quantityNum.val(+$quantityNum.val() + 1);
        });

        $(".quantity-num2").on("input", function() {
            var $quantityNum = $(this);
            if ($quantityNum.val() === "" || $quantityNum.val() <= 0) {
                $quantityNum.tooltip({
                    title: "You cannot add zero or blank quantity",
                    placement: "top",
                    trigger: "manual"
                }).tooltip("show");
            } else {
                $quantityNum.tooltip("dispose");
            }
        });

        $(".quantity-num2").on("focusout", function() {
            var $quantityNum = $(this);
            if ($quantityNum.val() === "" || $quantityNum.val() <= 0) {
                $quantityNum.val(1);
                $quantityNum.tooltip("dispose");
            }
        });
    }

    quantityProducts2(); 
});







    /*  Team-Slider-Owl-carousel  */
    if($('.instagram_slider').length){
        $('.instagram_slider').owlCarousel({
            loop:true,
            margin:30,
            dots:false,
            nav:false,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    center: false
                },
                320:{
                    items:1,
                    center: false
                },
                375:{
                    items:2,
                    center: false
                },
                520:{
                    items:2,
                    center: false
                },
                600: {
                    items: 2,
                    center: false
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                },
                1366: {
                    items: 5
                },
                1400: {
                    items: 5
                }
            }
        })
    }

    /*  Shop-Item-3-Grid-Slider-Owl-carousel  */
    if($('.shop_item_1grid_slider').length){
        $('.shop_item_1grid_slider').owlCarousel({
            loop:true,
            margin:30,
            center:false,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    center: false
                },
                480:{
                    items:1,
                    center: false
                },
                768: {
                    items: 1
                },
                992: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        })
    }

    /*  Shop-Item-2-Grid-Slider-Owl-carousel  */
    if($('.shop_item_2grid_slider').length){
        $('.shop_item_2grid_slider').owlCarousel({
            loop:true,
            margin:30,
            center:false,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    center: false
                },
                480:{
                    items:1,
                    center: false
                },
                600: {
                    items: 1,
                    center: false
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 2
                }
            }
        })
    }

    /*  Shop-Item-3-Grid-Slider-Owl-carousel  */
    if($('.shop_item_3grid_slider').length){
        $('.shop_item_3grid_slider').owlCarousel({
            loop:true,
            margin:30,
            center:true,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    center: false
                },
                480:{
                    items:1,
                    center: false
                },
                600: {
                    items: 1,
                    center: false
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        })
    }

    /*  Shop-Item-4-Grid-Slider-Owl-carousel  */
    if($('.shop_item_4grid_slider').length){
        $('.shop_item_4grid_slider').owlCarousel({
            loop:true,
            margin:0,
            center:false,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    center: false
                },
                480:{
                    items:1,
                    center: false
                },
                600: {
                    items: 1,
                    center: false
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                },
                1024: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        })
    }

    /*  Shop-Item-4-Grid-Slider-Owl-carousel  */
    if($('.shop_item_4grid_slider2').length){
        $('.shop_item_4grid_slider2').owlCarousel({
            loop:true,
            margin:0,
            center:false,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-chevron-left"></i>',
              '<i class="far fa-chevron-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    center: false
                },
                480:{
                    items:1,
                    center: false
                },
                600: {
                    items: 1,
                    center: false
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                },
                1024: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        })
    }

    /*  Shop-Item-5-Grid-Slider-Owl-carousel  */
    if($('.shop_item_5grid_slider').length){
        $('.shop_item_5grid_slider').owlCarousel({
            loop:true,
            margin:0,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 2,
                    center: false
                },
                480:{
                    items:2,
                    center: false
                },
                520:{
                    items:2,
                    center: false
                },
                767: {
                    items: 2,
                    center: false
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                },
                1366: {
                    items: 4
                },
                1400: {
                    items: 5
                }
            }
        })
    }

    /*  Shop-Item-6-Grid-Slider-Owl-carousel  */
    if($('.shop_item_6grid_slider').length){
        $('.shop_item_6grid_slider').owlCarousel({
            loop:true,
            margin:0,
            center:false,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 2,
                    center: false
                },
                480:{
                    items:2,
                    center: false
                },
                630: {
                    items: 2,
                    center: false
                },
                768: {
                    items: 3
                },
                992: {
                    items: 3
                },
                1024: {
                    items: 3
                },
                1200: {
                    items: 4
                },
                1400: {
                    items: 6
                }
            }
        })
    }

    /*  Shop-Item-7-Grid-Slider-Owl-carousel  */
    if($('.shop_item_7grid_slider').length){
        $('.shop_item_7grid_slider').owlCarousel({
            loop:true,
            margin:5,
            center:false,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 2,
                    center: false
                },
                480:{
                    items:2,
                    center: false
                },
                520: {
                    items: 2,
                    center: false
                },
                767: {
                    items: 2,
                    center: false
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1024: {
                    items: 4
                },
                1200: {
                    items: 5
                },
                1400: {
                    items: 5
                },
                1500: {
                    items: 7
                }
            }
        })
    }

    /*  Shop-Item-7-Grid-Slider-Owl-carousel  */
    if($('.shop_item_8grid_slider').length){
        $('.shop_item_8grid_slider').owlCarousel({
            loop:true,
            margin:0,
            center:false,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 2,
                    center: false
                },
                480:{
                    items:2,
                    center: false
                },
                520: {
                    items: 2,
                    center: false
                },
                767: {
                    items: 2,
                    center: false
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1024: {
                    items: 4
                },
                1200: {
                    items: 5
                },
                1400: {
                    items: 7
                },
                1500: {
                    items: 8
                }
            }
        })
    }

    /*  Shop-Item-10-Grid-Slider-Owl-carousel  */
    if($('.shop_item_10grid_slider').length){
        $('.shop_item_10grid_slider').owlCarousel({
            loop:true,
            margin:0,
            center:false,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 2,
                    center: false
                },
                480:{
                    items:2,
                    center: false
                },
                520: {
                    items: 2,
                    center: false
                },
                767: {
                    items: 2,
                    center: false
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1024: {
                    items: 4
                },
                1200: {
                    items: 5
                },
                1400: {
                    items: 7
                },
                1500: {
                    items: 10
                }
            }
        })
    }

    /*  Team-Slider-Owl-carousel  */
    if($('.bestseller_sidebar_slider').length){
        $('.bestseller_sidebar_slider').owlCarousel({
            loop:true,
            margin:30,
            dots:true,
            nav:true,
            rtl:false,
            autoplayHoverPause:false,
            autoplay: false,
            singleItem: true,
            smartSpeed: 1200,
            navText: [
              '<i class="far fa-arrow-left-long"></i>',
              '<i class="far fa-arrow-right-long"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    center: false
                },
                480:{
                    items:1,
                    center: false
                },
                520:{
                    items:1,
                    center: false
                },
                768: {
                    items: 1
                },
                992: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        })
    }

    /*  Expert-Freelancer-Owl-carousel  */
    if ($('.banner-style-one').length) {
        $('.banner-style-one').owlCarousel({
            loop: true,
            items: 1,
            margin: 0,
            dots: true,
            nav: true,
            animateOut: 'slideOutDown',
            animateIn: 'fadeIn',
            active: true,
            smartSpeed: 1000,
            autoplay: false
        });
        $('.banner-carousel-btn .left-btn').on('click', function() {
            $('.banner-style-one').trigger('next.owl.carousel');
            return false;
        });
        $('.banner-carousel-btn .right-btn').on('click', function() {
            $('.banner-style-one').trigger('prev.owl.carousel');
            return false;
        });
    }

    /* ----- Scroll To top ----- */
    function scrollToTop() {
        var btn = $('.scrollToHome');
        $(window).on('scroll', function () {
            if ($(window).scrollTop() > 300) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });
        btn.on('click', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
    }
    
    /* ----- Mega Dropdown Content ----- */
    $(document).on('ready', function(){
        $(".drop_btn").on('click',function(){
            $(".drop_content").toggle();
        });
        $(".drop_btn2").on('click',function(){
            $(".drop_content2").toggle();
        });
        $(".drop_btn3").on('click',function(){
            $(".drop_content3").toggle();
        });        
    });
    

/* ======
   When document is ready, do
   ====== */
    $(document).on('ready', function() {
      // add your functions
      navbarScrollfixed();
      scrollToTop();
      mobileNavToggle();
    });
    
/* ======
   When document is loading, do
   ====== */
    // window on Load function
    $(window).on('load', function() {
      // add your functions
      preloaderLoad();
    });
    // window on Scroll function
    $(window).on('scroll', function() {
      // add your functions
    });


})(window.jQuery);



// buyer dashboard js

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            if (confirm('Are you sure you want to delete this item?')) {
                const formData = new FormData(this);
                const url = this.getAttribute('action');
                
                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Optionally, remove the deleted row from the table
                        this.closest('tr').remove();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});


// buyer notification mark as read

 $(document).ready(function() {

    function toggleBoldClass(checkbox) {
        var messageCell = $(checkbox).closest('tr').find('.message-cell');
        var messageContent = messageCell.html();

        if ($(checkbox).is(':checked')) {
            // Remove strong tag if checked
            if (messageCell.find('strong').length > 0) {
                messageCell.html(messageContent.replace(/<strong>|<\/strong>/g, ''));
            }
        } else {
            // Add strong tag if unchecked
            if (messageCell.find('strong').length === 0) {
                messageCell.html('<strong>' + messageContent + '</strong>');
            }
        }
    }

        $('.mark-as-read').change(function() {
            let checkbox = $(this);
            let notificationId = checkbox.data('id');
            let isChecked = checkbox.is(':checked');
            let status = isChecked ? 1 : 0;

            toggleBoldClass(checkbox);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               
                url: uri + `/buyer_notifications/mark_as_read/${notificationId}`,
                type: 'POST',
                data: {
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Notification marked as read.');
                    } else {
                        console.error('Failed to mark notification as read.');
                        // Optionally, you can revert the checkbox state if needed
                        checkbox.prop('checked', !isChecked);
                        toggleBoldClass(checkbox);
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    // Optionally, you can revert the checkbox state if needed
                    checkbox.prop('checked', !isChecked);
                    toggleBoldClass(checkbox);
                }
            });
        });
    });





// redirect to changed password tabs

 $(document).ready(function () {
    // Get the query parameter from the URL
    var urlParams = new URLSearchParams(window.location.search);
    var tabParam = urlParams.get('tab');

    if (tabParam) {
        // Find the tab button with the corresponding data-bs-target and activate it
        var tabButton = $('button[data-bs-target="#' + tabParam + '"]');
        if (tabButton.length) {
            tabButton.tab('show');
        }
    }

    // Handle hash-based tab navigation
    var hash = window.location.hash;
    if (hash) {
        $('button[data-bs-target="' + hash + '"]').tab('show');
    }

    // Update URL when tab is clicked
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        var newUrl = window.location.pathname + '?tab=' + $(e.target).attr('data-bs-target').substring(1);
        window.history.replaceState(null, '', newUrl);
    });
});



// buyer address validation


 function validateContactForm() {
    var alpha = /^[a-zA-Z\s]*$/;
    var phoneno = /^[0-9]{10}$/;

    var contactName = document.forms["contact_form"]["contact_name"].value;
    var contactNumber = document.forms["contact_form"]["contact_number"].value;

    var valid = true;

    if (!contactName.match(alpha)) {
        document.getElementById('contact_name_error').innerText = 'Please enter a valid name (alphabetic characters only).';
        valid = false;
    } else {
        document.getElementById('contact_name_error').innerText = '';
    }

    if (!contactNumber.match(phoneno)) {
        document.getElementById('contact_number_error').innerText = 'Enter a valid 10-digit phone number.';
        valid = false;
    } else {
        document.getElementById('contact_number_error').innerText = '';
    }

    return valid;
}


// maually added image pop up on click


 var modal = document.getElementById("myModal");

    
    var modalImage = document.getElementById("modalImage");

    
    var span = document.getElementsByClassName("close")[0];

   
    span.onclick = function() {
        modal.style.display = "none";
    }

    
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    
    function showImageModal(imageSrc) {
        modalImage.src = imageSrc;
        modal.style.display = "block";
    }







//  rfq graph


// $(document).ready(function() {
//     // Ensure the CSRF token is set for AJAX requests
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     // Function to initialize RFQ count and optionally reload page
//     function initializeRFQCount(selectedValue, reloadPage) {
//         $.ajax({
//             url: '/get-rfq-count',  // Ensure this URL is correct
//             type: 'POST',
//             data: {
//                 company_id: selectedValue
//             },
//             success: function(response) {
//                 $('#rfq-count').text(response.rfqs_count);
//                 if (accountType === 'company') {
//                     updateGraph(response.rfqs_count);
//                 }

//                 if ($('#rfqLink').hasClass('-is-active') && reloadPage) {
//                     console.log('RFQs tab is active. Refreshing page...');
//                     location.reload();
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error getting RFQ count:', error);
//             }
//         });
//     }

//     // Function to update the graph
//     function updateGraph(rfqCount) {
//         var executiveCount = 0;
//         var deletedCount = parseInt(document.getElementById('rfq-deleted-count').textContent) || 0;
//         var modifiedCount = 0;

//         var total = rfqCount + executiveCount + deletedCount + modifiedCount;

//         var rfqPercentage = total > 0 ? Math.round((rfqCount / total) * 100) : 0;
//         var executivePercentage = total > 0 ? Math.round((executiveCount / total) * 100) : 0;
//         var deletedPercentage = total > 0 ? Math.round((deletedCount / total) * 100) : 0;
//         var modifiedPercentage = total > 0 ? Math.round((modifiedCount / total) * 100) : 0;

//         var series = total > 0 ? [rfqPercentage, executivePercentage, deletedPercentage, modifiedPercentage] : [0, 0, 0, 0];
//         var displayTotal = total > 0 ? "100%" : "0%";

//         console.log('Series data for graph:', series);

//         var options = {
//             chart: {
//                 height: 300,
//                 type: "donut"
//             },
//             labels: ["RFQ Raised", "Executed", "Deleted", "Modified"],
//             series: series,
//             colors: ['#ff9400', '#ff4e00', '#959595', '#000'],
//             stroke: {
//                 show: false,
//                 curve: "straight"
//             },
//             dataLabels: {
//                 enabled: true,
//                 formatter: function (val, opts) {
//                     return opts.w.config.series[opts.seriesIndex] === 0 ? "0%" : Math.round(val) + "%";
//                 }
//             },
//             tooltip: {
//                 y: {
//                     formatter: function (val, opts) {
//                         return opts.w.config.series[opts.seriesIndex] === 0 ? "0%" : Math.round(val) + "%";
//                     }
//                 }
//             },
//             legend: {
//                 show: true,
//                 position: "bottom",
//                 markers: {
//                     offsetX: -3
//                 },
//                 itemMargin: {
//                     vertical: 3,
//                     horizontal: 10
//                 },
//                 labels: {
//                     colors: "#333",
//                     useSeriesColors: false
//                 }
//             },
//             plotOptions: {
//                 pie: {
//                     donut: {
//                         labels: {
//                             show: true,
//                             name: {
//                                 fontSize: "1.5rem",
//                                 fontFamily: "Public Sans"
//                             },
//                             value: {
//                                 fontSize: "1rem",
//                                 color: "#333",
//                                 fontFamily: "Public Sans",
//                                 formatter: function (e) {
//                                     return e === 0 ? "0%" : Math.round(e) + "%";
//                                 }
//                             },
//                             total: {
//                                 show: true,
//                                 fontSize: "1rem",
//                                 color: "#333",
//                                 label: "",
//                                 formatter: function (e) {
//                                     return displayTotal;
//                                 }
//                             }
//                         }
//                     }
//                 }
//             },
//             responsive: [{
//                 breakpoint: 992,
//                 options: {
//                     chart: {
//                         height: 380
//                     },
//                     legend: {
//                         position: "bottom",
//                         labels: {
//                             colors: "#333",
//                             useSeriesColors: false
//                         }
//                     }
//                 }
//             }, {
//                 breakpoint: 576,
//                 options: {
//                     chart: {
//                         height: 320
//                     },
//                     plotOptions: {
//                         pie: {
//                             donut: {
//                                 labels: {
//                                     show: true,
//                                     name: {
//                                         fontSize: "1.2rem"
//                                     },
//                                     value: {
//                                         fontSize: ".8rem"
//                                     },
//                                     total: {
//                                         fontSize: "1.2rem"
//                                     }
//                                 }
//                             }
//                         }
//                     },
//                     legend: {
//                         position: "bottom",
//                         labels: {
//                             colors: "#333",
//                             useSeriesColors: false
//                         }
//                     }
//                 }
//             }, {
//                 breakpoint: 420,
//                 options: {
//                     chart: {
//                         height: 280
//                     },
//                     legend: {
//                         show: false
//                     }
//                 }
//             }, {
//                 breakpoint: 360,
//                 options: {
//                     chart: {
//                         height: 250
//                     },
//                     legend: {
//                         show: false
//                     }
//                 }
//             }]
//         };

//         // Ensure the chart div exists before initializing the chart
//         var chartDiv = document.querySelector("#rfqchart");
//         if (chartDiv) {
//             chartDiv.innerHTML = ""; // Clear any existing chart
//             var chart = new ApexCharts(chartDiv, options);
//             chart.render();
//         } else {
//             console.error("Chart div not found!");
//         }
//     }

//     var accountType = '{{ Session::get('account_type') }}';

//     // Handle company change event
//     $('#companySelect').change(function() {
//         var selectedValue = $(this).val();

//         $.ajax({
//             url: '/update_company',  // Ensure this URL is correct
//             type: 'POST',
//             data: {
//                 company_id: selectedValue
//             },
//             success: function(response) {
//                 console.log('Company ID updated in session.');
//                 initializeRFQCount(selectedValue, false);

//                 if ($('#rfqLink').hasClass('-is-active')) {
//                     console.log('RFQs tab is active. Redirecting to RFQ list page...');
//                     window.location.href = '/buyer/buyer_rfq';  // Ensure this URL is correct
//                 } else {
//                     initializeRFQCount(selectedValue, true);
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error updating company ID:', error);
//             }
//         });
//     });

//     // Initial load
//     var selectedValue = $('#companySelect').val();
//     initializeRFQCount(selectedValue, false);
// });
