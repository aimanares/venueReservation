<html>
<head>
</head>
<body>

<?php

  $myFile = 'mydata.json';
  $reservations = array();
	$jsonfile = file_get_contents($myFile);
  $reservations = json_decode($jsonfile, true);

?>

<table border = "2" width="900" align="center">
  	<tr>
  	<td>No</td>
  	<td>venue</td>
  	<td>dateTime</td>
  	<td>name</td>
  	<td>purpose</td>
  	<td>phone</td>
  	<td>email</td>
  	<td>address</td>

    </tr>

    <?php
      $no=1;
      foreach($reservations as $rsv ){
    ?>

    <tr>
    <td><?php echo $no ?></td>;
    <td><?php echo $rsv['venue'] ?></td>;
    <td><?php echo $rsv['dateTime']?></td>;
    <td><?php echo $rsv['name']?></td>;
    <td><?php echo $rsv['purpose']?></td>;
    <td><?php echo $rsv['phone']?></td>;
    <td><?php echo $rsv['email']?></td>;
    <td><?php echo $rsv['address']?></td>;
    </tr>

    <?php
      $no=$no+1;
      }

    ?>
    <tr>
      <td colspan="8" align="center">
        <form action="homepage.php" method="POST">
        <div class="button">
          <input type="submit" name="back" value="Back">
        </div>
        </form>
      </td>
    
    </tr>
    
  </table>



</body>
</html>
