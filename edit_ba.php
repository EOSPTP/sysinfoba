<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
			$( function() {
$( "#datepicker" ).datepicker();
} );
</script>
        </script>
  
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Edit BA</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				 <?php 
					$kode_ba=$_GET['kode_ba'];
					
					$sql=mysql_query("select * from ba where KODE_BA='$kode_ba'");
					while($data=mysql_fetch_array($sql)){
					?>	
					<input type="hidden" class="form-control" id="id_ba" name="id_ba" value="<?php echo $data['ID_BA'];?>">
					<div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">NO BA</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="no_ba" name="no_ba" value="<?php echo $data['NO_BA'];?>">
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tgl BA</label>
                              <div class="col-sm-4">
                                  <input class="form-control date-picker" name="tgl_ba" id="datepicker" type="text" value="<?php echo $data['TGL_BA'];?>"/>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Perihal</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama_kapal" name="perihal" value="<?php echo $data['PERIHAL'];?>">
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Upload BA</label>
                              <div class="col-sm-4">
                                  <input type="file" class="form-control" id="fupload" name="fupload">
                              </div>
                          </div>
						  
						  <center>
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NO REQ</th>
                                <th>NO NOTA</th>
                                <th>STATUS</th>
                                <th>TAGIHAN <br>NOTA</th>
                                <th>BIAYA <br>SHARING</th>
                                <th>MODUL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
						<?php
						$sx=mysql_query("SELECT * FROM mst_nota where KODE_BA='$kode_ba'");
						while($dt=mysql_fetch_array($sx)){
							$mod=$dt['ID_MODUL'];
						?>
                            <tr>
                                <input type="hidden" name="id_nota[]" size="5px" required class="form-control" value="<?php echo $dt['ID_NOTA'];?>"/>
                                <td><input type="text" name="no_req[]" size="5px" required class="form-control" value="<?php echo $dt['NO_REQ'];?>"/></td>
                                <td><input type="text" name="no_nota_lama[]" size="8px" class="form-control" value="<?php echo $dt['NO_NOTA_LAMA'];?>"/></td>
                                <td><input type="text" name="status_lama[]" size="5px" class="form-control" value="<?php echo $dt['STATUS_LAMA'];?>"/></td>
                                <td><input type="text" name="jml_nota_lama[]" size="8px" class="form-control" value="<?php echo $dt['JML_NOTA_LAMA'];?>"/></td>
                                <td><input type="text" name="biaya_sharing_lama[]" size="8px" class="form-control" value="<?php echo $dt['BIAYA_SHARING_LAMA'];?>"/></td>
                               <td>
									<select name="modul" class="form-control" id="modul">
									<?php
									$apl=mysql_query("select * from mst_modul");
									while($data_apl=mysql_fetch_array($apl))
									{
										?>
										<option <?php if($mod == $data_apl['ID_MODUL']) { echo "selected='selected'"; } ?> value="<?php echo $data_apl['ID_MODUL'];?>"><?php echo $data_apl['NAMA_MODUL'];?></option>	
									<?php
									}	
									?>
									</select>
								</td>
								<?php
								}
								?>
								</tr>
                        </tbody>
                    </table>
					</center>
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
include "config/fungsi_apa.php";

if(isset($_POST['proses']))
{
	
	$id_ba=$_POST['id_ba'];	
	$no_ba=$_POST['no_ba'];	
	$perihal=$_POST['perihal'];	
	$tgl_ba=date("d-m-Y",strtotime($_POST['tgl_ba']));	
	$jam=date("H:i:s");	
		
	$ss=mysql_query("select * from ba where KODE_BA='$kode_ba'");
	$dd=mysql_fetch_array($ss);
	$id_permohonan=$dd['ID_PERMOHONAN'];

	$ssx=mysql_query("select * from permohonan where ID_PERMOHONAN='$id_permohonan'");
	$ddx=mysql_fetch_array($ssx);
	$tgl_permohonan=$ddx['TGL_PERMOHONAN'];	
	$no_permohonan=$ddx['NO_PERMOHONAN'];	
		
	$bulan=date("m",strtotime($_POST['tgl_ba']));		
	$tahun=date("Y",strtotime($_POST['tgl_ba']));		
		
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
	$nama_file_unik = $acak.$nama_file; 
	
if (!empty($lokasi_file)){
    UploadBanner($nama_file);
	mysql_query("update ba set NO_BA='$no_ba', TGL_BA='$tgl_ba', PERIHAL='$perihal', FILE_BA='$nama_file', STATUS_BA='IN PROGRESS' where ID_BA='$id_ba'");
	
		$jumlah = count($_POST['no_nota_lama']);	
		for($i=0;$i<$jumlah;$i++)
		{
		$id_nota=$_POST['id_nota'][$i];
		$no_req=$_POST['no_req'][$i];
		$no_nota_lama=$_POST['no_nota_lama'][$i];
		$status_lama=$_POST['status_lama'][$i];
		$jml_nota_lama=$_POST['jml_nota_lama'][$i];
		$biaya_sharing_lama=$_POST['biaya_sharing_lama'][$i];
		$modul=$_POST['modul'][$i];
		
	mysql_query("update mst_nota set NO_REQ='$no_req', NO_BA ='$no_ba', NO_NOTA_LAMA='$no_nota_lama', STATUS_LAMA='$status_lama', JML_NOTA_LAMA='$jml_nota_lama', BIAYA_SHARING_LAMA='$biaya_sharing_lama', ID_MODUL='$modul' where ID_NOTA='$id_nota'");
	
	##mysql_query("insert into stopper(ID_STOPPER,PENGIRIM,PENERIMA,TGL_MASUK,TGL_KELUAR,KODE_BA,NO_PERMOHONAN) values('','2','','$tgl_permohonan|$jam','','','$no_permohonan')");
		
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=ba'</script>";
}
}
}	
?>