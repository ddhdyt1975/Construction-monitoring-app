<?php
     $logged_in = $this->session->userdata['logged_in']['user_id']; 
     $position = $this->session->userdata['logged_in']['position'];

    if(empty($logged_in))    {
        $this->session->set_flashdata('error', 'Session has Expired');
        redirect('auth');
    } 
    if($position == 'hr') {
        redirect('HumanR');
    }else if($position == 'ut1') {
        redirect('Admin');
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
            Attendance
            <small>(assign worker to projects)</small>
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="ManagerM"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="AttendancesM"><i class="fa fa-edit"></i> Attendance</a></li>
        </ol>
    </section>
    
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="box-body with-border">  
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-users"></i> Workers</a>
                    </li>
                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus"></i> Add Worker</a>
                    </li>
                     <li><a href="#settings" data-toggle="tab">Add Worker type</a>
                    </li>
                    <li><a href="#settings2" data-toggle="tab">View List</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <br>
                        <div class="dataTable_wrapper">
                            <table id="attendance_worker"  class="table table-striped table-bordered "  style="border:1px solid;" >
                                <thead>
                                    <tr>
                                        <th> Name</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                 
                    <div class="tab-pane fade well" id="profile">
                     
                        <form   id="form_worker" class="form-group">
                            <div class="form-body">
                                <div class="form-group  hidden">
                                    <label for="workid">User ID</label>
                                    <input type="text" class="form-control" id="workid" name="workid" placeholder="Enter User ID"/>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label for="workproject"> Add new Worker</label>  
                                </div>  

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="workfname">Firstname</label>
                                            <input type="text" class="form-control" id="workfname" name="workfname" placeholder="-Enter First Name-"/>
                                            <span class="help-block"></span>
                                        </div>
                                       <div class="col-lg-4">
                                            <label for="workmname">Middlename</label>
                                            <input type="text" class="form-control" id="workmname"  name="workmname" placeholder="-Enter Middle Name-"/>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="worklname">Lastname</label>
                                            <input type="text" class="form-control" id="worklname"  name="worklname" placeholder="-Enter Last Name-"/>
                                            <span class="help-block"></span>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class = "row">
                                        <div class="col-lg-6">
                                            <label for="workaddr">Address</label>
                                            <input class="form-control" id="workaddr"  name="workaddr"  placeholder= "-Address Here-"  type="text">
                                            <span class="help-block"></span>
                                        </div>
                                       
                                        <div class="col-lg-6">
                                            <label for="workcity">City, Province</label>
                                            <select id = "workcity" name="workcity" class="form-control">
                                                <option value="" disabled selected>-Select City, Province-</option>
                                                <?php foreach($cities as $cobject)
                                                   echo '<option value='.$cobject->city_id.'>'.$cobject->city_name.', '.$cobject->province_name.'</option>'
                                                ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class = "row">
                                        <div class="col-lg-6">
                                            <label for="workstat">Civil Status</label>
                                            <select id = "workstat" name="workstat" class="form-control">
                                                <option val="" disabled selected>-Select Civil Status-</option>
                                                <option value = "Married">Married</option>
                                                <option value = "Widowed">Widowed</option>
                                                <option value = "Separated">Separated</option>
                                                <option value = "Divorced">Divorced</option>
                                                <option value = "Single">Single</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                       
                                        <div class="col-lg-6">
                                            <label for="workgender">Gender</label>
                                            <select id = "workgender" name="workgender" class="form-control">
                                                <option val="" disabled selected>-Select Gender-</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </form>
                        <div align="center">
                            <button type="button" id="btnSavewrk" onclick="saveworker();" class="btn btn-primary btn-block">Add</button>
                         </div>
                    </div>
                    
                  
                    <div class="tab-pane fade" id="settings">
                        <br>
                        <form action="#" id="form_worktype" class="form-group">
                            <div class="form-group hidden">
                                <label for="wtid">Material Serial/id no.</label>
                                    <input type="text" class="form-control" id="matid" name = "matid" placeholder="Enter Material Serial/id no."/>
                                 <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="wtname">Worker Type Name</label>
                                <input type="text" class="form-control" id="wtname" name="wtname" placeholder="Enter Worker Type Name"/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="wtsal">Salary per Day</label> 
                                <input type="number" class="form-control" id="wtsal" name="wtsal" placeholder="Salary"/>
                            </div>
                        </form>
                        <div align="right">
                            <button type="button" id="btnSavewt" onclick="savewt()" class="btn btn-primary btn-block">Add</button>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="settings2">
                        <div class="row" >       
                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-5 ">
                            <br>
                                <div class = "form-group input-group">
                                    <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                                    <select id = "prjselectw"  class="form-control">
                                        <option val="" disabled selected>-Select Project-</option>
                                        <?php foreach($projects as $each){ ?>
                                            <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-4 " >
                            <br>
                                <div class = "form-group input-group">
                                    <span class="input-group-addon"><i class=" fa fa-calendar"></i></span>
                                    <input type="text" name="tskdate" id="tskdate"  value="<?php echo date('m/d/Y'); ?>" class="form-control clsDatePicker">
                                </div>
                            </div>
                            <div  class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                            <br>
                                <div class="form-group">
                                    <button class = "btn btn-danger form-control" onclick="viewList2()">Display</button>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                       
                            <div class="dataTable_wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                <table id="attendance_worker_list"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                                    <thead>
                                        <tr>
                                            <th> Name</th>
                                            <th> Position</th>
                                            <th> Actions</th>
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
        
        <div class="col-lg-5" id = "worker_profile">  
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
</div>

<script> 
    $(document).ready(function(){
        viewList();

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
</script>

<script>
    var projectSelected
    var table_worker;
    var save_method;
    var table_worker_list;
    var date;

    $('#prjselectw').change(function() {
        projectSelected = $(this).val();
        //alert(projectSelected);
    });

    $('#tskdate').change(function() {
        date = $(this).val();
        //alert(date);
    });

    function addworkertype(){
        save_method = 'addwt';
        $('#form_worktype')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form_worktype').modal('show'); 
        $('.modal-title').text('Add new Work Type'); 
    }
    
    function addworker (){
        save_method = 'addwrk';
        $('#form_worker')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form_worker').modal('show'); 
        $('.modal-title').text('Add new Worker'); 
    }

    function savewt(){
        $('#btnSavewt').text('Saving...'); 
        $('#btnSavewt').attr('disabled',true); 
        var url;

        url = "<?php echo site_url('AttendancesM/ajax_add_wt')?>";
        

          $.ajax({
            url : url,
            type: "POST",
            data: $('#form_worktype').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modal_form_worktype').modal('hide');
                    if(save_method == 'addwt'){
                        $('#alert_modal').modal('show');  
                        $("#myDialogText").text("Worktype is Added successfully.");
                    }else{
                        $('#alert_modal').modal('show');  
                        $("#myDialogText").text("Worktype is updated successfully.");
                    }
                     
                    reload_table();
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
            
            $('#btnSavewt').text('Save'); 
            $('#btnSavewt').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                if(save_method == 'addwt'){
                    $('#alert_modal').modal('show');  
                    $("#myDialogText").text("Error adding Worktype.");
                }else{
                     $('#alert_modal').modal('show');  
                    $("#myDialogText").text("Error updating Worktype.");
                }
                $('#btnSavewt').text('save'); 
                $('#btnSavewt').attr('disabled',false); 

            }
        });
    }

    function saveworker(){
        $('#btnSavewrk').text('Saving...'); 
        $('#btnSavewrk').attr('disabled',true); 
        var url;

        
        url = "<?php echo site_url('AttendancesM/ajax_add_worker')?>";
         

          $.ajax({
            url : url,
            type: "POST",
            data: $('#form_worker').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modal_form_worker').modal('hide');
                    if(save_method != 'addwrk'){
                        $('#alert_modal').modal('show');  
                        $("#myDialogText").text("Worker is added to database successfully.");
                    }else{
                        $('#alert_modal').modal('show');  
                        $("#myDialogText").text("Worker is updated in the database successfully.");
                    }
                    $('#workfname').val('');
                    $('#workmname').val('');
                    $('#worklname').val('');
                    $('#workaddr').val('');
                    $('#workcity').val('');
                    $('#workgender').val('');
                    $('#workstat').val('');
                     reload_table();
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
            
            $('#btnSavewrk').text('Save'); 
            $('#btnSavewrk').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                if(save_method != 'addwrk'){
                    $('#alert_modal').modal('show');  
                    $("#myDialogText").text("Error adding Worker.");
                }else{
                     $('#alert_modal').modal('show');  
                    $("#myDialogText").text("Error updating Worker.");
                }
                $('#btnSavewrk').text('save'); 
                $('#btnSavewrk').attr('disabled',false); 

            }
        });
    }

    function saveWorkImage(id){
        $.ajaxFileUpload({
                url             :"<?php echo site_url('AttendancesM/upload_workimage/')?>"+ id, 
                secureuri       :false,
                fileElementId   :'workfile',
                dataType: 'JSON',
                success : function (data){
                      
                }
        });
        updateworker(id);
    }

    function updateworker(id){
        $('#btnupdatewrk').text('Saving...'); 
        $('#btnupdatewrk').attr('disabled',true); 
        var url;

        //alert($('#form_updateworker').serialize());
        url = "<?php echo site_url('AttendancesM/ajax_update_worker/')?>"+id;
         

          $.ajax({
            url : url,
            type: "POST",
            data: $('#form_updateworker').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modal_form_worker').modal('hide');
                    
                        $('#alert_modal').modal('show');  
                        $("#myDialogText").text("Worker is updated in the database successfully.");
                   
                    reload_table();
                    viewWorker(id); 
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
            
            $('#btnupdatewrk').text('Update'); 
            $('#btnupdatewrk').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                
                     $('#alert_modal').modal('show');  
                    $("#myDialogText").text("Error updating Worker.");
           
                $('#btnupdatewrk').text('Update'); 
                $('#btnupdatewrk').attr('disabled',false); 

            }
        });
    }
    
    function viewList(){
        $("#attendance_worker").dataTable().fnDestroy();
     
        table_worker = $('#attendance_worker').DataTable({ 
        ajax: {
                "url": "<?php echo site_url('AttendancesM/ajax_list_work')?>",
                "type": "POST"
            },
            responsive: true
        });
    }

    function viewList2(){
        $("#attendance_worker_list").dataTable().fnDestroy();

        table_worker_list = $('#attendance_worker_list').DataTable({ 
        ajax: {
                "url": "<?php echo site_url('AttendancesM/ajax_list_work2')?>/"+projectSelected+'/'+$('#tskdate').val(),
                "type": "POST"
            },
            responsive: true
        });
    }

    function viewWorker(id){
        $('#worker_profile').empty();
        $.ajax({
            url : "<?php echo site_url('AttendancesM/getworker')?>/" + id,
            type: "POST",
            data: $('#form_worker').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.length>0){
                    $('#worker_profile').append('<div style="border:green  solid 1px;" class="box box-green">'+
                        '<div class="box-heading" align="center">'+
                            'Information'+
                        '</div>'+
                        '<div class="box-body green">'+
                            '<ul class="nav nav-tabs">'+
                                '<li class="active"><a href="#home-pills" data-toggle="tab">Designation</a>'+
                                '</li>'+
                                '<li><a href="#profile-pills" data-toggle="tab">Profile/Edit</a>'+
                                '</li>'+
                                '<li><a href="#messages-pills" data-toggle="tab">Payment</a>'+
                                '</li>'+
                                '<li><a href="#settings-pills" data-toggle="tab">Record</a>'+
                                '</li>'+
                            '</ul>'+

                            '<div class="tab-content">'+    
                                '<div class="tab-pane fade in active" id="home-pills">'+
                                    '<div class="row" >'+
                                        '<div  class="col-lg-12 col-md-12 " align="center">'+  
                                            '<img class = "btn-circle btn-xl" src="'+data[0]['worker_photo']+'" onclick="saveWorkImage("'+data[0]['pworker_id']+'") style = "width:50%;height:auto;"  />'+
                                            '<br>'+
                                            '<p><b> Name: '+data[0]['pworker_fname']+' '+data[0]['pworker_lname']+' </b></p> '+
                                        '</div>'+
                                        '<form id="desig_form" class="form-group">'+
                                            
                                                '<div  class="col-lg-6 col-md-6 " align="left">'+
                                                    '<div class="form-group">'+
                                                        '<label for="tskdate2">Assign Date</label>'+
                                                        '<input type="text" name="tskdate2" id="tskdate2"  value="<?php echo date('m/d/Y'); ?>" class="form-control clsDatePicker" />'+   
                                                    '</div>'+

                                                    '<div class="form-group">'+
                                                        '<label>Status</label>'+
                                                        '<select class="form-control" name="dstatus" id="dstatus">'+
                                                        '<option val=""></option>'+
                                                            '<option value="Present">Present</option>'+
                                                            '<option value="Late">Late</option>'+
                                                            '<option value="Absent">Absent</option>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                
                                                '<div  class="col-lg-6 col-md-6 " align="left">'+
                                                    '<div class="form-group">'+
                                                        '<label>Project</label>'+
                                                        '<select class="form-control" id ="dproj" name ="dproj">'+
                                                           '<option val=""></option>'+
                                                            '<?php foreach($projects as $each){ ?>'+
                                                            '<option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>;'+
                                                            '<?php } ?>'+
                                                        '</select>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<label>Position</label>'+
                                                        '<select class="form-control" name ="dpos" id = "dpos">'+
                                                            '<option val=""></option>'+
                                                            '<?php foreach($worktype as $each){ ?>'+
                                                            '<option value="<?php echo $each->worker_type_id; ?>"><?php echo $each->woker_type_desc; ?></option>;'+
                                                            '<?php } ?>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</form>'+
                                     
                                    
                                        '<button type="button" id="btnSavewrk" onclick="desig('+data[0]['pworker_id']+');" class="form-control btn btn-success ">Assign Now!</button>'+
                                    
                                '</div>'+
                                
                                '<div class="tab-pane fade" id="profile-pills">'+
                                    '<div class="row" >'+   
                                        '<br><div class="col-lg-7" align="left"> '+
                                           '<p><b> Worker Id: '+data[0]['pworker_id']+'</b></p> '+
                                            '<img class = "btn-circle btn-xl" src="'+data[0]['worker_photo']+'" style = "width:100%;height:auto;"  />'+
                                            '</div><div class="col-lg-5" >'+
                                                '<label><small>Cick to Change Image</label>'+
                                                '<input type="file" name="workfile" class="file from-control" id="workfile"></small>'+
                                            '</div>'+
                                        '</div><div class="row" >'+
                                        '<div  class="col-lg-12 col-md-6 ">'+
                                        '<form id="form_updateworker" class="form-group">'+
                                            '<br>'+
                                            '<small>'+
                                                '<div class="form-group">'+
                                                    '<div class="row">'+
                                                        '<div class="col-lg-4">'+
                                                            '<label for="workfname">Firstname</label>'+
                                                            '<input type="text" class="form-control" id="workfname2" name="workfname2" value="'+data[0]['pworker_fname']+'"/>'+
                                                            '<span class="help-block"></span>'+
                                                        '</div>'+
                                                       '<div class="col-lg-4">'+
                                                            '<label for="workmname">Middlename</label>'+
                                                            '<input type="text" class="form-control" id="workmname2"  name="workmname2" value="'+data[0]['pworker_mname']+'"/>'+
                                                            '<span class="help-block"></span>'+
                                                        '</div>'+
                                                        '<div class="col-lg-4">'+
                                                            '<label for="worklname">Lastname</label>'+
                                                            '<input type="text" class="form-control" id="worklname2"  name="worklname2" value="'+data[0]['pworker_lname']+'"/>'+
                                                            '<span class="help-block"></span>'+
                                                        '</div>'+

                                                    '</div>'+
                                                '</div>'+

                                                '<div class="form-group">'+
                                                    '<div class = "row">'+
                                                        '<div class="col-lg-6">'+
                                                            '<label for="pworker_add2">Address</label>'+
                                                            '<input class="form-control" id="workaddr2"  name="workaddr2" value="'+data[0]['pworker_add']+'"  type="text">'+
                                                            '<span class="help-block"></span>'+
                                                        '</div>'+
                                                       
                                                        '<div class="col-lg-6">'+
                                                            '<label for="workcity">City, Province</label>'+
                                                             '<select class="form-control" id ="workcity2" name="workcity2">'+
                                                                '<option value="'+data[0]['city_id']+'" >'+data[0]['city_name']+', '+data[0]['province_name']+'</option>;'+
                                                                '<?php foreach($cities as $each){ ?>'+
                                                                    '<option value="<?php echo $each->city_id; ?>"><?php echo $each->city_name.', '.$each->province_name?></option>;'+
                                                                '<?php } ?>'+
                                                            '</select> </b></p>'+
                                                            '<span class="help-block"></span>'+
                                                        '</div>'+
                                                       
                                                    '</div>'+
                                                '</div>'+

                                                '<div class="form-group">'+
                                                    '<div class = "row">'+
                                                        '<div class="col-lg-6">'+
                                                            '<label for="workstat">Civil Status</label>'+
                                                            '<select id = "workstat2" name="workstat2" class="form-control">'+
                                                                '<option val="'+data[0]['civil_status']+'" >'+data[0]['civil_status']+'</option>'+
                                                                '<option value = "Married">Married</option>'+
                                                                '<option value = "Widowed">Widowed</option>'+
                                                                '<option value = "Separated">Separated</option>'+
                                                                '<option value = "Divorced">Divorced</option>'+
                                                                '<option value = "Single">Single</option>'+
                                                            '</select>'+
                                                            '<span class="help-block"></span>'+
                                                        '</div>'+
                                                       
                                                        '<div class="col-lg-6">'+
                                                            '<label for="workgender">Gender</label>'+
                                                            '<select id = "workgender2" name="workgender2" class="form-control">'+
                                                                '<option val="'+data[0]['pworker_gender']+'">'+data[0]['pworker_gender']+'</option>'+
                                                                 '<option value="Male">Male</option>'+
                                                                '<option value="Female">Female</option>'+
                                                            '</select>'+
                                                            '<span class="help-block"></span>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</small>'+
                                        '</form>'+
                                        '<button id= "btnupdatewrk" class="btn btn-block btn-success" onclick = saveWorkImage("'+data[0]['pworker_id']+'"); >Update</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="tab-pane fade" id="messages-pills">'+
                                    '<h4>Status</h4>'+
                                    '<p>On the process.</p>'+
                                '</div>'+
                                '<div class="tab-pane fade" id="settings-pills">'+
                                    '<h4>Settings Tab</h4>'+
                                    '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }

    function desig(id){
        if (($('#dproj').val()!="")&&($('#dstatus').val()!="")&&($('#dpos').val()!="")) {       
            $.ajax({
                url : "<?php echo site_url('AttendancesM/designate')?>/" + id +"/"+$('#tskdate2').val(),
                type: "POST",
                data: $('#desig_form').serialize(),
                dataType: "JSON",
                success: function(data){
                    $('#alert_modal').modal('show');  
                    $("#myDialogText").text("Worker is assigned successfully.");
                },
                error: function (jqXHR, textStatus, errorThrown){
                    $('#alert_modal').modal('show');  
                    $("#myDialogText").text("Error. Check if user is already Assigned");
                }
            });
        }
        else{
            $('#alert_modal').modal('show');  
            $("#myDialogText").text("Error. Please check the credentials");
        }
    }

    function reload_table(){
        table_worker.ajax.reload(null,false);
        table_worker_list.ajax.reload(null,false);
    }
</script>