<?php
//avoid error notices, display only warnings:
error_reporting(0);
// $email = $_POST['email'];
$showDivFlag = true;
//check if user clicked the delete button in the form:
        
        //start with a session
session_start();

if ((isset($_SESSION['login']) && $_SESSION['login'] == "0")) {
     if($_SERVER['REQUEST_METHOD'] == 'POST'){

        include("connection.php");

        $getid = mysqli_real_escape_string($dbc, trim($_POST['id']));

    //delete user where email = $email_from_form_input: 
        mysqli_query($dbc, "DELETE FROM users WHERE user_id='$getid'");		
        $successMsg = "<h1 class='text-success'>Successfully deleted!</h1><br><br>
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
            <li><a href="adminHome.php">Update Admin Information</a></li>
          </ul>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>


<!-- ============ (CONTENT) ============== -->
<div class="col-sm-10 content">
    <h2>Admin Home Page</h2>
    <?php echo $successMsg; ?>
    <div id = "formDiv" <?php if ($showDivFlag == false) { ?> style='display:none' <?php } ?>>
        <h4> Are you sure you want to delete this user?</h4>
        <form action="delete_user.php" method="post">
            <div class="form-group col-md-8 col-md-offset-2">
                <label for="id">User ID: </label>
                <input type="text" class="form-control" name="id" maxlength="50" value="<?php echo $_GET['user_id']; ?>">
            </div>
            <div class="form-group col-md-8 col-md-offset-2">
                <label for="fname">User Type: </label>
                <input type="text" class="form-control" name="fname" maxlength="50" value="<?php echo $_GET['user_type']; ?>">
            </div>
            <div class="form-group col-md-8 col-md-offset-2">
                <label for="fname">User's First Name: </label>
                <input type="text" class="form-control" name="fname" maxlength="50" value="<?php echo $_GET['fName']; ?>">
            </div>
            <div class="form-group col-md-8 col-md-offset-2">
                <label for="lname">User's Last Name: </label>
                <input type="text" class="form-control" name="lname" maxlength="50" value="<?php echo $_GET['lName']; ?>">
            </div>

            <div class="form-group col-md-8 col-md-offset-2">
                <input type="submit" name="submit" class="btn btn-success" value="Yes, Delete User Now" />
                <button class='btn btn-warning' onclick='goBack()'>Go Back</button>
            </div>
        </form>
    </div>

    <br>

</div>
</div>
	<footer class="container-fluid">
        <p>&copy; 2016 Team Awesome</p>
	</footer>

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>