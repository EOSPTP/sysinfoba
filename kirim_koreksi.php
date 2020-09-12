<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include "config/koneksi.php";
include "config/fungsi_apa.php";

	$id=$_GET['id'];	
	$tgl=date("d-m-Y");	
	
	$xx=mysql_query("select * from stopper where ID_STOPPER='$id'");
	$yy=mysql_fetch_array($xx);
	$no_permohonan=$yy['NO_PERMOHONAN'];
	$kode_ba=$yy['KODE_BA'];
	$tgl_keluar=date("d-m-Y");
	$jam=date("H:i:s");
	
	$user=$_SESSION['username'];
	$sql=mysql_query("select * from tbl_user where username='$user'");
	$data=mysql_fetch_array($sql);
	$ID_USER=$data['ID'];
	$ID_DIVISI=$data['ID_DIVISI'];

	$kb=mysql_query("select * from detail_ba where KODE_BA='$kode_ba'");
	$dtba=mysql_num_rows($kb);
	$kbx=mysql_query("select * from stopper where KODE_BA='$kode_ba' AND PENERIMA !='0'");
	$dtbax=mysql_num_rows($kbx);
	
 if($dtba == $dtbax)
	{
	mysql_query("update ba set STATUS_BA='FINISH' where KODE_BA='$kode_ba'");

	mysql_query("update stopper set PENERIMA='2', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='KOREKSI', STATUS_KOREKSI='KOREKSI' where ID_STOPPER='$id'");

	mysql_query("update detail_ba set STAT='X' where KODE_BA='$kode_ba'");		
	}			
else
	{	
	$pr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and ID_DIVISI='$ID_DIVISI'");
	$prx=mysql_fetch_array($pr);
	$pro=$prx['PRIORITAS'];
	
	if($pro == '1')
	{	
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='2'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='KOREKSI', STATUS_KOREKSI='KOREKSI' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	}
	elseif($pro == '2')
	{	
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='3'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='KOREKSI', STATUS_KOREKSI='KOREKSI' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	}
	elseif($pro == '3')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='4'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='KOREKSI', STATUS_KOREKSI='KOREKSI' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	
	}
	elseif($pro == '4')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='5'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='KOREKSI', STATUS_KOREKSI='KOREKSI' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	
	}
	elseif($pro == '5')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='6'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='KOREKSI', STATUS_KOREKSI='KOREKSI' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	
	}	
	elseif($pro == '6')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='2'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='KOREKSI', STATUS_KOREKSI='KOREKSI' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	
	}
}
	
echo "<script>alert('Data Terkirim'); window.location='media.php?hal=approve'</script>";		
?>