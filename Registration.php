<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
// Include config file
        $conn = mysqli_connect("localhost", "root", "")
            or die("Could not connect to database!");
        $databaseExists = mysqli_select_db($conn, "Restaurant");

        // Define variables and initialize with empty values
        $firstname = $lastname = $email = $password = $confirm_password = "";
        $firstname_err = $lastname_err = $email_err = $password_err = $confirm_password_err = "";
        $errors = 0;
        
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            // Validate firstname
            if(empty(trim($_POST["firstname"]))){
                $errors++;
                $firstname_err = "Please enter a first name.";
            }
            
            // Validate lastname
            if(empty(trim($_POST["lastname"]))){
                $errors++;
                $lastname_err = "Please enter a last name.";
            }
            
            //Validate email
            if(empty(trim($_POST["email"]))){
                $errors++;
                $email_err = "Please enter an email.";
            }
            
            if(empty(trim($_POST["password"]))){
                $errors++;
                $password_err = "Please enter a password.";
            }
            
            if(empty(trim($_POST["confirm_password"]))){
                $errors++;
                $confirm_password_err = "Please fill in confirmed password.";
            }elseif($_POST["password"] != $_POST["confirm_password"]){
                $errors++;
                $confirm_password_err = "Please fill in the same password as above.";
            }
            
            // Check input errors before inserting in database
            if($errors == 0){
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                
                // Prepare an insert statement
                $sql = "INSERT INTO `Customer`(`Firstname`, `Lastname`, `Password`, `Email`) VALUES (\"" . $firstname . "\",\"" . $lastname . "\",\"" . $password . "\",\"" . $email . "\")";
                
                $stmt = mysqli_prepare($conn, $sql)
                    or die("Preperation error");
                mysqli_stmt_execute($stmt)
                    or die(mysqli_error($conn));
                mysqli_stmt_close($stmt);
            }
            // Close connection
            mysqli_close($conn);
        }
        ?>
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Firstname</label>
            <input type="text" name="firstname" class="form-control" autocomplete="off" value="<?php echo $firstname; ?>">
            <span class="help-block"><?php echo $firstname_err; ?></span>
            <br /><br />
            <label>Lastname</label>
            <input type="text" name="lastname" class="form-control" autocomplete="off" value="<?php echo $lastname; ?>">
            <span class="help-block"><?php echo $lastname_err; ?></span>
            <br /><br />
            <label>E-mail</label>
            <input type="text" name="email" class="form-control" autocomplete="off" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
            <br /><br />
            <label>Password</label>
            <input type="password" name="password" class="form-control" autocomplete="off" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
            <br /><br />
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" autocomplete="off" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
            <br /><br />
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </body>
</html>
