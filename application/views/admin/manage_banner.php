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
            <?php if ($manage_banner): ?>
              <?php
              $options = json_decode($manage_banner[0]->option_value);
              for ($i=0; $i <count($options) ; $i++) { ?>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="banner_<?php echo $i ?>">Banner</label>
                      <img src="<?php echo asset_url('img/').$options[$i]->home_banner ?>" class="crop_image img-responsive ft_img" alt="">
                    <input type="file" id="banner_<?php echo $i ?>" name="home_banner[]">
                    <input type="hidden" id="old_banner_<?php echo $i ?>" name="old_home_banner[]" value="<?php echo $options[$i]->home_banner;  ?>">
                    <p class="help-block">Your Home slider image here</p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                        <label for="banner_title_<?php echo $i ?>">Banner Title</label>
                        <input type="text" class="form-control" id="banner_title_<?php echo $i ?>" name="banner_title[]" value="<?php echo $options[$i]->banner_title; ?>">
                    </div>
                    <div class="form-group">
                        <label for="banner_sub_title_<?php echo $i ?>">Banner Subtitle</label>
                        <input type="text" class="form-control" id="banner_sub_title_<?php echo $i ?>" name="banner_sub_title[]" value="<?php echo $options[$i]->banner_sub_title; ?>">
                    </div>
                  </div>
                </div>

                <?php
              }
               ?>
            <?php else: ?>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="banner_1">Banner</label>
                    <img src="" class="crop_image img-responsive ft_img" alt="">
                  <input type="file" id="banner_1" name="home_banner[]">
                  <input type="hidden" id="old_banner_1" name="old_home_banner[]" value="">
                  <p class="help-block">Your Home slider image here</p>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                      <label for="banner_title_1">Banner Title</label>
                      <input type="text" class="form-control" id="banner_title_1" name="banner_title[]" value="">
                  </div>
                  <div class="form-group">
                      <label for="banner_sub_title_1">Banner Subtitle</label>
                      <input type="text" class="form-control" id="banner_sub_title_1" name="banner_sub_title[]" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="banner_2">Banner</label>
                    <img src="" class="crop_image img-responsive ft_img" alt="">
                  <input type="file" id="banner_2" name="home_banner[]">
                  <input type="hidden" id="old_banner_2" name="old_home_banner[]" value="">
                  <p class="help-block">Your Home slider image here</p>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                      <label for="banner_title_2">Banner Title</label>
                      <input type="text" class="form-control" id="banner_title_2" name="banner_title[]" value="">
                  </div>
                  <div class="form-group">
                      <label for="banner_sub_title_2">Banner Subtitle</label>
                      <input type="text" class="form-control" id="banner_sub_title_2" name="banner_sub_title[]" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="banner_3">Featured Image</label>
                    <img src="" class="crop_image img-responsive ft_img" alt="">
                  <input type="file" id="banner_3" name="home_banner[]">
                  <input type="hidden" id="old_banner_3" name="old_home_banner[]" value="">
                  <p class="help-block">Your Home slider image here</p>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                      <label for="banner_title_3">Banner Title</label>
                      <input type="text" class="form-control" id="banner_title_3" name="banner_title[]" value="">
                  </div>
                  <div class="form-group">
                      <label for="banner_sub_title_3">Banner Subtitle</label>
                      <input type="text" class="form-control" id="banner_sub_title_3" name="banner_sub_title[]" value="">
                  </div>
                </div>
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
        url: '<?php echo base_url('ajax_call/site_options/home_banner'); ?>',
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
