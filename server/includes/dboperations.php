<?php

class dboperations 

{
	private  $con ;

function __construct()
	{
		require_once dirname(__FILE__).'/dbconnect.php';
		
		$db = new dbconnect();
		
		$this->con =$db->connect();
	}	
	public  function createuser($username,$email,$pass,$repass,$birthdate,$phone)
	{
		
		// call function to check if the user exist or not

				if($this->isUserExist($username,$email))
				{

						return 0 ;
				}
				else
				{	
						$password = md5($pass);
						$repassword = md5($repass);
		
						$stmt =$this->con->prepare("INSERT INTO `user`(`person_id`, `username`, `email`, `password`, `repassword`, `birthdate`, `phone`) VALUES (NULL, ?, ?, ?, ?, ?, ?);"); 
	
							 
						
						$stmt->bind_param("ssssss",$username,$email,$password,$repassword,$birthdate,$phone);

				
						if($stmt->execute())
						{
						return 1 ;

						}	

						else
						{

						return 2 ;
						}
				}	
		} 


			//funcyion to check if user are exist then you have permission to login if not exist you will create user 
			public function userlogin($email, $pass)
			{

					$password = md5($pass);
					$stmt = $this->con->prepare("SELECT person_id FROM user WHERE email = ? AND password = ? ");
					$stmt->bind_param("ss",$email,$password);
					$stmt->execute();
					$stmt->store_result();
		   			
		   			 return $stmt->num_rows > 0; 

			}


			public function getUserByEmail($email)
			{
					$stmt = $this->con->prepare("SELECT * FROM user WHERE email = ?");
					$stmt->bind_param("s",$email);
					$stmt->execute();
					return $stmt->get_result()->fetch_assoc(); 

			}

		//function to check if the user exist or not
		private function isUserExist ($username , $email)
		{

			$stmt = $this->con->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
			$stmt->bind_param("ss",$username,$email);
			$stmt->execute();
			$stmt->store_result();
			//if this statement return 0 this mean the user not exist if 1 means the user are exist
		    return $stmt->num_rows >0; 
		}


		//function to check if the isperson_number_Exist or not

		private function isperson_number_Exist ($person_id)
		{

			$stmt = $this->con->prepare("SELECT * FROM NumberMessage WHERE person_id = ? ");
			$stmt->bind_param("s",$person_id);
			$stmt->execute();
			$stmt->store_result();
			//if this statement return 0 this mean the user not exist if 1 means the user are exist
		    return $stmt->num_rows >0; 
		}


   //getting all tokens to send push to all devices
    public function getAllTokens(){
        $stmt = $this->con->prepare("SELECT user_token FROM user");
        $stmt->execute(); 
        $result = $stmt->get_result();
        $tokens = array(); 
        while($token = $result->fetch_assoc()){
            array_push($tokens, $token['user_token']);
        }
        return $tokens; 
    }


    //getting a specified token to send push to selected device
    public function getTokenByEmail($email){
        $stmt = $this->con->prepare("SELECT user_token FROM user WHERE email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_assoc();
        return array($result['user_token']);        
    }




   //getting all the registered devices from database 
    public function getAllDevices()
    {
        $stmt = $this->con->prepare("SELECT person_id,email,user_token FROM user");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result; 
    }


	}