
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
$stmt = $conn->prepare("SELECT * FROM partners_details WHERE id=?");
$stmt->bind_param('i', $seller_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $seller = $result->fetch_assoc();
} else {
    $error_message = "distributer not found.";
}

$stmt->close();

include_once('includes/header.php');
?>



<div class="dashboard__main pl0-md">
    <div class="dashboard__content bg-color-buyer-dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard_title_area" style="margin-bottom: 30px;">
                    <h2 class="color-white">View Distributer</h2>
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
                                                <label class="form-label color-white">Partner Type</label>
                                                <div class="detail-value color-white">Distributer</div>
                                            </div>
                                        </div>
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
                                                <label class="form-label color-white">Office Phone</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['office_phone']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Date of Birth</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['dob']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Gender</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['gender']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Organisation Name</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['organise_name']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Organisation Address</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['organise_address']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Organisation Address 2</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['organise_address2']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Organisation Address 3</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['organise_addres3']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Organisation Address 4</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['organise_addres4']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">Landmark</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['landmark']); ?></div>
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
                                                <label class="form-label color-white">District</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['district']); ?></div>
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
                                                <label class="form-label color-white">Aadhar Number</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['aadhar_number']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">PAN Number</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['pan_number']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item mb-4">
                                                <label class="form-label color-white">GST</label>
                                                <div class="detail-value color-white"><?php echo htmlspecialchars($seller['gst']); ?></div>
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