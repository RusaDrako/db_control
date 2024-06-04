<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**
 * @group db_update
 * @group db_update__sql
 * @group db_update__sql__mysql
 * @group db_update__sql__mysql__column
 * @group db_update__sql__mysql__column__updateAliasName
 */
class column__updateAliasName__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateAliasName';

	/**
	 * @dataProvider inputDataArray
	 */
	public function test_array($input, $expected) {
		$this->assertEquals($expected, $this->use_method($input), "Неверное значение возвращаемого элемента");
	}

	/**  */
	public function inputDataArray(){
		return [
			['input'=>['$data'=>'Name'], 'expected'=>'Name'],
			['input'=>['$data'=>Null], 'expected'=>''],
			['input'=>['$data'=>''], 'expected'=>''],
			['input'=>['$data'=>0], 'expected'=>'0'],
			['input'=>['$data'=>'0'], 'expected'=>'0'],
		];
	}

/**/
}
