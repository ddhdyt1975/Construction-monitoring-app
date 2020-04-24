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
            Overview 
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="HumanR"><i class="fa fa-dashboard"></i> Home</a></li>
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
                            <a  id="hr1"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3><?php echo $c2 ?></h3>

                                <p>Employee(s)!</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-ios-people"></i>
                            </div>
                            <a  id="hr2"  href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                </div>
            </div>
        </div>

    </section>
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

<div class="modal fade" id="modal_form1" role="dialog">
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
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap" id="table1">
                                        <thead>
                                            <tr><th>Employee ID</th><th>Employee Name</th><th>Employee Address</th><th>Position</th></tr>
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


<script type="text/javascript">

    var table, table1;

    $(document).ready(function() {
        $('#hoa').attr("class","active");
        table = $('#table').DataTable();       
        table1 = $('#table1').DataTable();       
    });

    $('#hr1').click( function(e) {
        e.preventDefault();
        table.destroy();
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Project(s)');  
        table = $('#table').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('HumanR/ajax_list')?>",
            "type": "POST"
            },
        });
    });

     $('#hr2').click( function(e) {
        e.preventDefault();
        table1.destroy();
        $('#modal_form1').modal('show'); 
        $('.modal-title').text('Employee(s)');  
        table1 = $('#table1').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('HumanR/ajax_list1')?>",
            "type": "POST"
            },
        });
    });

    </script>
