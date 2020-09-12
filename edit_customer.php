<section class="wrapper site-min-height">
          	<h3><i class="fa fa-pencil"></i> Edit Customer</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				 <?php
				 $id=$_GET['id'];
				 $dd=mysql_query("select * from mst_customer where ID_CUSTOMER='$id'");
				 while($ss=mysql_fetch_array($dd)){
				 ?>
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Perusahaan</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $ss['NAMA_CUSTOMER'];?>"/>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                              <div class="col-sm-4">
                                  <textarea type="text" class="form-control" name="alamat"><?php echo $ss['ALAMAT'];?></textarea>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No NPWP</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="no_npwp" value="<?php echo $ss['NO_NPWP'];?>">
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No Rekening</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="no_rekening" value="<?php echo $ss['NO_REKENING'];?>">
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
include "config/koneksi.php";

if(isset($_POST['proses']))
{
	$nama=$_POST['nama_customer'];	
	$alamat=$_POST['alamat'];	
	$no_npwp=$_POST['no_npwp'];	
	$no_rekening=$_POST['no_rekening'];	
	
	mysql_query("update mst_customer set NAMA_CUSTOMER='$nama', ALAMAT='$alamat', NO_NPWP='$no_npwp', NO_REKENING='$no_rekening' where ID_CUSTOMER='$id'");
	
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=data_customer'</script>";
}	
?>