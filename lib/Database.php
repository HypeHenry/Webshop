<?php

class Database {
    protected $_dbHandle;
    protected $_result;

    /** Connects to database **/

    public function __construct()
    {
        $this->_dbHandle = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    public function insertQuery($table, $aColumnsAndValues = array())
    {
        /** Variabelen voor de query */
        $rows_singlerow = null;
        $values_singlerow = null;

        foreach($aColumnsAndValues as $key => $value)
        {
            $rows_singlerow     .= $this->_dbHandle->real_escape_string($key . ",");
            $values_singlerow   .= "'" . $this->_dbHandle->real_escape_string($value). "',";
        }

        /** Laatste comma weg halen uit de rijen */
        $rows_singlerow     = substr_replace($rows_singlerow ,"",-1);
        $values_singlerow   = substr_replace($values_singlerow ,"",-1);

        $table = $this->_dbHandle->real_escape_string($table);

        /** Query uitvoeren */
        if($this->_dbHandle->query("INSERT INTO ".$table." (".$rows_singlerow.") VALUES (".$values_singlerow.")") === true)
        {
            return mysqli_insert_id($this->_dbHandle);
        } else {
            die(print_r($this->_dbHandle->error));
        }
    }

    /** Custom made UPDATE query by cees */
    function updateQuery($table,$rows = array(), $values = array(),$where)
    {
        /** Variabelen voor de query */
        $rows_singlerow = null;
        $values_singlerow = null;

        /** De rij die ingevuld moet worden */
        for($i=0; $i < count($rows); $i++)
        {
            $rows_singlerow .= mysqli_real_escape_string($rows[$i]) . '="' . mysqli_real_escape_string($values[$i]).'",';
        }

        /** Laatste comma weg halen uit de rijen */
        $rows_singlerow = substr_replace($rows_singlerow ,"",-1);

        $table = mysqli_real_escape_string($table);

        /** Query uitvoeren */
        mysqli_query("UPDATE ".$table." SET ".$rows_singlerow . ' WHERE '. $where,$this->_dbHandle) or die(mysqli_error());
        return mysqli_insert_id();
    }

    /** Custom made UPDATE query by cees */
    function deleteQuery($table,$where)
    {
        /** Query uitvoeren */
        if($this->_dbHandle->query("DELETE FROM ".$table." WHERE ". $where) === true)
        {
            return true;
        } else {
            die(print_r($this->_dbHandle->error));
        }
    }

    function deleteCategory($iId)
    {
        $this->deleteQuery("category", "id=" . intval($iId));
    }

    /** User id te pakken krijgen */
    public function getUserByEmail($sEmail)
    {
        //\'s hertog
        $sEmail = $this->_dbHandle->real_escape_string($sEmail);
        $useridQuery = $this->_dbHandle->query("SELECT * FROM user WHERE email='".$sEmail."'");
        $row = $useridQuery->fetch_array(MYSQLI_ASSOC);

        return $row;
    }

    public function getUserById($iId)
    {
        $useridQuery = $this->_dbHandle->query("SELECT * FROM user WHERE id=". $iId);
        $row = $useridQuery->fetch_array(MYSQLI_ASSOC);

        return $row;
    }

    public function getProductById($iId)
    {
        $query = $this->_dbHandle->query("SELECT * FROM product WHERE id=". $iId);
        $row = $query->fetch_array(MYSQLI_ASSOC);

        return $row;
    }

    public function getInvoicesByUserId($iId)
    {
        $useridQuery = $this->_dbHandle->query("SELECT * FROM invoice WHERE user_id=". $iId);
        while($row = $useridQuery->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }

        //$row = $useridQuery->fetch_array(MYSQLI_ASSOC);

        return $rows;
    }

    public function getCategories()
    {
        $query = $this->_dbHandle->query("SELECT * FROM category");
        while($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }

        //$row = $useridQuery->fetch_array(MYSQLI_ASSOC);

        return $rows;
    }

    public function getProducts()
    {
        $query = $this->_dbHandle->query("SELECT * FROM product");
        while($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /** User id te pakken krijgen */
    public function getUserByEmailAndPassword($sEmail, $sPassword)
    {
        //\'s hertog
        $sEmail = $this->_dbHandle->real_escape_string($sEmail);
        $useridQuery = $this->_dbHandle->query("SELECT * FROM user WHERE email='".$sEmail."' AND password='".$sPassword."'");
        $row = $useridQuery->fetch_array(MYSQLI_ASSOC);

        return $row;
    }

    function selectAll($table) {
        $table = mysqli_real_escape_string($table);
        $query = "SELECT * FROM ".$table;
        return $this->query($query);
    }
    /** Query die alles selecteerd maar wel een WHERE waarde mee krijgt */
    function selectAllWhere($table,$where) {
        $query = "SELECT * FROM ".$table." WHERE ".$where;
        if($query != null)
            $query = $query['0'];
        print_r($query);
        return $this->query($query);
    }

    function select($id) {
        $query = 'select * from `'.$this->_table.'` where `id` = \''.mysqli_real_escape_string($id).'\'';
        return $this->query($query, 1);
    }

    function getNumrows($query) {
        $result = mysqli_query($query, $this->_dbHandle);
        $num_rows = mysqli_num_rows($result);
        return $num_rows;
    }


    /** Custom SQL Query **/

    function query($query, $singleResult = 0) {

        $this->_result = mysqli_query($query, $this->_dbHandle);

        if (preg_match("/select/i",$query)) {
            $result = array();
            $table = array();
            $field = array();
            $tempResults = array();
            $numOfFields = mysqli_num_fields($this->_result);
            for ($i = 0; $i < $numOfFields; ++$i) {
                array_push($table,mysqli_field_table($this->_result, $i));
                array_push($field,mysqli_field_name($this->_result, $i));
            }


            while ($row = mysqli_fetch_row($this->_result)) {
                for ($i = 0;$i < $numOfFields; ++$i) {
                    $table[$i] = trim(ucfirst($table[$i]),"s");
                    $tempResults[$table[$i]][$field[$i]] = $row[$i];
                }
                if ($singleResult == 1) {
                    mysqli_free_result($this->_result);
                    return $tempResults;
                }
                array_push($result,$tempResults);
            }
            mysqli_free_result($this->_result);
            return($result);
        }


    }

    /** Free resources allocated by a query **/

    function freeResult() {
        mysqli_free_result($this->_result);
    }

    /** Get error string **/

    function getError() {
        return mysqli_error($this->_dbHandle);
    }
}
