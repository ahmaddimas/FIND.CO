<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>TAMBAH PERUSAHAAN</h2>
        </div>
        <!-- Form Data Perusahaan -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATA PERUSAHAAN
                        </h2>
                    </div>
                    <div class="body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <?php if (!empty($this->session->flashdata('notif'))){ ?>
                                    <div class="alert alert-<?= $this->session->flashdata('classNotif'); ?>">
                                        <?= $this->session->flashdata('notif'); ?>
                                    </div>
                                <?php } ?>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="perusahaan" required>
                                            <label class="form-label">Perusahaan</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="alamat" required style="overflow: hidden; word-wrap: break-word; height: 46px;"></textarea>
                                            <label class="form-label">Alamat</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="telp" required>
                                            <label class="form-label">No. Telpon</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="kota" required>
                                            <label class="form-label">Kota</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="provinsi" required>
                                            <label class="form-label">Provinsi</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="fax" required>
                                            <label class="form-label">Fax</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="cp" required>
                                            <label class="form-label">CP</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="kuota" required>
                                            <label class="form-label">Kuota</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="frmFileUpload" class="dropzone dz-clickable">
                                        <div class="dz-message">
                                            <div class="drag-icon-cph">
                                                <i class="material-icons">touch_app</i>
                                            </div>
                                            <h3>Drop files here or click to upload.</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="icon-and-text-button-demo">
                                        <button type="submit" name="updateProfile" class="btn btn-lg bg-teal waves-effect">
                                            <i class="material-icons">check</i><span>SUBMIT</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Form Data Perusahaan -->
    </div>
</section>
