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
          <div class="single_page_section schedule_section authentication_section login_section">
            <div class="schedule_overlay">

            </div>
            <div class="container">
              <div class="row">

                <div class="col-md-12 register-form-col">

                  <form class="register-form" id="schedule-form">
                    <p>The continued need to ensure we meet local legal and global standards require that we inform you of two
                      very important points before moving forward.</p>
                      <p>You would be required to input your registered email address in the box below so that your schedule
                        will be sent to you immediately. Before now, people say that they do not get these very important emails.
                        With this system, we are sure you get the schedule delivered right into your inbox </p>
                    <p>Secondly, we have a new cookies policy in line with EU regulations which is attached to the schedule.
                      We have required ourselves to impress on you to read the cookies policy and terms and conditions related to
                      the transactions on this site.</p>
                    <p>Kindly read the terms and conditions  <a href="<?php echo base_url('home/terms_and_condition'); ?>">HERE</a> </p>
                    <p>Please fill your email address below to get the schedule and the cookies policy</p>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Email address" required>
                        </div><!-- /.form-group -->
                      </div>

                    </div>
                      <button type="submit" class="btn btn-primary btn_register">Send me the schedule</button>

                      <p  class="rtn_login">By clicking on the button above, you have agreed with our terms and agreement and our cookies policy</p>
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
          url: '<?php echo base_url('send_schedule/comit'); ?>',
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
            console.log(data);
            realData = JSON.parse(data);
            if (realData.responseCode == 1) {
              swal('Success', 'The schedule has been succesfully sent. Please check your mail', 'success');
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
