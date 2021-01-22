<!DOCTYPE html>
<html lang="en">
   <head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $pageTitle; ?></title>
      <link rel="stylesheet" type="text/css" href="style.css">
   </head>
   <body>
       <?php
       session_start();
       
       ?>
      <div>
      <div class="header">
         <img class="logo-image" src="img/ourlogo.png" alt="logo">
         <nav class="nav">
             <a href="index.php" class="<?php if($underline == "h"){ echo "line";} ?>">Home</a> 
             <?php
             if(isset($_SESSION["loggedin"])){
             ?>
             <a href="reservation.php"  class="<?php if($underline == "r") echo "line"; ?>">Reservation</a>
             <?php
             }
             ?>
             <a href="menu.php"  class="<?php if($underline == "m") echo "line"; ?>">Menu</a>
             <a href="location.php"  class="<?php if($underline == "l") echo "line"; ?>">Location</a>
             <?php
             if(!isset($_SESSION["loggedin"])){
             ?>
             <a href="registrationPage.php"  class="<?php if($underline == "e") echo "line" ?>">Sign Up</a>
             <?php
             }
             ?>
             <a href="About.php"  class="<?php if($underline == "a") echo "line"; ?>"> About Us</a> 
             <?php
             if(!isset($_SESSION["loggedin"])){
             ?>
             <a href="login.php"  class="<?php if($underline == "t") echo "line"; ?>"> Login </a>
             <?php
             }
             ?>
          </nav>
          <?php

          if(isset($_SESSION["profile_pic"]) && $_SESSION["profile_pic"] != null)
          {
          ?>
          <img class="logo-image" src="<?php echo $_SESSION["profile_pic"] ?>" alt="pfp">
          <?php
          }
          ?>
      </div>
   </div>
   