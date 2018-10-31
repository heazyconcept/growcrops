<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
   <div class="main">
       <div class="main-inner">
           <div class="content">
               <div class="mt-80 mb80">
   <div class="detail-banner checkout-banner" style="background-image: url(<?php echo asset_url('img/').$payment_schedule[0]->featured_image; ?>);">
   <div class="container">
       <div class="detail-banner-left">
           <h2 class="detail-title">
               <?php echo $payment_schedule[0]->crop_name; ?>
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
                   <?php
                   $total = $payment_schedule[0]->amount * $payment_schedule[0]->slot;
                   $vat = $total * 0.05;
                   $admin_fee = $payment_schedule[0]->admin_fee * $payment_schedule[0]->slot;
                   $final_total = $total + $admin_fee + $vat;
                    ?>
                   <tr>
                     <td><?php echo $payment_schedule[0]->crop_name; ?></td>
                     <td> <input type="number" name="slot" id="slot" value="<?php echo $payment_schedule[0]->slot; ?>" disabled> </td>
                     <td>&#8358;<?php echo number_format($payment_schedule[0]->amount, 2); ?></td>
                     <td class="total">&#8358;<?php echo number_format($total, 2); ?></td>
                   </tr>
                   <tr>
                     <td> <strong>Admin Fee</strong> </td>
                     <td></td>
                     <td>&#8358;<?php echo number_format($payment_schedule[0]->admin_fee, 2); ?></td>
                     <td class="admin_fee">&#8358;<?php echo number_format($admin_fee, 2); ?></td>
                   </tr>
                   <tr>
                     <td> <strong>Vat 5%</strong> </td>
                     <td></td>
                     <td></td>

                     <td class="vat">&#8358;<?php echo number_format($vat, 2); ?></td>
                   </tr>
                   <tr>
                     <td> <strong>Total Price</strong> </td>
                     <td></td>
                     <td></td>
                     <td  class="final_total">&#8358;<?php echo number_format($final_total, 2); ?></td>
                     <input type="hidden" id="final_total" name="" value="<?php echo $final_total; ?>">
                     <input type="hidden" id="stage" name="" value="<?php echo $payment_schedule[0]->stage; ?>">
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
             <strong>Total Cost:</strong> <br><span class="final_total">&#8358;<?php echo number_format($final_total, 2); ?></span>
           </div>
           <div class="payment_options">
             <select class="form-control " id="payment_options">
               <option value="bank_transfer">Bank Transfer</option>
             </select>
           </div>

           <div class="detail-actions row">
               <div class="col-sm-5">
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

     $('.btn-pay').on('click', function () {

       if (stage == 'early bird' || stage == 'earlybird') {
         var shortCode = "GRP000";
         var url = '<?php echo base_url('earlybird/') ?>';
       }else (stage == 'one') {
         var shortCode = "GRP000";
         var url = '<?php echo base_url('crops/') ?>';
       }
       if ($('#payment_options').val() == 'online') {
         var handler = PaystackPop.setup({
           key: 'pk_live_ae5f3965762f3d31350411562dd000bfa1821f7c',
           email: '<?php echo $this->session->userdata('email_address'); ?>',
           amount: $('#final_total').val() * 100,
           ref: shortCode +Math.floor((Math.random() * 1000000000) + 1),
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
             var transactionData = {amount: $('#final_total').val(), reference: response.reference, stage: $('#stage').val(), crop_id:'<?php echo $payment_schedule[0]->crop_id; ?>', status: 'paid', slot_amount: $('#slot').val(), payment_type: 'online' };
             $.post("<?php echo base_url('ajax_call/transaction'); ?>", transactionData, function(result){
             if (result) {
               console.log(result);
               swal({
                 title: "Your transaction is successful",
                 text: "your transaction ref is "+response.reference,
                 type: "success"
               });
              location.href = url+ 'invoice/'+ result;
             }
         });

           },
           onClose: function(){
               alert('window closed');
           }
         });
         handler.openIframe();
       }else if ($('#payment_options').val() == 'bank_transfer') {
         var ref = shortCode +Math.floor((Math.random() * 1000000000) + 1);
         var transactionData = {amount: $('#final_total').val(), reference: ref, stage: $('#stage').val(), crop_id:'<?php echo $payment_schedule[0]->crop_id; ?>', status: 'pending', slot_amount: $('#slot').val(), payment_type: 'bank_transfer' };
         $.post("<?php echo base_url('ajax_call/transaction'); ?>", transactionData, function(result){
         if (result ) {
           console.log(result);
           swal({
             title: "Your transaction is successful",
             text: "your transaction ref is "+ref,
             type: "success"
           });
          location.href = url+ 'thankyou/'+ result;
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
