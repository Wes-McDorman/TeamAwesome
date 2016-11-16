<?php
include('connection.php');
session_start();

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
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Manage Student</li>
                        <li><a href="adminHome.php">Update Information</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Manage Volunteer</li>
                        <li><a href="adminHome.php">Update Information</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header"></li>
                        <li><a href="delete_user.php">Delete Users</a></li>
                        <li><a href="adminHome.php">Update Admin Information</a></li>
                </ul>
            </li>
          </ul>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>


<!-- ============ (CONTENT) ============== -->
<div class="col-sm-10 content">
    <h2>Volunteer List</h2>


    <br>
    <br>
     <!-- ===Information displayed === -->
  <div class="col-sm-10 content">
    <div class="panel-group">






<table class="striped" id="listTableVol">
    <tr class="header">

        <td> First Name  </td>
        <td> Last Name  </td>
        <td> Email  </td>
        <td> Phone  </td>
        <td> Gender    </td>
        <td> Availability Begins    </td>
        <td> Availability Ends  </td>
    </tr>
    <?php
    $vol_query = mysqli_query($dbc, "SELECT * FROM users");
    $vol_avail_query = mysqli_query($dbc, "SELECT * FROM volAvailables");
       while ($u_row = mysqli_fetch_array($vol_query)) {
           if($u_row['user_type'] === "vol"){
                echo "<tr>";
                echo "<td>".$u_row['fName']."<br></td>";
                echo "<td>".$u_row['lName']."<br></td>";
                echo "<td>".$u_row['email']."<br></td>";
                echo "<td>".$u_row['phone']."<br></td>";

               if($u_row['isMale']){
                   $gender = "Male";
               }else{
                   $gender = "Female";
               }
               echo "<td>".$gender."</td>";
               echo "<td></td><td></td>";
               echo "</tr>";



               $vol_id = $u_row['user_id'];
               $vol_id_query = mysqli_query($dbc, "SELECT volunteer_id FROM volunteers WHERE user_id='".$vol_id."'");

               /*
               //not working
               if(empty($vol_avail_query)) {
                   echo "<tr>";
                   echo "<td></td><td></td><td></td><td></td><td></td>";
                   echo "<td>"."No times Given"."</td>";
                   echo "</tr>";
               }
               */
               while ($a_row = mysqli_fetch_array($vol_avail_query)) {
                    echo "<tr>";
                    echo "<td></td><td></td><td></td><td></td><td></td>";
                    /*
                    if(is_null($a_row['beginTime'])) {
                      echo "<td>"."No times Given"."</td>";
                    }
                    */
                    echo "<td>".$a_row['beginTime']."</td>";
                    echo "<td>".$a_row['endTime']."</td>";


                    echo "</tr>";

               }
           }
       }
    ?>
</table>















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
