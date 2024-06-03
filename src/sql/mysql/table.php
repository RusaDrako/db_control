<?php

namespace RusaDrako\db_update\sql\mysql;

class table{

	/**  */
	public static function getAllTables(){
		return <<<SQL
SHOW TABLES;
SQL;
	}

	/**  */
	public static function getSQLTableDeleteTemplate(){
		return <<<SQL
DROP TABLE `:table_name:`;
SQL;
	}

	/**  */
	public static function getSQLTableAddTemplate(){
		return <<<SQL
CREATE TABLE IF NOT EXISTS `:db_name:`.`:table_name:` (
	`:key_column_name:` BIGINT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID записи',
	PRIMARY KEY (`:key_column_name:`)
)
ENGINE = InnoDB
CHARSET = utf8mb4
COLLATE utf8mb4_unicode_ci
COMMENT = ':table_comment:';
SQL;
	}

}