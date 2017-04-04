<?php
   #load db connection
session_start();
$_SESSION['active'] = true;

   include 'includes/db.php';

   #including functions
   include 'includes/functions.php';

   #header

    #include header
   include 'includes/header.php';


  
   	if(isset($_GET['action']))

  	{


   	deleteProduct($conn,$_GET['book_id']);
   }

	 




   ?>



	<div class="wrapper">
		<div id="stream">

			<?php  if(isset($_GET['message'])) { echo $_GET['message'];} ?>

			<table id ="tab">
				<thead>
					<tr>
						<th>Title</th>
						<th>Author</th>
						
						<th>Price</th>
						<th>Year </th>
						<th>ISBN</th>
						<th>Image</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php  $view = getProducts($conn); echo "$view"; ?>
					</tr>
          		</tbody>
			</table>
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
