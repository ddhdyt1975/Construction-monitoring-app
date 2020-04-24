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
 

<style type="text/css">
    

    div.dt-buttons{
        position:relative;
        float:left;
    }
    .report-table thead tr,td {
        border: 1px solid #000;
    }
    .report-table tfoot td,tr {        
        border-left: none;
        border-right: none;
        border-top: none;        
        border-bottom: 1px solid #000;        
    }

    .report-footer td,tr {        
        border-left: none;
        border-right: none;
        border-top: none;        
        border-bottom: none;        
    }

    .smu{
        font-size: 9px;
        align-content: center;
    }
</style>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Report - Admin
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="HumanR"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="HumanRepA"><i class="fa fa-print"></i> Report - Admin</a></li>
        </ol>
    </section>
    
    <section class="content">
       
 

        <!-- Report 2 -->

        <div class="row" id="reportadmin">
            <div class="col-lg-12" align="right"> 
                <button class="btn btn-warning btn-sm " onclick="editD()"><i class="fa fa-pencil"></i> Date</button>
                <button class="btn btn-warning btn-sm" onclick="addentry()"><i class="fa fa-plus"></i> Add Entry</button>
                <button class="btn btn-danger btn-sm" onclick="printDiv()"><i class="fa fa-print"></i> Print</button>
                <br>
                <br>
            </div>
            <div class="col-lg-12">
                <div class="box" id="printme2">
                    <div class="box-body">
                        <div class="report-header">
                            <div class="col-md-12" style="font-size: 12px;">            
                                AVSENECA CONSTRUCTION CORP.<br>           
                                CIC COMPLEX FELIX AVE. CAINTA RIZAL<br><br>
                                SUMMARY OF ACTUAL PAYROLL PER PROJECTS <br>
                                <text id="period"  style="font-size: 12px;">Date:</text>
                            </div>     
                        </div>
                        <br>

                        <div class="report-table">
                            <div class="col-md-12">
                                <table id = "reptbl" class="table table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <!-- <td>No.</td> -->
                                            <td>PROJECT NAME</td>
                                            <td>REGULAR PAY</td>
                                            <td>OVERTIME</td>
                                            <td>GROSS PAY</td>
                                            <td>DEDUCTION</td>
                                            <td bgcolor="#d3d3d3">NET PAY</td>
                                            <td>LAST PAYROLL</td>
                                            <td>DIFFERENCE</td>
                                            <td>EVALUATION</td>
                                        </tr> 
                                    </thead>              
                                    <tbody>                        
                                    <!-- <tr>
                                        <td>1</td>
                                        <td>ANVAYA BATAAN</td>
                                        <td>30,680</td>
                                        <td>8,578.13</td>
                                        <td>39,258.13</td>
                                        <td></td>
                                        <td bgcolor="#d3d3d3">39,258.13</td>
                                        <td>59,414.89</td>
                                        <td>(20,156.77)</td>
                                    </tr> -->
                                    </tbody>                                                  
                                    <tfoot>
                                        <tr>
                                            <td colspan="9"> </td>
                                        </tr>
                                        <tr > 
                                            <td bgcolor="#d3d3d3" >TOTAL ALL PAYROLL</td>
                                            <td align="center" bgcolor="#d3d3d3" id="totpayf"></td>
                                            <td align="center" bgcolor="#d3d3d3" id="totoverf"></td>
                                            <td align="center" bgcolor="#d3d3d3" id="totgrossf"></td>
                                            <td align="center" bgcolor="#d3d3d3" id="totdedf"></td>
                                            <td align="center" bgcolor="#d3d3d3" id="totnetf"></td>
                                            <td align="center" bgcolor="#d3d3d3" id="totlastf"></td>
                                            <td align="center" bgcolor="#d3d3d3" id="totdifff"></td>
                                            <td align="center" bgcolor="#d3d3d3" id="totevaf"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="9"> </td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL CASH REQUESTED NET</td>
                                            <td colspan="3" bgcolor="#d3d3d3" style="text-align: center;" id="totcashf"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <br>
                        <table class="table report-footer" width="100%" cellspacing="0" >
                            <tbody>
                                <tr>
                                    <td><p> </p> </td>
                                    <td><p> </p> </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td>Prepared By</td>
                                    <td>Checked By:</td>
                                </tr>
                                <tr align="center">
                                    <td><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J.P. REYES / MJ NYERA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br><text class="smu">Signature over Printed Name</text></td>
                                    <td><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. ESCARCHA / Y. M. RODIL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br><text class="smu">Signature over Printed Name</text></td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <!-- <td>Noted By:</td> -->
                                    <td>Approved By:</td>
                                </tr>
                                <tr align="center">
                                    <!-- <td><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R. LEUS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br><text class="smu">Signature over Printed Name</text></td>
                                     --><td><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. V. SENECA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br><text class="smu">Signature over Printed Name</text></td>
                                </tr>
                            
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>

        <!-- end of report 2 -->

        <div class="modal fade" id="editdate" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header  btn-primary">
                       <h3 class="modal-title">Edit Report Date</h3>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form_editdate" class="form-group">
                            <div class="form-group">
                                <label for="repdate">Report Date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control pull-right" id="reservation2" name="reservation2">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id ="btnwrk" class="btn btn-danger btn-sm" onclick ="saveDate();">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addentrym" role="dialog">
            <div class="modal-dialog ">
                <div class="modal-content">
                  <div class="modal-header  btn-primary">
                       <h3 class="modal-title">Edit Report Date</h3>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form_adde" class="form-group">
                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-12">
                                        <label >Select Project</label>
                                        <div class = "form-group input-group">
                                            <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                                            <select id = "proj"  class="form-control">
                                                <option></option>
                                                <?php foreach($projects as $each){ ?>
                                                    <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Regular Pay:</label>
                                        <input type="number" class="form-control" id="reppay" name="reppay" placeholder = "Enter Regular Pay"/>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Overtime:</label>
                                        <input type="number" class="form-control" id="repover" name="repover" placeholder = "Enter Overtime Pay"/>
                                        <span class="help-block"></span>
                                    </div>

                                    <div class="col-lg-12">
                                        <label >Deduction:</label>
                                        <input type="number" class="form-control" id="repded" name="repded" placeholder = "Enter Deductions"/>
                                        <span class="help-block"></span>
                                    </div>
                                
                                    <div class="col-lg-12">
                                        <label >Last Payroll:</label>
                                        <input type="number" class="form-control" id="replast" name="replast" placeholder = "Enter Last Payroll"/>
                                        <span class="help-block"></span>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id ="btnwrk" class="btn btn-danger btn-sm" onclick ="saveEntry();">OK</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


<script type="text/javascript">
    var count =0;
    function editD(){
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#editdate').modal('show');  
    } 

    function saveDate() {
        $('#editdate').modal('hide');
        var date1 = $('#reservation2').val();
        $('#period').text('Date Period: '+date1);
    }

    function addentry(){
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();
        $('#addentrym').modal('show');  
        $('#form_adde')[0].reset();
    } 

    function saveEntry() {
        $('#addentrym').modal('hide');
        var e1 = $("#proj option:selected").text();
        var e2 = parseFloat($('#reppay').val());
        var e3 = parseFloat($('#repover').val());
        var e4 = parseFloat($('#repded').val());
        var e5 = parseFloat($('#replast').val());
        var e6 ="";
        var e7 = ( parseFloat(e2+e3) - parseFloat(e4) ).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        alert(e5.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        if(e7>e5.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")){
            e6='DECREASE';
        } 
        else{
            e6="INCREASE";
        }

        count++;
        $('#reptbl tbody').append('<tr align="center">'+
            // '<td align="left" >'+count+'</td>'+
            '<td>'+e1+'</td>'+
            '<td class="totpay">'+e2.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>'+
            '<td class="totover">'+e3.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>'+
            '<td class="totgross">'+parseFloat(e2+e3).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>'+
            '<td class="totded">'+e4.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>'+
            '<td class="totnet" bgcolor="#d3d3d3">'+e7+'</td>'+
            '<td class="totlast">'+e5.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>'+
            '<td class="totdiff">'+Math.abs((parseFloat(e5) -( (parseFloat(e2+e3) - parseFloat(e4))) )).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>'+
            '<td>'+e6+'</td>'+
            // '<td><button class="btn btn-info btn-xs noprint"><i class="fa fa-pencil"></i></button><button class="btn btn-danger btn-xs noprint"> <i class="fa fa-trash "></i></button></td>'+
        '</tr>');

        compute();
    }

    function compute(){
        var d1=0;
        $('.totpay').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d1 += parseFloatIgnoreCommas(value);
           }
        });
        $('#totpayf').empty();
        $('#totpayf').append(convertCommas(d1));

        var d2=0;
        $('.totover').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d2 += parseFloatIgnoreCommas(value);
           }
        });
        $('#totoverf').empty();
        $('#totoverf').append(convertCommas(d2));

        var d3=0;
        $('.totgross').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d3 += parseFloatIgnoreCommas(value);
           }
        });
        $('#totgrossf').empty();
        $('#totgrossf').append(convertCommas(d3));

        var d4=0;
        $('.totded').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d4 += parseFloatIgnoreCommas(value);
           }
        });
        $('#totdedf').empty();
        $('#totdedf').append(convertCommas(d4));

        var d5=0;
        $('.totnet').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d5 += parseFloatIgnoreCommas(value);
           }
        });
        $('#totnetf').empty();
        $('#totnetf').append(convertCommas(d5));

        var d6=0;
        $('.totlast').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d6 += parseFloatIgnoreCommas(value);
           }
        });
        $('#totlastf').empty();
        $('#totlastf').append(convertCommas(d6));

        var d7=0;
        $('.totdiff').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d7 += parseFloatIgnoreCommas(value);
           }
        });
        $('#totdifff').empty();
        $('#totdifff').append(convertCommas(d7));


        if(parseFloat($('#totnetf').text()) > parseFloat($('#totlastf').text())){
            $('#totevaf').empty();
            $('#totevaf').append('INCREASE');
        }
        else{
            $('#totevaf').empty();
            $('#totevaf').append('DECREASE');
        }

        $('#totcashf').empty();
        $('#totcashf').append(convertCommas(d5));

    }

    function parseFloatIgnoreCommas(number){
        var num = number.replace(/,/g, '');
        return parseFloat(num);
    }

    function convertCommas(number){
        return number.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }

    function printDiv() {
        var divToPrint = document.getElementById('printme2');
        var htmlToPrint = '<style type="text/css">@page{size:landscape; width:100%;}p{font-size:12px;}body { font-size: 10px ;}div.dt-buttons{position:relative;float:left;}.report-table thead tr,td { font-size:12px;border: 1px solid #000;}.report-table tfoot td,tr {font-size:12px; border-left: none;border-right: none;border-top: none;border-bottom: 1px solid #000;}.smu{font-size: 9px;}   .report-footer  td,tr {border-left: none;border-right: none;border-top: none;border-bottom: none;}</style>';
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }
</script>