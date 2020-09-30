<?php
/* APLIKASI PENJUALAN DPOS PRO
 *
 * Framework DPOS BISNIS berbasis PHP
 *
 * Developed by djavasoft.com
 * Copyright (c) 2018, Djavasoft Smart Technology
 *
 * @author	Mohamad Anton Arizal
 * @copyright	Copyright (c) 2018 Djavasoft. (https://djavasoft.com/)
 *
 *
*/



class Database {
	// properti
	public $dbHost;
	public $dbUser;
	public $dbPass;
	public $dbName;

	// method koneksi mysql
	function connectMySQL() {
		mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
		mysql_select_db($this->dbName) or die ("<center>Database Tidak Ditemukan di Server.<br/>Silakana melakaukan instalasi <a href='install.php'>disini</a></center> "); 		
		$conn = mysql_connect($this->dbHost,$this->dbUser,$this->dbPass);
		if(!$conn) die("Failed to connect to database!");
		$status = mysql_select_db($this->dbName, $conn);
		if(!$status) die("Failed to select database!");
		return $conn;	
	}
	function connect() {
        return $this ->connectMySQL();
	}
	
		function query($query)
	{
	global $dbUser, $dbPass, $dbHost, $dbname; 	
		mysql_connect($this->dbHost, $this->dbUser, $this->dbPass)or die("cannot connect to db");
		mysql_select_db($this->dbName)or die("cannot select DB");
		$result = mysql_query($query); 
		return $result; 
	}

	    private function table_exists($table)
    {
        $tablesInDb = @mysql_query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
        if($tablesInDb)
        {
            if(mysql_num_rows($tablesInDb)==1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
	
	public function select($table, $rows = '*', $where = null, $order = null){	
		$sql = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $sql .= ' WHERE '.$where;
        if($order != null)
            $sql .= ' ORDER BY '.$order;
			
		$result=mysql_query($sql);
			
		return $result;
	}

    public function insert($table,$rows = null,$values)
    {
        if($this->table_exists($table))
        {
            $insert = 'INSERT INTO '.$table;
            if($rows != null)
            {
                $insert .= ' ('.$rows.')';
            }

            for($i = 0; $i < count($values); $i++)
            {
                if(is_string($values[$i]))
                    $values[$i] = '"'.$values[$i].'"';
            }
            $values = implode(',',$values);
            $insert .= ' VALUES ('.$values.')';

            $ins = @mysql_query($insert);

            if($ins)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    public function delete($table,$where = null)
    {
        if($this->table_exists($table))
        {
            if($where == null)
            {
                $delete = 'DELETE '.$table;
            }
            else
            {
                $delete = 'DELETE FROM '.$table.' WHERE '.$where;
            }
            $del = @mysql_query($delete);

            if($del)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }	
    public function update($table,$rows,$where)
    {
        if($this->table_exists($table))
        {
            // Parse mana nilai-nilai
            // Bahkan nilai-nilai (termasuk 0) mengandung baris mana
            // Nilai ganjil mengandung klausul untuk baris
			
            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows);
            for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }

                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ',';
                }
            }
            $update .= ' WHERE '.$where;
            $query = @mysql_query($update);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}
?>