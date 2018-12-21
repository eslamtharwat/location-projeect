<?php
$servername = "localhost";
$username = "id2081856_paxspot";
$password = "";
$dbname = "id2081856_paxspot";


$id =$_POST['person_id'];
$lat=$_POST['lat'];
$lng=$_POST['lng'];
$address=$_POST['address'];


$conn = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT lat,lng,address FROM user WHERE person_id=$id";
$result = $conn->query($sql);

$row = $result->fetch_assoc();



		$looc1= explode(',', $row["lat"]);
		$looc2= explode(',', $row["lng"]);
		$add= explode(',', $row["address"]);


		array_push($looc1,$lat);
		array_push($looc2,$lng);
		array_push($add,$address);


		$loc11 = implode(',', $looc1);
		$loc22 = implode(',', $looc2);
		$adr33= implode(',', $add);


	
$sql2 = "UPDATE user SET lat='$loc11',lng='$loc22',address='$adr33' WHERE person_id='$id'";



if ($conn->query($sql2) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}