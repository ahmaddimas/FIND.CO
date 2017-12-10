<?php if ($perusahaan != null):
    foreach ($perusahaan as $p): ?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="card-wrapper">
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
            <input type="radio" class="with-gap radio-col-cyan" name="pilihan1" id="p1<?= $p->id_perusahaan; ?>" value="<?= $p->id_perusahaan; ?>" onchange="pilih1(this.value)" required>
            <label for="p1<?= $p->id_perusahaan; ?>" class="label-radio"><span></span></label>
        </div>
    </div>
    <?php endforeach;
else: ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                Data perusahaan tidak tersedia.
            </div>
        </div>
    </div>
<?php endif; ?>
