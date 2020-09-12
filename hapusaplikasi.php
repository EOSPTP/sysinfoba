<?php
$id=$_GET['id'];

mysql_query("delete from mst_aplikasi where ID_APLIKASI='$id'");
echo "<script>alert('Data berhasil Dihapus'); window.location='media.php?hal=aplikasi'</script>";
?>