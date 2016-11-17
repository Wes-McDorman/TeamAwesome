<?php
    session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "2")) {
        
        include("connection.php");
        
        $query = mysqli_query($dbc, "SELECT user_id, email, fName, lName, phone FROM users WHERE email='".$_SESSION['email']."'");
        if($query) {
            while($row = mysqli_fetch_assoc($query)) {
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
                                            <li><a href='volHome.php'>Update Information</a></li>
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
                          <div class='panel-body'>Volunteer ID:</div>
                          </div>
                          <div class='panel panel-info'>
                          <div class='panel-body'>Your next task:</div>
                          </div>
                          <div class='panel panel-info'>
                          <div class='panel-body'>Completed tasks:</div>
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
                            <div class='panel-body'>Which time period do you prefer to pick up?:</div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>How many students plus luggage could your vehicle handle?:</div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>How many trips to airport are you willing to go?:</div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Comments:</div>
                            </div>
                          </div>

                            <div>
                                <label>Housing Settings</label>
                            </div>
                          <div class='panel-group'>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Will you provide temporary housing?:</div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Home address:</div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>How many students could you host at the same time?:</div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>How long will you provide housing?:</div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Which period of time will you provide housing?:</div>
                            </div>
                            <div class='panel panel-info'>
                            <div class='panel-body'>Comments:</div>
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