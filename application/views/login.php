<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sistem Presensi Pegawai</title>
   <link rel="shortcut icon" href="<?= base_url('assets/logo.png') ?>">
   <link rel="stylesheet" type="text/css" href="<?= base_url('landing/') ?>css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="<?= base_url('landing/') ?>css/fontawesome-all.min.css">
   <link rel="stylesheet" type="text/css" href="<?= base_url('landing/') ?>css/iofrm-style.css">
   <link rel="stylesheet" type="text/css" href="<?= base_url('landing/') ?>css/iofrm-theme1.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
   <div class="form-body">
      <div class="website-logo">
            <a href="#">
               <div class="logo">
                  <img class="logo-size" src="<?= base_url('assets/') ?>logo.png" alt="">
               </div>
            </a>
      </div>
      <div class="row">
            <div class="img-holder">
               <div class="bg"></div>
               <div class="info-holder">

               </div>
            </div>
            <div class="form-holder">
               <div class="form-content">
                  <div class="form-items">
                        <h3>Selamat Datang di Inspektorat Daerah Kabupaten Kudus</h3>
                        <p>Hadirkan kenyamanan dan efisiensi ke ruang kerja digital Anda. Masukkan informasi login Anda di bawah ini</p>
                        <div class="page-links">
                           <a href="#" class="active">Form Login</a>
                        </div>
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('auth') ?>" method="post">
                           <input class="form-control" type="text" name="username" placeholder="Masukan username" required style="color: black;">
                           <!-- <?= form_error('username', '<small class="text-danger">', '</small>'); ?> -->
                           <input class="form-control" type="password" name="password" placeholder="Masukan Password" required style="color: black;">
                           <!-- <?= form_error('password', '<small class="text-danger">', '</small>'); ?> -->
                           
                           <div class="form-button">
                              <button type="submit" class="ibtn">Login</button> 
                           </div>
                        </form>
                  </div>
               </div>
            </div>
      </div>
   </div>
<script src="<?= base_url('landing/') ?>js/jquery.min.js"></script>
<script src="<?= base_url('landing/') ?>js/popper.min.js"></script>
<script src="<?= base_url('landing/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('landing/') ?>js/main.js"></script>
</body>
</html>