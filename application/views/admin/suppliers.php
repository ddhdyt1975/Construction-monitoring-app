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
           Suppliers
        </h1>
        <ol class="breadcrumb">
            <li  class=""><a href="Admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="Suppliers"><i class="fa fa-truck"></i> Suppliers</a></li>
        </ol>
        
    </section>
     
    <section class="content">
    	<div class="row" >

    	 	<div class="col-lg-12">
                <div class="box box-info ">
                    <div class="box-header with-border">
                        <h3 class="box-title"> List of Suppliers</h3>
                        <div class="box-tools pull-right">
                            <button  onclick="add_person()"  class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Supplier</button>
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body"  >
            			<table id="datatable-supplier" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
              				<thead>
				                <tr>
				                    <th>Supplier ID</th>
				                    <th>Supplier Name</th>
				                    <th>Supplier Address</th>
				                    <th>Actions</th>
				                </tr>
				            </thead>
			                <tbody>
			                </tbody>
			                <tfoot>
			                    <tr>
			                      <th>Supplier ID</th>
			                      <th>Supplier Name</th>
			                      <th>Supplier Address</th>
			                      <th>Actions</th>
			                    </tr>
                 			</tfoot>
            			</table>
          			</div>
        		</div>
      		</div>
      		
      		<div class="col-lg-6" style = "display:none;" id= "viewsup">
                <div class="box box-success collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"> List of Users (click here for table view.)</h3>
                        <div class="box-tools pull-right">
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body"  >
	            		<table id="datatable-msupplier" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
	              			<thead>
	                			<tr>
				                  <th>Material id</th>
				                  <th>Material name</th>
				                  <th>Material Quantity</th>
				                  <th>Supplied Date</th>
				                </tr>
	            			</thead>
	              			<tbody>
		              		</tbody>
	              			<tfoot>
				                <tr>
				                    <th>Material id</th>
				                    <th>Material name</th>
				                    <th>Material Quantity</th>
				                    <th>Supplied Date</th>
				                </tr>
	              			</tfoot>
	            		</table>
	          		</div>
        		</div>
      		</div>

			<div class="col-lg-6">
                <div class="box box-warning collapsed-box"  style = "display:none;" id= "viewsup2">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Equipments Supplied</h3>
                        <div class="box-tools pull-right">
                           <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body"  >
			         	<table id="datatable-mequip" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
              				<thead>
                                <tr>
                                    <th>Equip id</th>
                                    <th>Equip name</th>
                                    <th>Equip Quantity</th>
                                    <th>Supplied Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
						        <tr>
                                    <th>Equip id</th>
                                    <th>Equip name</th>
                                    <th>Equip Quantity</th>
                                    <th>Supplied Date</th>
                                </tr>
                            </tfoot>
            			</table>
          			</div>
        		</div>
      		</div>
     	</div>          
  	</section>      
</div>  


 
<script type="text/javascript">

  	var save_method; 
  	var table;
  	var table2;
  	var table3;
  	var idd;
   	
   	$(document).ready(function() {
   		 $('#sa').attr("class","active");

     	$('#supselect').on('change', function() {
      		if ( this.value == '1') {
				$("#modal-body1").show(); 
        		$("#modal-body2").hide();
			}
      		else if ( this.value == '2') {
		        $("#modal-body1").hide();
        		$("#modal-body2").show(); 
		    }
      		else{
        		$("#modal-body2").hide(); 
       			$("#modal-body1").hide();
      		}
	    });

	    table2 = $("#datatable-msupplier").DataTable();
	    table3 = $("#datatable-mequip").DataTable();
	    
	    var handleDataTableButtons = function() {
	        if ($("#datatable-supplier").length) {
	            table = $("#datatable-supplier").DataTable({
	                ajax: {
	                    "url": "<?php echo site_url('suppliers/ajax_list')?>",
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


	    $('#datatable-scroller').DataTable({
	        ajax: "js/datatables/json/scroller-demo.json",
	        deferRender: true,
	        scrollY: 380,
	        scrollCollapse: true,
	        scroller: true
	    });

	    $('#datatable-fixed-header').DataTable({
	      	fixedHeader: true
	    });

	    var $datatable = $('#datatable-checkbox');
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


  	function view_supplier(id){ 

      	$('#viewsup').show();
      	$('#viewsup2').show();
      	$("#datatable-msupplier").dataTable().fnDestroy();
      	$("#datatable-mequip").dataTable().fnDestroy();
 
        table2 = $("#datatable-msupplier").DataTable({
            ajax: {
	            "url": "<?php echo site_url('suppliers/ajax_list2')?>/" + id,
    	        "type": "POST"
          	},
       		order: [[3, 'asc']],
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
              
	 	table3 = $("#datatable-mequip").DataTable({
            ajax: {
	            "url": "<?php echo site_url('suppliers/ajax_list3')?>/" + id,
	            "type": "POST"
          	},
          	order: [[3, 'asc']],
            keys: true,
            dom: "Bfrtip",
            buttons: [{extend: "copy",className: "btn-sm"},{extend: "csv",className: "btn-sm"},{extend: "excel",className: "btn-sm"},{extend: "pdfHtml5",className: "btn-sm"},{extend: "print",className: "btn-sm"},],
             responsive: true
        });
	}

	function add_new(id){
		idd = id;
		//alert(idd);
	    $('#form2')[0].reset();
	    $('#form3')[0].reset();
	    $('#supselect').val('0');
	    $('#modal-body1').hide();
	    $('#modal-body2').hide();
	    $('[id="supsup2"]').val(id);
	    $('[id="matsup2"]').val(id);
	       
	    $('#form')[0].reset(); 
	    $('.form-group').removeClass('has-error'); 
	    $('.help-block').empty(); 
	    $('#modal_form2').modal('show'); 
	    $('.modal-title').text('Add new Supply'); 
	}

	function add_person(){
	    save_method = 'add';
	    $('#form')[0].reset(); 
	    $('.form-group').removeClass('has-error'); 
	    $('.help-block').empty(); 
	    $('#modal_form').modal('show'); 
	    $('.modal-title').text('Add new Supplier'); 
	}

	function edit_supplier(id){
		save_method = 'update';
	    $('#form')[0].reset(); 
	    $('.form-group').removeClass('has-error');  
	    $('.help-block').empty(); 
	    $.ajax({
	        url : "<?php echo site_url('suppliers/ajax_edit/')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data){
	            $('[name="supid"]').val(data.supplier_id);
	            $('[name="supname"]').val(data.supplier_name);
	            $('[name="supadd"]').val(data.supplier_address);
	            $('[name="supcity"]').val(data.city_id);
	           
	            $('#modal_form').modal('show'); 
	            $('.modal-title').text('Edit Supplier Information'); 
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
  	}

  	function reload_table2(){
    	table2.ajax.reload(null,false); 
  	}

  	function reload_table3(){
    	table3.ajax.reload(null,false);  
  	}

  	function save(){
      	$('#btnSave').text('Saving...'); 
      	$('#btnSave').attr('disabled',true);  
      	var url;
    
      	if(save_method == 'add') {
        	url = "<?php echo site_url('suppliers/ajax_add')?>";
      	} else {
        	url = "<?php echo site_url('suppliers/ajax_update')?>";
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
	                        text: 'Information ppdated successfully.',
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

  	function save2(){
      	$('#btnSave2').text('Saving...'); 
      	$('#btnSave2').attr('disabled',true);  
      	var url;
    
      	url = "<?php echo site_url('suppliers/ajax_add2')?>";
     	$.ajax({
          	url : url,
          	type: "POST",
          	data: $('#form2').serialize(),
          	dataType: "JSON",
          	success: function(data){
              	if(data.status){
                  	$('#modal_form2').modal('hide');
                  	$('#btnSave2').text('save'); //change button text
                  	$('#btnSave2').attr('disabled',false); //set button enable
                    new PNotify({
                        title: 'Success!',
                        text: 'Information added successfully.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    view_supplier(idd);
	                reload_table2();
	                reload_table3();
              	}
              	else{
                  	for (var i = 0; i < data.inputerror.length; i++){
                      	$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                      	$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                  	}
              	}
              	$('#btnSave2').text('save'); 
             	$('#btnSave2').attr('disabled',false);  
          	},
          	error: function (jqXHR, textStatus, errorThrown) {
		        new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });
		      $('#btnSave2').text('save'); //change button text
		      $('#btnSave2').attr('disabled',false); //set button enable 
          	}
      	});
  	}

  	function save3(){
      	$('#btnSave3').text('Saving...'); 
      	$('#btnSave3').attr('disabled',true);  
      	var url;
    
      	url = "<?php echo site_url('suppliers/ajax_add3')?>";
     
      	$.ajax({
          	url : url,
          	type: "POST",
          	data: $('#form3').serialize(),
          	dataType: "JSON",
          	success: function(data){
	            if(data.status){
                  	$('#modal_form2').modal('hide');
                    new PNotify({
                        title: 'Success!',
                        text: 'Information added successfully.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    $('#btnSave3').text('save');  
                    $('#btnSave3').attr('disabled',false);
                    view_supplier(idd);
                    reload_table2();
                    reload_table3();
              	}
              	else{
                  	for (var i = 0; i < data.inputerror.length; i++){
                      	$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                      	$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                  	}
             	 }
              $('#btnSave3').text('save'); 
              $('#btnSave3').attr('disabled',false);  
          	},
          	error: function (jqXHR, textStatus, errorThrown){
              
              	//alert('Error adding / update data' + jqXHR+ textStatus +errorThrown);
              	new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

              	$('#btnSave3').text('save'); 
              	$('#btnSave3').attr('disabled',false);  
			}
      	});
  	}

  	function delete_supplier(id){
      	if(confirm('Are you sure delete this data?')){
          	$.ajax({
              	url : "<?php echo site_url('suppliers/ajax_delete')?>/"+id,
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
</script>

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-group">
                    <div class="form-group hidden">
                            <label for="supid">Supplier Serial/id no.</label>
                               <input type="text" class="form-control" id="supid" name="supid" placeholder="Enter Supplier Serial/id no."/>
                                <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Supplier Name</label>
                                <input type="text" class="form-control" id="supname" name="supname" placeholder="Enter Supplier Name"/>
                            <span class="help-block"></span>                               
                        </div>


                        <div class="form-group input-group">
                            <div class = "row">
                                <div class="col-lg-6">
                                    <label for="prjdstatus">Project Address</label>
                                       <input class="form-control" id="supadd" name="supadd" placeholder= "Address Here"  type="text">
                                        <span class="help-block"></span>                               
                                </div>
                               
                                <div class="col-lg-6">
                                    <label for="prjpercent">City</label>
                                       <select id = "supcity" name="supcity" class="form-control" >
                                            <option value=""></option>
                                            <?php foreach($cities as $cobject)
                                                echo '<option value='.$cobject->city_id.'>'.$cobject->city_name.', '.$cobject->province_name.'</option>'
                                            ?>
                                        </select>
                                       <span class="help-block"></span>                               
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

<div class="modal fade" id="modal_form2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body" id="modal-body">
            <div class="form-group">
                <label >What to Supply?</label>
                <select id = "supselect"  class="form-control">
                    <option value="0"></option>
                    <option value="1">Equipment</option>
                    <option value="2">Material</option>
               </select>
            </div>
            </div>

            <div class="modal-body" id="modal-body1" style="display:none;">
                <form action="#" id="form2" class="form-group">
                     <div class="form-group">
                            <label for="prjcode">Equipment Serial/id no.</label>
                                 <input type="text" class="form-control" id="eqid2" name="eqid2" placeholder="Enter Equipment Serial/id no."/>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Equipment Name</label>
                                <input type="text" class="form-control" id="eqname2" name="eqname2" placeholder="Enter Equipment Name"/>
                           <span class="help-block"></span>
                        </div>


                        <div class="form-group">
                            <div class = "row">
                                <div class="col-lg-4">
                                        <label for="idTourDateDetails">Quantity</label>
                                        <input type="number" class="form-control" id="eqqua2" name="eqqua2" placeholder="0" onkeypress="return isNumberKey(event)"/>
                               <span class="help-block"></span>
                                </div>

                                <div class="col-lg-8">
                                    <label for="idTourDateDetails">Equipment Status:</label>
                                        <select  name="eqstat2" id="eqstat2" class="form-control">
                                            <option value=""> </option>
                                            <option value="Ok">Ok</option>
                                            <option value="Slight Damage">Slight Damage</option>
                                            <option value="Damaged">Damaged</option>
                                        </select>
                                        <span class="help-block"></span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class = "row">
                                <div class="col-lg-8 hidden">
                                    <label for="prjdstatus">Supplier</label>
                                      <select name="supsup2" id="supsup2" class="form-control" >
                                        <option value=""></option>
                                        <?php foreach ($supplier as $sup)
                                         	echo '<option value='.$sup->supplier_id.'>'.$sup->supplier_name.'</option>'
                                        ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="idTourDateDetails">Delivered Date:</label>
                                       
                                       <input  id = "eqddate2"  name= "eqddate2"  placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                         <span class="help-block"></span>
                                   
                                </div>
                            </div>
                            <div class="col-lg-6">
                            	<label for="prjcode">Comments <span class="fa fa-comment"></span></samp></label>
                            	<textarea type="text" class="form-control" id="eqcom2" name="eqcom2" placeholder="Comments"> </textarea>
                        	</div>
                        </div>
    
                       
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave2" onclick="save2()" class="btn btn-primary">Add Equipment</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form></div>

            <div class="modal-body" id="modal-body2" style="display:none;">
                <form action="#" id="form3" class="form-group">
                    <div class="form-group">
                            <label for="prjcode">Material Serial/id no.</label>
                                <input type="text" class="form-control" id="matid2" name = "matid2" placeholder="Enter Material Serial/id no."/>
                             <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="prjcode">Material Name</label>
                             <input type="text" class="form-control" id="matname2" name="matname2" placeholder="Enter Material Name"/>
                        <span class="help-block"></span>
                    </div>

                   <div class="form-group">
                        <div class = "row">
                            <div class="col-lg-3">
                                <label for="prjdstatus">Quantity</label>
                                    <input type="number" class="form-control" id="matqty2" name="matqty2" placeholder="0" onkeypress="return isNumberKey(event)"/>
                                    <span class="help-block"></span>
                            </div>

                            <div class="col-lg-3">
                                <label for="idTourDateDetails">Unit</label>
                                <div class = "form-group">
                                    <select  name="matunit2" id ="matunit2" class="form-control">
                                        <option value=""></option>
                                            <option value="bags">bags</option>
                                            <option value="cubic foot">cubic foot</option>
                                            <option value="CUM">cubic metre</option>
                                            <option value="drum">drum</option>
                                            <option value="kilogram">kilogram</option>
                                            <option value="liter">liter</option>
                                            <option value="pieces">pieces</option>
                                            <option value="pounds">pounds</option>
                                            <option value="sacks">sacks</option>
                                            <option value="square foot">square foot</option>
                                            <option value="tons">tons</option>
                                            <option value="none">none</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                
                            </div>

                            <div class="col-lg-6">
                                <label for="idTourDateDetails">Material Status:</label>
                                   <select name="matstat2" id ="matstat2" class="form-control">
                                        <option value=""> </option>
                                        <option value="Ok">Ok</option>
                                        <option value="Slight Damage">Slight Damage</option>
                                        <option value="Damaged">Damaged</option>
                                    </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class = "row">
                            <div class="col-lg-8 hidden">
                                <label for="prjdstatus">Supplier</label>
                               <select  name="matsup2" id="matsup2" class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($supplier as $sup)
                                     echo '<option value='.$sup->supplier_id.'>'.$sup->supplier_name.'</option>'
                                    ?>
                                </select>
                                 <span class="help-block"></span>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <label for="idTourDateDetails">Delivered Date:</label>
                                    <input name="matddate2" id = "matddate2" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                </div>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-lg-6">
                            	<label for="prjcode">Comments <span class="fa fa-comment"></span></samp></label>
                        		<textarea type="text" class="form-control" id="matcom2" name="matcom2" placeholder="Comments"> </textarea>
                        	</div>
                        </div>
                    </div>

                    <div class="form-group">
                        
                    </div>
                    <span class="help-block"></span>
                </form>
                <div class="modal-footer">
                <button type="button" id="btnSave3" onclick="save3()" class="btn btn-primary">Add Material</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </div>

            
        </div>
    </div>
</div>

 