<?php
include "config/koneksi.php";
$kode_ba=$_GET['kode_ba'];

mysql_query("update ba set STATUS_BA='DONE' where KODE_BA='$kode_ba'");

echo "<script>alert('Siklus Selesai >>'); window.location='media.php?hal=ba'</script>";

?>