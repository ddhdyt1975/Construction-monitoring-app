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
            Employee Information
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="HumanR"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="HumanEI"><i class="fa fa-user"></i> Employee Info</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            
            <div class="col-lg-12">
                <label>Select Employee </label>
                <div class = "form-group input-group">
                    <span class="input-group-addon"><i class=" fa fa-user"></i></span>
                    <select id = "empselect"  class="form-control select2">
                        <option></option>
                        <?php foreach($emp_info as $each){ ?>
                            <option value="<?php echo $each->pworker_id; ?>"><?php echo $each->pworker_lname; ?>, <?php echo $each->pworker_fname; ?>  <?php echo $each->pworker_mname; ?></option>';
                        <?php } ?>
                    </select>
                </div>
            </div>            
 
            <div class="col-lg-12" id="divi">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Employee Information</a></li>
                        <li><a href="#settings" data-toggle="tab">DTR History</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="row">
                                <div class="col-lg-6" align="center" id="eiphoto" name="eiphoto">
                                    <img src="<?php echo ('assets/user.png')?>">    
                                </div>
                                <div class="col-lg-6">
                                    <h4 align="center"><strong>Basic Information</strong></h4>
                                    <h4 id="eiid" name="eiid">ID: </h4>
                                    <h4 id="einame" name="einame">Name: </h4>
                                    <h4 id="eigender" name="eigender">Gender: </h4>
                                    <h4 id="eidob" name="eidob">Date of Birth: </h4>
                                    <h4 id="eitype" name="eitype">Worker Type: </h4>
                                    <h4 id="eistat" name="eistat">Status: </h4>
                                    <h4 id="eicont" name="eicont">Contact #: </h4>
                                    <h4 id="eiadd" name="eiadd">Address: </h4>
                                    <h4 align="center"><strong>Other Information</strong></h4>
                                    <h4 id="eisss" name="eisss">SSS: </h4>
                                    <h4 id="eiphil" name="eiphil">PHILHEALTH: </h4>
                                    <h4 id="eipag" name="eipag">PAG_IBIG: </h4>
                                    <h4 id="eitin" name="eitin"> TIN: </h4>
                                    <h4 id="eiacc" name="eiacc">ACCT NO: </h4>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="settings">
                            <div class="row">
                                <div class="col-lg-4">
                                    <table id="datatable-emp-dtrlist" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Project</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-8">
                                    <div class="box ">
                                        <div class="box-header"> 
                                            <h3 class="box-title"  id="dtrtitle">Daily Time Record</h3>
                                            
                                        </div>
                                        <div class="box-body no-padding">
                                            <div class="clearfix"></div>
                                            <div id="calendarempdtr"></div>
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

<script type="text/javascript">
    var emp;

    $('#empselect').change(function() {
        emp = $(this).val();
        viewprofile(emp);
        filltable(emp);
        loadCalendar(emp);
    });

    $(document).ready(function() {
        $('#emlist').attr("class","treeview active");
        $('#hprof').attr("class","active");
        $('#divi').hide();
    });

    function viewprofile(id){
        $('#divi').hide();
        $('#divi').show();
        $.ajax({
            url : "<?php echo site_url('HumanEI/getEmp/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){

                $('[name="eiid"]').text('ID: '+data.pworker_id);
                $('[name="einame"]').text('Name: '+data.pworker_fname+' '+data.pworker_mname+' '+data.pworker_lname);
                $('[name="eigender"]').text('Gender: '+data.pworker_gender);
                $('[name="eidob"]').text('Date of Birth: '+data.dob);
                $('[name="eicont"]').text('Contact #: '+data.contact_no);
                $('[name="eiadd"]').text('Address: '+data.pworker_add+', '+data.city_name+', '+data.province_name);
                $('[name="eisss"]').text('SSS #: '+data.sss);
                $('[name="eipag"]').text('PAG_IBIG #: '+data.pag_ibig);
                $('[name="eiphil"]').text('PHILHEALTH #: '+data.philhealth);
                $('[name="eitin"]').text('TIN #: '+data.philhealth);
                $('[name="eiacc"]').text('BANK #: '+data.bank_no);
                $('[name="eistat"]').text('Status: '+data.status);
                $('[name="eitype"]').text('Worker Type: '+data.description);
                $('[name="eiphoto"]').empty();
                $('[name="eiphoto"]').append('<h4 align="center"><strong>Photo</strong></h4><img src="'+data.worker_photo+'" width="50%"/>'); 

            }
        }); 
    }

    function filltable(id){
        $("#datatable-emp-dtrlist").dataTable().fnDestroy();
        table4 = $("#datatable-emp-dtrlist").DataTable({
            ajax: {
                "url": "<?php echo site_url('HumanEI/ajax_list')?>/"+id,
                "type": "POST"
            },
            keys: true,
            dom: 'frtp',
            language: { 
                searchPlaceholder: "Search Id or Name"
            },
            responsive: true
        });
    }
        

    function loadCalendar($id2){
        $id = $id2;
         
        $('#calendarempdtr').fullCalendar( 'refetchEvents' );
        $('#calendarempdtr').fullCalendar({
            header: {
                left: 'prev,next,today',
                center: 'title',
                right: 'month,basicWeek,agendaDay'
            },
            
            buttonText: {
                today: 'today',
                month: 'month', 
                week: 'week', 
                day: 'day'
            },

            
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: "<?php echo site_url('HumanEI/getdtr/')?>" + $id,
                    success: function(doc) {

                        if(doc.length>2){
                            var obj = jQuery.parseJSON(doc);
                            var events = [];
                            $.each(obj, function(index, value) {
                                
                                 if((value['time'] > "06:00:00") && (value['time'] < "11:00:00")){
                                    events.push({
                                        id: value['pworker_id'],
                                        title: 'In: '+value['dtime'],
                                        start: value['desig_date'],
                                        end: value['desig_date'],
                                        backgroundColor: "#00a65a", 
                                        borderColor: "#00a65a" 
                                    });
                                }
                                else{
                                    events.push({
                                        id: value['pworker_id'],
                                        title: 'Out: '+value['dtime'],
                                        start: value['desig_date'],
                                        end: value['desig_date'],
                                        backgroundColor: "#de1035", 
                                        borderColor: "#de1035"
                                    });
                                } 
                            });
                            callback(events);
                        }
                        else{
                            new PNotify({
                                title: 'Error!',
                                text: 'DTR not found. Please make sure .dat file uploaded.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }
                    },
                    error: function(e, x, y) {
                        new PNotify({
                            title: 'Error!',
                            text: 'A process cannot get through. Please consult your admin.'+e+x+y,
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    }
                });
            },

            eventClick: function(calEvent, jsEvent, view) {
                //alert(calEvent.id + " "+ calEvent.title + " " + calEvent.start + " to " + calEvent.end);
                //editsched(calEvent.id, calEvent.title, calEvent.start.format('MM/DD/YYYY h:mm A') + " - " + calEvent.end.format('MM/DD/YYYY h:mm A'), calEvent.color);
            },

            editable: true,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            buttonIcons: true, // show the prev/next text
            weekNumbers: false,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            fixedWeekCount: false,
            showNonCurrentDates: false 
            
        });
    }

</script>


