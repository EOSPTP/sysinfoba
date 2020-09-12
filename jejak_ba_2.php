<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
            $(function() {
                $("#nama").autocomplete({
                    source: 'autocomplete_ba.php'
                });
            });
        </script>
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-list"></i> Histori BA</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
				<form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="" method="post">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">NO BA</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama" name="nama" required/>
                              </div>
							 <input type="submit" class="btn btn-theme" name="submit" value="Cari">
                          </div>
				  </form>
					<?php
					if(isset($_POST['submit']))
					{
					?>
										<table id="dynamic-table" class="table table-striped table-bordered table-hover">
											<?php
											$nama=$_POST['nama'];
											
											echo "<h3>Nomor Berita Acara : $nama</h3>";
											$ss=mysql_query("SELECT * FROM ba where NO_BA='$nama'");
											$dd=mysql_fetch_array($ss);
											$dxx=$dd['KODE_BA'];
											$nota=mysql_query("select * from stopper where KODE_BA='$dxx'");
											?>
												<thead>
													<tr>
														<th>NO</th>
														<th>DIVISI</th>
														<th>TGL MASUK</th>
														<th>TGL KELUAR</th>
														<th>DURASI</th>
														<th>STATUS</th>
													</tr>
												</thead>
												<?php
												$no=1;
												 while($dt=mysql_fetch_array($nota)){
													 $PENGIRIM=$dt['PENGIRIM'];
													 $TGL_MASUK=$dt['TGL_MASUK'];
													 $TGL_KELUAR=$dt['TGL_KELUAR'];
													 $STS=$dt['STATUS_STOPPER'];
													 
													 $ss=mysql_query("SELECT * FROM divisi where ID_DIVISI='$PENGIRIM'");
													 $xx=mysql_fetch_array($ss);
													 $divisi1=$xx['DIVISI'];
													 
													 $durasi=abs($TGL_MASUK-$TGL_KELUAR);
												?>
												<tbody>
													<tr>
														<td><?php echo $no;?></td>
														<td><?php echo $divisi1;?></td>
														<td><?php echo $TGL_MASUK;?></td>
														<td><?php echo $TGL_KELUAR;?></td>
														<td><?php 
														if($durasi == $TGL_MASUK)
														{
																echo "0 Hari";
														}	
														else
														{
																echo "$durasi Hari";
														}	
														?></td>
														<td><?php echo $STS;?></td>
													</tr>
												</tbody>
												<?php
												$no++;
												}
												?>
											</table>
											<?php
					}
					?>
          	</div>
			
		</section><! --/wrapper -->