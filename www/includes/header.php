<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
</head>
<body>
	<section>
		<div class="mast">
			<h1>T<span>SSB</span></h1>
	<?php 
	If(isset($_SESSION['active'])){

	

	
?>
			<nav>
				<ul class="clearfix">
					<li><a href="adminHome.php" class="selected">Home</a></li>
					<li><a href="addProduct.php">Add Products</a></li>
					<li><a href="category.php">Categories</a></li>
					
					<li><a href="logout.php">logout</a></li>
				</ul>
			</nav>

		<?php	}  ?>



		</div>
	</section>