<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <!-- Profile Picture Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?php if (!empty($user['foto'])): ?>
                            <img src="<?= base_url('assets/img/user/' . $user['foto']); ?>" alt="Foto Profil" class="img-thumbnail mb-3" width="250" height="250">
                        <?php else: ?>
                            <img src="<?= base_url('assets/img/user/default.jpg'); ?>" alt="Foto Profil" class="img-thumbnail mb-3" width="250" height="250">
                        <?php endif; ?>
                        <h5 class="card-title mt-3"><?= $user['nm_pengguna']; ?></h5>
                    </div>
                </div>
            </div>

            <!-- Profile Form Card -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('profile/edit'); ?>" enctype="multipart/form-data">
                            <input type="hidden" value="<?= $user['id_user']; ?>" id="id_user" name="id_user">
                            <input type="hidden" value="<?= $user['id_pegawai']; ?>" id="id_pegawai" name="id_pegawai">
                            <div class="form-group mb-3">
                                <label for="nm_pengguna" class="form-control-label">Nama</label>
                                <input class="form-control" type="text" value="<?= $user['nm_pengguna']; ?>" id="nm_pengguna" name="nm_pengguna">
                            </div>
                            <div class="form-group mb-3">
                                <label for="jk_pegawai" class="form-control-label">Jenis Kelamin</label>
                                <select class="form-control" id="jk_pegawai" name="jk_pegawai">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Pria" <?= $user['jk_pegawai'] == 'Pria' ? 'selected' : '' ?>>Pria</option>
                                    <option value="Wanita" <?= $user['jk_pegawai'] == 'Wanita' ? 'selected' : '' ?>>Wanita</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_devisi" class="form-control-label">Devisi</label>
                                <select class="form-control" id="id_devisi" name="id_devisi">
                                    <option value="">-- Pilih Devisi --</option>
                                    <?php foreach ($devisi as $d): ?>
                                    <option value="<?= $d->id_devisi; ?>" <?= $user['id_devisi'] == $d->id_devisi ? 'selected' : '' ?>><?= $d->nm_devisi; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="no_pegawai" class="form-control-label">No.telp</label>
                                <input class="form-control" type="number" value="<?= $user['no_pegawai']; ?>" id="no_pegawai" name="no_pegawai">
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat" class="form-control-label">Alamat</label>
                                <input class="form-control" type="text" value="<?= $user['alamat']; ?>" id="alamat" name="alamat">
                            </div>
                            <div class="form-group mb-3">
                                <label for="username" class="form-control-label">Username</label>
                                <input class="form-control" type="text" value="<?= $user['username']; ?>" id="username" name="username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-control-label">Password</label>
                                <input class="form-control" type="password" value="<?= $user['password']; ?>" id="password" name="password">
                            </div>
                            <div class="form-group mb-3">
                                <label for="level" class="form-control-label">Jabatan</label>
                                <input class="form-control" type="text" value="<?= $user['level']; ?>" id="level" name="level" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="foto" class="form-control-label">Foto</label>
                                <input class="form-control" type="file" value="<?= $user['foto']; ?>" id="foto" name="foto">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
