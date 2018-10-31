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
        <a href="<?php echo base_url('admin/crop_new') ?>" class="btn btn-primary pull-right new-crop"> Add New Crop</a>
        <h3 class="admin_section_title">All Crops</h3>
      </div>

        <div class="col-sm-12 col-md-7">
            <div class="users">
    <table class="table">
        <tbody>
          <?php foreach ($all_crops as $crop): ?>
            <tr>
              <td><a class="user" href="<?php echo base_url('admin/crops_edit/'). $crop->id; ?>"><img src="<?php echo asset_url('img/').$crop->featured_image; ?>" alt=""></a></td>
              <td class="hidden-xs visible-sm visible-md visible-lg">
                  <h2 class="crop_name"><a href="<?php echo base_url('admin/crops_edit/'). $crop->id; ?>"><?php echo $crop->crop_name ?></a></h2>
              </td>
              <td class="right">
                  <a href="<?php echo base_url('admin/crop_edit/'). $crop->id; ?>" class="btn btn-xs btn-primary crop-edit">Edit</a>
                  <a href="<?php echo base_url('admin/crop_remove/'). $crop->id; ?>" class="btn btn-xs btn-danger new-crop">Remove</a>
              </td>
            </tr>



          <?php endforeach; ?>
        </tbody>
    </table>
</div><!-- /.users -->

        </div><!-- /.col-* -->


    </div><!-- /.row -->
</div><!-- /.col-* -->

                                    </div>
                                </div><!-- /.container-fluid -->
                            </div><!-- /.content-admin-main-inner -->
                        </div><!-- /.content-admin-main -->
