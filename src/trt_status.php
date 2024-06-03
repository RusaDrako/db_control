<?php

namespace RusaDrako\db_update;

trait trt_status{

	/** @var string Маркер нового элемента */
	protected $is_new;

	/** @var string Маркер обновления элемента */
	protected $is_update;

	/** @var string Маркер удаления элемента */
	protected $is_delete;

	/** @var string Маркер удаления элемента */
	protected $updated;

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
		$data_db=$this->db->getSQLObject()->updateAliasSetting($data);
		$data_mod=$this->db->getSQLObject()->updateAliasSetting($this->data);
		foreach($data_mod as $k=>$v){
			if (array_key_exists($k, $data_db)) {
				if($v!==$data_db[$k]){
					$this->updated[$k]=['old'=>$data_db[$k], 'new'=>$v];
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