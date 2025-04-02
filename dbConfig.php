<?php
class dbSetup{
	
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname   = "assignment";

function dbConnect(){
	$msg = 0;
   // Create connection
	$conn = @mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
	// Check connection
		if ($conn->connect_error) {
			// Create database if it does not exist
			$sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
			if ($conn->query($sql) === TRUE) {
				$msg = $conn;
			} else {
				$msg = $conn->connect_error;
			}	
			$msg = $conn->connect_error;
		}else { $conn = $conn; }
		return $conn;
}
function createEnrolmentTable(){
	$con = $this->dbConnect();
	$sql = "CREATE TABLE IF NOT EXISTS enrolment (id int(9), stid varchar(7) NOT NULL PRIMARY KEY,
	        email varchar(256), name varchar(256), course varchar(100), programme varchar (10));";
	$q = $con->query($sql);
	if($q !== true){ echo "Error Occured"; }else { echo "Database Created ";}
}

function createStaffTable(){
	$con = $this->dbConnect();
	$sql = "CREATE TABLE IF NOT EXISTS staff (id int(9), stfid varchar(7) NOT NULL PRIMARY KEY,
	        email varchar(256), name varchar(256), qualification varchar(100), specialisation varchar (10), 
			regDate timestamp DEFAULT CURRENT_TIMESTAMP);";
	$q = $con->query($sql);
	if($q !== true){ echo "Error Occured"; }else { echo "Database Created ";}
}
}
$Setup = new dbSetup();
$Setup->createEnrolmentTable(); 
echo "<br>";
$Setup->createStaffTable();

?>
