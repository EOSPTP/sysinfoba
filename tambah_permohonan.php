<?php
session_start();

$user=$_SESSION['username'];
$xx=mysql_query("select * from tbl_user where username='$user'");
$nn=mysql_fetch_array($xx);
$divisi=$nn['ID_DIVISI'];

include "config/fungsi.php";
$thn=date("Y");
$bln=date("m");
$getID=autonumber("permohonan","NO_PERMOHONAN",3,"$bln/$thn/PRMN/PTP/");
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
</script>
  
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Tambah Permohonan</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No Permohonan</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="no_permohonan" name="no_permohonan" value="<?php echo $getID;?>" readonly>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No Surat</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="no_surat" name="no_surat">
                              </div>
                          </div>
						   <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Perihal Surat</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="perihal_surat" name="perihal_surat">
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
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">PIC</label>
                              <div class="col-sm-4">
                                  <select name="pic" class="form-control">
								  <option>--PILIH PIC--</option>
								  <?php
								  $sc=mysql_query("select * from tbl_user where ID_DIVISI='2'");
								  while($kc=mysql_fetch_array($sc)){
									  echo "<option value=$kc[ID]>$kc[REALNAME]</option>";
								  }
								  ?>
								  </select>
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
date_default_timezone_set('Asia/Jakarta');
include "config/koneksi.php";
include "config/fungsi_apa.php";

if(isset($_POST['proses']))
{ 
	$no_permohonan=$_POST['no_permohonan'];	
	$no_surat=$_POST['no_surat'];	
	$perihal_surat=$_POST['perihal_surat'];	
	$pic=$_POST['pic'];	
	
	$id_aplikasi=$_POST['id_aplikasi'];	
	$tgl_permohonan=date("d-m-Y");
	$jam=date("H:i:s");
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
	$sql=mysql_query("insert into permohonan(ID_PERMOHONAN,NO_PERMOHONAN,NO_SURAT,PERIHAL_SURAT,TGL_PERMOHONAN,CUSTOMER,ID_APLIKASI,NAMA_KAPAL,VOYAGE,RESTITUSI,PIC,STATUS_PERMOHONAN) 
	values('','$no_permohonan','$no_surat','$perihal_surat','$tgl_permohonan|$jam','$id_customer','$id_aplikasi','$nama_kapal','$voyage','$restitusi','$pic','')");
	
		
	$jumlah= count($_POST['id_terminal']);	
	
	for($i=0;$i<$jumlah;$i++)
	{
		$id_terminal=$_POST['id_terminal'][$i];	
		
		mysql_query("insert into ba_terminal(ID,ID_TERMINAL,NO_PERMOHONAN) values('','$id_terminal','$no_permohonan')");
	}
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN) values('','2','','$tgl_permohonan|$jam','','','$no_permohonan')");
	
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=permohonan'</script>";
		}
	#}
}		
?>
