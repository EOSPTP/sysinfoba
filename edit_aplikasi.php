<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Tambah Aplikasi</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="media.php?hal=cari_customer" method="post">
				 <?php
				 $id=$_GET['id'];
				 $ss=mysql_query("select * from mst_aplikasi where ID_APLIKASI='$id'");
				 while($dd=mysql_fetch_array($ss)){
				 ?>
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Aplikasi</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $dd['NAMA_APLIKASI'];?>"/>
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
	$nama=$_POST['nama'];	
	
	mysql_query("update mst_aplikasi set NAMA_APLIKASI='$nama' where ID_APLIKASI='$id'");
	
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=aplikasi'</script>";
}	
?>