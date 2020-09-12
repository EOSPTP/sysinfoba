<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus-icon"></i> SEND PRIORITAS</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
				<center><button class="btn btn-success" onclick="addnota(); return false"><i class="ace-icon fa fa-plus plus-icon"></i> Tambah</button></center>
				<form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				<?php
					$kode_ba=$_GET['kode_ba'];
				?>
				<table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                             <tr>
                                <th>DIVISI</th>
                                <th>PRIORITAS</th>
                                <th>TOOLS</th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
                            <tr>
                                <td><select id="divisi" name="divisi[]" class="form-control">
								<?php
								$wry=mysql_query("select * from divisi where ID_DIVISI NOT LIKE '%2%'");
								while($dsd=mysql_fetch_array($wry))
								{
									echo "<option value=$dsd[ID_DIVISI]>$dsd[DIVISI]</option>";	
								}	
								?>
								</select>
								</td>
								 <td><select id="prioritas" name="prioritas[]" class="form-control">
									<option>--PILIH--</option>
									<option value="1">PRIORITAS 1</option>
									<option value="2">PRIORITAS 2</option>
									<option value="3">PRIORITAS 3</option>
									<option value="4">PRIORITAS 4</option>
									<option value="5">PRIORITAS 5</option>
									<option value="6">PRIORITAS 6</option>
								</select>
								</td>
                                <td></td>
                            </tr>
                        </tbody>
					</table>
				</center>
				<div class="clearfix form-actions" style="text-align: right !important">
							<button class="btn btn-info" type="submit" id="submit_form" name="proses">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Submit
							</button>
							<a href="media.php?hal=ba"><button class="btn btn-info" type="button" id="cancel_form">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Back
							</button></a>
					</div>
				</form>
          		</div>
          	</div>
			
		</section><! --/wrapper -->
<script>
var i = 1;
            function addnota() {
//                menentukan target append
                var itemlist = document.getElementById('itemlist');
                
//                membuat element
                var row = document.createElement('tr');
                var kegiatan = document.createElement('td');
                var biaya = document.createElement('td');
                var aksi = document.createElement('td');

//                meng append element
                itemlist.appendChild(row);
                row.appendChild(kegiatan);
                row.appendChild(biaya);
                row.appendChild(aksi);

//                membuat element input
				
				var modul = document.createElement('select');
                modul.setAttribute('name', 'divisi[' + i + ']');
                modul.setAttribute('class', 'form-control');
				
				var opt1 = document.createElement("option");
				var opt2 = document.createElement("option");
				var opt3 = document.createElement("option");
				var opt4 = document.createElement("option");
				var opt5 = document.createElement("option");
				var opt6 = document.createElement("option");
				var opt7 = document.createElement("option");
				
				opt1.value = "";
				opt1.text = "--PILIH--";
				
				opt2.value = "1";
				opt2.text = "SISTEM INFORMASI";

				opt3.value = "3";
				opt3.text = "KEAUNGAN";
				
				opt4.value = "4";
				opt4.text = "TRESURY";
				
				opt5.value = "5";
				opt5.text = "TERMINAL 01";
				
				opt6.value = "6";
				opt6.text = "TERMINAL 02";
				
				opt7.value = "7";
				opt7.text = "ANGGARAN & AKUTANSI";
				

				modul.add(opt1, null);
				modul.add(opt2, null);
				modul.add(opt3, null);
				modul.add(opt4, null);
				modul.add(opt5, null);
				modul.add(opt6, null);
				modul.add(opt7, null);
			
			
				var prioritas = document.createElement('select');
                prioritas.setAttribute('name', 'prioritas[' + i + ']');
                prioritas.setAttribute('class', 'form-control');
				
				var ptp1 = document.createElement("option");
				var ptp2 = document.createElement("option");
				var ptp3 = document.createElement("option");
				var ptp4 = document.createElement("option");
				var ptp5 = document.createElement("option");
				var ptp6 = document.createElement("option");
				var ptp7 = document.createElement("option");
				
				ptp1.value = "";
				ptp1.text = "--PILIH--";
				
				ptp2.value = "1";
				ptp2.text = "PRIORITAS 1";

				ptp3.value = "2";
				ptp3.text = "PRIORITAS 2";
				
				ptp4.value = "3";
				ptp4.text = "PRIORITAS 3";
				
				ptp5.value = "4";
				ptp5.text = "PRIORITAS 4";
				
				ptp6.value = "5";
				ptp6.text = "PRIORITAS 5";
				
				ptp7.value = "6";
				ptp7.text = "PRIORITAS 6";
				

				prioritas.add(ptp1, null);
				prioritas.add(ptp2, null);
				prioritas.add(ptp3, null);
				prioritas.add(ptp4, null);
				prioritas.add(ptp5, null);
				prioritas.add(ptp6, null);
				prioritas.add(ptp7, null);
			
				
                var hapus = document.createElement('span');

//                 meng append element input
                kegiatan.appendChild(modul);
                biaya.appendChild(prioritas);
                aksi.appendChild(hapus);

                hapus.innerHTML = '<button class="btn btn-danger"><i class="ace-icon fa fa-trush trush-icon"></i>Hapus</button>';
//                membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };

                i++;
            }	
</script>


<?php
date_default_timezone_set('Asia/Jakarta');
include "config/koneksi.php";

if(isset($_POST['proses']))
{
	
	mysql_query("update detail_ba set STAT='X' where KODE_BA='$kode_ba'");
	
	mysql_query("update stopper set STATUS_STOPPER='APPROVED', YX='X' where KODE_BA='$kode_ba' AND STATUS_STOPPER='APPROVED'");
	
		$jumlah = count($_POST['prioritas']);	
		for($i=0;$i<$jumlah;$i++)
		{
		$divisi=$_POST['divisi'][$i];
		$prioritas=$_POST['prioritas'][$i];
		
	mysql_query("insert into detail_ba(ID_DETAIL_BA,KODE_BA,ID_DIVISI,PRIORITAS,STAT) 
	values('','$kode_ba','$divisi','$prioritas','Y')");
		}
		
	$tgl_keluar=date("d-m-Y");	
	$jam=date("H:i:s");	
	$ss=mysql_query("select * from detail_ba where KODE_BA='$kode_ba' and PRIORITAS='1' and STAT='Y'");
	$dd=mysql_fetch_array($ss);
	$pri=$dd['ID_DIVISI'];
		
		$ssx=mysql_query("select * from ba,permohonan where ba.ID_PERMOHONAN=permohonan.ID_PERMOHONAN and KODE_BA='$kode_ba'");
		$ddx=mysql_fetch_array($ssx);
		$no_permohonan=$ddx['NO_PERMOHONAN'];
		
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,STATUS_STOPPER,YX) values('','$pri','','$tgl_keluar|$jam','','$kode_ba','$no_permohonan','','Y')");
	
	mysql_query("update ba set STATUS_BA='PENGERJAAN' where KODE_BA='$kode_ba'");
	
	echo "<script>alert('Data DiSimpan >>'); window.location='media.php?hal=ba'</script>";
				
}	
?>
		