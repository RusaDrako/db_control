<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**
 * @group db_update
 * @group db_update__sql
 * @group db_update__sql__mysql
 * @group db_update__sql__mysql__column
 * @group db_update__sql__mysql__column__updateAliasSetting
 */
class column__updateAliasSetting__Test extends _abstract_case {
	/** */
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	/** */
	protected $method_name = 'updateAliasSetting';

	/**
	 * @dataProvider inputDataArray
	 */
	public function test_array($input, $expected) {
		$this->assertEquals($expected, $this->use_method($input), "Неверное значение возвращаемого элемента");
	}

	/**  */
	public function inputDataArray(){
		return [
			[
				'input'=>[
					array (
						'name' => 'user_guid',
						'type' => 'guid',
						'is_null' => true,
						'default' => 'NULL',
						'comment' => "Проверка is_null=1, default='NULL'",
					)
				],
				'expected'=>[
					'name' => 'user_guid',
					'type' => 'varchar(32)',
					'is_null' => 'NULL',
					'default' => 'DEFAULT NULL',
					'comment' => "COMMENT 'Проверка is_null=1, default='NULL''",
				]
			],

			[
				'input'=>[
					array (
						'name' => 'user_guid',
						'type' => 'guid',
						'is_null' => null,
						'default' => 'NULL',
						'comment' => "Проверка is_null=0, default='NULL'",
					)
				],
				'expected'=>[
					'name' => 'user_guid',
					'type' => 'varchar(32)',
					'is_null' => 'NOT NULL',
					'default' => null,
					'comment' => "COMMENT 'Проверка is_null=0, default='NULL''",
				]
			],

			[
				'input'=>[
					array (
						'name' => 'user_id',
						'type' => 'id',
						'is_null' => null,
						'default' => null,
						'comment' => "Проверка is_null=null, default=null",
					)
				],
				'expected'=>[
					'name' => 'user_id',
					'type' => 'int(11)',
					'is_null' => 'NOT NULL',
					'default' => null,
					'comment' => "COMMENT 'Проверка is_null=null, default=null'",
				]
			],

		];
	}

/**/
}
