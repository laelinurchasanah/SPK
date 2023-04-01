<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_penerimaankas SET kode_penerimaankas=%s, tanggal_penerimaankas=%s, pembeli_penerimaankas=%s, diserahkan_penerimaankas=%s, uangmuka_penerimaankas=%s, kredit_penerimaankas=%s, statuspanjar_penerimaankas=%s, nominalpanjar_penerimaankas=%s, jenisbeli_penerimaankas=%s, leasing_penerimaankas=%s, transaksi_penerimaankas=%s, getmesin_penerimaankas=%s, periode_penerimaankas=%s, ut_penerimaankas=%s, ub_penerimaankas=%s, active_penerimaankas=%s WHERE id_penerimaankas=%s",
                       GetSQLValueString($koneksi, $_POST['kode_penerimaankas'], "text"),
                       GetSQLValueString($koneksi, $_POST['tanggal_penerimaankas'], "date"),
                       GetSQLValueString($koneksi, $_POST['pembeli_penerimaankas'], "text"),
                       GetSQLValueString($koneksi, $_POST['diserahkan_penerimaankas'], "int"),
                       GetSQLValueString($koneksi, $_POST['uangmuka_penerimaankas'], "double"),
                       GetSQLValueString($koneksi, $_POST['kredit_penerimaankas'], "double"),
                       GetSQLValueString($koneksi, $_POST['statuspanjar_penerimaankas'], "text"),
                       GetSQLValueString($koneksi, $_POST['nominalpanjar_penerimaankas'], "double"),
                       GetSQLValueString($koneksi, $_POST['jenisbeli_penerimaankas'], "text"),
                       GetSQLValueString($koneksi, $_POST['leasing_penerimaankas'], "int"),
                       GetSQLValueString($koneksi, $_POST['transaksi_penerimaankas'], "text"),
                       GetSQLValueString($koneksi, $_POST['getmesin_penerimaankas'], "text"),
                       GetSQLValueString($koneksi, $_POST['periode_penerimaankas'], "text"),
                       GetSQLValueString($koneksi, $_POST['ut_penerimaankas'], "date"),
                       GetSQLValueString($koneksi, $_POST['ub_penerimaankas'], "int"),
                       GetSQLValueString($koneksi, $_POST['active_penerimaankas'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_penerimaankas'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_pk = "-1";
if (isset($_GET['id_penerimaankas'])) {
  $colname_rs_pk = $_GET['id_penerimaankas'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_pk = sprintf("SELECT * FROM tb_penerimaankas WHERE id_penerimaankas = %s", GetSQLValueString($koneksi, $colname_rs_pk, "int"));
$rs_pk = mysqli_query($koneksi, $query_rs_pk) or die(mysqli_error($koneksi));
$row_rs_pk = mysqli_fetch_assoc($rs_pk);
$totalRows_rs_pk = mysqli_num_rows($rs_pk);
?>
<p><strong>UPDATE DATA PENERIMAAN KAS</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="398" height="532">
    <tr valign="baseline">
      <td width="146" align="right" nowrap="nowrap"><strong>KODE PK</strong></td>
<td width="15">&nbsp;</td>
      <td width="221"><input type="text" name="kode_penerimaankas" value="<?php echo htmlentities($row_rs_pk['kode_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>TANGGAL PK</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="tanggal_penerimaankas" value="<?php echo htmlentities($row_rs_pk['tanggal_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>PEMBELI</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="pembeli_penerimaankas" value="<?php echo htmlentities($row_rs_pk['pembeli_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>DISERAHKAN (ID)</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="diserahkan_penerimaankas" value="<?php echo htmlentities($row_rs_pk['diserahkan_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>UANG MUKA Rp.</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="uangmuka_penerimaankas" value="<?php echo htmlentities($row_rs_pk['uangmuka_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KREDIT Rp. </strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="kredit_penerimaankas" value="<?php echo htmlentities($row_rs_pk['kredit_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS PANJAR</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="statuspanjar_penerimaankas" value="<?php echo htmlentities($row_rs_pk['statuspanjar_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NOMINAL PANJAR</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nominalpanjar_penerimaankas" value="<?php echo htmlentities($row_rs_pk['nominalpanjar_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>JENIS BELI</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="jenisbeli_penerimaankas" value="<?php echo htmlentities($row_rs_pk['jenisbeli_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>LEASING</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="leasing_penerimaankas" value="<?php echo htmlentities($row_rs_pk['leasing_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ID TRANSAKSI</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="transaksi_penerimaankas" value="<?php echo htmlentities($row_rs_pk['transaksi_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ID MESIN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="getmesin_penerimaankas" value="<?php echo htmlentities($row_rs_pk['getmesin_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>PERIODE</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="periode_penerimaankas" value="<?php echo htmlentities($row_rs_pk['periode_penerimaankas'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_penerimaankas">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_pk['active_penerimaankas'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_pk['active_penerimaankas'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/pk"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_penerimaankas" value="<?php echo $row_rs_pk['id_penerimaankas']; ?>" />
</form> 