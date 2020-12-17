<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
          
    <meta charset="UTF-8">
    <title>Login</title>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>

    </head>
    <body>
        <?php
        // Initialize the session
        session_start();
        
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            header("location: index.php");
            exit;
        }
        
        // Connect to database
        $conn = mysqli_connect("localhost", "root", "")
            or die("Could not connect to database!");
        mysqli_select_db($conn, "Restaurant")
            or die("Database could not be selected");
        
        // Define variables and initialize with empty values
        $email = $password = "";
        $email_err = $password_err = "";
        
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
 
            // Check if username is empty
            if(empty(trim($_POST["email"]))){
                $email_err = "Please enter username.";
            } else {
                $email = trim($_POST["email"]);
            }
            
            // Check if password is empty
            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter your password.";
            } else {
                $password = trim($_POST["password"]);
            }
            
            // Validate credentials
            if(empty($email_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT id, email, password FROM Customer WHERE email = \"" . $email . "\"";
                $result = $conn->query($sql);
        
                $customer = $result->fetch_assoc();
                
                // Check if username exists
                if($customer != NULL){     
                    //Verify password
                    if($customer['password'] == $password){
                        // Password is correct, so start a new session
                        session_start();
                            
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $customer['id'];
                        $_SESSION["email"] = $email;                            
                            
                        // Redirect user to welcome page
                        header("location: index.php");
                    }else{
                        // Display an error message if password is not valid
                        $password_err = "The password you entered was not valid.";
                    }
                }else{
                    $email_err = "The email you entered has not been registered.";
                }
            }
            mysqli_close($conn);
        }
        ?>
        <div class="wrapper">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>E-mail</label><br>
                <input type="text" name="email" class="form-control" autocomplete="off" value="<?php echo $email; ?>">
                <p><?php echo $email_err ?></p>
                <label>Password</label>
                <br>
                <input type="password" name="password" class="form-control">
                <p><?php echo $password_err ?></p>
                <input type="submit" class="btn btn-primary" value="Login">
                <p>Don't have an account? <a href="Registration.php">Sign up now</a>.</p>
            </form>
        </div>
    </body>
</html>
