<?php
class DataBase extends PDO
{
	private $host		;
	private $dbName		;
	private $username	;
	private $password	;
	
	private $table 		;
	private $method		;
	private $columns	;
	private $column 	;
	private $set 		;
	public  $bindPar 	;
	public 	$query		;
	public 	$sql		;
	
	public function __construct($host = 'localhost', $dbname = 'k_dbo', $username = 'root', $password = '')
	{
		$this->host 	= $host ;
		$this->dbName 	= $dbname ;
		$this->username	= $username ;
		$this->password	= $password ;

		$dsn	 = "mysql:dbname={$dbname}; host={$host}";
		$options = array(PDO::ATTR_CASE 				=> PDO::CASE_NATURAL,
        				 PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_SILENT,
        				 PDO::ATTR_ORACLE_NULLS 		=> PDO::NULL_NATURAL,
        				 PDO::ATTR_STRINGIFY_FETCHES	=> false,
        				 PDO::ATTR_EMULATE_PREPARES 	=> false,
						 PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_OBJ,
						 PDO::MYSQL_ATTR_INIT_COMMAND 	=> "SET NAMES utf8");
						 
		try {
			parent::__construct($dsn, $username, $password, $options);
			} //try S
		catch(PDOException $e){
							   echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
							   die;
							  }//catch S
	} /* function __construct() */
	
	public function __call($metot, $arg)
	{
		try
		{
			$column = substr($metot,3);
			$metot  = substr($metot,0,3);
			
			if (strcasecmp($metot, "set")==0)
			{
				$this->columns();
				foreach($this->columns as $row)
				{
					if (strcasecmp($row, $column) ==0)
					{
						$this->column[$row] = $arg[0];
						$this->set();
						return $this;
					}
				}
			} /* if */
			
			if (strcasecmp($metot, "get")==0)
			{
				$this->columns();
				foreach($this->columns as $row)
				{
					if (strcasecmp($row, $column) ==0)
					{
						$this->column[] = $row;
						$this->get();
						return $this;
					}
				}
			} /* if */
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function __call */
	
	public function set()
	{
		try
		{
			$this->set ="";
		
			foreach ($this->column as $index => $row)
			{
				$this->set 				   .= "{$index} = :{$index}, ";
				$this->bindPar[":{$index}"] = $row;
			}
			
			$this->set = trim($this->set);
			$this->set =substr($this->set,0, -1);
			
			$this -> sql 	= "UPDATE {$this->table} SET {$this->set}";
			$this->method 	= "UPDATE";
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function set() */
	
	public function get()
	{
		try
		{
			foreach($this->column as $row)
			{
				$column .= $row.", ";
			}
			
			$column = trim($column);
			$column = substr($column, 0, -1);
			$this -> sql 	= "SELECT {$column} FROM {$this->table}";
			
			$this->method 	= "SELECT";
			return $this;
		}
		catch(Exception $e)
		{
		}
	} /* function get() */
	
	public function columns()
	{
		$dbName = $this->dbName;
		$table  = $this->table;
		
		$query = PDO::query("SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS`
							WHERE TABLE_SCHEMA = '$dbName' AND
 							TABLE_NAME = '$table' ORDER BY `ORDINAL_POSITION`");
							
		foreach ($query as $row)
		{
			$this->columns[] = $row[COLUMN_NAME];
		}
	} /* function columns() */
	
	public function from($table)
	{
		try
		{
			$this->table = $table;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function from */
	
	public function select($var)
	{
		try
		{
			if (empty($var)) $var = "*";
			$this->sql 		= "SELECT {$var} FROM $this->table";
			$this->method	= "SELECT";
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function get */
	
	public function insert($var)
	{
		try
		{
			if (is_array($var))
			{
				$col = "";
				$val = "";
				foreach($var as $index => $row)
				{
					$col 							.= $index.", ";
					$val 							.= ":".$index.", ";
					$this->bindPar[":{$index}"]      = $row;
				}
				$col = trim($col);
				$val = trim($val);
				
				$col = substr($col, 0, -1);
				$val = substr($val, 0, -1);
			}
			else
			{
				throw new Exception("Hatalı parametre correct use of : ->insert(\$array)");
			}
			
			var_dump($this->bindPar);
			$this->sql 		= "INSERT INTO $this->table ({$col}) VALUES ({$val})";
			$this->method	= "INSERT";
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function insert */
	
	public function delete()
	{
		try
		{
			$this->sql 		= "DELETE FROM $this->table ";
			$this->method	= "DELETE";
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function delete */
  
  	public function update($var)
	{
		try
		{
			if (is_array($var))
			{
				foreach($var as $index => $row)
				{
					$setr 					   .= $index." = ".":".$index.", ";
					$this->bindPar[":{$index}"] = $row;
				}
				$setr = trim($setr);
				$setr = substr($setr, 0, -1);
			}
			else
			{
				throw new Exception("Hatalı parametre correct use of : ->update(\$array)");
			}
			
			$this->sql 		= "UPDATE $this->table SET {$setr}";
			var_dump($this->sql);
			$this->method	= "UPDATE";
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function update */
  
	public function innerJoin($var)
	{
		try
		{
			$this->sql .= " INNER JOIN ".$var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function innerJoin */
	
	public function rightJoin($var)
	{
		try
		{
			$this->sql .= " RIGHT JOIN ".$var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function rightJoin */
	
	public function leftJoin($var)
	{
		try
		{
			$this->sql .= " LEFT JOIN ".$var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function leftJoin */
	
	public function on($var)
	{
		try
		{
			$this->sql .= " ON ".$var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function on */
	
	public function where($left, $ope = null, $right = null)
	{
		try
		{
			if (!is_null($ope) and !is_null($right))
			{
				$this->sql 					.= " WHERE {$left}  {$ope} :{$left}";
				$this->bindPar[":{$left}"]	 = $right;
				return $this;
			}
			else
			{
				$this->sql .= " WHERE ".$left;
				return $this;
			}
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function where */
	
	public function andWhere($left, $ope = null, $right = null)
	{
		try
		{
			$this->sql 						.= " AND {$left}  {$ope} :{$left}And";
			$this->bindPar[":{$left}And"]	 = $right;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function andWhere */
	
	public function orWhere($left, $ope = null, $right = null)
	{
		try
		{
			$this->sql 						.= " OR {$left}  {$ope} :{$left}Or";
			$this->bindPar[":{$left}Or"]	 = $right;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function orWhere */
	
	public function like($var)
	{
		try
		{
			$this->sql 				.= " LIKE :like";
			$this->bindPar[":like"]  = $var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function like */
	
	public function orderBy($col = null, $met = null)
	{
		try
		{
			$this->sql .= " ORDER BY {$col} {$met}";
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function orderBy */
	
	public function groupBy($var)
	{
		try
		{
			$this->sql .= " GROUP BY ".$var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	}/* function groupBy */
	
	public function having($left, $ope = null, $right = null)
	{
		try
		{
			$this->sql 						 .= " HAVING {$left} {$ope} :{$left}having";
			$this->bindPar[":{$left}having"]  = $right;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	}/* function having */
	
	public function limit($limit, $start = 0)
	{
		try
		{
			$this->sql 				.= " LIMIT :val1, :val2";
			$this->bindPar[":val1"]  = $start;
			$this->bindPar[":val2"]  = $limit;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	}/* function groupBy */
	
	public function run()
	{
		try
		{
			$this->query = PDO::prepare($this->sql);
				if(!$this->query) throw new Exception("SQL hatası : {$this->sql}");
				
				if (!empty($this->bindPar))
				{
					foreach($this->bindPar as $index => &$row)
					{
						$this->query->bindParam($index, $row);
					}
				}
				
			$this->query->execute();
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function run */
	
	public function LastID(){
		return $this->lastInsertId();
	}
	
	public function results($single = false) {
		$this->run();
		if($single){
			return $this->query->fetch();
		} else {
			try {
				return $this->query->fetchAll();
			}
			catch(Exception $e)
			{
				echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
			}
		}
	}
}
?>
