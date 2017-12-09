<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DAFTAR PERUSAHAAN</h2>
        </div>
        <?php
        if (empty($userData['nis']) || empty($userData['kelas']) || empty($userData['telp_siswa'])) { ?>
            <div class="alert alert-warning">
                <b>Warning!</b> Harap melengkapi data diri! <a class="alert-link" href="<?= base_url('Siswa/Profile') ?>">klik untuk melengkapi.</a>
            </div>
        <?php }
        if (empty($data_perusahaan)) { ?>
            <div class="alert alert-warning">
                <b>Warning!</b> Anda belum memilih perusahaan! <a class="alert-link" href="<?= base_url('Siswa/Perusahaan/pilih') ?>">klik untuk memilih.</a>
            </div>
        <?php }
        ?>
        <!-- Basic Example -->
        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
        <!-- #END# Basic Example -->
    </div>
</section>
