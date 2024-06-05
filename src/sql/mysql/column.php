<?php

namespace RusaDrako\db_update\sql\mysql;

class column{

	static protected $type_aliases=[
		'id'=>['type'=>'int(11)'],
		'guid'=>['type'=>'varchar(32)'],
		'int'=>['type'=>'int(11)'],
		'checkbox'=>['type'=>'int(1)'],
		'checkbox_time'=>['type'=>'datetime', 'is_null'=>1, "default"=>'NULL'],
		'priority'=>['type'=>'int(3)'],
		'select_table'=>['type'=>'int(11)'],
		'select_list'=>['type'=>'varchar(256)'],
		'text'=>['type'=>'text'],
		'serialized'=>['type'=>'mediumtext'],
		'create'=>['type'=>'datetime', 'is_null'=>1, 'default'=>'CURRENT_TIMESTAMP'],
	];

	/**  */
	public static function getAllColumns($table_name, $db_name){
		return <<<SQL
SELECT * FROM `information_schema`.`columns` WHERE `columns`.`table_name` = '{$table_name}' AND `columns`.`table_schema` = '{$db_name}';
SQL;
	}

	/**  */
	public static function getSQLColumnAddTemplate(){
		return [
			<<<SQL
ALTER TABLE `:db_name:`.`:table_name:` ADD `:column_name:` :column_type: :column_is_null: :column_default: :column_comment: AFTER `:back_column:`;
SQL
		];
	}

	/**  */
	public static function getSQLColumnChangeTemplate(){
		return [
			<<<SQL
ALTER TABLE `:db_name:`.`:table_name:` CHANGE `:column_name:` `:column_name:` :column_type: :column_is_null: :column_default: :column_comment:;
SQL
		];
	}

	/**  */
	public static function getSQLColumnDeleteTemplate(){
		return [
			<<<SQL
ALTER TABLE `:db_name:`.`:table_name:` DROP COLUMN `:column_name:`;
SQL
		];
	}

	/**  */
	public static function updateAliasSetting(array $data){
		$data_control=[
			"name"=>null,
			"type"=>null,
			"is_null"=>null,
			"default"=>null,
			"comment"=>null,
		];

		$updateSettings=array_key_exists($data['type'], static::$type_aliases)
			? static::$type_aliases[$data['type']]
			: [];

		$data=array_intersect_key($data, $data_control);
		$data=array_merge($data_control, $data, $updateSettings);

//		$data=array_merge($data_control, $data);

		# Настройка имени
		$template['name']=static::updateAliasName($data['name']);
		# Настройка типа
		$template['type']=static::updateAliasType($data['type']);
		# Настройка значения null
		$template['is_null']=static::updateAliasIsNull($data['is_null']);
		# Настройка значения по умолчанию
		$template['default']=static::updateAliasDefault($data['default'], $data['is_null']);
		# Настройка комментария
		$template['comment']=static::updateAliasComment($data['comment']);

		return $template;
	}

	/**  */
	public static function updateAliasName($value){
		return (string) $value;
	}

	/**  */
	public static function updateAliasType($value){
		return $value; /*array_key_exists($value, static::$type_aliases)
			? static::$type_aliases[$value]['type']
			: $value;*/
	}

	/**  */
	public static function updateAliasIsNull($value){
		return $value ? "NULL" : "NOT NULL";
	}

	/**  */
	public static function updateAliasDefault($value_def, $value_is_null){
		if($value_def===null && $value_is_null)                 { return 'DEFAULT NULL';}
		if($value_def===null)                                  { return NULL;}
		if(strtoupper($value_def)=='NULL' && !$value_is_null)   { return NULL;}
		if(strtoupper($value_def)=='NULL')                     { return 'DEFAULT NULL';}
		if(strtoupper($value_def)=='CURRENT_TIMESTAMP')        { return 'DEFAULT CURRENT_TIMESTAMP';}
		return "DEFAULT '{$value_def}'";
	}

	/**  */
	public static function updateAliasComment($value){
		return $value ? "COMMENT '{$value}'" : '';
	}

	/**  */
	public static function updateDBColumnData($data){
		$data_control=[
			"name"=>$data["COLUMN_NAME"],
			"type"=>$data["COLUMN_TYPE"],
			"is_null"=>strtoupper($data["IS_NULLABLE"])=='YES' ? 1 : 0,
			"default"=>($data["COLUMN_DEFAULT"]===NULL && strtoupper($data["IS_NULLABLE"])=='YES') ? 'NULL' : $data["COLUMN_DEFAULT"],
			"comment"=>$data["COLUMN_COMMENT"],
		];
		return $data_control;
	}

}