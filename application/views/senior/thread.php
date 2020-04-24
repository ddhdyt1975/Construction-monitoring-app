<?php
     $logged_in = $this->session->userdata['logged_in']['user_id']; 
     $position = $this->session->userdata['logged_in']['position'];

    if(empty($logged_in))    {
        $this->session->set_flashdata('error', 'Session has Expired');
        redirect('auth');
    } 
    if($position == 'hr') {
        redirect('HumanR');
    }else if($position == 'ut1') {
        redirect('Admin');
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
         Thread
      </h1>
      <ol class="breadcrumb">
         <li><a href="ManagerM"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Thread</li>
      </ol>
   </section>

   <section class="content">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 "> 
                <div class="box box-default" style="max-height:1000px;height:650px;overflow-y:auto;">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Latest Activities</h3>
                    </div>
                    <div class="box-body" >
                        <ul class="timeline timeline-inverse" id="seeact_id"> 
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-8  ">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Thread Details </h3>
                        <div class = "pull-right"> <button id = "create" onclick="view_create()" class = "btn btn-sm btn-success"><i class="fa fa-plus"></i> Create Thread</button></div>
                    </div>
                    <div class="box-body">
                        <div id="activity" style="display:none;max-height:500px;">
                        </div>
                        <div id ="post_div">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-lg-1">
                                        <img class = "form-control img-md  img-bordered-sm" src="<?php echo $user_info->user_photo?>"/>
                                    </div> 
                                    <div class="col-lg-11">
                                        <div class="form-group">
                                            <div class = "row">
                                                <div class="col-lg-12">
                                                    <form id="post_form">
                                                        <textarea class="form-control input-sm" id="post_mes" name="post_mes" placeholder="<?php echo $user_info->user_fname?>, Any idea?"></textarea>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 pull-right">
                                                <button type="submit" onclick="addPost()" class="form-control btn btn-danger btn-sm">Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div id ="comment_div" style="display:none;" >
                            <div class="page-header"></div>
                            <div class="row">
                                   <div class="input-group margin">
                                    <span class="input-group-btn">
                                       <img class = "form-control img-sm  img-bordered-sm" src="<?php echo $user_info->user_photo?>"/>
                                    </span>
                                    <form id="reply_form" class="form-horizontal">
                                        <input type="text" class="form-control " id="reply_mes" name="reply_mes" placeholder="Reply">
                                    </form>
                                    <span class="input-group-btn">
                                      <button type="submit" id = "btn-chat"  onclick="addReply()" class="btn btn-success btn-flat-sm">Send!</button>
                                    </span>
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
   var month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
   var month2 = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
   var days = ["Sunday","Monday","Tuesday", "Wednesday","Thursday","Friday","Saturday"];
   var tid1, tid2;


    $(document).ready(function(){
        $('#reply_mes').keypress(function(e) {
          if(e.which == 13) {
            $('#btn-chat').click();
            return false;
          }
        });
        seeAct();
    });

    window.setInterval(function(){
        newC();
    }, 1000);

    function view_create(){
        tid1 = null;
        tid2 = null;
        $('#activity').hide();
        $('#comment_div').hide();
        $('#post_div').show();
    }

    function addPost(){
        $.ajax({
            url : "<?php echo site_url('ThreadM/addPost/')?>",
            type: "POST",
            data: $('#post_form').serialize(),
            dataType: "JSON",
            success: function(data) {
                $('#post_form')[0].reset(); 
                seeAct();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Oh no!',
                    text: 'Error in adding reply.',
                    type: 'error',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
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

    function sortByKey2(array, key) {
        return array.sort(function(a, b) {
            var x = a[key];
            var y = b[key];
            return ((x > y) ? 1 : ((x < y) ? -1 : 0));
        });
    }

    function addReply(){
        if ( $("#reply_mes").val()!=""){
            $.ajax({
                url : "<?php echo site_url('ThreadM/addReply/')?>"+tid1,
                type: "POST",
                data: $('#reply_form').serialize(),
                dataType: "JSON",
                success: function(data) {
                    $('#reply_form')[0].reset(); 
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    new PNotify({
                        title: 'Oh no!',
                        text: 'Error in adding reply.',
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

    function newC(){
        $.ajax({
            url : "<?php echo site_url('ThreadM/getLst/')?>"+tid1+"/"+tid2,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                for(i=0; i<data.length;i++){
                    data = sortByKey2(data, 'udate');
                    var d3 = new Date(data[i]['udate']);
                    $('#comments').append('<ul style="list-style: none; padding:0"><li ><img class = "img-sm  img-bordered-sm" src="'+data[i]['uphoto']+'"/>&nbsp;<a> <b>'+data[i]['uName']+'</b></a>&nbsp;&nbsp;<small class ="time pull-right">'+d3.getDate()+' '+month2[d3.getMonth()]+'. '+d3.getFullYear()+', '+data[i]['time2']+'</small><ol><p>'+data[i]['umes']+'</p></ol></li></ul>');
                    tid2 = data[i]['thread_id2'];
                };
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Pssst!',
                    text: 'Error in getting latest activities.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
            }
        });  
    }

    function seeComments(id){
        $('#comments').empty();

        $.ajax({
            url : "<?php echo site_url('ThreadM/seeActD/')?>"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data) { 
                for(i=0; i<data.length;i++){
                    data = sortByKey2(data, 'udate2');
                    var d2 = new Date(data[i]['udate2']);
                    $('#comments').append('<ul style="list-style: none; padding:0"><li ><img class = "img-sm  img-bordered-sm" src="'+data[i]['uphoto']+'"/>&nbsp;<a> <b>'+data[i]['uName']+'</b></a>&nbsp;&nbsp;<small class ="time pull-right">'+d2.getDate()+' '+month2[d2.getMonth()]+'. '+d2.getFullYear()+', '+data[i]['time2']+'</small><ol><p>'+data[i]['umes']+'</p></ol></li></ul>');
                    tid2 = data[i]['thread_id2'];
                };
               
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Pssst!',
                    text: 'Error in getting latest activities.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
            }
        });  
    }

    function seeActD(id, mes, user, date , photo){
        $('#post_div').hide();
        $('#comment_div').show();
        $('#activity').show();
        $('#activity').empty();
          $('#activity').append('<div class="post" >'+
            '<div class="user-block">'+
               '<img class="img-circle-md  img-bordered-sm" src="'+photo+'" alt="user image">'+
               '<span class="username">'+
                 '<a >'+user+'</a>'+
               '</span>'+
               '<span class="description">Shared publicly - '+date+'</span>'+
            '</div>'+
            '<p>'+mes+
        '</p><div class="page-header"></div><div id ="comments" style="height:400px;overflow-y:auto;"></div>');
        tid1 =id;
        seeComments(id);
        
    }

    function seeAct(){
        $('#seeact_id').empty();
        $.ajax({
            url : "<?php echo site_url('ThreadM/seeAct/')?>",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                for(i=0; i<data.length;i++){
                    data = sortByKey(data, 'thread_date');
                    var d = new Date(data[i]['thread_date']);
                    if (data[i]['thread_type']=='text'){
                        $('#seeact_id').append('<li class="time-label">'+
                            '<span class="bg-red">'+d.getDate()+' '+month2[d.getMonth()]+'. '+d.getFullYear()+', '+days[d.getDay()]+'</span>'+
                            '</li>'+
                            '<li>'+
                            '<i class="fa fa-file-text-o bg-blue"></i>'+
                            '<div class="timeline-item">'+
                               '<span class="time"><i class="fa fa-clock-o"></i> '+data[i]['time']+'</span>'+
                               '<h3 class="timeline-header"><a href="#">'+data[i]['user_fname']+' '+data[i]['user_lname']+'</a> <small>posted</small></h3>'+
                               '<div class="timeline-body notification"> <a onclick =  "seeActD('+"'"+data[i]['thread_id']+"'"+', '+"'"+data[i]['thread_message']+"'"+', '+"'"+data[i]['user_fname']+' '+data[i]['user_lname']+"'"+', '+"'"+d.getDate()+' '+month2[d.getMonth()]+' '+d.getFullYear()+' '+days[d.getDay()]+"'"+', '+"'"+data[i]['user_photo']+"'"+');">'+data[i]["thread_message"] +'</a></div>'+
                            '</div>'+
                        '</li>');
                    }
                };
            $('#seeact_id').append(' <li><i class="fa fa-clock-o bg-gray"></i></li>');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Pssst!',
                    text: 'Error in getting latest activities.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
            }
        });  
    }
</script>