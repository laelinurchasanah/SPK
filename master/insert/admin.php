<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	//cek admin yang ada
	mysqli_select_db($koneksi, $database_koneksi);
	$query_rs_cek = sprintf("SELECT Login FROM tb_admin WHERE Login = %s",
					 GetSQLValueString($koneksi, $_POST['Login'], "text"));
	$rs_cek = mysqli_query($koneksi, $query_rs_cek) or die(mysqli_error($koneksi));
	$totalRows_rs_cek = mysqli_num_rows($rs_cek);
	
		//cek master yang ada
	mysqli_select_db($koneksi, $database_koneksi);
	$query_rs_cek = sprintf("SELECT Login FROM tb_master WHERE Login = %s",
					 GetSQLValueString($koneksi, $_POST['Login'], "text"));
	$rs_cek = mysqli_query($koneksi, $query_rs_cek) or die(mysqli_error($koneksi));
	$totalRows_rs_cek = mysqli_num_rows($rs_cek);
	
	if ($totalRows_rs_cek == 0) {
		  $insertSQL = sprintf("INSERT INTO tb_admin (Login, Password, nama_admin, gender_admin, address_admin, email_admin, hp_admin, photo_admin, `Level`, cb, key_admin) VALUES (%s, PASSWORD(%s), %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($koneksi, $_POST['Login'], "text"),
							   GetSQLValueString($koneksi, $_POST['Password'], "text"),
							   GetSQLValueString($koneksi, $_POST['nama_admin'], "text"),
							   GetSQLValueString($koneksi, $_POST['gender_admin'], "text"),
							   GetSQLValueString($koneksi, $_POST['address_admin'], "text"),
							   GetSQLValueString($koneksi, $_POST['email_admin'], "text"),
							   GetSQLValueString($koneksi, $_POST['hp_admin'], "text"),
							   GetSQLValueString($koneksi, $_POST['photo_admin'], "text"),
							   GetSQLValueString($koneksi, $_POST['Level'], "int"),
							   GetSQLValueString($koneksi, $_POST['cb'], "int"),
							   GetSQLValueString($koneksi, $_POST['key_admin'], "text"));
		
		  mysqli_select_db($koneksi, $database_koneksi);
		  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
		  
		  pesan('success','Admin Berhasil disimpan');
	}	  
}

//MENAMPILKAN DAFTAR ADMIN
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_admin = "SELECT * FROM tb_admin WHERE active_admin = 'Y' ORDER BY id_admin DESC";
$rs_admin = mysqli_query($koneksi, $query_rs_admin) or die(mysqli_error($koneksi));
$row_rs_admin = mysqli_fetch_assoc($rs_admin);
$totalRows_rs_admin = mysqli_num_rows($rs_admin);
?>

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

<div class="col-md-5">
<?php if (isset($totalRows_rs_cek) && ($totalRows_rs_cek > 0)) {
	pesan('danger','Oops! Username sudah dipakai oleh user lain!');
}
?>
<?php
	title('success','INSERT USER','Silahkan masukkan data user baru di bawah ini');
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="411" height="364">
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">Login </th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="Login" value="" class="form-control input-sm" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">Password</th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="password" name="Password" value="" class="form-control input-sm" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">Nama Lengkap</th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="nama_admin" value="" class="form-control input-sm" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">Gender</th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="gender_admin" value="L" <?php if (!(strcmp("L","L"))) {echo "CHECKED";} ?> />
            Laki-laki</td>
        </tr>
        <tr>
          <td><input type="radio" name="gender_admin" value="P" <?php if (!(strcmp("L","P"))) {echo "CHECKED";} ?> />
            Perempuan</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">Address</th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="address_admin" value="" class="form-control input-sm" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">Email</th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="email" name="email_admin" value="" class="form-control input-sm" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">No. Kontak</th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="number" name="hp_admin" value="" class="form-control input-sm" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">Level</th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><select class="form-control input-sm" name="Level" >
        <option value="1">Administrator</option>
        <option value="2">Operator</option>
        <option value="3">User</option>
         
      </select>      </td>
    </tr>
     
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">Key Pemulihan Sandi</th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="key_admin" value="" class="form-control input-sm" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <th nowrap="nowrap" align="right">&nbsp;</th>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Data" class="btn btn-success btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="photo_admin" value="default.png" />
  <input type="hidden" name="cb" value="<?= $ID; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form> 
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
              <td><?php echo $row_rs_admin['Login']; ?></td>
              <td><?php echo $row_rs_admin['nama_admin']; ?></td>
              <td><?php echo $row_rs_admin['hp_admin']; ?></td>
              <td><?php echo $row_rs_admin['Level']; ?></td>
              <td>
              <a href="?page=update/admin&id_admin=<?= $row_rs_admin['id_admin'];?>" class="btn btn-xs btn-warning" title="Edit"><span class="fa fa-edit"></span></a>
              <a onclick="return confirm('Hapus Admin <?= $row_rs_admin['id_admin']; ?>?');" href="?page=delete/hapus&id_admin=<?= $row_rs_admin['id_admin'];?>" class="btn btn-xs btn-danger" title="Hapus" ><span class="fa fa-trash"></span></a>              </td>
            </tr>
            <?php } while ($row_rs_admin = mysqli_fetch_assoc($rs_admin)); ?>
        </tbody>    
    </table> 
  </div>
</div>