<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.11.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
            $(function() {
                $("#nama").autocomplete({
                    source: 'autocomplete.php'
                });
            });
        </script>
<section class="wrapper site-min-height">
          	<h3><i class="fa fa-list"></i> Customer</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		  <form class="form-horizontal style-form" enctype="multipart/form-data" role="form" action="media.php?hal=cari_customer" method="post">
				  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Perusahaan</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="nama" name="nama" required/>
                              </div>
							 <input type="submit" class="btn btn-theme" name="submit" value="Cari">
                          </div>
				  </form>
				  

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap --><br>
										<div id="hasil">
										<p align="left"><a href="media.php?hal=tambahcustomer"><button button class="btn btn-sm btn-info no-radius">Tambah Customer</button></a></p>
										<table id="dynamic-table" class="table table-striped table-bordered table-hover">
											<?php
											include "config/pagination1.php";
											$sql=mysql_query("select * from mst_customer where STATUS='Y' ORDER BY NAMA_CUSTOMER ASC");
											  //pagination config start
											$rpp = 20; // jumlah record per halaman
											$reload = "media.php?hal=data_customer&pagination=true";
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
														<th>CUSTOMER</th>
														<th>ALAMAT</th>
														<th>NO NPWP</th>
														<th>No REKENING</th>
														<th>STATUS</th>

														<th>TOOLS</th>
													</tr>
												</thead>
												<?php 
												$no=1;
												 while(($count<$rpp) && ($i<$tcount)) {
												mysql_data_seek($sql,$i);
												$data = mysql_fetch_array($sql);
													$id=$data['ID_CUSTOMER'];			
													$nama=$data['NAMA_CUSTOMER'];			
													$alamat=$data['ALAMAT'];			
													$no_npwp=$data['NO_NPWP'];			
													$no_rekening=$data['NO_REKENING'];			
													$status=$data['STATUS'];			
												?>
												<tbody>
													<tr>
														<td class="center">
															<?php echo ++$no_urut;?> 
														</td>

														<td>
															<?php echo $nama;?>
														</td>
														<td><?php echo $alamat;?></td>
														<td class="hidden-480"><?php echo $no_npwp;?></td>
														<td><?php echo $no_rekening;?></td>

														<td class="hidden-480">
															<?php echo $status;?>
														</td>

														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="media.php?hal=edit_customer&id=<?php echo $id;?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red" href="hapuscustomer.php?id=<?php echo $id;?>" onclick="return confirm('Apakah Anda Yakin?');">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>

															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
																			</a>
																		</li>
																	</ul>
																</div>
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