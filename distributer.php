<?php
session_start();
 include('includes/header.php'); 
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

// Fetch the list of products from the database
$stmt = $conn->prepare("SELECT * FROM partners_details");
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle status update
    if (isset($_POST['action']) && $_POST['action'] === 'update_status') {
        $id = intval($_POST['id']);
        $status = intval($_POST['status']);
        $tableName = $_POST['tablename'];

        if ($tableName === 'partners_details') {
            $stmt = $conn->prepare("UPDATE partners_details SET status = ? WHERE id = ?");
            $stmt->bind_param('ii', $status, $id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Status updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error updating status.']);
            }
            $stmt->close();
        }
        exit;
    }

    // Handle delete request
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = intval($_POST['id']);
        $tableName = $_POST['tablename'];

        if ($tableName === 'partners_details') {
            $stmt = $conn->prepare("DELETE FROM partners_details WHERE id = ?");
            $stmt->bind_param('i', $id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error deleting record.']);
            }
            $stmt->close();
        }
        exit;
    }
}
?>



    <div class="dashboard__main pl0-md">
        <div class="dashboard__content bg-color-buyer-dashboard">
            <div class="row">
            <a href="export.php?type=distributer" style="font-size: 1rem; color: white; padding: 1rem; background-color: orange;">Export Distributers</a>
                <div class="col-xl-12">
                    <div class="dashboard_product_list account_user_deails">
                        <div class="row d-block d-sm-flex justify-content-center justify-content-sm-between"></div>
                        <div class="order_table table-responsive">
                            <table class="table data-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="heading-buyer-dashboard-recent-activity">S. No.</th>
                                        <th scope="col" class="heading-buyer-dashboard-recent-activity">FIRST NAME</th>
                                        <th scope="col" class="heading-buyer-dashboard-recent-activity">LAST NAME</th>
                                        <th scope="col" class="heading-buyer-dashboard-recent-activity">EMAIL</th>
                                        <th scope="col" class="heading-buyer-dashboard-recent-activity">STATE</th>
                                        <th scope="col" class="heading-buyer-dashboard-recent-activity">STATUS</th>
                                        <th scope="col" class="heading-buyer-dashboard-recent-activity">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $serial_number = 1;
                                    foreach ($products as $product) {
                                        ?>
                                        <tr class="buyer-dashboard-recent-activity-table-outer">
                                            <td class="buyer-dashboard-right-border"><?php echo $serial_number++; ?></td>
                                            <td class="buyer-dashboard-right-border"><?php echo htmlspecialchars($product['first_name']); ?></td>
                                            <td class="buyer-dashboard-right-border"><?php echo htmlspecialchars($product['last_name']); ?></td>
                                            <td class="buyer-dashboard-right-border"><?php echo htmlspecialchars($product['email']); ?></td>
                                            <td class="buyer-dashboard-right-border"><?php echo htmlspecialchars($product['state']); ?></td>
                                            
                                            <td class="buyer-dashboard-right-border">
                                                <select class="status-dropdown form-control" data-id="<?php echo $product['id']; ?>">
                                                    <option value="0" <?php echo $product['status'] == 0 ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="1" <?php echo $product['status'] == 1 ? 'selected' : ''; ?>>Approved</option>
                                                    <option value="2" <?php echo $product['status'] == 2 ? 'selected' : ''; ?>>Rejected</option>
                                                    <option value="3" <?php echo $product['status'] == 3 ? 'selected' : ''; ?>>Not Relevant</option>
                                                </select>
                                            </td>
                                            
                                            <td class="editing_list align-middle">
                                                <ul>
                                                    <li class='list-inline-item mb-1'>
                                                        <a href='view-distributer.php?id=<?php echo $product['id']; ?>' data-bs-toggle='tooltip' data-bs-placement='top' title='View' aria-label='View'><i class='fa fa-eye'></i></a>
                                                    </li>
                                                    <li class='list-inline-item mb-1'>
                                                        <a href='edit-distributer.php?id=<?php echo $product['id']; ?>' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit' aria-label='Edit'><i class='fa fa-edit'></i></a>
                                                    </li>
                                                    <li class='list-inline-item mb-1'>
                                                        <a href='#' class='delete-button' data-id='<?php echo $product['id']; ?>' data-table='partners_details' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete' aria-label='Delete'>
                                                            <i class='fa fa-trash' aria-hidden='true'></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                </div>
                                </div>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.data-table').DataTable();

        function deleteRecord(id, tableName) {
            $.ajax({
                url: '',
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

        function updateStatus(id, status) {
            $.ajax({
                url: '',
                type: 'POST',
                data: { action: 'update_status', id: id, status: status, tablename: 'partners_details' },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    //alert('Error updating status');
                    alert('status updated');
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

        // Attach status change action to dropdowns
        $(document).on('change', '.status-dropdown', function() {
            var id = $(this).data('id');
            var status = $(this).val();
            updateStatus(id, status);
        });
    });
    </script>

    <?php include('includes/footer.php'); ?>

