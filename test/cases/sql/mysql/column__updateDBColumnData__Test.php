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
class column__updateDBColumnData__Test extends _abstract_case {
	/** */
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	/** */
	protected $method_name = 'updateDBColumnData';

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
						'TABLE_CATALOG' => 'def',
						'TABLE_SCHEMA' => 'test_db_control',
						'TABLE_NAME' => 'user',
						'COLUMN_NAME' => 'id_user',
						'ORDINAL_POSITION' => '1',
						'COLUMN_DEFAULT' => NULL,
						'IS_NULLABLE' => 'NO',
						'DATA_TYPE' => 'bigint',
						'CHARACTER_MAXIMUM_LENGTH' => NULL,
						'CHARACTER_OCTET_LENGTH' => NULL,
						'NUMERIC_PRECISION' => '19',
						'NUMERIC_SCALE' => '0',
						'DATETIME_PRECISION' => NULL,
						'CHARACTER_SET_NAME' => NULL,
						'COLLATION_NAME' => NULL,
						'COLUMN_TYPE' => 'bigint(11)',
						'COLUMN_KEY' => 'PRI',
						'EXTRA' => 'auto_increment',
						'PRIVILEGES' => 'select,insert,update,references',
						'COLUMN_COMMENT' => 'Тест_1',
					)
				],
				'expected'=>[
					'name' => 'id_user',
					'type' => 'bigint(11)',
					'is_null' => 0,
					'default' => null,
					'comment' => 'Тест_1',
				]
			],

			[
				'input'=>[
					array (
						'TABLE_CATALOG' => 'def',
						'TABLE_SCHEMA' => 'test_db_control',
						'TABLE_NAME' => 'user',
						'COLUMN_NAME' => 'user_login',
						'ORDINAL_POSITION' => '2',
						'COLUMN_DEFAULT' => NULL,
						'IS_NULLABLE' => 'NO',
						'DATA_TYPE' => 'text',
						'CHARACTER_MAXIMUM_LENGTH' => '65535',
						'CHARACTER_OCTET_LENGTH' => '65535',
						'NUMERIC_PRECISION' => NULL,
						'NUMERIC_SCALE' => NULL,
						'DATETIME_PRECISION' => NULL,
						'CHARACTER_SET_NAME' => 'utf8mb4',
						'COLLATION_NAME' => 'utf8mb4_unicode_ci',
						'COLUMN_TYPE' => 'text',
						'COLUMN_KEY' => '',
						'EXTRA' => '',
						'PRIVILEGES' => 'select,insert,update,references',
						'COLUMN_COMMENT' => 'Тест_2',
					)
				],
				'expected'=>[
					'name' => 'user_login',
					'type' => 'text',
					'is_null' => 0,
					'default' => null,
					'comment' => 'Тест_2',
				]
			],

			[
				'input'=>[
					array (
						'TABLE_CATALOG' => 'def',
						'TABLE_SCHEMA' => 'test_db_control',
						'TABLE_NAME' => 'user',
						'COLUMN_NAME' => 'user_create',
						'ORDINAL_POSITION' => '4',
						'COLUMN_DEFAULT' => 'CURRENT_TIMESTAMP',
						'IS_NULLABLE' => 'NO',
						'DATA_TYPE' => 'datetime',
						'CHARACTER_MAXIMUM_LENGTH' => NULL,
						'CHARACTER_OCTET_LENGTH' => NULL,
						'NUMERIC_PRECISION' => NULL,
						'NUMERIC_SCALE' => NULL,
						'DATETIME_PRECISION' => '0',
						'CHARACTER_SET_NAME' => NULL,
						'COLLATION_NAME' => NULL,
						'COLUMN_TYPE' => 'datetime',
						'COLUMN_KEY' => '',
						'EXTRA' => '',
						'PRIVILEGES' => 'select,insert,update,references',
						'COLUMN_COMMENT' => 'Тест_3',
					)
				],
				'expected'=>[
					'name' => 'user_create',
					'type' => 'datetime',
					'is_null' => 0,
					'default' => 'CURRENT_TIMESTAMP',
					'comment' => 'Тест_3',
				]
			],

			[
				'input'=>[
					array (
						'TABLE_CATALOG' => 'def',
						'TABLE_SCHEMA' => 'test_db_control',
						'TABLE_NAME' => 'user',
						'COLUMN_NAME' => 'user_guid',
						'ORDINAL_POSITION' => '5',
						'COLUMN_DEFAULT' => NULL,
						'IS_NULLABLE' => 'YES',
						'DATA_TYPE' => 'varchar',
						'CHARACTER_MAXIMUM_LENGTH' => '32',
						'CHARACTER_OCTET_LENGTH' => '128',
						'NUMERIC_PRECISION' => NULL,
						'NUMERIC_SCALE' => NULL,
						'DATETIME_PRECISION' => NULL,
						'CHARACTER_SET_NAME' => 'utf8mb4',
						'COLLATION_NAME' => 'utf8mb4_unicode_ci',
						'COLUMN_TYPE' => 'varchar(32)',
						'COLUMN_KEY' => '',
						'EXTRA' => '',
						'PRIVILEGES' => 'select,insert,update,references',
						'COLUMN_COMMENT' => 'Тест_4',
					)
				],
				'expected'=>[
					'name' => 'user_guid',
					'type' => 'varchar(32)',
					'is_null' => 1,
					'default' => 'NULL',
					'comment' => 'Тест_4',
				]
			],

		];
	}

/**/
}
