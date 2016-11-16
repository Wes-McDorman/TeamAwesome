<?php
include('connection.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

 
//User DB elements
$userId = $_POST['userId'];
if(isset($_POST['fName'])){$fName = $_POST['fName'];}
$lName = $_POST['lName'];
$email = $_POST['email'];
    $originalEmail = $email;
$phone = $_POST['inputPhone'];

$userType = "stu";
$getGender = $_POST['gender'];
    if($getGender == 'male'){
        $isMale = true;
    }else{
        $isMale = false;
    }

    
// Student DB elements
$affiliation = $_POST['affiliation'];
    if(isset($_POST['needPickUp']) && $_POST['needPickUp'] == 'needPickUp'){
    $needPickUp = true;
}else{
    $needPickUp = false;
}
if(isset($_POST['needHome']) && $_POST['needHome'] == 'needHome'){
    $needHomeShare = true;
}else{
    $needHomeShare = false;
} 
$beginHomeShare = $_POST['beginHomeShare'];
$endHomeShare = $_POST['endHomeShare'];
$airline = $_POST['airline'];
$flightNumber = $_POST['flightNumber'];
$arrivalTime = $_POST['arrivalTime'];


//Contact DB elements
$contactName = $_POST['contactName'];
$contactRelation = $_POST['contactRelation'];
$contactPhone = $_POST['contactPhone'];
    




    
 
    if(true){       //session variable check

//User update      
        if(!empty($fName) && !empty($lName) && !empty($email) && !empty($phone) ){

if (mysqli_query($dbc, "UPDATE users SET fName='".$fName."', lName='".$lName."', email='".$email."', phone='".$phone."', isMale='".$isMale."' WHERE user_id='".$userId."'")){
    echo " Profile Updated!";	
}else{
    echo "Error updating record: fName='".$fName.", lName='".$lName."', email='".$email."', address='".$address."', zip='".$zip."', phone='".$phone."', isMale='".$isMale."'";
    echo "<br> ". mysqli_error($dbc);
}
}else{		
    echo "ERROR: you left some user values blank!";	
    echo "<strong>Please complete the form...</strong>";
}
        
//Student update
        if(!empty($affiliation)){
if (mysqli_query($dbc, "UPDATE students SET affiliation='".$affiliation."', needPickUp='".$needPickUp."', needHomeShare='".$needHomeShare."',   airline='".$airline."', flightNumber='".$flightNumber."', beginHomeShare='".$beginHomeShare."', arrivalTime='".$arrivalTime."',
endHomeShare='".$endHomeShare."' WHERE user_id='".$userId."'")){
    echo " Profile Updated!";	
}else{
    echo "Error updating record:  affiliation='".$affiliation."', needPickUp='".$needPickUp."', needHomeShare='".$needHomeShare."',   airline='".$airline."', flightNumber='".$flightNumber."', beginHomeShare='".$beginHomeShare."', arrivalTime='".$arrivalTime."'
endHomeShare='".$endHomeShare."' WHERE user_id='".$userId."'";
    echo "<br> ". mysqli_error($dbc);
}
}else{		
    echo "ERROR: you left some volunteer values blank!";	
    echo "<strong>Please complete the form...</strong>";
}
    
//Contact Update
    if(!empty($contactName) && !empty($contactRelation) && !empty($contactPhone)){
if (mysqli_query($dbc, "UPDATE contacts SET contactName='".$contactName."', contactRelation='".$contactRelation."', contactPhone='".$contactPhone."' WHERE user_id='".$userId."'")){
    echo " Profile Updated!";	
}else{
    echo "Error updating record:  contactName='".$contactName."', contactRelation='".$contactRelation."', contactPhone='".$contactPhone."''";
    echo "<br> ". mysqli_error($dbc);
}
}else{		
    echo "ERROR: you left some contact values blank!";	
    echo "<strong>Please complete the form...</strong>";
}
        


      
  header('Location: stuPage.php');
        

    }else{
  header('Location: stuPage.php');
    }
    
    

}
    
    
    
//if values are not empty, proceed to store them in the database

?>

