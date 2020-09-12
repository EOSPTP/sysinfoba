<?php
include "config/koneksi.php";

$kode_ba=$_GET['kode_ba'];
$status=$_GET['status'];

if($status == 'REJECT' || $status == 'DONE')
{
mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','2','','$tgl_permohonan|$jam','','','$no_permohonan','$status')");
}

echo "<script>alert('STATUS SUDAH DI UBAH'); window.location='media.php?hal=ba'</script>";
?>