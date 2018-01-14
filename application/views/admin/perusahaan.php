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
                            DATA PERUSAHAAN
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <a href="<?= base_url('Admin/Perusahaan/Tambah'); ?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="Tambah Perusahaan">
                                <i class="material-icons">add</i>
                            </a>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Perusahaan</th>
                                        <th>Alamat</th>
                                        <th>No. Telpon</th>
                                        <th>Kota</th>
                                        <th>Provinsi</th>
                                        <th>CP</th>
                                        <th>Kuota</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Perusahaan</th>
                                        <th>Alamat</th>
                                        <th>No. Telpon</th>
                                        <th>Kota</th>
                                        <th>Provinsi</th>
                                        <th>CP</th>
                                        <th>Kuota</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if ($perusahaan != null):
                                        foreach ($perusahaan as $p):
                                            $out = strlen($p->alamat) > 90 ? substr($p->alamat, 0, 91).'...':$p->alamat; ?>
                                            <tr>
                                                <td><?= $p->nama_perusahaan; ?></td>
                                                <td><?= $out; ?></td>
                                                <td><?= $p->telp_perusahaan; ?></td>
                                                <td><?= $p->kota; ?></td>
                                                <td><?= $p->provinsi; ?></td>
                                                <td><?= $p->cp; ?></td>
                                                <td><?= $p->kuota - $p->diterima; ?></td>
                                                <td class="p-0">
                                                    <a href="<?= base_url('admin/perusahaan/edit/').$p->id_perusahaan; ?>" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float m-2">
                                                        <i class="material-icons">mode_edit</i>
                                                    </a>
                                                    <a href="<?= base_url('admin/perusahaan/hapus/').$p->id_perusahaan; ?>" class="btn btn-danger btn-circle waves-effect waves-circle waves-float m-2" onclick="return confirm('Anda yakin ingin menghapus?')">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
