<?php
    session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "2")) {
        
        include("connection.php");
        
        $query = mysqli_query($dbc, "SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'");
        if($query) {
            while($row = mysqli_fetch_assoc($query)) {
                $info = mysqli_query($dbc, "SELECT * FROM volunteers WHERE user_id='".$row['user_id']."'");
                $rowA = mysqli_fetch_assoc($info);
                $pickup = mysqli_query($dbc, "SELECT * FROM volavailables WHERE volunteer_id='".$rowA['Volunteer_id']."'");
                $rowB = mysqli_fetch_assoc($pickup);
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
                          <div class='panel-body'>Your next task: </div>
                          </div>
                          <div class='panel panel-info'>
                          <div class='panel-body'>Completed tasks: </div>
                          </div>
                        </div>


                          <div>
                              <label>Airport Settings</label>
                          </div>
                          <div class='panel-group'>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Will you pick up students from the airport?:</div>
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
                            <div class='panel-body'>Will you provide temporary housing?:<br/>
                            <b>*** If you didn't provide home share, you'll see 0000-00-00 00:00:00 on Housing Period.</b></div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Home address: <b>".$row['address'].", ".$row['zip']."</b></div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Housing Period: From <b>".$rowA['beginHomeShare']."</b> to <b>".$rowA['endHomeShare']."</b></div>
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