<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

// Database connection
include('functions.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Determine the export type
$exportType = isset($_GET['type']) ? $_GET['type'] : '';

if ($exportType == 'product_registration') {
    // SQL query to fetch product registration data
    $sql = "
        SELECT
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
            e.part_num = d.serial_num
    ";

    // Set headers to download file as CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="product_registration_export.csv"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Output column headers
    fputcsv($output, [
        'ID',
        'First Name',
        'Last Name',
        'Phone',
        'Email',
        'Pincode',
        'City',
        'State',
        'Product Serial Number',
        'Part Number',
        'Purchase Date',
        'Product Invoice',
        'Created At',
        'Status',
        'Product Name'
    ]);

    // Output rows
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

} elseif ($exportType == 'products') {
    // SQL query to fetch product data
    $sql = "SELECT * FROM tbl_products";

    // Set headers to download file as CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="products_export.csv"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Output column headers
    fputcsv($output, [
        'ID',
        'Product Name',
        'Product Image',
        'Warranty Time',
        'Product MRP',
        'Product Discription',
        'Selling Price',
        'Brand',
        'Bulb Socket',
        'Color Temprature',
        'Light Source Type',
        'Components',
        'Fit Type',
        'Stable Lumens Output',
        'Amphere Rating',
        'Power Wattage',
        'Operating Voltage',
        'Operating Temprature',
        'Ip Rating',
        'high Power Chipset',
        'Optimum Operaing Life',
        'Heat Sink',
        
    ]);

    // Output rows
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    while ($row = $result->fetch_assoc()) {
        // Prepare data for CSV
        fputcsv($output, [
            $row['id'],
            $row['product_name'],
            $row['product_image'], // This will include all images as a comma-separated string
            $row['warranty'],
            $row['product_mrp'],
            $row['product_description'],
            $row['selling_price'],
            $row['brand'],
            $row['bulb_socket'],
            $row['color_temp'],
            $row['light_source_type'],
            $row['components'],
            $row['fit_type'],
            $row['stable_lumens_output'],
            $row['ampere_rating'],
            $row['power_wattage'],
            $row['operating_voltage'],
            $row['operating_temperature'],
            $row['ip_rating'],
            $row['high_power_chipset'],
            $row['optimum_operating_life'],
            $row['heat_sink']
        ]);
    }

}elseif ($exportType == 'distributer') {
    // SQL query to fetch product data
    $sql = "SELECT * FROM  partners_details";

    // Set headers to download file as CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="Distributer_export.csv"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Output column headers
    fputcsv($output, [
        'ID',
    'Partner Type',
    'First Name',
    'Last Name',
    'Email',
    'Phone',
    'Office Phone',
    'Date of Birth',
    'Gender',
    'Organization Name',
    'Organization Address 1',
    'Organization Address 2',
    'Organization Address 3',
    'Organization Address 4',
    'Landmark',
    'City',
    'Pincode',
    'District',
    'State',
    'Aadhar Number',
    'PAN Number',
    'GST Number',
    'Created At',
    'Status'
    ]);

    // Output rows
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    while ($row = $result->fetch_assoc()) {
        // Prepare data for CSV
        fputcsv($output, [
            $row['id'],
            $row['partner_type'],
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            $row['phone'],
            $row['office_phone'],
            $row['dob'],
            $row['gender'],
            $row['organise_name'],
            $row['organise_address'],
            $row['organise_address2'],
            $row['organise_addres3'],
            $row['organise_addres4'],
            $row['landmark'],
            $row['city'],
            $row['pincode'],
            $row['district'],
            $row['state'],
            $row['aadhar_number'],
            $row['pan_number'],
            $row['gst'],
            $row['created_at'],
            $row['status']
        ]);
    }

} elseif ($exportType == 'seller') {
    // SQL query to fetch product data
    $sql = "SELECT * FROM  sellers_details";

    // Set headers to download file as CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="Seller_export.csv"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Output column headers
    fputcsv($output, [
        'ID',
    'Partner Type',
    'First Name',
    'Last Name',
    'Email',
    'Phone',
    'Office Phone',
    'Date of Birth',
    'Gender',
    'Organization Name',
    'Organization Address 1',
    'Organization Address 2',
    'Organization Address 3',
    'Organization Address 4',
    'Landmark',
    'City',
    'Pincode',
    'District',
    'State',
    'Aadhar Number',
    'PAN Number',
    'GST Number',
    'Created At',
    'Status'
    ]);

    // Output rows
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    while ($row = $result->fetch_assoc()) {
        // Prepare data for CSV
        fputcsv($output, [
            $row['id'],
            $row['partner_type'],
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            $row['phone'],
            $row['office_phone'],
            $row['dob'],
            $row['gender'],
            $row['organise_name'],
            $row['organise_address'],
            $row['organise_address2'],
            $row['organise_addres3'],
            $row['organise_addres4'],
            $row['landmark'],
            $row['city'],
            $row['pincode'],
            $row['district'],
            $row['state'],
            $row['aadhar_number'],
            $row['pan_number'],
            $row['gst'],
            $row['created_at'],
            $row['status']
        ]);
    }

}  elseif ($exportType == 'contact') {
    // SQL query to fetch product data
    $sql = "SELECT * FROM contact";

    // Set headers to download file as CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="contact_export.csv"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Output column headers
    fputcsv($output, [
        'ID',
        'Name',
        'Phone',
        'Email',
        'Pincode',
        'State',
        'City',
        'Message',
        'Created At'
    ]);

    // Output rows
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    while ($row = $result->fetch_assoc()) {
        // Prepare data for CSV
        fputcsv($output, [
            $row['id'],
            $row['name'],
            $row['phone'],
            $row['email'],
            $row['pincode'],
            $row['state'],
            $row['city'],
            $row['message'],
            $row['created_at']
        ]);
    }

}  
else {
    die("Invalid export type.");
}

// Close file and database connection
fclose($output);
$conn->close();
exit();
?>
