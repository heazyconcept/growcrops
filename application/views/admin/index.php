<!DOCTYPE html>
<html>


<!-- Mirrored from preview.byaviators.com/template/superlist/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Apr 2018 09:22:53 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel='stylesheet' href="<?php echo asset_url('css/font-awesome.min.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/owl.carousel.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/colorbox.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/fileinput.min.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/superlist.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/slick.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/slick-theme.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/selectize.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/selectize.bootstrap3.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/extra.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/pace-theme-flash.css') ?>">

    <script type='text/javascript' src="<?php echo asset_url('js/pace.min.js'); ?>"></script>

    <script type='text/javascript' src="<?php echo asset_url('js/jquery.js'); ?>"></script>


    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/favicon.png"> -->

    <title><?php echo $page_title; ?></title>
</head>


<body class="">

<div class="page-wrapper">

    <header class="header">
    <div class="header-wrapper">
        <div class="container">
            <div class="header-inner">
                <div class="header-logo">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo asset_url('img/logo.png'); ?>" alt="Logo">
                    </a>
                </div><!-- /.header-logo -->

                <div class="header-content">



                </div><!-- /.header-content -->
            </div><!-- /.header-inner -->
        </div><!-- /.container -->
    </div><!-- /.header-wrapper -->
</header><!-- /.header -->




    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="content">



                    <div class="row">
    <div class="col-sm-4 col-sm-offset-4 mt50 mb50">
        <div class="page-title">
            <h1>Login</h1>
        </div><!-- /.page-title -->

        <form class="login_form" id="login_form">
            <div class="form-group">
                <label for="login-form-email">E-mail/username</label>
                <input type="text" class="form-control" name="username" id="login-form-email">
            </div><!-- /.form-group -->

            <div class="form-group">
                <label for="login-form-password">Password</label>
                <input type="password" class="form-control" name="password" id="login-form-password">
            </div><!-- /.form-group -->

            <button type="submit" class="btn btn-primary pull-right">Login</button>
        </form>
    </div><!-- /.col-sm-4 -->
</div><!-- /.row -->

                </div><!-- /.content -->
            </div><!-- /.container -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->
    <script type="text/javascript">

      $(document).ready(function () {
        $(document).on('submit', '#login_form', function (e) {
          e.preventDefault();
          var formData = new FormData($('form#login_form')[0]);
          $.ajax({
              url: '<?php echo base_url('ajax_call/login'); ?>',
              type: 'POST',
              data: formData,
              async: false,
              success: function (data) {
                realData = JSON.parse(data)
                if(realData.mess_type == '-5'){
                  swal("User Unknown", "The username used is invalid", "error");
                }else if(realData.mess_type == '-3') {
                  swal("Invalid Password", "Kindly check your password", "error");
                }else if (realData.mess_type == '1') {
                  console.log(realData);
                  location.href = realData.redirect_url;
                }

              },
              cache: false,
              contentType: false,
              processData: false
          });
        })
      })
    </script>
