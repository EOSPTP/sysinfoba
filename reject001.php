<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> REJECT BA </h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				 <?php 
					$id=$_GET['id'];
					$user=$_SESSION['username'];
					
					$sql=mysql_query("select * from tbl_user where username='$user'");
					$data=mysql_fetch_array($sql);
					$ID_USER=$data['ID'];
					$ID_DIVISI=$data['ID_DIVISI'];
					?>	
					<input type="hidden" name="divisi" class="form-control" value="<?php echo $ID_DIVISI;?>">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">UPLOAD BA</label>
                              <div class="col-sm-4">
                                <input type="file" name="fupload" class="form-control">
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">NOTES</label>
                              <div class="col-sm-4">
                                 <textarea type="text" class="form-control" name="notes" placeholder="Catatan"></textarea>
                              </div>
                          </div>
						  <div class="clearfix form-actions" style="text-align: right !important">
							<button class="btn btn-info" type="submit" id="submit_form" name="proses">
								<i class="ace-icon fa fa-check bigger-110"></i>
								REJECT
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
	$tgl=date("d-m-Y");	
	$divisi=$_POST['divisi'];
	$notes=$_POST['notes'];
	$jam=date("H:i:s");
		
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
	$nama_file_unik = $acak.$nama_file; 
	
if (!empty($lokasi_file)){
    UploadBanner($nama_file);	
	
mysql_query("update stopper set PENERIMA='2', TGL_KELUAR='$tgl $jam', STATUS_STOPPER='REJECT' where ID_STOPPER='$id'");	

	
$xx=mysql_query("select * from stopper where ID_STOPPER='$id'");
$yy=mysql_fetch_array($xx);
$no_permohonan=$yy['KODE_BA'];
$kode_ba=$yy['KODE_BA'];
$tgl_keluar=$yy['TGL_KELUAR'];

mysql_query("update ba set STATUS_BA='REJECT' where KODE_BA='$kode_ba'");	

	mysql_query("insert into approve_ba(ID_APPROVE_BA,KODE_BA,TGL,ID_USER,NOTES,ID_DIVISI,FILE_BA_APPROVE,STS) values('','$kode_ba','$tgl $jam','$ID_USER','$notes','$divisi','$nama_file','REJECT')");
	
	mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN,'') values('','2','','$tgl_keluar $jam','','$kode_ba','$no_permohonan','')");
	
	echo "<script>alert('REJECT'); window.location='media.php?hal=approve'</script>";
		
		
}	
}
?>