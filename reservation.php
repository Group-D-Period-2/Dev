
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
$pageTitle = "Reservation";
$underline = "r";
include('inc/header.php'); ?>
        
    <div class="form-res">
      <form class="res-form shadow" action="" submit="POST">
        <h1 id="res-title">Reservation</h1>

        <fieldset>
          <legend>Required Info</legend>

          <label>Choose:</label><br />
          <label>Sit In <input type="radio"  value="Sit_In" name="user_choice"></label>
          <label>Pick Up <input type="radio"  value="Pick_up" name="user_choice"></label><br />

          <label for="name">Name:</label>
          <input type="text" id="name" name="user_name"> <br />

          <label for="lastname">Lastname:</label>
          <input type="text" id="lastname" name="user_lastname"><br />

          <label for="cell">Tel:</label>
          <input type="tel" id="cell" name="user_tel"><br />

           <label for="location">Location:</label>
          <select id="location" name="user_location">
			<option value="">Choose a location</option>
			<option value="Emmen">Emmen</option>
			<option value="Assen">Assen</option>
			<option value="Zwolle">Zwolle</option>
			<option value="Groningen">Groningen</option>
			<option value="Volendam">Volendam</option>
		  </select>

          <label for="date"><img class="res-icon" src="img/reservation/calendar.svg" alt="reservation icon"></label>
          <input type="date" id="date" name="user_date"><br />

          <label for="time"><img class="res-icon" src="img/reservation/time.svg" alt="clock icon"></label>
          <input type="time" id="time" name="user_time">

          <label for="people"><img class="res-icon" src="img/reservation/people.svg" alt="people icon"></label>
          <input type="number" id="people" name="user_people">
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
	