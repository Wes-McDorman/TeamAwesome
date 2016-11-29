<?php
include('connection.php');
session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "0")) {
        $userId = $_SESSION['user_id'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

<title>Admin</title>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/styles.css">
<link rel="stylesheet" href="styles/adminStyles.css">

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
    <h2>Student List</h2>


    <br>
    <br>
     <!-- ===Information displayed === -->
    <div class="panel-group">
        <table class="table table-striped table-hover" id="listTableVol">
            <tr class="header">

                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Homeshare Begins</th>
                <th>Homeshare Ends</th>
                <th>Airline</th>
                <th>Flight Number</th>
                <th>Arrival Time</th>
                <th>User ID</th>

            </tr>
            <?php
            $stu_query = mysqli_query($dbc, "SELECT * FROM users");
            $stu_avail_query = mysqli_query($dbc, "SELECT * FROM students");
        while($u_row = mysqli_fetch_array($stu_query)) {
           if($u_row['user_type'] === "stu"){
                echo "<tr>";
                echo "<td>".$u_row['fName']."</td>";
                echo "<td>".$u_row['lName']."</td>";
                echo "<td>".$u_row['email']."</td>";
                echo "<td>".$u_row['phone']."</td>";

               if($u_row['isMale']){
                   $gender = "Male";
               }else{
                   $gender = "Female";
               }
               echo "<td>".$gender."</td>";

               $stu_user_id = $u_row['user_id'];
               $stu_id = mysqli_query($dbc, "SELECT * FROM students WHERE user_id='".$stu_user_id."'");
               $a_row = mysqli_fetch_assoc($stu_id);

               if(substr($a_row['beginHomeShare'], 0, 3) != "0000"){
                        echo "<td>".$a_row['beginHomeShare']."</td>";
                        echo "<td>".$a_row['endHomeShare']."</td>";
                        echo "<td>".$a_row['airline']."</td>";
                        echo "<td>".$a_row['flightNumber']."</td>";
                        echo "<td>".$a_row['arrivalTime']."</td>";
                        echo "<td>".$a_row['user_id']."</td>";
                    }else{
                        echo "<td>N/A</td>";
                        echo "<td>N/A</td>";
                        echo "<td>N/A</td>";
                        echo "<td>N/A</td>";
                        echo "<td>N/A</td>";
                        echo "<td>N/A</td>";
                        echo "</tr>";
                    }

           }else{}
        }
                echo "</tr>";





                       /*
                       //not working
                       if(empty($vol_avail_query)) {
                           echo "<tr>";
                           echo "<td></td><td></td><td></td><td></td><td></td>";
                           echo "<td>"."No times Given"."</td>";
                           echo "</tr>";
                       }
                       */

                       //comment all the things!


        /*               while ($a_row = mysqli_fetch_array($stu_avail_query)) {
                            //echo "<tr>";

                            if(substr($a_row['beginHomeShare'], 0, 3) != "0000"){
                                echo "<td></td><td></td><td></td><td></td><td></td>";
                                echo "<td>".$a_row['beginHomeShare']."</td>";
                                echo "<td>".$a_row['endHomeShare']."</td>";
                            }else{



                            echo "</tr>";
                            }
                       }
                       echo "</tr>";*/



    ?>
        </table>
<!--  All this hard work for nothing
<div class="panel panel-info">
<div class="panel-body">Volunteers:
  <ul id = "volList">
    <li>Timmy Two Shoes</li>
    <li>Bill Blabla</li>
  </ul>
</div>
</div>

  <button type="button" id="showVolButton" class="btn btn-info">Show more...</button>
<br>
<br>
</div>



-->
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