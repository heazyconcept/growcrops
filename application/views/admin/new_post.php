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
    <a href="<?php echo base_url('admin/post') ?>" class="btn btn-primary pull-right new-crop"> View All Blog Posts</a>
    <h3 class="admin_section_title">New Crop</h3>
  </div>

    <div class="col-sm-12 col-md-7">
        <form class="new_post_form" id="new_post_form" enctype="multipart/form-data">
          <div class="background-white p20 mb50">
              <h2 class="page-title">Post Details</h2>

                  <div class="form-group">
                      <label for="crop_name">Post Title</label>
                      <input type="text" class="form-control" id="post_title" name="post_title" >
                  </div>

                  <div class="form-group">
                      <label for="crop_content">Post Details</label>
                      <textarea class="form-control"  id="post_content" name="post_content"></textarea>
                  </div>

          </div>



    </div><!-- /.col-* -->
    <div class="col-md-5">
      <div class="background-white p20 mb50">
          <h2 class="page-title">Post Image</h2>

              <div class="form-group">
                  <label for="featured_image">Featured Image</label>
                  <input type="file" id="featured_image" name="featured_image">
                  <p class="help-block">Your main Image here</p>
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
$('#post_content').tinymce({
  plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
  height : "480"
});

$('#new_post_form').on('submit', function (e) {
  e.preventDefault();
  var formData = new FormData($('form#new_post_form')[0]);
  $.ajax({
      url: '<?php echo base_url('ajax_call/add_post'); ?>',
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
