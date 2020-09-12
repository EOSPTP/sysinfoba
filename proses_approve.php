<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include "config/koneksi.php";
include "config/fungsi_apa.php";

if(isset($_POST['proses']))
{
	$id=$_POST['id'];	
	$tgl=date("d-m-Y");	
	$notes=$_POST['notes'];
		
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
	$nama_file_unik = $acak.$nama_file; 
	
if (!empty($lokasi_file)){
    UploadBanner($nama_file);	
	
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
					
mysql_query("insert into approve_ba(ID_APPROVE_BA,KODE_BA,TGL,ID_USER,NOTES,ID_DIVISI,FILE_BA_APPROVE,STS) values('','$kode_ba','$tgl|$jam','$ID_USER','$notes','$ID_DIVISI','$nama_file','IN PROGRESS')");

mysql_query("update ba set FILE_BA='$nama_file' where KODE_BA='$kode_ba'");

	
	$pr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and ID_DIVISI='$ID_DIVISI'");
	$prx=mysql_fetch_array($pr);
	$pro=$prx['PRIORITAS'];
	
	if($pro == '1')
	{	
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='2'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	}
	elseif($pro == '2')
	{	
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='3'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	}
	elseif($pro == '3')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='4'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	
	}
	elseif($pro == '4')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='5'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	
	}
	elseif($pro == '5')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='6'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	
	}	
	elseif($pro == '6')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='2'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','')");
	
	}
	
	echo "<script>alert('Data Disimpan'); window.location='media.php?hal=approve'</script>";
		
			
}	
}	
?>