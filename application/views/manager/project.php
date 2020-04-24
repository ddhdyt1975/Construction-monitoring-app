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
<style>
    .progressDiv {
        width: 100%;
        height: 325px;

        position: relative;
        left: 0%;
        top: 0px;
        display: inline-block;
        border-radius: 5px;
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
        width:100%;
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
      border-radius: 100%;
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
      margin: 30px auto 0;
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
        margin-top: 20px;
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
            <li  class="active"><a href="ProjectsM"><i class="fa fa-book"></i> Projects</a></li>
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
                <div  class="nav nav-tabs-custom bg-gray"  id= "viewsup" style = "display:none;">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-book"></i> Project Details</a>
                        </li>
                        <li><a href="#taskdiv" data-toggle="tab"><i class="fa fa-tasks"></i> Project Tasks</a>
                        </li>
                        <li><a href="#planndiv" data-toggle="tab"><i class="fa fa-wrench"></i> Plan Activities</a>
                        </li>
                         <li><a href="#materialdiv" data-toggle="tab"><i class="fa fa-briefcase"></i> Materials </a>
                        </li>
                        <li><a href="#equipmentdiv" data-toggle="tab"><i class="fa fa-wrench"></i> Equipments</a>
                        </li>
                    </ul>

                    <div class="tab-content bg-gray">
                        <div class="tab-pane fade in active" id="home">
                            <div  class="row">
                                <br>
                                <div id = "prjchart">
                                </div>
                            </div>         
                        </div>

                        <div class="tab-pane fade in " id="taskdiv">
                            <div  class="row">
                                <br>
                                <div class="col-lg-12" id = "tsssk" style = "display:none;">
                                        <div class="col-lg-8">
                                            <h1 align="center">Task Lists</h1>
                                        </div>
                                        <div class="col-lg-4" align="right">
                                            <a onclick = "achiev()" class="btn btn-app btn-sm bg-orange" data-toggle="tooltip" data-placement="bottom" title="Add Achievement of the Day." style="height:100%"><i class="fa fa-trophy"></i> Achievement </a>
                                           <a onclick="addtask();" class="btn btn-app btn-sm bg-navy" style="height:100%" ><i class="fa fa-tasks"></i> Add new Task(s)</a>
                                        </div>
                                    <br>
                                    <div class="row">
                                        
                                   
                                        <div id = "prjtsk"> 
                                        </div>
                                        <!-- </div> -->
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="tab-pane fade in " id="materialdiv">
                            <div  class="row">
                                <br>
                                
                                <div class="col-lg-5">
                                    <div class="box box-success box-solid  ">
                                        <div class="box-header with-border">
                                        <h3 class="box-title"> Material on Stock</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        </div> 
                                        <div class="box-body" >
                                            <div class="dataTable_wrapper">
                                                <table id="dataTables-materialstock"  class="table table-striped table-bordered table-hover dataTable dtr-inline dt-responsive wrap" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                                                    <thead>
                                                        <tr>
                                                            <th>Material Name</th>
                                                            <th>Quantity</th> 
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                     
                                                </table>
                                            </div>
                                        </div>  
                                        <div class = "box-footer" align="right">
                                            <button onclick="addmaterialstock()" class="btn btn-success btn-sm "><i class="fa fa-plus"></i> Add New Material to Stock</button>
                                         </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="box box-success  box-solid">
                                        <div class="box-header with-border">
                                        <h3 class="box-title"> Material Used by Project</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        </div> 
                                        <div class="box-body" >
                                            <div class="dataTable_wrapper">
                                                <table id="dataTables-material"  class="table table-striped table-hover table-bordered  dt-responsive wrap"     width="100%"  >
                                                    <thead>
                                                        <tr>
                                                            <th>Material Name</th>
                                                            <th>Quantity</th>
                                                            <th>Date Used</th> 
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                    </tbody>
                                                     
                                                </table>
                                            </div>
                                        </div>  
                                        <div class = "box-footer" align="right">
                                            <button onclick="addmaterial()" class="btn btn-success btn-sm "><i class="fa fa-plus"></i> Add Material to use</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="box box-success ">
                                        <div class="box-header with-border">
                                        <h3 class="box-title"> Material Received from other Projects</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        </div>
                                        </div> 
                                        <div class="box-body" >
                                            <div class="dataTable_wrapper">
                                                <table id="dataTables-material-received"  class="table table-striped table-hover table-bordered  dt-responsive wrap"     width="100%"  >
                                                    <thead>
                                                        <tr>
                                                            <th>Material Name</th>
                                                            <th>Quantity</th>
                                                            <th>Received from</th>
                                                            <th>Date received</th> 
                                                        </tr>
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

                        <div class="tab-pane fade in " id="equipmentdiv">
                            <div  class="row"> 
                                    <br>

                                    <div class="col-lg-5">
                                        <div class="box box-warning box-solid ">
                                            <div class="box-header with-border">
                                            <h3 class="box-title">Equipment/Tools/Machine on Stock</h3>
                                                <div class="box-tools pull-right">
                                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="dataTable_wrapper">
                                                    <table id="dataTables-equipmentstock"  class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Equipment/Tools/Machine Name</th>
                                                                <th>Quantity</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            

                                                        </tbody>
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                            <div class = "box-footer" align="right">
                                                <button onclick="addequipment()" class="btn btn-warning btn-sm "><i class="fa fa-plus"></i> Add New Equipment/Tools/Machine to Stock</button>
                                             </div>
                                        </div>
                                    </div>
                   
                                    <div class="col-lg-7">
                                        <div class="box box-warning  box-solid">
                                            <div class="box-header with-border">
                                            <h3 class="box-title">Equipment/Tools/Machine used by Project</h3>
                                                <div class="box-tools pull-right">
                                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="dataTable_wrapper">
                                                    <table id="dataTables-equipment" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Equipment/Tools/Machine Name</th>
                                                                <th>Quantity</th>
                                                                <th>Date Used</th>
                                                                <th>Supplier</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            

                                                        </tbody>
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                            <div class = "box-footer" align="right">
                                                <button onclick="addequipmenttoP()" class="btn btn-warning btn-sm "><i class="fa fa-plus"></i> Add New Equipment/Tools/Machine</button>
                                             </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="box box-warning  box-solid">
                                            <div class="box-header with-border">
                                            <h3 class="box-title">Equipment/Tools/Machine Received from other Projects</h3>
                                                <div class="box-tools pull-right">
                                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="dataTable_wrapper">
                                                    <table id="dataTables-equipment-equip" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Equipment/Tools/Machine Name</th>
                                                                <th>Quantity</th>
                                                                <th>Received from</th>
                                                                <th>Received Date</th>
                                                            </tr>
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

 
                        <div class="tab-pane fade in " id="planndiv">
                            <div  class="row">
 
                                <div class = "col-lg-12">
                                   <div class="box box-success">
                                        <div class="box-header">
                                            <i class="ion ion-clipboard"></i>
                                            <h3 class="box-title">To Do List </h3>
                                            <div class="box-tools pull-right">
                                                <a  onclick="AddNextTask();" class="btn bg-olive" data-toggle="tooltip" data-placement="bottom" title="Add Nextday Activity."><i class="fa fa-plus"></i> Add New Entry</a>                                            
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div  id ="actss">
                                                <ul class="todo-list" id ="todo_li">
                                            
                                                </ul>
                                            </div>
                                        </div>
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
                                        <select id = "tskname" name="tskname" class="form-control"  data-toggle="tooltip" data-placement="bottom" title="Click to view tasks.">
                                        <option value=""></option>
                                            <?php foreach($task as $cobject)
                                                echo '<option value='.$cobject->projtsk_id.'>'.$cobject->projtsk_name.'</option>'
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="tskpercent">Percentage</label>
                                        <input type="number" class="form-control" onchange="handleChange(this);"  id="tskpercent" name="tskpercent" data-toggle="tooltip" data-placement="bottom" title="Example: 10%" placeholder = "Enter Task Percentage"/>
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
            <div class="modal-dialog modal-lg" style ="width:auto; margin:20px 20px 20px 20px">
                <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <div class = "row">
                            <div class = "col-lg-4">
                                <div class="box box-solid bg-olive" style="height:480px">
                                    <div class = "box-header">
                                        <div class ="box-title text-center">
                                            <b>Add Achievement</b>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                            
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
                                                    <option value="On-Going">On-Going</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Completed">Completed</option>
                                                    
                                                </select>
                                                <span class="help-block"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="prjtask_com">Add Comment<span class ="fa fa-comment"></span></label>
                                                <textarea type="text" rows="13" class="form-control" id="prjtask_com" name="prjtask_com" placeholder="Enter Task Comment"></textarea>
                                                <span class="help-block"></span>
                                            </div>
                                        </form>
                                        <div>
                                            <button type="button" id="btnSavec" onclick="saveC()" class="btn bg-olive btn-flat btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="box box-solid box-danger" id ="c1">
                                    <div class = "box-header with-border">
                                        <div class = "box-title"> On-Progress and Pending</div>
                                    </div>   
                                    <div class = "box-body">
                                        <ul class="timeline timeline-inverse" id="comment_timeline">

                                            
                                        </ul>
                                    </div>
                                </div>                                    
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="box box-solid box-success" id ="cc">
                                    <div class = "box-header with-border">
                                        <div class = "box-title"> Completed</div>
                                    </div>   
                                    <div class = "box-body">
                                        <ul class="timeline timeline-inverse " id="completed_timeline">

                                            
                                        </ul>
                                    </div>
                                </div>                                    
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_material_stock" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-success">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_addmaterial_stock" class="form-group">
                            <div class="form-group hidden">
                                <label for="matid"> </label>
                                <input type="text" class="form-control" id="matid" name="matid" placeholder = "Enter Task ID"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group hidden">
                                <label for="matid2"> </label>
                                <input type="text" class="form-control" id="matid2" name="matid2" placeholder = "Enter Task ID"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-6">
                                    <label for="matname">Material</label>
                                        <select id = "matname" name="matname" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="matqty">Quantity</label>
                                        <input type="number" class="form-control" id="matqty" name="matqty" placeholder = "Enter Quantity"/>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSavem" onclick="savemats()" class="btn btn-success">Save</button> 
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_equip" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-success">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_addequipment" class="form-group">
                            <div class="form-group hidden">
                                <label for="equipid">Task ID</label>
                                <input type="text" class="form-control" id="equipid" name="equipid" placeholder = "Enter Task ID"/>
                                <span class="help-block"></span>
                            </div>

                             <div class="form-group hidden">
                                <label for="equipid">Task ID</label>
                                <input type="text" class="form-control" id="equipid2" name="equipid2" placeholder = "Enter Task ID"/>
                                <span class="help-block"></span>
                            </div>


                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-6">
                                    <label for="equipname">Equipment</label>
                                        <select id = "equipname" name="equipname" class="form-control">
                                        <option value=""></option>
                                            <?php foreach($equipment as $cobject)
                                                echo '<option value='.$cobject->equipment_id.'>'.$cobject->equipment_name.'</option>'
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="equipqty">Quantity</label>
                                        <input type="number" class="form-control" id="equipqty" name="equipqty" placeholder = "Enter Quantity"/>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSavee" onclick="saveequip()" class="btn btn-success">Save</button> 
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="achievmodal" role="dialog">
            <div class="modal-dialog modal-lg" style ="width:auto; margin:20px 20px 20px 20px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row" >
                               
                                    <div class="col-lg-4">
                                        <div class="box box-solid bg-purple">
                                            <div class = "box-header">
                                                <div class ="box-title text-center">
                                                    <b>Add Achievement</b>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <form  id="form_add_achv" class="form-group">
                                                    <div class="form-group hidden">
                                                        <input type="text" class="form-control" id="achv_idd" name="achv_idd" placeholder = "Enter subject"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="matid">Subject:</label>
                                                        <input type="text" class="form-control" id="achv_sub" name="achv_sub" placeholder = "Enter subject"/>
                                                        <span class="help-block"></span>
                                                    </div>

                                                    <div class="form-group ">
                                                        <label for="matid2">Description:</label>
                                                        <textarea type="text" rows="5" class="form-control" id="achv_des" name="achv_des" placeholder = "Enter description" ></textarea>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </form>
                                                <div>
                                                    <button onclick="addachv()" class = "btn bg-orange btn-flat btn-block"><i class="fa fa-plus"> <i class="fa fa-trophy"> </i></i> Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               
                                    <div class="col-lg-8">
                                        <div class="box box-solid" id ="achv_box">
                                            <div class = "box-body">
                                                <ul class="timeline timeline-inverse" id="achv_timeline">

                                                    
                                                </ul>
                                            </div>
                                        </div>                                    
                                    </div>
                                        

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editnext" role="dialog">
            <div class="modal-dialog ">
                <div class="modal-content">
                   <div class="modal-header  btn-primary">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form   id="formeditcomnext">
                         <div class="form-group hidden">
                                <label for="nid">Task ID</label>
                                <input type="text" class="form-control" id="nid" name="nid" placeholder = "Enter Task ID"/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="prjmng">Task</label>
                                <select id = "tskname" name="tskname" class="form-control">
                                <option value=""></option>
                                    <?php foreach($task as $cobject)
                                        echo '<option value='.$cobject->projtsk_id.'>'.$cobject->projtsk_name.'</option>'
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-12">
                                        <label>Comment!</label>
                                        <textarea class="form-control" id ="ncomm" name="ncomm"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id ="btnn" class="btn btn-danger btn-sm" onclick="saveN(); ">OK</button>
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>

<script>
  function handleChange(input) {
    if (input.value < 0) input.value = 0;
    if (input.value > 100) input.value = 100;
  }
</script>
 
<script>

   var save_method;
   var id2;
   var table, table2, table3, table4, table5, table6, table7;
   var idm, idm2;


    $('#prjselect').change(function() {

        var projectSelected = $(this).val();

        id2 = projectSelected;
        listproj(id2);
        listownedmat(id2);
        listownedeqp(id2);
        $('#prjchart').empty();
        
        showChart(id2);

        $('#accofd').hide();
        $('#acts').hide();
        $('#tsssk').hide();
        $('#viewsup').hide(); 
    });


    $(document).ready(function(){
        $('#pd').attr("class","treeview active");
        $('#myP').attr("class","active");

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


    function AddNextTask(){
        save_method = 'addnext';
        $('#formeditcomnext')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#editnext').modal('show');  
        $('.modal-title').text('Add Next Activity'); 
    }


    function viewAchv(){
        $('#achv_timeline').empty();
        
        $.ajax({
            url : "<?php echo site_url('ProjectsM/Get_ac/')?>/" + id2,
            type: "POST",
            data: $('#form_add_achv').serialize(),
            dataType: "JSON",
            success: function(data){

                for(i=0; i<data.length;i++){
                    $('#achv_timeline').append('<li class="time-label">'+
                        '<span class="bg-red">'+data[i]['ddate']+'</span>'+
                    '</li>'+
                    '<li>'+
                        '<i class="fa fa-trophy bg-yellow"></i>'+
                        '<div class="timeline-item">'+
                            '<span class="time"><i class="fa fa-clock-o"></i> '+data[i]['time']+'</span>'+
                            '<h3 class="timeline-header"><a>'+data[i]['achv_sub']+'</a> ...</h3>'+
                            '<div class="timeline-body">'+data[i]['achv_info']+'</div>'+
                            '<div class="timeline-footer">'+
                                '<a class="btn btn-primary btn-xs" onclick = "edit_achv('+"'"+data[i]['achv_id']+"'"+')"> <i class = "fa fa-pencil"></i> Edit </a>'+
                                '  <a class="btn btn-danger btn-xs" onclick = "delete_achv('+"'"+data[i]['achv_id']+"'"+')"><i class = "fa fa-trash"></i>  Delete</a>'+
                            '</div>'+
                        '</div>'+
                    '</li>');
                };
                $('#achv_timeline').append('<li><i class="fa fa-clock-o bg-gray"></i></li>');
            },
            error: function (jqXHR, textStatus, errorThrown){

                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 

                $('#btnSaveA').text('save'); 
                $('#btnSaveA').attr('disabled',false); 

            }
        });

    }

    function edit_achv(id){
        $('#trncom').empty();
        $('#trncom2').empty();
        $.ajax({
            url : "<?php echo site_url('ProjectsM/editachv/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) { 
                    $('#achv_sub').val(data.achv_sub);
                    $('#achv_des').val(data.achv_info);
                    $('#achv_idd').val(data.achieve_id);
            },
          error: function (jqXHR, textStatus, errorThrown) {
             
          }
        });  
    }

    function delete_achv(id){
        if(confirm('Do you want to delete this Achievement?')){
                $.ajax({
                url : "<?php echo site_url('ProjectsM/ajax_delete_achv')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){  
                    viewAchv();
                    new PNotify({
                        title: 'success!',
                        text: 'Information deleted successfully.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
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


    function addachv(){
        $.ajax({
            url : "<?php echo site_url('ProjectsM/Projs_ac/')?>/" + id2,
            type: "POST",
            data: $('#form_add_achv').serialize(),
            dataType: "JSON",
            success: function(data){
              
                if(data.status) {
                    new PNotify({
                        title: 'Hey!',
                        text: 'Achievement of the Day added successfully.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    });

                    $('#form_add_achv')[0].reset(); 
                    viewAchv();                
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
            
                $('#btnSave').text('Save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            },
            error: function (jqXHR, textStatus, errorThrown){

                new PNotify({
                    title: 'Oh no!',
                    text: 'Error getting Data into the Server.',
                    type: 'error',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 

                $('#btnSaveA').text('save'); 
                $('#btnSaveA').attr('disabled',false); 

          }
        });
    }
    
    function listproj(id){
         
        $('#trncom').empty();
        $('#trncom2').empty();
        $.ajax({
            url : "<?php echo site_url('ProjectsM/Projs/')?>/" + id,
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


    function listownedmat(id){
         
        $('#matname').empty();
        $.ajax({
            url : "<?php echo site_url('ProjectsM/getOm/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                 
                for(i=0; i<data.length;i++){
                    $('#matname').append('<option value='+data[i]['material_id']+'>'+data[i]['material_name']+' </option>');
                };
          },
          error: function (jqXHR, textStatus, errorThrown) {
            
          }
        });  
    }

    function listownedeqp(id){
         
        $('#transeqpname').empty();
         $.ajax({
            url : "<?php echo site_url('ProjectsM/getOe/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                //alert(data.length); 
                for(i=0; i<data.length;i++){
                    $('#transeqpname').append('<option value='+data[i]['eu_id']+'>'+data[i]['equipment_name']+' ('+data[i]['eu_date']+')</option>');
                    //alert(data[i]['mu_id']+'&&'+data[i]['material_id']);
                    idm2 = (data[i]['eu_id'].substring(5+id2.length,(data[i]['equipment_id'].length)+5+id2.length));
                   // alert(idm2);
                };
          },
          error: function (jqXHR, textStatus, errorThrown) {
            //alert('Error get data from ajax');
          }
        });  
    }
    
    function reload_table(){
        table2.ajax.reload(null,false); 
        table3.ajax.reload(null,false);
        table4.ajax.reload(null,false);
        table5.ajax.reload(null,false);
        table6.ajax.reload(null,false);
        table7.ajax.reload(null,false);
    }

    function edit_project(id){
      
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        //alert(id);
        $.ajax({
            url : "<?php echo site_url('ProjectsM/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="prjcode"]').val(data.project_code);
                //$('#prjcode').attr("disabled", "disabled");
                $('[name="prjtitle"]').val(data.project_title);
                $('[name="prjdesc"]').val(data.project_desc);
                $('[name="prjstatus"]').val(data.project_status);
                $('[name="prjaddr"]').val(data.project_address);
                $('[name="prjcity"]').val(data.city_id);
                $('[name="prjtype"]').val(data.project_type);
                $('[name="prjstrt"]').val(data.start_project);
                //$('#prjstrt').attr("disabled", "disabled");
                $('[name="prjend"]').val(data.expected_end_date);
                //$('#prjend').attr("disabled", "disabled");
                // $('[name="prjmng"]').val(data.user_id);
                // $('#prjmng').attr("disabled", true);

                
                if (data.project_type == "Hybrid"){
                    $("#gprjscn").show();
                    $("#gprjcn").show();
                    $('[name="prjscn"]').val(data.project_sub_contractor);
                    $('[name="prjcn"]').val(data.project_comp_contract);
                }

                else if (data.project_type == "w/ Sub Contractor"){
                    $("#gprjscn").show();
                    $('[name="prjscn"]').val(data.project_sub_contractor);
                    $('[name="prjcn"]').val("");
                    $("#gprjcn").hide();
                }
                else if (data.project_type == "Company Contract"){
                    $("#gprjscn").hide();
                    $('[name="prjscn"]').val("");
                    $("#gprjcn").show();
                    $('[name="prjcn"]').val(data.project_comp_contract);
                }
                else {
                    $("#gprjscn").hide();
                    $('[name="prjscn"]').val("");
                    $('[name="prjcn"]').val("");
                    $("#gprjcn").hide();
                }

                
                $('#modal_form').modal('show');  
                $('.modal-title').text('Edit Project Information'); 

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

    function save(){
 
        $('#btnSave').text('Saving...'); 
        $('#btnSave').attr('disabled',true);
        var url;
        url = "<?php echo site_url('ProjectsM/ajax_update')?>";
       
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
              
            if(data.status) 
              {
                $('#prjchart').empty();
                showChart(id2);
                $('#prjdetails').empty();
                $('#tsssk').hide();
                //showprojectdetails(id2);
                $('#viewsup').hide();
                $('#modal_form').modal('hide');

                //reload_table();

                new PNotify({
                    title: 'Hey!',
                    text: 'Project Information is updated successfully.',
                    type: 'info',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 

                //$('#alert_modal').modal('show');  
                //$("#myDialogText").text("Project Information is updated successfully.");
               }
            else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                  }
              }
              $('#btnSave').text('Save'); //change button text
              $('#btnSave').attr('disabled',false); //set button enable 


          },
          error: function (jqXHR, textStatus, errorThrown){

                new PNotify({
                    title: 'Oh no!',
                    text: 'Error getting Data into the Server.',
                    type: 'error',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 

                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 

          }
        });
    }

    function view_transactions(id){ 

        $('#viewsup').show();
      
        $("#dataTables-material").dataTable().fnDestroy();
        $("#dataTables-materialstock").dataTable().fnDestroy();
        $("#dataTables-equipment").dataTable().fnDestroy();
        $("#dataTables-equipmentstock").dataTable().fnDestroy();
        $("#dataTables-material-received").dataTable().fnDestroy();
        $("#dataTables-equipment-equip").dataTable().fnDestroy();
        

        table2 = $('#dataTables-material').DataTable({ 
            ajax: {
                    "url": "<?php echo site_url('ProjectsM/ajax_list2')?>/" + id,
                    "type": "POST"
                },
                order: [[2, 'desc']],
                responsive: true
            });


        table3 = $("#dataTables-materialstock").DataTable({
            ajax: {
                "url": "<?php echo site_url('ProjectsM/ajax_list_transmat')?>/" + id,
                "type": "POST"
            },  
            order: [[1, 'desc']],
            responsive: true
        });

        table6 = $("#dataTables-material-received").DataTable({
            ajax: {
              "url": "<?php echo site_url('ProjectsM/ajax_list_recmat')?>/" + id,
              "type": "POST"
            },
            responsive: true
        });

        table4 = $("#dataTables-equipment").DataTable({
            ajax: {
              "url": "<?php echo site_url('ProjectsM/ajax_list4')?>/" + id,
              "type": "POST"
            },
            order: [[2, 'desc']],
            responsive: true
        });

        table5 = $("#dataTables-equipmentstock").DataTable({
            ajax: {
              "url": "<?php echo site_url('ProjectsM/ajax_list_transeqp')?>/" + id,
              "type": "POST"
            },
            responsive: true
        });

        table7 = $("#dataTables-equipment-equip").DataTable({
            ajax: {
              "url": "<?php echo site_url('ProjectsM/ajax_list_receqp')?>/" + id,
              "type": "POST"
            },
            responsive: true
        });
    }

    function showChart(id){
        var total1 = 0, total2 = 0;
        $("#prjchart").empty();
        $.ajax({
            url : "<?php echo site_url('ProjectsM/getTasks/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data!=null){
                for(i=0; i<data.length;i++){
                    total = parseInt(data[i]['projdtsk_percent']); 
                    total2 = total2 + total;
                };
               
                $('#prjchart').append('<div class="col-lg-12">'+
                    '<div class="row">'+
                    '<div class="col-lg-12">'+
                    //     '<div class="box-body" >'+
                            '<div align="center">'+
                                '<h2>'+data[0]['project_title']+'</h2>'+
                            '</div>'+    
                            '<div class="progressDiv">'+
                                '<div class="statChartHolder">'+
                                    '<div class="progress-pie-chart" data-percent="0">'+
                                        '<div class="ppc-progress">'+
                                            '<div class="ppc-progress-fill"></div></div>'+
                                                '<div class="ppc-percents">'+
                                                    '<div class="pcc-percents-wrapper">'+
                                                        '<span>%</span>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                     
                                      
                                        '<div class="statRightHolder" id = "prjdetails" style="overflow-y:auto">'+
                                           
                                        '</div>'+
                                        
                                    '</div>'+
                                    '<div align="right"> '+ 
                                       '<button data-backdrop="static" data-keyboard="true" data-toggle="modal" onclick="edit_project('+"'"+data[0]['project_code']+"'"+')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit Project Info</button>'+
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
                }
                else{
                    $('#prjchart').append('<div class="col-lg-12">'+
                        '<div class="box box-solid">'+
                            '<div class="box-body" >'+
                                '<div align="center">'+
                                    '<h2><text id = "tit"></text><h2>'+
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
                                    '<div class="statRightHolder" id = "prjdetails" style="overflow-y:auto">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="box-footer" align="right">'+
                                '<button data-backdrop="static" data-keyboard="true" data-toggle="modal" onclick="edit_project('+"'"+id+"'"+')" class="btn btn-primary btn-sm "><i class="fa fa-pencil"></i> Edit Project Info</button>'+
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

    function showprojectdetails(projectSelected){
        $("#tit").empty();
        $.ajax({
          url : "<?php echo site_url('ProjectsM/ProjDetails/')?>/" + projectSelected,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $("#tit").append(data['project_title']);
            $('#prjdetails').append('<dl>'+
                /*'<p class="blueh">Project Title: <text style="font-family:Times;font-size:25px;color:black;"><u>'+data['project_title']+'</u></text></p>'+*/
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

    function DisplayTask(id){
        $("#tsssk").show();
        $("#prjtsk").empty();
        
        $.ajax({
            url : "<?php echo site_url('ProjectsM/getTasks/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){   
                // 
                
                // for(i=0; i<data.length;i++){

                //     if ((data[i]['projdtsk_percent'] >= 75 ) && (data[i]['projdtsk_percent'] <= 100 )) {
                //         $('#prjtsk').append(''+
                //                             '<div class ="well" id="div'+data[i]['projdtsk_id']+'" ><p style="font-size:12px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong></text><text class="pull-right"> <button data-toggle="tooltip" data-placement="bottom" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="bottom" title= "Add Comment" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" class="btn btn-primary btn-xs"><i class="fa fa-comment"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="bottom" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button> </text></p>'+
                //                                 '<div class="progress ">'+
                //                                     '<div class="progress-bar progress-bar-success progress-bar-striped active" id = '+data[i]['projtsk_id']+' role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;">'+
                //                                         ''+data[i]['projdtsk_percent']+'% Complete'+
                //                                     '</div>'+
                //                                 '</div>Encountered issue:<ul> </ul>'+
                //                             '</div>'+
                //                         '');                                       
                //         $('#'+data[i]['projtsk_id']+'').css('width', data[i]['projdtsk_percent']+'%').attr('aria-valuenow',  data[i]['projdtsk_percent']); 
                //     }

                //     else if ((data[i]['projdtsk_percent'] >= 50)&&(data[i]['projdtsk_percent'] < 75)){
                //         $('#prjtsk').append(''+
                //                         '<div class ="well" id="div'+data[i]['projdtsk_id']+'"><p style="font-size:12px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong></text><text class="pull-right"> <button data-toggle="tooltip" data-placement="bottom" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="bottom" title= "Add Comment" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" class="btn btn-primary btn-xs "><i class="fa fa-comment"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="bottom" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button> </text></p>'+
                //                             '<div class="progress ">'+
                //                                 '<div class="progress-bar progress-bar-warning progress-bar-striped active" id = '+data[i]['projtsk_id']+' role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;">'+
                //                                     ''+data[i]['projdtsk_percent']+'% Complete'+
                //                                 '</div>'+
                //                             '</div>Encountered issue:<ul> </ul>'+
                //                         '</div> '+
                //                     '');                                       
                //         $('#'+data[i]['projtsk_id']+'').css('width', data[i]['projdtsk_percent']+'%').attr('aria-valuenow',  data[i]['projdtsk_percent']); 
                //     }

                //     else if ((data[i]['projdtsk_percent'] >= 0)&&(data[i]['projdtsk_percent'] < 50)){
                //         $('#prjtsk').append(''+
                //                         '<div class ="well" id="div'+data[i]['projdtsk_id']+'"><p style="font-size:12px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong></text><text class="pull-right"> <button data-toggle="tooltip" data-placement="bottom" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="bottom" title= "Add Comment" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" class="btn btn-primary btn-xs "><i class="fa fa-comment"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="bottom" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button></text> </p>'+
                //                             '<div class="progress ">'+
                //                                 '<div class="progress-bar progress-bar-danger progress-bar-striped active" id = '+data[i]['projtsk_id']+' role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;">'+
                //                                     ''+data[i]['projdtsk_percent']+'% Complete'+
                //                                 '</div>'+
                //                             '</div>Encountered issue:<ul> </ul>'+
                //                         '</div> '+
                //                     '');                                       
                //         $('#'+data[i]['projtsk_id']+'').css('width', data[i]['projdtsk_percent']+'%').attr('aria-valuenow',  data[i]['projdtsk_percent']); 
                //     }
                
                // getTaskCom(data[i]['projdtsk_id']);
                // };

                if(data!=null){
                    for(i=0; i<data.length;i++){
                      //  total = parseInt(data[i]['projdtsk_percent']); 
                        var colore;

                        if (data[i]['projdtsk_percent'] >=50){
                            colore = "#81CE97";
                        }
                        else{
                            colore ="#f56954";    
                        }

                        var d = data[i]['projtsk_desc'];

                        if (d != null){
                            d = d;
                        }
                        else{
                            d = "No Description."
                        }

                        $('#prjtsk').append('<div class = "col-lg-6">'+
                            '<div class ="text-center box col-lg-12 col-md-6 col-sm-12 col-xs-12" >'+
                                '<p style="font-size:20px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong></text><text class="pull-right"> <button data-toggle="tooltip" data-placement="bottom" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="bottom" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button> </text></p>'+
                                '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" >'+
                                    '<input class="knob" value="'+data[i]['projdtsk_percent']+'" data-skin="tron" data-thickness="0.2" data-width="100" data-height="100" data-fgColor="'+colore+'" " data-readonly="true">'+
                                '</div>'+
                                
                                '<div class = "col-lg-8 col-md-6 col-sm-6 col-xs-12" id="div'+data[i]['projdtsk_id']+'" >'+
                                    '</div><div class = "col-lg-4 col-md-3 col-sm-4 col-xs-4"><i>'+d+'<i></div>'+
                                    '<div align="right" class = "col-lg-4 col-md-3 col-sm-4 col-xs-4"><a class="btn btn-app btn-sm bg-maroon" style="height:100%" data-toggle="tooltip" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" data-placement="bottom" title="Add Problems Encountered."><i class="fa fa-bomb"></i> Problems<br>Encountered</a></div>'+                                    
                            '</div>');
                       

                        $(".knob").knob({
                            draw: function () {

                            // "tron" case
                            if (this.$.data('skin') == 'tron') {

                              var a = this.angle(this.cv)  // Angle
                                  , sa = this.startAngle          // Previous start angle
                                  , sat = this.startAngle         // Start angle
                                  , ea                            // Previous end angle
                                  , eat = sat + a                 // End angle
                                  , r = true;

                              this.g.lineWidth = this.lineWidth;

                              this.o.cursor
                              && (sat = eat - 0.3)
                              && (eat = eat + 0.3);

                              if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.value);
                                this.o.cursor
                                && (sa = ea - 0.3)
                                && (ea = ea + 0.3);
                                this.g.beginPath();
                                this.g.strokeStyle = this.previousColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                              }

                              this.g.beginPath();
                              this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                              this.g.stroke();

                              this.g.lineWidth = 2;
                              this.g.beginPath();
                              this.g.strokeStyle = this.o.fgColor;
                              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                              this.g.stroke();

                              return false;
                            }
                          }
                        });
                    //getTaskCom(data[i]['projdtsk_id']);
                    };
                }
             
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#'+data[i]['projtsk_id']+'').css('width', "0"+'%').attr('aria-valuenow',  "0");
            }
        });
    }

    function achiev(){
        save_method = 'addachiev';
       // $('#form_addtask')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#achievmodal').modal('show');  
        $('.modal-title').empty();
        $('.modal-title').append('<i class="fa fa-trophy"></i> Achievement'); 
        viewAchv();
    }

    function DeleteTask(id){

        if(confirm('Do you want to delete this Task?')){
                $.ajax({
                url : "<?php echo site_url('ProjectsM/ajax_delete_task')?>/"+id,
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
                        type: 'error',
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
        $('#comment_timeline').empty();
        $('#completed_timeline').empty();
        $.ajax({
            url : "<?php echo site_url('ProjectsM/getTasksCom/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){   
                if (data!=null){
                    
                    for(i=0; i<data.length;i++){ 
                        if (data[i]['prjtsk_status']!="Completed"){
                            $('#comment_timeline').append('<li class="time-label">'+
                                '<span class="bg-red">'+data[i]['prjtsk_comment_date']+'</span>'+
                                '</li>'+
                                '<li>'+
                                    '<i class="fa fa-bomb bg-black"></i>'+
                                    '<div class="timeline-item">'+
                                        '<h3 class="timeline-header"><a>'+data[i]['prjtsk_status']+'</a> ...</h3>'+
                                        '<div class="timeline-body">'+data[i]['prjtsk_comment']+'</div>'+
                                        '<div class="timeline-footer" align="right" >'+
                                            '<a class="btn btn-primary btn-xs" onclick =  "editcom('+data[i]['prjtsk_comm_id']+')"> <i class = "fa fa-pencil"></i> Edit </a>'+
                                        '</div>'+
                                    '</div>'+
                            '</li>');
                        }
                        else{
                            $('#completed_timeline').append('<li class="time-label">'+
                                '<span class="bg-green">'+data[i]['prjtsk_comment_date']+'</span>'+
                                '</li>'+
                                '<li>'+
                                    '<i class="fa fa-check bg-black"></i>'+
                                    '<div class="timeline-item">'+
                                        '<h3 class="timeline-header"><a>'+data[i]['prjtsk_status']+'</a> ...</h3>'+
                                        '<div class="timeline-body">'+data[i]['prjtsk_comment']+'</div>'+
                                        '<div class="timeline-footer" align="right" >'+
                                            '<a class="btn btn-primary btn-xs" onclick =  "editcom('+data[i]['prjtsk_comm_id']+')"> <i class = "fa fa-pencil"></i> Edit </a>'+
                                        '</div>'+
                                    '</div>'+
                            '</li>');
                        
                        }
                    };
                    $('#comment_timeline').append('<li><i class="fa fa-clock-o bg-gray"></i></li>');
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
        getTaskCom(id);        
        save_method = 'addtaskcom';
        $('#form_addtask_comment')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#add_task_comment').modal('show');
        $('.modal-title').empty();  
        $('.modal-title').append('<i class= "fa fa-bomb"></i>Add Problems Encountered'); 
        $('#tskidcom2').val(id);

    }

    function save2(){
        
        $('#btnSavet').text('Saving...'); 
        $('#btnSavet').attr('disabled',true);
        var url;
       
        if (save_method =='updatetask'){
            //alert('1');
            url = "<?php echo site_url('ProjectsM/ajax_update_task')?>/"+id2;
        }
        else{
           // alert('2');
             url = "<?php echo site_url('ProjectsM/ajax_add_task')?>/"+id2;
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
            url = "<?php echo site_url('ProjectsM/ajax_update_taskcomm')?>/"+id2;
        }
        else{
           url = "<?php echo site_url('ProjectsM/ajax_add_taskcomm')?>/"+id2;
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
            url : "<?php echo site_url('ProjectsM/ajax_edit_comment/')?>/" + id,
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
                 new PNotify({
                    title: 'Oh No!',
                    text: 'Error getting Data into the Server.',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 
                
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
            url : "<?php echo site_url('ProjectsM/ajax_edit_task/')?>/" + id,
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

    function addmaterial(){
        save_method = 'addmat';
        $('#form_addmaterial_stock')[0].reset();
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty();
        $('#matname').attr("readonly",false); 
        $('#matqty').attr("placeholder","Enter Quantity");    
        $('#matname').empty(); 
        $('#matname').append("<option></option>");
        
        $.ajax({
            url : "<?php echo site_url('ProjectsM/ajax_get_materials')?>/" + id2,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                for(i=0; i<data.length;i++){
                    $('#matname').append('<option value='+data[i]['material_id']+'>'+data[i]['material_name']+'   ('+data[i]['quantity']+')</option>');          
                };
            },
            error: function (jqXHR, textStatus, errorThrown){
                 new PNotify({
                    title: 'Oh No!',
                    text: 'Error getting Data into the Server.',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 
                $("#myDialogText").text("Error getting Data into the Server.");
            }
        });

        //alert($('#form_addmaterial_stock').serialize());
        $('#add_material_stock').modal('show');  
        $('.modal-title').text('Add Material to Site'); 
        
    }

    function addmaterialstock(){
        save_method = 'addmats';
        $('#form_addmaterial_stock')[0].reset();
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty();
        
        $('#matname').attr("readonly",false); 
        $('#matqty').attr("placeholder","Enter Quantity"); 
        
        $('#matname').empty(); 
        $('#matname').append("<option></option>");

        $.ajax({
            url : "<?php echo site_url('ProjectsM/ajax_get_materialss')?>/" + id2,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                for(i=0; i<data.length;i++){
                    $('#matname').append('<option value='+data[i]['material_id']+'>'+data[i]['material_name']+'   ('+data[i]['quantity']+')</option>');          
                };
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });
       // alert($('#form_addmaterial_stock').serialize());
        $('#add_material_stock').modal('show');  
        $('.modal-title').text('Add Material to Stock'); 

    }

    function savemats(){
        
        $('#btnSavem').text('Saving...'); 
        $('#btnSavem').attr('disabled',true);
        var url;
       
        if (save_method =='addmats'){
            url = "<?php echo site_url('ProjectsM/ajax_add_material')?>/"+id2;
        }
        else if (save_method =='addmat'){
            url = "<?php echo site_url('ProjectsM/ajax_add_materialts')?>/"+id2;
        }
        else if (save_method == 'updatemats'){
            url = "<?php echo site_url('ProjectsM/ajax_update_materials')?>/"+id2;
        }
        else{
            url = "<?php echo site_url('ProjectsM/ajax_update_material')?>/"+id2;
        }
        //alert($('#form_addmaterial_stock').serialize());
        $.ajax({
          url : url,
          type: "POST",
          data: $('#form_addmaterial_stock').serialize(),
          dataType: "JSON",
          success: function(data){
            if(data.status){
                $('#form_addmaterial_stock')[0].reset();
                reload_table();
                if (save_method == 'addmat'){
                    new PNotify({
                        title: 'Yeah!',
                        text: 'Material is added successfully.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 

                   
                }
                else{
                    new PNotify({
                        title: 'Hey!',
                        text: 'Material is updated successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
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


             $('#btnSavem').text('Save'); 
            $('#btnSavem').attr('disabled',false); 
       
          },
          error: function (jqXHR, textStatus, errorThrown){
             new PNotify({
                title: 'Psst!',
                text: 'Material is already added but you can update it.',
                type: 'warning',
                styling: 'bootstrap3',
                nonblock: {
                    nonblock: true
                }
            }); 

           
           }
        });

            $('#btnSavem').text('Save'); 
            $('#btnSavem').attr('disabled',false); 
    }

    function updateMat(id){
      
        save_method = 'updatemat';
        $('#form_addmaterial_stock')[0].reset();
        $('.form-group').removeClass('has-error');  
        $('.help-block').empty();

        $.ajax({
            url : "<?php echo site_url('ProjectsM/ajax_edit_material')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){

                $('[name="matname"]').attr('readonly', false);
                //listownedmat(id2);
                $('[name="matid"]').val(data.mu_id);
                $('[name="matid2"]').val(data.material_id);
                $('[name="matname"]').empty();
                $('[name="matname"]').append('<option value = '+data.material_id+'>'+data.material_name+'</option>');
                $('[name="matqty"]').attr("placeholder","You have: "+data.quantity+" + ?");
                $('#add_material_stock').modal('show');  
                $('.modal-title').text('Update Material in Stock'); 

            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Oh No!',
                    text: 'Something terrible happened. Error getting Data from the Server',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 
            }
        });
    }

    function updateMat2(id){
      
        save_method = 'updatemats';
        $('#form_addmaterial_stock')[0].reset();
        $('.form-group').removeClass('has-error');  
        $('.help-block').empty();

        $.ajax({
            url : "<?php echo site_url('ProjectsM/ajax_edit_material2')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="matid"]').val(data.mu_id);
                $('[name="matid2"]').val(data.material_id);
                $('[name="matname"]').empty();
                $('[name="matname"]').append('<option value = '+data.material_id+'>'+data.material_name+'</option>');
                $('[name="matqty"]').attr("placeholder","You have: "+data.mu_quantity+" + ?");
                $('#add_material_stock').modal('show');  
                $('.modal-title').text('Update Material used'); 

            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Oh No!',
                    text: 'Something terrible happened. Error getting Data from the Server',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 
            }
        });
    }

    function deleteMat(id){

        if(confirm('Do you want to delete this material?')){
                $.ajax({
                url : "<?php echo site_url('ProjectsM/ajax_delete_material')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    reload_table();
                    new PNotify({
                        title: 'Yeah!',
                        text: 'Material is deleted successfully.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    new PNotify({
                        title: 'Oh No!',
                        text: 'Something terrible happened. Error in deleting Data from the Server',
                        type: 'error',
                        styling: 'bootstrap3'
                    }); 
                }
            });
        }        
    }

    function addequipment(){
        save_method = 'addeqptostock';
        $('#form_addequipment')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#equipname').attr("disabled",false);  
        $('#equipqty').attr("placeholder","Enter Quantity"); 

        $('#equipname').empty();

        $.ajax({
            url : "<?php echo site_url('ProjectsM/ajax_get_equipment_in_stock')?>/",
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#equipname').append('<option value =""> </option>')
                for(i=0; i<data.length;i++){
                    $('#equipname').append('<option value='+data[i]['equipment_id']+'>'+data[i]['equipment_name']+'   ('+data[i]['quantity']+')</option>');          
                };
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });

        $('#add_equip').modal('show');  
        $('.modal-title').text('Add Equipment to Stock'); 
       
    }

    function addequipmenttoP(){
        save_method = 'addeqptopro';
        $('#form_addequipment')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#equipname').attr("disabled",false);  
        $('#equipqty').attr("placeholder","Enter Quantity"); 

        $('#equipname').empty();

        $.ajax({
            url : "<?php echo site_url('ProjectsM/ajax_get_equipment_in_pro')?>/"+id2,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#equipname').append('<option value =""> </option>')
                for(i=0; i<data.length;i++){
                    $('#equipname').append('<option value='+data[i]['equipment_id']+'>'+data[i]['equipment_name']+'   ('+data[i]['quantity']+')</option>');          
                };
            },
            error: function (jqXHR, textStatus, errorThrown){
                
            }
        });

        $('#add_equip').modal('show');  
        $('.modal-title').text('Add Equipment to Project'); 
       
    }

    function saveequip(){
        
        $('#btnSavee').text('Saving...'); 
        $('#btnSavee').attr('disabled',true);
        var url;
       
        if (save_method =='addeqptostock'){
            url = "<?php echo site_url('ProjectsM/ajax_add_equipment_to_stock')?>/"+id2;
        }

        else if (save_method =='addeqptopro'){
            url = "<?php echo site_url('ProjectsM/ajax_add_equipment_to_pro')?>/"+id2;
        }
        else if (save_method =='updateeqpstock'){
            url = "<?php echo site_url('ProjectsM/ajax_update_equipment_in_stock')?>/"+id2;
        }
        else{
            url = "<?php echo site_url('ProjectsM/ajax_update_equipment')?>/"+id2;
        }

        $.ajax({
          url : url,
          type: "POST",
          data: $('#form_addequipment').serialize(),
          dataType: "JSON",
          success: function(data){
              
            if(data.status){
                $('#add_equip').modal('hide');
                reload_table();
                if (save_method == 'addeqp'){
                    new PNotify({
                        title: 'Yeah!',
                        text: 'Equipment is updated successfully.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    });
                   
                }
                else{
                    new PNotify({
                        title: 'Hey!',
                        text: 'Equipment is updated successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                }
            }
            else{
                for (var i = 0; i < data.inputerror.length; i++){
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                };
            }
            $('#btnSavee').text('Save'); 
            $('#btnSavee').attr('disabled',false);  
            //listownedeqp(id2);

          },
            error: function (jqXHR, textStatus, errorThrown){

                new PNotify({
                    title: 'Psst!',
                    text: 'Equipment is already added but you can update it.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
           
            }
        });
            $('#btnSavee').text('Save'); 
            $('#btnSavee').attr('disabled',false); 
    }

    function updateEqpstock(id){
      
        save_method = 'updateeqpstock';
        $('#form_addequipment')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();

        $.ajax({
            url : "<?php echo site_url('ProjectsM/ajax_edit_equipmentinstock')?>/" + id +"/"+ id2,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="equipid"]').val(data.equipment_id);
                //$('[name="equipid2"]').val(data.equipment_id);
                //$('[name="equipname"]').val(data.equipment_id);
                $('#equipname').empty();
                $('#equipname').append('<option value = "'+data.equipment_id+'">'+data.equipment_name+'</option>');
                $('[name="equipqty"]').attr("placeholder","You have: "+data.quantity+" + ?");
                $('#add_equip').modal('show');  
                $('.modal-title').text('Update Equipment in Stock'); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Oh No!',
                    text: 'Something terrible happened. Error getting Data from the Server',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function updateEqpinPro(id){
      
        save_method = 'updateeqpinpro';
        $('#form_addequipment')[0].reset();
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty();
        //alert(id);
        $.ajax({
            url : "<?php echo site_url('ProjectsM/ajax_edit_equipmentinproj/')?>" + id +"/"+ id2,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="equipid"]').val(data.equipment_id);
                //$('[name="equipid2"]').val(data.equipment_id);
                //$('[name="equipname"]').val(data.equipment_id);
                $('#equipname').empty();
                $('#equipname').append('<option value = "'+data.equipment_id+'">'+data.equipment_name+'</option>');
                $('[name="equipqty"]').attr("placeholder","You have: "+data.eu_quantity+" + ?");
                $('#add_equip').modal('show');  
                $('.modal-title').text('Update Equipment in Project'); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Oh No!',
                    text: 'Something terrible happened. Error getting Data from the Server',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function deleteEqp(id){

        if(confirm('Do you want to delete this equipment?')){
                $.ajax({
                url : "<?php echo site_url('ProjectsM/ajax_delete_equipment')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    reload_table();
                    new PNotify({
                        title: 'Yeah!',
                        text: 'Equipment is deleted successfully.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    new PNotify({
                        title: 'Oh No!',
                        text: 'Something terrible happened. Error getting Data from the Server',
                        type: 'error',
                        styling: 'bootstrap3'
                    }); 
                }
            });

        }        
    }

    function transferMat(){
    
        save_method = 'transmat';
        $('#form_transmaterial')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#transfer_material').modal('show');  
        $('.modal-title').text('Transfer material'); 
        $('#transmatname').attr("disabled",false);  
    }

    function savetransfer(){
       if(confirm('Do you want to transfer this material?')){
        $('#btnSavetrte').text('Saving...'); 
        $('#btnSavetrte').attr('disabled',true);
        var url;
        //alert(idm);
        $('[name="transmatid2"]').val(idm);
        
        if (save_method =='transmat'){
            url = "<?php echo site_url('ProjectsM/ajax_trans_material')?>/"+id2;
        }
        else{
            url = "<?php echo site_url('ProjectsM/ajax_update_material')?>/"+id2;
        }
        

        $.ajax({
          url : url,
          type: "POST",
          data: $('#form_transmaterial').serialize(),
          dataType: "JSON",
          success: function(data)
          {
              
            if(data.status){
                $('#form_transmaterial').modal('hide');
                reload_table();
                if (save_method == 'transmat'){
                    new PNotify({
                        title: 'Yeah!',
                        text: 'Material is transfered successfully.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                }
                else{
                    new PNotify({
                        title: 'Hey!',
                        text: 'Material is updated successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
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

              $('#btnSavetrte').text('Save'); //change button text
              $('#btnSavetrte').attr('disabled',false); //set button enable 


          },
          error: function (jqXHR, textStatus, errorThrown)
          {
                new PNotify({
                    title: 'Psst!',
                    text: 'Material is already transfered but you can update it in Transfered Material table.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
           
           }
        });
            $('#btnSavetrte').text('Save'); 
            $('#btnSavetrte').attr('disabled',false); 
        }
    }
   
    function transferEqp(){
        
        save_method = 'transeqp';
        $('#form_transequipment')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#transfer_equipment').modal('show');  
        $('.modal-title').text('Transfer Equipment'); 
        //$('#transmatname').attr("disabled",false);  
    }

    function savetransferE(){
       if(confirm('Do you want to transfer this equipment?')){
        $('#btnSavetrte2').text('Saving...'); 
        $('#btnSavetrte2').attr('disabled',true);
        var url;
        //alert(idm);
        $('[name="transeqpid2"]').val(idm2);
        
        if (save_method =='transeqp'){
            url = "<?php echo site_url('ProjectsM/ajax_trans_equipment')?>/"+id2;
        }
        else{
            url = "<?php echo site_url('ProjectsM/ajax_update_material')?>/"+id2;
        }
        
        //alert('transfer'+id2+''+$('#transeqpname').val()+''+$('#trncom2').val());

        $.ajax({
          url : url,
          type: "POST",
          data: $('#form_transequipment').serialize(),
          dataType: "JSON",
          success: function(data)
          {
              
            if(data.status){
                $('#form_transequipment').modal('hide');
                reload_table();
                if (save_method == 'transeqp'){
                   new PNotify({
                        title: 'Yeah!',
                        text: 'Equipment is tranfered successfully.',
                        type: 'success',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                }
                else{
                    new PNotify({
                        title: 'Hey!',
                        text: 'Equipment is updated successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
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

              $('#btnSavetrte2').text('Save'); //change button text
              $('#btnSavetrte2').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Psst!',
                    text: 'Equipment is already transfered but you can update it in Transfered Equipment table.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                });
              }
        });
            $('#btnSavetrte2').text('Save'); 
            $('#btnSavetrte2').attr('disabled',false); 
        }
    }

    function ok_planned_task(id){
        if(confirm('Do you want to mark this activity done?')){
            $.ajax({
                url : "<?php echo site_url('ProjectsM/ok_planned_task')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    if(data.status){
                        viewNext(id2);
                        new PNotify({
                            title: 'Yeah!',
                            text: 'Activity updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3',
                            nonblock: {
                                nonblock: true
                            }
                        }); 
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    new PNotify({
                        title: 'Psst!',
                        text: 'Error in updating Activity.',
                        type: 'warning',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    });
                }
            });
        }
    }


    function visible_planned_task(id){
        if(confirm('Do you want to mark this activity done?')){
            $.ajax({
                url : "<?php echo site_url('ProjectsM/visible_planned_task')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    if(data.status){
                        viewNext(id2);
                        new PNotify({
                            title: 'Yeah!',
                            text: 'Activity updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3',
                            nonblock: {
                                nonblock: true
                            }
                        }); 
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    new PNotify({
                        title: 'Psst!',
                        text: 'Error in updating Activity.',
                        type: 'warning',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    });
                }
            });
        }
    }

    function viewNext(id){
        $("#acts").show();
        $("#todo_li").empty();
            $.ajax({
                url : "<?php echo site_url('ProjectsM/viewActs/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data.length>0){
                        data = sortByKey(data, 'postDate');
                        for (i =0; i<data.length; i++){
                            var d = new Date(data[i]['postDate']);
                            if (data[i]['visible'] != "false"){
                                if (data[i]['status']==null){
                                    
                                    $("#todo_li").append('<li>'+
                                        '<span class="handle">'+
                                          '<i class="fa fa-ellipsis-v"></i> '+
                                          '<i class="fa fa-ellipsis-v"></i>'+
                                        '</span>'+
                                        '<input type="checkbox" onclick ="ok_planned_task('+"'"+data[i]['next_id']+"'"+')">'+
                                        '<span class="text"><b>'+data[i]['projtsk_name']+'</b> - '+data[i]['nextAct']+'</span>'+
                                        '<small class="label label-danger"><i class="fa fa-clock-o"></i>  '+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'</small>'+
                                        '<div class="tools">'+
                                          '<i class="fa fa-edit" onclick="editnextAct('+"'"+data[i]['next_id']+"'"+');"></i> '+
                                          '<i class="fa fa-trash-o" onclick ="visible_planned_task('+"'"+data[i]['next_id']+"'"+')"></i>'+
                                        '</div>'+
                                    '</li>');
                                                  
                                }
                                else {
                                    $("#todo_li").append('<li>'+
                                        '<span class="handle">'+
                                          '<i class="fa fa-ellipsis-v"></i> '+
                                          '<i class="fa fa-ellipsis-v"></i>'+
                                        '</span>'+
                                        '<input type="checkbox" checked="checked" onclick ="ok_planned_task('+"'"+data[i]['next_id']+"'"+')">'+
                                        '<span class="text"><b>'+data[i]['projtsk_name']+'</b> - '+data[i]['nextAct']+'</span>'+
                                        '<small class="label label-danger"><i class="fa fa-clock-o"></i>  '+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+'</small>'+
                                        '<div class="tools">'+
                                          '<i class="fa fa-edit" onclick="editnextAct('+"'"+data[i]['next_id']+"'"+');"></i> '+
                                          '<i class="fa fa-trash-o" onclick ="visible_planned_task('+"'"+data[i]['next_id']+"'"+')"></i>'+
                                        '</div>'+
                                    '</li>');
                                }
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

    function saveN(){
        $('#btnn').text('Saving...'); 
        $('#btnn').attr('disabled',true);
        var url;
       
        if (save_method =='addnext'){
            url = "<?php echo site_url('ProjectsM/ajax_add_nextact')?>/"+id2;
        }
        else{
            url = "<?php echo site_url('ReportsM/ajax_update_nextAct')?>/";
        }

        $.ajax({
          url : url,
          type: "POST",
          data: $('#formeditcomnext').serialize(),
          dataType: "JSON",
          success: function(data)
          {
              
            if(data.status){
                $('#editnext').modal('hide');
                

                    new PNotify({
                        title: 'Hey!',
                        text: 'Changes saved successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                    viewNext(id2);
            }
            else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                  }
              }

              $('#btnn').text('Save'); 
              $('#btnn').attr('disabled',false);  
           

             },
            error: function (jqXHR, textStatus, errorThrown) {
            new PNotify({
                title: 'Oh No!',
                text: 'Something terrible happened. Error getting Data from the Server',
                type: 'error',
                styling: 'bootstrap3'
            }); 
           }
        });
            $('#btnn').text('Save'); 
            $('#btnn').attr('disabled',false); 
    }

    function editnextAct(id){
        save_method = 'editwork';
        $('#formeditcomnext')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('ReportsM/ajax_edit_N/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="nid"]').val(data.next_id);
                $('[name="tskname"]').val(data.task);
                $('[name="ncomm"]').val(data.nextAct);
                $('#editnext').modal('show');  
                $('.modal-title').text('Edit Next Activity'); 

            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Oh No!',
                    text: 'Something terrible happened. Error getting Data from the Server',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 
            }
        });
    }

</script>


 