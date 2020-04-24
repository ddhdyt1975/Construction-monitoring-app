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
    <section class="content-header">
        <h1>
            Employee
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="HumanR"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="HumanE"><i class="fa fa-users"></i> Employee</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box-body">  
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-user"> </i> Employee List</a></li>
                            <li><a href="#deductions" data-toggle="tab"><i class="fa fa-users"> </i> Project Groups</a></li>                     
                            <li><a href="#empyty" data-toggle="tab"><i class="fa fa-users"> </i> Employee Type</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Employee List<small></small></h3>
                                        <div class="pull-right box-tools">
                                            <button  onclick="add_employee()"  class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Employee</button>
                                            <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        </div> 
                                    </div>
                                    <div class="box-body">
                                        <table id="datatable-hr-employee" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Employee ID</th>
                                                    <th>Employee Name</th>
                                                    <!-- <th>Employee Address</th> -->
                                                    <th>Position</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                  <th>Employee ID</th>
                                                    <th>Employee Name</th>
                                                    <!-- <th>Employee Address</th> -->
                                                    <th>Position</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade in " id="deductions">
                                <div class="box box-info">
                                        <div class="box-header">
                                        <h3 class="box-title">Project Groups<small></small></h3>
                                        <div class="pull-right box-tools">
                                            <button  onclick="add_employee()"  class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Employee</button>
                                            <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        </div> 
                                    </div>
                                    <div class="box-body">
                                        <table id="datatable-hr-employee" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Employee ID</th>
                                                    <th>Employee Name</th>
                                                    <!-- <th>Employee Address</th> -->
                                                    <th>Position</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                  <th>Employee ID</th>
                                                    <th>Employee Name</th>
                                                    <!-- <th>Employee Address</th> -->
                                                    <th>Position</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade in " id="empyty">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- modals -->
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

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                    <label for="supid">Employee Picture</label>
                                    <output id="list"></output>
                                    <div class="upimage">
                                    <input class="form-control" required type="file" id="file" name="file"/>      
                                    </div>                                
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="supid">Worker_id/Id no.</label>
                            <input type="text" class="form-control" id="worker_id" name="worker_id" placeholder="Emp Type Id/id no."/>
                            <span class="help-block"></span>
                        </div>                    
                        <div class="row">                        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="prjcode">First Name</label>
                                        <input type="text" class="form-control" id="efname" name="efname" placeholder="Enter First name"/>
                                    <span class="help-block"></span>                               
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="prjcode">Middle Name</label>
                                        <input type="text" class="form-control" id="emname" name="emname" placeholder="Enter Middle name"/>
                                    <span class="help-block"></span>                               
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="prjcode">Last Name</label>
                                        <input type="text" class="form-control" id="elname" name="elname" placeholder="Enter Last name"/>
                                    <span class="help-block"></span>                               
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">Address</label>
                                    <input type="text" class="form-control" id="eaddress" name="eaddress" placeholder="Enter Address"/>
                                <span class="help-block"></span>                               
                                </div>                        
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">City</label>
                                   <select id = "ecity" name="ecity" class="form-control">
                                                <option value="999">TBA</option>
                                                <?php foreach($cities as $cobject)
                                                   echo '<option value='.$cobject->city_id.'>'.$cobject->city_name.', '.$cobject->province_name.'</option>'

                                                ?>
                                    </select>
                                <span class="help-block"></span>                               
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">Gender</label>
                                    <select id="egender" name="egender" class="form-control">
                                        <option value=""></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                <span class="help-block"></span>                               
                                </div>                        
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">Civil Status</label>
                                    <select id="ecivilstat" name="ecivilstat" class="form-control">
                                        <option value=""></option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                    </select>                          
                                <span class="help-block"></span>                               
                                </div>
                            </div>
                        </div>
                        <div class="row">                         
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="idTourDateDetails">Birthdate:</label>
                                    <input  id = "ebdate"  name= "ebdate" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">Phone number</label>
                                    <input type="text" class="form-control" id="ephone" name="ephone" placeholder="Enter Contact number"/>
                                <span class="help-block"></span>                               
                                </div>                        
                            </div>
                        </div>
                      <!--   <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="prjcode">Height</label>
                                        <input type="text" class="form-control" id="eheight" name="eheight" placeholder="Enter Height Ex.(167cm)"/>
                                    <span class="help-block"></span>                               
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="prjcode">Weight</label>
                                        <input type="text" class="form-control" id="eweight" name="eweight" placeholder="Enter Weight Ex.(57kg)"/>
                                    <span class="help-block"></span>                               
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="prjcode">Blood type</label>
                                        <input type="text" class="form-control" id="eblood" name="eblood" placeholder="Enter Blood type"/>
                                    <span class="help-block"></span>                               
                                    </div>
                                </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">SSS number</label>
                                    <input type="text" class="form-control" id="esss" name="esss" placeholder="Enter SSS ID number"/>
                                <span class="help-block"></span>                               
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">Phil-health number</label>
                                    <input type="text" class="form-control" id="ephil" name="ephil" placeholder="Enter Phil-health number"/>
                                <span class="help-block"></span>                               
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">Pag-ibig number</label>
                                    <input type="text" class="form-control" id="epagibig" name="epagibig" placeholder="Enter Pag-ibig number"/>
                                <span class="help-block"></span>                               
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">Bank number</label>
                                    <input type="text" class="form-control" id="ebanknum" name="ebanknum" placeholder="Enter Bank number"/>
                                <span class="help-block"></span>                               
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">TIN number</label>
                                    <input type="text" class="form-control" id="etin" name="etin" placeholder="Enter TIN number"/>
                                <span class="help-block"></span>                               
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="prjcode">Tax code</label>
                                    <input type="text" class="form-control" id="etax" name="etax" placeholder="Enter Tax code"/>
                                <span class="help-block"></span>                               
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="prjcode">Position</label>
                                <select id = "eposition" name="eposition" class="form-control">
                                    <option value=""></option>
                                    <?php foreach($positions as $pos)
                                    echo '<option value='.$pos->emptype_id.'>'.$pos->alias.'    ('.($pos->salary*8).')</option>'
                                    ?>
                                </select>
                                <span class="help-block"></span>                               
                            </div>
                            <div class="col-md-6">
                                <label for="prjcode">Employment Status</label>
                                <select id = "estatus" name="estatus" class="form-control">
                                    <option value="Regular">Regular</option>
                                    <option value="Casual">Casual</option>
                                    <option value="Probation">Probation</option>
                                    <option value="Expelled">Expelled</option>
                                </select>
                                <span class="help-block"></span>                               
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


<script type="text/javascript">
    var table;
    var table2;
    
    $(document).ready(function() {

        $('#single_cal5').datepicker({
            format: 'yyyy-mm-dd',
            changeMonth: true,
            changeYear: true,
            autoclose: true, 
            todayHighlight: true 
        });
        
        $('#emlist').attr("class","treeview active");
        $('#hemp').attr("class","active");
        
       $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,  
        });

        var handleDataTableButtons = function() {
            if ($("#datatable-hr-employee").length) {
                table = $("#datatable-hr-employee").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('HumanE/ajax_list')?>",
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
    });

    function add_employee() {
        save_method = 'add';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Add new employee');        
    }

    function handleFileSelect(evt) {
    $("#list").html("");
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.#
      reader.readAsDataURL(f);
    }    
    }

    document.getElementById('file').addEventListener('change', handleFileSelect, false);

    function save(){
        $('#btnSave').text('Saving...'); 
        $('#btnSave').attr('disabled',true);  
        var url;
        var formData = new FormData($("#form")[0]); 
        formData.append('file', file);
    
        if(save_method == 'add') {
            url = "<?php echo site_url('HumanE/ajax_add_employee')?>";
        } else {
            url = "<?php echo site_url('HumanE/ajax_update_employee')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
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

    function edit_emp(id){        
        save_method = 'update';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error');  
        $('.help-block').empty(); 
        $.ajax({
            url : "<?php echo site_url('HumanE/ajax_edit/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){     
                $("#list").html("");        
                var output_list = document.getElementById('list');
                var img_elem = document.createElement("img");
                img_elem.classList.add("thumb");
                img_elem.src = data.worker_photo;
                output_list.appendChild(img_elem);

                $('[name="worker_id"]').val(id);
                $('[name="efname"]').val(data.pworker_fname);
                $('[name="emname"]').val(data.pworker_mname);  
                $('[name="elname"]').val(data.pworker_lname);  
                $('[name="eaddress"]').val(data.pworker_add);  
                $('[name="ecity"]').val(data.city_id);  
                $('[name="egender"]').val(data.pworker_gender);  
                $('[name="ecivilstat"]').val(data.civil_status);  
                $('[name="ebdate"]').val(data.dob);  
                $('[name="ephone"]').val(data.contact_no);  
                $('[name="esss"]').val(data.sss);  
                $('[name="ephil"]').val(data.philhealth);  
                $('[name="epagibig"]').val(data.pag_ibig);  
                $('[name="ebanknum"]').val(data.bank_no);  
                $('[name="eposition"]').val(data.emptype_id);                  
                $('[name="estatus"]').val(data.status); 
                $('[name="eweight"]').val(data.weight);
                $('[name="eheight"]').val(data.height);
                $('[name="etin"]').val(data.tin_number);
                $('[name="eblood"]').val(data.blood_type);
                $('[name="etax"]').val(data.tax_code);
                $('#modal_form').modal('show'); 
                $('.modal-title').text('Edit Employee details'); 
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

    function del_emp(id){
        if(confirm('Are you sure delete this data?')){
            $.ajax({
                url : "<?php echo site_url('HumanE/ajax_delete')?>/"+id,
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

    function reload_table(){
        table.ajax.reload(null,false);  
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

    function add_emp_type() {
        save_method = 'add';
        $('#form2')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form2').modal('show'); 
        $('.modal-title').text('Create new Employee Type');        
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

    function reload_table2(){
        table2.ajax.reload(null,false);  
    }


    </script>
