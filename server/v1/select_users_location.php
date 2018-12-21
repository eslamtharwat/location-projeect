<?php

function getloc($email){

$servername = "localhost";
$username = "id2081856_paxspot";
$password = "";
$dbname = "id2081856_paxspot";

$conn = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT lat,lng,address FROM user WHERE email='$email'";
$result = $conn->query($sql);


$row = $result->fetch_assoc();



		$looc1= explode(',', $row["lat"]);
		$looc2= explode(',', $row["lng"]);
    $adrs= explode(',', $row["address"]);



$lastloc1 = array_slice($looc1, -10, 10);
$lastloc2 = array_slice($looc2, -10, 10);
$adrs2 = array_slice($adrs, -10, 10);




@$location = array (

  "loc1"  => array  ("lat" => $lastloc1[1],"lng" =>$lastloc2[1] , "address" =>$adrs2[1]),
  "loc2"  => array  ("lat" => $lastloc1[2],"lng" =>$lastloc2[2] , "address" =>$adrs2[2]),
  "loc3"  => array  ("lat" => $lastloc1[3],"lng" =>$lastloc2[3] , "address" =>$adrs2[3]),
  "loc4"  => array  ("lat" => $lastloc1[4],"lng" =>$lastloc2[4] , "address" =>$adrs2[4]),
  "loc5"  => array  ("lat" => $lastloc1[5],"lng" =>$lastloc2[5] , "address" =>$adrs2[5]),
  "loc6"  => array  ("lat" => $lastloc1[6],"lng" =>$lastloc2[6] , "address" =>$adrs2[6]),
  "loc7"  => array  ("lat" => $lastloc1[7],"lng" =>$lastloc2[7] , "address" =>$adrs2[7]),
  "loc8"  => array  ("lat" => $lastloc1[8],"lng" =>$lastloc2[8] , "address" =>$adrs2[8]),
  "loc9"  => array  ("lat" => $lastloc1[9],"lng" =>$lastloc2[9] , "address" =>$adrs2[9]),
  "loc10" => array  ("lat" => $lastloc1[10],"lng" =>$lastloc2[10] , "address" =>$adrs2[10]),
  	);


		$allloc = json_encode($location);


		echo  $allloc ;

}



//  run  function

$email = $_POST['email'];

 getloc("$email");