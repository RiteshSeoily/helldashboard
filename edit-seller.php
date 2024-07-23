<?php 
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

include('functions.php');

$success_message = '';
$error_message = '';

// Get product ID from URL or form submission
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    
    // Fetch and sanitize the form inputs
    $partner_type = trim($_POST['partner_type']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $office_phone = trim($_POST['office_phone']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender']);
    $organise_name = trim($_POST['organise_name']);
    $organise_address = trim($_POST['organise_address']);
    $organise_address2 = trim($_POST['organise_address2']);
    $organise_addres3 = trim($_POST['organise_addres3']);
    $organise_addres4 = trim($_POST['organise_addres4']);
    $landmark = trim($_POST['landmark']);
    $city = trim($_POST['city']);
    $pincode = trim($_POST['pincode']);
    $district = trim($_POST['district']);
    $state = trim($_POST['state']);
    $aadhar_number = trim($_POST['aadhar_number']);
    $pan_number = trim($_POST['pan_number']);
    $gst = trim($_POST['gst']);
    
    // Update the seller details in the database
    $stmt = $conn->prepare("UPDATE sellers_details SET partner_type=?, first_name=?, last_name=?, email=?, phone=?, office_phone=?, dob=?, gender=?, organise_name=?, organise_address=?, organise_address2=?, organise_address3=?, organise_address4=?, landmark=?, city=?, pincode=?, district=?, state=?, aadhar_number=?, pan_number=?, gst=? WHERE id=?");
    
    $stmt->bind_param('ssssssssssssssssssssi', $partner_type, $first_name, $last_name, $email, $phone, $office_phone, $dob, $gender, $organise_name, $organise_address, $organise_address2, $organise_address3, $organise_address4, $landmark, $city, $pincode, $district, $state, $aadhar_number, $pan_number, $gst, $product_id);
    
    if ($stmt->execute()) {
        $success_message = "Seller details updated successfully!";
    } else {
        $error_message = "Failed to update seller details. Please try again.";
    }
    
    $stmt->close();
} else {
    // Fetch the existing seller details
    $stmt = $conn->prepare("SELECT * FROM sellers_details WHERE id=?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $product = $result->fetch_assoc();
    } else {
        $error_message = "Seller not found.";
    }
    
    $stmt->close();
}

include_once('includes/header.php');
?>



<div class="dashboard__main pl0-md">
    <div class="dashboard__content bg-color-buyer-dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard_title_area" style="margin-bottom: 30px;">
                    <h2 class="color-white">Edit Seller</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="dashboard_setting_box" style="background: rgba(40, 43, 53, 1);">
                    <div class="buyer-dashboard-edit-addresses-section">
                        <div class="account_details_page form_grid">
                            <!-- Display success or error message -->
                            <?php if ($success_message): ?>
                                <div class="alert alert-success mt-3" role="alert">
                                    <?php echo $success_message; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($error_message): ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>

                            <form class="edit_seller" name="edit-seller" action="" method="post" novalidate>
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Partner Type</label>
                                            <input class="form-control" type="text" name="partner_type" placeholder="Partner Type" value="Seller" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">First Name</label>
                                            <input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($product['first_name']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Last Name</label>
                                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($product['last_name']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Email</label>
                                            <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($product['email']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Phone</label>
                                            <input class="form-control" type="text" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($product['phone']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Office Phone</label>
                                            <input class="form-control" type="text" name="office_phone" placeholder="Office Phone" value="<?php echo htmlspecialchars($product['office_phone']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Date of Birth</label>
                                            <input class="form-control" type="text" name="dob" placeholder="Date of Birth" value="<?php echo htmlspecialchars($product['dob']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Gender</label>
                                            <input class="form-control" type="text" name="gender" placeholder="Gender" value="<?php echo htmlspecialchars($product['gender']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Organisation Name</label>
                                            <input class="form-control" type="text" name="organise_name" placeholder="Organisation Name" value="<?php echo htmlspecialchars($product['organise_name']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Organisation Address</label>
                                            <input class="form-control" type="text" name="organise_address" placeholder="Organisation Address" value="<?php echo htmlspecialchars($product['organise_address']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Organisation Address 2</label>
                                            <input class="form-control" type="text" name="organise_address2" placeholder="Organisation Address 2" value="<?php echo htmlspecialchars($product['organise_address2']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Organisation Address 3</label>
                                            <input class="form-control" type="text" name="organise_address3" placeholder="Organisation Address 3" value="<?php echo htmlspecialchars($product['organise_addres3']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Organisation Address 4</label>
                                            <input class="form-control" type="text" name="organise_address4" placeholder="Organisation Address 4" value="<?php echo htmlspecialchars($product['organise_addres4']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Landmark</label>
                                            <input class="form-control" type="text" name="landmark" placeholder="Landmark" value="<?php echo htmlspecialchars($product['landmark']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">City</label>
                                            <input class="form-control" type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars($product['city']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Pincode</label>
                                            <input class="form-control" type="text" name="pincode" placeholder="Pincode" value="<?php echo htmlspecialchars($product['pincode']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">District</label>
                                            <input class="form-control" type="text" name="district" placeholder="District" value="<?php echo htmlspecialchars($product['district']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">State</label>
                                            <input class="form-control" type="text" name="state" placeholder="State" value="<?php echo htmlspecialchars($product['state']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Aadhar Number</label>
                                            <input class="form-control" type="text" name="aadhar_number" placeholder="Aadhar Number" value="<?php echo htmlspecialchars($product['aadhar_number']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">PAN Number</label>
                                            <input class="form-control" type="text" name="pan_number" placeholder="PAN Number" value="<?php echo htmlspecialchars($product['pan_number']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">GST</label>
                                            <input class="form-control" type="text" name="gst" placeholder="GST" value="<?php echo htmlspecialchars($product['gst']); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Update Seller</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
