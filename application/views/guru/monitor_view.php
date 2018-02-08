<section class="content">
    <div class="container-fluid">
        <?php if ($this->session->flashdata('notif') != ""){ ?>
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
                            DATA MONITORING PERUSAHAAN
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="#modalMonitor" data-toggle="modal" data-placement="left" title="" data-original-title="Tambah Monitoring">
                                    <i class="material-icons">add</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Perusahaan</th>
                                        <th>Tanggal Monitoring</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Perusahaan</th>
                                        <th>Tanggal Monitoring</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($monitor as $m): ?>
                                        <tr id="g<?= $m->id_monitoring; ?>">
                                            <td><?= $m->nama_perusahaan; ?></td>
                                            <td><?= $m->tgl_monitoring; ?></td>
                                            <td><?= $m->keterangan; ?></td>
                                            <td class="p-1">
                                                <a href="#" onclick="prepareEdit(this)" aria-label="<?= $m->id_monitoring; ?>" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float m-1">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                                <a href="<?= base_url('guru/monitor/delete/').$m->id_monitoring; ?>" class="btn btn-danger btn-circle waves-effect waves-circle waves-float m-1" onclick="return confirm('Anda yakin ingin menghapus?')">
                                                    <i class="material-icons">delete</i>
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
        <div class="modal fade" tabindex="-1" role="dialog" id="modalMonitor">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Monitoring</h3>
                    </div>
                    <div class="modal-body">
                        <form class="" action="<?= base_url('guru/monitor/'); ?>" method="post">
                            <div class="row clearfix">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="tgl_monitoring" id="tgl_monitoring" value="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>" autofocus required>
                                        <label class="form-label">Tanggal Monitoring</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Perusahaan</label>
                                    <select class="form-control selectpicker" name="nama_perusahaan" id="id_perusahaan">
                                        <option value="">-- Please Select Industry --</option>
                                        <?php foreach ($data_perusahaan as $p): ?>
                                            <option value="<?= $p->id_perusahaan; ?>"><?= $p->nama_perusahaan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea rows="1" class="form-control no-resize auto-growth" name="keterangan" id="keterangan" required style="overflow: hidden; word-wrap: break-word; height: 46px;" placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                                <div class="icon-and-text-button-demo">
                                    <!-- <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
                                    <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">
                                        <i class="material-icons">close</i><span>CLOSE</span>
                                    </button>
                                    <button type="submit" name="submitMonitor" class="btn btn-lg bg-teal waves-effect">
                                        <i class="material-icons">check</i><span>SUBMIT</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of modal dialog -->
    </div>
</section>
<script type="text/javascript">
    var defaultAction = $('#modalMonitor').find('form').attr('action');

    function resetAction() {
        $('#modalMonitor').find('form').attr('action', defaultAction + 'add');
    }

    resetAction();

    function prepareEdit(e) {
        var _index = $(e).attr('aria-label');
        $.ajax({
            url: base_url+'guru/monitor/get',
            type: 'POST',
            dataType: 'json',
            data: {mid: _index},
            beforeSend: function() {
                $('.page-loader-wrapper').show(0);
            }
        }).done(function(e) {
            if (e.statusCode !== 0) {
                var _form = $('#modalMonitor').find('form');
                _form.attr('action', defaultAction + 'edit/' + _index);
                _form.find("#tgl_monitoring").val(e.tgl_monitoring);
                _form.find("#id_perusahaan").selectpicker('val', e.id_perusahaan);
                _form.find("#keterangan").val(e.keterangan);
                $("#modalMonitor").modal('show');
            }
            $('.page-loader-wrapper').fadeOut();
        });
    }

    // $('#modalMonitor').find('form').find("#id_perusahaan").val('7');

    $("#modalMonitor").on('hide.bs.modal', function(event) {
        var _form = $('#modalMonitor').find('form');
        _form.find("#tgl_monitoring").val("<?= date('Y-m-d'); ?>");
        _form.find("#id_perusahaan").selectpicker('val', '');
        _form.find("#keterangan").removeClass('focused').val('');
        resetAction();
    });
</script>
