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
  <div class="container">
    <a href="<?php echo base_url('admin/new_testimonial') ?>" class="btn btn-primary pull-right new-crop"> Add New Testimonials</a>
    <h3 class="admin_section_title">All Testimonials</h3>
  </div>

    <div class="col-sm-12 col-md-12">
      <div class="background-white p20 mb50">
        <div class="all_testimonials">
        <?php if (isset($testimonials) && !empty($testimonials)): ?>
            <?php foreach ($testimonials as $testimony): ?>
              <div class="testimonial">
                <div class="testimonial_header">
                  <div class="testimonial-rating">
                    <?php
                    for ($i=0; $i < $testimony->rating ; $i++) {
                      echo '<i class="fa fa-star"></i>';
                    }

                     ?>

                  </div>
                  <div class="testimonial_name">
                    <h6><?php echo $testimony->customer_name ?></h6>
                  </div>
                </div>
                <div class="testimonial_body">
                  <p><?php echo $testimony->testimony; ?></p>
                </div>
                <div class="testimonial_footer">
                  <div class="testimonial_location">
                    <p><?php echo $testimony->customer_location; ?></p>
                  </div>
                  <div class="testimonial_action">
                    <a href="<?php echo base_url('admin/testimonial_delete/'). $testimony->id; ?>" class="btn btn-xs btn-primary crop-edit">Delete</a>
                    <a href="<?php echo base_url('admin/edit_testimonial/'). $testimony->id; ?>" class="btn btn-xs btn-primary crop-edit">Edit</a>
                  </div>
                </div>


              </div>

            <?php endforeach; ?>

        <?php else: ?>
          <h5 class="no_info">No testimonial entered yet</h5>
        <?php endif; ?>
      </div>


      </div>

    </div><!-- /.col-* -->


</div><!-- /.row -->
</div><!-- /.col-* -->

                                </div>
                            </div><!-- /.container-fluid -->
                        </div><!-- /.content-admin-main-inner -->
                    </div><!-- /.content-admin-main -->
<script type="text/javascript">
$(document).ready(function () {
$('#filter_value').on('keyup', function () {
  if (!$(this).val()) {
    $('.option_available').html('');
  }
  var filterValue = $(this).val();
  var filterData = {post_title: filterValue};
  $.post("<?php echo base_url('ajax_call/filter_post'); ?>", filterData, function(result){
  if (result) {
    console.log(result);
    $('.option_available').html(result);
  }
});
})


})
</script>
