<?php

namespace RusaDrako\db_update;

class Column extends _template {

	/** @var string Приставка объекта для шаблона */
	protected $template_prefix='column_';

	/** @var array Имя */
	protected $data=[
		'table_name'=>null,
		'name'=>null,
		'type'=>null,
		'is_null'=>null,
		'default'=>null,
		'comment'=>null,
	];

	/** @var array Массив замены */
	protected $template=[
		':back_column:'=>null,
	];

	protected $back_column;

	/** @var Table */
	protected $table;

	public function setTable(Table $value){
		$this->table=$value;
		$this->setConfig(['table_name'=>$value->getName()]);
		return $this;
	}

	public function getTable(){
		return $this->table;
	}

	/**  */
	public function setConfig(array $config) {
		parent::setConfig($config);
	}

	public function setBackColumn(Column $value){
		$this->back_column;
		$this->template[':back_column:']=$value->getName();
		return $this;
	}


	/**  */
	public function __construct(string $name/*, string $table_name, array $config*/){
		parent::__construct($name);
		$this->set__name($name);
		$this->template[':column_name:']=$name;
	}

	/**  */
	public function getSQLUpdate() {
		if(!$this->is_new && !$this->is_update && !$this->is_delete){ return; }

		$_sql=$this->_getSQLUpdate();

		$template=$this->db->getSQLObject()->setColumnTemplate($this->data);

		$sql=[];
		foreach($_sql as $k=>$v){
			$v=str_replace(array_keys($template), $template, $v);
			$sql[]=$this->updateTemplate($v);
		}

		return $sql;
	}

	/**  */
	protected function _getSQLUpdate() {
		$sql='';
		if($this->is_delete){
			$sql=$this->db->getSQLObject()->getSQLColumnDeleteTemplate();;
		}elseif($this->is_new){
			$sql=$this->db->getSQLObject()->getSQLColumnAddTemplate();
		}elseif($this->is_update) {
			$sql=$this->db->getSQLObject()->getSQLColumnChangeTemplate();
		}
		return $sql;
	}

}