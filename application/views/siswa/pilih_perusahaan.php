<section class="content">
    <div class="container-fluid">
        <?php
        if (empty($userData['nis']) || empty($userData['kelas']) || empty($userData['telp_siswa'])) { ?>
            <div class="alert alert-warning">
                <b>Warning!</b> Harap melengkapi data diri! <a class="alert-link" href="<?= base_url('Siswa/Profile') ?>">klik untuk melengkapi.</a>
            </div>
        <?php }
        ?>
        <!-- Advanced Form With Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>PILIH PERUSAHAAN</h2>
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
                        <form id="wizard_with_validation" method="POST">
                            <h3>Pilihan Pertama (Utama)</h3>
                            <fieldset>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">domain</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control date" placeholder="Cari Perusahaan">
                                    </div>
                                    <span class="input-group-addon">
                                        <i class="material-icons">search</i>
                                    </span>
                                </div>
                                <div class="row clearfix">
                                    <input type="radio" id="indeks1" name="index1" value="asa" class="form-control">
                                    <input type="radio" id="indeks2" name="index1" value="asdas" class="form-control">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <label for="indeks1">
                                            <div class="card">
                                                <img src="<?= base_url(); ?>assets/images/google.jpg" alt="" width="100%">
                                                <div class="body pt-1 demo-icon-container">
                                                    <h4>Google Indonesia</h4>
                                                    <div class="demo-google-material-icon">
                                                        <i class="material-icons">place</i>
                                                        <span class="icon-name">Jakarta</span>
                                                    </div>
                                                    <div class="demo-google-material-icon">
                                                        <i class="material-icons">phone</i>
                                                        <span class="icon-name">082 232 213 132</span>
                                                    </div>
                                                    <div class="demo-google-material-icon">
                                                        <i class="material-icons">check</i>
                                                        <span class="icon-name">3 Available</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <label for="indeks2">
                                            <div class="card">
                                                <img src="<?= base_url(); ?>assets/images/telkom.jpg" alt="" width="100%">
                                                <div class="body pt-1 demo-icon-container">
                                                    <h4>SMK Telkom Malang</h4>
                                                    <div class="demo-google-material-icon">
                                                        <i class="material-icons">place</i>
                                                        <span class="icon-name">Malang</span>
                                                    </div>
                                                    <div class="demo-google-material-icon">
                                                        <i class="material-icons">phone</i>
                                                        <span class="icon-name">082 232 213 132</span>
                                                    </div>
                                                    <div class="demo-google-material-icon">
                                                        <i class="material-icons">check</i>
                                                        <span class="icon-name">2 Available</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <h3>Pilihan Kedua (Cadangan)</h3>
                            <fieldset>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" required>
                                        <label class="form-label">First Name*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="surname" class="form-control" required>
                                        <label class="form-label">Last Name*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" name="email" class="form-control" required>
                                        <label class="form-label">Email*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                        <label class="form-label">Address*</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input min="18" type="number" name="age" class="form-control" required>
                                        <label class="form-label">Age*</label>
                                    </div>
                                    <div class="help-info">The warning step will show up if age is less than 18</div>
                                </div>
                            </fieldset>

                            <h3>Verifikasi - Selesai</h3>
                            <fieldset>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <b>Pilihan Pertama</b><hr class="my-1">
                                        <div class="card">
                                            <img src="<?= base_url(); ?>assets/images/google.jpg" alt="" width="100%">
                                            <div class="body pt-1 demo-icon-container">
                                                <h4>Google Indonesia</h4>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">place</i>
                                                    <span class="icon-name">Jakarta</span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">phone</i>
                                                    <span class="icon-name">082 232 213 132</span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">check</i>
                                                    <span class="icon-name">3 Available</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <b>Pilihan Kedua</b><hr class="my-1">
                                        <div class="card">
                                            <img src="<?= base_url(); ?>assets/images/telkom.jpg" alt="" width="100%">
                                            <div class="body pt-1 demo-icon-container">
                                                <h4>SMK Telkom Malang</h4>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">place</i>
                                                    <span class="icon-name">Malang</span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">phone</i>
                                                    <span class="icon-name">082 232 213 132</span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">check</i>
                                                    <span class="icon-name">2 Available</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Advanced Form Example With Validation -->
    </div>
</section>
