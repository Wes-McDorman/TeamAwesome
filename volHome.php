<?php
    session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "2")) {
        
        include("connection.php");
        
        $query = mysqli_query($dbc, "SELECT * FROM Users WHERE user_id='".$_SESSION['user_id']."'");
        if($query) {
            while($row = mysqli_fetch_assoc($query)) {
                $info = mysqli_query($dbc, "SELECT * FROM Volunteers WHERE user_id='".$row['user_id']."'");
                $rowA = mysqli_fetch_assoc($info);
                
                $pickup = mysqli_query($dbc, "SELECT * FROM VolAvailables WHERE volunteer_id='".$rowA['Volunteer_id']."'");
                $rowB = mysqli_fetch_assoc($pickup);
                
                $pickup_who = mysqli_query($dbc, "SELECT * FROM PickUps WHERE volunteer_id='".$rowA['Volunteer_id']."'");
                $pickup_who_fetch = mysqli_fetch_assoc($pickup_who);
                
                $homeshare_who = mysqli_query($dbc, "SELECT * FROM HomeShares WHERE volunteer_id='".$rowA['Volunteer_id']."'");
                $homeshare_who_fetch = mysqli_fetch_assoc($homeshare_who);
                
                $pickup_stu = mysqli_query($dbc, "SELECT * FROM Students WHERE Student_id='".$pickup_who_fetch['Student_id']."'");
                $pickup_stu_fetch = mysqli_fetch_assoc($pickup_stu);
                
                $homeshare_stu = mysqli_query($dbc, "SELECT * FROM Students WHERE Student_id='".$homeshare_who_fetch['Student_id']."'");
                $homeshare_stu_fetch = mysqli_fetch_assoc($homeshare_stu);
                
                $pickup_stu_info = mysqli_query($dbc, "SELECT * FROM Users WHERE user_id='".$pickup_stu_fetch['user_id']."'");
                $pickup_stu_info_fetch = mysqli_fetch_assoc($pickup_stu_info);
                
                $homeshare_stu_info = mysqli_query($dbc, "SELECT * FROM Users WHERE user_id='".$homeshare_stu_fetch['user_id']."'");
                $homeshare_stu_info_fetch = mysqli_fetch_assoc($homeshare_stu_info);
                
                if($rowB['beginTime'] != null) {
                    $yesno = "Yes";
                } else {
                    $yesno = "No";
                }
                
                if($rowA['beginHomeShare'] != null) {
                    $msg = "Yes";
                } else {
                    $msg = "No";
                }
                
                echo "
                <!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>

                <html>

                    <head>

                        <title>Volunteer Home</title>
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
                                <li class='active'><a href='volHome.php'>Home</a></li>
                                <li class='dropdown'>
                                  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Profile<b class='caret'></b></a>
                                    <ul class='dropdown-menu'>
                                            <li><a href='volProfile.php'>Update Information</a></li>
                                        <li class='divider'></li>
                                        <li class='dropdown-header'>Account Information</li>
                                            <li><a href='volHome.php'>Change Password</a></li>
                                    </ul>
                                </li>
                              </ul>
                                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                          </div><!--/.nav-collapse -->
                        </div>
                      </div>
                    </div>

                    <!-- ============ (CONTENT) ============== -->
                    <div class='col-sm-10 content'>
                        <h2>Volunteer Home Page</h2>
                        Thank you for being a volunteer, ".$row['fName']." ".$row['lName']."!
                        <br>
                        <br>
                         <!-- ===Information displayed === -->
                        <div class='panel-group'>
                          <div class='panel panel-info'>
                          <div class='panel-body'>Volunteer ID: <b>".$rowA['Volunteer_id']."</b></div>
                          </div>
                          <div class='panel panel-info'>
                          <div class='panel-body'>You are picking up <b>".$pickup_stu_info_fetch['fName']." ".$pickup_stu_info_fetch['lName']."</b> from the airport   on <b>".$pickup_who_fetch['date']."</b></div>
                          </div>
                          <div class='panel panel-info'>
                          <div class='panel-body'>Completed tasks: <b>".$homeshare_stu_info_fetch['fName']." ".$homeshare_stu_info_fetch['lName']."</b> will stay at your house from <b>".$homeshare_stu_fetch['beginHomeShare']."</b> to <b>".$homeshare_stu_fetch['endHomeShare']."</b></div>
                          </div>
                        </div>


                          <div>
                              <label>Airport Settings</label>
                          </div>
                          <div class='panel-group'>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Will you pick up students from the airport?: <b>".$yesno."</b></div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Time Period: From <b>".$rowB['beginTime']."</b> to <b>".$rowB['endTime']."</b></div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>How many students plus luggage could your vehicle handle?: <b>".$rowA['passengers']."</b> students and <b>".$rowA['suitcases']."</b> luggages</div>
                            </div>
                          </div>

                            <div>
                                <label>Housing Settings</label>
                            </div>
                          <div class='panel-group'>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Will you provide temporary housing?: <b>".$msg."</b> </div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Home address: <b>".$row['address'].", ".$row['zip']."</b></div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Housing Period: From <b>".$rowA['beginHomeShare']."</b> to <b>".$rowA['endHomeShare']."</b>
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