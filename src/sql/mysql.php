<?php

namespace RusaDrako\db_update\sql;

use RusaDrako\db_update\sql\mysql\column;
use RusaDrako\db_update\sql\mysql\index;
use RusaDrako\db_update\sql\mysql\table;
use RusaDrako\db_update\Table as Table_obj;

class mysql implements inf_sql{

	public function getTables(){
		return table::getAllTables();
	}

	public function getSQLTableDeleteTemplate(){
		return table::getSQLTableDeleteTemplate();
	}

	public function getSQLTableAddTemplate(){
		return table::getSQLTableAddTemplate();
	}



	public function getTableColumns(Table_obj $table_obj){
		return column::getAllColumns($table_obj->getName(), $table_obj->getDb()->getName());
	}

	public function setColumnTemplate($data){
		return column::setTemplate($data);
	}

	public function getSQLColumnAddTemplate(){
		return column::getSQLColumnAddTemplate();
	}

	public function getSQLColumnChangeTemplate(){
		return column::getSQLColumnChangeTemplate();
	}

	public function updateColumnHandler($data){
		return column::updateColumnHandler($data);
	}



	public function getTableIndexes(Table_obj $table_obj){
		return index::getTableIndexes($table_obj->get__name());
	}

}