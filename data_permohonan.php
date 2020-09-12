<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
            $(function() {
                $("#nama").autocomplete({
                    source: 'autocomplete_per.php'
                });
            });
        </script>
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-table"></i> Permohonan Customer</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		  <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="media.php?hal=cari_per" method="post">
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
										<p align="left"><a href="media.php?hal=tambah_permohonan"><button button class="btn btn-sm btn-info no-radius">Tambah</button></a></p>
										<table border="1" class="table" id="dynamic-table">
											<?php
											include "config/pagination1.php";
											$sql=mysql_query("select * from permohonan,mst_customer,mst_aplikasi where 
											permohonan.CUSTOMER=mst_customer.ID_CUSTOMER and permohonan.ID_APLIKASI=mst_aplikasi.ID_APLIKASI ORDER BY ID_PERMOHONAN DESC");
											
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
														<th>TGL PERMOHONAN</th>
														<th>APLIKASI</th>
														<th>RESTITUSI</th>
														<th>NAMA KAPAL</th>
														<th>VOYAGE</th>
														<th>CUSTOMER</th>
														<th>PIC</th>
														<th>STATUS PERMOHONAN</th>
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
													$NO_SURAT=$data['NO_SURAT'];
													$NAMA_CUSTOMER=$data['NAMA_CUSTOMER'];			
													$TGL_PERMOHONAN=$data['TGL_PERMOHONAN'];			
													$NAMA_APLIKASI=$data['NAMA_APLIKASI'];		
													$STATUS_PERMOHONAN=$data['STATUS_PERMOHONAN'];	
													$VOYAGE=$data['VOYAGE'];	
													$NAMA_KAPAL=$data['NAMA_KAPAL'];	
													$RESTITUSI=$data['RESTITUSI'];	
													$PIC=$data['PIC'];	
													
													$ss=mysql_query("select * from tbl_user where ID='$PIC'");
													$dd=mysql_fetch_array($ss);
													$nama_pic=$dd['REALNAME'];
													
													$ssx=mysql_query("select * from mst_nota where NO_SURAT='$NO_SURAT'");
													$ddx=mysql_fetch_array($ssx);
													$NO_REQ=$ddx['NO_REQ'];
													
												?>
												<tbody>
													<?php 
													if($STATUS_PERMOHONAN == "") 
													{ 
														echo "<tr bgcolor='FFF585'>"; 
													} 
													elseif($STATUS_PERMOHONAN == "APPROVE")
													{
														echo "<tr bgcolor='55AD02'>";
													}
													elseif($STATUS_PERMOHONAN == "REJECT")
													{
														echo "<tr bgcolor='B02600'>";
													}
													?>
														<td class="center">
															<?php echo ++$no_urut;?> 
														</td>

														<td><?php echo $NO_PERMOHONAN;?></td>
														<td><?php echo $TGL_PERMOHONAN;?></td>
														<td><?php echo $NAMA_APLIKASI;?></td>
														<td><?php echo $RESTITUSI;?></td>
														<td><?php echo $NAMA_KAPAL;?></td>
														<td><?php echo $VOYAGE;?></td>
														<td><?php echo $NAMA_CUSTOMER;?></td>
														<td><?php echo $nama_pic;?></td>
														<td><?php
														if($STATUS_PERMOHONAN == "" and $NO_REQ != "")
														{
														?>
														<a href="approve_cs.php?id=<?php echo $ID_PERMOHONAN;?>"><button class="btn btn-success">APPROVE</button></a>
														<a href="media.php?hal=reject_cs&id=<?php echo $ID_PERMOHONAN;?>" onclick="return confirm('Apakah Anda Yakin?');"><button class="btn btn-danger">REJECT</button></a>
														<?php
														}
														elseif($STATUS_PERMOHONAN == "APPROVE")
														{
															echo "APPROVE";
														}
														elseif($STATUS_PERMOHONAN == "REJECT")
														{
															echo "REJECT";
														}
														?>
														</td>
														<td>
														<?php
														if($STATUS_PERMOHONAN == "")
														{
														?>
														<a href="media.php?hal=tambahnota&no_surat=<?php echo $NO_SURAT;?>"><button class="btn btn-info">+Nota</button></a>
														<?php
														}
														elseif($STATUS_PERMOHONAN == "APPROVE" || $STATUS_PERMOHONAN == "REJECT")
														{
															echo "";
														}
														?>
														<br>
														<a href="media.php?hal=edit_permohonan&id=<?php echo $ID_PERMOHONAN;?>"><button class="btn btn-warning">EDIT</button></a>
														<a href="hapus_permohonan.php?id=<?php echo $ID_PERMOHONAN;?>" onclick="return confirm('Apakah Anda Yakin?');"><button class="btn btn-danger">HAPUS</button></a>
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