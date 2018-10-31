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
    <a href="<?php echo base_url('admin/invoice_schedule'); ?>" class="btn btn-primary pull-right new-crop">Back</a>
    <h3 class="admin_section_title">Invoice Schedule</h3>
  </div>

    <div class="col-sm-12 col-md-12">
      <div class="background-white p20 mb50">
        <?php if (isset($all_transaction) && !empty($all_transaction)): ?>
          <table class="table table-striped mb0 table-pending">
            <div class="pull-right filter_payment">
              <select class="form-control" name="" id="filter_value">
                <option value="">Search by stage</option>
                <option value="earlybird">Early Bird</option>
                <option value="one">Stage One</option>
                <option value="two">Stage Two</option>
                <option value="three">Stage Three</option>
              </select>
            </div>
              <thead>
                  <tr>
                      <th><input type="checkbox" class="checkbox check_all"></th>
                      <th>Customers' Name</th>
                      <th>Email address</th>
                      <th>Phone Number</th>
                      <th>Stage</th>
                      <th>Slot</th>
                      <th>Action</th>
                  </tr>
              </thead>

              <tbody class="pending_refresh">
                <form class="schedule_form" action="<?php echo base_url('admin/book'); ?>" method="post">
                  <?php foreach ($all_transaction as $transaction): ?>
                    <?php
                    $stage_slug = str_replace(' ', '', $transaction->stage);

                     ?>
                    <tr>
                      <td> <input type="checkbox" name="tran_id[]" value="<?php echo $transaction->id.'_'.$stage_slug; ?>" class="check_it"> </td>
                      <td><?php echo $transaction->first_name . ' '. $transaction->last_name; ?></td>
                      <td> <?php echo $transaction->email_address; ?></td>
                      <td> <?php echo $transaction->phone_number; ?></td>
                      <td> <?php echo $transaction->stage; ?></td>
                      <td> <?php echo $transaction->slot; ?></td>
                      <td><a href="<?php echo base_url('admin/book/'). $transaction->id.'_'.$stage_slug; ?>" class="btn btn-xs btn-primary crop-edit">Schedule Invoice</a></td>
                    </tr>

                  <?php endforeach; ?>
                  <tr>
                    <td><button type="submit" class="btn btn-xs btn-primary crop-edit">Bulk Schedule</button></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td> </td>
                    <td></td>
                  </tr>
                </form>





              </tbody>
          </table>
          <div class="pager">

              <ul>

                <?php
                if ($offset > 1) {
                echo current($links);
                }
                if ((count($links) - $offset) < 9  ) {
                  for ($i=$offset-1; $i < count($links) ; $i++) {
                  echo  $links[$i];
                  }
                }else {
                  for ($i=$offset-1; $i < $offset+8 ; $i++) {
                  echo  $links[$i];
                  }
                  echo end($links);
                }

                ?>

              </ul>
          </div><!-- /.pagination -->

        <?php else: ?>
          <h5 class="no_info">No User For this Stage/Crop</h5>
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
$('#filter_value').on('change', function () {
  var filterValue = $(this).val();
  location.href = '<?php echo base_url('admin/invoice_view/').$crop_id; ?>' +'/'+ filterValue;

})
$(document).on('change','.check_all', function () {
    if ($(this).is(':checked')) {
        $('.check_it').prop('checked', true);
    } else {
        $('.check_it').prop('checked', false);
    }
});


})
</script>
