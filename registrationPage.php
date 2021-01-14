<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soobway</title>
    <link rel="stylesheet" href="style.css">
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
    <div class="grid-container">
        <div class="grid-nav">
            <img class="logo-image" src="img/ourlogo.png">
            
        </div>
        <div class="grid-main">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Register</h2>
                <div class="collumn">
                    <p><label>First Name</label></p>
                    <input type="text" name="firstname" class="form-control" autocomplete="off" value="<?php echo $firstname; ?>">
                    <p><span class="help-block"><?php echo $firstname_err; ?></span></p>
                    <p><label>Last Name</label></p>
                    <input type="text" name="lastname" class="form-control" autocomplete="off" value="<?php echo $lastname; ?>">
                    <p><span class="help-block"><?php echo $lastname_err; ?></span></p>
                </div>
                <div class="collumn-2">
                    <p><label>Email</label></p>
                    <input type="text" name="email" class="form-control" autocomplete="off" value="<?php echo $email; ?>">
                    <p><span class="help-block"><?php echo $email_err; ?></span></p>
                    <p><label>Password</label></p>
                    <p><input type="password" name="password" class="form-control" autocomplete="off" value="<?php echo $password; ?>"></p>
                    <p><span class="help-block"><?php echo $password_err; ?></span></p>
                    <label>Confirm Password</label></p>
                    <p><input type="password" name="confirm_password" class="form-control" autocomplete="off" value="<?php echo $confirm_password; ?>"></p>
                    <p><span class="help-block"><?php echo $confirm_password_err; ?></span></p>
                </div>
                <div class="submit">
                <input type="submit" class="btn btn-primary" value="Submit" id="button">
                <input type="reset" class="btn btn-default" value="Reset" id="button-res">
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
                </div>
            </form>
        </div>
        <div class="grid-footer">
            <div class="footer">
                <img class="footer-logo-image" src="img/ourlogo.png" alt="brand-logo">
            </div>

            <div class="footer-2">
                <h3>Contacts: </h3>
                <p>Tel: +31590586656</p>
                <p>email: soobway@gmail.com</p>
            </div>

            <div class="footer-3">
                <h3>Follow us on:</h3>
                <p id="social">
                    <a href=""><img class="social" src="img/insta.png" alt="instagramLogo"></a>
                    <a href=""><img class="social" src="img/linkedin.png" alt="instagramLogo"></a>
                    <a href=""><img class="social" src="img/youtube.png" alt="instagramLogo"></a>
                </p>

            </div>
        </div>
    </div>
</body>

</html>