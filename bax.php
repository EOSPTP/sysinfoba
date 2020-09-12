<section class="wrapper site-min-height">
          	<h3><i class="fa fa-plus"></i> APPROVE </h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		 <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="proses_approvesi.php" method="post">
				 <?php 
				 $id=$_GET['id'];
					$kb=mysql_query("select * from stopper where ID_STOPPER='$id'");
					$dtba=mysql_fetch_array($kb);
					$kode_bav=$dtba['KODE_BA'];
					?>	
				  <input type="hidden" name="id" value="<?php echo $id;?>">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">UPLOAD BA</label>
                              <div class="col-sm-4">
                                <input type="file" name="fupload" class="form-control">
                              </div>
                          </div>
				 <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">REMARKS</label>
                              <div class="col-sm-4">
                              <textarea type="text" name="remarks" class="form-control"></textarea>
                              </div>
                          </div>		  
						  <table id="dynamic-table" class="table table-striped table-bordered table-hover">
						  <?php
						  $not=mysql_query("select * from mst_nota where KODE_BA='$kode_bav'");
						  ?>
						  <tr>
							<th>NO REQ</th>
							<th>NO NOTA</th>
							<th>STATUS</th>
							<th>TAGIHAN</th>
							<th>BIAYA SHARING</th>
							<th>NO REQ<br>BARU</th>
							<th>NO NOTA<br>BARU</th>
							<th>STATUS</th>
							<th>TAGIHAN<br>BARU</th>
							<th>BIAYA SHARING<br>BARU</th>
						  </tr>
						  <?php
						  while($dt=mysql_fetch_array($not)){
						  ?>
						  <tr>
								<td><?php echo $dt['NO_REQ'];?></td>
								<td><?php echo $dt['NO_NOTA_LAMA'];?></td>
								<td><?php echo $dt['STATUS_LAMA'];?></td>
								<td><?php echo $dt['JML_NOTA_LAMA'];?></td>
								<td><?php echo $dt['BIAYA_SHARING_LAMA'];?></td>
								<td><input type="text" name="no_req_baru[]" class="form-control"></td>
								<td><input type="text" name="no_nota_baru[]" class="form-control"></td>
								<td><input type="text" name="status_baru[]" class="form-control"></td>
								<td><input type="text" name="jml_nota_baru[]" class="form-control"></td>
								<td><input type="text" name="biaya_sharing_baru[]" class="form-control"></td>
						  </tr>
						  <?php
						  }
						  ?>
						  </table>
						  <div class="clearfix form-actions" style="text-align: right !important">
						<button class="btn btn-info" type="submit" id="submit_form" name="proses">
								<i class="ace-icon fa fa-check bigger-110"></i>
								SUBMIT
							</button>	
				  </form>
          		</div>
          	</div>
			
		</section><! --/wrapper -->