<?php
include "config/koneksi.php";

$id=$_GET['id'];

$ss=mysql_query("select * from permohonan where ID_PERMOHONAN='$id'");
$dd=mysql_fetch_array($ss);

$no_permohonan=$dd['NO_PERMOHONAN'];

mysql_query("update permohonan set STATUS_PERMOHONAN='APPROVE' where ID_PERMOHONAN='$id'");

echo "<script>alert('APPROVED'); window.location='media.php?hal=tambah_ba&no=$no_permohonan'</script>";
?>