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
    <a href="<?php echo base_url('admin/crops') ?>" class="btn btn-primary pull-right new-crop"> View All Early Birds</a>
    <h3 class="admin_section_title">New Early Bird</h3>
  </div>

    <div class="col-sm-12 col-md-7">
        <form class="new_crop_form" id="new_crop_form" enctype="multipart/form-data">
          <div class="background-white p20 mb50">
              <h2 class="page-title">Crop Details</h2>

                  <div class="form-group">
                      <label for="crop_name">Crop Title</label>
                      <input type="text" class="form-control" id="crop_name" name="crop_name" >
                  </div>

                  <!-- <div class="form-group">
                      <label for="crop_content">Crop Details</label>
                      <textarea class="form-control"  id="crop_content" name="content"></textarea>
                  </div> -->

          </div>
          <div class="background-white p20 mb50">
              <h2 class="page-title">Payment Details</h2>
              <div class="row stage_one_row">
                <div class="form-group col-md-8">
                    <label for="attribute_name">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount">
                </div>
                <div class="form-group col-md-3">
                    <label for="quantity">Maximum Slot</label>
                    <input type="text" class="form-control" id="max_slot" name="max_slot">
                </div>

              </div>
          </div>





    </div><!-- /.col-* -->
    <div class="col-md-5">
      <div class="background-white p20 mb50">
          <h2 class="page-title">Crop Image</h2>

              <div class="form-group">
                  <label for="featured_image">Featured Image</label>
                  <input type="file" id="featured_image" name="featured_image">
                  <p class="help-block">Your main Image here</p>
              </div>
              <div class="form-group">
                  <label for="alternative_image">Alternative Image</label>
                  <input type="file" id="alternative_image" name="alternative_image">
                  <p class="help-block">your alternative image here.</p>
              </div>

              <button type="submit" class="btn btn-primary btn-submit"> Submit</button>
      </div>
    </div>
    </form>


</div><!-- /.row -->
</div><!-- /.col-* -->

                                </div>
                            </div><!-- /.container-fluid -->
                        </div><!-- /.content-admin-main-inner -->
                    </div><!-- /.content-admin-main -->















<script type="text/javascript">
$(document).ready(function () {
//add more fields group
$('#new_crop_form').on('submit', function (e) {
  e.preventDefault();
  var formData = new FormData($('form#new_crop_form')[0]);

  $.ajax({
      url: '<?php echo base_url('ajax_call/add_earlybird'); ?>',
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
