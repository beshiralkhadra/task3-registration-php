<?php 
// connecting loginapp table
// $connection = mysqli_connect('localhost','root','','registerapp');
// if (!$connection){
// die('database failed');
// }
?>

<?php 
// $host = 'localhost';
// $db = 'registerapp';
// $user = 'root';


// try {
//     $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
// 	$pdo = new PDO($dsn, $user, '');

// 	if ($pdo) {
// 		echo "Connected to the $db database successfully!";
// 	}
// } catch (PDOException $e) {
//     $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); 
// $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
// 	echo 'failed connection';
// } 
?>
<?php 

class db {
private $host ="localhost";
private $user ="root";
private $pwd ="";
private $dbName ="registerapp";

protected function connect(){
	$dsn = 'mysql:host='.$this->host . '; dbname=' .$this->dbName;
	$pdo = new PDO ($dsn ,$this->user ,$this->pwd);
	$pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC ); //OPTIONAL HOW YOU WANT TO PULL UP THE DATA AS ASSOC
	return $pdo;
}

}


?>