<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title >obraOne - Construction  Project Monitoring</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url()?>assets/favicon.png"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/all/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/pace/pace.min.css">
    <script src="<?= base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <link href="<?= base_url() ?>assets/all/pnotify.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/datatables.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/pnotify.buttons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/pnotify.nonblock.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">
    <link href="<?= base_url() ?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">


</head>
 <style type="text/css">
    body {
        font-size: 14px ;
    }

    div.dt-buttons{
        position:relative;
        float:left;
    }
    
</style>
<body  class="hold-transition skin-black sidebar-mini fixed ">
    <div class="wrapper">
        <header class="main-header">
            <a href="Admin" class="logo">
                <span class="logo-mini"><center><img  style="width:100%" src="<?php echo $user_info->path; ?>"></center></span>
                <span class="logo-lg"><b><?php echo $user_info->company_name; ?></b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo $user_info->user_photo?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $user_info->user_fname; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo $user_info->user_photo?>" class="img-circle" alt="User Image">
                                    <p>
                                      <?php echo $user_info->user_fname; ?> <?php echo $user_info->user_mname; ?> <?php echo $user_info->user_lname; ?>
                                      <small>Member since <?php echo $user_info->ddate; ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a  href="<?= base_url('Profiles') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>

                                    <div class="pull-right">
                                        <a  href="<?= base_url('Auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                       
                       <!--  <li class="dropdown messages-menu" >
                            <a   class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success" id="mes"> </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" id ="mes2"> </li>
                                <li>
                                    <ul class="menu" id ="ul_id">
                                        
                                    </ul>
                                </li>
                                <li class="footer"><a href="<?= base_url('RequestsM') ?>">See All Messages</a></li>
                            </ul> 
                        </li>
                        
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning" id = "notif1"> </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" id = "notif2"> </li>
                                <li>
                                    <ul class="menu" id ="ul_notification">
                                        
                                    </ul>
                                </li>
                                <li class="footer"><a href="<?= base_url('RequestsM') ?>">View all</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown tasks-menu hidden">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-flag-o"></i>
                              <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                              </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="" data-toggle="control-sidebar"><i class=""></i></a>
                        </li>
                        <li>
                            <a href="" data-toggle="control-sidebar"><i class=""></i></a>
                        </li> -->
                    </ul>
                </div>
            </nav>
        </header>
       <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel" >
                    <div class="pull-left image">
                        <img src="<?php echo $user_info->user_photo ?>" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <h4><p align="center"> <small><b><?php echo $user_info->user_fname; ?>  <?php echo $user_info->user_lname; ?> </b></p></h4>   
                        <p><i class="fa fa-circle text-success"></i> <?php echo $user_info->usertype_name; ?></p></small>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <ul class="sidebar-menu">
                    <li class="header" align="center"><b>MAIN NAVIGATION</b></li>
                    <li  id= "oa" >
                        <a href="<?= base_url('Admin') ?>"><i class="fa fa-dashboard fa-fw"></i> <span >Overview</span ></a>
                    </li>
                    <li  id= "pa" >
                        <a href="<?= base_url('Projects') ?>"><i class="fa fa-book fa-fw"></i> <span >Project's Dashboard</span ></a>
                    </li>
                    <li  id= "ea" >
                        <a href="<?= base_url('Equipments') ?>"><i class="fa fa-wrench fa-fw"></i><span > Equipments/Tools</span ></a>
                    </li>
                    <li  id= "sa" >
                        <a href="<?= base_url('Suppliers') ?>"><i class="fa fa-truck fa-fw"></i><span > Suppliers</span ></a>
                    </li>
                    <li  id= "ma" >
                        <a href="<?= base_url('Materials') ?>"><i class="fa fa-briefcase fa-fw"></i><span > Materials</span ></a>
                    </li>
                    <li  id= "ua" >
                        <a href="<?= base_url('Users') ?>"><i class="fa fa-users fa-fw"></i> <span >Users</span ></a>
                    </li>
                    <li  id= "ra" >
                        <a href="<?= base_url('Reports') ?>"><i class="fa fa-print fa-fw"></i> <span >Reports</span ></a>
                    </li>
                    <li  id= "ps" >
                        <a href="<?= base_url('Payroll') ?>"><i class="fa fa-user fa-fw"></i> <span >Payroll Settings</span ></a>
                    </li>
                    <li  id= "sea" >
                        <a href="<?= base_url('Settings') ?>"><i class="fa fa-print fa-gears"></i> <span >Settings</span ></a>
                    </li>
                </ul>
            </section>
        </aside>

<!--script type="text/javascript">
    var month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var month2 = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    
    $(document).ready(function(){
        viewMessageCount();
        viewMessages();
        viewNotifCount();
        viewNotifications();
    });

    window.setInterval(function(){
        viewMessageCount();
        viewMessages();
        viewNotifCount();
        viewNotifications();
    }, 10000);

    function sortByKey(array, key) {
        return array.sort(function(a, b) {
            var x = a[key];
            var y = b[key];
            return ((x < y) ? 1 : ((x > y) ? -1 : 0));
        });
    }


    function viewMessageCount(){
        $('#mes').empty();
        $('#mes2').empty();
        $('#mes3').empty();
        var url = "<?php echo site_url('RequestsM/countrecr')?>";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != 0){
                    $('#mes').append(data);
                    $('#mes2').append('You have '+data+' new message(s)');
                    $('#mes3').append(data);
                }
                else {
                    $('#mes').append(' ');
                    $('#mes2').append('You have no new message');
                    $('#mes3').append(data);
                }             
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Psst!',
                    text: 'Something happen in getting messsages in database.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
            }
        }); 
    }

    function viewNotifCount(){
        $('#notif1').empty();
        $('#notif2').empty();
        var url = "<?php echo site_url('ManagerM/countnotif')?>";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != 0){
                    $('#notif1').append(data);
                    $('#notif2').append('You have '+data+' new notification(s)');
                }
                else {
                    $('#notif1').append(' ');
                    $('#notif2').append('You have no new notification');
                }             
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Psst!',
                    text: 'Something happen in getting messsages in database.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
            }
        }); 
    }

    function viewMessages(){
        $('#ul_id').empty();
        var url = "<?php echo site_url('RequestsM/viewmessage')?>";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != null){
                data = sortByKey(data, 'req_date');
                    for(i=0; i<data.length;i++){
                        if (data[i]['seen_date']!=null){
                            var d = new Date(data[i]['req_date']);
                            $('#ul_id').append('<li>'+
                                '<a href="<?php echo site_url("RequestsM")?>">'+
                                    '<div class="pull-left">'+
                                        '<img src="'+data[i]['user_photo']+'" class="img-circle" alt="User Image">'+
                                    '</div>'+
                                    '<h4>'+data[i]['user_fname']+' '+data[i]['user_lname']+ 
                                    '<small><i class="fa fa-clock-o"></i> '+data[i]['time']+', '+d.getDate()+' '+month2[d.getMonth()]+'. </small>'+
                                    '</h4>'+
                                    '<p>Requested from '+data[i]['project_title']+' to '+data[i]['p1']+'</p>'+
                                '</a>'+
                            '</li>');
                        }
                        else{
                            var d = new Date(data[i]['req_date']);
                            $('#ul_id').append('<li>'+
                                '<a href="<?php echo site_url("RequestsM")?>">'+
                                    '<div class="pull-left">'+
                                        '<img src="'+data[i]['user_photo']+'" class="img-circle" alt="User Image">'+
                                    '</div>'+
                                    '<h4><b>'+data[i]['user_fname']+' '+data[i]['user_lname']+ 
                                    '</b><small><i class="fa fa-clock-o"></i> '+data[i]['time']+', '+d.getDate()+' '+month2[d.getMonth()]+'.</small>'+
                                    '</h4>'+
                                    '<p>Requested from '+data[i]['project_title']+' to '+data[i]['p1']+'</p>'+
                                '</a>'+
                            '</li>');
                        }
                    };  
                    
                }
                else {
                
                }             
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Psst!',
                    text: 'Something happen in getting messages in database.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
            }
        }); 
    }

    function viewNotifications(){
        $('#ul_notification').empty();
        var url = "<?php echo site_url('ManagerM/viewnotification')?>";
        $.ajax({
            url : url,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                if (data != null){
                    for(i=0; i<data.length;i++){
                        $('#ul_notification').append('<li>'+
                            '<a href="<?php echo site_url("RequestsM")?>">'+
                            '<i class="fa fa-refresh text-aqua"></i> Task "'+data[0]['projtsk_name']+'" in project "'+data[0]['project_title']+'" is updated by '+data[0]['updated_by']+' to '+data[0]['updated_percent'] +'%.'+
                            '</a>'+
                        '</li>');
                    };  
                    
                }
                else {
                
                }             
            },
            error: function (jqXHR, textStatus, errorThrown){
                new PNotify({
                    title: 'Psst!',
                    text: 'Something happen in getting Notification in database.',
                    type: 'warning',
                    styling: 'bootstrap3',
                    nonblock: {
                        nonblock: true
                    }
                }); 
            }
        }); 

    }

</script-->


<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title >Konstrak - Construction  Project Monitoring</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/all/codebox.jpg"/>
    <link href="<?= base_url() ?>assets/all/metisMenu.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/bootstrap.min.css" rel="stylesheet">
     <link href="<?= base_url() ?>assets/all/nprogress.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/green.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/scroller.bootstrap.min.css" rel="stylesheet">
   <script src="<?= base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <link href="<?= base_url() ?>assets/all/pnotify.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/dataTables.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/pnotify.buttons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/pnotify.nonblock.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
       <link href="<?= base_url() ?>assets/all/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/normalize.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/custom.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/dataTables.min.css" rel="stylesheet">
 
 
       
    <style type="text/css">

th { font-size: 14px; }
td { font-size: 12px; }
    </style>
  </head>

<body class="nav-md">
  <div class="container body ">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url('Admin') ?>" class="site_title"><i class="fa fa-building"></i> <span> Konstrak</span></a>
          </div>

          <div class="clearfix"></div>
            <div class="profile">
              <div class="profile_pic">
                <img src="<?php echo $userdata->user_photo?>"  class="img-circle  profile_img" style="width:120%;height:100px;">
              </div>
              <div class="profile_info" align="center">
                <span>Welcome,</span>
                  <h2><?php
                      echo  $userdata->user_fname.' '.$userdata->user_lname;
                  ?>  
                 </h2>
              </div>
            </div>
 
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
              <div class="menu_section" align="center">
                <h3><?php echo $userdata->usertype_name  ?></h3>
                </div>
                <div class="menu_section">
                <ul class="nav side-menu">
                  <li>
                      <a id= "o" href="<?= base_url('Admin') ?>"><i3 class="fa fa-dashboard fa-fw"></i3> Overview</a>
                  </li>
                  <li>
                      <a href="<?= base_url('Projects') ?>"><i3 class="fa fa-book fa-fw"></i3> Project's Dashboard</a>
                  </li>
                 <!--  <li>
                      <a href="<?= base_url('Attendance') ?>"><i3 class="fa fa-edit fa-fw"></i3> Attendance</a>
                  </li> -->
                  <!--li>
                      <a href="<?= base_url('Equipments') ?>"><i3 class="fa fa-wrench fa-fw"></i3> Equipments</a>
                  </li>
                  <li>
                      <a href="<?= base_url('Suppliers') ?>"><i3 class="fa fa-truck fa-fw"></i3> Suppliers</a>
                  </li>
                  <li>
                      <a href="<?= base_url('Materials') ?>"><i3 class="fa fa-briefcase fa-fw"></i3> Materials</a>
                  </li>
                  <li>
                      <a href="<?= base_url('Users') ?>"><i3 class="fa fa-users fa-fw"></i3> Users</a>
                  </li>
                  <li>
                      <a href="<?= base_url('Reports') ?>"><i3 class="fa fa-print fa-fw"></i3> Reports</a>
                  </li>
                </ul>
              </div>
            </div>
            
            <div class="sidebar-footer hidden-small">
              
            </div>
            <!-- /menu footer buttons -->
          <!--/div>
      </div>

        <!-- top navigation -->
      <!--div class="top_nav">
        <div class="nav_menu menu ">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <img src="<?php echo $userdata->user_photo?>"  ><?php echo  $userdata->user_fname.' '.$userdata->user_mname.' '.$userdata->user_lname; ?>&nbsp;
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="<?= base_url('Profiles') ?>"> Profile</a></li>
                    
                  <li><a href="<?= base_url('auth/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>

               
            </ul>
          </nav>
        </div>
      </div>
    </div>-->