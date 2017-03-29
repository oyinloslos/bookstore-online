<?php  #test.php sandbox

/*define('DBNAME','onlinestore');
define('DBUSER','root');
define('DBPASS','vagrant');

$conn = new PDO ('mysql:host=localhost;dbname='.DBNAME, DBUSER,DBPASS);

try{
	#prepare a pdo instance
	$conn = new pdo('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

	#set verbose error modes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

} catch(PDOException $e) {
	echo $e->getMessage();
}*/

if(array_key_exists('save', $_POST)){
	print_r($_FILES);
}

#max file size...
define("MAX_FILE_SIZE", "2097152");

#allowed extension...
$ext = ["image/jpg","image/jpeg", "image/png"];

if(array_key_exists('save', $_POST)) {
	$errors = [];

	#be sure a file was selected....
	if(empty($_FILES['pic']['name'])){
		$errors[]= "please choose a file";
	}

	#check file size...

	if($_FILES['pic']['size'] > MAX_FILE_SIZE) {
		$errors[] = "file size exceeds maximum. maximum: ".MAX_FILE_SIZE;
	}

	#check extention....
	if(!in_array($_FILES['pic']['type'], $ext)) {
		$errors[] = "Invalid file type";
	}

	#generate random number to append
	$rnd = rand(0000000000, 9999999999);

	#strip filename for spaces

	$strip_name = str_replace("","_", $_FILES['pic']['name']);

	$filename = $rnd.$strip_name;
	$destination = 'uploads/'.$filename;

	if(!move_uploaded_file($_FILES['pic']['tmp_name'], $destination)) {
		
		$errors[]  = "file upload failed";
	}



	if(empty($errors)) {
		echo "done";

	}else{
		foreach ($errors as $error) {
			echo $error. '</br>';
		}
	}
}

?>


<form id="register" method="POST" enctype="multipart/form-data">
	<p>please upload a file</p>
	<input type="file" name="pic">

	<input type="submit" name="save">
</form>

