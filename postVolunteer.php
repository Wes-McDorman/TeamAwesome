<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

//User DB elements
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$email = $_POST['email'];
$phone = $_POST['inputPhone'];
$password = $_POST['password'];
$address = $_POST['address'];
$zip = $_POST['zip'];
$getGender = $_POST['gender'];
    if($getGender == 'male'){
        $isMale = true;
    }else{
        $isMale = false;
    }
    
//Volunteer DB elements
$affiliation = $_POST['affiliation'];
$canPickUp = $_POST['canPickUp'];
$canHome = $_POST['canHome'];
$passengers = $_POST['passengers'];
$suitcases = $_POST['suitcases']; 
    
//Contact DB elements
$contactName = $_POST['contactName'];
$contactRelation = $_POST['contactRelation'];
$contactPhone = $_POST['contactPhone'];
    
//VolAvailables DB elements
$availPUStart = $_POST['availPUStart'];
$availPUEnd = $_POST['availPUEnd'];
 
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
		mysqli_query($dbc, "INSERT INTO Users(fName, lName, email, password, address, zip, phone, isMale) 
		VALUES ('$fName', '$lName', '$email', '$password', '$address', '$zip', '$phone', '$isMale')");
    }else{
        echo "ERROR: Missing User Information"
    }

$newUserId =  mysqli_query($dbc, "SELECT user_id FROM users WHERE email='".$email."'");
if(!empty($newUserId)){

//Create Volunteer Entry        
    if(!empty($affiliation) && !empty($canPickUp) && !empty($canHome)){       //TODO: rethink which fields to validate
        mysqli_query($dbc, "INSERT INTO Volunteers(affiliation, canPickUp, canHomeShare, passengers,
        suitcases, beginHomeShare, endHomeShare, $newUser) 
        VALUES ('$affiliation', '$canPickUp', '$canHome', '$passengers', '$suitcases', '$beginHomeShare',
        '$endHomeShare', '$newUserId')");
    }else{
        echo "ERROR: Missing Volunteer Information"
    }

//Create Contact Entry
    if(!empty($contactName) && !empty($contactPhone)){          
		mysqli_query($dbc, "INSERT INTO Users(contactName, contactRelation, contactPhone, isVolunteer, user_id) 
		VALUES ('$contactName', '$contactRelation', '$contactPhone', 'true', '$newUser')");
    }else{
        echo "ERROR: Missing Contact Information"
    }

//Create VolAvailables Entry
    if(!empty($availPUStart) && !empty($availPUEnd)){         
		mysqli_query($dbc, "INSERT INTO Users(volunteer_id, beginTime, endTime, filled) 
		VALUES ('$newUserId', '$availPUStart', '$availPUEnd', 'false')");
    }else{
        echo "ERROR: Missing Contact Information"
    }
    
    echo " Account successfully created!";	           
    echo "<br><center><a href='index.html'>Log In</a></center>";      
}else{		
    echo "ERROR: Missing required information!";	
    echo "<strong>Please complete the form...</strong>";
     }          
    }
}
}

?>

