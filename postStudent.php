<!-- User elements => fName lName inputEmail inputPhone gender password  -->
    
<!-- Student Elements => airline flightNumber flightDateTime needPickUp needHome affiliation homeStart homeEnd-->
    
<!-- Contact Elements => contactName contactRelation contactPhone -->

<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

//User DB Elements  
if(isset($_POST['fName'])){$fName = $_POST['fName'];}
$lName = $_POST['lName'];
$email = $_POST['email'];
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
$airline = $_POST['airline'];
$flightNumber = $_POST['flightNumber'];
$flightDateTime = $_POST['flightDateTime'];
$affiliation = $_POST['affiliation'];
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
$contactName = $_POST['contactName'];
$contactRelation = $_POST['contactRelation'];
$contactPhone = $_POST['contactPhone'];
        

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