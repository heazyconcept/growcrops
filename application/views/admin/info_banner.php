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
    <a href="<?php echo base_url('admin/site_options') ?>" class="btn btn-primary pull-right new-crop">Back</a>
    <h3 class="admin_section_title">Home Banners</h3>
  </div>

    <div class="col-sm-12 col-md-7">
        <form class="new_crop_form" id="new_crop_form" enctype="multipart/form-data">
          <div class="background-white p20 mb50">
            <?php if ($info_banner): ?>
              <?php
              $options = json_decode($info_banner[0]->option_value);
              ?>

                    <div class="form-group">
                      <label for="info_banner">Home page Information Banner</label>
                      <img src="<?php echo asset_url('img/').$options[0]->info_banner ?>" class="crop_image img-responsive ft_img" alt="">
                    <input type="file" id="info_banner ?>" name="info_banner">
                    <input type="hidden" id="old_info_banner" name="old_info_banner" value="<?php echo $options[0]->info_banner;  ?>">
                    <p class="help-block">Your Home slider image here</p>
                    </div>



            <?php else: ?>
              <div class="form-group">
                <label for="info_banner">Home page Information Banner</label>
                <img src="#" class="crop_image img-responsive ft_img" alt="">
              <input type="file" id="info_banner ?>" name="info_banner">
              <input type="hidden" id="old_info_banner" name="old_info_banner" value="">
              <p class="help-block">Your Home slider image here</p>
              </div>

            <?php endif; ?>



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
  $('#new_crop_form').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData($('form#new_crop_form')[0]);
    $.ajax({
        url: '<?php echo base_url('ajax_call/site_options/info_banner'); ?>',
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
