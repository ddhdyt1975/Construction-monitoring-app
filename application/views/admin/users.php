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
    }else if($position == 'ut3') {
        redirect('ManagerM');
    }else if($position == 'utv') {
        redirect('Public_prof');
    }else if($position == 'super') {
        redirect('SuperAdmin');
    }
    
?>
<style type="text/css">
    .profile_details profile_view.{display:inline-block;padding:10px 0 0;background:#fff}.profile_details .profile_view .divider{border-top:1px solid #e5e5e5;padding-top:5px;margin-top:5px}.profile_details .profile_view .ratings{margin-bottom:0}.profile_details .profile_view .bottom{background:#F2F5F7;padding:9px 0;border-top:1px solid #E6E9ED}.profile_details .profile_view .left{margin-top:20px}.profile_details .profile_view .left p{margin-bottom:3px}.profile_details .profile_view .right{margin-top:0px;padding:10px}.profile_details .profile_view .img-circle{border:1px solid #E6E9ED;padding:2px}.profile_details .profile_view h2{margin:5px 0}.profile_details .profile_view .ratings{text-align:left;font-size:16px}.profile_details .profile_view .brief{margin:0;font-weight:300}.profile_details .profile_left{background:white}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
           Users
        </h1>
        <ol class="breadcrumb">
            <li  class=""><a href="Admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="Users"><i class="fa fa-users"></i> Users</a></li>
        </ol>
        
    </section>
     
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="box box-danger collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"> List of Users (click here for table view.)</h3>
                        <div class="box-tools pull-right">
                            <button  onclick="add_person()"  class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add User</button>
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body"  >
                        <table id="datatable-users" class="table table-striped table-hover table-bordered dt-responsive  wrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th >Name</th>
                                    <th>User Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th >User Type</th>
                                    <th >Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                            <tfoot >
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>User Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>User Type</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

             
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-default">
                    <div class="box-body">
                    <div class="row">
                        <div id = "cont2">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            

        </div>

        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-success">
                       <h3 class="modal-title">Person Form</h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form" class="form-group">
                            <div class="form-body">
                                <div class="form-group has-error hidden">
                                    <label for="uaddid">User ID</label>
                                    <input type="text" class="form-control" id="uaddid" name="uaddid" placeholder="Enter User ID"/>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="uaddfname">Firstname</label>
                                            <input type="text" class="form-control" id="uaddfname" name="uaddfname" placeholder="Enter First Name"/>
                                            <span class="help-block"></span>
                                        </div>
                                       <div class="col-lg-4">
                                            <label for="uaddmname">Middlename</label>
                                            <input type="text" class="form-control" id="uaddmname"  name="uaddmname" placeholder="Enter Middle Name"/>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="uaddlname">Lastname</label>
                                            <input type="text" class="form-control" id="uaddlname"  name="uaddlname" placeholder="Enter Last Name"/>
                                            <span class="help-block"></span>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="uaddemail">Email</label>
                                    <input type="email" class="form-control" id="uaddemail" name="uaddemail" placeholder="Enter Email"/>
                                    <span class="help-block"></span>
                                </div>
                                

                                <div class="form-group input-group">
                                    <div class = "row">
                                        <div class="col-lg-6">
                                            <label for="uaddaddr">Address</label>
                                            <input class="form-control" id="uaddaddr"  name="uaddaddr"  placeholder= "Address Here"  type="text">
                                            <span class="help-block"></span>
                                        </div>
                                       
                                        <div class="col-lg-6">
                                            <label for="uaddcity">City, Province</label>
                                            <select id = "uaddcity" name="uaddcity" class="form-control">
                                                <option value=""></option>
                                                <?php foreach($cities as $cobject)
                                                   echo '<option value='.$cobject->city_id.'>'.$cobject->city_name.', '.$cobject->province_name.'</option>'

                                                ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="form-group has-error">
                                    <div class = "row">
                                        <div class="col-lg-6">
                                            <label for="uaddut">User Type</label>
                                           <select id = "uaddut" name="uaddut" class="form-control">
                                                <option value=""></option>
                                                <?php foreach($usertype as $uobject)
                                                    echo '<option value='.$uobject->usertype_id.'>'.$uobject->usertype_name.'</option>'
                                                ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                       
                                        <div class="col-lg-6">
                                            <label for="uaddstat">Status</label>
                                            <select id = "uaddstat" name="uaddstat" class="form-control">
                                                <option value=""></option>
                                                <option value="OK">OK</option>
                                                <option value="Suspended">Suspended</option>
                                                <option value="Fired">Fired</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>

                                       <input class="hidden" id="company"  name="company"  value="<?php echo $user_info->company_id; ?>" type="text"> 
                                    </div>
                                </div>
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

    </section>
</div>

<script type="text/javascript">  
    function DisplayU(){
        $("#cont2").empty();
        $.ajax({
            url : "<?php echo site_url('users/contacts/')?>" ,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                for(i=0; i<data.length;i++){
                    $('#cont2').append('<div class="col-lg-4 profile_details">        <div class="profile_view">              <div class="col-sm-12">              <h3 class="brief" ><i >'+data[i]['usertype_name']+' </i></h3>                <div class="left col-xs-7">                 <h2>'+data[i]['user_fname']+' '+data[i]['user_mname']+' '+data[i]['user_lname']+' </h2>     <p><strong><i class="fa fa-envelope"></i></strong>  '+data[i]['user_email']+' </p>                  <ul class="list-unstyled">            <li><i class="fa fa-phone"></i> Phone #: 0'+ data[i]['user_phone']+' </li>            <li><i class="fa fa-gavel"></i> Status:  ' +data[i]['user_status']+' </li>        <li><i class="fa fa-building"></i> Address:  ' +data[i]['user_address']+','+data[i]['city_name']+', '+data[i]['province_name']+' </li>    </ul>               </div>             <div class="right col-xs-5 text-center" > <img   style="width:100%;height:120px;" src="'+data[i]['user_photo']+'" alt="" class="img-circle img-responsive ">               </div>         </div>             <div class="col-xs-12 bottom text-center">             <div class="col-xs-12 col-sm-6 emphasis">     <a type="button" class="btn btn-primary btn-xs pull-left" onclick="edit_person('+"'"+data[i]['user_id']+"'"+')"><i class="fa fa-user"></i> Edit Profile</a>    </div>           <div class="col-xs-12 col-sm-6 emphasis">            <a type="button" class="btn btn-danger btn-xs pull-right" onclick="delete_person('+"'"+data[i]['user_id']+"'"+')"> <i class="fa fa-trash"> </i> Delete</a>      </div>       </div>     </div>  </div>');
                };
            }
        });
    };
</script>

<script type="text/javascript">
    var save_method; 
    var table; 
    
    $(document).ready(function(){

        $('#ua').attr("class","active");

        DisplayU();
        var handleDataTableButtons = function() {
            if ($("#datatable-users").length) {
                table = $("#datatable-users").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('users/ajax_list')?>",
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{extend: "copy",className: "btn-sm"},{extend: "csv",className: "btn-sm"},{extend: "excel",className: "btn-sm"},{extend: "pdfHtml5",className: "btn-sm"},{extend: "print",className: "btn-sm"},],
                    responsive: true
                });
            }
        };

        TableManageButtons = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons();
                }
            };
        }();

        TableManageButtons.init();

        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,  
        });

        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
    });


    function add_person(){
        save_method = 'add';
        $('#form')[0].reset();  
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Add new User'); 
    }

    function edit_person(id){

        save_method = 'update';
        $('#form')[0].reset();  
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $.ajax({
            url : "<?php echo site_url('users/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){

                $('[name="uaddid"]').val(data.user_id);
                $('[name="uaddfname"]').val(data.user_fname);
                $('[name="uaddlname"]').val(data.user_lname);
                $('[name="uaddmname"]').val(data.user_mname);
                $('[name="uaddaddr"]').val(data.user_address);
                $('[name="uaddemail"]').val(data.user_email);
                $('[name="uaddcity"]').val(data.city_id);
                $('[name="uaddut"]').val(data.usertype_id);
                $('[name="uaddstat"]').val(data.user_status);
                
                $('#modal_form').modal('show');  
                $('.modal-title').text('Edit User Information');  

            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function reload_table(){
        table.ajax.reload(null,false);  
    }

    function save(){
        $('#btnSave').text('saving...');  
        $('#btnSave').attr('disabled',true);  
        var url;

        if(save_method == 'add') {
            url = "<?php echo site_url('users/ajax_add')?>";
        } else {
            url = "<?php echo site_url('users/ajax_update')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                 
                if(data.status){
                    $('#modal_form').modal('hide');
                       if(save_method == 'add'){
                        DisplayU();
                        new PNotify({
                            title: 'Success!',
                            text: 'Information added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    else{
                        DisplayU();
                        new PNotify({
                            title: 'Success!',
                            text: 'Information updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    reload_table();
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
                $('#btnSave').text('save');  
                $('#btnSave').attr('disabled',false);  
            },
            error: function (jqXHR, textStatus, errorThrown) {
               new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            }
        });
    }

    function delete_person(id){
        if(confirm('Are you sure delete this data?')){
            $.ajax({
                url : "<?php echo site_url('users/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {                    
                    $('#modal_form').modal('hide');
                    DisplayU();
                    reload_table();
                     new PNotify({
                        title: 'Success',
                        text: 'Information deleted successfully.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
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
    }

</script>
 
