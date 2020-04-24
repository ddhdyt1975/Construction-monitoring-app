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

</style>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Reports    
        </h1>
        <ol class="breadcrumb">
            <li  class=""><a href="Admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="Reports"><i class="fa fa-print"></i> Reports</a></li>
        </ol>
        
    </section>
     
    <section class="content">
        <div class = "row">
            <div class="col-lg-6">
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
            
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="idTourDateDetails">Report Date</label>
                    <div class = "form-group input-group">
                        <input id="single_cal5" class="date-picker form-control col-lg-4 col-xs-12 active" value="<?php echo date("m/d/Y")?>" required="required" type="text">
                        <span class="input-group-addon"><i class=" fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div>
                <div class="col-lg-2">
                <label>Click to View</label>
                <a onclick="view()" class="btn btn-danger"  ><i class="fa fa-print"></i> View Report</a>
                </div>
            </div>

           <div   id = "didiv" style="display:none;">
            <div class="col-lg-12">
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
                        <table id = 'tbl24'  width="90%" align="center">
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
                                    <td>  <ol><u><b>Photo Log(s)</b></u>  </ol>
                                    
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
        </div>
        </div>
    </section>
</div>

<script>
      $(document).ready(function() {
        $('#ra').attr("class","active");
        $('#single_cal5').datepicker({
            dateFormat: 'mm/dd/yy',
            minDate: '+5d',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            altField: "#idTourDateDetailsHidden",
            altFormat: 'mm/dd/yy'
        });
    });
</script>

<script>
    
    var projectSelected;
    var repdates;
    var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    var d;
    var month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var month2 = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

    $('#prjselect').change(function() {
        projectSelected = $(this).val(); 
    });

    $('#single_cal5').change(function() {
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
        d = new Date($('#single_cal5').val());
        $.ajax({
            url : "<?php echo site_url('Reports/ProjDetails/')?>/" + projectSelected,
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
                   '<td id = "td1" colspan ="6">Weather: <text id = "wandt"> </text>&nbsp;&nbsp; </td>'+
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
        url : "<?php echo site_url('Reports/actDetails/')?>/" + projectSelected +'/'+$('#single_cal5').val(),
        type: "GET",
        dataType: "JSON",
        success: function(data) {
           if (data.length >0){
            for(i=0; i<data.length;i++){
                    $('#tbl2 ul').append('<li> '+data[i]['projtsk_name']+' updated to '+data[i]['updated_percent']+'%.</li><div id ="nested'+data[i]['updated_task_id']+'">');
                    getComment(data[i]['updated_task_id'].substring(0,(data[i]['updated_task_id'].length - ($('#single_cal5').val().length-2))), "nested"+data[i]['updated_task_id']);
                };
                $('#tbl2 ul').append('</ul><ol></div>');
            }
            else{
                $('#tbl2 ul').append('</ul><ol></div>');
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
        url : "<?php echo site_url('Reports/actComm/')?>/" + id +'/'+$('#single_cal5').val(),
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if (data.length >0){
            $('#'+dd).append('<ol>Issue <ul>');
            for(i=0; i<data.length;i++){
                    $('#'+dd+' ul').append('<li>  '+data[i]['prjtsk_comment']+'. - <b>'+data[i]['prjtsk_status']+'</b></li>');
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
        url : "<?php echo site_url('Reports/actComm2/')?>/" + projectSelected +'/'+$('#single_cal5').val(),
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if (data.length >0){
                for(i=0; i<data.length;i++){
                    if ((data[i]['prjtsk_status'] == "Unresolved") || (data[i]['prjtsk_status'] == "Progress") || (data[i]['prjtsk_status'] == "Critical") || (data[i]['prjtsk_status'] == "Open")) {
                        $('#ptsk ul').append('<li> '+data[i]['projtsk_name']+' ('+ data[i]['projdtsk_percent']+'%) - '+data[i]['prjtsk_comment']+'. - <b>'+data[i]['prjtsk_status']+' ('+ data[i]['prjtsk_comment_date']+')</b></li>');
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
        $('#tbl24 tbody').empty();
        $('#tbl24 tbody').append('<ol> <u>Next Planned Activities</u>'+'   '+'<ul>');
        
        $.ajax({
        url : "<?php echo site_url('Reports/NXTDetails/')?>" + projectSelected +'/'+$('#single_cal5').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                 if (data.length >0){
                    for(i=0; i<data.length;i++){
                        if (data[i]['status']==null){
                            $('#tbl24 ul').append('<li><b>'+data[i]['projtsk_name']+'</b> - '+data[i]['nextAct'] +'</li>');
                        }
                    };
                    $('#tbl24 ul').append('</ul><ol>');
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

    function EUDetails1(){
        $('#tbl3 tbody').empty();
        $('#tbl3 tbody').append('<ol>  Equipment Used  <ul>');
                   
        $.ajax({
        url : "<?php echo site_url('Reports/EUDetails1/')?>/" + projectSelected +'/'+$('#single_cal5').val(),
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
        url : "<?php echo site_url('Reports/EUDetails/')?>/" + projectSelected +'/'+$('#single_cal5').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                if (data.length >0){
                    for(i=0; i<data.length;i++){
                        $('#tbl3 ul').append('<li >'+data[i]['eu_quantity'] +' '+data[i]['equipment_name']+' is used.');//' transfered from '+data[i]['project_title']+'.</li>');          
                    };
                   
                    $('#tbl3 ul').append('</ul><ol>');
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });  
    }

    function MUDetails(){
        $('#tbl4 tbody').empty();
        $('#tbl4 tbody').append('<ol> Material Used    <ul>');
                   
        $.ajax({
        url : "<?php echo site_url('Reports/MUDetails/')?>/" + projectSelected +'/'+$('#single_cal5').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                if (data.length >0){
                    for(i=0; i<data.length;i++){
                        $('#tbl4 ul').append('<li >'+data[i]['mu_quantity'] +' '+ data[i]['unit_acro']+' of '+data[i]['material_name']+' is used from Warehouse.</li>');
                    };
                    
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });  
    }
    
    function MUDetails2(){
        $.ajax({
        url : "<?php echo site_url('Reports/MUDetails2/')?>/" + projectSelected +'/'+$('#single_cal5').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                if (data.length >0){
                    for(i=0; i<data.length;i++){
                        $('#tbl4 ul').append('<li >'+data[i]['mu_quantity'] +' '+ data[i]['unit_acro']+' of '+data[i]['material_name']+' is used.');//' transfered from '+data[i]['project_title']+'.</li>');
                    };
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
        url : "<?php echo site_url('Reports/WandTDetails/')?>/" + projectSelected +'/'+$('#single_cal5').val(),
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
        $('#tbl5 tbody').empty();
        $('#tbl5 tbody').append('<ol> Worker(s) Assigned <ul>');
        
        $.ajax({
        url : "<?php echo site_url('Reports/WRKDetails/')?>/" + projectSelected +'/'+$('#single_cal5').val(),
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
 
    function Viewphotos(){
 
        $('#asd').empty(); 
        //$('#tbl6 tbody').append('<ol> Photo Logs &nbsp;&nbsp;&nbsp;<a>Add photo</a></ol> <div = "row row-centered" style="display:inline-block">');
                 
        $.ajax({
        url : "<?php echo site_url('Reports/PhotoDetails/')?>/" + projectSelected +'/'+$('#single_cal5').val(),
        type: "GET",
        dataType: "JSON",
            success: function(data) {
                //alert(data.length);
                if (data.length >0){
                    
                    for(i=0; i<data.length;i++){
                        if (data[i]['photo_comment']!=null){
                            $('#asd').append('<div class = "col-lg-6 col-centered" ><img src="'+data[i]['photo']+'" style="width:290px; height:280px;"><br>&nbsp;&nbsp;<b>'+data[i]['photo_comment']+'</b>&nbsp;&nbsp; </div>');
                        }
                        else{
                            $('#asd').append('<div class = "col-lg-6 col-centered" ><img src="'+data[i]['photo']+'" style="width:290px; height:280px;"><br>&nbsp;&nbsp;<b></b>&nbsp;&nbsp;</div>');
                        }
                    };
                }
                else{
                    $('#asd').append('<div class class = "col-lg-6 col-centered">No Photo uploaded yet!!!</div>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
               
            }
        });  
    }
 

    function printDiv() {
        var divToPrint = document.getElementById('DivIdToPrint');
        var htmlToPrint = '' +
        '<style type="text/css">' +
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
        'height: 30px;' +
        '}' +

        '#td1{' +
            'font-size: 15px;' +
            'font-weight: bolder;' +
            'border-top: 2px solid black;' +
            'border-left: 2px solid black;' + 
            'border-bottom: 2px solid black;' +
            'border-right: 2px solid black;' +
        '}' +
        '#td2{' +
            ' font-size: 10px;' +
            'font-weight: bolder;' +
            'border-right: 2px solid black;' +
        '}' +
        'ol{' +
            'font-size: 13px;' +
             
            'font-weight: bolder;' +
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

 
 

</script>