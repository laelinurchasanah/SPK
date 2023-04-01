<?php  

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs_historylogin = 10;
$pageNum_rs_historylogin = 0;
if (isset($_GET['pageNum_rs_historylogin'])) {
  $pageNum_rs_historylogin = $_GET['pageNum_rs_historylogin'];
}
$startRow_rs_historylogin = $pageNum_rs_historylogin * $maxRows_rs_historylogin;

$colname_rs_historylogin = "-1";
if (isset($_GET['search'])) {
  $colname_rs_historylogin = $_GET['search'];
	 mysqlii_select_db($koneksi, $database_koneksi);
	 $query_rs_historylogin =  sprintf("SELECT username_login, status_login, added_login, Nama FROM history_login LEFT JOIN vw_login ON username_login = Login WHERE Nama LIKE %s OR username_login LIKE %s", GetSQLValueString($koneksi, $koneksi, "%" . $colname_rs_historylogin . "%", "text"),  GetSQLValueString($koneksi, $koneksi, "%" . $colname_rs_historylogin . "%", "text"));

}else{
	mysqlii_select_db($koneksi, $database_koneksi);
	$query_rs_historylogin = "SELECT username_login, status_login, added_login, Nama FROM history_login LEFT JOIN vw_login ON username_login = Login ORDER BY id_login DESC";
	 
}
$query_limit_rs_historylogin = sprintf("%s LIMIT %d, %d", $query_rs_historylogin, $startRow_rs_historylogin, $maxRows_rs_historylogin);
$rs_historylogin = mysqlii_query($koneksi, $query_limit_rs_historylogin) or die(mysqlii_error($koneksi));
$row_rs_historylogin = mysqlii_fetch_assoc($rs_historylogin);
 

if (isset($_GET['totalRows_rs_historylogin'])) {
  $totalRows_rs_historylogin = $_GET['totalRows_rs_historylogin'];
} else {
  $all_rs_historylogin = mysqlii_query($koneksi, $query_rs_historylogin);
  $totalRows_rs_historylogin = mysqlii_num_rows($all_rs_historylogin);
}
$totalPages_rs_historylogin = ceil($totalRows_rs_historylogin/$maxRows_rs_historylogin)-1;

$queryString_rs_historylogin = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_historylogin") == false && 
        stristr($param, "totalRows_rs_historylogin") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_historylogin = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_historylogin = sprintf("&totalRows_rs_historylogin=%d%s", $totalRows_rs_historylogin, $queryString_rs_historylogin);

$halaman = ceil($totalRows_rs_historylogin / $maxRows_rs_historylogin);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<h3>RIWAYAT LOGIN SYSTEM</h3>
<div class="pull-right">
<form id="form1" name="form1" method="get" action="">
	<div class="input-group input-group-sm">
    <input type="hidden" name="page" value="view/login"/>
    <input type="text" name="search" id="search" placeholder="Temukan data Anda di sini" class="form-control"/>
         <div class="input-group-btn">
                  <button type="submit" class="btn btn-warning">Search <span class="fa fa-search"></span></button>
         </div>
    </div>
</form>
</div>

<?php if ($totalRows_rs_historylogin >0) { ?>
<table width="100%" class="table table-bordered table-striped table-hover small">
<thead>
  <tr align="center" bgcolor="#006699">
    <th width="3%"><span class="style1">NO.</span></th>
    <th width="34%"><div align="center" class="style1">USERNAME</div></th>
    <th width="24%"><div align="center" class="style1">NAMA</div></th>
    <th width="17%"><div align="center" class="style1">STATUS</div></th>
    <th width="22%"><div align="center" class="style1">#</div></th>
  </tr>
  </thead>
  <tbody>
  <?php $no = 1; do { ?>
  <tr>
    <td align="center"><?= $no; ?></td>
      <td><div align="center"><?php echo $row_rs_historylogin['username_login']; ?></div></td>
      <td><div align="center"><?php if (!empty($row_rs_historylogin['Nama'])) { echo $row_rs_historylogin['Nama']; } else { echo "Tidak diketahui"; } ?></div></td>
      <td><div align="center"><?php if ($row_rs_historylogin['status_login'] == 'Y') {
	  echo "<div class='btn btn-xs btn-block btn-success'>Success</div>";
	  }else{
	  echo "<div class='btn btn-xs btn-block btn-danger'>Failed!</div>";
	  } ?></div></td>
      <td><div align="center"><?php echo date("d F Y H:i:s", $row_rs_historylogin['added_login']); ?></div></td>
    </tr>
    <?php 
	$no++;
	} while ($row_rs_historylogin = mysqlii_fetch_assoc($rs_historylogin)); ?>
    </tbody>
</table>
<!-- /.box-body -->
            <div class="box-footer clearfix">
            <div class="pull-left">
            Records <?php echo ($startRow_rs_historylogin + 1) ?> to <?php echo min($startRow_rs_historylogin + $maxRows_rs_historylogin, $totalRows_rs_historylogin) ?> of <?php echo $totalRows_rs_historylogin ?>
            </div>
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><?php if ($pageNum_rs_historylogin > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_historylogin=%d%s", $currentPage, 0, $queryString_rs_historylogin); ?>">First</a>
        <?php } // Show if not first page ?>    </li>
                <li><?php if ($pageNum_rs_historylogin > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_historylogin=%d%s", $currentPage, max(0, $pageNum_rs_historylogin - 1), $queryString_rs_historylogin); ?>">Previous</a>
        <?php } // Show if not first page ?></li>
        
        
           
        <!-- LINK NUMBER -->
        <?php
        
        $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
        $start_number = ($pageNum_rs_historylogin > $jumlah_number)? $pageNum_rs_historylogin - $jumlah_number : 1; // Untuk awal link number
        $end_number = ($pageNum_rs_historylogin < ($halaman - $jumlah_number))? $pageNum_rs_historylogin + $jumlah_number : $halaman; // Untuk akhir link number
        
        for($i = $start_number; $i <= $end_number; $i++){
          $link_active = ($pageNum_rs_historylogin == $i - 1)? ' class="active"' : '';
        ?>
          <li<?php echo $link_active; ?>><a href="<?php printf("%s?pageNum_rs_historylogin=%d%s", $currentPage, $i - 1, $queryString_rs_historylogin); ?>"><?php echo $i; ?></a></li>
        <?php } ?>
       
                <li><?php if ($pageNum_rs_historylogin < $totalPages_rs_historylogin) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_historylogin=%d%s", $currentPage, min($totalPages_rs_historylogin, $pageNum_rs_historylogin + 1), $queryString_rs_historylogin); ?>">Next</a>
        <?php } // Show if not last page ?>   </li>
        		<li><?php if ($pageNum_rs_historylogin < $totalPages_rs_historylogin) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_historylogin=%d%s", $currentPage, $totalPages_rs_historylogin, $queryString_rs_historylogin); ?>">Last</a>
        <?php } // Show if not last page ?> </li>
              </ul>
            </div>
<?php }else{
	pesan('danger','Oops Belum ada yang login :(');
}
?>
</p>
</body>
</html>