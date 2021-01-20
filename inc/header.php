<!DOCTYPE html>
<html>
   <head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $pageTitle; ?></title>
      <link rel="stylesheet" type="text/css" href="style.css">
   </head>
   <body>
      <div>
      <div class="header">
         <img class="logo-image" src="img/ourlogo.png" alt="logo">
         <nav class="nav">
            
               <a href="index.php" class="<?php if($underline == "h"){ echo "line";} ?>">Home</a> 
               <a href="reservation.php"  class="<?php if($underline == "r") echo "line"; ?>">Reservation</a> 
               <a href="menu.php"  class="<?php if($underline == "m") echo "line"; ?>">Menu</a></li>
               <a href="location.php"  class="<?php if($underline == "l") echo "line"; ?>">Location</a> 
               <a href="registrationPage.php"  class="<?php if($underline == "e") echo "line" ?>">Sign Up</a>
               <a href="About.php"  class="<?php if($underline == "a") echo "line"; ?>"> About Us</a> 
                <a href="login.php"  class="<?php if($underline == "t") echo "line"; ?>"> Login </a>

            
         </nav>
      </div>
   </div>
   