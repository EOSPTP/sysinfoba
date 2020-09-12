<?php
include "config/koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$id=$_GET['id'];
$tgl=date("d-m-Y");
$bulan=date("m");
$tahun=date("Y");

$ss=mysql_query("select * from ba where ID_BA='$id'");
$dd=mysql_fetch_array($ss);
$KODE_BA=$dd['KODE_BA'];
$NO_BA=$dd['NO_BA'];


if($NO_BA == "")
{
 	echo "<script>alert('Maaf NO BA masih kosong'); window.location='media.php?hal=ba'</script>";
}
else
{	
mysql_query("update ba set STATUS_BA='SEND' where ID_BA='$id'");

mysql_query("update mst_nota set ID_BULAN='$bulan', TAHUN='$tahun' where KODE_BA='$KODE_BA'");

mysql_query("update stopper set TGL_KELUAR='$tgl' where KODE_BA='$KODE_BA'");

$xx=mysql_query("select * from stopper where KODE_BA='$KODE_BA'");
$yy=mysql_fetch_array($xx);
$TGL_KELUAR=$yy['TGL_KELUAR'];
$jam=date("H:i:s");
$PENERIMA=$yy['PENERIMA'];

if($TGL_KELUAR !== '')
{
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA) values('','$PENERIMA','','$TGL_KELUAR $jam','','$KODE_BA')");
}

echo "<script>alert('Data DiKirim >>'); window.location='media.php?hal=ba'</script>";
}
?>