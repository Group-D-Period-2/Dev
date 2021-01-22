<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="grid-container">

        <div class="grid-nav">
            <?php
            $pageTitle = "Login";
            $underline = "t";
            include('inc/header.php');
            ?>
            
            <?php

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Check if username is empty
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter username.";
        } else {
            $email = trim($_POST["email"]);
        }

        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter password.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if (empty($email_err) && empty($password_err)) {
            // Prepare a select statement
            $sql = "SELECT id, email, password, Profile_Picture_Location FROM Customer WHERE email = \"" . $email . "\"";
            $result = $conn->query($sql);

            $customer = $result->fetch_assoc();

            // Check if username exists
            if ($customer != NULL) {
                //Verify password
                if ($customer['password'] == $password) {
                    // Password is correct, so start a new session
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $customer['id'];
                    $_SESSION["email"] = $email;
                    $_SESSION["profile_pic"] = $customer["Profile_Picture_Location"];

                    // Redirect user to welcome page
//                    header("location: index.php");
                } else {
                    // Display an error message if password is not valid
                    $password_err = "The password you entered was not valid.";
                }
            } else {
                $email_err = "The email you entered has not been registered.";
            }
        }
        mysqli_close($conn);
    }
    ?>

        </div>
        <div class="grid-main">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Login</h2>
                <p><label>Email</label></p>
                <p><input type="text" name="email" class="form-control" autocomplete="off" value="<?php echo $email; ?>"></p>
                <p><span><?php echo $email_err ?></span></p>
                <p><label>Password</label></p>
                <p><input type="password" name="password" class="form-control"></p>
                <p><span><?php echo $password_err ?></span></p>
                <p><input type="submit" class="btn btn-primary" value="Login" id="button"></p>
                <p> Don't have an account? <a href="Registration.php">Sign up now</a></p>
            </form>


        </div>
        <div class="grid-footer">

            <?php include('inc/gridFooter.php'); ?>

        </div>
    </div>
</body>

</html>