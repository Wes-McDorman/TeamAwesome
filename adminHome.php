<?php
    session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "0")) {

        include("connection.php");

        $query = mysqli_query($dbc, "SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'");
        if($query) {
            while($row = mysqli_fetch_assoc($query)) {
                $stu = mysqli_query($dbc, "SELECT * FROM students");
                $vol = mysqli_query($dbc, "SELECT * FROM volunteers");
                $volPickup = mysqli_query($dbc, "SELECT * FROM volavailables");
                $contacts = mysqli_query($dbc, "SELECT * FROM contacts");
                $homeshares = mysqli_query($dbc, "SELECT * FROM homeshares");
                $pickups = mysqli_query($dbc, "SELECT * FROM pickups");
                $stuInfo = mysqli_fetch_assoc($stu);
                $volInfo = mysqli_fetch_assoc($vol);
                $volPickupInfo = mysqli_fetch_assoc($volPickup);
                $contactsInfo = mysqli_fetch_assoc($contacts);
                $homesharesInfo = mysqli_fetch_assoc($homeshares);
                $pickupsInfo = mysqli_fetch_assoc($pickups);
                echo "
                <!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>

                <html>

                    <head>

                        <title>Admin Home</title>
                        <link rel='stylesheet' href='styles/bootstrap.min.css'>
                        <link rel='stylesheet' href='styles/styles.css'>

                    </head>

                    <body style='margin: 0px; padding: 0px; font-family: Trebuchet MS,verdana;'>

                    <!-- ============ THE HEADER SECTION ============== -->

                    <div class='container banner' id='banner'>
                      <div class='row banner'>
                          <h1 style=' font-family: Raleway,sans-serif'> <img src='images/Logo.png' id='logo'> <strong>International Students</strong>  HUB</h1>
                      </div>
                    </div>

                    <div class='container breadCrumb' id='banner'>
                      <div class='row breadCrumb'>
                          <ol class='breadcrumb'>
                            <li><a href='logout_function.php' class='deco-none'><span class='glyphicon glyphicon-log-out'></span> Log out</a></li>
                          </ol>
                      </div>
                    </div>

                    <!-- ============ THE LEFT COLUMN (MENU) ============== -->


                    <div class='row'>
                      <div class='col-sm-2'>
                        <div class='sidebar-nav'>
                          <div class='navbar navbar-default navMenu navM' role='navigation'>
                            <div class='navbar-header'>
                              <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.sidebar-navbar-collapse'>
                                <span class='sr-only'>Toggle navigation</span>
                                <span class='icon-bar'></span>
                                <span class='icon-bar'></span>
                                <span class='icon-bar'></span>
                              </button>
                              <span class='visible-xs navbar-brand'>Navigation Menu</span>
                            </div>
                            <div class='navbar-collapse collapse sidebar-navbar-collapse'>
                              <ul class='nav navbar-nav'>
                                <li class='active''><a href='adminHome.php'>Home</a></li>
                                <li><a href='adminStuView.php'>Student Database</a></li>
                                <li><a href='adminVolView.php'>Volunteer Database</a></li>
                                <li class='dropdown'>
                                  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Pick Up/Home Share<b class='caret'></b></a>
                                    <ul class='dropdown-menu'>
                                        <li class='dropdown-header'>Pick Up</li>
                                            <li><a href='matchPickUp.php'>Match Pick Up</a></li>
                                            <li><a href='adminHome.php'>Pick Up List</a></li>
                                        <li class='divider'></li>
                                        <li class='dropdown-header'>Home Share</li>
                                            <li><a href='adminHome.php'>Match Home Share</a></li>
                                            <li><a href='adminHome.php'>Home Share List</a></li>
                                    </ul>
                                </li>
                                <li><a href='delete_user.php'>Delete Users</a></li>
                                <li><a href='adminHome.php'>Update Admin Information</a></li>
                              </ul>
                                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                          </div><!--/.nav-collapse -->
                        </div>
                      </div>
                    </div>

                    <!-- ============ (CONTENT) ============== -->
                    <div class='col-sm-10 content'>
                        <h2>Admin Home Page</h2>

                        <br>
                          Hello, ".$row['fName']." ".$row['lName']."! Your admin ID: ".$row['user_id']."
                        <br>

                        <br>
                        <br>
                        
                        <div class='panel-group'>
                          <div class='panel panel-info'>
                          <div class='panel-body'>Today's activity:
                            <ul>
                              <li>Timmy Two Shoes went to '??'</li>
                              <li>Bill Blabla registered to be a volunteer</li>
                            </ul>
                          </div>
                          </div>
                          <div class='panel panel-info'>
                          <div class='panel-body'>Airport pickup list:
                            <ul>
                              <li>Timmy Two Shoes picking up Sammy Somoa from airport:??????</li>
                              <li>Bill Blabla picking up Jimbo Jones from Airport:??????</li>
                            </ul>
                          </div>
                          </div>
                          <div class='panel panel-info'>
                          <div class='panel-body'>Home share list:
                            <ul>
                              <li>picking up Sammy Somoa is staying at Timmy Two Shoes's house from date to date</li>
                              <li>picking up Sammy Somoa is staying at Timmy Two Shoes's house from date to date</li>
                            </ul>
                          </div>

                          <br>
                          <br>
                          <br>
                          <br>
                        </div>
                      </div>

                        <br>

                      </div>

                    </div>
                        <footer class='container-fluid'>
                            <p>&copy; 2016 Team Awesome</p>
                        </footer>

                        <script src='js/jquery-2.1.4.min.js'></script>
                        <script src='js/bootstrap.min.js'></script>
                        <script src='js/script.js'></script>
                    </body>

                </html>";
            }
        }
    }
?>
