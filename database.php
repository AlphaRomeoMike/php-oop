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
        public function select_where($table_name, $where) {
            $condition = '';
            $array = array();
            foreach($where as $key => $value) {
                $condition .= $key . " = '".$value."' AND ";
            }
            $condition = substr($condition, 0, -5);
            $query = "SELECT * FROM $table_name WHERE $condition";
            $result = mysqli_query($this->con, $query);

            while($row = mysqli_fetch_array($result)) {
                $array[] = $row;
            }
            return $array;
        }
        
        //* UPDATE SINGLE DATA
        public function update($table_name, $fields, $where) {
            $query = '';
            $condition = '';

            foreach($fields as $key => $value) {
                $query .= $key. "='".$value."', ";
            }
            $query = substr($query, 0, -2);
            foreach($where as $key => $value) {
                $condition .= $key. "='".$value."' AND ";
            }
            $condition = substr($condition, 0, -5);
            $query = "UPDATE $table_name SET $query WHERE $condition";

            if(mysqli_query($this->con, $query)) {
                return true;
            }
        }
    }
?>