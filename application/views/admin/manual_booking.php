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
    <h3 class="admin_section_title">Manual Booking</h3>
  </div>

    <div class="col-sm-12 col-md-7">
      <div class="background-white p20 mt50">
        <form class="new_booking_form" id="new_booking_form" enctype="multipart/form-data">
          <div class="row">
            <div class="form-group col-md-6">
                <label for="stage_one_amount">Email Address</label>
                <input type="text" class="form-control" id="filter_value" name="" value="" placeholder="Search by email address">
                <div class="option_available">

                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="crop">Crop</label>
                <select class="form-control" name="crop" id="crop">
                  <option value="">Select one</option>
                  <?php foreach ($all_crops as $crop): ?>
                    <option value="<?php echo $crop->id ?>"><?php echo $crop->crop_name; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="stage_one_amount">Amount</label>
              <input type="text" name="" value="" placeholder="actual amount" class="form-control" id="amount">
              <input type="text" name="" value="" placeholder="VAT" class="form-control" id="vat">
              <input type="text" name="" value="" placeholder="Admin Fee" class="form-control" id="admin_fee">
            </div>
            <div class="form-group col-md-6">
                <label for="stage_one_amount">Slot</label>
                <input type="number" name="" value="1" class="form-control" id="slot">
            </div>
          </div>

            <button type="button" class="btn btn-primary btn-schedule"> Schedule</button>
          </div>

    </div><!-- /.col-* -->
    <div class="col-md-5">
      <div class="background-white p20 mt50">
        <div class="user_details">

        </div>
      </div>

    </div>

    </form>
      </div>



</div><!-- /.row -->
</div><!-- /.col-* -->

                                </div>
                            </div><!-- /.container-fluid -->
                        </div><!-- /.content-admin-main-inner -->
                    </div><!-- /.content-admin-main -->
                    <script type="text/javascript">
$(document).ready(function () {
  var userId
  var cropAmount;
  var currentValue;
  $('#crop').selectize();
  $('#filter_value').on('keyup', function () {
    if (!$(this).val()) {
      $('.option_available').empty();
    }
    var filterValue = $(this).val();
    var filterData = {email_address: filterValue, link_it: 'No'};
    $.post("<?php echo base_url('ajax_call/filter_email'); ?>", filterData, function(result){
    if (result) {
      console.log(result);
      $('.option_available').html(result);
    }
});
  })
  $(document).on('click', '.option_item', function () {
    currentValue = $(this).html();
    $('#filter_value').val(currentValue);
    var filterData = {email_address: currentValue};
      $('.option_available').empty();
      $.post("<?php echo base_url('ajax_call/get_details/'); ?>", filterData, function(result){
      if (result) {
        result = JSON.parse(result);
        var detailsHtml = '<div class="user-group"><strong>Full Name: </strong><span>'+result.first_name+ ' '+ result.last_name +'</span></div>'+
        '<div class="user-group"><strong>Email Address: </strong><span>'+result.email_address+'</span></div>'+
        '<div class="user-group"><strong>Phone Number: </strong><span>'+result.phone_number+'</span></div>'+
        '<div class="user-group"><strong>State: </strong><span>'+result.state+'</span></div>';
        $('.user_details').html(detailsHtml);
        userId = result.id;
      }
  })
})


$('.btn-schedule').on('click', function () {
  var stage = $('#stage').val();
  if (stage == 'early_bird') {
    var shortCode = "GRP000";
    var url = '<?php echo base_url('earlybird/') ?>';
  }else{
    var shortCode = "GRP000";
    var url = '<?php echo base_url('crops/') ?>';
  }
  var slot = $('#slot').val();
    cropAmount = $('#amount').val();
  var totalAmount = cropAmount * slot;
  var vat = ($('#vat').val())? $('#vat').val(): 0;
  var admin_fee = ($('#admin_fee').val())? $('#admin_fee').val(): 0;
  var finalTotal = totalAmount + parseInt(vat) + parseInt(admin_fee);
  var reference =  shortCode + Math.floor((Math.random() * 1000000000) + 1);
  var transactionData = {
    amount:finalTotal,
    reference: reference,
    stage: 'others',
    crop_id: $('#crop').val(),
    status: 'paid',
    slot_amount: slot,
    payment_type: 'online',
    user_id: userId,
    vat: $('#vat').val(),
    admin_fee: $('#admin_fee').val(),
    action: 'manual_booking'
  };
  $.post("<?php echo base_url('ajax_call/transaction'); ?>", transactionData, function(result){
    if (result && result != 'exceeded') {
      console.log(result);
      swal({
        title: "Your transaction is successful",
        text: "your transaction ref is "+reference,
        type: "success"
      });
    }else {
       swal('Limit Exceeded', 'Your have exceeded the maximum number of slot per user', 'error');
    }
  });
})
})
function addCommas(nStr) {
 nStr += '';
 var x = nStr.split('.');
 var x1 = x[0];
 var x2 = x.length > 1 ? '.' + x[1] : '';
 var rgx = /(\d+)(\d{3})/;
 while (rgx.test(x1)) {
     x1 = x1.replace(rgx, '$1' + ',' + '$2');
 }
 return x1 + x2;
}

</script>
