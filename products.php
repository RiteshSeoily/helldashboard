<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

include('functions.php');
include_once('includes/header.php');

$showDirectory = '/helldashboard/images/';

// Fetch the list of products from the database
$stmt = $conn->prepare("SELECT * FROM tbl_products");
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="dashboard__main pl0-md">
    <div class="dashboard__content bg-color-buyer-dashboard">
        <div class="row">
        <a href="export.php?type=products" style="font-size: 1rem; color: white; padding: 1rem; background-color: orange;">Export Products</a>

            <div class="col-xl-12">
                <div class="dashboard_product_list account_user_deails">
                    <div class="row d-block d-sm-flex justify-content-center justify-content-sm-between"></div>
                    <div class="order_table table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">S. No.</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">Product Image</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">PRODUCT NAME</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">Warranty Time</th>
      
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">PRODUCT MRP</th>
                                    <th scope="col" class="heading-buyer-dashboard-recent-activity">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $serial_number = 1;
                                foreach ($products as $product) {
                                    // Split the product_image field to get the first image
                                    $product_images = explode(',', $product['product_image']);
                                    $first_image = isset($product_images[0]) ? $product_images[0] : '';
                                    ?>
                                    <tr class="buyer-dashboard-recent-activity-table-outer">
                                        <td class="buyer-dashboard-right-border"><?php echo $serial_number++; ?></td>
                                        <td class="buyer-dashboard-right-border">
                                            <?php if ($first_image): ?>
                                                <img src="<?php echo htmlspecialchars($showDirectory . $first_image); ?>" alt="Product Image" style="width: 100px; height: auto;">
                                            <?php else: ?>
                                               <img src = "/helldashboard/images/download.png"
                                            <?php endif; ?>
                                        </td>
                                        <td class="buyer-dashboard-right-border"><?php echo htmlspecialchars($product['product_name']); ?></td>
                                        <td class="buyer-dashboard-right-border"><?php echo htmlspecialchars($product['warranty']); ?></td>

                                        <td class="buyer-dashboard-right-border product-image-buyer-rfq-page">
                                            <?php echo htmlspecialchars($product['product_mrp']); ?>
                                        </td>
                                        <td class="editing_list align-middle">
                                            <ul>
                                                <li class='list-inline-item mb-1'>
                                                    <a href='https://seoily.co.uk/test/product-details.php?id=<?php echo $product['id']; ?>' target="_blank" data-bs-toggle='tooltip' data-bs-placement='top' title='View' aria-label='View'><i class='fa fa-eye'></i></a>
                                                </li>
                                                <li class='list-inline-item mb-1'>
                                                    <a href='edit-product.php?id=<?php echo $product['id']; ?>' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit' aria-label='Edit'><i class='fa fa-edit'></i></a>
                                                </li>
                                                <li class='list-inline-item mb-1'>
                                                    <a href='#' class='delete-button' data-id='<?php echo $product['id']; ?>' data-table='tbl_products' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete' aria-label='Delete'>
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

<?php include_once('includes/footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.data-table').DataTable();

        function deleteRecord(id, tableName) {
            $.ajax({
                url: 'functions.php',
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

        $(document).on('click', '.delete-button', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            var tableName = $(this).data('table');
            if (confirm('Are you sure you want to delete this record?')) {
                deleteRecord(id, tableName);
            }
        });
    });
</script>
