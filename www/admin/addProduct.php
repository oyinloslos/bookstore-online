<?php

	session_start();
	$_SESSION['active'] = true;
	   #load db connection

   include '../includes/db.php';

   #including functions
   include '../includes/functions.php';

   #header

    #include header
   include '../includes/header.php';


    $flag = array ("top-selling", "trending");


  
				


    $erorrs = [];

		   if (array_key_exists('add', $_POST)) {

		   	  		 define("MAX_FILE_SIZE", "2097152");

#allowed extension...
					$ext = ["image/jpg","image/jpeg", "image/png"];


		   			


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

				if(empty($_POST['flag'])){

					$errors['flag']="Please enter a flag"; 
				}
					


					    #be sure a file was selected....
						if(empty($_FILES['pic']['name'])){
							$errors['pic']= "please choose a file";
						}

						#check file size...

						if($_FILES['pic']['size'] > MAX_FILE_SIZE) {
							$errors['pic'] = "file size exceeds maximum. maximum: ".MAX_FILE_SIZE;
						}

						#check extention....
						if(!in_array($_FILES['pic']['type'], $ext)) {
							$errors['pic'] = "Invalid file type";
						}

						$chk = uploadFiles($_FILES, 'pic', '../uploads/');

						if($chk[0]) {
				   				$destination = $chk[1];
				   		} else {
				   			$errors['pic'] = "file upload failed";
				   		}



					 if(empty($errors)){
						   	$clean = array_map('trim', $_POST);
						   	$clean['dest'] = $destination;

				   			addProducts($conn,$clean);
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
			<div>

			    <label>Flag</label>
			    <select name= "flag">

			    <option value="">Select a flag</option>
			    <?php foreach($flag as $flag){ ?>
               <option value="<?php echo $flag?>"><?php echo $flag?></option>
               <?php }?>

			    </select>


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
 
   include '../includes/footer.php';

	?>
