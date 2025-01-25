<div class="page-wrapper">
      <div class="content container-fluid">

         <div class="page-header">
            <div class="content-page-header ">
               <h5>Data Devisi Pegawai</h5>
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
                     <h4 class="card-title">Tabel Devisi Pegawai</h4>
                     <p class="card-text">
                        Berikut adalah data devisi pegawai. anda dapat melakukan pengelolaan data tersebut sesaui dengan jabatan yang anda miliki 
                     </p>
                  </div>
                  <div class="card-body">
                     <?= $this->session->flashdata('pesan'); ?>
                     <div class="table-responsive">
                        <table id="example" class="datatable table table-stripped">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Nama Devisi</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $no = 1; foreach ($devisi as $item):?>
                              <tr>
                                 <td><?= $no++; ?></td>
                                 <td><?= $item->nm_devisi ?></td>
                                 <td class="d-flex align-items-center">
                                    <div class="dropdown dropdown-action">
                                       <button type="button" class=" btn btn-primary" data-bs-toggle="dropdown"
                                          aria-expanded="false">Aksi</button>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <ul>
                                             <li>
                                                <a class="dropdown-item edit" href="javascript:void(0)" data-id="<?= $item->id_devisi ?>" data-bs-toggle="modal" data-bs-target="#edit">
                                                   <i class="far fa-edit me-2"></i>Edit
                                                </a>
                                             </li>
                                             <li>
                                                <a class="dropdown-item hapus" href="<?= base_url('admin/devisi/delete/'.$item->id_devisi)?>">
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
            <h5 class="modal-title" id="exampleModalLabel1">Tambah Devisi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="<?= base_url('admin/devisi/add') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="row">
                  <div class="col mb-12">
                     <label for="nameBasic" class="form-label">Nama Devisi</label>
                     <input type="text" id="nm_devisi" name="nm_devisi" required="" class="form-control">                           
                     <?= form_error('nm_devisi', '<small class="text-danger">', '</small>'); ?>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
      $('#example').on('click', '.edit', function() {
         let data = $(this).data();
         let id = data.id;
         console.log(id);

         $.ajax({
               method: 'get', 
               dataType: 'json',
               url: `<?= base_url('admin/devisi/edit/') ?>` + id, 
               success: function(res) {
                  console.log(res);
                  $('#edit').modal('show');
                  $("#formEdit").attr('action', `<?= base_url('admin/devisi/do_edit/') ?>` + id);
                  $("#nm_devisi").val(res.data.nm_devisi);
               }
         });
      });
   });
</script>

<div class="modal fade" id="edit" aria-hidden="true">
   <div class="modal-dialog" jabatan="document">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel1">Edit Devisi</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formEdit" method="post" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="row">
                     <div class="col mb-12">
                        <label for="nameBasic" class="form-label">Nama Devisi</label>
                        <input type="text" name="nm_devisi" id="nm_devisi" required="" class="form-control">                           
                        <?= form_error('nm_devisi', '<small class="text-danger">', '</small>'); ?>
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


