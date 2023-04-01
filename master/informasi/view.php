<?php  

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs_posting = 10;
$pageNum_rs_posting = 0;
if (isset($_GET['pageNum_rs_posting'])) {
  $pageNum_rs_posting = $_GET['pageNum_rs_posting'];
}
$startRow_rs_posting = $pageNum_rs_posting * $maxRows_rs_posting;

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_posting = "SELECT id_posting, title_posting, image_posting, Nama, ct_posting, cb_posting, waktuawal_posting, active_posting FROM tb_posting 
INNER JOIN vw_login ON cb_posting = ID
WHERE active_posting = 'Y' OR active_posting = 'P' ORDER BY id_posting DESC";
$query_limit_rs_posting = sprintf("%s LIMIT %d, %d", $query_rs_posting, $startRow_rs_posting, $maxRows_rs_posting);
$rs_posting = mysqli_query($koneksi, $query_limit_rs_posting) or die(mysqli_error($koneksi));
$row_rs_posting = mysqli_fetch_assoc($rs_posting);

if (isset($_GET['totalRows_rs_posting'])) {
  $totalRows_rs_posting = $_GET['totalRows_rs_posting'];
} else {
  $all_rs_posting = mysqli_query($koneksi, $query_rs_posting);
  $totalRows_rs_posting = mysqli_num_rows($all_rs_posting);
}
$totalPages_rs_posting = ceil($totalRows_rs_posting/$maxRows_rs_posting)-1;

$queryString_rs_posting = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_posting") == false && 
        stristr($param, "totalRows_rs_posting") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_posting = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_posting = sprintf("&totalRows_rs_posting=%d%s", $totalRows_rs_posting, $queryString_rs_posting);
?> 


<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {color: #CC0000}
-->
</style>
</head>

<body>
<?php
	$hapus = "-1";
	if (isset($hapus) && ($hapus == 'true')) {
		pesan('danger','Informasi berhasil dihapus'); 
	}
?>
<a href="?page=informasi/view" class="btn btn-success"><span class="fa fa-table"></span> Kembali</a> <a href="?page=informasi/insert" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Add Posting</a>
<br><br>

<?php if ($totalRows_rs_posting > 0) { ?>
<div class="table-responsive">
<table width="300" height="41" border="0">
  <tr>
    <td><?php if ($pageNum_rs_posting > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs_posting=%d%s", $currentPage, 0, $queryString_rs_posting); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rs_posting > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs_posting=%d%s", $currentPage, max(0, $pageNum_rs_posting - 1), $queryString_rs_posting); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rs_posting < $totalPages_rs_posting) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs_posting=%d%s", $currentPage, min($totalPages_rs_posting, $pageNum_rs_posting + 1), $queryString_rs_posting); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rs_posting < $totalPages_rs_posting) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs_posting=%d%s", $currentPage, $totalPages_rs_posting, $queryString_rs_posting); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</p>
 
<table width="100%" class="table table-striped table-hover" id="example1">
  <thead>
  <tr align="center" bgcolor="#006699">
    <th width="5%"><span class="style1">No.</span></th>
    <th width="73%"><span class="style1">TITLE</span></th>
    <th width="16%"><span class="style1">GAMBAR UTAMA</span></th>
    <th width="6%"><span class="style1">STATUS</span></th>
  </tr>
  </thead>
  <tbody>
  <?php $no = 1; do { ?>
    <tr>
      <td align="center" valign="middle"><?php echo $no++; ?></td>
      <td> <strong><?php echo $row_rs_posting['title_posting']; ?></strong> <br>

      by <?php echo $row_rs_posting['Nama']; ?> - created <?php echo $row_rs_posting['waktuawal_posting']; ?></h2>
      <br>
      <a href="?page=informasi/update&post=<?= $row_rs_posting['id_posting']?>" class="btn btn-xs btn-warning"><span class="fa fa-edit"></span> Ubah</a> 
<a onClick="return confirm('Anda yakin ingin menghapus postingan <?= $row_rs_posting['title_posting']?>');" href="?page=informasi/delete&post=<?= $row_rs_posting['id_posting']; ?>"  class="btn btn-xs btn-danger" ><span class="fa fa-trash"></span> Hapus</a></td>
      <td>
	  <?php if (!empty($row_rs_posting['image_posting'])) { ?>
	  		<img src="../feature_images/<?= $row_rs_posting['image_posting']; ?>" class="img-responsive">
	  <?php }else{ ?>
      		<img src="../feature_images/default.png" class="img-responsive">
      <?php } ?>	  </td>
      <td><?php if($row_rs_posting['active_posting'] == "P") {
	  	echo "<span class='style2'><i>Daftar</i></span>";
	  }elseif ($row_rs_posting['active_posting'] == "Y"){
	  	echo "Posting";
	  }else{
	  	echo "<span class='style2'>Block</span>";
	  } ?></td>
    </tr>
    <?php } while ($row_rs_posting = mysqli_fetch_assoc($rs_posting)); ?>
  </tbody>
</table>
<table width="305" height="62" border="0">
  <tr>
    <td><?php if ($pageNum_rs_posting > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_posting=%d%s", $currentPage, 0, $queryString_rs_posting); ?>">First</a>
        <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rs_posting > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_posting=%d%s", $currentPage, max(0, $pageNum_rs_posting - 1), $queryString_rs_posting); ?>">Previous</a>
        <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rs_posting < $totalPages_rs_posting) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_posting=%d%s", $currentPage, min($totalPages_rs_posting, $pageNum_rs_posting + 1), $queryString_rs_posting); ?>">Next</a>
        <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rs_posting < $totalPages_rs_posting) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_posting=%d%s", $currentPage, $totalPages_rs_posting, $queryString_rs_posting); ?>">Last</a>
        <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</div>

<?php }else{
	pesan('danger','Oops! Informasi belum ada');
}	
?>