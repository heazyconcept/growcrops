<div class="main">
    <div class="outer-admin">
        <div class="wrapper-admin">
            <?php $this->load->view('templates/admin_menu'); ?>

            <div class="content-admin">
                <div class="content-admin-wrapper">
                    <div class="content-admin-main">
                        <div class="content-admin-main-inner">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">



<div class="row">
  <div class="container">
    <a href="<?php echo base_url('admin/users') ?>" class="btn btn-primary pull-right new-crop"> Refresh</a>
    <button class="btn btn-primary pull-right send_schedule new-crop"> Send Schedule</button>
    <h3 class="admin_section_title">All Users</h3>
  </div>
    <div class="col-sm-12 col-md-12">
      <div class="background-white p20 mb50">
          <table class="table table-striped mb0 table-pending">
              <thead>
                  <tr>
                      <th>Full Name</th>
                      <th>Email Address</th>
                      <th>Phone Number</th>
                      <th>address</th>
                      <th>State</th>
                      <th></th>
                  </tr>
              </thead>

              <tbody class="pending_refresh">





              </tbody>
          </table>



      </div>


    </div><!-- /.col-* -->


</div><!-- /.row -->
</div><!-- /.col-* -->

                                </div>
                            </div><!-- /.container-fluid -->
                        </div><!-- /.content-admin-main-inner -->
                    </div><!-- /.content-admin-main -->

                    <script type="text/javascript">
                      $(document).ready(function () {
                        var userTable =   $('.table-pending').DataTable({
                        "pageLength": 50,
                        "processing": true,
                        "serverSide": true,
                        "ajax":{
                              "url": "<?php echo base_url("fetch_tables/users") ?>",
                              "dataType": "json",
                              "type": "GET"
                                            },
                        "columns": [
                                   { "data": "full_name" },
                                   { "data": "email_address" },
                                   { "data": "phone_number" },
                                   { "data": "user_address" },
                                   { "data": "state" },
                                   { "data": "action" },

                                ],
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]
                          });

                      })
                    </script>
                    <script type="text/javascript">
$(document).ready(function () {

$('.send_schedule').on('click', function () {
  $.ajax({
      url: '<?php echo base_url('send_schedule/send_mail'); ?>',
      type: 'POST',
      async: false,
      success: function (data) {
        console.log(data);
        if(data == '1'){
          swal("Success", "Your mail is processing", "success");
          setTimeout(function(){
            location.reload();
          },2000)
        }else {
          swal("Oops", "unknown error occured, kindly contact your administrator", "error");
        }

      },
      error: function (data) {
        console.log(data);
      },
      cache: false,
      contentType: false,
      processData: false
  });
})
$(document).on("click", ".pasword-reset", function () { 
    var userId = $(this).data("id");
    $.post("<?php echo base_url('adminApi/ResetPassword/"+ userId +"') ?>")
      .done(function (data) {
        if (data == 1) {
          swal("Success", "password changed successfully", "success");
          setTimeout(function(){
            location.reload();
          },2000)
        }else {
          swal("Oops", "unknown error occured, kindly contact your administrator", "error");
        }

        })
        .fail(function (error) {
          console.log(error);
          
          })

 })
})
</script>
