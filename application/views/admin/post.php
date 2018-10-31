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
    <a href="<?php echo base_url('admin/new_post') ?>" class="btn btn-primary pull-right new-crop"> Add New Post</a>
    <h3 class="admin_section_title">All Blog Post</h3>
  </div>

    <div class="col-sm-12 col-md-12">
      <div class="background-white p20 mb50">
        <?php if (isset($posts) && !empty($posts)): ?>
          <table class="table table-striped mb0 table-pending table-posts">
            <div class="pull-right filter_payment">
              <input type="text" class="form-control" id="filter_value" name="" value="" placeholder="Search by post_title">
              <div class="option_available">

              </div>
            </div>
              <thead>
                  <tr>
                      <th style="width:10%;"></th>
                      <th>Post title</th>
                      <th>Action</th>
                  </tr>
              </thead>

              <tbody class="pending_refresh">
                <?php foreach ($posts as $post): ?>
                  <tr>
                    <td><img src="<?php echo asset_url('img/').$post->post_image; ?>" class="img-responsive" alt=""></td>
                    <td class="post_title"><?php echo $post->post_title; ?></td>
                    <td>
                      <a href="<?php echo base_url('admin/post_delete/'). $post->id; ?>" class="btn btn-xs btn-primary crop-edit">Delete</a>
                      <a href="<?php echo base_url('admin/edit_post/'). $post->id; ?>" class="btn btn-xs btn-primary crop-edit">Edit</a>
                    </td>
                  </tr>

                <?php endforeach; ?>




              </tbody>
          </table>
        <?php else: ?>
          <h5 class="no_info">No post entered yet</h5>
        <?php endif; ?>


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
