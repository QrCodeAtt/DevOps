<?php
class dbSetup{
	
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname   = "assignment";
	
function __construct(){
	$this->dbConnect();
	$this->createEnrolmentTable();
	$this->createStaffTable();
	$this->createModuleTable();
	$this->createTimeTable();
	$this->createMappingTable();
	echo ":)";
}

function dbConnect(){
   // Create connection
	$conn = @mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
	// Check connection
		if ($conn->connect_error) {
			// Create database if it does not exist
			$sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
			if ($conn->query($sql) === TRUE) {
				$conn = $conn;
			} else {
				$conn = $conn;
			}	
			$msg = $conn->connect_error;
		}else { $conn = $conn; }
		return $conn;
}
function createEnrolmentTable(){
	$msg = 0;
	$con = $this->dbConnect();
	$sql = "CREATE TABLE IF NOT EXISTS enrolment (id int(9), stid varchar(7) NOT NULL PRIMARY KEY,
	        email varchar(256), name varchar(256), course varchar(100), programme varchar (20), session varchar(10) NOT NULL,
	        gender char (1), password varchar(256),
	        regDate timestamp DEFAULT CURRENT_TIMESTAMP);";
	$q = $con->query($sql);
	if($q !== true){ $msg = 0; }else { $msg = 1;}
	return $msg;
}

function createStaffTable(){
	$msg = 0;
	$con = $this->dbConnect();
	$sql = "CREATE TABLE IF NOT EXISTS staff (id int, stfid varchar(7) NOT NULL PRIMARY KEY,
	                 email varchar(256), name varchar(256), qualification varchar(100), password varchar(256), 
		         specialisation varchar (10), department varchar (256), rank varchar (50), 
	                 gender char (1), regDate timestamp DEFAULT CURRENT_TIMESTAMP);";
	$q = $con->query($sql);
	if($q !== true){ $msg = 0; }else { $msg = 1;}
	return $msg;
}
function createModuleTable(){
	$msg = 0;
	$con = $this->dbConnect();
	$sql = "CREATE TABLE IF NOT EXISTS Module (id int, 
	        cosCode varchar (5), cosTitle varchar (100), level varchar(5), lecturer varchar(100),
			regDate timestamp DEFAULT CURRENT_TIMESTAMP, stfid varchar(5),
			PRIMARY KEY (id, cosCode),
			FOREIGN KEY (stfid) REFERENCES staff(stfid) ON DELETE CASCADE
			);";
	$q = $con->query($sql);
	if($q !== true){ $msg = 0; }else { $msg = 1;}
	return $msg;
}

function createTimeTable(){
	$msg = 0;
	$con = $this->dbConnect();
	$sql = "CREATE TABLE IF NOT EXISTS timetable (id int auto_increment primary key,  cosCode varchar(5), 
	        openAt TIME NOT NULL, closeAt TIME NOT NULL, graceAt TIME NOT NULL, stfid varchar(5), 
			regDate timestamp DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (stfid) REFERENCES staff(stfid) ON DELETE CASCADE
			);";
	$q = $con->query($sql);
	if($q !== true){ $msg = 0; }else { $msg = 1;}
	return $msg;
}

function createMappingTable(){
	$msg = 0;
	$con = $this->dbConnect();
	$sql = "CREATE TABLE IF NOT EXISTS mapping (id int auto_increment primary key,  cosCode varchar(5), 
	        stid varchar(7), cosTitle varchar(100), stfid varchar(5), 
			regDate timestamp DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (stfid) REFERENCES staff(stfid) ON DELETE CASCADE,
			FOREIGN KEY (stid) REFERENCES enrolment(stid) ON DELETE CASCADE
			);";
	$q = $con->query($sql);
	if($q !== true){ $msg = 0; }else { $msg = 1;}
	return $msg;
}

function createAttendanceTable(){
	$msg = 0;
	$con = $this->dbConnect();
	$sql = "CREATE TABLE IF NOT EXISTS attendance (id int auto_increment primary key, stid varchar(7),  
	        cosCode varchar(5),  takenAt TIME, type varchar(100), 
			regDate timestamp DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (stid) REFERENCES enrolment(stid) ON DELETE CASCADE
			);";
	$q = $con->query($sql);
	if($q !== true){ $msg = 0; }else { $msg = 1;}
	return $msg;
}
}
$Setup = new dbSetup();


?>
