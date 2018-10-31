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
        <a href="<?php echo base_url('admin/payment_approval') ?>" class="btn btn-primary pull-right new-crop"> Refresh</a>
        <h3 class="admin_section_title">Approve Payment</h3>
      </div>

        <div class="col-sm-12 col-md-12">
          <div class="background-white p20 mb50">
              <table class="table table-striped mb0 table-pending">
              
                  <thead>
                      <tr>
                          <th>Transaction Reference</th>
                          <th>Customers' Name</th>
                          <th>Email address</th>
                          <th>Amount Paid</th>
                          <th>Crop Invested in</th>
                          <th>Stage</th>
                          <th>Slot</th>
                          <th>Action</th>
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
    var pendingPaymentTable =   $('.table-pending').DataTable({

      "processing": true,
             "serverSide": true,
             "ajax":{
          "url": "<?php echo base_url("fetch_tables/pending_transaction") ?>",
          "dataType": "json",
          "type": "GET"
                        },
       "columns": [
               { "data": "transaction_ref" },
               { "data": "full_name" },
               { "data": "email_address" },
               { "data": "amount" },
               { "data": "crop_name" },
               { "data": "stage" },
               { "data": "slot" },
               { "data": "action" },
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
      });

  })
</script>
