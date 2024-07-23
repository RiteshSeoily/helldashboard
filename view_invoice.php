<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

// Retrieve the invoice URL from the query parameter
$invoiceFile = isset($_GET['invoice']) ? urldecode($_GET['invoice']) : '';

// Define the base directory where PDFs are stored
$baseDir = 'images/';

// Construct the full path to the PDF
$invoicePath = $baseDir . $invoiceFile;

// Validate the invoice file path
if (empty($invoiceFile) || !file_exists($invoicePath)) {
    echo "Invoice not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        iframe {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Product Invoice</h2>
        <iframe src="<?php echo htmlspecialchars($invoicePath); ?>" width="100%" height="800px" allowfullscreen></iframe>
        <a href="javascript:history.back()" class="btn btn-primary mt-3">Back</a>
    </div>
</body>
</html>
