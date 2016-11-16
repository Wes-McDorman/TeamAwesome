<?php
include('connection.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST'){


    
//User DB elements
 
if(isset($_POST['fName'])){$fName = $_POST['fName'];}
$lName = $_POST['lName'];
$email = $_POST['email'];
$phone = $_POST['inputPhone'];
$password = $_POST['password'];
$address = $_POST['address'];
$zip = $_POST['zip'];
$userType = "vol";
$getGender = $_POST['gender'];
    if($getGender == 'male'){
        $isMale = true;
    }else{
        $isMale = false;
    }

    
//Volunteer DB elements
$affiliation = $_POST['affiliation'];
    
if(isset($_POST['canPickUp']) && $_POST['canPickUp'] == 'canPickUp'){
    $canPickUp = true;
}else{
    $canPickUp = false;
}

if(isset($_POST['canHome']) && $_POST['canHome'] == 'canHome'){
    $canHome = true;
}else{
    $canHome = false;
}   
    
if(isset($_POST['beginHomeShare'])){
    $beginHomeShare = $_POST['beginHomeShare'];
}else{
    $beginHomeShare = null;
}
    
if(isset($_POST['endHomeShare'])){
    $endHomeShare = $_POST['endHomeShare'];
}else{
    $endHomeShare = null;
}
    
if(isset($_POST['passengers'])){
    $passengers = $_POST['passengers'];
}else{
    $passengers = 0;
}
    
if(isset($_POST['suitcases'])){
    $suitcases = $_POST['suitcases']; 
}else{
    $suitcases = 0;
}
    
//Contact DB elements
$contactName = $_POST['contactName'];
$contactRelation = $_POST['contactRelation'];
$contactPhone = $_POST['contactPhone'];
    
//VolAvailables DB elements

$puIterator = $_POST['pickUpRangeIterator'];
 
//Parameters used to check for duplicate User registration
$query = mysqli_query($dbc, "SELECT * FROM users WHERE email='".$email."'");
$numrows = mysqli_num_rows($query);

    
    
if($_SERVER['REQUEST_METHOD'] == 'POST'){
//if user duplicate detected
if($numrows != 0){   
    echo "<br><br><br><br><center><strong>".$email." is registered with an existing account.</strong></center>";  //TODO: link to password recovery
    echo "<br><center><a href='volRegister.html'>New User Registration</a></center>";  
}else{

//Create User Entry
    if(!empty($fName) && !empty($lName) && !empty($email) && !empty($phone) && !empty($password)){       //TODO: rethink which fields to validate       
		mysqli_query($dbc, "INSERT INTO Users(fName, lName, user_type, email, password, address, zip, phone, isMale) 
		VALUES ('$fName', '$lName', '$userType', '$email', '$password', '$address', '$zip', '$phone', '$isMale')");
    }else{
        echo "ERROR: Missing User Information";
    }


$newUserId = $dbc->insert_id;

if(!empty($newUserId)){

//Create Volunteer Entry        
    if(!empty($affiliation) && ($canPickUp || $canHome)){       

        mysqli_query($dbc, "INSERT INTO Volunteers(affiliation, canPickUp, canHomeShare, passengers,
        suitcases, beginHomeShare, endHomeShare, user_id) 
        VALUES ('$affiliation', '$canPickUp', '$canHome', '$passengers', '$suitcases', '$beginHomeShare',
        '$endHomeShare', '$newUserId')");
    }else{
        echo "ERROR: Missing Volunteer Information";
    }
$newVolId= $dbc->insert_id;
    
//Create Contact Entry
    if(!empty($contactName) && !empty($contactPhone)){    
		mysqli_query($dbc, "INSERT INTO contacts(contactName, contactRelation, contactPhone, isVolunteer, user_id) 
		VALUES ('$contactName', '$contactRelation', '$contactPhone', '1', '$newUserId')");
    }else{
        echo "ERROR: Missing Contact Information";
    }

//Create VolAvailables Entry
if($canPickUp === true){
for ($x = ($puIterator - 1); $x >= 0; $x--) { 
    $availPUStart = $_POST['availPUStart'.$x];
    $availPUEnd = $_POST['availPUEnd'.$x];
    if(!empty($availPUStart) && !empty($availPUEnd)){  
		mysqli_query($dbc, "INSERT INTO volavailables(volunteer_id, beginTime, endTime, filled) 
		VALUES ('$newVolId', '$availPUStart', '$availPUEnd', '0')");
        echo ("Error description: " . mysqli_error($dbc));
    }else{
        echo "ERROR: Missing Contact Information";
    }
}
}else{}
    
//Success    
    echo " Account successfully created!";	           
     header('Location: login.html');    
}else{	
//Failure
    echo "ERROR: Missing required information!";	
    echo "<strong>Please complete the form...</strong>";
     }          
    }
}
}

?>

