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
    <link href="<?= base_url() ?>assets/all/pnotify.buttons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/datatables.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/all/pnotify.nonblock.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">
</head>
 
<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="ManagerSM" class="logo">
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
                                <span class="hidden-xs"><?php echo $user_info->user_fname; ?>  <?php echo $user_info->user_lname; ?></span>
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
                                        <a  href="<?= base_url('ProfileSM') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a  href="<?= base_url('Auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="dropdown messages-menu hidden">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <ul class="menu">
                                        <li> 
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo $user_info->user_photo?>" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                              <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                              <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <li class="dropdown notifications-menu hidden">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                                page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>
                                         <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
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
                            <a data-toggle="control-sidebar hidden"> </a>
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
                    <li ><a href="<?= base_url('ManagerSM') ?>"><i class="fa fa-dashboard"></i>  <span>Quick Dashboard</span></a></li>
                    <li><a href="<?= base_url('ThreadSM') ?>"><i class="fa fa-envelope-o"></i> <span> Thread Dashboard</span></a></li>
                    <li class="treeview">
                       <!--  <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                                </ul>
                    </li> -->

                    <!-- <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i> <span>Project's Dashboard</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu"> -->
                            <li ><a href="<?= base_url('ProjectsSM') ?>"><i class="fa fa-book"></i>  <span>Projects </span></a></li>
                        <!-- </ul>
                    </li> -->
                   <!--  <li>
                        <a href="<?= base_url('AttendancesSM') ?>"><i class="fa fa-exchange"></i><span >Request Page</span></a>
                    </li>
                    <li>
                        <a href="<?= base_url('AttendancesSM') ?>"><i class="fa fa-edit"></i><span >Attendance</span></a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('ReportsSM') ?>"><i class="fa fa-print"></i><span >Reports</span></a>
                    </li>
                </ul>
            </section>
        </aside>