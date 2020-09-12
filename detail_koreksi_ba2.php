<section class="wrapper site-min-height">
          	<h3><i class="fa fa-list"></i> Detail Berita Acara</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
										
										<table id="dynamic-table" class="table table-striped table-bordered table-hover">
											<?php
											$kode_ba=$_GET['kode_ba'];
											$sql=mysql_query("select * from permohonan,ba,mst_customer,mst_aplikasi where permohonan.ID_PERMOHONAN=ba.ID_PERMOHONAN and
											permohonan.CUSTOMER=mst_customer.ID_CUSTOMER and permohonan.ID_APLIKASI=mst_aplikasi.ID_APLIKASI and ba.KODE_BA='$kode_ba' ORDER BY KODE_BA");
											$data = mysql_fetch_array($sql);
													$ID_BA=$data['ID_BA'];			
													$NO_PERMOHONAN=$data['NO_PERMOHONAN'];			
													$NO_BA=$data['NO_BA'];			
													$NAMA_CUSTOMER=$data['NAMA_CUSTOMER'];			
													$TGL_BA=$data['TGL_BA'];			
													$PERIHAL=$data['PERIHAL'];			
													$NAMA_APLIKASI=$data['NAMA_APLIKASI'];		
													$TGL_MASUK=$data['TGL_PERMOHONAN'];			
													$TGL_KELUAR=$data['TGL_KELUAR'];			
													$RESTITUSI=$data['RESTITUSI'];			
													$NAMA_KAPAL=$data['NAMA_KAPAL'];			
													$VOYAGE=$data['VOYAGE'];	
													
													$xxx=mysql_query("select * from mst_nota where KODE_BA='$kode_ba'");
													$yyy=mysql_fetch_array($xxx);
													$NO_NOTA_BARU=$yyy['NO_NOTA_BARU'];
											?>
												<tbody>
													<tr>
														<th>NO BA</th>
														<td><?php echo $NO_BA;?></td>
													</tr>
													<tr>		
														<th>CUSTOMER</th>
														<td><?php echo $NAMA_CUSTOMER;?></td>
													</tr>
													<tr>		
														<th>TGL BA</th>
														<td><?php echo $TGL_BA;?></td>
													</tr>	
													<tr>
														<th>PERIHAL</th>
														<td><?php echo $PERIHAL;?></td>
													</tr>
													<tr>	
														<th>APLIKASI</th>
														<td><?php echo $NAMA_APLIKASI;?></td>
													</tr>	
													<tr>		
														<th>TGL MASUK</th>
														<td><?php $ssx=mysql_query("select * from stopper where KODE_BA='$kode_ba'");
														$ddx=mysql_fetch_array($ssx);
														
														echo $ddx['TGL_MASUK'];?></td>
													</tr>
													<tr>	
														<th>TGL KELUAR</th>
														<td><?php 
														$ss=mysql_query("select * from stopper where KODE_BA='$kode_ba'");
														$dd=mysql_fetch_array($ss);
														
														echo $dd['TGL_KELUAR'];?></td>
													</tr>
													<tr>	
														<th>RESTITUSI</th>
														<td><?php echo $RESTITUSI;?></td>
													</tr>
													<tr>	
														<th>NAMA KAPAL</th>
														<td><?php echo $NAMA_KAPAL;?></td>
													</tr>
													<tr>	
														<th>VOYAGE</th>
														<td><?php echo $VOYAGE;?></td>
													</tr>
													<tr>
													<th>TERMINAL</th>
													<?php
													$ter=mysql_query("select * from ba_terminal where NO_PERMOHONAN='$NO_PERMOHONAN'");
													while($data_ter=mysql_fetch_array($ter))
													{
														$id_terminal=$data_ter['ID_TERMINAL'];
														$ss=mysql_query("select * from mst_terminal where ID_TERMINAL='$id_terminal'");
														$dd=mysql_fetch_array($ss);
														$nama_terminal=$dd['NAMA_TERMINAL'];
													echo "<td>$nama_terminal</td>";
													}
													?>
												</tr>
												<tr>		
														<th>FILE BA</th>
														<td><?php
													$bb=mysql_query("select * from ba where KODE_BA='$kode_ba'");
													$cc=mysql_fetch_array($bb);
													$FILE_BA=$cc['FILE_BA'];
													?>
													<a href="file/<?php echo $FILE_BA;?>" target="_blank"><button class="btn btn-info">View</button></a>
													</td>
													</tr>
												</tbody>
											</table>
											
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
											<?php
											$nota=mysql_query("select * from mst_nota,mst_modul where mst_nota.ID_MODUL=mst_modul.ID_MODUL and KODE_BA='$kode_ba' ORDER BY NO_NOTA_LAMA");
											?>
												<thead>
													<tr>
														<th>NO REQ</th>
														<th>NO NOTA</th>
														<th>STATUS</th>
														<th>TAGIHAN</th>
														<?php
														$sharing_sql=mysql_query("select * from mst_nota where KODE_BA='$kode_ba'");
														$sharing_data=mysql_fetch_array($sharing_sql);
														$NO_REQX=$sharing_data['NO_REQ_BARU'];
														$biaya_sharing_lama=$sharing_data['BIAYA_SHARING_LAMA'];
														if($biaya_sharing_lama == '')
														{
															echo "";
														}		
														else
														{
														echo "<th>BIAYA SHARING</th>";
														}
														if($NO_REQX != '')
														{
														?>
														<th>NO REQ <br>BARU</th>
														<th>NO NOTA <br>BARU</th>
														<th>STATUS</th>
														<th>TAGIHAN<br>BARU</th>
														<?php
														$sharing_sqlx=mysql_query("select * from mst_nota where KODE_BA='$kode_ba'");
														$sharing_datax=mysql_fetch_array($sharing_sqlx);
														$biaya_sharing_baru=$sharing_datax['BIAYA_SHARING_BARU'];
														if($biaya_sharing_baru == '')
														{
															echo "";
														}		
														else
														{
															echo "<th>BIAYA SHARING BARU</th>";
														}
														}
														?>
														<th>KETERANGAN</th>
														<th>ALASAN</th>
													</tr>
												</thead>
												<?php
												$no=1;
												 while($dt=mysql_fetch_array($nota)){
													 $ID_NOTA=$dt['ID_NOTA'];
													 $NO_REQ=$dt['NO_REQ'];
													 $NAMA_MODUL=$dt['NAMA_MODUL'];
													 $NO_NOTA_LAMA=$dt['NO_NOTA_LAMA'];
													 $STATUS_LAMA=$dt['STATUS_LAMA'];
													 $JML_NOTA_LAMA=rupiah($dt['JML_NOTA_LAMA']);
													 $BIAYA_SHARING_LAMA=rupiah($dt['BIAYA_SHARING_LAMA']);
													 $NO_REQ_BARU=$dt['NO_REQ_BARU'];
													 $NO_NOTA_BARU=$dt['NO_NOTA_BARU'];
													 $STATUS_BARU=$dt['STATUS_BARU'];
													 $JML_NOTA_BARU=rupiah($dt['JML_NOTA_BARU']);
													 $BIAYA_SHARING_BARU=rupiah($dt['BIAYA_SHARING_BARU']);
													 
													 $sharing_lama=$dt['BIAYA_SHARING_LAMA'];
													 $sharing_baru=$dt['BIAYA_SHARING_BARU'];

													 $keterangan=$dt['KETERANGAN'];
													 $alasan=$dt['ALASAN_KETERANGAN'];
													 $df=mysql_query("select * from kesalahan where ID_KESALAHAN='$keterangan'");
													 $rt=mysql_fetch_array($df);
													 $KESALAHAN=$rt['KESALAHAN'];
													 
													 $dfx=mysql_query("select * from detail_kesalahan where ID_DETAIL_KESALAHAN='$alasan'");
													 $rtx=mysql_fetch_array($dfx);
													 $DKESALAHAN=$rtx['DETAIL_KESALAHAN'];
												?>
												<tbody>
													<tr>
														<td><?php echo $NO_REQ;?></td>
														<td><?php echo $NO_NOTA_LAMA;?></td>
														<td><?php echo $STATUS_LAMA;?></td>
														<td><?php echo $JML_NOTA_LAMA;?></td>
														<?php
														if($sharing_lama == '')
														{
															echo "";
														}		
														else
														{
														echo "<td>$BIAYA_SHARING_LAMA</td>";
														}
														
														if($NO_REQ_BARU != '')
														{
														?>
														<td><?php echo $NO_REQ_BARU;?></td>
														<td><?php echo $NO_NOTA_BARU;?></td>
														<td><?php echo $STATUS_BARU;?></td>
														<td><?php echo $JML_NOTA_BARU;?></td>
														<?php
														if($sharing_baru == '')
														{
															echo "";
														}		
														else
														{
														echo "<td>$BIAYA_SHARING_BARU</td>";
														}
														}
														?>
														<td>
														<?php echo $KESALAHAN;?>
														</td>
														<td><?php echo $DKESALAHAN;?></td>
													</tr>
												</tbody>
												<?php
												}
												?>
											</table>
											<div class="clearfix form-actions" style="text-align: right !important">
											<?php
											if($NO_NOTA_BARU == '')
											{
												echo "~~";
											}
											else
											{	
											?>
							<form action="export.php" method="post">
							<input type="hidden" name="kode_ba" value="<?php echo $kode_ba;?>">
							<button class="btn btn-info" type="submit" id="submit_form">
								<i class="ace-icon fa fa-check bigger-110"></i>
								CETAK
							</button>
							</form>
							<?php
							}
							?>
							</div>							
											<center><a href="media.php?hal=approve"><button class="btn btn-info">Kembali</button></a></center>
          	</div>
			
		</section><! --/wrapper -->