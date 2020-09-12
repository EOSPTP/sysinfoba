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
											if ((isset($_POST['submit'])) AND ($_POST['nama'] <> "")) {
											$search = $_POST['nama'];
											$sql=mysql_query("select * from permohonan,mst_customer,mst_aplikasi,ba where 
											permohonan.CUSTOMER=mst_customer.ID_CUSTOMER and permohonan.ID_APLIKASI=mst_aplikasi.ID_APLIKASI and STATUS_PERMOHONAN = 'APPROVE' and permohonan.ID_PERMOHONAN=ba.ID_PERMOHONAN and ba.NO_BA LIKE '%$search%' ORDER BY permohonan.ID_PERMOHONAN DESC");
											$jumlah = mysql_num_rows($sql); 
											  if ($jumlah > 0) {
												echo '<p>Ada '.$jumlah.' data yang sesuai.</p>';
													$nomor=1;
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
													
													$ss=mysql_query("select * from ba where ID_PERMOHONAN='$ID_PERMOHONAN'");
													$dd=mysql_fetch_array($ss);
													$KODE_BA=$dd['KODE_BA'];
													$NO_BA=$dd['NO_BA'];
													$STATUS_BA=$dd['STATUS_BA'];
													
													$ssx=mysql_query("select * from mst_nota where KODE_BA='$KODE_BA'");
													$ddx=mysql_fetch_array($ssx);
													$KETERANGAN=$ddx['KETERANGAN'];
													
													$ssy=mysql_query("select * from tbl_user where ID='$PIC'");
													$ddy=mysql_fetch_array($ssy);
													$REALNAME=$ddy['REALNAME'];
												?>
												<tbody>
													<?php 
													if($tgl < "4" AND $STATUS_BA == "") 
													{ 
														echo "<tr bgcolor='FFF585'>"; 
													} 
													elseif($tgl >= "5") 
													{ 
														echo "<tr bgcolor='B02600'>";
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
															 <a href="media.php?hal=reject222&?kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-danger">
																REJECT
															</button>
															</a>
															<?php
															}
															elseif($STATUS_BA == 'DONE')
															{
															echo "SELESAI";	
															}	
															?>
															
														</td>
														<td>
															<a href="media.php?hal=prioritas&kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-danger">
																Prioritas
															</button>
															</a>
															<div class="hidden-sm hidden-xs btn-group">
															<a href="media.php?hal=jejakba&kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-info">
																 Jejak BA
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
													</tr>
												</tbody>
												<?php
												$i++;
												$count++;
												}
												}
								  else {
								   // menampilkan pesan zero data
									echo 'Maaf, hasil pencarian tidak ditemukan.';
								  }
								} 
								else { ?>
								<table border="1" class="table">
											<?php
											include "config/pagination1.php";
											$sql=mysql_query("select * from permohonan,mst_customer,mst_aplikasi,ba where 
											permohonan.CUSTOMER=mst_customer.ID_CUSTOMER and permohonan.ID_APLIKASI=mst_aplikasi.ID_APLIKASI and STATUS_PERMOHONAN = 'APPROVE' and permohonan.ID_PERMOHONAN=ba.ID_PERMOHONAN ORDER BY permohonan.ID_PERMOHONAN DESC");
											
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
													
													$ss=mysql_query("select * from ba where ID_PERMOHONAN='$ID_PERMOHONAN'");
													$dd=mysql_fetch_array($ss);
													$KODE_BA=$dd['KODE_BA'];
													$NO_BA=$dd['NO_BA'];
													$STATUS_BA=$dd['STATUS_BA'];
													
													$ssx=mysql_query("select * from mst_nota where KODE_BA='$KODE_BA'");
													$ddx=mysql_fetch_array($ssx);
													$KETERANGAN=$ddx['KETERANGAN'];
													
													$ssy=mysql_query("select * from tbl_user where ID='$PIC'");
													$ddy=mysql_fetch_array($ssy);
													$REALNAME=$ddy['REALNAME'];
												?>
												<tbody>
													<?php 
													if($tgl < "4" AND $STATUS_BA == "") 
													{ 
														echo "<tr bgcolor='FFF585'>"; 
													} 
													elseif($tgl >= "5") 
													{ 
														echo "<tr bgcolor='B02600'>";
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
															 <a href="media.php?hal=reject222&?kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-danger">
																REJECT
															</button>
															</a>
															<?php
															}
															elseif($STATUS_BA == 'DONE')
															{
															echo "SELESAI";	
															}	
															?>
															
														</td>
														<td>
															<a href="media.php?hal=prioritas&kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-danger">
																Prioritas
															</button>
															</a>
															<div class="hidden-sm hidden-xs btn-group">
															<a href="media.php?hal=jejakba&kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-xs btn-info">
																 Jejak BA
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
													</tr>
												</tbody>
												<?php
												$i++;
												$count++;
												}
												?>
												</table>
								<?php
								}
								?>
											</table>
											 <center><div><?php echo paginate_one($reload, $page, $tpages); ?></div></center>
	</div>
          		</div>
          	</div>
			
		</section><! --/wrapper -->
		
		