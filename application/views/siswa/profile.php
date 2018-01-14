<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>PROFILE</h2>
        </div>
        <?php if (empty($data_perusahaan)) { ?>
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
                        <form action="<?= base_url('siswa/profile'); ?>" method="post">
                            <div class="row clearfix">
                                <?php if ($this->session->flashdata('notif')){ ?>
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
            <h2>PERUSAHAAN YANG DIPILIH</h2>
        </div>
        <!-- Data Perusahaan -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <?php if ($data_perusahaan != null): ?>
                        <div class="body">
                            <div class="row clearfix">
                                <?php foreach ($data_perusahaan as $dp): ?>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <?php $status = $dp->status != "diterima" && $dp->status != "-" ? $dp->status." konfirmasi":$dp->status; ?>
                                        <b>Pilihan <?= $dp->indeks; ?> (<?= $status; ?>)</b><hr class="my-1">
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
                            Anda belum memilih perusahaan.
                        </div>
                    <?php endif; ?>
                </div>
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
