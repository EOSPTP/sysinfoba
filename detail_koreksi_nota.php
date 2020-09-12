<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Tambah Koreksi Nota</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				 <?php
					$kode_ba=$_GET['kode_ba'];
					$sql=mysql_query("select * from berita_acara_nota where KODE_BA='$kode_ba'");
					while($data=mysql_fetch_array($sql))
					{
					$customer=$data['ID_CUSTOMER'];
					$aplikasi=$data['ID_APLIKASI'];
					$terminal=$data['ID_TERMINAL'];
					?>
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kode</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="kode_ba" name="kode_ba" value="<?php echo $kode_ba;?>" readonly>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Customer</label>
                              <div class="col-sm-4">
                                  <select name="id_customer" class="form-control" id="id_customer" style="width:200px" readonly>
										<?php
												$cus=mysql_query("select * from mst_customer");
												while($data_cus=mysql_fetch_array($cus))
												{
													if ($data_cus['ID_CUSTOMER']==$customer)
													{
														$slc=" selected=selected";
													}
													else
													{
														$slc="";
													}
													echo "<option value='".$data_cus['ID_CUSTOMER']."' $slc>".$data_cus['NAMA_CUSTOMER']."</option>";
												}
											?>
									</select>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Aplikasi</label>
                              <div class="col-sm-4">
                                  <select name="id_aplikasi" class="form-control" id="id_aplikasi">
										<?php
												$apl=mysql_query("select * from mst_aplikasi");
												while($data_apl=mysql_fetch_array($apl))
												{
													if ($data_apl['ID_APLIKASI']==$aplikasi)
													{
														$alc=" selected=selected";
													}
													else
													{
														$alc="";
													}
													echo "<option value='".$data_apl['ID_APLIKASI']."' $alc>".$data_apl['NAMA_APLIKASI']."</option>";
												}
											?>
									</select>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tgl Masuk</label>
                              <div class="col-sm-4">
                                  <input class="form-control date-picker" name="tgl_masuk" type="text" value="<?php echo $data['TGL_MASUK'];?>" readonly>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Terminal</label>
                              <div class="col-sm-4">
                                  <?php
												$ter=mysql_query("select * from ba_terminal,mst_terminal where ba_terminal.ID_TERMINAL=mst_terminal.ID_TERMINAL and KODE_BA='$kode_ba'");
												while($data_ter=mysql_fetch_array($ter))
												{
													$NAMA_TERMINAL=$data_ter['ID_TERMINAL'];	
													$checked = explode(', ', $data_ter['ID_TERMINAL']);
												?>	
													<input type="checkbox" name="id_terminal" value="<?php echo $data_ter['ID_TERMINAL'];?>" <?php in_array ($NAMA_TERMINAL, $checked) ? print "checked" : ""; ?>> <?php echo $data_ter['NAMA_TERMINAL'];?> <br>
												<?php
												}
											?>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Restitusi</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" name="restitusi" value="<?php echo $data['RESTITUSI'];?>" readonly>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Kapal</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama_kapal" name="nama_kapal" value="<?php echo $data['NAMA_KAPAL'];?>" readonly>
                              </div>
                          </div>
						   <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Voyage</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="voyage" name="voyage" value="<?php echo $data['VOYAGE'];?>" readonly>
                              </div>
                          </div>
						  <?php
							}
							?>
          		</div>
				<br>
				<center>
				<button class="btn-success" onclick="additem(); return false"><i class="ace-icon fa fa-plus plus-icon"></i> Tambah</button>
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NO REQ</th>
                                <th>NO NOTA LAMA</th>
                                <th>STATUS</th>
                                <th>TAGIHAN <br>NOTA LAMA</th>
                                <th>BIAYA <br>SHARING LAMA</th>
                                <th>NO REQ BARU</th>
                                <th>NO NOTA BARU</th>
                                <th>STATUS</th>
                                <th>TAGIHAN <br>NOTA BARU</th>
                                <th>BIAYA <br>SHARING BARU</th>
                                <th>MODUL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
                            <tr>
                                <td><input type="text" name="no_req[]" size="5px" required class="input-block-level" /></td>
                                <td><input type="text" name="no_nota_lama[]" size="8px" class="input-block-level" /></td>
                                <td><input type="text" name="status_lama[]" size="5px" class="input-block-level" /></td>
                                <td><input type="text" name="jml_nota_lama[]" size="8px" class="input-block-level" /></td>
                                <td><input type="text" name="biaya_sharing_lama[]" size="8px" class="input-block-level" /></td>
                                <td><input type="text" name="no_req_baru[]" size="8px" class="input-block-level" /></td>
                                <td><input type="text" name="no_nota_baru[]" size="8px" class="input-block-level" /></td>
                                <td><input type="text" name="status_baru[]" size="5px" class="input-block-level" /></td>
                                <td><input type="text" name="jml_nota_baru[]" size="8px" class="input-block-level" /></td>
                                <td><input type="text" name="biaya_sharing_baru[]" size="8px" class="input-block-level" /></td>
                                <td><select id="modul" name="modul[]">
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
					</div>
					</form>
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
                var req = document.createElement('td');
                var hasil = document.createElement('td');
                var stok = document.createElement('td');
                var qty = document.createElement('td');
                var sharing = document.createElement('td');
                var kegiatan = document.createElement('td');
                var aksi = document.createElement('td');

//                meng append element
                itemlist.appendChild(row);
                row.appendChild(id);
                row.appendChild(jenis);
                row.appendChild(barang);
                row.appendChild(jumlah);
                row.appendChild(biaya);
                row.appendChild(req);
                row.appendChild(hasil);
                row.appendChild(stok);
                row.appendChild(qty);
                row.appendChild(sharing);
                row.appendChild(kegiatan);
                row.appendChild(aksi);

//                membuat element input
				var no_req = document.createElement('input');
                no_req.setAttribute('name', 'no_req[' + i + ']');
                no_req.setAttribute('size', '5px');
                no_req.setAttribute('class', 'input-block-level');
				
                var no_nota_lama = document.createElement('input');
                no_nota_lama.setAttribute('name', 'no_nota_lama[' + i + ']');
				no_nota_lama.setAttribute('size', '8px');
                no_nota_lama.setAttribute('class', 'input-block-level');

				var status_lama = document.createElement('input');
                status_lama.setAttribute('name', 'status_lama[' + i + ']');
				status_lama.setAttribute('size', '5px');
                status_lama.setAttribute('class', 'input-block-level');
				
                var jml_nota_lama = document.createElement('input');
                jml_nota_lama.setAttribute('name', 'jml_nota_lama[' + i + ']');
				jml_nota_lama.setAttribute('size', '8px');
                jml_nota_lama.setAttribute('class', 'input-block-level');
				
				var biaya_sharing_lama = document.createElement('input');
                biaya_sharing_lama.setAttribute('name', 'biaya_sharing_lama[' + i + ']');
				biaya_sharing_lama.setAttribute('size', '8px');
                biaya_sharing_lama.setAttribute('class', 'input-block-level');
				
				var no_req_baru = document.createElement('input');
                no_req_baru.setAttribute('name', 'no_req_baru[' + i + ']');
				no_req_baru.setAttribute('size', '8px');
                no_req_baru.setAttribute('class', 'input-block-level');
				
				var no_nota_baru = document.createElement('input');
                no_nota_baru.setAttribute('name', 'no_nota_baru[' + i + ']');
				no_nota_baru.setAttribute('size', '8px');
                no_nota_baru.setAttribute('class', 'input-block-level');
				
				var status_baru = document.createElement('input');
                status_baru.setAttribute('name', 'status_baru[' + i + ']');
				status_baru.setAttribute('size', '5px');
                status_baru.setAttribute('class', 'input-block-level');
				
				var jml_nota_baru = document.createElement('input');
                jml_nota_baru.setAttribute('name', 'jml_nota_baru[' + i + ']');
				jml_nota_baru.setAttribute('size', '8px');
                jml_nota_baru.setAttribute('class', 'input-block-level');
				
				var biaya_sharing_baru = document.createElement('input');
                biaya_sharing_baru.setAttribute('name', 'biaya_sharing_baru[' + i + ']');
				biaya_sharing_baru.setAttribute('size', '8px');
                biaya_sharing_baru.setAttribute('class', 'input-block-level');
				
				var modul = document.createElement('select');
                modul.setAttribute('name', 'modul[' + i + ']');
                modul.setAttribute('class', 'input-block-level');
				
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
                hasil.appendChild(no_nota_baru);
                req.appendChild(no_req_baru);
                stok.appendChild(status_baru);
                qty.appendChild(jml_nota_baru);
                sharing.appendChild(biaya_sharing_baru);
                kegiatan.appendChild(modul);
                aksi.appendChild(hapus);

                hapus.innerHTML = '<button class="btn-danger"><i class="ace-icon fa fa-trush trush-icon"></i>Hapus</button>';
//                membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };

                i++;
            }				
</script>
<?php
include "config/koneksi.php";

if(isset($_POST['proses']))
{
	
	$jumlah = count($_POST['no_nota_lama']);
	
	for($i=0;$i<$jumlah;$i++)
	{
		$no_req=$_POST['no_req'][$i];
		$no_nota_lama=$_POST['no_nota_lama'][$i];
		$status_lama=$_POST['status_lama'][$i];
		$jml_nota_lama=$_POST['jml_nota_lama'][$i];
		$biaya_sharing_lama=$_POST['biaya_sharing_lama'][$i];
		$no_req_baru=$_POST['no_req_baru'][$i];
		$no_nota_baru=$_POST['no_nota_baru'][$i];
		$status_baru=$_POST['status_baru'][$i];
		$jml_nota_baru=$_POST['jml_nota_baru'][$i];
		$biaya_sharing_baru=$_POST['biaya_sharing_baru'][$i];
		$modul=$_POST['modul'][$i];
		
	mysql_query("insert into mst_nota(ID_NOTA,NO_REQ,KODE_BA,NO_BA,NO_NOTA_LAMA,STATUS_LAMA,JML_NOTA_LAMA,BIAYA_SHARING_LAMA,NO_REQ_BARU,NO_NOTA_BARU,STATUS_BARU,JML_NOTA_BARU,BIAYA_SHARING_BARU,ID_MODUL) 
	values('','$no_req','$kode_ba','','$no_nota_lama','$status_lama','$jml_nota_lama','$biaya_sharing_lama','$no_req_baru','$no_nota_baru','$status_baru','$jml_nota_baru','$biaya_sharing_baru','$modul')");
	
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=ba'</script>";
	}
}	
?>		