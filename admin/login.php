<?php
session_start();
include('../functions.php');

// Check if the user is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
   header('Location: ../dashboard.php');
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (validateLogin($email, $password)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header('Location: ../dashboard.php');
        exit;
    } else {
        $error_message = 'Invalid email or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Hella Admin</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
</head>
<body>
  <header>
    <style>
      #intro {
        background-image: url(https://mdbootstrap.com/img/new/fluid/city/008.jpg);
        height: 100vh;
      }

      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>

    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form class="bg-white rounded shadow-5-strong p-5" method="POST" action="login.php">
                <h2 class="text-center mb-4">Hella Admin</h2>
                <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php } ?>
                <div class="form-outline mb-4" data-mdb-input-init>
                  <input type="email" id="form1Example1" name="email" class="form-control" required />
                  <label class="form-label" for="form1Example1">Email address</label>
                </div>
                <div class="form-outline mb-4" data-mdb-input-init>
                  <input type="password" id="form1Example2" name="password" class="form-control" required />
                  <label class="form-label" for="form1Example2">Password</label>
                </div>
                <!-- <div class="row mb-4">
                  <div class="col d-flex justify-content-center">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                      <label class="form-check-label" for="form1Example3">Remember me</label>
                    </div>
                  </div>
                  <div class="col text-center">
                    <a href="#!">Forgot password?</a>
                  </div>
                </div> -->
                <button type="submit" class="btn btn-primary btn-block" data-mdb-ripple-init>Sign in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <script type="text/javascript" src="js/mdb.umd.min.js"></script>
</body>
</html>
