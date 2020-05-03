<?php
class Databases {	
	public $connection;
	public $error;
	public $lastRecord;
	public $result;

	public function __construct(){

		try {
			$this->connection = mysqli_connect("localhost", "root","","cactsla1_db");
		} catch (Exception $e) {
			echo 'Databse Connection Error'. mysqli_connect_error($this->connection);
		}
		
	}

	public function insert($table,$data){
		$string = "INSERT INTO " . $table . " (";
		$string .= implode(",", array_keys($data)) . ') VALUES (';
		$string .= "'". implode("','", array_values($data)) . "')";
		if (mysqli_query($this->connection, $string)) {
			$this->lastRecord = mysqli_insert_id($this->connection);
			return true;
		}else {
			echo mysqli_error($this->connection);
		}
	}

	public function update($tbl_name, $fields, $where){
		$qryString = '';
		$condition = '';

		foreach ($fields as $key => $value) {
			$qryString .= $key . "='" . mysqli_real_escape_string($this->connection, $value) ."',";
		}

		$qryString = substr($qryString,0,-1);
		foreach ($where as $key => $value) {
			$condition .= $key . " = '".mysqli_real_escape_string($this->connection, $value)."' AND ";
		}

		$condition =substr($condition,0,-5);
		$qryString = "UPDATE ". $tbl_name . " SET " .$qryString ." WHERE " .$condition. "";
		if (mysqli_query($this->connection, $qryString)) {
		
			return true;
		}else{
			echo mysqli_error($this->connection);
			return false;

		}
	}
	
	public function selectWhere($table, $where, $order="", $sortKey=""){
		$condition = "";
		$fetch =array();

		if (!empty($where)) {
			foreach ($where as $key => $value) {
				$condition.= $key . "='".mysqli_real_escape_string($this->connection, $value)."' AND ";
			}
			
			$condition = substr($condition,0,-5);
			$query = "SELECT * FROM ". $table." WHERE ".$condition."";

			if (!empty($order)) {
				$query = $query ." order by ".$order." ".$sortKey."";
			}
		}else{
			$query ="SELECT * FROM ". $table . "";
		}
		

		
		
		$this->result = mysqli_query($this->connection,$query);
		while ($row = mysqli_fetch_assoc($this->result)) {
				$fetch[]=$row;
		}
		return $fetch; 
	}
	
	public function selectWhereby($table, $where){
		$condition = "";
		$fetch =array();

		foreach ($where as $key => $value) {
			$condition.= $key . "='".mysqli_real_escape_string($this->connection, $value)."' AND ";
		}

		$condition = substr($condition,0,-5);
		$matric = "student_matric";
		$query = "SELECT * FROM ". $table." WHERE ".$condition." order by ".$matric."";
		
		$this->result = mysqli_query($this->connection,$query);
		while ($row = mysqli_fetch_assoc($this->result)) {
				$fetch[]=$row;
		}
		return $fetch; 
	}
	
	public function get_all_order_by($table, $order){
		
		$fetch =array();
        $query = "SELECT * FROM ".$table." ORDER BY ".$order."";
		$this->result = mysqli_query($this->connection,$query);
		$rows =mysqli_num_rows($this->result);
		while ($row = mysqli_fetch_assoc($this->result)) {
				$fetch[]=$row;
		}
		return $fetch; 
	}

	public function selectLike($table, $where){
		$condition = "";
		$fetch =array();

		foreach ($where as $key => $value) {
			$condition.= $key . " LIKE '%".mysqli_real_escape_string($this->connection, $value)."%' AND ";
		}

		$condition = substr($condition,0,-5);
		$query = "SELECT * FROM ". $table." WHERE ".$condition."";
		$this->result = mysqli_query($this->connection,$query);
		while ($row = mysqli_fetch_assoc($this->result)) {
				$fetch[]=$row;
		}
		return $fetch; 
	}

	public function delete($table, $where){
		$condition = "";
		foreach ($where as $key => $value) {
			$condition.= $key . "='".mysqli_real_escape_string($this->connection, $value)."' AND ";
		}

		$condition = substr($condition,0,-5);
		$query = "DELETE FROM ". $table." WHERE ".$condition."";
		$this->result = mysqli_query($this->connection,$query);
	}

	
	public function selectAll($table){
		$fetch = array();
		$query = "SELECT * FROM ".$table."";
		$this->result = mysqli_query($this->connection,$query);
		$rows =mysqli_num_rows($this->result);
		while ($row = mysqli_fetch_assoc($this->result)) {
				$fetch[]=$row;
		}
		return $fetch;  
	}

	public function validation($field){
		$count = 0;
		foreach ($field as $key => $value) {
			if (empty($value)) {
				$count++; 
				$this->error = "<p>".$key."is required</p>";
			}
		}
		if ($count==0) {
			return true;
		}
	}

	public function lastId(){

		return $this->lastRecord;
	}

	public function sqlResult(){
		return $this->result;
	}
	
	public function errLog(){
		return $this->error;
	}

} 

$db = new Databases;
?>