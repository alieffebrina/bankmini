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

		$conn=mysqli_connect($this->dbHost,$this->dbUser, $this->dbPass, $this->dbName);
		if (mysqli_connect_errno()) { /* check connection */
			printf('Connect failed: %s\n', mysqli_connect_error());
			exit();
		}
		return $conn;	
	}
	function connect() {
        return $this ->connectMySQL();
	}
	
	function query($query)
	{
	global $dbUser, $dbPass, $dbHost, $dbname; 	

		$conn=mysqli_connect($this->dbHost,$this->dbUser, $this->dbPass, $this->dbName);
		if (mysqli_connect_errno()) { /* check connection */
			printf('Connect failed: %s\n', mysqli_connect_error());
			exit();
		}else{
			if ($result=mysqli_query($conn, $query)) {
				return $result;
			}else{
				return '<br><pre>QUERY GAGAL DIPROSES!</pre>';
				//echo '<pre>'.$sql.'</pre><br>';

			}

	}
	}
	

	    private function table_exists($table)
    {
        $tablesInDb = @mysqli_query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
        if($tablesInDb)
        {
            if(mysqli_num_rows($tablesInDb)==1)
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
			
		$result=mysqli_query($sql);
			
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

            $ins = @mysqli_query($insert);

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
            $del = @mysqli_query($delete);

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
            $query = @mysqli_query($update);
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