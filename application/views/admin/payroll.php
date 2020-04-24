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
            Payroll Settings
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="Admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="Payroll"><i class="fa fa-gear"></i> Payroll Settubg</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box-body">  
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-plus"> </i> Additionals</a>
                            </li>
                            <li><a href="#deductions" data-toggle="tab"><i class="fa fa-minus"> </i> Deductions</a>
                            </li>                     
                            <li><a href="#emptype" data-toggle="tab"><i class="fa fa-user"> </i> Employee type</a>
                            </li>                     
                            <li><a href="#emplist" data-toggle="tab"><i class="fa fa-users"> </i> Employee List</a>
                            </li> 
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <br>
                                <div class="box box-info box-solid ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"> List of Additionals</h3>
                                    <div class="box-tools pull-right">
                                        <button  onclick="add_additional()"  class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Title</button>
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body"  >
                                    <table id="datatable-additionals" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                              <th>Title</th>
                                              <th>Note</th>
                                              <th>Date Created</th>
                                              <th>Date Updated</th>
                                              <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>Title</th>
                                              <th>Note</th>
                                              <th>Date Created</th>
                                              <th>Date Updated</th>
                                              <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                </div>
                            </div>
                         
                            <div class="tab-pane fade " id="deductions">                                            
                                <br>
                                <div class="box box-danger box-solid">
                                <div class="box-header">
                                    <h3 class="box-title"> List of Deductions</h3>
                                    <div class="box-tools pull-right">
                                        <button  onclick="add_deduction()"  class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Title</button>
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body"  >
                                    <table id="datatable-deductions" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                              <th>Title</th>
                                              <th>Note</th>
                                              <th>Date Created</th>
                                              <th>Date Updated</th>
                                              <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>Title</th>
                                              <th>Note</th>
                                              <th>Date Created</th>
                                              <th>Date Updated</th>
                                              <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                </div>
                            </div>

                            <div class="tab-pane fade " id="emptype">
                                <br>
                                <div class="box box-warning box-solid ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"> List of Employee type</h3>
                                    <div class="box-tools pull-right">
                                        <button  onclick="add_emp_type()"  class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Title</button>
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body"  >
                                    <table id="datatable-emptype" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                              <th>Description</th>
                                              <th>Salary</th>
                                              <th>Date Created</th>
                                              <th>Date Updated</th>
                                              <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>Description</th>
                                              <th>Salary</th>
                                              <th>Date Created</th>
                                              <th>Date Updated</th>
                                              <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade " id="emplist">
                                <br>
                                <div class="box box-success box-solid ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"> List of Employees</h3>
                                    <div class="box-tools pull-right">                                                    
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body"  >
                                    <table id="datatable-listemp" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Employee Address</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Created by</th>
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
            </div>
        </div>
    </section>
</div>
 
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-group">
                        <div class="form-group hidden">
                            <label for="supid">Additional/id no.</label>
                               <input type="text" class="form-control" id="addtype_id" name="addtype_id" placeholder="Additional/id no."/>
                                <span class="help-block"></span>
                        </div>                    
                        <div class="form-group">
                            <label for="prjcode">Title</label>
                                <input type="text" class="form-control" id="atitle" name="atitle" placeholder="Enter Title"/>
                            <span class="help-block"></span>                               
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Note</label>
                                <textarea class="form-control" rows="2" name="anote" id="anote" placeholder="Enter note"></textarea>
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

<div class="modal fade" id="modal_form1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form1" class="form-group">
                        <div class="form-group hidden">
                            <label for="supid">Deduction/id no.</label>
                               <input type="text" class="form-control" id="deductype_id" name="deductype_id" placeholder="Additional/id no."/>
                                <span class="help-block"></span>
                        </div>                    
                        <div class="form-group">
                            <label for="prjcode">Title</label>
                                <input type="text" class="form-control" id="dtitle" name="dtitle" placeholder="Enter Title"/>
                            <span class="help-block"></span>                               
                        </div>
                        <div class="form-group">
                            <label for="prjcode"> Type</label>
                                <select type=<select name="dtype" id="dtype" class="form-control">
                                    <option value=""></option>              
                                    <option value="DEDUCTION">Deduction</option>
                                    <option value="LOAN">Loan</option>
                                </select>
                            <span class="help-block"></span>                               
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Note</label>
                                <textarea class="form-control" rows="2" name="dnote" id="dnote" placeholder="Enter note"></textarea>
                            <span class="help-block"></span>                               
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save1()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form2" class="form-group">
                        <div class="form-group hidden">
                            <label for="supid">emptype_id/id no.</label>
                               <input type="text" class="form-control" id="emptype_id" name="emptype_id" placeholder="Emp Type Id/id no."/>
                                <span class="help-block"></span>
                        </div>                    
                        <div class="form-group">
                            <label for="prjcode">Description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description"/>
                            <span class="help-block"></span>                               
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary" min="1" step=".01">
                            <span class="help-block"></span>                               
                        </div>

                        <div class="form-group">
                            <label for="prjcode">Display AS:</label>
                                <input type="text" class="form-control" id="disemp" name="disemp" min="1" >
                            <span class="help-block"></span>                               
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save2()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_formdtr" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form id="formdtr" class="form-group">
                    <label >Project</label>
                    <div class = "form-group input-group">
                        <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                        <select id = "prjselect" name= "prjselect"  class="form-control" value="<?php echo date("yyy/mm/dd")?>">
                            <option></option>
                            <?php foreach($projects as $each){ ?>
                                <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                            <?php } ?>
                        </select>
                    </div>
                    
                    <label for="idTourDateDetails">Date</label>
                    <div class = "form-group input-group">
                        <input id="single_cal5" name="single_cal5"  class="date-picker form-control col-lg-4 col-xs-12 active"   type="text">
                        <span class="input-group-addon"><i class=" fa fa-calendar"></i></span>
                    </div>
              
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Time picker:</label>

                            <div class="input-group" data-date-format ="HH:mm" data-date-pickDate="false">
                                <input type="text" id="intime" name="intime" class="form-control timepicker" >

                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="adddtr()" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>


<script>

    var save_method;
    var table; 
    var table1;
    var table2;
    var table3;
    var eid;

    $(document).ready(function(){

        $('#single_cal5').datepicker({
            format: 'yyyy-mm-dd',
            changeMonth: true,
            changeYear: true,
            autoclose: true, 
            todayHighlight: true 
        });

       
        
        $('#ps').attr("class","active");
        var handleDataTableButtons = function() {
            if ($("#datatable-additionals").length) {
                table = $("#datatable-additionals").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('payroll/ajax_list')?>",
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
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

        var handleDataTableButtons1 = function() {
            if ($("#datatable-deductions").length) {
                table1 = $("#datatable-deductions").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('payroll/ajax_list1')?>",
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
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
                    responsive: true
                });
            }
        };

        TableManageButtons1 = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons1();
                }
            };
        }();
        TableManageButtons1.init();

        var handleDataTableButtons2 = function() {
            if ($("#datatable-emptype").length) {
                table2 = $("#datatable-emptype").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('payroll/ajax_list2')?>",
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
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
                    responsive: true
                });
            }
        };

        TableManageButtons2 = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons2();
                }
            };
        }();
        TableManageButtons2.init();

        var handleDataTableButtons3 = function() {
            if ($("#datatable-listemp").length) {
                table = $("#datatable-listemp").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('payroll/ajax_list3')?>",
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
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
                    responsive: true
                });
            }
        };

        TableManageButtons3 = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons3();
                }
            };
        }();
        TableManageButtons3.init();

    });

    function add_additional() {
        save_method = 'add';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Additionals new title');        
    }

    function add_deduction() {
        save_method = 'add';
        $('#form1')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form1').modal('show'); 
        $('.modal-title').text('Deductions new title');   
    }

    function add_emp_type() {
        save_method = 'add';
        $('#form2')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form2').modal('show'); 
        $('.modal-title').text('Create new Employee Type');        
    }

    function save2(){
        $('#btnSave').text('Saving...'); 
        $('#btnSave').attr('disabled',true);  
        var url;
    
        if(save_method == 'add') {
            url = "<?php echo site_url('payroll/ajax_add_emptype')?>";
        } else {
            url = "<?php echo site_url('payroll/ajax_update_emptype')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form2').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    if(save_method == 'add'){
                        new PNotify({
                            title: 'Success!',
                            text: 'Information added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }else{
                        new PNotify({
                            title: 'Success!',
                            text: 'Information updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    $('#modal_form2').modal('hide');
                    reload_table2();
                    //window.location.reload();
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });
    }

    function save1(){
        $('#btnSave').text('Saving...'); 
        $('#btnSave').attr('disabled',true);  
        var url;
    
        if(save_method == 'add') {
            url = "<?php echo site_url('payroll/ajax_add_deductions')?>";
        } else {
            url = "<?php echo site_url('payroll/ajax_update_deductions')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form1').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    if(save_method == 'add'){
                        new PNotify({
                            title: 'Success!',
                            text: 'Information added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }else{
                        new PNotify({
                            title: 'Success!',
                            text: 'Information updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    $('#modal_form1').modal('hide');
                    reload_table1();
                    //window.location.reload();
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });
    }

    function save(){
        $('#btnSave').text('Saving...'); 
        $('#btnSave').attr('disabled',true);  
        var url;
    
        if(save_method == 'add') {
            url = "<?php echo site_url('payroll/ajax_add_additionals')?>";
        } else {
            url = "<?php echo site_url('payroll/ajax_update_additionals')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    if(save_method == 'add'){
                        new PNotify({
                            title: 'Success!',
                            text: 'Information added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }else{
                        new PNotify({
                            title: 'Success!',
                            text: 'Information updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    $('#modal_form').modal('hide');
                    reload_table();
                    //window.location.reload();
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });
    }

    function edit_additional(id){
        save_method = 'update';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error');  
        $('.help-block').empty(); 
        $.ajax({
            url : "<?php echo site_url('payroll/ajax_edit/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="addtype_id"]').val(data.additionaltype_id);
                $('[name="atitle"]').val(data.description);
                $('[name="anote"]').val(data.note);                
               
                $('#modal_form').modal('show'); 
                $('.modal-title').text('Edit Additional title'); 
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

    function edit_deduction(id){
        save_method = 'update';
        $('#form1')[0].reset(); 
        $('.form-group').removeClass('has-error');  
        $('.help-block').empty(); 
        $.ajax({
            url : "<?php echo site_url('payroll/ajax_edit1/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="deductype_id"]').val(data.deductiontype_id);
                $('[name="dtitle"]').val(data.description);
                $('[name="dnote"]').val(data.note);   
                $('[name="dtype"]').val(data.dtype);                
               
                $('#modal_form1').modal('show'); 
                $('.modal-title').text('Edit Deduction title'); 
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

    function edit_emptype(id){
        save_method = 'update';
        $('#form2')[0].reset(); 
        $('.form-group').removeClass('has-error');  
        $('.help-block').empty(); 
        $.ajax({
            url : "<?php echo site_url('payroll/ajax_edit2/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="emptype_id"]').val(data.emptype_id);
                $('[name="description"]').val(data.description);
                $('[name="salary"]').val(data.salary);     
                $('[name="disemp"]').val(data.alias);                
               
                $('#modal_form2').modal('show'); 
                $('.modal-title').text('Edit Employee type'); 
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

    function delete_additional(id){
        if(confirm('Are you sure delete this data?')){
            $.ajax({
                url : "<?php echo site_url('payroll/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    $('#modal_form').modal('hide');
                    reload_table();
                    new PNotify({
                        title: 'Success!',
                        text: 'information deleted successfully.',
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

    function delete_deduction(id){
        if(confirm('Are you sure delete this data?')){
            $.ajax({
                url : "<?php echo site_url('payroll/ajax_delete1')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    $('#modal_form1').modal('hide');
                    reload_table1();
                    new PNotify({
                        title: 'Success!',
                        text: 'information deleted successfully.',
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

    function delete_emptype(id){
        if(confirm('Are you sure delete this data?')){
            $.ajax({
                url : "<?php echo site_url('payroll/ajax_delete2')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    $('#modal_form2').modal('hide');
                    reload_table2();
                    new PNotify({
                        title: 'Success!',
                        text: 'information deleted successfully.',
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

    function reload_table(){
        table.ajax.reload(null,false);  
    }

    function reload_table1(){
        table1.ajax.reload(null,false);  
    }
    
    function reload_table2(){
        table2.ajax.reload(null,false);  
    }

    function dtradj(id){
        eid=id;
        $('#formdtr')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_formdtr').modal('show'); 
        $('.modal-title').text('Adjust Employee DTR');        
    }

    function adddtr(){
        $.ajax({
            url : "<?php echo site_url('Payroll/adjust/')?>" + eid,
            type: "POST",
            data: $('#formdtr').serialize(),
            dataType: "JSON",
            success: function(data){
                
            },
            error: function (jqXHR, textStatus, errorThrown){
              
 
            }
        });
        $('#modal_formdtr').modal('hide'); 
    }



</script>