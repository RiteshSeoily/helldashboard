<?php 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin/login.php');
    exit;
}
include('functions.php');

// Fetch counts
$stmt = $conn->prepare("SELECT COUNT(*) as seller_count FROM sellers_details");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$seller_count = $row['seller_count'];

$stmt = $conn->prepare("SELECT COUNT(*) as partner_count FROM partners_details");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$partner_count = $row['partner_count'];

$stmt = $conn->prepare("SELECT COUNT(*) as warrenty_registered FROM product_registration");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$warrenty_registered = $row['warrenty_registered'];

$stmt = $conn->prepare("SELECT COUNT(*) as product_count FROM tbl_products");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$product_count = $row['product_count'];

$stmt = $conn->prepare("SELECT COUNT(*) as enquiry_details FROM contact");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$enquiry_details = $row['enquiry_details'];

include_once('includes/header.php');
?>
 <div class="dashboard__main pl0-md">
        <div class="dashboard__content bg-color-buyer-dashboard">         
         <div class="row buyerdashboard-overview-page-rfq-box-webview">
           <div class="col-lg-12">
             <div class="buyer-dashboard-icon-section" style="margin-bottom: 30px;">

               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-users"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Product Listed on Website</h5>
                   <h2><?php echo htmlspecialchars($product_count); ?></h2>
                 </div>
               </div>

            <a class="buyer-dashboard-icon-section-box" href=""><div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-user-tie"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Total Number of Warranty Registered</h5>
                   <h2><?php echo htmlspecialchars($warrenty_registered); ?></h2>
                 </div>
               </div>
</a>

               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-file-alt"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Enquiry Received</h5>
                   <h2><?php echo htmlspecialchars($enquiry_details); ?></h2>
                 </div>
               </div>

               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-shopping-cart"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Sellers Registered</h5>
                   <h2><?php echo htmlspecialchars($seller_count); ?></h2>
                 </div>
               </div>

             </div>

             <div class="buyer-dashboard-icon-section">

              <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-inr"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Distributer</h5>
                   <h2><?php echo htmlspecialchars($partner_count); ?></h2>
                 </div>
               </div>

               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-boxes"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Products on Website</h5>
                   <h2>25</h2>
                 </div>
               </div>

               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-tags"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Total Brands Avilable</h5>
                   <h2>0</h2>
                 </div>
               </div>

            <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-chart-line"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Total Profit</h5>
                   <h2>0</h2>
                 </div>
               </div>

              

             </div>

           </div>
         </div>

         <!--for-mobileview-code-start-->
          <div class="row buyerdashboard-overview-page-rfq-box-mobileview">
           <div class="col-lg-12">
             <div class="buyer-dashboard-icon-section">

               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-tachometer"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Total Buyer</h5>
                   <h2>25</h2>
                 </div>
               </div>

               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-shopping-cart"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Total Sellers</h5>
                   <h2>0</h2>
                 </div>
               </div>
             </div>
              
              <div class="buyer-dashboard-icon-section">
               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-dollar-sign"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Total RFQ</h5>
                   <h2>0</h2>
                 </div>
               </div>

               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-box"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Total Orders</h5>
                   <h2>0</h2>
                 </div>
               </div>
             </div>

           <div class="buyer-dashboard-icon-section">
               <div class="buyer-dashboard-icon-section-box">
                 <div class="buyer-dashboard-icon-image">
                   <i class="fa fa-piggy-bank"></i>
                 </div>
                 <div class="buyer-dashboard-icon-heading">
                   <h5>Total Order Value</h5>
                   <h2>0</h2>
                 </div>
               </div>

             </div>
           </div>
         </div>


         <div class="row">
           <div class="col-md-12 rfq-and-orders-buyer-outer">

            <div class="col-md-4">
              <div class="rfq-chart-buyer-dashboard-outer-box">
                <div class="buyer-dashboard-graph-heading">
                  <h2>Total Buyer: 100</h2>
                </div>
                <div id="rfqchartone"></div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="rfq-chart-buyer-dashboard-outer-box">
                <div class="buyer-dashboard-graph-heading">
                  <h2>Total Sellers: 100</h2>
                </div>
                <div id="rfqcharttwo"></div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="rfq-chart-buyer-dashboard-outer-box">
                <div class="buyer-dashboard-graph-heading">
                  <h2>Total RFQ: 100</h2>
                </div>
                <div id="rfqchartthree"></div>
              </div>
            </div>

           

           </div>

           <div class="col-md-12 rfq-and-orders-buyer-outer">


           <div class="col-md-4">
             <div class="rfq-chart-buyer-dashboard-outer-box">
              <div class="buyer-dashboard-graph-heading">
              <h2>Total Orders: 10</h2>
            </div>
               <div id="adminweeklyorders"></div>
             </div>
           </div>

           <div class="col-md-4">
             <div class="rfq-chart-buyer-dashboard-outer-box">
              <div class="buyer-dashboard-graph-heading">
               <h2>Total Order Value</h2>
              </div>
               <div id="savingsTracker"></div>
                <div class="weekdays">
                        <span>Jan</span>
                        <span>Feb</span>
                        <span>Mar</span>
                        <span>Apr</span>
                        <span>May</span>
                        <span>June</span>                       
                    </div>
              
             </div>
           </div>

           <div class="col-md-4">
              <div class="rfq-chart-buyer-dashboard-outer-box">
                <div class="buyer-dashboard-graph-heading">
                  <h2>Total Profit: 100</h2>
                </div>
                <div id="rfqchartfour"></div>
              </div>
            </div>

           </div>
         </div>


           <div class="row">
            <div class="col-xl-12">
              <h4 style="color: #fff;">Recent Actvity</h4>
              <div class="dashboard_product_list account_user_deails">
                <div class="row d-block d-sm-flex justify-content-center justify-content-sm-between">
                
                </div>
                <div class="order_table table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                    <th scope="col" class="heading-buyer-dashboard-recent-activity">S. No.</th>
                  <th scope="col" class="heading-buyer-dashboard-recent-activity">Activity</th>
                    <th scope="col" class="heading-buyer-dashboard-recent-activity">Date</th>
                    <th scope="col" class="heading-buyer-dashboard-recent-activity">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="buyer-dashboard-recent-activity-table-outer">
                        <td class="buyer-dashboard-right-border">01</td>
                        <td class="buyer-dashboard-right-border">Payment Updated</td>          <td class="buyer-dashboard-right-border">Aug 15, 2022</td>
                        <td class="editing_list align-middle">
                          <ul>
                            <li class="list-inline-item mb-1">
                              <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" aria-label="View"><i class="fa fa-eye"></i></a>
                            </li>
                            <li class="list-inline-item mb-1">
                              <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" aria-label="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>

                      <tr class="buyer-dashboard-recent-activity-table-outer">
                        <td class="buyer-dashboard-right-border">02</td>
                        <td class="buyer-dashboard-right-border">Payment Updated</td>          
                        <td class="buyer-dashboard-right-border">Aug 15, 2022</td>
                        <td class="editing_list align-middle">
                          <ul>
                             <li class="list-inline-item mb-1">
                              <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" aria-label="View"><i class="fa fa-eye"></i></a>
                            </li>
                            <li class="list-inline-item mb-1">
                              <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" aria-label="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>

                      <tr class="buyer-dashboard-recent-activity-table-outer">
                        <td class="buyer-dashboard-right-border">03</td>
                        <td class="buyer-dashboard-right-border">Payment Updated</td>         
                        <td class="buyer-dashboard-right-border">Aug 15, 2022</td>
                        <td class="editing_list align-middle">
                          <ul>
                             <li class="list-inline-item mb-1">
                              <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" aria-label="View"><i class="fa fa-eye"></i></a>
                            </li>
                            <li class="list-inline-item mb-1">
                              <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" aria-label="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>

                      <tr class="buyer-dashboard-recent-activity-table-outer">
                        <td class="buyer-dashboard-right-border">04</td>
                        <td class="buyer-dashboard-right-border">Payment Updated</td>         
                        <td class="buyer-dashboard-right-border">Aug 15, 2022</td>
                        <td class="editing_list align-middle">
                          <ul>
                            <li class="list-inline-item mb-1">
                              <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" aria-label="View"><i class="fa fa-eye"></i></a>
                            </li>
                            <li class="list-inline-item mb-1">
                              <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" aria-label="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>   
                      
                    </tbody>
                  </table>
                </div>
             
              </div>
            </div>


           </div>
    </div> 

    <?php include_once('includes/footer.php');?>