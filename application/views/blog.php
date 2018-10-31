<div class="main blog_page">
   <div class="main-inner">
      <div class="container">
         <div class="row">
            <div class="col-sm-8 col-lg-9">
               <div class="content">
                  <div class="page-title">
                     <h1>Our Latest News</h1>
                  </div>
                  <!-- /.page-title -->
                  <div class="posts">
                     <?php if ($blog): ?>
                     <?php foreach ($blog as $post): ?>
                     <div class="post post-boxed">
                        <div class="post-image">
                           <img src="<?php echo asset_url('img/').$post->post_image ?>" alt="<?php echo $post->post_title; ?>">
                           <a class="read-more" href="<?php echo base_url('post/view/').$post->slug; ?>">View</a>
                        </div>
                        <!-- /.post-image -->
                        <div class="post-content">
                           <h2>
                              <a href="<?php echo base_url('post/view/').$post->slug; ?>"><?php echo $post->post_title; ?>
                              <a>
                           </h2>
                           <p><?php echo character_limiter(strip_tags($post->post_content), 200, '...') ?></p>
                        </div>
                        <!-- /.post-content -->
                        <div class="post-meta clearfix">
                        <div class="post-meta-author">By <a href="blog-detail.html">Growcropsonline</a></div><!-- /.post-meta-author -->
                        <div class="post-meta-date"><?php echo date('d/m/Y', strtotime($post->date_created)); ?></div><!-- /.post-meta-date -->
                        <div class="post-meta-more"><a href="<?php echo base_url('post/view/').$post->slug; ?>">Read More <i class="fa fa-chevron-right"></i></a></div><!-- /.post-meta-more -->
                        </div><!-- /.post-meta -->
                     </div>
                     <!-- /.post -->
                     <?php endforeach; ?>
                     <?php else: ?>
                     <div class="post post-boxed">
                        No post available yet
                     </div>
                     <!-- /.post -->
                     <?php endif; ?>
                  </div>
                  <!-- /.posts -->
                  <!-- <div class="pager">
                     <ul>
                         <li><a href="#">Prev</a></li>
                         <li><a href="#">5</a></li>
                         <li class="active"><a>6</a></li>
                         <li><a href="#">7</a></li>
                         <li><a href="#">Next</a></li>
                     </ul>
                     </div> -->
               </div>
               <!-- /.content -->
            </div>
            <!-- /.col-* -->
            <div class="col-sm-4 col-lg-3">
               <div class="sidebar">
                  <div class="widget">
                     <h2 class="widgettitle">Our Crops</h2>
                     <?php foreach ($this->all_conn->fetch_crops(10) as $crop): ?>
                     <div class="cards-small">
                        <div class="card-small">
                           <div class="card-small-image">
                              <a href="<?php echo base_url('crops/view/').$crop->slug; ?>">
                              <img src="<?php echo asset_url('img/').$crop->featured_image; ?>" alt="<?php echo $crop->crop_name; ?>">
                              </a>
                           </div>
                           <!-- /.card-small-image -->
                           <div class="card-small-content">
                              <h3><a href="<?php echo base_url('crops/view/').$crop->slug; ?>"><?php echo $crop->crop_name ?></a></h3>
                           </div>
                           <!-- /.card-small-content -->
                        </div>
                        <!-- /.card-small -->
                     </div>
                     <!-- /.cards-small -->
                     <?php endforeach; ?>
                  </div>
                  <!-- /.widget -->
               </div>
               <!-- /.sidebar -->
            </div>
            <!-- /.col-* -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container -->
   </div>
   <!-- /.main-inner -->
</div>
<!-- /.main -->
