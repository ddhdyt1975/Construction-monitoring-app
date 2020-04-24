<?php
     $logged_in = $this->session->userdata['logged_in']['user_id']; 
     $position = $this->session->userdata['logged_in']['position'];

    if(empty($logged_in))    {
        $this->session->set_flashdata('error', 'Session has Expired');
        redirect('auth');
    } 
    if($position == 'hr') {
        redirect('HumanR');
    }else if($position == 'ut2') {
        redirect('ManagerSM');
    }else if($position == 'ut1') {
        redirect('Admin');
    }else if($position == 'utv') {
        redirect('Public_prof');
    }else if($position == 'super') {
        redirect('SuperAdmin');
    }
    
?>
<style>

    .file {
      visibility: hidden;
      position: absolute;
    }
    .col-sm-1 {
        position: none;
        text-align: left;
       padding: 0 !important;
       margin: 0 !important;
    }
    .col-sm-9 {
        position:none;
        margin-left: 125px;
    }

    .col-sm-8 {
        position:none;
        margin-left: 188px;
         font-size: 12px;

    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit Profile 
        <small>(manage your profile here)</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('ManagerM') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a  href="<?= base_url('ProfileM') ?>"><i class="fa fa-user"></i>Profile</a></li>
        
      </ol>
    </section>


    <section class="content">
        <div class="row">
            <input type="hidden" id="userid" value="<?php echo $user_info->user_id ?>" />
            <div class="col-lg-7">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">My info</h3>
                    </div>
             
                    <div class="box-body">
                        <form class="form-horizontal" method="post" id="upload_file">
                            <center>
                            <img class = "profile-user-img img-responsive img-circle" style="width:150px;height:150px;border-radius:50%" src="<?php echo $user_info->user_photo?>"/>
                            <br>
                            <h4><?php echo $user_info->usertype_name ?></h4>
                           
                            <input type="file" name="userfile" class="file" id="userfile">
                            <div class="input-group col-xs-8">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                              <input type="text" class="form-control input-sm" disabled placeholder="Click Browse then Submit to change image">
                              <span class="input-group-btn">
                                <button class="browse btn btn-primary input-sm" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                              </span>
                            </div>
                            <div class="input-group col-xs-7">
                            <input type="submit" name="submit" id="submit" />
                            </div>
                            </center>
                        </form>

                        <br>
                        
                        <form id= "prof_form" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="Fname">First name</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="fname" name ="fname" placeholder="First Name" value="<?php echo $user_info->user_fname?>">
                                </div>         
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-3" for="Mname">Middle name</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" value="<?php echo $user_info->user_mname?>">
                                </div>                        
                            </div>

                             <div class="form-group">
                                <label class="control-label col-sm-3" for="Lname">Last name</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="lname" name="lname"  placeholder="Last Name" value="<?php echo $user_info->user_lname?>">
                                </div>                 
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-3" for="Number">Phone Number</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone #" value="<?php echo $user_info->user_phone?>">
                                </div>                        
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-3" for="Address">Address</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="address" name = "address" placeholder="Address" value="<?php echo $user_info->user_address ?>">
                                </div>                       
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" >City</label>
                                <div class="col-sm-6">
                                    <select id = "city" name="city" class="form-control">
                                        <option value="<?php echo $user_info->city_id?>"><?php echo $user_info->city_name.', '.$user_info->province_name ?></option>
                                        <?php foreach($cities as $cobject)
                                            echo '<option value='.$cobject->city_id.'>'.$cobject->city_name.', '.$cobject->province_name.'</option>'
                                        ?>
                                    </select>
                                </div>
                            </div>
                              
                            </form>
                                <div class = "box-footer" align="right">
                                    <button onclick="editProf();" class="btn btn-success btn-sm "><i class="fa fa-refresh"></i> Update Profile</button>
                                </div>
                        
                    </div>
                </div> 
            </div>
            <div class="col-lg-5">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Account Details</h3>
                    </div>
                    
                    <div class="box-body">
                        <div class="col-lg-12">
                            <div class="box box-info collapsed-box">
                                <div class="box-header with-border">
                                <h3 class="box-title"> Change Email</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form id="emailForm">
                                        <div class="form-group">
                                            <label>Current Email</label>
                                            <input type="text" class="form-control" id="curemail" readonly="readonly"  value="<?php echo $user_info->user_email?>" />
                                            
                                        </div>
                                    </form>
                                              
                                    <form id="reg_form" >
                                        <div class="form-group">
                                            <label >New Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="konstrak@yourcompany.com" required />                                                           
                                        </div>
                                        <div class="col-lg-12 ajax_response_result"></div>
                                    </form>
                                </div>
                                <div class = "box-footer" align="right">
                                    <button onclick="editEmail(event)" class="btn btn-success btn-sm "><i class="fa fa-refresh"></i> Update Email</button>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-12">
                            <div class="box box-info collapsed-box">
                                <div class="box-header with-border">
                                <h3 class="box-title"> Change Password</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form id="pass_form" >
                                        <?php $userid = ($this->session->userdata['logged_in']['user_id']); ?>
                                        <input type="hidden" name="userid" id="userid" value="<?php echo $userid ?>" />

                                        <div class="form-group">
                                            <label for="curPword">Current Password</label>
                                            <input type="password" class="form-control" name="curPword" id="curPword" placeholder="Enter current password" required />
                                        </div>

                                        <div class="form-group">
                                            <label  for="newPword">New Password</label>
                                            <input type="password" class="form-control" name="newPword" id="newPword" placeholder="Enter new password" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="confPword">Confirm Password</label>
                                            <input type="password" class="form-control" name="confPword" id="confPword" placeholder="Confirm new password" required />         
                                        </div>
                                        <div class="  ajax_pass_result"></div>
                                    </form>
                                </div>

                                <div class = "box-footer" align="right">
                                    <button onclick="changepass(event)" class="btn btn-success btn-sm "><i class="fa fa-refresh"></i> Update Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>  
        </div> 
    </section>
</div>


                
<script>

 
var id = document.getElementById('userid').value;

function changepass(e) {
    e.preventDefault();
    jQuery.ajax({
        type: "POST",
        url:  "<?php echo site_url('ProfileM/update_password') ?>",    
        data: $("#pass_form").serialize(),
        success: function(res) {
            $(".ajax_pass_result").html(res);
        }
    });

}

</script>

<script>
var id = document.getElementById('userid').value;

 function getUserDetails(id) {
            
         $.ajax({
          url : "<?php echo site_url('ProfileM/userDetails/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
              
                $('#curemail').val(data['user_email']);
                
          },
          error: function (jqXHR, textStatus, errorThrown) {
              //alert('Error get data from ajax');
          }
        });  
}

function editEmail(e) {
    e.preventDefault();
    jQuery.ajax({
    type: "POST",
    url: "<?php echo site_url('ProfileM/check_email') ?>/" + id,    
    data: $("#reg_form").serialize(),
        success: function(res) {
            $(".ajax_response_result").html(res);
                getUserDetails(id);
        }
    });
}
    
function editProf() { 

    var id = document.getElementById('userid').value;
    var fname = document.getElementById('fname').value;
    var mname = document.getElementById('mname').value;
    var lname = document.getElementById('lname').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('address').value;
    var city = document.getElementById('city').value;

    var postData = {
        'id' : id,
        'fname' : fname,
        'mname' : mname,
        'lname' : lname,
        'phone' : phone,
        'address' : address, 
        'city' : city
        }

        $.ajax({
         type: "POST",
         url: "<?php echo site_url('ProfileM/editDetails/')?>" + id,
         data: postData,
         success: function(msg){
            window.location.reload();   
         }
        });
}

</script>
<script>

     $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });
    $(document).on('change', '.file', function(){
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
</script>

<script>
    $(function() {
        $('#upload_file').submit(function(e) {
            e.preventDefault();
            $.ajaxFileUpload({
                url             :"<?php echo site_url('ProfileM/upload_file')?>", 
                secureuri       :false,
                fileElementId   :'userfile',
                dataType: 'JSON',
                success : function (data){
                    window.location.reload();                  
                }
            });
            return false;
        });
    });
</script>

<!-- /#page-wrapper -->