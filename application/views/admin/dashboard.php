    <div class="main">
        <div class="outer-admin">
            <div class="wrapper-admin">
                <?php $this->load->view('templates/admin_menu'); ?>

                <div class="content-admin">
                    <div class="content-admin-wrapper">
                        <div class="content-admin-main">
                            <div class="content-admin-main-inner">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">


    <div class="row">
        <div class="col-sm-12 col-lg-12">

            <div class="row">
                <div class="col-sm-4">
                    <div class="statusbox">
                        <h2>Total User</h2>
                        <div class="statusbox-content">
                            <strong><?php echo $all_users; ?></strong>
                            <span>Updated <?php echo date('j/n/Y'); ?></span>
                        </div><!-- /.statusbox-content -->

                        <div class="statusbox-actions">
                            <a href="#"><i class="fa fa-eye"></i></a>
                        </div><!-- /.statusbox-actions -->
                    </div><!-- /.statusbox -->
                </div>
                <div class="col-sm-4">
                    <div class="statusbox">
                        <h2>Total Crops</h2>
                        <div class="statusbox-content">
                            <strong><?php echo $crops; ?></strong>
                            <span>Updated <?php echo date('j/n/Y'); ?></span>
                        </div><!-- /.statusbox-content -->

                        <div class="statusbox-actions">
                            <a href="#"><i class="fa fa-eye"></i></a>

                        </div><!-- /.statusbox-actions -->
                    </div>
                </div>
                <?php  if($this->session->userdata('designation') != 'employee'): ?>
                <div class="col-sm-4">
                    <div class="statusbox">
                        <h2>Daily Transaction</h2>
                        <div class="statusbox-content">
                            <strong>&#8358;<?php echo number_format($dailyAmount, 2) ?></strong>
                            <span>Updated <?php echo date('j/n/Y'); ?></span>
                        </div><!-- /.statusbox-content -->

                        <div class="statusbox-actions">
                            <a href="#"><i class="fa fa-eye"></i></a>

                        </div><!-- /.statusbox-actions -->
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="statusbox">
                        <h2>Total Paystack Transaction</h2>
                        <div class="statusbox-content">
                            <strong>&#8358;<?php echo number_format($paystack, 2) ?></strong>
                            <span>Updated <?php echo date('j/n/Y'); ?></span>
                        </div><!-- /.statusbox-content -->

                        <div class="statusbox-actions">
                            <a href="#"><i class="fa fa-eye"></i></a>

                        </div><!-- /.statusbox-actions -->
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="statusbox">
                        <h2>Total Bank Transfer</h2>
                        <div class="statusbox-content">
                            <strong>&#8358;<?php echo number_format($bank_transfer, 2) ?></strong>
                            <span>Updated <?php echo date('j/n/Y'); ?></span>
                        </div><!-- /.statusbox-content -->

                        <div class="statusbox-actions">
                            <a href="#"><i class="fa fa-eye"></i></a>

                        </div><!-- /.statusbox-actions -->
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="statusbox">
                        <h2>Verified Amount</h2>
                        <div class="statusbox-content">
                            <strong>&#8358;<?php echo number_format($verifiedAmount, 2) ?></strong>
                            <span>Updated <?php echo date('j/n/Y'); ?></span>
                        </div><!-- /.statusbox-content -->

                        <div class="statusbox-actions">
                            <a href="#"><i class="fa fa-eye"></i></a>

                        </div><!-- /.statusbox-actions -->
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="statusbox">
                        <h2>Unverified Amount</h2>
                        <div class="statusbox-content">
                            <strong>&#8358;<?php echo number_format($unverifiedAmount, 2) ?></strong>
                            <span>Updated <?php echo date('j/n/Y'); ?></span>
                        </div><!-- /.statusbox-content -->

                        <div class="statusbox-actions">
                            <a href="#"><i class="fa fa-eye"></i></a>

                        </div><!-- /.statusbox-actions -->
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="statusbox">
                        <h2>Daily Registration</h2>
                        <div class="statusbox-content">
                            <strong><?php echo count($daily_user) ?></strong>
                            <span>Updated <?php echo date('j/n/Y'); ?></span>
                        </div><!-- /.statusbox-content -->

                        <div class="statusbox-actions">
                            <a href="#"><i class="fa fa-eye"></i></a>

                        </div><!-- /.statusbox-actions -->
                    </div>
                </div>
<?php endif; ?>
                
            </div><!-- /.row -->
        </div><!-- /.col-* -->


    </div><!-- /.row -->



    <div class="row">
        <div class="col-sm-12 col-lg-5">
            <h3>Recent Registered Users </h3>

            <div class="users">
    <table class="table">
        <tbody>

          <?php foreach ($recent_users as $recent): ?>
            <tr>
                <td><a class="user" href="#"><img src="<?php echo (isset($recent->image_name))? base_url('upload/profile_pic/').$recent->image_name : '' ?>" alt=""></a></td>
                <td class="hidden-xs visible-sm visible-md visible-lg">
                    <h2><a href="#"><?php echo $recent->first_name . ' '. $recent->last_name; ?></a></h2>
                </td>

            </tr>
          <?php endforeach; ?>

        </tbody>
    </table>
</div><!-- /.users -->

        </div><!-- /.col-* -->


    </div><!-- /.row -->
</div><!-- /.col-* -->

                                    </div>
                                </div><!-- /.container-fluid -->
                            </div><!-- /.content-admin-main-inner -->
                        </div><!-- /.content-admin-main -->
