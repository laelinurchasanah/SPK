<?php

if ((isset($_GET['id_bstk'])) && ($_GET['id_bstk'] != "")) {
  $updateSQL = sprintf("UPDATE tb_bstk SET active_bstk=%s WHERE id_bstk=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_bstk'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/bstk');
}

if ((isset($_GET['id_channel'])) && ($_GET['id_channel'] != "")) {
  $updateSQL = sprintf("UPDATE tb_channel SET active_channel=%s WHERE id_channel=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_channel'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/channel');
}

if ((isset($_GET['id_dokumentasi'])) && ($_GET['id_dokumentasi'] != "")) {
  $updateSQL = sprintf("UPDATE tb_dokumentasi SET active_dokumentasi=%s WHERE id_dokumentasi=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_dokumentasi'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/dokumentasi');
}

if ((isset($_GET['id_group'])) && ($_GET['id_group'] != "")) {
  $updateSQL = sprintf("UPDATE tb_group SET active_group=%s WHERE id_group=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_group'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/group');
}

if ((isset($_GET['id_item'])) && ($_GET['id_item'] != "")) {
  $updateSQL = sprintf("UPDATE tb_item SET active_item=%s WHERE id_item=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_item'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/item');
}

if ((isset($_GET['id_jenistransaksi'])) && ($_GET['id_jenistransaksi'] != "")) {
  $updateSQL = sprintf("UPDATE tb_jenistransaksi SET active_jenistransaksi=%s WHERE id_jenistransaksi=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_jenistransaksi'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/jenistransaksi');
}

if ((isset($_GET['id_kategori'])) && ($_GET['id_kategori'] != "")) {
  $updateSQL = sprintf("UPDATE tb_kategori SET active_kategori=%s WHERE id_kategori=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_kategori'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/kategori');
}

if ((isset($_GET['id_leasing'])) && ($_GET['id_leasing'] != "")) {
  $updateSQL = sprintf("UPDATE tb_leasing SET active_leasing=%s WHERE id_leasing=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_leasing'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/leasing');
}

if ((isset($_GET['id_mutasi'])) && ($_GET['id_mutasi'] != "")) {
  $updateSQL = sprintf("UPDATE tb_mutasi SET active_mutasi=%s WHERE id_mutasi=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_mutasi'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/mutasi');
}

if ((isset($_GET['id_operator'])) && ($_GET['id_operator'] != "")) {
  $updateSQL = sprintf("UPDATE tb_operator SET active_operator=%s WHERE id_operator=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_operator'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/operator');
}

if ((isset($_GET['id_pegawai'])) && ($_GET['id_pegawai'] != "")) {
  $updateSQL = sprintf("UPDATE tb_pegawai SET active_pegawai=%s WHERE id_pegawai=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_pegawai'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/pegawai');
}

if ((isset($_GET['id_penerimaankas'])) && ($_GET['id_penerimaankas'] != "")) {
  $updateSQL = sprintf("UPDATE tb_penerimaankas SET active_penerimaankas=%s WHERE id_penerimaankas=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_penerimaankas'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/penerimaankas');
}

if ((isset($_GET['id_pos'])) && ($_GET['id_pos'] != "")) {
  $updateSQL = sprintf("UPDATE tb_pos SET active_pos=%s WHERE id_pos=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_pos'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/pos');
}

if ((isset($_GET['id_posisi'])) && ($_GET['id_posisi'] != "")) {
  $updateSQL = sprintf("UPDATE tb_posisi SET active_posisi=%s WHERE id_posisi=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_posisi'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/posisi');
}

if ((isset($_GET['id_posting'])) && ($_GET['id_posting'] != "")) {
  $updateSQL = sprintf("UPDATE tb_posting SET active_posting=%s WHERE id_posting=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_posting'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/posting');
}

if ((isset($_GET['id_segmen'])) && ($_GET['id_segmen'] != "")) {
  $updateSQL = sprintf("UPDATE tb_segmen SET active_segmen=%s WHERE id_segmen=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_segmen'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/segmen');
}

if ((isset($_GET['id_smh'])) && ($_GET['id_smh'] != "")) {
  $updateSQL = sprintf("UPDATE tb_smh SET active_smh=%s WHERE id_smh=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_smh'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/smh');
}

if ((isset($_GET['id_staff'])) && ($_GET['id_staff'] != "")) {
  $updateSQL = sprintf("UPDATE tb_staff SET active_staff=%s WHERE id_staff=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_staff'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/staff');
}

if ((isset($_GET['id_surat'])) && ($_GET['id_surat'] != "")) {
  $updateSQL = sprintf("UPDATE tb_surat SET active_surat=%s WHERE id_surat=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_surat'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/surat');
}

if ((isset($_GET['id_unit'])) && ($_GET['id_unit'] != "")) {
  $updateSQL = sprintf("UPDATE tb_unit SET active_unit=%s WHERE id_unit=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_unit'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/unit');
}

if ((isset($_GET['id_admin'])) && ($_GET['id_admin'] != "")) {
  $updateSQL = sprintf("UPDATE tb_admin SET active_admin=%s WHERE id_admin=%s",
                       GetSQLValueString($koneksi, "Y", "text"),
					   GetSQLValueString($koneksi, $_GET['id_admin'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data tersebut berhasil di RESTORE','?page=view/admin');
}
?>
