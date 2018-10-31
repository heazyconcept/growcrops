<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
   <div class="main">
       <div class="main-inner mb50">
           <div class="content">
               <div class="mt-80 mb80">
   <div class="detail-banner" style="background-image: url(<?php echo asset_url('img/').$crop[0]->featured_image; ?>);">
   <div class="container">
       <div class="detail-banner-left">

           <h2 class="detail-title">
               <?php echo $crop[0]->crop_name; ?>
           </h2>

           <!-- <div class="detail-banner-btn bookmark">
               <i class="fa fa-bookmark-o"></i> <span data-toggle="Bookmarked">Bookmark</span>
           </div> -->

           <div class="detail-banner-btn heart">
              <a href="<?php echo base_url('earlybird/checkout/').$crop[0]->slug; ?>">Start Farming</a>
           </div><!-- /.detail-claim -->

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

           <!-- <ul class="detail-gallery-index">
               <li class="detail-gallery-list-item active">
                   <a data-target="assets/img/tmp/gallery-1.jpg">
                       <img src="assets/img/tmp/gallery-1.jpg" alt="...">
                   </a>
               </li>
               <li class="detail-gallery-list-item active">
                   <a data-target="assets/img/tmp/gallery-2.jpg">
                       <img src="assets/img/tmp/gallery-2.jpg" alt="...">
                   </a>
               </li>
               <li class="detail-gallery-list-item active">
                   <a data-target="assets/img/tmp/gallery-3.jpg">
                       <img src="assets/img/tmp/gallery-3.jpg" alt="...">
                   </a>
               </li>
               <li class="detail-gallery-list-item active">
                   <a data-target="assets/img/tmp/gallery-4.jpg">
                       <img src="assets/img/tmp/gallery-4.jpg" alt="...">
                   </a>
               </li>
               <li class="detail-gallery-list-item active">
                   <a data-target="assets/img/tmp/gallery-5.jpg">
                       <img src="assets/img/tmp/gallery-5.jpg" alt="...">
                   </a>
               </li>
               <li class="detail-gallery-list-item active">
                   <a data-target="assets/img/tmp/gallery-6.jpg">
                       <img src="assets/img/tmp/gallery-6.jpg" alt="...">
                   </a>
               </li>
               <li class="detail-gallery-list-item active">
                   <a data-target="assets/img/tmp/gallery-7.jpg">
                       <img src="assets/img/tmp/gallery-7.jpg" alt="...">
                   </a>
               </li>
               <li class="detail-gallery-list-item active">
                   <a data-target="assets/img/tmp/gallery-8.jpg">
                       <img src="assets/img/tmp/gallery-8.jpg" alt="...">
                   </a>
               </li>
           </ul> -->
       </div><!-- /.detail-gallery -->

   </div><!-- /.col-sm-7 -->

   <div class="col-sm-5">

       <div class="background-white p20">
           <!-- <div class="detail-overview-hearts">
               <i class="fa fa-heart"></i> <strong>213 </strong>people love it
           </div>
           <div class="detail-overview-rating">
               <i class="fa fa-star"></i> <strong>4.3 / 5 </strong>from <a href="#reviews">316 reviews</a>
           </div> -->
           <div class="crop_title">
             <?php echo $crop[0]->crop_name; ?>
             <span>&#8358; <?php echo number_format($price[0]->amount, 2) ?></span>
           </div>

           <div class="detail-actions row">
               <div class="col-sm-5">
                   <div class="btn btn-primary btn-book"><a href="<?php echo base_url('earlybird/checkout/').$crop[0]->slug; ?>"><i class="fa fa-shopping-cart"></i> Start Farming </a></div>
               </div><!-- /.col-sm-4 -->
               <div class="col-sm-5">
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

           </div><!-- /.detail-actions -->
       </div>






       <!-- <h2>Amenities</h2>

       <div class="background-white p20">
           <ul class="detail-amenities">
               <li class="yes">WiFi</li>
               <li class="yes">Parking</li>
               <li class="no">Vine</li>
               <li class="yes">Terrace</li>
               <li class="no">Bar</li>
               <li class="yes">Take Away Coffee</li>
               <li class="no">Catering</li>
               <li class="yes">Raw Food</li>
               <li class="no">Delivery</li>
               <li class="yes">No-smoking room</li>
               <li class="no">Reservations</li>
           </ul>
       </div> -->





       <!-- <div class="detail-payments">
           <h3>Accepted Payments</h3>

           <ul>
               <li><a href="#"><i class="fa fa-paypal"></i></a></li>
         <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
               <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
         <li><a href="#"><i class="fa fa-cc-stripe"></i></a></li>
               <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
       </ul>
       </div> -->

   </div><!-- /.col-sm-5 -->


   </div><!-- /.row -->

   </div><!-- /.container -->

           </div><!-- /.content -->
       </div><!-- /.main-inner -->
   </div><!-- /.main -->
