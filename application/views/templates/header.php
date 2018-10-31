<!DOCTYPE html>
<html>


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
    <link rel='stylesheet' href="<?php echo asset_url('css/pace-theme-flash.css') ?>">
    <link rel='stylesheet' href="<?php echo asset_url('css/extra.css') ?>">

    <script type='text/javascript' src="<?php echo asset_url('js/pace.min.js'); ?>"></script>
    <script type='text/javascript' src="<?php echo asset_url('js/jquery.js'); ?>"></script>


    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/favicon.png"> -->

    <title><?php echo $page_title; ?></title>
</head>


<body class="">

<div class="page-wrapper">

    <header class="header header-transparent">
    <div class="header-wrapper">
        <div class="container">
            <div class="header-inner">
                <div class="header-logo">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo asset_url('img/logo.png'); ?>" alt="Logo">
                    </a>
                </div><!-- /.header-logo -->

                <div class="header-content">
                    <div class="header-bottom">
                        <div class="header-action">
                          <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="<?php echo base_url('/user'); ?>" class="header-action-inner"  data-toggle="tooltip" data-placement="bottom">
                              <i class="fa fa-user"></i> Welcome <?php echo $_SESSION['first_name']; ?>
                            </a><!-- /.header-action-inner -->
                            <a href="<?php echo base_url('auth/logout'); ?>" class="header-action-inner"  data-toggle="tooltip" data-placement="bottom">
                                 Logout
                            </a>
                          <?php else: ?>
                            <a href="<?php echo base_url('/home/crops'); ?>" class="header-action-inner"  data-toggle="tooltip" data-placement="bottom">
                                <i class="fa fa-plus"></i> Start Farming
                            </a><!-- /.header-action-inner -->
                            <a href="<?php echo base_url('auth/login'); ?>" class="header-action-inner"  data-toggle="tooltip" data-placement="bottom">
                                <i class="fa fa-user"></i> Login
                            </a>
                          <?php endif; ?>

                        </div><!-- /.header-action -->

                        <ul class="header-nav-primary nav nav-pills collapse navbar-collapse">
                          <li class="hidden-md hidden-lg">
                            <?php if (isset($_SESSION['user_id'])): ?>
                              <a href="<?php echo base_url('/user'); ?>" class="header-action-inner mobile-header-auth"  data-toggle="tooltip" data-placement="bottom">
                                <i class="fa fa-user"></i> Welcome <?php echo $_SESSION['first_name']; ?>
                              </a><!-- /.header-action-inner -->
                              <a href="<?php echo base_url('auth/logout'); ?>" class="header-action-inner mobile-header-auth"  data-toggle="tooltip" data-placement="bottom">
                                   Logout
                              </a>
                            <?php else: ?>
                              <a href="<?php echo base_url('/auth/register'); ?>" class="header-action-inner mobile-header-auth"  data-toggle="tooltip" data-placement="bottom">
                                  <i class="fa fa-plus"></i> Start Farming
                              </a><!-- /.header-action-inner -->
                              <a href="<?php echo base_url('auth/login'); ?>" class="header-action-inner mobile-header-auth"  data-toggle="tooltip" data-placement="bottom">
                                  <i class="fa fa-user"></i> Login
                              </a>
                            <?php endif; ?>
                          </li>


    <li class="active">
        <a href="<?php echo base_url(); ?>">Home </a>
    </li>

    <li >
        <a href="<?php echo base_url('/home/how_it_works'); ?>">How it works</a>
    </li>

    <li>
        <a href="<?php echo base_url('/home/crops'); ?>">Crops</a>
    </li>

    <li >
        <a href="<?php echo base_url('/home/blog'); ?>">Blog </a>
    </li>

    <li >
        <a href="<?php echo base_url('/home/contact_us'); ?>">Contact </a>
    </li>


</ul>

<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".header-nav-primary">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>

                    </div><!-- /.header-bottom -->
                </div><!-- /.header-content -->
            </div><!-- /.header-inner -->
        </div><!-- /.container -->
    </div><!-- /.header-wrapper -->
</header><!-- /.header -->
