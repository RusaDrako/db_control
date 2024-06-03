<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**  */
class column__updateDefaultAlias__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateDefaultAlias';

	/**  */
	public function test_array() {
		$data=[
			1=>['input'=>['$data_def'=>NULL, '$data_is_null'=>0], 'result'=>NULL],
			2=>['input'=>['$data_def'=>NULL, '$data_is_null'=>1], 'result'=>NULL],
			3=>['input'=>['$data_def'=>'NULL', '$data_is_null'=>0], 'result'=>NULL],
			4=>['input'=>['$data_def'=>'NULL', '$data_is_null'=>1], 'result'=>'DEFAULT NULL'],
			5=>['input'=>['$data_def'=>'CURRENT_TIMESTAMP', '$data_is_null'=>0], 'result'=>'DEFAULT CURRENT_TIMESTAMP'],
			6=>['input'=>['$data_def'=>'CURRENT_TIMESTAMP', '$data_is_null'=>1], 'result'=>'DEFAULT CURRENT_TIMESTAMP'],
			7=>['input'=>['$data_def'=>0, '$data_is_null'=>0], 'result'=>"DEFAULT '0'"],
			8=>['input'=>['$data_def'=>0, '$data_is_null'=>1], 'result'=>"DEFAULT '0'"],
			9=>['input'=>['$data_def'=>1, '$data_is_null'=>0], 'result'=>"DEFAULT '1'"],
			10=>['input'=>['$data_def'=>1, '$data_is_null'=>1], 'result'=>"DEFAULT '1'"],
			11=>['input'=>['$data_def'=>'', '$data_is_null'=>0], 'result'=>"DEFAULT ''"],
			12=>['input'=>['$data_def'=>'', '$data_is_null'=>1], 'result'=>"DEFAULT ''"],
			13=>['input'=>['$data_def'=>'0', '$data_is_null'=>0], 'result'=>"DEFAULT '0'"],
			14=>['input'=>['$data_def'=>'0', '$data_is_null'=>1], 'result'=>"DEFAULT '0'"],
			15=>['input'=>['$data_def'=>'1', '$data_is_null'=>0], 'result'=>"DEFAULT '1'"],
			16=>['input'=>['$data_def'=>'1', '$data_is_null'=>1], 'result'=>"DEFAULT '1'"],
			17=>['input'=>['$data_def'=>'sTring', '$data_is_null'=>0], 'result'=>"DEFAULT 'sTring'"],
			18=>['input'=>['$data_def'=>'sTring', '$data_is_null'=>1], 'result'=>"DEFAULT 'sTring'"],
		];

		foreach($data as $k=>$v){
			$this->assertEquals($v['result'], $this->use_method($v['input']), "Неверное значение возвращаемого элемента {$k}");
		}
	}

/**/
}
