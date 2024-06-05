<?php

use RusaDrako\db_update\DB;
use RusaDrako\driver_db\DB as DB_driver;

require_once(__DIR__ . '/../vendor/autoload.php');

$config=require_once(__DIR__ . '/config.php');
$db = new DB_driver();

$arr_db_set['mysql'] = [
	'driver' => DB::SQL_TYPE__MYSQL,
	'setting' => [
		'DRIVER' => DB_driver::DRV_MYSQLI,
		'HOST' => 'localhost',
		'USER' => 'root',
		'PASS' => '',
		'DBNAME' => 'test_db_control',
	]
];

foreach($arr_db_set as $k=>$v){

	echo PHP_EOL;
	echo '================================================================================';
	echo PHP_EOL;
	echo '================================================================================';
	echo PHP_EOL;
	echo "База данных: {$k}";
	echo PHP_EOL;
	echo '================================================================================';
	echo PHP_EOL;
	echo '================================================================================';
	$db->setDB($k, $v['setting']);
	$dbConnector=$db->getDBConnect($k);

	$dbUpdate=new DB('test_db_control', $config, $v['driver'], $dbConnector);

	$arr=$dbUpdate->updateDB();

	foreach($arr as $k_sql=>$v_sql){
		echo PHP_EOL;
		echo $k_sql;
		if(substr($k_sql, 0, 1)!='-'){
			try{
				$dbConnector->query($v_sql);
				echo " - готово";
			}catch(\ RusaDrako\driver_db\drivers\DriverDB $e){
				echo PHP_EOL;
				echo "\t{$e->getMessage()}";
			}catch(\Exception $e){
				echo PHP_EOL;
				echo "\t" . get_class($e) . " {$e->getMessage()}";
			}
		} else {
			echo PHP_EOL;
			echo "\t{$v_sql}";
		}
		echo PHP_EOL;
		echo '================================================================================';
	}
}

echo PHP_EOL;
echo PHP_EOL;
echo 'Готово';

