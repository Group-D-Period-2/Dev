<!DOCTYPE html>
<html>
  <head>
    <title>Reservation</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
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

          <!-- <label for="address">Address</label>
          <input type="text" id="address" name="user_address"><br /> -->

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
  </body>
</html>
