<?php
   defined('BASEPATH') OR exit('No direct script access allowed');

   ?>
   <div class="user-dashboard">
   <div class="main">
       <div class="main-inner">
           <div class="container">
               <div class="row">
                   <div class="col-sm-4 col-lg-3">
                       <div class="sidebar">
   <?php $this->load->view('templates/user_menu'); ?>

                       </div><!-- /.sidebar -->
                   </div><!-- /.col-* -->

                   <div class="col-sm-8 col-lg-9">
                       <div class="content">
                           <div class="page-title">
   <h1 class="user_name"><?php echo ucfirst(strtolower($user_data['first_name'])); ?> <?php echo ucfirst(strtolower($user_data['last_name'])); ?></h1>
   </div><!-- /.page-title -->
   <div class="right-dashboard">
     <div class="background-white p20 mb30">
       <div class="transaction_table">
         <h3>My Transaction Details</h3>

         <?php if ($transactions): ?>
           <table class="table table-striped mb0">
               <thead>
                   <tr>
                       <th>Transaction Ref</th>
                       <th>Crop</th>
                       <th>Slot</th>
                       <th>Amount Paid</th>
                       <th>Stage</th>
                       <th>Action</th>
                   </tr>
               </thead>

               <tbody>
                 <?php foreach ($transactions as $transaction): ?>
                   <tr>
                       <td><?php echo $transaction->transaction_ref; ?></td>
                       <td><?php echo $transaction->crop_name; ?></td>
                       <td><?php echo $transaction->slot; ?></td>
                       <td>&#8358;<?php echo number_format($transaction->amount, 2); ?></td>
                       <td><?php echo strtoupper($transaction->stage); ?></td>
                       <td><?php if (  $transaction->stage == 'early bird') { ?>  <a href="<?php echo base_url('earlybird/invoice/'). $transaction->id; ?>">Print Receipt</a>
                       <?php }else { ?>
                         <a href="<?php echo base_url('crops/invoice/'). $transaction->id; ?>">Print Receipt</a>
                    <?php   }
                       ?></td>
                   </tr>
                 <?php endforeach; ?>
               </tbody>
           </table>
         <?php else: ?>
           <div class="error">
             No transaction recorded yet
           </div>
         <?php endif; ?>

       </div>


     </div>

   </div>

                       </div><!-- /.content -->
                   </div><!-- /.col-* -->
               </div><!-- /.row -->
           </div><!-- /.container -->
       </div><!-- /.main-inner -->
   </div><!-- /.main -->
</div>
