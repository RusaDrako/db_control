<?php

namespace RusaDrako\db_update;

class _template {

	use trt_status;

	/** @var string Имя элемента */
	protected $name;

	/** @var array Массив данных */
	protected $data=[];

	/** @var string Приставка объекта для шаблона */
	protected $template_prefix='template_';

	/** @var array Массив замены */
	protected $template=[];

	/** @var DB Базовый элемент модели БД */
	protected $db;

	/**  */
	public function __debugInfo(){
		return [
			'data'=>$this->data,
		];
	}

	/**  */
	public function __construct($name){
		$this->setName($name);
	}

	/**  */
	public function __call($name, $arguments){
		switch(substr($name, 0, 5)){
			case 'get__':
				$data_name=substr($name, 5);
				if (array_key_exists($data_name, $this->data)) {
					return $this->data[$data_name];
				}
				break;
			case 'set__':
				$data_name=substr($name, 5);
				if (array_key_exists($data_name, $this->data)) {
					if($arguments[0] !== $this->data[$data_name]){
						$this->data[$data_name]=$arguments[0];
						$this->update[$data_name]=1;
					}
					return $this;
				}
				break;
		}
		$class=get_class($this);
		throw new \Exception("Не объявленный метод {$class}->{$name}()");
	}

	public function setName(string $value){
		$this->name=$value;
		return $this;
	}

	public function getName(){
		return $this->name;
	}

	public function setDb(DB $value){
		$this->db=$value;
		return $this;
	}

	public function getDb(){
		return $this->db;
	}

	public function updateTemplate($data){
		return str_replace(array_keys($this->template), $this->template, $data);
	}

	public function setConfig(array $config) {
		foreach($this->data as $k=>$v){
			if(array_key_exists($k, $config)){
				$this->data[$k]=$config[$k];
				$template_key=":{$this->template_prefix}{$k}:";
				$this->template[$template_key]=$config[$k];
			}
		}
		return $this;
	}

}