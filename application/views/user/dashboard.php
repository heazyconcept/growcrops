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
       <div class="col-md-7 cards-col">
         <div class="row">
           <div class="col-md-6 col-xs-6 card-item">
               <div class="card-icon">
                 <img class="img-responsive" src="<?php echo asset_url('img/crops.png'); ?>" alt="">
               </div>
               <div class="card-text">
                 <span class="dash-value"><?php echo count($invested_crop) ?></span>
                 <span class="dash-keys"> Crop(s) Planted</span>
               </div>
           </div>
           <div class="col-md-6 col-xs-6 card-item">
               <div class="card-icon">
                 <img class="img-responsive" src="<?php echo asset_url('img/investment.png'); ?>" alt="">
               </div>
               <div class="card-text">
                 <span class="dash-value">&#8358; <?php echo  (empty($transaction[0]->amount))? '0.00' : number_format($transaction[0]->amount, 2); ?> </span>
                 <span class="dash-keys">Last Invested</span>
               </div>
           </div>
           <div class="col-md-6 col-xs-6 card-item">
               <div class="card-icon">
                 <img class="img-responsive" src="<?php echo asset_url('img/dollar.png'); ?>" alt="">
               </div>
               <div class="card-text">
                 <span class="dash-value">N/A</span>
                 <span class="dash-keys">Projected Income</span>
               </div>
           </div>
           <div class="col-md-6 col-xs-6 card-item">
               <div class="card-icon">
                 <img class="img-responsive" src="<?php echo asset_url('img/drought.png'); ?>" alt="">
               </div>
               <div class="card-text">
                 <span class="dash-value"><?php echo  (empty($transaction[0]->slot))? '0' : number_format($transaction[0]->slot, 2); ?> </span>
                 <span class="dash-keys">Slot Invested</span>
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
       <div class="progress-chart col-md-5">
         <div id="specificChart" >

           </div>
       </div>
     </div>
   </div>

                       </div><!-- /.content -->
                   </div><!-- /.col-* -->
               </div><!-- /.row -->
           </div><!-- /.container -->
       </div><!-- /.main-inner -->
   </div><!-- /.main -->
</div>
<?php
if (!empty($transaction[0]->stage) || isset($transaction[0]->stage) ) {
  if ($transaction[0]->stage == 'one' || $transaction[0]->stage == 'early bird') {
    $top_perc = 25;
    $bottom_perc = 75;
    $top_color = '#ff4b4b';
    $bottom_color = '#fff';

  }elseif ($transaction[0]->stage == 'two') {
    $top_perc = 50;
    $bottom_perc = 50;
    $top_color = '#ff4b4b';
    $bottom_color = '#fff';
  }elseif ($transaction[0]->stage == 'three') {
    $top_perc = 75;
    $bottom_perc = 25;
    $top_color = '#ff4b4b';
    $bottom_color = '#fff';
  }
  elseif ($transaction[0]->stage == 'four') {
    $top_perc = 100;
    $bottom_perc = 0;
    $top_color = '#ff4b4b';
    $bottom_color = '#fff';
  }
}else {
  $top_perc = 100;
  $bottom_perc = 0;
  $top_color = '#ff4b4b';
  $bottom_color = '#fff';
}

 ?>
<script type="text/javascript">
$(document).ready(function () {
  $('#specificChart').rotapie({
      slices: [
          { color: '<?php echo $top_color; ?>', percentage: <?php echo $top_perc; ?> }, // If color not set, slice will be transparant.
          { color: '<?php echo $bottom_color; ?>', percentage: <?php echo $bottom_perc; ?> }, // Font color to render percentage defaults to 'color' but can be overriden by setting 'fontColor'.
      ],
      sliceIndex: 0, // Start index selected slice.
      deltaAngle: 0.2, // The rotation angle in radians between frames, smaller number equals slower animation.
      minRadius: 200, // Radius of unselected slices, can be set to percentage of container width i.e. '50%'
      maxRadius: 200, // Radius of selected slice, can be set to percentage of container width i.e. '45%'
      minInnerRadius: 55, // Smallest radius inner circle when animated, set to 0 to disable inner circle, can be set to percentage of container width i.e. '35%'
      maxInnerRadius: 65, // Normal radius inner circle, set to 0 to disable inner circle, can be set to percentage of container width i.e. '30%'
      innerColor: '#fff', // Background color inner circle.
      minFontSize: 30, // Smallest fontsize percentage when animated, set to 0 to disable percentage display, can be set to percentage of container width i.e. '20%'
      maxFontSize: 40, // Normal fontsize percentage, set to 0 to disable percentage display, can be set to percentage of container width i.e. '10%'
      fontYOffset: 0, // Vertically offset the percentage display with this value, can be set to percentage of container width i.e. '-10%'
      fontFamily: 'Montserrat', // FontFamily percentage display.
      fontWeight: 'bold', // FontWeight percentage display.
      decimalPoint: '.', // Can be set to comma or other symbol.
      clickable: false // If set to true a user can select a different slice by clicking on it.
      /*
      beforeAnimate: function (nextIndex, settings) {
          var canvas = this;
          return false; // Cancel rotation
      },
      afterAnimate: function(settings){
          var canvas = this;
          var index = settings.sliceIndex; // Retrieve current index.
      }
      */
  });
})

</script>
