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
<style>
    .progressDiv {
        width: 100%;
        height: 325px;

        position: relative;
        left: 0%;
        top: 0px;
        display: inline-block;
        border-radius: 2px;
    }

    .statChartHolder {
        width: 55%;
        height: 100%;
        position: relative;
        top: 0px;
        display: inline-block;
    }

    .statRightHolder {
        display: inline-block;
        height: 100%;
        width: 45%;
        position: relative;
        top: 0px;
        margin: 0;
    }
    .statRightHolder ul {
        list-style: none;
        margin: 0;
        width: 95%
    }
    .statRightHolder li {
        border-bottom: 1px solid #ccc;
        height: 85px;
        width: 95%;
        position: relative;
        top: -25px;
    }
    .statRightHolder h3 p {
        display: inline-block;
        margin-right: 10px;
        color: #B6B5B5;
        font-weight: 300;
        font-size: 38px;
    }
    .statRightHolder span {
        display: inline-block;
        color: #B6B5B5;
        font-size: 12px;
        font-weight: 300;
    }

    .statsLeft {
        list-style:none;
        display:inline-block;
        width:45%;
    }
    .statsLeft li {
        width: 100%;
        height: 14px;
        border: none;
        top: 5px;
        margin-bottom: 25px;
    }
    .statsLeft h3{
        font-size:17px;
        display: inline-block;
    }
    .statsLeft span{
        font-size: 17px;
        display:inline-block;
    }
    .statsRight {
        width: 45%;
        display: inline-block;
        position: absolute;
    }
    .statsRight li {
        width: 100%;
        height: 10px;
        border: none;
        top: 5px;
        margin-bottom: 10px;
    }
    .statsRight h3{
        font-size:17px;
        display: inline-block;
    }
    .statsRight span{
        font-size: 17px;
        display:inline-block;
    }
    /* Pie Chart */
    .progress-pie-chart {
      width:200px;
      height: 200px;
      border-radius: 50%;
      background-color: #E5E5E5;
      position: relative;
    }
    .progress-pie-chart.gt-50  {
      background-color: #81CE97;
    }

    .ppc-progress {
      content: "";
      position: absolute;
      border-radius: 50%;
      left: calc(50% - 100px);
      top: calc(50% - 100px);
      width: 200px;
      height: 200px;
      clip: rect(0, 200px, 200px, 100px);
    }
    .ppc-progress .ppc-progress-fill  {
      content: "";
      position: absolute;
      border-radius: 50%;
      left: calc(50% - 100px);
      top: calc(50% - 100px);
      width: 200px;
      height: 200px;
      clip: rect(0, 100px, 200px, 0);
      background:  #f84a38 ;
      transform: rotate(60deg);
    }
    .gt-50 .ppc-progress {
      clip: rect(0, 100px, 200px, 0);
    }
    .gt-50 .ppc-progress .ppc-progress-fill  {
      clip: rect(0, 200px, 200px, 100px);
      background: #E5E5E5;
    }

    .ppc-percents {
      content: "";
      position: absolute;
      border-radius: 50%;
      left: calc(50% - 173.91304px/2);
      top: calc(50% - 173.91304px/2);
      width: 173.91304px;
      height: 173.91304px;
      background: #fff;
      text-align: center;
      display: table;
    }
    .ppc-percents span {
      display: block;
      font-size: 2.6em;
      font-weight: bold;
      color: #81CE97;
    }

    .pcc-percents-wrapper {
      display: table-cell;
      vertical-align: middle;
    }
    .progress-pie-chart {
      margin: 50px auto 0;
    }
    .blue {
     
      font-family:Times;
      font-weight:bold;
    }
    .blueh{
     
      font-family:Times;
    }
    .dtask {
      font-size: 17px;
    }

    #addworker .modal-dialog  {
      width:39%;
    }

    #prjdetails{
        margin-top: 0px;
    }  
    #loading {
       width: 100%;
       height: 100%;
       top: 0;
       left: 0;
       position: center;
       display: block;
       opacity: 1.0;
       background-color: #fff;
       z-index: 99;
       text-align: center;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Projects
            <small>(projects displayed are assigned by admin)</small>
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="ManagerM"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="ProjectsSM"><i class="fa fa-book"></i> Projects</a></li>
        </ol>
    </section>
    
    <section class="content">
 
        <div class="row">
            <div class="col-lg-12">
            <label >Select Project to View</label>
                <div class = "form-group input-group">
                <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                <select id = "prjselect"  class="form-control">
                    <option></option>
                    <?php foreach($projects as $each){ ?>
                        <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                    <?php } ?>
                </select>
                </div>
            </div>

            <div class="col-lg-12">
                <div  class="row" >
                    <br>
                    <div id = "prjchart">
                    </div>

                    <div class="col-lg-4" id = "tsssk" style = "display:none;">
                       <div class="box box-danger  ">
                            <div class="box-header with-border">
                                <h3 class="box-title">Project Task</h3>
                                <div class="box-tools pull-right">
                                    <button onclick="addtask();" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Add new Task(s)</button>
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body" class="box-collapse"  >
                                <div id = "prjtsk">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-lg-3" id = "acts" style = "display:none;"  >
                        <div class="box box-primary">
                            <div class="box-header  with-border">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Planned Activities</h3>
                                <div class="box-tools pull-right">
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body" >
                                <div class="row">
                                    <div class="col-lg-12" id ="actss" >
                                        <ul class="todo-list" id ="todo_li">

                                        </ul>
                                    </div>
                                </div> 
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="row">  
                    <div  id= "viewsup" style = "display:none;">
                        <div class="col-lg-6">
                            <div class="box box-info collapsed-box box-solid">
                                <div class="box-header with-border">
                                <h3 class="box-title"> Material Used</h3>
                                <div class="box-tools pull-right">
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                </div> 
                                <div class="box-body" >
                                    <div class="dataTable_wrapper">
                                        <table id="dataTables-material"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                                            <thead>
                                                <tr>
                                                    <th>Material Name</th>
                                                    <th>Quantity</th>
                                                    <th>Date Used</th>
                                                    <th>Supplier</th>
                                                     
                                                </tr>
                                            </thead>
                                            <tbody>
                                                

                                            </tbody>
                                            <tfoot>
                                         
                                                <th>Material Name</th>
                                                <th>Quantity</th>
                                                <th>Date Used</th>
                                                <th>Supplier</th>
                                                
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>  
                                
                            </div>
                        </div>
                                
                        <div class="col-lg-6 hidden">
                            <div class="box box-warning collapsed-box box-solid">
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
                                            <tfoot> 
                                                <th>Material</th> 
                                                <th>Transfered to</th> 
                                                <th>Date</th> 
                                                <th>Quantity</th> 
                                                 
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                                 
                        <div class="col-lg-6">
                            <div class="box box-warning collapsed-box box-solid">
                                <div class="box-header with-border">
                                <h3 class="box-title">Equipment Used</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="dataTable_wrapper">
                                        <table id="dataTables-equipment"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                                            <thead>
                                                <tr>
                                                    <th>Equipment Name</th>
                                                    <th>Quantity</th>
                                                   
                                                    <th>Date Used</th>
                                                    <th>Supplier</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                

                                            </tbody>
                                            <tfoot>
                                                <th>Equipment Name</th>
                                                <th>Quantity</th>
                                                
                                                <th>Date Used</th>
                                                <th>Supplier</th>
                                                 
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-lg-6 hidden">
                            <div class="box box-warning collapsed-box box-solid">
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
                                            <tfoot> 
                                                <th>Equipment</th> 
                                                <th>Transfered to</th> 
                                                <th>Transfer Date</th> 
                                                <th>Quantity</th> 
                                                 
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

        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-success">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form" class="form-group">
                            <div class="form-group">
                                <label for="prjcode">Project Code</label>
                                <input type="text" class="form-control" id="prjcode" name="prjcode" placeholder = "Enter Project Code"/>
                                <span class="help-block"></span>

                            </div>
 
                           
                      
                            <div class="form-group">
                                <label for="prjtitle">Project Title</label>
                                <input type="text" class="form-control" id="prjtitle" name="prjtitle" placeholder="Enter Project Title"/>
                                <span class="help-block"></span>

                            </div>
                            
                            <div class="form-group">
                                <label for="prjdecs">Project Description  <span class ="fa fa-comment"></span></label>
                                <textarea type="text" class="form-control" id="prjdesc" name="prjdesc" placeholder="Enter Project Description"> </textarea>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group ">
                                <label for="prjdstatus">Project Status</label>
                                     <select id = "prjstatus" name="prjstatus" class="form-control">
                                        <option value=""></option>
                                        <option value="On-Going">On-Going</option>
                                        <option value="Under Construction">Under Construction</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                    <span class="help-block"></span>
                             </div>

                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-6">
                                        <label for="prjdstatus">Project Address</label>
                                        <input class="form-control" id="prjaddr" name="prjaddr" placeholder= "Address Here"  type="text">
                                        <span class="help-block"></span>
                                    </div>
                                   
                                    <div class="col-lg-6">
                                        <label for="prjpercent">City</label>
                                         <select id = "prjcity" name="prjcity" class="form-control">
                                            <option value=""></option>
                                                <?php foreach($cities as $cobject)
                                                    echo '<option value='.$cobject->city_id.'>'.$cobject->city_name.', '.$cobject->province_name.'</option>'
                                                ?>
                                        </select>
                                        
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-6">
                                        <label for="prjstrt">Project Start Date:</label>
                                        <input type="text" name="prjstrt" id="prjstrt"  class="form-control clsDatePicker">
                                        <span class="help-block"></span>
                                    </div>
                                   
                                    <div class="col-lg-6">
                                        <label for="prjend">Project End Date:</label>
                                         <input type="text" name="prjend" id="prjend"  class="form-control clsDatePicker">
                                        
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="prjtype">Project Type</label>
                                <select id = "prjtype" name="prjtype" class="form-control">
                                    <option value=""></option>
                                    <option value="w/ Sub Contractor">w/ Sub Contractor</option>
                                    <option value="Company Contract">Company Contract</option>
                                    <option value="Hybrid">Hybrid</option>
                                </select>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group" style="display:none" id="gprjscn">
                                <label for="prjscn">Sub-Contractor Name</label>
                                <input class="form-control" id="prjscn" name="prjscn"  type="text">
                            </div>

                            <div class="form-group" style="display:none" id="gprjcn" name="gprjcn">
                                <label for="prjcn">Contract Name</label>
                                <input class="form-control" id="prjcn" name="prjcn" type="text">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_task" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-success">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_addtask" class="form-group">
                            <div class="form-group hidden">
                                <label for="tskid">Task ID</label>
                                <input type="text" class="form-control" id="tskid" name="tskid" placeholder = "Enter Task ID"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-6">
                                    <label for="prjmng">Task</label>
                                        <select id = "tskname" name="tskname" class="form-control">
                                        <option value=""></option>
                                            <?php foreach($task as $cobject)
                                                echo '<option value='.$cobject->projtsk_id.'>'.$cobject->projtsk_name.'</option>'
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="tskpercent">Percentage</label>
                                        <input type="number" class="form-control" id="tskpercent" name="tskpercent" placeholder = "Enter Task Percentage"/>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSavet" onclick="save2()" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_task_comment" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-success">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_addtask_comment" class="form-group">

                            <div class="form-group hidden">
                                <label for="tskidcom2">Task ID</label>
                                <input type="text" class="form-control" id="tskidcom2" name="tskidcom2" placeholder = "Enter Task ID"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group hidden">
                                <label for="tskidcom1">Task ID</label>
                                <input type="text" class="form-control" id="tskidcom1" name="tskidcom1" placeholder = "Enter Task ID"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group ">
                                <label for="prjdstatus">Select Status</label>
                                <select id = "prjstatus_com" name="prjstatus_com" class="form-control">
                                    <option value=""></option>
                                    <option value="Unresolved">Unresolved</option>
                                    <option value="Progress">Progress</option>
                                    <option value="Critical">Critical</option>
                                    <option value="Open">Open</option>
                                    <option value="Resolved">Resolved</option>
                                    <option value="Closed">Closed</option>
                                </select>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="prjtask_com">Add Comment<span class ="fa fa-comment"></span></label>
                                <textarea type="text" class="form-control" id="prjtask_com" name="prjtask_com" placeholder="Enter Task Comment"></textarea>
                                <span class="help-block"></span>
                            </div>
                           
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSavec" onclick="saveC()" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>         
    </section>
</div>


<script>
 var projectSelected;
    var month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var month2 = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    var days = ["Sunday","Monday","Tuesday", "Wednesday","Thursday","Friday","Saturday"];
    var days2 = ["Sun","Mon","Tue", "Wed","Thu","Fri","Sat"];
   var save_method;
   var id2;
   var table, table2, table3, table4, table5;
   var idm, idm2;


    $('#prjselect').change(function() {

        var projectSelected = $(this).val();

        id2 = projectSelected;
        listproj(id2);
       $('#prjchart').empty();
        
        showChart(id2);
        //showprojectdetails(id2);
       
        $('#tsssk').hide();
        $('#acts').hide();       
        $('#viewsup').hide();
        $("#loading").fadeOut("slow");
    });


    $(document).ready(function(){
        $('#prjtype').on('change', function(){
            
            if (this.value == "w/ Sub Contractor"){
                $("#gprjscn").show();
                $("#gprjcn").hide();
            }
            else if (this.value == "Company Contract"){
                $("#gprjscn").hide();
                $("#gprjcn").show();
            }
            else if (this.value == "Hybrid"){
                $("#gprjscn").show();
                $("#gprjcn").show();
            }
            else{   
               $("#gprjscn").hide();
                $("#gprjcn").hide();
            }

        });
        $("#gprjscn").hide();
        $("#gprjcn").hide();    
    });

    function listproj(id){
         
        $('#trncom').empty();
        $('#trncom2').empty();
         $.ajax({
            url : "<?php echo site_url('ProjectsSM/Projs/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                 
                for(i=0; i<data.length;i++){
                    $('#trncom').append('<option value='+data[i]['project_code']+'>'+data[i]['project_title']+'</option>');
                    $('#trncom2').append('<option value='+data[i]['project_code']+'>'+data[i]['project_title']+'</option>');
                };
          },
          error: function (jqXHR, textStatus, errorThrown) {
             
          }
        });  
    }
    
    function reload_table(){
        table2.ajax.reload(null,false); 
        table3.ajax.reload(null,false);
        table4.ajax.reload(null,false);
        table5.ajax.reload(null,false);
    }

    function DeleteTask(id){

        if(confirm('Do you want to delete this Task?'))
        {
                $.ajax({
                url : "<?php echo site_url('ProjectsSM/ajax_delete_task')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    $('#prjchart').empty();
                $('#prjdetails').empty();
                showChart(id2);
                //showprojectdetails(id2);
                $('#tsssk').hide();
                $('#viewsup').hide();
                $('#add_task').modal('hide');
                   
                    new PNotify({
                    title: 'Yeah!',
                    text: 'Task is deleted successfully.',
                    type: 'success',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 

               
                },
                error: function (jqXHR, textStatus, errorThrown){
                    
                    new PNotify({
                        title: 'Oh no!',
                        text: 'Error in deleting.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 

             
                }
            });

        }        
    }

    function getTaskCom(id){
        var today = new Date();
        var dd = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
      
        
        $("#div"+id+" ul").empty();
        
       $.ajax({
            url : "<?php echo site_url('ProjectsSM/getTasksCom/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){   
                if (data!=null){
                    
                    for(i=0; i<data.length;i++){
                        //alert(data[i]['prjtsk_comm_id']);
                        if (data[i]['prjtsk_status']=='Unresolved'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" class="text-danger"><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'. <a onclick = "editcom('+data[i]['prjtsk_comm_id']+')"><i class ="fa fa-pencil" style="color:green" title="edit this Issue"></i ></a> </p></li>');
                        }
                        if (data[i]['prjtsk_status']=='Progress'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" class="text-info"><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'. <a onclick = "editcom('+data[i]['prjtsk_comm_id']+')"><i class ="fa fa-pencil" style="color:green" title="edit this Issue"></i ></a> </p></li>');
                        }
                        if (data[i]['prjtsk_status']=='Critical'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" class="text-warning"><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'. <a onclick = "editcom('+data[i]['prjtsk_comm_id']+')"><i class ="fa fa-pencil" style="color:green" title="edit this Issue"></i > </a> </p></li>');
                        }
                        if (data[i]['prjtsk_status']=='Open'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" class="text-success"><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'. <a onclick = "editcom('+data[i]['prjtsk_comm_id']+')"><i class ="fa fa-pencil" style="color:green" title="edit this Issue"></i ></a> </p></li>');
                        }

                        if ((data[i]['prjtskcom_update'] == dd)&&(data[i]['prjtsk_status']=='Resolved')||data[i]['prjtsk_status']=='Closed'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" ><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'. <a onclick = "editcom('+data[i]['prjtsk_comm_id']+')"><i class ="fa fa-pencil" style="color:green" title="edit this Issue"></i ></a> </p></li>');
                        }
                    };
                }
                else{
                    $('#div'+id+' ul').append('<li><p style="font-size:10px;" class ="texr-muted">Some issue is either Closed, Resolved or no Record.</p></li>');
                }
            }
        });
    }

    function addtask(){
        save_method = 'addtask';
        $('#form_addtask')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#add_task').modal('show');  
        $('.modal-title').text('Add new Task'); 
        $('#tskname').attr("disabled",false);    
    }

    function addtaskcomment(id){
        
        save_method = 'addtaskcom';
        $('#form_addtask_comment')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#add_task_comment').modal('show');  
        $('.modal-title').text('Add Task Issue'); 
        $('#tskidcom2').val(id);
    }

    function save2(){
        
        $('#btnSavet').text('Saving...'); 
        $('#btnSavet').attr('disabled',true);
        var url;
       
        if (save_method =='updatetask'){
            //alert('1');
            url = "<?php echo site_url('ProjectsSM/ajax_update_task')?>/"+id2;
        }
        else{ 
            url = "<?php echo site_url('ProjectsSM/ajax_add_task')?>/"+id2;
        }

        $.ajax({
          url : url,
          type: "POST",
          data: $('#form_addtask').serialize(),
          dataType: "JSON",
          success: function(data)
          {
              
            if(data.status) 
              {
                $('#prjchart').empty();
                $('#prjdetails').empty();
                showChart(id2);
                //showprojectdetails(id2);
                $('#tsssk').hide();
                $('#viewsup').hide();
                $('#add_task').modal('hide');
                
                if (save_method=='updatetask'){
                    new PNotify({
                        title: 'Hey!',
                        text: 'Task is updated successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 

                    // $('#alert_modal').modal('show');  
                    // $("#myDialogText").text("Task updated.");
                }
                else{
                     new PNotify({
                        title: 'Yeah!',
                        text: 'Task is added successfully.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                    // $('#alert_modal').modal('show');  
                    // $("#myDialogText").text("Task Added.");
                }
               }
            else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                  }
              }

              $('#btnSavet').text('Save'); //change button text
              $('#btnSavet').attr('disabled',false); //set button enable 


          },
          error: function (jqXHR, textStatus, errorThrown)
          {
               if (save_method=='updatetask'){
                    new PNotify({
                        title: 'Oh No!',
                        text: 'Error in updating task.',
                        type: 'error',
                        styling: 'bootstrap3'
                    }); 
                    // $('#alert_modal').modal('show');  
                    // $("#myDialogText").text("Error in updating task.");
                }
                else{
                    new PNotify({
                        title: 'Oh No!',
                        text: 'Error in adding task. Task already registered. You may update task by clicking the update button beside the task name.',
                        type: 'error',
                        styling: 'bootstrap3'
                    }); 
                    // $('#alert_modal').modal('show');  
                    // $("#myDialogText").text("Error in adding task. Task already registered. You may update task by clicking the update button beside the task name.");
                }
              $('#btnSavet').text('Save'); 
              $('#btnSavet').attr('disabled',false); 

          }
        });
        $('#btnSavet').text('Save'); 
        $('#btnSavet').attr('disabled',false); 
    }

    function saveC(){
        
        $('#btnSavec').text('Saving...'); 
        $('#btnSavec').attr('disabled',true);
        var url;
       
        if (save_method =='updatetaskcom'){
            url = "<?php echo site_url('ProjectsSM/ajax_update_taskcomm')?>/"+id2;
        }
        else{
           url = "<?php echo site_url('ProjectsSM/ajax_add_taskcomm')?>/"+id2;
        }

        $.ajax({
          url : url,
          type: "POST",
          data: $('#form_addtask_comment').serialize(),
          dataType: "JSON",
          success: function(data){
              
            if(data.status) 
              {
                $('#prjchart').empty();
                $('#prjdetails').empty();
                showChart(id2);
                //showprojectdetails(id2);
                $('#tsssk').hide();
                $('#viewsup').hide();
                $('#add_task_comment').modal('hide');
                
                if (save_method=='updatetaskcom'){
                   new PNotify({
                        title: 'Hey!',
                        text: 'Issue is updated successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                }
                else{
                    new PNotify({
                        title: 'Psst!',
                        text: 'Issue is added successfully.',
                        type: 'warning',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                    // $('#alert_modal').modal('show');  
                    // $("#myDialogText").text("Issue Added.");
                }
                $('#prjtask_com').val();
                $('#prjstatus_com').val('');
            }
            else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                  }
              }

              $('#btnSavec').text('Save'); 
              $('#btnSavec').attr('disabled',false); 
          },
          error: function (jqXHR, textStatus, errorThrown)          {
               if (save_method=='updatetaskcom'){
                    new PNotify({
                        title: 'Oh No!',
                        text: 'Error in updating task issue.',
                        type: 'error',
                        styling: 'bootstrap3'
                    }); 

                }
                else{
                    new PNotify({
                        title: 'Oh No!',
                        text: 'Error in adding Issue. Issue already registered. You may update task by clicking the update button beside the task name.',
                        type: 'error',
                        styling: 'bootstrap3'
                    }); 

                    // $('#alert_modal').modal('show');  
                    // $("#myDialogText").text("Error in adding Issue. Issue already registered. You may update task by clicking the update button beside the task name.");
                }
              $('#btnSavec').text('Save'); 
              $('#btnSavec').attr('disabled',false); 

          }
        });
            $('#btnSavec').text('Save'); 
            $('#btnSavec').attr('disabled',false); 
    }

    function editcom(id){
      
        save_method = 'updatetaskcom';
        $('#form_addtask_comment')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();

        $.ajax({
            url : "<?php echo site_url('ProjectsSM/ajax_edit_comment/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data.material_name);
                $('[name="tskidcom1"]').val(data.prjtsk_comm_id);
                $('[name="tskidcom2"]').val(data.projdtsk_id);
                $('[name="prjstatus_com"]').val(data.prjtsk_status);
                $('[name="prjtask_com"]').val(data.prjtsk_comment);                
                
                $('#add_task_comment').modal('show');  
                $('.modal-title').text('Update Task Issue'); 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#alert_modal').modal('show');  
                $("#myDialogText").text("Error getting Data into the Server.");
            }
        });
    }

    function updateTask(id){
        save_method = 'updatetask';
        $('#form_addtask')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        //alert(id+""+"<?php echo date("Y-m-d") ?>");
        //alert(id);

        $.ajax({
            url : "<?php echo site_url('ProjectsSM/ajax_edit_task/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data["status"])
                //alert(data.projtsk_id);
                $('[name="tskid"]').val(data.projdtsk_id);
                $('[name="tskname"]').val(data.projtsk_id);
                //$('#tskname').attr("disabled", "disabled");
                $('[name="tskpercent"]').val(data.projdtsk_percent);
              
                $('#add_task').modal('show');  
                $('.modal-title').text('Update Task');  

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                new PNotify({
                    title: 'Oh No!',
                    text: 'Error getting Data into the Server.',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 

                  
            }
        });
    }

    function view_transactions(id){ 

        $('#viewsup').show();
      
        $("#dataTables-material").dataTable().fnDestroy();
        $("#dataTables-teu").dataTable().fnDestroy();
        $("#dataTables-equipment").dataTable().fnDestroy();
        $("#dataTables-tmu").dataTable().fnDestroy();

            table2 = $('#dataTables-material').DataTable({ 
                ajax: {
                        "url": "<?php echo site_url('ProjectsSM/ajax_list2')?>/" + id,
                        "type": "POST"
                    },
                    responsive: true
                });


            table3 = $("#dataTables-tmu").DataTable({
                ajax: {
                    "url": "<?php echo site_url('ProjectsSM/ajax_list_transmat')?>/" + id,
                    "type": "POST"
                },  
                responsive: true
            });

            table4 = $("#dataTables-equipment").DataTable({
                ajax: {
                  "url": "<?php echo site_url('ProjectsSM/ajax_list4')?>/" + id,
                  "type": "POST"
                },
                responsive: true
            });

            table5 = $("#dataTables-teu").DataTable({
                ajax: {
                  "url": "<?php echo site_url('ProjectsSM/ajax_list_transeqp')?>/" + id,
                  "type": "POST"
                },
                responsive: true
            });
    }

    function DisplayTask(id){
        $("#tsssk").show();
        $("#prjtsk").empty();
        
        $.ajax({
            url : "<?php echo site_url('ProjectsSM/getTasks/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){   
                
                for(i=0; i<data.length;i++){

                    if ((data[i]['projdtsk_percent'] >= 75 ) && (data[i]['projdtsk_percent'] <= 100 )) {
                        $('#prjtsk').append(''+
                                            '<div class ="well" id="div'+data[i]['projdtsk_id']+'" ><p style="font-size:12px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong></text><text class="pull-right"> <button data-toggle="tooltip" data-placement="top" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title= "Add Comment" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" class="btn btn-primary btn-xs"><i class="fa fa-comment"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button> </text></p>'+
                                                '<div class="progress ">'+
                                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" id = '+data[i]['projtsk_id']+' role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;">'+
                                                        ''+data[i]['projdtsk_percent']+'% Complete'+
                                                    '</div>'+
                                                '</div>Encountered issue:<ul> </ul>'+
                                            '</div>'+
                                        '');                                       
                        $('#'+data[i]['projtsk_id']+'').css('width', data[i]['projdtsk_percent']+'%').attr('aria-valuenow',  data[i]['projdtsk_percent']); 
                    }

                    else if ((data[i]['projdtsk_percent'] >= 50)&&(data[i]['projdtsk_percent'] < 75)){
                        $('#prjtsk').append(''+
                                        '<div class ="well" id="div'+data[i]['projdtsk_id']+'"><p style="font-size:12px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong></text><text class="pull-right"> <button data-toggle="tooltip" data-placement="top" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title= "Add Comment" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" class="btn btn-primary btn-xs "><i class="fa fa-comment"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button> </text></p>'+
                                            '<div class="progress ">'+
                                                '<div class="progress-bar progress-bar-warning progress-bar-striped active" id = '+data[i]['projtsk_id']+' role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;">'+
                                                    ''+data[i]['projdtsk_percent']+'% Complete'+
                                                '</div>'+
                                            '</div>Encountered issue:<ul> </ul>'+
                                        '</div> '+
                                    '');                                       
                        $('#'+data[i]['projtsk_id']+'').css('width', data[i]['projdtsk_percent']+'%').attr('aria-valuenow',  data[i]['projdtsk_percent']); 
                    }

                    else if ((data[i]['projdtsk_percent'] >= 0)&&(data[i]['projdtsk_percent'] < 50)){
                        $('#prjtsk').append(''+
                                        '<div class ="well" id="div'+data[i]['projdtsk_id']+'"><p style="font-size:12px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong></text><text class="pull-right"> <button data-toggle="tooltip" data-placement="top" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title= "Add Comment" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" class="btn btn-primary btn-xs "><i class="fa fa-comment"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button></text> </p>'+
                                            '<div class="progress ">'+
                                                '<div class="progress-bar progress-bar-danger progress-bar-striped active" id = '+data[i]['projtsk_id']+' role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;">'+
                                                    ''+data[i]['projdtsk_percent']+'% Complete'+
                                                '</div>'+
                                            '</div>Encountered issue:<ul> </ul>'+
                                        '</div> '+
                                    '');                                       
                        $('#'+data[i]['projtsk_id']+'').css('width', data[i]['projdtsk_percent']+'%').attr('aria-valuenow',  data[i]['projdtsk_percent']); 
                    }
                
                getTaskCom(data[i]['projdtsk_id']);
                };
             
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#'+data[i]['projtsk_id']+'').css('width', "0"+'%').attr('aria-valuenow',  "0");
            }
        });
    }

    function showprojectdetails(projectSelected){
        $("#tit").empty();
        $.ajax({
          url : "<?php echo site_url('ProjectsSM/ProjDetails/')?>/" + projectSelected,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $("#tit").append(data['project_title']);
            $('#prjdetails').append('<dl>'+
                /*'<p class="blueh">Project Title: <text style="font-family:Times;font-size:25px;color:black;"><u>'+data['project_title']+'</u></text></p>'+*/
                '<dt>Project Manager: </dt><dd>'+data['user_fname']+' '+data['user_lname']+' ('+data['user_email']+') </dd>'+
                '<dt>Project Status: </dt><dd>'+data['project_status']+' </dd>'+
                '<dt>Project Address:  </dt><dd>'+data['project_address']+', '+data['city_name']+', '+data['province_name']+' </dd>'+
                '<dt>Project Type: </dt><dd>'+data['project_type']+' </dd>'+
                '<dt>Sub Contractor: </dt><dd>'+data['project_sub_contractor']+'</dd>'+
                '<dt>Company Contract: </dt><dd>'+data['project_comp_contract']+'</dd>'+
                '<dt>Project Description:  </dt><dd>'+data['project_desc']+' </dd>'+
                '</dl>');
                view_transactions(id2);
                DisplayTask(id2);
                viewNext(id2);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            //alert('Error get data from ajax');
          }
        });  
    }

    function sortByKey(array, key) {
        return array.sort(function(a, b) {
            var x = a[key];
            var y = b[key];
            return ((x < y) ? 1 : ((x > y) ? -1 : 0));
        });
    }

    function viewNext(id){
        $("#acts").show();
        $("#todo_li").empty();
        $.ajax({
            url : "<?php echo site_url('ProjectsSM/viewActs/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.length>0){
                    data = sortByKey(data, 'postDate');
                    for (i =0; i<data.length; i++){
                        var d = new Date(data[i]['postDate']);
                        if (data[i]['status']==null){
                            //alert(data[i]['nextAct']);
                            $("#todo_li").append('<li>'+
                                '<text><small><span> '+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'</span></small></text>'+
                                '<span class="text">'+data[i]['projtsk_name']+' - '+data[i]['nextAct']+'</span>'+
                                '<small class="label label-danger"><i class="fa fa-clock-o"></i> '+data[i]['time']+'</small>'+
                            '</li>');
                       }
                    };
                }
                else{
                    $('#todo_li').append(' <li>'+
                        '<span class="text">No recorded Planned Activity found.</span>'+
                    '</li>');
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
             
            }
        });  
    }

    function showChart(id){
        var total1 = 0, total2 = 0;
        $("#prjchart").empty();
        $.ajax({
            url : "<?php echo site_url('ProjectsSM/getTasks/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data!=null){
               for(i=0; i<data.length;i++){
                    total = parseInt(data[i]['projdtsk_percent']); 
                    total2 = total2 + total;
                };
               
                $('#prjchart').append('<div class="col-lg-5">'+
                          '<div class="box box-success box-solid">'+
                              '<div class="box-header with-border">'+
                                  '<h3 class="box-title">Project Chart</h3>'+
                                    '<div class="box-tools pull-right">'+
                                        '<button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>'+
                                        '</button>'+
                                    '</div>'+
                                '</div>'+
                               
                                  '<div class="box-body" >'+
                                    '<div align="center">'+
                                     '<h2>'+data[0]['project_title']+'</h2>'+
                                     '</div>'+    
                                      '<div class="progressDiv">'+
                                          '<div class="statChartHolder">'+
                                              '<div class="progress-pie-chart" data-percent="0">'+
                                                '<div class="ppc-progress">'+
                                                  '<div class="ppc-progress-fill"></div>'+
                                                '</div>'+
                                                '<div class="ppc-percents">'+
                                                  '<div class="pcc-percents-wrapper">'+
                                                    '<span>%</span>'+
                                                  '</div>'+
                                                '</div>'+
                                              '</div>'+
                                          '</div>'+
                                         
                                          
                                            '<div class="statRightHolder" style=" height:350px;overflow-y: auto;">'+
                                               '<div id = "prjdetails"></div>'+
                                          '</div>'+
                                          
                                      '</div>'+
                                  '</div>'+
                                
                                    '</div>'+
                        '</div>'+
                    '</div>');
                    var start = 0;
                    var end = total2/data.length;
                    var time = 800; //in ms
                    var fps = 30;

                    var increment = ((end-start)/time)*fps;

                    $('.progress-pie-chart')[0].dataset.percent = start;

                    var timer = setInterval(function() {
                          $('.progress-pie-chart')[0].dataset.percent = parseFloat($('.progress-pie-chart')[0].dataset.percent) + increment;

                          if (parseFloat($('.progress-pie-chart')[0].dataset.percent) >= end) {
                            clearInterval(timer);
                          }

                          var $ppc = $('.progress-pie-chart'),
                            percent = parseFloat($ppc[0].dataset.percent),
                            deg = 360 * percent / 100;
                            //alert(deg);
                          if (percent > 50) {
                            $ppc.addClass('gt-50');
                         
                        }

                        if (end >50){

                            $('.ppc-percents span').html(parseInt(percent-1, 10) + '%');
                          }
                          else{
                             $('.ppc-percents span').html(parseInt(percent, 10) + '%');
                          }
                       
                          $('.ppc-progress-fill').css('transform', 'rotate(' + (deg-4.5) + 'deg)');
                        
                    },fps);  
                   // showprojectdetails(id2);

                }
                else{
                      $('#prjchart').append('<div class="col-lg-5">'+
                        '<div class="box box-success box-solid">'+
                              '<div class="box-header with-border">'+
                                  '<h3 class="box-title">Project Chart</h3>'+
                                    '<div class="box-tools pull-right">'+
                                        '<button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>'+
                                        '</button>'+
                                    '</div>'+
                                '</div>'+
                                  '<div class="box-body" >'+
                                    '<div align="center">'+
                                     '<p align="center"> <text style="font-family:Times;font-size:25px;color:black;"><u id = "tit" ></u></text></p>'+
                                     '</div>'+    
                                      '<div class="progressDiv">'+
                                          '<div class="statChartHolder">'+
                                              '<div class="progress-pie-chart" data-percent="0">'+
                                                '<div class="ppc-progress">'+
                                                  '<div class="ppc-progress-fill"></div>'+
                                                '</div>'+
                                                '<div class="ppc-percents">'+
                                                  '<div class="pcc-percents-wrapper">'+
                                                    '<span>Add Task!</span>'+
                                                  '</div>'+
                                                '</div>'+
                                              '</div>'+
                                          '</div>'+
                                         
                                          
                                            '<div class="statRightHolder"  >'+
                                               '<div id = "prjdetails"></div>'+
                                          '</div>'+
                                          
                                      '</div>'+
                                  '</div>'+
                                  // '<div class="box-footer" align="right">'+
                                  //           '<button data-backdrop="static" data-keyboard="true" data-toggle="modal" onclick="edit_project()" class="btn btn-info btn-sm "><i class="fa fa-pencil"></i> Edit Project Info</button>'+
                                  //       '</div>'+
                                    '</div>'+
                              '</div>'+
                          '</div>'+
                      '</div>'+
                    '</div>');
                    var start = 0;
                    var end = 0;
                    var time = 800; //in ms
                    var fps = 30;

                    var increment = ((end-start)/time)*fps;

                    $('.progress-pie-chart')[0].dataset.percent = start;

                    var timer = setInterval(function() {
                          $('.progress-pie-chart')[0].dataset.percent = parseFloat($('.progress-pie-chart')[0].dataset.percent) + increment;

                          if (parseFloat($('.progress-pie-chart')[0].dataset.percent) >= end) {
                            clearInterval(timer);
                          }

                          var $ppc = $('.progress-pie-chart'),
                            percent = parseFloat($ppc[0].dataset.percent),
                            deg = 360 * percent / 100;
                            //alert(deg);
                          if (percent > 50) {
                            $ppc.addClass('gt-50');
                         
                        }

                            
                       
                        $('.ppc-progress-fill').css('transform', 'rotate(' + (deg) + 'deg)');
                        
                    },fps);  

                }
                showprojectdetails(id2);
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });
    }
</script>
  