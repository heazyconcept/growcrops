<div class="main">
    <div class="outer-admin">
        <div class="wrapper-admin">
            <?php $this->load->view('templates/admin_menu');?>
            <div class="content-admin">
                <div class="content-admin-wrapper">
                    <div class="content-admin-main">
                        <div class="content-admin-main-inner">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="container">
                                                <h3 class="admin_section_title">Employees Management</h3>
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                    
                                                        <div class="background-white p20 mb50">
                                                            <h2 class="page-title">New Employee</h2>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <form class="new_post_form" id="Employeeform" >
                                                                    <div class="form-group">
                                                                        <label for="full_name">First Name</label>
                                                                        <input type="text" class="form-control" id="first_name"  name="first_name" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="full_name">Last Name</label>
                                                                        <input type="text" class="form-control" id="last_name"  name="last_name" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email_address">Email Address</label>
                                                                        <input type="text" class="form-control" id="email_address"  name="email_address" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone_number">Phone Number</label>
                                                                        <input type="text" class="form-control" id="phone_number"  name="phone_number" >
                                                                    </div>
                                                                    <div class="form-action">
                                                                    <button class="btn btn-success"> Submit </button>
                                                                    </div>
                                                                    </form>

                                                                </div>
                                                                <div class="col-md-6">
                                                                <h2 class="page-title"> Employees</h2>
                                                                <table class="table table-striped mb0 table-employee">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Full Name</th>
                                                                            <th>Email Address</th>
                                                                            <th>Phone Number</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody class="pending_refresh">

                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                


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
                       
                     var userTable = $('.table-employee').DataTable({
                            "pageLength": 50,
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": "<?php echo base_url("fetch_tables/employees") ?>",
                              "dataType": "json",
                                "type": "GET"
                            },
                            "columns": [
                                { "data": "full_name" },
                                { "data": "email_address" },
                                { "data": "phone_number" },
                                { "data": "action" },
                            ],
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        });
                        $('#Employeeform').on('submit', function (e) {
                            e.preventDefault();
                            var formData = new FormData($('form#Employeeform')[0]);
                            $.ajax({
                                url: '<?php echo base_url('ajax_call/addEmployee'); ?>',
                                type: 'POST',
                                data: formData,
                                async: false,
                                success: function (data) {
                                    console.log(data);
                                    if(data == 0){
                                        swal("Oops", "unknown error occured, kindly contact your administrator", "error");
                                    
                                    }else {
                                        var realData = JSON.parse(data);
                                        if(realData.mess_type == '1'){
                                            swal("Success", "Data saved successfully", "success");
                                            setTimeout(function(){
                                                location.reload();
                                            },2000)
                                        }else if(realData.mess_type == '-5'){
                                            swal("Error", "User Already Exists", "error");
                                        }else{
                                            swal("Oops", "unknown error occured, kindly contact your administrator", "error");
                                        }
                                        

                                    
                                    }

                                },
                                error: function(error){
                                    console.log(error);
                                },
                                cache: false,
                                contentType: false,
                                processData: false
                            });
    })
                    })
                </script>
                