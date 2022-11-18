<?php

/**
 * 
 *
 * @author pit
 */
class dbPdo {

    private $host;
    private $user;
    private $password;
    private $database;
    private $charset;
    private $collation;
    private $debug;

    public function __construct($host, $user, $password) {

        $this->host = $host;
        $this->user = $user;
        $this->password = $password;

        $this->charset = 'utf8mb4';
        $this->collation = 'utf8mb4_unicode_ci';
        $this->debug = true;                                //debug flag for print operation step, if false nothing appears on screen
    }

    /**
     * Conntect Sql without database
     * @return type
     */
    public function connectSql() {
        try {
            $this->link = $this->getPDO($this->host, $this->user, $this->password, "");
        } catch (PDOException $e) {
            echo '<br>'.$this->error_handling($e, __FUNCTION__);
            return false;
        }
        if ($this->debug) {
            $pass_string = str_repeat('*', strlen($this->password));
            $desc = "Host:" . $this->host . " User:" . $this->user . " Password:" . $pass_string;
            echo '<br>Connecting MySql ' . $desc . ' ' . ' successful!';
        }
        return true;
    }

    /**
     * Connect the database
     * New Pdo object with database connection 
     * @param type $database_name
     * @return boolean
     */
    public function connectDb($database_name) {
        $this->database = $database_name;
        try {
            $this->link = $this->getPDO($this->host, $this->user, $this->password, $database_name);
        } catch (PDOException $e) {
            echo '<br>'.$this->error_handling($e, __FUNCTION__);
            return false;
        }
        if ($this->debug) {
            echo '<br>Connecting database ' . $database_name . ' successful!';
        }
        return true;
    }

    /**
     * Set Dns string and attributes for connection
     * @param type $host
     * @param type $user
     * @param type $password
     * @param type $database
     * @return \PDO
     */
    protected function getPDO($host, $user, $password, $database) {
        $dsn = 'mysql:';
        if ($database) {
            $dsn .= 'dbname=' . $database . ';';
        }
        $matches = array();
        if (preg_match('/^(.*):([0-9]+)$/', $host, $matches)) {
            $dsn .= 'host=' . $matches[1] . ';port=' . $matches[2];
        } else {
            $dsn .= 'host=' . $host;
        }
        $dsn .= ';charset=' . $this->charset;

        return new PDO(
                $dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
        );
    }

    /**
     * Create database in this connection
     * @param type $database_name
     * @return boolean
     */
    public function createDatabase($database_name) {
        try {
            $sql = "CREATE DATABASE $database_name CHARACTER SET = $this->charset COLLATE = $this->collation;";
            $this->link->exec($sql);
        } catch (PDOException $e) {
            echo '<br>'.$this->error_handling($e, __FUNCTION__);
            return false;
        }
        if ($this->debug) {
            echo '<br>Database "' . $this->database . '" created!';
        }
        return true;
    }

    /**
     * Create all tables present in $tablesList
     * if a table exists it continues without creating it
     * @param type $tablesList (from class $dbTables->tablesList array)
     * @return boolean
     */
    public function createTables($tablesList) {
        $this->link->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        foreach ($tablesList as $value) {
            $tableName = $value[0];
            try {
                $sql = $value[1];
                $this->link->exec($sql);
                if ($this->debug) {
                    echo '<br>Table "' . $tableName . '" created!';
                }
            } catch (PDOException $e) {
                echo '<br>' . $this->error_handling($e, __FUNCTION__);
            }
        }
        return true;
    }

    /**
     * Executes the same query on all the tables in $tablesList
     * example: drop or truncate
     * @param type $tablesList (from class $dbTables->tablesList array)
     * @param type $action
     * @return boolean
     */
    public function opTables($tablesList, $action) {
        foreach ($tablesList as $value) {
            $tableName = $value[0];
            try {
                $sql = "$action TABLE $tableName;";
                $this->link->query($sql);
                if ($this->debug) {
                    echo "<br>Table $tableName " . " $action!";
                }
            } catch (PDOException $e) {
                echo "<br>Exec $action $tableName " . $this->error_handling($e, __FUNCTION__);
            }
        }
        return true;
    }

    /**
     * Execute an exec
     * @param type sql query
     * @return PDO Statement object
     */
    public function pdoExec($sql) {
        try {
            $stm = $this->link->exec($sql);
        } catch (PDOException $e) {
            echo "<br>Exec $sql " . $this->error_handling($e, __FUNCTION__);
            return false;
        }
        if ($this->debug) {
            echo "<br>Exec $sql done!";
        }
        return $stm;
    }

    /**
     * error handling if an error is not defined it stops the script execution
     * otherwise it returns the description of the error
     * @param type $e
     * @param type $prov :name of the original function of the error
     * @return type
     */
    protected function error_handling($e, $prov) {
        $desc = "";
        $ainfo = $e->errorInfo;
        //print("<pre>".print_r($ainfo,true)."</pre>");
        if ($ainfo[1] === 1049) { //Unknown database
            $desc = $ainfo[1] . " " . $ainfo[2];
        }
        if ($ainfo[1] === 1007) { //database already exists
            $desc = $ainfo[1] . " " . $ainfo[2];
        }
        if ($ainfo[1] === 1008) { //Can't drop database
            $desc = $ainfo[1] . " " . $ainfo[2];
        }
        if ($ainfo[1] === 1050) { //table already exists
            $desc = $ainfo[1] . " " . $ainfo[2];
        }
        if ($ainfo[1] === 1051) { //unknown table
            $desc = $ainfo[1] . " " . $ainfo[2];
        }
        if ($desc != "") {
            return $desc;
        } else {
            Die($prov . " ---> ERROR " . $ainfo[1] . " " . $ainfo[2] . "<br>FORCED END!");
        }
    }

}
