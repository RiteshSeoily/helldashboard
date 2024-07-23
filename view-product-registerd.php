
<?php 
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

include('functions.php');

$success_message = '';
$error_message = '';

// Get seller ID from URL
$seller_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the existing seller details
$stmt = $conn->prepare("SELECT * FROM product_registration WHERE id=?");
$stmt->bind_param('i', $seller_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $seller = $result->fetch_assoc();
} else {
    $error_message = "registerd product not found.";
}

$stmt->close();

include_once('includes/header.php');
?>



<div class="dashboard__main pl0-md">
    <div class="dashboard__content bg-color-buyer-dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard_title_area" style="margin-bottom: 30px;">
                    <h2 class="color-white">Product warrenty Detail</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="dashboard_setting_box" style="background: rgba(40, 43, 53, 1);">
                    <div class="buyer-dashboard-edit-addresses-section">
                        <div class="account_details_page form_grid">
                            <!-- Display error message if any -->
                            <?php if ($error_message): ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    <?php echo $error_message; ?>
                                </div>
                            <?php else: ?>
                                <div class="seller-details">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">First Name</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['first_name']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Last Name</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['last_name']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Email</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['email']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Phone</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['phone']); ?></div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">City</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['city']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Pincode</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['pincode']); ?></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">State</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['state']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">product serial num</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['product_serial_num']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">part_num</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['part_num']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">product_purchase_date</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['product_purchase_date']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">product_invoice</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['product_invoice']); ?></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>



<?php include_once('includes/footer.php'); ?>