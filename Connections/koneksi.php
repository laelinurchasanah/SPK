<?php
# FileName="Connection_php_mysqli.htm"
# Type="mysqli"
# HTTP="true"
#KETERANGAN LEVEL:
#MASTER = 1 ->AI DIMULAI DARI 1
#ADMIN = 2 ->AI DIMULAI DARI 10
#GURU = 3 ->AI DIMULAI DARI 100
#STAFF =  ->AI DIMULAI DARI 500
#SISWA = 4 ->AI DIMULAI DARI 1000

$hostname_koneksi = "localhost";
$database_koneksi = "codeego_pro";
$username_koneksi = "root";
$password_koneksi = "";
$koneksi = mysqli_connect($hostname_koneksi, $username_koneksi, $password_koneksi) or trigger_error(mysqli_error($koneksi),E_USER_ERROR); 

//TANGGAL
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$bulan= date("m");
$tglsekarang = date("Y-m-d", $tanggal);
$today = date("Y-m-d H:i:s");
$pukul=date("H:i:s");
$tahun=date("Y");
$jam=date("H");
$menit=date("i");
$detik=date("s");
$kodeacak = substr(time(),5);
//PESAN
function title($class, $judul, $isi) {
	echo "<div class='animated flash callout callout-".$class."'>
	<h4>".$judul."</h4>
	".$isi."</div>";
}

function pesan($title, $isi) {
	echo "<div class='animated flash callout callout-".$title."'>
	<h4>Informasi</h4>
	".$isi."</div>";
}

function pesanlink($title, $arahkan) {
	echo "<script>
	alert('".$title."');
	document.location = '".$arahkan."';
	</script>";
}

//SANITASI
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($koneksi, $theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($koneksi, $theValue) : mysqli_escape_string($koneksi, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

//SESI LOGIN
$colname_rs_login = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs_login = $_SESSION['MM_Username'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_login = sprintf("SELECT * FROM vw_login WHERE Login = %s", GetSQLValueString($koneksi, $colname_rs_login, "text"));
$rs_login = mysqli_query($koneksi, $query_rs_login) or die(mysqli_error($koneksi));
$row_rs_login = mysqli_fetch_assoc($rs_login);
$totalRows_rs_login = mysqli_num_rows($rs_login);

$ID = $row_rs_login['ID'];
$login = $row_rs_login['Login'];
$nama = $row_rs_login['Nama'];
$level = $row_rs_login['Level'];
 
//LOGOUT
$logoutAction = "keluar.php";
//MENAMPILKAN DEFAULT WEB
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_config = "SELECT * FROM tb_config";
$rs_config = mysqli_query($koneksi, $query_rs_config) or die(mysqli_error($koneksi));
$row_rs_config = mysqli_fetch_assoc($rs_config);
$totalRows_rs_config = mysqli_num_rows($rs_config);

$title = $row_rs_config['title'];
$deskripsi = $row_rs_config['deskripsi'];
$header = $row_rs_config['header'];
$footer = $row_rs_config['footer'];
$text1 = $row_rs_config['text1'];
$text2 = $row_rs_config['text2'];
$text3 = $row_rs_config['text3'];

//MENAMPILKAN MENU
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_menu = "SELECT * FROM tb_menu WHERE level_menu LIKE '%".$level."%' ORDER BY nourut_menu ASC";
$rs_menu = mysqli_query($koneksi, $query_rs_menu) or die(mysqli_error($koneksi));
$row_rs_menu = mysqli_fetch_assoc($rs_menu);
$totalRows_rs_menu = mysqli_num_rows($rs_menu);

//TAHUN PERIODE AKADEMIK
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_tap = "SELECT * FROM tb_ta WHERE id_ta = 1";
$rs_tap = mysqli_query($koneksi, $query_rs_tap) or die(mysqli_error($koneksi));
$row_rs_tap = mysqli_fetch_assoc($rs_tap);
$totalRows_rs_tap = mysqli_num_rows($rs_tap);
$ta = $row_rs_tap['kode_ta'];

//FUNCTION UPLOAD PHOTO
function upload($name) {
	
	$namaFile = $_FILES[$name]['name'];
	$ukuranFile = $_FILES[$name]['size'];
	$error = $_FILES[$name]['error'];
	$tmpName = $_FILES[$name]['tmp_name'];
	
	 
	 if ( $error === 4 ) {
		//pesanlink('Oops! Gambar masih kosong','?page=insert/photo');
		return false;
	} 
	
	//cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg','jpeg','png','PNG','JPEG','JPG'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	
	if ( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('File yang diupload bukan gambar!!');
			</script>";
		return false;	
	}
	
	if ( $ukuranFile > 1000000) {
		echo "<script>
				alert('Ukuran file terlalu besar, minimal < 1 MB');
			</script>";
		//return false;
	}
	
	//rename file gambar
	$namaFileBaru = uniqid();
	$namaFileBaru .= ".";
	$namaFileBaru .= $ekstensiGambar;
	
	move_uploaded_file($tmpName, '../photos/' . $namaFileBaru);
	
	return $namaFileBaru;
}

function photopos($name) {
	
	$namaFile = $_FILES[$name]['name'];
	$ukuranFile = $_FILES[$name]['size'];
	$error = $_FILES[$name]['error'];
	$tmpName = $_FILES[$name]['tmp_name'];
	 
	//cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg','jpeg','png','PNG','JPEG','JPG'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	
	/* if ( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('File yang diupload bukan gambar!!');
			</script>";
		return false;	
	} */
	
	if ( $ukuranFile > 1000000) {
		echo "<script>
				alert('Ukuran file terlalu besar, minimal < 1 MB');
			</script>";
		//return false;
	}
	
	//rename file gambar
	if ( $error !== 4 ) {
		
	$namaFileBaru = uniqid();
	$namaFileBaru .= ".";
	$namaFileBaru .= $ekstensiGambar;
	
	move_uploaded_file($tmpName, '../photo_pos/' . $namaFileBaru);
	
	return $namaFileBaru;
	} 
}


//FUNCTION UPLOAD PHOTO
function feature_image($name) {
	
	$namaFile = $_FILES[$name]['name'];
	$ukuranFile = $_FILES[$name]['size'];
	$error = $_FILES[$name]['error'];
	$tmpName = $_FILES[$name]['tmp_name'];
	
	 
	 if ( $error === 4 ) {
		//pesanlink('Oops! Gambar masih kosong','?page=insert/photo');
		return false;
	} 
	
	//cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg','jpeg','png','PNG','JPEG','JPG'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	
	if ( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('File yang diupload bukan gambar!!');
			</script>";
		return false;	
	}
	
	if ( $ukuranFile > 1000000) {
		echo "<script>
				alert('Ukuran file terlalu besar, minimal < 1 MB');
			</script>";
		//return false;
	}
	
	//rename file gambar
	$namaFileBaru = uniqid();
	$namaFileBaru .= ".";
	$namaFileBaru .= $ekstensiGambar;
	
	move_uploaded_file($tmpName, '../feature_images/' . $namaFileBaru);
	
	return $namaFileBaru;
}

//FUNCTION UPLOAD PHOTO
function dokumentasi($name) {
	
	$namaFile = $_FILES[$name]['name'];
	$ukuranFile = $_FILES[$name]['size'];
	$error = $_FILES[$name]['error'];
	$tmpName = $_FILES[$name]['tmp_name'];
	
	 
	 if ( $error === 4 ) {
		//pesanlink('Oops! Gambar masih kosong','?page=insert/photo');
		return false;
	} 
	
	//cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg','jpeg','png','PNG','JPEG','JPG'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	
	if ( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('File yang diupload bukan gambar!!');
			</script>";
		return false;	
	}
	
	if ( $ukuranFile > 1000000) {
		echo "<script>
				alert('Ukuran file terlalu besar, minimal < 1 MB');
			</script>";
		//return false;
	}
	
	//rename file gambar
	$namaFileBaru = uniqid();
	$namaFileBaru .= ".";
	$namaFileBaru .= $ekstensiGambar;
	
	move_uploaded_file($tmpName, '../dokumentasi_image/' . $namaFileBaru);
	
	return $namaFileBaru;
}

//MEMBUAT FUNGSI TERBILANG
function penyebut($nilai) {
		$nilai = abs($nilai);
//		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$huruf = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEBILAN", "SEPULUH", "SEBELAS");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " BELAS";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." PULUH". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " RATUS" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " SERIBU" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " RIBU" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " JUTA" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " MILYAR" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " TRILYUN" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "MINUS ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}

?>