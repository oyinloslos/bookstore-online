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

						<?php

						?>

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
					<?php  

						$stmt = $conn->prepare("SELECT * FROM categories"); 

						$stmt->execute();

						while ($record = $stmt->fetch()) {

						echo "<tr>";
						echo "<td>".$record['category_id']."</td>";
						echo "<td>".$record['category_name']."</td>";
						echo "<td>".$record['date_created']."</td>";
						echo "<td><a href=\"editCategory.php\">edit</a></td>";
						echo "<td><a href=\"deletecategory.php\">delete</a></td>";
						echo "</tr>";
						
							# code...
						}


					?>

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
