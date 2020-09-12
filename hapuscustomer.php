<?php
$id=$_GET['id'];

mysql_query("delete from mst_customer where ID_CUSTOMER='$id'");
echo "<script>alert('Data berhasil Dihapus'); window.location='media.php?hal=data_customer'</script>";
?>