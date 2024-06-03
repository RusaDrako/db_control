<?php

namespace RusaDrako\db_update;

require_once('trt_status.php');
require_once('_template.php');
require_once('DB.php');
require_once('Table.php');
require_once('Column.php');

require_once('sql/inf_sql.php');

require_once('sql/mysql.php');
require_once('sql/mysql/table.php');
require_once('sql/mysql/column.php');
require_once('sql/mysql/index.php');

function dd(...$data){
	if(0<count($data) && count($data)<2){$data=$data[0];};
	echo var_export($data, 1);
	exit;
}