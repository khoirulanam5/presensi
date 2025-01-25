      <!-- Page Wrapper -->
      <div class="page-wrapper">
         <div class="content container-fluid">
            <div class="page-header">
               <div class="content-page-header">
                  <h5>Halaman Dashboard</h5>
               </div>
            </div>

            <!-- Dashboard Widgets -->
            <div class="row">
               <div class="col-xl-4 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-1">
                              <i class="fas fa-user"></i>
                           </span>
                           <div class="dash-count">
                              <div class="dash-counts">
                                 <?php if($this->session->userdata('level') == 'pegawai'): ?>
                                    <a href="<?= base_url('pegawai/absensi/') ?>"><p>Absensi Masuk</p></a>
                                 <?php elseif($this->session->userdata('level') == 'admin' || 'pimpinan'): ?>
                                    <span>Absensi Masuk</span>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-4 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-1">
                              <i class="fas fa-calendar"></i>
                           </span>
                           <div class="dash-count">
                              <div class="dash-counts">
                                 <?php if($this->session->userdata('level') == 'pegawai'): ?>
                                    <a href="<?= base_url('pegawai/absensi/') ?>"><p>Absensi Keluar</p></a>
                                 <?php elseif($this->session->userdata('level') == 'admin' || 'pimpinan'): ?>
                                    <span>Absensi Keluar</span>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-4 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-3">
                              <i class="fas fa-users"></i>
                           </span>
                           <div class="dash-count">
                              <div class="dash-title">Jumlah Pegawai</div>
                              <div class="dash-counts">
                                 <p><?= $pegawai ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /Dashboard Widgets -->

            <!-- Welcome Message -->
            <div class="col-xl-12 col-sm-12 col-12">
               <div class="card">
                  <div class="card-body">
                     <?= $this->session->flashdata('pesan'); ?>
                     <center>
                        <h4 class="header-title">Selamat Datang <?= $this->session->userdata('nm_pengguna'); ?> di Sistem Presensi Pegawai.</h4>
                        <p class="text-muted">Anda dapat melakukan pekerjaan anda sesuai dengan jabatan <?= $this->session->userdata('level'); ?> </p>
                        <img height="550px" src="<?= base_url('assets/banner.png'); ?>">
                     </center>
                  </div>
               </div>
            </div>
            <!-- /Welcome Message -->

         </div>
      </div>
      <!-- /Page Wrapper -->
