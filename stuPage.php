<?php
    session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "1")) {
        
        include("connection.php");
        
        $query = mysqli_query($dbc, "SELECT user_id, email, fName, lName, phone FROM users WHERE user_id='".$_SESSION['user_id']."'");
        if($query) {
            while($row = mysqli_fetch_assoc($query)) {
                $info = mysqli_query($dbc, "SELECT * FROM students WHERE user_id='".$row['user_id']."'");
                $rowA = mysqli_fetch_assoc($info);
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
                                    <li>Student ID: ".$rowA['Student_id']."</li>
                                    <li>Name: ".$row['fName']." ".$row['lName']."</li>
                                    <li>Phone number: ".$row['phone']."</li>
                                    <li>Affiliation: ".$rowA['affiliation']."</li>
                                </ul>
                              </div>
                            </div>
                            <div class='panel panel-info'>
                              <div class='panel-body'><b>Your Airline Information:</b>
                                <ul>
                                    <li>Airline: ".$rowA['airline']."</li>
                                    <li>Flight Number: ".$rowA['flightNumber']."</li>
                                    <li>Arrival Time: ".$rowA['arrivalTime']."</li>
                                </ul>
                              </div>
                            </div>
                            <div class='panel panel-info'>
                              <div class='panel-body'><b>Your Home Share Information:</b>
                                <ul>
                                    <li>Home Share Begins: ".$rowA['beginHomeShare']."</li>
                                    <li>Home Share Ends: ".$rowA['endHomeShare']."</li>
                                    <b>*** If you didn't request home share, you'll see 0000-00-00 00:00:00.</b>
                                </ul>
                              </div>
                            </div>
                        </div>

                        <hr/>

                        <div>
                          <label>Places to go in Atlanta</label>
                        </div>
                        <div class='panel-group'>
                            <div class='panel panel-info'>
                                <div class='panel-body'><a href='http://www.georgiaaquarium.org/experience/visit/tickets' target='_blank'>Georgia Aquarium</a></div>
                            </div>
                            <div class='panel panel-info'>
                                <div class='panel-body'><a href='https://www.worldofcoca-cola.com/purchase-tickets/' target='_blank'>World of Coca-Cola</a></div>
                            </div>
                            <div class='panel panel-info'>
                                <div class='panel-body'><a href='http://www.cnn.com/tour/' target='_blank'>CNN Center</a></div>
                            </div>
                            <div class='panel panel-info'>
                                <div class='panel-body'><a href='http://atlanta.braves.mlb.com/atl/ballpark/information/' target='_blank'>Turner Field</a></div>
                            </div>
                            <div class='panel panel-info'>
                                <div class='panel-body'><a href='http://foxtheatre.org/shows-and-events/' target='_blank'>Fox Theatre</a></div>
                            </div>
                            <div class='panel panel-info'>
                                <div class='panel-body'><a href='http://www.atlantahistorycenter.com/visit-us' target='_blank'>Atlanta History Center</a></div>
                            </div>
                            <div class='panel panel-info'>
                                <div class='panel-body'><a href='http://www.piedmontpark.org/visit/history.html' target='_blank'>Piedmont Park</a></div>
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