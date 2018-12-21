<?php

require_once '../includes/dboperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST')
{

	if(isset($_POST['email']) and isset($_POST['password']))
	{	

		$db = new dboperations();

		//if this method return true then the user can login if return false the user not exist or the email or pass is false
		if($db->userlogin($_POST['email'],$_POST['password']))
		{

			//this variable have the user data
    	    $user =	$db->getUserByEmail($_POST['email']);

    	    	$response['error'] = false ;
    	    	$response['person_id'] = $user['person_id'] ;
    	    	$response['email'] = $user['email'] ;
       	    	$response['username'] = $user['username'] ;
       	    	$response['phone'] = $user['phone'] ;

		}
		else
		{

			$response['error'] = true ;
			$response['message'] = "Invalid Email Or Password";

		}
	} 
	else 
		{
			$response['error'] = true ;
			$response['message'] = "Required field are missing";	
		}
}

echo json_encode($response);