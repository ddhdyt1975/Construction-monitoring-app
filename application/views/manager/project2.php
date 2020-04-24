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

    #loading-image {
      position: center;
      top: 200px;
      left: 400px;
      z-index: 100;
    }

</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Other Projects
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
                <div  class="row" >
                    <br>
                    <div id = "prjchart">
                    </div>

                    <div class="col-lg-6" id = "tsssk" style = "display:none;">
                         
                        <div class="box box-danger  box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Project Task</h3>
                                <div class="box-tools pull-right">
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div id = "prjtsk" class="box-body" class="box-collapse" style="max-height:405px;overflow-y: auto;">
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
                                        <table id="dataTables-material"  class="table table-striped table-bordered table-hover dataTable dtr-inline dt-responsive wrap" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
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
                                
                         <div class="col-lg-6">
                            <div class="box box-info collapsed-box box-solid">
                                <div class="box-header with-border">
                                <h3 class="box-title">Equipment Used</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="dataTable_wrapper">
                                        <table id="dataTables-equipment"  class="table table-striped table-bordered table-hover dataTable dtr-inline dt-responsive wrap" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
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
                    </div>
                </div>
            </div>  
        </div>

 

     </section>
</div>


<script>
   var save_method;
   var id2;
   var table, table2, table3, table4, table5;
   var idm, idm2;

   $(document).ready(function(){
        $('#pd').attr("class","treeview active");
        $('#otP').attr("class","active");
    });
   
    $('#prjselect').change(function() {

        var projectSelected = $(this).val();

        id2 = projectSelected;
        listproj(id2);
        listownedmat(id2);
        listownedeqp(id2);
        $('#prjchart').empty();
        
        showChart(id2);
        //showprojectdetails(id2);
       
        $('#tsssk').hide();
       
        $('#viewsup').hide();
        $("#loading").fadeOut("slow");
    });

 
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
         
        $('#transmatname').empty();
         $.ajax({
            url : "<?php echo site_url('ProjectsM/getOm/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                 
                for(i=0; i<data.length;i++){
                    $('#transmatname').append('<option value='+data[i]['mu_id']+'>'+data[i]['material_name']+' ('+data[i]['mu_date']+')</option>');
                    idm = (data[i]['mu_id'].substring(8+id2.length,(data[i]['material_id'].length)+8+id2.length));
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
    }

    function view_transactions(id){ 

        $('#viewsup').show();
      
        $("#dataTables-material").dataTable().fnDestroy();
        $("#dataTables-teu").dataTable().fnDestroy();
        $("#dataTables-equipment").dataTable().fnDestroy();
        $("#dataTables-tmu").dataTable().fnDestroy();

            table2 = $('#dataTables-material').DataTable({ 
                ajax: {
                        "url": "<?php echo site_url('Projects2M/ajax_list2')?>/" + id,
                        "type": "POST"
                    },
                    order: [[2, 'desc']],
                    responsive: true
                });


            table3 = $("#dataTables-tmu").DataTable({
                ajax: {
                    "url": "<?php echo site_url('Projects2M/ajax_list_transmat')?>/" + id,
                    "type": "POST"
                },  
                responsive: true
            });

            table4 = $("#dataTables-equipment").DataTable({
                ajax: {
                  "url": "<?php echo site_url('Projects2M/ajax_list4')?>/" + id,
                  "type": "POST"
                },
                order: [[2, 'desc']],
                responsive: true
            });

            table5 = $("#dataTables-teu").DataTable({
                ajax: {
                  "url": "<?php echo site_url('Projects2M/ajax_list_transeqp')?>/" + id,
                  "type": "POST"
                },
                responsive: true
            });
    }

    function showChart(id){
        var total1 = 0, total2 = 0;
        $("#prjchart").empty();
        $.ajax({
            url : "<?php echo site_url('Projects2M/getTasks/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data!=null){
               for(i=0; i<data.length;i++){
                    total = parseInt(data[i]['projdtsk_percent']); 
                    total2 = total2 + total;
                };
               
                $('#prjchart').append('<div class="col-lg-6">'+
                    
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
                                         
                                          
                                            '<div class="statRightHolder" id = "prjdetails" style="overflow-y:auto">'+
                                               
                                          '</div>'+
                                          
                                      '</div>'+
                                  '</div>'+
                                  // '<div class="box-footer" align="right">'+
                                  //           '<button data-backdrop="static" data-keyboard="true" data-toggle="modal" onclick="edit_project('+"'"+data[0]['project_code']+"'"+')" class="btn btn-info btn-sm "><i class="fa fa-pencil"></i> Edit Project Info</button>'+
                                  //       '</div>'+
                                  //   '</div>'+
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
                      $('#prjchart').append('<div class="col-lg-6">'+
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
                                                    '<span>No Task!</span>'+
                                                  '</div>'+
                                                '</div>'+
                                              '</div>'+
                                          '</div>'+
                                         
                                          
                                            '<div class="statRightHolder" id = "prjdetails" style="overflow-y:auto">'+
                                               
                                          '</div>'+
                                          
                                      '</div>'+
                                  '</div>'+
                                  // '<div class="box-footer" align="right">'+
                                  //           '<button data-backdrop="static" data-keyboard="true" data-toggle="modal" onclick="edit_project()" class="btn btn-info btn-sm "><i class="fa fa-pencil"></i> Edit Project Info</button>'+
                                  //       '</div>'+
                                  //   '</div>'+
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
                
                for(i=0; i<data.length;i++){

                    if ((data[i]['projdtsk_percent'] >= 75 ) && (data[i]['projdtsk_percent'] <= 100 )) {
                        $('#prjtsk').append(''+
                                            '<div class ="well" id="div'+data[i]['projdtsk_id']+'" ><p style="font-size:12px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong>'+//</text><text class="pull-right"> <button data-toggle="tooltip" data-placement="top" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title= "Add Comment" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" class="btn btn-primary btn-xs"><i class="fa fa-comment"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button> </text></p>'+
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
                                        '<div class ="well" id="div'+data[i]['projdtsk_id']+'"><p style="font-size:12px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong>'+//</text><text class="pull-right"> <button data-toggle="tooltip" data-placement="top" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title= "Add Comment" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" class="btn btn-primary btn-xs "><i class="fa fa-comment"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button> </text></p>'+
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
                                        '<div class ="well" id="div'+data[i]['projdtsk_id']+'"><p style="font-size:12px;"><strong>'+data[i]['projtsk_name']+'<text style="font-size:10px;"> (as of '+data[i]['projdtsk_update']+') </strong>'+//</text><text class="pull-right"> <button data-toggle="tooltip" data-placement="top" title="Update Task Percentage" onclick ="updateTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title= "Add Comment" onclick ="addtaskcomment('+"'"+data[i]['projdtsk_id']+"'"+');" class="btn btn-primary btn-xs "><i class="fa fa-comment"></i></button>&nbsp;<button data-toggle="tooltip" data-placement="top" title="Delete this Task"  onclick ="DeleteTask('+"'"+data[i]['projdtsk_id']+"'"+')" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button></text> </p>'+
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

    function getTaskCom(id){
        var today = new Date();
        var dd = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
      
        
        $("#div"+id+" ul").empty();
        
       $.ajax({
            url : "<?php echo site_url('ProjectsM/getTasksCom/')?>" +id,
            type: "GET",
            dataType: "JSON",
            success: function(data){   
                if (data!=null){
                    
                    for(i=0; i<data.length;i++){
                        //alert(data[i]['prjtsk_comm_id']);
                        if (data[i]['prjtsk_status']=='Unresolved'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" class="text-danger"><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'.</p></li>');
                        }
                        if (data[i]['prjtsk_status']=='Progress'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" class="text-info"><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'. </p></li>');
                        }
                        if (data[i]['prjtsk_status']=='Critical'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" class="text-warning"><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'. </p></li>');
                        }
                        if (data[i]['prjtsk_status']=='Open'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" class="text-success"><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'. </p></li>');
                        }

                        if ((data[i]['prjtskcom_update'] == dd)&&(data[i]['prjtsk_status']=='Resolved')||data[i]['prjtsk_status']=='Closed'){
                            $('#div'+id+' ul').append('<li><p style="font-size:10px;" ><b>'+data[i]['prjtsk_status']+' ('+data[i]['prjtsk_comment_date']+') </b>- '+data[i]['prjtsk_comment']+'. </p></li>');
                        }
                    };
                }
                else{
                    $('#div'+id+' ul').append('<li><p style="font-size:10px;" class ="texr-muted">Some issue is either Closed, Resolved or no Record.</p></li>');
                }
            }
        });
    }
</script>
  