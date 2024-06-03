<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**  */
class column__updateTypeAlias__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateTypeAlias';

	/**  */
	public function test_array() {
		$data=[
			1=>['input'=>['$data'=>'id'], 'result'=>'int(11)'],
			2=>['input'=>['$data'=>'guid'], 'result'=>'varchar(32)'],
			3=>['input'=>['$data'=>'int'], 'result'=>'int(11)'],
			4=>['input'=>['$data'=>'checkbox'], 'result'=>'int(1)'],
			5=>['input'=>['$data'=>'priority'], 'result'=>'int(3)'],
			6=>['input'=>['$data'=>'select_table'], 'result'=>'int(11)'],
			7=>['input'=>['$data'=>'select_list'], 'result'=>'varchar(256)'],
			8=>['input'=>['$data'=>'text'], 'result'=>'text'],
			9=>['input'=>['$data'=>'serialized'], 'result'=>'mediumtext'],
		];

		foreach($data as $k=>$v){
			$this->assertEquals($v['result'], $this->use_method($v['input']), "Неверное значение возвращаемого элемента {$k}");
		}
	}

/**/
}
