<section class="content">
    <div class="container-fluid">
        <?php
        if (empty($userData['nis']) || empty($userData['kelas']) || empty($userData['telp_siswa'])) { ?>
            <div class="alert alert-warning">
                <b>Warning!</b> Harap melengkapi data diri! <a class="alert-link" href="<?= base_url('Siswa/Profile') ?>">klik untuk melengkapi.</a>
            </div>
        <?php }
        if (!empty($data_perusahaan)) { ?>
            <div class="alert alert-danger">
                <b>Danger!</b> Anda sudah memilih perusahaan!
            </div>
        <?php }
        if (!empty($this->session->flashdata('notif'))){ ?>
            <div class="alert alert-<?= $this->session->flashdata('classNotif'); ?>">
                <?= $this->session->flashdata('notif'); ?>
            </div>
        <?php } ?>
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
                        <form id="wizard_with_validation" method="POST" action="<?= base_url('Siswa/Perusahaan/Pilih'); ?>">
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
                                </div>
                            </fieldset>

                            <h3>Pilihan Kedua (Cadangan)</h3>
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
                                                <input type="radio" class="with-gap radio-col-cyan" name="pilihan2" id="p2<?= $p->id_perusahaan; ?>" value="<?= $p->id_perusahaan; ?>" onchange="pilih2(this.value)" required>
                                                <label for="p2<?= $p->id_perusahaan; ?>" class="label-radio"><span></span></label>
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
                                </div>
                            </fieldset>

                            <h3>Verifikasi - Selesai</h3>
                            <fieldset>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <b>Pilihan Pertama</b><hr class="my-1">
                                        <div class="card pilihan1">
                                            <img src="" alt="" width="100%">
                                            <div class="body pt-1 demo-icon-container">
                                                <h4 class="title"></h4>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">place</i>
                                                    <span class="icon-name kota"></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">phone</i>
                                                    <span class="icon-name telp_perusahaan"></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">check</i>
                                                    <span class="icon-name kuota"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <b>Pilihan Kedua</b><hr class="my-1">
                                        <div class="card pilihan2">
                                            <img src="" alt="" width="100%">
                                            <div class="body pt-1 demo-icon-container">
                                                <h4 class="title"></h4>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">place</i>
                                                    <span class="icon-name kota"></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">phone</i>
                                                    <span class="icon-name telp_perusahaan"></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">check</i>
                                                    <span class="icon-name kuota"></span>
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
<script>
    var _pilihan1, _pilihan2; var _data1 = []; var _data2 = [];
    var base_url = window.location.origin + '/pw/';
    function pilih1(val) {
        if (_pilihan2 == val) {
            swal({
                title: "Error!",
                text: "Anda sudah memilih untuk pilihan kedua!",
                icon: "error",
            });
            var ele = document.getElementsByName("pilihan1");
            for(var i=0;i<ele.length;i++)
                ele[i].checked = false;
            return false;
        }
        _pilihan1 = val;
    }
    function pilih2(val) {
        if (_pilihan1 == val) {
            swal({
                title: "Error!",
                text: "Anda sudah memilih untuk pilihan pertama!",
                icon: "success",
            });
            var ele = document.getElementsByName("pilihan2");
            for(var i=0;i<ele.length;i++)
                ele[i].checked = false;
            return false;
        }
        _pilihan2 = val;
    }
    // $('#wizard_with_validation .tablist')
    function getPilihan1() {
        $.ajax({
            url: base_url+'siswa/perusahaan/get',
            type: 'GET',
            dataType: 'json',
            data: {pid: _pilihan1}
        }).done(function(e) {
            _data1 = e;
            $('.page-loader-wrapper').fadeOut();
            return;
        });
    }
    function getPilihan2() {
        $.ajax({
            url: base_url+'siswa/perusahaan/get',
            type: 'GET',
            dataType: 'json',
            async: false,
            data: {pid: _pilihan2}
        }).done(function(e) {
            _data2 = e;
            $('.page-loader-wrapper').fadeOut();
            return;
        });
    }
    function setPilihan() {
        var c1 = $('.pilihan1'); var c2 = $('.pilihan2');
        // set pilihan1
        c1.find('img').attr('src', base_url+_data1.picture_url);
        c1.find('.title').html(_data1.nama_perusahaan);
        c1.find('.kota').html(_data1.kota);
        c1.find('.telp_perusahaan').html(_data1.telp_perusahaan);
        c1.find('.kuota').html(_data1.kuota + " Kuota Tersedia");
        // set pilihan2
        c2.find('img').attr('src', base_url+_data2.picture_url);
        c2.find('.title').html(_data2.nama_perusahaan);
        c2.find('.kota').html(_data2.kota);
        c2.find('.telp_perusahaan').html(_data2.telp_perusahaan);
        c2.find('.kuota').html(_data2.kuota + " Kuota Tersedia");
        $('.page-loader-wrapper').fadeOut();
    }
</script>
