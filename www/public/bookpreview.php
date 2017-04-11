<?php
  
 #load db connection

   include '../includes/db.php';

    #including functions
   include '../includes/functions.php';

  include 'includes/hHeader.php';


   if(isset($_GET['book_id'])) {
   
    # DATA ACCESS OBJECT DESIGN PATTERN....
      $item = getBookByID($conn, $_GET['book_id']);
   }





?>

<?php


if(array_key_exists('add', $_POST)){
  $errors = [];

  if(empty($_POST['amount'])){
    $errors['amount']="Please enter an amount";
  }

  if(empty($errors)){


  }
}
?>


?>



      <form class="search-brainfood">
        <input type="text" class="text-field" placeholder="Search all books">
      </form>
    </div>
  </div>
  <div class="main">
    <p class="global-error">You have not chosen any amount!</p>
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
          <input type="number" name="amount"class="book-amount text-field">
          <input class="def-button add-to-cart" type="submit" name="add" value="Add to cart">
        </form>
      </div>
    </div>
    <div class="book-reviews">
      <h3 class="header">Reviews</h3>
      <ul class="review-list">
        <li class="review">
          <div class="avatar-def user-image">
            <h4 class="user-init">jm</h4>
          </div>
          <div class="info">
            <h4 class="username">Jon Williams</h4>
            <p class="comment">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
        </li>
        <li class="review">
          <div class="avatar-def user-image">
            <h4 class="user-init">AE</h4>
          </div>
          <div class="info">
            <h4 class="username">Abby Essien</h4>
            <p class="comment">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
        </li>
        <li class="review">
          <div class="avatar-def user-image">
            <h4 class="user-init">SB</h4>
          </div>
          <div class="info">
            <h4 class="username">Sandra Bullock</h4>
            <p class="comment">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
        </li>
      </ul>
      <div class="add-comment">
        <h3 class="header">Add your comment</h3>
        <form class="comment">
          <textarea class="text-field" placeholder="write something"></textarea>
          <button class="def-button post-comment">Upload comment</button>
        </form>
      </div>
    </div>
  </div>
 <?php
   #include footer
 
   include 'includes/footer.php';

?>
  