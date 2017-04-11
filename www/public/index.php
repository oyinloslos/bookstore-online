<?php
  
 #load db connection

   include '../includes/db.php';

    #including functions
   include '../includes/functions.php';

  include 'includes/hHeader.php';

  $item = bestSellingBook($conn);





if(array_key_exists('add', $_POST)){
  $errors = [];

  if(empty($_POST['amount'])){
    $errors['amount']="Please enter an amount";
  }

  if(empty($errors)){


  }
}
?>












  <!-- main content starts here -->
  <div class="main">
   
    <div class="book-display">
   
      <div class="display-book" style="background: url('../<?php echo $item['image_path'];?>');

          background-size: cover;
          background-position: center;
           background-repeat: no-repeat;">
      </div>
     
      <div class="info">
     
        <h2 class="book-title"><?php echo $item['title'];?></h2>
     
        <h3 class="book-author"><?php echo $item['author'];?></h3>
     
        <h3 class="book-price">$<?php echo $item['price'];?></h3>

        <form>
          <label for="book-amout">Amount</label>
          <input type="number" class="book-amount text-field" name="amount">
          <input class="def-button add-to-cart" type="submit" name="add" value="Add to cart">
        </form>
      </div>
    </div>
    <div class="trending-books horizontal-book-list">
      <h3 class="header">Trending</h3>
      <ul class="book-list">
        <?php echo trending($conn); ?>
      </ul>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
      <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>
      
             <?php echo recentlyViewed($conn) ;?>
        
      </ul>
    </div>
    
  </div>
  <!-- footer starts here-->
 
 <?php
   #include footer
 
   include 'includes/footer.php';

?>
