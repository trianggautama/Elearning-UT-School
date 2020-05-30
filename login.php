   <?php
    include "config/class.admin.php";
    $user=new User();
if (isset($_POST['login'])) { 
    $email=$_POST['email']; 
    $pass=$_POST['pass'];  
    $login = $user->check_login($email, $pass);
    if ($login) {

    // Registration Success
   echo "<script>;
      window.location = 'index.php'</script>"; 
    } else {
    // Registration Failed
    echo "<script>alert('Login GAGAL. Username atau Password Tidak Cocok.');
      window.location = 'login.php?auth'</script>"; 
    }

} 
?> 

<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="vendor/animate/animate.css">

		<link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>

	</head>
	<body style="padding-top:0px !important;margin-top:0px !important;">
					<!-- start: header -->
					<header class="header bg-dark mt-0 pt-0">
						<div class="logo-container">
							<a href="../2.2.0" class="logo">
								<img src="img/logo_ut.png" width="35" height="35" alt="Porto Admin" />
							</a>
							<p class="logo pt-1	text-white">
								<b>E-Learning UT School</b> 
							</p>
							<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
								<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
							</div>
						</div>
					
						<!-- start: search & user box -->
						<div class="header-right pt-1">					
							<div id="userbox" class="userbox pt-1">
								<a href="modul/mod_registrasi/registrasi.php" class="btn btn-sm btn-warning">
									Refgistrasi
								</a>
							</div>
						</div>
						<!-- end: search & user box -->
					</header>
					<!-- end: header -->
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">

				<div class="card">
					<div class="card-body">
						<div class="text-center mb-4">
							<b>LOGIN USER</b>
						</div>
						<hr>
            <form class="user" method="POST">
							<div class="form-group mb-3">
								<label>Email</label>
								<div class="input-group">
                <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fs fa-envolve"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-3">
								<div class="clearfix">
									<label class="float-left">Password</label>
									<a href="pages-recover-password.html" class="float-right">Lost Password?</a>
								</div>
								<div class="input-group">
                <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
                  <button class="btn btn-warning mt-2" name="login">
                      Login
                  </button>
								</div>
							</div>

							<p class="text-center">Don't have an account yet? <a href="modul/mod_registrasi/registrasi.php">Register</a></p>

						</form>
					</div>
				</div>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="vendor/popper/umd/popper.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.js"></script>
		<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="vendor/common/common.js"></script>
		<script src="vendor/nanoscroller/nanoscroller.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

	</body>
</html>