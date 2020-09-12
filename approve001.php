<?php
				$id=$_GET['id'];
				$xxv=mysql_query("select * from stopper where ID_STOPPER='$id'");
				$yyv=mysql_fetch_array($xxv);
				$kode_ba=$yyv['KODE_BA'];
				$tgl_keluar=date("d-m-Y");	
				$jam=date("H:i:s");
				
				$user=$_SESSION['username'];
					$sql=mysql_query("select * from tbl_user where username='$user'");
					$data=mysql_fetch_array($sql);
					$ID_USER=$data['ID'];
					$ID_DIVISI=$data['ID_DIVISI'];
					
					$ss=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and ID_DIVISI='$ID_DIVISI'");
					$dd=mysql_fetch_array($ss);
					$pro=$dd['PRIORITAS'];
				
	mysql_query("insert into approve_ba(ID_APPROVE_BA,KODE_BA,TGL,ID_USER,NOTES,ID_DIVISI,FILE_BA_APPROVE,STS) values('','$kode_ba','$tgl|$jam','$ID_USER','','$ID_DIVISI','','IN PROGRESS')");

			
	if($pro == '1')
	{	
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='2'and STAT='Y'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER,YX) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','','Y')");
	}
	elseif($pro == '2')
	{	
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='3' and STAT='Y'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER,YX) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','','Y')");
	}
	elseif($pro == '3')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='4' and STAT='Y'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER,YX) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','','Y')");
	
	}
	elseif($pro == '4')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='5' and STAT='Y'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER,YX) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','','Y')");
	
	}
	elseif($pro == '5')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='6' and STAT='Y'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER,YX) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','','Y')");
	
	}	
	elseif($pro == '6')
	{
	$apr=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='2' and STAT='Y'");
	$qpr=mysql_fetch_array($apr);
	$divis=$qpr['ID_DIVISI'];
	
	mysql_query("update stopper set PENERIMA='$divis', TGL_KELUAR='$tgl_keluar|$jam', STATUS_STOPPER='APPROVED' where ID_STOPPER='$id'");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER,YX) values('','$divis','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','','Y')");
	
	}
	
	echo "<script>alert('APPROVED'); window.location='media.php?hal=approve'</script>";
?>	