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

<title>Student Registration Page</title>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/styles.css">
<link rel="stylesheet" href="styles/registerStyles.css">
<script type = "text/javascript"  src ="js/regValidator.js" ></script>
</head>

<body style="margin: 0px; padding: 0px; font-family: 'Trebuchet MS',verdana;">



    
    
<!-- ============ THE HEADER SECTION ============== -->


<div class="container banner" id="banner">
  <div class="row banner">
      <h1 style="font-family: 'Raleway',sans-serif"> <img src="images/Logo.png" id="logo"> <strong>International Students</strong>  HUB</h1>
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
          <ul class='nav navbar-nav'>
            <li class='active'><a href='stuPage.php'>Home</a></li>
            <li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Profile<b class='caret'></b></a>
                <ul class='dropdown-menu'>
                        <li><a href='stuProfile.php'>Update Information</a></li>
                    <li class='divider'></li>
                    <li class='dropdown-header'>Account Information</li>
                        <li><a href='stuPage.php'>Change Password</a></li>
                </ul>
            </li>
          </ul>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>

<!-- ============ (CONTENT) ============== -->
<!-- User elements => fName lName inputEmail inputPhone gender password  -->
    
<!-- Student Elements => airline flightNumber flightDateTime needPickUp needHome  affiliation homeStart homeEnd-->
    
<!-- Contact Elements => contactName contactRelation contactPhone -->
<div class="col-sm-10 content">

   <h1 class="pageTitle pageTitleWords">Intl. Student Registration</h1>
<br><br><br>


<form  name="myForm" class="form-horizontal" onSubmit="return formValidation();" action ="stuUpdate.php" method="POST">
    
    <input type="hidden" name="userId" value="<?=$userId?>">

<div class="form-group">
  <label class="col-xs-12 col-sm-2 control-label noPad" for="fName">First Name:</label>
    <div class="col-xs-12 col-sm-6 noPad">
        <input class="form-control" type="text" name="fName"
        id="fName" value="<?=$fName?>" required /> <span id="errorFName"></span>
    </div>
    <div class="col-xs-12 col-sm-4"></div>
</div>
    
<div class="form-group">
  <label class="col-xs-12 col-sm-2 control-label noPad" for="lName">Last Name:</label>
    <div class="col-xs-12 col-sm-6 noPad">
        <input class="form-control" type="text" name="lName"
        id="lName" placeholder="LastName" value="<?=$lName?>"required /> <span id="errorLName"></span>
    </div>
    <div class="col-xs-12 col-sm-4"></div>
</div>

<div class="form-group">
  <label class="col-xs-12 col-sm-2 control-label noPad" for="email">E-mail Address:</label>
    <div class="col-xs-12 col-sm-6 noPad">
        <input class="form-control" type="email" name="email"
        id="email" placeholder="Email" value="<?=$email?>"required /> <span class="err" id="errorEmail"></span>
    </div>
    <div class="col-xs-12 col-sm-4"></div>
</div>

<div class="form-group">
  <label class="col-sm-2 control-label noPad" for="email2">Re-Enter:</label>
    <div class="col-sm-6 noPad">
        <input class="form-control" type="email"
        id="email2" placeholder="Email" value="<?=$email?>" required><span id="errorEmailMatch"></span>
    </div>
    <div class="col-xs-12 col-sm-4"></div>
</div>

<div class="form-group">
  <label class="col-sm-2 control-label noPad" for="affiliation">Affiliation:</label>
    <div class="col-sm-6 noPad">
        <input class="form-control" type="text" name="affiliation"
        id="affiliation" placeholder="WCF / GTCFA" value="<?=$affiliation?>"required>
    </div>
    <div class="col-xs-12 col-sm-4"></div>
</div>

<div class="form-group">
  <label class="col-sm-2 control-label noPad" for="inputPhone">Phone Number:</label>
    <div class="col-sm-4 noPad">
        <input class="form-control" type="tel" name="inputPhone"
        id="inputPhone" placeholder="###-###-####" value="<?=$phone?>"required><span id="errorPhone"></span>
    </div>
    <div class="col-xs-12 col-sm-6"></div>
    
</div>

<section class="col-xs-0 col-sm-1"></section>

<section class="col-xs-6 col-sm-2 dayCell">
    <fieldset>
        <div class="item weekDay">
            <label>Gender</label>
        </div>
        <div class="item">
            <input type="radio" name="gender" value="male" id="male"
                   <?php
  if ($isMale) {
    echo 'checked="checked" ';
  }
?>>
            <label for="male">Male</label>
        </div>
        <div class="item">
           <input type="radio" name="gender" value="female" id="female" 
                  <?php
  if (!$isMale) {
    echo 'checked="checked" ';
  }
?>>
            <label for="female">Female</label>
        </div>
    </fieldset>
</section>

<section class="col-xs-0 col-sm-1"></section>

<section class="col-xs-6 col-sm-3 dayCell">
    <fieldset>
        <div class="item weekDay">
            <label>Service Requested</label>
        </div>
        <div class="item">
            <input type="checkbox" name="needPickUp" value="needPickUp" id="needPickUp"
                    <?php
  if ($needPickUp) {
    echo 'checked="checked" ';
  }
?>>
            <label for="needPickUp">Pick-Up</label>
        </div>
        <div class="item">
           <input type="checkbox" name="needHome" value="needHome" id="needHome"
                  <?php
  if ($needHomeShare) {
    echo 'checked="checked" ';
  }
?>>
            <label for="needHome">Home-Share</label>
        </div>
    </fieldset>
</section>
    
<section class="col-xs-0 col-sm-5" id="homeShareDateArea">
    
    
    <? if($needHomeShare){ 
    
    echo '
<div class="up" ><div class="col-sm-12 homeTitle">HomeShare Availability</div>
    <div class="form-group">
      <label class="col-sm-2 control-label noPad" for="beginHomeShare">Start:</label>
        <div class="col-sm-8 noPad">
            <input class="form-control" type="datetime-local"
            name="beginHomeShare" value="'.$beginHomeShare.'" required>
        </div>
        <div class="col-sm-2 noPad"></div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label noPad" for="endHomeShare">End:</label>
        <div class="col-sm-8 noPad">
            <input class="form-control" type="datetime-local"
            name="endHomeShare" value="'.$endHomeShare.'" required>
        </div>
        <div class="col-sm-2 noPad"></div>
    </div>
</div>'
    
 } ?> 
    
    
</section>
    
<section class="col-xs-0 col-sm-3"></section>

<section class="col-xs-0 col-sm-12"><br></section>
      
    
<div class="form-group">
    <div class="col-sm-2">
    </div>
    <label class="col-sm-12 " > <span>Flight Information</span></label>
</div>

<div class="form-group">
  <label class="col-xs-12 col-sm-2 control-label noPad" for="airline">Airline:</label>
    <div class="col-xs-12 col-sm-9 noPad">
        <input class="form-control" type="text" name="airline"
        id="airline" placeholder="Delta, Korean Air, etc."  value="<?=$airline?>"required />
    </div>
</div>

<div class="form-group">
  <label class="col-xs-12 col-sm-2 control-label noPad" for="flightNumber">Flight Number:</label>
    <div class="col-xs-12 col-sm-3 noPad">
        <input class="form-control" type="text" name="flightNumber"
        id="flightNumber" placeholder="A233" value="<?=$flightNumber?>"required />
    </div>
  <label class="col-sm-2 control-label noPad" for="flightDateTime">Date/Time:</label>
    <div class="col-xs-12 col-sm-3 noPad">
        <input class="form-control" type="datetime-local" name="arrivalTime"
        id="flightDateTime" value="<?=$arrivalTime?>"required>
    </div>
</div>

<br><br>
<!-- ============ (Emergency Contact) ============== -->


<div class="form-group">
    <div class="col-sm-2">
    </div>
    <label class="col-sm-12 " for="inputPassword"> <span>Emergency Contact</span></label>
</div>

<div class="form-group">
  <label class="col-xs-12 col-sm-2 control-label noPad" for="contactName">Name:</label>
    <div class="col-xs-12 col-sm-6 noPad">
        <input class="form-control " type="text" name="contactName"
        id="contactName" placeholder="FirstName, LastName, MiddleInitial" value="<?=$contactName ?>"required />
    </div>
    <div class="col-xs-12 col-sm-4"></div>
</div>

<div class="form-group">
  <label class="col-sm-2 control-label noPad" for="contactRelation">Relationship:</label>
    <div class="col-sm-6 noPad">
        <input class="form-control" type="text" name="contactRelation"
        id="contactRelation" placeholder="Parent, Spouse, etc." value="<?=$contactRelation ?>" required>
    </div>
    <div class="col-xs-12 col-sm-4"></div>
</div>

<div class="form-group">
  <label class="col-sm-2 control-label noPad" for="contactPhone">Phone Number:</label>
    <div class="col-sm-6 noPad">
        <input class="form-control" type="tell" name="contactPhone"
        id="contactPhone" placeholder="###-###-####" value="<?=$contactPhone ?>"required><span id="errorContactPhone"></span>
    </div>
    <div class="col-xs-12 col-sm-4"></div>
</div>

<div class="form-group">
    <div class="checkbox">
        <div class="col-sm-10 col-sm-offset-9">
			<input type="submit" class="btn btn-success" value="Update">
			<a style="margin-right:200px;" href="changepassword.php" class="btn btn-info btn-sm" role="button">Change Your Password</a>
        </div>
    </div>
</div>
</form>

</div>
</div>
	<footer class="container-fluid">
        <p>&copy; 2016 Team Awesome</p>
	</footer>
    
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script type = "text/javascript"  src = "js/regValidatorr.js"></script>
    <script type = "text/javascript"  src ="js/studentReg.js" ></script>
</body>

</html>
