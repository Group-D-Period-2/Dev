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
         $bugs = "bugs";
        $id = "ID";
        if(isset($_GET['id']))
        {
           $id = $_GET['id'];
           $conn = mysqli_connect ("localhost","root","");
           mysqli_select_db($conn, "restaurant")
           or die("Could not select");
           $select= "SELECT * FROM `" . $customer ."` WHERE ID = \"" . $id . "\"";
           $result = $conn->query($select);
           
  
 
           
             

    
        }else{
            $id = false;
        }
        ?>
        <h2>Editing your username, it's what I do, john.</h2>
        <hr>
    <?php
    if(!$id || !$result || $result->num_rows !=1){
    ?>

    <?php
    }else{
        while($row = $result->fetch_assoc()){ ?>
 
        <form action="bugedit.php?id=<?php print($id)?>" method="POST">
            <p>First Name: </p>
            <input type="text" name="Firstname" value="<?php print($row['Firstname']); ?>"><br>
            <p>Last Name: </p>
            <input type="text" name="Lastname" value="<?php print($row['Lastname']); ?>"><br><br>
            <p>E-Mail: </p>
            <input type="text" name="Email" value="<?php print($row['Email']); ?>"><br><br>
            <input type="submit" name="submit" value="submit">
            
            
        </form>  
        <?php
        }
        if(isset($_POST['submit'])){
                        if(!empty($_POST['Firstname'])){
                if(!empty($_POST['Lastname'])){
                if(!empty($_POST['Email'])){
            $Product = $_POST['Firstname'];
            $Version = $_POST['Lastname'];
            $Hardware = $_POST['Email'];
       
    
    
    $sql= "UPDATE customer SET Firstname = '". $Firstname ."', Lastname = '". $Lastname ."', Email = '". $Email ."' WHERE ID = " . $id . "";
                 $stmt = mysqli_prepare($conn, $sql)
                            or die(mysqli_error($conn));
                 mysqli_stmt_execute($stmt)
                            or die(mysqli_error($conn));
                  mysqli_stmt_close($stmt);
                  ?>
        <script type="text/javascript">
            window.location="Mainpage.php";
            </script>
            <?php
                }else{
                  echo "Please fill in all fields";  
                }           
            }else{
                echo "Please fill in all fields";
            }
                        }else{
                echo "Please fill in all fields";
            }
        }
           }
        ?>
    </body>
</html>
