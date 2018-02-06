<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DAFTAR PERUSAHAAN</h2>
        </div>
        <?php
        if (empty($userData['nis']) || empty($userData['kelas']) || empty($userData['telp_siswa'])) { ?>
            <div class="alert alert-warning">
                <b>Warning!</b> Harap melengkapi data diri! <a class="alert-link" href="<?= base_url('Siswa/Profile'); ?>">klik untuk melengkapi.</a>
            </div>
        <?php }
        if (empty($data_perusahaan)) { ?>
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
                                                <h4 class="c-p" onclick="getInfo(this)" aria-label="<?= $p->id_perusahaan; ?>"><?= $p->nama_perusahaan; ?></h4>
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
                                                    <?php
                                                      $kuota = $p->tahun_rekap == date('Y') ? $p->kuota - $p->diterima : $p->kuota;
                                                    ?>
                                                    <span class="icon-name"><?= $kuota; ?> Kuota Tersedia (<?= $p->tahun_rekap; ?>)</span>
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
                                        <span class="icon-name"><span class="kuota"></span> Kuota Tersedia (<span class="tahun"></span>)</span>
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
            _element.find('.modal-body .tahun').html(e.tahun_rekap);
            var date = new Date();
            var kuota = e.tahun_rekap == date.getFullYear() ? e.kuota - e.diterima : e.kuota;
            _element.find('.modal-body .kuota').html(kuota);
            $('.page-loader-wrapper').fadeOut(50);
            _element.modal('show');
        });

    }
</script>
