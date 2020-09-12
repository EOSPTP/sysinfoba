<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Tambah Terminal</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Terminal</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama" name="nama" required/>
                              </div>
                          </div>
						   <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Deskripsi</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="des" name="deskripsi" required/>
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
	$nama=$_POST['nama'];	
	$deskripsi=$_POST['deskripsi'];	
	mysql_query("insert into mst_terminal(ID_TERMINAL,NAMA_TERMINAL,DESCRIPTION,ID_CABANG,STATUS) values('','$nama','$deskripsi','1','Y')");
	
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=terminal'</script>";
}	
?>