<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



//MENAMPILKAN JUMLAH GAMBAR BERDASARKAN DARI TABLE tb_posting
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_jumlah = "SELECT * FROM tb_photoposting  WHERE pemilik_photoposting = '".$ID."'";
$rs_jumlah = mysqli_query($koneksi, $query_rs_jumlah) or die(mysqli_error($koneksi));
$totalRows_rs_jumlah = mysqli_num_rows($rs_jumlah);

//SETIAP FORM DILAKUKAN PERULANGAN
for ($a = 1; $a <= $totalRows_rs_jumlah; $a++) {
	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formx$a")) {
	  $updateSQL = sprintf("UPDATE tb_posting SET  image_posting=%s WHERE id_posting=%s",
							
						   GetSQLValueString($koneksi, $_POST['image_posting'], "text"),
						   GetSQLValueString($koneksi, $colname_rs_posting, "int"));
	
	  mysqli_select_db($koneksi, $database_koneksi);
	  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
	  
	  if($Result1) {
	  echo "<script>document.location = '?page=informasi/update&post=".$colname_rs_posting."'
	  </script>";
	  }
	}
	
}

//MENGHAPUS GAMBAR DARI GALERI
for ($a = 1; $a <= $totalRows_rs_jumlah; $a++) {
	if ((isset($_POST["MM_delete"])) && ($_POST["MM_delete"] == "forxx$a")) {  
	  $deleteSQL = sprintf("DELETE FROM tb_photoposting WHERE id_photoposting=%s",
						   GetSQLValueString($koneksi, $_POST['id_photoposting'], "int"));
	
	  mysqli_select_db($koneksi, $database_koneksi);
	  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
	  
  	if($Result1) {
	  echo "<script>document.location = '?page=informasi/update&post=".$colname_rs_posting."'
	  </script>";
	  }
	}
}

//MENAMPILKAN GAMBAR SOAL BERDASARKAN ID SOAL
$colname_rs_soalfile = "-1";
if (isset($_GET['post'])) {
  $colname_rs_soalfile = $_GET['post'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_soalfile = sprintf("SELECT id_posting, image_posting FROM tb_posting WHERE id_posting = %s", GetSQLValueString($koneksi, $colname_rs_posting, "int"));
$rs_soalfile = mysqli_query($koneksi, $query_rs_soalfile) or die(mysqli_error($koneksi));
$row_rs_soalfile = mysqli_fetch_assoc($rs_soalfile);
$totalRows_rs_soalfile = mysqli_num_rows($rs_soalfile);

//MENAMPILKAN DAFTAR PHOTO UNTUK DITAMPILKAN DI MODAL
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_galeri = "SELECT * FROM tb_photoposting WHERE pemilik_photoposting = '".$ID."'";
$rs_galeri = mysqli_query($koneksi, $query_rs_galeri) or die(mysqli_error($koneksi));
$row_rs_galeri = mysqli_fetch_assoc($rs_galeri);
$totalRows_rs_galeri = mysqli_num_rows($rs_galeri);
?> 


<?php if ($totalRows_rs_galeri > 0) { // Show if recordset not empty ?>
 
   
  <?php $no = 1; do { ?>  
  <div class="col-md-2">
  
 
  <div class="box box-default">
	  <div class="box-body">  
       <form action="<?php echo $editFormAction; ?>" method="post" name="formx<?= $no; ?>">
           <img src="../feature_images/<?php echo $row_rs_galeri['images_photoposting']; ?>" alt="codeego" width="150px" height="200px" longdesc="http://www.codeego.com/" class="img">
           <input type="hidden" name="image_posting" value="<?php echo htmlentities($row_rs_galeri['images_photoposting'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
	    	<input type="submit" value="Jadikan Gambar Soal ini" class="btn btn-success btn-xs btn-block" />
    		<input type="hidden" name="MM_update" value="formx<?= $no; ?>" />
    		<input type="hidden" name="id_soal" value="<?php echo $row_rs_soalfile['id_soal']; ?>" />
	    </form>
        
            
    <form action="<?php echo $editFormAction; ?>" method="post" name="forxx<?= $no; ?>">
    <input type="submit" value="Hapus Gambar dari Galeri" class="btn btn-danger btn-xs btn-block" />
    <input name="id_photoposting" type="hidden" value="<?php echo $row_rs_galeri['id_photoposting']; ?>" />
    <input type="hidden" name="MM_delete" value="forxx<?= $no; ?>" />
    </form>

		</div>
	</div>
  </div>
    
   <?php 
  $no++;
  } while ($row_rs_galeri = mysqli_fetch_assoc($rs_galeri)); ?> 
 
<?php } ?>

