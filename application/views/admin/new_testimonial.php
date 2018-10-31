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
    <a href="<?php echo base_url('admin/testimonials') ?>" class="btn btn-primary pull-right new-crop"> View All Testimonials</a>
    <h3 class="admin_section_title">New Testimonial</h3>
  </div>

    <div class="col-sm-12 col-md-7">
        <form class="new_post_form" id="new_post_form" enctype="multipart/form-data">
          <div class="background-white p20 mb50">
              <h2 class="page-title">Testimonial Details</h2>

                  <div class="form-group">
                      <label for="crop_name">Customer's Name</label>
                      <input type="text" class="form-control" id="customer_name" name="customer_name" >
                  </div>

                  <div class="form-group">
                      <label for="crop_content">Testimony</label>
                      <textarea class="form-control"  id="testimony" name="testimony"></textarea>
                  </div>
                  <div class="form-group">
                      <label for="customer_location">Customer's Location</label>
                      <input type="text" class="form-control" id="customer_location" name="customer_location" >
                  </div>
                  <div class="form-group">
                      <label for="rating">Rating</label>
                      <input type="number" class="form-control" id="rating" name="rating" >
                  </div>
                  <button type="submit" class="btn btn-primary btn-submit"> Submit</button>

          </div>



    </div><!-- /.col-* -->

    </form>


</div><!-- /.row -->
</div><!-- /.col-* -->

                                </div>
                            </div><!-- /.container-fluid -->
                        </div><!-- /.content-admin-main-inner -->
                    </div><!-- /.content-admin-main -->

<script type="text/javascript">
$(document).ready(function () {
$('#new_post_form').on('submit', function (e) {
  e.preventDefault();
  var formData = new FormData($('form#new_post_form')[0]);
  $.ajax({
      url: '<?php echo base_url('ajax_call/add_testimonial'); ?>',
      type: 'POST',
      data: formData,
      async: false,
      success: function (data) {
        console.log(data);
        if(data == '1'){
          swal("Success", "Data saved successfully", "success");
          setTimeout(function(){
            location.reload();
          },2000)
        }else {
          swal("Oops", "unknown error occured, kindly contact your administrator", "error");
        }

      },
      cache: false,
      contentType: false,
      processData: false
  });
})
})
</script>
