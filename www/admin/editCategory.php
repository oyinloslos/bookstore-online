<?php
   #load db connection

   include '../includes/db.php';

   #including functions
   include '../includes/functions.php';

   #header

   ?>




<?php

	 $errors =[];
    #title

   $page_title = "EditCategory";

 

   #include header
   include 'includes/header1.php';



   if(array_key_exists('edit', $_POST)) {
   	
   	
   	
	   	#validate first name 
	   	if(empty($_POST['category'])){
	   		$errors['category'] = "*please enter a category name </br>";

	   	}


	   	if(empty($errors)) {

	   	editCategory($conn,$_POST,$_GET);

	   		
	   	} else {
	   		foreach ($errors as $error) {
	   			echo $error;
	   		}
	   	}
   		

  	}







 

  	
?>







	<div class="wrapper">
		<div id="stream">

				

			

					<form class="register" method="POST">
						<p>Edit Category</p>

						<input type="text" name="category" placeholder ="enter category name"  
						value="<?php echo $_GET['name'];?>"
						>


						<input type="submit" name="edit" value="Click to edit">
					</form>

						

				
		</div>

		<div class="paginated">
			
		</div>
	</div>

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>
</body>
</html>
