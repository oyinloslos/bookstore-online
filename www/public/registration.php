<?php
   #load db connection

   include '../includes/db.php';

   #including functions
   include '../includes/functions.php';

       #title

   $page_title = "registration";

  #include header
   include 'includes/header.php';


?>


<?php
   $errors =[];

   if(array_key_exists('register', $_POST)){

    

    if(empty($_POST['fname'])){

      $errors['fname']="*Please enter your first name";
    }

    if(empty($_POST['lname'])){
      $errors['lname']="*Please enter  your lastname";
    }

    if(empty($_POST['email'])){
      $errors['email']="*Please enter your email";
    }

    if(EmailExistenceDuringReg($conn, $_POST['email'])) {

      $errors['email'] = "*email already exists";
    }

    if(empty($_POST['uname'])){
      $errors['uname']= "*Please enter a username";
    }
    if(empty($_POST['password'])){
      $errors['password']= "*Please enter a password";
    }

    if(empty($_POST['pword'])){
      $errors['pword']= "*Please confirm password";
    }

    if ($_POST['pword'] != $_POST['password'])
    {
        $errors['pword'] = "*Passwords do not match.";
    }



    if(empty($errors)){


      $clean =array_map('trim',$_POST);
      dbUserRegister($conn,$clean);
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
   
    <div class="registration-form">
   
      <form class="def-modal-form"  action = "registration.php" method = "POST">
   
        <div class="cancel-icon close-form"></div>
         <?php  if(isset($_GET['success'])) { echo $_GET['success'];} ?>
   
        <label for="registration-from" class="header"><h3>User Registration</h3></label>

      <p class="form-error"> <?php 
          $errmsg = displayErrors($errors, 'fname');
          echo $errmsg;
        ?></p>
   
        <input type="text" name="fname" class="text-field first-name" placeholder="Firstname">

       <p class="form-error"> <?php
          $errmsg = displayErrors($errors, 'lname');
          echo $errmsg;
        ?></p>
   
        <input type="text" name="lname"  class="text-field last-name" placeholder="Lastname">

        <p class="form-error"><?php
        echo displayErrors($errors, 'email');

        ?></p>

   
        <input type="email" name="email" class="text-field email" placeholder="Email">
        <p class="form-error"><?php
        echo displayErrors($errors, 'uname');

        ?></p>
   
        <input type="text" name ="uname" class="text-field username" placeholder="Username">

        <p class="form-error"><?php
        echo displayErrors($errors, 'password');

        ?></p>
   
        <input type="password" name="password" class="text-field password" placeholder="Password">

        <p class="form-error"><?php
        echo displayErrors($errors, 'pword');

        ?></p>
   
        <input type="password" name="pword" class="text-field confirm-password" placeholder="Confirm Password">
   
        <input type="submit" name="register" class="def-button" value="Register">
   
        <p class="login-option">Have an account already?<a href="UserLogin.php"> Login</p>
   
      </form>
    </div>
  </div>
 
 <?php
   #include footer
 
   include 'includes/footer.php';

?>