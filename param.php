<?php

/*
 *  pit - 9 nov 2022  - 13:47:50
 */

/**
 * Database connection parameters
 * @author pit
 */
class param {

    public $host;
    public $user;
    public $dbname;
    public $dbpass;
    public $dbport;

    function __construct() {
        $this->server_name = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_DEFAULT);

        if ($this->server_name == "127.0.0.1" || $this->server_name == "localhost") {
            $this->user = "root";
            $this->dbname = "links";
            $this->dbpass = "a27b11c1962d15e15f";
            error_reporting(E_ALL);
        } else {
            $this->user = "username";
            $this->dbname = "links";
            $this->dbpass = "";
            error_reporting(0);
        }

        $this->host = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_DEFAULT);
        $this->dbport = 3306;
        $this->host = $this->host . ":" . $this->dbport;
    }

}
