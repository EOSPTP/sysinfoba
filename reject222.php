<section class="wrapper site-min-height">
          	<h3><i class="fa fa-list"></i> REJECT BA</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
										<table border="1" class="table">
											<?php			
											$kode_ba=$_GET['kode_ba'];
											$nota=mysql_query("select * from approve_ba where KODE_BA='$kode_ba'");
											$dt=mysql_fetch_array($nota);
											?>
												
												<tbody>
													<tr>
														<td>NO BA</td>
														<td><?php echo $dt['NO_BA'];?></td>
														</tr>
														<tr>
														<td>NOTES</td>
														<td><?php echo $dt['NOTES'];?></td>
														</tr>
												</tbody>
											</table>
          	</div>
			
		</section><! --/wrapper -->