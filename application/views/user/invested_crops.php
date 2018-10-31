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

                   <div class="col-sm-5 col-lg-6">
                       <div class="content">
                           <div class="page-title">
   <h1 class="user_name"><?php echo ucfirst(strtolower($user_data['first_name'])); ?> <?php echo ucfirst(strtolower($user_data['last_name'])); ?></h1>
   </div><!-- /.page-title -->
   <div class="right-dashboard">
     <div class="background-white p20 mb30">
       <div class="transaction_table">
         <h3>My Invested Crops</h3>

         <?php if ($invested_crops): ?>
           <table class="table invested_crops_table">
               <tbody>
                 <?php foreach ($invested_crops as $crop): ?>
                   <tr>
                     <td class="hidden-xs visible-sm visible-md visible-lg">
                       <a class="user" href="<?php echo base_url('user/view_crop/'). $crop->id; ?>"><img src="<?php echo asset_url('img/').$crop->featured_image; ?>" alt=""></a>
                     </td>
                     <td>
                         <h2 class="crop_name"><a href="<?php echo base_url('user/view_crop/'). $crop->id; ?>"><?php echo $crop->crop_name ?></a></h2>
                     </td>
                     <td class="right">
                         <a href="<?php echo base_url('user/view_crop/'). $crop->id; ?>" class="btn btn-xs btn-danger new-crop">View</a>
                     </td>
                   </tr>



                 <?php endforeach; ?>
               </tbody>
           </table>
         <?php else: ?>
           <div class="error">
             No invested crop yet
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
