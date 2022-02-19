<?php
class Dbh{
private $host = "198.71.55.59:3306";
private $user = "team1";
private $pwd = "teamOneRocks-1";
private $dbName = "columbia-p1";
	
protected function connect(){
$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
$pdo = new PDO($dsn, $this->user, $this->pwd);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
return $pdo;
$pdo = null;
}
}
?>