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
                        <form action="<?= base_url('Admin/Perusahaan/Tambah'); ?>" method="post" enctype="multipart/form-data">
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
                                            <input type="number" class="form-control" name="telp" required>
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
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="priority" onkeyup="validNumber(this)" required>
                                            <label class="form-label">Prioritas</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="img-upload-wrapper demo-icon-container">
                                        <img class="img-upload" src="<?= base_url(); ?>assets/images/image-blank.png" style="height:auto;width:100%">
                                        <label for="gbrE" class="label-file">
                                            <div class="demo-google-material-icon">
                                                <i class="material-icons">file_upload</i> <span class="icon-name">Pilih Gambar</span>
                                            </div>
                                        </label>
                                    </div>
                                    <input id="gbrE" type="file" name="image" onchange="readInputURL(this)" class="sr-only" required>
                                </div>
                                <div class="col-sm-12">
                                    <div class="icon-and-text-button-demo">
                                        <button type="submit" name="addIndustry" class="btn btn-lg bg-teal waves-effect">
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
<script type="text/javascript">
  function validNumber(e) {
    var value = parseInt(e.value);
    if (value > 5) {
      swal({
          title: 'Error',
          text: 'Nilai maksimal 5!',
          type: 'warning'
      });
      $(e).val('');
    }
  }
</script>
