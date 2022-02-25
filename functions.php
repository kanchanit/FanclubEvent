<?php 

    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'fanclub_db');
    
    class DB_con {

        function __construct() {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $this->dbcon = $conn;

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL : " . mysqli_connect_error();
            }
        }

        public function insert($firstname, $lastname, $email) {
            $result = mysqli_query($this->dbcon, "INSERT INTO member(Fname, Lname, email) VALUES('$Fname', '$Lname', '$email')");
            return $result;
        }

        public function fetchdata() {
            $result = mysqli_query($this->dbcon, "SELECT * FROM member");
            return $result;
        }

        public function fetchonerecord($NationalID) {
            $result = mysqli_query($this->dbcon, "SELECT * FROM member WHERE NationalID = '$NationalID'");
            return $result;
        }
        public function selectLeader($NationalID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM leader WHERE L_NationalID = '$NationalID'");
            return $result;
        }

        public function selectLocation($postNo){
            $result = mysqli_query($this->dbcon, "SELECT * FROM leader_location WHERE PostNo = '$postNo'");
            return $result;
        }

        public function selectBank($bankID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM bank WHERE BankID = '$bankID'");
            return $result;
        }

        public function update($firstname, $lastname, $email, $NationalID) {
            $result = mysqli_query($this->dbcon, "UPDATE member SET 
                Fname = '$firstname',
                Lname = '$lastname',
                email = '$email',
                WHERE NationalID = '$NationalID'
            ");
            return $result;
        }

        public function delete($NationalID) {
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM member WHERE NationalID = '$NationalID'");
            return $deleterecord;
        }

    }
    
    class Member extends DB_con{
        
    }

?>