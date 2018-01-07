<section class="content">
    <div class="container-fluid">
        <?php if (!empty($this->session->flashdata('notif'))){ ?>
            <div class="alert alert-<?= $this->session->flashdata('classNotif'); ?>">
                <?= $this->session->flashdata('notif'); ?>
            </div>
        <?php } ?>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATA SISWA
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Angkatan</th>
                                        <th>No. Telpon</th>
                                        <th>JK</th>
                                        <th>Pilihan 1</th>
                                        <th>Pilihan 2</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Angkatan</th>
                                        <th>No. Telpon</th>
                                        <th>JK</th>
                                        <th>Pilihan 1</th>
                                        <th>Pilihan 2</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody id="table-list">
                                    <?php foreach ($xsiswa as $xs):
                                        $p1 = "-"; $p2 = "-"; $s1; $s2;
                                        foreach ($siswa as $s) {
                                            if ($s->id_siswa !== $xs->id_siswa) {
                                                continue;
                                            }
                                            if ($s->indeks == 1) {
                                                $p1 = $s->nama_perusahaan.' ('.$s->status.')';
                                                $s1 = $s->status;
                                                continue;
                                            }
                                            if ($s->indeks == 2) {
                                                $p2 = $s->nama_perusahaan.' ('.$s->status.')';
                                                $s2 = $s->status;
                                                continue;
                                            }
                                        }
                                        $status = $s1 === 'diterima' || $s2 === 'diterima' ? 1:0;
                                        $reject = $s1 === 'ditolak' || $s2 === 'ditolak' ? 1:0;
                                        $kelas = !empty($xs->kelas) ? $xs->jurusan.' '.str_replace(' ','', substr($xs->kelas, strrpos($xs->kelas, $xs->jurusan) + $xs->jurusan - 1)) : '';
                                        ?>
                                        <tr id="i<?= $xs->id_siswa; ?>">
                                            <td><?= $xs->nama_siswa; ?></td>
                                            <td><?= $kelas; ?></td>
                                            <td><?= $xs->angkatan; ?></td>
                                            <td><?= $xs->telp_siswa; ?></td>
                                            <td><?= $xs->jk_siswa; ?></td>
                                            <td><?= $p1; ?></td>
                                            <td><?= $p2; ?></td>
                                            <td class="p-1">
                                                <?php if ($p1 !== "-" && $p2 !== "-" && !$status && !$reject): ?>
                                                    <button type="button" class="btn btn-success waves-effect m-1" onclick="showConfirmDialog(this)">
                                                        <i class="material-icons">done_all</i>
                                                        <span>Konfirmasi</span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning waves-effect m-1" onclick="showRejectConfirmDialog(this)">
                                                        <i class="material-icons">close</i>
                                                        <span>Reject</span>
                                                    </button>
                                                <?php elseif ($p1 !== "-" && $p2 !== "-" && $status): ?>
                                                    <button type="button" class="btn btn-warning waves-effect m-1" onclick="showCancelConfirmDialog(this)">
                                                        <i class="material-icons">close</i>
                                                        <span>Batalkan</span>
                                                    </button>
                                                <?php endif; ?>
                                                <a href="<?= base_url('admin/users/siswa/edit/').$xs->id_siswa; ?>" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float m-1">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
        <!-- modal dialog -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalConfirm">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Konfirmasi Pilihan Perusahaan</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pilihan">
                                <b>Pilihan Pertama</b><hr class="my-1">
                                <div class="card-wrapper">
                                    <div class="card">
                                        <img src="" alt="" width="100%">
                                        <div class="body pt-1 demo-icon-container">
                                            <h4 class="title">a</h4>
                                            <div class="demo-google-material-icon">
                                                <i class="material-icons">place</i>
                                                <span class="icon-name city"></span>
                                            </div>
                                            <div class="demo-google-material-icon">
                                                <i class="material-icons">phone</i>
                                                <span class="icon-name phone-number"></span>
                                            </div>
                                            <div class="demo-google-material-icon">
                                                <i class="material-icons">check</i>
                                                <span class="icon-name"><span class="kuota"></span> Kuota Tersedia</span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="radio" class="with-gap radio-col-cyan" name="pilihan" id="p1" value="" onchange="pilih(this.value)" required>
                                    <label for="p1" class="label-radio"><span></span></label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pilihan">
                                <b>Pilihan Kedua</b><hr class="my-1">
                                <div class="card-wrapper">
                                    <div class="card">
                                        <img src="" alt="" width="100%">
                                        <div class="body pt-1 demo-icon-container">
                                            <h4 class="title">b</h4>
                                            <div class="demo-google-material-icon">
                                                <i class="material-icons">place</i>
                                                <span class="icon-name city"></span>
                                            </div>
                                            <div class="demo-google-material-icon">
                                                <i class="material-icons">phone</i>
                                                <span class="icon-name phone-number"></span>
                                            </div>
                                            <div class="demo-google-material-icon">
                                                <i class="material-icons">check</i>
                                                <span class="icon-name"><span class="kuota"></span> Kuota Tersedia</span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="radio" class="with-gap radio-col-cyan" name="pilihan" id="p2" value="" onchange="pilih(this.value)" required>
                                    <label for="p2" class="label-radio"><span></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn waves-effect btn-success" onclick="sendConfirmData(this)" aria-label="">SAVE CHANGES</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of modal dialog -->
    </div>
</section>
<script type="text/javascript">
    var _pid = "";
    function showConfirmDialog(e) {
        var _parent = $(e).parents('tr');
        $('input[name="pilihan"]').prop('checked', false);
        $.ajax({
            url: base_url+'admin/users/siswa/get',
            type: 'GET',
            dataType: 'json',
            data: {uid: _parent.attr('id')},
            beforeSend: function() {
                $('.page-loader-wrapper').show(0);
            }
        }).done(function(e) {
            if (e.statusCode !== 0) {
                var _target = $('#modalConfirm .modal-body').find('.row').find('.pilihan');
                for (var i = 0; i < _target.length; i++) {
                    $(_target[i]).find('input').val(e[i].id_perusahaan);
                    var _card = $(_target[i]).find('.card');
                    _card.find('img').attr('src', base_url + e[i].picture_url);
                    _card.find('.title').html(e[i].nama_perusahaan);
                    _card.find('.city').html(e[i].kota);
                    _card.find('.phone-number').html(e[i].telp_perusahaan);
                    _card.find('.kuota').html(e[i].kuota);
                }
                $('#modalConfirm .modal-footer').find('button.btn-success').attr('aria-label', _parent.attr('id'));
                $('.page-loader-wrapper').fadeOut();
                $('#modalConfirm').modal('show');
            }
        });
    }
    function showCancelConfirmDialog(e) {
        var _parent = $(e).parents('tr');
        var _uid = _parent.attr('id');
        swal({
            title: 'Hapus Konfirmasi?',
            type: 'error',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak, batalkan!',
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url+'admin/users/siswa/reset',
                    type: 'POST',
                    dataType: 'json',
                    data: {uid: _uid},
                    beforeSend: function() {
                        $('.page-loader-wrapper').show(0);
                    }
                }).done(function(e) {
                    if (e.statusCode !== 0) {
                        window.location.reload();
                    }
                });
            }
        });
    }
    function showRejectConfirmDialog(e) {
        var _parent = $(e).parents('tr');
        var _uid = _parent.attr('id');
        swal({
            title: 'Tolak Konfirmasi?',
            type: 'error',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak, batalkan!',
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base_url+'admin/users/siswa/reject',
                    type: 'POST',
                    dataType: 'json',
                    data: {uid: _uid},
                    beforeSend: function() {
                        $('.page-loader-wrapper').show(0);
                    }
                }).done(function(e) {
                    if (e.statusCode !== 0) {
                        window.location.reload();
                    }
                    console.log(e.statusCode);
                });
            }
        });
    }

    function pilih(val) {
        _pid = val;
    }

    function sendConfirmData(e) {
        var _index = $(e).attr('aria-label');
        if (_pid !== "") {
            $.ajax({
                url: base_url+'admin/users/siswa/set',
                type: 'POST',
                dataType: 'json',
                data: {uid: _index, pid: _pid},
                beforeSend: function() {
                    $('.page-loader-wrapper').show(0);
                }
            }).done(function(e) {
                if (e.statusCode !== 0) {
                    _pid = "";
                    window.location.reload();
                }
            });
        } else {
            swal({
                title: 'Error',
                text: 'Harap memilih perusahaan!',
                type: 'warning'
            });
        }
    }
</script>
