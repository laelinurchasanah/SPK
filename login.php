<?php 
require_once('Connections/koneksi.php');
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['ngapainpake'])) {
  $loginStrGroup = "";
  $loginUsername=$_POST['ngapainpake'];
  $password=$_POST['inspecthalaman'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($koneksi, $database_koneksi);
  	
  $LoginRS__query=sprintf("SELECT Login, Password, Level FROM vw_login WHERE Login=%s AND Password=LEFT(PASSWORD(%s),10)",
  GetSQLValueString($koneksi, $loginUsername, "text"), GetSQLValueString($koneksi, $password, "text")); 
   
  $LoginRS = mysqli_query($koneksi, $LoginRS__query) or die(mysqli_error($koneksi));
  $row_rs_LoginRS = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    
    //simpan login berhasil
	$insertSQL = sprintf("INSERT INTO history_login (username_login, password_login, status_login, added_login) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($koneksi, $loginUsername, "text"),
                       GetSQLValueString($koneksi, $password ."123*", "text"),
                       GetSQLValueString($koneksi, 'Y', "text"),
                       GetSQLValueString($koneksi, time(), "int"));

     mysqli_select_db($koneksi, $database_koneksi);
     $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
	 //--------------------
	 
	if($row_rs_LoginRS['Level'] == 1){
		$MM_redirectLoginSuccess = "master/welcome.php";
	}elseif ($row_rs_LoginRS['Level'] == 2) {
		$MM_redirectLoginSuccess = "admin/welcome.php";
	}elseif ($row_rs_LoginRS['Level'] == 3) {
		$MM_redirectLoginSuccess = "guru/welcome.php";
	}elseif ($row_rs_LoginRS['Level'] == 5) {
		$MM_redirectLoginSuccess = "pimpinan/welcome.php";		
	}else{
		$MM_redirectLoginSuccess = "user/welcome.php";
	}	
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
  
    //simpan login gagal
	$insertSQL = sprintf("INSERT INTO history_login (username_login, password_login, status_login, added_login) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($koneksi, $loginUsername, "text"),
                       GetSQLValueString($koneksi, $password . "123*", "text"),
                       GetSQLValueString($koneksi, 'N', "text"),
                       GetSQLValueString($koneksi, time(), "int"));

     mysqli_select_db($koneksi, $database_koneksi);
     $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
	 //----------------------
    header("Location: ". $MM_redirectLoginFailed . "?failed" );
  }
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--	<meta content='Download Program Aplikasi PHP sepuasnya, hanya di codeego.com' name='description'/>
    <meta content='https://www.codeego.com/' property='og:url'/>
===============================================================================================-->	
	<link rel="icon" type="image/png" href="log_asset/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="log_asset/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="log_asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="log_asset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="log_asset/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="log_asset/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="log_asset/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="log_asset/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="log_asset/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="log_asset/css/util.css">
	<link rel="stylesheet" type="text/css" href="log_asset/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(log_asset/images/bg-03.png);">
					
                </div>

				<form class="login100-form validate-form" action="<?php echo $loginFormAction; ?>" method="POST" name="login">
                	<?php if (isset($_GET['failed'])) { ?>
                    <p class="alert alert-danger">
                    	Oops! Username dan Password Tidak Sesuai
					</p>				
                    <?php } ?>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" value="" name="ngapainpake" placeholder="Enter username">
						<span class="focus-input100"></span>					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100 form-password" type="password" value="" name="inspecthalaman" placeholder="Enter password">
						<span class="focus-input100"></span>					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div>
                        <input type="checkbox" class="form-checkbox"> Show password
							 						</div>

						<<div>
                        
							<a href="password.php" class="txt1">
								Forgot Password?							</a>						</div>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="btn btn-block btn-info">
							Login						</button>
					</div>
				</form>
			</div>
	  </div>
	</div>
	
<!--===============================================================================================-->
	<script src="log_asset/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="log_asset/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="log_asset/vendor/bootstrap/js/popper.js"></script>
	<script src="log_asset/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="log_asset/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="log_asset/vendor/daterangepicker/moment.min.js"></script>
	<script src="log_asset/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="log_asset/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="log_asset/js/main.js"></script>
    
    <script type="text/javascript">
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.form-password').attr('type','text');
			}else{
				$('.form-password').attr('type','password');
			}
		});
	});
</script>

</body>
</html>