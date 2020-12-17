<!DOCTYPE html>
<html>
    <head>
        <title>Database initialising</title>
    </head>
    <body>
        <?php
        $databaseName = "Restaurant";
        $tableNames = ["Customer", "Location", "Meal", "Reservation", "Takeout", "Orders"];
        
        $conn = mysqli_connect("localhost", "root", "")
            or die("Could not connect to database!");
        $databaseExists = mysqli_select_db($conn, $databaseName);
        
        if (!$databaseExists){
            $sql = "CREATE DATABASE " . $databaseName;
            $stmt = mysqli_prepare($conn, $sql)
                or die(mysqli_error($conn));
            mysqli_stmt_execute($stmt)
                or die("Database creation failed");
            mysqli_stmt_close($stmt);
            mysqli_select_db($conn, $databaseName);
        }
        
        foreach($tableNames as $tableName){
            $select = "SELECT * FROM " . $tableName;
            $result = $conn->query($select);
            
            if(!$result){
                switch ($tableName){
                    case "Customer":
                        $sql = "CREATE TABLE " . $tableName . "
                        (
                            Id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            Firstname varchar (200),
                            Lastname varchar (200),
                            Password varchar (200) NOT NULL,
                            Email varchar (200) NOT NULL UNIQUE,
                            Profile_Picture_Location varchar (200)
                        )";
                        $stmt = mysqli_prepare($conn, $sql)
                            or die("Preparation Error 1");
                        mysqli_stmt_execute($stmt)
                            or die(mysqli_error($conn));
                        
                        mysqli_stmt_close($stmt);
                        break;
                        
                    case "Location":
                        $sql = "CREATE TABLE " . $tableName . "
                        (
                            Id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            Name varchar (200),
                            Address varchar (200),
                            Seats int
                        )";
                        $stmt = mysqli_prepare($conn, $sql)
                            or die("Preparation Error 2");
                        mysqli_stmt_execute($stmt)
                            or die(mysqli_error($conn));
                        
                        mysqli_stmt_close($stmt);
                        break;
                        
                    case "Meal":
                        $sql = "CREATE TABLE " . $tableName . "
                        (
                            Id int  UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            Name varchar (200),
                            Price float,
                            Description TEXT,
                            BestDeal tinyint (1)
                        )";
                        $stmt = mysqli_prepare($conn, $sql)
                            or die("Preparation Error 3");
                        mysqli_stmt_execute($stmt)
                            or die(mysqli_error($conn));
                        
                        mysqli_stmt_close($stmt);
                        break;
                        
                    case "Reservation":
                        $sql = "CREATE TABLE " . $tableName . "
                        (
                            Id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            Customer_Id int UNSIGNED NOT NULL,
                            Location_Id int UNSIGNED NOT NULL,
                            Group_Size int,
                            Date_Time DateTime,
                            FOREIGN KEY (Customer_Id) REFERENCES Customer(Id),
                            FOREIGN KEY (Location_Id) REFERENCES Location(Id)
                        )";
                        $stmt = mysqli_prepare($conn, $sql)
                            or die("Preparation Error 4");
                        mysqli_stmt_execute($stmt)
                            or die(mysqli_error($conn));
                        
                        mysqli_stmt_close($stmt);
                        break;
                        
                    case "Takeout":
                        $sql = "CREATE TABLE " . $tableName . "
                        (
                            Id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            Customer_Id int UNSIGNED NOT NULL,
                            Location_Id int UNSIGNED NOT NULL,
                            DeliveryTime DateTime,
                            FOREIGN KEY (Customer_Id) REFERENCES Customer(Id),
                            FOREIGN KEY (Location_Id) REFERENCES Location(Id)
                        )";
                        $stmt = mysqli_prepare($conn, $sql)
                            or die("Preparation Error 5");
                        mysqli_stmt_execute($stmt)
                            or die(mysqli_error($conn));
                        
                        mysqli_stmt_close($stmt);
                        break;
                        
                    case "Orders":
                        $sql = "CREATE TABLE " . $tableName . "
                        (
                            Meal_Id int UNSIGNED NOT NULL,
                            Takeout_Id int UNSIGNED NOT NULL,
                            Amount int,
                            FOREIGN KEY (Meal_Id) REFERENCES Meal(Id),
                            FOREIGN KEY (Takeout_Id) REFERENCES Takeout(Id),
                            CONSTRAINT Compkey_MEALID_TAKEOUTID PRIMARY KEY (Meal_Id, Takeout_Id)
                        )";
                        $stmt = mysqli_prepare($conn, $sql)
                            or die("Preparation Error 6");
                        mysqli_stmt_execute($stmt)
                            or die(mysqli_error($conn));
                        
                        mysqli_stmt_close($stmt);
                        break;
                }
            }
        }
        
        ?>
        <p>
            Database should be created
        </p>
    </body>
</html>
