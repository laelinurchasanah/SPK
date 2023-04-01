<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

 if (empty($_POST['Password'])) {
	 $updateSQL = sprintf("UPDATE tb_admin SET  nama_admin=%s, gender_admin=%s, address_admin=%s, email_admin=%s, hp_admin=%s, `Level`=%s, active_admin=%s, key_admin=%s, ut=%s WHERE id_admin=%s",
						    
						   GetSQLValueString($koneksi, $_POST['nama_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['gender_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['address_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['email_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['hp_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['Level'], "int"),
						   GetSQLValueString($koneksi, $_POST['active_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['key_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['ut'], "date"),
						   GetSQLValueString($koneksi, $_POST['id_admin'], "int"));
	
	  mysqli_select_db($koneksi, $database_koneksi);
	  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
	  
	  pesan('success','Sukses! Data Berhasil disimpan tanpa password');
 }else{
	  $updateSQL = sprintf("UPDATE tb_admin SET Password=PASSWORD(%s), nama_admin=%s, gender_admin=%s, address_admin=%s, email_admin=%s, hp_admin=%s, `Level`=%s, active_admin=%s, key_admin=%s, ut=%s WHERE id_admin=%s",
						   GetSQLValueString($koneksi, $_POST['Password'], "text"),
						   GetSQLValueString($koneksi, $_POST['nama_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['gender_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['address_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['email_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['hp_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['Level'], "int"),
						   GetSQLValueString($koneksi, $_POST['active_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['key_admin'], "text"),
						   GetSQLValueString($koneksi, $_POST['ut'], "date"),
						   GetSQLValueString($koneksi, $_POST['id_admin'], "int"));
	
	  mysqli_select_db($koneksi, $database_koneksi);
	  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
	  
	  pesan('success','Sukses! Data Berhasil disimpan beserta password');
  }
}

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_editadmin = "SELECT * FROM tb_admin WHERE active_admin = 'Y'";
$rs_editadmin = mysqli_query($koneksi, $query_rs_editadmin) or die(mysqli_error($koneksi));
$row_rs_editadmin = mysqli_fetch_assoc($rs_editadmin);
$totalRows_rs_editadmin = mysqli_num_rows($rs_editadmin);

$colname_rs_admin = "-1";
if (isset($_GET['id_admin'])) {
  $colname_rs_admin = $_GET['id_admin'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_admin = sprintf("SELECT * FROM tb_admin WHERE id_admin = %s AND active_admin = 'Y'", GetSQLValueString($koneksi, $colname_rs_admin, "int"));
$rs_admin = mysqli_query($koneksi, $query_rs_admin) or die(mysqli_error($koneksi));
$row_rs_admin = mysqli_fetch_assoc($rs_admin);
$totalRows_rs_admin = mysqli_num_rows($rs_admin);

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_level = "SELECT * FROM tb_level ORDER BY id_level ASC";
$rs_level = mysqli_query($koneksi, $query_rs_level) or die(mysqli_error($koneksi));
$row_rs_level = mysqli_fetch_assoc($rs_level);
$totalRows_rs_level = mysqli_num_rows($rs_level);
?> 
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div class="col-md-5">
<?php if ($totalRows_rs_admin > 0) { ?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="358" height="373">
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">Password</th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td><input type="password" name="Password" value="" class="form-control input-sm" size="32"/></td>
    </tr>
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">Nama Lengkap</th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td><input type="text" name="nama_admin" value="<?php echo htmlentities($row_rs_admin['nama_admin'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" required/></td>
    </tr>
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">Gender</th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="gender_admin" value="L" <?php if (!(strcmp(htmlentities($row_rs_admin['gender_admin'], ENT_COMPAT, 'utf-8'),"L"))) {echo "CHECKED";} ?> />
            Laki-laki</td>
        </tr>
        <tr>
          <td><input type="radio" name="gender_admin" value="P" <?php if (!(strcmp(htmlentities($row_rs_admin['gender_admin'], ENT_COMPAT, 'utf-8'),"P"))) {echo "CHECKED";} ?> />
            Perempuan</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">Address</th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td><input type="text" name="address_admin" value="<?php echo htmlentities($row_rs_admin['address_admin'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" required/></td>
    </tr>
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">Email </th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td><input type="text" name="email_admin" value="<?php echo htmlentities($row_rs_admin['email_admin'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" required/></td>
    </tr>
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">Kontak</th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td><input type="text" name="hp_admin" value="<?php echo htmlentities($row_rs_admin['hp_admin'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" required/></td>
    </tr>
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">Level</th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td><select class="form-control input-sm" name="Level" class="form-control input-sm">
        <?php
do {  
?>
        <option value="<?php echo $row_rs_level['id_level']?>"<?php if (!(strcmp($row_rs_level['id_level'], htmlentities($row_rs_admin['Level'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_level['nama_level']?></option>
        <?php
} while ($row_rs_level = mysqli_fetch_assoc($rs_level));
  $rows = mysqli_num_rows($rs_level);
  if($rows > 0) {
      mysqli_data_seek($rs_level, 0);
	  $row_rs_level = mysqli_fetch_assoc($rs_level);
  }
?>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">Status</th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td><select class="form-control input-sm" name="active_admin" class="form-control input-sm">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_admin['active_admin'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Aktif</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_admin['active_admin'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Blok</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">Pemulihan Sandi</th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td><input type="text" name="key_admin" value="<?php echo htmlentities($row_rs_admin['key_admin'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" required/></td>
    </tr>
    <tr valign="baseline">
      <th align="right" valign="top" nowrap="nowrap">&nbsp;</th>
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="ut" value="<?php echo htmlentities($tglsekarang, ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_admin" value="<?php echo $row_rs_admin['id_admin']; ?>" />
</form> 
<?php  }else{
	pesanlink('Kami melihat hal yang mencurigakan, untuk itu demi kenyamanan bersama silahkan Anda keluar dulu ya','../keluar.php');
}

?>

</div>
<div class="col-md-7">
  <div class="table-responsive">
    <table width="100%" class="table table-striped table-bordered table-hover small" id="example1">
        <thead>
          <tr bgcolor="#663366">
            <th><span class="style1">NO.</span></th>
            <th><span class="style1">Login</span></th>
            <th><span class="style1">Fullname</span></th>
            <th><span class="style1">Contact</span></th>
            <th><span class="style1">Level</span></th>
            <th><span class="style1">Action</span></th>
          </tr>
 		</thead>
        <tbody>  
          <?php $no = 1; do { ?>
            <tr>
              <td align="center"><?php echo $no++; ?></td>
              <td><?php echo $row_rs_editadmin['Login']; ?></td>
              <td><?php echo $row_rs_editadmin['nama_admin']; ?></td>
              <td><?php echo $row_rs_editadmin['hp_admin']; ?></td>
              <td><?php echo $row_rs_editadmin['Level']; ?></td>
              <td>
              <a href="?page=update/admin&id_admin=<?= $row_rs_editadmin['id_admin'];?>" class="btn btn-xs btn-warning" title="Edit"><span class="fa fa-edit"></span></a>
              <a onclick="return confirm('Hapus Admin <?= $row_rs_editadmin['id_admin']; ?>?');" href="?page=delete/hapus&id_admin=<?= $row_rs_editadmin['id_admin'];?>" class="btn btn-xs btn-danger" title="Hapus" ><span class="fa fa-trash"></span></a>              </td>
            </tr>
            <?php } while ($row_rs_editadmin = mysqli_fetch_assoc($rs_editadmin)); ?>
        </tbody>    
    </table> 
  </div>
</div>