<?php

namespace RusaDrako\db_update;

trait trt_status{

	/** @var string Маркер нового элемента */
	protected $is_new;

	/** @var string Маркер обновления элемента */
	protected $is_update;

	/** @var string Маркер удаления элемента */
	protected $is_delete;

	public function setIsNew(bool $value){
		$this->is_new= (bool) $value;
		return $this;
	}

	public function getIsNew(){
		return (bool) $this->is_new;
	}

	public function setUpdate(bool $value){
		$this->is_update = (bool) $value;
		return $this;
	}

	public function getUpdate(){
		return (bool) $this->is_update;
	}

	public function setIsDelete(bool $value){
		$this->is_delete = (bool) $value;
		return $this;
	}

	public function getIsDelete(){
		return (bool) $this->is_delete;
	}

	public function checkData($data){
		foreach($this->data as $k=>$v){
			if (array_key_exists($k, $data)) {
				if($v!==$data[$k]){
					$this->setUpdate(true);
				}
			}
		}
		return $this;
	}

	public function getStatus(){
		if($this->is_new)    {return '+';}
		if($this->is_delete) {return '-';}
		return '%';
	}

}