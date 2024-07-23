<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

include('functions.php');

$success_message = '';
$error_message = '';

$base_url = __DIR__ . '/images/';
$showDirectory = '/helldashboard/images/';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$product_images = [];

if (isset($_FILES['product_image']['name'])) {
    $total_count = count($_FILES['product_image']['name']);
    for ($i = 0; $i < $total_count; $i++) {
        $tmpFilePath = $_FILES['product_image']['tmp_name'][$i];
        if ($tmpFilePath != "") {
            $file_name = basename($_FILES['product_image']['name'][$i]);
            $newFilePath = $base_url . $file_name;
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $product_images[] = $file_name;
            } else {
                echo "Failed to move file: $file_name<br>";
            }
        }
    }
}
$product_image = implode(',', $product_images);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $pincode = trim($_POST['pincode']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $product_serial_num = trim($_POST['product_serial_num']);
    $part_num = trim($_POST['part_num']);
    $product_purchase_date = trim($_POST['product_purchase_date']);

    // Handle invoice file upload
    $product_invoice = $_POST['existing_invoice'];
    if (isset($_FILES['product_invoice']) && $_FILES['product_invoice']['error'] == UPLOAD_ERR_OK) {
        $tmpFilePath = $_FILES['product_invoice']['tmp_name'];
        $invoiceFileName = basename($_FILES['product_invoice']['name']);
        $newFilePath = $base_url . $invoiceFileName;
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            $product_invoice = $invoiceFileName;
        } else {
            echo "Failed to move file: $invoiceFileName<br>";
        }
    }

    $stmt = $conn->prepare("UPDATE product_registration SET first_name=?, last_name=?, phone=?, email=?, pincode=?, city=?, state=?, product_serial_num=?, part_num=?, product_purchase_date=?, product_invoice=? WHERE id=?");
    $stmt->bind_param('sssssssssssi', $first_name, $last_name, $phone, $email, $pincode, $city, $state, $product_serial_num, $part_num, $product_purchase_date, $product_invoice, $product_id);
    if ($stmt->execute()) {
        $success_message = "Product updated successfully!";
    } else {
        $error_message = "Failed to update product. Please try again.";
    }
    $stmt->close();
} else {
    $stmt = $conn->prepare("SELECT * FROM product_registration WHERE id=?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $product = $result->fetch_assoc();
    } else {
        $error_message = "Product not found.";
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
                    <h2 class="color-white">Edit Product Warranty</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="dashboard_setting_box" style="background: rgba(40, 43, 53, 1);">
                    <div class="buyer-dashboard-edit-addresses-section">
                        <div class="account_details_page form--label block-box">
                            <?php if (!empty($success_message)): ?>
                                <div class="alert alert-success"><?php echo $success_message; ?></div>
                            <?php endif; ?>
                            <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger"><?php echo $error_message; ?></div>
                            <?php endif; ?>

                            <form class="edit_product" name="edit-product" action="" method="post" enctype="multipart/form-data" novalidate>
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars(@$product_id); ?>">
                                <div class="row">
                                    <!-- Pre-fill form fields with existing product data -->
                                    <div class="col-md-6">
                                       
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">First Name</label>
                                            <input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars(@$product['first_name']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Last Name</label>
                                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars(@$product['last_name']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Phone</label>
                                            <input class="form-control" type="text" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars(@$product['phone']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Email</label>
                                            <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars(@$product['email']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Pincode</label>
                                            <input class="form-control" type="text" name="pincode" placeholder="Pincode" value="<?php echo htmlspecialchars(@$product['pincode']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">City</label>
                                            <input class="form-control" type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars(@$product['city']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">State</label>
                                            <input class="form-control" type="text" name="state" placeholder="State" value="<?php echo htmlspecialchars(@$product['state']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Product Serial Number</label>
                                            <input class="form-control" type="text" name="product_serial_num" placeholder="Product Serial Number" value="<?php echo htmlspecialchars(@$product['product_serial_num']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Part Number</label>
                                            <input class="form-control" type="text" name="part_num" placeholder="Part Number" value="<?php echo htmlspecialchars(@$product['part_num']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
    <label class="form-label color-white">Product Purchase Date</label>
    <input class="form-control" type="date" name="product_purchase_date" placeholder="Product Purchase Date" value="<?php echo htmlspecialchars(@$product['product_purchase_date']); ?>" />
</div>
                                        <div class="form-group mb-4">
    <label class="form-label color-white">Product Invoice</label>
    <input type="hidden" name="existing_invoice" value="<?php echo htmlspecialchars(@$product['product_invoice']); ?>">
    <input class="form-control" type="file" name="product_invoice">
    <?php if (!empty($product['product_invoice'])): ?>
        <div class="mt-2">
            <a href="<?php echo $showDirectory . htmlspecialchars($product['product_invoice']); ?>" target="_blank">
                <i class="fa fa-file-pdf-o" style="font-size: 24px; color: red;"></i>
                <?php echo htmlspecialchars($product['product_invoice']); ?>
            </a>
        </div>
    <?php endif; ?>
</div>
                                    </div>
                               
                                    
                                    <div class="col-md-12">
                                        <button class="btn btn--md btn--round" type="submit" style="background: orange;">Update Product</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Ends: .account_details_page -->
                    </div>
                    <!-- Ends: .buyer-dashboard-edit-addresses-section -->
                </div>
                <!-- Ends: .dashboard_setting_box -->
            </div>
        </div>
    </div>
    <!-- Ends: .dashboard_content -->
</div>
                                            </div>
<!-- Ends: .dashboard_main -->
<?php include_once('includes/footer.php'); ?>
