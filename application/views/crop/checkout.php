<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
   <div class="main">
       <div class="main-inner">
           <div class="content">
               <div class="mt-80 mb80">
   <div class="detail-banner checkout-banner" style="background-image: url(<?php echo asset_url('img/').$crop[0]->featured_image; ?>);">
   <div class="container">
       <div class="detail-banner-left">
           <h2 class="detail-title">
               <?php echo $crop[0]->crop_name; ?>
           </h2>
       </div><!-- /.detail-banner-left -->
   </div><!-- /.container -->
   </div><!-- /.detail-banner -->

   </div>

   <div class="container">
   <div class="row detail-content">
   <div class="col-sm-8">

       <div class="background-white p20 mb50">

             <table class="table table-hover mb0 checkout_table">
                 <caption>Amount Payeable</caption>
                 <thead>
                 <tr>
                     <th>Crop</th>
                     <th>Slot</th>
                     <th>Cost Per slot</th>
                     <th>Total Cost</th>
                 </tr>
                 </thead>

                 <tbody>
                   <tr>
                     <td><?php echo $crop[0]->crop_name; ?></td>
                     <td> <input type="number" name="slot" id="slot" value="1"> </td>
                     <td>&#8358;<?php echo number_format($price[0]->amount, 2); ?></td>
                     <td class="total">&#8358;<?php echo number_format($price[0]->amount, 2); ?></td>
                   </tr>
                   <tr>
                     <td> <strong>Vat 5%</strong> </td>
                     <td></td>
                     <td></td>
                     <td class="vat">&#8358;<?php echo number_format($price[0]->amount * 0.05, 2); ?></td>
                   </tr>
                   <tr>
                     <td> <strong>Admin Fee</strong> </td>
                     <td></td>
                     <td></td>
                     <td class="admin_fee">&#8358;<?php echo number_format($crop[0]->admin_fee, 2); ?></td>
                   </tr>
                   <tr>
                     <td> <strong>Total Price</strong> </td>
                     <td></td>
                     <td></td>
                     <td  class="final_total">&#8358;<?php echo number_format($price[0]->amount + $crop[0]->admin_fee + ($price[0]->amount * 0.05), 2); ?></td>
                     <input type="hidden" id="final_total" name="" value="<?php echo $price[0]->amount + $crop[0]->admin_fee + ($price[0]->amount * 0.05); ?>">
                   </tr>
                 </tbody>
             </table>

       </div>
   </div><!-- /.col-sm-7 -->

   <div class="col-sm-4">

       <div class="background-white p20">
           <!-- <div class="detail-overview-hearts">
               <i class="fa fa-heart"></i> <strong>213 </strong>people love it
           </div>
           <div class="detail-overview-rating">
               <i class="fa fa-star"></i> <strong>4.3 / 5 </strong>from <a href="#reviews">316 reviews</a>
           </div> -->
           <div class="crop_title">
             <strong>Total Cost:</strong> <br><span class="final_total">&#8358;<?php echo number_format($price[0]->amount + $crop[0]->admin_fee + ($price[0]->amount * 0.05), 2); ?></span>
           </div>
           <div class="payment_options">
             <select class="form-control " id="payment_options">
               <option value="online">Online Payment</option>
               <option value="bank_transfer">Bank Transfer</option>
             </select>
           </div>

           <div class="detail-actions row">
               <div class="col-sm-12 ">
                   <div class="button_pay_wrapper"> <button type="button" name="button" class="btn btn-primary btn-pay"> Pay Now</button> </div>
               </div><!-- /.col-sm-4 -->


           </div><!-- /.detail-actions -->
       </div>

   </div><!-- /.col-sm-5 -->


   </div><!-- /.row -->

   </div><!-- /.container -->

           </div><!-- /.content -->
       </div><!-- /.main-inner -->
   </div><!-- /.main -->
   <script src="https://js.paystack.co/v1/inline.js"></script>
   <script type="text/javascript">
   $(document).ready(function () {
     $('#slot').on('keyup mouseup', function () {
       var amount = '<?php echo $price[0]->amount; ?>';
       var adminFee = '<?php echo $crop[0]->admin_fee; ?>'
       var totalAmount = $(this).val() * amount;
       var totalAdminFee = $(this).val() * adminFee;
       var vat = totalAmount * 0.05;
       var finalAmount = totalAmount + vat + totalAdminFee;
       $('.total').html('&#8358;'+addCommas(totalAmount));
       $('.vat').html('&#8358;'+addCommas(vat));
       $('.admin_fee').html('&#8358;'+addCommas(totalAdminFee));
       $('.final_total').html('&#8358;'+addCommas(finalAmount));
       $('#final_total').val(finalAmount);

     })
     $('.btn-pay').on('click', function () {
       if ($('#slot').val() > 5) {
         swal('Limit Exceeded', 'Your have exceeded the maximum number of slot per user', 'error');
         return;
       }
       if ($('#payment_options').val() == 'online') {
         var handler = PaystackPop.setup({
           key: 'pk_test_6a7d253f73f251dd88becbad2430a3760fe8f309',
           email: '<?php echo $this->session->userdata('email_address'); ?>',
           amount: $('#final_total').val() * 100,
           ref: 'STG001'+Math.floor((Math.random() * 1000000000) + 1),
           metadata: {
              custom_fields: [
                 {
                     display_name: "Mobile Number",
                     variable_name: "mobile_number",
                     value: "<?php echo $this->session->userdata('phone_number'); ?>"
                 }
              ]
           },
           callback: function(response){
             var transactionData = {amount: $('#final_total').val(), reference: response.reference, crop_id:'<?php echo $crop[0]->id; ?>', status: 'Confirmed', slot_amount: $('#slot').val(), payment_type: 'Paystack' };
             $.post("<?php echo base_url('ajax_call/transaction'); ?>", transactionData, function(result){
             if (result && result != 'exceeded') {
               console.log(result);
               swal({
                 title: "Your transaction is successful",
                 text: "your transaction ref is "+response.reference,
                 type: "success"
               });
               setTimeout(() => {
                location.href = '<?php echo base_url("user") ?>';
               }, 3000);
            }else {
               swal('Limit Exceeded', 'Your have exceeded the maximum number of slot per user', 'error');
            }
         });

           },
           onClose: function(){
               alert('window closed');
           }
         });
         handler.openIframe();
       }else if ($('#payment_options').val() == 'bank_transfer') {
         var ref = 'STG001'+Math.floor((Math.random() * 1000000000) + 1);
         var transactionData = {amount: $('#final_total').val(), reference: ref, crop_id:'<?php echo $crop[0]->id; ?>', status: 'Not Confirmed', slot_amount: $('#slot').val(), payment_type: 'bank_transfer' };
         $.post("<?php echo base_url('ajax_call/transaction'); ?>", transactionData, function(result){
         if (result && result != 'exceeded') {
           console.log(result);
           swal({
             title: "Your transaction is successful",
             text: "your transaction ref is "+ref,
             type: "success"
           });
           setTimeout(() => {
             location.href = '<?php echo base_url("crops/thankyou/") ?>'+ result;
           }, 2000);
          
        }else {
           swal('Limit Exceeded', 'Your have exceeded the maximum number of slot per user', 'error');
        }
     });

       }
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
