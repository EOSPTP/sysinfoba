<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Tambah Customer</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Perusahaan</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama" name="nama" required/>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                              <div class="col-sm-4">
                                  <textarea type="text" class="form-control" name="alamat"></textarea>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No NPWP</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="no_npwp">
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No Rekening</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="no_rekening">
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

if(isset($_POST['proses']))
{
	$nama=$_POST['nama_customer'];	
	$alamat=$_POST['alamat'];	
	$no_npwp=$_POST['no_npwp'];	
	$no_rekening=$_POST['no_rekening'];	
	
	mysql_query("insert into mst_customer(ID_CUSTOMER,NAMA_CUSTOMER,ALAMAT,NO_NPWP,NO_REKENING,STATUS) values('','$nama','$alamat','$no_npwp','$no_rekening','Y')");
	
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=data_customer'</script>";
}	
?>