<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <title>FIND.CO</title>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/animation.css">
    </head>
    <body>

        <!-- Loading Animation -->
        <div class="animation fixed-top">
            <div class="circle-"></div>
            <div class="circle--small"></div>
            <div class="circle--big"></div>
            <div class="circle--inner-inner"></div>
            <div class="circle--inner"></div>
        </div>

        <nav class="navbar navbar-dark navbar-expand-sm bg-transparent fixed-top py-nav">
            <a href="<?= base_url(); ?>" class="navbar-brand web-title-small">FIND.CO</a>
            <a href="#mynav" class="navbar-toggler ml-auto" data-toggle="collapse">
                <span class="navbar-toggler-icon" aria-hidden="true"></span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="mynav">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item my-1">
                        <a href="index.html" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item my-1">
                        <a href="index.html" class="nav-link">Industry</a>
                    </li>
                    <li class="nav-item my-1">
                        <a href="index.html" class="nav-link">About Us</a>
                    </li> -->
                    <li class="nav-item my-1">
                        <form class="form-inline">
                            <div class="input-group search-bar-wrapper">
                                <input type="text" class="search-bar search-bar-white" id="search" placeholder="Search Industry">
                                <span class="search-bar-icon text-white"><i class="fa fa-search"></i></span>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item ml-3 my-1" id="LoginBtn">
                        <a href="index.html" class="nav-link btn btn-outline-light rounded- px-4">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php $this->load->view($main_view); ?>
        <script src="<?= base_url(); ?>assets/js/jquery.js" charset="utf-8"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.easing.1.3.min.js" charset="utf-8"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.easing.compatibility.js" charset="utf-8"></script>
        <script src="<?= base_url(); ?>assets/js/popper.min.js" charset="utf-8"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js" charset="utf-8"></script>
        <script src="<?= base_url(); ?>assets/js/parallax.js" charset="utf-8"></script>
        <script type="text/javascript">
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
            $(window).on('load', function(event) {
                $('.animation').fadeOut(2000);
            });
            function slide(_target) {
                $('html, body').stop().animate({
                    scrollTop: $(_target).offset().top - $('nav.navbar').height()
                }, 2000, 'easeOutQuint');
            }
            $('a').click(function(event) {
                var _href = $(this).attr('href').slice(0, 1);
                if (_href == '#') event.preventDefault();
            });
        </script>
    </body>
</html>
