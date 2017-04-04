<?php
   #load db connection

   include 'includes/db.php';

   #including functions
   include 'includes/functions.php';

   #header

    #include header
   include 'includes/header.php';


   ?>


   <?Php

				


    

		   if (array_key_exists('add', $_POST)) {

		   	  		 define("MAX_FILE_SIZE", "2097152");

#allowed extension...
					$ext = ["image/jpg","image/jpeg", "image/png"];


		   			 $erorrs = [];


				 if(empty($_POST['title'])){

				  	$errors['title']="Please enter a Book title"; 
				   }

				   if(empty($_POST['author'])){

				  	$errors['author']="Please enter Book author"; 
				   }
				if(empty($_POST['price'])){

				  	$errors['price']="Please enter the Book price"; 
				   }

				   if(empty($_POST['category'])){

				  	$errors['category']="Please select the category"; 
				   }
				if(empty($_POST['year'])){

				  	$errors['year']="Please enter the year of publication"; 
				   }

				   if(empty($_POST['isbn'])){

				  	$errors['isbn']="Please enter the ISBN"; 
				   }


					#be sure a file was selected....
						if(empty($_FILES['pic']['name'])){
							$errors[]= "please choose a file";
						}

						#check file size...

						if($_FILES['pic']['size'] > MAX_FILE_SIZE) {
							$errors[] = "file size exceeds maximum. maximum: ".MAX_FILE_SIZE;
						}

						#check extention....
						if(!in_array($_FILES['pic']['type'], $ext)) {
							$errors[] = "Invalid file type";
						}

							$rnd = rand(0000000000, 9999999999);

	#strip filename for spaces

						$strip_name = str_replace("","_", $_FILES['pic']['name']);

						$filename = $rnd.$strip_name;
						$destination = 'uploads/'.$filename;

						if(!move_uploaded_file($_FILES['pic']['tmp_name'], $destination)) {
							
							$errors[]  = "file upload failed";

						}

						   if(empty($errors)){


				   	$stmt=$conn->prepare("INSERT INTO books(title,author,cat_id,price,year,ISBN,image_path) VALUES(:title,:author,:cat_id,:price,:year,:IS, :image_path)");
				   	
				   	$stmt->bindparam(":title",$_POST['title']);
				   	$stmt->bindparam(":author",$_POST['author']);
				   	$stmt->bindparam(":year",$_POST['year']);
				   	$stmt->bindparam(":IS",$_POST['isbn']);
				   	$stmt->bindparam(":image_path",$destination);
				   	$stmt->bindparam(":cat_id",$_POST['category']);
				   	$stmt->bindparam(":price",$_POST['price']);

				   	$stmt->execute();


				   	 $success = "Category Successfully Added";
		    
		   			 header("Location:addProduct.php?success=$success");


		 		 } else {
			   		foreach ($errors as $error) {
			   			echo $error. '</br>';


			   		}

			   	 }



		   }

				

					


				



			?>

	<div class="wrapper">
		<h1 id="register-label">Add Products</h1>
		<hr>
		<form id="register"  action ="addProduct.php" method ="POST" enctype="multipart/form-data">
			<div>
			<div>
				<label>Title</label>
				<input type="text" name="title" placeholder="title">
			</div>
			<div>
				
				<label>Author</label>	
				<input type="text" name="author" placeholder="author">
			</div>
			<div>
				
				<label>Category</label>	
				<select name="category">
					<option value = "">Select</option>
					<?php $view = getCategory($conn);   echo $view; ?>
				</select>
				
			</div>
			    
			<div>
				
				<label>Price</label>
				<input type="text" name="price" placeholder="price">
			</div>
			    
			<div>
				
				<label>Year of Publication</label>
				<input type="text" name="year" placeholder="year">
			</div>
			<div>
				
				<label>ISBN</label>
				<input type="text" name="isbn" placeholder="ISBN">
			</div>
			<div>
				

				<label>Upload Image</label>
				<input type="file" name="pic">
			
			</div>

			<input type="submit" name="add" value="Add product">


			</form>
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>

	<?php
   #include footer
 
   include 'includes/footer.php';

	?>
