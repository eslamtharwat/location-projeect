<?php

require_once '../includes/dboperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST')
{

		if(isset($_POST['username']) and isset($_POST['email'])  and isset($_POST['password'])
									  and isset($_POST['repassword']) and isset($_POST['birthdate']) and isset($_POST['phone']))
		{
				$db = new dboperations();


					$result = $db->createuser(  $_POST['username'],
												$_POST['email'],
												$_POST['password'],
												$_POST['repassword'],
												$_POST['birthdate'],
												$_POST['phone']
												);



			
			if($result == 1)	
			{

					$response['error'] = false ;
					$response['message'] = "User Registered Successfully";	

			}
			else if($result == 2) 
			{
					$response['error'] = true ;
					$response['message'] = "Some Error Occurred please try again";			
			}
			else if($result == 0) 
			{
					$response['error'] = true ;
					$response['message'] = "It Seems You Are Already Registered,please choose Differnet email and name";			
			}
		}

		else 
		{
			$response['error'] = true ;
			$response['message'] = "Required field are missing";	
		}

}
else
{

$response['error'] = true ;
$response['message'] = "Invalid Request";	

}

echo json_encode($response);