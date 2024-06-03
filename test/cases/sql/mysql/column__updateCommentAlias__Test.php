<?php

namespace RusaDrako\db_update\cases\sql\mysql;

require_once('_abstract_case.php');

/**  */
class column__updateCommentAlias__Test extends _abstract_case {
	protected $class_name = \RusaDrako\db_update\sql\mysql\column::class;
	protected $method_name = 'updateCommentAlias';

	/**  */
	public function test_array() {
		$data=[
			1=>['input'=>['$data'=>Null], 'result'=>''],
			2=>['input'=>['$data'=>''], 'result'=>''],
			3=>['input'=>['$data'=>0], 'result'=>''],
			4=>['input'=>['$data'=>'0'], 'result'=>''],
			5=>['input'=>['$data'=>false], 'result'=>''],
			6=>['input'=>['$data'=>1], 'result'=>"COMMENT '1'"],
			7=>['input'=>['$data'=>'1'], 'result'=>"COMMENT '1'"],
			8=>['input'=>['$data'=>true], 'result'=>"COMMENT '1'"],
			9=>['input'=>['$data'=>'Null'], 'result'=>"COMMENT 'Null'"],
			10=>['input'=>['$data'=>'sTring'], 'result'=>"COMMENT 'sTring'"],
		];

		foreach($data as $k=>$v){
			$this->assertEquals($v['result'], $this->use_method($v['input']), "Неверное значение возвращаемого элемента {$k}");
		}
	}

/**/
}
