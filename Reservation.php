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
        <?php// Include config file
        $conn = mysqli_connect("localhost", "root", "")
            or die("Could not connect to database!");
        $databaseExists = mysqli_select_db($conn, "Restaurant");

        // Define variables and initialize with empty values
        $firstname = $lastname = $email = $password = "";
        $firstname_err = $lastname_err = $email_err = $password_err = "";
        $errors = 0;
        
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            // Validate firstname
            if(empty(trim($_POST["CustomerID"]))){
                $errors++;
                $firstname_err = "Please enter a name.";
            }
            
            // Validate lastname
            if(empty(trim($_POST["Date"]))){
                $errors++;
                $lastname_err = "Please enter a date.";
            }
            
            //Validate email
            if(empty(trim($_POST["Groupsize"]))){
                $errors++;
                $email_err = "Please enter the size of your group.";
            }
            
            if(empty(trim($_POST["Location"]))){
                $errors++;
                $password_err = "Please enter a location.";
            }
            
            
            // Check input errors before inserting in database
            if($errors == 0){
                $firstname = $_POST["CustomerID"];
                $lastname = $_POST["Date"];
                $email = $_POST["Groupsize"];
                $password = $_POST["Location"];
                
                // Prepare an insert statement
                $sql = "INSERT INTO `reservation`(`Customer_ID`, `Date_Time`, `Group_Size`, `Location_ID`) VALUES (\"" . $firstname . "\",\"" . $lastname . "\",\"" . $password . "\",\"" . $email . "\")";
                
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
                <label>Name</label>
                <input type="text" name="CustomerID" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
                <br />
                <label>Date</label>
                <input type="password" name="Date" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
                <br />
                <label>Group Size</label>
                <input type="password" name="GroupSize" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
                <br />
                <label>Location</label>
                <input type="password" name="Location" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
                <br />

                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </body>
</html>

    </body>
</html>
