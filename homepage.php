<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
<title>Venue Reservation Form</title>
<link rel="stylesheet" href="homecss.css">
</head>
<body>
    <?php

      $venue = $dateTime = $name = $purpose = $phone = $email = $address = '';

      $myFile = 'mydata.json';
      $arr_data = array(); // create empty array

      if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['number'];
        $address = $_POST['address'];
        $purpose = $_POST['purpose'];
        $dateTime = $_POST['date'] . " " . $time = $_POST['time'];
        $venue = $_POST['venue'];
      }

      if(isset($_POST['submit'])){
        try
        {
          //$formdata = array($venue, $dateTime, $name, $purpose, $phone, $email, $address);
          $formdata = array(
            'venue'=> $_POST['venue'],
            'dateTime'=> $_POST['date'] . " " . $time = $_POST['time'],
            'name'=> $_POST['name'],
            'purpose'=> $_POST['purpose'],
            'phone'=> $_POST['number'],
            'email'=> $_POST['email'],
            'address'=>$_POST['address']
         );
  
          //Get data from existing json file
          $jsondata = file_get_contents($myFile);
  
          // converts json data into array
          $arr_data = json_decode($jsondata, true);
          
          $sameVen = array_keys(array_column($arr_data, 'venue'), $venue);
      
          if(sizeof($arr_data,0)==0 || sizeof($sameVen,0)==0){
              array_push($arr_data,$formdata);
              function_alert('RESERVATION SUCCESSFUL');
          }else{
              $clash = 0;
              for($y=0; $y<(sizeof($sameVen)); $y++){
                  $z = $sameVen[$y];
                  if($arr_data[$z]['dateTime'] == $dateTime){
                      $clash = 1;
                  }
              }

              if($clash == 0){
                  array_push($arr_data,$formdata);
                  function_alert('RESERVATION SUCCESSFUL');
              }else{
                  function_alert('CLASHED');
              }
          }

          //Convert updated array to JSON
          $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
          
          //write json data into data.json file
          if(file_put_contents($myFile, $jsondata)) {
            function_alert('Data successfully saved') ;
          }
          else 
            function_alert("Error");
        }
        catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
      }

        function function_alert($message) {
            echo "<script>alert('$message');</script>";
        }
    ?>

  <div class="container">
    <h2>RESERVATION ONLINE</h2>
    <form  action="" method="post">
      <div class="user-details">

        <div class="input-box">
        <span class="details">Name</span>
        <input type="text" name="name"placeholder="Enter your name " required >

        </div>

        <div class="input-box">
        <span class="details">Phone number</span>
        <input type="number" name="number"placeholder="Your contact number "required >

        </div>

        <div class="input-box">
        <span class="details">E-mail</span>
        <input type="text" name="email"placeholder="Enter your e-Email" required>

        </div>

        <div class="input-box">
        <span class="details">Address</span>
         <input type="text" name="address"placeholder="Enter your address" required>

        </div>

        <div class="input-box">
        <span class="details">Purpose</span>
        <input type="text" name="purpose" placeholder="Event purpose" value="">

        </div>

        <div class="input-box">
          <span class="details">Date</span>
          <input type="date" name="date" value="">
        </div>

        <div class="input-box">
          <span class="details">Time</span>
          <input type="time" name="time" value="">
        </div>

        <div class="input-box">
        <span class="details"></span>
        <label for="Venue"> Choose a venue </label>
        <select id="venue" name="venue">
          <option value="Argentina">Argentina conference room</option>
          <option value="Belgium">Belgium conference room</option>
          <option value="Chile">Chile conference room</option>
          <option value="Denmark">Denmark conference Room</option>
          <option value="Egypt">Egypt conference Room</option>
          <option value="France">France meeting room</option>
          <option value="Germany">Germany conference Room</option>
          <option value="Hungary">Hungary conference room</option>
          <option value="Ireland">Ireland conference room</option>
          <option value="Japan">Japan conference room</option>
          <option value="Kosovo">Kosovo conference room</option>
          <option value="Luxembourg">Luxembourg conferece Room</option>
          <option value="Malaysia">Malaysia confernce Room</option>
          <option value="Norway">Norway conferece room</option>
          <option value="Oman">Oman conferece Room</option>
          <option value="Philippines">Philippines conference room</option>
          <option value="Qatar">Qatar conference room</option>
          <option value="Russia">Russia conference room</option>
          <option value="Singapore">Singapore conference Room</option>
          <option value="Turkey">Turkey conference Room</option>
          <option value="United">United Kingdom conference room</option>
          <option value="Vietnam">Vietnam conference Room</option>
          <option value="Western">Western Sahara Meeting room</option>
          <option value="Yemen">Yemen conference room</option>
          <option value="Zimbabwe">Zimbabwe conference room</option>
          <option value="Australia">Australia conference room</option>
          <option value="Brazil">Brazil conference Room</option>
          <option value="China">China conference room</option>
          <option value="Finland">Finland conference room</option>
          <option value="Greece">Greece conference Room</option>

        </select>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Reserve">
          <input type="reset" name="reset" value="Clear">
        </div>
    </form>
    <form action="displayDataz.php" method="POST">
      <div class="button">
        <input type="submit" name="availability" value="Availability">
      </div>
    </form>
    <form action="Table1.php" method="POST">
      <div class="button">
        <input type="submit" name="table" value="View Table">
      </div>
    </form>
  </div>
  </div>
</body>
</html>
