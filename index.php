<!DOCTYPE html>
<!--
 pit - 9 nov 2022  - 13:29:29
-->
<?php
error_reporting(E_ALL);
require_once 'param.php';
$param = new param();
$db1_name="links";
require_once 'dbTablesDb1.php';
$dbTablesDb1 = new dbTablesDb1();
$db2_name="links2";
require_once 'dbTablesDb2.php';
$dbTablesDb2 = new dbTablesDb2();
require_once 'dbPdo.php';
$mySql = new DbPdo($param->host, $param->user, $param->dbpass);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MySql init db</title>
        <link rel="icon" href="favicon.ico" />
        <style>
            html, body {
                min-height: 100%;
            }
            body {
                background: linear-gradient(to bottom, #595959 0%, #131313 1%, #4c4c4c 100%);
                color: #fff;
            }
            #wrapper {
                top: 5em;
                width: 80%;
            }
            #content {
                position: relative;
                top: 5em;
                text-align: left;
            }
            .center {
                display: block;
                margin: 0px auto;
                text-align: center;
            }
        </style>


    </head>
    <body>


        <div id="wrapper" class="center">
        <div id="content">
            <?php
            echo "<br>Init";
            echo "<br>_______________________________________________________";
            echo "<br>";

            execOp($db1_name,$dbTablesDb1);
            execOp($db2_name,$dbTablesDb2);
            
            echo "<br>end";
            
            function execOp($db_name,$dbTables) {
                global $mySql;
            $dbName =$db_name;
            $mySql->connectSql();
            
            if (!$mySql->connectDb($dbName)) {
                $mySql->createDatabase($dbName);
                $mySql->connectDb($dbName);
            }
            
            echo "<br>";
            $tablesList = $dbTables->tablesList;
            
            //$mySql->opTables($tablesList, "drop");
            //$mySql->opTables($tablesList, "truncate");
            $mySql->createTables($tablesList);
            
            //$mySql->pdoExec("DROP DATABASE $dbName");
            echo "<br>_______________________________________________________";
            echo "<br>";
    
}
            ?>
        </div>
        </div>
    </body>
</html>

<?php
