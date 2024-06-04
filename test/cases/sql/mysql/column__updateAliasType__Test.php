<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**
 * @group db_update
 * @group db_update__sql
 * @group db_update__sql__mysql
 * @group db_update__sql__mysql__column
 * @group db_update__sql__mysql__column__updateDBColumnData
 */
class column__updateAliasType__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateAliasType';

	/**
	 * @dataProvider inputDataArray
	 */
	public function test_array($input, $expected) {
		$this->assertEquals($expected, $this->use_method($input), "Неверное значение возвращаемого элемента");
	}

	/**  */
	public function inputDataArray(){
		return [
			['input'=>['$data'=>'id'], 'expected'=>'int(11)'],
			['input'=>['$data'=>'guid'], 'expected'=>'varchar(32)'],
			['input'=>['$data'=>'int'], 'expected'=>'int(11)'],
			['input'=>['$data'=>'checkbox'], 'expected'=>'int(1)'],
			['input'=>['$data'=>'priority'], 'expected'=>'int(3)'],
			['input'=>['$data'=>'select_table'], 'expected'=>'int(11)'],
			['input'=>['$data'=>'select_list'], 'expected'=>'varchar(256)'],
			['input'=>['$data'=>'text'], 'expected'=>'text'],
			['input'=>['$data'=>'serialized'], 'expected'=>'mediumtext'],
		];
	}

/**/
}
