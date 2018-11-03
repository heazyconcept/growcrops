<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>

   <div class="user-dashboard">
   <div class="main">
       <div class="main-inner">
           <div class="container">
               <div class="row">
                   <div class="col-sm-4 col-lg-3">
                       <div class="sidebar">
   <?php $this->load->view('templates/user_menu'); ?>

                       </div><!-- /.sidebar -->
                   </div><!-- /.col-* -->

                   <div class="col-sm-8 col-lg-9">
                       <div class="content">
                           <div class="page-title">
   <h1 class="user_name"><?php echo ucfirst(strtolower($user_data['first_name'])); ?> <?php echo ucfirst(strtolower($user_data['last_name'])); ?></h1>
   </div><!-- /.page-title -->
   <div class="right-dashboard">
     <div class="row">
     <?php if( isset($DashboardStat)) : ?>
       <div class="col-md-12 cards-col">
         <div class="row">
           <div class="col-md-4 col-xs-6 card-item">
               <div class="card-text">
                 <span class="dash-value">&#8358;<?php echo number_format($DashboardStat->AmountPayeable, 2); ?></span>
                 <span class="dash-keys"> Amount Payeable</span>
               </div>
           </div>
           <div class="col-md-4 col-xs-6 card-item">
               
               <div class="card-text">
                 <span class="dash-value"> <?php echo $DashboardStat->Slot; ?> </span>
                 <span class="dash-keys">Slot Bought</span>
               </div>
           </div>
           <div class="col-md-4 col-xs-6 card-item">
               
               <div class="card-text">
                 <span class="dash-value"><?php echo $this->utilities->formatDate($DashboardStat->DateCreated);  ?> </span>
                 <span class="dash-keys">Last Update</span>
               </div>
           </div>
           <div class="col-md-8 col-xs-6 card-item">
               <!-- <div class="card-icon">
                 <img class="img-responsive" src="<?php //echo asset_url('img/dollar.png'); ?>" alt="">
               </div> -->
               <div class="card-text">
                 <span class="dash-value"> Payment Update</span>
                 <span class="dash-keys"><?php echo $DashboardStat->PaymentUpdate; ?> </span>
               </div>
           </div>
           
           <!-- <div class="col-md-6 card-item">
               <div class="card-icon">
                 <img class="img-responsive" src="<?php //echo asset_url('img/crops.png'); ?>" alt="">
               </div>
               <div class="card-text">
                 <span class="dash-value">3</span>
                 <span class="dash-keys"> Crops Planted</span>
               </div>
           </div>

           <div class="col-md-6 card-item">
               <div class="card-icon">
                 <img class="img-responsive" src="<?php //echo asset_url('img/crops.png'); ?>" alt="">
               </div>
               <div class="card-text">
                 <span class="dash-value">3</span>
                 <span class="dash-keys"> Crops Planted</span>
               </div>
           </div> -->

         </div>
       </div>
      <?php else: ?>
      <div class="updated-wrapper">
      <h4> Your Details is been updated please excercise patience </h4>
      </div>
      <?php endif; ?>
       
     </div>
   </div>

                       </div><!-- /.content -->
                   </div><!-- /.col-* -->
               </div><!-- /.row -->
           </div><!-- /.container -->
       </div><!-- /.main-inner -->
   </div><!-- /.main -->
</div>


