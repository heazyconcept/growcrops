<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
          <div class="single_page_section schedule_section authentication_section login_section">
            <div class="schedule_overlay">

            </div>
            <div class="container">
              <div class="row">

                <div class="col-md-12 register-form-col">

                  <form class="register-form" id="schedule-form">
                    <p>Please fill your email address below to validate your credentials</p>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Email address" required>
                        </div><!-- /.form-group -->
                      </div>

                    </div>
                      <button type="submit" class="btn btn-primary btn_register">Send me the schedule</button>

                      <p  class="rtn_login">By clicking on the button above, you have agreed with our <a href="<?php echo base_url('home/terms_and_condition'); ?>">terms and agreement and our cookies policy</a></p>
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
    $('#schedule-form').on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData($('form#schedule-form')[0]);
      $.ajax({
          url: '<?php echo base_url('authAjax/ValidateCert'); ?>',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            console.log(data);
            realData = JSON.parse(data);
            if (realData.responseCode == 1) {
              swal('Success', 'Your certificate is successfully validated', 'success');
            }else {
              swal('Error', realData.responseValue, 'error');
            }


          },
          cache: false,
          contentType: false,
          processData: false
      });
    })
  })
</script>
