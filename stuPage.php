<?php
    session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "1")) {
        
        include("connection.php");
        
        $query = mysqli_query($dbc, "SELECT user_id, email, fName, lName, phone FROM users WHERE user_id='".$_SESSION['user_id']."'");
        if($query) {
            while($row = mysqli_fetch_assoc($query)) {
                $info = mysqli_query($dbc, "SELECT * FROM students WHERE user_id='".$row['user_id']."'");
                $rowA = mysqli_fetch_assoc($info);
                
                $pickup = mysqli_query($dbc, "SELECT * FROM pickups WHERE Student_id='".$rowA['Student_id']."'");
                $pickup_fetch = mysqli_fetch_assoc($pickup);
                
                $homeShare = mysqli_query($dbc, "SELECT * FROM homeshares WHERE Student_id='".$rowA['Student_id']."'");
                $homeShare_fetch = mysqli_fetch_assoc($homeShare);
                
                $pickup_vol = mysqli_query($dbc, "SELECT * FROM volavailables WHERE Volunteer_id='".$pickup_fetch['Volunteer_id']."'");
                $pickup_vol_fetch = mysqli_fetch_assoc($pickup_vol);
                
                $homeshare_vol = mysqli_query($dbc, "SELECT * FROM volunteers WHERE Volunteer_id='".$homeShare_fetch['Volunteer_id']."'");
                $homeshare_vol_fetch = mysqli_fetch_assoc($homeshare_vol);
                
                $pickup_vol_info = mysqli_query($dbc, "SELECT * FROM users WHERE user_id='".$pickup_vol_fetch['user_id']."'");
                $pickup_vol_fetch = mysqli_fetch_assoc($pickup_vol_info);
                
                $homeshare_vol_info = mysqli_query($dbc, "SELECT * FROM users WHERE user_id='".$homeshare_vol_fetch['user_id']."'");
                $homeshare_vol_info_fetch = mysqli_fetch_assoc($homeshare_vol_info);
                
                if($rowA['beginHomeShare'] != null) {
                    $msg = "Yes";
                } else {
                    $msg = "No";
                }
                
                echo "
                <!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>

                <html>

                    <head>

                        <title>Student Home</title>
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
                                <li class='active'><a href='stuPage.php'>Home</a></li>
                                <li class='dropdown'>
                                  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Profile<b class='caret'></b></a>
                                    <ul class='dropdown-menu'>
                                            <li><a href='stuProfile.php'>Update Information</a></li>
                                        <li class='divider'></li>
                                        <li class='dropdown-header'>Account Information</li>
                                            <li><a href='changepassword.php'>Change Password</a></li>
                                    </ul>
                                </li>
                                <li><a href='stuHelpful.php'>Helpful Links</a></li>
                              </ul>
                                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                          </div><!--/.nav-collapse -->
                        </div>
                      </div>
                    </div>

                    <!-- ============ (CONTENT) ============== -->
                    <div class='col-sm-10 content'>
                        <h2>Student Page</h2>
                          Thank you for choosing International Student Hub, ".$row['fName']." ".$row['lName']."!
                        <br>
                        <br>
                         <!-- ===Information displayed === -->
                        <div class='panel-group'>
                            <div class='panel panel-info'>
                                <div class='panel-body'><b>General Information:</b>
                                    <ul>
                                        <li>Student ID: <b>".$rowA['Student_id']."</b></li>
                                        <li>Name: <b>".$row['fName']." ".$row['lName']."</b></li>
                                        <li>Phone number: <b>".$row['phone']."</b></li>
                                        <li>Affiliation: <b>".$rowA['affiliation']."</b></li>
                                    </ul>
                                </div>
                            </div>
                            <div class='panel panel-info'>
                                <div class='panel-body'><b>Your Airline Information:</b>
                                    <ul>
                                        <li><b>".$pickup_vol_fetch['fName']." ".$pickup_vol_fetch['lName']."</b> will pick you up from the airport</li>
                                        <li>Airline: <b>".$rowA['airline']."</b></li>
                                        <li>Flight Number: <b>".$rowA['flightNumber']."</b></li>
                                        <li>Arrival Time: <b>".$rowA['arrivalTime']."</b></li>
                                    </ul>
                                </div>
                            </div>
                            <div class='panel panel-info'>
                                <div class='panel-body'><b>Your Home Share Information:</b>
                                    <ul>
                                        <li>Did you request a Home Share? <b>".$msg."</b></li>
                                        <li>You will stay at <b>".$homeshare_vol_info_fetch['fName']." ".$homeshare_vol_info_fetch['lName']."</b>'s house.
                                            <ul>
                                                <li>Period: from <b>".$rowA['beginHomeShare']."</b> to <b>".$rowA['endHomeShare']."</b></li>
                                                <li>Home Share Address: <b>".$homeshare_vol_info_fetch['address']." ".$homeshare_vol_info_fetch['zip']."</b></li>
                                                <li>Home Share Phone Number: <b>".$homeshare_vol_info_fetch['phone']."</b></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <br><br><br><br>
                        <br>

                    </div>

                        <br>

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