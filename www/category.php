<?php
   #load db connection

   include 'includes/db.php';

   #including functions
   include 'includes/functions.php';

   #header

   ?>




<?php

	 $errors =[];
    #title

   $page_title = "category";

   #include header
   include 'includes/header1.php';



   if(array_key_exists('add', $_POST)) {
   	
   	
   	
	   	#validate first name 
	   	if(empty($_POST['category'])){
	   		$errors['category'] = "*please enter a category name </br>";

	   	}


	   	if(empty($errors)) {
	   		addCategories($conn,$_POST);
	   	} else {
	   		foreach ($errors as $error) {
	   			echo $error;
	   		}
	   	}
   		

  	}



  	
?>







	<div class="wrapper">
		<div id="stream">


			<table id="tab">

					<form class="register" method="POST">
						<p>Add Category Name</p>
						<input type="text" name="category" placeholder ="enter category name">

						<input type="submit" name="add" value="Click to add">
					</form>



				<thead>
					<tr>
						<th>category id</th>
						<th>category name</th>
						<th>date created</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>the knowledge gap</td>
						<td>maja</td>
						<td>January, 10</td>
						<td><a href="#">edit</a></td>
						<td><a href="#">delete</a></td>
					</tr>
          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<span><a href="category.php">1</a></span>
			
			<span><a href="#">2</a></span>
			
			<a href="#">3</a>
			<span>4</span>
		</div>
	</div>

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>
</body>
</html>
