   <div class="page-wrapper">
      <div class="content container-fluid">

         <div class="page-header">
            <div class="content-page-header ">
               <h5>Data Pegawai</h5>
               <div class="list-btn">
                  <ul class="filter-list">
                     <li>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"  href="#"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Tambah Data</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header card-buttons">
                     <h4 class="card-title">Tabel Pegawai</h4>
                     <p class="card-text">
                        Berikut adalah data pegawai. anda dapat melakukan pengelolaan data tersebut sesaui dengan jabatan yang anda miliki 
                     </p>
                  </div>
                  <div class="card-body">
                     <?= $this->session->flashdata('pesan'); ?>
                     <div class="table-responsive">
                        <table id="example" class="datatable table table-stripped">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Foto</th>
                                 <th>Nama</th>
                                 <th>Jenis Kelamin</th>
                                 <th>No.Telp</th>
                                 <th>Alamat</th>
                                 <th>Jabatan</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $no = 1; foreach ($pegawai as $item):?>
                              <tr>
                                 <td><?= $no++; ?></td>
                                 <td>
                                    <a href="<?= base_url('assets/img/user/'.$item->foto) ?>" target="_blank" class="product-list-item-img"><img src="<?= base_url('assets/img/user/'.$item->foto) ?>" alt=""></a>
                                 </td>
                                 <td><?= $item->nm_pengguna ?></td>
                                 <td><?= $item->jk_pegawai ?></td>
                                 <td><?= $item->no_pegawai ?></td>
                                 <td><?= $item->alamat ?></td>
                                 <td><?= $item->level ?></td>
                                 <td class="d-flex align-items-center">
                                    <div class="dropdown dropdown-action">
                                       <button type="button" class=" btn btn-primary" data-bs-toggle="dropdown"
                                          aria-expanded="false">Aksi</button>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <ul>
                                             <li>
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit<?= $item->id_user ?>"><i
                                                      class="far fa-edit me-2"></i>Edit</a>
                                             </li>
                                             <li>
                                                <a class="dropdown-item hapus" href="<?= base_url('pimpinan/data_pegawai/delete/'.$item->id_user)?>">
                                                <i class="far fa-trash-alt me-2"></i>Hapus</a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <?php endforeach;?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="tambah" aria-hidden="true">
   <div class="modal-dialog" jabatan="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Tambah Pegawai</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="<?= base_url('pimpinan/data_pegawai/add') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Nama</label>
                     <input type="text" name="nm_pengguna" required="" class="form-control">                           
                     <?= form_error('nm_pengguna', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Jenis Kelamin</label>
                     <select class="form-control" required="" name="jk_pegawai" placeholder="Jenis kelamin">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Pria">Pria</option>  
                        <option value="Wanita">Wanita</option>                  
                     </select>
                     <?= form_error('jk_pegawai', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">No.Telp</label>
                     <input type="text" name="no_pegawai" onkeypress="return hanyaAngka(event)" required="" class="form-control">
                     <?= form_error('no_pegawai', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Alamat</label>
                     <input type="text" name="alamat" required="" class="form-control">
                     <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Devisi</label>
                     <select class="form-control" required="" name="id_devisi">
                        <option value="">-- Pilih Devisi --</option>
                        <?php foreach ($devisi as $d) : ?>
                           <option value="<?= $d->id_devisi; ?>"><?= $d->nm_devisi; ?></option>
                        <?php endforeach; ?>
                     </select>
                     <?= form_error('id_devisi', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Foto</label>
                     <input type="file" name="foto" required="" class="form-control">
                     <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Username</label>
                     <input type="text" name="username" required="" class="form-control">
                     <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Password</label>
                     <input type="password" name="password" required="" class="form-control">
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Jabatan</label><br>
                     <select class="form-control" required="" name="level" placeholder="Jabatan">
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="pimpinan">Pimpinan</option>  
                        <option value="admin">Admin</option>  
                        <option value="pegawai">Pegawai</option>                   
                     </select>
                     <?= form_error('level', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-outline-secondary float-left" data-bs-dismiss="modal">Close</button>
               <button type="submit" name="btnSimpan" class="btn btn-primary">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>

<?php foreach ($pegawai as $item): ?>
<div class="modal fade" id="edit<?= $item->id_user ?>" aria-hidden="true">
   <div class="modal-dialog" jabatan="document">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel1">Edit Data Pegawai</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('pimpinan/data_pegawai/edit/' . $item->id_user) ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Nama</label>
                     <input type="hidden" name="id_user" value="<?= $item->id_user ?>">
                     <input type="text" id="nm_pengguna" name="nm_pengguna" required="" class="form-control" value="<?= $item->nm_pengguna ?>">                           
                     <?= form_error('nm_pengguna', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Jenis Kelamin</label>
                     <select class="form-control" id="jk_pegawai" name="jk_pegawai" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Pria" <?= $item->jk_pegawai == 'Pria' ? 'selected' : '' ?>>Pria</option>
                        <option value="Wanita" <?= $item->jk_pegawai == 'Wanita' ? 'selected' : '' ?>>Wanita</option>
                     </select>
                     <?= form_error('jk_pegawai', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">No.Telp</label>
                     <input type="text" id="no_pegawai" name="no_pegawai" value="<?= $item->no_pegawai ?>" onkeypress="return hanyaAngka(event)" required="" class="form-control">
                     <?= form_error('no_pegawai', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Alamat</label>
                     <input type="text" id="alamat" name="alamat" required="" class="form-control" value="<?= $item->alamat ?>">
                     <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Devisi</label>
                     <select class="form-control" id="id_devisi" name="id_devisi" required>
                        <option value="">-- Pilih Devisi --</option>
                        <?php foreach ($devisi as $d): ?>
                           <option value="<?= $d->id_devisi; ?>" <?= $item->id_devisi == $d->id_devisi ? 'selected' : '' ?>><?= $d->nm_devisi; ?></option>
                        <?php endforeach; ?>
                     </select>
                     <?= form_error('id_devisi', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Foto</label>
                     <input type="file" id="foto" name="foto" required="" class="form-control" value="<?= $item->foto ?>">
                     <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Username</label>
                     <input type="text" id="username" name="username" required="" class="form-control" value="<?= $item->username ?>">
                     <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Password</label>
                     <input type="password" id="password" name="password" required="" class="form-control" value="<?= $item->password ?>">
                  </div>
               </div>
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Jabatan</label><br>
                     <select class="form-control" id="level" name="level" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="pimpinan" <?= $item->level == 'pimpinan' ? 'selected' : '' ?>>Pimpinan</option>
                        <option value="admin" <?= $item->level == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="pegawai" <?= $item->level == 'pegawai' ? 'selected' : '' ?>>Pegawai</option>
                     </select>
                     <?= form_error('level', '<small class="text-danger">', '</small>'); ?>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-outline-secondary float-left" data-bs-dismiss="modal">Close</button>
               <button type="submit" name="btnSimpan" class="btn btn-primary">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>
<?php endforeach; ?>

<script>
   function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
      return true;
   }

   document.querySelectorAll('.hapus').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah link agar tidak langsung dijalankan
            var url = this.getAttribute('href'); // Ambil URL dari atribut href

            Swal.fire({
                title: "Hapus Data?",
                text: "Data yang sudah dihapus tidak dapat dipulihkan kembali!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, redirect ke URL penghapusan
                    window.location.href = url;
                }
            });
        });
    });
</script>


