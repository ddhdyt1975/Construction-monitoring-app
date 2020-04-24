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
<div class="content-wrapper">
    <section class="content-header">
        <h1>
           Settings
        </h1>
        <ol class="breadcrumb">
            <li  class=""><a href="Admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="Settings"><i class="fa fa-gears"></i> Settings</a></li>
        </ol>
        
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class = "row">
                    <div class = "col-lg-12">
                        <div class="box">
                            <div class="box-header with-border">
                            <h3 class="box-title"> Company Details </h3>
                                <div class="box-tools pull-right">
                                     <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body"  style="overflow-x:auto;">
                                <table  id="datatable-materials-stock" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr >
                                            <th >Logo</th>
                                            <th>Company name</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr align="center" >
                                            <td onclick ="edit_company_photo()"> <img src="<?php echo $user_info->path; ?>" style = "height:100px;" /></td>
                                            <td onclick ="edit_company(<?php echo $user_info->company_id; ?>)"> <h2><b><?php echo $user_info->company_name; ?></b></h2></td>
                                        </tr>
                                    </tbody>
                                     
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class = "col-lg-6">
                        <div class="box collapsed-box">
                            <div class="box-header with-border">
                            <h3 class="box-title"> List of Tasks  </h3>
                                <div class="box-tools pull-right">
                                    <button  class="btn btn-flat btn-sm" data-toggle="tooltip" data-placement="left" title="Add new Task" onclick="add_task()" ><i class="fa fa-tasks"></i> Add Task</button>
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <table id="datatable-tasks" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Task Id</th>
                                            <th>Task Name</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                     
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class = "col-lg-6">
                        <div class="box collapsed-box">
                            <div class="box-header with-border">
                            <h3 class="box-title"> List of Units </h3>
                                <div class="box-tools pull-right">
                                    <button  class="btn btn-flat btn-sm" data-toggle="tooltip" data-placement="left" title="Add new unit" onclick="add_unit()" ><i class="fa fa-plus"></i> Add Unit</button>
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <table id="datatable-units" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Unit Id</th>
                                            <th>Unit Name</th>
                                            <th>Acronym</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                     
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class = "col-lg-6">
                        <div class="box collapsed-box">
                            <div class="box-header with-border">
                            <h3 class="box-title"> List of Project Groups </h3>
                                <div class="box-tools pull-right">
                                    <button  class="btn btn-flat btn-sm" data-toggle="tooltip" data-placement="left" title="Add new unit" onclick="add_group()" ><i class="fa fa-users"></i> Add Group</button>
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <table id="datatable-units" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Group Id</th>
                                            <th>Project</th>
                                            <th>Group Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                     
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>  

        <div class="modal fade" id="modal-task" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                       <h3 class="modal-title"> </h3>
                    </div>
                    <div class="modal-body">
                        <form  id="form-task" class="form-group">
                            <div class="form-body">
                                <div class="form-group has-error hidden">
                                    <label for="uaddid">User ID</label>
                                    <input type="text" class="form-control" id="taskid" name="taskid" placeholder="Enter User ID"/>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Task Name</label>
                                    <input type="text" class="form-control" id="taskname" name="taskname" placeholder="Enter Task Name"/>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label>Task Description</label>
                                    <textarea type"text" class = "form-control" id ="tskdec" name ="tskdec" placeholder = "Enter Task Description"></textarea>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" id="btnSaveT" onclick="savetask()" class="btn btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-unit" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                       <h3 class="modal-title"> </h3>
                    </div>
                    <div class="modal-body">
                        <form  id="form-unit" class="form-group">
                            <div class="form-body">
                                <div class="form-group has-error hidden">
                                    <label for=""></label>
                                    <input type="text" class="form-control" id="unitid" name="unitid" placeholder="Enter User ID"/>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Unit Name</label>
                                    <input type="text" class="form-control" id="unitname" name="unitname" placeholder="Enter new unit"/>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label>Unit Acronym</label>
                                    <input type"text" class = "form-control" id ="unitacro" name ="unitacro" placeholder = "Enter unit acronym"/>
                                    <span class="help-block"></span>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" id="btnSaveU" onclick="saveunit()" class="btn btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-comname" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                       <h3 class="modal-title"> </h3>
                    </div>
                    <div class="modal-body">
                        <form  id="form-comname" class="form-group">
                            <div class="form-body">
                                <div class="form-group hidden">
                                    <label for=""></label>
                                    <input type="text" class="form-control" id="comid" name="comid" placeholder="Enter User ID"/>
                               </div>
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" class="form-control" id="comname" name="comname"  />
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" id="btnSaveCN" onclick="saveCn()" class="btn btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="com_photo" role="dialog">
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
        
        <div class="modal fade" id="modal-group" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                       <h3 class="modal-title"> </h3>
                    </div>
                    <div class="modal-body">
                        <form  id="form-group" class="form-group">
                            <div class="form-body">
                                <div class="form-group has-error hidden">
                                    <label for=""></label>
                                    <input type="text" class="form-control" id="groupid" name="groupid" placeholder="Enter User ID"/>
                                    <span class="help-block"></span>
                                </div>

                                <div class = "form-group ">
                                    <label for="">Project</label>
                                    <select id = "prjselect"  class="form-control">
                                        <option></option>
                                         <?php foreach($projects as $each){ ?>
                                        <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                        <?php } ?>
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label>Group Name</label>
                                    <input type"text" class = "form-control" id ="groupdesc" name ="groupdesc"/>
                                    <span class="help-block"></span>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button  type="button" id="btnSaveU" onclick="saveunit()" class="btn btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </section>          
</div>

<script>
    var save_method;
    var tabletask;
    var tableunit;


    $(document).ready(function() {
        $('#sea').attr("class","active");
        var handleDataTableButtons = function() {
            
            if ($("#datatable-tasks").length) {
                tabletask = $("#datatable-tasks").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('Settings/tasks_lists')?>",
                        "type": "POST"
                    },
                    order: [[1, 'asc']],
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [ {
                            extend: "copy",
                            className: "btn-sm"
                        },{
                    extend: "csv",
                    className: "btn-sm"
                  },{
                            extend: "excel",
                            className: "btn-sm"
                        },{
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },{
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true,

                });
            }

            if ($("#datatable-units").length) {
                tableunit = $("#datatable-units").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('Settings/unit_lists')?>",
                        "type": "POST"
                    },
                    order: [[1, 'asc']],
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [ {
                            extend: "copy",
                            className: "btn-sm"
                        },{
                            extend: "excel",
                            className: "btn-sm"
                        },{
                    extend: "csv",
                    className: "btn-sm"
                  },{
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },{
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true,

                });
            }


           
        }

        
        TableManageButtons = function(){
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


//////////////////TASK//////////////////////////////////
    function reload_table_task(){
        tabletask.ajax.reload(null,false);  
    }
    
    function add_task(){
        save_method = 'addtask';
        $('#form-task')[0].reset();  
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal-task').modal('show'); 
        $('.modal-title').text('Add new Task'); 
    }

    function edit_task(taskid){
        save_method = 'updatetask';
        $('#form-task')[0].reset();  
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 

         $.ajax({
            url : "<?php echo site_url('Settings/gettask')?>/"+taskid,
            type: "GET",
            dataType: "JSON",
            success: function(data){

                $('[name="taskid"]').val(data.projtsk_id);
                $('[name="taskname"]').val(data.projtsk_name);
                $('[name="tskdec"]').val(data.projtsk_desc);
                $('#modal-task').modal('show'); 
                $('.modal-title').text('Edit Task'); 
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

    function savetask(){
        $('#btnSaveT').text('Saving...');  
        $('#btnSaveT').attr('disabled',true);  
        var url;

        if(save_method == 'addtask') {
            url = "<?php echo site_url('Settings/addtask')?>";
        } else {
            url = "<?php echo site_url('Settings/updatetask')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form-task').serialize(),
            dataType: "JSON",
            success: function(data){
                 
                if(data.status){
                    reload_table_task();
                    $('#modal-task').modal('hide');
                       if(save_method == 'addtask'){
                        new PNotify({
                            title: 'Status',
                            text: 'Task Added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    else{
                        new PNotify({
                            title: 'Status',
                            text: 'Task updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                    $('#btnSaveT').text('Save');  
                    $('#btnSaveT').attr('disabled',false);  
                }
                $('#btnSaveT').text('Save'); 
                $('#btnSaveT').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                $('#btnSaveT').text('Save'); 
                $('#btnSaveT').attr('disabled',false); 
            }
        });
    }

    function delete_task(taskid){
        if(confirm('Are you sure delete this Task?')){
             $.ajax({
                url : "<?php echo site_url('Settings/deletetask')?>/"+taskid,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    $('#modal-task').modal('hide');
                    reload_table_task();
                    new PNotify({
                        title: 'Success!',
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
//////////////////TASK//////////////////////////////////

//////////////////UNIT//////////////////////////////////
    function reload_table_unit(){
        tableunit.ajax.reload(null,false);  
    }
    
    function add_unit(){
        save_method = 'addunit';
        $('#form-unit')[0].reset();  
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal-unit').modal('show'); 
        $('.modal-title').text('Add new Unit'); 
    }

    function saveunit(){
        $('#btnSaveU').text('Saving...');  
        $('#btnSaveU').attr('disabled',true);  
        var url;

        if(save_method == 'addunit') {
            url = "<?php echo site_url('Settings/addunit')?>";
        } 
        else {
            url = "<?php echo site_url('Settings/updateunit')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form-unit').serialize(),
            dataType: "JSON",
            success: function(data){
                 
                if(data.status){
                    reload_table_unit();
                    $('#modal-unit').modal('hide');
                       if(save_method == 'addunit'){
                        new PNotify({
                            title: 'Success!',
                            text: 'Information added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    else{
                        new PNotify({
                            title: 'Success!',
                            text: 'Information updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                    $('#btnSaveU').text('Save');  
                    $('#btnSaveU').attr('disabled',false);  
                }
                $('#btnSaveU').text('Save'); 
                $('#btnSaveU').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });
                $('#btnSaveU').text('Save'); 
                $('#btnSaveU').attr('disabled',false); 
            }
        });
    }

    function edit_unit(uid){
        save_method = 'updateunit';
        $('#form-unit')[0].reset();  
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 

         $.ajax({
            url : "<?php echo site_url('Settings/getunit')?>/"+uid,
            type: "GET",
            dataType: "JSON",
            success: function(data){

                $('[name="unitid"]').val(data.unit_id);
                $('[name="unitname"]').val(data.unit_name);
                $('[name="unitacro"]').val(data.unit_acro);
                $('#modal-unit').modal('show'); 
                $('.modal-title').text('Edit unit'); 
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

    function delete_unit(taskid){
        if(confirm('Are you sure delete this unit?')){
            $.ajax({
                url : "<?php echo site_url('Settings/deleteunit')?>/"+taskid,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    $('#modal-unit').modal('hide');
                    reload_table_unit();
                    new PNotify({
                        title: 'Success!',
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
//////////////////UNIT//////////////////////////////////

//////////////////PHOTO/////////////////////////////////////////

    function edit_company(id){
        save_method = 'comname'; 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('[name="comid"]').val(<?php echo $user_info->company_id; ?>);
        $('[name="comname"]').val("<?php echo $user_info->company_name; ?>");
        $('#modal-comname').modal('show'); 
        $('.modal-title').text('Edit Company Name');    
    }

    function saveCn(){
        $('#btnSaveCN').text('Saving...');  
        $('#btnSaveCN').attr('disabled',true);  
      
        $.ajax({
            url : "<?php echo site_url('Settings/updatecomname')?>",
            type: "POST",
            data: $('#form-comname').serialize(),
            dataType: "JSON",
            success: function(data){
                 
                if(data.status){
                    $('#modal-comname').modal('hide'); 
                    new PNotify({
                        title: 'Success!',
                        text: 'Wait for the site to reload.',
                        type: 'success',
                        styling: 'bootstrap3'
                    }); 
                    window.location.reload();
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                    $('#btnSaveCN').text('Save');  
                    $('#btnSaveCN').attr('disabled',false);  
                }
                $('#btnSaveCN').text('Save'); 
                $('#btnSaveCN').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 
                 
                $('#btnSaveCN').text('Save'); 
                $('#btnSaveCN').attr('disabled',false); 
            }
        });
    }





    function edit_company_photo(){
        $('#upload_file')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#com_photo').modal('show');
        $('.modal-title').text('Change Company Photo');
    }

    function addPhoto(){
        $.ajaxFileUpload({
            url             :"<?php echo site_url('Settings/upload_file/')?>", 
            secureuri       :false,
            fileElementId   :'userfile',
            dataType: 'JSON',
            success : function (data){

            $('#add_photo').modal('hide'); 
                new PNotify({
                    title: 'Success!',
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




//////////////////PHOTO/////////////////////////////////////////



//////////////////GROUP//////////////////////////////////
    function reload_table_group(){
        tablegroup.ajax.reload(null,false);  
    }
    
    function add_group(){
        save_method = 'addgroup';
        $('#form-group')[0].reset();  
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal-group').modal('show'); 
        $('.modal-title').text('Add new Group'); 
    }

    function saveunit(){
        $('#btnSaveU').text('Saving...');  
        $('#btnSaveU').attr('disabled',true);  
        var url;

        if(save_method == 'addunit') {
            url = "<?php echo site_url('Settings/addunit')?>";
        } 
        else {
            url = "<?php echo site_url('Settings/updateunit')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form-unit').serialize(),
            dataType: "JSON",
            success: function(data){
                 
                if(data.status){
                    reload_table_unit();
                    $('#modal-unit').modal('hide');
                       if(save_method == 'addunit'){
                        new PNotify({
                            title: 'Success!',
                            text: 'Information added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    else{
                        new PNotify({
                            title: 'Success!',
                            text: 'Information updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                    $('#btnSaveU').text('Save');  
                    $('#btnSaveU').attr('disabled',false);  
                }
                $('#btnSaveU').text('Save'); 
                $('#btnSaveU').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });
                $('#btnSaveU').text('Save'); 
                $('#btnSaveU').attr('disabled',false); 
            }
        });
    }

    function edit_unit(uid){
        save_method = 'updateunit';
        $('#form-unit')[0].reset();  
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 

         $.ajax({
            url : "<?php echo site_url('Settings/getunit')?>/"+uid,
            type: "GET",
            dataType: "JSON",
            success: function(data){

                $('[name="unitid"]').val(data.unit_id);
                $('[name="unitname"]').val(data.unit_name);
                $('[name="unitacro"]').val(data.unit_acro);
                $('#modal-unit').modal('show'); 
                $('.modal-title').text('Edit unit'); 
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

    function delete_unit(taskid){
        if(confirm('Are you sure delete this unit?')){
            $.ajax({
                url : "<?php echo site_url('Settings/deleteunit')?>/"+taskid,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    $('#modal-unit').modal('hide');
                    reload_table_unit();
                    new PNotify({
                        title: 'Success!',
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
//////////////////GROUP//////////////////////////////////

</script>