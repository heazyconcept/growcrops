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
    <a href="<?php echo base_url('admin/invoice_schedule') ?>" class="btn btn-primary pull-right new-crop"> Invoice Schedule</a>
    <h3 class="admin_section_title">Schedule Invoice</h3>
  </div>

    <div class="col-sm-12 col-md-5">
        <form class="new_crop_form" id="new_crop_form" enctype="multipart/form-data">
          <div class="background-white p20 mb50">
            <?php if (isset($user_details)): ?>
              <div class="booking_details">
                <span class="bk_title"><?php echo $user_details[0]->first_name . ' '.$user_details[0]->last_name;  ?></span>
                <span class="bk_title"><?php echo $user_details[0]->email_address; ?></span>
                <span class="bk_title"><?php echo $user_details[0]->phone_number; ?></span>
                <span class="bk_title"><?php echo $transaction[0]->slot; ?> Slot(s)</span>
              </div>
            <?php endif; ?>

          </div>
          <div class="booking_amount">
            
            <div class="form-group">
                <label for="stage_one_amount">Schedule Amount/Slot</label>
                <input type="text" class="form-control" id="stage_amount" name="stage_amount" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="button" class="btn btn-primary btn-schedule"> Schedule</button>
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
  $('.btn-schedule').on('click', function () {
    $(this).html('Please Wait <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');

    var transactionData = {amount: $('#stage_amount').val(), stage: $('#stage').val(), description: $('#description').val()};
    console.log(transactionData);
    $.post("<?php echo base_url('ajax_call/book_transaction'); ?>", transactionData, function(result){
      console.log(result);
       if (result == '-4') {
        $('.btn-schedule').html('Schedule');
        swal({
          title: "invalid Transaction",
          text: "Transaction is not set",
          type: "error"
        });
      }else if (result == '-5') {
        $('.btn-schedule').html('Schedule');
        swal({
          title: "Oops",
          text: "Unknown error Occurred",
          type: "error"
        });
      }else if (result == '-3') {
        $('.btn-schedule').html('Schedule');
        swal({
          title: "Already Booked",
          text: "This stage has already been scheduled for this user",
          type: "error"
        });
      }else{
        $('.btn-schedule').html('Schedule');
        swal({
          title: "Schedule Successful",
          text: "Invoice schedule is successful",
          type: "success"
        });

      }
    });
  })
})
</script>
