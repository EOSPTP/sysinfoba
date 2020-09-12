    <?php
    #koneksi
    mysql_connect("localhost", "root", "");
    mysql_select_db("koreksi_ptp");
    #akhir-koneksi
     
    #ambil data propinsi
    $query = "SELECT ID_KESALAHAN, KESALAHAN FROM kesalahan ORDER BY KESALAHAN";
    $sql = mysql_query($query);
    $arrpropinsi = array();
    while ($row = mysql_fetch_assoc($sql)) {
    $arrpropinsi [ $row['ID_KESALAHAN'] ] = $row['KESALAHAN'];
    }
     
    #action get Kabupaten
    if(isset($_GET['action']) && $_GET['action'] == "getKab") {
    $ID_KESALAHAN = $_GET['ID_KESALAHAN'];
     
    //ambil data kabupaten
    $query = "SELECT ID_DETAIL_KESALAHAN, DETAIL_KESALAHAN FROM detail_kesalahan WHERE ID_KESALAHAN='$ID_KESALAHAN' ORDER BY DETAIL_KESALAHAN";
    $sql = mysql_query($query);
    $arrkab = array();
    while ($row = mysql_fetch_assoc($sql)) {
    array_push($arrkab, $row);
    }
    echo json_encode($arrkab);
    exit;
    }
    ?>
	 <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    $('#keterangan').change(function(){
    $.getJSON('form_kesalahan.php',{action:'getKab', ID_KESALAHAN:$(this).val()}, function(json){
    $('#alasan').html('');
    $.each(json, function(index, row) {
    $('#alasan').append('<option value='+row.ID_DETAIL_KESALAHAN+'>'+row.DETAIL_KESALAHAN+'</option>');
    });
    });
    });
    });
    </script>
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> Form Kesalahan</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				 <?php 
					$kode_ba=$_GET['kode_ba'];
					?>	
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Keterangan</label>
                              <div class="col-sm-4">
                                  <select id="keterangan" name="keterangan" class="form-control">
									   <option value="">-Pilih-</option>
										<?php
										foreach ($arrpropinsi as $ID_KESALAHAN=>$KESALAHAN) {
										echo "<option value='$ID_KESALAHAN'>$KESALAHAN</option>";
										}
										?>
										</select>
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Alasan</label>
                              <div class="col-sm-4">
                                 <select id="alasan" name="alasan" class="form-control">
								</select>
                              </div>
                          </div>
						  
						  <table id="dynamic-table" class="table table-striped table-bordered table-hover">
						  <?php
						  $sql=mysql_query("select * from mst_nota where KODE_BA='$kode_ba' AND KETERANGAN=''");
						  ?>
						  <tr>
							<th></th>
							<th>NO NOTA</th>
						  </tr>
						  <?php
						  while($data=mysql_fetch_array($sql)){
						  ?>
						  <tr>
							<td><input type="checkbox" name="pilih[]" value="<?php echo $data['NO_NOTA_LAMA'];?>"></td>
							<td><?php echo $data['NO_NOTA_LAMA'];?></td>
						  </tr>
						  <?php
						  }
						  ?>
						  </table>
						  <div class="clearfix form-actions" style="text-align: right !important">
							<button class="btn btn-info" type="submit" id="submit_form" name="proses">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Submit
							</button>
							<a href="media.php?hal=ba"><button class="btn btn-info" type="button" id="cancel_form">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Back
							</button></a>
				  </form>
          		</div>
          	</div>
			
		</section><! --/wrapper -->
		
<?php
include "config/koneksi.php";

if(isset($_POST['proses']))
{
		$keterangan=$_POST['keterangan'];
		$alasan=$_POST['alasan'];
		$jumlah = count($_POST['pilih']);	
		for($i=0;$i<$jumlah;$i++)
		{
		$no_nota_lama=$_POST['pilih'][$i];
	
	mysql_query("update mst_nota set KETERANGAN='$keterangan', ALASAN_KETERANGAN='$alasan' where NO_NOTA_LAMA='$no_nota_lama'");
		}
	echo "<script>alert('Data berhasil DiSimpan'); window.location='media.php?hal=tambah_kesalahan&kode_ba=$kode_ba'</script>";
		
				
}	
?>