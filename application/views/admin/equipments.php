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
           Equipments
        </h1>
        <ol class="breadcrumb">
            <li  class=""><a href="Admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="Equipments"><i class="fa fa-wrench"></i> Equipments/Tools</a></li>
        </ol>
        
    </section>
     
    <section class="content">
        <div class="row" >
            <div class = "col-lg-5">
                <div class="box  box-warning">
                    <div class="box-header with-border">
                    <h3 class="box-title">Equipment/Tools Stocks List</h3>
                        <div class="box-tools pull-right">
                             <button  onclick="add_equip()"  class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> Add Eqpt/Tool</button>
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="datatable-equip-stock" class="table table-striped table-hover table-bordered  dt-responsive wrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Eqpt/Tool Name</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                             <tbody >
                            </tbody>
                             
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"> List of Equipments/Tools</h3>
                        <div class="box-tools pull-right">
                           
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="datatable-buttons" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Eqpt/Tool ID</th>
                                    <th>Equipment Name</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Date Supplied</th>
                                    <th>Supplier</th>
                                    <th>Status</th> 
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            <div class = "col-lg-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"> List of Equipments/Tools delivered to projects</h3>
                        <div class="box-tools pull-right">
                           
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="datatable-buttons-projs" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Eqpt/Tool Name</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
                        <form  id="form" class="form-group">
                            <div class="form-group hidden">
                                <label for="prjcode">Equipment Serial/id no.</label>
                                <input type="text" class="form-control" id="eqidii" name="eqidii" placeholder="Enter Equipment Serial/id no."/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group hidden">
                                <label for="prjcode">Equipment Serial/id no.</label>
                                <input type="text" class="form-control" id="eqid" name="eqid" placeholder="Enter Equipment Serial/id no."/>
                                <span class="help-block"></span>
                            </div>
                            <div class=" ">
                                <label for="prjcode">Equipment/Tool Name</label>
                                <input type="text" class="form-control" id="eqname" name="eqname" placeholder="Enter Equipment Name"/>
                               <span class="help-block"></span>
                            </div>


                            <div class=" ">
                                <div class = "row">
                                    <div class="col-lg-4">
                                        <label for="idTourDateDetails">Quantity</label>
                                        <input type="number" class="form-control" id="eqqua" name="eqqua" placeholder="0" onkeypress="return isNumberKey(event)"/>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="idTourDateDetails">Equipment/Tool Status:</label>
                                        <select  name="eqstat" id="eqstat" class="form-control">
                                            <option value=""> </option>
                                            <option value="Ok">Ok</option>
                                            <option value="Slight Damage">Slight Damage</option>
                                            <option value="Damaged">Damaged</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="idTourDateDetails">Amount</label>
                                        <input type="number" class="form-control" id="eqtot" name="eqtot" placeholder="0" onkeypress="return isNumberKey(event)"/>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-8">
                                        <label for="prjdstatus">Supplier</label>
                                        <select name="eqsup" id="eqsup" class="form-control">
                                        <option value=""></option>
                                        <?php foreach ($supplier as $sup)
                                         echo '<option value='.$sup->supplier_id.'>'.$sup->supplier_name.'</option>'
                                        ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                        <label for="idTourDateDetails">Delivered Date:</label>
                                            <div class = "form-group input-group">
                                            <input  id = "eqddate"  name= "eqddate" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                            <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="form-group">
                                <label for="prjcode">Comments <span class="fa fa-comment"></span></samp></label>
                                <textarea type="text" class="form-control" id="eqcom" name="eqcom" placeholder="Comments"> </textarea>
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


        <div class="modal fade" id="modal_form_stock" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-success">
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form  id="form_stock" class="form-group">
                            <div class="form-group hidden">
                                <label for="prjcode">Equipment Serial/id no.</label>
                                <input type="text" class="form-control" id="eqid1" name="eqid1" placeholder="Enter Equipment Serial/id no."/>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-lg-6">
                                <label for="prjcode">Equipment/Tool Name</label>
                                    <input type="text" class="form-control" id="eqname1" name="eqname1" placeholder="Enter Equipment Name"/>
                               <span class="help-block"></span>
                            </div>

                           <div class="col-lg-6">
                                <label for="idTourDateDetails">Quantity</label>
                                <input type="number" class="form-control" id="eqqua1" name="eqqua1" placeholder="0" onkeypress="return isNumberKey(event)"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="col-lg-8 hidden">
                                <label for="idTourDateDetails">Equipment/Tool Status:</label>
                                <select  name="eqstat1" id="eqstat1" class="form-control">
                                    <option value=""> </option>
                                    <option value="Ok">Ok</option>
                                    <option value="Slight Damage">Slight Damage</option>
                                    <option value="Damaged">Damaged</option>
                                </select>
                                <span class="help-block"></span>
                            </div>


                            <div class="form-group ">
                                <div class = "row">
                                    <div class="col-lg-8 hidden">
                                        <label for="prjdstatus">Supplier</label>
                                          <select name="eqsup1" id="eqsup1" class="form-control">
                                            <option value=""></option>
                                            <?php foreach ($supplier as $sup)
                                             echo '<option value='.$sup->supplier_id.'>'.$sup->supplier_name.'</option>'
                                            ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-lg-4 hidden">
                                        <div class="form-group">
                                            <label for="idTourDateDetails">Delivered Date:</label>
                                            <div class = "form-group input-group">
                                           <input  id = "eqddate1"  name= "eqddate1" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                             <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="form-group  hidden">
                                <label for="prjcode1">Comments <span class="fa fa-comment"></span></samp></label>
                                <textarea type="text" class="form-control" id="eqcom1" name="eqcom1" placeholder="Comments"> </textarea>
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

    </section>          
</div>



  

<script>
    var save_method; 
    var table;
    var table2;
    var table3;
    
    $(document).ready(function() {
        $('#ea').attr("class","active");
        var handleDataTableButtons = function() {
            if ($("#datatable-buttons").length) {
                table = $("#datatable-buttons").DataTable({
                 ajax: {
                  "url": "<?php echo site_url('equipments/ajax_list')?>",
                  "type": "POST"
                }, 
                order: [[3, 'desc']],
                keys: true,
                dom: "Bfrtip",
                buttons: [
                  {
                    extend: "copy",
                    className: "btn-sm",
                  },
                  {
                    extend: "csv",
                    className: "btn-sm"
                  },
                  {
                    extend: "excel",
                    className: "btn-sm"
                  },
                  {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                  },
                  {
                    extend: "print",
                    className: "btn-sm"
                  },
                ],
                responsive: true
              });
            }

            if ($("#datatable-equip-stock").length) {
                table2 = $("#datatable-equip-stock").DataTable({
                 ajax: {
                  "url": "<?php echo site_url('equipments/ajax_list_stock')?>",
                  "type": "POST"
                },
                keys: true,
                dom: "Bfrtip",
                buttons: [
                  {
                    extend: "copy",
                    className: "btn-sm"
                  },
                  {
                    extend: "csv",
                    className: "btn-sm"
                  },
                  {
                    extend: "excel",
                    className: "btn-sm"
                  },
                  {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                  },
                  {
                    extend: "print",
                    className: "btn-sm"
                  },
                ],
                responsive: true
              });
            }

            if ($("#datatable-buttons-projs").length) {
                table3 = $("#datatable-buttons-projs").DataTable({
                 ajax: {
                  "url": "<?php echo site_url('equipments/ajax_list_proj')?>",
                  "type": "POST"
                }, 
                order: [[3, 'desc']],
                keys: true,
                dom: "Bfrtip",
                buttons: [
                  {
                    extend: "copy",
                    className: "btn-sm",
                  },
                  {
                    extend: "csv",
                    className: "btn-sm"
                  },
                  {
                    extend: "excel",
                    className: "btn-sm"
                  },
                  {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                  },
                  {
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


    function add_equip(){
        save_method = 'add';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty();
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Add new Equipment'); 
    }



    function edit_equip(id){
        save_method = 'update';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $.ajax({
            url : "<?php echo site_url('equipments/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="eqidii"]').val(data.ii);
                $('[name="eqid"]').val(data.equipment_id);
                $('[name="eqname"]').val(data.equipment_name);
                $('[name="eqsup"]').val(data.supplier_id);
                $('[name="eqddate"]').val(data.equipment_date);
                $('[name="eqddate"]').attr('readonly','readonly');
                $('[name="eqqua"]').val(data.equipment_quantity);
                $('[name="eqstat"]').val(data.equipment_status);
                $('[name="eqcom"]').val(data.equipment_comment);
                $('[name="eqtot"]').val(data.total_amount);
                $('#modal_form').modal('show'); 
                $('.modal-title').text('Edit Equipment Information');
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

    function edit_equip_stock(id){
        save_method = 'updatestock';
        $('#form_stock')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $.ajax({
            url : "<?php echo site_url('equipments/ajax_edit2/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="eqid1"]').val(data.equipment_id);
                $('[name="eqname1"]').val(data.equipment_name);
                $('[name="eqname1"]').attr("readonly", "readonly");
                $('[name="eqsup1"]').val(data.supplier_id);
                //$('[name="eqddate1"]').val(data.equipment_date);
                $('[name="eqqua1"]').attr("placeholder", "You have "+data.quantity+" + ?");

                $('[name="eqstat1"]').val(data.equipment_status);
                $('[name="eqcom1"]').val(data.equipment_comment);
                $('#modal_form_stock').modal('show'); 
                $('.modal-title').text('Edit Equipment Stock');
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

        if(save_method == 'add') {
            url = "<?php echo site_url('equipments/ajax_add_to_stock')?>";
        } 
        else if (save_method == 'updatestock') {
            url = "<?php echo site_url('equipments/ajax_update_stock')?>";
        }
         else {
            url = "<?php echo site_url('equipments/ajax_update')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status) {

                    reload_table();
                    $('#modal_form').modal('hide');
                    if(save_method == 'add'){
                        new PNotify({
                            title: 'Status',
                            text: 'Information successfully added.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }else{
                        new PNotify({
                            title: 'Status',
                            text: 'Information successfully updated.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
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
               

                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            }
        });
    }

    function save2(){
        $('#btnSave').text('Saving...'); 
        $('#btnSave').attr('disabled',true);
        var url;

        if (save_method == 'updatestock') {
            url = "<?php echo site_url('equipments/ajax_update_stock')?>";
        }
         else {
       //     url = "<?php echo site_url('equipments/ajax_update')?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_stock').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status) {
                    $('#modal_form').modal('hide');
                    
                   if(save_method == 'add'){
                        new PNotify({
                            title: 'Status',
                            text: 'Information successfully added.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }else{
                        new PNotify({
                            title: 'Status',
                            text: 'Information successfully updated.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    reload_table();
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
                 
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            }
        });
    }

    function delete_equip(id){
        if(confirm('Are you sure delete this data?')){
            $.ajax({
                url : "<?php echo site_url('equipments/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    $('#modal_form').modal('hide');
                    new PNotify({
                        title: 'Status',
                        text: 'Information deleted successfully.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    reload_table();
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
        table2.ajax.reload(null,false); 
    }


</script>