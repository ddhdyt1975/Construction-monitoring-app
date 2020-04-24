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
<style type="text/css">
       
        th{
            padding: 4px 4px 4px 4px ;
            text-align: left ;
            text-decoration: underline;
            }

       #tbl1{
        
        border-collapse: collapse;
        height: 30px;
        }

        #td1{
            font-size: 15px;
            font-weight: bolder;
            border-top: 2px solid black;
            border-left: 2px solid black;
            border-bottom: 2px solid black;
            border-right: 2px solid black;
            padding: 5px;
        }
        #td2{
             font-size: 15px;
            font-weight: bolder;
            border-right: 2px solid black;
            padding: 5px;
        }
        ol{
            font-size: 13px;
            
        }
       li{
            font-weight: normal;
            text-decoration:none;
       }

       .row-centered {
        text-align:center;
        }
        .col-centered {
            display:inline-block;
            float:none;
        
            text-align:center;
       
            margin-right:-5px;
            margin-top:15px;
            margin-bottom:25px;
        } 
    }


    th, td {
        padding: 5px;
    }
}
</style>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Reports
            <small>(create Report to project here)</small>
        </h1>
        <ol class="breadcrumb">
            <li  class="inactive"><a href="ManagerM"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="ReportsM"><i class="fa fa-print"></i> Reports</a></li>
        </ol>
    </section>
    
    <section class="content">
    
        <div class = "row">
            <div class="col-lg-6">
                <label >Select Project to View</label>
                <div class = "form-group input-group">
                    <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                    <select id = "prjselect"  class="form-control">
                        <option value ="none"></option>
                        <?php foreach($projects as $each){ ?>
                        <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="repdate">Report Date</label>
                    <div class = "form-group input-group">
                        <input name="repdate" id="repdate" class="form-control r">
                        <span class="input-group-addon"><i class=" fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-lg-2">
                <label>Click to View</label>
                <button class="btn btn-success"  onclick="view()"><i class="fa fa-print"></i> View Report</button>
                </div>
            </div>
        </div>

        <div class = "row" id = "didiv" style="display:none;">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <div class="box box-primary box-solid">
                     
                    <div class="box-body" >
                        <div  id='DivIdToPrint'>
                        <table width="90%" align="center" BORDER="0" CELLSPACING="0" id ='tbl1'>
                            <thead>
                                <tr>
                                    <th colspan="7" class="text-center" >
                                        <p style = "font-size:22px;"> <img src ="<?php echo $user_info->path?>" width = "100" heigth = "100"/> <?php echo $user_info->company_name?></p>
                                    </th>                              </tr>
                                <tr>
                                <tr>
                                    <th colspan="7">
                                    <p align="center" style = "font-size:20px"><u>DAILY ACTIVITY REPORT</u></p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                    
                        </table>
                        <table id = 'tbl2'  width="90%" align="center">
                            <thead>
                                <tr >
                                    <td >  <br></td>
                                </tr>    
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                        <table id = 'tbl21'  width="90%" align="center">
                            <thead>
                                <tr >
                                    <td >  <br></td>
                                </tr>    
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table> 
                        <table id = 'tbl3'  width="90%" align="center">
                            <thead>
                                <tr >
                                    <td >   <br></td>
                                </tr>    
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                        <table id = 'tbl4'  width="90%" align="center">
                            <thead>
                                <tr >
                                    <td >   <br></td>
                                </tr>    
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                        <table id = 'tbl5'  width="90%" align="center">
                            <thead>
                                <tr >
                                    <td >   <br></td>
                                </tr>    
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                        <table id = 'tbl6'  width="90%"  align="center">
                            <thead>
                                <tr >
                                    <td >   <br></td>
                                </tr>    
                            </thead>
                            <tbody>
                                 <tr>
                                    <td>  <ol><u><b>Photo Log(s)</b></u> </ol>
                                    
                                    <div class= "im-centered row" id = "asd">

                                    </div>
                                    </td>
                                 </tr>
                            </tbody>
                        </table>

                    </div>
                    </div>
                    <div class ="box-footer" align ="right">
                        <button class ="btn btn-danger" id="btn" value="Print" onclick="printDiv();"><i class="fa fa-print"> Print</i></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="box" id="heart53100">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Customize Report</h3>
                        <div class="box-tools pull-right">
                            <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group ">
                            <label style="font-size:12px">
                            <input type="checkbox" class="icheckbox_minimal-blue" id = "AD" name = "AD" checked>
                            Activities of the Day
                            </label>
                        </div>
                        <div class="form-group  ">
                            <label style="font-size:12px">
                            <input type="checkbox" class="icheckbox_minimal-blue" id = "NPA" name = "NPA" checked>
                            Next Planned Activities
                            </label>
                        </div>
                        <div class="form-group  ">
                            <label style="font-size:12px">
                            <input type="checkbox" class="icheckbox_minimal-blue" id = "EU" name = "EU" checked>
                            Equipment Used
                            </label>
                        </div>
                        <div class="form-group r">
                            <label style="font-size:12px">
                            <input type="checkbox" class="icheckbox_minimal-blue" id = "MU" name = "MU" checked>
                            Material Used
                            </label>
                        </div>
                        <div class="form-group ">
                            <label style="font-size:12px">
                            <input type="checkbox" class="icheckbox_minimal-blue" id = "WA" name = "WA" checked>
                            Workers Assign
                            </label>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px">
                            <input type="checkbox" class="icheckbox_minimal-blue" id = "PH" name = "PH" checked>
                            Photos
                            </label>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px">
                            <a  onclick="editPrint();"><i class="fa fa-pencil"> <i class="fa fa-sun-o"></i></i>
                            Edit Weather</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px">
                            <a id="tese2" onclick="AddNextTask();"><i class="fa fa-plus"> </i> Add Next Day Activity</a> 
                            </label>
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px">
                            <a onclick = "addPhotos()"><i class = "fa fa-photo"></i> Add Photo</a>
                            </label>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div id="print" class="modal fade" role="dialog">
            <div class="modal-dialog ">
                <div class="modal-content ">
                    <div class="modal-header btn-success">
                       <h4 class="modal-title">Add new User</h4>
                    </div>
                    <div class="modal-body">
                       <p>Under Construction</p>
                    </div>
                    <div class="modal-footer btn-success" align="right">
                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Add User</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editPrint" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header  btn-primary">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_editw" class="form-group">
                            <div class="form-group">
                                <div class = "row">
                                    
                                    <div class="col-lg-6">
                                        <label for="repweather">Weather Condition</label>
                                        <select id = "repweather" name="repweather" class="form-control">
                                            <option value="Sunny">Sunny</option>
                                            <option value="Cloudy">Cloudy</option>
                                            <option value="Foggy">Foggy</option>
                                            <option value="Rainy">Rainy</option>
                                            <option value="Shower">Shower</option>
                                            <option value="Stormy">Stormy</option>
                                            <option value="Floody">Floody</option>
                                            <option value="Snowy">Snowy</option>
                                            <option value="Others">Others</option>

                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                      
                                    <div class="col-lg-4">
                                        <label for="reptemp">Temperature &deg;C</label>
                                        <input type="number" class="form-control" id="reptemp" name="reptemp" placeholder = "Enter Quantity"/>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="col-lg-2">
                                        <label for="repweather">Period</label>
                                        <select id = "repperiod" name="repperiod" class="form-control">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnW" class="btn btn-danger btn-sm" onclick="saveW();" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editwrk" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header  btn-primary">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_editwrk" class="form-group">
                            <div class="form-group">
                                <div class = "row">
                                    <div class="form-group hidden">
                                        <label for="wrkid">Task ID</label>
                                        <input type="text" class="form-control" id="wrkid" name="wrkid" placeholder = "Enter Task ID"/>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="repwrk">Worker Title</label>
                                        <input  class="form-control" id="repwrk" name="repwrk" placeholder = "Enter Work Title"/>  
                                        <span class="help-block"></span>
                                    </div>
                      
                                    <div class="col-lg-6">
                                        <label for="repqty">No of people Assigned:</label>
                                        <input type="number" class="form-control" id="repqty" name="repqty" placeholder = "Enter Quantity"/>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id ="btnwrk" class="btn btn-danger btn-sm" onclick ="saveWRK();">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="alert_modal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                   
                    <div class="modal-body">
                    <div id="myDialogText" style="font-size:16px">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_photo" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                   <div class="modal-header  btn-primary">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form   id="upload_file">
                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-12">
                                        <label>File input</label>
                                        <input type="file" name="userfile" id="userfile" >
                                    </div>
                                     
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" onclick="addPhoto(); ">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editcom" role="dialog">
            <div class="modal-dialog ">
                <div class="modal-content">
                   <div class="modal-header  btn-primary">
                       <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <form   id="formeditcom2">
                            <div class="form-group hidden">
                                <label for="pid">Task ID</label>
                                <input type="text" class="form-control" id="pid" name="pid" placeholder = "Enter Task ID"/>
                                <span class="help-block"></span>
                            </div>


                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-12">
                                        <label>Comment!</label>
                                        <textarea class="form-control" id ="comm" name="comm"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" onclick="savecomment(); ">OK</button>
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
    
    var projectSelected;
    var repdates;
    var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    var month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var month2 = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    var d;


    $(document).ready(function(){
        $('#rpt').attr("class","active");
    });

    $('#EU').change(function() {
        if (!this.checked)
            $('#tbl3 tbody').empty(); 
        else 
            EUDetails1(); 
            EUDetails();
    });

    $('#MU').change(function() {
        if (!this.checked)
            $('#tbl4 tbody').empty(); 
        else 
            MUDetails();
            MUDetails2();
    });

    $('#WA').change(function() {
        if (!this.checked)
            $('#tbl5 tbody').empty(); 
        else 
            WRKDetails();
    });

    $('#PH').change(function() {
        if (!this.checked)
            $('#tbl6 tbody').empty(); 
        else 
            Viewphotos();
    });

    $('#NPA').change(function() {
        if (!this.checked)
            $('#tbl21 tbody').empty(); 
        else 
           viewnextT(); 
    });

    $('#AD').change(function() {
        if (!this.checked)
            $('#tbl2 tbody').empty(); 
        else 
            viewActD(); 
    });

   

    $('#prjselect').change(function() {
        projectSelected = $(this).val(); 
    });

    $('#repdate').change(function() {
        repdates = $(this).val();
    });

    function view(){
        if ($('#prjselect').val()!="none"){
            viewDetails();
            WandTDetails();
            viewActD();
            viewnextT();
            EUDetails1();
            EUDetails();
            MUDetails();
            MUDetails2();
            WRKDetails();
            Viewphotos();
        }
        else{
            $('#didiv').hide();   
        }
    }

    function viewDetails(){
        d = new Date($('#repdate').val());
        $.ajax({
            url : "<?php echo site_url('ReportsM/ProjDetails')?>/"+ projectSelected,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                 
                $('#didiv').show();    
                $('#tbl1 tbody').empty();
                
                $('#tbl1 tbody').append('<tr>'+
                        '<td id = "td1" colspan ="4"><u>Project:</u> '+data['project_title']+'</td>'+
                        '<td id = "td1" colspan ="2" rowspan="2"><p><u>File: </u> '+data['project_code']+'-'+d.getDate()+''+(d.getMonth()+1)+''+d.getFullYear()+'</p><p><u>Date: </u>'+month2[d.getMonth()]+'. '+d.getDate()+', '+d.getFullYear()+'</p><p><u>Day: </u>'+days[d.getDay()]+'</p></td>'+
                    '</tr>'+
                    '<tr>'+
                    
                        '<td  id = "td1" colspan ="2"><p><u>Project Type: </u>'+data['project_type']+'</p><p><u>Sub Contractor: </u>'+data['project_sub_contractor']+'</p><p><u>Company Contract: </u>'+data['project_comp_contract']+'</p></td> '+
                        // '<td id = "td1" colspan ="2"><text id="ii"></text></td> '+
                    '</tr>'+
                  
                    '<tr>'+
                         '<td id = "td1" colspan ="6"><p><u>Project Manager: </u>'+data['user_fname']+' '+data['user_mname']+' '+data['user_lname']+'</p><p><u>Project Supervisor:</u>'+data['supervisor']+'</p><p><u>Project Foreman:</u>'+data['foreman']+'</p></td></tr>'+
                    '<tr>'+
                   '<td id = "td1" colspan ="6">Weather: <text id = "wandt"> </text>&nbsp;&nbsp;</td>'+
                '</tr>');
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

    function viewActD(){
        $('#tbl2 tbody').empty();
        $('#tbl2 tbody').append('<br><u><ol id = "ol2">  Activities of the Day </u><ul>');
                      
       
        $.ajax({
        url : "<?php echo site_url('ReportsM/actDetails/')?>/" + projectSelected +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if (data.length >0){
            for(i=0; i<data.length;i++){
                    $('#tbl2 ul').append('<li> '+data[i]['projtsk_name']+' updated to '+data[i]['updated_percent']+'%.</li><div id ="nested'+data[i]['updated_task_id']+'">');
                     
                    getComment(data[i]['updated_task_id'].substring(0,(data[i]['updated_task_id'].length - ($('#repdate').val().length-2))), "nested"+data[i]['updated_task_id']);
                    
                };
                $('#tbl2 ul').append('</ul><ol></div>');
            }
            else{
                $('#tbl2 ul').append('</ul><ol></div>');
                // $('#tbl2 ul').append('<li > No Activity Updated as of this day. </li>');
            } 
        getComment2();       
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

    function getComment(id, dd){
        $('#'+dd).empty();
        
        $.ajax({
        url : "<?php echo site_url('ReportsM/actComm/')?>/" + id +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if (data.length >0){
            $('#'+dd).append('<ol>Issue <ul>');
            for(i=0; i<data.length;i++){
                    $('#'+dd+' ul').append('<li>  '+data[i]['prjtsk_comment']+'. - <b>'+data[i]['prjtsk_status']+'</b></li>');
                     
                    //getComment(data[i]['updated_task_id'].substring(0,(data[i]['updated_task_id'].length - ($('#repdate').val().length-2)))+', '+"nested"+data[i]['updated_task_id']);
                    
                };
                $('#'+dd).append('</ul><ol></div>');
            }
            else{
                $('#'+dd).append('<ol>Issue <ul><li>No issue recorded.</li></ul></ol></div>');
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

    function getComment2(){
        $('#tbl2 tbody').append('<div id ="ptsk">');
        $('#ptsk').empty();
        $('#ptsk').append('<br><u><ol id = "ol2"> Other Task with Issues Found</u><ul>');
        
        $.ajax({
        url : "<?php echo site_url('ReportsM/actComm2/')?>/" + projectSelected +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if (data.length >0){
                for(i=0; i<data.length;i++){
                    //alert(data[i]['prjtsk_status']!="Resolved");

                    //if ((data[i]['prjtsk_status'] == "Unresolved") || (data[i]['prjtsk_status'] == "Progress") || (data[i]['prjtsk_status'] == "Critical") || (data[i]['prjtsk_status'] == "Open")) {
                    //    $('#ptsk ul').append('<li> '+data[i]['projtsk_name']+' ('+ data[i]['projdtsk_percent']+'%) - '+data[i]['prjtsk_comment']+'. - <b>'+data[i]['prjtsk_status']+' ('+ data[i]['prjtsk_comment_date']+')</b></li>');                   
                    if ((data[i]['prjtsk_status'] == "On-Going") || (data[i]['prjtsk_status'] == "Pending")) {
                        $('#ptsk  ul').append('<li> '+data[i]['projtsk_name']+' ('+ data[i]['projdtsk_percent']+'%) - '+data[i]['prjtsk_comment']+'. - <b>'+data[i]['prjtsk_status']+' ('+ data[i]['prjtsk_comment_date']+')</b></li>');
                    }
                };
                $('#ptsk ').append('</ul><ol>');
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

    function viewnextT(){
        $('#tbl21 tbody').empty();
        $('#tbl21 tbody').append('<ol> <u>Next Planned Activities</u><ul>');
        
        $.ajax({
        url : "<?php echo site_url('ReportsM/NXTDetails/')?>/" + projectSelected +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                if (data.length >0){
                    for(i=0; i<data.length;i++){
                        $('#tbl21 ul').append('<li>'+data[i]['projtsk_name']+' - '+data[i]['nextAct'] +' &nbsp;&nbsp;&nbsp;'+'<a class = "link" onclick="editnextAct('+"'"+data[i]['next_id']+"'"+');"><i class= "fa fa-pencil"> </i></a>&nbsp;&nbsp;&nbsp;<a style="color:red;"class = "link" onclick="deletenextAct('+"'"+data[i]['next_id']+"'"+');"><i class= "fa fa-trash"></a></li>');
                    };
                    $('#tbl21 ul').append('</ul><ol>');
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

    function AddNextTask(){
        save_method = 'addnext';
        $('#formeditcomnext')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#editnext').modal('show');  
        $('.modal-title').text('Add Next Activity'); 
    }

    function saveN(){
        $('#btnn').text('Saving...'); 
        $('#btnn').attr('disabled',true);
        var url;
       
        if (save_method =='addnext'){
            url = "<?php echo site_url('ReportsM/ajax_add_nextact')?>/"+projectSelected+"/"+$('#repdate').val() ;;
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
                        title: 'Success!',
                        text: 'Information added successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                    viewnextT();
               
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
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
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
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                }); 
            }
        });
    }

    function EUDetails1(){
        $('#tbl3 tbody').empty();
        $('#tbl3 tbody').append('<ol>  <u>Equipment Used</u>  <ul>');
                   
        $.ajax({
        url : "<?php echo site_url('ReportsM/EUDetails1/')?>/" + projectSelected +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                if (data.length >0){
                    for(i=0; i<data.length;i++){
                        $('#tbl3 ul').append('<li >'+data[i]['eu_quantity'] +' '+data[i]['equipment_name']+' is used from Warehouse.</li>');
                    };
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });  
    }
    
    function EUDetails(){
           
        $.ajax({
        url : "<?php echo site_url('ReportsM/EUDetails/')?>/" + projectSelected +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                if (data.length >0){
                    for(i=0; i<data.length;i++){
                        $('#tbl3 ul').append('<li >'+data[i]['eu_quantity'] +' '+data[i]['equipment_name']+' is used.');// transfered from '+data[i]['project_title']+'.</li>');          
                    };
                    //$('#tbl3 tbody').append('--- Nothing Follows ---');
                    //$('#tbl3 tbody').append('</ul></td></tr>');
                    $('#tbl3 ul').append('</ul><ol>');
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });  
    }

    function MUDetails(){
        $('#tbl4 tbody').empty();
        $('#tbl4 tbody').append('<ol> <u>Material Used</u>    <ul>');
                   
        $.ajax({
        url : "<?php echo site_url('ReportsM/MUDetails/')?>/" + projectSelected +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                if (data.length >0){
                    for(i=0; i<data.length;i++){
                        $('#tbl4 ul').append('<li >'+data[i]['mu_quantity'] +' '+ data[i]['unit_acro']+'  '+data[i]['material_name']+' is used from Warehouse.</li>');
                    };
                    
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });  
    }
    
    function MUDetails2(){
        $.ajax({
        url : "<?php echo site_url('ReportsM/MUDetails2/')?>/" + projectSelected +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                if (data.length >0){
                    for(i=0; i<data.length;i++){
                        $('#tbl4 ul').append('<li >'+data[i]['mu_quantity'] +' '+ data[i]['unit_acro']+'  '+data[i]['material_name']+' is used.');//' transfered from '+data[i]['project_title']+'.</li>');
                    };
                    //$('#tbl4 tbody').append('--- Nothing Follows ---');
                    //$('#tbl4 tbody').append('</ul></td></tr>');
                    $('#tbl4 ul').append('</ul><ol>');
                }
                    
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });  
    }

    function WandTDetails(){
        $('#wandt').empty();
        $.ajax({
        url : "<?php echo site_url('ReportsM/WandTDetails/')?>/" + projectSelected +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                for(i=0; i<data.length;i++){
                    $('#wandt').append( data[i]['rep_period']+'-'+data[i]['weather'] +':'+ data[i]['temperature']+'&deg;C; ');  
                };
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });  
    }

    function sortByKey(array, key) {
        return array.sort(function(a, b) {
            var x = a[key];
            var y = b[key];
            return ((x > y) ? 1 : ((x < y) ? -1 : 0));
        });
    }

    function WRKDetails(){
        var arr=[];
        var arr2=[];
        var holder='';
        var cnt=0;
        $('#tbl5 tbody').empty();
        $('#tbl5 tbody').append('<ol> <u>Worker(s) Assigned</u> <ul>');
        $.ajax({
        url : "<?php echo site_url('ReportsM/WRKDetails/')?>" + projectSelected +'/'+$('#repdate').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                //alert(data.length);
                $.each(data, function(index, el) {
                    // index is your 0-based array index
                    // el is your value
                    $('#tbl5 tbody ul').append('<li>'+index+' - '+ el+'</li>');
                
                  // for example
                    //alert("element at " + index + ": " + el); // will alert each value
                });
                $('#tbl5 tbody ul').append('</ul></ol>');
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });  
    }

    function editPrint(){
        save_method = 'addweather';
        $('#form_editw')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#editPrint').modal('show');  
        $('.modal-title').text('Edit Weather and Temperature '); 
        //$('#transmatname').attr("disabled",false);  
    }

    function saveW(){
        $('#btnW').text('Saving...'); 
        $('#btnW').attr('disabled',true);
        var url;
       
        if (save_method =='addweather'){
            url = "<?php echo site_url('ReportsM/ajax_add_weather')?>/"+projectSelected+"/"+$('#repdate').val() ;
        }
        else{
             
        }
        //alert(url);
        $.ajax({
          url : url,
          type: "POST",
          data: $('#form_editw').serialize(),
          dataType: "JSON",
          success: function(data)
          {
              
            if(data.status){
                $('#editPrint').modal('hide');
                //reload_table();
                if (save_method == 'addweather'){
                    new PNotify({
                        title: 'Hey!',
                        text: 'Changes saved successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    });
                    WandTDetails();
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

              $('#btnW').text('Save'); 
              $('#btnW').attr('disabled',false);  
           

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
            $('#btnW').text('Save'); 
            $('#btnW').attr('disabled',false); 
    }

    function AddWorker(){
        save_method = 'addwork';
        $('#form_editwrk')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#editwrk').modal('show');  
        $('.modal-title').text('Add Worker'); 
    }

    function saveWRK(){
        $('#btnwrk').text('Saving...'); 
        $('#btnwrk').attr('disabled',true);
        var url;
       
        if (save_method =='addwork'){
            url = "<?php echo site_url('ReportsM/ajax_add_worker')?>/"+projectSelected+"/"+$('#repdate').val() ;;
        }
        else{
            url = "<?php echo site_url('ReportsM/ajax_update_worker')?>/";
        }

        $.ajax({
          url : url,
          type: "POST",
          data: $('#form_editwrk').serialize(),
          dataType: "JSON",
          success: function(data)
          {
              
            if(data.status){
                $('#editwrk').modal('hide');
                //reload_table();

                   new PNotify({
                        title: 'Success!',
                        text: 'Information added successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    }); 
                    WRKDetails();
               
            }
            else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                  }
              }

              $('#btnwrk').text('Save'); 
              $('#btnwrk').attr('disabled',false);  
           

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
            $('#btnwrk').text('Save'); 
            $('#btnwrk').attr('disabled',false); 
    }

    function editwrkd(id){
        save_method = 'editwork';
        $('#form_editwrk')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        //alert(id);
            $.ajax({
                url : "<?php echo site_url('ReportsM/ajax_edit_work/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    //alert(data.material_name);
                    $('[name="wrkid"]').val(data.projdtsk_id);
                    $('[name="repwrk"]').val(data.worker_title);
                    $('[name="repqty"]').val(data.worker_quantity);                
                    
                    $('#editwrk').modal('show');  
                    $('.modal-title').text('Edit Worker'); 

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

    function Viewphotos(){
        $('#tbl6 tbody').append('<tr><td>  <ol><u><b>Photo Log(s)</b></u> </ol><div class= "im-centered row" id = "asd"></div></td> </tr>');
        $('#asd').empty(); 
        $.ajax({
            url : "<?php echo site_url('ReportsM/PhotoDetails/')?>/" + projectSelected +'/'+$('#repdate').val(),
            type: "GET",
            dataType: "JSON",
                success: function(data) {
                    if (data.length >0){
                        
                        for(i=0; i<data.length;i++){
                            if (data[i]['photo_comment']!=null){
                                $('#asd').append('<div class = "col-lg-6 col-centered" ><div class="pull-right"><a data-toggle="tooltip" data-placement="top" title="Edit photo Comment" onclick="editcom('+"'"+data[i]['photo_id']+"'"+');"><i class="fa fa-pencil"></i></a> </i></p><p data-toggle="tooltip" data-placement="top" title="Delete photo"><i class="fa fa-trash text-danger" onclick="deletePhoto('+"'"+data[i]["photo_id"]+"'"+')"></i></p></div><img src="'+data[i]['photo']+'" style="width:290px; height:200px;"><br>&nbsp;&nbsp; '+data[i]['photo_comment']+' &nbsp;&nbsp;</div>');
                            }
                            else{
                                $('#asd').append('<div class = "col-lg-6 col-centered" ><div class="pull-right"><a data-toggle="tooltip" data-placement="top" title="Add photo comment" onclick="editcom('+"'"+data[i]['photo_id']+"'"+');"><i class="fa fa-plus"></i></a></p><p data-toggle="tooltip" data-placement="top" title="Delete photo"><i class="fa fa-trash text-danger" onclick="deletePhoto('+"'"+data[i]["photo_id"]+"'"+')"></i></p></div><img src="'+data[i]['photo']+'" style="width:290px; height:200px;"><br>&nbsp;&nbsp;</div>');
                            }
                        };
                    }
                    else{
                        $('#asd').append('<div class class = "col-lg-12 col-centered">No Photo uploaded yet!!!</div>');
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

    function addPhotos(){
        $('#upload_file')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#add_photo').modal('show');  
        $('.modal-title').text('Add Daily Photo'); 
    }

    function printDiv() {
        var divToPrint = document.getElementById('DivIdToPrint');
        var htmlToPrint = '' +
        '<style >' +
        'body {' +
            'font-family: arial, sans-serif ;' +
            'font-size: 12px ;' +
            '}' +
        
        'th{' +
            'padding: 4px 4px 4px 4px ;' +
            'text-align: left ;' +
            'text-decoration: underline;' +
            '}' +

       '#tbl1{' +
        
        'border-collapse: collapse;' + 
        'height: 60px;' +
        '}' +

        '#td1{' +
            'font-size: 15px;' +
            'font-weight: bolder;' +
            'border-top: 2px solid black;' +
            'border-left: 2px solid black;' + 
            'border-bottom: 2px solid black;' +
            'border-right: 2px solid black;padding: 5px;' +
        '}' +
        '#td2{' +
            ' font-size: 10px;' +
            'font-weight: bolder;' +
            'border-right: 2px solid black;padding: 5px;' +
        '}' +
        'ol{' +
            'font-size: 13px;' +
              
        '}' +
       'li{' +
           ' font-weight: normal;' +
           ' text-decoration:none;' +
       '}' +


       '.row-centered {'+
        'text-align:center;'+
        '}'+
        '.col-centered {'+
        'display:inline-block;'+
        'float:none;'+
        'text-align:center;'+
       'margin-right:-5px; '+
       'margin-top:15px; '+
       'margin-left:25px; '+

        '</style>';
      
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }

    function addPhoto(){
        $.ajaxFileUpload({
            url             :"<?php echo site_url('ReportsM/upload_file/')?>" + projectSelected+'/'+$('#repdate').val(), 
            secureuri       :false,
            fileElementId   :'userfile',
            dataType: 'JSON',
            success : function (data){
               
                $('#add_photo').modal('hide'); 
                new PNotify({
                    title: 'Success!',
                    text: 'Photo added successfully.',
                    type: 'info',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
                Viewphotos(); 
            }
        });
        return false;
    } 
    
    function editcom(id){
        save_method = 'addcom';
        $('#formeditcom2')[0].reset();
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();

        $.ajax({
            url : "<?php echo site_url('ReportsM/ajax_editp/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="pid"]').val(data.photo_id);
                $('[name="comm"]').val(data.photo_comment);
                 
                
                
                $('#editcom').modal('show');  
                 $('.modal-title').text('Add Photo Comment'); 

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
 
    function savecomment(){

        var url;
       
        if (save_method =='addcom'){
            url = "<?php echo site_url('ReportsM/ajax_add_comment')?>/";
        }
        else{
            url = "<?php echo site_url('ReportsM/ajax_update_worker')?>/";
        }

        $.ajax({
          url : url,
          type: "POST",
          data: $('#formeditcom2').serialize(),
          dataType: "JSON",
          success: function(data)
          {

            //alert($('#formeditcom2').serialize());
              
            if(data.status){
                $('#editcom').modal('hide');
                //reload_table();

                    new PNotify({
                        title: 'Success!',
                        text: 'information added successfully.',
                        type: 'info',
                        styling: 'bootstrap3',
                        nonblock: {
                            nonblock: true
                        }
                    });
                    Viewphotos();
               
            }
            else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                  }
              }

              $('#btnwrk').text('Save'); 
              $('#btnwrk').attr('disabled',false);  
           

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
            $('#btnwrk').text('Save'); 
            $('#btnwrk').attr('disabled',false); 
    }
    
    function deletewrkd(id){

        if(confirm('Do you want to delete this worker info?'))
        {
                $.ajax({
                url : "<?php echo site_url('ReportsM/ajax_delete_work')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    WRKDetails();
                    new PNotify({
                        title: 'Success!',
                        text: 'Information deleted successfully.',
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
                        title: 'Error!',
                        text: 'A process cannot get through. Please consult your admin.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                }
            });

        }        
    }

    function deletenextAct(id){

        if(confirm('Do you want to delete this Next Activity?'))
        {
                $.ajax({
                url : "<?php echo site_url('ReportsM/ajax_delete_next')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    viewnextT();
                    new PNotify({
                        title: 'Success!',
                        text: 'Information deleted successfully.',
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
                        title: 'Error!',
                        text: 'A process cannot get through. Please consult your admin.',
                        type: 'error',
                        styling: 'bootstrap3'
                    }); 
                }
            });

        }        
    }

    function deletePhoto(id){
        if(confirm('Do you want to delete this photo')){
            $.ajax({
                url : "<?php echo site_url('ReportsM/ajax_delete_photo')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    Viewphotos();
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