<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>PROFILE</h2>
        </div>
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
                        <form action="<?= base_url('admin/profile/edit/').$adminData['id_admin']; ?>" method="post">
                            <div class="row clearfix">
                                <?php if ($this->session->flashdata('notif') != ""){ ?>
                                    <div class="alert alert-<?= $this->session->flashdata('classNotif'); ?>">
                                        <?= $this->session->flashdata('notif'); ?>
                                    </div>
                                <?php } ?>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $adminData['username']; ?>" disabled>
                                            <label class="form-label">Username</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn bg-cyan waves-effect m-b-15" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                            <!-- collapse input -->
                            <div class="collapse" id="collapseExample" aria-expanded="false" style="height: 0px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="currentPassword" placeholder="Current password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="newPassword" placeholder="New password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of collapse input -->
                            <div class="icon-and-text-button-demo d-block mx-auto">
                                <button type="submit" name="updateProfile" class="btn btn-lg bg-teal waves-effect">
                                    <i class="material-icons">check</i><span>SAVE PROFILE</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Form Data Diri -->
    </div>
</section>
