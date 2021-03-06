<?php
include('connection.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

 
//User DB elements
$userId = $_POST['userId'];
if(isset($_POST['fName'])){$fName = filter_var($_POST['fName'], FILTER_SANITIZE_STRING);}
$lName = filter_var($_POST['lName'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $originalEmail = $email;
$phone = filter_var($_POST['inputPhone'], FILTER_SANITIZE_STRING);
$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
$zip = filter_var($_POST['zip'], FILTER_SANITIZE_STRING);
$userType = "vol";
$getGender = $_POST['gender'];
    if($getGender == 'male'){
        $isMale = true;
    }else{
        $isMale = false;
    }

    
//Volunteer DB elements
$affiliation = filter_var($_POST['affiliation'], FILTER_SANITIZE_STRING);
    

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
$contactName = filter_var($_POST['contactName'], FILTER_SANITIZE_STRING);
$contactRelation = filter_var($_POST['contactRelation'], FILTER_SANITIZE_STRING);
$contactPhone = filter_var($_POST['contactPhone'], FILTER_SANITIZE_STRING);
    
//VolAvailables DB elements
$puIterator = $_POST['pickUpRangeIterator'];
$rangeDelList = $_POST['rangeDelList'];
$rangeEditList = $_POST['rangeEditList'];
$oldVolId = $_POST['volId'];




    
 
    if(true){       //session variable check

//User update      
        if(!empty($fName) && !empty($lName) && !empty($email) && !empty($phone) ){

if (mysqli_query($dbc, "UPDATE Users SET fName='".$fName."', lName='".$lName."', email='".$email."', address='".$address."', zip='".$zip."', phone='".$phone."', isMale='".$isMale."' WHERE user_id='".$userId."'")){
    echo " Profile Updated!";	
}else{
    echo "Error updating record: fName='".$fName.", lName='".$lName."', email='".$email."', address='".$address."', zip='".$zip."', phone='".$phone."', isMale='".$isMale."'";
    echo "<br> ". mysqli_error($dbc);
}
}else{		
    echo "ERROR: you left some user values blank!";	
    echo "<strong>Please complete the form...</strong>";
}
        
//Volunteer update
        if(!empty($affiliation)){
if (mysqli_query($dbc, "UPDATE Volunteers SET affiliation='".$affiliation."', canPickUp='".$canPickUp."', canHomeShare='".$canHome."',   passengers='".$passengers."', suitcases='".$suitcases."', beginHomeShare='".$beginHomeShare."',
endHomeShare='".$endHomeShare."' WHERE user_id='".$userId."'")){
    echo " Profile Updated!";	
}else{
    echo "Error updating record:  affiliation='".$affiliation."', canPickUp='".$canPickUp."', canHomeShare='".$canHome."',
    passengers='".$passengers."', suitcases='".$suitcases."', beginHomeShare='".$beginHomeShare."', endHomeShare='".$endHomeShare."'";
    echo "<br> ". mysqli_error($dbc);
}
}else{		
    echo "ERROR: you left some volunteer values blank!";	
    echo "<strong>Please complete the form...</strong>";
}
    
//Contact Update
    if(!empty($contactName) && !empty($contactRelation) && !empty($contactPhone)){
if (mysqli_query($dbc, "UPDATE Contacts SET contactName='".$contactName."', contactRelation='".$contactRelation."', contactPhone='".$contactPhone."' WHERE user_id='".$userId."'")){
    echo " Profile Updated!";	
}else{
    echo "Error updating record:  contactName='".$contactName."', contactRelation='".$contactRelation."', contactPhone='".$contactPhone."''";
    echo "<br> ". mysqli_error($dbc);
}
}else{		
    echo "ERROR: you left some contact values blank!";	
    echo "<strong>Please complete the form...</strong>";
}
        

//Create New VolAvailables Entries
if($canPickUp == true && $puIterator > 1){
    
for ($x = ($puIterator - 1); $x >= 1; $x--) { 
    $availPUStart = $_POST['availPUStart'.$x];
    $availPUEnd = $_POST['availPUEnd'.$x];
    if(!empty($availPUStart) && !empty($availPUEnd)){  
		mysqli_query($dbc, "INSERT INTO VolAvailables(volunteer_id, beginTime, endTime, filled) 
		VALUES ('$oldVolId', '$availPUStart', '$availPUEnd', '0')");
        echo ("Error VolAvail description: " . mysqli_error($dbc));
    }else{
        echo "ERROR: Missing Contact Information";
    }
}
}else{}
        
//Update Existing VolAvailables Entries
if(strlen($rangeEditList) > 0){

    $rangeKeys = preg_split('/ /', $rangeEditList);
    $editCount = count($rangeKeys) - 1;
    echo "<br>".$editCount."<br>";
    
    for($i = ($editCount - 1); $i >= 1; $i--){
        $idKeys = preg_split('/-/', $rangeKeys[$i]);
        $volAvailId = $idKeys[0];

        
        $availPUStart = $_POST['availPUStart'.$i];
        $availPUEnd = $_POST['availPUEnd'.$i];
        
      
if (mysqli_query($dbc, "UPDATE VolAvailables SET volunteer_id='".$oldVolId."', beginTime='".$availPUStart."', endTime='".$availPUEnd."' WHERE Avail_id='".$volAvailId."'")){
    echo " Profile Updated!";	
}else{
    echo "volunteer_id='".$oldVolId."', beginTime='".$availPUStart."', endTime='".$availPUEnd."' WHERE Avail_id='".$volAvailId."'";
    echo "<br> ". mysqli_error($dbc);
}

        
        
        echo ($idKeys[0]);
        print_r($rangeKeys);
    }
}else{}
      
    
//Delete VolAvails Entry
if(strlen($rangeDelList) > 0){
        
    $rangeKeys = preg_split('/ /', $rangeDelList);
    $delCount = count($rangeKeys) - 1;
    echo "<br>".$delCount."<br>";
    for($i = ($delCount); $i >= 0; $i--){

        $volAvailId = $rangeKeys[$i];

        if (mysqli_query($dbc, "DELETE FROM VolAvailables WHERE Avail_id='".$volAvailId."'")){
            echo " Profile DELETED, everything worked fine!";

        }else{
            echo "<br> ". mysqli_error($dbc);
            echo "<br><br><center><a href='delete_user.php'>Try Again</a></center>";                
        }
    }
}
        
if(!$canPickUp){
            if (mysqli_query($dbc, "DELETE FROM VolAvailables WHERE volunteer_id='".$oldVolId."'")){
            echo " Profile DELETED, everything worked fine!";
                
        }else{
            
            echo "<br> ". mysqli_error($dbc);
            echo "<br><br><center><a href='delete_user.php'>Try Again</a></center>";                
        }
}else{}
         header('Location: volHome.php');

    }else{

    }
    
    

}
    
    
    
//if values are not empty, proceed to store them in the database

?>

