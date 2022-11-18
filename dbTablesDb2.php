<?php

/*
 *  pit - 10 nov 2022  - 15:08:00
 */

/**
 * Diefine Tables structure
 *
 * @author pit
 */
class dbTablesDb2 {
    public $tablesList;
function __construct() {
    $this->tablesList = array(
        array("engine", 'CREATE TABLE geot (' .
            'ID integer NOT NULL AUTO_INCREMENT,' .
            'DATE datetime,' .
            'PAGE varchar(20),' .
            'UA varchar(500),' .
            'UAS varchar(100),' .
            'IP_HOST varchar(100),' .
            'HTTP_X_FORWARDED_FOR varchar(50),' .
            'REMOTE_ADDR varchar(50),' .
            'REAL_IP varchar(50),' .
            'city_name varchar(100),' .
            'region_name varchar(100),' .
            'country_code varchar(5),' .
            'country_name varchar(100),' .
            'latitude varchar(50),' .
            'longitude varchar(50),' .
            'proxy_city_name varchar(100),' .
            'proxy_region_name varchar(100),' .
            'proxy_country_code varchar(5),' .
            'note varchar(300),' .
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
