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
                            DATA GURU PEMBIMBING
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                    <i class="material-icons">add</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?= base_url('admin/users/guru/tambah'); ?>" class=" waves-effect waves-block">Tambah Pembimbing</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Import Excel</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. Telpon</th>
                                        <th>JK</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. Telpon</th>
                                        <th>JK</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($guru as $g): ?>
                                        <tr id="g<?= $g->id_guru; ?>">
                                            <td><?= $g->nama_guru; ?></td>
                                            <td><?= $g->email_guru; ?></td>
                                            <td><?= $g->telp_guru; ?></td>
                                            <td><?= $g->jk_guru; ?></td>
                                            <td class="p-1">
                                                <?php if ($g->id_perusahaan == null): ?>
                                                    <button type="button" class="btn btn-success waves-effect m-1" data-toggle="modal" data-target="#modalData">
                                                        <i class="material-icons">done_all</i>
                                                        <span>Pilihkan</span>
                                                    </button>
                                                <?php endif; ?>
                                                <a href="<?= base_url('admin/users/guru/edit/').$g->id_guru; ?>" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float m-1">
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
        <div class="modal fade" tabindex="-1" role="dialog" id="modalData">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Konfirmasi Bimbingan Perusahaan</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <?php foreach ($perusahaan as $p): ?>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pilihan">
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
                                        <input type="checkbox" name="pilihan" id="p<?= $p->id_perusahaan; ?>" value="<?= $p->id_perusahaan; ?>" required>
                                        <label for="p<?= $p->id_perusahaan; ?>" class="label-checkbox"><span></span></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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
