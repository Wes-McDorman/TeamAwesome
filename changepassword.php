<?php
session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "1")) {
        
        include("connection.php");

$userId = $_SESSION['user_id'];

// User information collection
$queryUser = mysqli_query($dbc, "SELECT * FROM users WHERE user_id='".$userId."'");
if($queryUser) {
    $row = mysqli_fetch_assoc($queryUser);
    $fName = $row['fName'];
    $lName = $row['lName'];
    $email = $row['email'];
    $address = $row['address'];
    $zip = $row['zip'];
    $phone = $row['phone'];
    $isMale = $row['isMale'];
}

// Contact information collection
$queryContact = mysqli_query($dbc, "SELECT * FROM Contacts WHERE user_id='".$userId."'");
if($queryContact){
    $row = mysqli_fetch_assoc($queryContact);
    $isVolunteer = $row['isVolunteer'];
    $contactName = $row['contactName'];
    $contactPhone = $row['contactPhone'];
    $contactRelation = $row['contactRelation'];
}

// Student information collection
$queryStu = mysqli_query($dbc, "SELECT * FROM Students WHERE user_id='".$userId."'");
if($queryStu){
    $row = mysqli_fetch_assoc($queryStu);
    $affiliation = $row['affiliation'];
    $needPickUp = $row['needPickUp'];
    $needHomeShare = $row['needHomeShare'];
    $beginHomeShare = $row['beginHomeShare'];
    $beginHomeShare = str_replace(" ", "T", $beginHomeShare);
    $endHomeShare = $row['endHomeShare'];
    $endHomeShare = str_replace(" ", "T", $endHomeShare);
    $airline = $row['airline'];
    $flightNumber = $row['flightNumber'];
    $arrivalTime = $row['arrivalTime'];
    $arrivalTime = str_replace(" ", "T", $arrivalTime);
    $studentId = $row['Student_id'];
}

    }else{
        header('Location: login.html');
    }
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

<title>Team Awesome</title>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/styles.css">

</head>

<body style="margin: 0px; padding: 0px; font-family: 'Trebuchet MS',verdana;">



<!-- ============ THE HEADER SECTION ============== -->


<div class="container banner" id="banner">
  <div class="row banner">
      <h1 style=" font-family: 'Raleway',sans-serif"> <img src="images/Logo.png" id="logo"> <strong>International Students</strong>  HUB</h1>
  </div>
</div>

<div class="container breadCrumb" id="banner">
  <div class="row breadCrumb">
      <ol class="breadcrumb">
        <li>
            <a href="stuRegister.html" class="deco-none"><span class="glyphicon glyphicon-pencil"></span> Student Register</a> | 
            <a href="volRegister.html" class="deco-none"><span class="glyphicon glyphicon-pencil"></span> Volunteer Register</a>
        </li>
        <li><a href="login.html" class="deco-none"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
      </ol>
  </div>
</div>

<!-- ============ THE LEFT COLUMN (MENU) ============== -->


<div class="row">
  <div class="col-sm-2">
    <div class="sidebar-nav">
      <div class="navbar navbar-default navMenu navM" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Navigation Menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="indexGP.html">Home</a></li>
            <li><a href="aboutUs.html">Who We Are</a></li>
            <li><a href="contact_us.html">Help</a></li>
          </ul>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>

<!-- ============ (CONTENT) ============== -->
<div class="col-sm-10 content">

    <h1>Change Your Password</h1>

    <div class="form-group method="post" action="" onSubmit="return validatePassword()">
	<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
        <label class="col-sm-2 control-label noPad" for="help_name">* Current Password: </label>
            <div class="col-sm-9 noPad">
               <input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span>
            </div>
		<br><br>
		<label class="col-sm-2 control-label noPad" for="help_name">* New Password: </label>
            <div class="col-sm-9 noPad">
                <input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span>
            </div>	
        <br><br>
		<label class="col-sm-2 control-label noPad" for="help_name">* Confirm Password: </label>
            <div class="col-sm-9 noPad">
                <input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span>
            </div>			            
		<br><br><br>
        <<div class="col-sm-9 noPad">
		<input  class="btn btn-success" type="submit" name="submit" value="Update">           
        </div>
    </div>

</div>

</div>
	<footer class="container-fluid">
        <p>&copy; 2016 Team Awesome</p>
	</footer>
    
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
