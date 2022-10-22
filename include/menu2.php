
    <!-- fixed-top-->
    <nav class='header-navbar navbar-shadow  navbar-expand-md navbar navbar-with-menu navbar-flipped-top navbar-light navbar-border navbar-brand-center'>
      <div class='navbar-wrapper'>
        <div class='navbar-header'>
          <ul class='nav navbar-nav flex-row'>
            <li class='nav-item mobile-menu d-md-none mr-auto' data-toggle="tooltip" data-original-title="Menu Mobile"><a class='nav-link nav-menu-main menu-toggle hidden-xs' href='#'><i class='ft-menu font-large-1'></i></a></li>
            <li class='nav-item'><a class='navbar-brand' href='index.php'  data-toggle="tooltip" data-original-title="Homepages"><img class='brand-logo' src='themes/edosen-app.png' width='32px' height='29px'>
                <h2 class='brand-text secondary text-bold-700'><b>E-DOSEN</b></h2></a></li>
            <li class='nav-item d-none'><a class='nav-link open-navbar-container' data-toggle='collapse' data-target='#navbar-mobile'><i class='fa fa-ellipsis-v'></i></a></li>
			<li class='nav-item d-md-none'><a class='nav-link hidden-xs' href='admin.php?page=tgs' data-toggle="tooltip" data-original-title="Tugas Open">
				<i class='font-large-1 icon icon-bell'></i><span class='badge badge-pill badge-default badge-danger badge-default badge-up'><?php echo $countgs; ?></span></a>
			</li>
			<li class='nav-item d-md-none'><a class='nav-link hidden-xs' href='?page=on&usr=<?php echo "$_SESSION[username]";?>'  data-toggle="tooltip" data-original-title="Profile"><i class='ft-users font-large-1'></i></a></li>
          </ul>
        </div>
        <div class='navbar-container container center-layout'>
          <div class='collapse navbar-collapse' id='navbar-mobile'>
            <ul class='nav navbar-nav mr-auto float-left'>
              <li class='nav-item d-none d-md-block'><a class='nav-link nav-menu-main menu-toggle hidden-xs' href='index.php'><i class='ft-menu'></i></a></li>
			  <!--
              <li class='dropdown nav-item mega-dropdown'><a class='dropdown-toggle nav-link gray-dark ' href='#' data-toggle='dropdown'><b>INFO</b></a>
                <ul class='mega-dropdown-menu dropdown-menu row'>
				  <li class='col-md-4'>
                    <h6 class="dropdown-menu-header text-uppercase"><i class="icon-earphones-alt"></i> <b>PT. nio teknologi</b></h6>
					<h6 class='mt-2 mb-1'>Jl.Epicentru Utama No.9 Gedung <b>Studio 1 ANTV</b> Lant. 2  Kuningan – Jakarta selatan</h6>
					<h6 class='mb-2'>Jl. Raya Lubeg No.5C Batungga Taba, Kec.Lubuk Begalung Kab.Padang Timur  – Sumatera Barat</h6>
					<ul class="drilldown-menu">
                      <li class="menu-list">
                        <ul>
                          <li><a class="dropdown-item"><i class="icon-call-out"></i> 021 80647888 – 0751 4481252</a></li>
                          <li><a class="dropdown-item"><i class="fa fa-whatsapp"></i> +62822 8874 6559</a></li>
                          <li><a class="dropdown-item"><i class="icon-bubbles"></i> edosen@niozone.com</a></li>
                          <li><a class="dropdown-item" href='https://niozone.com' target='_blank'> <i class="icon-globe"></i> https://niozone.com</a></li>
                        </ul>
                      </li>
                    </ul>
				  </li>
					<?php  if($_SESSION['level'] == 'M'){ ?>


					<?php }else{?>
					  <li class="col-md-5">
						<h6 class="dropdown-menu-header text-uppercase"><i class="icon-wallet"></i> <b> Billing eDosen</b> </h6>
						<?php
						$query = mysqli_query($config, "SELECT * FROM nio_edosen");
							while($row = mysqli_fetch_array($query)){
							$reg = tgl_indo($row['reg']);
							$tempo = tgl_indo($row['tempo']);
						?>
						<h5 class='f16'>Registrasi :<b> 24 September 2018</b></h5>
						<h5 class='f16'>Tagihan Selanjutnya :<b class='danger'> <?php echo $tempo; ?></b></h5><hr/>
						<h5 class='f16'>Paket : <b>eDosen - <?php echo $row['paket']; ?></b><br/> 
											 Dosen : <b><?php echo $row['storage']; ?> Account</b><br/> 
											 Mahasiswa : <b>Unlimited Account</b></h5><hr/>
						<h5 class='f16'>Kapasistas penyimpanan : <b><?php echo $row['hosting']; ?> GB</b><br/>
										Domain : <b><?php echo $row['url']; ?></b></h5>
						<hr/>
						
					  </li>		
					  <li class="col-md-3">
						<h6 class="dropdown-menu-header text-uppercase"><i class="icon-earphones-alt"></i> <b> Help Desk</b></h6>
						<a href="https://api.whatsapp.com/send?phone=6282288746559&text=ID%20eDosen%20%3A*<?php echo $row['idedosen']; ?>*%0A%20*Paket%20%3A*<?php echo $row['paket']; ?>*%0A%0A*Upgrade%20paket%20aplikasi%20eDosen*%20" target='_blank' class='p-1'><span class='btn btn-block btn-secondary pepe f14'> <i class="icon-cup"></i> UPGRADE PAKET</span></a>
						<a href="https://api.whatsapp.com/send?phone=6282288746559&text=*ID%20eDosen%20%3A<?php echo $row['idedosen']; ?>*%0A%20*TAGIHAN%20PERPANJANGG%20DOMAIN%20%3A%20<?php echo $row['paket']; ?>*%0A%0A*Lamp.Bukti%20Pembayaran%20dibawah%20ini*%20" target='_blank'  class='p-1 mb-2'><span class='btn btn-block btn-info pepe f14'> <i class="icon-wallet"></i> BAYAR TAGIHAN</span></a><hr/>
						
					  </li>		
					  <li class="col-md-12 text-center mb-3">						
						<i class='f14'>*Informasi ini hanaya dapat dilihat oleh Superuser & Dosen</i>
					  </li>					
					<?php } } ?>
                </ul>
              </li>
			  -->
			  
              <li class='nav-item d-none d-md-block'><a class='nav-link nav-link-expand' href='#'><i class='ficon ft-maximize'></i></a></li>
              <li class='nav-item nav-search'><a class='nav-link nav-link-search' href='#'><i class='ficon ft-search'></i></a>
                <div class='search-input'>
                  <input class='input' type='text' placeholder='Cari matakuliah anda....!!'>
                </div>
              </li>
            </ul>
            <ul class='nav navbar-nav float-right'>
			<?php if($_SESSION['level'] == 'M'){?>
			
              <li class='dropdown dropdown-notification nav-item' data-toggle="tooltip" data-original-title="Tugas Open"><a class='nav-link nav-link-label' href='#' data-toggle='dropdown'><i class='ficon ft-file-text'></i><span class='badge badge-pill badge-default badge-warning badge-default badge-up'><?php echo $countgs; ?></span></a>
                <ul class='dropdown-menu dropdown-menu-media dropdown-menu-right'>
                  <li class='dropdown-menu-header'>
                    <h6 class='dropdown-header m-0'><span class='danger darken-2'>Notifications Tugas</span></h6>
                  </li>
				  <?php
				  $query = mysqli_query($config, "SELECT * FROM nio_tugas WHERE act='A' AND idk='$_SESSION[kls]'");				
					while($row = mysqli_fetch_array($query)){
					$date = tgl_indo($row['dateline']);
					echo " <li class='scrollable-container media-list'>                      
					  <a href='?page=tgs'>
                      <div class='media'>
                        <div class='media-left align-self-center'><i class='ft-check-circle icon-bg-circle bg-cyan'></i></div>
                        <div class='media-body'>
                          <h6 class='media-heading'><b>Tugas Baru</b> - $row[jenis]</h6>
						  <small><time class='media-meta text-muted'><b>Ditutup :</b> $date</time></small>
                        </div>
                      </div></a>
					</li>";
					}
				  ?>
					
                </ul>
              </li>
			  <?php }else{?>			  
			    <li class='nav-item' data-toggle="tooltip" data-original-title="Tugas Masuk"><a class='nav-link nav-link-label' href='?page=tgs'><i class='ficon ft-file-text'></i><span class='badge badge-pill badge-default badge-warning badge-default badge-up'><?php echo $uptu; ?></span></a></li>
			    <li class='nav-item' data-toggle="tooltip" data-original-title="Bimbingan Terbaru"><a class='nav-link nav-link-label' href='#'><i class='ficon ft-bell'></i><span class='badge badge-pill badge-default badge-primary badge-default badge-up'>137</span></a></li>
			  <?php }?>
			  
              <li class='nav-item' data-toggle="tooltip" data-original-title="Inbox"><a class='nav-link nav-link-label' href='#'><i class='ficon ft-mail'></i><span class='badge badge-pill badge-default badge-danger badge-default badge-up'><?php echo $countgs; ?></span></a></li>
              <li class='dropdown dropdown-user nav-item'><a class='dropdown-toggle nav-link dropdown-user-link' href='#' data-toggle='dropdown'>
			  <span class='avatar avatar-online'>
				<?php
				$query = mysqli_query($config, "SELECT * FROM nio_user WHERE  username='$_SESSION[username]'");
				if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)){
				  if($row['photo'] == ''){echo"<img src='themes/user/avatar.png' alt='avatar' class='border'>";}
				  else{ echo"<img src='themes/user/$row[photo]' alt='avatar' class='border' style='height:35px;'>"; }
				  
				}}?><i></i>
			  </span>
			  <span class='user-name'>
			   <?php
				$query = mysqli_query($config, "SELECT * FROM nio_user WHERE  username='$_SESSION[username]'");
				while($row = mysqli_fetch_array($query)){
				  if($row['nick'] == ''){echo"<b class='danger pepe'>Your Nickname</b>";}
				  else{ echo"<b class='danger'><span class='pepe'>@$row[nick]</span></b>"; }
				  
				}
				?>
			   </span></a>
                <div class='dropdown-menu dropdown-menu-right'>
					<a class='dropdown-item' href='?page=on&usr=<?php echo "$_SESSION[username]";?>'><i class='ft-user'></i> My Profile</a>
					<a class='dropdown-item' href='https://niozone.com/' target='_blank'><i class='ft-pocket'></i> Privacy Police</a>
					<a class='dropdown-item' href='https://niozone.com/' target='_blank'><i class='ft-radio'></i> Team of Service</a>
					<a class='dropdown-item' href='https://niozone.com/' target='_blank'><i class='ft-info'></i>Created Us</a>
                  <div class='dropdown-divider'></div>
				  <a class='dropdown-item' href='logout.php'><i class='ft-lock'></i> Logout</a>
                </div>
              </li>
			  <li class='nav-item'><a class='nav-link nav-link-label' href='#'><i class='icon-info icon-bg-circle bg-warning f18'></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

	<div class='header-navbar navbar-expand-lg navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow menu-border' role='navigation' data-menu='menu-wrapper'>
      <!-- Horizontal menu content-->
      <div class='navbar-container main-menu-content container center-layout' data-menu='menu-container'>
        <!-- include ../../../includes/mixins-->
        <ul class='nav navbar-nav float-right' id='main-menu-navigation' data-menu='menu-navigation'>
          <li class='nav-item'><a class='nav-link' href='index.php'><i class='ft-home icon-bg-circle bg-cyan'></i></a></li>
		  <!--
          <li class='nav-item mr-1'><a class='nav-link' href='?page=disqus'><i class='icon icon-bubbles'></i> Disqus</a></li>
          <li class="dropdown nav-item mr-1" data-menu="megamenu"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="ft-globe"></i>General</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="">Follow Facebook</a></li>
              <li><a class="dropdown-item" href="">Follow Twitter</a></li>
              <li><a class="dropdown-item" href="">Chating on WhatsApp</a></li>
            </ul>
          </li>
		  -->
		<?php
		  if($_SESSION['level'] == 'D' || $_SESSION['level'] == 'A'){
		  echo "
          <li class='dropdown nav-item mr-1' data-menu='dropdown'><a class='dropdown-toggle nav-link' data-toggle='dropdown'><i class='ft-feather'></i> ED Setting</a>
            <ul class='dropdown-menu'>
              <li><a class='dropdown-item' href='?page=instansi'><i class='ft-settings'></i>  Setting Institusi</a></li>
              <li><a class='dropdown-item' href='?page=session'><i class='ft-pocket'></i> Session Activity</a></li>
              <li><a class='dropdown-item' href='?page=session'><i class='ft-pocket'></i> Import Data</a></li>
            </ul>
          </li>
          <li class='dropdown nav-item mr-1' data-menu='dropdown'><a class='dropdown-toggle nav-link' data-toggle='dropdown'><i class='ft-airplay'></i>ED Master </a>
            <ul class='dropdown-menu'>
              <li><a class='dropdown-item' href='?page=mkl'><i class='ft-gitlab'></i> Master Matakuliah</a></li>
              <li><a class='dropdown-item' href='?page=jrs'><i class='ft-home'></i>Master Jurusan</a></li>
              <li><a class='dropdown-item' href='?page=kls'><i class='icon-puzzle'></i>Master Kelas</a></li>
              <li><a class='dropdown-item' href='?page=dosen'><i class='icon icon-user'></i>Master Lecture</a></li>
              <li><a class='dropdown-item' href='?page=mahasiswa'><i class='icon icon-users'></i> Master Murid</a></li>
            </ul>
          </li>
          <li class='dropdown nav-item mr-1' data-menu='dropdown'><a class='dropdown-toggle nav-link' data-toggle='dropdown'><i class='icon-star'></i>ED Learning </a>
            <ul class='dropdown-menu'>
              <li><a class='dropdown-item hover' href='?page=mdl'><i class='icon-badge'></i>  List Course</a></li>
              <li><a class='dropdown-item' href='?page=tgs'><i class='ft-airplay'></i> List Tugas</a></li>
            </ul>
          </li>
		  ";
		  }else {
		  echo "	  
          <li class='nav-item mr-1'><a class='nav-link' href='?page=mdl'><i class='ft-pocket'></i>ED Course</a></li>
          <li class='nav-item mr-1'><a class='nav-link' href='?page=tgs'><i class='ft-file-text'></i>ED Tugas</a></li>
          <li class='nav-item mr-1'><a class='nav-link' href='?page=histori'><i class='ft-layers'></i>History Unduh</a></li>
		  ";		  
		  }
		?>
        <!--  <li class='nav-item mr-1'><a class='nav-link' href='?page=tesis'><i class='icon icon-graduation f16'></i> ED Bimbingan Online</a></li> -->
          <li class="dropdown nav-item mr-1" data-menu="megamenu"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="icon-user"></i> My Account</a>
            <ul class="dropdown-menu">
              <li><a class='dropdown-item' href='?page=on&usr=<?php echo "$_SESSION[username]";?>'><i class="icon-user"></i> My Profile</a></li>			  
				  <?php if($_SESSION['level'] == 'M'){?>
				  <li><a class="dropdown-item" href="https://doc.niozone.com/student" target="_blank"><i class='icon-earphones-alt'></i> Petunjuk Pengguaan</a></li>			  
				  <?php }else {?>
				  <li><a class="dropdown-item" href="https://doc.niozone.com/lecture" target="_blank"><i class='icon-earphones-alt'></i> Petunjuk Pengguaan</a></li>
				  <?php }?>
              <li><a class="dropdown-item" href="https://doc.niozone.com" target="_blank"><i class='ft-star'></i> About App</a></li>
            </ul>
          </li>
          <li class='nav-item active mr-3'><a class='nav-link' href='logout.php'><i class='ft-lock'></i>Logout</a></li>
		 
		  
        </ul>
      </div>
      <!-- /horizontal menu content-->
    </div>