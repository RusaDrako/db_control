<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**  */
class column__updateIsNullAlias__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateIsNullAlias';

	/**  */
	public function test_array() {
		$data=[
			1=>['input'=>['$data'=>Null], 'result'=>'NOT NULL'],
			2=>['input'=>['$data'=>''], 'result'=>'NOT NULL'],
			3=>['input'=>['$data'=>0], 'result'=>'NOT NULL'],
			4=>['input'=>['$data'=>'0'], 'result'=>'NOT NULL'],
			5=>['input'=>['$data'=>false], 'result'=>'NOT NULL'],
			6=>['input'=>['$data'=>1], 'result'=>'NULL'],
			7=>['input'=>['$data'=>'1'], 'result'=>'NULL'],
			8=>['input'=>['$data'=>true], 'result'=>'NULL'],
			9=>['input'=>['$data'=>'Null'], 'result'=>'NULL'],
		];

		foreach($data as $k=>$v){
			$this->assertEquals($v['result'], $this->use_method($v['input']), "Неверное значение возвращаемого элемента {$k}");
		}
	}

/**/
}
