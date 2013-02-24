<?php
/**
 * Model Class
 * 
 * @author Keven Ages <kages@gmail.com>
 * @version 1.0
 * @since 1.0
 *
 */
class Model extends Object {
	/**
	 * Public and overwritable
	 */
	public $id = null;
	public $last_insert = null;
	public $data = array();
	public $fields = array();
	public $conditions = array();
	public $limit = array();
	public $config = array();
	public $debug = array();
	/**
	 * Private
	 */
	private $db;
	private $table = null;
	private $model = null;
	private $primaryKey = null;
	private $schema = array();

	public function __construct(){
		if(!empty($this->config)){
			$this->setConfig($this->config);
		}
	}

	private function setConfig($config = array()){
		$this->setTable($config['table']);
		$this->setModel($config['model']);
		$this->setPrimaryKey($config['primaryKey']);
		$this->setSchema($config['schema']);
	}

	public function setSchema($schema){
		$this->schema = $schema;
	}

	public function getSchema(){
		return $this->$schema;
	}

	public function setPrimaryKey($primaryKey){
		$this->primaryKey = $primaryKey;
	}

	public function getPrimaryKey(){
		return $this->primaryKey;
	}

	public function setTable($table){
		$this->table = $table;
	}

	public function getTable(){
		return $this->table;
	}

	public function setModel($model){
		$this->model = $model;
	}

	public function getModel(){
		return $this->model;
	}

	public function create(){
		
		$server = DB_HOST;
		$user = DB_USER;
		$pwd = DB_PASSWORD;
		$db = DB_SCHEMA;

		$DB = NewADOConnection('mysql');
		$DB->Connect($server, $user, $pwd, $db);

		$this->data = DbFormatUtils::prepare_insert($this->schema, $this->data);
		
		$sql = sprintf('INSERT INTO `%s` (%s) 
							VALUES(%s)',
							mysql_real_escape_string($this->table),
							DbFormatUtils::implode_quotes(DbFormatUtils::prepare_schema($this->schema)),
							$this->data
							);

		if(false !== $DB->Execute($sql)){
			return $DB->Insert_ID();
		}

		return false;
	}

	public function read(){

		$server = DB_HOST;
		$user = DB_USER;
		$pwd = DB_PASSWORD;
		$db = DB_SCHEMA;

		$DB = NewADOConnection('mysql');
		$DB->Connect($server, $user, $pwd, $db);

		if(!empty($this->fields)){
			$this->schema = $this->fields;
		} else {
			$this->schema = DbFormatUtils::prepare_schema($this->schema);
		}
	
		$id = $this->id;
		
		if(!is_numeric($id)){
			$id = DbFormatUtils::implode_quotes(mysql_real_escape_string($id), "'");
		} else {
			$id = mysql_real_escape_string($id);
		}
	
		$sql = sprintf('SELECT %s 
						FROM `%s` 
						WHERE `%s` = %s 
						LIMIT 1',
						mysql_real_escape_string(DbFormatUtils::implode_quotes($this->schema)),
						mysql_real_escape_string($this->getTable()),
						mysql_real_escape_string($this->getPrimaryKey()),
						$id
						);
		
		$result = $DB->GetAll($sql);
		
		if(!empty($result)){
			return array($this->getModel() => $result[0]);
		}

		return false;
	}

	public function update(){

		$server = DB_HOST;
		$user = DB_USER;
		$pwd = DB_PASSWORD;
		$db = DB_SCHEMA;

		$DB = NewADOConnection('mysql');
		$DB->Connect($server, $user, $pwd, $db);

		$sql = sprintf('UPDATE `%s`
						SET %s 
						WHERE `%s`.`%s` = %d',
						$this->table,
						DbFormatUtils::prepare_update($this->schema, $this->data),
						$this->table,
						$this->primaryKey,
						mysql_real_escape_string($this->id)
						);

		//$this->write_db();
		$DB->Execute($sql);
		if(0 == $DB->Affected_Rows()){
			return false;
		}

		return true;
	}

	public function rawQuery($sql){
		
		$server = DB_HOST;
		$user = DB_USER;
		$pwd = DB_PASSWORD;
		$db = DB_SCHEMA;

		$DB = NewADOConnection('mysql');
		$DB->Connect($server, $user, $pwd, $db);

		//$this->write_db();
		//This should be changed to $DB->Execute()
		//my bad, sorry.
		$response = $DB->getAll($sql);
		
		if(!empty($response)){
			$response = array($this->getModel() => $response);
		}

		return $response;
	}
	/**
	 * DESTRUCTION!!!!!!!
	 */
	public function __destruct(){}
	/**
	 * Prevent cloning
	 */
	public function __clone(){}
}
/**
 * DBFormatUtils Class
 * static class for mysql/database formatting
 * 
 * @author Keven Ages <kages@torstardigital.com>
 * @copyright 2012 Torstar Digital
 * @copyright 2012 Wagjag.com
 * @version 1.0
 * @since 1.0
 *
 */
class DbFormatUtils {

    public static function prepare_schema($schema = null){
		if($schema){
			return array_keys($schema);
		}
	}

	public static function implode_quotes($fields = null, $type = "`"){
			if(is_array($fields)){
				return $type . implode($type . ',' . $type, $fields) . $type;	
			} else {
				return $type . $fields . $type;
			}
	}

	public static function prepare_insert($schema = null, $data = null){
		if($schema && $data){
			$data = array_merge($schema, $data);
			foreach($data as $key => $value){
				if(!$value && "0" != $value){
					$data[$key] = "NULL";
				} else {
					$data[$key] = mysql_real_escape_string($value);
				}
			}
			$data = self::implode_quotes($data, "'");
			return $data;
		}
	}

	public static function prepare_update($schema = null, $data = null){
	
		if($schema && $data){
			$dataFormatted = array();
			$data = array_merge($schema, $data);
			foreach($data as $key => $value){
				if(!$value && "0" != $value){
					unset($data[$key]);
				} else {
					$updateData = self::implode_quotes($key) . '=' . self::implode_quotes(mysql_real_escape_string($value), "'");
					array_push($dataFormatted, $updateData);
				}
			}
			$dataFormatted = implode(",", $dataFormatted);
			return $dataFormatted;
		}
	}
}