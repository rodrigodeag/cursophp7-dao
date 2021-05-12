<?php 

class Sql extends PDO {

	private $conn;

	public function __construct(){

		$this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");
		
	}

	private function setParams($statemente, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->setParams($key, $value);	
		}	
	}

	private function setParam($statemente, $key, $valor){

			$statemente->bindParam($key, $value);			
	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

		}

	public function select($rawQuery, $params = array()):array{

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}

}

 ?>