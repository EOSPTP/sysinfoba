<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include "config/koneksi.php";
include "config/fungsi_apa.php";

if(isset($_POST['proses']))
{
	$id=$_POST['id'];	
	$remarks=$_POST['remarks'];	
	$tgl=date("d-m-Y");	
		
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

mysql_query("update approve_ba set FILE_BA_APPROVE='$nama_file' where KODE_BA='$kode_ba'");

mysql_query("update ba set REMARKS='$remarks', FILE_BA='$nama_file' where KODE_BA='$kode_ba'");

$user=$_SESSION['username'];
$sql=mysql_query("select * from tbl_user where username='$user'");
$data=mysql_fetch_array($sql);
$ID_USER=$data['ID'];
$ID_DIVISI=$data['ID_DIVISI'];
	
		$jumlah = count($_POST['no_nota_baru']);	
		for($i=0;$i<$jumlah;$i++)
		{
		$no_req_baru=$_POST['no_req_baru'][$i];
		$no_nota_baru=$_POST['no_nota_baru'][$i];
		$status_baru=$_POST['status_baru'][$i];
		$jml_nota_baru=$_POST['jml_nota_baru'][$i];
		$biaya_sharing_baru=$_POST['biaya_sharing_baru'][$i];
		
		mysql_query("update mst_nota set NO_REQ_BARU='$no_req_baru', NO_NOTA_BARU='$no_nota_baru', STATUS_BARU='$status_baru', JML_NOTA_BARU='$jml_nota_baru', BIAYA_SHARING_BARU='$biaya_sharing_baru' where KODE_BA='$kode_ba'");
		}	
}
else
{
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

mysql_query("update ba set REMARKS='$remarks' where KODE_BA='$kode_ba'");
	
		$jumlah = count($_POST['no_nota_baru']);	
		for($i=0;$i<$jumlah;$i++)
		{
		$no_req_baru=$_POST['no_req_baru'][$i];
		$no_nota_baru=$_POST['no_nota_baru'][$i];
		$status_baru=$_POST['status_baru'][$i];
		$jml_nota_baru=$_POST['jml_nota_baru'][$i];
		$biaya_sharing_baru=$_POST['biaya_sharing_baru'][$i];
		
		mysql_query("update mst_nota set NO_REQ_BARU='$no_req_baru', NO_NOTA_BARU='$no_nota_baru', STATUS_BARU='$status_baru', JML_NOTA_BARU='$jml_nota_baru', BIAYA_SHARING_BARU='$biaya_sharing_baru' where KODE_BA='$kode_ba'");
		}
}
echo "<script>alert('Data berhasil Diupdate'); window.location='media.php?hal=detail_berita_acara2&kode_ba=$kode_ba'</script>";
}
?>