<!-- Sidebar -->
<div class="sidebar" id="sidebar">
         <center class="pt-2">
            <a href="<?= base_url('dashboard') ?>">
               <img height="80px" src="<?= base_url('assets/logo.png') ?>" alt="">
            </a>
            <h4><b style="color: #0D969C;"><?= $this->session->userdata('nm_pengguna'); ?> (<?= $this->session->userdata('level'); ?>)</b></h4>
         </center>
         <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
               <!-- Sidebar content, e.g. Menu -->
			   <ul>
					<li class="menu-title"><span>Main Menu</span></li>
					<li class="<?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''?>">
						<a href="<?= base_url('dashboard') ?>"><i class="fe fe-home" style="color: #0D969C;"></i> <span style="color: #0D969C;"> Dashboard</span></a>
					</li>

               <?php if ($this->session->userdata('level') == 'pimpinan'): ?>
					<li class="menu-title"><span>Data Presensi</span></li>
					<li class="<?= $this->uri->segment(2) == 'absensi' ? 'active' : ''?>">
						<a href="<?= base_url('pimpinan/absensi') ?>"><i class="fe fe-edit" style="color: #0D969C;"></i> <span style="color: #0D969C;"> Data Presensi</span></a>
					</li>
					<li class="menu-title"><span>Data Master</span></li>
					<li class="<?= $this->uri->segment(2) == 'data_pegawai' ? 'active' : ''?>">
						<a href="<?= base_url('pimpinan/data_pegawai') ?>"><i class="fe fe-user" style="color: #0D969C;"></i> <span style="color: #0D969C;"> Data Pegawai</span></a>
					</li>
               <?php endif; ?>

               <?php if ($this->session->userdata('level') == 'admin'): ?>
               <li class="menu-title"><span>Data Presensi</span></li>
					<li class="<?= $this->uri->segment(2) == 'absensi' ? 'active' : ''?>">
						<a href="<?= base_url('admin/absensi') ?>"><i class="fe fe-edit" style="color: #0D969C;"></i> <span style="color: #0D969C;"> Presensi</span></a>
					</li>
				<li class="menu-title"><span>Data Master</span></li>
					<li class="<?= $this->uri->segment(2) == 'devisi' ? 'active' : ''?>">
						<a href="<?= base_url('admin/devisi') ?>"><i class="fe fe-user" style="color: #0D969C;"></i> <span style="color: #0D969C;"> Devisi</span></a>
					</li>
               <?php endif; ?>

               <?php if ($this->session->userdata('level') == 'pegawai'): ?>
               <li class="menu-title"><span>Presensi</span></li>
					<li class="<?= $this->uri->segment(2) == 'absensi' ? 'active' : ''?>">
						<a href="<?= base_url('pegawai/absensi') ?>"><i class="fe fe-calendar" style="color: #0D969C;"></i> <span style="color: #0D969C;"> Presensi</span></a>
					</li>
					<li class="<?= $this->uri->segment(2) == 'data_absensi' ? 'active' : ''?>">
						<a href="<?= base_url('pegawai/data_absensi') ?>"><i class="fe fe-calendar" style="color: #0D969C;"></i> <span style="color: #0D969C;"> Data Presensi</span></a>
					</li>
               <?php endif; ?>
				</ul>
            </div>
         </div>
      </div>
      <!-- /Sidebar -->