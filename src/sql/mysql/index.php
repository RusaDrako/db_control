<?php

namespace RusaDrako\db_update\sql\mysql;

class index{

	/**  */
	public static function getTableIndexes($table_name){
		return <<<SQL
SHOW INDEX FROM `{$table_name}`;
SQL;
	}

}