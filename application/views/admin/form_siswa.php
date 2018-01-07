<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>TAMBAH DATA SISWA</h2>
        </div>
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
                        <form action="<?= base_url('admin/users/siswa/tambah'); ?>" method="post">
                            <div class="row clearfix">
                                <?php if (!empty($this->session->flashdata('notif'))){ ?>
                                    <div class="alert alert-<?= $this->session->flashdata('classNotif'); ?>">
                                        <?= $this->session->flashdata('notif'); ?>
                                    </div>
                                <?php } ?>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nama" autofocus required>
                                            <label class="form-label">Nama</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="email" autofocus required>
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="nis" autofocus required>
                                            <label class="form-label">NIS</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" class="form-control" placeholder="RPL 1" name="kelas" autofocus required>
                                            <label class="form-label">Kelas</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="angkatan" autofocus required>
                                            <label class="form-label">Angkatan</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="jurusan" autofocus required>
                                            <label class="form-label">Jurusan</label>
                                        </div>
                                    </div>
                                    <div class="form-line">
                                        <div class="demo-radio-button">
                                            <input type="radio" name="jk" value="male" id="lk" required>
                                            <label class="form-label" for="lk">Laki - Laki</label>
                                        </div>
                                        <div class="demo-radio-button">
                                            <input type="radio" name="jk" value="female" id="pr" required>
                                            <label class="form-label" for="pr">Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="telp" autofocus required>
                                            <label class="form-label">Telepon</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="icon-and-text-button-demo d-block mx-auto">
                                        <button type="submit" name="addProfile" class="btn btn-lg bg-teal waves-effect">
                                            <i class="material-icons">check</i><span>SUBMIT</span>
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
    </div>
</section>
