<?php
$id=$_GET['id'];

mysql_query("delete from mst_terminal where ID_TERMINAL='$id'");
echo "<script>alert('Data berhasil Dihapus'); window.location='media.php?hal=terminal'</script>";
?>