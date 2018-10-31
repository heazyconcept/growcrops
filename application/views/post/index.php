<div class="main post_page">
    <div class="main-inner">
        <div class="container">
            <div class="content">



                <div class="page-title">
<h1><?php echo $post[0]->post_title; ?></h1>
</div><!-- /.page-title -->

<div class="posts post-detail">

<img src="<?php echo asset_url('img/').$post[0]->post_image; ?>" alt="<?php echo $post[0]->post_title; ?>">

<div class="post-meta clearfix">
    <div class="post-meta-author">By <span>Growcropsonline</span></div><!-- /.post-meta-author -->
    <div class="post-meta-date"><?php echo date('d/m/Y', strtotime($post[0]->date_created)); ?></div><!-- /.post-meta-date -->
</div><!-- /.post-meta -->

<div class="post-content">
    <?php echo $post[0]->post_content; ?>
</div><!-- /.post-content -->



<!-- <h2 id="reviews">23 Comments</h2> -->






</div><!-- /.post -->


            </div><!-- /.content -->
        </div><!-- /.container -->
    </div><!-- /.main-inner -->
</div><!-- /.main -->
