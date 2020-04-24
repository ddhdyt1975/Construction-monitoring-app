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
        Dashboard
        <small>Senior control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li  class="active"><a href="ManagerSM"><i class="fa fa-dashboard"></i> Home</a></li>
        
      </ol>
    </section>
    
    <section class="content">

        <div class="row">
            <div class="col-lg-7">
                <div class="box box-success ">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Project(s)</h3>
                        <div class="box-tools pull-right">
                        <span class="label label-danger"><?php echo $c1 ?></span>
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>   
                    <div class="box-body">
                        <table   class="table table-bordered table-hover" id="tables">
                            <thead>
                                <tr> <th>Project </th> <th>Project Manager</th><th>Completion %</th></tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
          
            <div class="col-lg-5">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Members</h3>
                        <div class="box-tools pull-right">
                            <span class="label label-danger"><?php echo $c5 ?> Members</span>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding" id ="conts">
                        <ul class="users-list clearfix" >
                      
                        </ul>
                    </div>
                    <div class="box-footer text-center">
                        <a href="" id="a5" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                                    <table  class="table table-striped table-bordered table-hover" id="table5s">
                                        <thead>
                                            <tr><th>Name</th><th>Email</th><th>Position</th><th>Address</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Name</th><th>Email</th><th>Position</th><th>Address</th>
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

   
    </section>

</div>



<script type="text/javascript">

    var table, table2, table3, table4, table5, table6, table7, table8;

    $(document).ready(function() {
        conts();
        table = $('#tables').DataTable();
        projs();
        table5 = $('#table5s').DataTable();
        
    });



    function projs(){
        table.destroy();
        table = $('#tables').DataTable({ 
            "scrollY" :"300",
            "ajax": {
            "url": "<?php echo site_url('ManagerSM/ajax_list')?>",
            "type": "POST"
            },
        });
    }

    $('#a2').click( function(e) {
        e.preventDefault();
        table2.destroy();
        $('#modal_form2').modal('show'); // show bootstrap modal
        $('.modal-title').text('Material View'); // Set Title to Bootstrap modal title
        table2 = $('#table2s').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerSM/ajax_list2')?>",
            "type": "POST"
            },
        });

    });
    
    $('#a3').click( function(e){
        e.preventDefault();
        table3.destroy();
        $('#modal_form3').modal('show'); // show bootstrap modal
        $('.modal-title').text('Equipment View'); // Set Title to Bootstrap modal title
        table3 = $('#table3s').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerSM/ajax_list3')?>",
            "type": "POST"
            },
        });
    });
    
    $('#a4').click( function(e) {
        e.preventDefault();
         table4.destroy();
        $('#modal_form4').modal('show'); // show bootstrap modal
        $('.modal-title').text('Supplier View'); // Set Title to Bootstrap modal title
     
        table4 = $('#table4s').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerSM/ajax_list4')?>",
            "type": "POST"
            },
        });
    });
    
    $('#a5').click( function(e) {
        e.preventDefault();
        table5.destroy();
        $('#modal_form5').modal('show'); // show bootstrap modal
        $('.modal-title').text('Users View'); // Set Title to Bootstrap modal title
        table5 = $('#table5s').DataTable({
            "ajax": {
            "url": "<?php echo site_url('ManagerSM/ajax_list5')?>",
            "type": "POST"
            },
            
        });
    });  

    $('#a6').click( function(e) {
        e.preventDefault();
        table6.destroy();
        $('#modal_form6').modal('show'); // show bootstrap modal
        $('.modal-title').text('Transfered Material View'); // Set Title to Bootstrap modal title
        table6 = $('#table6s').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerSM/ajax_list6')?>",
            "type": "POST"
            },
        });
    });  

    $('#a7').click( function(e) {
        e.preventDefault();
        table7.destroy();
        $('#modal_form7').modal('show'); // show bootstrap modal
        $('.modal-title').text('Transfered Equipment View'); // Set Title to Bootstrap modal title
        table7 = $('#tables7').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerSM/ajax_list7')?>",
            "type": "POST"
            },
        });
    });  

    $('#a8').click( function(e) {
        e.preventDefault();
        table8.destroy();
        $('#modal_form8').modal('show'); // show bootstrap modal
        $('.modal-title').text('Assigned Workers View'); // Set Title to Bootstrap modal title
        table8 = $('#table8s').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('ManagerSM/ajax_list8')?>",
            "type": "POST"
            },
        });
    });  

    function conts(){
        $('#conts ul').empty();
        $.ajax({
            url : "<?php echo site_url('ManagerSM/ajax_list5c/')?>" ,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data!=null){
                    for(i=0; i<data.length;i++){
                        $('#conts ul').append('<li>'+
                              '<img style="width:75px;height:75px;border-radius:50%" src="'+data[i]['user_photo']+'" alt='+data[i]['name']+'>'+
                              '<a class="users-list-name" href="#">'+data[i]['name']+'</a>'+
                              '<span class="users-list-date">'+data[i]['usertype_name']+'</span>'+
                        '</li>');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });
    }
    
</script>
