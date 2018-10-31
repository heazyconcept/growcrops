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
        <a href="<?php echo base_url('admin/crops') ?>" class="btn btn-primary pull-right new-crop"> View All Crop</a>
        <h3 class="admin_section_title">New Crop</h3>
      </div>

        <div class="col-sm-12 col-md-7">
            <form class="new_crop_form" id="new_crop_form" enctype="multipart/form-data">
              <div class="background-white p20 mb50">
                  <h2 class="page-title">Crop Details</h2>

                      <div class="form-group">
                          <label for="crop_name">Crop Title</label>
                          <input type="text" class="form-control" id="crop_name" name="crop_name" >
                      </div>

                      <div class="form-group">
                          <label for="crop_content">Crop Details</label>
                          <textarea class="form-control"  id="crop_content" name="content"></textarea>
                      </div>

              </div>
              <div class="background-white p20 mb50">
                <button type="button" class="btn btn-primary add_stage_one pull-right">Add </button>
                  <h2 class="page-title">Payment Breakdown</h2>
                  <div class="row stage_one_row">
                    <div class="form-group col-md-6">
                        <label for="payment_details">Payment Details</label>
                        <input type="text" class="form-control" id="payment_details" name="payment_details[]">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity[]">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cost_per_unit">Price/Slot</label>
                        <input type="text" class="form-control" id="cost_per_unit" name="cost_per_unit[]">
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
                  <div class="form-group">
                      <label for="admin_fee">Admin Fee</label>
                      <input type="text" class="form-control" id="admin_fee" name="admin_fee">
                  </div>
                  <div class="form-group">
                      <label for="admin_fee">Projected Income</label>
                      <div class="row">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="min_projected"  placeholder="minimum" name="min_projected" required>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control col-md-6" id="max_projected" name="max_projected" placeholder="maximum" required>
                        </div>
                      </div>

                  </div>
                  <div class="form-group">
                      <label for="stage_one_amount">Initial Invested Amount</label>
                      <input type="text" class="form-control" id="stage_one_amount" name="stage_one_amount" required>
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
    $('#crop_content').tinymce({
      height : "480"
    });
    var currentButton;
    //add more fields group
    $(".add_stage_one").click(function(){
      currentButton ='.stage_one_row';
      var stageOne = '<div class="row stage_one_row">'+
      '<div class="form-group col-md-6">'+
      '<label for="payment_details">Payment Details</label>'+
      '<input type="text" class="form-control" id="payment_details" name="payment_details[]">'+
      '</div>'+
      '<div class="form-group col-md-2">'+
      '<label for="quantity">Quantity</label>' +
      '<input type="text" class="form-control" id="quantity" name="quantity[]">'+
      '</div>'+
      '<div class="form-group col-md-2">'+
      '<label for="cost_per_unit">Price/Unit</label>'+
      '<input type="text" class="form-control" id="cost_per_unit" name="cost_per_unit[]">'+
      '</div>'+
      '<div class="form-group col-md-2">'+
      '<button type="button" class="remove_fields btn btn-secondary"> Remove</button>'+
      '</div></div>';
            $('body').find('.stage_one_row:last').after(stageOne);

    });



    //remove fields group
    $("body").on("click",".remove_fields",function(){
        $(this).parents(currentButton).remove();
    });
    $('#new_crop_form').on('submit', function (e) {
      e.preventDefault();
        text = tinymce.get('crop_content').getContent();
      var formData = new FormData($('form#new_crop_form')[0]);



      $.ajax({
          url: '<?php echo base_url('ajax_call/add_crop'); ?>',
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
