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
  <link rel='stylesheet' href="<?php echo asset_url('css/bootstrap3-wysihtml5.min.css') ?>">
  <link rel='stylesheet' href="<?php echo asset_url('css/pace-theme-flash.css') ?>">
  <link rel='stylesheet' href="<?php echo asset_url('css/on-off-switch.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/datatables.bootstrap.min.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/buttons.datatables.min.css'); ?>" />
  <link rel='stylesheet' href="<?php echo asset_url('css/admin.css') ?>">

  <script type='text/javascript' src="<?php echo asset_url('js/pace.min.js'); ?>"></script>

  <script type='text/javascript' src="<?php echo asset_url('js/jquery.js'); ?>"></script>
  <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type='text/javascript' src="<?php echo asset_url('js/on-off-switch.js'); ?>"></script>
  <script type='text/javascript' src="<?php echo asset_url('js/on-off-switch-onload.js'); ?>"></script>
  <script type='text/javascript' src="<?php echo asset_url('js/datatables.min.js'); ?>"></script>
  <script type='text/javascript' src="<?php echo asset_url('js/datatables.bootstrap.min.js'); ?>"></script>

    <title><?php echo $page_title; ?></title>
</head>


<body class="">

<div class="page-wrapper">

    <header class="header header-minimal">
    <div class="header-statusbar">
        <div class="header-statusbar-inner">
            <div class="header-statusbar-left">
              <img src="<?php echo asset_url('img/logo.png') ?>" alt="">
            </div><!-- /.header-statusbar-left -->

            <div class="header-statusbar-right">
              <div class="header-nav-user">
<div class="dropdown">
<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
  <div class="user-image">
      <img src="<?php if(empty($user_extras)){echo asset_url('img/agent-2.jpg');}else{echo base_url('upload/profile_pic/').$user_extras[0]->image_name;} ?>">
      <div class="notification"></div><!-- /.notification-->
  </div><!-- /.user-image -->

  <span class="header-nav-user-name"><?php echo $this->session->userdata('first_name') . ' '. $this->session->userdata('last_name'); ?></span> <i class="fa fa-chevron-down"></i>
</button>

<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
  <li><a href="<?php echo base_url('admin/profile'); ?>">Edit Profile</a></li>
  <li><a href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
</ul>
</div><!-- /.dropdown -->
</div><!-- /.header-nav-user -->
            </div><!-- /.header-statusbar-right -->
        </div><!-- /.header-statusbar-inner -->
    </div><!-- /.header-statusbar -->
</header><!-- /.header -->
