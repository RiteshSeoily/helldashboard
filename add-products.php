<?php 
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}

include('functions.php');

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $product_image = trim($_POST['product_image']);
    $product_description = trim($_POST['product_description']);
    
    // Insert the data into the database
    $stmt = $conn->prepare("INSERT INTO tbl_products (product_name, product_mrp, bulb_socket, color_temp, light_source_type, components, fit_type, stable_lumens_output, ampere_rating, power_wattage, operating_voltage, operating_temperature, ip_rating, high_power_chipset, optimum_operating_life, heat_sink, warranty, product_image, product_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param('sssssssssssssssssss', $product_name, $product_mrp, $bulb_socket, $color_temp, $light_source_type, $components, $fit_type, $stable_lumens_output, $ampere_rating, $power_wattage, $operating_voltage, $operating_temperature, $ip_rating, $high_power_chipset, $optimum_operating_life, $heat_sink, $warranty, $product_image, $product_description);
    
    if ($stmt->execute()) {
        $success_message = "Product added successfully!";
    } else {
        $error_message = "Failed to add product. Please try again.";
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
                <h2 class="color-white">ADD Product</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="dashboard_setting_box" style="background: rgba(40, 43, 53, 1);">
                <div class="buyer-dashboard-edit-addresses-section">

                   <div class="account_details_page form_grid">

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
                        <form class="add_product" name="add-product" action="#" method="post">
                
                          <div class="row">

                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Product Name</label>
                                <input class="form-control" type="text" name="product_name" placeholder="Full Name" value="" />
                                <span class="error" id="contact_name_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb30">
                                <label class="form-label color-white">Product MRP</label>
                                <input class="form-control" type="text" name="product_mrp" placeholder="Complete Address">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Bulb Socket</label>
                                <input class="form-control" type="text" name="bulb_socket" value="" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Color Temperature</label>
                                <input class="form-control" type="text" name="color_temp" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Light Source Type</label>
                                <input class="form-control" type="text" name="light_source_type" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Component</label>
                                <input class="form-control" type="text" name="components" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Fit Type</label>
                                <input class="form-control" type="text" name="fit_type" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Stable Lumens Output</label>
                                <input class="form-control" type="text" name="stable_lumens_output" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Amphere Rating</label>
                                <input class="form-control" type="text" name="ampere_rating" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Power Wattage</label>
                                <input class="form-control" type="text" name="power_wattage" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Operating Voltage</label>
                                <input class="form-control" type="text" name="operating_voltage" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Operating Temperature</label>
                                <input class="form-control" type="text" name="operating_temperature" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">IP Rating</label>
                                <input class="form-control" type="text" name="ip_rating" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Highest Power Chipset</label>
                                <input class="form-control" type="text" name="high_power_chipset" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Optimum Operating Life</label>
                                <input class="form-control" type="text" name="optimum_operating_life" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Heat Sink</label>
                                <input class="form-control" type="text" name="heat_sink" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Warranty</label>
                                <input class="form-control" type="text" name="warranty" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Product Image</label>
                                <input class="form-control" type="text" name="product_image" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label color-white">Product Description</label>
                                <input class="form-control" type="text" name="product_description" placeholder="Contact Number" value="" />
                                <span class="error" id="contact_number_error" style="color: red;"></span>
                              </div>
                            </div>

                          
                
                            <div class="col-sm-12">
                              <div class="form-group d-grid d-sm-flex mb0">
                                <button type="submit" class="style2 btn btn-thm me-3 mb15-520">Submit</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>

                 

                </div>
              </div>
            </div>
         

          

         <?php include_once('includes/footer.php');?>
          