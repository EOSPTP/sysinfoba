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
          	<h3><i class="fa fa-table"></i> Berita Acara</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		  <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="media.php?hal=cari_ba" method="post">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Cari</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama" name="nama" required/>
                              </div>
							 <input type="submit" class="btn btn-theme" name="submit" value="Cari">
                          </div>
				  </form>
				  

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap --><br>
										<div id="hasil">
										<table border="1" class="table">
											<?php
											include "config/pagination1.php";
											$sql=mysql_query("select * from permohonan,mst_customer,mst_aplikasi,ba where 
											permohonan.CUSTOMER=mst_customer.ID_CUSTOMER and permohonan.ID_APLIKASI=mst_aplikasi.ID_APLIKASI and permohonan.ID_PERMOHONAN=ba.ID_PERMOHONAN ORDER BY permohonan.ID_PERMOHONAN DESC");
											
											  //pagination config start
											$rpp = 20; // jumlah record per halaman
											$reload = "media.php?hal=koreksi_nota&pagination=true";
											$page = intval($_GET["page"]);
											if($page<=0) $page = 1;  
											$tcount = mysql_num_rows($sql);
											$tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
											$count = 0;
											$i = ($page-1)*$rpp;
											$no_urut = ($page-1)*$rpp;
											//pagination config end
											?>
												<thead>
													<tr>
														<th class="center">NO
														</th>
														<th>NO PERMOHONAN</th>
														<th>NO SURAT</th>
														<th>NO BA</th>
														<th>PIC</th>
														<th>STATUS</th>
														<th>TOOLS</th>
														<th></th>
														<?php
														$ddxy=mysql_fetch_array($sql);
														$STS=$ddxy['STATUS_BA'];
														
														if($STS == '' || $STS == 'PENGERJAAN'){
															echo "<th></th>";
														}
														elseif($STS == 'DONE' || $STS == 'REJECT'){
															echo "";
														}
														?>
													</tr>
												</thead>
												<?php 
												$no=1;
												 while(($count<$rpp) && ($i<$tcount)) {
												mysql_data_seek($sql,$i);
												$data = mysql_fetch_array($sql);	
													$ID_PERMOHONAN=$data['ID_PERMOHONAN'];			
													$NO_PERMOHONAN=$data['NO_PERMOHONAN'];			
													$TGL_PERMOHONAN=$data['TGL_PERMOHONAN'];			
													$NO_SURAT=$data['NO_SURAT'];
													
													$date=date("d-m-Y");
													$tgl=abs($TGL_PERMOHONAN-$date);
													
													$PIC=$data['PIC'];	
												
													$KODE_BA=$data['KODE_BA'];
													$NO_BA=$data['NO_BA'];
													$STATUS_BA=$data['STATUS_BA'];
													
													$ssx=mysql_query("select * from approve_ba where KODE_BA='$KODE_BA'");
													$ddx=mysql_fetch_array($ssx);
													$NOTES=$ddx['NOTES'];
													
													$ssxw=mysql_query("select * from detail_ba where KODE_BA='$KODE_BA'");
													$ddxw=mysql_fetch_array($ssxw);
													$PRIORITAS=$ddxw['PRIORITAS'];
													
													$ssx=mysql_query("select * from mst_nota where KODE_BA='$KODE_BA'");
													$ddx=mysql_fetch_array($ssx);
													$KETERANGAN=$ddx['KETERANGAN'];
													
													$ssy=mysql_query("select * from tbl_user where ID='$PIC'");
													$ddy=mysql_fetch_array($ssy);
													$REALNAME=$ddy['REALNAME'];
												?>
												<tbody>
													<?php 
													if($STATUS_BA == "PENGERJAAN") 
													{ 
														echo "<tr bgcolor='FFF585'>"; 
													} 
													elseif($STATUS_BA == "DONE")
													{
														echo "<tr bgcolor='979998'>";
													}
													elseif($STATUS_BA == "REJECT")
													{
														echo "<tr bgcolor='ED2424'>";
													}
													?>
														<td class="center">
															<?php echo ++$no_urut;?> 
														</td>

														<td><?php echo $NO_PERMOHONAN;?></td>
														<td><?php echo $NO_SURAT;?></td>
														
														<td>
															<?php
															if($NO_BA == '')
															{
															?>
															<a href="media.php?hal=tambah_ba&no=<?php echo $NO_PERMOHONAN;?>"><button class="btn btn-xs btn-warning">
																<i class="ace-icon fa fa-plus bigger-120"> BA</i>
															</button>
															</a>
															<?php	
															}
															else
															{
																echo "$NO_BA";
															}		
															?>
														</td>
														<td><?php echo $REALNAME;?></td>
														<td>
														<?php 
														if($STATUS_BA == 'IN PROGRESS')
														{
															echo "<a href='media.php?hal=detail_ba&kode_ba=$KODE_BA'><button class='btn btn-xs btn-primary'>SEND</button>";
														}
														elseif($STATUS_BA == 'PENGERJAAN')
														{
															echo "PENGERJAAN";	
														}	
														elseif($STATUS_BA == "FINISH")
															{
															 ?>	
															 <a href="selesai_siklus.php?kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-warning">
																DONE
															</button>
															</a>
															<?php
															}
															elseif($STATUS_BA == "REJECT")
															{
															 ?>	
															 <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal">
																REJECT
															</button>
															<!-- Modal -->
															<div id="myModal" class="modal fade" role="dialog">
															<div class="modal-dialog">
															<!-- konten modal-->
															<div class="modal-content">
															<!-- heading modal -->
															<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">REJECT BA</h4>
															</div>
															<!-- body modal -->
															<div class="modal-body">
															<p>NOTES : <?php echo $NOTES;?></p>
															</div>
															<!-- footer modal -->
															<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
															</div>
															</div>
															</div>
															</div>		
															<?php
															}
															elseif($STATUS_BA == 'DONE')
															{
															echo "SELESAI";	
															}	
															?>
															
														</td>
														<td>
															<?php
															if($STATUS_BA == "REJECT" || $STATUS_BA == "DONE")
															{
															?>
															<a href="ubah_status.php?kode_ba=<?php echo $KODE_BA;?>&status=<?php echo $STATUS_BA;?>"><button class="btn btn-xs btn-warning">
																Ubah Status
															</button>
															</a>
															<?php
															}
															
															if($PRIORITAS == '')
															{
																echo "";
															}
															elseif($PRIORITAS !== "" AND $STATUS_BA == "FINISH") 
															{
															?>
															<a href="media.php?hal=tambahprio&kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-danger">
																+ Prioritas
															</button>
															</a>
															<?php
															}
															elseif($PRIORITAS != "")
															{
															?>
															<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#priModal">
																Prioritas
															</button>
															</a>
															<div id="priModal" class="modal fade" role="dialog">
															<div class="modal-dialog">
															<!-- konten modal-->
															<div class="modal-content">
															<!-- heading modal -->
															<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">PRIORITAS</h4>
															</div>
															<!-- body modal -->
															<div class="modal-body">
															<table id="dynamic-table" class="table table-striped table-bordered table-hover">
															<?php
															$nota=mysql_query("select * from detail_ba,divisi where detail_ba.ID_DIVISI=divisi.ID_DIVISI and KODE_BA='$KODE_BA' and STAT='Y' ORDER BY PRIORITAS ASC");
															?>
																<thead>
																	<tr>
																		<th>NO</th>
																		<th>DIVISI</th>
																		<th>PRIORITAS</th>
																	</tr>
																</thead>
																<?php
																$no1=1;
																 while($dt=mysql_fetch_array($nota)){
																	 $PRIORITAS1=$dt['PRIORITAS'];
																	 $DIVISI1=$dt['DIVISI'];
																?>
																<tbody>
																	<tr>
																		<td><?php echo $no1;?></td>
																		<td><?php echo $DIVISI1;?></td>
																		<td><?php echo $PRIORITAS1;?></td>
																	</tr>
																</tbody>
																<?php
																$no1++;
																}
																?>	
															</table>
															</div>
															<!-- footer modal -->
															<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
															</div>
															</div>
															</div>
															</div>		
															<?php
															}
															?>
															<div class="hidden-sm hidden-xs btn-group">
															<a href="media.php?hal=jejakba&kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-info">
																 Log BA
															</button>
															</a>
															<a href="media.php?hal=detail_berita_acara&kode_ba=<?php echo $KODE_BA;?>">
															<button class="btn btn-xs btn-success">
																<i class="ace-icon fa fa-check bigger-120"> Detail</i>
															</button>
															</a>
															<?php
															if($STATUS_BA == "")
															{
																	echo "";
															}
															elseif($STATUS_BA == "IN PROGRESS")
															{		
															?>
															<a href="media.php?hal=tambah_kesalahan&kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-warning">
																<i class="ace-icon fa fa-plus bigger-120"> Kesalahan</i>
															</button>
															</a>
															<?php
															}
															elseif($STATUS_BA = "PENGERJAAN")
															{
																echo "";
															}
															?>
															</td>
															<td>
															<a href="media.php?hal=edit_ba&kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-warning">
																Edit
															</button>
															</a>
															<a href="hapus_ba.php?kode_ba=<?php echo $KODE_BA;?>" onclick="return confirm('Apakah Anda Yakin?');"><button class="btn btn-xs btn-danger">
																Hapus
															</button>
															</a>
															</td>
													</tr>
												</tbody>
												<?php
												$i++;
												$count++;
												}
												?>
											</table>
											 <center><div><?php echo paginate_one($reload, $page, $tpages); ?></div></center>
	</div>
          		</div>
          	</div>
			
	
		</section><! --/wrapper -->
		
		