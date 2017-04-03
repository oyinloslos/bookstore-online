<?php
   #load db connection

   include 'includes/db.php';

   #including functions
   include 'includes/functions.php';

   #header

   ?>
   <?php

   #getting id of data from url
   $id =$_GET['id'];


   #deleting the row from table
  deleteCategory($conn,$_GET);



   ?>





















</div>

		<div class="paginated">
			
		</div>
	</div>

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>
</body>
</html>