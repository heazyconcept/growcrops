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
                                                <h3 class="admin_section_title">User Dashbard</h3>
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                    <form class="new_post_form" id="userDashboardForm" >
                                                        <div class="background-white p20 mb50">
                                                            <h2 class="page-title">Add/Update User Dashboard</h2>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="user_details">Search Users</label>
                                                                        <input type="text" class="form-control" id="user_details"  name="user_details" placeholder="search by name, email, or phonenumber">
                                                                        <div class="suggest-wrapper">

                                                                        </div>
                                                                    </div>
                                                                    <div class="user-profile" style="display:none">
                                                                    <div class="form-group">
                                                                        <label for="full_name">Full Name</label>
                                                                        <input type="text" class="form-control" id="full_name"  name="full_name"disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email_address">Email Address</label>
                                                                        <input type="text" class="form-control" id="email_address"  name="email_address" disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone_number">Phone Number</label>
                                                                        <input type="text" class="form-control" id="phone_number"  name="phone_number" disabled>
                                                                    </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="slot">Number of Slot Bought</label>
                                                                        <input type="text" class="form-control" id="slot"  name="Slot" placeholder="Number of slot bought">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="amount">Amount Payeable</label>
                                                                        <input type="text" class="form-control" id="amount"  name="AmountPayeable" placeholder="Amount payeable">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="paymentUpdate">Payment Update</label>
                                                                        <textarea class="form-control" id="paymentUpdate"  name="PaymentUpdate"></textarea>                                                           
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                </form>


                                            </div>


                                        </div><!-- /.col-* -->


                                    </div><!-- /.row -->
                                </div><!-- /.col-* -->

                            </div>
                        </div><!-- /.container-fluid -->
                    </div><!-- /.content-admin-main-inner -->
                </div><!-- /.content-admin-main -->
                <div class="content-admin-main">
                    <div class="content-admin-main-inner">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="container">
                                            <a href="<?php echo base_url('admin/users') ?>" class="btn btn-primary pull-right new-crop">
                                                Refresh</a>

                                            <h3 class="admin_section_title">User Dashbard Enabled </h3> </div> <div
                                                    class="col-sm-12 col-md-12">
                                                    <div class="background-white p20 mb50">
                                                        <table class="table table-striped mb0 table-pending">
                                                            <thead>
                                                                <tr>
                                                                    <th>Full Name</th>
                                                                    <th>Email Address</th>
                                                                    <th>Phone Number</th>
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
                        var globalData;
                        $("#user_details").keyup(function(){
                            $(".user-profile").hide("slow");
                            $(".suggest-wrapper").html('');
                            var search = $(this).val();
                            if(search === null || search === undefined || search === ''){
                                $(".suggest-wrapper").html('');
                                return;
                            }
                            $.post('<?php echo base_url("ajax_call/fetchUser/")  ?>' + search + '/' + 5, function(data){
                                
                                if(data !== ''){
                                    var formatedData = JSON.parse(data);
                                    globalData = formatedData;
                                var html = "";
                                $.each(formatedData, function(key,value){
                                    html += '<li class="suggest-item" data-id="'+ value.id +'">' +
                                        '<span class="major-suggest">'+ value.first_name + ' ' + value.last_name +'</span>' +
                                        '<span class="minor-suggest">' + value.email_address + ' - ' + value.phone_number + '</span>' +
                                        '</li>';
                                })
                                $(".suggest-wrapper").html(html);

                                }else{
                                    $(".suggest-wrapper").html('');
                                }
                                
                            })

                        })
                         $(document).on( 'click', '.suggest-item', function (){
                           var id =  $(this).data("id");
                           $(".suggest-wrapper").html('');
                           var html = "";
                           $.each(globalData, function(key,value){
                               if(value.id == id){
                                   var fullName = value.first_name + ' ' + value.last_name;
                                   $("#full_name").val(fullName);
                                   $("#email_address").val(value.email_address);
                                   $("#phone_number").val(value.phone_number);


                               }
                           })
                           $(".user-profile").show("slow");

                        })
                    })
                </script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        var userTable = $('.table-pending').DataTable({
                            "pageLength": 50,
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": "<?php echo base_url("fetch_tables/users") ?>",
                              "dataType": "json",
                                "type": "GET"
                            },
                            "columns": [
                                { "data": "full_name" },
                                { "data": "email_address" },
                                { "data": "phone_number" },
                                { "data": "user_address" },
                                { "data": "state" }
                            ],
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        });

                    })
                </script>