<?php
   #load db connection

   include 'includes/db.php';

   #including functions
   include 'includes/functions.php';

   #header

   ?>


   <?Php

   if (array_key_exists('add', $_POST)) {


  $erorrs = [];


  if(empty($_POST['title']))

  	$errors['title']="Please enter a Book title"; 
   }

   if(empty($_POST['author']))

  	$errors['author']="Please enter Book author"; 
   }
if(empty($_POST['price']))

  	$errors['price']="Please enter the Book price"; 
   }
if(empty($_POST['year']))

  	$errors['year']="Please enter the year of publication"; 
   }








   ?>

	<div class="wrapper">
		<div id="stream">
			<form class="register" method="POST">
				<p>Add Product</p>

				<label>Title</label>
				<input type="text" name="title" placeholder="title">
			</div>
			<div>
				<?php
				echo displayErrors($errors, 'title');

				?>
				<label>Author</label>	
				<input type="text" name="author" placeholder="author">
			</div>
			    
			<div>
				<?php
					echo displayErrors($errors, 'author');

				?>
				<label>Price</label>
				<input type="text" name="price" placeholder="price">
			</div>
			    
			<div>
				<?php
					echo displayErrors($errors, 'price');
				?>

				<label>Year of Publication</label>
				<input type="password" name="year" placeholder="year">
			</div>
			<div>
				<?php
					echo displayErrors($errors, 'image');
				?>

				<label>Image</label>
				<input type="password" name="image" placeholder="">
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

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>
</body>
</html>
