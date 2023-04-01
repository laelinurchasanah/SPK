<?php 
require_once('Connections/koneksi.php');

//--- daftar ---
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

//cek email
	$x = GetSQLValueString($koneksi, $_POST['kode'], "text");
	$y = GetSQLValueString($koneksi, $_POST['a'], "text");

	  if ($x == $y) {
	       mysqli_select_db($koneksi, $database_koneksi);
		  $sql = sprintf("SELECT email_member FROM tb_member WHERE email_member = %s", GetSQLValueString($koneksi, $_POST['email'], "text"));
		  $cek = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
		  $row = mysqli_fetch_assoc($cek);	
		  if ($row > 0) {
		  
		  	   echo "<script type='text/javascript'>
				alert('Oops!! Sorry, that email already exists. Please login');
				document.location= 'https://stmikroyal.ac.id/icossit/login.php';
				</script>";  
				}else{
  //jika tidak ditemukan
  $insertSQL = sprintf("INSERT INTO tb_member (firstname_member, middlename_member, lastname_member, email_member, passwd_member, gender_member, contact_member, country_member, active_member, key_member, ta_member, date_member, updateby_member) VALUES (%s, %s, %s, %s, PASSWORD(%s), %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($koneksi, $_POST['firstname'], "text"),
                       GetSQLValueString($koneksi, $_POST['mid_name'], "text"),
                       GetSQLValueString($koneksi, $_POST['last_name'], "text"),
					   GetSQLValueString($koneksi, $_POST['email'], "text"),
					   GetSQLValueString($koneksi, $_POST['password'], "text"),
                       GetSQLValueString($koneksi, $_POST['gender'], "text"),
                       GetSQLValueString($koneksi, $_POST['contact'], "text"),
                       GetSQLValueString($koneksi, $_POST['country'], "text"),
                       GetSQLValueString($koneksi, 'Y', "text"),
					   GetSQLValueString($koneksi, $_POST['email'], "text"),
                       GetSQLValueString($koneksi, $ta, "text"),
                       GetSQLValueString($koneksi, $today, "date"),
                       GetSQLValueString($koneksi, $ID, "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
  
  if ($Result1){
		  // *** Validate request to login to this site.
		if (!isset($_SESSION)) {
		  session_start();
		} //session
		
		$loginFormAction = $_SERVER['PHP_SELF'];
		if (isset($_GET['accesscheck'])) {
		  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
		} // Login Form
		
		if (isset($_POST['email'])) {
		  $loginUsername=$_POST['email'];
		  $password=$_POST['password'];
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
		}		//if isset

  } // Result
  
  } //cek row > 0
  
  
  		}else{ // kode
			echo "<script type='text/javascript'>
			alert('Oops! The code you entered is incorrect!');
			document.location= 'https://stmikroyal.ac.id/icossit/register.php?oops';
			</script>";
	  } //kode 
  
} // if simpan

//----------


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
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

<script type="text/javascript" src="log_asset/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	$('document').ready(function(){	
		$('#nip').after('<span class="status"></span>').css('margin-right','10px');
		$('#nip').keyup(function(){
			$(this).css({'border':'1px solid #ccc','background':'none'});
		});
		$('#nip').change(function(e){
			var nip = $(this).val();
			if(nip.length != 0){
				$('.status').html('<img src="log_asset/images/loading.gif"><b> Chek ketersediaan ...</b>');
				$.ajax({
					type: "POST",
					url: "cek.php",
					data: "email="+nip,
					success: function(data){
						if(data == 0){
							$('.status').html(' <img src="log_asset/images/true.png"><b style="color:green;"> Username available</b>');
						}else{					
							$('.status').html(' <img src="log_asset/images/false.png"><b style="color:red;"> Username unavailable</b>');
							$('#nip').css({'border':'3px solid #f00','background':'yellow'});
						}
					}
				});
			}else{
				$('.status').html('');
			}
		});
	});
</script>

<script type="text/javascript">
	$('document').ready(function(){	
		$('.msg').hide();
			
		function isEmail(email){
			return /^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/.test(email);
		}
				
		$('#form').submit(function(){
			var kirim = true;	
			$('input').each(function(){
				var aktif = $(this);
				var min = parseInt(aktif.attr('min'));
				var max = parseInt(aktif.attr('max'));
				var nama = aktif.attr('name');
				
				aktif.keyup(function(){
					$(this).removeClass('error');
					kirim = true;
				});
					var isi= aktif.val();
				// Cek kekosongan
					if(aktif.hasClass('required') && isi == ""){
						if(kirim == true) alert("Field "+nama+" harus diisi");
						aktif.addClass('error');
						kirim = false;
					}else 
				// Cek angka
					if(aktif.hasClass('angka') && /^[0-9- ]*$/.test(isi) == false){
						if(kirim == true) alert("Field  "+nama+" must be a number");
						aktif.addClass('error');
						kirim = false;
					}else
				// Cek huruf
					if(aktif.hasClass('huruf') && /^[a-zA-Z- ]*$/.test(isi) == false){
						if(kirim == true) alert("Field  "+nama+"  must be filled in letters");
						aktif.addClass('error');
						kirim = false;
					}else
				// Cek text a-z atau 0-9					
					if(aktif.hasClass('text') && /^[a-zA-Z0-9-]*$/.test(isi) == false){
						if(kirim == true) alert("Field  "+nama+"  can only contain characters a-z or 0-9");
						aktif.addClass('error');
						kirim = false;
					}else
				// Cek email					
					if(aktif.hasClass('email') && isEmail(isi) == false && isi !== ""){
						if(kirim == true) alert("Email is invalid");
						aktif.addClass('error');
						kirim = false;
					}else
				// Cek panjang huruf					
					if((aktif.hasClass('range')) && (isi.length < 6 || isi.length > 10)){
						if(kirim == true) alert("Long  "+nama+" must be between 6-10 letters");
						aktif.addClass('error');
						kirim = false;
					}
			});
			if(kirim){
				return true;
			}else{
				$('.error:first').focus();
				return false;				
			}
		});	
	});
</script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(log_asset/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						REGISTER					</span>				</div>

				<form class="login100-form validate-form" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form">
					
                    <div>
                    	<a href="login.php">Click here</a> if you are already registered on this site.
                    </div>
					<br>
					<br>

					<div class="wrap-input100 validate-input m-b-26" data-validate="First Name is required">	
                        <span class="label-input100">First Name</span>
						<input class="input100 huruf" type="text" name="firstname" placeholder="Enter First Name" id="firstname_member">
						<span class="focus-input100"></span>					
                  </div>

					<div class="wrap-input100 m-b-18" >
						<span class="label-input100">Middle Name</span>
						<input class="input100 huruf" type="text" name="mid_name" placeholder="Enter Middle Name">
						<span class="focus-input100"></span>					
                    </div>
                    
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Last Name is required">
						<span class="label-input100">Last Name</span>
						<input class="input100 huruf" type="text" name="last_name" placeholder="Enter Last Name">
						<span class="focus-input100"></span>					
                    </div>
		
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">	
                        <span class="label-input100">Email</span>
						<input class="input100 email" type="text" name="email" id="nip"  placeholder="Enter Email @ ">
						<span class="focus-input100"></span>					
                    </div>
                    
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Password is required">	
                        <span class="label-input100">Password</span>
						<input name="password" type="password" class="input100 range" maxlength="10" placeholder="Enter Password">
						<span class="focus-input100"></span>					
                    </div>
                    
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Gender is required">	
                        <span class="label-input100">I am</span>
						<select name="gender" class="form-control">
                        	<option value="L" <?php if (!(strcmp("L", "L"))) {echo "SELECTED";} ?>>Male</option>
                        	<option value="P" <?php if (!(strcmp("P", "L"))) {echo "SELECTED";} ?>>Female</option>
                        </select> 
						<span class="focus-input100"></span>					
                    </div>
                    
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Contact Number is required">	
                        <span class="label-input100">Contact Number</span>
						<input class="input100 angka" type="number" name="contact" placeholder="Enter Contact Number">
						<span class="focus-input100"></span>					
                    </div>
                    
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Country is required">	
                        <span class="label-input100">Country</span>
                        <select name="country" id="country" class="form-control">
                            <option value="Afghanistan">Afghanistan</option>
                             <option value="Albania">Albania</option>
                             <option value="Algeria">Algeria</option>
                             <option value="Andorra">Andorra</option>
                             <option value="Angola">Angola</option>
                             <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                             <option value="Argentina">Argentina</option>
                             <option value="Armenia">Armenia</option>
                             <option value="Australia">Australia</option>
                             <option value="Austria">Austria</option>
                             <option value="Azerbaijan">Azerbaijan</option>
                             <option value="The Bahamas">The Bahamas</option>
                             <option value="Bahrain">Bahrain</option>
                             <option value="Bangladesh">Bangladesh</option>
                             <option value="Barbados">Barbados</option>
                             <option value="Belarus">Belarus</option>
                             <option value="Belgium">Belgium</option>
                             <option value="Belize">Belize</option>
                             <option value="Benin">Benin</option>
                             <option value="Bhutan">Bhutan</option>
                             <option value="Bolivia">Bolivia</option>
                             <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                             <option value="Botswana">Botswana</option>
                             <option value="Brazil">Brazil</option>
                             <option value="Brunei">Brunei</option>
                             <option value="Bulgaria">Bulgaria</option>
                             <option value="Burkina Faso">Burkina Faso</option>
                             <option value="Burundi">Burundi</option>
                             <option value="Cambodia">Cambodia</option>
                             <option value="Cameroon">Cameroon</option>
                             <option value="Canada">Canada</option>
                             <option value="Cape Verde">Cape Verde</option>
                             <option value="Central African Republic">Central African Republic</option>
                             <option value="Chad">Chad</option>
                             <option value="Chile">Chile</option>
                             <option value="China">China</option>
                             <option value="Colombia">Colombia</option>
                             <option value="Comoros">Comoros</option>
                             <option value="Republic of the Congo">Republic of the Congo</option>
                             <option value="Costa Rica">Costa Rica</option>
                             <option value="Ivory Coast">Ivory Coast</option>
                             <option value="Croatia">Croatia</option>
                             <option value="Cuba">Cuba</option>
                             <option value="Cyprus">Cyprus</option>
                             <option value="Czech Republic">Czech Republic</option>
                             <option value="Denmark">Denmark</option>
                             <option value="Djibouti">Djibouti</option>
                             <option value="Dominica">Dominica</option>
                             <option value="Dominican Republic">Dominican Republic</option>
                             <option value="East Timor">East Timor</option>
                             <option value="Ecuador">Ecuador</option>
                             <option value="Egypt">Egypt</option>
                             <option value="El Salvador">El Salvador</option>
                             <option value="Equatorial Guinea">Equatorial Guinea</option>
                             <option value="Eritrea">Eritrea</option>
                             <option value="Estonia">Estonia</option>
                             <option value="Ethiopia">Ethiopia</option>
                             <option value="Fiji">Fiji</option>
                             <option value="Finland">Finland</option>
                             <option value="France">France</option>
                             <option value="Gabon">Gabon</option>
                             <option value="The Gambia">The Gambia</option>
                             <option value="Georgia">Georgia</option>
                             <option value="Germany">Germany</option>
                             <option value="Ghana">Ghana</option>
                             <option value="Greece">Greece</option>
                             <option value="Grenada">Grenada</option>
                             <option value="Guatemala">Guatemala</option>
                             <option value="Guinea">Guinea</option>
                             <option value="Guinea Bissau">Guinea Bissau</option>
                             <option value="Guyana">Guyana</option>
                             <option value="Haiti">Haiti</option>
                             <option value="Honduras">Honduras</option>
                             <option value="Hungary">Hungary</option>
                             <option value="Iceland">Iceland</option>
                             <option value="India">India</option>
                             <option value="Indonesia">Indonesia</option>
                             <option value="Iran">Iran</option>
                             <option value="Iraq">Iraq</option>
                             <option value="Ireland">Ireland</option>
                             <option value="Israel">Israel</option>
                             <option value="Italy">Italy</option>
                             <option value="Jamaica">Jamaica</option>
                             <option value="Japan">Japan</option>
                             <option value="Jordan">Jordan</option>
                             <option value="Kazakhstan">Kazakhstan</option>
                             <option value="Kenya">Kenya</option>
                             <option value="Kiribati">Kiribati</option>
                             <option value="Korea, North">Korea, North</option>
                             <option value="Korea, South">Korea, South</option>
                             <option value="Kuwait">Kuwait</option>
                             <option value="Kyrgyzstan">Kyrgyzstan</option>
                             <option value="Laos">Laos</option>
                             <option value="Latvia">Latvia</option>
                             <option value="Lebanon">Lebanon</option>
                             <option value="Libya">Libya</option>
                             <option value="Liechtenstein">Liechtenstein</option>
                             <option value="Luxembourg">Luxembourg</option>
                             <option value="Macedonia">Macedonia</option>
                             <option value="Madagascar">Madagascar</option>
                             <option value="Malawi">Malawi</option>
                             <option value="Malaysia">Malaysia</option>
                             <option value="Maldives">Maldives</option>
                             <option value="Mali">Mali</option>
                             <option value="Malta">Malta</option>
                             <option value="Marshall Islands">Marshall Islands</option>
                             <option value="Mauritania">Mauritania</option>
                             <option value="Mauritius">Mauritius</option>
                             <option value="Mexico">Mexico</option>
                             <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                             <option value="Moldova">Moldova</option>
                             <option value="Monaco">Monaco</option>
                             <option value="Mongolia">Mongolia</option>
                             <option value="Montenegro">Montenegro</option>
                             <option value="Morocco">Morocco</option>
                             <option value="Mozambique">Mozambique</option>
                             <option value="Myanmar">Myanmar</option>
                             <option value="Namibia">Namibia</option>
                             <option value="Nauru">Nauru</option>
                             <option value="Nepal">Nepal</option>
                             <option value="Netherlands">Netherlands</option>
                             <option value="New Zealand">New Zealand</option>
                             <option value="Nicaragua">Nicaragua</option>
                             <option value="Niger">Niger</option>
                             <option value="Nigeria">Nigeria</option>
                             <option value="Norway">Norway</option>
                             <option value="Oman">Oman</option>
                             <option value="Pakistan">Pakistan</option>
                             <option value="Palau">Palau</option>
                             <option value="Panama">Panama</option>
                             <option value="Papua New Guinea">Papua New Guinea</option>
                             <option value="Paraguay">Paraguay</option>
                             <option value="Peru">Peru</option>
                             <option value="Philippines">Philippines</option>
                             <option value="Poland">Poland</option>
                             <option value="Portugal">Portugal</option>
                             <option value="Qatar">Qatar</option>
                             <option value="Romania">Romania</option>
                             <option value="Russia">Russia</option>
                             <option value="Rwanda">Rwanda</option>
                             <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                             <option value="Saint Lucia">Saint Lucia</option>
                             <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                             <option value="Samoa">Samoa</option>
                             <option value="San Marino">San Marino</option>
                             <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                             <option value="Saudi Arabia">Saudi Arabia</option>
                             <option value="Senegal">Senegal</option>
                             <option value="Serbia">Serbia</option>
                             <option value="Seychelles">Seychelles</option>
                             <option value="Sierra Leone">Sierra Leone</option>
                             <option value="Singapore">Singapore</option>
                             <option value="Slovakia">Slovakia</option>
                             <option value="Slovenia">Slovenia</option>
                             <option value="Solomon Islands">Solomon Islands</option>
                             <option value="Somalia">Somalia</option>
                             <option value="South Africa">South Africa</option>
                             <option value="Spain">Spain</option>
                             <option value="Sri Lanka">Sri Lanka</option>
                             <option value="Sudan">Sudan</option>
                             <option value="Suriname">Suriname</option>
                             <option value="Swaziland">Swaziland</option>
                             <option value="Sweden">Sweden</option>
                             <option value="Switzerland">Switzerland</option>
                             <option value="Syria">Syria</option>
                             <option value="Tajikistan">Tajikistan</option>
                             <option value="Tanzania">Tanzania</option>
                             <option value="Thailand">Thailand</option>
                             <option value="Togo">Togo</option>
                             <option value="Tonga">Tonga</option>
                             <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                             <option value="Tunisia">Tunisia</option>
                             <option value="Turkey">Turkey</option>
                             <option value="Turkmenistan">Turkmenistan</option>
                             <option value="Tuvalu">Tuvalu</option>
                             <option value="Uganda">Uganda</option>
                             <option value="Ukraine">Ukraine</option>
                             <option value="United Arab Emirates">United Arab Emirates</option>
                             <option value="United Kingdom">United Kingdom</option>
                             <option value="United States">United States</option>
                             <option value="Uruguay">Uruguay</option>
                             <option value="Uzbekistan">Uzbekistan</option>
                             <option value="Vanuatu">Vanuatu</option>
                             <option value="Vatican City">Vatican City</option>
                             <option value="Venezuela">Venezuela</option>
                             <option value="Vietnam">Vietnam</option>
                             <option value="Yemen">Yemen</option>
                             <option value="Zambia">Zambia</option>
                             <option value="Zimbabwe">Zimbabwe</option>
                    
                          </select>
						<span class="focus-input100"></span>					
                    </div>
                    
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Contact Number is required">	
                            <p>Please Enter Unique Code : "<strong><?php $a = rand(1000,6000); echo $a; ?></strong>"</p>
                        <input type="hidden" class="form-control  angka" name="a" value="<?= $a; ?>"  required>
						<input class="input100 angka" type="number" name="kode" placeholder="Enter Contact Number Here">
						<span class="focus-input100"></span>					
                    </div>
                    
                    <label><div align="left" class="style2"></div>
                                     
                                     </label>
                    
					<div class="container-login100-form-btn">
						<button class="login100-form-btn btn-block">
							Submit						</button>
					</div>
                    
                      
  						<input type="hidden" name="MM_insert" value="form1" />
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

</body>
</html>