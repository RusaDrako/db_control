<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**  */
class column__updateAliasName__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateAliasName';

	/**  */
	public function test_array() {
		$data=[
			1=>['input'=>['$data'=>'Name'], 'result'=>'Name'],
			2=>['input'=>['$data'=>Null], 'result'=>''],
			3=>['input'=>['$data'=>''], 'result'=>''],
			4=>['input'=>['$data'=>0], 'result'=>'0'],
			5=>['input'=>['$data'=>'0'], 'result'=>'0'],
		];

		foreach($data as $k=>$v){
			$this->assertEquals($v['result'], $this->use_method($v['input']), "Неверное значение возвращаемого элемента {$k}");
		}
	}

/**/
}
