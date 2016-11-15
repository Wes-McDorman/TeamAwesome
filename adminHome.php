<?php
    session_start();

    if ((isset($_SESSION['login']) && $_SESSION['login'] == "0")) {
        
        include("connection.php");
        
        $query = mysqli_query($dbc, "SELECT user_id, email, fName, lName, phone FROM users WHERE email='".$_SESSION['email']."'");
        if($query) {
            while($row = mysqli_fetch_assoc($query)) {
                echo "
                <!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>

                <html>

                    <head>

                        <title>Admin Home</title>
                        <link rel='stylesheet' href='styles/bootstrap.min.css'>
                        <link rel='stylesheet' href='styles/styles.css'>

                    </head>

                    <body>

                    <!-- ============ THE HEADER SECTION ============== -->

                    <div class='container banner' id='banner'>
                      <div class='row banner'>
                          <h1> <img src='images/Logo.png' id='logo'> <strong>International Students</strong>  HUB</h1>
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
                                <li class='active'><a href='adminHome.php'>Home</a></li>
                                <li><a href='adminStuView.html'>Student Database</a></li>
                                <li><a href='adminVolView.html'>Volunteer Database</a></li>
                                <li class='dropdown'>
                                  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Manage<b class='caret'></b></a>
                                    <ul class='dropdown-menu'>
                                        <li class='dropdown-header'>Manage Student</li>
                                            <li><a href='adminHome.php'>Update Information</a></li>
                                            <li><a href='adminHome.php'>Delete Student</a></li>
                                        <li class='divider'></li>
                                        <li class='dropdown-header'>Manage Volunteer</li>
                                            <li><a href='adminHome.php'>Update Information</a></li>
                                            <li><a href='adminHome.php'>Delete Volunteer</a></li>
                                        <li class='divider'></li>
                                        <li class='dropdown-header'>Admin only</li>
                                            <li><a href='adminHome.php'>Update Admin Information</a></li>
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
                        <h2>Admin Home Page</h2>

                        <br>
                          Hello, ".$row['fName']." ".$row['lName']."! Your admin ID: ".$row['user_id']."
                        <br>

                        <br>
                        <br>
                      <div class='col-sm-10 content'>
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
                          <div class='panel-body'>General requests:
                              <ol>
                                <li>This one</li>
                                <li>That one</li>
                              </ol>
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