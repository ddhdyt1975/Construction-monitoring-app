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
    }else if($position == 'ut1') {
        redirect('Admin');
    }else if($position == 'utv') {
        redirect('Public_prof');
    }else if($position == 'super') {
        redirect('SuperAdmin');
    }
    
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="ManagerM"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="col-lg-6 ">
            <div class="row">
                <div class="col-md-12">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $c1 ?></h3>

                            <p>Project(s) assigned!</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-ios-book"></i>
                        </div>
                        <a  id="a1"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="ion ion-ios-briefcase"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Material</span>
                            <span class="info-box-number"><?php echo $c9?> - <small>Unused</small></span>
                            <span class="info-box-number"><?php echo $c10?> - <small>Transfered</small></span>
                        </div>
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="info-box bg-orange">
                        <span class="info-box-icon"><i class="fa fa-wrench"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Equipment</span>
                            <span class="info-box-number"><?php echo $c11?> - <small>Unused</small></span>
                            <span class="info-box-number"><?php echo $c12?> - <small>Transfered</small></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $c2 ?></h3>

                            <p>Material(s) used!</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-ios-briefcase"></i>
                        </div>
                        <a  id="a2"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3><?php echo $c3 ?></h3>

                            <p>Equipment(s) used!</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-wrench"></i>
                        </div>
                        <a  id="a3"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-md-6">
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

                <div class="col-md-6">
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

                <div class="col-lg-3 col-xs-6 hidden">
                   <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $c6 ?></h3>

                            <p>Transfered Material(s)!</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-ios-briefcase-outline"></i>
                        <i class="ion ion-ios-refresh-empty"></i>
                        </div>
                        <a  id="a6"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6 hidden">
                   <div class="small-box bg-orange">
                        <div class="inner">
                            <h3><?php echo $c7 ?></h3>

                            <p>Transfered Equipment(s)!</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-wrench"></i>
                        <i class="ion ion-ios-refresh-empty"></i>
                        </div>
                        <a  id="a7"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6 hidden" >
                   <div class="small-box " style="background-color:#605ca8">
                        <div class="inner">
                            <h3><?php echo $c8 ?></h3>

                            <p>Total Worker(s)!</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                        </div>
                        <a  id="a8"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>  
        
        <div class="col-lg-6">
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
        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog modal-lg modal-info">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                       <div class="panel panel-info">
                            <div class="panel-heading">
                                List of Projects
                                <button class="btn btn-aqua btn-xs pull-right" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            </div>
                            <div class="panel-body">
                                <div class="box-body">
                                    <table    class="table table-striped table-bordered table-hover dt-responsive wrap"   width="100%" id="table">
                                        <thead>
                                            <tr> <th>Project </th><th>Project Description</th> <th>Project Address</th></tr>
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
            <div class="modal-dialog modal-lg modal-success">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body form">
                                    <div class="row">
                    <div class="col-lg-12">
                       <div class="panel panel-success">
                            <div class="panel-heading">
                                List of Materials
                                <button class="btn btn-green btn-xs pull-right" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap" id="table2">
                                        <thead>
                                            <tr><th>Project</th><th>Material Name</th><th>Quantity</th><th>Date Used</th><th>Supplier</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Project</th><th>Material Name</th><th>Quantity</th><th>Date Used</th><th>Supplier</th></tr>
                                     </tfoot>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                             
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form3" role="dialog">
            <div class="modal-dialog modal-lg modal-warning">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body form">
                                    <div class="row">
                    <div class="col-lg-12">
                       <div class="panel panel-warning">
                            <div class="panel-heading">
                                List of Equipments
                                <button class="btn btn-orange btn-xs pull-right" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap" id="table3">
                                        <thead>
                                            <tr><th>Project</th><th>Equipment</th><th>Quantity</th><th>Date Used</th><th>Supplier</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Project</th><th>Equipment</th><th>Quantity</th><th>Date Used</th><th>Supplier</th></tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                             
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form4" role="dialog">
            <div class="modal-dialog modal-lg modal-danger">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body form">
                                    <div class="row">
                    <div class="col-lg-12">
                       <div class="panel panel-danger">
                            <div class="panel-heading">
                                List of Suppliers
                                <button class="btn btn-red btn-xs pull-right" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap"   id="table4">
                                        <thead>
                                            <tr><th>Supplier Name</th><th>Supplier Address</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Supplier Name</th><th>Supplier Address</th></tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                             
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
                    </div>
     
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form5" role="dialog">
            <div class="modal-dialog modal-lg modal-danger">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body form">
                                    <div class="row">
                    <div class="col-lg-12">
                       <div class="panel panel-danger">
                            <div class="panel-heading">
                                List of Users
                                <button class="btn btn-red btn-xs pull-right" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table  class="table table-striped table-bordered table-hover dt-responsive wrap" width="100%" id="table5">
                                        <thead>
                                            <tr><th>Name</th><th>Email</th><th>Position</th><th>Address</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Name</th><th>Email</th><th>Position</th><th>Address</th></tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                             
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
                    </div>
                   
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form6" role="dialog">
            <div class="modal-dialog modal-lg modal-success">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body form">
                                    <div class="row">
                    <div class="col-lg-12">
                       <div class="panel panel-success">
                            <div class="panel-heading">
                                List of Transfered Material
                                <button class="btn btn-green btn-xs pull-right" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive nowrap" id="table6">
                                        <thead>
                                            <tr><th>Material</th><th>Transfered from</th><th>Transfered to</th><th>Quantity</th><th>Date</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Material</th><th>Transfered from</th><th>Transfered to</th><th>Quantity</th><th>Date</th></tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                             
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
                    </div>
                   
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form7" role="dialog">
            <div class="modal-dialog modal-lg modal-warning">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body form">
                                    <div class="row">
                    <div class="col-lg-12">
                       <div class="panel panel-warning">
                            <div class="panel-heading">
                                List of Transfered Equipment
                                <button class="btn btn-orange btn-xs pull-right" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive nowrap" id="table7">
                                        <thead>
                                            <tr><th>Equipment</th><th>Transfered from</th><th>Transfered to</th><th>Quantity</th><th>Date</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Equipment</th><th>Transfered from</th><th>Transfered to</th><th>Quantity</th><th>Date</th></tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                             
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
                    </div>
                     
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal_form8" role="dialog" >
            <div class="modal-dialog modal-lg"  >
                <div class="modal-content" style="background-color:#605ca8">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body form">
                    <div class="row">
                    <div class="col-lg-12">
                       <div class="panel "  >
                            <div class="panel-heading" style="background-color:#605ca8">
                                List of Transfered Equipment
                                <button class="btn btn-warning btn-xs pull-right" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table  class="table table-striped table-bordered table-hover dt-responsive wrap" style =" word-wrap:break-word;" id="table8">
                                        <thead>
                                            <tr><th>Project</th><th>Worker</th><th>Quantity</th><th>Date</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Project</th><th>Worker</th><th>Quantity</th><th>Date</th></tr>
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
        </div>
    </section>
</div>


<script type="text/javascript">

    var table, table2, table3, table4, table5, table6, table7, table8;
    var projectSelected;
    var month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var month2 = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    var days = ["Sunday","Monday","Tuesday", "Wednesday","Thursday","Friday","Saturday"];
    var days2 = ["Sun","Mon","Tue", "Wed","Thu","Fri","Sat"];
     
    $('#prjselectd').change(function() {
        projectSelected = $(this).val();  
        viewNext(projectSelected); 
             
    });


    $(document).ready(function() {
        table = $('#table').DataTable();
        table2 = $('#table2').DataTable();
        table3 = $('#table3').DataTable();
        table4 = $('#table4').DataTable();
        table5 = $('#table5').DataTable();
        table6 = $('#table6').DataTable();
        table7 = $('#table7').DataTable();
        table8 = $('#table8').DataTable();
        $('#ds').attr("class","active");
        Display();
    });

    $('#a1').click( function(e) {
        e.preventDefault();
        table.destroy();
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Project View'); // Set Title to Bootstrap modal title
        table = $('#table').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerM/ajax_list')?>",
            "type": "POST"
            },
        });
    });

    $('#a2').click( function(e) {
        e.preventDefault();
        table2.destroy();
        $('#modal_form2').modal('show'); // show bootstrap modal
        $('.modal-title').text('Material View'); // Set Title to Bootstrap modal title
        table2 = $('#table2').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerM/ajax_list2')?>",
            "type": "POST"
            },
            order:[[3, 'asc']],
        });

    });
    
    $('#a3').click( function(e){
        e.preventDefault();
        table3.destroy();
        $('#modal_form3').modal('show'); // show bootstrap modal
        $('.modal-title').text('Equipment View'); // Set Title to Bootstrap modal title
        table3 = $('#table3').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerM/ajax_list3')?>",
            "type": "POST"
            },
            order:[[3, 'desc']],
        });
    });
    
    $('#a4').click( function(e) {
        e.preventDefault();
         table4.destroy();
        $('#modal_form4').modal('show'); // show bootstrap modal
        $('.modal-title').text('Supplier View'); // Set Title to Bootstrap modal title
     
        table4 = $('#table4').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerM/ajax_list4')?>",
            "type": "POST"
            },
        });
    });
    
    $('#a5').click( function(e) {
        e.preventDefault();
        table5.destroy();
        $('#modal_form5').modal('show'); // show bootstrap modal
        $('.modal-title').text('Users View'); // Set Title to Bootstrap modal title
        table5 = $('#table5').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerM/ajax_list5')?>",
            "type": "POST"
            },
        });
    });  

    $('#a6').click( function(e) {
        e.preventDefault();
        table6.destroy();
        $('#modal_form6').modal('show'); // show bootstrap modal
        $('.modal-title').text('Transfered Material View'); // Set Title to Bootstrap modal title
        table6 = $('#table6').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerM/ajax_list6')?>",
            "type": "POST"
            },
        });
    });  

    $('#a7').click( function(e) {
        e.preventDefault();
        table7.destroy();
        $('#modal_form7').modal('show'); // show bootstrap modal
        $('.modal-title').text('Transfered Equipment View'); // Set Title to Bootstrap modal title
        table7 = $('#table7').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerM/ajax_list7')?>",
            "type": "POST"
            },
        });
    });  

    $('#a8').click( function(e) {
        e.preventDefault();
        table8.destroy();
        $('#modal_form8').modal('show'); // show bootstrap modal
        $('.modal-title').text('Assigned Workers View'); // Set Title to Bootstrap modal title
        table8 = $('#table8').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerM/ajax_list8')?>",
            "type": "POST"
            },
        });
    });  

    function sortByKey(array, key) {
        return array.sort(function(a, b) {
            var x = a[key];
            var y = b[key];
            return ((x < y) ? 1 : ((x > y) ? -1 : 0));
        });
    }

    function ok_list(id){
       var url = "<?php echo site_url('ManagerM/check_list')?>/"+id;
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                viewNext(projectSelected);
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }

     function Display(){
        $("#projects").empty();
        $.ajax({
        url : "<?php echo site_url('ManagerM/getProjects/')?>" ,
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
            url : "<?php echo site_url('ManagerM/getTasks/')?>" +id,
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

    
    
</script>
