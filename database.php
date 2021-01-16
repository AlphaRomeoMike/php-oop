<?php
    class Database{
        public $con;
        public function __construct()
        {
            $this->con = mysqli_connect('localhost', 'root', '', 'oop');

            if(!$this->con){
                echo "Database Error";
            } else {
                // echo "Database";
            }
        }
        public function insert($table_name, $data)
        {
            $string = "INSERT INTO ".$table_name." (";
            $string .= implode(",", array_keys($data)). ') VALUES (';
            $string .= "'". implode("','", array_values($data))."')";

            if(mysqli_query($this->con, $string)) {
                return true;
            } else {
                echo "Error, please try again";
            }
        }
    }
?>