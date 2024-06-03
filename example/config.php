<?php

return $config=[
	'user'=>[
		"comment"=>"Тестовая таблица",
		"columns"=>[
			'user_login'      =>["type"=>"text", 'comment'=>'Логин',],
			'user_password'   =>["type"=>"text", 'comment'=>'Парооль пользователя', 'default'=>'NULL',],
			'user_create'     =>["type"=>"datetime", 'comment'=>'Дата создания', 'default'=>'CURRENT_TIMESTAMP',],
			'user_guid'       =>["type"=>"guid", 'comment'=>'GUID', 'is_null'=>1, 'default'=>'NULL',],
		],
		"indexes"=>[],
	],
];