<?php
   session_start();
	$_SESSION['active'] = true;

   #load db connection

   include '../includes/db.php';

   #including functions
   include '../includes/functions.php';

    $page_title = "editproducts";

   #include header
   include '../includes/header.php';

   if(isset($_GET['book_id'])) {
   	# DATA ACCESS OBJECT DESIGN PATTERN....
   		$item = getBookByID($conn, $_GET['book_id']);
   }

   $category = getCategoryByID($conn, $item['cat_id']);

    $flag = array ("top-selling", "trending");

   $errors=[];

   if(array_key_exists('edit', $_POST)){

   	if(empty($_POST['title'])){
   		$errors['title']="please enter a title";
   	}
   	if(empty($_POST['author'])){
   		$errors['author']="please enter the author name";

   	}
   	if(empty($_POST['category'])){

   		$errors['category']="please select a category";
   	}
   	if(empty($_POST['price'])){

   		$errors['price']="please enter the book price";
   	}

   	if(empty($_POST['year'])){
   		$errors['year']="please enter the year of publication";
   	}
	if(empty($_POST['isbn'])){

   		$errors['isbn']="please enter the ISBN";
   	}
   	if(empty($_POST['flag'])){

   		$errors['flag']="please enter the ISBN";
   	}

   	if(empty($errors)){
   		$clean=array_map('trim', $_POST);
   		editProducts($conn,$clean, $_GET['book_id']);

   	}

   }

?>

	<div class="wrapper">

		<div id="stream">
		<h1 id="register-label">Edit Products</h1>
		<hr>
		<form id="register"   method ="POST" action="<?php echo "editProducts.php?book_id=".$_GET['book_id']; ?>">
			<div>
			<div>
				<?php
					$errmsg = displayErrors($errors, 'title');
					echo $errmsg;
				?>
				<label>Title</label>
				<input type="text" name="title" placeholder="title" value="<?php echo $item['title']; ?>">

			</div>
			<div>
				<?php
				$errmsg = displayErrors($errors, 'author');
					echo $errmsg;
				?>
				<label>Author</label>	
				<input type="text" name="author" placeholder="author"  	value="<?php echo $item['author']; ?>" >
				
			</div>
			<div>
				<?php
				$errmsg = displayErrors($errors, 'category');
					echo $errmsg;
				?>
				<label>Category</label>	
				<select name="category">
					<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
					<?php
						$catList = doEditSelectCategory($conn, $category['category_name']);
						echo $catList;
					?>
				</select>
				
			</div>
			    
			<div>
				<?php
				$errmsg = displayErrors($errors, 'price');
					echo $errmsg;
				?>
				
				<label>Price</label>
				<input type="text" name="price" placeholder="price" value="<?php echo $item['price']; ?>">

			</div>
			    
			<div>
				<?php
				$errmsg = displayErrors($errors, 'year');
					echo $errmsg;
				?>
				<label>Year of Publication</label>
				<input type="text" name="year" placeholder="year"  value="<?php echo $item['year']; ?>">
			</div>
			<div>
				<?php
				$errmsg = displayErrors($errors, 'isbn');
					echo $errmsg;
				?>
				<label>ISBN</label>
				<input type="text" name="isbn" placeholder="ISBN"  	value="<?php echo $item['isbn']; ?>">
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


			<input type="submit" name="edit" value="Edit product">


			</form>
		</div>
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
