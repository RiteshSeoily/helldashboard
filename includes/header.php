<?php require_once('db.php');?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- css file -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<link rel="stylesheet" href="css/ace-responsive-menu.css">

<link rel="stylesheet" href="css/menu.css">

<link rel="stylesheet" href="css/fontawesome.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="css/flaticon.css">
<link rel="stylesheet" href="css/bootstrap-select.min.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/dashbord_navitaion.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500&family=Poppins:wght@700&display=swap" rel="stylesheet">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script>
        // Define the base URI for use in external JavaScript files
        var uri = '{{ url("/") }}';
    </script>
<!-- Title -->
<title></title>
<!-- Favicon -->
<link href="" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="" sizes="128x128" rel="shortcut icon" />

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<div class="dashboardnew-header-outer">
<!-- <div class="preloader">
    <div class="preloader-inner">
      <img src="images/preloader.gif" class="preloader-image">
    </div>
  </div> -->
 <!-- header middle -->
  <div class="header_middle pt20 pb20 dn-992 dashboard-newheader-outer">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-xxl-2">
          <div class="header_top_logo_home1">
            <div class="logo">
            <a href="/">
            <img src="images/logo.jpg">
            </a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xxl-6">
          <div class="header_middle_advnc_search">
            <div class="search_form_wrapper">
              <div class="row">
                <div class="col-auto pr0">
                 
                </div>
                <div class="col-auto p0">

                  <div class="top-search">

                    <form action="#" method="get" class="form-search" accept-charset="utf-8">

                      <div class="box-search pre_line">

                        <input class="form_control search_products" type="text" name="search" placeholder="Search products…">

                  <div id="search-results"></div>
                        <div class="search-suggestions">



                    

                        </div><!-- /.search-suggestions -->

                      </div><!-- /.box-search -->

                    </form><!-- /.form-search -->

                  </div><!-- /.top-search -->

                </div>
                <div class="col-auto p0">
                  <div class="advscrh_frm_btn">
                    <button type="submit" class="btn search-btn"><span class="color-white"><i class="fa fa-search" aria-hidden="true"></i></span></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xxl-4 pr0-lg" style="padding-right: 0px;">
          <div class="hm_log_fav_cart_widget justify-content-center">
            <div class="wrapper">
              <ul class="mb0 dashoard-buyer-name-outer">
                
            






                
                <li class="list-inline-item">
                  <a class="header_top_iconbox" href="#" data-bs-toggle="dropdown">
                    <div class="d-block d-md-flex" style="align-items: center;">
                      <div class="icon">
                        
                        
                        <img src="{{ asset('public/assets_new/images/buyer-dashboard/dummy-profilee.jpg') }}">
                        
                      </div>
                      <a class="dropdown-item" href="admin/logout.php"><i class="fa fa-sign-out mr10"></i>Logout</a>
                      <div class="details">
                        <p class="subtitle">Welcome</p>
                        <h5 class="title">Admin</h5>
                      </div>
                    </div>
                  </a>

                  <div class="dropdown-menu">
                <div class="user_setting_content">
                      <a class="dropdown-item" href="#"><i class="fa fa-gear fa-spin mr10"></i>Settings</a>
                      <a class="dropdown-item" href="admin/logout.php"><i class="fa fa-sign-out mr10"></i>Logout</a>
                    </div>
                  </div>
                  
                </li>

                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Main Header Nav -->
  <header class="header-nav menu_style_home_one main-menu">

    <!-- Ace Responsive Menu -->

    <nav class="posr"> 

      <div class="container posr menu_bdrt1"> 

        <!-- Menu Toggle btn-->

        <div class="menu-toggle">

          <button type="button" id="menu-btn">

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

          </button>

        </div>

        <!-- <div class="posr logo1 home1_style">

          <div id="mega-menu">

            <a class="btn-mega" href="/shop">

              <img class="me-2" src="{{ asset('public/assets_new/images/new-images/header-menu-icon.png') }}" alt="Desktop Menu Icon">

              <span class="fw500 fz16 color-white vam">Browse Categories</span>

            </a>

            <ul class="menu">

              <li>

                <a class="dropdown" href="/education">

                  <span class="menu-icn"><i class="fa-solid fa-book"></i></span>

                  <span class="menu-title">Education Institutes</span>

                </a>

                <div class="drop-menu">

                  <div class="one-third">

                    <div class="cat-title">Uniforms</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/half-sleeves-plain-school-polo-t-shirt">T-Shirt</a></li>

                      <li><a href="https://justprocure.com/product/details/summer-hosiery-government-school-dress">Govt. School Uniform</a></li>

                      <li><a href="https://justprocure.com/product/details/blue-pp-satin-plastic-school-belt-feature-:-powerful-pattern">Blue School Belt</a></li>

                    </ul>

                  </div>

                   <div class="one-third">

                    <div class="cat-title">Stationery</div>

                    <ul class="mb0">

                      <li><a href="https://justprocure.com/product/details/packmate-blue-recycled-paper-ball-pens-(pack-of-5)">Recycled Ball Pens</a></li>

                      <li><a href="https://justprocure.com/product/details/falcon-secure-display-book-with-punchless-clip">Falcon Display Book</a></li>

                      <li><a href="https://justprocure.com/product/details/cartoon-magnetic-pencil-box-with-built-in-calculator-combo-set-of-moti-pencil-key-chain-geometry-scale-fruit-eraser-and-smiley-sticker">Cartoon Pencil Box</a></li>

                    </ul>

                  </div>

                  <div class="one-third">

                    <div class="cat-title">Sports</div>

                    <ul class="mb0">

                      <li><a href="https://justprocure.com/product/details/infinizy-basketball">Infinizy Basketball</a></li>

                      <li><a href="https://justprocure.com/product/details/vicky-lite-blue-poplar-willow-cricket-tennis-bat-with-hotshot-tennis-ball">Lite Cricket Set</a></li>

                      <li><a href="https://justprocure.com/product/details/forgesy-6-pcs-yellow-rubber-light-weight-cricket-tennis-ball-set">Yellow Cricket Ball Set</a></li>

                    </ul>

                  </div>

                </div>

              </li>

              <li>

                <a class="dropdown" href="/hospitality">

                  <span class="menu-icn"><i class="fas fa-couch"></i></span>

                  <span class="menu-title">Hospitality</span>

                </a>

                <div class="drop-menu">

                  <div class="one-third">

                    <div class="cat-title">Personal Care</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/250ml-onion-shampoo">Onion Shampoo</a></li>

                      <li><a href="https://justprocure.com/product/details/dettol-5l-liquid-handwash-can">Dettol Liquid Handwash</a></li>

                      <li><a href="https://justprocure.com/product/details/1l-strawberry-liquid-hand-wash-refill">Strawberry Hand Wash Refill</a></li>

                    </ul>

                  </div>

                </div>

              </li>

              <li>

                <a class="dropdown" href="/healthcare">

                  <span class="menu-icn"><i class="fa-solid fa-stethoscope"></i></span>

                  <span class="menu-title">Medical Equipment</span>

                </a>

                   <div class="drop-menu">

                  <div class="one-third">

                    <div class="cat-title">Medical Supplies</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/stainless-steel-medical-tray">Medical Stainless Tray</a></li>

                      <li><a href="https://justprocure.com/product/details/hiv-kit-with-medical-pouch">HIV Testing Kit</a></li>

                      <li><a href="https://justprocure.com/product/details/stainless-steel-suturing-thread-medical-equipment-kit">Stainless Steel Suturing Kit</a></li>

                    </ul>

                     <div class="cat-title">Dental</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/25mm-universal-protaper-finishing-hand-file">Universal Hand File</a></li>

                      <li><a href="https://justprocure.com/product/details/oracura-oc150-pro-smart-white-water-flosser">Oracura Pro Water Flosser</a></li>

                      <li><a href="https://justprocure.com/product/details/compact-plus-green-rechargeable-water-flosser-with-2-years-warranty">Green Water Flosser</a></li>

                    </ul>

                  </div>

                  

                   <div class="one-third">

                    <div class="cat-title">Fitness & Nutrition</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/fitness-power-tower-for-pull-up-bar-chinning-push-ups">Fitness Power Tower</a></li>

                      <li><a href="https://justprocure.com/product/details/iron-silver-fitness-pump-toner-workout-training-machine">Fitness Pump Toner</a></li>

                      <li><a href="https://justprocure.com/product/details/steel-black-fitness-gym-cable-crossover">Black Gym Cable Crossover</a></li>

                    </ul>

                    <div class="cat-title">Lab Supplies</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/microtips-for-micropipette">Microtips for Micropipette</a></li>

                      <li><a href="https://justprocure.com/product/details/15ml-borosilicate-test-tube-with-screw-cap">15ml Test Tube</a></li>

                      <li><a href="https://justprocure.com/product/details/500pcs-cap-plastic-test-tube">Test Tube Set</a></li>

                    </ul>

                  </div>

                  <div class="one-third">

                    <div class="cat-title">Hospital & Clinical Supplies</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/tubes-a-medico-clinical-centrifuge">Medico/Clinical Centrifuge</a></li>

                      <li><a href="https://justprocure.com/product/details/bench-top-doctor-centrifuge-with-high-speed-cooper-motor">Benchtop Doctor Centrifuge</a></li>

                      <li><a href="https://justprocure.com/product/details/iron-leppro-hospital-trolley">Iron Hospital Trolley</a></li>

                    </ul>

                  </div>

                  <div class="one-third">

                    <div class="cat-title">Personal Hygiene</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/stainless-steel-disposable-surgical-skin-razor-set-for-personal-hygiene">Disposable Surgical Razor Set</a></li>

                      <li><a href="https://justprocure.com/product/details/dettol-250ml-no-touch-handwash-system">Dettol No Touch Handwash</a></li>

                      <li><a href="https://justprocure.com/product/details/250ml-neem-tulsi-honey-pealised-type-liquid-hand-wash">Neem, Tulsi & Honey Hand Wash</a></li>

                    </ul>

                  </div>

                </div>

              </li>

              <li>

                <a class="dropdown" href="/corporate">

                  <span class="menu-icn"><i class="fa-solid fa-house-laptop"></i></span>

                  <span class="menu-title">Corporate & Office</span>

                </a>

                <div class="drop-menu">

                  <div class="one-third">

                    <div class="cat-title">Office Stationery</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/scout-jute-cover-business-diary">Scout Business Diary</a></li>

                       <li><a href="https://justprocure.com/product/details/stick-plastic-black-ball-pen">Black Plastic Pen</a></li>

                      <li><a href="https://justprocure.com/product/details/desk-mdf-engineering-wood-black-pen-holder-with-clock-calendar">Desk Pen Holder</a></li>

                    </ul>

                  </div>

                  <div class="one-third">

                    <div class="cat-title">Office Furniture</div>

                    <ul class="mb0">

                      <li><a href="https://justprocure.com/product/details/white-medium-glossy-finish-wood-table">White Glossy Table</a></li>

                      <li><a href="https://justprocure.com/product/details/wood-honey-ambient-study-table">Honey Study Table</a></li>

                      <li><a href="https://justprocure.com/product/details/duly-painted-double-door-steel-almirah">Painted Steel Almirah</a></li>

                    </ul>

                  </div>

                  <div class="one-third">

                    <div class="cat-title">Cleaning & Housekeeping</div>

                    <ul class="mb0">

                      <li><a href="https://justprocure.com/product/details/litre-blue-virgin-plastic-dustbin">Blue Plastic Dustbin</a></li>

                      <li><a href="https://justprocure.com/product/details/disinfectant-toilet-cleaner">Toilet Disinfectant</a></li>

                      <li><a href="https://justprocure.com/product/details/wet-dry-vacuum-cleaner">Wet/Dry Vacuum</a></li>

                    </ul>

                  </div>

                </div>

              </li>

              <li>

                <a class="dropdown" href="/constructions">

                  <span class="menu-icn"><i class="fa-solid fa-screwdriver-wrench"></i></span>

                  <span class="menu-title">Construction</span>

                </a>

                <div class="drop-menu">

                  <div class="one-third">

                    <div class="cat-title">Plumbing</div>

                    <ul class="mb20">

                      <li><a href="https://justprocure.com/product/details/3-pcs-chrome-vanadium-steel-plumbing-tool-set">Plumbing Tool Set</a></li>

                      <li><a href="https://justprocure.com/product/details/multicolour-heavy-duty-sg-iron-drill-clamping-tool">Multicolor Drill Clamp</a></li>

                      <li><a href="https://justprocure.com/product/details/3-4-inch-straight-turning-tool-bit-holder">Straight Tool Bit Holder</a></li>

                    </ul>

                  </div>

                  <div class="one-third">

                    <div class="cat-title">Hardware</div>

                    <ul class="mb0">

                      <li><a href="https://justprocure.com/product/details/bench-drill-machine">Bench Drill Machine</a></li>

                      <li><a href="https://justprocure.com/product/details/electric-variable-speed-reversible-drill-machine">Variable Speed Drill</a></li>

                      <li><a href="https://justprocure.com/product/details/reversible-impact-drill-machine">Reversible Impact Drill</a></li>

                    </ul>

                  </div>

                  <div class="one-third">

                    <div class="cat-title">Paints & Coatings</div>

                    <ul class="mb0">

                      <li><a href="https://justprocure.com/product/details/650w-electric-portable-paint-sprayer-machine">Portable Paint Sprayer</a></li>

                      <li><a href="https://justprocure.com/product/details/abs-blue-orange-corded-paint-spray-machine">Blue & Orange Paint Sprayer</a></li>

                      <li><a href="https://justprocure.com/product/details/20l-white-ace-exterior-emulsion">White Exterior Emulsion</a></li>

                    </ul>

                  </div>

                </div>

              </li>



            </ul>

          </div>

        </div> -->

        <!-- Responsive Menu Structure-->

        <ul id="respMenu" class="ace-responsive-menu menu_list_custom_code wa pl200" data-menu-style="horizontal">

          <li class="visible_list"> <a href="/"><span class="title">Home</span></a>

            <!-- Level Two-->

          </li>

          <li class="megamenu_style"> <a href="/shop"><span class="title">Shop</span></a>

          </li>

          <li class="visible_list"> <a href="/aboutus"><span class="title">About Us</span></a>

          </li>          

          <li class="visible_list"> <a href="/blog"><span class="title">Blog</span></a>

          </li>

          <li class="visible_list"> <a href="/contact"><span class="title">Contact Us / Help Desk</span></a>

          </li>

        </ul>

       

      </div>

    </nav>

  </header>

  <!--for-mobileview-header-start-->
   
    <!-- Body Ovelay Behind Sidebar -->

  <!--<div class="hiddenbar-body-ovelay"></div>-->

  <!-- Sign In Hiddn SideBar -->

  <div class="signin-hidden-sbar">

    <div class="hsidebar-header">

      <div class="sidebar-close-icon"><span><i class="fa fa-close"></i></span></div>

      <h4 class="title">Sign-In</h4>

    </div>

    <div class="hsidebar-content">

      <div class="log_reg_form sidebar_area">

        <div class="login_form">

          <form action="#">

            <div class="mb-2 mr-sm-2">

              <label class="form-label">Username or email address</label>

              <input type="text" class="form-control" placeholder="Ali Tufan">

            </div>

            <div class="form-group mb5">

              <label class="form-label">Password</label>

              <input type="password" class="form-control" placeholder="Password">

            </div>

            <div class="custom-control custom-checkbox">

              <input type="checkbox" class="custom-control-input" id="exampleCheck3">

              <label class="custom-control-label" for="exampleCheck3">Remember me</label>

              <a class="btn-fpswd float-end" href="#">Lost your password?</a>

            </div>

            <button type="submit" class="btn btn-log btn-thm mt20">Login</button>

            <p class="text-center mb25 mt10">Don't have an account? <a class="signup-filter-btn" href="#">Create account</a></p>

            <div class="hr_content">

              <hr>

              <span class="hr_top_text">or</span>

            </div>

            <ul class="login_with_social text-center mt30 mb0">

              <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="fab fa-google"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="fab fa-apple"></i></a></li>

            </ul>

          </form>

        </div>

      </div>

    </div>

  </div>

 

  <!-- Sign Up Hiddn SideBar -->

  <div class="signup-hidden-sbar">

    <div class="hsidebar-header">

      <div class="sidebar-close-icon"><i class="fa fa-close"></i></div>

      <h4 class="title">Create Your Account</h4>

    </div>

    <div class="hsidebar-content">

      <div class="log_reg_form sidebar_area">

        <div class="sign_up_form">

          <form action="#">

            <div class="form-group">

              <label class="form-label">Your Name</label>

              <input type="text" class="form-control" placeholder="Ali Tufan">

            </div>

            <div class="form-group">

              <label class="form-label">Username</label>

              <input type="text" class="form-control" placeholder="alitfn">

            </div>

            <div class="form-group">

              <label class="form-label">Your Email</label>

              <input type="email" class="form-control" placeholder="abc@gmail.com">

            </div>

            <div class="form-group mb20">

              <label class="form-label">Password</label>

              <input type="password" class="form-control" placeholder="******************">

            </div>

            <button type="submit" class="btn btn-signup btn-thm">Create Account</button>

            <p class="text-center mb25 mt10">Already have an account? <a href="login">Sign in</a></p>

            <div class="hr_content">

              <hr>

              <span class="hr_top_text">or</span>

            </div>

            <ul class="login_with_social text-center mt30 mb0">

              <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="fab fa-google"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="fab fa-apple"></i></a></li>

            </ul>

          </form>

        </div>

      </div>

    </div>

  </div>

  <!--End Sign Up Hiddn SideBar -->

  

  <!-- Main Header Nav For Mobile -->

  


  <!--for-mobileview-header-end-->
  
  </div>

<body class="full-page-bg-buyer-dashboard" data-spy="scroll">

<div class="wrapper">


<div class="dashboard_content_wrapper">
    <div class="dashboard dashboard_wrapper pr0-md">
      <div class="dashboard__sidebar">
        <div class="dashboard_sidebar_list">
          <div class="sidebar_list_item">
            <a href="dashboard.php" class="items-center -is-active"><i class="fa fa-tachometer mr15"></i> Overview</a>
          </div>
         
          <div class="sidebar_list_item ">
            <a href="products.php" class="items-center"><i class="fa fa-box mr15"></i>Products</a>
          </div>
          <div class="sidebar_list_item ">
            <a href="product-register.php" class="items-center"><i class="fa fa-box mr15"></i>Warranty Registered</a>
          </div>
          <div class="sidebar_list_item ">
            <a href="distributer.php" class="items-center"><i class="fa fa-box mr15"></i>Distributers</a>
          </div>
          <div class="sidebar_list_item ">
            <a href="sellers.php" class="items-center"><i class="fa fa-bell mr15"></i>Sellers</a>
          </div>
          <div class="sidebar_list_item ">
            <a href="contact.php" class="items-center"><i class="fa fa-bell mr15"></i>Contacts</a>
          </div>
          <div class="sidebar_list_item ">
            <a href="setting.php" class="items-center"><i class="fa fa-cog mr15"></i>Settings</a>
          </div> 
     

          <div class="chat-with-us-buyer-dashboard">
            <div class="chat-with-us-buyer-dashboard-image">
              <img src="images/buyer-dashboard/client.png">
            </div>

            <div class="chat-with-us-buyer-dashboard-text">
              <p>Need support on your order or have any enquiry?</p>
            </div>

            <button class="chat-with-us-button-dashboard">Chat with us</button>
          </div>
        
        </div>
      </div>