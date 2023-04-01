<?php  
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

  $gambar = upload('images_photo'); 	
  if(empty($gambar)) {
  	return false;
  }	
  //MEMASUKKAN GAMBAR
  $insertSQL = sprintf("INSERT INTO tb_photo (pemilik_photo, images_photo, cb_photo, tanggal_photo) VALUES (%s, %s,%s, %s)",
                       GetSQLValueString($koneksi, $ID, "int"),
					   GetSQLValueString($koneksi, $gambar, "text"),
					   GetSQLValueString($koneksi, $ID, "int"),
                       GetSQLValueString($koneksi, $tglsekarang, "date"));

					   
  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));	
  
  //MENGUBAH PHOTO PROFILE
  $updateSQL = sprintf("UPDATE tb_master SET photo_master=%s WHERE id_master=%s",
                       GetSQLValueString($koneksi, $gambar, "text"),
                       GetSQLValueString($koneksi, $ID, "int"));			   

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesan('success','Photo berhasil ditambahkan!');
}

//MENAMPILKAN JUMLAH GAMBAR PER ID 
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_jumlah = "SELECT * FROM tb_photo WHERE pemilik_photo = ".$ID."";
$rs_jumlah = mysqli_query($koneksi, $query_rs_jumlah) or die(mysqli_error($koneksi));
$totalRows_rs_jumlah = mysqli_num_rows($rs_jumlah);

for ($a = 1; $a <= $totalRows_rs_jumlah; $a++) {
	if ((isset($_POST["MM_update".$a])) && ($_POST["MM_update".$a] == "form".$a)) {
	  $updateSQL = sprintf("UPDATE tb_master SET photo_master=%s WHERE id_master=%s",
						   GetSQLValueString($koneksi, $_POST['photo'.$a], "text"),
						   GetSQLValueString($koneksi, $_POST['id_master'.$a], "int"));
	
	  mysqli_select_db($koneksi, $database_koneksi);
	  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
	  
	  pesanlink('Photo berhasil diubah','?page=insert/photo');
	} 
}

//MENAMPILKAN JUMLAH GAMBAR PER ID 
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_photos = "SELECT * FROM tb_photo WHERE pemilik_photo = ".$ID."";
$rs_photos = mysqli_query($koneksi, $query_rs_photos) or die(mysqli_error($koneksi));
$row_rs_photos = mysqli_fetch_assoc($rs_photos);
$totalRows_rs_photos = mysqli_num_rows($rs_photos);
?> 


<p><strong>Upload Photo</strong></p>
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="272" height="88">
    <tr valign="baseline">
      <td><input name="images_photo" type="file" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <td><input type="submit" value="Simpan Photo" class="btn btn-success btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>

<?php if ($totalRows_rs_photos > 0) { // Show if recordset not empty ?>
  <p>Pilih Dari Gallery</p>
  
  <div class="timeline-body">
   
  <?php $no = 1; do { ?>  
  <div class="col-md-3">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form<?= $no ?>">
  <div class="box box-default">
	  <div class="box-body">  
           <img src="../photos/<?php echo $row_rs_photos['images_photo']; ?>" alt="codeego" width="200" height="180"  longdesc="http://www.codeego.com/" class="margin">
           <input type="hidden" name="photo<?= $no; ?>" value="<?php echo $row_rs_photos['images_photo']; ?>" />
          
          <input type="submit" value="Jadikan Photo Profil" class="btn btn-success btn-xs btn-block" />
          <a onclick="return confirm('Yakin ingin menghapus photo ini? ');" href="?page=delete/hapus&id_photo=<?= $row_rs_photos['id_photo']; ?>&img=<?= $row_rs_photos['images_photo']; ?>" class="btn btn-danger btn-xs btn-block"><i class="fa fa-trash"></i> Hapus Photo</a>
          <input type="hidden" name="MM_update<?= $no; ?>" value="form<?= $no; ?>" />
          <input type="hidden" name="id_master<?= $no; ?>" value="<?php echo $ID; ?>" />
		</div>
	</div>
    </form>
  </div>
    
 <?php 
  $no++;
  } while($row_rs_photos = mysqli_fetch_assoc($rs_photos)); 
 ?>  
  	 
  
  
  </div>

  
  <?php }else{ // Show if recordset empty
  	pesan('danger','Oops! Belum ada gambar');
  } ?> 