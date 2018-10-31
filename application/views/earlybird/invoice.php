<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="content">

                <div class="invoice-wrapper mt50 mb50" id="invoice-wrapper">
<div class="invoice">
    <div class="invoice-header clearfix">
        <div class="invoice-logo">
          <img src="<?php echo asset_url('img/logo.png') ?>" alt="">
        </div><!-- /.invoice-logo -->

        <div class="invoice-description">
            <strong> <?php echo 'INV000'. $invoice_details[0]->id; ?> / <?php echo date("m.d.Y", strtotime($invoice_details[0]->transaction_date)); ?></strong>
            <span>Invoice for payment</span>
        </div>
    </div><!-- /.invoice-header -->

    <div class="invoice-info">
        <div class="row">
            <div class="col-sm-4">
                <h4>Client</h4>
                <?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name');  ?> <br>
                <?php echo $this->session->userdata('email_address'); ?> <br>
                <?php echo $this->session->userdata('phone_number'); ?> <br>
                <?php echo $this->session->userdata('user_address'); ?> <br>
            </div>

            <div class="col-sm-4">
                <!-- <h4>About</h4>

                Drem psum dolor sit amet<br>
                Laoreet dolore magna<br>
                Consectetuer adipiscing elit<br>
                Magna aliquam tincidunt erat volutpat<br>
                Olor sit amet adipiscing eli<br>
                Laoreet dolore magna -->
            </div>

            <div class="col-sm-4 pull-right">
                <h4>Payment Details</h4>

                <strong>Reference:</strong> <?php echo $invoice_details[0]->transaction_ref; ?><br>
                <strong>Payment Type:</strong> Online<br>
                <strong>Crop Name:</strong><?php echo $invoice_details[0]->crop_name; ?><br>
                <strong>Stage Paid For:</strong>  <?php echo $invoice_details[0]->stage; ?><br>
            </div>
        </div>
    </div><!-- /.invoice-info -->

    <table class="invoice-table table">
        <thead>
        <tr>
            <th>Crop Name</th>
            <th>Slot</th>
            <th>Price per Slot</th>
            <th>Total</th>
        </tr>
        </thead>

        <tbody>
            <tr>
                <td><?php echo $invoice_details[0]->crop_name; ?></td>
                  <td><?php echo $invoice_details[0]->slot; ?></td>
                  <td><?php echo $price[0]->amount; ?></td>
                  <td>&#8358;<?php echo number_format($price[0]->amount * $invoice_details[0]->slot, 2); ?></td>
            </tr>



        </tbody>
    </table>

    <div class="invoice-summary clearfix">
        <dl class="dl-horizontal pull-right">
            <dt>Sub - Total amount:</dt>
            <dd>&#8358;<?php echo number_format($price[0]->amount * $invoice_details[0]->slot, 2); ?></dd>
            <dt>VAT 5%:</dt>
            <dd>&#8358;<?php echo number_format($invoice_details[0]->amount - ($price[0]->amount * $invoice_details[0]->slot), 2); ?></dd>
            <dt>Grand Total:</dt>
            <dd>&#8358; <?php echo number_format($invoice_details[0]->amount, 2);  ?></dd>
        </dl>

    </div><!-- /.invoice-summary -->
</div><!-- /.invoice -->
</div><!-- /.invoice-wrapper -->
<button type="button" name="button" class="btn btn-secondary btn-print pull-right mb50"> Print Receipt</button>
            </div><!-- /.content -->
        </div><!-- /.container -->
    </div><!-- /.main-inner -->
</div><!-- /.main -->
<script type='text/javascript' src="<?php echo asset_url('js/jQuery.print.min.js'); ?>"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('.btn-print').click(function () {
      $("#invoice-wrapper").print({});

    })
  })
</script>
