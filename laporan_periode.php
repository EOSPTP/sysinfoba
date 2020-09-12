<?php
	error_reporting(0);
	include "config/koneksi.php";
	include "config/fungsi_rupiah.php";
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=ERD_KOREKSI_BA_PERIODE.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	//$db = getDB('billing');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
/* setting format tabel */
table {
 font-family: Verdana;
 font-size: 8pt;
 border-width: 1px;
 border-style: solid;
 border-color: #ccd2d2;
 border-collapse: collapse;
 background-color: #f9f9f9;
}
th {
 color: #f00;
 font-size: 8pt;
 text-transform: uppercase;
 text-align: center;
 padding: 0.5em;
 border-width: 1px;
 border-style: solid;
 border-color: #000;
 border-collapse: collapse;
 background-color: #000;
}
td {
 padding: 0.1em;
 color: #272727;
 vertical-align: top;
 border-width: 1px;
 border-style: solid;
 border-color: #000;
 border-collapse: collapse;
 font-size: 8pt;
}
</style>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
 <link rel="shortcut icon" type="image/png" href="images/weblogo.png">
<title>Koreksi Nota</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<body>
<table>
	<tr>
		<td colspan='3'>
				
		</td>
		<td>
			<table>
	<tr>
		<td></td>
		<td></td>
		<td>
			<table style='border-bottom:thick double #000000;'>
				<tr><td></td></tr>
				<tr><td colspan='6' align="center"><h2>REPORT BERITA ACARA KOREKSI NOTA</h2></td></tr>
				<tr><td colspan='6' align="center">
				<?php
				$tgl=date('d-m-Y',strtotime($_POST['tgl']));
				$tgl1=date('d-m-Y',strtotime($_POST['tgl1']));
				
				echo "<h3>TGL  $tgl S/d $tgl1</h3>";?>
				</td>
				</tr>
			</table>
		</td>
	</tr>	
</table>
</td>	
	</tr>
	<tr>
		<td colspan='10'>
		</td>
	</tr>
</table>
<table border='1'>
	<tr bgcolor="#c2c3c4">
	<?php
	$sql=mysql_query("select * from permohonan,mst_customer,mst_aplikasi,ba_terminal,ba
	where 
	permohonan.CUSTOMER=mst_customer.ID_CUSTOMER and 
	permohonan.ID_APLIKASI=mst_aplikasi.ID_APLIKASI and 
	permohonan.NO_PERMOHONAN=ba_terminal.NO_PERMOHONAN and 
	permohonan.ID_PERMOHONAN=ba.ID_PERMOHONAN and 
	ba.TGL_BA>='$tgl' and ba.TGL_BA<='$tgl1' and ba.STATUS_BA='DONE'");
	?>
		<th rowspan='2'>
			NO
		</th>
		<th rowspan='2'>
			CUSTOMER
		</th>
		<th rowspan='2'>
			NO BA
		</th>		
		<th rowspan='2'>
			TGL BA
		</th>		
		<th rowspan='2'>
			PERIHAL
		</th>	
		<th rowspan='2'>
			NO REQ
		</th>
		<th rowspan='2'>
			NO NOTA PREV
		</th>		
		<th rowspan='2'>
			TAGIHAN NOTA PREV
		</th>	
		<th rowspan='2'>
			BIAYA SHARING PREV
		</th>
		<th rowspan='2'>
			NO REQ NEW
		</th>		
		<th rowspan='2'>
			NO NOTA NEW
		</th>
		<th rowspan='2'>
			TAGIHAN NOTA NEW
		</th>
		<th rowspan='2'>
			BIAYA SHARING NEW
		</th>
		<th rowspan='2'>
			APLIKASI
		</th>	
		<th rowspan='2'>
			MODUL
		</th>	
		<th rowspan='2'>
			TERMINAL
		</th>
	</tr>	
</table>
<table border='1' align="center">
	<?php
	$no=1;
	while($row=mysql_fetch_array($sql)) {
		$id_terminal=$row['ID_TERMINAL'];
		$no_permohonan=$row['NO_PERMOHONAN'];
		
		$KODE_BA=$row['KODE_BA'];
		$kod=mysql_query("select * from mst_nota where KODE_BA='$KODE_BA'");
		$data_kod=mysql_fetch_array($kod);
		$id_modul=$data_kod['ID_MODUL'];
		
		$ter=mysql_query("select * from mst_terminal where ID_TERMINAL='$id_terminal'");
		$data_ter=mysql_fetch_array($ter);
		$nama_terminal=$data_ter['NAMA_TERMINAL'];
		
		$mod=mysql_query("select * from mst_modul where ID_MODUL='$id_modul'");
		$data_mod=mysql_fetch_array($mod);
		$nama_modul=$data_mod['NAMA_MODUL'];
		
		$JML_NOTA_LAMA=rupiah($data_kod['JML_NOTA_LAMA']);
		
		$BIAYA_SHARING_LAMA=rupiah($data_kod['BIAYA_SHARING_LAMA']);
		$BIAYA_SHARING_BARU=rupiah($data_kod['BIAYA_SHARING_BARU']);
		
		$JML_NOTA_BARU=rupiah($data_kod['JML_NOTA_BARU']);
		
		echo "<tr bgcolor='#ffffff' style='text-align: center; vertical-align:middle;mso-number-format:\"\@\"'>";
		echo "<td>" . $no . "</td>";
		echo "<td>" . $row["NAMA_CUSTOMER"] . "</td>";
		echo "<td>" . $row["NO_BA"] . "</td>";
		echo "<td>" . $row["TGL_BA"] . "</td>";
		echo "<td>" . $row["PERIHAL"] . "</td>";
		echo "<td>" . $data_kod["NO_REQ"] . "</td>";
		echo "<td>" . $data_kod["NO_NOTA_LAMA"] . "</td>";
		echo "<td>" . $JML_NOTA_LAMA . "</td>";
		echo "<td>" . $BIAYA_SHARING_LAMA . "</td>";
		echo "<td>" . $data_kod["NO_REQ_BARU"] . "</td>";
		echo "<td>" . $data_kod["NO_NOTA_BARU"] . "</td>";
		echo "<td>" . $JML_NOTA_BARU . "</td>";
		echo "<td>" . $BIAYA_SHARING_BARU . "</td>";
		echo "<td>" . $row["NAMA_APLIKASI"] . "</td>";
		echo "<td>" . $nama_modul . "</td>";
		echo "<td>" . $nama_terminal . "</td>";
	$no++;	
	}
	?>
</table>
		</td>
	</tr>	
</table>
		</td>	
	</tr>
	<tr>
		<td colspan='10'>
		</td>
	</tr>
</table>

<table>
		<tr>
			<td colspan="3"><?php
			session_start();
			$name=$_SESSION['username'];
		$user=mysql_query("select * from tbl_user where USERNAME='$name'");
		$data_user=mysql_fetch_array($user);
		$pic=$data_user['REALNAME'];
		
		echo "PIC : $pic";
		?>	</td>
		</tr>
</table>
</body>