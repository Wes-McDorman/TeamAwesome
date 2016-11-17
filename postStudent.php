<!-- User elements => fName lName inputEmail inputPhone gender password  -->
    
<!-- Student Elements => airline flightNumber flightDateTime needPickUp needHome affiliation homeStart homeEnd-->
    
<!-- Contact Elements => contactName contactRelation contactPhone -->

<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

//User DB Elements  
if(isset($_POST['fName'])){$fName = $_POST['fName'];}
$lName = filter_var($_POST['lName'], FILTER_SANITIZE_STRING);
if (isset($_POST['email'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}else{}
$phone = $_POST['inputPhone'];
$password = SHA1($_POST['password']);   //encrypt password in database
$address = "";
$zip = "";
$userType = "stu";
$getGender = $_POST['gender'];
    if($getGender == 'male'){
        $isMale = true;
    }else{
        $isMale = false;
    }
    
//Student DB Elements
$airline = filter_var($_POST['airline'], FILTER_SANITIZE_STRING);
$flightNumber = filter_var($_POST['flightNumber'], FILTER_SANITIZE_STRING);
$flightDateTime = $_POST['flightDateTime'];
$affiliation = filter_var($_POST['affiliation'], FILTER_SANITIZE_STRING);
$arrivalTime = $_POST['flightDateTime'];

if(isset($_POST['needHome']) && $_POST['needHome'] == 'needHome'){
    $needHome = true;
}else{
    $needHome = false;
}
    
if(isset($_POST['needPickUp']) && $_POST['needPickUp'] == 'needPickUp'){
    $needPickUp = true;
}else{
    $needPickUp = false;
}
    

    $homeStart = $_POST['beginHomeShare'];
    $homeEnd = $_POST['endHomeShare'];

    
//Contact DB elements
$contactName = filter_var($_POST['contactName'], FILTER_SANITIZE_STRING);
$contactRelation = filter_var($_POST['contactRelation'], FILTER_SANITIZE_STRING);
$contactPhone = filter_var($_POST['contactPhone'], FILTER_SANITIZE_STRING);
        

 //Parameters used to check for duplicate User registration   
$query = mysqli_query($dbc, "SELECT * FROM users WHERE email='".$email."'");
$numrows = mysqli_num_rows($query);
    
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
    
//create Student Entry
    if(!empty($affiliation) && ($needPickUp || $needHome)){       

        mysqli_query($dbc, "INSERT INTO Students(affiliation, needPickUp, needHomeShare, beginHomeShare, endHomeShare, airline, flightNumber, arrivalTime, user_id) 
        VALUES ('$affiliation', '$needPickUp', '$needHome', '$homeStart', '$homeEnd',
        '$airline', '$flightNumber', '$arrivalTime','$newUserId')");
    }else{
        echo "ERROR: Missing Student Information";
    }
    
$newVolId= $dbc->insert_id;
//Create Contact Entry
    if(!empty($contactName) && !empty($contactPhone)){    
        echo "made it past three";
		mysqli_query($dbc, "INSERT INTO contacts(contactName, contactRelation, contactPhone, isVolunteer, user_id) 
		VALUES ('$contactName', '$contactRelation', '$contactPhone', '0', '$newUserId')");
    }else{
        echo "ERROR: Missing Contact Information";
    }
     
    header('Location: login.html');

}else{
//Failure
    echo "ERROR: Missing required information!";	
    echo "<strong>Please complete the form...</strong>";  
}
}
    
}
?>