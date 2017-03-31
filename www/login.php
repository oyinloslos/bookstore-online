<?php
   #load db connection

   include 'includes/db.php';

   #including functions
   include 'includes/functions.php';

   ?>


<?php

    #title

   $page_title = "Login";

   #include header
   include 'includes/header.php';

   	#cache errors
   	$errors = [];
     


   if(array_key_exists('register', $_POST)) {
   
        #validate email

   	if(empty($_POST['email'])){
   		$errors[] = "*please enter a email address </br>" ; 
   	}

   	if(empty($_POST['password'])){
   		$errors[] = "*Please enter a password </br>";

   	}

   	 

   	if(empty($errors)) {
   		//do database stuff

   		#eliminate unwanted spaces from values in the $_POST array
   			$clean = array_map('trim', $_POST);


   		adminLogin($conn,$clean);


   	}

   }
?>
    


	
	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>

				
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="register" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

<?php
   #include footer
 
   include 'includes/footer.php';

?>
	