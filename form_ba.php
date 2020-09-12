<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
			 $(function(){

       $("#form-field-1-1").datepicker({ minDate: 0 });

                $('#form-field-1-1').datepicker({dateFormat: 'dd-mm-yyyy'});

       });
        </script>
  
 <?php
include "config/fungsi.php";
$thn=date("Y");
$bln=date("m");
$getID=autonumber("ba","KODE_BA",3,"$bln/$thn/BA/PTP/");
?> 
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Tambah BA</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				 <?php 
					$id_permohonan=$_GET['id'];
					?>	
					<div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">KODE_BA</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="kode_ba" name="kode_ba" value="<?php echo $getID;?>" readonly>
                              </div>
                          </div>
					<div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">NO BA</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="no_ba" name="no_ba">
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tgl BA</label>
                              <div class="col-sm-4">
                                  <input class="form-control date-picker" name="tgl_ba" id="form-field-1-1" type="text" data-date-format="dd-mm-yyyy" />
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Perihal</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama_kapal" name="perihal">
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Upload BA</label>
                              <div class="col-sm-4">
                                  <input type="file" class="form-control" id="fupload" name="fupload">
                              </div>
                          </div>

						  <center>
				<button class="btn btn-success" onclick="additem(); return false">+ Tambah</button>
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NO REQ</th>
                                <th>NO NOTA</th>
                                <th>STATUS</th>
                                <th>TAGIHAN <br>NOTA</th>
                                <th>BIAYA <br>SHARING</th>
                                <th>MODUL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
                            <tr>
                                <td><input type="text" name="no_req[]" size="5px" required class="form-control" /></td>
                                <td><input type="text" name="no_nota_lama[]" size="8px" class="form-control" /></td>
                                <td><input type="text" name="status_lama[]" size="5px" class="form-control" /></td>
                                <td><input type="text" name="jml_nota_lama[]" size="8px" class="form-control" /></td>
                                <td><input type="text" name="biaya_sharing_lama[]" size="8px" class="form-control" /></td>
                                <td><select id="modul" name="modul[]" class="form-control">
								<?php
								$wry=mysql_query("select * from mst_modul ORDER BY NAMA_MODUL ASC");
								while($dsd=mysql_fetch_array($wry))
								{
									echo "<option value=$dsd[ID_MODUL]>$dsd[NAMA_MODUL]</option>";	
								}	
								?>
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
							<button class="btn btn-info" type="button" id="cancel_form">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Back
							</button>
				  </form>
          		</div>
          	</div>
			
		</section><! --/wrapper -->
		 <script>
var i = 1;
            function additem() {
//                menentukan target append
                var itemlist = document.getElementById('itemlist');
                
//                membuat element
                var row = document.createElement('tr');
                var id = document.createElement('td');
                var jenis = document.createElement('td');
                var barang = document.createElement('td');
                var jumlah = document.createElement('td');
                var biaya = document.createElement('td');
                var kegiatan = document.createElement('td');
                var aksi = document.createElement('td');

//                meng append element
                itemlist.appendChild(row);
                row.appendChild(id);
                row.appendChild(jenis);
                row.appendChild(barang);
                row.appendChild(jumlah);
                row.appendChild(biaya);
                row.appendChild(kegiatan);
                row.appendChild(aksi);

//                membuat element input
				var no_req = document.createElement('input');
                no_req.setAttribute('name', 'no_req[' + i + ']');
                no_req.setAttribute('size', '5px');
                no_req.setAttribute('class', 'form-control');
				
                var no_nota_lama = document.createElement('input');
                no_nota_lama.setAttribute('name', 'no_nota_lama[' + i + ']');
				no_nota_lama.setAttribute('size', '8px');
                no_nota_lama.setAttribute('class', 'form-control');

				var status_lama = document.createElement('input');
                status_lama.setAttribute('name', 'status_lama[' + i + ']');
				status_lama.setAttribute('size', '5px');
                status_lama.setAttribute('class', 'form-control');
				
                var jml_nota_lama = document.createElement('input');
                jml_nota_lama.setAttribute('name', 'jml_nota_lama[' + i + ']');
				jml_nota_lama.setAttribute('size', '8px');
                jml_nota_lama.setAttribute('class', 'form-control');
				
				var biaya_sharing_lama = document.createElement('input');
                biaya_sharing_lama.setAttribute('name', 'biaya_sharing_lama[' + i + ']');
				biaya_sharing_lama.setAttribute('size', '8px');
                biaya_sharing_lama.setAttribute('class', 'form-control');
				
				var modul = document.createElement('select');
                modul.setAttribute('name', 'modul[' + i + ']');
                modul.setAttribute('class', 'form-control');
				
				var opt1 = document.createElement("option");
				var opt2 = document.createElement("option");
				var opt3 = document.createElement("option");
				var opt4 = document.createElement("option");
				var opt5 = document.createElement("option");
				var opt6 = document.createElement("option");
				var opt7 = document.createElement("option");
				var opt8 = document.createElement("option");
				var opt9 = document.createElement("option");
				var opt10 = document.createElement("option");
				var opt11 = document.createElement("option");
				var opt12 = document.createElement("option");

				opt1.value = "10";
				opt1.text = "ANGKUTAN LANGSUNG";

				opt2.value = "3";
				opt2.text = "BATAL MUAT ALIH KAPAL";
				
				opt3.value = "6";
				opt3.text = "BATAL MUAT DELIVERY";
				
				opt4.value = "11";
				opt4.text = "BEHANDLE";
				
				opt5.value = "5";
				opt5.text = "BONGKAR MUAT";
				
				opt6.value = "9";
				opt6.text = "BPRP";
				
				opt7.value = "1";
				opt7.text = "DELIVERY";
				
				opt8.value = "8";
				opt8.text = "GLC & OHC";
				
				opt9.value = "4";
				opt9.text = "RBM";
				
				opt10.value = "2";
				opt10.text = "RECEIVING";

				opt11.value = "7";
				opt11.text = "STUFFING & STRIPPING";
				
				opt11.value = "12";
				opt11.text = "PENUMPUKAN";

				modul.add(opt1, null);
				modul.add(opt2, null);
				modul.add(opt3, null);
				modul.add(opt4, null);
				modul.add(opt5, null);
				modul.add(opt6, null);
				modul.add(opt7, null);
				modul.add(opt8, null);
				modul.add(opt9, null);
				modul.add(opt10, null);
				modul.add(opt11, null);
				modul.add(opt12, null);

                var hapus = document.createElement('span');

//                meng append element input
                id.appendChild(no_req);
                jenis.appendChild(no_nota_lama);
                barang.appendChild(status_lama);
                jumlah.appendChild(jml_nota_lama);
                biaya.appendChild(biaya_sharing_lama);
                kegiatan.appendChild(modul);
                aksi.appendChild(hapus);

                hapus.innerHTML = '<button class="btn btn-danger">Hapus</button>';
//                membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };

                i++;
            }				
</script>
		
<?php
include "config/koneksi.php";
include "config/fungsi_apa.php";

if(isset($_POST['proses']))
{
	$kode_ba=$_POST['kode_ba'];
	$no_ba=$_POST['no_ba'];
	$tgl_ba=$_POST['tgl_ba'];
	$perihal=$_POST['perihal'];
	
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
	$nama_file_unik = $acak.$nama_file; 
	
if (!empty($lokasi_file)){
    UploadBanner($nama_file);

	mysql_query("insert into ba(ID_BA,KODE_BA,NO_BA,TGL_BA,PERIHAL,FILE_BA,STATUS_BA,ID_PERMOHONAN) values('','$kode_ba','$no_ba','$tgl_ba','$perihal','$nama_file','NEW','$id_permohonan')");	
}

	if($nb == NULL)
		{
		$jumlah = count($_POST['no_nota_lama']);	
		for($i=0;$i<$jumlah;$i++)
		{
		$no_req=$_POST['no_req'][$i];
		$no_nota_lama=$_POST['no_nota_lama'][$i];
		$status_lama=$_POST['status_lama'][$i];
		$jml_nota_lama=$_POST['jml_nota_lama'][$i];
		$biaya_sharing_lama=$_POST['biaya_sharing_lama'][$i];
		$modul=$_POST['modul'][$i];
		
	mysql_query("insert into ba(ID_NOTA,NO_REQ,KODE_BA,NO_BA,NO_NOTA_LAMA,STATUS_LAMA,JML_NOTA_LAMA,BIAYA_SHARING_LAMA,NO_REQ_BARU,NO_NOTA_BARU,STATUS_BARU,JML_NOTA_BARU,BIAYA_SHARING_BARU,ID_MODUL) 
	values('','$no_req','$kode_ba','','$no_nota_lama','$status_lama','$jml_nota_lama','$biaya_sharing_lama','','','','','','$modul')");
	echo "<script>alert('Data DiSimpan >>'); window.location='media.php?hal=detail_ba&kode_ba=$kode_ba'</script>";
		}	
	}
}	
?>