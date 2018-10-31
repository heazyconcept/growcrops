<div class="widget">
<div class="user-photo">
<a href="#">
<form class="upload-form" id="upload-form" enctype="multipart/form-data">
  <img src="<?php echo $image_url; ?>"  class="preview_profile_pic" alt="User Photo">
  <button type="button" id="button" class="user-photo-action" name="button" value="Upload" onclick="thisFileUpload();">Upload</button>
  <button type="button" id="save_button" class="user-photo-action" name="button" value="Upload" onclick="savePicture();" style="display:none;"  >Save</button>
  <input type="file" id="profile_pics" name="profile_pics" style="display:none;" />
</form>
</a>
</div><!-- /.user-photo -->
</div><!-- /.widget -->
 <div class="widget">
<ul class="menu-advanced">
    <li><a href="<?php echo base_url('user/crops_planted'); ?>"><i class="fa fa-pencil"></i> Crops Planted</a></li>
    <li class=""><a href="<?php echo base_url('home/crops'); ?>"><i class="fa fa-user"></i> View all Crops</a></li>
    <li><a href="<?php echo base_url('user/change_profile_details'); ?>"><i class="fa fa-user"></i> Change Profile Details</a></li>
    <li><a href="<?php echo base_url('user/transaction_details'); ?>"><i class="fa fa-sign-out"></i> My Transaction Details</a></li>
    <li><a href="<?php echo base_url('user/pending'); ?>"><i class="fa fa-sign-out"></i> Pending Transactions</a></li>
    <li><a href="<?php echo base_url('user/invoice'); ?>"><i class="fa fa-sign-out"></i> My Invoice</a></li>
</ul>
</div><!-- /.widget -->
<script type="text/javascript">
function thisFileUpload() {
         document.getElementById("profile_pics").click();
     };
     function savePicture() {
       var picData = new FormData($('form#upload-form')[0]);
       // formData.append("actions", "writer_request");

       $.ajax({
           url: '<?php echo base_url('ajax_call/save_picture'); ?>',
           type: 'POST',
           data: picData,
           async: false,
           success: function (data) {
             console.log(data);
             if(data == '-5'){
               swal("Unknown Error", "Kindly contact your adminisrator", "error");
             }else if (data == '1') {
               swal("Successfull", "Profile Image Uploaded", "success");
               $('#button').show('fast');
               $('#save_button').hide('fast');
             }

           },
           cache: false,
           contentType: false,
           processData: false
       });
     }
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.preview_profile_pic').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(document).ready(function () {
  $("#profile_pics").on('change', function () {
      readURL(this);
      $('#button').hide('fast');
      $('#save_button').show('fast');

  })

})

</script>
