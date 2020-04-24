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
    .dataTables_filter {
        float: left !important;
    }
    
    td   .fc-da
    }
    fontbox-eight"
</style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daily Time Record
      </h1>
      <ol class="breadcrumb">
        <li><a href="HumanR"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <a href="HumanDTR">Calendar</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-info ">
                    <div class="box-body">

                        <label >Select Project to view list.</label>
                        <div class = "form-group input-group">
                            <span class="input-group-addon"><i class=" fa fa-book"></i></span>
                            <select id = "prjselect"  class="form-control">
                                <option></option>
                                <?php foreach($projects as $each){ ?>
                                    <option value="<?php echo $each->project_code; ?>"><?php echo $each->project_title; ?></option>';
                                <?php } ?>
                            </select>
                        </div>
                     
                        <table id="datatable-dtrlist" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          
            <div class="col-md-8">
            
                <div class="box box-info">
                    <div class="box-header"> 
                        <h3 class="box-title"  id="dtrtitle">Daily Time Record for - (Employee name)</h3>
                        
                    </div>
                    <div class="box-body no-padding">
                        <div class="clearfix"></div>
                        <div id="calendardtr"></div>
                    </div>
                </div>
            
            </div>
        </div>
    </section>
</div>


  <script type="text/javascript">
    var table4;
    var t;

    $(document).ready(function() {
        $('#emlist').attr("class","treeview active");
        $('#hdtr').attr("class","active");
 
        $('#prjselect').change(function() {
            var projectSelected = $(this).val();
            t = $("#prjselect option:selected").text();
            filltable(projectSelected, t);
        });
    });

 


    function filltable(id){
        $("#datatable-dtrlist").dataTable().fnDestroy();
        table4 = $("#datatable-dtrlist").DataTable({
            ajax: {
                "url": "<?php echo site_url('HumanDTR/ajax_list')?>/"+id,
                "type": "POST"
            },
            order: [[1, 'asc']],
            keys: true,
            dom: 'frtip',
            language: { 
                searchPlaceholder: "Search Id or Name"
            },
            responsive: true
        });
    }

    function trya($q){
        alert($q);
    }

    function loadCalendar($id2, $n1, $n2, $n3){
        $id = $id2;
        $nf = $n2;
        $nl = $n1;
        $n33 = $n3;
        $('#calendardtr').fullCalendar( 'refetchEvents' );
        $('#calendardtr').fullCalendar({
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
                    url: "<?php echo site_url('HumanDTR/getdtr/')?>" + $id +"/"+$n33,
                    success: function(doc) {

                        if(doc.length>2){
                            var obj = jQuery.parseJSON(doc);
                            var events = [];
                            $.each(obj, function(index, value) {
                                
                            $('#dtrtitle').text($nl+', '+$nf+'  @  Project: ' + t);
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
                //alert(calEvent.id + " "+ calEvent.title + " " + calEvent.start.format('DD/MM/YYYY') + " to " + calEvent.end.format('DD/MM/YYYY'));
                editsched(calEvent.id, calEvent.title, calEvent.start.format('MM/DD/YYYY h:mm A') + " - " + calEvent.end.format('MM/DD/YYYY h:mm A'), calEvent.color);
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