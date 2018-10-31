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
       <form class="profile_edit" id="profile_edit">
         <h3 class="page-title sub_edit">
             Contact Information

             <button type="button"  class="btn btn-primary btn-xs pull-right btn_save_info">Update</button>
         </h3>
         <div class="row">
             <div class="form-group col-sm-6">
                 <label>First Name</label>
                 <input type="text" class="form-control" name="first_name" value="<?php echo $this->session->userdata('first_name'); ?>" >
             </div><!-- /.form-group -->

             <div class="form-group col-sm-6">
                 <label>Last Name</label>
                 <input type="text" class="form-control" name="last_name" value="<?php echo $this->session->userdata('last_name'); ?>">
             </div><!-- /.form-group -->

             <div class="form-group col-sm-6">
                 <label>E-mail Address</label>
                 <input type="email" class="form-control" name="email_address" value="<?php echo $this->session->userdata('email_address'); ?>">
             </div><!-- /.form-group -->

             <div class="form-group col-sm-6">
                 <label>Phone Number</label>
                 <input type="text" class="form-control" name="phone_number" value="<?php echo $this->session->userdata('phone_number'); ?>">
             </div><!-- /.form-group -->
             <div class="form-group col-sm-12">
                 <label>Address</label>
                 <textarea  class="form-control" name="user_address"><?php echo $this->session->userdata('user_address'); ?></textarea>
             </div><!-- /.form-group -->
             <div class="form-group col-sm-6">
                 <label>State</label>
                 <select  name="state" class="states form-control" required>
                   <option value="<?php echo $this->session->userdata('state'); ?>"><?php echo $this->session->userdata('state'); ?></option>
                   <?php foreach ($states as $state ): ?>
                     <option value="<?php echo $state->state; ?>"><?php echo $state->state ?></option>
                   <?php endforeach; ?>
                 </select>
             </div><!-- /.form-group -->
             <div class="form-group col-sm-6">
                 <label>City</label>
                 <select  name="city" class="form-control city" required>
                   <option value="<?php echo $this->session->userdata('city'); ?>"><?php echo $this->session->userdata('city'); ?></option>
                 </select>
             </div><!-- /.form-group -->
         </div><!-- /.row -->
       </form>

     </div>
     <div class="background-white p20 mb30">
       <form class="change_password" id="change_password">
         <h3 class="page-title sub_edit">
             Change Password

             <button type="button"  class="btn btn-primary btn-xs pull-right btn_change_pass">Change</button>
         </h3>
         <div class="row">
             <div class="form-group col-sm-8">
                 <label>Old Password</label>
                 <input type="password" class="form-control" name="password_old" id="password_old">
             </div><!-- /.form-group -->

             <div class="form-group col-sm-8">
                 <label>New Password</label>
                 <input type="password" class="form-control" name="password" id="password">
             </div><!-- /.form-group -->

             <div class="form-group col-sm-8">
                 <label>Confirm New Password</label>
                 <input type="password" class="form-control" name="password_confirm" id="password_confirm">
             </div><!-- /.form-group -->

         </div><!-- /.row -->
       </form>

     </div>
   </div>

                       </div><!-- /.content -->
                   </div><!-- /.col-* -->
               </div><!-- /.row -->
           </div><!-- /.container -->
       </div><!-- /.main-inner -->
   </div><!-- /.main -->
</div>
<script type="text/javascript">

  $(document).ready(function () {
    var xhr;
var select_state, $select_state;
var select_city, $select_city;

    $select_state = $('.states').selectize({
        onChange: function(value2) {
          console.log(value2);
            if (!value2.length) return;
            select_city.disable();
            select_city.clearOptions();
            select_city.load(function(callback) {
                xhr && xhr.abort();
                xhr = $.ajax({
                    url: '<?php echo base_url('/ajax_call/lga_call'); ?>/' + value2 ,
                    success: function(results) {
                      var newresult = JSON.parse(results);
                      console.log(newresult);

                        select_city.enable();
                        callback(newresult);
                    },
                    error: function() {
                        callback();
                    }
                })
            });
        }
    });

    $select_city = $('.city').selectize({
      valueField: 'local_government',
      labelField: 'local_government',
      searchField: ['local_government']
    });

    select_city  = $select_city[0].selectize;
    select_state = $select_state[0].selectize;

    select_city.disable();
    $('.btn_save_info').on('click', function () {

      var formData = new FormData($('form#profile_edit')[0]);
      // formData.append("actions", "writer_request");

      $.ajax({
          url: '<?php echo base_url('ajax_call/profile_edit'); ?>',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            console.log(data);
            if(data == '-5'){
              swal("Oops", "Error while updating your data kindly try again", "error");
            }else if (data == 1) {
              swal("Success", "Your account details is successfully updated", "success");
            }else {
              swal("Oops", "An unknown error has occured, kindly contact your administrator", "error");
            }

          },
          cache: false,
          contentType: false,
          processData: false
      });
    })
    $('.btn_change_pass').on('click', function () {
      if ($('#password').val() != $('#password_confirm').val()) {
        swal("Password mismatch!", "kindly check your password", "error");
        return;
      }

      var formData = new FormData($('form#change_password')[0]);
      // formData.append("actions", "writer_request");

      $.ajax({
          url: '<?php echo base_url('ajax_call/change_password'); ?>',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            console.log(data);
            if(data == '-5'){
              swal("Oops", "Error while changing your password", "error");
            }else if (data == '-4') {
              swal("Incorrect Old Password", "Your current password is Incorrect", "error");
              location.reload();
            }else if (data == 1) {
              swal("Success", "Your account details is successfully updated", "success");
              location.reload();
            }else {
              swal("Oops", "An unknown error has occured, kindly contact your administrator", "error");
            }

          },
          cache: false,
          contentType: false,
          processData: false
      });
    })
  })
</script>
