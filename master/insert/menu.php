<?php  
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_menu (nourut_menu, link_menu, icon_menu, text_menu, color_menu, label_menu, level_menu) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($koneksi, $_POST['nourut_menu'], "int"),
                       GetSQLValueString($koneksi, $_POST['link_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['icon_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['text_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['color_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['label_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['level_menu'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
}

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_menu = "SELECT * FROM tb_menu ORDER BY nourut_menu ASC";
$rs_menu = mysqli_query($koneksi, $query_rs_menu) or die(mysqli_error($koneksi));
$row_rs_menu = mysqli_fetch_assoc($rs_menu);
$totalRows_rs_menu = mysqli_num_rows($rs_menu);


?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>


<div class="col-md-5">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="265">
    <tr valign="baseline">
      <td width="80" nowrap="nowrap">No. Urut</td>
      <td width="247"><input type="number" name="nourut_menu" value="" class="form-control input-sm" size="32"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Link</td>
      <td><input type="text" name="link_menu" value="" class="form-control input-sm" size="32"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Icon</td>
      <td>
      <select name="icon_menu" class="form-control input-sm">
        <?php require_once('options.php'); ?>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Text</td>
      <td><input type="text" name="text_menu" value="" class="form-control input-sm" size="32"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Color</td>
      <td><select class="form-control input-sm" name="color_menu">
        <option value="bg-blue" <?php if (!(strcmp("bg-blue", "bg-blue"))) {echo "SELECTED";} ?>>bg-blue</option>
        <option value="bg-green" <?php if (!(strcmp("bg-green", "bg-blue"))) {echo "SELECTED";} ?>>bg-green</option>
        <option value="bg-yellow" <?php if (!(strcmp("bg-yellow", "bg-blue"))) {echo "SELECTED";} ?>>bg-yellow</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Label</td>
      <td><input type="text" name="label_menu" value="" class="form-control input-sm" size="32"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Level</td>
      <td><input type="number" name="level_menu" value="" class="form-control input-sm" size="32"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">&nbsp;</td>
      <td><input type="submit" value="Simpan Data" class="btn btn-success btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</div>
<div class="col-md-7">
  <div class="table-responsive">
    <table width="100%" class="table table-striped table-bordered table-hover small" id="example1">
        <thead>
          <tr bgcolor="#663366">
            <th width="4%"><span class="style1">No.</span></th>
            <th width="14%"><span class="style1">URUTAN</span></th>
            <th width="29%"><span class="style1">LINK</span></th>
            <th width="20%"><span class="style1">TEXT</span></th>
            <th width="13%"><span class="style1">LEVEL</span></th>
            <th width="20%"><span class="style1">ACTIONS</span></th>
          </tr>
        </thead>
        <tbody>  
          <?php $no = 1; do { ?>
            <tr>
              <td align="center"><?php echo $no++; ?></td>
              <td><?php echo $row_rs_menu['nourut_menu']; ?></td>
              <td><?php echo $row_rs_menu['link_menu']; ?></td>
              <td><?php echo $row_rs_menu['text_menu']; ?></td>
              <td><?php echo $row_rs_menu['level_menu']; ?></td>
              <td>
              <a href="?page=update/menu&id_menu=<?= $row_rs_menu['id_menu'];?>" class="btn btn-xs btn-warning" title="Edit"><span class="fa fa-edit"></span></a>
              <a onclick="return confirm('Hapus Menu <?= $row_rs_menu['text_menu']; ?>?');" href="?page=delete/hapus&id_menu=<?= $row_rs_menu['id_menu'];?>" class="btn btn-xs btn-danger" title="Hapus" ><span class="fa fa-trash"></span></a>
              </td>
            </tr>
            <?php } while ($row_rs_menu = mysqli_fetch_assoc($rs_menu)); ?>
        </tbody>    
    </table> 
  </div>
</div>