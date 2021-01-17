<?php
    class Database{
        public $con;

        //* CREATE CONSTRUCTOR
        public function __construct()
        {
            $this->con = mysqli_connect('localhost', 'root', '', 'oop');

            if(!$this->con){
                echo "Database Error";
            } else {
                // echo "Database";
            }
        }


        //* INSERT SINGLE DATA
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


        //* FETCH ALL DATA
        public function select($table_name) {
            $array = array ();
            $query = "SELECT * FROM ".$table_name."";
            $result = mysqli_query($this->con, $query);
            while($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }
            return $array;
        }


        //* FETCH SINGLE DATA
        public function select_where($table_name, $where_condition) {
            $condition = '';
            $array = array();
            foreach($where_condition as $key => $values) {
                $condition .= $key . " = '". $values ."' AND";
            }
            $condition = substr($condition, 0, -5);

            $query = "SELECT * FROM ".$table_name." WHERE " . $condition;
            $result = mysqli_query($this->con, $query);
            while($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }
            return $array;
        }
    }
?>