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
    table{font-size: 11px;}
    .noprint{
        display: none;
    }


</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Report 
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="HumanR"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="HumanRep"><i class="fa fa-print"></i> Report</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class = "row">
            <div class="col-lg-4">
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
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="repdate">Report Type</label>
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-tasks"></i></div>
                        <select class="form-control" id="reptype" name="reptype">
                            <option></option>
                            <option value="report1">Summary Report</option>
                            <option value="report3">Payroll Release Form</option>
                            <option value="report4">Attendance Sheet</option>
                            <option value="report5">Loan Summary Report</option>
                            <option value="report6">Bonus Report</option>
                            <option value="report7">Bonus Report (Monthly)</option>
                        </select> 
                    </div>
                </div>
            </div>
            <div class="col-lg-3" id="allselect">
                <div class="form-group">
                    <label for="repdate">Report Date</label>
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control pull-right" id="reservation2" name="reservation2">
                    </div>
                </div>
            </div>
             
            <div class="col-lg-1">
                <label>Click</label>
                <button class="btn btn-success"  onclick="getRec()"><i class="fa fa-print"></i> View</button>
            </div>
           
        </div>

        <!-- Report 1 -->
        <div class="row " id="payrolldiv">
            <div class="col-lg-12"> 

                <div class="box" id="printme">
                    <div class="print-header box-header with-border">
                      <!--  <table  class="table">
                            <tbody>
                                <tr>
                                    <td id="prj" style="font-size: 14px; font-weight: bold;"> Project</td>
                                    <td></td>    
                                </tr>
                               <tr  style="font-size: 14px; font-weight: bold;">
                                   <td>
                                       FIRM NAME: AVS CONSTRUCTION CORPORATION
                                   </td>
                                   <td>
                                       WORK PERIOD FROM: <text id="dater"></text>
                                   </td>
                               </tr>
                           </tbody>
                       </table> -->
                        

                        <div class="row">                
                            <div class="col-lg-12" style="font-weight: bold;" id="prj">
                                PROJECT: 
                            </div>                
                        </div>
                        <br>
                        <div class="row"  style="font-weight: bold;">
                       
                            <div class="col-lg-12" style="font-weight: bold;">
                                FIRM NAME: AVS CONSTRUCTION CORPORATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WORK PERIOD FROM:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <text id="dater"></text>
                            </div>
                       
                        </div>
                    </div>
                    <br>

                    <div class="print-table box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="table-report" class="table table-hover" cellspacing="0" cellpadding="5px"  style="border: 2px solid #000" width="100%">
                                    <tr align="center">
                                        <td  style="border: 2px solid #000" rowspan="4"  align="center">No.</td>
                                        <td  style="border: 2px solid #000" rowspan="4"  align="center">Name of Employee</td>
                                        <td style="border: 2px solid #000" rowspan="4">Designation</td>
                                        <td style="border: 2px solid #000" rowspan="4">Regular Rate</td>
                                        
                                        <td style="border: 2px solid #000" colspan="6" align="center"><strong>EARNINGS</strong></td>
                                        <td style="border: 2px solid #000" colspan="6"  align="center"><strong>DEDUCTIONS</strong></td>
                                        <td style="border: 2px solid #000"  rowspan="4">Net Amount Paid</td>
                                    </tr>
                                    <tr align="center">
                                        <td style="border: 2px solid #000" colspan="2">REGULAR</td>                                                        
                                        <td style="border: 2px solid #000" colspan="2">OVERTIME</td>
                                        <td style="border: 2px solid #000">ADJUSTMENT</td>
                                        <td style="border: 2px solid #000" rowspan="3">TOTAL EARNINGS</td>
                                        <td  style="border: 2px solid #000"rowspan="3">OTHER DEDUCTION</td>
                                        <td style="border: 2px solid #000" rowspan="3">UNIFORM</td>
                                        <td style="border: 2px solid #000" rowspan="3">SAFETY GEAR</td>
                                        <td style="border: 2px solid #000" rowspan="3">HELMET</td>
                                        <td style="border: 2px solid #000" rowspan="3">AVEELA/VALE</td>
                                        <td style="border: 2px solid #000" rowspan="3">TOTAL Deductions</td>                            
                                    </tr>
                                    <tr align="center">
                                        <td style="border: 2px solid #000" rowspan="2">Days</td>
                                        <td style="border: 2px solid #000"  rowspan="2">Amount</td>
                                        <td style="border: 2px solid #000"  align="center"  colspan="2">Regular</td>
                                        <td style="border: 2px solid #000"  rowspan="2"  align="center">Allowance/s</td>
                                    </tr>
                                    <tr align="center">
                                        <td  style="border: 2px solid #000">Hours</td>
                                        <td style="border: 2px solid #000">Amount</td>
                                    </tr>

                                    <tbody id ="datat">
                                    </tbody>              

                                    <tr style="font-weight: bolder" align="right">
                                        <td style="border: 2px solid #000" colspan="4" align="center"><strong>TOTAL</strong></td>
                                        <td style="border: 2px solid #000" id="daysi" name="daysi"></td>
                                        <td style="border: 2px solid #000" id="amo"></td>
                                        <td style="border: 2px solid #000" id="hri"></td>
                                        <td style="border: 2px solid #000" id="amo2"></td>
                                        <td style="border: 2px solid #000" id="alli"></td>
                                        <td style="border: 2px solid #000" id="toteri"></td>
                                        <td style="border: 2px solid #000" id="otded"></td>
                                        <td style="border: 2px solid #000" id="unii"></td>
                                        <td style="border: 2px solid #000" id="sgi"></td>
                                        <td style="border: 2px solid #000" id="hemi"></td>
                                        <td style="border: 2px solid #000" id="evei"></td>
                                        <td style="border: 2px solid #000" id="totded"></td>
                                        <td style="border: 2px solid #000" id="netam"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="border-left: 2px solid #000 ">Approve for payment:</td>
                                        <td colspan="14"  style="border-right:  2px solid #000">I hereby that I have paid in cash to all above mentioned employees their corresponding payrolls for the period as stated.</td>
                                    </tr>  
                                    <tr>
                                        <td  colspan="12" align="center"  style="border-left: 2px solid #000;"></td>
                                        <td  colspan="5" rowspan="2"  style="border-right: 2px solid #000;border-bottom: 2px solid #000" > We hereby acknowledge to have received the sum specefied apposite our respective names, as full payment for our service.</td>
                                    </tr>

                                    <tr style="font-weight: bolder;" align="center">
                                        <td  colspan="2" style="border-left: 2px solid #000;border-bottom: 2px solid #000"><u>MJ NEYRA</u><br>Prepared By:</td>
                                        <td  colspan="4" style="border-bottom: 2px solid #000"><u>J.P REYES/A MALINAO</u><br>Checked By:</td>
                                        <td  colspan="3" style="border-bottom: 2px solid #000"><u>Y. RODIL</u><br>Verified By:</td>
                                        <td  colspan="3" style="border-bottom: 2px solid #000"><u>A.V. SENECA</u><br>Approved</td>
                                    </tr>   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a id="dlink"  style="display:none;"></a> 
                    <button class="btn btn-small btn-danger" onclick="printDiv('printme')"><i class="fa fa-print"></i> Pdf!</button>
                    <button class="btn btn-small btn-success" onclick="tableToExcel('printme', 'name', 'Summary Report.xls')"><i class="fa fa-print"></i> Excel!</button>
                </div>
            </div>
        </div>
        <!-- end of report 1 -->
        <!-- Report 3 -->
        <div class="row " id="payrolldiv2">
            <div class="col-lg-12"> 

                <div class="box" id="printme2" >
                    <br>
                    <div class="print-table box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="table-report" class="table table-hover" cellspacing="0" cellpadding="5px"  width="100%">
                                    <tr>
                                        <td colspan="19"><img  style="width:100%;height: 90%" src="<?= base_url() ?>assets/report.png"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="19" style="border: 1px solid #000; font-size: 15px;" align="center">PAYROLL RELEASE FORM</td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td nowrap colspan="4" style="border-left: 1px solid #000;  font-size: 12px;" align="left">PROJECT: </td>
                                        <td colspan="9" style="border-bottom:1px solid #000;font-size: 13px; " align="left" id="prj2"></td>
                                        <td colspan="6" align="center" style="border-right: 1px solid #000; font-size:13px;">APPENDIX C</td>
                                    </tr>
                                    <tr>
                                        <td nowrap colspan="4" style="border-left: 1px solid #000; font-size: 12px;" align="left">PERIOD COVERED: </td>
                                        <td colspan="9" style="border-bottom:1px solid #000;font-size: 13px; " align="left" id="dater2"></td>
                                        <td colspan="6" align="center" style="border-right: 1px solid #000; "></td>
                                    </tr>   

                                     <tr>
                                        <td colspan="15" style="border-bottom: 1px solid #000;border-left: 1px solid #000" ></td>
                                        <td colspan="4" style="border-bottom: 1px solid #000;border-right: 1px solid #000" ></td>
                                        
                                    </tr>                         
                                    <tr align="center">
                                        <td style="border: 1px solid #000" width="5" >NO.</td>
                                        <td style="border: 1px solid #000"   class="noprint"  align="center">Emp ID</td>
                                        <td style="border: 1px solid #000" colspan="3"  align="center">EMPLOYEE NAME</td>
                                        <td style="border: 1px solid #000"   class="noprint">Designation</td>
                                        <td style="border: 1px solid #000" colspan="2">NO. of Days</td>
                                        <td style="border: 1px solid #000" colspan="2">OT HOURS</td>
                                        <td style="border: 1px solid #000" colspan="3">  PAYROLL AMOUNT</td>
                                        <td style="border: 1px solid #000" colspan="3"  >AMOUNT RECEIVED</td>
                                        <td style="border: 1px solid #000"  colspan="2" >DATE RECEIVED</td>
                                        <td style="border: 1px solid #000" colspan="3"  >SIGNATURE</td>
                                        
                                        <td style="border: 1px solid #000" class="noprint" rowspan="4" class="noprint">Regular Rate</td>
                                        <td style="border: 1px solid #000" colspan="6" align="center" class="noprint"><strong>EARNINGS</strong></td>
                                        <td style="border: 1px solid #000" colspan="6"  align="center" class="noprint"><strong>DEDUCTIONS</strong></td>
                                        
                                    </tr>
                                    <tr align="center" class="noprint">
                                        <td style="border: 1px solid #000" colspan="2" >REGULAR</td>                                                        
                                        <td style="border: 1px solid #000" colspan="2">OVERTIME</td>
                                        <td style="border: 1px solid #000">ADJUSTMENT</td>
                                        <td style="border: 1px solid #000" rowspan="3">TOTAL EARNINGS</td>
                                        <td  style="border: 1px solid #000"rowspan="3">OTHER DEDUCTION</td>
                                        <td style="border: 1px solid #000" rowspan="3">UNIFORM</td>
                                        <td style="border: 1px solid #000" rowspan="3">SAFETY GEAR</td>
                                        <td style="border: 1px solid #000" rowspan="3">HELMET</td>
                                        <td style="border: 1px solid #000" rowspan="3">AVEELA/VALE</td>
                                        <td style="border: 1px solid #000" rowspan="3">TOTAL Deductions</td>                            
                                    </tr>
                                    <tr align="center">
                                        <td style="border: 1px solid #000"  align="center"  colspan="2" class="noprint">Regular</td>
                                        <td style="border: 1px solid #000"  rowspan="2" class="noprint">Amount</td>
                                        <td style="border: 1px solid #000"  rowspan="2"  align="center" class="noprint">Allowance/s</td>
                                    </tr>
                                    <tr align="center">
                                        <td style="border: 1px solid #000" class="noprint">Amount</td>
                                    </tr>

                                    <tbody id ="datat2">
                                    </tbody>              
                                    <tfoot>
                                        <tr class="noprint" style="font-weight: bolder" align="right">
                                            <td style="border: 1px solid #000" colspan="4" align="center"><strong>TOTAL</strong></td>
                                            <td style="border: 1px solid #000" id="nnetam"></td>
                                            <td style="border: 1px solid #000"></td>
                                            <td style="border: 1px solid #000" id="ndaysi" name="daysi"></td>
                                            <td style="border: 1px solid #000" id="namo"></td>
                                            <td style="border: 1px solid #000" id="nhri"></td>
                                            <td style="border: 1px solid #000" id="namo2"></td>
                                            <td style="border: 1px solid #000" id="nalli"></td>
                                            <td style="border: 1px solid #000" id="ntoteri"></td>
                                            <td style="border: 1px solid #000" id="notded"></td>
                                            <td style="border: 1px solid #000" id="nunii"></td>
                                            <td style="border: 1px solid #000" id="nsgi"></td>
                                            <td style="border: 1px solid #000" id="nhemi"></td>
                                            <td style="border: 1px solid #000" id="nevei"></td>
                                            <td style="border: 1px solid #000" id="ntotded"></td>
                                            <td style="border: 1px solid #000"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="19"> </td>
                                        </tr>
                                        <tr >
                                            <td align="center" colspan="4" style="font-size: 15px;" >TOTAL: </td>
                                            <td align="right" colspan="9"  style="border-top:1px solid #000; font-size: 13px;"  id="toti">asdas</td>
                                            <td ></td>
                                            <td colspan="5"></td>
                                            
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="4"> </td>
                                            <td colspan="9"  style="border-top:1px solid #000;"> </td>
                                            <td ></td>
                                            <td colspan="5"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="19"> &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="19"> &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="19">&nbsp; </td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="10">PREPARED BY:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
                                            <td align="right" colspan="10">RELEASED BY:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
                                        </tr>

                                    </tfoot>    
                                </table>
                             
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-small btn-danger" onclick="printDiv('printme2')"><i class="fa fa-print"></i> Print!</button>
                    <button class="btn btn-small btn-success" id = "pint2"><i class="fa fa-print"></i> Excel!</button>
                </div>
            </div>
        </div>
        <!-- end of report 3  -->
        <div class="row hidden">
            <div class="col-lg-8" >
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Payroll Details</h4>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover"  id="table-manual">
                            <thead>
                                <tr>
                                    <th width="18%">Project</th>
                                    <th width="18%">Date</th>
                                    <th>Time in</th>
                                    <th>Time out</th>
                                    <th>Work Hours</th>
                                    <th>Late</th>
                                    <th>Undertime</th>
                                    <th>Overtime</th>
                                    <th class="hidden">Pay</th>
                                </tr>
                            </thead>
                            <tbody>           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                
        <!-- Loan Summary-->
        <div class="row " id="loandiv">
            <div class="col-lg-12"> 
                <div class="box" id="printmeloan" >
                    <br>
                    <div class="print-table-loan box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="table-report-loan" class="table table-hover" cellspacing="0" cellpadding="5px"  width="100%">
                                    <tr>
                                        <td colspan="19" style="border: 2px solid #000; font-size: 18px;" align="center">LOAN SUMMARY REPORT</td>
                                    </tr>
                                    
                                        <td nowrap colspan="2" style="border-left: 1px solid #000; font-size: 12px;" align="left">AS OF : </td>
                                        <td colspan="17" style="border-right: 1px solid #000; font-size: 12px; text-decoration: underline; " align="left" id="dater2l"></td>
                                    </tr>                            
                                    <tr align="center">
                                        <td align="left" style="border: 2px solid #000">NO.</td>
                                        <td style="border: 2px solid #000">Emp ID</td>
                                        <td style="border: 2px solid #000">EMPLOYEE NAME</td>
                                        <td style="border: 2px solid #000">Designation</td>
                                        <td style="border: 2px solid #000">HELMET</td> 
                                        <td style="border: 2px solid #000">UNIFORM</td> 
                                        <td style="border: 2px solid #000">SAFETY SHOES</td> 
                                        <td style="border: 2px solid #000">SHOES</td>  
                                        <td style="border: 2px solid #000">AVEELA/VALE</td>
                                    <tbody id ="dataloan">
                                    </tbody>              
                                    <tfoot align="center" style="font-weight: bolder;">
                                        <td align="left" colspan="4" style="border: 2px solid #000"><b>Total</b></td>
                                        <td style="border: 2px solid #000" id="helm"></td> 
                                        <td style="border: 2px solid #000" id="uni"></td> 
                                        <td style="border: 2px solid #000" id="sg"></td> 
                                        <td style="border: 2px solid #000" id="sh"></td>  
                                        <td style="border: 2px solid #000" id="ave"></td>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-small btn-danger" onclick="printDiv('printmeloan')"><i class="fa fa-print"></i> Print!</button>
                </div>
            </div>
        </div>
        <!-- end of loan summary-->
        <!-- Bonus -->
        <div class="row " id="bonusdiv">
            <div class="col-lg-12"> 
                <div class="box" id="printmebonus" >
                    <br>
                    <div class="print-table-bonus box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="table-report-bonus" class="table table-hover" cellspacing="0" cellpadding="5px"  width="100%">
                                    <tr>
                                        <td  colspan= "6" style="  font-size: 14px;" align="center">Avseneca Construction Corporation<br>13th Month Report<br>AS of <text id="daterbon"></text></td>
                                    </tr>
                                    <tr align="center" style="border: 2px solid #000">
                                        <td style="border: 2px solid #000">NO.</td>
                                        <td style="border: 2px solid #000">Name</td>
                                        <td style="border: 2px solid #000">Position</td>
                                        <td style="border: 2px solid #000">Rate</td>
                                        <td style="border: 2px solid #000">Net Pay</td>
                                        <td style="border: 2px solid #000">13th Month</td>
                                    </tr>
                                    <tbody id ="databonus">
                                    </tbody>              
                                    <tfoot align="right" style="font-weight: bolder;">
                                        <td align="center"  style="border-left: 2px solid #000;border-bottom: 2px solid #000;border-top: 2px solid #000"></td>
                                        <td align="left" colspan="3" style="border-right: 2px solid #000;border-bottom: 2px solid #000;border-top: 2px solid #000"><b>Total</b></td>
                                        <td style="border: 2px solid #000" id="totnetbon"></td> 
                                        <td style="border: 2px solid #000" id="totnetbon2"></td> 
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-small btn-danger" onclick="printDiv('printmebonus')"><i class="fa fa-print"></i> Print!</button>
                </div>
            </div>
        </div>
        <!-- end of bonus -->

        <!-- Bonus2 -->
        <div class="row " id="bonusdiv2">
            <div class="col-lg-12"> 
                <div class="box" id="printmebonus2" >
                    <br>
                    <div class="print-table-bonus box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="table-report-bonus" class="table table-hover" cellspacing="0" cellpadding="5px"  width="100%">
                                    <tr>
                                        <td nowrap align="left">PROJECT: </td>
                                        <td  style=" text-decoration: underline;" align="left" id="titb"></td>
                                    </tr>
                                    <tr>
                                        <td nowrap  align="left">FIRM NAME: </td>
                                        <td   style=" text-decoration: underline; " align="left">AVS CONSTRUCTION CORPORATION</td>
                                    </tr>      
                                        <td nowrap   align="left">AS OF : </td>
                                        <td  style=" text-decoration: underline; " align="left" id="dater2b"></td>
                                    </tr>     
                                    <tr align="center" style="border: 2px solid #000">
                                        <td style="border: 2px solid #000" >NO.</td>
                                        <td style="border: 2px solid #000">Name</td>
                                        <td style="border-top: 2px solid #000">Net Pay</td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000"></td>
                                        <td style="border-top: 2px solid #000;border-left: 2px solid #000" >13th Month</td>
                                         <td style="border: 2px solid #000" >Signature</td>
                                    </tr>
                                    <tr align="center" style="border: 2px solid #000"> 
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000">Jan</td>
                                        <td style="border: 2px solid #000">Feb</td>
                                        <td style="border: 2px solid #000">Mar</td>
                                        <td style="border: 2px solid #000">Apr</td>
                                        <td style="border: 2px solid #000">May</td>
                                        <td style="border: 2px solid #000">Jun</td>
                                        <td style="border: 2px solid #000">Jul</td>
                                        <td style="border: 2px solid #000">Aug</td>
                                        <td style="border: 2px solid #000">Sep</td>
                                        <td style="border: 2px solid #000">Oct</td>
                                        <td style="border: 2px solid #000">Nov</td>
                                        <td style="border: 2px solid #000">Dec</td> 
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                    </tr>
                                    <tbody id ="databonus2">
                                    </tbody>              
                                    <tfoot align="right" style="font-weight: bolder;">
                                        <tr>
                                        <td align="left" colspan="2" style="border: 2px solid #000"><b>Total</b></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td>
                                        <td style="border: 2px solid #000"></td> 
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
 
                                            <td align="left" colspan="8">PREPARED BY:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
                                            <td align="right" colspan="8">RELEASED BY:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
                                         
                                        </tr>
                                    </tfoot>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-small btn-danger" onclick="printDiv('printmebonus2')"><i class="fa fa-print"></i> Print!</button>
                    <button class="btn btn-small btn-success" id = "pint3"><i class="fa fa-print"></i> Excel!</button>
                </div>
            </div>
        </div>
        <!-- end of bonus2 -->

        <!-- Report 4 -->

            <div class="row">
                <div class="col-lg-12" >
                    <div class="box" id="inditablediv">
                        
                    </div>
                </div>
            </div>

        <!-- end of Report 4 -->

        <!-- Report 2 -->

        
        <!-- end of report 2 -->

    </section>
</div>


<script>
    var weekdays = new Array(7);
    weekdays[0] = 'SUN';
    weekdays[1] = 'MON';
    weekdays[2] = 'TUE';
    weekdays[3] = 'WED';
    weekdays[4] = 'THU';
    weekdays[5] = 'FRI';
    weekdays[6] = 'SAT';

    var projectSelected ='';
    var t, rep;
    $(document).ready(function() {
        $('#payrolldiv').hide();
        $('#payrolldiv2').hide();
        $('#bonusselect').hide(); 
        $('#inditablediv').hide();
        $('#loandiv').hide();
        $('#bonusdiv').hide();
        $('#bonusdiv2').hide();
        $('#hrep').attr("class","active");
        
        $('#proj').change(function() {
            projectSelected = $(this).val();
            t = ($("#proj option:selected").text()).toUpperCase();
        });

        $('#reptype').change(function() {
            var projectSelected = $(this).val();
            rep = $("#reptype option:selected").text();
        });
    
    }); 

    function getRec(){
        proj = $('#proj').val();
        $('#payrolldiv').hide();
        $('#inditablediv').hide();
        $('#payrolldiv2').hide();
        $('#loandiv').hide();
        $('#bonusdiv2').hide();
        $('#prj').empty();
        $('#prj').append("PROJECT: "+t); 
        $('#prj2').empty();
        $('#prj2').append(t); 
        $('#titb').empty();
        $('#titb').append(t); 
        var date1 = $('#reservation2').val();
        $('#dater').empty();
        $('#dater').append(date1);
        $('#dater2').empty();
        $('#dater2').append(date1);
        $('#dater2b').empty();
        $('#dater2b').append(date1);
        $('#datat').empty();
        $('#datat2').empty();
        $('#dater2l').empty();
        $('#dater2l').append(date1);
        $('#daterbon').empty();
        $('#daterbon').append(date1);
        $('#bonusdiv').hide();
        $('#totnetbon').empty();
        $('#totnetbon2').empty();

        if(rep=='Summary Report'){
            $('#payrolldiv').show();
            $.ajax({
                url: "<?php echo site_url('HumanRep/getemp/')?>" + proj+'/'+date1,
                dataType: "JSON",
                success: function(data) {
                    for(i=0;i<data.length;i++){
                        $('#datat').append('<tr align="right"><td style="border: 1px solid #000;border-left: 2px solid #000" align="center">'+(i+1)+'</td>'+
                            '<td nowrap style="border: 1px solid #000" align="left">'+data[i]['pworker_lname']+', '+data[i]['pworker_fname']+'</td>'+         
                            '<td style="border: 1px solid #000">'+data[i]['description']+'</td>'+
                            '<td style="border: 1px solid #000" class="sal" id="sal'+data[i]['pworker_id']+'">'+(data[i]['salary'] * 8).toFixed(1)+"0"+'</td>'+
                            '<td style="border: 1px solid #000" class="days" id="days'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="amount" id="amount'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="odays" id="odays'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="oamount" id="oamount'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="allow" id="allow'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="toter" id="toter'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="odeduc" id="odeduc'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="unif" id="unif'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="safgr" id="safgr'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="helm" id="helm'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="avee" id="avee'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="totdeduc" id="totdeduc'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000;border-right: 2px solid #000" class="net" id="net'+data[i]['pworker_id']+'">-</td>'+
                        '</tr>');
                        getPayroll(data[i]['pworker_id'], date1);
                    };                 
                }
            });
        }

        if(rep=='Payroll Release Form'){
            $('#payrolldiv2').show();
            $.ajax({
                url: "<?php echo site_url('HumanRep/getemp/')?>" + proj+'/'+date1,
                dataType: "JSON",
                success: function(data) {
                    for(i=0;i<data.length;i++){
                        $('#datat2').append('<tr align="right"><td style="border: 1px solid #000" align="left">'+(i+1)+'</td><td class="noprint" style="border: 2px solid #000">'+data[i]['pworker_id']+'</td><td nowrap style="border: 1px solid #000" align="left" colspan="3">'+data[i]['pworker_lname']+', '+data[i]['pworker_fname']+'</td>'+         
                            '<td style="border: 1px solid #000" class="noprint">'+data[i]['description']+'</td>'+
                            '<td style="border: 1px solid #000" class="sal noprint" id="sal'+data[i]['pworker_id']+'">'+(data[i]['salary'] * 8).toFixed(1)+'</td>'+
                            '<td style="border: 1px solid #000" class="days" id="days'+data[i]['pworker_id']+'" colspan="2">-</td>'+
                            '<td style="border: 1px solid #000" class="odays" id="odays'+data[i]['pworker_id']+'" colspan="2">-</td>'+
                            '<td style="border: 1px solid #000" class="net" id="net'+data[i]['pworker_id']+'" colspan="3"></td>-<td style="border: 1px solid #000" colspan="3"></td>'+
                            '<td  style="border: 1px solid #000" colspan="2"></td><td  style="border: 1px solid #000" colspan="3"></td>'+
                            '<td style="border: 1px solid #000" class="amount noprint" id="amount'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="oamount noprint" id="oamount'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="allow noprint" id="allow'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="toter noprint" id="toter'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="odeduc noprint" id="odeduc'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="unif noprint" id="unif'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="safgr noprint" id="safgr'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="helm noprint" id="helm'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="avee noprint" id="avee'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 1px solid #000" class="totdeduc noprint" id="totdeduc'+data[i]['pworker_id']+'">-</td>'+
                        ' </tr>');
                        getPayroll(data[i]['pworker_id'], date1);
                    };                 
                }
            });
        }

        if(rep=='Attendance Sheet'){
            $('#inditablediv').show();  
            $('#inditablediv').empty();
            var t1 = new Date(date1);
            var str = 'inditablediv';
            $('#inditablediv').append('<b>AVSENECA CONSTRUCTION CORP.</b><button class="btn pull-right btn-danger" onclick="printDiv('+"'"+str+"'"+')">Print</button><br> CAINTA RIZAL<br><b>Attendance Sheet</b><br>For the period of '+date1+'<br><br>'); 
            $.ajax({
                url: "<?php echo site_url('HumanRep/getemp/')?>" + proj+'/'+date1,
                dataType: "JSON",
                success: function(data) {
                    for(i=0;i<data.length;i++){
                        $('#inditablediv').append('<table class="table table-bordered" cellspacing="0" cellpadding="5px" id="table'+data[i]['pworker_id']+'">'+
                            '<thead >'+
                                '<tr align="left">'+
                                    '<th colspan="12"><u>ID / NAME:</u>&nbsp;&nbsp;&nbsp;&nbsp;'+data[i]['pworker_id']+' / '+data[i]['pworker_lname']+', '+data[i]['pworker_fname']+'</th>'+
                                '</tr>'+
                                '<tr style="background:gray">'+
                                    '<th style="border: 2px solid #000">Day</th>'+
                                    '<th style="border: 2px solid #000">Date</th>'+
                                    '<th style="border: 2px solid #000">Schedule</th>'+
                                    '<th style="border: 2px solid #000">IN</th>'+
                                    '<th style="border: 2px solid #000">OUT</th>'+
                                    '<th style="border: 2px solid #000">H/Worked</th>'+
                                    '<th style="border: 2px solid #000">Lates</th>'+
                                    '<th style="border: 2px solid #000">U/Time</th>'+
                                    '<th style="border: 2px solid #000">OT</th>'+
                                    '<th style="border: 2px solid #000">Type</th>'+
                                    '<th style="border: 2px solid #000" colspan="2">Project</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody>'+

                            '</tbody>'+
                            '<tfoot>'+
                                '<tr style="font-weight:bold" align="center">'+
                                    '<td style="border: 2px solid #000" nowrap colspan="2" id="ddw'+data[i]['pworker_id']+'">Days Worked:</td>'+
                                    '<td style="border: 2px solid #000" nowrap colspan="2" id="hhw'+data[i]['pworker_id']+'">Hrs Worked:</td>'+
                                    '<td style="border: 2px solid #000" nowrap colspan="2" id="adw'+data[i]['pworker_id']+'">Actual Days Worked:</td>'+
                                    '<td style="border: 2px solid #000" nowrap colspan="2" id="llw'+data[i]['pworker_id']+'">Late</td>'+
                                    '<td style="border: 2px solid #000" nowrap colspan="2" id="uuw'+data[i]['pworker_id']+'">U/Time</td>'+
                                    '<td style="border: 2px solid #000" nowrap colspan="2" id="oow'+data[i]['pworker_id']+'">OT</td>'+
                                '</tr>'+
                            '</tfoot>'+
                        '</table><hr>');
                        getPayroll2(data[i]['pworker_id'], date1);
                    };
                }
            });
        }

        if(rep =='Loan Summary Report'){
            $('#loandiv').show();
            $('#dataloan').empty();
            $.ajax({
                url: "<?php echo site_url('HumanRep/getloan/')?>"+date1,
                dataType: "JSON",
                success: function(data) {
                    for(i=0;i<data.length;i++){

                        var loan = data[i]['original_loan'];
                        $('#dataloan').append('<tr align="center"><td style="border: 2px solid #000"  align="left">'+(i+1)+'</td>'+
                            '<td  style="border: 2px solid #000">'+data[i]['pworker_id']+'</td>'+
                            '<td nowrap  style="border: 2px solid #000" align="left">'+data[i]['pworker_lname']+', '+data[i]['pworker_fname']+'</td>'+
                            '<td style="border: 2px solid #000" >'+data[i]['ED']+'</td>'+
                            (data[i]['Helmet'] != null ? '<td class="helmett" style="border: 2px solid #000" >'+data[i]['Helmet']+'</td>':'<td class="helmett" style="border: 2px solid #000" >-</td>')+
                            (data[i]['Uniform'] != null ? '<td class="unit" style="border: 2px solid #000" >'+data[i]['Uniform']+'</td>':'<td  class="unit" style="border: 2px solid #000" >-</td>')+
                            (data[i]['Safety_Gear'] != null ? '<td class="sgt" style="border: 2px solid #000" >'+data[i]['Safety_Gear']+'</td>':'<td class="sgt" style="border: 2px solid #000" >-</td>')+ 
                            (data[i]['Shoes'] != null ? '<td class="sht" style="border: 2px solid #000" >'+data[i]['Shoes']+'</td>':'<td class="sht" style="border: 2px solid #000" >-</td>')+
                            (data[i]['Avela'] != null ? '<td class="avet" style="border: 2px solid #000" >'+data[i]['Avela']+'</td>':'<td class="avet"  style="border: 2px solid #000" >-</td>')+
                        ' <tr>');
                    };    
                    compuloan();             
                }
            });
        }

        if(rep =='Bonus Report'){
            $('#bonusdiv').show();
            $('#databonus').empty();
            $.ajax({
                url: "<?php echo site_url('HumanRep/getemp/')?>" + proj+'/'+date1,
                dataType: "JSON",
                success: function(data) {
                    for(i=0;i<data.length;i++){
                        $('#databonus').append('<tr><td style="border: 2px solid #000">'+(i+1)+'</td><td class="noprint" style="border: 2px solid #000">'+data[i]['pworker_id']+'</td><td nowrap style="border: 2px solid #000" align="left" >'+data[i]['pworker_lname']+', '+data[i]['pworker_fname']+'</td>'+         
                            '<td style="border: 2px solid #000" class="noprint">'+data[i]['description']+'</td>'+
                            '<td style="border: 2px solid #000" class="sal noprint" id="sal'+data[i]['pworker_id']+'">'+(data[i]['salary'] * 8).toFixed(1)+'</td>'+
                            '<td style="border: 2px solid #000" class="days noprint" id="days'+data[i]['pworker_id']+'" colspan="2">-</td>'+
                            '<td style="border: 2px solid #000" class="odays noprint" id="odays'+data[i]['pworker_id']+'" colspan="2">-</td>'+
                            '<td style="border: 2px solid #000" class="">'+data[i]['description']+'</td>'+
                            '<td style="border: 2px solid #000" align ="right" class="" >'+(data[i]['salary'] * 8).toFixed(1)+'</td>'+
                            '<td style="border: 2px solid #000" align ="right" class="bonnet" id="net'+data[i]['pworker_id']+'"  >'+
                            '<td style="border: 2px solid #000" align ="right"  class="bon13" colspan="" id="netb'+data[i]['pworker_id']+'"></td>'+
                            '<td  style="border: 2px solid #000" class="noprint" colspan="2"></td><td  style="border: 2px solid #000"  class="noprint" colspan="3"></td>'+
                            '<td style="border: 2px solid #000" class="amount noprint" id="amount'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 2px solid #000" class="oamount noprint" id="oamount'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 2px solid #000" class="allow noprint" id="allow'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 2px solid #000" class="toter noprint" id="toter'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 2px solid #000" class="odeduc noprint" id="odeduc'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 2px solid #000" class="unif noprint" id="unif'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 2px solid #000" class="safgr noprint" id="safgr'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 2px solid #000" class="helm noprint" id="helm'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 2px solid #000" class="avee noprint" id="avee'+data[i]['pworker_id']+'">-</td>'+
                            '<td style="border: 2px solid #000" class="totdeduc noprint" id="totdeduc'+data[i]['pworker_id']+'">-</td>'+
                        ' </tr>');
                        getPayroll(data[i]['pworker_id'], date1);
                    };                 
                }
            });
        }

        if(rep =='Bonus Report (Monthly)'){

            $('#bonusdiv2').show();
            $('#databonus2').empty();
            $.ajax({
                url: "<?php echo site_url('HumanRep/getemp/')?>" + proj+'/'+date1,
                dataType: "JSON",
                success: function(data) {
                    for(i=0;i<data.length;i++){
                        $('#databonus2').append('<tr><td style="border: 2px solid #000">'+(i+1)+'</td><td class="noprint" style="border: 2px solid #000">'+data[i]['pworker_id']+'</td><td nowrap style="border: 2px solid #000" align="left" >'+data[i]['pworker_lname']+', '+data[i]['pworker_fname']+'</td>'+ 
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            '<td style="border: 2px solid #000" ></td>'+
                            
                        ' </tr>');
                        //getPayroll(data[i]['pworker_id'], date1);
                    };                 
                }
            });
        }
    }

    function compuloan(){
        var dw3=0;
        $('.helmett').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                dw3 += parseFloat(value);
            }
        });
        $('#helm').empty();
        $('#helm').append(dw3.toFixed(1));

        var dw3u=0;
        $('.unit').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                dw3u += parseFloat(value);
            }
        });
        $('#uni').empty();
        $('#uni').append(dw3u.toFixed(1));

        var dw3s=0;
        $('.sgt').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                dw3s += parseFloat(value);
            }
        });
        $('#sg').empty();
        $('#sg').append(dw3s.toFixed(1));

        var dw3sh=0;
        $('.sht').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                dw3sh += parseFloat(value);
            }
        });
        $('#sh').empty();
        $('#sh').append(dw3sh.toFixed(1));

        var dw3av=0;
        $('.avet').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                dw3av += parseFloat(value);
            }
        });
        $('#ave').empty();
        $('#ave').append(dw3av.toFixed(1));
    }

    function getPayroll(id, dat){ 
        var holder="";
        var dates = [];
        $.ajax({
            url: "<?php echo site_url('HumanP/getdtr/')?>" + id+'/'+dat+'/'+projectSelected,
            dataType: "JSON",
            success: function(data) {

                var  holder2 = '' ;
                var  holdert1='', holdert2='';
                rph = data[0]['salary'];
                for(i=0; i<data.length;i++){
                    if (holder != data[i]['desig_date']){
                        $("#table-manual tbody").append("<tr>"+
                            "<td id="+data[i]['project_title']+"> "+data[i]['project_title']+" </td>"+
                            "<td id="+data[i]['desig_date']+"> "+data[i]['ddate']+" </td>"+
                            "<td class='ini"+id+"' id='in"+data[i]['desig_date']+""+id+"'></td>"+
                            "<td class='outi"+id+"' id='out"+data[i]['desig_date']+""+id+"'></td>"+
                            "<td class='worki"+id+"' id='work"+data[i]['desig_date']+""+id+"'></td>"+
                            "<td class='latei"+id+"' id='late"+data[i]['desig_date']+""+id+"'></td>"+
                            "<td class='underi"+id+"' id='under"+data[i]['desig_date']+""+id+"'></td>"+
                            "<td class='overi"+id+"' id='over"+data[i]['desig_date']+""+id+"'></td>"+
                        '</tr>');                     
                    }
                    
                    holder = data[i]['desig_date'];
                    dates[i] = holder;
                    for(j=0; j<data.length;j++){
                        
                        if (holder ==  data[j]['desig_date'] ){ 
                            if((data[j]['time'] >= "06:00:00") &&(data[j]['time'] < "12:00:00") && (holdert1 == '')) {
                                $('#in'+data[j]['desig_date']+id).empty();
                                $('#in'+data[j]['desig_date']+id).append(data[j]['dtime']+'');  
                                holdert1 = data[j]['time']; 
                            } 

                            else if((data[j]['time'] >= "00:00:00") &&(data[j]['time'] < "06:00:00")){
                                var t1 = new Date(data[j]['desig_date']);
                                var toout2 = (moment(t1).subtract(1, 'days'));
                                var t3 = moment(toout2).format('YYYY-MM-DD');
    
                                $('#out'+t3+id).empty();
                                $('#out'+t3+id).append(data[j]['dtime']+'');  
                            }      

                            else if((data[j]['time'] >= "12:00:00") && (data[j]['time'] <= "21:00:00") && (holdert2 == '')){
                                $('#out'+data[j]['desig_date']+id).empty();
                                $('#out'+data[j]['desig_date']+id).append(data[j]['dtime']+'');  
                                holdert2 = data[j]['time']; 
                            }  
                        }
                        else{ 
                            holdert1 ='';
                            holdert2 ='';
                        }        
                    };

                };
                var arr = dates;
                var sorted_arr = arr.slice().sort();

                var results = [];
                for (var i =0; i < sorted_arr.length; i++){
                    if(sorted_arr[i+1] != sorted_arr[i]){
                        results.push(sorted_arr[i]);
                    }
                };

                for (var j = 0; j <results.length; j++ ){
                    computelate(id, results[j]);
                    getaded(id, dat);
                    getded(id, dat);
                } 
                
            }
        });
    }

    function getPayroll2(id, dat){ 
        $("#table"+id+" tbody").empty();
        var holder="";
        var dates = [];
        $.ajax({
            url: "<?php echo site_url('HumanP/getdtr2/')?>" + id+'/'+dat+'/'+projectSelected,
            dataType: "JSON",
            success: function(data) {
                var  holder2 = '' ;
                var  holdert1='', holdert2='';
                for(i=0; i<data.length;i++){
                    if (holder != data[i]['desig_date']){
                        var t1 = new Date(data[i]['desig_date']);
                        $("#table"+id+" tbody").append("<tr>"+
                            '<td class="dw'+id+'" style="border: 2px solid #000" nowrap>'+weekdays[t1.getDay()]+'</td>'+
                            '<td style="border: 2px solid #000" nowrap>'+data[i]['desig_date']+'</td>'+
                            '<td style="border: 2px solid #000" nowrap>08:00 am - 05:00 pm </td>'+
                            '<td style="border: 2px solid #000" nowrap id="in'+data[i]['desig_date']+''+id+'">---</td>'+
                            '<td style="border: 2px solid #000" nowrap id="out'+data[i]['desig_date']+''+id+'"></td>'+
                            '<td class="ahw'+id+'" style="border: 2px solid #000" nowrap id="work'+data[i]['desig_date']+''+id+'">---</td>'+
                            '<td class="lw'+id+'" style="border: 2px solid #000" nowrap id="late'+data[i]['desig_date']+''+id+'">---</td>'+
                            '<td class="uw'+id+'" style="border: 2px solid #000" nowrap id="under'+data[i]['desig_date']+''+id+'">---</td>'+
                            '<td class="ow'+id+'" style="border: 2px solid #000" nowrap id="over'+data[i]['desig_date']+''+id+'">---</td>'+
                            '<td style="border: 2px solid #000" nowrap>'+data[i]['status']+'</td>'+
                            '<td style="border: 2px solid #000" nowrap>'+data[i]['project_title']+'</td>'+
                        '</tr>');                     
                    }
                    
                    holder = data[i]['desig_date'];
                    dates[i] = holder;
                    for(j=0; j<data.length;j++){
                        
                        if (holder ==  data[j]['desig_date'] ){ 
                            if((data[j]['time'] >= "06:00:00") && (data[j]['time'] < "12:00:00") && (holdert1 == '')){
                                $('#in'+data[j]['desig_date']+id).empty();
                                $('#in'+data[j]['desig_date']+id).append(data[j]['dtime']+'');  
                                holdert1 = data[j]['time']; 
                            }   

                            else if((data[j]['time'] >= "00:00:00") &&(data[j]['time'] < "06:00:00")){
                                var t1 = new Date(data[j]['desig_date']);
                                var toout2 = (moment(t1).subtract(1, 'days'));
                                var t3 = moment(toout2).format('YYYY-MM-DD');
    
                                $('#out'+t3+id).empty();
                                $('#out'+t3+id).append(data[j]['dtime']+'');  
                            }    

                            else if((data[j]['time'] >= "12:00:00") && (data[j]['time'] <= "21:00:00") && (holdert2 == '')){
                                $('#out'+data[j]['desig_date']+id).empty();
                                $('#out'+data[j]['desig_date']+id).append(data[j]['dtime']+'');  
                                holdert2 = data[j]['time']; 
                            }  
                        }
                        else{ 
                            holdert1 ='';
                            holdert2 ='';
                        }        
                    };

                };
                var arr = dates;
                var sorted_arr = arr.slice().sort();

                var results = [];
                for (var i =0; i < sorted_arr.length; i++){
                    if(sorted_arr[i+1] != sorted_arr[i]){
                        results.push(sorted_arr[i]);
                    }
                };

                for (var j = 0; j <results.length; j++ ){
                    computelate(id, results[j]);
                    getres(id);
                }
            }
        });
    }

    function getres(id){
        var dw=0;
        var dw2=0;
        $('.ahw'+id).each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                dw++;
                dw2 += parseFloat(value);
            }
        });

        $('#ddw'+id).empty();
        $('#ddw'+id).append('Days Worked: '+dw);

        $('#hhw'+id).empty();
        $('#hhw'+id).append('Hrs Worked: '+dw2);

        $('#adw'+id).empty();
        $('#adw'+id).append('Actual Days Worked: '+dw);

        var dw3=0;
        $('.lw'+id).each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                dw3 += parseFloat(value);
            }
        });
        $('#llw'+id).empty();
        $('#llw'+id).append('Late: '+dw3);

        var dw4=0;
        $('.uw'+id).each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                dw4 += parseFloat(value);
            }
        });
        $('#uuw'+id).empty();
        $('#uuw'+id).append('U/Time: '+dw4);

        var dw5=0;
        $('.ow'+id).each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                dw5 += parseFloat(value);
            }
        });
        $('#oow'+id).empty();
        $('#oow'+id).append('OT: '+dw5);

    }

    function computelate(id, ate){
        var s = $('#in'+ate+id).text();
        var o = $('#out'+ate+id).text();
        var t1 = new Date(ate+" "+s);
        var t2 = new Date(ate+" "+o);
        var millisec = t2-t1; 

        var tinbase = new Date(ate+" "+"08:00:00");
        var tin = new Date(ate+" "+"08:15:00");
        var tin2 = new Date(ate+" "+"08:16:00");
        var tin3 = new Date(ate+" "+"08:31:00");
        var tin4 = new Date(ate+" "+"09:01:00");
        var tin5 = new Date(ate+" "+"09:31:00");
        var tin6 = new Date(ate+" "+"10:01:00");
        var tin7 = new Date(ate+" "+"10:31:00");
        var tin8 = new Date(ate+" "+"11:01:00");
        var tin9 = new Date(ate+" "+"11:31:00");
        var tin99 = new Date(ate+" "+"12:01:00");
        var toin1 = new Date(ate+" "+"18:00:00");
        var toin = new Date(ate+" "+"19:30:00");
        var toout = new Date(ate+" "+"21:00:00");
        var tout = new Date(ate+" "+"17:00:00");
        
        var seconds=(millisec/1000).toFixed(1);
        var minutes=(millisec/(1000*60)).toFixed(1);
        var hours=(millisec/(1000*60*60)).toFixed(1);
        var days=(millisec/(1000*60*60*24)).toFixed(1);
        var wh = (tout-t1)/(1000*60*60);

        if (wh>=8){
            $('#work'+ate+id).empty();
            $('#work'+ate+id).append("8 hr(s)");
        }
        else{ 
            $('#work'+ate+id).empty();
            $('#work'+ate+id).append(wh.toFixed(1)+" hr(s)");
        }

        if(t1>=tin2){
            alert(t1);
            if((t1>=tin2)&&(t1<tin3)){
                $('#late'+ate+id).empty();
                $('#late'+ate+id).append((1800000/(1000*60*60)).toFixed(2)+" hr(s)"); 
                alert('on1');
            }
            if((t1>=tin3)&&(t1<tin4)){
                $('#late'+ate+id).empty();
                $('#late'+ate+id).append((3600000/(1000*60*60)).toFixed(2)+" hr(s)"); 
                alert('on2')
            }
            if((t1>=tin4)&&(t1<tin5)){
                $('#late'+ate+id).empty();
                $('#late'+ate+id).append((5400000/(1000*60*60)).toFixed(2)+" hr(s)"); 
            }
            if((t1>=tin5)&&(t1<tin6)){
                $('#late'+ate+id).empty();
                $('#late'+ate+id).append((7200000/(1000*60*60)).toFixed(2)+" hr(s)"); 
            }
            if((t1>=tin6)&&(t1<tin7)){
                $('#late'+ate+id).empty();
                $('#late'+ate+id).append((9000000/(1000*60*60)).toFixed(2)+" hr(s)"); 
            }
            if((t1>=tin7)&&(t1<tin8)){
                $('#late'+ate+id).empty();
                $('#late'+ate+id).append((10800000/(1000*60*60)).toFixed(2)+" hr(s)"); 
            }
            if((t1>=tin8)&&(t1<tin9)){
                $('#late'+ate+id).empty();
                $('#late'+ate+id).append((12600000/(1000*60*60)).toFixed(2)+" hr(s)"); 
            }
            if((t1>=tin9)&&(t1<tin99)){
                $('#late'+ate+id).empty();
                $('#late'+ate+id).append((14400000/(1000*60*60)).toFixed(2)+" hr(s)"); 
            }
             
        }
        else{
            $('#late'+ate+id).empty();
            $('#late'+ate+id).append("---"); 
        }   

        if(t2<tout){
            if(t2 > tin){
                var dif2 = tout-t2;
                $('#under'+ate+id).empty();
                $('#under'+ate+id).append((dif2/(1000*60*60)).toFixed(1)+" hr(s)");
            }
            else{
                $('#under'+ate+id).empty();
                $('#under'+ate+id).append("---"); 
            } 
        }
        else{
            $('#under'+ate+id).empty();
            $('#under'+ate+id).append("---"); 
        }          

        if(t2 >= toin){
            var ov = t2 - toin1;
            $('#over'+ate+id).empty();
            $('#over'+ate+id).append( (ov/(1000*60*60)).toFixed(1) +" hr(s)");

        }
        
        else if (t2 < tin){
            var toout2 = (moment(t2).add(1, 'days'));
            var t3 = moment(toout2).format('YYYY-MM-DD');
            $('#over'+ate+id).empty();
            $('#over'+ate+id).append(((toout2-toin1)/(1000*60*60)).toFixed(1)+" hr(s)");
        }

        else{
            $('#over'+ate+id).empty();
            $('#over'+ate+id).append("---");
        }

        if((s=='')||(o=='')||(s=='---')||(o=='---')){
            $('#over'+ate+id).empty(); 
            $('#over'+ate+id).append("---"); 
            $('#late'+ate+id).empty();
            $('#late'+ate+id).append("---"); 
            $('#under'+ate+id).empty();
            $('#under'+ate+id).append("---"); 
            $('#work'+ate+id).empty();
            $('#work'+ate+id).append("---"); 
        }    
        
        var hro=0, c=0;
        $('.worki'+id).each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                c++;
            }
        });
        
        $('#days'+id).empty();
        $('#days'+id).append(c.toFixed(1)+"0");
        $('#amount'+id).empty(); 
        $('#amount'+id).append( (c*(parseFloat($('#sal'+id).text()))).toFixed(1)+"0");

        var ovo=0 ;
        $('.overi'+id).each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                ovo += parseFloat(value);
            }
        });

        $('#odays'+id).empty();
        $('#odays'+id).append(ovo.toFixed(1)+"0");
        $('#oamount'+id).empty();
        $('#oamount'+id).append(((ovo.toFixed(1)*(parseFloat($('#sal'+id).text())/8)).toFixed(1))+"0"); 

        var lto=0;
        $('.latei'+id).each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                lto += parseFloat(value);
                //alert(lto);
            } 
        });

        $('.underi'+id).each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                lto += parseFloat(value);
            }
        });

        var dtot=0;
        //alert(lto);
        dtot =  lto.toFixed(1)*(parseFloat($('#sal'+id).text())/8);
        $('#odeduc'+id).empty();
        $('#odeduc'+id).append(dtot.toFixed(1)+"0");
    }

    function getaded(id, date){
        $.ajax({
            url : "<?php echo site_url('HumanP/getaded/')?>" + id+"/"+date,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#allow'+id).empty();
                var tot = 0;
                for(i=0; i<data.length;i++){
                    tot += parseFloat(data[i]['amount']);
                };     
                $('#allow'+id).append(tot.toFixed(1)+"0");   

                
                if(rep =="Bonus Report"){
                    $('#toter'+id).empty();
                    $('#toter'+id).append( (parseFloat($('#amount'+id).text())).toFixed(1)+"0" );
                }
                else{
                    $('#toter'+id).empty();
                    $('#toter'+id).append( (parseFloat($('#amount'+id).text())+parseFloat($('#oamount'+id).text())+(parseFloat($('#allow'+id).text()))).toFixed(1)+"0" );
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


    function getded(id, date){
        var hot;
        hot = parseFloat($('#odeduc'+id).text());

        $.ajax({
            url : "<?php echo site_url('HumanP/getded/')?>" + id+"/"+date,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                var tot = 0;
                var lod =0; 
                var ot2=0;
                for(i=0; i<data.length;i++){
                    tot += parseFloat(data[i]['amount']);
                    if((data[i]['deductiontype_id']==22)||(data[i]['deductiontype_id']==17)){
                        lod +=  parseFloat(data[i]['amount']) ;
                        $('#avee'+id).empty();
                        $('#avee'+id).append(lod.toFixed(1)+"0");
                    }
                    else if(data[i]['deductiontype_id']==21){
                        $('#unif'+id).empty();
                        $('#unif'+id).append(parseFloat((data[i]['amount'])).toFixed(1)+"0");
                    }
                    else if(data[i]['deductiontype_id']==16){
                        $('#safgr'+id).empty();
                        $('#safgr'+id).append(parseFloat((data[i]['amount'])).toFixed(1)+"0");
                    }
                    else if(data[i]['deductiontype_id']==19){ 
                        $('#helm'+id).empty();
                        $('#helm'+id).append(parseFloat((data[i]['amount'])).toFixed(1)+"0");
                    }
                    else {
                        ot2 += parseFloat(data[i]['amount']) ;
                    }
                }; 

                $('#odeduc'+id).empty();
                $('#odeduc'+id).append( (parseFloat(ot2)).toFixed(1)+"0");
        
                var ot8 =0;
                ot8 = parseFloat($('#odeduc'+id).text());
                $('#odeduc'+id).empty();
                $('#odeduc'+id).append( (parseFloat(hot)+ parseFloat(ot8)).toFixed(1)+"0");
                
                var ot6 =0;
                ot6 = parseFloat($('#odeduc'+id).text());

                $('#totdeduc'+id).empty();
                $('#totdeduc'+id).append((parseFloat(tot)+parseFloat(hot)).toFixed(1)+"0");
                 getded2(id, date);
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

    function getded2(id, date){
        var hot;
        hot = parseFloat($('#totdeduc'+id).text());
        $.ajax({
            url : "<?php echo site_url('HumanP/displayded21/')?>" + id+"/"+date,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data['amount_paid']!=null) {
                    $('#totdeduc'+id).empty();
                    $('#totdeduc'+id).append((parseFloat(data['amount_paid'])+parseFloat(hot)).toFixed(1)+"0");
                }
                if(rep =="Bonus Report"){
                    thisisit13(id);
                }
                else{
                    thisisit(id);
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

    function thisisit(id){ 
        $("#table-manual tbody").empty(); 
        $('#net'+id).empty();
        $('#net'+id).append( parseFloat( ($('#toter'+id).text())-parseFloat($('#totdeduc'+id).text())).toFixed(1)+"0" ) ;
        $('#netb'+id).empty();
        $('#netb'+id).append( parseFloat( (($('#toter'+id).text())-parseFloat($('#totdeduc'+id).text()))/12 ).toFixed(1)+"0" ) ;
        getGrandTotal();
    }


    function thisisit13(id){ 
        $("#table-manual tbody").empty(); 
        $('#net'+id).empty();
        $('#net'+id).append( parseFloat( ($('#toter'+id).text()) ).toFixed(1)+"0" ) ;
        $('#netb'+id).empty();
        $('#netb'+id).append( parseFloat( (($('#toter'+id).text()) )/12 ).toFixed(1)+"0" ) ;
        getGrandTotal();
    }

    function getGrandTotal(){
        var di=0;
        $('.days').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                di += parseFloat(value);
           }
        });
        var din =  di.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#daysi').empty();
        $('#daysi').append(din);
        $('#ndaysi').empty();
        $('#ndaysi').append(din);

        var d2=0;
        $('.amount').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d2 += parseFloat(value);
           }
        });
        var d2n =  d2.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#amo').empty();
        $('#amo').append(d2n);
        $('#namo').empty();
        $('#namo').append(d2n);

        var d3=0;
        $('.odays').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d3 += parseFloat(value);
           }
        });
        var d3n =  d3.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#hri').empty();
        $('#hri').append(d3n);
        $('#nhri').empty();
        $('#nhri').append(d3n);

        var d4=0;
        $('.oamount').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d4 += parseFloat(value);
           }
        });
        var d4n =  d4.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#amo2').empty();
        $('#amo2').append(d4n);
        $('#namo2').empty();
        $('#namo2').append(d4n);


        var d5=0;
        $('.allow').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d5 += parseFloat(value);
           }
        });
        var d5n =  d5.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#alli').empty();
        $('#alli').append(d5n);
        $('#nalli').empty();
        $('#nalli').append(d5n);

        var d6=0;
        $('.toter').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d6 += parseFloat(value);
           }
        });
        var d6n =  d6.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#toteri').empty();
        $('#toteri').append(d6n);
        $('#ntoteri').empty();
        $('#ntoteri').append(d6n);

        var d7=0;
        $('.odeduc').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d7 += parseFloat(value);
           }
        });
        var d7n =  d7.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#otded').empty();
        $('#otded').append(d7n);
        $('#notded').empty();
        $('#notded').append(d7n);

        var d8=0;
        $('.unif').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d8 += parseFloat(value);
           }
        });
        var d8n =  d8.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#unii').empty();
        $('#unii').append(d8n);
        $('#nunii').empty();
        $('#nunii').append(d8n);

        var d9=0;
        $('.safgr').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d9 += parseFloat(value);
           }
        });
        var d9n =  d9.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#sgi').empty();
        $('#sgi').append(d9n);
        $('#nsgi').empty();
        $('#nsgi').append(d9n);

        var d91=0;
        $('.helm').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d91 += parseFloat(value);
           }
        });
        var d91n =  d91.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#hemi').empty();
        $('#hemi').append(d91n);
        $('#nhemi').empty();
        $('#nhemi').append(d91n);

        var d92=0;
        $('.avee').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d92 += parseFloat(value);
           }
        });
        var d92n =  d92.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#evei').empty();
        $('#evei').append(d92n);
        $('#nevei').empty();
        $('#nevei').append(d92n);

        var d93=0;
        $('.totdeduc').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d93 += parseFloat(value);
           }
        });
        var d93n =  d93.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#totded').empty();
        $('#totded').append(d93n);
        $('#ntotded').empty();
        $('#ntotded').append(d93n);

        var d94=0;
        $('.net').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                d94 += parseFloat(value);
           }
        });
        var d94n =  d94.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#netam').empty();
        $('#netam').append(d94n);
        $('#nnetam').empty();
        $('#nnetam').append(d94n);
        $('#toti').empty();
        $('#toti').append(d94n);

        var bonnet=0;
        $('.bonnet').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                bonnet += parseFloat(value);
           }
        });
        var bonnetn =  bonnet.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#totnetbon').empty();
        $('#totnetbon').append(bonnetn);
        
        var bon13=0;
        $('.bon13').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='-'){
                bon13 += parseFloat(value);
           }
        });
        var bon13n =  bon13.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"0";
        $('#totnetbon2').empty();
        $('#totnetbon2').append(bon13n);
    }

    function printDiv(div) {
        var divToPrint = document.getElementById(div);
        var htmlToPrint='';
         if((rep=="Summary Report")|| (rep=="Bonus Report (Monthly)")){
            htmlToPrint = '<style type="text/css">@page{size:landscape; width:100%;}table{font-size:12px} .noprint{display: none;}</style>';
         }
         else if((rep=="Payroll Release Form") || (rep=="Bonus Report")) {
                htmlToPrint = '<style type="text/css">@page{size:portrait; width:100%;}table{font-size:12px} .noprint{display: none;}</style>';
         }else{
             htmlToPrint='<style type="text/css">@page{size:portrait; width:100%;}table{font-size:11px}</style>';
         }
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }

    function printEx(div){
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById(div);
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = 'download.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
   
    }

    var tableToExcel = (function() {

        var uri = 'data:application/vnd.ms-excel;base64,', template = '<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><style type="text/css"> .noprint{ display: none; }<table>{table}</table></body></html>', base64 = function(s) { 
            return window.btoa(unescape(encodeURIComponent(s))) }, format = function(s, c){ 
                return s.replace(/{(\w+)}/g, function(m, p) { return c[p];  
            }) 
        }

        return function (table, name, filename) {

            if (!table.nodeType) table = document.getElementById(table) 
                var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                document.getElementById("dlink").href = uri + base64(format(template, ctx));
                document.getElementById("dlink").download = filename;
                document.getElementById("dlink").click();
            }
        })
    ();


    $("#pint2").click(function(e){
        e.preventDefault();
        $("#printme2").table2excel({
            exclude: ".noprint",
            name: "Worksheet Name",
            filename: "Payroll Release Form" //do not include extension
        });
    });

    $("#pint3").click(function(e){
        e.preventDefault();
        $("#printmebonus2").table2excel({
            exclude: ".noprint",
            name: "Worksheet Name",
            filename: "Bonus Report (Monthly)" //do not include extension
        });
    });

     

</script>
