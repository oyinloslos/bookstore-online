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


    function addCategories($dbconn,$input){

    #insert data


      #One way to form an INSERT statement to look like INSERT INTO categories(category_name, date_created) VALUES ('JAVA', '2017-04-08')
    //$stmt = $dbconn->prepare("INSERT INTO categories(category_name,date_created) VALUES ('" .$input['category']. "',NOW())");

    #Another way: Using BindParam in an index fashion
    $stmt = $dbconn->prepare("INSERT INTO categories(category_name,date_created) VALUES (?,NOW())");
    $stmt->bindparam(1, $input['category']);

    #Another way: Using BindParam in an associative fashion
    //$stmt = $dbconn->prepare("INSERT INTO categories(category_name) VALUES (:c)");

    //$stmt->bindparam(":c", $input['category']);
   
    $stmt->execute();

    $success = "Category Successfully Added";
    
    header("Location:category.php?success=$success");
      

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



   

   function uploadFiles($input){
   		#generate random number to append
	$rnd = rand(0000000000, 9999999999);

	#strip filename for spaces

	$strip_name = str_replace("","_", $_FILES['pic']['name']);

	$filename = $rnd.$strip_name;
	$destination = 'uploads/'.$filename;

	if(!move_uploaded_file($_FILES['pic']['tmp_name'], $destination)) {
		
		$input[]  = "file upload failed";
	}


		}






function viewCategories($dbconn){

  $view="";


           $stmt = $dbconn->prepare("SELECT * FROM categories  WHERE category_id =:id,category_name =:name,date_created =:created"); 
           

          

               //$id= $stmt->bindparam(":id",$cat['category_id']);

                //$name = $stmt->bindparam(":name", $cat[1]);
                
                //$created = $stmt->bindparam(":created", $cat[2]);

                //$stmt->execute();
            


            //foreach ($stmt as $cat) {

              //$view.= "<tr>";
              //$view.="<td>".$id.'</td></td>'.$name.'<td></td>'.$created.'<td></td>';
              //$view.="</tr>";


       //$stmt->bindparam(":e", $email);


                
 // }

           


  

}
	   
	   ?>

