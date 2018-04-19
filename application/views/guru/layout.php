<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>FIND.CO</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?= base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?= base_url(); ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?= base_url(); ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?= base_url(); ?>assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!--WaitMe Css-->
    <link href="<?= base_url(); ?>assets/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="<?= base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="<?= base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Font-Awesome Css -->
    <link href="<?= base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?= base_url(); ?>assets/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">GURU - FIND.CO</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?= $userData['picture_url']; ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $userData['nama_guru']; ?></div>
                    <div class="email"><?= $userData['email_guru']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?= base_url('auth/logout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <?php $uri2 = $this->uri->segment(2); $uri3 = $this->uri->segment(3); ?>
                    <li class="<?php if(strcasecmp($uri2, 'profile') == 0 || strcasecmp($uri2, 'about') == 0) {echo 'active';} ?>">
                        <a href="<?= base_url('guru/profile'); ?>">
                            <i class="material-icons">person</i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?php if(strcasecmp($uri2, 'dashboard') == 0) {echo 'active';} ?>">
                        <a href="<?= base_url('guru/dashboard'); ?>">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="<?php if(strcasecmp($uri2, 'perusahaan') == 0) {echo 'active';} ?>">
                        <a href="<?= base_url('guru/perusahaan'); ?>">
                            <i class="material-icons">domain</i>
                            <span>Perusahaan</span>
                        </a>
                    </li>
                    <li class="<?php if(strcasecmp($uri2, 'monitor') == 0) {echo 'active';} ?>">
                        <a href="<?= base_url('guru/monitor'); ?>">
                            <i class="material-icons">timeline</i>
                            <span>Monitoring</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="<?= base_url('guru/about'); ?>">FIND.CO</a>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <!-- <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
            </div>
        </aside> -->
        <!-- #END# Right Sidebar -->
    </section>

    <script type="text/javascript">
        // set up base url
        var base_url = window.location.origin + '/pw/';
    </script>

    <!-- Jquery Core Js -->
    <script src="<?= base_url(); ?>assets/js/jquery.js"></script>

    <?php $this->load->view($main_view); ?>

    <!-- Bootstrap Core Js -->
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?= base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?= base_url(); ?>assets/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="<?= base_url(); ?>assets/js/admin.js"></script>
    <?php
    if(strcasecmp($uri2, 'dashboard') == 0) {
        // Jquery CountTo Plugin Js
        echo '<script src="'.base_url().'assets/plugins/jquery-countto/jquery.countTo.js"></script>';
        // Morris Plugin Js
        echo '<script src="'.base_url().'assets/plugins/raphael/raphael.min.js"></script>';
        echo '<script src="'.base_url().'assets/plugins/morrisjs/morris.js"></script>';
        // Sparkline Chart Plugin Js
        echo '<script src="'.base_url().'assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>';
        // Custom Js
        echo '<script src="'.base_url().'assets/js/pages/index.js"></script>';
    }
    if(strcasecmp($uri2, 'perusahaan') == 0) {
        // Wait Me Plugin Js
        echo '<script src="'.base_url().'assets/plugins/waitme/waitMe.js"></script>';
        // Jquery Validation Plugin
        echo '<script src="'.base_url().'assets/plugins/jquery-validation/jquery.validate.js"></script>';
        // JQuery Steps Plugin Js
        echo '<script src="'.base_url().'assets/plugins/jquery-steps/jquery.steps.js"></script>';
        // Sweet Alert Plugin Js
        echo '<script src="'.base_url().'assets/plugins/sweetalert/sweetalert.min.js"></script>';
        // Custom Js
        echo '<script src="'.base_url().'assets/js/pages/cards/colored.js"></script>';
        echo '<script src="'.base_url().'assets/js/pages/forms/form-wizard.js"></script>';
    }
    if(strcasecmp($uri2, 'profile') == 0) {
        // Autosize Plugin Js
        echo '<script src="'.base_url().'assets/plugins/autosize/autosize.js"></script>';
        // Moment Plugin Js
        echo '<script src="'.base_url().'assets/plugins/momentjs/moment.js"></script>';
        // Custom Js
        // echo '<script src="'.base_url().'assets/js/pages/forms/basic-form-elements.js"></script>';
    }
    ?>

    <script type="text/javascript">
        $(function() {
            //Tooltip
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        });
    </script>
    <!-- Demo Js -->
    <script src="<?= base_url(); ?>assets/js/demo.js"></script>
</body>

</html>
