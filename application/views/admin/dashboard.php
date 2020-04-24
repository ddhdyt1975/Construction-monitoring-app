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
            Overview 
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="Admin"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3><?php echo $c1 ?></h3>

                                <p>Project(s)!</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-ios-book"></i>
                            </div>
                            <a  id="a1"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo $c2 ?></h3>

                                <p>Material(s)!</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-ios-briefcase"></i>
                            </div>
                            <a  id="a2"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="small-box bg-orange">
                            <div class="inner">
                                <h3><?php echo $c3 ?></h3>

                                <p>Equipment(s)!</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-wrench"></i>
                            </div>
                            <a  id="a3"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                      
                    <div class="col-lg-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?php echo $c4 ?></h3>

                                <p>Supplier(s)!</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-android-car"></i>
                            </div>
                            <a  id="a4"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3><?php echo $c5 ?></h3>

                                <p>User(s)!</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-ios-people"></i>
                            </div>
                            <a  id="a5"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>  
                </div>
            </div>
           <!--  <div class="col-lg-4">
               <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Viewer(s)</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding" id = "viewers">
                        <ul class="users-list clearfix">
                           
                        </ul>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-5">
                <div class="box box-solid bg-blue-gradient">
                    <div class="box-header">
                        <i class="fa fa-calendar"></i>
                        <h3 class="box-title">Calendar</h3>
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <div class="box-footer text-black">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4><b>Projects</b></h4>
                                <div id = "projects" >
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog modal-lg" style ="width:auto; margin:20px 20px 20px 20px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap" id="table">
                                        <thead>
                                            <tr><th>Project Code</th><th>Project Title</th><th>Project Description</th><th>Project Manager</th><th>Project Address</th></tr>
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

        <div class="modal fade" id="modal_form2" role="dialog">
            <div class="modal-dialog modal-lg" style ="width:auto; margin:20px 20px 20px 20px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap" id="table2">
                                        <thead>
                                            <tr><th>Material Id</th><th>Material Name</th><th>Supplier</th><th>Date Supplied</th><th>Quantity</th><th>Unit</th><th>Status</th><th>Comment</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                               <tr><th>Material Id</th><th>Material Name</th><th>Supplier</th><th>Date Supplied</th><th>Quantity</th><th>Unit</th><th>Status</th><th>Comment</th></tr>
                                     </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form3" role="dialog">
            <div class="modal-dialog modal-lg" style ="width:auto; margin:20px 20px 20px 20px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                               <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap" id="table3">
                                        <thead>
                                            <tr><th>Equipment Id</th><th>Equipment Name</th><th>Supplier</th><th>Supplied Date</th><th>Quantity</th><th>Status</th><th>Comment</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Equipment Id</th><th>Equipment Name</th><th>Supplier</th><th>Supplied Date</th><th>Quantity</th><th>Status</th><th>Comment</th></tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form4" role="dialog">
            <div class="modal-dialog modal-lg" style ="width:auto; margin:20px 20px 20px 20px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap" id="table4">
                                        <thead>
                                            <tr><th>Supplier Id</th><th>Supplier Name</th><th>Supplier Address</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Supplier Id</th><th>Supplier Name</th><th>Supplier Address</th></tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form5" role="dialog">
            <div class="modal-dialog modal-lg" style ="width:auto; margin:20px 20px 20px 20px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap" id="table5">
                                        <thead>
                                            <tr><th>Name</th><th>Email</th><th>Position</th><th>Address</th><th>Registered</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Name</th><th>Email</th><th>Position</th><th>Address</th><th>Registered</th></tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


<script type="text/javascript">

    var table, table2, table3, table4, table5;

    $(document).ready(function() {
        $('#oa').attr("class","active");
        table = $('#table').DataTable();
        table2 = $('#table2').DataTable();
        table3 = $('#table3').DataTable();
        table4 = $('#table4').DataTable();
        table5 = $('#table5').DataTable();
        Display();
        newUser();
    });

    $('#a1').click( function(e) {
        e.preventDefault();
        table.destroy();
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Project(s)');  
        table = $('#table').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list')?>",
            "type": "POST"
            },
        });
    });

    $('#a2').click( function(e) {
        e.preventDefault();
        table2.destroy();
        $('#modal_form2').modal('show');  
        $('.modal-title').text('Material History');  
        table2 = $('#table2').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list2')?>",
            "type": "POST"
            },
            order: [[6, 'asc']],
        });
    });
    
    $('#a3').click( function(e) {
        e.preventDefault();
        table3.destroy();
        $('#modal_form3').modal('show');  
        $('.modal-title').text('Equipment History'); 
        table3 = $('#table3').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list3')?>",
            "type": "POST"
            },
            order: [[3, 'asc']],
        });
    });
    
    $('#a4').click( function(e) {
        e.preventDefault();
         table4.destroy();
        $('#modal_form4').modal('show'); 
        $('.modal-title').text('Supplier List'); 
        table4 = $('#table4').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list4')?>",
            "type": "POST"
            },
        });
    });
    
    $('#a5').click( function(e) {
        e.preventDefault();
        table5.destroy();
        $('#modal_form5').modal('show'); 
        $('.modal-title').text('Users List');  
        table5 = $('#table5').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('Admin/ajax_list5')?>",
            "type": "POST"
            },
        });
    });  


    function Display(){
        $("#projects").empty();
        $.ajax({
        url : "<?php echo site_url('Admin/getProjects/')?>" ,
        type: "GET",
        dataType: "JSON",
        success: function(data){   
            for(i=0; i<data.length;i++){
                $("#projects").append('<div class="clearfix">'+
                    '<span class="pull-left">'+data[i]['project_title']+'</span>'+
                    '<small class="pull-right"><text id = "'+'pname'+i+'"></text>% completed</small>'+
                '</div>'+
               '<div class="progress xs">'+
                '<div id = "'+'p'+i+'" class="progress-bar progress-bar-green" ></div>'+
                '</div>');
                showChart(data[i]['project_code'], i);
            };
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

    function showChart(id, z){
        var total1 = 0, total2 = 0, total3 = 0;
        $.ajax({
            url : "<?php echo site_url('Admin/getTasks/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data!=null){
                    for(i=0; i<data.length;i++){
                        total = parseInt(data[i]['projdtsk_percent']); 
                        total2 = total2 + total;
                    };
                    
                    total3 = (total2/data.length).toFixed(2);
                    $('#p'+z).css('width', total3+'%').attr('aria-valuenow',  total3);
                    $('#pname'+z).append(total3);
                }
                else{
                    $('#p'+z).css('width', 0+'%').attr('aria-valuenow',  '0');
                    $('#pname'+z).append('0');
                }
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

    function newUser(){
        $('#viewers ul').empty();
        $.ajax({
        url : "<?php echo site_url('Admin/ajax_list51/')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data){
                if (data!=null){
                    for(i=0; i<data.length;i++){
                        $('#viewers ul').append('<li>'+
                            '<img src="'+data[i]["user_photo"]+'" alt="User Image">'+
                            '<a class="users-list-name" href="#"><small>'+data[i]["name"]+'</small></a>'+
                            '<span class="users-list-date"><small>'+data[i]['oauth_provider']+'</small></span>'+
                        '</li>');
                    };
                }
                
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
    
</script>
