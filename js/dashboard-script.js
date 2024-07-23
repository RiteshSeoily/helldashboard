//toggle between hiding and showing the dropdown content
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
// Closes dropdown
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

// Sidebar Menu Script
$.sidebarMenu = function(menu) {
    var animationSpeed = 300;  
    $(menu).on('click', 'li a', function(e) {
      var $this = $(this);
      var checkElement = $this.next();
      if (checkElement.is('.treeview-menu') && checkElement.is(':visible')) {
        checkElement.slideUp(animationSpeed, function() {
          checkElement.removeClass('menu-open');
        });
        checkElement.parent("li").removeClass("active");
      }

      //If the menu is not visible
      else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
          //Get the parent menu
          var parent = $this.parents('ul').first();
          //Close all open menus within the parent
          var ul = parent.find('ul:visible').slideUp(animationSpeed);
          //Remove the menu-open class from the parent
          ul.removeClass('menu-open');
          //Get the parent li
          var parent_li = $this.parent("li");
          //Open the target menu and add the menu-open class
          checkElement.slideDown(animationSpeed, function() {
          //Add the class active to the parent li
          checkElement.addClass('menu-open');
          parent.find('li.active').removeClass('active');
          parent_li.addClass('active');
          });
      }
      //if this isn't a link, prevent the page from being redirected
      if (checkElement.is('.treeview-menu')) {
        e.preventDefault();
      }
    });
}
$.sidebarMenu($('.sidebar-menu'))

/* ----- Dashboard Sidebar Open Close ----- */
$(document).on("ready",function(){
  $(".dashboard_sidebar_toggle_icon").on("click",function(){
    $(".dashboard.dashboard_wrapper").toggleClass("dsh_board_sidebar_hidden");
  });
});


// Address Primary

$(document).ready(function() {
  uri = "https://justprocure.com";
    $('.primary-address-checkbox').change(function() {
        var addressId = $(this).data('address-id');
        var isChecked = $(this).prop('checked');

        // Update all addresses to be unchecked initially
        $('.primary-address-checkbox').prop('checked', false);

        // Check the clicked checkbox
        $(this).prop('checked', true);

        $.ajax({
          headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            
            type: 'POST',
            url: uri + '/update-address-type',
            data: {
                address_id: addressId,
                
                
            },
            success: function(response) {
                // Handle success response
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});



// buyer rfq count according to their selected company




//23-06-2024


$(document).ready(function() {
    var uri = window.location.origin; // Ensure the base URL is correctly set

    function initializeRFQCount(selectedValue, reloadPage) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: uri + '/get-rfq-count',
            type: 'POST',
            data: {
                company_id: selectedValue,
            },
            success: function(response) {
                $('.rfqs-count h2').text(response.rfqs_count);
                $('#rfqs-count').text(response.rfqs_count);

                if (reloadPage) {
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error getting RFQ count:', error);
            }
        });
    }

    function updateCompany(selectedValue, isDetailPage, isNotificationPage, isDashboardPage, isSettingsPage) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: uri + '/update_company',
            type: 'POST',
            data: {
                company_id: selectedValue,
            },
            success: function(response) {
                if (response.status === 'success') {
                    console.log('Company ID updated in session:', response.selected_company_id);

                    // Update the selected value in the dropdown to reflect the change
                    $('#companySelect').val(selectedValue);

                    // After updating company ID, update RFQ count without reloading page
                    initializeRFQCount(selectedValue, false);

                    var dashboardUrl = uri + '/buyer/dashboard';
                    var rfqListUrl = uri + '/buyer/buyer_rfq';

                    if (isSettingsPage) {
                        window.location.href = dashboardUrl;
                    } else if (isDetailPage || isNotificationPage || isDashboardPage) {
                        if (isDashboardPage) {
                            location.reload();
                        } else {
                            window.location.href = dashboardUrl;
                        }
                    } else {
                        if ($('#rfqLink').hasClass('-is-active')) {
                            window.location.href = rfqListUrl;
                        } else {
                            initializeRFQCount(selectedValue, true);
                        }
                    }
                } else {
                    console.error('Failed to update company ID in session.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating company ID:', error);
            }
        });
    }

    // Handle company change event
    $('#companySelect').change(function() {
        var selectedValue = $(this).val();

        if (selectedValue === 'create_new_company') {
            window.location.href = uri + '/buyer/buyer-settings#socialprofile';
        } else {
            var currentUrl = window.location.href;
            var rfqDetailUrlPattern = /\/buyer_rfq_detail\/\d+/;
            var notificationUrlPattern = /\/buyer\/notification/;
            var dashboardUrlPattern = /\/buyer\/dashboard/;
            var settingsUrlPattern = /\/buyer\/buyer-settings/;

            var isDetailPage = rfqDetailUrlPattern.test(currentUrl);
            var isNotificationPage = notificationUrlPattern.test(currentUrl);
            var isDashboardPage = dashboardUrlPattern.test(currentUrl);
            var isSettingsPage = settingsUrlPattern.test(currentUrl);

            console.log('Company selected:', selectedValue);
            updateCompany(selectedValue, isDetailPage, isNotificationPage, isDashboardPage, isSettingsPage);
        }
    });

    // Check initial state on page load
    var selectedValue = $('#companySelect').val();
    if (selectedValue) {
        initializeRFQCount(selectedValue, false); // Initialize RFQ count without reloading page
    }
});











// wishllist delete

$(document).ready(function() {
        $('.delete-wishlist-item').on('click', function(event) {
            event.preventDefault();
            var wishlistId = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure want to delete this wishlist product?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: uri + '/buyer-delete-wishlist-item',

                        method: 'POST',
                        data: {
                           
                            wishlist_id: wishlistId
                        },
                        success: function(response) {
                            if (response.success) {
                                // Swal.fire(
                                //     'Deleted!',
                                //     'Your wishlist product has been deleted.',
                                //     'success'
                                // ).then(() => {
                                //     location.reload();
                                // });

                                location.reload();
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Failed to delete the item.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the item.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });


// Delete buyer account script

$(document).ready(function() {
        // Send verification email
        $('#sendVerificationEmail').click(function() {
            var email = $('#email').val();
            //alert(email);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
                url: uri + '/buyer-send-verification-email',
                type: 'POST',
                data: {
                    email: email
                },
                success: function(response) {
                    // alert(response.message); // Show success message
                    // console.log(response.message);
                    // $('#deleteAccountBtn').show(); // Show delete account button

                    Swal.fire({
                title: 'Verification link sent successfully!',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
            console.log(response.message);
            $('#deleteAccountBtn').show();

                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    //alert(err.error); // Show error message
                    console.log(err.error);

                    Swal.fire({
                title: 'Error!',
                text: err.error,
                icon: 'error',
                confirmButtonText: 'OK'
            });
                }
            });
        });

        // Handle form submission for deleting account
        $('#deleteAccountForm').submit(function(e) {
            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
                url: uri + '/buyer-delete-account',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    alert('Your account has been successfully deleted.');
                    window.location.href = '/'; // Redirect to homepage or desired location
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    alert(err.error); // Show error message
                }
            });
        });
    });



// notification select all checbox functionality


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
    // Handle "Select All" checkbox change
    $('#select-all-mark-read').on('change', function() {
        var isChecked = $(this).is(':checked');
        $('.mark-as-read').prop('checked', isChecked);

        // Gather all notification IDs
        var notificationIds = [];
        $('.mark-as-read').each(function() {
            notificationIds.push($(this).data('id'));
            toggleBoldClass(this); // Update bold class for each checkbox
        });

        // Send AJAX request to update the server
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/mark-all-as-read', // Ensure this URL is correct
            data: {
                mark_as_read: isChecked ? 1 : 0,
                notification_ids: notificationIds
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

});


// rfq delete form

$(document).ready(function() {
        $('.rfqdeleteForm').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this RFQ.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                }
            });
        });
    });


// notification  delete alert 

$(document).ready(function() {
        $('.notify-delete-row').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this Notification.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                }
            });
        });
    });

// rfq product delete alert


document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.rfq-product-delete-form');

        deleteForms.forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Are you sure you want to delete this Product?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });

// company address  delete alert 

$(document).ready(function() {
        $('.delete-company-address').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure you want to delete this company record?',
                text: 'You are about to delete this company record.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                }
            });
        });
    });

// setting tab buyer dashboard profile form validation

$(document).ready(function() {
    // Real-time validation for the first name input
    $('input[name="first_name"]').on('keyup', function() {
        var pattern = /^[A-Za-z\s]+$/;
        if (!pattern.test($(this).val())) {
            $(this).addClass('is-invalid');
            $(this).next('.invalid-feedback').show();
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').hide();
        }
    });

    // Validate form on submit
    $('form.profile_form').on('submit', function(event) {
        var isValid = true;

        // Check the first name
        var firstName = $('input[name="first_name"]');
        var pattern = /^[A-Za-z\s]+$/;
        if (!pattern.test(firstName.val())) {
            firstName.addClass('is-invalid');
            firstName.next('.invalid-feedback').show();
            isValid = false;
        } else {
            firstName.removeClass('is-invalid');
            firstName.next('.invalid-feedback').hide();
        }

        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
        }
    });
});
