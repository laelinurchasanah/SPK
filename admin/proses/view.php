<?php   
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  for ($a = 1; $a <= $_POST['id_tempbobot']; $a++) {
  $insertSQL = sprintf("UPDATE tb_alternatif SET nilai_akhir=%s WHERE id_alternatif=%s",
                       GetSQLValueString($koneksi, $_POST['name'.$a], "double"),
                       GetSQLValueString($koneksi, $_POST['id_tempbobot'.$a], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
  }
  
  echo "
  <script>
  	document.location = '?page=proses/result';
  </script>
  ";
}
//function
function nilaibobot($gap){
		if ($gap == 0) {
			$nilai = 5;
			return $nilai;
		}elseif ($gap == 1) {
			$nilai = 4.5;
			return $nilai;
		}elseif ($gap == -1) {
			$nilai = 4;
			return $nilai;
		}elseif ($gap == 2) {
			$nilai = 3.5;
			return $nilai;
		}elseif ($gap == -2) {
			$nilai = 3;
			return $nilai;
		}elseif ($gap == 3) {
			$nilai = 2.5;
			return $nilai;
		}elseif ($gap == -3) {
			$nilai = 2;
			return $nilai;
		}elseif ($gap == 4) {
			$nilai = 1.5;
			return $nilai;
		}elseif ($gap == -4) {
			$nilai = 1;
			return $nilai;
		}else{
			return "Oops! Error";
		}
	}
//-----------
 
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_alternatif = "SELECT * FROM tb_alternatif ORDER BY id_alternatif ASC";
$rs_alternatif = mysqli_query($koneksi, $query_rs_alternatif) or die(mysqli_error($koneksi));
$rs_alternatif2 = mysqli_query($koneksi, $query_rs_alternatif) or die(mysqli_error($koneksi));
$rs_alternatif3 = mysqli_query($koneksi, $query_rs_alternatif) or die(mysqli_error($koneksi));
$rs_alternatif4 = mysqli_query($koneksi, $query_rs_alternatif) or die(mysqli_error($koneksi));
$row_rs_alternatif = mysqli_fetch_assoc($rs_alternatif);
$row_rs_alternatif2 = mysqli_fetch_assoc($rs_alternatif2);
$row_rs_alternatif3 = mysqli_fetch_assoc($rs_alternatif3);
$row_rs_alternatif4 = mysqli_fetch_assoc($rs_alternatif4);
$totalRows_rs_alternatif = mysqli_num_rows($rs_alternatif);


mysqli_select_db($koneksi, $database_koneksi);
$query_rs_kriteria = "SELECT id_kriteria, kode_kriteria, nama_kriteria, faktor_id FROM tb_kriteria";
$rs_kriteria = mysqli_query($koneksi, $query_rs_kriteria) or die(mysqli_error($koneksi));
$row_rs_kriteria  = mysqli_fetch_assoc($rs_kriteria);
$rs_kriteria2 = mysqli_query($koneksi, $query_rs_kriteria) or die(mysqli_error($koneksi));
$row_rs_kriteria2 = mysqli_fetch_assoc($rs_kriteria2);
$totalRows_rs_kriteria = mysqli_num_rows($rs_kriteria);

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_kriteria3 = "SELECT COUNT(faktor_id) as faktor, persen_faktor FROM `tb_kriteria` INNER JOIN tb_faktor ON faktor_id = id_faktor GROUP BY faktor_id";
$rs_kriteria3 = mysqli_query($koneksi, $query_rs_kriteria3) or die(mysqli_error($koneksi));
$row_rs_kriteria3 = mysqli_fetch_assoc($rs_kriteria3);

do {
	$faktorku[] = $row_rs_kriteria3['faktor'];
	$persen[] = $row_rs_kriteria3['persen_faktor'] / 100;
} while($row_rs_kriteria3 = mysqli_fetch_assoc($rs_kriteria3));

do {
	$id_kriteria[] = $row_rs_kriteria['id_kriteria'];
	$kode_kriteria[] = $row_rs_kriteria['kode_kriteria'];
	$faktor[] = $row_rs_kriteria['faktor_id'];	
} while($row_rs_kriteria = mysqli_fetch_assoc($rs_kriteria));
?>

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

<p><?php 
 pesan('success','<b>NILAI BOBOT</b>');
 ?> </p>
 <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <input type="submit" value="Simpan dan Lihat Ranking" class="btn btn-danger btn-lg btn-block">
 <div class="table-responsive">
<table width="100%" class="table table-striped table-bordered">
<thead>
   <tr bgcolor="#003366">
    <th><span class="style1">NO.</span></th>
    <th><span class="style1">NAMA ALTERNATIF</span></th>
    <?php for ($a = 0; $a < $totalRows_rs_kriteria; $a++ ) {  ?>
    <th bgcolor="#FF6600"><span class="style1"><?php echo $kode_kriteria[$a]; ?></span></th>
    
    <?php }  ?>
    </tr>
    </thead>
   <tbody>
  <?php $no = 1; do { ?>
    <tr>
      <td align="center"><?php echo $no; ?></td>
      <td><?php echo $row_rs_alternatif['nama_alternatif']; ?></td>
      <?php
	  $total = 0; 
	   for ($a = 0; $a < $totalRows_rs_kriteria; $a++ ) { 
	  
		mysqli_select_db($koneksi, $database_koneksi);
		$query_rs_bobot =  sprintf("SELECT nilai_bobot FROM tb_bobot INNER JOIN tb_kriteria ON kriteria_id = id_kriteria WHERE alternatif_id = %s AND kriteria_id = %s", 
										GetSQLValueString($koneksi, $row_rs_alternatif['id_alternatif'], "int"),
										GetSQLValueString($koneksi, $id_kriteria[$a], "int"));
		$rs_bobot = mysqli_query($koneksi, $query_rs_bobot) or die(mysqli_error($koneksi));
		$row_rs_bobot = mysqli_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysqli_num_rows($rs_bobot);
	  ?>
	  <td><div align="center">
	    <?= $row_rs_bobot['nilai_bobot']; ?> 
	    </div></td>
      <?php 
	  	 
	  } ?>
      </tr>
	 <?php 
	$no++;
	} while ($row_rs_alternatif = mysqli_fetch_assoc($rs_alternatif)); ?>      
    <tr>
      <td colspan="2" align="center"><strong>PROFILE IDEAL</strong></td>
      <?php for ($a = 0; $a < $totalRows_rs_kriteria; $a++ ) {  
	  mysqli_select_db($koneksi, $database_koneksi);
		$query_rs_bobot =  sprintf("SELECT profile_ideal FROM tb_kriteria WHERE id_kriteria = %s",  GetSQLValueString($koneksi, $id_kriteria[$a], "int"));
		$rs_bobot = mysqli_query($koneksi, $query_rs_bobot) or die(mysqli_error($koneksi));
		$row_rs_bobot = mysqli_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysqli_num_rows($rs_bobot);
	  ?>
      	<td><div align="center">
      	  <?= $row_rs_bobot['profile_ideal']; ?>
          <?php $ar_max[] = $row_rs_bobot['profile_ideal']; ?>
    	  </div></td>
      <?php } ?>
    </tr>
    </tbody>
 </table> 
</div>
 
 <p><?php 
 pesan('success','<b>NILAI GAP</b>');
 ?> </p>
 <div class="table-responsive">
<table width="100%" class="table table-striped table-bordered">
<thead>
   <tr bgcolor="#003366">
    <th><span class="style1">NO.</span></th>
    <th><span class="style1">NAMA ALTERNATIF</span></th>
    <?php for ($a = 0; $a < $totalRows_rs_kriteria; $a++ ) {  ?>
    <th bgcolor="#FF6600"><span class="style1">GAP</span></th>
    <th><span class="style1">Bobot</span></th>
    <?php }  ?>
    </tr>
    </thead>
   <tbody>
  <?php $no = 1; do { ?>
    <tr>
      <td align="center"><?php echo $no; ?></td>
      <td><?php echo $row_rs_alternatif2['nama_alternatif']; ?></td>
      <?php
	    for ($a = 0; $a < $totalRows_rs_kriteria; $a++ ) { 

		mysqli_select_db($koneksi, $database_koneksi);
		$query_rs_bobot =  sprintf("SELECT nilai_bobot, faktor_id FROM tb_bobot INNER JOIN tb_kriteria ON kriteria_id = id_kriteria WHERE alternatif_id = %s AND kriteria_id = %s", 
										GetSQLValueString($koneksi, $row_rs_alternatif2['id_alternatif'], "int"),
										GetSQLValueString($koneksi, $id_kriteria[$a], "int"));
		$rs_bobot = mysqli_query($koneksi, $query_rs_bobot) or die(mysqli_error($koneksi));
		$row_rs_bobot = mysqli_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysqli_num_rows($rs_bobot);
	  ?>
	  <td><div align="center">
	    <?php $gap = $row_rs_bobot['nilai_bobot'] - $ar_max[$a]; echo $gap; ?> 
	    </div></td>
      <td><div align="center">
      <?php  
			echo nilaibobot($gap);  
		?>
      </div></td>  
      <?php } 
	   
	  ?>
      </tr>
    <?php 
	$no++;
	} while ($row_rs_alternatif2 = mysqli_fetch_assoc($rs_alternatif2)); ?>
    </tbody>
 </table> 
 </div>
<p></p>
<p></p> 
<div class="row">
<div class="col-md-6">
<div class="table-responsive">
<table width="100%" class="table table-striped table-bordered">
<thead>
   <tr bgcolor="#003366">
    <th><span class="style1">NO.</span></th>
    <th><span class="style1">NAMA ALTERNATIF</span></th>
    <th><div align="center" class="style1">CF</div></th>
    <th><div align="center" class="style1">SF</div></th>
    <th><div align="center" class="style1">NILAI AKHIR</div></th>
   </tr>
    </thead>
   <tbody>
  <?php $no = 1; do { ?>
    <tr>
      <td align="center"><?php echo $no; ?></td>
      <td><?php echo $row_rs_alternatif3['nama_alternatif']; ?></td>
      <td><div align="center">
	  <?php
	   $total = 0;
	   for ($a = 0; $a < $totalRows_rs_kriteria; $a++ ) { 

		mysqli_select_db($koneksi, $database_koneksi);
		$query_rs_bobot =  sprintf("SELECT nilai_bobot, faktor_id FROM tb_bobot INNER JOIN tb_kriteria ON kriteria_id = id_kriteria WHERE alternatif_id = %s AND kriteria_id = %s", 
										GetSQLValueString($koneksi, $row_rs_alternatif3['id_alternatif'], "int"),
										GetSQLValueString($koneksi, $id_kriteria[$a], "int"));
		$rs_bobot = mysqli_query($koneksi, $query_rs_bobot) or die(mysqli_error($koneksi));
		$row_rs_bobot = mysqli_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysqli_num_rows($rs_bobot);
	  ?>
	    <?php $gap = $row_rs_bobot['nilai_bobot'] - $ar_max[$a]; ?> 
	     
      <?php if ($row_rs_bobot['faktor_id'] == 1) { 
			$total += nilaibobot($gap);  
		}	 
	 }	
	 echo $cf = $total / $faktorku[0];
	  ?>      </td>  
      <td>
      <?php
	   $total = 0;
	   for ($a = 0; $a < $totalRows_rs_kriteria; $a++ ) { 

		mysqli_select_db($koneksi, $database_koneksi);
		$query_rs_bobot =  sprintf("SELECT nilai_bobot, faktor_id FROM tb_bobot INNER JOIN tb_kriteria ON kriteria_id = id_kriteria WHERE alternatif_id = %s AND kriteria_id = %s", 
										GetSQLValueString($koneksi, $row_rs_alternatif3['id_alternatif'], "int"),
										GetSQLValueString($koneksi, $id_kriteria[$a], "int"));
		$rs_bobot = mysqli_query($koneksi, $query_rs_bobot) or die(mysqli_error($koneksi));
		$row_rs_bobot = mysqli_fetch_assoc($rs_bobot);
		$totalRows_rs_bobot = mysqli_num_rows($rs_bobot);
	  ?>
	    <?php $gap = $row_rs_bobot['nilai_bobot'] - $ar_max[$a]; ?> 
	     
      <?php if ($row_rs_bobot['faktor_id'] == 2) { 
			$total += nilaibobot($gap);  
		}	 
	 }	
	 echo $sf = $total / $faktorku[1];
	  ?>      </td>
       
	  <td><?php 
	  	$hasil = ($cf*$persen[0])+($sf*$persen[1]);
		echo $hasil;
	  ?>
      <input type="hidden" name="name<?= $no;?>" value="<?php echo number_format($hasil,2); ?>" />
      <input type="hidden" name="id_tempbobot<?= $no; ?>" value="<?= $no;?>" />
      </td>
    </tr>
    <?php 
	$no++;
	} while ($row_rs_alternatif3 = mysqli_fetch_assoc($rs_alternatif3)); ?>
    </tbody>
 </table> 
 </div>
</div>
<div class="col-md-6">

</div> 
</div>
 <input type="hidden" name="id_tempbobot" value="<?= $totalRows_rs_alternatif;?>" />
 <input type="submit" value="Simpan dan Lihat Ranking" class="btn btn-danger btn-lg btn-block">
 <input type="hidden" name="MM_update" value="form1" />
 
<p></p>
 <p></p>
</form>