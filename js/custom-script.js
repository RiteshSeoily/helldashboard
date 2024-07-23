
//********************* buyers list Filter **************************************************

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('input[name="filter"]').change(function() {
        var filter = $(this).val();
       
        $.ajax({
            url: uri + '/admin/all-buyers',
            type: 'GET',
            data: { filter: filter },
            success: function(response) {
                var tbody = '';
                $.each(response.allusers.data, function(index, user) {
                    var serial = index + 1 + (response.allusers.current_page - 1) * response.allusers.per_page;
                    tbody += `<tr class="buyer-dashboard-recent-activity-table-outer">
                        <td class="buyer-dashboard-right-border">${serial}</td>
                        <td class="buyer-dashboard-right-border">${user.first_name}</td>
                        <td class="buyer-dashboard-right-border">${user.email}</td>
                        <td class="buyer-dashboard-right-border">${user.phone_number}</td>
                        <td class="buyer-dashboard-right-border">${user.account_type}</td>
                        <td class="buyer-dashboard-right-border">${user.rfq_count}</td>
                        <td class="buyer-dashboard-right-border">0</td>
                        <td class="editing_list align-middle">
                            <ul>
                                <li class="list-inline-item mb-1">
                                    <a href="buyer-detail-list/${user.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" aria-label="View"><i class="fa fa-eye"></i></a>
                                </li>
                                <li class="list-inline-item mb-1">
                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" aria-label="Edit"><i class="fa fa-pen" aria-hidden="true"></i></a>
                                </li>
                                <li class="list-inline-item mb-1">
                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" aria-label="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </td>
                    </tr>`;
                });

                $('#buyer-list-tbody').html(tbody);
                $('.pagination-wrapper').html(response.allusers.links);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});


//********************* End buyers list Filter **************************************************

//********************* start buyer-details filter **********************************************

// $(document).ready(function() {
//     // Handle GST filter changes
//     var buyerId = $('#buyer-id').val();
//     $('input[name="gst-filter"]').change(function() {
//         var filter = $(this).val();
//         $.ajax({
//             url: uri + '/admin/buyer-detail-list/' + buyerId,
//             type: 'GET',
//             data: {
//                 filter: filter,
//             },
//             success: function(response) {
//                 console.log(response.rfq_count);
//                 var tbody = '';
//                 $.each(response.buyer_details.addresses, function(index, address) {
//                     if (filter === 'all' || address.gst_number === filter) {
//                         tbody += `<tr class="buyer-dashboard-recent-activity-table-outer">
//                             <td class="buyer-dashboard-right-border">${index + 1}</td>
//                             <td class="buyer-dashboard-right-border">${response.buyer_details.first_name}</td>
//                             <td class="buyer-dashboard-right-border">${response.buyer_details.email}</td>
//                             <td class="buyer-dashboard-right-border">${response.buyer_details.phone_number}</td>
//                             <td class="buyer-dashboard-right-border">${address.gst_number}</td>
//                             <td class="buyer-dashboard-right-border">${response.buyer_details.pan_number ?? 'N/A'}</td>
//                             <td class="buyer-dashboard-right-border">${address.location}</td>
//                             <td class="buyer-dashboard-right-border">${address.state}</td>
//                             <td class="buyer-dashboard-right-border">${response.rfq_count}</td>
//                             <td class="buyer-dashboard-right-border">0</td>
//                             <td class="buyer-dashboard-right-border">50K</td>
//                         </tr>`;
//                     }
//                 });

//                 $('#buyer-details-tbody').html(tbody);
//                 $('#totalRFQCount').text(response.rfq_count);
//             },
//             error: function(xhr, status, error) {
//                 console.log(error);
//             }
//         });
//     });
// });



$(document).ready(function() {
    // Handle GST filter changes
    var buyerId = $('#buyer-id').val();
    $('input[name="gst-filter"]').change(function() {
        var filter = $(this).val();
        $.ajax({
            url: uri + '/admin/buyer-detail-list/' + buyerId,
            type: 'GET',
            data: {
                filter: filter,
            },
            success: function(response) {
                console.log(response.rfq_count);
                
                // Update buyer details table
                var tbody = '';
                $.each(response.buyer_details.addresses, function(index, address) {
                    if (filter === 'all' || address.gst_number === filter) {
                        tbody += `<tr class="buyer-dashboard-recent-activity-table-outer">
                            <td class="buyer-dashboard-right-border">${index + 1}</td>
                            <td class="buyer-dashboard-right-border">${response.buyer_details.first_name}</td>
                            <td class="buyer-dashboard-right-border">${response.buyer_details.email}</td>
                            <td class="buyer-dashboard-right-border">${response.buyer_details.phone_number}</td>
                            <td class="buyer-dashboard-right-border">${address.gst_number ?? 'N/A'}</td>
                            <td class="buyer-dashboard-right-border">${response.buyer_details.pan_number ?? 'N/A'}</td>
                            <td class="buyer-dashboard-right-border">${address.location}</td>
                            <td class="buyer-dashboard-right-border">${address.state}</td>
                            <td class="buyer-dashboard-right-border">${response.rfq_count}</td>
                            <td class="buyer-dashboard-right-border">0</td>
                            <td class="buyer-dashboard-right-border">50K</td>
                        </tr>`;
                    }
                });

                $('#buyer-details-tbody').html(tbody);
                $('#totalRFQCount').text(response.rfq_count);
                
                // Update RFQ table
                var rfqTbody = '';
                if (response.rfq_details.length > 0) {
                    $.each(response.rfq_details, function(index, rfq) {
                        rfqTbody += `<tr class="buyer-dashboard-recent-activity-table-outer">
                            <td class="buyer-dashboard-right-border">${index + 1}</td>
                            <td class="buyer-dashboard-right-border">${rfq.rfq_number}</td>
                            <td class="buyer-dashboard-right-border">${rfq.created_at}</td>
                            <td class="buyer-dashboard-right-border">${rfq.type_a}</td>
                            <td class="editing_list align-middle">
                                <ul>
                                    <li class="list-inline-item mb-1">
                                        <a href="rfqs-detail/${rfq.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" aria-label="View"><i class="fa fa-eye"></i></a>
                                    </li>
                                    <li class="list-inline-item mb-1">
                                        <a href="buyer-rfqs-edit/${rfq.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" aria-label="Edit"><i class="fa fa-pen" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="list-inline-item mb-1">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="History" data-bs-original-title="History" aria-label="History"><i class="fa fa-history" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </td>
                        </tr>`;
                    });
                } else {
                    rfqTbody += `<tr class="buyer-dashboard-recent-activity-table-outer">
                        <td colspan="5" class="text-center">No RFQ found for this GST</td>
                    </tr>`;
                }

                $('#rfq-details-tbody').html(rfqTbody);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});

