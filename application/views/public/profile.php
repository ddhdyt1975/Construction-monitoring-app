
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="<?= base_url() ?>"><b>Konstrak</b>
  </div>
  <!-- User name -->
                                      
  <div class="lockscreen-name"><?php echo $user_info->user_fname;?> <?php echo $user_info->user_lname;?>  </div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo$user_info->user_photo;?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control" placeholder="Sign out">

        <div class="input-group-btn">
          <a href="<?= base_url('auth/logout')?>"><button type="button" class="btn"><i class="fa  fa-sign-out text-muted"></i></button></a>
        </div>
      </div>
    </form>

    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Your account has been locked. Wait for the Admin confirmation to use your account
  </div>
  <div class="text-center">
    <a href="<?= base_url('auth/logout')?>">Or sign in as a different user</a>
  </div>
   
</div>
<!-- /.center -->

<!-- <html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<link rel="stylesheet" media="screen and (max-width: 1200px) and (min-width: 0px)" type="text/css" href="<?php echo base_url(); ?>css/styleresponsive1.css">
<link rel="stylesheet" media="screen and (max-width: 600px) and (min-width: 0px)" type="text/css" href="<?php echo base_url(); ?>css/styleresponsive2.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<style type="text/css">
  body {
margin:0;
padding:0;
font-family:raleway;
background-image: url(../images/repeat-bg.png);
}
#main{
width: 65%;
height: 100%;
margin-left: 17%;
margin-top: 5%;
position: relative;
}
h2{
font-family:raleway;
}
div#envelope{
position: relative;
width: 51%;
border: 1px solid #CFCFD0;
border-radius: 10px;
background-color: #FFFFFF;
}
div#content{
width: 100%;
padding:12px auto;
overflow: hidden;
word-break: break-all;
overflow-wrap: break-word;
border-radius: 0 0 10px 10px;
}
header#sign_in{
font-family:raleway;
background-color: #079BAE;
text-align: center;
padding-top: 12px;
padding-left: 5px;
padding-bottom: 8px;
margin-bottom: -8px;
border-radius: 10px 10px 0 0;
color: white;
}
header#info{
font-family:raleway;
background-color: #079BAE;
margin-top: -11px;
padding-top:15px;
padding-bottom: 42px;
padding-left: 15px;
padding-right: 15px;
font-size: 16px;
border-radius: 10px 10px 0 0;
color: white;

}
header#info a.user_name{
font-family:raleway;
text-decoration: none;
color:white;
}
div.logout{
padding-top: 30px;
float:right;
}
a.logout{
font-family:raleway;
font-size: 20px;
font-weight: 600;
text-decoration: none;
padding-right: 0 auto;
float:right;
color:white;
}
p {
padding: 0 25px;
}
p.profile {
font-weight: bold;
font-size: 20px;
}
img.user_img{
border-radius:50% 50% 50% 50%;
border:3px solid white;
}
p.welcome{
margin-top: -50px;
margin-left: 12%;
}
</style>
<body>
<div id="main">
<div id="envelope">
<?php if (isset($authUrl)){ ?>
<header id="sign_in">
<h2>CodeIgniter Login With Google Oauth PHP</h2>
</header>
<hr>
<div id="content">
<center><a href="<?php echo $authUrl; ?>"><img id="google_signin" src="<?php echo base_url(); ?>images/google_login.jpg" width="100%" ></a></center>
</div>
<?php }else{ ?>
<header id="info">
<a target="_blank" class="user_name" href="<?php echo $userData->link; ?>" /><img class="user_img" src="<?php echo $userData->picture; ?>" width="15%" />
<?php echo '<p class="welcome"><i>Welcome ! </i>' . $userData->name . "</p>"; ?></a><a class='logout' href='https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo base_url(); ?>index.php/user_authentication/logout'>Logout</a>
</header>
<?php
echo "<p class='profile'>Profile :-</p>";
echo "<p><b> First Name : </b>" . $userData->given_name . "</p>";
echo "<p><b> Last Name : </b>" . $userData->family_name . "</p>";
echo "<p><b> Gender : </b>" . $userData->gender . "</p>";
echo "<p><b>Email : </b>" . $userData->email . "</p>";
?>
<?php }?>
</div>
</div>
</body>
</html>
  -->


<!--   <?php
if(!empty($authUrl)) {
    echo '<a href="'.$authUrl.'"><img src="'.base_url().'assets/images/glogin.png" alt=""/></a>';
}else{

?>
<div class="wrapper">
    <h1>Google Profile Details </h1>
    <?php
    echo '<div class="welcome_txt">Welcome <b>'.$userData['first_name'].'</b></div>';
    echo '<div class="google_box">';
    echo '<p class="image"><img src="'.$userData['picture_url'].'" alt="" width="300" height="220"/></p>';
    echo '<p><b>Google ID : </b>' . $userData['oauth_uid'].'</p>';
    echo '<p><b>Name : </b>' . $userData['first_name'].' '.$userData['last_name'].'</p>';
    echo '<p><b>Email : </b>' . $userData['email'].'</p>';
    echo '<p><b>Gender : </b>' . $userData['gender'].'</p>';
    echo '<p><b>Locale : </b>' . $userData['locale'].'</p>';
    echo '<p><b>Google+ Link : </b>' . $userData['profile_url'].'</p>';
    echo '<p><b>You are login with : </b>Google</p>';
    echo '<p><b>Logout from <a href="'.base_url().'user_authentication/logout">Google</a></b></p>';
    echo '</div>';
    ?>
</div>
<?php } ?> -->