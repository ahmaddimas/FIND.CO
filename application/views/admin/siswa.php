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
                                        <th>JK</th>
                                        <th>Pilihan 1</th>
                                        <th>Pilihan 2</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($xsiswa as $xs):
                                        $p1 = "-"; $p2 = "-";
                                        foreach ($siswa as $s) {
                                            if ($s->id_siswa !== $xs->id_siswa) {
                                                continue;
                                            }
                                            if ($s->indeks == 1) {
                                                $p1 = $s->nama_perusahaan;
                                                continue;
                                            }
                                            if ($s->indeks == 2) {
                                                $p2 = $s->nama_perusahaan;
                                                continue;
                                            }
                                        }
                                        $kelas = !empty($xs->kelas) ? $xs->jurusan.' '.str_replace(' ','', substr($xs->kelas, strrpos($xs->kelas, $xs->jurusan) + $xs->jurusan - 1)) : '';
                                        ?>
                                        <tr>
                                            <td><?= $xs->nama_siswa; ?></td>
                                            <td><?= $kelas; ?></td>
                                            <td><?= $xs->angkatan; ?></td>
                                            <td><?= $xs->jk_siswa; ?></td>
                                            <td><?= $p1; ?></td>
                                            <td><?= $p2; ?></td>
                                            <td style="width: 50px">
                                                <a href="<?= base_url('admin/users/siswa/edit/').$xs->id_siswa; ?>" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
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
    </div>
</section>
