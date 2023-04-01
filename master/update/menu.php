<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_menu SET nourut_menu=%s, link_menu=%s, icon_menu=%s, text_menu=%s, color_menu=%s, label_menu=%s, level_menu=%s WHERE id_menu=%s",
                       GetSQLValueString($koneksi, $_POST['nourut_menu'], "int"),
                       GetSQLValueString($koneksi, $_POST['link_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['icon_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['text_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['color_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['label_menu'], "text"),
                       GetSQLValueString($koneksi, $_POST['level_menu'], "int"),
                       GetSQLValueString($koneksi, $_POST['id_menu'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_editmenu = "-1";
if (isset($_GET['id_menu'])) {
  $colname_rs_editmenu = $_GET['id_menu'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_editmenu = sprintf("SELECT * FROM tb_menu WHERE id_menu = %s", GetSQLValueString($koneksi, $colname_rs_editmenu, "int"));
$rs_editmenu = mysqli_query($koneksi, $query_rs_editmenu) or die(mysqli_error($koneksi));
$row_rs_editmenu = mysqli_fetch_assoc($rs_editmenu);
$totalRows_rs_editmenu = mysqli_num_rows($rs_editmenu);

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
  <table width="100%" height="283">
    <tr valign="baseline">
      <td nowrap="nowrap">No. Urut</td>
      <td><input type="text" name="nourut_menu" value="<?php echo htmlentities($row_rs_editmenu['nourut_menu'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Link</td>
      <td><input type="text" name="link_menu" value="<?php echo htmlentities($row_rs_editmenu['link_menu'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Icon</td>
      <td><select class="form-control input-sm"  name="icon_menu">
        <?php require_once('options.php'); ?>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Text</td>
      <td><input type="text" name="text_menu" value="<?php echo htmlentities($row_rs_editmenu['text_menu'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Color</td>
      <td><select class="form-control input-sm"  name="color_menu">
        <option value="bg-blue" <?php if (!(strcmp("bg-blue", htmlentities($row_rs_editmenu['color_menu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>bg-blue</option>
        <option value="bg-green" <?php if (!(strcmp("bg-green", htmlentities($row_rs_editmenu['color_menu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>bg-green</option>
        <option value="bg-yellow"<?php if (!(strcmp("bg-yellow", htmlentities($row_rs_editmenu['color_menu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>bg-yellow</option> 
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Label</td>
      <td><input type="text" name="label_menu" value="<?php echo htmlentities($row_rs_editmenu['label_menu'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Level</td>
      <td><input type="text" name="level_menu" value="<?php echo htmlentities($row_rs_editmenu['level_menu'], ENT_COMPAT, 'utf-8'); ?>" class="form-control input-sm" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_menu" value="<?php echo $row_rs_editmenu['id_menu']; ?>" />
</form> 
</div>

<div class="col-md-7">
    <div class="table-responsive">
    <table width="100%" class="table table-striped table-bordered table-hover small" id="example1">
        <thead>
          <tr bgcolor="#663366">
            <th width="4%"><span class="style1">No.</span></th>
            <th width="14%"><span class="style1">NOMOR</span></th>
            <th width="29%"><span class="style1">LINK</span></th>
            <th width="20%"><span class="style1">TEXT</span></th>
            <th width="13%"><span class="style1">LEVEL</span></th>
            <th width="20%"><span class="style1">ACTIONS</span></th>
          </tr>
        </thead>
        <tbody>  
          <?php $no = 1; do { ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row_rs_menu['nourut_menu']; ?></td>
              <td><?php echo $row_rs_menu['link_menu']; ?></td>
              <td><?php echo $row_rs_menu['text_menu']; ?></td>
              <td><?php echo $row_rs_menu['level_menu']; ?></td>
              <td>
              <a href="?page=update/menu&id_menu=<?= $row_rs_menu['id_menu'];?>" class="btn btn-xs btn-warning" title="Edit"><span class="fa fa-edit"></span></a>
              <a href="#" class="btn btn-xs btn-danger" title="Hapus"><span class="fa fa-trash"></span></a>
              </td>
            </tr>
            <?php } while ($row_rs_menu = mysqli_fetch_assoc($rs_menu)); ?>
        </tbody>    
    </table> 
    </div>

</div>