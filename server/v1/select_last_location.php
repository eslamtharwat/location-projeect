<?php

function select_last_location(){

$servername = "localhost";
$username = "id2081856_paxspot";
$password = "";
$dbname = "id2081856_paxspot";

$conn = new mysqli($servername, $username, $password, $dbname);

$alluser = array();

$sql = "SELECT * FROM user";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

$looc1= explode(',', $row["lat"]);
$looc2= explode(',', $row["lng"]);

$lastloc1 = array_slice($looc1, -1, 1);
$lastloc2 = array_slice($looc2, -1, 1);

$location = array( 'username'=> $row["username"] , 'lat' => $lastloc1 , 'lng' => $lastloc2  );

    $allloc = json_encode($location);

    echo  $allloc ;


    }
} else {
    echo "0 results";
}




}

//  run  function
 select_last_location();