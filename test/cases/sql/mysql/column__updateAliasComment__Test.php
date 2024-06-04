<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**
 * @group db_update
 * @group db_update__sql
 * @group db_update__sql__mysql
 * @group db_update__sql__mysql__column
 * @group db_update__sql__mysql__column__updateAliasComment
 */
class column__updateAliasComment__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateAliasComment';

	/**
	 * @dataProvider inputDataArray
	 */
	public function test_array($input, $expected) {
		$this->assertEquals($expected, $this->use_method($input), "Неверное значение возвращаемого элемента");
	}

	/**  */
	public function inputDataArray() {
		return [
			['input'=>['$data'=>Null], 'expected'=>''],
			['input'=>['$data'=>''], 'expected'=>''],
			['input'=>['$data'=>0], 'expected'=>''],
			['input'=>['$data'=>'0'], 'expected'=>''],
			['input'=>['$data'=>false], 'expected'=>''],
			['input'=>['$data'=>1], 'expected'=>"COMMENT '1'"],
			['input'=>['$data'=>'1'], 'expected'=>"COMMENT '1'"],
			['input'=>['$data'=>true], 'expected'=>"COMMENT '1'"],
			['input'=>['$data'=>'Null'], 'expected'=>"COMMENT 'Null'"],
			['input'=>['$data'=>'sTring'], 'expected'=>"COMMENT 'sTring'"],
		];
	}

/**/
}
