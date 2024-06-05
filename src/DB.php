<?php

namespace RusaDrako\db_update;

//use RusaDrako\debug\DebugExpansion;

class DB extends _template {

	const SQL_TYPE__MYSQL='mysql';

	/** @var array Свойства */
	protected $data=[
		'name'=>null,
		'comment'=>null,
	];

	/** @var array */
	protected $template=[
		':db_name:'=>null,
	];

	/** @var Column[] Входящие столбцы */
	protected $tables = [];

	/** @var sql\inf_sql */
	protected $sql_object;

	/** @var sql\inf_sql */
	protected $connect_obj;

	/**  */
	public function setSQLObject(sql\inf_sql $obj){
		$this->sql_object=$obj;
	}

	/**  */
	public function getSQLObject(){
		return $this->sql_object;
	}

	/**  */
	public function __debugInfo(){
		$result=parent::__debugInfo();
		$result['tables']=$this->tables;
		return $result;
	}

	/**  */
	public function __construct($name, $config, $sql_type=DB::SQL_TYPE__MYSQL, $connect=null){
		parent::__construct($name);

		$this->set__name($name);

		$this->template[':db_name:']=$name;

		switch($sql_type){
			case DB::SQL_TYPE__MYSQL:
				$this->setSQLObject(new sql\mysql());
				break;
			default:
				break;
		}

		$this->connect_obj=$connect;

		$this->setConfing($config?:[]);
	}

	/**  */
	public function setConfing(array $config) {
		foreach($config?:[] as $k=>$v){
			$this->addTable($k, $v);
		}
	}


	/**  */
	public function addTable($name, array $setting) {
		$table=new Table($name/*, $setting*/);
		$table->setDb($this);
		$table->setConfig($setting);
		$this->tables[$name]=$table;
		return $table;
	}

	/**  */
	public function updateDB() {
		$_arr_result=[];
		# Пролучаем существующие в БД таблицы
		$tables=$this->getTableExists();

		$exists=[];
		foreach($tables as $k=>$v){
			$data=$this->getSQLObject()->getTableName($v);
			$exists[$data]=$data;
		}

		# Существующие таблицы
		$table_exists=array_intersect_key($this->tables, $exists);
		# Новые таблицы
		$table_new=array_diff_key($this->tables, $table_exists);
		# Удалённые таблицы
		$table_delete=array_diff_key($exists, $table_exists);

		# Настройки объектов
		foreach($table_new as $k=>$v){
			$this->tables[$k]->setIsNew(true);
		}

		# Настройки объектов
		foreach($table_delete as $k=>$v){
			$table=new Table($k);
			$table->setDb($this);
			$table->setIsDelete(true);
			$_arr_result[$k]=$table->getSQLUpdate();
		}

		# Получение sql запросов
		foreach($this->tables as $k=>$v){
			$_arr_result[$k]=$v->getSQLUpdate();
		}

		# Оформление массива SQL-запросов
		$arr_result=[];
		foreach($_arr_result as $k=>$v){
			foreach($v as $k_2=>$v_2){
				$count=count($v_2);
				foreach($v_2 as $k_3=>$v_3){
					# Заполнение шаблонов
					$arr_result["{$k_2}" . ($count > 1 ? " => step {$k_3}" : '')]=$this->updateTemplate($v_3);
				}
			}
		}
		return $arr_result;
	}

	/**  */
	public function getTableExists() {
		$sql=$this->getSQLObject()->getTables();
		return $this->selectDB($sql);
	}

	/**  */
	public function selectDB($sql) {
		return $this->connect_obj->select($sql);
	}

}