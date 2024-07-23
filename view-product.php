<?php
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

include('functions.php');

$error_message = '';

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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

include_once('includes/header.php');
?>

<div class="container">
    <h2>Product Details</h2>
    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?= $error_message ?>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Serial Number:</strong> <?= htmlspecialchars($product['serial_num']) ?></p>
                <p><strong>Product Name:</strong> <?= htmlspecialchars($product['product_name']) ?></p>
                <p><strong>Product MRP:</strong> <?= htmlspecialchars($product['product_mrp']) ?></p>
                <p><strong>Selling Price:</strong> <?= htmlspecialchars($product['selling_price']) ?></p>
                <p><strong>Brand:</strong> <?= htmlspecialchars($product['brand']) ?></p>
                <p><strong>Bulb Socket:</strong> <?= htmlspecialchars($product['bulb_socket']) ?></p>
                <p><strong>Color Temperature:</strong> <?= htmlspecialchars($product['color_temp']) ?></p>
                <p><strong>Light Source Type:</strong> <?= htmlspecialchars($product['light_source_type']) ?></p>
                <p><strong>Components:</strong> <?= htmlspecialchars($product['components']) ?></p>
                <p><strong>Fit Type:</strong> <?= htmlspecialchars($product['fit_type']) ?></p>
                <p><strong>Stable Lumens Output:</strong> <?= htmlspecialchars($product['stable_lumens_output']) ?></p>
                <p><strong>Ampere Rating:</strong> <?= htmlspecialchars($product['ampere_rating']) ?></p>
                <p><strong>Power Wattage:</strong> <?= htmlspecialchars($product['power_wattage']) ?></p>
                <p><strong>Operating Voltage:</strong> <?= htmlspecialchars($product['operating_voltage']) ?></p>
                <p><strong>Operating Temperature:</strong> <?= htmlspecialchars($product['operating_temperature']) ?></p>
                <p><strong>IP Rating:</strong> <?= htmlspecialchars($product['ip_rating']) ?></p>
                <p><strong>High Power Chipset:</strong> <?= htmlspecialchars($product['high_power_chipset']) ?></p>
                <p><strong>Optimum Operating Life:</strong> <?= htmlspecialchars($product['optimum_operating_life']) ?></p>
                <p><strong>Heat Sink:</strong> <?= htmlspecialchars($product['heat_sink']) ?></p>
                <p><strong>Warranty:</strong> <?= htmlspecialchars($product['warranty']) ?></p>
                <p><strong>Product Image:</strong> <img src="<?= htmlspecialchars($product['product_image']) ?>" alt="Product Image"></p>
                <p><strong>Product Description:</strong> <?= htmlspecialchars($product['product_description']) ?></p>
                <p><strong>Created At:</strong> <?= htmlspecialchars($product['created_at']) ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include_once('includes/footer.php'); ?>
