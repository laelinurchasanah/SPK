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
  $loginUsername=$_POST['ngapainpake'];
  $password=$_POST['inspecthalaman'];
  $MM_fldUserAuthorization = "Level";
  
  $MM_redirectLoginFailed = "welcome.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($koneksi, $database_koneksi);
  	
  $LoginRS__query=sprintf("SELECT Login, Password, Level FROM vw_login WHERE Login=%s AND Password=LEFT(PASSWORD(%s),10)",
  GetSQLValueString($koneksi, $loginUsername, "text"), GetSQLValueString($koneksi, $password, "text")); 
   
  $LoginRS = mysqli_query($koneksi, $LoginRS__query) or die(mysqli_error($koneksi));
  $row_rs_LoginRS = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
    
   //$loginStrGroup  = mysqli_result($koneksi, $LoginRS,0,'Level');
    
	if($row_rs_LoginRS['Level'] == 1){
		$MM_redirectLoginSuccess = "master/welcome.php";
	}elseif ($row_rs_LoginRS['Level'] == 2) {
		$MM_redirectLoginSuccess = "admin/welcome.php";
	}elseif ($row_rs_LoginRS['Level'] == 3) {
		$MM_redirectLoginSuccess = "operator/welcome.php";		
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
    header("Location: ". $MM_redirectLoginFailed );
  }
}
 
require_once('require/header.php'); 
?>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
   <?php require_once('require/navbar.php'); ?>
  </header>
  
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <div class="animated fadeIn">
      <?php
	  if(isset($_GET["page"]) && $_GET["page"] != "home"){
          if(file_exists(htmlentities($_GET["page"]).".php")){
 					include(htmlentities($_GET["page"]).".php");
			  }else{
					include("404.php");
			  }
	  	}else{
	 		include("home.php");
  	  } 
	  ?>
      </div>
      
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
<?php require_once('require/footer.php'); ?>