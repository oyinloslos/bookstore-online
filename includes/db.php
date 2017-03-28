<?php  #test.php sandbox

define('DBNAME','onlinestore');
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
}
?>
