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
                    <!-- <h4>Welcome to Growcrops Online</h4> -->
                    <!-- <p>Please Login to continue</p> -->
                  </div>
                </div>
                <div class="col-md-6 register-form-col">
                  <div class="auth_message height_adj">

                  </div>
                  <form class="register-form" id="register-form">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="email_address">Enter your registered email address</label>
                            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Your email address" required>
                        </div><!-- /.form-group -->
                      </div>


                    </div>
                      <button type="submit" class="btn btn-primary btn_register">Reset</button>

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
    $('#register-form').on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData($('form#register-form')[0]);
      $.ajax({
          url: '<?php echo base_url('ajax_call/reset_password'); ?>',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            console.log(data);
            if(data == '-5'){
              swal("User Unknown", "The email address entered is invalid.", "error");
            }else if (data == '1') {
              swal("Email Sent", "Password reset instruction has been sent to your mail", "success");

            }

          },
          cache: false,
          contentType: false,
          processData: false
      });
    })
  })
</script>
