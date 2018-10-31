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
    <a href="<?php echo base_url('admin/transactions') ?>" class="btn btn-primary pull-right new-crop"> Refresh</a>
    <h3 class="admin_section_title">All Transactions</h3>
  </div>
  <div class="transaction_overview">


    <div class="row">
      <div class="col-sm-4">
          <div class="statusbox">
              <h2>All transaction</h2>
              <div class="statusbox-content">
                  <strong>&#8358;<?php echo number_format($all_transaction[0]->total_amount, 2); ?></strong>
                  <span>Updated <?php echo date('j/n/Y'); ?></span>
              </div><!-- /.statusbox-content -->

              <div class="statusbox-actions">
                  <a href="#"><i class="fa fa-eye"></i></a>
              </div><!-- /.statusbox-actions -->
          </div><!-- /.statusbox -->
      </div>
      <div class="col-sm-4">
          <div class="statusbox">
              <h2>Pending Transaction</h2>
              <div class="statusbox-content">
                  <strong>&#8358;<?php echo number_format($pend_transaction[0]->pending_amount, 2); ?></strong>
                  <span>Updated <?php echo date('j/n/Y'); ?></span>
              </div><!-- /.statusbox-content -->

              <div class="statusbox-actions">
                  <a href="#"><i class="fa fa-eye"></i></a>
              </div><!-- /.statusbox-actions -->
          </div><!-- /.statusbox -->
      </div>
      <div class="col-sm-4">
          <div class="statusbox">
              <h2>Approved Transaction</h2>
              <div class="statusbox-content">
                  <strong>&#8358;<?php echo number_format($paid_transaction[0]->paid_amount, 2); ?></strong>
                  <span>Updated <?php echo date('j/n/Y'); ?></span>
              </div><!-- /.statusbox-content -->

              <div class="statusbox-actions">
                  <a href="#"><i class="fa fa-eye"></i></a>
              </div><!-- /.statusbox-actions -->
          </div><!-- /.statusbox -->
      </div>
    </div>
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
                        var PaymentTable =   $('.table-pending').DataTable({
                          "pageLength": 50,
                          "processing": true,
                          "serverSide": true,
                          "ajax":{
                              "url": "<?php echo base_url("fetch_tables/transactions") ?>",
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
                                   { "data": "slot" }
                                ],
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]
                          });

                      })
                    </script>
