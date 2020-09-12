<?php
include "config/koneksi.php";

$id=$_GET['id'];

mysql_query("delete from permohonan where ID_PERMOHONAN='$id'");
echo "<script>alert('Data berhasil DiHapus'); window.location='media.php?hal=permohonan'</script>";
?>