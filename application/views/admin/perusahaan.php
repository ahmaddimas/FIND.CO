<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATA PERUSAHAAN
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?= base_url('Admin/Perusahaan/Tambah'); ?>">Tambah Perusahaan</a></li>
                                </ul>
                            </li>
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
                                        foreach ($perusahaan as $p): ?>
                                            <tr>
                                                <td><?= $p->nama_perusahaan; ?></td>
                                                <td><?= $p->alamat; ?></td>
                                                <td><?= $p->telp_perusahaan; ?></td>
                                                <td><?= $p->cp; ?></td>
                                                <td><?= $p->kuota; ?></td>
                                                <td style="width: 100px">
                                                    <button type="button" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">mode_edit</i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">delete</i>
                                                    </button>
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
