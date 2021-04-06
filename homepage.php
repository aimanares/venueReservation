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

          //Get form data
          /*$formdata = array(
            0 => $venue,
            1 => $dateTime,
            2 => $name,
            3 => $purpose,
            4 => $phone,
            5 => $email,
            6 => $address);*/

          //Get data from existing json file
          $jsondata = file_get_contents($myFile);

          // converts json data into array
          $arr_data = json_decode($jsondata, true);

          // compare data - validation
          //addReservation($formdata, $arr_data, $venue, $dateTime, $name, $purpose, $phone, $email, $address);

          $sameVen = array_keys(array_column($arr_data, 'venue'), $venue);
          //global $formdata;

          if(sizeof($arr_data,0)==0 || sizeof($sameVen,0)==0){
              //array_push($arrayV, array($ven, $dt, $nm, $pur, $pho, $em, $ad));
              //$formdata = array($ven, $dt, $nm, $pur, $pho, $em, $ad);

              array_push($arr_data,$formdata);
              function_alert('RESERVATION SUCCESSFUL 1');
          }else{
            // echo (sizeof($arr_data,0)) . "<br>" ;
            //   print_r ($sameVen) . "<br>";
            //   echo (sizeof($sameVen,0)) . "<br>" ;
            //   echo $venue . "<br>";

              $clash = 0;
              for($y=0; $y<(sizeof($sameVen)); $y++){
                  $z = $sameVen[$y];
                  echo "This is z" . $z . "<br>";
                  if($arr_data[$z]['dateTime'] == $dateTime){
                      $clash = 1;
                  }

              }
              //echo $clash;
              if($clash == 0){
                  array_push($arr_data,$formdata);
                  //$formdata = array($ven, $dt, $nm, $pur, $pho, $em, $ad);
                  function_alert('RESERVATION SUCCESSFUL 2');
              }else{
                  function_alert('CLASHED');
              }
          }

          // Push user data to array
          //array_push($arr_data,$formdata);

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

        function addReservation($arrayV, $arrayF, $ven, $dt, $nm, $pur, $pho, $em, $ad){

            $sameVen = array_keys(array_column($arrayF, 0), $ven);
            //global $formdata;

            if(sizeof($arrayF,0)==0 || sizeof($sameVen,0)==0){
                //array_push($arrayV, array($ven, $dt, $nm, $pur, $pho, $em, $ad));
                //$formdata = array($ven, $dt, $nm, $pur, $pho, $em, $ad);
                array_push($arrayF,$arrayV);
                function_alert('RESERVATION SUCCESSFUL 1');
            }else{
                $clash = 0;
                for($y=0; $y<(sizeof($sameVen)); $y++){
                    $z = $sameVen[$y];
                    if($arrayV[$z][1] == $dt){
                        $clash = 1;
                    }
                }
                echo $clash;
                if($clash == 0){
                    array_push($arrayF,$arrayV);
                    //$formdata = array($ven, $dt, $nm, $pur, $pho, $em, $ad);
                    function_alert('RESERVATION SUCCESSFUL 2');
                }else{
                    function_alert('CLASHED');
                }
            }
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
          <option value="a">Argentina conference room</option>
          <option value="b">Belgium conference room</option>
          <option value="c">Chile conference room</option>
          <option value="d">Denmark conference room</option>
          <option value="e">Egypt conference room</option>
          <option value="f">France meeting room</option>
          <option value="g">Germany conference room</option>
          <option value="h">Hungary conference room</option>
          <option value="i">Ireland conference room</option>
          <option value="j">Japan conference room</option>
          <option value="k">Kosovo conference room</option>
          <option value="l">luxembourg conferece room</option>
          <option value="m">Malaysia conference room</option>
          <option value="n">Norway conference room</option>
          <option value="o">Oman conference room</option>
          <option value="p">Philippines conference room</option>
          <option value="q">Qatar conference room</option>
          <option value="r">Russia conference room</option>
          <option value="s">Singapore conference room</option>
          <option value="t">Turkey conference room</option>
          <option value="u">United Kingdom conference room</option>
          <option value="v">Vietnam conference room</option>
          <option value="w">Western Sahara Meeting room</option>
          <option value="x">Yemen conference room</option>
          <option value="y">Zimbabwe conference room</option>
          <option value="z">Australia conference room</option>
          <option value="aa">Brazil conference room</option>
          <option value="ab">China conference room</option>
          <option value="ab">Finland conference room</option>
          <option value="ad">Greece conference room</option>


        </select>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Reserve">
          <input type="reset" name="reset" value="Availability">
        </div>

    </form>
  </div>

  <?php
    if(isset($_POST['submit'])) {
        echo "<br>";
        //print_r($_SESSION);
        //echo json_encode($array);
        //echo array2string($_SESSION);
        echo "<br>";
    }

  ?>


</div>




</body>
</html>
