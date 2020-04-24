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
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Payroll
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="HumanR"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="HumanP"><i class="fa fa-credit-card"></i> Payroll</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Employee Payroll</a></li>
                        <li><a href="#timeline" data-toggle="tab">Additionals/Deductions</a></li>                        
                        <li><a href="#loans" data-toggle="tab">Loans</a></li> 
                        <li><a href="#trese" data-toggle="tab">13th month</a></li>          
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="row">    
                                <div class="col-lg-4">
                                    <div class="col-lg-12">
                                        <br>
                                        <label>Select Employee: </label>
                                        <div class = "form-group input-group">
                                            <span class="input-group-addon"><i class=" fa fa-user"></i></span>
                                            <select class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" id="emp" name="emp">
                                                <option></option>
                                                <?php foreach($emp_info as $each){ ?>
                                                    <option value="<?php echo $each->pworker_id; ?>"><?php echo $each->pworker_lname; ?>, <?php echo $each->pworker_fname; ?>  <?php echo $each->pworker_mname; ?></option>';
                                                <?php } ?>
                                            </select>
                                        </div>
                                    

                                        <div class="form-group">
                                            <label>Date range:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <input type="text" class="form-control pull-right" id="reservation" name="reservation">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-danger btn-sm btn-block" onclick="startcompute()">Compute Salary</button>
                                        </div>    
                                    </div>
                                    <div class="col-lg-12" id="prpr">
                                        <hr>
                                        <div id ="payslip" class="bg-gray" style="border:1px solid">
                                        </div>   
                                        <hr>                              
                                        <div>
                                            <button class="btn btn-sm btn-block btn-info" onclick="printDiv();"><i class="fa fa-print"> </i> Print</button>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-lg-8" >
                                    <div class="box">
                                        <div class="box-header">
                                            <h4 class="box-title">Payroll Details</h4>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered table-striped table-hover" id="table-manual">
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
                        </div>
                        <div class="tab-pane fade" id="timeline">
                            
                            <div class="box box-info ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"> Employees</h3>
                                    <div class="box-tools pull-right">                            
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body"  >
                                    <table id="datatable-hr-employee-add-deduc" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Employee Address</th>
                                                <th>Position</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Employee Address</th>
                                                <th>Position</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                </div>

                        </div>    
                        <div class="tab-pane" id="loans">
                            <div class="box box-info ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"> Employees</h3>
                                    <div class="box-tools pull-right">                            
                                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body"  >
                                    <table id="datatable-hr-employee-loans" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Employee Address</th>
                                                <th>Position</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Employee Address</th>
                                                <th>Position</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>  

                        <div class="tab-pane" id="trese">
                            <div class="row">    
                                <div class="col-lg-4">
                                    <div class="col-lg-12">
                                        <br>
                                        <label>Select Employee: </label>
                                        <div class = "form-group input-group">
                                            <span class="input-group-addon"><i class=" fa fa-user"></i></span>
                                            <select class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" id="emp13" name="emp13">
                                                <option></option>
                                                <?php foreach($emp_info as $each){ ?>
                                                    <option value="<?php echo $each->pworker_id; ?>"><?php echo $each->pworker_lname; ?>, <?php echo $each->pworker_fname; ?>  <?php echo $each->pworker_mname; ?></option>';
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <label>Select Month: </label>
                                        <div class = "form-group input-group">
                                            <span class="input-group-addon"><i class=" fa fa-calendar"></i></span>
                                            <select class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" id="month13" name="month13">
                                                <option></option>
                                                <option value="0">January</option>
                                                <option value="1">February</option>
                                                <option value="2">March</option>
                                                <option value="3">April</option>
                                                <option value="4">May</option>
                                                <option value="5">June</option>
                                                <option value="6">July</option>
                                                <option value="7">August</option>
                                                <option value="8">September</option>
                                                <option value="9">October</option>
                                                <option value="10">November</option>
                                                <option value="11">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Input Year: </label>
                                        <input class="form-control" type="number" placeholder="" name="year13" id="year13" min="1" >
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button class="btn btn-danger btn-sm btn-block" onclick="startcompute13()">View</button>
                                        </div>    
                                    </div>
                                   
                                </div>
                                <div class="col-lg-8" >
                                    <div class="box">
                                        <div class="box-header">
                                            <h4 class="box-title">Bonus Details</h4>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered table-striped table-hover" id="table-manual-bonus">
                                                <thead>
                                                    <tr>
                                                        <th>Week</th>
                                                        <th>Total Actual Hours Worked</th>
                                                        <th>Net Pay</th>
                                                        <th>13th Month/Incentives</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                      <th>Total</th>
                                                        <th id="to13"></th>
                                                        <th id="net13"></th>
                                                        <th id="inc13"></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8 hidden" >
                                    <div class="box">
                                        <div class="box-header">
                                            <h4 class="box-title">List</h4>
                                        </div>
                                        <div class="box-body">
                                            <table class="table table-bordered table-striped table-hover" id="table-manual-13">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Time in</th>
                                                        <th>Time out</th>
                                                        <th>Work Hours</th>  
                                                        <th>undertime</th>  
                                                        <th>late</th>  
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
                </div>
            </div>
        </div>
    </section>
</div>

<!-- modals -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-group">
                        <div class="form-group hidden">
                            <label for="supid">Additional/id no.</label>
                               <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Additional/id no."/>
                                <span class="help-block"></span>
                        </div>                    
                        <div class="form-group">
                            <label for="prjcode">Additional Title</label>
                                <select name="additional_id" id="additional_id" class="form-control">
                                <option value="undefined"></option>
                                <?php foreach ($additionals_id as $sup)
                                 echo '<option value='.$sup->additionaltype_id.'>'.$sup->description.'</option>'
                                ?>
                                </select>
                            <span class="help-block"></span>                               
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Note</label>
                                <p style = "color:red;margin-left: 2%;" id="addnote"> </p>
                            <span class="help-block"></span>                               
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Amount</label>
                                <input class="form-control" type="number" placeholder="0.00" name="addamt" min="1" step=".01">
                            <span class="help-block"></span>                               
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                <label for="idTourDateDetails">Start Date:</label>
                                    <div class = "form-group input-group">
                                    <input  id = "addsdate"  name= "addsdate" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                    </div>
                                </div>
                        </div>    

                        <div class="col-md-4">
                                <div class="form-group">
                                <label for="idTourDateDetails">End Date:</label>
                                    <div class = "form-group input-group">
                                    <input  id = "addedate"  name= "addedate" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                    </div>
                                </div>
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

<div class="modal fade" id="modal_form1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form1" class="form-group">
                        <div class="form-group hidden">
                            <label for="supid">Deduction/id no.</label>
                               <input type="text" class="form-control" id="employee_id1" name="employee_id1" placeholder="Additional/id no."/>
                                <span class="help-block"></span>
                        </div>                    
                        <div class="form-group">
                            <label for="prjcode">Deduction Title</label>
                                <select name="deduction_id" id="deduction_id" class="form-control">
                                <option value="undefined"></option>
                                <?php foreach ($deductions_id as $ded)
                                 echo '<option value='.$ded->deductiontype_id.'>'.$ded->description.'</option>'
                                ?>
                                </select>
                            <span class="help-block"></span>                               
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Note</label>
                                <p style = "color:red;margin-left: 2%;" id="addnote1"> </p>
                            <span class="help-block"></span>                               
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Amount</label>
                                <input class="form-control" type="number" placeholder="0.00" name="deducamt" min="1" step=".01">
                            <span class="help-block"></span>                               
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                <label for="idTourDateDetails">Start Date:</label>
                                    <div class = "form-group input-group">
                                    <input  id = "deducsdate"  name= "deducsdate" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                    </div>
                                </div>
                        </div>    

                        <div class="col-md-4">
                                <div class="form-group">
                                <label for="idTourDateDetails">End Date:</label>
                                    <div class = "form-group input-group">
                                    <input  id = "deducedate"  name= "deducedate" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                    </div>
                                </div>
                        </div>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave1" onclick="save1()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <img class="img-emp" id="img-emp">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <p id="emp_name" style="color: red; font-size: 17px; margin-left: 1.5%;"></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 3%;">
                    <div class="col-sm-12">
                        <div class="box box-info ">
                            <div class="box-header with-border">
                                <h3 class="box-title"> Additionals</h3>
                                <div class="box-tools pull-right">                            
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body"  >
                                <table id="datatable-addts" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Amount</th>
                                            <th>Date started</th>
                                            <th>Date end</th>
                                            <th>Date added</th>                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>                                  
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="box box-info ">
                            <div class="box-header with-border">
                                <h3 class="box-title"> Deductions</h3>
                                <div class="box-tools pull-right">                            
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body"  >
                                <table id="datatable-deducs" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Amount</th>
                                            <th>Date started</th>
                                            <th>Date end</th> 
                                            <th>Date added</th>
                                            <th>Action</th>
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
            <div class="modal-footer">                
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form3" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  btn-success">
               <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form_loan" class="form-group">
                        <div class="form-group">
                            <label for="supid">Loan/id no.</label>
                               <input type="text" class="form-control" id="employee_id_loan" name="employee_id_loan"/>
                                <span class="help-block"></span>
                        </div>                    
                        <div class="form-group">
                            <label for="prjcode">Loan Title</label>
                                <select name="loan_id" id="loan_id" class="form-control">
                                <option value="undefined"></option>
                                <?php foreach ($deductions_id2 as $ded)
                                 echo '<option value='.$ded->deductiontype_id.'>'.$ded->description.'</option>'
                                ?>
                                </select>
                            <span class="help-block"></span>                              
                        </div>
                        <div class="form-group">
                            <label for="prjcode">Note</label>
                                <p style = "color:red;margin-left: 2%;" id="loan_note"> </p>
                        <span class="help-block"></span>                               
                        </div>

                        <div class="form-group">
                            <label for="prjcode">Original Loan</label>
                                <input class="form-control" type="number" placeholder="0.00" name="amt_loan" id="amt_loan" min="1" step=".01">
                            <span class="help-block"></span>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="prjcode">Terms</label>
                                    <input class="form-control" type="number" placeholder="1" name="loanterm" id="loanterm" min="1" step="1">
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="idTourDateDetails">Interest</label>
                                        <input class="form-control" type="number" placeholder="0" name="loanint" id="loanint" min="0" step="1">
                                </div>
                            </div>

                            <div class="col-md-4">  
                                <label for="prjcode">Deduction Amount</label>
                                    <input class="form-control" type="text" name="deducamt" id="deducamt" min="1" step="1" readonly>
                            </div>
                                       
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="idTourDateDetails">Deduction Period:</label>
                                    <select name="loan_period" id="loan_period" class="form-control">
                                        <option value=""></option>              
                                        <option value="Every Payroll">Every Payroll</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="idTourDateDetails">Date Loan/Granted:</label>
                                    <div class = "form-group input-group">
                                    <input  id = "loangrant"  name= "loangrant" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>    

                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="idTourDateDetails">Deduction Starts:</label>
                                    <div class = "form-group input-group">
                                    <input  id = "deducstart"  name= "deducstart" value ="<?php echo date("Y-m-d")?>" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                    <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>                                   
                        </div>         

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave1" onclick="save_loan()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form4" role="dialog">
    <div class="modal-dialog modal-lg" style ="width:auto; margin:20px 20px 20px 20px">
        <div class="modal-content">
            <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
            </div>            
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-5">
                        <img class="img-emp" id="img-emp_loan">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-5">
                        <p id="emp_name_loan" style="color: red; font-size: 17px; margin-left: 1.5%;"></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 3%;">
                    <div class="col-sm-12">
                        <div class="box ">
                            <div class="box-header no-border">
                                <h3 class="box-title"> Loans</h3>
                                <div class="box-tools pull-right">                            
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <table id="datatable-loans" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Loan Title</th>
                                            <th>Date Loan/Granted</th>
                                            <th>Orig. Loan</th>
                                            <th>Terms</th>
                                            <th>Interest</th>
                                            <th>Deduct Amt</th>
                                            <th>Deduction Period</th>
                                            <th>Deduction Starts on</th>
                                            <th>Total Paid</th>
                                            <th>Action</th>
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
            <div class="modal-footer">                
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form5" role="dialog">
    <div class="modal-dialog modal-sm" style ="width:auto; margin:150px 150px 150px 150px" >
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title3"></h3>
            </div>            
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-5">
                        <img class="img-emp" id="img-emp_loan">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-5">
                        <p id="emp_name_loan" style="color: red; font-size: 17px; margin-left: 1.5%;"></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 3%;">
                    <div class="col-sm-12">
                        <div class="box ">
                            <div class="box-header no-border">
                                <div class="box-tools pull-right">                            
                                    <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <table id="datatable-loans_pay" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Loan Payment Id</th>
                                            <th>Date of Payment</th>
                                            <th>Amount Paid</th>
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
            <div class="modal-footer">                
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    var table;
    var name;
    var save_method;    
    var table_add;
    var table_deduc;
    var table_loans;
    var table_loans_p;
    var rph;
    var emp1;
    var date1;
    var op;
    
    $(document).ready(function() {
        $('#prpr').hide();
        $('#hpay').attr("class","active");

        $('#emp').change(function() {
            name = $("#emp option:selected").text();
        });


        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,  
        });

        var handleDataTableButtons = function() {
            if ($("#datatable-hr-employee-add-deduc").length) {
                table = $("#datatable-hr-employee-add-deduc").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('HumanP/ajax_list')?>",
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
                            extend: "copy",
                            className: "btn-sm"
                        },{
                            extend: "csv",
                            className: "btn-sm"
                        },{
                            extend: "excel",
                            className: "btn-sm"
                        },{
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },{
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons();
                }
            };
        }();
        TableManageButtons.init();

        var handleDataTableButtons1 = function() {
            if ($("#datatable-hr-employee-loans").length) {
                table = $("#datatable-hr-employee-loans").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('HumanP/ajax_list_loan')?>",
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
                            extend: "copy",
                            className: "btn-sm"
                        },{
                            extend: "csv",
                            className: "btn-sm"
                        },{
                            extend: "excel",
                            className: "btn-sm"
                        },{
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },{
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons1 = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons1();
                }
            };
        }();
        TableManageButtons1.init();

    });

    function startcompute(){
        $('#prpr').show();
        emp1 = $('#emp').val(); 
        date1 = $('#reservation').val();
        $('#payslip').empty();
        var dates = [];
        $.ajax({
            url: "<?php echo site_url('HumanP/getdtr1/')?>" + emp1+'/'+date1,
            dataType: "JSON",
            success: function(data) {
                $("#table-manual tbody").empty();
                var holder = '',holder2 = '' ;
                var  holdert1='', holdert2='';
                rph = data[0]['salary'];
                for(i=0; i<data.length;i++){
                    if (holder != data[i]['desig_date']){

                        $("#table-manual tbody").append("<tr>"+
                            "<td id="+data[i]['project_title']+"> "+data[i]['project_title']+" </td>"+
                            "<td id="+data[i]['desig_date']+"> "+data[i]['ddate']+" </td>"+
                            "<td class='ini' id='in"+data[i]['desig_date']+"'></td>"+
                            "<td class='outi' id='out"+data[i]['desig_date']+"'></td>"+
                            "<td class='worki' id='work"+data[i]['desig_date']+"'></td>"+
                            "<td class='latei' id='late"+data[i]['desig_date']+"'></td>"+
                            "<td class='underi' id='under"+data[i]['desig_date']+"'></td>"+
                            "<td class='overi' id='over"+data[i]['desig_date']+"'></td>"+
                            "<td class='payi hidden' id='pay"+data[i]['desig_date']+"'></td>"+
                        '</tr>');                     
                    }
                    
                    
                    holder = data[i]['desig_date'];
                    dates[i] = holder;
                    for(j=0; j<data.length;j++){
                       
                        if (holder ==  data[j]['desig_date'] ){ 
                            if((data[j]['time'] >= "06:00:00") &&(data[j]['time'] < "12:00:00") && (holdert1 == '')){
                                $('#in'+data[j]['desig_date']).empty();
                                $('#in'+data[j]['desig_date']).append(data[j]['dtime']+'');  
                                holdert1 = data[j]['time']; 
                            }     

                           else if((data[j]['time'] >= "00:00:00") &&(data[j]['time'] < "06:00:00")){
                                var t1 = new Date(data[j]['desig_date']);
                                var toout2 = (moment(t1).subtract(1, 'days'));
                                var t3 = moment(toout2).format('YYYY-MM-DD');
    
                                $('#out'+t3).empty();
                                $('#out'+t3).append(data[j]['dtime']+'');  
                            }     

                            else if((data[j]['time'] >= "12:00:00") && (data[j]['time'] <= "21:00:00") && (holdert2 == '')){
                                $('#out'+data[j]['desig_date']).empty();
                                $('#out'+data[j]['desig_date']).append(data[j]['dtime']+'');  
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
                    computelate(results[j]);
                }
                
                payslip(date1, rph);
                getaded(emp1, date1);
                getded(emp1, date1);
                displayded2(emp1, date1);
            }
        });
    }

    function computelate(ate){
        var s = $('#in'+ate).text();
        var o = $('#out'+ate).text();
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
        
        var tout = new Date(ate+" "+"17:00:00");
        var toin1 = new Date(ate+" "+"18:00:00");
        var toin = new Date(ate+" "+"19:30:00");
        var toout = new Date(ate+" "+"21:00:00");
        var seconds=(millisec/1000).toFixed(1);
        var minutes=(millisec/(1000*60)).toFixed(1);
        var hours=(millisec/(1000*60*60)).toFixed(1);
        var days=(millisec/(1000*60*60*24)).toFixed(1);
 
        

        var wh = (tout-t1)/(1000*60*60);
        if (wh>=8){
            $('#work'+ate).empty();
            $('#work'+ate).append("8 hr(s)");
        }
        else{ 
            $('#work'+ate).empty();
            $('#work'+ate).append(wh.toFixed(1)+" hr(s)");
        }

        if(t1>=tin2){
            if((t1>=tin2)&&(t1<tin3)){
                $('#late'+ate).empty();
                $('#late'+ate).append((1800000/(1000*60*60)).toFixed(1)+" hr(s)"); 
            }
            if((t1>=tin3)&&(t1<tin4)){
                $('#late'+ate).empty();
                $('#late'+ate).append((3600000/(1000*60*60)).toFixed(1)+" hr(s)"); 
            }
            if((t1>=tin4)&&(t1<tin5)){
                $('#late'+ate).empty();
                $('#late'+ate).append((5400000/(1000*60*60)).toFixed(1)+" hr(s)"); 
            }
            if((t1>=tin5)&&(t1<tin6)){
                $('#late'+ate).empty();
                $('#late'+ate).append((7200000/(1000*60*60)).toFixed(1)+" hr(s)"); 
            }
            if((t1>=tin6)&&(t1<tin7)){
                $('#late'+ate).empty();
                $('#late'+ate).append((9000000/(1000*60*60)).toFixed(1)+" hr(s)"); 
            }
            if((t1>=tin7)&&(t1<tin8)){
                $('#late'+ate).empty();
                $('#late'+ate).append((10800000/(1000*60*60)).toFixed(1)+" hr(s)"); 
            }
            if((t1>=tin8)&&(t1<tin9)){
                $('#late'+ate).empty();
                $('#late'+ate).append((12600000/(1000*60*60)).toFixed(1)+" hr(s)"); 
            }
            if((t1>=tin9)&&(t1<tin99)){
                $('#late'+ate).empty();
                $('#late'+ate).append((14400000/(1000*60*60)).toFixed(1)+" hr(s)"); 
            }
             
            // var dif = tinbase2-tinbase;
            // alert(dif); 
            // $('#late'+ate).empty();
            // $('#late'+ate).append((dif/(1000*60*60)).toFixed(1)+" hr(s)"); 
        }
        else{
            $('#late'+ate).empty();
            $('#late'+ate).append("---"); 
        }   

        if(t2<tout){
            if(t2 > tin){
                var dif2 = tout-t2;
                $('#under'+ate).empty();
                $('#under'+ate).append((dif2/(1000*60*60)).toFixed(1)+" hr(s)");
            }
            else{
                $('#under'+ate).empty();
                $('#under'+ate).append("---"); 
            } 
        }
        else{
            $('#under'+ate).empty();
            $('#under'+ate).append("---"); 
        }          
 
        if(t2 >= toin){
            var ov = t2 - toin1;
            $('#over'+ate).empty();
            $('#over'+ate).append((ov/(1000*60*60)).toFixed(1)+" hr(s)");
        }
        
        else if (t2 < tin){
            var toout2 = (moment(t2).add(1, 'days'));
            var t3 = moment(toout2).format('YYYY-MM-DD');
            $('#over'+ate).empty();
            $('#over'+ate).append(((toout2-toin1)/(1000*60*60)).toFixed(1)+" hr(s)");
        }

        else{
            $('#over'+ate).empty();
            $('#over'+ate).append("---");
        }

        if((s=='')||(o=='')){
            $('#over'+ate).empty(); 
            $('#over'+ate).append("---"); 
            $('#late'+ate).empty();
            $('#late'+ate).append("---"); 
            $('#under'+ate).empty();
            $('#under'+ate).append("---"); 
            $('#work'+ate).empty();
            $('#work'+ate).append("---"); 
        }    
        
        
    }

    
    function payslip(d, rph){

        var hro=0;
        $('.worki').each(function(){
            var value = $(this).text();

            if(value.length!=0 && value!='---'){
                hro += parseFloat(value);
           }
        });

        var ovo=0;
        $('.overi').each(function(){
            var value = $(this).text();

            if(value.length!=0 && value!='---'){
                ovo += parseFloat(value);
           }
        });

        var lto=0;
        $('.latei').each(function(){
            var value = $(this).text();

            if(value.length!=0 && value!='---'){
                lto += parseFloat(value);
           }
        });

        var uro=0;
        $('.underi').each(function(){
            var value = $(this).text();

            if(value.length!=0 && value!='---'){
                uro += parseFloat(value);
           }
        });
        $('#addl').show();
        $('#payslip').empty();
        $('#payslip').append(
            '<table class="table" >'+
                '<thead>'+
                    '<tr><th colspan="4">Name: '+name+'</th> </tr>'+
                    '<tr><th colspan="4">Payslip Date: '+d+'</th> </tr>'+
                '</thead>'+
                '<tbody>'+
                    '<tr>'+
                       '<td colspan="4">  </td>'+ 
                        
                    '</tr>'+
                    '<tr align="center">'+
                       '<td></td> '+
                       '<td><strong>Rate</strong></td>'+ 
                       '<td><strong>Work Hrs</strong></td>'+
                       '<td><strong>Amount</strong></td> '+
                    '</tr>'+
                    '<tr>'+
                       '<td>Basic</td>'+ 
                       '<td align="center">'+rph.toString()+'</td> '+
                       '<td align="center"><b>'+hro.toFixed(1)+'</b></td> '+
                       '<td align="center" class="add">'+(rph*hro).toFixed(1)+'</td>'+ 
                    '</tr>'+
                    '<tr>'+
                       '<td>Overtime</td> '+
                       '<td align="center">'+rph.toString()+'</td> '+
                       '<td align="center"><b>'+ovo.toFixed(1)+'</b></td> '+
                       '<td align="center" class="add">'+(rph*ovo).toFixed(1)+'</td>'+
                    '</tr>'+
                '</tbody>'+
            '</table> '+

            '<table class="table" id="addtd">'+
                '<thead>'+
                    '<tr><th>ADDITIONALS</th></tr>'+
                '</thead>'+
                '<tbody>'+         
                '</tbody>'+
            '</table>'+

            '<table class="table" id="deductbl">'+
                '<thead>'+
                    '<tr><th>DEDUCTIONS</th></tr>'+     
                '</thead>'+
                '<tbody>'+
                    '<tr>'+         
                       '<td>Tardiness</td>'+ 
                       '<td align="center">'+rph.toString()+'</td> '+
                       '<td align="center"><b>'+lto.toFixed(1)+'</b></td> '+
                       '<td align="center" class="deduc">'+(rph*lto).toFixed(1)+'</td>'+ 
                    '</tr>'+
                    '<tr>'+         
                       '<td>Undertime</td>'+ 
                       '<td align="center">'+rph.toString()+'</td> '+
                       '<td align="center"><b>'+uro.toFixed(1)+'</b></td> '+
                       '<td align="center" class="deduc">'+(rph*uro).toFixed(1)+'</td>'+ 
                    '</tr>'+
                '</tbody>'+
                '<tbody id="tbody2">'+
                '</tbody>'+
                '<tbody id="tbody3">'+
                '</tbody>'+
            '</table>'+

            '<table class="table">'+
               '<tbody>'+         
                    '<tr style="font-weight:bolder">'+
                        '<td></td>'+
                        '<td></td>'+
                       '<td align="right">Total Pay:  </td>'+ 
                       '<td id="tot" align="center"></td>'+ 
                    '</tr>'+
                '</tbody>'+
             
            '</table><div><button class="btn btn-sm btn-block btn-default" onclick="loan_stat('+emp1+');"><i class="fa fa-plus"> </i> Add Loan</button></div>');
    }

    function getaded(id, date){
        $.ajax({
            url : "<?php echo site_url('HumanP/getaded/')?>" + id+"/"+date,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#addtd tbody').empty();
                for(i=0; i<data.length;i++){
                    $('#addtd tbody').append('<tr><td>'+data[i]['description']+'</td>'+ 
                   '<td align="center"></td> '+
                   '<td align="center"></td> '+
                   '<td align="center" class="add">'+data[i]['amount']+'</td></tr>');
                };           
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
        $.ajax({
            url : "<?php echo site_url('HumanP/getded/')?>" + id+"/"+date,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#tbody2').empty();
                for(i=0; i<data.length;i++){
                    $('#tbody2').append('<tr><td>'+data[i]['description']+'</td>'+ 
                   '<td align="center"></td> '+
                   '<td align="center"></td> '+
                   '<td align="center" class="deduc">'+data[i]['amount']+'</td></tr>');
                };    
                thisisit(); 
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

    function displayded2(id, date){
        $('#tbody3').empty();
        $.ajax({
            url : "<?php echo site_url('HumanP/displayded2/')?>" + id+"/"+date,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                for(i=0; i<data.length;i++){
                    $('#tbody3').append('<tr><td>'+data[i]['description']+' <i class="fa fa-trash" onclick="loan_del('+data[i]['loan_payment_id']+','+id+')"></i></td>'+ 
                   '<td align="center"></td> '+
                   '<td align="center"></td> '+
                   '<td align="center" class="deduc">'+data[i]['amount_paid']+'</td></tr>');
                };           
            thisisit();
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

    function loan_history(id){ 
        $('#datatable-loans_pay').dataTable().fnDestroy();
        $('#modal_form5').modal('show'); 
        $('.modal-title3').text('Loan Payment History');

        var handleDataTableButtons3 = function() {
            if ($("#datatable-loans_pay").length) {
                table_loans_p = $("#datatable-loans_pay").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('HumanP/ajax_listpay/')?>" + id,
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
                            extend: "copy",
                            className: "btn-sm"
                        },{
                            extend: "csv",
                            className: "btn-sm"
                        },{
                            extend: "excel",
                            className: "btn-sm"
                        },{
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },{
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons3 = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons3();
                }
            };
        }();
        TableManageButtons3.init();
    }

    function loan_del(id, id2){
        if(confirm('Are you sure to delete this record?')){
            $.ajax({
                url : "<?php echo site_url('HumanP/loan_del/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    displayded2(id2,date1);         
                    thisisit();
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

    function getded2(id, emp_id){
        var op ='addi';
        if(confirm('Are you sure add this loan?')){
            $.ajax({
                url : "<?php echo site_url('HumanP/getded2/')?>" + id+"/"+date1,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    displayded2(emp_id,date1);         
                    thisisit();
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

    function thisisit(){
        var add=0;
        $('.add').each(function(){
            var value = $(this).text();
            if(value.length!=0){
                add += parseFloat(value);
           }
        });

        var ded=0;
        $('.deduc').each(function(){
            var value = $(this).text();
            if(value.length!=0){
                ded += parseFloat(value);
           }
        });
        
        $('#tot').empty();
        $('#tot').append((add-ded).toFixed(1));
    }
 
    function printDiv() {
        var divToPrint = document.getElementById('payslip');
        var htmlToPrint = '<style type="text/css"> table {table-layout: fixed; width:100%;margin: 5px; font-size:18px;height:100px;}thead{align:left;}td{width: 25%;}div{width:50%;}</style>';
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }

    function emp_additional(emp_id) {        
        save_method = 'add';        
        $('#form')[0].reset();
        $('#addnote').text(""); 
        $('[name="employee_id"]').val(emp_id);
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Additional in salary');        
    }

    $('#additional_id').change(function(){
        var id = $('#additional_id').val();
        if(id != 'undefined') {
            getAddNote(id);
        } else {
            $('#addnote').text("");               
        }
    });

    function getAddNote(id) {
       $.ajax({
            url : "<?php echo site_url('HumanP/getAdditionalNote/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#addnote').text(data[0].note);               
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

    function save() {
        $('#btnSave').text('Saving...'); 
        $('#btnSave').attr('disabled',true);  
        var url;
    
        if(save_method == 'add') {
            url = "<?php echo site_url('HumanP/ajax_add_additional')?>";
        } else {

        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    if(save_method == 'add'){
                        new PNotify({
                            title: 'Success!',
                            text: 'Information added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }else{
                        new PNotify({
                            title: 'Success!',
                            text: 'Information updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    $('#modal_form').modal('hide');                    
                    //window.location.reload();
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });
    }

    function emp_deduction(emp_id){
        save_method = 'add';        
        $('#form1')[0].reset();
        $('#addnote1').text(""); 
        $('[name="employee_id1"]').val(emp_id);
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form1').modal('show'); 
        $('.modal-title').text('Deduction in salary');        

    }

    $('#deduction_id').change(function(){
        var id1 = $('#deduction_id').val();
        if(id1 != 'undefined') {
            getDeducNote(id1);
        } else {
            $('#addnote1').text("");               
        }
    });

    $('#loanint').change(function(){
        let loanamt = $('#amt_loan').val();
        let loanint = $('#loanint').val();
        let addi = parseFloat(loanamt*(loanint/100));
        let terms = $('#loanterm').val();
        let totloan = parseFloat(loanamt) + parseFloat(addi);
        let deducamt = Math.round(totloan/terms * 100)/100;
        document.getElementById("deducamt").value = deducamt;
    });

    $('#loanterm').change(function(){
        let loanamt = $('#amt_loan').val();
        let loanint = $('#loanint').val();
        let addi = parseFloat(loanamt*(loanint/100));
        let terms = $('#loanterm').val();
        let totloan = parseFloat(loanamt) + parseFloat(addi);
        let deducamt = Math.round(totloan/terms * 100)/100;
        document.getElementById("deducamt").value = deducamt;
    });

    $('#amt_loan').change(function(){
        let loanamt = $('#amt_loan').val();
        let loanint = $('#loanint').val();
        let addi = parseFloat(loanamt*(loanint/100));
        let terms = $('#loanterm').val();
        let totloan = parseFloat(loanamt) + parseFloat(addi);
        let deducamt = Math.round(totloan/terms * 100)/100;
        if(deducamt == "Infinity") {
            document.getElementById("deducamt").value = loanamt;
        }else {
            document.getElementById("deducamt").value = deducamt;    
        }        
    });


    function getDeducNote(id){
        $.ajax({
            url : "<?php echo site_url('HumanP/getDeductionalNote/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#addnote1').text(data[0].note);               
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

    function save1() {
        $('#btnSave1').text('Saving...'); 
        $('#btnSave1').attr('disabled',true);  
        var url;
    
        if(save_method == 'add') {
            url = "<?php echo site_url('HumanP/ajax_add_deduction')?>";
        } else {

        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form1').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    if(save_method == 'add'){
                        new PNotify({
                            title: 'Success!',
                            text: 'Information added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }else{
                        new PNotify({
                            title: 'Success!',
                            text: 'Information updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    $('#modal_form1').modal('hide');                                        
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
                $('#btnSave1').text('save'); 
                $('#btnSave1').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                $('#btnSave1').text('save'); //change button text
                $('#btnSave1').attr('disabled',false); //set button enable 
            }
        });
    }

    function view_stat(emp_id) {
         get_profile(emp_id);
         data_table_additionals(emp_id);
         data_table_deductions(emp_id);
         $('#modal_form2').modal('show'); 
         $('.modal-title').text('Employee Status');
    }

    function get_profile(id){
      $.ajax({
      url : "<?php echo site_url('HumanP/get_employee_profile/')?>" + id,
      type: "GET",
      dataType: "JSON",
        success: function(data) {
            $('#emp_name').text(data[0].pworker_fname +" "+data[0].pworker_mname+ " "+data[0].pworker_lname);
            $("#img-emp").attr('src',data[0].worker_photo);  
        },
        error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                $('#btnSave1').text('save'); //change button text
                $('#btnSave1').attr('disabled',false); //set button enable 
            }
        });
            
    }

    function data_table_additionals(id) {
        var handleDataTableButtons1 = function() {
            if ($("#datatable-addts").length) {
                table_add = $("#datatable-addts").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('HumanP/ajax_list1/')?>" + id,
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
                            extend: "copy",
                            className: "btn-sm"
                        },{
                            extend: "csv",
                            className: "btn-sm"
                        },{
                            extend: "excel",
                            className: "btn-sm"
                        },{
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },{
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons1 = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons1();
                }
            };
        }();
        TableManageButtons1.init();
    }

    function data_table_deductions(id) {
        var handleDataTableButtons2 = function() {
            if ($("#datatable-deducs").length) {
                table_deduc = $("#datatable-deducs").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('HumanP/ajax_list2/')?>" + id,
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
                            extend: "copy",
                            className: "btn-sm"
                        },{
                            extend: "csv",
                            className: "btn-sm"
                        },{
                            extend: "excel",
                            className: "btn-sm"
                        },{
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },{
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons2 = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons2();
                }
            };
        }();
        TableManageButtons2.init();
    }

    function del_addt(addt_id) {
        if(confirm('Are you sure delete this data?')){
            $.ajax({
                url : "<?php echo site_url('HumanP/ajax_additional_delete')?>/"+addt_id,
                type: "POST",
                dataType: "JSON",
                success: function(data){                    
                    reload_table();
                    new PNotify({
                        title: 'Success!',
                        text: 'information deleted successfully.',
                        type: 'success',
                        styling: 'bootstrap3'
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

    function del_deduc(deduc_id) {
        if(confirm('Are you sure delete this data?')){
            $.ajax({
                url : "<?php echo site_url('HumanP/ajax_deduction_delete')?>/"+deduc_id,
                type: "POST",
                dataType: "JSON",
                success: function(data){                    
                    reload_table1();
                    new PNotify({
                        title: 'Success!',
                        text: 'information deleted successfully.',
                        type: 'success',
                        styling: 'bootstrap3'
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

    function reload_table(){
        table_add.ajax.reload(null,false); 
        table_loans.ajax.reload(null,false);  
    }

    function reload_table1(){
        table_deduc.ajax.reload(null,false);  
    }

    function reload_table3(){
        table_loans.ajax.reload(null,false);  
    }

     

    function getDeducLoan(id){
        $.ajax({
            url : "<?php echo site_url('HumanP/getDeductionalNote/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#loan_note').text(data[0].note);               
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

    $('#loan_id').change(function(){
        var id2 = $('#loan_id').val();
        if(id2 != 'undefined') {
            getDeducLoan(id2);
        } else {
            $('#loan_note').text("");               
        }
    });

    function add_loan(id) {        
        save_method = 'add';        
        $('#form_loan')[0].reset();
        $('#addnote').text(""); 
        $('#employee_id_loan').val(id);
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form3').modal('show'); 
        $('.modal-title').text('Add Loan');        
    }

    function save_loan() {
        $('#btnSave').text('Saving...'); 
        $('#btnSave').attr('disabled',true);  
        var url;
    
        if(save_method == 'add') {
            url = "<?php echo site_url('HumanP/ajax_add_loan')?>";
        } else {

        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_loan').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    if(save_method == 'add'){
                        new PNotify({
                            title: 'Success!',
                            text: 'Information added successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }else{
                        new PNotify({
                            title: 'Success!',
                            text: 'Information updated successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    $('#modal_form3').modal('hide');                    
                    //window.location.reload();
                }
                else{
                    for (var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });
    }

    $('#modal_form2').on('hidden.bs.modal', function () {
        $('#datatable-addts').dataTable().fnDestroy();
        $('#datatable-deducs').dataTable().fnDestroy();
        $('#datatable-loans').dataTable().fnDestroy();
    });

    $('#modal_form4').on('hidden.bs.modal', function () {
        $('#datatable-addts').dataTable().fnDestroy();
        $('#datatable-deducs').dataTable().fnDestroy();
        $('#datatable-loans').dataTable().fnDestroy();
    });

    
    function loan_stat(id) {
        if(op=="addi"){
            $('#dell').addClass('noprint');
        }
        get_profile_loan(id);
        data_table_loan(id);
        $('#modal_form4').modal('show'); 
        $('.modal-title').text('Employee Loan Status');
    }

    function get_profile_loan(id){
      $.ajax({
      url : "<?php echo site_url('HumanP/get_employee_profile/')?>" + id,
      type: "GET",
      dataType: "JSON",
        success: function(data) {
            $('#emp_name_loan').text(data[0].pworker_fname +" "+data[0].pworker_mname+ " "+data[0].pworker_lname);
            $("#img-emp_loan").attr('src',data[0].worker_photo);  
        },
        error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Error!',
                    text: 'A process cannot get through. Please consult your admin.',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                $('#btnSave1').text('save'); //change button text
                $('#btnSave1').attr('disabled',false); //set button enable 
            }
        });
    }

    function data_table_loan(id) {
        var handleDataTableButtons3 = function() {
            if ($("#datatable-loans").length) {
                table_loans = $("#datatable-loans").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('HumanP/ajax_list3/')?>" + id,
                        "type": "POST"
                    },
                    keys: true,
                    dom: "Bfrtip",
                    buttons: [{
                            extend: "copy",
                            className: "btn-sm"
                        },{
                            extend: "csv",
                            className: "btn-sm"
                        },{
                            extend: "excel",
                            className: "btn-sm"
                        },{
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },{
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons3 = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons3();
                }
            };
        }();
        TableManageButtons3.init();
    }

    function del_loan(id) {
        if(confirm('Are you sure delete this data?')){
            $.ajax({
                url : "<?php echo site_url('HumanP/ajax_loan_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){                    
                    $('#modal_form4').modal('hide');    
                    new PNotify({
                        title: 'Success!',
                        text: 'information deleted successfully.',
                        type: 'success',
                        styling: 'bootstrap3'
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

    function startcompute13(){
        var emp13 = $('#emp13').val(); 
        var month13 = $('#month13').val(); 
        var year13 = $('#year13').val(); 
        $("#table-manual-bonus tbody").empty();
        getWeeksStartAndEndInMonth(emp13,month13,year13,'monday');
        
    }

    function getWeeksStartAndEndInMonth(emp, month, year, _start) {
        let weeks = [],firstDate = new Date(year, month, 1), lastDate = new Date(year, month + 1, 0), numDays = lastDate.getDate();
        var c = Date();
        let start = 1;
        let end = 7 - firstDate.getDay();
        if (_start == 'monday') {
            if (firstDate.getDay() === 0) {
                end = 1;
            } else {
                end = 7 - firstDate.getDay() + 1;
            }
        }
        while (start <= numDays) {
            var businessWeekEnd = end-1
            if(businessWeekEnd > 0){
                if(businessWeekEnd > start){
                    weeks.push({start: start, end: businessWeekEnd});
                }
                else{ 
                    weeks.push({start: start, end: end});
                }
            }
            start = end + 1;
            end = end + 7;
            end = start === 1 && end === 8 ? 1 : end;
            if (end > numDays) {
                end = numDays;
            }
        }
        var count=0;
        $("#inc13").empty();
        $("#net13").empty();
        $("#to13").empty();
        $("#table-manual-13 tbody").empty();
        weeks.forEach(week => {
        var _s = parseInt(week.start, 10)+1,_e = parseInt(week.end,10)+1;
        var start = new Date(year, month, _s).toJSON().slice(0,10).split('/').reverse().join('-');
        var end = new Date(year, month, _e).toJSON().slice(0,10).split('/').reverse().join('-');
             
            var dates = [];
            $.ajax({
                url: "<?php echo site_url('HumanP/getdtr13/')?>" + emp+'/'+start+"/"+end,
                dataType: "JSON",
                success: function(data) {
                    count=start+" to "+end;
                    if(data.length>0){
                        $("#table-manual-13 tbody").empty();
                        var holder = '',holder2 = '' ;
                        var  holdert1='', holdert2='';
                        rph = data[0]['salary'];
                        for(i=0; i<data.length;i++){
                            if (holder != data[i]['desig_date']){

                                $("#table-manual-13 tbody").append("<tr>"+
                                    "<td >"+data[i]['desig_date']+"</td>"+
                                    "<td class='ini13' id='in13"+data[i]['desig_date']+"'></td>"+
                                    "<td class='outi13' id='out13"+data[i]['desig_date']+"'></td>"+
                                    "<td class='worki13' id='work13"+data[i]['desig_date']+"'></td>"+
                                    "<td class='latei13' id='late13"+data[i]['desig_date']+"'></td>"+
                                    "<td class='underi13' id='under13"+data[i]['desig_date']+"'></td>"+
                                '</tr>');                     
                            }
                            
                            
                            holder = data[i]['desig_date'];
                            dates[i] = holder;
                            for(j=0; j<data.length;j++){
                               
                                if (holder ==  data[j]['desig_date'] ){ 
                                    if((data[j]['time'] >= "06:00:00") &&(data[j]['time'] < "12:00:00") && (holdert1 == '')){
                                        $('#in13'+data[j]['desig_date']).empty();
                                        $('#in13'+data[j]['desig_date']).append(data[j]['dtime']+'');  
                                        holdert1 = data[j]['time']; 
                                    }     

                                   else if((data[j]['time'] >= "00:00:00") &&(data[j]['time'] < "06:00:00")){
                                        var t1 = new Date(data[j]['desig_date']);
                                        var toout2 = (moment(t1).subtract(1, 'days'));
                                        var t3 = moment(toout2).format('YYYY-MM-DD');
            
                                        $('#out13'+t3).empty();
                                        $('#out13'+t3).append(data[j]['dtime']+'');  
                                    }     

                                    else if((data[j]['time'] >= "12:00:00") && (data[j]['time'] <= "21:00:00") && (holdert2 == '')){
                                        $('#out13'+data[j]['desig_date']).empty();
                                        $('#out13'+data[j]['desig_date']).append(data[j]['dtime']+'');  
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
                            computelate13(results[j]);
                        }   
                        
                        bonustable(count, rph);
                    }
                    else{
                        $("#table-manual-bonus tbody").append('<tr>'+
                            '<td>'+count+'</td>'+
                            '<td>0 hr(s)</td>'+
                            '<td>0.00</td>'+
                            '<td>0.00</td>'+
                        '</tr>');
                    }
                }
            });
        });
        return weeks;
    }


    function computelate13(ate){
        var s = $('#in13'+ate).text();
        var o = $('#out13'+ate).text();
        var t1 = new Date(ate+" "+s);
        var t2 = new Date(ate+" "+o);
        var millisec = t2-t1; 
        var tin = new Date(ate+" "+"08:15:00");
        var tout = new Date(ate+" "+"17:00:00");
        var toin1 = new Date(ate+" "+"18:00:00");
        var toin = new Date(ate+" "+"19:30:00");
        var toout = new Date(ate+" "+"21:00:00");
    
        var wh = (tout-t1)/(1000*60*60);
        if (wh>=8){
            $('#work13'+ate).empty();
            $('#work13'+ate).append("8 hr(s)");
        }
        else{ 
            $('#work13'+ate).empty();
            $('#work13'+ate).append(wh.toFixed(1)+" hr(s)");
        }

         if(t1>tin){
            var dif = t1-tin;
            $('#late13'+ate).empty();
            $('#late13'+ate).append((dif/(1000*60*60)).toFixed(1)+" hr(s)");
        }
        else{
            $('#late13'+ate).empty();
            $('#late13'+ate).append("---"); 
        }   
        
        if(t2<tout){
            if(t2 > tin){
                var dif2 = tout-t2;
                $('#under13'+ate).empty();
                $('#under13'+ate).append((dif2/(1000*60*60)).toFixed(1)+" hr(s)");
            }
            else{
                $('#under13'+ate).empty();
                $('#under13'+ate).append("---"); 
            } 
        }
        else{
            $('#under13'+ate).empty();
            $('#under'+ate).append("---"); 
        }  

        if((s=='')||(o=='')){
            $('#work13'+ate).empty();
            $('#work13'+ate).append("---"); 
             $('#late13'+ate).empty();
            $('#late13'+ate).append("---"); 
            $('#under13'+ate).empty();
            $('#under13'+ate).append("---"); 
        }    
    }

    function bonustable(count, sal){
        var ovo=0;
        $('.worki13').each(function(){
            var value = $(this).text();

            if(value.length!=0 && value!='---'){
                ovo += parseFloat(value);
           }
        });

         var lto=0;
        $('.latei13').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                lto += parseFloat(value);
            }
        });

        $('.underi13').each(function(){
            var value = $(this).text();
            if(value.length!=0 && value!='---'){
                lto += parseFloat(value);
            }
        });

        var dtot=0;
        dtot =  lto.toFixed(1)*(sal);
        $("#table-manual-bonus tbody").append('<tr>'+
            '<td>'+count+'</td>'+
            '<td  class="cto13">'+ovo.toFixed(1)+" hr(s)"+'</td>'+
            '<td  class="cnet13">'+((ovo*sal)-dtot).toFixed(1)+'</td>'+
            '<td  class="cinc13">'+(((ovo*sal)-dtot)/12).toFixed(1)+'</td>'+
            '</tr>');
        getall();
    }

    function getall(){
        var ovo=0;
        $('.cto13').each(function(){
            var value = $(this).text();

            if(value.length!=0 && value!='---'){
                ovo += parseFloat(value);
           }
        });
        $("#to13").empty();
        $("#to13").append(ovo+" hrs");

        var ovo2=0;
        $('.cnet13').each(function(){
            var value = $(this).text();

            if(value.length!=0 && value!='---'){
                ovo2 += parseFloat(value);
           }
        });
        $("#net13").empty();
        $("#net13").append(ovo2.toFixed(1));

        var ovo3=0;
        $('.cinc13').each(function(){
            var value = $(this).text();

            if(value.length!=0 && value!='---'){
                ovo3 += parseFloat(value);
           }
        });
        $("#inc13").empty();
        $("#inc13").append(ovo3.toFixed(1));
        sortTable();
    }
 
    function sortTable() {
      var table, rows, switching, i, x, y, shouldSwitch;
      table = document.getElementById("table-manual-bonus");
      switching = true;
      /*Make a loop that will continue until
      no switching has been done:*/
      while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
          //start by saying there should be no switching:
          shouldSwitch = false;
          /*Get the two elements you want to compare,
          one from current row and one from the next:*/
          x = rows[i].getElementsByTagName("TD")[0];
          y = rows[i + 1].getElementsByTagName("TD")[0];
          //check if the two rows should switch place:
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
        if (shouldSwitch) {
          /*If a switch has been marked, make the switch
          and mark that a switch has been done:*/
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
        }
      }
    }
</script>
