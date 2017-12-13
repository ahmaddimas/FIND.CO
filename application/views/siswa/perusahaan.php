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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php if ($perusahaan != null): ?>
                        <div class="body">
                            <div class="row clearfix">
                                <?php foreach ($perusahaan as $p): ?>
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <div class="card">
                                            <img src="<?= base_url().$p->picture_url; ?>" alt="" width="100%">
                                            <div class="body pt-1 demo-icon-container">
                                                <h4><?= $p->nama_perusahaan; ?></h4>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">place</i>
                                                    <span class="icon-name"><?= $p->kota; ?></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">phone</i>
                                                    <span class="icon-name"><?= $p->telp_perusahaan; ?></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">check</i>
                                                    <span class="icon-name"><?= $p->kuota; ?> Kuota Tersedia</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="header">
                            Data perusahaan tidak tersedia.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- #END# Basic Example -->
    </div>
</section>
