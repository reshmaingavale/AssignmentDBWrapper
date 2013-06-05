<?php
require_once "DBConnection.php";

class Query {

 const IDENTIFIER_QUOTE_SYMBOL = '`';

  public function __construct () {
        }

        public function insert($table, $values) {
              $_connection =DBConnection::getConnection();
		$sql = "INSERT INTO {$table}";
		$keysql = '';
		$valuesql = '';
		foreach($values as $key => $value) {
			$keysql .= "`$key`,";
			if (preg_match ("/^[0-9]+$/", $value)) {
				$valuesql .= "{$value},";
			} else {
				$valuesql .= "'{$value}',";
			}
		}
		$sql = $sql.'('.substr($keysql, 0, -1).')VALUES('.substr($valuesql, 0, -1).')';
                echo "***********************";
                echo "<br>";
                echo $sql;
                echo "<br>";
		$result = $this->query($sql,$_connection);
                echo "Insert operation performed on DB";
                echo "<br>";
                echo "***********************";
                if ($result == 1) {
		return true;
                } else {
                return false; }
	}

	////
	public function update($table, $data, $where) {
        $_connection =DBConnection::getConnection();
        $limit=0;
        $set = array();
        $i = 0;
        foreach ($data as $col => $val) {
            $val = '?';
            $set[] = $this->quoteIdentifier($col) . ' = ' . $val;
        }
        
        $data = array_values($data);
        
        if (is_array($where)) {
            $whereSet = array();
            foreach ($where as $col => $val) {
                $data[] = $val;
                $whereSet[] = $col;
            }
            $where = implode(' AND ', $whereSet);
        }
        
        if ($limit) {
            $limit = (int) $limit;
        }
        
        // build the statement
        $sql = "UPDATE "
             . $this->quoteIdentifier($table)
             . ' SET ' . implode(', ', $set)
             . (($where) ? " WHERE $where" : '')
             . (($limit) ? " LIMIT $limit" : '');
        
        $_connection->beginTransaction();
        echo "***********************";
        echo "<br>";
        echo $sql;
        echo "<br>";
        $stmt = $_connection->prepare($sql);
        $stmt->execute($data);
        echo "update operation performed on DB";
        echo "<br>";
        echo "***********************";
        $affectedRows = $stmt->rowCount();
        $_connection->commit();
        
        return $affectedRows;
	}
        
         public function quoteIdentifier($value)
    {
        $q = self::IDENTIFIER_QUOTE_SYMBOL;
        return ($q . str_replace("$q", "$q$q", $value) . $q);
    }
      
	
	// crud
	public function query($sql,$_connection){
            $stmt= $_connection->prepare( $sql );
            $result = $stmt->execute();
	    return $result;
                
		
	}

         public function delete($table, $where = '')
    {
        $_connection =DBConnection::getConnection();
        $limit =0;
        $bind = array();
        if (is_array($where)) {
            $whereSet = array();
            foreach ($where as $col => $val) {
                $bind[] = $val;
                $whereSet[] = $col;
            }
            $where = implode(' AND ', $whereSet);
        }
        
        if ($limit) {
            $limit = (int) $limit;
        }
        
        // build the statement
        $sql = "DELETE FROM "
        . $this->quoteIdentifier($table)
        . (($where) ? " WHERE $where" : '')
        . (($limit) ? " LIMIT $limit" : '');
        
        $_connection->beginTransaction();
        echo "***********************";
        echo "<br>";
        echo $sql;
        echo "<br>";
        $stmt = $_connection->prepare($sql);
        $stmt->execute($bind);
        $affectedRows = $stmt->rowCount();
        $_connection->commit();
        echo "Delete operation performed on DB";
        echo "<br>";
        echo "***********************";
        return $affectedRows;
    }
}
?>