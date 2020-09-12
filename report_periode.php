<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
$( function() {
$( "#datepicker" ).datepicker();
} );

$( function() {
$( "#datepicker1" ).datepicker();
} );
</script>
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-print"></i> Laporan Koreksi Nota Per Periode</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="laporan_periode.php" method="post">
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tgl</label>
                              <div class="col-sm-4">
							  <input type="text" id="datepicker" class="form-control" name="tgl">
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">S/d</label>
                              <div class="col-sm-4">
							  <input type="text" id="datepicker1" class="form-control" name="tgl1">
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