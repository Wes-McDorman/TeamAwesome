<?php
error_reporting(0);
include("connection.php");
//grab values email and password from login form

$login_email = $_POST['login_email']; //must matching with the name in the login form
$login_password = $_POST['login_pw'];

//create the query and number of rows returned from the query
$query = mysqli_query($dbc, "SELECT * FROM users WHERE email='".$login_email."'");
$numrows = mysqli_num_rows($query);
// if user clicked submit
if($_SERVER['REQUEST_METHOD'] == 'POST'){

//create condition to check if there is 1 row with that email
if($numrows != 0){
//grab the email and password from that row returned before
	while($row = mysqli_fetch_array($query)){	
		$dbemail = $row['email']; //must matching with the field name in your database table;
		$dbpass = $row['password'];
		$dbfirstname = $row['fName'];	
		$dblastname = $row['lName'];
        $dbuser_type = $row['user_type'];
		}
	
//create condition to check if email and password are equal to the returned row	
	
	if($login_email==$dbemail){
		if($login_password==$dbpass){
            if($dbuser_type == 'stu') {
                
                session_start();
                $_SESSION['login'] = "1";
                $_SESSION['email'] = $dbemail;
                include("stuPage.php");
                
            } if($dbuser_type == 'vol') {
                
                session_start();
                $_SESSION['login'] = "2";
                $_SESSION['email'] = $dbemail;
                include("volHome.html");
                
            } else {
                
                session_start();
                $_SESSION['login'] = "0";
                $_SESSION['email'] = $dbemail;
                include("adminHome.html");
            }
            
		}else{
		
			echo "<html>
                    <head>
                        <title>Team Awesome</title>
                        <link rel='stylesheet' href='styles/bootstrap.min.css'>
                        <link rel='stylesheet' href='styles/styles.css'>
                        <script>
                            function goBack() {
                                window.history.back();
                            }
                        </script>
                    </head>
                    <body>
                        <h1>Your password is incorrect!</h1>
                        <button class='btn btn-info' onclick='goBack()'>Go Back</button>
                    </body>
                </html>";
		
		}
	}else{
	
		echo "<html>
                <head>
                    <title>Team Awesome</title>
                    <link rel='stylesheet' href='styles/bootstrap.min.css'>
                    <link rel='stylesheet' href='styles/styles.css'>
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                </head>
                <body>
                    <h1>Your email is incorrect!</h1>
                    <button class='btn btn-info' onclick='goBack()'>Go Back</button>
                </body>
            </html>";
	
	}
	
}else{

echo "<html>
        <head>
            <title>Team Awesome</title>
            <link rel='stylesheet' href='styles/bootstrap.min.css'>
            <link rel='stylesheet' href='styles/styles.css'>
        </head>
        <body>
            <h1>Invalid credentials! If you are not registered please register below...</h1>
            <a href='stuRegister.html'>Students</a> | <a href='volRegister.html'>Volunteer</a>
        </body>
      </html>
            ";
}
}else{

	echo "Please Login...";
}

?>