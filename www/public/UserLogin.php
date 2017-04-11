<?php
   #load db connection

   include '../includes/db.php';

   #including functions
   include '../includes/functions.php';

    #title

   $page_title = "Login";
  #include header
   include 'includes/header.php';

?>
<?php
    
      $errors = [];
    if(array_key_exists('login', $_POST)){

    

      if (empty($_POST['email'])) {
        $errors['email']="Please enter your email address";
        }

      if(empty($_POST['password'])){
        $errors['password'] = "Please enter your password";
      }

      if(empty($errors)){

        $clean = array_map('trim',$_POST);

        $chk = UserLogin($conn,$clean);


         if($chk[0] == true) {

            $row = $chk[1];


         #set user session..
            //$_SESSION['user_id'] = $row['user_id'];
            //$_SESSION['admin_name'] = $row['firstName'];

            # redirect...
            redirect('index.php');


      }
    }

  }

?>



<form class="search-brainfood">
        <input type="text" class="text-field" placeholder="Search all books">
      </form>
    </div>
  </div>


     
  <!-- main content starts here -->
  <div class="main">
    
    <div class="login-form">

       
      
      <form class="def-modal-form" action = "UserLogin.php" method = "POST">
        
        <div class="cancel-icon close-form"></div>
        
        <label for="login-form" class="header"><h3>Login</h3></label>
        <p class="form-error"><?php  if(isset($_GET['msg'])) { echo $_GET['msg'];} ?></p>
        
        <input type="text" name="email" class="text-field email" placeholder="Email">
        
        <p class="form-error"><?php echo displayErrors($errors, 'email');?></p>
        
        <input type="password" name="password"class="text-field password" placeholder="Password">
        
        <!--clear the error and use it later just to show you how it works -->
        
        <p class="form-error"><?php echo displayErrors($errors, 'password');?></p>
        
        <input type="submit" name="login" class="def-button login" value="Login">
         <p class="login-option">Don't have an account? <a href="registration.php"> Register</p>
      
      </form>
    </div>
  </div>
 <?php
   #include footer
 
   include 'includes/footer.php';

?>