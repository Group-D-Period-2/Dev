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
        $conn = mysqli_connect("localhost", "root", "")
            or die("Could not connect to database!");
        $databaseExists = mysqli_select_db($conn, "Restaurant");

        // Define variables and initialize with empty values
        $CustomerID = $Date = $GroupSize = $Location = "";
        $CustomerID_err = $Date_err = $GroupSize_err = $Location_err = "";
        $errors = 0;
        
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
   
            if(empty(trim($_POST["CustomerID"]))){
                $errors++;
                $CustomerID_err = "Please enter a name.";
            }
            

            if(empty(trim($_POST["Date"]))){
                $errors++;
                $Date_err = "Please enter a date.";
            }

            if(empty(trim($_POST["GroupSize"]))){
                $errors++;
                $GroupSize_err = "Please enter the size of your group.";
            }
            
            if(empty(trim($_POST["Location"]))){
                $errors++;
                $Location_err = "Please enter a location.";
            }

            if($errors == 0){
                $CustomerID = $_POST["CustomerID"];
                $Date = $_POST["Date"];
                $GroupSize = $_POST["GroupSize"];
                $Location = $_POST["Location"];
                
                // Prepare an insert statement
                $sql = "INSERT INTO `reservation`(`Customer_ID`, `Date_Time`, `Group_Size`, `Location_ID`) VALUES (\"" . $CustomerID . "\",\"" . $Date . "\",\"" . $GroupSize . "\",\"" . $Location . "\")";
                
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
        
              <h2>Reserving</h2>
        <p>Please fill this form to create a reservation.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Name</label>
                <input type="text" name="CustomerID" class="form-control" >
                <span class="help-block"><?php echo $CustomerID_err; ?></span>
                <br />
                <label>Date</label>
                <input type="text" name="Date" class="form-control" >
                <span class="help-block"><?php echo $Date_err; ?></span>
                <br />
                <label>Group Size</label>
                <input type="text" name="GroupSize" class="form-control" >
                <span class="help-block"><?php echo $GroupSize_err; ?></span>
                <br />
                <label>Location</label>
                <input type="text" name="Location" class="form-control" >
                <span class="help-block"><?php echo $Location_err; ?></span>
                <br />

                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
        </form>
    </body>
</html>

    </body>
</html>