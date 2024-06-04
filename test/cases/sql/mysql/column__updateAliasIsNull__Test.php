<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**
 * @group db_update
 * @group db_update__sql
 * @group db_update__sql__mysql
 * @group db_update__sql__mysql__column
 * @group db_update__sql__mysql__column__updateAliasIsNull
 */
class column__updateAliasIsNull__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateAliasIsNull';

	/**
	 * @dataProvider inputDataArray
	 */
	public function test_array($input, $expected) {
		$this->assertEquals($expected, $this->use_method($input), "Неверное значение возвращаемого элемента");
	}

	/**  */
	public function inputDataArray(){
		return [
			['input'=>['$data'=>Null], 'expected'=>'NOT NULL'],
			['input'=>['$data'=>''], 'expected'=>'NOT NULL'],
			['input'=>['$data'=>0], 'expected'=>'NOT NULL'],
			['input'=>['$data'=>'0'], 'expected'=>'NOT NULL'],
			['input'=>['$data'=>false], 'expected'=>'NOT NULL'],
			['input'=>['$data'=>1], 'expected'=>'NULL'],
			['input'=>['$data'=>'1'], 'expected'=>'NULL'],
			['input'=>['$data'=>true], 'expected'=>'NULL'],
			['input'=>['$data'=>'Null'], 'expected'=>'NULL'],
		];
	}

/**/
}
