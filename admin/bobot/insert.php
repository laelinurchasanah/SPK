<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  for ($a = 1; $a <= $_POST['jumlahkriteria']; $a++) {
  $insertSQL = sprintf("UPDATE tb_bobot SET nilai_bobot=%s WHERE kriteria_id=%s AND alternatif_id=%s",
                       GetSQLValueString($koneksi, $_POST['nilai_bobot'.$a], "int"),
                       GetSQLValueString($koneksi, $_POST['kriteria_id'.$a], "int"),
                       GetSQLValueString($koneksi, $_GET['id_alternatif'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
  }
  if ($Result1) {
  	echo "<script>
	document.location = '?page=alternatif/insert';
	</script>";
  }
}
  
$colname_rs_kriteria = "-1";
if (isset($_GET['faktor_id'])) {
  $colname_rs_kriteria = $_GET['faktor_id'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_kriteria = sprintf("SELECT * FROM tb_kriteria WHERE faktor_id = %s", GetSQLValueString($koneksi, $colname_rs_kriteria, "int"));
$rs_kriteria = mysqli_query($koneksi, $query_rs_kriteria) or die(mysqli_error($koneksi));
$row_rs_kriteria = mysqli_fetch_assoc($rs_kriteria);
$rs_kriteria2 = mysqli_query($koneksi, $query_rs_kriteria) or die(mysqli_error($koneksi));
$row_rs_kriteria2 = mysqli_fetch_assoc($rs_kriteria2);
$totalRows_rs_kriteria = mysqli_num_rows($rs_kriteria);

//total kriteira
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_kriterias = "SELECT id_kriteria FROM tb_kriteria";
$rs_kriterias = mysqli_query($koneksi, $query_rs_kriterias) or die(mysqli_error($koneksi));
$row_rs_kriterias = mysqli_fetch_assoc($rs_kriterias);
$totalRows_rs_kriterias = mysqli_num_rows($rs_kriterias);
//-----------

$colname_rs_alternatif = "-1";
if (isset($_GET['id_alternatif'])) {
  $colname_rs_alternatif = $_GET['id_alternatif'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_alternatif = sprintf("SELECT * FROM tb_alternatif WHERE id_alternatif = %s", GetSQLValueString($koneksi, $colname_rs_alternatif, "int"));
$rs_alternatif = mysqli_query($koneksi, $query_rs_alternatif) or die(mysqli_error($koneksi));
$row_rs_alternatif = mysqli_fetch_assoc($rs_alternatif);
$totalRows_rs_alternatif = mysqli_num_rows($rs_alternatif); 

//MENYIMPAN OTOMATIS NILAI BOBOT
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_cek = sprintf("SELECT alternatif_id FROM tb_bobot WHERE alternatif_id = %s", GetSQLValueString($koneksi, $colname_rs_alternatif, "int"));
$rs_cek = mysqli_query($koneksi, $query_rs_cek) or die(mysqli_error($koneksi));
$totalRows_rs_cek = mysqli_num_rows($rs_cek);

if ($totalRows_rs_kriterias > 0) { 
	if ($totalRows_rs_cek == 0) {
		 do {
		  $insertSQL = sprintf("INSERT INTO tb_bobot (kriteria_id, alternatif_id) VALUES (%s, %s)",
							   GetSQLValueString($koneksi, $row_rs_kriterias['id_kriteria'], "int"),
							   GetSQLValueString($koneksi, $colname_rs_alternatif, "int"));
							   
		  mysqli_select_db($koneksi, $database_koneksi);
		  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
		} while ($row_rs_kriterias = mysqli_fetch_assoc($rs_kriterias));
	}
}else{
	pesanlink('Data kriteria masih kosong, silahkan isi!','?page=kriteria/insert');
}
//------------------

?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<?php if ($totalRows_rs_kriteria > 0) { ?>
<p><strong>BERIKAN NILAI BOBOT UNTUK ALTERNATIF &quot;<?php echo $row_rs_alternatif['nama_alternatif']; ?> (<?php echo $row_rs_alternatif['id_alternatif']; ?>)&quot;</strong></p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table width="100%" class="table table-striped table-bordered">
        <thead>
          <tr bgcolor="#003366">
            <th width="5%"><span class="style1">NO.</span></th>
            <th width="67%"><span class="style1">NAMA</span></th>
            <th width="28%"><span class="style1">NILAI BOBOT</span></th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; do { 
		  //MENGAMBIL NILAI BOBOT
			mysqli_select_db($koneksi, $database_koneksi);
			$query_rs_bobot = sprintf("SELECT nilai_bobot FROM tb_bobot WHERE alternatif_id = %s AND kriteria_id = %s", 
										GetSQLValueString($koneksi, $row_rs_alternatif['id_alternatif'], "int"),
										GetSQLValueString($koneksi, $row_rs_kriteria['id_kriteria'], "int"));
			$rs_bobot = mysqli_query($koneksi, $query_rs_bobot) or die(mysqli_error($koneksi));
			$row_rs_bobot = mysqli_fetch_assoc($rs_bobot);
			$totalRows_rs_bobot = mysqli_num_rows($rs_bobot);
		  ?>
          <tr>
            <td align="center"><a href="?page=kriteria/update&id_kriteria=<?php echo $row_rs_kriteria['id_kriteria']; ?>"><?php echo $no; ?></a></td>
            <td><?php echo $row_rs_kriteria['nama_kriteria']; ?></td>
            <td>
                <input type="hidden" name="kriteria_id<?= $no;?>" value="<?php echo $row_rs_kriteria['id_kriteria']; ?>" size="32">
                <input type="text" name="nilai_bobot<?= $no;?>" value="<?php echo $row_rs_bobot['nilai_bobot']; ?>" size="32">
            </td>
          </tr>
          <?php 
		  $no++;
		  } while ($row_rs_kriteria = mysqli_fetch_assoc($rs_kriteria)); ?>
          <tr>
            <td height="43" colspan="3" align="center"><input type="submit" value="Simpan Nilai" class="btn btn-primary btn-block"></td>
          </tr>
        </tbody>
      </table>
      <input type="hidden" name="jumlahkriteria" value="<?php echo $totalRows_rs_kriteria; ?>"> 
      <input type="hidden" name="MM_insert" value="form1">
    </form> 
<?php }else{
pesanlink('Data kriteria masih kosong, silahkan isi!','?page=kriteria/insert');
}
?>     