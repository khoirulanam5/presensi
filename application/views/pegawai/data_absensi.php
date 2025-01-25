<div class="page-wrapper">
      <div class="content container-fluid">

         <div class="page-header">
            <div class="content-page-header ">
               <h5>Data Presensi Pegawai</h5>
            </div>
         </div>

         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header card-buttons">
                     <h4 class="card-title">Tabel Data Presensi</h4>
                     <p class="card-text">
                        Berikut adalah data presensi pegawai. anda dapat melakukan pengelolaan data tersebut sesaui dengan jabatan yang anda miliki 
                     </p>
                  </div>
                  <div class="card-body">
                     <?= $this->session->flashdata('pesan'); ?>
                     <div class="table-responsive">
                     <table id="example" class="datatable table table-stripped">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Nama</th>
                                 <th>Foto Masuk</th>
                                 <th>Jam Masuk</th>
                                 <th>Lokasi Masuk</th>
                                 <th>Foto Keluar</th>
                                 <th>Jam Keluar</th>
                                 <th>Lokasi Keluar</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $no = 1; foreach ($absensi as $item):?>
                              <tr>
                                 <td><?= $no++; ?></td>
                                 <td><?= $item->nm_pengguna ?></td>
                                 <td>
                                    <?php if (!empty($item->selfie)) : ?>
                                       <a href="<?= base_url('assets/img/absensi/' . $item->selfie) ?>" target="_blank" class="product-list-item-img">
                                             <img src="<?= base_url('assets/img/absensi/' . $item->selfie) ?>" alt="">
                                       </a>
                                    <?php endif; ?>
                                 </td>
                                 <td><?= date('d-m-Y H:i:s', strtotime($item->jam_masuk)) ?></td>
                                 <td><?= $item->lokasi_masuk ?></td>
                                 <td>
                                    <?php if (!empty($item->selfie_keluar)) : ?>
                                       <a href="<?= base_url('assets/img/absensi/' . $item->selfie_keluar) ?>" target="_blank" class="product-list-item-img">
                                             <img src="<?= base_url('assets/img/absensi/' . $item->selfie_keluar) ?>" alt="">
                                       </a>
                                    <?php endif; ?>
                                 </td>
                                 <td><?= $item->jam_keluar ?></td>
                                 <td><?= $item->lokasi_keluar ?></td>
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