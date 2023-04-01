<?php require_once('../require/lap_header.php'); ?>
<?php 
//error_reporting(0);
$colname_rs_jadwal = "-1";
$colname_rs_kelas = "-1";
if (isset($_GET['jadwal'])) {
  $colname_rs_jadwal = $_GET['jadwal'];
  $colname_rs_kelas = $_GET['kelas'];
}
 
mysqlii_select_db($koneksi, $database_koneksi);
$query_rs_detailhasilESSAY = sprintf("SELECT DISTINCT(kodepeserta_ujian), nama_peserta, nama_kelas, soal_ujian, LEFT(konten_soal, 10) as soal, kategori_soal, kodejadwal_ujian,paket_jadwal, LEFT(jawabpeserta_ujian, 10) AS jawab, mulai_jadwal, akhir_jadwal, waktuawal_ujian FROM `tb_ujian` 
INNER JOIN tb_peserta ON Login = kodepeserta_ujian 
INNER JOIN tb_kelas ON id_kelas = kelas_peserta 
INNER JOIN tb_soal ON id_soal = soal_ujian INNER JOIN tb_jadwal ON kode_jadwal = kodejadwal_ujian WHERE kodejadwal_ujian = %s AND kategori_soal = 'ESSAY' AND kelas_peserta = %s ORDER BY `tb_kelas`.`nama_kelas` ASC", 
GetSQLValueString($koneksi, $koneksi, $colname_rs_jadwal, "text"),
GetSQLValueString($koneksi, $koneksi, $colname_rs_kelas, "text"));
$rs_detailhasilESSAY = mysqlii_query($koneksi, $query_rs_detailhasilESSAY) or die(mysqlii_error($koneksi));
$row_rs_detailhasilESSAY = mysqlii_fetch_assoc($rs_detailhasilESSAY);
$totalRows_rs_detailhasilESSAY = mysqlii_num_rows($rs_detailhasilESSAY);

 
?>


 
<?php
	title('success','LAPORAN HASIL JAWABAN PESERTA UJIAN','Laporan Hasil Jawaban Peserta Ujian');
?> 
 
<table width="100%" class="table table-striped table-hover">
  <tr>
    <td width="14%">KODE JADWAL</td>
    <td width="2%">&nbsp;</td>
    <td width="84%"><?php echo $row_rs_detailhasilESSAY['kodejadwal_ujian']; ?> : <?= $row_rs_detailhasilESSAY['nama_kelas']; ?></td>
  </tr>
  <tr>
    <td>WAKTU UJIAN</td>
    <td>&nbsp;</td>
    <td><?php echo $row_rs_detailhasilESSAY['mulai_jadwal']; ?> s/d <?php echo $row_rs_detailhasilESSAY['akhir_jadwal']; ?></td>
  </tr>

</table>
 

                    <table class="table table-striped" id="example2">
                    <thead>
                      <tr align="center">
                        <th><span class="style1" style="color: #000000">NO.</span></th>
                        <th><span class="style1" style="color: #000000">KODE PESERTA</span></th>
                        <th><span class="style1" style="color: #000000">NAMA PESERTA</span></th>
                        <th><span style="color: #000000">NILAI</span></th>
                        <th><span class="style1" style="color: #000000">WAKTU MULAI</span></th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $no = 1; do { 
					  //nilai benar atau salah
					  mysqlii_select_db($koneksi, $database_koneksi);
					  $query_rs_nilai = "SELECT kodepeserta_ujian, SUM(nilai_ujian = 'B') as Benar, SUM(nilai_ujian = 'S') as Salah FROM `tb_ujian` INNER JOIN tb_peserta ON Login = kodepeserta_ujian INNER JOIN tb_kelas ON id_kelas = kelas_peserta INNER JOIN tb_soal ON id_soal = soal_ujian INNER JOIN tb_jadwal ON kode_jadwal = kodejadwal_ujian WHERE kodejadwal_ujian = '".$row_rs_detailhasilESSAY['kodejadwal_ujian']."' AND kodepeserta_ujian = '".$row_rs_detailhasilESSAY['kodepeserta_ujian']."' ORDER BY `tb_kelas`.`nama_kelas` ASC";
						$rs_nilai = mysqlii_query($koneksi, $query_rs_nilai) or die(mysqlii_error($koneksi));
						$row_rs_nilai = mysqlii_fetch_assoc($rs_nilai);
						$totalRows_rs_nilai = mysqlii_num_rows($rs_nilai);
					  ?>
                        <tr>
                          <td align="center"><?php echo $no++; ?></td>
                          <td><?php echo $row_rs_detailhasilESSAY['kodepeserta_ujian']; ?></td>
                          <td><?php echo $row_rs_detailhasilESSAY['nama_peserta']; ?></td>
                          <td>Benar : <?= $row_rs_nilai['Benar'];?><br>
							  Salah : <?= $row_rs_nilai['Salah'];?>                            </td>
                          <td><?php echo $row_rs_detailhasilESSAY['waktuawal_ujian']; ?></td>
                        </tr>
                        <?php } while ($row_rs_detailhasilESSAY = mysqlii_fetch_assoc($rs_detailhasilESSAY)); ?>
                        </tbody>
                    </table> 
                    
<?php require_once('../require/lap_footer.php'); ?>          