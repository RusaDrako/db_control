<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**
 * @group db_update
 * @group db_update__sql
 * @group db_update__sql__mysql
 * @group db_update__sql__mysql__column
 * @group db_update__sql__mysql__column__updateAliasDefault
 */
class column__updateAliasDefault__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateAliasDefault';

	/**
	 * @dataProvider inputDataArray
	 */
	public function test_array($input, $expected) {
		$this->assertEquals($expected, $this->use_method($input), "Неверное значение возвращаемого элемента");
	}

	/**  */
	public function inputDataArray(){
		return [
			['input'=>['$data_def'=>NULL, '$data_is_null'=>0], 'expected'=>NULL],
			['input'=>['$data_def'=>NULL, '$data_is_null'=>1], 'expected'=>'DEFAULT NULL'],
			['input'=>['$data_def'=>'NULL', '$data_is_null'=>0], 'expected'=>NULL],
			['input'=>['$data_def'=>'NULL', '$data_is_null'=>1], 'expected'=>'DEFAULT NULL'],
			['input'=>['$data_def'=>'CURRENT_TIMESTAMP', '$data_is_null'=>0], 'expected'=>'DEFAULT CURRENT_TIMESTAMP'],
			['input'=>['$data_def'=>'CURRENT_TIMESTAMP', '$data_is_null'=>1], 'expected'=>'DEFAULT CURRENT_TIMESTAMP'],
			['input'=>['$data_def'=>0, '$data_is_null'=>0], 'expected'=>"DEFAULT '0'"],
			['input'=>['$data_def'=>0, '$data_is_null'=>1], 'expected'=>"DEFAULT '0'"],
			['input'=>['$data_def'=>1, '$data_is_null'=>0], 'expected'=>"DEFAULT '1'"],
			['input'=>['$data_def'=>1, '$data_is_null'=>1], 'expected'=>"DEFAULT '1'"],
			['input'=>['$data_def'=>'', '$data_is_null'=>0], 'expected'=>"DEFAULT ''"],
			['input'=>['$data_def'=>'', '$data_is_null'=>1], 'expected'=>"DEFAULT ''"],
			['input'=>['$data_def'=>'0', '$data_is_null'=>0], 'expected'=>"DEFAULT '0'"],
			['input'=>['$data_def'=>'0', '$data_is_null'=>1], 'expected'=>"DEFAULT '0'"],
			['input'=>['$data_def'=>'1', '$data_is_null'=>0], 'expected'=>"DEFAULT '1'"],
			['input'=>['$data_def'=>'1', '$data_is_null'=>1], 'expected'=>"DEFAULT '1'"],
			['input'=>['$data_def'=>'sTring', '$data_is_null'=>0], 'expected'=>"DEFAULT 'sTring'"],
			['input'=>['$data_def'=>'sTring', '$data_is_null'=>1], 'expected'=>"DEFAULT 'sTring'"],
		];
	}

/**/
}
