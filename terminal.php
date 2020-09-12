<section class="wrapper site-min-height">
          	<h3><i class="fa fa-list"></i> Terminal</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		  <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="media.php?hal=cari_terminal" method="post">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Terminal</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama" name="nama" required/>
                              </div>
							 <input type="submit" class="btn btn-theme" name="submit" value="Cari">
                          </div>
				  </form>
				  

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap --><br>
										<div id="hasil">
										<p align="left"><a href="media.php?hal=tambahterminal"><button button class="btn btn-sm btn-info no-radius">Tambah Terminal</button></a></p>
										<table id="dynamic-table" class="table table-striped table-bordered table-hover">
											<?php
											include "config/pagination1.php";
											$sql=mysql_query("select * from mst_terminal ORDER BY NAMA_TERMINAL ASC");
											  //pagination config start
											$rpp = 20; // jumlah record per halaman
											$reload = "media.php?hal=data_terminal&pagination=true";
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
														<th>TERMINAL</th>

														<th>TOOLS</th>
													</tr>
												</thead>
												<?php 
												$no=1;
												 while(($count<$rpp) && ($i<$tcount)) {
												mysql_data_seek($sql,$i);
												$data = mysql_fetch_array($sql);
													$id=$data['ID_TERMINAL'];			
													$nama=$data['NAMA_TERMINAL'];
												?>
												<tbody>
													<tr>
														<td class="center">
															<?php echo ++$no_urut;?> 
														</td>

														<td>
															<?php echo $nama;?>
														</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="media.php?hal=editterminal&id=<?php echo $id;?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red" href="hapusterminal.php?id=<?php echo $id;?>" onclick="return confirm('Apakah Anda Yakin?');">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>
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