<?php
$id=$_GET['id'];

$query=mysql_query("select * from permohonan where ID_PERMOHONAN='$id'");
$sql=mysql_fetch_array($query);
$no=$sql['NO_PERMOHONAN'];
?>
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-pencil"></i> Reject CS</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Keterangan</label>
                              <div class="col-sm-4">
								<select name="ket" class="form-control">
								<option>---Pilih--</option>
								<option value="BA">Buat BA</option>
								<option value="Surat">Buat Surat Jawaban</option>
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
if(isset($_POST['proses'])){
include "config/koneksi.php";
$ket=$_POST['ket'];
		mysql_query("update permohonan set STATUS_PERMOHONAN='REJECT', NOTE_PERMOHONAN='$ket' where ID_PERMOHONAN='$id'");
		
		echo "<script>alert('BUAT BA'); window.location='media.php?hal=tambah_ba&no=$no'</script>";	
}
?>