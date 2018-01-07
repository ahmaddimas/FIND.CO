<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>PROFILE</h2>
        </div>
        <?php if (empty($data_perusahaan)) { ?>
            <div class="alert alert-warning">
                <b>Warning!</b> Anda belum memilih perusahaan! <a class="alert-link" href="<?= base_url('Siswa/Perusahaan/pilih'); ?>">klik untuk memilih.</a>
            </div>
        <?php } else {
            foreach ($data_perusahaan as $dp) {
                if ($dp->status == "diterima") { ?>
                    <div class="alert alert-success">
                        <b>Congratulation!</b> Anda telah diterima diperusahaan <?= $dp->nama_perusahaan; ?>
                    </div>
                <?php } elseif ($dp->status == "ditolak") { ?>
                    <div class="alert alert-danger">
                        <b>Danger!</b> Anda belum diterima diperusahaan <a class="alert-link" href="<?= base_url('Siswa/Perusahaan/pilih'); ?>">klik untuk memilih.</a>
                    </div>
                <?php
                    break;
                }
            }
        }
        ?>
        <!-- Form Data Diri -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATA PRIBADI
                        </h2>
                    </div>
                    <div class="body">
                        <form action="<?= base_url('siswa/profile'); ?>" method="post">
                            <div class="row clearfix">
                                <?php if (!empty($this->session->flashdata('notif'))){ ?>
                                    <div class="alert alert-<?= $this->session->flashdata('classNotif'); ?>">
                                        <?= $this->session->flashdata('notif'); ?>
                                    </div>
                                <?php } ?>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $userData['nama_siswa']; ?>" disabled>
                                            <label class="form-label">Nama</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $userData['email_siswa']; ?>" disabled>
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line focused <?php if(empty($userData['nis'])) echo "error"; ?>">
                                            <input type="text" class="form-control" name="nis" <?php if(!empty($userData['nis'])) echo "value='".$userData['nis']."' disabled"; ?>>
                                            <label class="form-label">NIS</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line focused <?php if(empty($userData['kelas'])) echo "error"; ?>">
                                            <input type="text" class="form-control" placeholder="RPL 1" name="kelas" <?php if(!empty($userData['kelas'])) echo "value='".$userData['kelas']."' disabled"; ?>>
                                            <label class="form-label">Kelas</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $userData['angkatan']; ?>" disabled>
                                            <label class="form-label">Angkatan</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $userData['jurusan']; ?>" disabled>
                                            <label class="form-label">Jurusan</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $userData['jk_siswa']; ?>" disabled>
                                            <label class="form-label">Jenis Kelamin</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line focused <?php if(empty($userData['telp_siswa'])) echo "error"; ?>">
                                            <input type="number" class="form-control" name="telp" <?php if(!empty($userData['telp_siswa'])) echo "value='".$userData['telp_siswa']."' disabled"; ?>>
                                            <label class="form-label">Telepon</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img src="<?= $userData['picture_url']; ?>" class="mx-auto" alt="Profile Picture" width="50%">
                                </div>
                                <div class="col-sm-12">
                                    <div class="icon-and-text-button-demo d-block mx-auto">
                                        <button type="submit" name="updateProfile" class="btn btn-lg bg-teal waves-effect">
                                            <i class="material-icons">check</i><span>SAVE PROFILE</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Form Data Diri -->
        <div class="block-header">
            <h2>PERUSAHAAN YANG DIPILIH</h2>
        </div>
        <!-- Data Perusahaan -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php if ($data_perusahaan != null): ?>
                        <div class="body">
                            <div class="row clearfix">
                                <?php foreach ($data_perusahaan as $dp): ?>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <b>Pilihan <?= $dp->indeks; ?> (<?= $dp->status; ?> konfirmasi)</b><hr class="my-1">
                                        <div class="card">
                                            <img src="<?= base_url().$dp->picture_url; ?>" alt="" width="100%">
                                            <div class="body pt-1 demo-icon-container">
                                                <h4><?= $dp->nama_perusahaan; ?></h4>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">place</i>
                                                    <span class="icon-name"><?= $dp->kota; ?></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">phone</i>
                                                    <span class="icon-name"><?= $dp->telp_perusahaan; ?></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">check</i>
                                                    <span class="icon-name"><?= $dp->kuota; ?> Kuota Tersedia</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="header">
                            Anda belum memilih perusahaan.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- #END# Data Perusahaan -->
    </div>
</section>
