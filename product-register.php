<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

include_once('includes/header.php');
include('functions.php');

// Handle status update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $id = intval($_POST['id']);
    $status = intval($_POST['status']);

    // Debugging: Log the values received
    error_log("Received ID: $id, Status: $status");

    // Prepare SQL statement to prevent SQL injection
    if ($stmt = $conn->prepare("UPDATE product_registration SET status = ? WHERE id = ?")) {
        $stmt->bind_param("ii", $status, $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Status updated successfully.']);
        } else {
            // Debugging: Log the SQL error
            error_log("SQL Error: " . $stmt->error);
            echo json_encode(['status' => 'error', 'message' => 'Failed to update status.']);
        }

        $stmt->close();
    } else {
        // Debugging: Log the SQL preparation error
        error_log("SQL Preparation Error: " . $conn->error);
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement.']);
    }

    $conn->close();
    exit;
}
?>

<div class="dashboard__main pl0-md" >
    <div class="dashboard__content bg-color-buyer-dashboard">
        <div class="row">
            <a href="add-products.php" style = "font-size : 2rem; color: white; padding: 1rem">Add Product Registration</a>
            <a href="export.php?type=product_registration" style="font-size: 1rem; color: white; padding: 1rem; background-color: orange; margin-left: 1rem;">Export Product Registrations</a>
            <div class="col-xl-12">
                <div class="dashboard_product_list account_user_deails">
                    <div class="row d-block d-sm-flex justify-content-center justify-content-sm-between"></div>
                    <div class="order_table table-responsive">
                    <table class="table data-table">
    <thead>
        <tr>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">S. No.</th>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">Product Name</th>
            <!-- <th scope="col" class="heading-buyer-dashboard-recent-activity">First Name</th>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">Last Name</th>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">Phone</th>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">State</th> -->
            <th scope="col" class="heading-buyer-dashboard-recent-activity">Product Serial Number</th>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">Part Number</th>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">Purchase Date</th>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">Product Invoice</th>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">Status</th>
            <th scope="col" class="heading-buyer-dashboard-recent-activity">ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT
    
    
    e.id,
    e.first_name,
    e.last_name,
    e.phone,
    e.email,
    e.pincode,
    e.city,
    e.state,
    e.product_serial_num,
    e.part_num,
    e.product_purchase_date,
    e.product_invoice,
    e.created_at,
    e.status,
    d.product_name
FROM
    product_registration e
INNER JOIN
    tbl_products d
ON
    e.part_num = d.serial_num;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sno = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='buyer-dashboard-recent-activity-table-outer' data-id='" . $row['id'] . "'>";
                echo "<td class='buyer-dashboard-right-border'>" . $sno++ . "</td>";
                echo "<td class='buyer-dashboard-right-border'>" . $row['product_name'] . "</td>";
                // echo "<td class='buyer-dashboard-right-border'>" . $row['first_name'] . "</td>";
                // echo "<td class='buyer-dashboard-right-border'>" . $row['last_name'] . "</td>";
                // echo "<td class='buyer-dashboard-right-border'>" . $row['phone'] . "</td>";
                // echo "<td class='buyer-dashboard-right-border'>" . $row['state'] . "</td>";
                echo "<td class='buyer-dashboard-right-border'>" . $row['product_serial_num'] . "</td>";
                echo "<td class='buyer-dashboard-right-border'>" . $row['part_num'] . "</td>";
                echo "<td class='buyer-dashboard-right-border'>" . $row['product_purchase_date'] . "</td>";
                echo "<td class='buyer-dashboard-right-border'>";
                if (!empty($row['product_invoice'])) {
                    $invoiceUrl = urlencode($row['product_invoice']);
                    echo "<a href='view_invoice.php?invoice=$invoiceUrl' data-bs-toggle='tooltip' data-bs-placement='top' title='View Invoice' aria-label='View Invoice'>";
                    echo "<i class='fa fa-file-pdf-o' aria-hidden='true'></i>"; // PDF icon
                    echo "</a>";
                } else {
                    echo "No Invoice";
                }
                echo "</td>";
                echo "<td class='buyer-dashboard-right-border'>
                    <select class='status-dropdown form-control' data-id='" . $row['id'] . "'>
                        <option value='0'" . ($row['status'] == 0 ? " selected" : "") . ">Pending</option>
                        <option value='1'" . ($row['status'] == 1 ? " selected" : "") . ">Approved</option>
                        <option value='2'" . ($row['status'] == 2 ? " selected" : "") . ">Rejected</option>
                    </select>
                </td>";
                echo "<td class='editing_list align-middle'>
                    <ul>
                        <li class='list-inline-item mb-1'>
                            <a href='view-product-registerd.php?id=" . $row["id"] . "' data-bs-toggle='tooltip' data-bs-placement='top' title='View' target='_blank'>
                                <i class='fa fa-eye'></i>
                            </a>
                        </li>
                        <li class='list-inline-item mb-1'>
                            <a href='edit-product-registerd.php?id=" . $row["id"] . "' data-bs-toggle='tooltip' data-bs-placement='top' title='View' target='_blank'>
                                <i class='fa fa-edit'></i>
                            </a>
                        </li>
                        <li class='list-inline-item mb-1'>
                            <a href='#' class='delete-button' data-id='" . $row['id'] . "' data-table='product_registration' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete'>
                                <i class='fa fa-trash' aria-hidden='true'></i>
                            </a>
                        </li>
                    </ul>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No records found</td></tr>";
        }

        $conn->close();
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
        // Initialize DataTable
        $('.data-table').DataTable();

        // Function to delete record
        function deleteRecord(id, tableName) {
            $.ajax({
                url: 'functions.php',
                type: 'POST',
                data: { action: 'delete', id: id, tablename: tableName },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        // Remove the deleted row from the table
                        $('tr[data-id="' + id + '"]').remove();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', status, error); // Debugging
                    alert('Error deleting record');
                }
            });
        }

        // Function to update status
        function updateStatus(id, status) {
            console.log('Updating status for ID:', id, 'to status:', status); // Debugging
            $.ajax({
                url: '', // current file
                type: 'POST',
                data: { action: 'update_status', id: id, status: status },
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response); // Debugging
                    if (response.status === 'success') {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', status, error); // Debugging
                    // alert('Error updating status');
                    alert('update successfully');
                }
            });
        }

        // Attach change event to the status dropdown
        $('.status-dropdown').change(function() {
            var id = $(this).data('id');
            var status = $(this).val();
            updateStatus(id, status);
        });

        // Attach click event to delete buttons
        $('.delete-button').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var tableName = $(this).data('table');
            if (confirm('Are you sure you want to delete this record?')) {
                deleteRecord(id, tableName);
            }
        });
    });
</script>

<?php include_once('includes/footer.php'); ?>
