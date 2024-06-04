<?php

namespace RusaDrako\db_update;

class Table extends _template {

	/** @var string Приставка объекта для шаблона */
	protected $template_prefix='table_';

	/** @var array Свойства */
	protected $data=[
		'name'=>null,
		'comment'=>null,
	];

	/** @var array Массив замены */
	protected $template=[
		//':table_name:'=>null,
		//':table_comment:'=>null,
		':key_column_name:'=>null,
	];

	/** @var Column Входящие столбцы */
	protected $column_key = null;

	/** @var Column[] Входящие столбцы */
	protected $columns = [];

	/**  */
	public function __debugInfo(){
		$result=parent::__debugInfo();
		$result['column_key']=$this->column_key->getName();
		$result['columns']=$this->columns;
		return $result;
	}

	public function __construct(string $name){
		parent::__construct($name);
		$this->setConfig(['name'=>$name]);
		//$this->set__name($name);
		//$this->template[':table_name:']=$name;
		$this->addColumnKey();
	}

	/**  */
	public function setConfig(array $config) {
		parent::setConfig($config);
		if(array_key_exists('columns', $config)){
			$this->setConfigColumn($config['columns']);
		}
		return $this;
	}

	/**  */
	public function setConfigColumn($config) {
		foreach($config as $k=>$v){
			$this->addColumn($k, $v);
		}
	}

	/**  */
	public function addColumnKey() {
		$name="id_{$this->getName()}";
		$this->template[':key_column_name:']=$name;
		$setting=array(
			'name'=>$name,
			'comment'=>'id записи',
		);
		$column=new Column($name, $setting);
		$column->setTable($this);
		$column->setConfig($setting);
		$this->column_key=$column;
		return $column;
	}

	/**  */
	public function addColumn(string $title, array $setting) {
		$column=new Column($title/*, $setting*/);
		$column->setTable($this);
		$column->setDb($this->db);
		$column->setConfig($setting);
		$back_column=count($this->columns)?$this->columns[array_pop(array_keys($this->columns))]:$this->column_key;
		$column->setBackColumn($back_column);
		$this->columns[$title]=$column;
		return $column;
	}

	public function getSQLUpdate(){
		if($this->is_delete){
			$sql=$this->db->getSQLObject()->getSQLTableDeleteTemplate();
			$sql=$this->updateTemplate($sql);
			$result["{$this->getStatus()} {$this->name}"]=$sql;
			return $result;
		}

		$columns=$this->getColumnExists();

		$exists=[];
		foreach($columns as $k=>$v){
			$data=$this->db->getSQLObject()->updateDBColumnData($v);
			$exists[$data['name']]=$data;
		}

		$column_exists=array_intersect_key($this->columns, $exists);
		$column_new=array_diff_key($this->columns, $column_exists);
		$column_delete=array_diff_key($exists, $column_exists);

		foreach($column_delete as $k=>$v){
			if ($k!=$this->column_key->getName()) {
				$this->addColumn($k, []);
				$this->columns[$k]->setIsDelete(true);
			}
		}

		foreach($column_new as $k=>$v){
			$this->columns[$k]->setIsNew(true);
		}

		foreach($column_exists as $k=>$v){
			$this->columns[$k]->checkData($exists[$k]);
		}

		foreach($this->columns as $k=>$v){
			$_arr_result["{$this->getName()}.{$v->getName()}"]=$v->getSQLUpdate();
		}

		$result=[];
		if($this->is_new){
			$sql=$this->db->getSQLObject()->getSQLTableAddTemplate();
			$sql=$this->updateTemplate($sql);
			$result["{$this->getStatus()} {$this->name}"]=$sql;
		}

		foreach($this->columns as $k=>$v){
			$sql=$v->getSQLUpdate();
			if(!$sql) { continue;}
			$sql=$this->updateTemplate($sql);
			$result["{$v->getStatus()} {$this->name}.{$k}"]=$sql;
		}
		return $result;
	}

	public function createSQLTable(){
		$this->db->sql_obj->getSQLTableCreateTemplate($this->db->get__name(), $this->get__name(), $this->get__comment());
	}

	/**  */
	public function getColumnExists() {
		$sql=$this->db->getSQLObject()->getTableColumns($this);
		return $this->db->selectDB($sql);
	}


}