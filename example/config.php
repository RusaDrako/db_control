<?php

return $config=[
	'user'=>[
		"comment"=>"Тестовая таблица",
		"columns"=>[
			'user_id'             =>["type"=>"id", 'comment'=>'Тест_id',],
			'user_guid'           =>["type"=>"guid", 'comment'=>'Тест_guid',],
			'user_priority'       =>["type"=>"priority", 'comment'=>'Тест_priority',],
			'user_checkbox'       =>["type"=>"checkbox", 'comment'=>'Тест_checkbox',],
			'user_checkbox_time'  =>["type"=>"checkbox_time", 'comment'=>'Тест_checkbox_time',],
			'user_select_table'   =>["type"=>"select_table", 'comment'=>'Тест_select_table',],
			'user_select_list'    =>["type"=>"select_list", 'comment'=>'Тест_select_list', 'is_null'=>1, 'default'=>'NULL',],
			'user_text'           =>["type"=>"text", 'comment'=>'user_text',],
			'user_serialized'     =>["type"=>"serialized", 'comment'=>'Тест_serialized', 'is_null'=>1,],
			'user_datetime'       =>["type"=>"datetime", 'comment'=>'Тест_datetime', 'is_null'=>0, 'default'=>'CURRENT_TIMESTAMP',],
			'user_datetime_2'     =>["type"=>"datetime", 'comment'=>'Тест_datetime_2', 'is_null'=>1,],
			'user_create'         =>["type"=>"create", 'comment'=>'Тест_datetime_2',],
		],
		"indexes"=>[],
	],
];
