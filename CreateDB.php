<!DOCTYPE html>
<html>
    <head>
        <title>Database initialising</title>
    </head>
    <body>
        <?php
        $databaseName = "Restaurant";
        $tableNames = ["Customer", "Location", "Meal", "Reservation"];
        
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
                            Website varchar (200),
                            PostalCode varchar (200),
                            Telephone varchar (200),
                            Hours varchar (200),
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
                            Date date,
                            Time time,
                            OptionalRequest varchar(1000),
                            Telephone varchar(25),
                            Takeout varchar(25),
                            Name varchar(25),
                            FOREIGN KEY (Customer_Id) REFERENCES Customer(Id),
                            FOREIGN KEY (Location_Id) REFERENCES Location(Id)
                        )";
                        $stmt = mysqli_prepare($conn, $sql)
                            or die("Preparation Error 4");
                        mysqli_stmt_execute($stmt)
                            or die(mysqli_error($conn));
                        
                        mysqli_stmt_close($stmt);
                        break;
                }
            }
        }
        
        $locations = [
            [
                "Name" => "Emmen",
                "Address" => "",
                "PostalCode" => "1012 WP Emmen",
                "Website" => "soobway.nl",
                "Telephone" => "020 6262 969",
                "Hours" => "Mon - Sun: 9:00 AM - 5:00 PM",
                "Seats" => 200
            ],
            [
                "Name" => "Assen",
                "Address" => "Nieuwendijk 6",
                "PostalCode" => "012 MK Assen",
                "Website" => "soobway.nl",
                "Telephone" => "020 7893 905",
                "Hours" => "Mon - Fri: 9:00 am - 4:00 pm, Sat - Sun: 9:00 am - 5:00 pm",
                "Seats" => 200
            ],
            [
                "Name" => "Zwolle",
                "Address" => "",
                "PostalCode" => "3511 AW Zwolle",
                "Website" => "soobway.nl",
                "Telephone" => "030 268 42 92",
                "Hours" => "Mon - Fri: 9:00 am - 4:00 pm, Sat - Sun: 9:00 am - 5:00 pm",
                "Seats" => 200
            ],
            [
                "Name" => "Groningen",
                "Address" => "Oudegracht 122",
                "PostalCode" => "3511 Gronigen",
                "Website" => "soobway.nl",
                "Telephone" => "030 268 42 92",
                "Hours" => "Mon - Fri: 9:00 am - 4:00 pm, Sat - Sun: 9:00 am - 5:00 pm",
                "Seats" => 200
            ],
            [
                "Name" => "Volendam",
                "Address" => "Oudegracht 122",
                "PostalCode" => "3511 AW Volendam",
                "Website" => "soobway.nl",
                "Telephone" => "030 268 42 92",
                "Hours" => "Mon - Fri: 9:00 am - 4:00 pm, Sat - Sun: 9:00 am - 5:00 pm",
                "Seats" => 200
            ]
        ];
            
            foreach($locations as $location){
                $sqlLocationInsert = "INSERT INTO `Location`(`Name`,`Address`,`PostalCode`,`Website`,`Telephone`,`Hours`,`Seats`) 
                VALUES 
                (\"" .$location["Name"]. "\",\"" .$location["Address"]. "\",\"" .$location["PostalCode"]. "\",\"" .$location["Website"]. "\",\"" .$location["Telephone"]. "\",\"" .$location["Hours"]. "\",\"" .$location["Seats"]. "\")";
                $stmt = mysqli_prepare($conn, $sqlLocationInsert)
                    or die(mysqli_error($conn));
                mysqli_stmt_execute($stmt)
                    or die(mysqli_error($conn));
                mysqli_stmt_close($stmt);
            }
        ?>
        <p>
            Database should be created
        </p>
    </body>
</html>
