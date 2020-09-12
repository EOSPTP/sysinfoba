<?php
	session_start();
	include "config/koneksi.php";
	include "config/fungsi_rupiah.php";
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=ERD_KOREKSI_BA.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	//$db = getDB('billing');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
/* setting format tabel */
table {
 border-collapse: collapse;
}
</style>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>IPC</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<body>
<table>
		<tr>
			<td></td>
		<td>
			<table>
			<?php
			$kode_ba=$_POST['kode_ba'];
			$sql_nb=mysql_query("select * from ba where KODE_BA='$kode_ba'");
			$data_nb=mysql_fetch_array($sql_nb);
			$ID_PERMOHONAN=$data_nb['ID_PERMOHONAN'];
			$remarks=$data_nb['REMARKS'];
			$no_ba=$data_nb['NO_BA'];
			
			$per=mysql_query("select * from permohonan,mst_customer,mst_aplikasi where permohonan.CUSTOMER=mst_customer.ID_CUSTOMER and permohonan.ID_APLIKASI=mst_aplikasi.ID_APLIKASI and ID_PERMOHONAN='$ID_PERMOHONAN'");
			$data_per=mysql_fetch_array($per);
			$NO_PERMOHONAN=$data_per['NO_PERMOHONAN'];
			$aplikasi=$data_per['NAMA_APLIKASI'];
			$customer=$data_per['NAMA_CUSTOMER'];
			?>
				<tr><td></td></tr>
				<tr><td colspan='8' align="center"><p>REKAPITULASI KOREKSI NOTA <?php echo $aplikasi;?></p></td></tr>
				<tr><td colspan='8' align="center"><p><?php echo $customer;?> UNTUK KEGIATAN DI 
				<?php $ter=mysql_query("select * from ba_terminal where NO_PERMOHONAN='$NO_PERMOHONAN'");
				$jm=mysql_num_rows($ter);
			if($jm == '1')
			{
				$dt=mysql_fetch_array($ter);
			$id_terminal=$dt['ID_TERMINAL'];
			$ss=mysql_query("select * from mst_terminal where ID_TERMINAL='$id_terminal' ORDER BY NAMA_TERMINAL ASC");
			$dd=mysql_fetch_array($ss);
			$nama_terminal=$dd['DESCRIPTION'];
			echo "$nama_terminal";
			}
			else
			{	
			while($data_ter=mysql_fetch_array($ter))
			{
			$id_terminal=$data_ter['ID_TERMINAL'];
			$ss=mysql_query("select * from mst_terminal where ID_TERMINAL='$id_terminal' ORDER BY NAMA_TERMINAL ASC");
			$dd=mysql_fetch_array($ss);
			$nama_terminal=$dd['DESCRIPTION'];
			echo "$nama_terminal & ";
			}
			}?></p></td></tr>
			</table>
		</td>
	</tr>	
</table>
<br>
<table>
<tr>
		<td>
	<table border='1'>
	<tr bgcolor="#c2c3c4">
	<?php
	$kode_bax=$_POST['kode_ba'];
	$sql=mysql_query("select * from ba,mst_nota where ba.KODE_BA=mst_nota.KODE_BA and mst_nota.KODE_BA='$kode_bax'");
	?>
		<th rowspan='2'>
			NO
		</th>
		<th rowspan='2'>
			NO REQ
		</th>	
		<th rowspan='2'>
			NO NOTA LAMA
		</th>
		<th rowspan='2'>
			STATUS
		</th>	
		<th rowspan='2'>
			JUMLAH TAGIHAN NOTA LAMA
		</th>		
		<?php
		$by_lama_sql=mysql_query("select * from mst_nota where KODE_BA='$kode_bax'");
		$by_lama_data=mysql_fetch_array($by_lama_sql);
		$no_req_baru=$by_lama_data['NO_REQ_BARU'];
		$biaya_sharing_lama=$by_lama_data['BIAYA_SHARING_LAMA'];
		$biaya_sharing_baru=$by_lama_data['BIAYA_SHARING_BARU'];
		if($biaya_sharing_lama == '')
		{
			echo "";
		}		
		else
		{	
		?>
		<th rowspan='2'>
			BIAYA <br>SHARING LAMA
		</th>	
		<?php
		}
		?>
		<?php
		if($no_req_baru == '')
		{
			echo "";
		}
		else
		{		
		?>	
		<th rowspan='2'>
			NO REQ BARU
		</th>
		<?php
		}
		?>
		<th rowspan='2'>
			NO NOTA BARU
		</th>
		<th rowspan='2'>
			STATUS
		</th>
		<th rowspan='2'>
			JUMLAH TAGIHAN BARU
		</th>
		<?php
		if($biaya_sharing_baru == '')
		{
			echo "";
		}
		else
		{		
		?>		
		<th rowspan='2'>
			BIAYA <br>SHARING BARU
		</th>
		<?php
		}
		?>	
	</tr>	
</table>
<table border='1' align="center">
	<?php
	$no=1;
	while($row=mysql_fetch_array($sql)) {
		$id_modul=$row['ID_MODUL'];
		$mod=mysql_query("select * from mst_modul where ID_MODUL='$id_modul'");
		$data_mod=mysql_fetch_array($mod);
		$nama_modul=$data_mod['NAMA_MODUL'];
		
		$no_req_baru=$row['NO_REQ_BARU'];
		
		$sharing_lama=$row['BIAYA_SHARING_LAMA'];
		$sharing_baru=$row['BIAYA_SHARING_BARU'];
		
		$BIAYA_SHARING_LAMA=rupiah($row['BIAYA_SHARING_LAMA']);
		$BIAYA_SHARING_BARU=rupiah($row['BIAYA_SHARING_BARU']);
		$JML_NOTA_LAMA=rupiah($row['JML_NOTA_LAMA']);
		$JML_NOTA_BARU=rupiah($row['JML_NOTA_BARU']);
	?>
		<tr>
			<td></td>
			<?php
			if($sharing_lama == '' and $sharing_baru == '' and $no_req_baru == '')
			{
				echo "<td colspan='7'>$nama_modul</td>";
			}	
			else
			{
				echo "<td colspan='10'>$nama_modul</td>";
			}	
			?>
		</tr>
	<?php	
		echo "<tr bgcolor='#ffffff' style='text-align: center; vertical-align:middle;mso-number-format:\"\@\"'>";
		echo "<td>" . $no . "</td>";
		echo "<td>" . $row["NO_REQ"] . "</td>";
		echo "<td>" . $row["NO_NOTA_LAMA"] . "</td>";
		echo "<td>" . $row["STATUS_LAMA"] . "</td>";
		echo "<td>" . $JML_NOTA_LAMA . "</td>";
	if($sharing_lama == '')
	{
		echo "";
	}
	else
	{
		echo "<td>$BIAYA_SHARING_LAMA</td>";
	}	
	if($no_req_baru == '')
	{
		echo "";
	}
	else
	{
		echo "<td>" . $row["NO_REQ_BARU"] . "</td>";
	}
		echo "<td>" . $row["NO_NOTA_BARU"] . "</td>";
		echo "<td>" . $row["STATUS_BARU"] . "</td>";
		echo "<td>" . $JML_NOTA_BARU . "</td>";
	if($sharing_baru == '')
	{
		echo "";
	}
	else
	{
		echo "<td>$BIAYA_SHARING_BARU</td>";
	}		
	$no++;	
	}
	?>
</table>
</td>
</tr>
</table>
<table>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo nl2br (stripslashes($remarks));?></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
		<td colspan="2">Dibuat oleh Sistem Informasi <br> Tanggal Cetak 
		<?php 
		$tgl=date("d");
		$bln=date("m");
		$bulan=mysql_query("select * from bulan where ID_BULAN='$bln'");
		$data_bulan=mysql_fetch_array($bulan);
		$cc=$data_bulan['NAMA_BULAN'];
		$thn=date("Y");
		
		echo "$tgl $cc $thn";
		?></td>
		</tr>
		<tr>
		<td colspan="2">NO. BA</td>
		<td><?php echo $no_ba;?></td>
		<td></td>
		<td align="right" colspan="2">
			Verifikasi 
		</td>
		<td><?php
		$username=$_SESSION['username'];
		$user=mysql_query("select * from tbl_user where USERNAME='$username'");
		$data_user=mysql_fetch_array($user);
		$REALNAME=$data_user['REALNAME'];
		
		echo "<strong>$REALNAME</strong>";
		?>
		</td>
		<td colspan='2'>................................</td>
		</tr>
</table>
</body>