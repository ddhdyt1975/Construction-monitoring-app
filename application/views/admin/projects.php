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
<style type="text/css">
    .avatars:hover {
    position:absolute;
    top:-125px;
    left:435px;
    width:500px;
    height:500px;
    display:absolute;
    z-index:999;
    }
    .avatars{
    width:60px;
    height: 60px;
    align-content:center;
    }

    #prjstrt{
        z-index: 1100 !important;
    }
.Projects .list-inline{margin:0}.profile_title{background:#F5F7FA;border:0;padding:7px 0;display:-ms-flexbox;display:flex}ul.stats-overview{border-bottom:1px solid #e8e8e8;padding-bottom:10px;margin-bottom:10px}ul.stats-overview li{display:inline-block;text-align:center;padding:0 15px;width:30%;font-size:14px;border-right:1px solid #e8e8e8}ul.stats-overview li:last-child{border-right:0}ul.stats-overview li .name{font-size:12px}ul.stats-overview li .value{font-size:14px;font-weight:bold;display:block}ul.stats-overview li:first-child{padding-left:0}ul.project_files li{margin-bottom:5px}ul.project_files li a i{width:20px}.project_detail p{margin-bottom:10px}.project_detail p.title{font-weight:bold;margin-bottom:0}.avatar img{border-radius:50%;max-width:45px}.pricing{background:#fff}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Projects
        </h1>

 
        <ol class="breadcrumb">
            <li  class="active"><a href="Admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="Projects"><i class="fa fa-book"></i> Projects</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                    <h3  > List of Projects</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-success btn-sm  " onclick="add_project()" ><i class="fa fa-plus"></i> Add New Project</button>
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped Projects" id = "Projects-overview">
                            <thead>
                                <tr>
                                    <th style="width: 25%">Project Name</th>
                                    <th style="width: 20%">Project Manager</th>
                                    <th style="width: 25%">Project Progress</th>
                                    <th style="width: 10%">Status</th>
                                    <th style="width: 25%">#Edit</th>
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
                            <div class="form-group">
                                <label for="prjcode">Project Code</label>
                                <input type="text" class="form-control" id="prjcode" name="prjcode" placeholder = "Enter Project Code"/>
                                <span class="help-block"></span>

                            </div>

                            <div class="form-group">
                                <label for="prjmng">Project Manager</label>
                                <select id = "prjmng" name="prjmng" class="form-control">
                                <option value=""></option>
                                    <?php foreach($PM as $cobject)
                                        echo '<option value='.$cobject->user_id.'>'.$cobject->user_fname.' '.$cobject->user_lname.'</option>'
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="prjown">Project Owner</label>
                                <select id = "prjown" name="prjown" class="form-control">
                                <option value=""></option>
                                    <?php foreach($owner as $cobject)
                                        echo '<option value='.$cobject->user_id.'>'.$cobject->user_fname.' '.$cobject->user_lname.'</option>'
                                    ?>
                                </select>
                            </div>
                           
                      
                            <div class="form-group">
                                <label for="prjtitle">Project Title</label>
                                <input type="text" class="form-control" id="prjtitle" name="prjtitle" placeholder="Enter Project Title"/>
                                <span class="help-block"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="prjdesc">Project Description  <span class ="fa fa-comment"></span></label>
                                <textarea type="text" class="form-control" id="prjdesc" name="prjdesc" placeholder="Enter Project Description"> </textarea>
                                <span class="help-block"></span>

                            </div>

                            <div class="form-group ">
                                <label for="prjdstatus">Project Status</label>
                                     <select id = "prjstatus" name="prjstatus" class="form-control">
                                        <option value=""></option>
                                        <option value="On-Going">On-Going</option>
                                        <option value="Back-job">Back-job</option>
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
                                        <input type="text" name="prjstrt" id="prjstrt"  class="form-control" value ="<?php echo date('m/d/Y')?>">
                                        <span class="help-block"></span>
                                    </div>
                                   
                                    <div class="col-lg-6">
                                        <label for="prjend">Project End Date:</label>
                                         <input type="text" name="prjend" id="prjend"  class="form-control">
                                        
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="prjfore">Foreman</label>
                                <input type="text" class="form-control" id="prjfore" name="prjfore" placeholder="Enter Foreman Name"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="prjsv">Supervisor</label>
                                <input type="text" class="form-control" id="prjsv" name="prjsv" placeholder="Enter Supervsor Name"/>
                                <span class="help-block"></span>

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
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form_task" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  btn-success">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="formtask" class="form-group">
                            <div class="form-group">
                                <label for="prjcode">Task Id</label>
                                <input type="text" class="form-control" id="tskid" name="tskid" placeholder = "Enter Task Id"/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="prjcode">Task Name</label>
                                <input type="text" class="form-control" id="tskname" name="tskname" placeholder = "Enter Task name"/>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="prjcode">Task Description</label>
                                <textarea type="text" class="form-control" id="tskdecs" name="tskdecs" placeholder = "Enter Task description"></textarea>
                                <span class="help-block"></span>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="savet()" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form2" role="dialog" style = "height:auto;">
            <div class="modal-dialog modal-lg" > 
                <div class="modal-content">
                    <div class="modal-header  btn-success">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form2" class="form-group">
                            <div class="">
                                <div class="page-title">
                                    <div class="title_left green">
                                        <h3 id = "ptit" name = "ptit"></h3> 
                                        <h4 id = "dit" name = "dit"></h4> 
                                    </div>
                                    <div class="title_right green">
                                    </div>
                                </div>
                    
                                <div class="clearfix"></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="">
                                            <div class="box-body">
                                                
                                                <div class="col-lg-9">
                                                    <ul class="stats-overview">
                                                        <li>
                                                            <span class="name"> Estimated No of Materials used </span>
                                                            <div id = "nom"></div>
                                                        </li>
                                                        <li>
                                                            <span class="name"> Estimated No of Equipment used </span>
                                                            <div id= "noe"></div>
                                                        </li>
                                                        <li class="hidden-phone">
                                                            <span class="name"> No. of project Task(s) </span>
                                                            <div id = "not"></div>
                                                        </li>
                                                    </ul>
                                                    <br />
                                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                     
                                                    </div>
                                                    <br>
                                                    <div id ="tskk" style="overflow-y:auto;">
                                                        
                            
                                                            
                                                    </div>
                                                </div>
                     
                                                <div class="col-lg-3">
                                                    <section class="panel">
                                                        <div class="x_title green">
                                                            <h2>Project Description</h2>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <p id ="pdesc"></p>
                                                            <br />
                                                        </div>
                                                    </section>

                                                    <section class="panel">
                                                        <div class="project_detail" align="center">
                                                            <p class="title green">Project Owner</p>
                                                            <p id = "pjown"></p>  
                                                            <p class="title green">Project Type</p>
                                                            <p id = "ptype"></p>  
                                                            <p class="title green">Sub-Contractor</p>
                                                            <p id = "psub"></p>
                                                            <p class="title green">Company Contract</p>
                                                            <p id = "pcon"></p>
                                                        </div>
                                                        <br />
                                                    </section>
                                            
                                                    <section class="panel">
                                                        <div class="project_detail" align="center">
                                                            <p class="title green">Project Manager</p>
                                                            <p id = "pl"></p>
                                                            <p class="title green">Project Foreman</p>
                                                            <p id = "pf"></p>
                                                            <p class="title green">Project Supervisor</p>
                                                            <p id = "ps"></p>
                                                        </div>
                                                        <br />
                                                    </section>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>   
                </div>
            </div>
        </div>

    </section>
</div>


<script>
    $(document).ready(function() {
        $('#pa').attr("class","active");
        Display();
    });
   
    var save_method;

    $(document).ready(function(){
        $('#prjtype').on('change', function(){
            
            if (this.value == "w/ Sub Contractor"){
                $("#gprjscn").show();
                $('[name="prjcn"]').val("");
                $("#gprjcn").hide();
            }
            else if (this.value == "Company Contract"){
                $("#gprjscn").hide();
                $('[name="prjscn"]').val("");
                $("#gprjcn").show();
            }
            else if (this.value == "Hybrid"){
                $("#gprjscn").show();
                $("#gprjcn").show();
            }
            else{   
               $('[name="prjcn"]').val("");
               $('[name="prjscn"]').val("");
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

    function savet(){
        $.ajax({
        url : "<?php echo site_url('Projects/ajax_add_task')?>",
        type: "POST",
        data: $('#formtask').serialize(),
        dataType: "JSON",
        success: function(data){              
            new PNotify({
                title: 'Success!',
                text: 'Information successfully added.',
                type: 'success',
                styling: 'bootstrap3'
            });
            $('#modal_form_task').modal('hide');

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

    function Display(){
        $("#Projects-overview tbody").empty();
        $.ajax({
        url : "<?php echo site_url('Projects/getProjects/')?>" ,
        type: "GET",
        dataType: "JSON",
        success: function(data){   
            data = sortByKey(data, 'created_date');
            
            for(i=0; i<data.length;i++){
                $('#Projects-overview tbody').append('  <tr>     <td>       <a style="font-weight:bolder;font-size:12px;">'+data[i]['project_title']+'</a>        <br />         <small>Created: '+data[i]['ddate']+' - Updated:'+ data[i]['edate']+'</small>     </td>         <td>          <ul class="list-inline">    <li>     <img src="'+data[i]['user_photo']+'" class="img-md"  alt="'+data[i]['usertype_name']+'">    </li><li>'+data[i]['user_fname']+' '+data[i]['user_lname']+'</li>    </ul>     </td>      <td class="project_progress">      <div class="progress progress-striped active">    <div class="progress-bar bg-green" id = "'+'p'+i+'" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" >       </div>    </div>    <small ><text id = "'+'pname'+i+'"> </text>% Complete</small> </td>     <td>   <button type="button" class="btn btn-success btn-xs">'+data[i]['project_status']+'</button>   </td>       <td>     <a onclick="view_project('+"'"+data[i]['project_code']+"'"+')" class="btn btn-primary btn-xs"><i class="fa fa-area-chart"></i> View </a>  <a onclick="edit_project('+"'"+data[i]['project_code']+"'"+')" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>   <a onclick="delete_project('+"'"+data[i]['project_code']+"'"+')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>    </td>      </tr>     ');
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

    function sortByKey(array, key) {
        return array.sort(function(a, b) {
            var x = a[key];
            var y = b[key];
            return ((x < y) ? 1 : ((x > y) ? -1 : 0));
        });
    }

    function showChart(id, z){
        var total1 = 0, total2 = 0, total3 = 0;
        $.ajax({
            url : "<?php echo site_url('Projects/getTasks/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data!=null){
                    for(i=0; i<data.length;i++){
                        total = parseInt(data[i]['projdtsk_percent']); 
                        total2 = total2 + total;
                    };
                    
                    total3 = total2/data.length;
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

    function view_project(id){
        
        $('#form2')[0].reset();
        $.ajax({
            url : "<?php echo site_url('Projects/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
               
                
                $('#ptit').text(data.project_title);
                $('#pl').text(data.user_fname+' '+data.user_lname);
                $('#dit').text('Duration: ('+data.start_project+' to '+data.expected_end_date+')');
              
                if (data.project_desc == ""){
                    $('#pdesc').text("--- No Record Found ---");
                }
                else{
                    $('#pdesc').text(data.project_desc);
                }

                if (data.project_owner == ""){
                    $('#pjown').text("--- No Record Found ---");
                }
                else{
                    $('#pjown').text(data.ofname+" "+data.olname);
                }

                if ((data.supervisor == null)||(data.supervisor == "")){
                    $('#ps').text("--- No Record Found ---");
                }
                else{
                    $('#ps').text(data.supervisor);
                }
                   
                if ((data.foreman == null)||(data.foreman == "")){
                    $('#pf').text("--- No Record Found ---");
                }
                else{
                    $('#pf').text(data.foreman);
                }
                   
                if (data.project_type=="Hybrid"){
                    $('#ptype').text(data.project_type);
                    $('#psub').text(data.project_sub_contractor);
                    $('#pcon').text(data.project_comp_contract);
                }
                if (data.project_type=="w/ Sub Contractor"){
                    $('#ptype').text(data.project_type);
                    $('#psub').text(data.project_sub_contractor);
                    $('#pcon').text("- - -");
                }
                else{
                    $('#ptype').text(data.project_type);
                    $('#psub').text("- - -");
                    $('#pcon').text(data.project_comp_contract);
                }

                getImages(id);
                getProblems(id);
                getE(id);
                getM(id);
                showT(id);
                $('#modal_form2').modal('show');
                $('.modal-title').text('Project Details'); 
 
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

    function add_task(){
        save_method = 'add';
        $('#formtask')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form_task').modal('show');
        $('.modal-title').text('Add new Task');
    }

    function add_project(){
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add new Project');
    }

    function edit_project(id){
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
       
        $.ajax({
            url : "<?php echo site_url('Projects/ajax_edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){

                $('[name="prjcode"]').val(data.project_code);
                $('[name="prjtitle"]').val(data.project_title);
                $('[name="prjdesc"]').val(data.project_desc);
                $('[name="prjstatus"]').val(data.project_status);
                $('[name="prjaddr"]').val(data.project_address);
                $('[name="prjcity"]').val(data.city_id);
                $('[name="prjtype"]').val(data.project_type);
                $('[name="prjmng"]').val(data.pmid);
                $('[name="prjown"]').val(data.ownid);
                $('[name="prjstrt"]').val(data.start_project);
                $('[name="prjend"]').val(data.expected_end_date);
                $('[name="prjfore"]').val(data.foreman);
                $('[name="prjown"]').val(data.project_owner);
                $('[name="prjsv"]').val(data.supervisor);

                
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

    function getImages(id){
        $('#myCarousel').empty();
        $('#myCarousel').append('<div class="carousel-inner" role="listbox" id = "lili">');
        $.ajax({
            url : "<?php echo site_url('Projects/getImages')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if (data.length>0){
                    $('#lili').empty();
                    for(i=0; i<data.length;i++){
                        if (i==0){
                            $('#lili').append('<div class="item active">'+
                                '<img src="'+data[i]['photo']+'" >'+
                                '<div class="carousel-caption green" style=" font-weight:bolder;color:black;">'+
                                    '<h4>'+data[i]['photo_upload_date']+'</h4>'+
                                    '<p>'+data[i]['photo_comment']+'</p>'+
                                '</div>'+
                            '</div>');
                        }
                        else{

                            $('#lili').append('<div class="item">'+
                              '<img src="'+data[i]['photo']+'" >'+
                                '<div class="carousel-caption green" style=" font-weight:bolder;color:black;">'+
                                    '<h4>'+data[i]['photo_upload_date']+'</h4>'+
                                    '<p>'+data[i]['photo_comment']+'</p>'+
                                '</div>'+
                            '</div>');
                        }
                    };

                    $('#lili').append('</div><a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">'+
                            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>'+
                            '<span class="sr-only">Previous</span>'+
                        '</a>'+
                        '<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">'+
                            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'+
                            '<span class="sr-only">Next</span>'+
                        '</a>'+
                    '</div>');
                }
                else{
                    $('#lili').append('<div class="item active" align ="center>'+
                        '<div class=" green" style=" font-weight:bolder;align:center;" >'+
                            '<h4>No images Uploaded</h4>'+
                            '<p>Photos uploaded in Reports will show here.</p>'+
                        '</div>'+
                        '<img src="<?= base_url() ?>/assets/noimages.png" alt="No Image(s) Uploaded.">'+

                    '</div>');
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

    function getProblems(id){
        $('#tskk').empty();
        $('#tskk').append('<h4>Recent Task Issues</h4><ul class="messages" id = "mess" >');
        $.ajax({
            url : "<?php echo site_url('Projects/getProbs')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if (data.length>0){
                    for(i=0; i<data.length;i++){
                         
                             $('#mess').append('<li>'+
                                '<img src="'+data[i]['user_photo']+'" class="img img-sm" alt="Avatar">'+
                                '<div class="message_date">'+
                                    '<h4 class="date text-info">'+data[i]['prjtskcom_update']+'</h4>'+
                                    
                                '</div>'+
                                '<div class="message_wrapper">'+
                                    '<h4 class="heading">'+data[i]['prjtsk_status']+'</h4>'+
                                    '<blockquote class="message">'+data[i]['prjtsk_comment']+'</blockquote>'+
                                    '<br />'+
                                '</div>');
                           
                        $('#mess').append('</ul>');
                    };
                }
                else{
                    $('#mess').append('<li> NO Issues Found</li></ul>');
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

    function getE(id){
        $('#noe').empty();
        //$('#tskk').append('<h4>Recent Task Issues</h4><ul class="messages" id = "mess" >');
        $.ajax({
            url : "<?php echo site_url('Projects/getNOofEQ')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data['total']!=null){
                    $('#noe').append('<span class="value text-success" > '+data['total']+'</span>');
                }
                else{
                    $('#noe').append('<span class="value text-success" > No record Found</span>');
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

    function getM(id){
        $('#nom').empty();
        //$('#tskk').append('<h4>Recent Task Issues</h4><ul class="messages" id = "mess" >');
        $.ajax({
            url : "<?php echo site_url('Projects/getNOofMT')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data['total2']!=null){
                    $('#nom').append('<span class="value text-success" > '+data['total2']+'</span>');
                }
                else{
                    $('#nom').append('<span class="value text-success" > No record Found</span>');
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

    function showT(id){
        $('#not').empty();
        $.ajax({
            url : "<?php echo site_url('Projects/getTasks/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data!=null){
                    $('#not').append('<span class="value text-success" > '+data.length+'</span>');
                }
                else{
                    $('#not').append('<span class="value text-success" > No task Found</span>');
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

    function save(){
        $('#btnSave').text('Saving...'); 
        $('#btnSave').attr('disabled',true);
        var url;

          if(save_method == 'add') {
              url = "<?php echo site_url('Projects/ajax_add')?>";
          } else {
              url = "<?php echo site_url('Projects/ajax_update')?>";
          }

          $.ajax({
              url : url,
              type: "POST",
              data: $('#form').serialize(),
              dataType: "JSON",
              success: function(data)
              {
                  
                  if(data.status) 
                  {
                      $('#modal_form').modal('hide');
                      if(save_method == 'add'){
                        //$( "#Projects-overview" ).load( "<?=base_url() ?>/admin/Projects #Projects-overview" );
                        Display();
                         new PNotify({
                            title: 'Status',
                            text: 'Information successfully added.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                         
                    }else{
                        //$( "#Projects-overview" ).load( "<?=base_url() ?>/admin/Projects #Projects-overview" );
                        Display();
                        new PNotify({
                            title: 'Status',
                            text: 'Information successfully updated.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                      //reload_table();
                  }
                  else
                  {
                      for (var i = 0; i < data.inputerror.length; i++) 
                      {
                          $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                          $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                      }
                  }

                  $('#btnSave').text('Save Changes'); //change button text
                  $('#btnSave').attr('disabled',false); //set button enable 


              },
              error: function (jqXHR, textStatus, errorThrown){
               new PNotify({
                        title: 'Error!',
                        text: 'A process cannot get through. Please consult your admin.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });  
                

                $('#btnSave').text('Save'); 
                $('#btnSave').attr('disabled',false); 

              }
          });
    }

    function delete_project(id){
        if(confirm('Are you sure delete this project?')) {
             $.ajax({
                url : "<?php echo site_url('Projects/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    Display();
                   new PNotify({
                            title: 'Status',
                            text: 'Information successfully deleted.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                      
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
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
 