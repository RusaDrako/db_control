<?php

namespace RusaDrako\db_update\sql\mysql;

class column{

	static protected $type_aliases=[
		'id'=>'int(11)',
		'guid'=>'varchar(32)',
		'int'=>'int(11)',
		'checkbox'=>'int(1)',
		'priority'=>'int(3)',
		'select_table'=>'int(11)',
		'select_list'=>'varchar(256)',
		'text'=>'text',
		'serialized'=>'mediumtext',
	];

	/**  */
	public static function getAllColumns($table_name, $db_name){
		return <<<SQL
SELECT * FROM `information_schema`.`columns` WHERE `columns`.`table_name` = '{$table_name}' AND `columns`.`table_schema` = '{$db_name}';
SQL;
	}

	/**  */
	public static function getSQLColumnAddTemplate(){
		return <<<SQL
ALTER TABLE `:column_table_name:` ADD `:column_name:` :column_type: :column_is_null: :column_default: :column_comment: AFTER `:back_column:`;
SQL;
	}

	/**  */
	public static function getSQLColumnChangeTemplate(){
		return <<<SQL
ALTER TABLE `:column_table_name:` CHANGE `:column_name:` `:column_name:` :column_type: :column_is_null: :column_default: :column_comment:;
SQL;
	}

	/**  */
	public static function updateSetting(array $data){
		$data_control=[
			"name"=>null,
			"type"=>null,
			"is_null"=>null,
			"default"=>null,
			"comment"=>null,
		];

		$data=array_intersect_key($data, $data_control);
		$data=array_merge($data_control, $data);

		# Настройка имени
		$template['name']=$data['name'];
		# Настройка типа
		$template['type']=static::updateTypeAlias($data['type']);
		# Настройка значения null
		$template['is_null']=$data['is_null']
			? "NULL"
			: "NOT NULL";
		# Настройка значения по умолчанию
		$template['default']=static::updateDefaultAlias($data['default'], $data['is_null']);
		# Настройка комментария
		$template['comment']=$data['comment']
			? "COMMENT '{$data['comment']}'"
			: '';

		return $template;
	}

	/**  */
	public static function updateTypeAlias($data){
		return array_key_exists($data, static::$type_aliases)
			? static::$type_aliases[$data]
			: $data;
	}

	/**  */
	public static function updateDefaultAlias($data_def, $data_is_null){
		if($data_def===null)                                  { return NULL;}
		if(strtoupper($data_def)=='NULL' && !$data_is_null)   { return NULL;}
		if(strtoupper($data_def)=='NULL')                     { return 'DEFAULT NULL';}
		if(strtoupper($data_def)=='CURRENT_TIMESTAMP')        { return 'DEFAULT CURRENT_TIMESTAMP';}
		return "DEFAULT '{$data_def}'";
	}

	/**  */
	public static function updateColumnHandler($data){
		$data_control=[
			"name"=>$data["COLUMN_NAME"],
			"type"=>$data["DATA_TYPE"] . (($data["CHARACTER_MAXIMUM_LENGTH"] && !in_array($data["DATA_TYPE"], ['text']))? "({$data["CHARACTER_MAXIMUM_LENGTH"]})" : ''),
			"is_null"=>strtoupper($data["IS_NULLABLE"])=='YES' ? 1 : 0,
			"default"=>($data["COLUMN_DEFAULT"]===NULL && strtoupper($data["IS_NULLABLE"])=='YES') ? 'NULL' : $data["COLUMN_DEFAULT"],
			"comment"=>$data["COLUMN_COMMENT"],
		];
		return $data_control;
	}

}