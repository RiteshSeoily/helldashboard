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

// Get product ID from URL or form submission
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$product_images = [];
// $upload_dir = '/helldashboard/images/';

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
// Join the image names into a comma-separated string
$product_image = implode(',', $product_images);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    // Fetch and sanitize the form inputs
    $product_name = trim($_POST['product_name']);
    $product_mrp = trim($_POST['product_mrp']);
    $bulb_socket = trim($_POST['bulb_socket']);
    $color_temp = trim($_POST['color_temp']);
    $light_source_type = trim($_POST['light_source_type']);
    $components = trim($_POST['components']);
    $fit_type = trim($_POST['fit_type']);
    $stable_lumens_output = trim($_POST['stable_lumens_output']);
    $ampere_rating = trim($_POST['ampere_rating']);
    $power_wattage = trim($_POST['power_wattage']);
    $operating_voltage = trim($_POST['operating_voltage']);
    $operating_temperature = trim($_POST['operating_temperature']);
    $ip_rating = trim($_POST['ip_rating']);
    $high_power_chipset = trim($_POST['high_power_chipset']);
    $optimum_operating_life = trim($_POST['optimum_operating_life']);
    $heat_sink = trim($_POST['heat_sink']);
    $warranty = trim($_POST['warranty']);
    $product_description = trim($_POST['product_description']);



    // Update the product in the database
    $stmt = $conn->prepare("UPDATE tbl_products SET product_name=?, product_mrp=?, bulb_socket=?, color_temp=?, light_source_type=?, components=?, fit_type=?, stable_lumens_output=?, ampere_rating=?, power_wattage=?, operating_voltage=?, operating_temperature=?, ip_rating=?, high_power_chipset=?, optimum_operating_life=?, heat_sink=?, warranty=?, product_image=?, product_description=? WHERE id=?");
    $stmt->bind_param('sssssssssssssssssssi', $product_name, $product_mrp, $bulb_socket, $color_temp, $light_source_type, $components, $fit_type, $stable_lumens_output, $ampere_rating, $power_wattage, $operating_voltage, $operating_temperature, $ip_rating, $high_power_chipset, $optimum_operating_life, $heat_sink, $warranty, $product_image, $product_description, $product_id);
    if ($stmt->execute()) {
        $success_message = "Product updated successfully!";
    } else {
        $error_message = "Failed to update product. Please try again.";
    }
    $stmt->close();
} else {
    // Fetch the existing product details
    $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE id=?");
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
                    <h2 class="color-white">Edit Product</h2>
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

                            <form class="edit_product" name="edit-product" action="" method="post" enctype="multipart/form-data" novalidate>
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars(@$product_id); ?>">
                                <div class="row">
                                    <!-- Pre-fill form fields with existing product data -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Product Name</label>
                                            <input class="form-control" type="text" name="product_name" placeholder="Product Name" value="<?php echo htmlspecialchars(@$product['product_name']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Product MRP</label>
                                            <input class="form-control" type="text" name="product_mrp" placeholder="Product MRM" value="<?php echo htmlspecialchars(@$product['product_mrp']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Bulb Socket</label>
                                            <input class="form-control" type="text" name="bulb_socket" placeholder="Bulb Socket" value="<?php echo htmlspecialchars(@$product['bulb_socket']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Color Temperature</label>
                                            <input class="form-control" type="text" name="color_temp" placeholder="Color Temprature" value="<?php echo htmlspecialchars(@$product['color_temp']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Light Source Type</label>
                                            <input class="form-control" type="text" name="light_source_type" placeholder="Light Source Type" value="<?php echo htmlspecialchars(@$product['light_source_type']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Component</label>
                                            <input class="form-control" type="text" name="components" placeholder="Component" value="<?php echo htmlspecialchars(@$product['components']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Fit Type</label>
                                            <input class="form-control" type="text" name="fit_type" placeholder="Fit Type" value="<?php echo htmlspecialchars(@$product['fit_type']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Stable Lumens Output</label>
                                            <input class="form-control" type="text" name="stable_lumens_output" placeholder="Stable Lumens Output" value="<?php echo htmlspecialchars(@$product['stable_lumens_output']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Amphere Rating</label>
                                            <input class="form-control" type="text" name="ampere_rating" placeholder="Amphere Rating" value="<?php echo htmlspecialchars(@$product['ampere_rating']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Power Wattage</label>
                                            <input class="form-control" type="text" name="power_wattage" placeholder="Power Wattage" value="<?php echo htmlspecialchars(@$product['power_wattage']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Operating Voltage</label>
                                            <input class="form-control" type="text" name="operating_voltage" placeholder="Operating Voltage" value="<?php echo htmlspecialchars(@$product['operating_voltage']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Operating Temperature</label>
                                            <input class="form-control" type="text" name="operating_temperature" placeholder="Operating Temperature" value="<?php echo htmlspecialchars(@$product['operating_temperature']); ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">IP Rating</label>
                                            <input class="form-control" type="text" name="ip_rating" placeholder="IP Rating" value="<?php echo htmlspecialchars(@$product['ip_rating']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">High Power Chipset</label>
                                            <input class="form-control" type="text" name="high_power_chipset" placeholder="High Power Chipset" value="<?php echo htmlspecialchars(@$product['high_power_chipset']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Optimum Operating Life</label>
                                            <input class="form-control" type="text" name="optimum_operating_life" placeholder="Optimum Operating Life" value="<?php echo htmlspecialchars(@$product['optimum_operating_life']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Heat Sink</label>
                                            <input class="form-control" type="text" name="heat_sink" placeholder="Heat Sink" value="<?php echo htmlspecialchars(@$product['heat_sink']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Warranty</label>
                                            <input class="form-control" type="text" name="warranty" placeholder="Warranty" value="<?php echo htmlspecialchars(@$product['warranty']); ?>" />
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Product Images</label>
                                            <input class="form-control" type="file" name="product_image[]" multiple />
                                            <div id="image_preview">
                                                <?php
                                                if (!empty($product['product_image'])) {
                                                    $images = explode(',', $product['product_image']);
                                                    foreach ($images as $image) {
                                                        echo '<img src="' . $showDirectory. htmlspecialchars($image) . '" alt="Product Image" style="width: 100px; height: auto; margin-top: 10px;">';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label color-white">Product Description</label>
                                            <textarea class="form-control" name="product_description" rows="3" placeholder="Product Description"><?php echo htmlspecialchars(@$product['product_description']); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <button class="btn btn-warning text-bold text-white" type="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('includes/footer.php'); ?>
    </div>
</div>
