<?php

/*
 *  pit - 10 nov 2022  - 15:08:00
 */

/**
 * Diefine Tables structure
 *
 * @author pit
 */
class dbTablesDb1 {
    public $tablesList;
function __construct() {
    $this->tablesList = array(
        array("engine", 'CREATE TABLE engine (' .
            'ID integer UNSIGNED NOT NULL AUTO_INCREMENT,' .
            'CODE varchar(20) NOT NULL,' .
            'SITE varchar(50) NOT NULL,' .
            'PRIMARY KEY ( ID )' .
            ' ) ENGINE = InnoDB'),
        array("status", 'CREATE TABLE status (' .
            'ID integer UNSIGNED NOT NULL AUTO_INCREMENT,' .
            'CODE varchar(20) NOT NULL,' .
            'SITE varchar(50) NOT NULL,' .
            'LINK varchar(200) NOT NULL,' .
            'SITELINK varchar(200),' .
            'CURRENT_STATE BOOLEAN,' .
            'PREVIOUS_STATE BOOLEAN,' .
            'RESPONSEOFF varchar(1000),' .
            'PRIMARY KEY ( ID ),' .
            'INDEX IDXCODE ( CODE ),' .
            'INDEX IDXSITE ( SITE )' .
            ' ) ENGINE = MyISAM'),
    );
    
}

}
