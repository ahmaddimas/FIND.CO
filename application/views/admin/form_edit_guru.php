<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>EDIT DATA PEMBIMBING</h2>
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
                        <form action="<?= base_url('admin/users/guru/edit/').$guru->id_guru; ?>" method="post">
                            <div class="row clearfix">
                                <?php if (!empty($this->session->flashdata('notif'))){ ?>
                                    <div class="alert alert-<?= $this->session->flashdata('classNotif'); ?>">
                                        <?= $this->session->flashdata('notif'); ?>
                                    </div>
                                <?php } ?>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $guru->nama_guru; ?>" disabled>
                                            <label class="form-label">Nama</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $guru->email_guru; ?>" disabled>
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $guru->jk_guru; ?>" disabled>
                                            <label class="form-label">Jenis Kelamin</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line focused <?php if(empty($guru->telp_guru)) echo "error"; ?>">
                                            <input type="number" class="form-control" name="telp" <?php if(!empty($guru->telp_guru)) echo "value='".$guru->telp_guru."'"; ?>>
                                            <label class="form-label">Telepon</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img src="<?= $guru->picture_url; ?>" class="mx-auto" alt="Profile Picture" width="50%">
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
    </div>
</section>
