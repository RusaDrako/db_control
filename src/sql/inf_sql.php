<?php

namespace RusaDrako\db_update\sql;

use RusaDrako\db_update\Table as Table_obj;

interface inf_sql {

	public function getTables();

	public function getTableColumns(Table_obj $table_obj);

	public function getTableIndexes(Table_obj $table_obj);

}