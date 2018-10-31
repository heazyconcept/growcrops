<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<div class="main">
   <div class="main-inner">
      <div class="content">
        <!-- <div class=" authentication_header single_page_header has_overlay">
          <div class="header_overlay">
            <div class="container">
              <h2>R</h2>
              <p>Farming made easy</p>
            </div>
          </div>
        </div> -->
        <div class="single_page_main_content">
          <div class="single_page_section authentication_section">
            <div class="container">
              <div class="row">
                <div class="col-md-6 register_banner">
                  <!-- <div class="auth_overlay">

                  </div> -->
                  <div class="auth_logo">
                    <img src="<?php echo asset_url('img/logo.png'); ?>" alt="">
                  </div>
                  <div class="auth_catchphrase">
                    <h4>Welcome to Growcrops Online</h4>
                    <p>Are you ready to join us?</p>
                  </div>
                </div>
                <div class="col-md-6 register-form-col">

                  <form class="register-form" id="register-form">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        </div><!-- /.form-group -->
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Email address" required>
                        </div><!-- /.form-group -->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" required>
                        </div><!-- /.form-group -->
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" required>
                        </div><!-- /.form-group -->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div><!-- /.form-group -->
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirm Password" required>
                        </div><!-- /.form-group -->
                      </div>
                    </div>
                    <div class="row form_single_row">
                      <div class="form-group">
                            <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone number" required>
                      </div><!-- /.form-group -->
                    </div>
                    <div class="row form_single_row">
                      <div class="form-group">
                        <textarea class="form-control" id="user_address" name="user_address" rows="2" cols="20" required>Your address</textarea>
                      </div><!-- /.form-group -->
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <select  name="state" class="states form-control" required>
                                <option value="">Select States</option>
                                <?php foreach ($states as $state ): ?>
                                  <option value="<?php echo $state->state; ?>"><?php echo $state->state ?></option>
                                <?php endforeach; ?>
                              </select>
                          </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <select  name="city" class="form-control city" required>
                                <option value="">Local Government</option>
                              </select>
                          </div><!-- /.form-group -->
                        </div>
                      </div>
                      <div class="checkbox">
                        <input type="checkbox" name="" value="1"><a href="<?php echo base_url('home/terms_and_condition'); ?>">I agree to the terms and conditions</a>
                      </div>
                      <button type="submit" class="btn btn-primary btn_register">Register</button>
                      <a href="<?php echo base_url('auth/login'); ?>" class="pull-right rtn_login">I am already a member</a>
                  </form>

                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
      <!-- /.content -->
   </div>
   <!-- /.main-inner -->
</div>
<!-- /.main -->
<script type="text/javascript">

  $(document).ready(function () {
    var xhr;
var select_state, $select_state;
var select_city, $select_city;

    $select_state = $('.states').selectize({
        onChange: function(value) {
            if (!value.length) return;
            select_city.disable();
            select_city.clearOptions();
            select_city.load(function(callback) {
                xhr && xhr.abort();
                xhr = $.ajax({
                    url: '<?php echo base_url('/ajax_call/lga_call'); ?>/' + value ,
                    success: function(results) {
                      var newresult = JSON.parse(results);

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
    $('#register-form').on('submit', function (e) {
      e.preventDefault();
      if ($('#password').val() != $('#password_confirm').val()) {
        swal("Password mismatch!", "kindly check your password", "error");
        return;
      }
      var formData = new FormData($('form#register-form')[0]);
      // formData.append("actions", "writer_request");

      $.ajax({
          url: '<?php echo base_url('ajax_call/register'); ?>',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            console.log(data);
            realData = JSON.parse(data)
            if(realData.mess_type == '-5'){
              swal("Duplicate Data", "It seems this user exists kinly login to continue", "error");
            }else if (realData.mess_type == 1) {
              swal("Success", "Your account is created successfully", "success");
              setTimeout(function(){
                location.href = realData.redirect_url;
              },2000)
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
