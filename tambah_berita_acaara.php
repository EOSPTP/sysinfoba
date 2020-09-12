<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
			$( function() {
$( "#datepicker" ).datepicker();
} );
</script>
  
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Tambah BA</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				 <?php 
					$no_permohonan=$_GET['no'];
					include "config/fungsi.php";
					$thn=date("Y");
					$bln=date("m");
					$getID=autonumber("ba","KODE_BA",3,"$bln/$thn/BA/PTP/");
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
                                  <input class="form-control date-picker" name="tgl_ba" id="datepicker" type="text"/>
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
	$ss=mysql_query("select * from permohonan where NO_PERMOHONAN='$no_permohonan'");
	$dd=mysql_fetch_array($ss);
	$id_permohonan=$dd['ID_PERMOHONAN'];
	$no_surat=$dd['NO_SURAT'];
	
	$kode_ba=$_POST['kode_ba'];	
	$no_ba=$_POST['no_ba'];	
	$perihal=$_POST['perihal'];	
	$tgl_ba=date("d-m-Y",strtotime($_POST['tgl_ba']));	
	$jam=date("H:i:s");	
		
	$bulan=date("m",strtotime($_POST['tgl_ba']));		
	$tahun=date("Y",strtotime($_POST['tgl_ba']));		
		
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
	$nama_file_unik = $acak.$nama_file; 
	
if (!empty($lokasi_file)){
    UploadBanner($nama_file);
	mysql_query("insert into ba(ID_BA,KODE_BA,NO_BA,TGL_BA,PERIHAL,FILE_BA,STATUS_BA,ID_PERMOHONAN) values('','$kode_ba','$no_ba','$tgl_ba $jam','$perihal','$nama_file','IN PROGRESS','$id_permohonan')");
	
	mysql_query("update stopper set KODE_BA='$kode_ba' where NO_PERMOHONAN='$no_permohonan'");
	
	mysql_query("update mst_nota set KODE_BA='$kode_ba', NO_BA='$no_ba', ID_BULAN='$bulan', TAHUN='$tahun' where NO_SURAT='$no_surat'");
	
	
		echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=tambah_kesalahan&kode_ba=$kode_ba'</script>";

}
}	
?>