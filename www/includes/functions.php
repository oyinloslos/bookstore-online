<?php
      function dbAdminRegister($dbconn,$input) {

      

  	#hash the password
  	$hash = password_hash($input['password'], PASSWORD_BCRYPT);


  	#insert data
  	$stmt = $dbconn->prepare("INSERT INTO admin(firstName, lastName, email, hash) VALUES(:fn, :ln, :e, :h)");



  	#bind params
  	$data = [
  		':fn' => $input['fname'],
  		':ln' => $input['lname'],
  		':e'  => $input['email'],
  		':h'  => $hash
  	];

  		$stmt->execute($data);



  	}



  function usersEmailExistence($dbconn,$email) {
  	$result = false;

  	$stmt = $dbconn->prepare("SELECT email FROM admin WHERE email=:e");
  	#bind parameters
  	$stmt->bindparam(":e", $email);
  	$stmt->execute();

  	#get number of rows returned

  	$count = $stmt->rowCount();

  	if($count > 0){
  		$result = true;
  	}

  		return $result;

  }




  function displayErrors($view, $what){

  		$result = "";

  		if(isset($view[$what])) { 

  			$result =  '<span class="err">'.$view[$what]. '</span>';


  	
	     

	    }

	    return $result;

	}




	function adminLogin($dbconn,$input){




			$stmt = $dbconn->prepare("SELECT * FROM admin WHERE 
										email = '".$input['email']. "'");
			#bind params							
      

  		$stmt->execute();


  	   #get number of rows returned

  	   $count = $stmt->rowCount();

  	   if($count > 0) {

	  	   	$userRecord = $stmt->fetch(PDO::FETCH_ASSOC);

	  	   	if(password_verify($input['password'], $userRecord['hash'])) {
	  	   		
	  	   		echo "login successful";
	  	   	} else {

	  	   		echo "*login failed";

	  	   	}

  	   } else {

  	   	echo "Email does not exist";


  	   }
    }



   
   
   ?>