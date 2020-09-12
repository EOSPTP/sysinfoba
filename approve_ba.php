<section class="wrapper site-min-height">
          	<h3><i class="fa fa-list"></i> Data Berita Acara</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
										<table border="1" class="table">
											<?php	
											$user=$_SESSION['username'];	
											$sql=mysql_query("select * from tbl_user where username='$user'");
											$data=mysql_fetch_array($sql);
											$divisi=$data['ID_DIVISI'];
											$level=$data['LEVEL'];
											$nota=mysql_query("select * from ba,stopper where ba.KODE_BA=stopper.KODE_BA AND PENGIRIM='$divisi' AND YX='Y'");
											?>
												<thead>
													<tr>
														<th>NO</th>
														<th>NO BA</th>
														<th>TGL MASUK</th>
														<th>TGL KELUAR</th>
														<th>STATUS</th>
														<?php
														$ss=mysql_query("select * from stopper where PENGIRIM='$divisi'");
														$dd=mysql_fetch_array($ss);
														$ngirim=$dd['PENGIRIM'];
														if($ngirim == "1")
														{
															echo "<th>TOOLS</th>";
														}
														else
														{
															echo "";		
														}		
														?>
														<th></th>
													</tr>
												</thead>
												<?php
												$no=1;
												 while($dt=mysql_fetch_array($nota)){
													 $ID_STOPPER=$dt['ID_STOPPER'];
													 $NO_BA=$dt['NO_BA'];
													 $KODE_BA=$dt['KODE_BA'];
													 $STATUS_STOPPER=$dt['STATUS_STOPPER'];
													 $STATUS_KOREKSI=$dt['STATUS_KOREKSI'];
													 $TGL_MASUK=$dt['TGL_MASUK'];
													 $TGL_KELUAR=$dt['TGL_KELUAR'];
													 $FILE=$dt['FILE_BA'];
													 $PENERIMA=$dt['PENERIMA'];
													 $PENGIRIM=$dt['PENGIRIM'];
													 
													 $xxx=mysql_query("select * from mst_nota where KODE_BA='$KODE_BA'");
													 $yyy=mysql_fetch_array($xxx);
													 $coba=$yyy['NO_NOTA_BARU'];
													 
													 $date=date("d-m-Y");
													 $tgl=abs($TGL_MASUK-$date);
												?>
												<tbody>
													<?php 
													if($STATUS_STOPPER == "") 
													{ 
														echo "<tr bgcolor='FFF585'>"; 
													} 
													elseif($STATUS_STOPPER == "APPROVED")
													{
														echo "<tr bgcolor='55AD02'>";
													}
													elseif($STATUS_STOPPER == "KOREKSI")
													{
														echo "<tr bgcolor='FF9EEC'>";
													}
													elseif($STATUS_STOPPER == "REJECT")
													{
														echo "<tr bgcolor='B02600'>";
													}
													?>
														<td><?php echo $no;?></td>
														<td><?php echo $NO_BA;?></td>
														<td><?php echo $TGL_MASUK;?></td>
														<td><?php echo $TGL_KELUAR;?></td>
														<td><?php
														if($STATUS_STOPPER == "" AND $level == "USER" AND $divisi == "1")
														{
															echo "";
														}
														elseif($STATUS_STOPPER == "" AND $level == "USER")
														{	
														?>
														<a href="media.php?hal=approve001&id=<?php echo $ID_STOPPER;?>"><button class="btn btn-success">Approve</button></a>
														<a href="media.php?hal=reject001&id=<?php echo $ID_STOPPER;?>"><button class="btn btn-danger">Reject</button></a>
														<?php
														}
														elseif($STATUS_STOPPER == "" AND $level == "ADMIN")
														{
														?>
														<a href="approve002.php?id=<?php echo $ID_STOPPER;?>"><button class="btn btn-success">Approve</button></a>
														<a href="reject001.php?id=<?php echo $ID_STOPPER;?>"><button class="btn btn-danger">Reject</button></a>
														<?php
														}
														elseif($STATUS_STOPPER == "REJECT")
														{
															echo "REJECT";
														}
														elseif($STATUS_STOPPER == "KOREKSI" and $divisi == "1")
														{
															echo "KOREKSI";
														}
														elseif($STATUS_STOPPER == "APPROVED" and $divisi == "1" and $STATUS_KOREKSI == "KOREKSI" and $level == "USER")
														{
														?>
														<a href="kirim_koreksi.php?id=<?php echo $ID_STOPPER;?>"><button class="btn btn-danger">SEND</button></a>
														<?php
														}
														elseif($STATUS_STOPPER == "APPROVED" and $divisi != "0")
														{
															echo "APPROVED";	
														}	
														?>
														</td>
														<?php
														if($PENGIRIM != "1")
														{
															echo "";
														}
														else
														{		
														?>
														<td>
														<?php
														if($divisi == "1" and $level == "USER" and $STATUS_STOPPER == "APPROVED" and $coba == "")
														{
														?>
														<a href="media.php?hal=bax&id=<?php echo $ID_STOPPER;?>"><button class="btn btn-warning">+ Koreksi</button></a>
														<?php
														}
														elseif($divisi == "1" and $level == "USER" and $STATUS_STOPPER == "APPROVED" || $STATUS_STOPPER == "KOREKSI" and $coba != "")
														{
														?>
														<a href="media.php?hal=edit_bax&id=<?php echo $ID_STOPPER;?>"><button class="btn btn-warning">Edit</button></a>
														<?php
														}
														elseif($divisi == "1" and $level == "USER" and $STATUS_STOPPER == "")
														{
															echo "";
														}	
														?>
														</td>
														<?php
														}
														?>
														<td><a href="media.php?hal=detail_berita_acara2&kode_ba=<?php echo $KODE_BA;?>"><button class="btn btn-primary">Detail</button></a></td>
													</tr>
												</tbody>
												<?php
												$no++;
												}
												?>
											</table>
          	</div>
			
		</section><! --/wrapper -->