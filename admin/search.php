<?php if ($totalRows_rs_search > 0) { // Show if recordset not empty ?>
  <p><?php echo $row_rs_search['nama_admin']; ?> ( <?php echo $row_rs_search['Login']; ?> )</p>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rs_search == 0) {  
	pesan('danger','Oops! Hasil tidak ditemukan!');
 } // Show if recordset empty ?>
