<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    // Include config file
    $conn = mysqli_connect("localhost", "root", "")
        or die("Could not connect to database!");
    $databaseExists = mysqli_select_db($conn, "Restaurant");

    // Define variables and initialize with empty values
    $firstname = $lastname = $email = $password = $confirm_password = $profile_picture = "";
    $firstname_err = $lastname_err = $email_err = $password_err = $confirm_password_err = $profile_picture_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = 0;

        // Validate firstname
        if (empty(trim($_POST["firstname"]))) {
            $errors++;
            $firstname_err = "Please enter a first name.";
        }

        // Validate lastname
        if (empty(trim($_POST["lastname"]))) {
            $errors++;
            $lastname_err = "Please enter a last name.";
        }

        //Validate email
        if (empty(trim($_POST["email"]))) {
            $errors++;
            $email_err = "Please enter an email.";
        }

        if (empty(trim($_POST["password"]))) {
            $errors++;
            $password_err = "Please enter a password.";
        }

        if (empty(trim($_POST["confirm_password"]))) {
            $errors++;
            $confirm_password_err = "Please fill in confirmed password.";
        } elseif ($_POST["password"] != $_POST["confirm_password"]) {
            $errors++;
            $confirm_password_err = "Please fill in the same password as above.";
        }
        
        if (!empty($_FILES["profile_picture"]["name"])){
            if($_FILES["profile_picture"]["type"] != "image/png" && $_FILES["profile_picture"]["type"] != "image/jpeg"){
                $errors++;
                $profile_picture_err = "Please pick an image.";
            }
        }

        // Check input errors before inserting in database
        if ($errors == 0) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            if(!empty($_FILES["profile_picture"]["name"])){
                var_dump(1);
                $target_dir = "uploads/";
                $profile_picture = $target_dir . basename($_FILES["profile_picture"]["name"]);
                
                if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"],$profile_picture)){
                    // Prepare an insert statement
            $sql = "INSERT INTO `Customer`(`Firstname`, `Lastname`, `Password`, `Email`,`Profile_Picture_Location`) VALUES (\"" . $firstname . "\",\"" . $lastname . "\",\"" . $password . "\",\"" . $email . "\",\"" . $profile_picture . "\")";

                    
            $stmt = mysqli_prepare($conn, $sql)
                or die(mysqli_error($conn));
            mysqli_stmt_execute($stmt)
                or die(mysqli_error($conn));
            mysqli_stmt_close($stmt);
                }
            }else{
                // Prepare an insert statement
                $sql = "INSERT INTO `Customer`(`Firstname`, `Lastname`, `Password`, `Email`) VALUES (\"" . $firstname . "\",\"" . $lastname . "\",\"" . $password . "\",\"" . $email . "\")";
                $stmt = mysqli_prepare($conn, $sql)
                    or die("Preperation error");
                mysqli_stmt_execute($stmt)
                    or die(mysqli_error($conn));
                mysqli_stmt_close($stmt);
            }
            
            $sqlGet = "SELECT id, email, Profile_Picture_Location FROM Customer WHERE email = \"" . $email . "\"";
            $result = $conn->query($sqlGet);

            $customer = $result->fetch_assoc();
            
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $customer['id'];
            $_SESSION["email"] = $email;
            if(!empty($_FILES["profile_picture"]["name"])){
                $_SESSION["profile_pic"] = $profile_picture;
            }else{
                $_SESSION["profile_pic"] = null;
            }
            header("location: index.php");
            
        }
        // Close connection
        mysqli_close($conn);
    }
    ?>

    <div class="grid-container">
        <div class="grid-nav">
            <?php
            $underline = "e";
            include('inc/header.php');
            ?>
        </div>
        <div class="grid-main">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <h2>Register</h2>
                
                <p><label>First Name</label></p>
                <input type="text" name="firstname" class="form-control" autocomplete="off" value="<?php echo $firstname; ?>">
                <p><span class="help-block"><?php echo $firstname_err; ?></span></p>
                <p><label>Last Name</label></p>
                <input type="text" name="lastname" class="form-control" autocomplete="off" value="<?php echo $lastname; ?>">
                <p><span class="help-block"><?php echo $lastname_err; ?></span></p>


                <p><label>Email</label></p>
                <input type="text" name="email" class="form-control" autocomplete="off" value="<?php echo $email; ?>">
                <p><span class="help-block"><?php echo $email_err; ?></span></p>
                <p><label>Password</label></p>
                <p><input type="password" name="password" class="form-control" autocomplete="off" value="<?php echo $password; ?>"></p>
                <p><span class="help-block"><?php echo $password_err; ?></span></p>
                <p><label>Confirm Password</label></p>
                <p><input type="password" name="confirm_password" class="form-control" autocomplete="off" value="<?php echo $confirm_password; ?>"></p>
                <p><span class="help-block"><?php echo $confirm_password_err; ?></span></p>
                <p><label>Profile Picture</label></p>
                <p><input type="file" name="profile_picture" class="form-control"  class="pic" accept="image/png, image/jpeg"></p>
                <p><span class="help-block"><?php echo $profile_picture_err; ?></span></p>


                <input type="submit" class="btn btn-primary" value="Submit" id="button">
                <input type="reset" class="btn btn-default" value="Reset" id="button-res">
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>


        </div>
        <div class="grid-footer">

            <?php include('inc/gridFooter.php'); ?>
        </div>
        </div>
   </body>
</html>
