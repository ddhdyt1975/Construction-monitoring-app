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
           Materials
        </h1>
        <ol class="breadcrumb">
            <li  class=""><a href="Admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="Materials"><i class="fa fa-briefcase"></i> Materials</a></li>
        </ol>
        
    </section>
     
    <section class="content">
    	<div class="row" >
    		<div class="col-lg-6">
    			<div class="box  box-success">
          			<div class="box-header with-border">
            		<h3 class="box-title">Materials Stocks List</h3>
            			<div class="box-tools pull-right">
                 			<button  class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Add new Stock" onclick="add_material()" ><i class="fa fa-plus"></i> Add stock</button>
           				    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      	</div>
          			</div>
          			<div class="box-body">
            			<table id="datatable-materials-stock" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
             				<thead>
				                <tr>
				                    <th>Material Name (on Stock)</th>
				                    <th>Quantity</th>
				                    <th>Actions</th>
				                </tr>
              				</thead>
				            <tbody>
				            </tbody>
				             
				        </table>
          			</div>
        		</div>
    		</div>
      		<div class="col-lg-6">
        		<div class="box box-solid box-success">
          			<div class="box-header with-border">
            		<h3 class="box-title"> List of Materials (History)</h3>
            			<div class="box-tools pull-right">
                 	 	    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      	</div>
          			</div>
          			<div class="box-body">
            			<table id="datatable-materials" class="table table-striped table-hover table-bordered  dt-responsive wrap" cellspacing="0" width="100%">
             				<thead>
				                <tr>
				                    <th>Material Serial/Id no.</th>
				                    <th>Material Name</th>
				                    <th>Quantity</th>
                                    <th>Amount</th>
				                    <th>Status</th>
				                    <th>Supplier</th>
				                    <th>Date Supplied</th>
				                    <th>Actions</th>
				                </tr>
              				</thead>
                             <tbody >
				            </tbody>
				             
				        </table>
          			</div>
        		</div>
      		</div>
            <div class="col-lg-12">
                <div class="box  box-solid">
                    <div class="box-header with-border">
                    <h3 class="box-title"> List of Materials delivered to projects</h3>
                        <div class="box-tools pull-right">
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="datatable-materials-proj" class="table table-striped table-hover table-bordered dt-responsive  wrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Material Name</th>
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
                        <form action="#" id="form" class="form-group">
                            <div class="form-group hidden">
                                <label for="prjcode">Material Serial/id no.</label>
                                <input type="text" class="form-control" id="matidii" name = "matidii" placeholder="Enter Material Serial/id no."/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group hidden">
                                    <label for="prjcode">Material Serial/id no.</label>
                                        <input type="text" class="form-control" id="matid" name = "matid" placeholder="Enter Material Serial/id no."/>
                                     <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label for="prjcode">Material Name</label>
                                         <input type="text" class="form-control" id="matname" name="matname" placeholder="Enter Material Name"/>
                                    <span class="help-block"></span>
                                </div>



                                <div class="form-group">
                                    <div class = "row">
                                        <div class="col-lg-3">
                                            <label for="prjdstatus">Quantity</label>
                                                <input type="number" class="form-control" id="matqty" name="matqty" placeholder="0" onkeypress="return isNumberKey(event)"/>
                                                <span class="help-block"></span>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="idTourDateDetails">Unit</label>
                                            <div class = "form-group">
                                                <select  name="matunit" id ="matunit" class="form-control">
                                                    <option value=""></option>
                                                    <?php foreach ($units as $sup) echo '<option value='.$sup->unit_id.'>'.$sup->unit_name.'</option>'?>
                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                            
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="idTourDateDetails">Material Status:</label>
                                               <select id = "prjstatus" name="matstat" id ="matstat" class="form-control">
                                                    <option value=""> </option>
                                                    <option value="Ok">Ok</option>
                                                    <option value="Slight Damage">Slight Damage</option>
                                                    <option value="Damaged">Damaged</option>
                                                </select>
                                            <span class="help-block"></span>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="prjdstatus">Amount</label>
                                            <input type="number" class="form-control" id="mattot" name="mattot" placeholder="0" onkeypress="return isNumberKey(event)"/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class = "row">
                                        <div class="col-lg-8">
                                            <label for="prjdstatus">Supplier</label>
                                            <select id = "prjstatus" name="matsup" id="matsup" class="form-control">
                                                <option value=""></option>
                                                <?php foreach ($supplier as $sup)
                                                 echo '<option value='.$sup->supplier_id.'>'.$sup->supplier_name.'</option>'
                                                ?>
                                            </select>
                                             <span class="help-block"></span>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group ">
                                                <label for="idTourDateDetails">Delivered Date:</label>
                                                <input name="matddate" id = "matddate" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                                <span class="help-block"></span>
                                            </div>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <label for="prjcode">Comments <span class="fa fa-comment"></span></samp></label>
                                    <textarea type="text" class="form-control" id="matcom" name="matcom" placeholder="Comments"> </textarea>
                                </div>
                                <span class="help-block"></span>
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
                        <form action="#" id="form_stock" class="form-group">
                            <div class="form-group hidden">
                                <label for="matids1">Material Name</label>
                                <input type="text" class="form-control" id="matids" name="matids" placeholder="Enter Material Name"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group col-lg-7">
                                <label for="prjcode">Material Name</label>
                                <input type="text" class="form-control" id="matname1" name="matname1" placeholder="Enter Material Name"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="col-lg-5">
                                <label for="prjdstatus">Quantity</label>
                                <input type="number" class="form-control" id="matqty1" name="matqty1" placeholder="0" onkeypress="return isNumberKey(event)"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="col-lg-3 hidden">
                                <label for="idTourDateDetails">Unit</label>
                                <div class = "form-group">
                                    <select i name="matunit1" id ="matunit1" class="form-control">
                                        <option value=""></option>
                                            <?php foreach ($units as $sup) echo '<option value='.$sup->unit_id.'>'.$sup->unit_name.'</option>'?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                
                            </div>

                            <div class="col-lg-6  hidden">
                                <label for="idTourDateDetails">Material Status:</label>
                                   <select   name="matstat1" id ="matstat1" class="form-control">
                                        <option value=""> </option>
                                        <option value="Ok">Ok</option>
                                        <option value="Slight Damage">Slight Damage</option>
                                        <option value="Damaged">Damaged</option>
                                    </select>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group hidden">
                                <div class = "row">
                                    <div class="col-lg-8">
                                        <label for="prjdstatus">Supplier</label>
                                        <select  name="matsup1" id="matsup1" class="form-control">
                                            <option value=""></option>
                                            <?php foreach ($supplier as $sup)
                                             echo '<option value='.$sup->supplier_id.'>'.$sup->supplier_name.'</option>'
                                            ?>
                                        </select>
                                         <span class="help-block"></span>
                                    </div>
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSaves" onclick="saves()" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>  


 
<script type="text/javascript">

	var save_method; 
	var table, table2, table3; 
    
    $(document).ready(function() {
        $('#ma').attr("class","active");
      	var handleDataTableButtons = function() {
        	
	        if ($("#datatable-materials").length) {
	      		table = $("#datatable-materials").DataTable({
	            	ajax: {
	              		"url": "<?php echo site_url('materials/ajax_list')?>",
	              		"type": "POST"
	            	},
                    order: [[5, 'desc']],
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

            if ($("#datatable-materials-stock").length) {
	      		table2 = $("#datatable-materials-stock").DataTable({
	            	ajax: {
	              		"url": "<?php echo site_url('materials/ajax_list_stock')?>",
	              		"type": "POST"
	            	},
	            	//order: [[5, 'desc']],
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

            if ($("#datatable-materials-proj").length) {
                table3 = $("#datatable-materials-proj").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('materials/ajax_list4')?>",
                        "type": "POST"
                    },
                    order: [[3, 'desc']],
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

	function add_material(){
	    save_method = 'add';
	    $('#form')[0].reset(); 
	    $('.form-group').removeClass('has-error'); 
	    $('.help-block').empty(); 
	    $('#modal_form').modal('show'); 
	    $('.modal-title').text('Add new Material'); 
	}

	function edit_material(id){
	    save_method = 'update';
	    $('#form')[0].reset(); 
	    $('.form-group').removeClass('has-error'); 
	    $('.help-block').empty(); 
	    $.ajax({
	        url : "<?php echo site_url('materials/ajax_edit2/')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data){
                $('[name="matidii"]').val(data.ii);
	            $('[name="matid"]').val(data.material_id);
	            $('[name="matid"]').attr("readonly","readonly");
	            $('[name="matname"]').val(data.material_name);
	            $('[name="matqty"]').val(data.material_quantity);
	            $('[name="matstat"]').val(data.material_status);
	            $('[name="matddate"]').val(data.material_date);
	            $('[name="matsup"]').val(data.supplier_id);
	            $('[name="matunit"]').val(data.material_unit);
	            $('[name="matcom"]').val(data.material_comment);
                $('[name="mattot"]').val(data.total_amount);
	             
	            $('#modal_form').modal('show'); 
	            $('.modal-title').text('Edit Material Information'); 
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
 
    function edit_material_stock(id){
        save_method = 'updatestock';
        $('#form_stock')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $.ajax({
            url : "<?php echo site_url('Materials/ajax_edit/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){

                $('[name="matids"]').val(data.material_id);
                $('[name="matname1"]').val(data.material_name);
                $('[name="matname1"]').attr("readonly","readonly");
                $('[name="matqty1"]').attr("placeholder", data.quantity+" + ?");
                $('[name="matstat1"]').val(data.material_status);
                $('[name="matsup1"]').val(data.supplier_id);
                $('[name="matunit1"]').val(data.material_unit);
                $('[name="matcom1"]').val(data.material_comment);
                  
                $('#modal_form_stock').modal('show'); 
                $('.modal-title').text('Edit Material Information'); 
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

	function reload_table(){
	    table.ajax.reload(null,false); 
	    table2.ajax.reload(null,false);  
	}

	function saves(){
        $('#btnSaves').text('Saving...'); 
        $('#btnSaves').attr('disabled',true); 
     
        $.ajax({
            url : "<?php echo site_url('Materials/ajax_update_stock')?>",
            type: "POST",
            data: $('#form_stock').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
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
                    $('#modal_form_stock').modal('hide'); 
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
            
            $('#btnSaves').text('Save'); 
            $('#btnSaves').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 
                $('#btnSaves').text('Save'); 
                $('#btnSaves').attr('disabled',false); 

            }
        });
    }

    function save(){
	    $('#btnSave').text('Saving...'); 
	    $('#btnSave').attr('disabled',true); 
	    var url;

	    if(save_method == 'add'){
	        url = "<?php echo site_url('materials/ajax_add')?>";
	    } 
	    else{
	        url = "<?php echo site_url('materials/ajax_update')?>";
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
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
	                }
	            }
            
            $('#btnSave').text('Save'); 
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

	function delete_material(id){
	    if(confirm('Are you sure delete this data?')){
	         $.ajax({
	            url : "<?php echo site_url('materials/ajax_delete')?>/"+id,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data){
	                $('#modal_form').modal('hide');
	                reload_table();
	                new PNotify({
                        title: 'Status',
                        text: 'Deleted successfully.',
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



 