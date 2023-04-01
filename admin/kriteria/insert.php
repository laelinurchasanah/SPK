<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO tb_kriteria (kode_kriteria, nama_kriteria, profile_ideal, faktor_id) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($koneksi, $_POST['kode_kriteria'], "text"),
                       GetSQLValueString($koneksi, $_POST['nama_kriteria'], "text"),
                       GetSQLValueString($koneksi, $_POST['profile_ideal'], "int"),
                       GetSQLValueString($koneksi, $_POST['faktor_id'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_kriteria (nama_kriteria, persen_kriteria) VALUES (%s, %s)",
                       GetSQLValueString($koneksi, $_POST['nama_kriteria'], "text"),
                       GetSQLValueString($koneksi, $_POST['persen_kriteria'], "double"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesan('success','Faktor berhasil ditambahkan');
  }
}

$maxRows_rs_kriteria = 10;
$pageNum_rs_kriteria = 0;
if (isset($_GET['pageNum_rs_kriteria'])) {
  $pageNum_rs_kriteria = $_GET['pageNum_rs_kriteria'];
}
$startRow_rs_kriteria = $pageNum_rs_kriteria * $maxRows_rs_kriteria;

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_kriteria = "SELECT id_kriteria, kode_kriteria, nama_kriteria, nama_faktor, profile_ideal FROM tb_kriteria JOIN tb_faktor ON faktor_id = id_faktor";
$query_limit_rs_kriteria = sprintf("%s LIMIT %d, %d", $query_rs_kriteria, $startRow_rs_kriteria, $maxRows_rs_kriteria);
$rs_kriteria = mysqli_query($koneksi, $query_limit_rs_kriteria) or die(mysqli_error($koneksi));
$row_rs_kriteria = mysqli_fetch_assoc($rs_kriteria);

if (isset($_GET['totalRows_rs_kriteria'])) {
  $totalRows_rs_kriteria = $_GET['totalRows_rs_kriteria'];
} else {
  $all_rs_kriteria = mysqli_query($koneksi, $query_rs_kriteria);
  $totalRows_rs_kriteria = mysqli_num_rows($all_rs_kriteria);
}
$totalPages_rs_kriteria = ceil($totalRows_rs_kriteria/$maxRows_rs_kriteria)-1;

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_faktor = "SELECT * FROM tb_faktor";
$rs_faktor = mysqli_query($koneksi, $query_rs_faktor) or die(mysqli_error($koneksi));
$row_rs_faktor = mysqli_fetch_assoc($rs_faktor);
$totalRows_rs_faktor = mysqli_num_rows($rs_faktor);
?>

<div class="col-md-6">

<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table width="100%" height="200">
    <tr valign="top">
      <td width="12%" align="right" nowrap="nowrap">Kode Kriteria</td>
      <td width="2%" align="right" nowrap="nowrap">&nbsp;</td>
      <td width="86%"><input type="text" name="kode_kriteria" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="top">
      <td nowrap="nowrap" align="right">Nama Kriteria</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="nama_kriteria" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="top">
      <td nowrap="nowrap" align="right">Bagian Faktor</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><select name="faktor_id" class="form-control input-sm">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_faktor['id_faktor']?>" ><?php echo $row_rs_faktor['nama_faktor']?></option>
        <?php
} while ($row_rs_faktor = mysqli_fetch_assoc($rs_faktor));
?>
      </select>      </td>
    </tr>
    <tr valign="top">
      <td nowrap="nowrap" align="right">Set Profile Ideal</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="profile_ideal" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="top">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Kriteria" class="btn btn-primary btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form2" />
</form>
<p>&nbsp;</p>
</div>
<div class="col-md-6">
<?php if ($totalRows_rs_kriteria > 0) { ?>
<?php
	title('info','DAFTAR KRITERIA','Berikut ini daftar kriteria yang telah ditambahkan');
?>
<table width="10%" class="table table-striped table-bordered table-hover">
<thead>
  <tr>
    <th>NO.</th>
    <th>KODE</th>
    <th>NAMA KRITERIA</th>
    <th>FAKTOR</th>
    <th>PROFILE IDEAL</th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  <?php $no = 1; do { ?>
    <tr>
      <td><a href="?page=kriteria/update&amp;id_kriteria=<?php echo $row_rs_kriteria['id_kriteria']; ?>"><?php echo $no; ?></a></td>
      <td><?php echo $row_rs_kriteria['kode_kriteria']; ?></td>
      <td><?php echo $row_rs_kriteria['nama_kriteria']; ?></td>
      <td><?php echo $row_rs_kriteria['nama_faktor']; ?></td>   
      <td><?php echo $row_rs_kriteria['profile_ideal']; ?></td>      
      <td><a href="?page=kriteria/delete&amp;id_kriteria=<?php echo $row_rs_kriteria['id_kriteria']; ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Hapus</a></td>
    </tr>
    <?php 
	$no++;
	} while ($row_rs_kriteria = mysqli_fetch_assoc($rs_kriteria)); ?>
    </tbody>
</table>
<?php }else{

	pesan('danger','<strong>Oops!</strong> Data kriteria belum ditambahkan');
} ?>
</div>
 