<?php
error_reporting(0);

$showDivFlag = true;

include('connection.php');

session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "0")) {
        $userId = $_SESSION['user_id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $stuUserId = $_POST['stuSelect'];
            
            $volSelect = $_POST['volSelect'];
                $arr = explode("|", $volSelect);
                $availId = $arr[0];
                $volUserId = $arr[1];
            
            
            $pickUpTime = $_POST['pickUpTime'];

            $stuData = mysqli_query($dbc, "SELECT * FROM Students WHERE user_id='".$stuUserId."'");
            $stuResult = mysqli_fetch_assoc($stuData);
            $volData = mysqli_query($dbc, "SELECT * FROM Volunteers WHERE user_id='".$volUserId."'");
            $volResult = mysqli_fetch_assoc($volData);
            $availData = mysqli_query($dbc, "SELECT * FROM VolAvailables WHERE Avail_id='".$availId."'");
            $availResult = mysqli_fetch_assoc($availData);
            
            $checkStu = mysqli_query($dbc, "SELECT * FROM PickUps WHERE Student_id='".$stuResult['Student_id']."'");
            $checkVol = mysqli_query($dbc, "SELECT * FROM PickUps WHERE Student_id='".$volResult['Volunteer_id']."'");
            
            if(false) {
                $msg = "<h1 class='text-warning'>Pick Up List has already created for this student!</h1><br><br>
                <button class='btn btn-warning' onclick='goBack()'>Go Back</button>";
                $showDivFlag = false;
            }
            else {
                $stuR = $stuResult['Student_id'];
                $volR = $volResult['Volunteer_id'];
                $stuDate = $stuResult['arrivalTime'];
                mysqli_query($dbc, "INSERT INTO PickUps(Student_id, Volunteer_id, date) 
                    VALUES ('$stuR', '$volUserId', '$stuDate')");
                    echo ("Error VolAvail description: " . mysqli_error($dbc));
                
                
                
                
                mysqli_query($dbc, "UPDATE VolAvailables SET filled='1' WHERE Avail_id='".$availId."'");
                $msg = "<h1 class='text-success'>Successfully added into Pick Up List!</h1><br><br>
                <button class='btn btn-warning' onclick='goBack()'>Go Back</button>";
                $showDivFlag = false;
                
            }
            
            }
        
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

    <title>Admin</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/adminStyles.css">
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

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
        <li><a href="logout_function.php" class="deco-none"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
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
            <li class="active"><a href="adminHome.php">Home</a></li>
            <li><a href="adminStuView.php">Student Database</a></li>
            <li><a href="adminVolView.php">Volunteer Database</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pick Up/Home Share<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Pick Up</li>
                        <li><a href="matchPickUp.php">Match Pick Up</a></li>
                        <li><a href="adminHome.php">Pick Up List</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Home Share</li>
                        <li><a href="matchHomeShare.php">Match Home Share</a></li>
                        <li><a href="adminHome.php">Home Share List</a></li>
                </ul>
            </li>
            <li><a href="delete_user.php">Delete Users</a></li>
          </ul>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>


<!-- ============ (CONTENT) ============== -->
<div class="col-sm-10 content">
    <h2>Airport Pick Up Match</h2>
    
    <br>
    <br>
     <!-- ===Information displayed === -->
        <?php // echo $msg; ?>
    <div id = "formDiv" <?php if ($showDivFlag == false) { ?> style='display:none' <?php } ?>>
        <form action="matchPickUp.php" method="post" >
            <div class="panel-group" style="display: inline-block">
                <label>STUDENT</label>
                <table class="table">
                    <tr class="header">
                        <th>M/F</th>
                        <th>Flight Number</th>
                        <th>Arrival Time</th>
                        <th>User ID</th>
                        <th>Select </th>
                    </tr>
                    <?php
                        $stu_query = mysqli_query($dbc, "SELECT * FROM Users");
                        $stu_avail_query = mysqli_query($dbc, "SELECT * FROM Students");
                        while($u_row = mysqli_fetch_array($stu_query)) {
                            if($u_row['user_type'] === "stu"){
                                echo "<tr>";
                                if($u_row['isMale']){
                                    $gender = "Male";
                                }else{
                                    $gender = "Female";
                                }
                                echo "<td>".$gender."</td>";
                            $stu_user_id = $u_row['user_id'];
                            $stu_id = mysqli_query($dbc, "SELECT * FROM Students WHERE user_id='".$stu_user_id."'");
                                

                                
                            $a_row = mysqli_fetch_assoc($stu_id);
                                
                                $availData = mysqli_query($dbc, "SELECT * FROM PickUps WHERE Student_id='".$a_row.['Student_id']."'");
                                

                          
                                
                                
                                echo "<td>".$a_row['flightNumber']."</td>";
                                echo "<td>".$a_row['arrivalTime']."</td>";
                                echo "<td>".$a_row['user_id']."</td>";
                          
                                $x_row = mysqli_fetch_assoc($availData);

                                echo $x_row['Student_id'];
                                
                                
                                if($x_row['Student_id'] == $a_row.['Student_id']){
                                    echo "<td>filled</td>";
                                }else{
                                    echo "<td><input type='radio' name='stuSelect' value='".$a_row['user_id']."' id='stuSelect'></td>";
                                }
                            }
                        }
                    ?>
                </table>
            </div>
            
            
<div class="panel-group" style="display: inline-block">
    <label>VOLUNTEER</label>
    <table class="table">
        <tr class="header">
            <th>Gender</th>

            <th>Passengers</th>
            <th>User ID</th>
            <th>Pick Up Begins</th>
            <th>Pick Up Ends</th>
            <th>Select</th>
        </tr>
        <?php
            $vol_query = mysqli_query($dbc, "SELECT * FROM Users");
            $vol_avail_query = mysqli_query($dbc, "SELECT * FROM VolAvailables");
               while ($u_row = mysqli_fetch_array($vol_query)) {
                   if($u_row['user_type'] === "vol"){
                        echo "<tr>";

                       if($u_row['isMale']){
                           $gender = "Male";
                       }else{
                           $gender = "Female";
                       }


                       $vol_id = $u_row['user_id'];
   


                       



                       $vol_id_query1 = mysqli_query($dbc, "SELECT * FROM Volunteers WHERE user_id='".$vol_id."'");
                       while ($b_row = mysqli_fetch_array($vol_id_query1)) {
                            $availFirst = true;
                            echo "<td>".$gender."</td>";
                            echo "<td>".$b_row['passengers']."</td>";
                            echo "<td>".$b_row['user_id']."</td>";
                            
                            $vol_id_query = mysqli_query($dbc, "SELECT * FROM VolAvailables WHERE volunteer_id='".$b_row['Volunteer_id']."'");
                           
                    while ($a_row = mysqli_fetch_assoc($vol_id_query)) {

                      if($a_row['volunteer_id'] == $b_row['Volunteer_id']){
                        if (!$availFirst){
                            echo "<tr><td></td><td></td><td></td>";

                          
                        }else{
                          $availFirst = false;

                      }
                        echo "<td>".$a_row['beginTime']."</td>";
                        echo "<td>".$a_row['endTime']."</td>";
                        echo "<td><input type='radio' name='volSelect' value='".$a_row['Avail_id']."|".$b_row['Volunteer_id']."' id='volSelect'></td>";
                          echo "</tr>";
                       }else{
                          
                      }
                        }

                           
                           
                       }
                       echo "</tr>";
                   }
               }
        ?>  
    </table>
</div>
            <div class="col-sm-10 col-sm-offset-3">
                <label class="col-sm-2 control-label noPad" for="pickUpTime">Pick Up Date/Time:</label>
                <div class="col-xs-12 col-sm-3 noPad">
                    <input class="form-control" type="datetime-local" name="pickUpTime"
                    id="pickUpTime" >
                </div>
            </div>
            <div class="col-sm-10 col-sm-offset-5">
                <br/>
                <input class="btn btn-success" type="submit" value="Match" name="Match">
            </div>
        </form>
    </div>
    <br>

</div>
</div>
	<footer class="container-fluid">
        <p>&copy; 2016 Team Awesome</p>
	</footer>

    <script src="js/showMore_ButtonLogic.js"></script>
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
<?php } ?>