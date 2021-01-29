<!doctype HTML>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
$pageTitle = "Reservation";
$underline = "r";
include('inc/header.php');

        $conn = mysqli_connect("localhost", "root", "")
            or die("Could not connect to database!");
        $databaseExists = mysqli_select_db($conn, "Restaurant");

        // Define variables and initialize with empty values
        $CustomerID = $Date = $GroupSize = $Time = $Location = $Telephone = $OptionalRequest = "";
        $CustomerID_err = $Date_err = $Time_err = $GroupSize_err = $Location_err = $Telephone_err = $user_choice_err = "";
        $errors = 0;
        
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if(empty($_POST["user_choice"])){
                $errors++;
                $user_choice_err = "Please choose order type.";
            }
   
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
            
             if(empty(trim($_POST["user_tel"]))){
                $errors++;
                $Telephone_err = "Please enter a telephone number.";
            }
                  if(empty(trim($_POST["user_tel"]))){
                $errors++;
                $Telephone_err = "Please enter a telephone number.";
            }

            if($errors == 0){
                $CustomerName = $_POST["CustomerID"];
                $Date = $_POST["Date"];
                $GroupSize = $_POST["GroupSize"];
                $Location = $_POST["Location"];
                $Telephone = $_POST["user_tel"];
                $OptionalRequest = $_POST["user_request"];
                $Time = $_POST["Time"];
                $CustomerID = $_SESSION["id"];
                $Choice = $_POST["user_choice"];
                
                $sql = "INSERT INTO `Reservation`(`Customer_Id`, `Location_Id`, `Group_Size`, `Date`, `OptionalRequest`, `Telephone`, `Time`, `Name`, `Takeout`) VALUES (" . $CustomerID . "," .$Location. "," .$GroupSize. ",\"" .$Date. "\",\"" .$OptionalRequest. "\",\"" .$Telephone. "\",\"" .$Time. "\",\"" .$CustomerName ."\",". $Choice .")";
                
                $stmt = mysqli_prepare($conn, $sql)
                    or var_dump($sql);
                mysqli_stmt_execute($stmt)
                    or die(mysqli_error($conn));
                mysqli_stmt_close($stmt);
                
                
            }
            // Close connection
            mysqli_close($conn);
        }
        ?>

    <div class="form-res">
        <form class="res-form shadow" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1 id="res-title">Reservation</h1>

        <fieldset>
          <legend>Required Info</legend>
          <label>Choose:</label><br />
          <label>Sit In <input type="radio"  value="false" name="user_choice"></label>
          <label>Pick Up <input type="radio"  value="true" name="user_choice"></label><br />
        <span class="help-block"><?php echo $user_choice_err; ?></span>

          <label for="name">Name:</label>
          <input type="text" id="CustomerID" name="CustomerID"> <br />
          <span class="help-block"><?php echo $CustomerID_err; ?></span>

          <label for="cell">Tel:</label>
          <input type="tel" id="user_tel" name="user_tel"><br />
          <span class="help-block"><?php echo $Telephone_err; ?></span>

           <label for="location">Location:</label>
          <select id="location" name="Location">
			<option value="">Choose a location</option>
			<option value="1">Emmen</option>
			<option value="2">Assen</option>
			<option value="3">Zwolle</option>
			<option value="4">Groningen</option>
			<option value="5">Volendam</option>
		  </select>
           <span class="help-block"><?php echo $Location_err; ?></span>

          <label for="date"><img class="res-icon" src="img/reservation/calendar.svg" alt="reservation icon"></label>
          <input type="date" id="date" name="Date"><br />
          <span class="help-block"><?php echo $Date_err; ?></span>

          <label for="time"><img class="res-icon" src="img/reservation/time.svg" alt="clock icon"></label>
          <input type="time" id="Time" name="Time">
          <span class="help-block"><?php echo $Time_err; ?></span>

          <label for="people"><img class="res-icon" src="img/reservation/people.svg" alt="people icon"></label>
          <input type="number" id="GroupSize" name="GroupSize">
          <span class="help-block"><?php echo $GroupSize_err; ?></span>
        </fieldset>

        <fieldset>
          <legend>Optional</legend>

          <label for="special-request">Special Request</label>
          <textarea id="special-request" name="user_request"></textarea><br />
        </fieldset>

        <button type="submit">Reserve</button>

      </form>
    </div>
	<?php include('inc/footer.php'); ?> 