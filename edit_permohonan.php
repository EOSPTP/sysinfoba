<?php
$user=$_SESSION['username'];
$xx=mysql_query("select * from tbl_user where username='$user'");
$nn=mysql_fetch_array($xx);
$divisi=$nn['ID_DIVISI'];
?>
<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
			$( function() {
$( "#datepicker" ).datepicker();
} );
</script>
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Tambah Permohonan</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				<?php
				$id=$_GET['id'];
				$sql=mysql_query("select * from permohonan,mst_customer where permohonan.CUSTOMER=mst_customer.ID_CUSTOMER and ID_PERMOHONAN='$id'");
				while($data=mysql_fetch_array($sql)){
				?>
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No Permohonan</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="no_permohonan" name="no_permohonan" value="<?php echo $data['NO_PERMOHONAN'];?>" readonly>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No Surat</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?php echo $data['NO_SURAT'];?>">
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tgl Permohonan</label>
                              <div class="col-sm-4">
                                  <input class="form-control date-picker" name="tgl_permohonan" id="datepicker" type="text" value="<?php echo $data['TGL_PERMOHONAN'];?>"/>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Customer</label>
                              <div class="col-sm-4">
                                   <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['NAMA_CUSTOMER'];?>"/>
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
                                  <input type="text" class="form-control" id="nama_kapal" name="nama_kapal" value="<?php echo $data['NAMA_KAPAL'];?>">
                              </div>
                          </div>
						   <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Voyage</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="voyage" name="voyage" value="<?php echo $data['VOYAGE'];?>">
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
						  <?php
							}
							?>
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
	$pic=$_POST['pic'];	
	
	$id_aplikasi=$_POST['id_aplikasi'];	
	$tgl_permohonan=date("d-m-Y",strtotime($_POST['tgl_permohonan']));
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
	
	$sql=mysql_query("update permohonan set TGL_PERMOHONAN='$tgl_permohonan', ID_APLIKASI='$aplikasi', CUSTOMER='$customer', NO_SURAT='$no_surat', PIC='$id_customer', voyage='$voyage', RESTITUSI='$restitusi', NAMA_KAPAL='$nama_kapal', ID_TERMINAL='$id_terminal' where NO_PERMOHONAN='$no_permohonan'");
	
		
	$jumlah= count($_POST['id_terminal']);	
	
	for($i=0;$i<$jumlah;$i++)
	{
		$id_terminal=$_POST['id_terminal'][$i];	
		
		mysql_query("update ba_terminal set ID_TERMINAL='$id_terminal' where NO_PERMOHONAN='$no_permohonan'");
	}
	
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=permohonan'</script>";
	#}
}		
?>
