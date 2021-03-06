<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">school</i>
                    </div>
                    <div class="content">
                        <div class="text">SEMUA SISWA</div>
                        <div class="number count-to" data-from="0" data-to="<?= count($xsiswa); ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <?php
            $diterima = 0;
            foreach ($xsiswa as $xs):
                $p1 = "-"; $p2 = "-"; $s1 = ""; $s2 = "";
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
                if ($p1 !== "-" && $p2 !== "-" && $status && !$reject) {
                    $diterima++;
                }
            endforeach; ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">school</i>
                    </div>
                    <div class="content">
                        <div class="text"><small>SISWA DITERIMA</small></div>
                        <div class="number count-to" data-from="0" data-to="<?= $diterima; ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">PEMBIMBING</div>
                        <div class="number count-to" data-from="0" data-to="<?= count($guru); ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <div class="row clearfix">
            <!-- Line Chart -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>GRAFIK KUOTA</h2>
                    </div>
                    <div class="body">
                        <div id="line_chart" class="graph"></div>
                    </div>
                </div>
            </div>
            <!-- #END# Line Chart -->
        </div>
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>DATA SISWA</h2>
                        <ul class="header-dropdown m-r--5">
                            <a href="<?= base_url('admin/users/siswa'); ?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="Tambah Perusahaan">
                                <i class="material-icons">launch</i>
                            </a>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Pilihan 1</th>
                                        <th>Pilihan 2</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($xsiswa as $xs):
                                        if ($i == 11) {
                                            break;
                                        }
                                        $p1 = "-"; $p2 = "-"; $s1; $s2;
                                        foreach ($siswa as $s) {
                                            if ($s->id_siswa !== $xs->id_siswa) {
                                                continue;
                                            }
                                            if ($s->indeks == 1) {
                                                $p1 = $s->nama_perusahaan;
                                                $s1 = $s->status;
                                                continue;
                                            }
                                            if ($s->indeks == 2) {
                                                $p2 = $s->nama_perusahaan;
                                                $s2 = $s->status;
                                                continue;
                                            }
                                        }
                                        $status = $s1 === 'diterima' || $s2 === 'diterima' ? 1:0;
                                        $reject = $s1 === 'ditolak' || $s2 === 'ditolak' ? 1:0;
                                        $status1 = $status === 0 ? 'Menunggu Konfirmasi':1;
                                        if ($p1 !== "-" && $p2 !== "-" && !$status && !$reject): ?>
                                            <tr id="i<?= $xs->id_siswa; ?>">
                                                <td><?= $i++; ?></td>
                                                <td><?= $xs->nama_siswa; ?></td>
                                                <td><?= $p1; ?></td>
                                                <td><?= $p2; ?></td>
                                                <td class="text-warning"><?= $status1; ?></td>
                                            </tr>
                                        <?php endif;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
        <!-- DATA MONITORING -->
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>DATA MONITORING</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pembimbing</th>
                                        <th>Perusahaan</th>
                                        <th>Tanggal Monitoring</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($monitoring as $m): ?>
                                    <tr id="i<?= $m->id_monitoring; ?>">
                                        <td><?= $i++; ?></td>
                                        <td><?= $m->nama_guru; ?></td>
                                        <td><?= $m->nama_perusahaan; ?></td>
                                        <td><?= $m->tgl_monitoring; ?></td>
                                        <td><?= $m->keterangan; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
</section>
<script type="text/javascript">
    var kuota_line_chart = <?php echo json_encode($rekap); ?>;
    console.log(kuota_line_chart[0]);
</script>
