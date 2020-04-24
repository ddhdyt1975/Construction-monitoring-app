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
            Requests Page!
            <small>(request equipments, material or etc from the other projects.)</small>
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="ManagerM"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="inactive"><a href="RequestsM"><i class="fa fa-exchange"></i> Requests</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12" >  
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-envelope"></i> </span>
                    <div class="info-box-content">
                        <a onclick="view_r2()"><span class="info-box-text">Received</span>
                        <span class="info-box-text">Requests<small>(unread)</small></span>
                        <span class="info-box-number" id ="recrequest"> </a></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 col-xs-12"> 
                <div class="info-box" id="view_r">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-info"></i></span>
                    <div class="info-box-content">
                        <a onclick="view_n()"><span class="info-box-text"><p></p></span>
                        <span class="info-box-text">Notification(s)</span>
                        <span class="info-box-number"  id = "myrequestbox"></span></a>
                    </div>
                </div>
            </div>
            
            <div class="clearfix visible-sm-block"></div>
            
            <div class="col-md-3 col-sm-6 col-xs-12" >
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-refresh"></i> <i class="ion  ion-ios-briefcase-outline"></i></span>
                    <div class="info-box-content">
                      <a onclick = "view_tranM()"><span class="info-box-text">Tranfered</span>
                      <span class="info-box-text">Material(s)</span>
                      <span class="info-box-number" id="transmatbox"> </a></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 col-xs-12" >
                <div class="info-box" >
                    <span class="info-box-icon bg-yellow"><i class="fa fa-refresh"></i> <i class="ion ion-wrench"></i></span>
                    <div class="info-box-content">
                      <a onclick="view_tranE()"><span class="info-box-text">Transfered</span>
                      <span class="info-box-text">Equipment(s)</span>
                      <span class="info-box-number" id = "transeqpbox"> </a></span>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="page-header"></div>

        <div class="row">
            <div id ="received_request" style="display:none;">
                <div class="col-md-3">
                    <a   onclick="view_r()" class="btn btn-primary btn-block margin-bottom">Create Request</a>
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Folders</h3>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                          <ul class="nav nav-pills nav-stacked">
                            <li ><a onclick = "view_r2()"><i class="fa fa-envelope"></i> Received Request
                                <span class="label label-primary pull-right" id = "mes3"></span></a>
                            </li>
                            <li ><a onclick = "view_r3()"><i class="fa fa-send"></i> Sent Request
                                <span class="label label-primary pull-right" ></span></a>
                            </li>
                             </ul>
                        </div>
                    </div> 
                 </div> 
             
                
                <div  >
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="box box-primary" id ="received_request_inbox" style="display:none;max-height:500px;height:300px; overflow-y:auto">
                            <div class="box-header with-border">
                              <h3 class="box-title">Inbox&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                                <small><i class="fa fa-star-o"></i> - read&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-star text-aqua"></i> - unread</small>
                            </div>
                            <div class="box-body no-padding">
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped" id = "tbl_mes">
                                    <thead><tr><th>Status</th><th>Sender</th><th>Message</th><th class="pull-right">Date</th></tr></thead>
                                        <tbody>
                                     
                                     
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        </div>

                        <div class="box box-primary" id ="sent_request_inbox" style="display:none;max-height:500px;height:300px; overflow-y:auto">
                            <div class="box-header with-border">
                              <h3 class="box-title">Sent request(s)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                                <!-- <small><i class="fa fa-star-o"></i> - read&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-star text-aqua"></i> - unread</small> -->
                            </div>
                            <div class="box-body no-padding">
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped" id = "tbl_sent">
                                    <thead><tr><th>Status (seen)</th><th>Receiver</th><th>Message</th><th class="pull-right">Date</th></tr></thead>
                                        <tbody>
                                     
                                     
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        </div>

                    </div>
                </div>
                 

                 
                <div id ="received_request_direct" style="display:none;">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Read Request</h3>
                                <div class="box-tools pull-right">
                                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="box-body no-padding" id= "message_body">
                                
                            </div>
                            
                            <div class="box-footer">
                                <!-- <div class="pull-right">
                                    <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
                                </div>
                                <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                                <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div id ="create_request" style="display:none;">
                <div class="col-lg-5">
                    <div class="box box-default  ">
                        <div class="box-header with-border">
                            <h3 class="box-title">Select Project to View <small> (this is for reference only)</small></h3>
                            <div class="box-tools pull-right">
                                <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">  
                            <div class = "form-group input-group">
                                <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                                <select id = "prjselectww"  class="form-control">
                                    <option></option>
                                    <?php foreach($projects as $each){ ?>
                                        <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                    <?php } ?>
                                </select>
                            </div>
                            <div id ="projdet" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               
                            </div>
                            <div id ="pers" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                            </div>
                            <div id ="projdeta" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                
                            </div>
                             <div id ="projdetb" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Request!</h3>
                            <div class="box-tools pull-right">
                                <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body"> 
                            <div class="row">
                                <form id="request_form">
                                    <div class="col-lg-5">
                                        <label>Project From <small>(other projects)</small></label>
                                        <div class = "form-group input-group">
                                        <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                                        <select id = "prjselectwwww" name = "prjselectwwww"  class="form-control">
                                            <option></option>
                                            <?php foreach($projects as $each){ ?>
                                                <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                            <?php } ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <label>Project To <small>(my projects)</small></label>
                                        <div class = "form-group input-group">
                                        <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                                        <select id = "prjselectwww" name = "prjselectwww"  class="form-control">
                                            <option></option>
                                            <?php foreach($myprojects as $each){ ?>
                                                <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                            <?php } ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 has-error">
                                        <label>Severity</label>
                                        <select id = "severity" name= "severity"  class="form-control ">
                                            <option></option>
                                            <option val ="1">1</option>
                                            <option val ="2">2</option>
                                            <option val ="3">3</option>
                                            <option val ="4">4</option>
                                            <option val ="5">5</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12 form-group">
                                        <label>Request Worker(s) needed <small>( i. e Mason, Plumber ... etc. Leave blank if there's no request)</small></label>
                                        <textarea class="form-control" id = "wreq" name = "wreq"></textarea>
                                    </div>
                                     
                                    <div class="col-lg-12 form-group">
                                        <label>Request Equipment(s) needed <small>( i. e Truck, Tracktor ... etc. Leave blank if there's no request)</small></label>
                                        <textarea class="form-control" id = "ereq" name = "ereq"></textarea>
                                    </div>
                                     
                                    <div class="col-lg-12 form-group">
                                        <label>Request Material(s) needed <small>( i. e Shove, Digger ... etc. Leave blank if there's no request)</small></label>
                                        <textarea class="form-control" id = "mreq" name = "mreq"></textarea>
                                    </div> 

                                    <div class="col-lg-12 form-group">
                                        <label>Remarks <small>( i. e suggestion, comment... etc. Leave blank if there's no remarks to make.)</small></label>
                                        <textarea class="form-control" id = "remarks" name = "remarks"></textarea>
                                    </div>
                                </form>
                                <div class="col-lg-12 form-group">
                                    <button class ="btn btn-info btn-block" id = "btnreq" onclick ="newReq()"><i class = "fa fa-plus" > Create Request Now!</i></button>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div> 
            </div>
        </div>

        <div class ="row">
            <div id ="transfer_mat_div" style="display:none;" >
                <div class="col-lg-6">
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Transfered Material</h3>
                            <div class="box-tools pull-right">
                                <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="dataTable_wrapper"> 
                                <table id="dataTables-tmu"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material"> 
                                    <thead> 
                                        <tr> 
                                            <th>Material</th> 
                                            <th>Transfered to</th> 
                                            <th>Date</th> 
                                            <th>Quantity</th>
                                          </tr> 
                                    </thead> 
                                    <tbody> 
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="box box-success  ">
                        <div class="box-header with-border">
                            <h3 class="box-title">Transfer Material!</h3>
                            <div class="box-tools pull-right">
                                <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body"> 
                            <form  id="form_transmaterial" class="form-group">
                                <div class ="row">
                                    <div class="form-group hidden">
                                        <label for="transmatqty">Task ID</label>
                                        <input type="text" class="form-control" id="transmatqty" name="transmatqty" placeholder = "Enter Task ID"/>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="col-lg-6">     
                                        <label>Transfer from Project</label>
                                        <div class = "form-group input-group">
                                            <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                                            <select id = "prjselectmat" name = "prjselectmat"  class="form-control">
                                                <option></option>
                                                <?php foreach($myprojects as $each){ ?>
                                                    <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                                <?php } ?>
                                            </select>
                                        </div> 
                                    </div>            
                                    
                                    <div class="col-lg-6"> 
                                        <label>Transfer to Project</label>
                                        <div class = "form-group input-group">
                                            <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                                            <select id = "prjselectmat2" name = "prjselectmat2"  class="form-control">
                                                <option></option>
                                                <?php foreach($projects as $each){ ?>
                                                    <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                                <?php } ?>
                                            </select>
                                        </div>             
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class = "row">
                                        <div class="col-lg-6">
                                            <label for="transmatname">Material to transfer - (quantity unit)</label>
                                            <div class = "form-group input-group">
                                                <span class="input-group-addon"><i class= "fa fa-briefcase"></i></span>
                                                <select id = "transmatname2" name="transmatname2" class="form-control">
                                                </select>  
                                            </div> 
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="transmatqty2">No of material to transfer:</label>
                                            <input type="number" class="form-control" id="transmatqty2" name="transmatqty2" placeholder = "Enter Quantity"/>
                                            <span class="help-block"></span>
                                        </div>

                                        <div class="form-group hidden">
                                            <label for="transmatqtydb">Task ID</label>
                                            <input type="text" class="form-control" id="transmatqtydb" name="transmatqtydb" placeholder = "Enter Task ID"/>
                                            <span class="help-block"></span>
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <div class=" form-group">
                                <button class ="btn btn-success btn-block" onclick ="transferMat()" id="btntrmat"><i class = "fa fa-exchange"> Transfer Now!</i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>

        <div class ="row">
            <div id ="transfer_eqp_div" style="display:none;" >
                <div class="col-lg-6">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tranfered Equipment(s)</h3>
                            <div class="box-tools pull-right">
                                <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>   
                        <div class="box-body">
                            <div class="dataTable_wrapper"> 
                                <table id="dataTables-teu"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material"> 
                                    <thead> 
                                        <tr> 
                                            <th>Equipment</th> 
                                            <th>Transfered to</th> 
                                            <th>Date</th> 
                                            <th>Quantity</th> 
                                             
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="col-lg-6">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Transfer Equipment!</h3>
                            <div class="box-tools pull-right">
                                <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body"> 
                            <form id="form_transequipment" class="form-group">
                                <div class ="row">
                                    <div class="col-lg-6">     
                                        <label>Transfer from Project</label>
                                        <div class = "form-group input-group">
                                            <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                                            <select id = "prjselecteqp" name = "prjselecteqp"  class="form-control">
                                                <option></option>
                                                <?php foreach($myprojects as $each){ ?>
                                                    <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                                <?php } ?>
                                            </select>
                                        </div> 
                                    </div>            
                                    
                                    <div class="col-lg-6"> 
                                        <label>Transfer to Project</label>
                                        <div class = "form-group input-group">
                                            <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                                            <select id = "prjselecteqp2" name = "prjselecteqp2"  class="form-control">
                                                <option></option>
                                                <?php foreach($projects as $each){ ?>
                                                    <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                                <?php } ?>
                                            </select>
                                        </div>             
                                    </div>
                                </div>

                                <div class = "row">
                                    <div class="col-lg-6">
                                    <label for="transeqpname">Equipment</label>
                                        <div class = "form-group input-group">
                                            <span class="input-group-addon"><i class= "fa fa-wrench"></i></span>
                                            <select id = "transeqpname2" name="transeqpname2" class="form-control">
                                        
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group hidden">
                                        <label for="transmatqty">Task ID</label>
                                        <input type="text" class="form-control" id="transmatqty" name="transmatqty" placeholder = "Enter Task ID"/>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="col-lg-6 ">
                                        <label for="transeqpqty">No of equipment to transfer:</label>
                                        <div class = "form-group ">
                                            <input type="number" class="form-control" id="transeqpqty2" name="transeqpqty2" placeholder = "Enter Quantity"/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class=" form-group">
                                <button class ="btn btn-warning btn-block" onclick="transferEqp()"><i class = "fa fa-exchange"> Transfer Now!</i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class ="row">
            <div id ="notif_div" style="display:none;" >
                <div class="col-lg-12">
                    <div class="box box-warning ">
                        <div class="box-header ">
                            <h3 class="box-title">Notification(s) </h3>
                            <div class="box-tools pull-right">
                                <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>   
                        <div class="box-body">
                            <div class=""> 
                                <table id="notif_table"  class="table  table-hover dataTable "    width="100%" > 
                                    <tbody> 
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div> 

    </section>
</div>

<script> 
    $(document).ready(function(){
        $('#Rp').attr("class","active");
        view_r2();
        transmbox();
        transebox();
        myreq();
        recrequest();
      

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

        table2 = $("#dataTables-teu").DataTable({
            "ajax": {
              "url": "<?php echo site_url('RequestsM/ajax_list_transeqp')?>/",
              "type": "POST"
            },
            responsive: true
        });

        table3 = $("#dataTables-tmu").DataTable({
            "ajax": {
                "url": "<?php echo site_url('RequestsM/ajax_list_transmat')?>/",
                "type": "POST"
            },  
            order:[[2, 'desc']],
            responsive: true,
        });
        
    });
 
    var month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var month2 = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    var days = ["Sunday","Monday","Tuesday", "Wednesday","Thursday","Friday","Saturday"];
    var table3;
    var table2;
    var projectSelected;
    var projectSelected2;
    var projectSelected3;
    var table_worker;
    var save_method;
    var table_worker_list;
    var date;
    var iii;

    window.setInterval(function(){
        recrequest();
        myreq();
    }, 10000);

    $('#prjselectww').change(function() {
        projectSelected = $(this).val();
        view(projectSelected);
        view2(projectSelected);
        viewDetails(projectSelected);
        viewDetails2(projectSelected);
    });

    $('#prjselectmat').change(function() {
        projectSelected = $(this).val();
        projectSelected2 = projectSelected;
        getMyMat(projectSelected);    
    });

    $('#prjselecteqp').change(function() {
        projectSelected = $(this).val();
        projectSelected3 = projectSelected;
        getMyEqp(projectSelected);    
    });

    $('#transmatname2').change(function() {
        projectSelected = $(this).val();
       // coutmymat(projectSelected, projectSelected2);    
    });

    function sortByKey(array, key) {
        return array.sort(function(a, b) {
            var x = a[key];
            var y = b[key];
            return ((x < y) ? 1 : ((x > y) ? -1 : 0));
        });
    }

    function reload_table(){
        table2.ajax.reload(null,false); 
        table3.ajax.reload(null,false);
    }

    function view_tranE(){
        $('#received_request').hide();
        $('#transfer_mat_div').hide();
        $('#create_request').hide();
        $('#notif_div').hide();
        $('#transfer_eqp_div').show();

        $("#dataTables-teu").dataTable().fnDestroy();
        
        table2 = $("#dataTables-teu").DataTable({
            "ajax": {
              "url": "<?php echo site_url('RequestsM/ajax_list_transeqp')?>/",
              "type": "POST"
            },
            responsive: true
        });
    }

    function view_tranM(){
        $('#received_request').hide();
        $('#transfer_eqp_div').hide();
        $('#create_request').hide();
        $('#notif_div').hide();
        $('#transfer_mat_div').show();

        $("#dataTables-tmu").dataTable().fnDestroy();

        table3 = $("#dataTables-tmu").DataTable({
            "ajax": {
                "url": "<?php echo site_url('RequestsM/ajax_list_transmat')?>/",
                "type": "POST"
            },  
            order:[[2, 'desc']],
            responsive: true,
        });


    }

    function view_r(){
        $('#received_request').hide();
        $('#transfer_eqp_div').hide();
        $('#transfer_mat_div').hide();
        $('#notif_div').hide();
        $('#create_request').show();
    }

    function seen_notif12(){
        var url = "<?php echo site_url('RequestsM/seen_notif')?>/";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
              
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }

    function view_n(){
        $('#received_request').hide();
        $('#transfer_eqp_div').hide();
        $('#transfer_mat_div').hide();
        $('#create_request').hide();
        $('#notif_div').show();

        $('#notif_table tbody').empty();

        var url = "<?php echo site_url('ManagerM/viewnotification')?>";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != null){
                    sortByKey(data, 'update_date')
                    for(i=0; i<data.length;i++){
                        var d = new Date(data[i]['update_date']);
                        if (data[i]['seen_by_PM']!=null){
                            $('#notif_table tbody').append('<p><a><i class="fa fa-flag text-aqua"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'+days[d.getDay()]+', '+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'</b><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Task "'+data[i]['projtsk_name']+'" in project "'+data[i]['project_title']+'" is updated by '+data[i]['updated_by']+' ('+data[i]['usertype_name']+') to '+data[i]['updated_percent'] +'%.</i></p>');
                        }
                        else{
                            $('#notif_table tbody').append('<p><a><i class="fa fa-flag text-aqua"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+days[d.getDay()]+', '+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Task "'+data[i]['projtsk_name']+'" in project "'+data[i]['project_title']+'" is updated by '+data[i]['updated_by']+' ('+data[i]['usertype_name']+') to '+data[i]['updated_percent'] +'%.</i></p>');
                        }
                    };     
                }
                seen_notif12();           
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

    function seen(id){
        var url = "<?php echo site_url('RequestsM/seen_message')?>/"+id;
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){

            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }

    function open_mess(id){
        $('#received_request_inbox').hide();
        $('#received_request_direct').show();
        $('#message_body').empty();
        var url = "<?php echo site_url('RequestsM/viewmessage2')?>/"+id;
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != null){
                   for(i=0; i<data.length;i++){
                        var d = new Date(data[i]['req_date']);
                       $('#message_body').append('<div class="mailbox-read-info">'+
                                     '<h3>From: '+data[i]['user_fname']+' '+data[i]['user_lname']+''+
                                    '<span class="mailbox-read-time pull-right">'+days[d.getDay()]+', '+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'</span></h3>'+
                                '</div>'+
                                  '<div class="mailbox-read-message">'+
                                    '<p>Hello '+data[i]['userr']+',</p>'+

                                    '<p>Severity level: <b>'+data[i]['request_severity']+'</b></p>'+

                                    '<p>'+data[i]['remarks']+'</p>'+

                                    '<p>'+data[i]['worker_req']+' '+

                                    '<p>'+data[i]['equipment_req']+' '+

                                    '<p>'+data[i]['material_req']+' '+

                                    
                                    '<p>Thanks,<br>'+data[i]['user_fname']+'</p>'+
                                '</div>');
                            seen(data[i]['request_id']);
                    };        
                }
                else {
                
                }             
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Warning!',
                    text: 'Something happen in getting messsages in database.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
            }
        });
    }

    function view_r3(){
        $('#notif_div').hide();
        $('#transfer_eqp_div').hide();
        $('#transfer_mat_div').hide();
        $('#create_request').hide();
        $('#received_request').show();
        $('#received_request_direct').hide();
        $('#received_request_inbox').hide();
        $('#sent_request_inbox').show();

        $('#tbl_sent tbody').empty();
        var url = "<?php echo site_url('RequestsM/viewmessages')?>";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != null){
                data = sortByKey(data, 'req_date');
                   for(i=0; i<data.length;i++){
                        if (data[i]['seen_date']!=null){
                            var d = new Date(data[i]['req_date']);
                            $('#tbl_sent tbody').append('<tr>'+
                                '<td class="mailbox-star"><center >'+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+', '+days[d.getDay()]+' '+data[i]['time']+'</center></td>'+
                                '<td class="mailbox-name"><a  onclick = "open_mess('+data[i]['request_id']+')" >'+data[i]['user_fname']+' '+data[i]['user_lname']+'</a></td>'+
                                '<td class="mailbox-subject"><b>Request</b> - Requested from '+data[i]['project_title']+' to '+data[i]['p1']+''+
                                '</td>'+
                                '<td class="mailbox-attachment"></td>'+
                                '<td class="mailbox-date">'+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'</td>'+
                            '</tr>');
                        }
                        else{
                            var d = new Date(data[i]['req_date']);
                            $('#tbl_sent tbody').append('<tr>'+
                                '<td class="mailbox-star"><center >not seen</center></td>'+
                                '<td class="mailbox-name"><a  onclick = "open_mess('+data[i]['request_id']+')" >'+data[i]['user_fname']+' '+data[i]['user_lname']+'</a></td>'+
                                '<td class="mailbox-subject"><b>Request</b> - Requested from '+data[i]['project_title']+' to '+data[i]['p1']+''+
                                '</td>'+
                                '<td class="mailbox-attachment"></td>'+
                                '<td class="mailbox-date">'+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'</td>'+
                            '</tr>');
                        }
                    };          
                }
                else {
                
                }             
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

    function view_r2(){
        $('#notif_div').hide();
        $('#transfer_eqp_div').hide();
        $('#transfer_mat_div').hide();
        $('#create_request').hide();
        $('#received_request').show();
        $('#received_request_direct').hide();
         $('#sent_request_inbox').hide();
        $('#received_request_inbox').show();

        $('#tbl_mes tbody').empty();
        var url = "<?php echo site_url('RequestsM/viewmessage')?>";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != null){
                data = sortByKey(data, 'req_date');
                   for(i=0; i<data.length;i++){
                        if (data[i]['seen_date']!=null){
                            var d = new Date(data[i]['req_date']);
                            $('#tbl_mes tbody').append('<tr>'+
                                '<td class="mailbox-star"><center ><i class="fa fa-star-o"></i></center></td>'+
                                '<td class="mailbox-name"><a  onclick = "open_mess('+data[i]['request_id']+')" >'+data[i]['user_fname']+' '+data[i]['user_lname']+'</a></td>'+
                                '<td class="mailbox-subject"><b>Request</b> - Requested from '+data[i]['project_title']+' to '+data[i]['p1']+''+
                                '</td>'+
                                '<td class="mailbox-attachment"></td>'+
                                '<td class="mailbox-date">'+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'</td>'+
                            '</tr>');
                        }
                        else{
                            var d = new Date(data[i]['req_date']);
                            $('#tbl_mes tbody').append('<tr>'+
                                '<td class="mailbox-star"><center ><i class="fa fa-star"></i></center></td>'+
                                '<td class="mailbox-name"><a  onclick = "open_mess('+data[i]['request_id']+')" >'+data[i]['user_fname']+' '+data[i]['user_lname']+'</a></td>'+
                                '<td class="mailbox-subject"><b>Request</b> - Requested from '+data[i]['project_title']+' to '+data[i]['p1']+''+
                                '</td>'+
                                '<td class="mailbox-attachment"></td>'+
                                '<td class="mailbox-date">'+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'</td>'+
                            '</tr>');
                        }
                    };          
                }
                else {
                
                }             
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

    function recrequest(){   
        $('#recrequest').empty();
        var url = "<?php echo site_url('RequestsM/countrecr')?>";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != null){
                    $('#recrequest').append(data);
                }
                else {
                    $('#recrequest').append('0');
                }
             
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

    function myreq(){
        $('#myrequestbox').empty();
        var url = "<?php echo site_url('ManagerM/countnotif')?>";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != null){
                    $('#myrequestbox').append(data);
                }
                else {
                    $('#myrequestbox').append('0');
                }
             
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
   
    function newReq(){
        $('#btnSavereq').text('Requesting...'); 
        $('#btnSavereq').attr('disabled',true);
        var url;
        url = "<?php echo site_url('RequestsM/newRequest')?>";
       
        $.ajax({
            url : url,
            type: "POST",
            data: $('#request_form').serialize(),
            dataType: "JSON",
            success: function(data){
              
            if(data.status){
                new PNotify({
                    title: 'Success!',
                    text: 'Information added successfully.',
                    type: 'success',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
                $('#request_form')[0].reset(); 
                myreq();
            }
            else{
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                }
            }
            $('#btnSavereq').text('Create request now!');
            $('#btnSavereq').attr('disabled',false);
            },
            error: function (jqXHR, textStatus, errorThrown){

                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });
                $('#btnSavereq').text('Create request now!'); 
                $('#btnSavereq').attr('disabled',false); 
            }
        });        
    }

    function transebox(id){
        $('#transeqpbox').empty();
        var url = "<?php echo site_url('RequestsM/countte')?>/";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != null){
                    $('#transeqpbox').append(data);
                }
                else {
                     $('#transeqpbox').append('0');
                }
              
             
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

    function transferEqp(){
        if (($('#prjselecteqp').val()!="")&&($('#prjselecteqp2').val()!="")&&($('#transeqpname2').val()!="")&&($('#transeqpqty2').val()!="")) {       
            if (confirm('Do you want to transfer this equipment?')){
                $('#btneqp').text('Transfering...'); 
                $('#btneqp').attr('disabled',true);
                var url = "<?php echo site_url('RequestsM/ajax_trans_equipment')?>/"+projectSelected3;
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form_transequipment').serialize(),
                    dataType: "JSON",
                    success: function(data){
                      
                        if(data.status){
                            new PNotify({
                                title: 'Success!',
                                text: 'Equipment is transfered successfully.',
                                type: 'success',
                                styling: 'bootstrap3',
                                nonblock: {
                                    nonblock: true
                                }
                            }); 
                           $("#form_transequipment")[0].reset();
                            reload_table();
                        }
                         else{
                            for (var i = 0; i < data.inputerror.length; i++){
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        new PNotify({
                            title: 'Psst!',
                            text: 'Equipment is already transfered but you can update it in Transfered Material table.',
                            type: 'warning',
                            styling: 'bootstrap3',
                            nonblock: {
                                nonblock: true
                            }
                        }); 
                    }
                });
                $('#btneqp').text('Transfer Now!'); 
                $('#btneqp').attr('disabled',false); 
                transebox();
            }
        }
        else{
            new PNotify({
                title: 'Warning!',
                text: 'Please complete the credentials.',
                type: 'warning',
                styling: 'bootstrap3',
                nonblock: {
                    nonblock: true
                }
            }); 
        }
    }
    
    function transmbox(){
        $('#transmatbox').empty();
        var url = "<?php echo site_url('RequestsM/counttm')?>/";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data !=null){
                    $('#transmatbox').append(data);
                }
                else{
                     $('#transmatbox').append('0');
                }
             
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Warning!',
                    text: 'Something happen in getting trasfer material details in database.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
            }
        });  
    }

    function transferMat(){
        if (($('#prjselectmat2').val()!="")&&($('#prjselectmat').val()!="")&&($('#transmatname2').val()!="")&&($('#transmatqty2').val()!="")) {       
            if (confirm('Do you want to transfer this material?')){
                $('#btntrmat').text('Transfering...'); 
                $('#btntrmat').attr('disabled',true);
                var url = "<?php echo site_url('RequestsM/ajax_trans_material')?>/" + projectSelected2;
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form_transmaterial').serialize(),
                    dataType: "JSON",
                    success: function(data){
                        
                        reload_table();

                        if(data.status){
                            new PNotify({
                                title: 'Success!',
                                text: 'Material is transfered successfully.',
                                type: 'success',
                                styling: 'bootstrap3',
                                nonblock: {
                                    nonblock: true
                                }
                            }); 
                           
                        $("#form_transmaterial")[0].reset();
                        }
                        else{
                            for (var i = 0; i < data.inputerror.length; i++){
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        new PNotify({
                            title: 'Warning!',
                            text: 'Material is already transfered but you can update it in Transfered Material table.',
                            type: 'warning',
                            styling: 'bootstrap3',
                            nonblock: {
                                nonblock: true
                            }
                        }); 
                    }
                });
                $('#btntrmat').text('Transfer Now!'); 
                $('#btntrmat').attr('disabled',false); 
                transmbox();
            }
        }
        else{
            new PNotify({
                title: 'Warning!',
                text: 'Please complete the credentials.',
                type: 'warning',
                styling: 'bootstrap3',
                nonblock: {
                    nonblock: true
                }
            }); 
        }
    }

    function getMyEqp(id) {
        $('#transeqpname2').empty();
        
        $.ajax({
            url : "<?php echo site_url('RequestsM/getMyEqp')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if(data.length>0){
                    $('#transeqpname2').append('<option></option>');
                    for(i=0; i<data.length;i++){
                        $('#transeqpname2').append('<option value='+data[i]['equipment_id']+' >'+data[i]['equipment_name']+'('+data[i]['quantity']+')</option>');
                    };
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }

    function getMyMat(id) {
        $('#transmatname2').empty();
        $('#transmatname2').append('<option></option>');
        $.ajax({
            url : "<?php echo site_url('RequestsM/getMyMat')?>/" + id ,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if(data.length>0){
                    for(i=0; i<data.length;i++){
                        $('#transmatname2').append('<option value='+data[i]['material_id']+' >'+data[i]['material_name']+' - ('+data[i]['quantity']+')</option>');
                    };
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }

    function view(id){
        $('#projdet').empty();
        $('#projdet').append('<dl class="dl-horizontal">');
        $.ajax({
            url : "<?php echo site_url('RequestsM/getI')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if(data.length>0){
                    if (data[0]['project_type'] == 'w/ Sub Contractor'){   
                        $('#projdet dl').append('<dt>Project Information</dt><dd></dd>'+
                            '<dt>Project Title</dt>'+
                            '<dd>'+data[0]['project_title']+'</dd>'+
                            '<dt>Project Manager</dt>'+
                            '<dd>'+data[0]['PM']+'</dd>'+
                            '<dt>Status</dt>'+
                            '<dd>'+data[0]['project_status']+'</dd>'+
                            '<dt>Project Type</dt>'+
                            '<dd>'+data[0]['project_type']+'</dd>'+
                            '<dd> - '+data[0]['project_sub_contractor']+'</dd>'+
                            '<dt>Address</dt>'+
                            '<dd>'+data[0]['addrsess']+''+
                        '</dd>');
                    }
                    if (data[0]['project_type'] == 'Company Contract'){   
                        $('#projdet dl').append('<dt>Project Information<dd></dd></dt>'+
                            '<dt>Project Title</dt>'+
                            '<dd>'+data[0]['project_title']+'</dd>'+
                            '<dt>Project Manager</dt>'+
                            '<dd>'+data[0]['PM']+'</dd>'+
                            '<dt>Status</dt>'+
                            '<dd>'+data[0]['project_status']+'</dd>'+
                            '<dt>Project Type</dt>'+
                            '<dd>'+data[0]['project_type']+'</dd>'+
                            '<dd> - '+data[0]['project_comp_contract']+'</dd>'+
                            '<dt>Address</dt>'+
                            '<dd>'+data[0]['addrsess']+''+
                        '</dd>');
                    }
                    if (data[0]['project_type'] == 'Hybrid'){   
                        $('#projdet dl').append('<dt>Project Information<dd></dd></dt>'+
                            '<dt>Project Title</dt>'+
                            '<dd>'+data[0]['project_title']+'</dd>'+
                            '<dt>Project Manager</dt>'+
                            '<dd>'+data[0]['PM']+'</dd>'+
                            '<dt>Status</dt>'+
                            '<dd>'+data[0]['project_status']+'</dd>'+
                            '<dt>Project Type</dt>'+
                            '<dd>'+data[0]['project_type']+'</dd>'+
                            '<dd> - '+data[0]['project_sub_contractor']+'</dd>'+
                            '<dd> - '+data[0]['project_comp_contract']+'</dd>'+
                            '<dt>Address</dt>'+
                            '<dd>'+data[0]['addrsess']+''+
                        '</dd>');
                    }
                $('#projdet dl').append('</dl><div class="page-header"></div>');
                }
                else{
                    $('#projdet dl').append('<dt><i>Project Information</i><dd> Retrieving information...</dd></dt>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }

    function view2(id){
        $('#pers').empty();
        $.ajax({
            url : "<?php echo site_url('RequestsM/getTasks')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if(data['data'] != 'no recorded task'){
                    $('#pers').append('<center>Overall progress: <b>'+data['data']+'%</b><div class="progress progress-sm"><div class="progress-bar progress-bar-striped active  progress-bar-success " style="width: '+data['data']+'%"></div></div>');
                }
                else{
                    $('#pers').append('<center><p>Overall progress:  <b>'+data['data']+'.</b></p></center>');
                }
                $('#pers').append('</dl><div class="page-header"></div>');
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }

    function viewDetails(id){
        $('#projdeta').empty();
        $.ajax({
            url : "<?php echo site_url('RequestsM/getEquip')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $('#projdeta').append('<b>Equipment used:</b><ul>');
                if(data.length>0){
                    for(i=0; i<data.length;i++){
                        $('#projdeta ul').append('<li><p>'+data[i]["equipment_name"]+' - '+data[i]["equip_qty"]+'</p></li>');
                    };   
                }
                else{
                    $('#projdeta ul').append('<li><p>No equipment used.</p></li>');
                }
                $('#projdeta').append('</ul>');
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }
    
    function viewDetails2(id){
        $('#projdetb').empty();
         $.ajax({
            url : "<?php echo site_url('RequestsM/getMat')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $('#projdetb').append('<b>Material used:</b><ul>');
                if(data.length>0){
                    for(i=0; i<data.length;i++){
                        $('#projdetb ul').append('<li><p>'+data[i]["material_name"]+' - '+data[i]["mat_qty"]+'</p></li>');
                    };
                }
                 else{
                    $('#projdetb ul').append('<li><p>No material used.</p></li>');
                }
                $('#projdetb').append('</ul>');
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
    }
</script>