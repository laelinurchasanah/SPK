<?php require_once('../../Connections/koneksi.php'); 
 
 

$output = '';
$colname_rs_search = "-1";
if(isset($_POST["query"])){
	$colname_rs_search = $_POST['query'];
} 
mysqlii_select_db($koneksi, $database_koneksi);
$query_rs_search = sprintf("SELECT * FROM tb_peserta INNER JOIN tb_kelas ON id_kelas = kelas_peserta WHERE active_peserta <> 'N' AND ta_peserta = '".$ta."' AND Login = %s OR nama_peserta LIKE %s OR nama_kelas = %s", 
	GetSQLValueString($koneksi, $koneksi,  $colname_rs_search , "text"),
	GetSQLValueString($koneksi, $koneksi, "%". $colname_rs_search ."%", "text"),
	GetSQLValueString($koneksi, $koneksi, $colname_rs_search, "text"));

$rs_search = mysqlii_query($koneksi, $query_rs_search) or die(mysqlii_error($koneksi));
$row_rs_search = mysqlii_fetch_assoc($rs_search);
$totalRows_rs_search = mysqlii_num_rows($rs_search);



if($totalRows_rs_search > 0) {

echo "<br><p>Berikut ini data yang dapat kami sajikan</p>";
do {
?>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

	
  <div class="table-responsive">
    <table width="100%" class="table table-striped table-bordered table-hover small" id="example1">
    <thead>
      <tr bgcolor="#006699">
        <th>&nbsp;</th>
        <th><span class="style1">NO.</span></th>
        <th><span class="style1">KODE</span></th>
        <th><span class="style1">NAMA LENGKAP</span></th>
        <th><span class="style1">EMAIL</span></th>
        <th><span class="style1">NO. KONTAK</span></th>
        <th><span class="style1">KELAS</span></th>
        <th><span class="style1">DAFTAR</span></th>
        <th><span class="style1">STATUS</span></th>
        <th><span class="style1">ACTIONS</span></th>
      </tr>
</thead>
        <tbody>  
          <?php $no = 1; do { ?>
            <tr>
              <td align="center">
              <form action="<?php echo $editFormAction; ?>" method="post" name="form<?= $no; ?>" id="form<?= $no; ?>"> 
                <select name="active_peserta<?= $no; ?>" id="active_peserta" onchange="this.form.submit();">
                  <option value="Y" <?php if (!(strcmp("Y", $row_rs_search['active_peserta']))) {echo "selected=\"selected\"";} ?>>Aktif</option>
                  <option value="N" <?php if (!(strcmp("N", $row_rs_search['active_peserta']))) {echo "selected=\"selected\"";} ?>>Blok</option>
                  <option value="P" <?php if (!(strcmp("P", $row_rs_search['active_peserta']))) {echo "selected=\"selected\"";} ?>>Pending</option
                ></select>             
              <input type="hidden" name="id_peserta<?= $no;?>" value="<?php echo $row_rs_search['id_peserta']; ?>" />
              <input type="hidden" name="MM_update<?= $no; ?>" value="form<?= $no; ?>" />
              </form>
</td>
              <td align="center"><?php echo $no; ?></td>
              <td><?php echo $row_rs_search['Login']; ?></td>
              <td><?php echo $row_rs_search['nama_peserta']; ?></td>
              <td><?php echo $row_rs_search['email_peserta']; ?></td>
              <td><?php echo $row_rs_search['hp_peserta']; ?></td>
              <td><?php echo $row_rs_search['nama_kelas']; ?></td>
              <td><?php echo $row_rs_search['waktuawal_peserta']; ?></td>
              <td>
              <?php if ($row_rs_search['active_peserta'] == 'P') {
			  		echo "<div class='btn btn-xs btn-info btn-block'>Pending ...</div>";
				}elseif ($row_rs_search['active_peserta'] == 'Y'){
					echo "<div class='btn btn-xs btn-success btn-block'>Aktif</div>";
				}elseif ($row_rs_search['active_peserta'] == 'N'){
					echo "<div class='btn btn-xs btn-danger btn-block'>Blok</div>";
				}else{
					echo "Error";
				} ?>              </td>
              <td>
              <a onclick="return confirm('Anda yakin mengubah data ini?');" href="?page=peserta/edit&id_peserta=<?= $row_rs_search['id_peserta'];?>" class="btn btn-xs btn-warning" title="Edit"><span class="fa fa-edit"></span></a>
              <a onclick="return confirm('Anda yakin menghapus data ini?');" href="?page=peserta/delete&id_peserta=<?= $row_rs_search['id_peserta'];?>" class="btn btn-xs btn-danger" title="Hapus"><span class="fa fa-trash"></span></a>
              </td>              
            </tr>
    		<?php 
			$no++;
			} while ($row_rs_search = mysqlii_fetch_assoc($rs_search)); ?>
    	</tbody>    
    </table> 
  </div>
 
<?php 
  } while ($row_rs_search = mysqlii_fetch_assoc($rs_search));
}else{
	echo "<br>";
	pesan('danger','Oops! Silahkan cari data anda pada kolom search');
}
?>