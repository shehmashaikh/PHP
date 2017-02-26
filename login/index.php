<!DOCTYPE html>
<?php
    
    if(!empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['designation'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $designation = $_POST['designation'];
        login($email,$password,$designation);
    }

    function login($email,$password,$designation){
        $databaseHost = 'localhost:3307';
        $databaseUser = 'root';
        $databasePassword = '';
        $databaseName = 'login';

        // connecting to the server and select dba

        $connection = new mysqli ($databaseHost, $databaseUser, $databasePassword, $databaseName);
        //check connection
        if($connection->connect_error){
            die("Connecrion failed: " . $connection->connect_error);
            echo($connection->connect_error);
        }
        
        // query
        switch ($designation) {
            //if professor wants to login
            case 'p':
                $query = "SELECT `professorsID`, `ProfessorsName`, `professorsPassword`, `professorsEmail` FROM `professors` WHERE `professorsEmail` = '$email' AND `professorsPassword` = '$password'";
                $result = $connection->query($query);

                if($result->num_rows > 0 ){
                    while($row = $result->fetch_assoc()){
                        echo "Welcome Prof." . $row['ProfessorsName'];
                    }
                }else{
                    echo "Failed to Login";
                }
                break;
            //if student wants to login
            case 's':
                $query = "SELECT `StudentID`, `StudentFirstName`, `studentLastName`, `studentPassword`, `studentEmail` FROM `studens` WHERE `studentEmail` = '$email' AND `studentPassword` = '$password'";
                $result = $connection->query($query);

                if($result->num_rows > 0 ){
                    while($row = $result->fetch_assoc()){
                        echo "Welcome" . $row['StudentFirstName']." ".$row['studentLastName'];
                    }
                }else{
                    echo "Failed to Login";
                }
                break;
            //if nothing is selected
            default:
                //TODO:
                break;
        }
        
    }


?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"> </link>
</head>
<body>

<div id="frm" class="container">
    <img src="img/Logo.png">
    <form action="index.php" method="post">
        <p>

            <input type="text" id="email" name="email" placeholder="Enter username"/>
        </p>
        <p>

            <input type="password" id="password" name="password" placeholder="Enter password"/>
        </p>
        <p class="prof"> <label>
            <img src ="img/icon.png">
            <input type="radio" name="designation" value="p"> Professor

            <input type="radio" name="designation" value="s"> Student </label>
        </p>


        <p class="remember_me"> <label>
            <input type="checkbox" name="remember" value="Remember me"> Remember me </label>
        </p>
        <p>
            <input type="submit" id="btn" value="LOGIN" class="btn-login"/></br>
        </p>
        <a href="">Forgot your Password?</a>
    </form>
</div>
</body>
</html>
