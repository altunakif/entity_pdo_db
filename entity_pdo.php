<?php
class dataBase extends PDO
{
	private $table 	;
	public 	$sql	;
	private $method	;
	public 	$result	;
	
	public function __construct($host = 'localhost', $dbname = 'k_dbo', $username = 'root', $password = '')
	{
		$dsn	 = "mysql:dbname={$dbname}; host={$host}";
		$options = array(PDO::ATTR_CASE 				=> PDO::CASE_NATURAL,
        				 PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_SILENT,
        				 PDO::ATTR_ORACLE_NULLS 		=> PDO::NULL_NATURAL,
        				 PDO::ATTR_STRINGIFY_FETCHES	=> false,
        				 PDO::ATTR_EMULATE_PREPARES 	=> false,
						 PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_ASSOC,
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
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function __call */
	
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
	
	public function insert($var = null, $val = null)
	{
		try
		{
			if (is_array($var))
			{
				foreach($var as $index => $row)
				{
					$col .= $index.", ";
					$val .= $row.", ";
				}
				$col = trim($col);
				$val = trim($val);
				
				$col = substr($col, 0, -1);
				$val = substr($val, 0, -1);
			}
			else
			{
				$col = $var;
			}
			
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
  
  	public function update($var = null)
	{
		try
		{
			if (is_array($var))
			{
				foreach($var as $index => $row)
				{
					$setr .= $index." = ".$row.", ";
				}
				$setr = trim($setr);
				$setr = substr($setr, 0, -1);
			}
			else
			{
				$setr = $var;
			}
			
			$this->sql 		= "UPDATE $this->table SET {$setr}";
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
	
	public function where($var)
	{
		try
		{
			$this->sql .= " WHERE ".$var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function where */
	
	public function andWhere($var)
	{
		try
		{
			$this->sql .= " AND ".$var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function andWhere */
	
	public function like($var)
	{
		try
		{
			$this->sql .= " LIKE ".$var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function like */
	
	public function orderBy($var)
	{
		try
		{
			$this->sql .= " ORDER BY ".$var;
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
	
	public function having($var)
	{
		try
		{
			$this->sql .= " HAVING ".$var;
			return $this;
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	}/* function having */
	
	public function limit($var)
	{
		try
		{
			$this->sql .= " LIMIT ".$var;
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
			if ($this->method == "SELECT")
			{
				$query = PDO::prepare($this->sql);
				if(!$query) throw new Exception("SQL hatası : {$this->sql}"); 
				$query ->execute();
				$this->result = $query->fetchAll(PDO::FETCH_ASSOC);
			}
			
			if ($this->method == "INSERT")
			{
				$query = PDO::prepare($this->sql);
				if(!$query) throw new Exception("SQL hatası : {$this->sql}");
				$query ->execute();
				if ($query) $this->result = true;
			}
			
			if ($this->method == "DELETE")
			{
				$query = PDO::prepare($this->sql);
				if(!$query) throw new Exception("SQL hatası : {$this->sql}");
				$query ->execute();
				if ($query) $this->result = true;
			}
			
			if ($this->method == "UPDATE")
			{
				$query = PDO::prepare($this->sql);
				if(!$query) throw new Exception("SQL hatası : {$this->sql}");
				$query ->execute();
				if ($query) $this->result = true;
			}
		}
		catch(Exception $e)
		{
			echo  "Error : ".$e->getMessage() ."<br/>"."File : ".$e->getFile() . "<br/>"."Line : ".$e->getLine() . "<br/>";
		}
	} /* function run */
}
?>