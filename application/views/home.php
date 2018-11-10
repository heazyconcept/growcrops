<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<div class="main">
   <div class="main-inner">
      <div class="content">
         <div class="home-banner">
            <div class="hero-image">
               <ul class="banner-lists">
                 <?php $banner =  json_decode($home_banner[0]->option_value); ?>
                 <?php foreach ($banner as $ban): ?>
                   <li class="banner-item">
                      <img src="<?php echo asset_url('img/').$ban->home_banner; ?>" alt="">
                      <div class="banner-content">
                         <h4><?php echo $ban->banner_title; ?></h4>
                         <p><?php echo $ban->banner_sub_title; ?></p>
                      </div>
                   </li>
                 <?php endforeach; ?>
               </ul>
            </div>
            <!-- /.hero-image -->
         </div>
         <div class="featured-in-section fluid-container">
            <div class="row">
               <div class="col-md-1 featured-in-header-col">
                  <h4 class="featured-in-header">Featured in</h4>
               </div>
               <div class="col-md-11 featured-brands-col">
                  <div class="featured-brands">
                     <ul class="brand-lists">
                        <li class="brand-item"> <img src="<?php echo asset_url('img/97.jpg'); ?>" alt=""> </li>
                        <li class="brand-item"> <img src="<?php echo asset_url('img/business_day.jpg'); ?>" alt=""> </li>
                        <li class="brand-item"> <img src="<?php echo asset_url('img/b.jpg'); ?>" alt=""> </li>
                        <li class="brand-item"> <img src="<?php echo asset_url('img/happ.jpg'); ?>" alt=""> </li>
                        <li class="brand-item"> <img src="<?php echo asset_url('img/cn.jpg'); ?>" alt=""> </li>
                        <li class="brand-item"> <img src="<?php echo asset_url('img/913.jpg'); ?>" alt=""> </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="important_information_section">
            <div class="container">
               <div class="row">
                  <div class="col-md-7">
                     <div class="home_information">
                        <h3>A Brilliant Concept : Safe, Profitable and Insured</h3>
                        <p>
                        Now, anyone can OWN and RUN a real farm online from anywhere on your mobile phone, laptop, at home, 
                        in the office and on the road.
                        </p>
                        <p>
                        You simply choose a crop with a location you desire, choose a land size, you pay for it online and 
                        CONGRATS! You have started! 
                           <a href="<?php echo base_url('home/faq'); ?>"><em > CLICK HERE</em></a> FOR OUR
                           <em><a href="<?php echo base_url('home/faq'); ?>">FREQUENTLY ASKED QUESTIONS</a></em>
                        </p>
                        <p>
                        A certificate would be sent to you as evidence of your booking of your desired number of slots.
                        </p>
                        <p>
                        Over the period of planting, weeding, spraying herbicides and harvesting, 
                        you would be prompted to pay online for each of the services. You are also 
                        entitled to visit your Farm Parcel at anytime through a Pre-book Appointments 
                        System. 
                        <br>
                        During the visit, the farm manager would be available for any questions and enquiry.
                        </p>
                        <p>
                        Basically, all we are offering is farm services. Farming for you to allow 
                        you experience farming risk free and make some money in the process.
                        <br>
                        At any point, you can request an assessment of the value of your farm and you can 
                        sell your interest in the farm to anyone you choose.<a class="more" href="<?php echo base_url('home/faq'); ?>" >MORE</a>
                        </p>
                        <p>
                        After harvest, your harvested produce would either be immediately delivered to you or 
                        immediately sent for processing where the processed product is sold off at your 
                        instruction on a platform established for that purpose or if you choose, the processed 
                        product will be delivered to you. 
                        </p>
                        <p>
                           The farming process is insured from planting to harvest so you never lose money !
                        </p>
                        <p>
                            With the surging need for both raw and processed organic agricultural 
                            products,  you can make and up to 100% profit in SOME cases based on 
                            estimated prices given per crop   <em style="box-sizing: border-box;">
                           <a href="<?php echo base_url('home/crops'); ?>" >HERE</a></em>.
                        </p>
                        <p >
                            This is only for those interested in the farming and processing experience, 
                            risks and profits. We will send you a proposed timeline as soon as work 
                            begins on the field. Our ultimate guarantee is that you would NOT loose your 
                            money no matter how long the process takes.
                           <strong>SO take the BOLD step and be an ONLINE FARMER today.</strong>
                        </p>
                        <p>
                           <a class="more" href="<?php echo base_url('home/how_it_works'); ?>" >CLICK HERE TO BEGIN</a>
                        </p>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="home_announcement">
                        <div class="flash_anouncement">
                          <?php if ($early_option): ?>
                            <?php $early_o = json_decode($early_option[0]->option_value); ?>
                            <?php if ($early_o[0]->is_early == 'true'): ?>
                              <a href="<?php  echo base_url('home/earlybird'); ?>"> For Early Bird Bookings, Click HERE</a>
                            <?php endif; ?>
                          <?php endif; ?>
                        </div>
                        <?php if ($info_banner): ?>
                        <?php $info = json_decode($info_banner[0]->option_value); ?>
                          <img src="<?php echo asset_url('img/').$info[0]->info_banner; ?>" class="img-responsive" alt="">
                        <?php endif; ?>
                     </div>
                     <div class="home-video">
                        <a href="https://iframe%20src='//players.brightcove.net/1571595826001/default_default/index.html?videoId=5387556842001'%20allowfullscreen%20frameborder=0/iframe"><iframe src="//players.brightcove.net/1571595826001/default_default/index.html?videoId=5387556842001" width="100%" height="400" frameborder="0" allowfullscreen="allowfullscreen"></iframe></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="crop-category-section">
            <div class="container">
               <div class="page-header">
                  <h1>Explore Crops Categories</h1>
                  <p>List of crops you might want to cultivate</p>
               </div>
               <!-- /.page-header -->
               <div class="cards-simple-wrapper">
                  <div class="row">
                     <?php foreach ($crops as $crop): ?>
                     <div class="col-sm-6 col-md-3">
                        <div class="card-simple" data-background-image="<?php echo asset_url('img/').$crop->featured_image; ?>">
                           <div class="card-simple-background">
                              <div class="card-simple-content">
                                 <h2><a href="<?php echo base_url('crops/view/').$crop->slug ?>"><?php echo $crop->crop_name; ?></a></h2>
                                 <!-- <div class="card-simple-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    </div><!-- /.card-rating --> -->
                                 <div class="card-simple-actions">
                                    <a href="<?php echo base_url('crops/view/').$crop->slug ?>" class="fa fa-search"></a>
                                 </div>
                                 <!-- /.card-simple-actions -->
                              </div>
                              <!-- /.card-simple-content -->
                           </div>
                           <!-- /.card-simple-background -->
                        </div>
                        <!-- /.card-simple -->
                     </div>
                     <!-- /.col-* -->
                     <?php endforeach; ?>
                     <div class="section-category-action">
                        <a href="<?php echo base_url('home/crops'); ?>" class="all-action">View all</a>
                        <a href="<?php echo base_url('home/crops') ?>" class="signup-action">Start Farming</a>
                     </div>
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.cards-simple-wrapper -->
            </div>
         </div>
         <div class="container">
            <div class="block background-white background-transparent-image fullwidth whychooseus_wrapper">
            <div class="overlay_whychooseus">
            </div>
            <div class="whuchoose-design">
            <div class="page-header">
                  <h1>Why Join Grow Crops Online</h1>
               </div>
               <div class="why-choose-us">
                  <div class="row">
                     <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="why-choose-us-box">
                           <div class="icon">
                              <img src="<?php echo asset_url('img/secure.png'); ?>" alt="">
                           </div>
                           <div class="title">
                              <h4>Secure</h4>
                           </div>
                           <div class="desc">
                              <p>Your transaction and data is secure and you have nothing to worry about us. We are giving world class security</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="why-choose-us-box">
                           <div class="icon">
                              <img src="<?php echo asset_url('img/flexible.png'); ?>" alt="">
                           </div>
                           <div class="title">
                              <h4>Flexible</h4>
                           </div>
                           <div class="desc">
                              <p>You can pay in installments or at once. Making it flexible.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="why-choose-us-box">
                           <div class="icon">
                              <img src="<?php echo asset_url('img/paper-plane.png'); ?>" alt="">
                           </div>
                           <div class="title">
                              <h4>Easy</h4>
                           </div>
                           <div class="desc">
                              <p>Get a farm in less than 5 minutes, just get a crop, fund it and make your dream.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="why-choose-us-box">
                           <div class="icon">
                              <img src="<?php echo asset_url('img/gift.png'); ?>" alt="">
                           </div>
                           <div class="title">
                              <h4>Supports Farmers</h4>
                           </div>
                           <div class="desc">
                              <p>Farmers and local help are empowered and feel rewarded. </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
               
               <!-- /.page-header -->
               
            </div>
            <div class="block background-white fullwidth">
               <div class="row">
                  <div class="col-sm-6 post-col">
                     <div class="sub_title_section">
                        <h3>Latest News</h3>
                     </div>
                     <div class="posts">
                        <?php foreach ($this->all_conn->fetch_post('3') as $posts): ?>
                        <div class="post">
                           <div class="post-image">
                              <img src="<?php echo asset_url('img/').$posts->post_image; ?>" alt="">
                              <a class="read-more" href="<?php echo base_url('post/view/').$posts->slug; ?>">View</a>
                           </div>
                           <!-- /.post-image -->
                           <div class="post-content">
                              <div class="post-date"><?php echo date('d/m/Y', strtotime($posts->date_created)); ?></div>
                              <!-- /.post-date -->
                              <h2><?php echo $posts->post_title; ?></h2>
                              <p><?php echo character_limiter(strip_tags($posts->post_content), 100, '...') ?></p>
                           </div>
                           <!-- /.post-content -->
                        </div>
                        <!-- /.post -->
                        <?php endforeach; ?>
                     </div>
                     <!-- /.posts -->
                  </div>
                  <!-- /.col-* -->
                  <div class="col-sm-6">
                     <div class="sub_title_section">
                        <h3>Testimonials</h3>
                     </div>
                     <div class="testimonial-wrapper">
                        <?php foreach ($this->all_conn->fetch_testimonials(2) as $test): ?>
                        <div class="testimonial">
                           <div class="testimonial-inner">
                              <div class="testimonial-title">
                                 <h2><?php echo $test->customer_name; ?></h2>
                                 <div class="testimonial-rating">
                                    <?php
                                       for ($i=0; $i < $test->rating ; $i++) {
                                         echo '<i class="fa fa-star"></i>';
                                       }

                                        ?>
                                 </div>
                                 <!-- /.testimonial-rating -->
                              </div>
                              <!-- /.testimonial-title -->
                              <?php echo $test->testimony; ?>
                              <div class="testimonial-sign">- <?php echo $test->customer_location; ?></div>
                              <!-- /.testimonial-sign -->
                           </div>
                           <!-- /.testimonial-inner -->
                        </div>
                        <!-- /.testimonial -->
                        <?php endforeach; ?>
                     </div>
                  </div>
                  <!-- /.col-* -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.block -->
            <div class="block background-secondary fullwidth  home-cta-section">
               <div class="row">
                  <div class="cta-title">
                     <h2>Want To Start Farming From The Comfort Of Your Home?</h2>
                  </div>
                  <div class="cta-action">
                     <a href="<?php echo base_url('home/crops'); ?>">Get Started Now</a>
                  </div>
               </div>
               <!-- /.row -->
            </div>
         </div>
         <!-- /.container -->
      </div>
      <!-- /.content -->
   </div>
   <!-- /.main-inner -->
</div>
<!-- /.main -->
