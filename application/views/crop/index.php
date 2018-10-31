<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
   <div class="main">
       <div class="main-inner">
           <div class="content">
               <div class="mt-80 mb80">
   <div class="detail-banner" style="background-image: url(<?php echo asset_url('img/').$crop[0]->featured_image; ?>);">
   <div class="container">
       <div class="detail-banner-left">

           <h2 class="detail-title">
               <?php echo $crop[0]->crop_name; ?>
               <span><?php echo ($crop[0]->is_full == 1)? '(Fully Booked)': '' ?></span>
           </h2>

           <!-- <div class="detail-banner-btn bookmark">
               <i class="fa fa-bookmark-o"></i> <span data-toggle="Bookmarked">Bookmark</span>
           </div> -->

           <div class="detail-banner-btn heart">
              <a href="<?php echo ($crop[0]->is_full == 0)? base_url('crops/checkout/').$crop[0]->slug : '#' ?>">Start Farming</a>
           </div><!-- /.detail-claim -->
           <?php if ($crop[0]->is_early == 1): ?>
             <div class="detail-banner-btn heart">
                <a href="<?php echo base_url('earlybird/checkout/').$crop[0]->slug; ?> ">Early Bird is available Buy now!</a>
             </div><!-- /.detail-claim -->
           <?php endif; ?>

       </div><!-- /.detail-banner-left -->
   </div><!-- /.container -->
   </div><!-- /.detail-banner -->

   </div>

   <div class="container">
   <div class="row detail-content">
   <div class="col-sm-7">
       <div class="detail-gallery">
           <div class="detail-gallery-preview">
               <a href="<?php echo asset_url('img/').$crop[0]->alternative_image; ?>">
                   <img src="<?php echo asset_url('img/').$crop[0]->alternative_image; ?>">
               </a>
           </div>


       </div><!-- /.detail-gallery -->
       <div class="background-white p20">
         <div class="crop_details">
           <?php echo $crop[0]->content; ?>
         </div>

       </div>
   </div><!-- /.col-sm-7 -->

   <div class="col-sm-5">

       <div class="background-white p20">

           <div class="crop_title">
             <?php echo $crop[0]->crop_name; ?>
             <span><?php echo ($crop[0]->is_full == 1)? '(Fully Booked)': '' ?></span>
           </div>

           <div class="detail-actions row">
               <div class="col-sm-6">
                   <div class="btn btn-primary btn-book"><a href="<?php echo ($crop[0]->is_full == 0)? base_url('crops/checkout/').$crop[0]->slug : '#' ?>"><i class="fa fa-shopping-cart"></i> Start Farming</a></div>

               </div><!-- /.col-sm-4 -->
               <div class="col-sm-6">
                   <div class="btn btn-secondary btn-share"><i class="fa fa-share-square-o"></i> Share
                       <div class="share-wrapper">
                           <ul class="share">
                               <li><i class="fa fa-facebook"></i> Facebook</li>
                               <li><i class="fa fa-twitter"></i> Twitter</li>
                               <li><i class="fa fa-google-plus"></i> Google+</li>
                               <li><i class="fa fa-pinterest"></i> Pinterest</li>
                               <li><i class="fa fa-chain"></i> Link</li>
                           </ul>
                       </div>
                   </div>
               </div><!-- /.col-sm-4 -->
                <?php if ($crop[0]->is_early == 1): ?>
                <div class="col-md-12 mt30">
                 <div class="btn btn-primary btn-book">
                    <a href="<?php echo base_url('earlybird/checkout/').$crop[0]->slug; ?> ">Early Bird is available Buy now!</a>
                 </div><!-- /.detail-claim -->
               </div>

                   <?php endif; ?>


           </div><!-- /.detail-actions -->
       </div>
       <div class="widget">
  <h2 class="single-crop-title">Estimated Price Breakdown</h2>

  <div class="p20 background-white">
      <div class="working-hours">
        <?php if ($payment_details): ?>
          <?php foreach ($payment_details as $detail): ?>
            <div class="day clearfix">
              <span class="name"><?php echo $detail->payment_details; ?></span><span class="hours">&#8358; <?php echo number_format($detail->total_cost, 2) ?></span>
            </div>
          <?php endforeach; ?>
          <div class="day clearfix">
            <span class="name">Admin Fee</span><span class="hours">&#8358; <?php echo number_format($crop[0]->admin_fee, 2) ?></span>
          </div>
        <?php endif; ?>

    </div>
  </div>
  </div>





   </div><!-- /.col-sm-5 -->


   </div><!-- /.row -->

   </div><!-- /.container -->

           </div><!-- /.content -->
       </div><!-- /.main-inner -->
   </div><!-- /.main -->
