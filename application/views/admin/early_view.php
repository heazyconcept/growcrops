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
    <div class="switch-wrapper pull-right">
      <div class="checkbox-container">
        <?php if ($early_option): ?>
          <?php $is_early = json_decode($early_option[0]->option_value); ?>
            <input type="checkbox" id="on-off-switch" name="switch1" <?php echo ($is_early[0]->is_early == 'true')? 'checked': ''; ?>>
        <?php else: ?>
          <input type="checkbox" id="on-off-switch" name="switch1" >
        <?php endif; ?>

      </div>

    </div>


    <h3 class="admin_section_title">Early Birds</h3>
  </div>

    <div class="col-sm-12 col-md-7">
        <div class="users">
<table class="table">
    <tbody>
      <?php if ($all_early): ?>
        <?php foreach ($all_early as $early): ?>
          <tr>
            <td><a class="user" href="<?php echo base_url('admin/earlybird_activate/'). $early->id; ?>"><img src="<?php echo asset_url('img/').$early->featured_image; ?>" alt=""></a></td>
            <td class="hidden-xs visible-sm visible-md visible-lg">
                <h2 class="crop_name"><a href="<?php echo base_url('admin/earlybird_activate/'). $early->id; ?>"><?php echo $early->crop_name ?></a></h2>
            </td>
            <td class="act_col"> <?php echo ($early->is_early)? 'Early Bird Activated': 'Early Bird Not Activated' ?>
            </td>
            <td class="right">
              <?php if ($early->is_early): ?>

                <a href="<?php echo base_url('admin/earlybird_deactivate/'). $early->id; ?>" class="btn btn-xs btn-danger new-crop">Deactivate</a>
              <?php else: ?>

                <a href="<?php echo base_url('admin/earlybird_activate/'). $early->id; ?>" class="btn btn-xs btn-primary crop-edit">Activate</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td>No Earlybird Available </td>
        </tr>
      <?php endif; ?>

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
                    <script type="text/javascript">
                        new DG.OnOffSwitch({
                            el: '#on-off-switch',
                            textOn: 'On',
                            textOff: 'Off',
                            listener:function(name, checked){
                              var optionData = {is_early: checked};
                              $.post("<?php echo base_url('ajax_call/site_options/early_bird'); ?>", optionData, function(result){
                                console.log(result);

                          });

                            }
                        });
                    </script>
