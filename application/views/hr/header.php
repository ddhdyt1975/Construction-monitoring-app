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
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <link rel="stylesheet" href="<?= base_url() ?>assets/daterangepicker.css">
      <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
    
</head>
 <style type="text/css">
    body {
        font-size: 13px ;
        color: black;
    }

    div.dt-buttons{
        position:relative;
        float:left;
    } 
    .img-emp {
        width: 100%;
        max-width: 150px;
        height: 100%;
        max-height: 150px;
    } 
</style>
<body  class="hold-transition skin-black sidebar-mini fixed " >
    <div class="wrapper">
        <header class="main-header">
            <a href="HumanR" class="logo">
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
                                        <a  href="<?= base_url('ProfileHR') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>

                                    <div class="pull-right">
                                        <a  href="<?= base_url('Auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
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
                    <li  id= "hoa" >
                        <a href="<?= base_url('HumanR') ?>"><i class="fa fa-dashboard "></i> <span >Overview</span ></a>
                    </li>
                    
                    <li class="treeview" id="emlist">
                      <a href="">
                        <i class="fa fa-users"></i> <span>Employee</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li  id= "hemp" >
                            <a href="<?= base_url('HumanE') ?>"><i class="fa fa-list"></i> <span >List</span ></a>
                        </li>
                        <li id= "hprof"><a href="<?= base_url('HumanEI') ?>"><i class="fa fa-user"></i> Profile</a></li>
                        <li  id= "hdtr" >
                            <a href="<?= base_url('HumanDTR') ?>"><i class="fa fa-calendar"></i> <span >DTR</span ></a>
                        </li>
                      </ul>
                    </li>
                    <li  id= "hpay" >
                        <a href="<?= base_url('HumanP') ?>"><i class="fa fa-credit-card "></i> <span >Payroll</span ></a>
                    </li>
                    <li  id= "hatt" >
                        <a href="<?= base_url('HumanA') ?>"><i class="fa fa-edit "></i> <span >Attendance</span ></a>
                    </li>

                    <li  id= "hrep" >
                        <a href="<?= base_url('HumanRep') ?>"><i class="fa fa-print"></i> <span >Report</span ></a>
                    </li>
                    <li  id= "hrepa" >
                        <a href="<?= base_url('HumanRepA') ?>"><i class="fa fa-print"> </i><i class="fa fa-user"></i> <span >Report - Admin</span ></a>
                    </li>
                    
                    
                </ul>
            </section>
        </aside>

 