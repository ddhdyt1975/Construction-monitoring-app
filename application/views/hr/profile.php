<?php
     $logged_in = $this->session->userdata['logged_in']['user_id']; 
     $position = $this->session->userdata['logged_in']['position'];

    if(empty($logged_in))    {
        $this->session->set_flashdata('error', 'Session has Expired');
        redirect('auth');
    } 
    if($position == 'ut1') {
        redirect('Admin');
    }else if($position == 'ut2') {
        redirect('ManagerSM');
    }else if($position == 'ut3') {
        redirect('ManagerM');
    }else if($position == 'utv') {
        redirect('Public_prof');
    }else if($position == 'super') {
        redirect('SuperAdmin');
    }
    
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit Profile 
        <small>(manage your profile here)</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('Admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a  href="<?= base_url('Profiles') ?>"><i class="fa fa-user"></i>Profile</a></li>
        
      </ol>
    </section>


    <section class="content">
        <div class ="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Profile  </h3>
                        <div class="box-tools pull-right">
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class ="row">
                            <div class="col-lg-6">
                                <div class="col-lg-12 well">
                                    <h1><?php echo $user_info->user_fname.' '. $user_info->user_mname ?> <?php echo $user_info->user_lname ?></h1>
                                        <ul class="list-unstyled user_data">
                                            <h3><i class="fa fa-briefcase user-profile-icon"> :</i> <?php echo $user_info->usertype_name ?></h3>

                                            <h3 class="m-top-xs">  <i class="fa fa-mobile user-profile-icon"> :</i>
                                                <?php echo $user_info->user_phone ?> 
                                            </h3>
                                             <h3><i class="fa fa-map-marker user-profile-icon"> :</i> <?php echo $user_info->user_address ?>, <?php echo $user_info->city_name ?>, <?php echo $user_info->province_name ?>, <?php echo $user_info->zip_code ?>
                                            </h3>
                                        </ul>
                                    <a class="btn btn-success pull-right" onclick="editProfile()"><i class="fa fa-edit m-right-xs"></i> Edit My Profile Details</a>
                                </div>
                                <div class="col-lg-12 well">
                                    <h3 class="m-top-xs">  <i class="fa fa-at user-profile-icon"> : </i><?php echo $user_info->user_email?></h3>
                                        <ul class="list-unstyled user_data">
                                            <li>Status <i class="fa fa-hand-o-right user-profile-icon"> : </i> <?php echo $user_info->user_status ?>
                                            </li>
                                            <li>Password: click (Edit my account) button to change password and email.</li> 
                                        </ul>
                                    <a class="btn btn-success pull-right" onclick="editProfile2()"><i class="fa fa-edit m-right-xs"></i> Edit My Account</a>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="col-lg-11 well" style="max-heigth:100px;heigth:100px;">
                                    <div align="center">
                                        <div class="center sidebar user-panel image">
                                            <img   style="heigth:150px;max-heigth:150px;width:150px;max-width:150px;"  src="<?php echo $user_info->user_photo ?>" alt="image" />
                                            <div class ="clearfix"><br></div>
                                            <button  class="btn btn-success btn-block"onclick="changeDP()">Click to change Profile picture</button>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_photo" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header  btn-primary">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form   id="upload_file">
                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-12">
                                        <label>File input</label>
                                        <input type="file" name="userfile" id="userfile" >
                                    </div>
                                     
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" onclick="addPhoto(); ">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_profile" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-primary">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form   id="formprofile" class="form-group">
                             
                            <div class="form-group">
                              <div class ="row">
                                <div class = "col-lg-4">
                                  <label for="myfname">Firstname:</label>
                                  <input type="text" class="form-control" id="myfname" name="myfname" placeholder = "First name"/>
                                  <span class="help-block"></span>
                                </div>
                                <div class = "col-lg-4">
                                  <label for="mymname">Middle Name:</label>
                                  <input type="text" class="form-control" id="mymname" name="mymname" placeholder = "Middle name"/>
                                  <span class="help-block"></span>
                                </div>
                                <div class = "col-lg-4">
                                  <label for="mylname">Last Name:</label>
                                  <input type="text" class="form-control" id="mylname" name="mylname" placeholder = "Last name"/>
                                  <span class="help-block"></span>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class ="row">
                                <div class = "col-lg-6">
                                    <label for="myadd">Address:</label>
                                    <input type="text" class="form-control" id="myadd" name="myadd" placeholder = "Address"/>
                                    <span class="help-block"></span>
                                </div>
                                <div class = "col-lg-6">
                                    <label for="mycity">City, Province:</label>
                                    <select id="mycity" name="mycity"  class="form-control">
                                    <?php foreach($city as $cobject)
                                        echo '<option value='.$cobject->city_id.'>'.$cobject->city_name.', '.$cobject->province_name.'</option>'
                                    ?>
                                     </select>
                                    <span class="help-block"></span>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="mynum">Contact number:</label>
                              <input type="text" class="form-control" id="mynum" name="mynum" placeholder = "Phone number"/>
                              <span class="help-block"></span>
                            </div> 

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_profile2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-primary">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form   id="pass_form" class="form-group">
                            
                            <div class="form-group">
                              <label for="myemail">Email:</label>
                              <input type="text" class="form-control" id="myemail" name="myemail" placeholder = "Phone number"/>
                              <span class="help-block"></span>
                            </div> 

                            <div class="clearfix"></div>

                            <div class="form-group">
                                <label  for="curPword">Current Password</label>
                                
                                <input type="password" class="form-control" name="curPword" id="curPword" placeholder="Enter current password" required />
                               
                            </div>

                            <div class="form-group">
                                <label  for="newPword">New Password</label>
                                 
                                <input type="password" class="form-control" name="newPword" id="newPword" placeholder="Enter new password" required />
                                
                            </div>

                             <div class="form-group">
                                <label  for="confPword">Confirm Password</label>
                                 
                                <input type="password" class="form-control" name="confPword" id="confPword" placeholder="Confirm new password" required />
                                
                                 
                            </div>
                            <div class="col-lg-12 ajax_pass_result" style="color:red;font-weight:bolder;"></div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="changepass(event)" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="alert_modal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                   
                    <div class="modal-body">
                    <div id="myDialogText" style="font-size:16px">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div> 
    </section>
</div>
 
 
<script>
    function changepass(e) {
        e.preventDefault();
        jQuery.ajax({
            type: "POST",
            url:  "<?php echo site_url('Profiles/update_password') ?>",    
            data: $("#pass_form").serialize(),
            success: function(res) {
                $(".ajax_pass_result").html(res);
                
            }
        });
    }
</script>

<script >
 

function editProfile(){
  $('#formprofile')[0].reset();
  $('.form-group').removeClass('has-error');
  $('.help-block').empty();
 

  $.ajax({
        url : "<?php echo site_url('Profiles/ajax_edit_p/')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data){

          $('[name="myfname"]').val(data.user_fname);
          $('[name="mymname"]').val(data.user_mname);
          $('[name="mylname"]').val(data.user_lname);
          $('[name="myadd"]').val(data.user_address);
          $('[name="mycity"]').val(data.city_id);
          $('[name="mynum"]').val(data.user_phone);
          $('#modal_profile').modal('show');
          $('.modal-title').text('Edit My Profile');
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}

function editProfile2(){
  $('#pass_form')[0].reset();
  $('.form-group').removeClass('has-error');
  $('.help-block').empty();
 

    $.ajax({
        url : "<?php echo site_url('Profiles/ajax_edit_p/')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data){

          $('[name="myemail"]').val(data.user_email);
          $('#modal_profile2').modal('show');
          $('.modal-title').text('Edit My Profile');
        },
        error: function (jqXHR, textStatus, errorThrown){
          new PNotify({
            title: 'Error!',
            text: 'A process cannot get through. Please consult your admin.',
            type: 'error',
            styling: 'bootstrap3'
          }); 
        }
    });
}

function save(){
  $('#btnSave').text('Saving...'); 
  $('#btnSave').attr('disabled',true);

  var url;
  url = "<?php echo site_url('Profiles/ajax_update')?>";

  $.ajax({
      url : url,
      type: "POST",
      data: $('#formprofile').serialize(),
      dataType: "JSON",
      success: function(data){          
        if(data.status){
          $('#modal_profile').modal('hide');
          new PNotify({
            title: 'Status',
            text: 'Updated successfully. To see changes please re-login.',
            type: 'success',
            styling: 'bootstrap3'
          });
        }
        window.location.reload();
        $('#btnSave').text('Save'); //change button text
        $('#btnSave').attr('disabled',false);
      },
      
  });
  $('#btnSave').text('Save'); //change button text
  $('#btnSave').attr('disabled',false);
}

function changeDP(){
    $('#upload_file')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#add_photo').modal('show');
    $('.modal-title').text('Change Profile Picture');
}


function addPhoto(){
    $.ajaxFileUpload({
        url             :"<?php echo site_url('Profiles/upload_file/')?>", 
        secureuri       :false,
        fileElementId   :'userfile',
        dataType: 'JSON',
        success : function (data){

        $('#add_photo').modal('hide'); 
            new PNotify({
                title: 'Update Status',
                text: 'Uploaded successfully. To see changes please re-login.',
                type: 'success',
                styling: 'bootstrap3'
            });
            window.location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown){
          new PNotify({
            title: 'Error!',
            text: 'A process cannot get through. Please consult your admin.',
            type: 'error',
            styling: 'bootstrap3'
          }); 
        }
    });
    return false;
} 
 

</script>
    
</body>
</html>