<?php

use RusaDrako\db_update\DB;
use RusaDrako\driver_db\DB as DB_driver;

require_once('../src/autoload.php');
$config=require_once('config.php');
require_once('../../driver_db/src/autoload.php');

$db = new DB_driver();

$db_key = 'mysql';

$arr_db_set = [
	'DRIVER' => DB_driver::DRV_MYSQLI,
	'HOST' => 'localhost',
	'USER' => 'root',
	'PASS' => '',
	'DBNAME' => 'test_db_control',
];

$db->setDB($db_key, $arr_db_set);

$dbConnector=$db->getDBConnect($db_key);

$dbUpdate=new DB('test_db_control', $config, DB::SQL_TYPE__MYSQL, $dbConnector);

$arr=$dbUpdate->updateDB();

//var_dump($dbUpdate);
//exit;

foreach($arr as $k=>$v){
	echo $k;
	if(substr($k, 0, 1)!='-'){
		echo ' - выполнить';
//		$dbConnector->query($v);
	}
	echo PHP_EOL;
	echo "\t{$v}";
	echo PHP_EOL;
}
