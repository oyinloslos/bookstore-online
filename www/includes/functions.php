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


   

            $stmt = $dbconn->prepare("SELECT * FROM categories"); 

            $stmt->execute();

            while ($record = $stmt->fetch()) {

            echo "<tr>";
            echo "<td>".$record['category_id']."</td>";
            echo "<td>".$record['category_name']."</td>";
            echo "<td>".$record['date_created']."</td>";
            echo "<td><a href=\"editCategory.php?id=" .$record['category_id']. "&name=" .$record['category_name']. "\">edit</a></td>";
            echo "<td><a href=\"deleteCategory.php?id=" .$record['category_id']."\">delete</a></td>";
            echo "</tr>";
            
              # code...
            }

}



function editCategory($dbconn,$post,$get){


  $stmt =$dbconn->prepare("UPDATE categories SET category_name=:name WHERE category_id=:id");

        $stmt->bindparam(":name",$post['category']);

        $stmt->bindparam(":id",$get['id']);

        $stmt->execute();

        header("Location:category.php");
	   
     }




function deleteCategory($dbconn,$get){

        
         $stmt=$dbconn->prepare("DELETE FROM categories WHERE category_id=:id");
         
         $stmt->bindparam(":id", $get['id']);

         $stmt->execute();

         header("location:category.php");

       }



function getCategory($dbconn){

       $stmt=$dbconn->prepare("SELECT * FROM categories");
       $stmt->execute();
       $result = "";

       while ($record = $stmt->fetch()){
            $cat_id = $record['category_id'];
            $cat_name = $record['category_name'];

            $result .= "<option value='$cat_id'>$cat_name</option>";

       }
       return $result;



}
function uploadProduct($dbconn,$input,$file)

      {



      }

      function getproducts($dbconn){
      $stmt=$dbconn->prepare("SELECT * FROM books");
       $stmt->execute();
      $result = "";

       while ($record = $stmt->fetch()){
              $book_id = $record['book_id'];
              $title = $record['title'];
              $author = $record['author'];
              $price = $record['price'];
              $year= $record['year'];
              $isbn = $record['ISBN'];
              $path = $record['image_path'];
          

                   $result .= "<tr>";
              $result .= "<td>".$title."</td>";
              $result .= "<td>".$author."</td>";
              $result .= "<td>".$price."</td>";
                $result .= "<td>".$year."</td>";
                    $result .= "<td>".$isbn."</td>";
                       $result .= "<td><img src='$path' height='80px'  width='80px'/></td>";
              $result .= "<td><a href='editProduct.php?id=$book_id'>edit</a></td>";
                 $result .= "<td><a href='adminHome.php?action=delete&book_id=$book_id'>delete</a></td>";
              
              $result .= "</tr>";


         }
         return $result;



}



function deleteProduct($dbconn,$id){

        
         $stmt=$dbconn->prepare("DELETE FROM books WHERE book_id=:id");
         
         $stmt->bindparam(":id", $id);

         $stmt->execute();
         $success = "Product Deleted";

         header("location:adminHome.php?message=$success");

       }

	   ?>

