<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="media.php"><img src="assets/img/friends/logo_ptp.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $nama;?></h5>
              	  <h5 class="centered"><?php echo $divisi;?></h5>
              	  <hr>	
                  <li class="mt">
                      <a href="media.php?hal=home">
                          <i class="fa fa-dashboard"></i>
                          <span>Home</span>
                      </a>
                  </li>
				  <?php
				  if($id_divisi == "2")
				  {
				  ?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Master</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="media.php?hal=data_customer">Customer</a></li>
                          <li><a  href="media.php?hal=data_aplikasi">Aplikasi</a></li>
                          <li><a  href="media.php?hal=data_terminal">Terminal</a></li>
                      </ul>
                  </li>
				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-briefcase"></i>
                          <span>Data</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="media.php?hal=permohonan">Permohonan</a></li>
                          <li><a  href="media.php?hal=ba">Berita Acara</a></li>
                      </ul>
                  </li>
				  <?php
				  }
				  else
				  {
				  ?>
				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Data Koreksi</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="media.php?hal=approve">Berita Acara</a></li>
                          <li><a  href="media.php?hal=jejakba2">Histori Ba</a></li>
                      </ul>
                  </li>
				  <?php
				  }
				  ?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-print"></i>
                          <span>Report</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="media.php?hal=laporan_periode">Report Periode</a></li>
                      </ul>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>