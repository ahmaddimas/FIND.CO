<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>PROFILE</h2>
        </div>
        <?php if (empty($data_perusahaan)) { ?>
            <div class="alert alert-warning">
                <b>Warning!</b> Anda belum memilih perusahaan! <a class="alert-link" href="<?= base_url('Siswa/Perusahaan/pilih') ?>">klik untuk memilih.</a>
            </div>
        <?php }
        ?>
        <!-- Form Data Diri -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATA PRIBADI
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form action="" method="post">
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
            <h2>DAFTAR PERUSAHAAN</h2>
        </div>
        <!-- Data Perusahaan -->
        <div class="row clearfix">
            <?php if ($data_perusahaan != null):
                foreach ($data_perusahaan as $dp): ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="card">
                            <img src="<?= base_url(); ?>assets/images/google.jpg" alt="" width="100%">
                            <div class="body pt-1 demo-icon-container">
                                <h4><?= $dp['nama_perusahaan']; ?></h4>
                                <div class="demo-google-material-icon">
                                    <i class="material-icons">place</i>
                                    <span class="icon-name"><?= $dp['kota']; ?></span>
                                </div>
                                <div class="demo-google-material-icon">
                                    <i class="material-icons">phone</i>
                                    <span class="icon-name"><?= $dp['telp_perusahaan']; ?></span>
                                </div>
                                <div class="demo-google-material-icon">
                                    <i class="material-icons">check</i>
                                    <span class="icon-name"><?= $dp['kuota']; ?> Kuota Tersedia</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            else: ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            Anda belum memilih perusahaan.
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- #END# Data Perusahaan -->
    </div>
</section>
