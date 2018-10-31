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
          <div class="single_page_section authentication_section login_section">
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
                    <p>Please Login to continue</p>
                  </div>
                </div>
                <div class="col-md-6 register-form-col">
                  <div class="auth_message height_adj">
                    <?php if ($this->session->has_userdata('redirect_data')): ?>
                      <div class="flash_message">
                        Please login/register to continue
                      </div>

                    <?php endif; ?>

                  </div>
                  <form class="register-form" id="register-form">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username/Email address" required>
                        </div><!-- /.form-group -->
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div><!-- /.form-group -->
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="return_url" id="return_url" value="<?php if($this->session->has_userdata('redirect_data')){$redirect_data =  $this->session->userdata('redirect_data'); echo urlencode($redirect_data['url']); } ?>" >
                        </div><!-- /.form-group -->
                      </div>
                    </div>
                      <button type="submit" class="btn btn-primary btn_register">Login</button>
                      
                      <a href="<?php echo base_url('auth/register'); ?>" class="pull-right rtn_login">Not a member yet? Click here to register</a>
                  </form>
                    <a href="<?php echo base_url('auth/forgot_password'); ?>" class="rtn_login rtn_reset_password">Lost your password? Click here to reset it</a>

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
    $('#register-form').on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData($('form#register-form')[0]);
      $.ajax({
          url: '<?php echo base_url('ajax_call/login'); ?>',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            realData = JSON.parse(data)
            if(realData.mess_type == '-5'){
              swal("User Unknown", "The username used is invalid", "error");
            }else if(realData.mess_type == '-3') {
              swal("Invalid Password", "Kindly check your password", "error");
            }else if (realData.mess_type == '1') {
              console.log(realData);
              location.href = realData.redirect_url;
            }

          },
          cache: false,
          contentType: false,
          processData: false
      });
    })
  })
</script>
