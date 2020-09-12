<?php
include "config/koneksi.php";

$id=$_GET['id'];

mysql_query("update stopper set STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
echo "<script>alert('APPROVED'); window.location='media.php?hal=approve'</script>";
?>