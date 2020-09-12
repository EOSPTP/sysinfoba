<?php
session_start();

$user=$_SESSION['username'];
$xx=mysql_query("select * from tbl_user where username='$user'");
$nn=mysql_fetch_array($xx);
$divisi=$nn['ID_DIVISI'];

include "config/fungsi.php";
$thn=date("Y");
$bln=date("m");
$getID=autonumber("berita_acara_nota","KODE_BA",3,"$bln/$thn/PTP/");
?>
<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
            $(function() {
                $("#nama").autocomplete({
                    source: 'autocomplete.php'
                });
            });
			
			 $(function(){

       $("#form-field-1-1").datepicker({ minDate: 0 });

                $('#form-field-1-1').datepicker({dateFormat: 'dd-mm-yyyy'});

       });
        </script>
  
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Tambah Koreksi Nota</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kode</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="kode_ba" name="kode_ba" value="<?php echo $getID;?>" readonly>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Customer</label>
                              <div class="col-sm-4">
                                   <input type="text" class="form-control" id="nama" name="nama" required/>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Aplikasi</label>
                              <div class="col-sm-4">
                                  <select name="id_aplikasi" class="form-control" id="id_aplikasi">
										<option value="">-- All --</option>
										<?php
										$apl=mysql_query("select * from mst_aplikasi");
										while($data_apl=mysql_fetch_array($apl))
										{
										echo "<option value=$data_apl[ID_APLIKASI]>$data_apl[NAMA_APLIKASI]</option>";
										}
										?>
									</select>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tgl Masuk</label>
                              <div class="col-sm-4">
                                  <input class="form-control date-picker" name="tgl_masuk" id="form-field-1-1" type="text" data-date-format="dd-mm-yyyy" />
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Terminal</label>
                              <div class="col-sm-4">
                                  <?php
										$ter=mysql_query("select * from mst_terminal");
										while($data_ter=mysql_fetch_array($ter))
										{
											echo "<input type='checkbox' name='id_terminal[]' value=$data_ter[ID_TERMINAL]> $data_ter[NAMA_TERMINAL] <br></option>";
										}
										?>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Restitusi</label>
                              <div class="col-sm-4">
                                  <select name="restitusi" class="form-control" id="restitusi" style="width:200px">
										<option value="">-- PILIH --</option>
										<option value="YA">YA</option>
										<option value="TIDAK">TIDAK</option>
										
									</select>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Kapal</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama_kapal" name="nama_kapal">
                              </div>
                          </div>
						   <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Voyage</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="voyage" name="voyage">
                              </div>
                          </div>
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
		
<?php
include "config/koneksi.php";
include "config/fungsi_apa.php";

if(isset($_POST['proses']))
{ 
	$user=$_SESSION['username'];
	$us=mysql_query("select * from tbl_user where USERNAME='$user'");
	$data_us=mysql_fetch_array($us);
	$pic=$data_us['REALNAME'];
	
	$kode_ba=$_POST['kode_ba'];	
	
	$id_aplikasi=$_POST['id_aplikasi'];	
	$tgl_masuk=date("d-m-Y",strtotime($_POST['tgl_masuk']));
	$keterangan=$_POST['keterangan'];
	$nama_kapal=$_POST['nama_kapal'];
	$restitusi=$_POST['restitusi'];
	$voyage=$_POST['voyage'];
	
	$customer=$_POST['nama'];	
	$ss=mysql_query("select * from mst_customer where NAMA_CUSTOMER='$customer'");
	$dd=mysql_fetch_array($ss);
	$id_customer=$dd['ID_CUSTOMER'];
	
	#$lokasi_file    = $_FILES['fupload']['tmp_name'];
	#$tipe_file      = $_FILES['fupload']['type'];
	#$nama_file      = $_FILES['fupload']['name'];
	#$acak           = rand(1,99);
	#$nama_file_unik = $acak.$nama_file; 
	
#if (!empty($lokasi_file)){
    #UploadBanner($nama_file);
	
	if($id_customer == '')
	{
		echo "<script>alert('MAAF NAMA CUSTOMER TIDAK DITEMUKAN'); window.location='media.php?hal=tambahba'</script>";	
	}
	else
	{
	$sql=mysql_query("insert into berita_acara_nota(ID_BA,KODE_BA,NO_BA,TGL_BA,PERIHAL,ID_CUSTOMER,ID_APLIKASI,TGL_MASUK,TGL_KELUAR,STATUS_BA,KETERANGAN,ID_BULAN,TAHUN,PIC,REMARKS,STATUS,FILE_BA,RESTITUSI,NAMA_KAPAL,VOYAGE) 
	values('','$kode_ba','','','','$id_customer','$id_aplikasi','$tgl_masuk','','IN PROGRESS','','','','$pic','OK','Y','','$restitusi','$nama_kapal','$voyage')");
	
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA) values('','$divisi','5','$tgl_masuk','','$kode_ba')");
	
	
	$jumlah= count($_POST['id_terminal']);	
	
	for($i=0;$i<$jumlah;$i++)
	{
		$id_terminal=$_POST['id_terminal'][$i];	
		
		mysql_query("insert into ba_terminal(ID,NO_BA,ID_TERMINAL,KODE_BA) values('','','$id_terminal','$kode_ba')");
	}
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=form_detail_ba&kode_ba=$kode_ba'</script>";
		}
	#}
}		
?>
