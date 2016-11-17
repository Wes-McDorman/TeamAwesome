<?php
session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "2")) {
        
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

// Volunteer information collection
$queryVol = mysqli_query($dbc, "SELECT * FROM Volunteers WHERE user_id='".$userId."'");
if($queryVol){
    $row = mysqli_fetch_assoc($queryVol);
    $volId = $row['Volunteer_id'];
    $affiliation = $row['affiliation'];
    $canPickUp = $row['canPickUp'];
    $canHomeShare = $row['canHomeShare'];
    $passengers = $row['passengers'];
    $suitcases = $row['suitcases'];
    $beginHomeShare = $row['beginHomeShare'];
        $beginHomeShare = str_replace(" ", "T", $beginHomeShare);
    $endHomeShare = $row['endHomeShare'];
        $endHomeShare = str_replace(" ", "T", $endHomeShare);
}

// Volunteer pickUp availablities collection
if($canPickUp){
    $oldPickUpIterator = 0;
    $volAvailBeginArray = array();
    $volAvailEndArray = array();
    $volAvailFilledArray = array();
    $volAvailIdArray = array();
    $queryVolAvail = mysqli_query($dbc, "SELECT * FROM volAvailables WHERE volunteer_id='".$volId."'");
    while($row = mysqli_fetch_assoc($queryVolAvail)) {       
        $beginTime = $row['beginTime'];
            $beginTime = str_replace(" ", "T", $beginTime);
        $endTime = $row['endTime'];
            $endTime = str_replace(" ", "T", $endTime);
        $filled = $row['filled'];
        $availId = $row['Avail_id'];
        echo $beginTime."  ";
        array_push($volAvailBeginArray, $beginTime);
        array_push($volAvailEndArray, $endTime);
        array_push($volAvailFilledArray, $filled);
        array_push($volAvailIdArray, $availId);
        $oldPickUpIterator = $oldPickUpIterator + 1;
    }
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

$pickUpDates = "";

for ($i = 0; $i < $oldPickUpIterator; $i++) { 

$pickUpDates = $pickUpDates.'        
<section class="item dateRangeDark" id="oldDateRange'.$i.'">
<div class="form-group">
  <label class="col-sm-3 control-label noPad" for="availPUStart">Start Date/Time:</label>
    <div class="col-sm-4 noPad">
        <input class="form-control" type="datetime-local"
        name="oldAvailPUStart'.$i.'" id="oldAvailPUStart'.$i.'" value="'.$volAvailBeginArray[$i].'" disabled
               required>
    </div>
    <div class="col-sm-5 noPad"></div>
</div>
    
<input type="hidden" name="thisAvailId'.$i.'" id="thisAvailId'.$i.'" value="'.$volAvailIdArray[$i].'">  
    
<div class="form-group">
  <label class="col-sm-3 control-label noPad" for="availPUEnd">End Date/Time:</label>
    <div class="col-sm-4 noPad">
        <input class="form-control" type="datetime-local" id="oldAvailPUEnd'.$i.'"
        name="oldAvailPUEnd'.$i.'" value="'.$volAvailEndArray[$i].'" disabled
                required>
    </div>
    <div class="col-sm-5 noPad" id="oldDelButArea'.$i.'">
    <button type="button" class="btn btn-default btn-xs alignRight editAvailBut" id="editOldRangeBut'.$i .'" onclick="editOldRange('.$i.')">Edit this Range</button>
    <button type="button" class="btn btn-default btn-xs alignRight removeBut" id="deleteOldRangeBut'.$i .'" onclick="deleteOldRange('.$i.')">Delete this Range</button></div>
</div>
</section>';
}

 }else{
        header('Location: login.html');
    }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

<title>ISP Registration</title>
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
          <ul class="nav navbar-nav">
            <li class="active"><a href="volHome.php">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile<b class="caret"></b></a>
                <ul class="dropdown-menu">
                        <li><a href="volHome.php">Update Information</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Account Information</li>
                        <li><a href="changepassword.php">Change Password</a></li>
                </ul>
            </li>
          </ul>
           
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>

<!-- ============ (CONTENT) ============== -->
<!-- User elements => fName, lName, inputEmail, inputPhone, gender, password, address, zip -->
    
<!-- Volunteer Elements => affiliation, canPickUp, canHome, passengers, suitcases -->
    
<!-- Contact Elements => contactName, contactRelation, contactPhone -->
    
<!-- VolAvailables => availPUStart0. availPUEnd0 -->
    
<!--    pickUpRangeIterator  -->
    
<div class="col-sm-10 content">

   <h1 class="pageTitle pageTitleWords">Volunteer Profile</h1>
<br><br><br>


<form  name="myForm" class="form-horizontal" onSubmit="return formValidation();" action ="volUpdate.php" method="POST">

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
    <div class="col-xs-10 col-sm-4"></div>
</div>

<div class="form-group">
  <label class="col-xs-10 col-sm-2 control-label noPad" for="address">Address:</label>
    <div class="col-xs-10 col-sm-6 noPad">
        <input class="form-control" type="text" name="address"
        id="address" placeholder="123 Road St YourTown, GA" value="<?=$address?>"required />
    </div>
    <div class="col-xs-10 col-sm-4"></div>
</div>
    
<div class="form-group">
  <label class="col-xs-12 col-sm-2 control-label noPad" for="zip">Zip Code:</label>
    <div class="col-xs-12 col-sm-6 noPad">
        <input class="form-control" type="text" name="zip"
        id="zip" placeholder="#####" value="<?=$zip?>"required />
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
<div class="form-group typeArea">
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
?>/> 
            <label for="male" >Male</label>
        </div>
        <div class="item">
           <input type="radio" name="gender" value="female" id="female" 
<?php
  if (!$isMale) {
    echo 'checked="checked" ';
  }
?>/>  
            <label for="female">Female</label>
        </div>
    </fieldset>
</section>

<section class="col-xs-0 col-sm-1"></section>

<section class="col-xs-6 col-sm-2 dayCell">
    <fieldset>
        <div class="item weekDay">
            <label>Type</label>
        </div>
        <div class="item">
            <input type="checkbox" name="canHome" value="canHome" id="canHome"
                   <?php
  if ($canHomeShare) {
    echo 'checked="checked" ';
  }
?>>
            <label for="canHome" >Home-Share</label>

        </div>
        <div class="item">
            <input type="checkbox" name="canPickUp" value="canPickUp" id="canPickUp" onclick="confirmPickUp" 
                   <?php
  if ($canPickUp) {
    echo 'checked="checked" ';
  }
?>
>
            <label for="canPickUp">Pick-Up</label>
        </div>
    </fieldset>
</section>

<section class="col-xs-0 col-sm-6" id="homeShareDateArea">
    
<? if($canHomeShare){ ?>
    
    
<div class="up" ><div class="col-sm-12 homeTitle">HomeShare Availability</div>
    <div class="form-group">
      <label class="col-sm-2 control-label noPad" for="beginHomeShare">Start:</label>
        <div class="col-sm-8 noPad">
            <input class="form-control" type="datetime-local"
            name="beginHomeShare" value="<?=$beginHomeShare?>" required>
        </div>
        <div class="col-sm-2 noPad"></div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label noPad" for="endHomeShare">End:</label>
        <div class="col-sm-8 noPad">
            <input class="form-control" type="datetime-local"
            name="endHomeShare" value="<?=$endHomeShare?>" required>
        </div>
        <div class="col-sm-2 noPad"></div>
    </div>
</div>
    
<? } ?>    
    
</section>


    </div>
<div id="carInfoArea" class="">

<? if($canPickUp) { ?>
    
<div class="form-group ">
  <label class="col-xs-12 col-sm-5 control-label noPad " 
  for="passengers"># passengers your vehicle handles:</label> 
    <div class="col-xs-12 col-sm-2 noPad">
        <input class="form-control" type="number" name="passengers"
        id="passengers" placeholder="#" value="<?=$passengers ?>" required /> 
    </div> 
    <div class="col-sm-5 noPad"></div> 
</div> 

<div class="form-group">
  <label class="col-xs-12 col-sm-5 control-label noPad" 
  for="suitcases"># suitcases your vehicle handles:</label>
    <div class="col-xs-12 col-sm-2 noPad"> 
        <input class="form-control" type="number" name="suitcases"
        id="suitcases" placeholder="#" value="<?=$suitcases?>" required />
    </div>
    <div class="col-xs-0 col-sm-5 noPad"></div>
</div>
    
<? } ?>
    
</div>    
    
    
    
    
    
    
    
    
<input type="hidden" name="oldPickUpRangeIterator" id="oldPickUpRangeIterator" 
value="<?=$oldPickUpIterator?>">

<input type="hidden" name="pickUpRangeIterator" id="pickUpRangeIterator" value="1">

<input type="hidden" name="rangeDelList" id="rangeDelList" value="">    
   
<input type="hidden" name="rangeEditList" id="rangeEditList" value=""> 
    
<input type="hidden" name="userId" value="<?=$userId?>">
    
<input type="hidden" name="volId" value="<?=$volId?>">
    
    
<div class="form-group noPad">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-12" id="addRangeButArea">
        
        <? if($canPickUp) { ?>
        
<label> <span>Ranges of Pick-Up Availablity</span></label>

        
<?= $pickUpDates ?>
<br>        
<button type="button" class="btn btn-default btn-xs alignRight bigBut" 
id="firstNewRangeBut" onclick="addRange(1)">Add New Range</button>
<br>
        <? } ?>
    </div>
</div>   
    

<section class="item" id="addBut">

</section>

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
        <div class="col-sm-10 col-sm-offset-6">
  <input type="submit" class="btn btn-default"
  value="submit">





        </div>
    </div>
</div>
</form>

</div>
</div>
	<footer class="container-fluid">
        <p>&copy; 2016 Team Awesome</p>
	</footer>
    
    
    <script type = "text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script type = "text/javascript"  src = "js/regValidatorr.js"></script>
    <script type = "text/javascript"  src ="js/volunteer.js" ></script>
</body>

</html>
?>