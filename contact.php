<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}
include_once('includes/header.php');
include('functions.php');

?>

<div class="dashboard__main pl0-md">
    <div class="dashboard__content bg-color-buyer-dashboard">
        <div class="row">
        <a href="export.php?type=contact" style="font-size: 1rem; color: white; padding: 1rem; background-color: orange;">Export Contact</a>
            <div class="col-xl-12">
                <div class="dashboard_product_list account_user_deails">
                    <div class="row d-block d-sm-flex justify-content-center justify-content-sm-between"></div>
                    <div class="order_table table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">S. No.</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">NAME</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">Phone</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">Email</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">Pincode</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">State</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">City</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">Message</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM contact";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $sno = 1;
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr class='buyer-dashboard-recent-activity-table-outer' data-id='" . $row['id'] . "'>";
                                        echo "<td class='buyer-dashboard-right-border'>" . $sno++ . "</td>";
                                        echo "<td class='buyer-dashboard-right-border'>" . $row['name'] . "</td>";
                                        echo "<td class='buyer-dashboard-right-border'>" . $row['phone'] . "</td>";
                                        echo "<td class='buyer-dashboard-right-border'>" . $row['email'] . "</td>";
                                        echo "<td class='buyer-dashboard-right-border'>" . $row['pincode'] . "</td>";
                                        echo "<td class='buyer-dashboard-right-border'>" . $row['state'] . "</td>";
                                        echo "<td class='buyer-dashboard-right-border'>" . $row['city'] . "</td>";
                                        echo "<td class='buyer-dashboard-right-border'>" . $row['message'] . "</td>";
                                        echo "<td class='editing_list align-middle'>
                                            <ul>
                                                <li class='list-inline-item mb-1'>
                                                    <a href='#' data-bs-toggle='tooltip' data-bs-placement='top' title='View' data-bs-original-title='View' aria-label='View' target='_blank'><i class='fa fa-eye'></i></a>
                                                </li>
                                                <li class='list-inline-item mb-1'>
                                                    <a href='#' class='delete-button' data-id='" . $row['id'] . "' data-table='contact' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete' data-bs-original-title='Delete' aria-label='Delete'>
                                                        <i class='fa fa-trash' aria-hidden='true'></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No records found</td></tr>";
                                }

                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    

<?php include_once('includes/footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function() {
       
        $('.data-table').DataTable();

        
        function deleteRecord(id, tableName) {
            $.ajax({
                url: 'functions.php',
                type: 'POST',
                data: { action: 'delete', id: id, tablename: tableName },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        
                        $('tr[data-id="' + id + '"]').remove();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error deleting record');
                }
            });
        }

        // Attach delete action to buttons
        $(document).on('click', '.delete-button', function(event) {
            event.preventDefault(); // Prevent the default action of the link
            var id = $(this).data('id');
            var tableName = $(this).data('table');
            if (confirm('Are you sure you want to delete this record?')) {
                deleteRecord(id, tableName);
            }
        });
    });
</script>
