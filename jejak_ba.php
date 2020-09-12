<section class="wrapper site-min-height">
          	<h3><i class="fa fa-list"></i> Histori Berita Acara</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
										<table id="dynamic-table" class="table table-striped table-bordered table-hover">
											<?php
											$dxx=$_GET['kode_ba'];
											$nota=mysql_query("select * from stopper where KODE_BA='$dxx'");
											?>
												<thead>
													<tr>
														<th>NO</th>
														<th>PENGIRIM</th>
														<th>PENERIMA</th>
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
													 $PENERIMA=$dt['PENERIMA'];
													 $TGL_MASUK=$dt['TGL_MASUK'];
													 $TGL_KELUAR=$dt['TGL_KELUAR'];
													 $STS=$dt['STATUS_STOPPER'];
													 
													 $ss=mysql_query("SELECT * FROM divisi where ID_DIVISI='$PENGIRIM'");
													 $xx=mysql_fetch_array($ss);
													 $divisi1=$xx['DIVISI'];
													 
													  $ssx=mysql_query("SELECT * FROM divisi where ID_DIVISI='$PENERIMA'");
													 $xxx=mysql_fetch_array($ssx);
													 $divisi2=$xxx['DIVISI'];
													 
													 $durasi=abs($TGL_MASUK-$TGL_KELUAR);
												?>
												<tbody>
													<tr>
														<td><?php echo $no;?></td>
														<td><?php echo $divisi1;?></td>
														<td><?php echo $divisi2;?></td>
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
          	</div>
			
		</section><! --/wrapper -->