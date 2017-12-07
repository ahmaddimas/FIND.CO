<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <title>Login | FIND.CO</title>
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

        <div class="jumbotron jumbotron-fluid my-auto" id="top-element">
            <div class="container">
                <form action="" method="post">
                    <h4>Login with Google Account</h4><hr>
                    <div class="form-group">
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control">
                    </div>
                </form>
            </div>
        </div>
        <script src="<?= base_url(); ?>assets/js/jquery.js" charset="utf-8"></script>
        <script src="<?= base_url(); ?>assets/js/popper.min.js" charset="utf-8"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js" charset="utf-8"></script>
        <script type="text/javascript">
            $(window).on('load', function(event) {
                $('.animation').fadeOut(2000);
            });
        </script>
    </body>
</html>
