<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>
        <?php
        if (empty($userData['telp_guru'])) { ?>
            <div class="alert alert-warning">
                <b>Warning!</b> Harap melengkapi data diri! <a class="alert-link" href="<?= base_url('guru/profile'); ?>">klik untuk melengkapi.</a>
            </div>
        <?php } ?>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">domain</i>
                    </div>
                    <div class="content">
                        <div class="text">PERUSAHAAN</div>
                        <div class="number count-to" data-from="0" data-to="<?= count($perusahaan); ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">school</i>
                    </div>
                    <div class="content">
                        <div class="text">SEMUA SISWA</div>
                        <div class="number count-to" data-from="0" data-to="<?= count($siswa); ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">school</i>
                    </div>
                    <div class="content">
                        <div class="text">SISWA YANG DIBIMBING</div>
                        <div class="number count-to" data-from="0" data-to="<?= count($dsiswa); ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <div class="block-header">
            <h2>PERUSAHAAN YANG DIBIMBING</h2>
        </div>
        <div class="row clearfix">
            <!-- Data Perusahaan -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php if ($data_perusahaan != null): ?>
                        <div class="body">
                            <div class="row clearfix">
                                <?php foreach ($data_perusahaan as $dp): ?>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="card">
                                            <img src="<?= base_url().$dp->picture_url; ?>" alt="" width="100%">
                                            <div class="body pt-1 demo-icon-container">
                                                <h4 class="c-p" onclick="getInfo(this)" aria-label="<?= $dp->id_perusahaan; ?>"><?= $dp->nama_perusahaan; ?></h4>
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
                                                    <span class="icon-name"><?= $dp->kuota - $dp->diterima; ?> Kuota Tersedia</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="header">
                            Anda belum membimbing perusahaan.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- #END# Data Perusahaan -->
            <!-- modal dialog -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalInfo">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title"></h3>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix pilihan">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <img src="" alt="" width="100%">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="pt-1 demo-icon-container">
                                        <div class="demo-google-material-icon">
                                            <i class="material-icons">place</i>
                                            <span class="icon-name"><span class="street"></span><br> <span class="city"></span>, <span class="province"></span></span>
                                        </div>
                                        <div class="demo-google-material-icon">
                                            <i class="material-icons">phone</i>
                                            <span class="icon-name"><span class="phone-number"></span> - <span class="cp"></span></span>
                                        </div>
                                        <div class="demo-google-material-icon">
                                            <i class="material-icons">print</i>
                                            <span class="icon-name fax"></span>
                                        </div>
                                        <div class="demo-google-material-icon">
                                            <i class="material-icons">check</i>
                                            <span class="icon-name"><span class="kuota"></span> Kuota Tersedia</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of modal dialog -->
        </div>
        <div class="block-header">
            <h2>SISWA YANG DIBIMBING</h2>
        </div>
        <div class="row clearfix">
            <!-- Data Perusahaan -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php if ($dsiswa != null): ?>
                        <div class="body">
                            <div class="row clearfix">
                                <?php foreach ($dsiswa as $s): ?>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="card">
                                            <img src="<?= $s->picture_url; ?>" alt="" width="100%">
                                            <div class="body pt-1 demo-icon-container">
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">person</i>
                                                    <span class="icon-name"><?= $s->nama_siswa; ?></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">phone</i>
                                                    <span class="icon-name"><?= $s->telp_siswa; ?></span>
                                                </div>
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">email</i>
                                                    <span class="icon-name"><?= $s->email_siswa; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="header">
                            Anda belum membimbing perusahaan.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- #END# Data Perusahaan -->
        </div>
    </div>
</section>
<script type="text/javascript">
    function getInfo(e) {
        var _pid = $(e).attr('aria-label');
        $.ajax({
            url: base_url+'siswa/perusahaan/get',
            type: 'GET',
            dataType: 'json',
            data: {pid: _pid},
            beforeSend: function() {
                $('.page-loader-wrapper').show(0);
            }
        }).done(function(e) {
            var _element = $('#modalInfo');
            _element.find('.modal-title').html(e.nama_perusahaan);
            _element.find('.modal-body img').attr('src', base_url+e.picture_url);
            _element.find('.modal-body .street').html(e.alamat);
            _element.find('.modal-body .city').html(e.kota);
            _element.find('.modal-body .province').html(e.provinsi);
            _element.find('.modal-body .phone-number').html(e.telp_perusahaan);
            _element.find('.modal-body .cp').html(e.cp);
            _element.find('.modal-body .fax').html(e.fax);
            _element.find('.modal-body .kuota').html(e.kuota - e.diterima);
            $('.page-loader-wrapper').fadeOut(50);
            _element.modal('show');
        });

    }
</script>
