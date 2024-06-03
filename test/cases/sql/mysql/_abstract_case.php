<?php

namespace RusaDrako\db_update\cases\sql\mysql;

use RusaDrako\db_update\abstract_case;

require_once(__DIR__.'/../../../abstract_case.php');

/**  */
class _abstract_case extends abstract_case {

	/** */
	protected $class_name;
	/** */
	protected $method_name;

	/**
	 * Выполнение метода
	 * @param $args
	 * @return mixed
	 */
	public function use_method(array $args=[]){
		$class=$this->class_name;
		$method=$this->method_name;
		$_args=[];
		foreach($args as $v){
			$_args[]=$v;
		}
		return $class::$method(...$_args);
	}

}
