<?php

class Conn {
  private static $conn = NULL;

  private function __construct() {}

  private static function init() {
      $conf = self::config();
      try {
        self::$conn = new PDO($conf['dsn'], $conf['user'], $conf['pass']);
      }
      catch (PDOException $e) {
        echo $e->getMessage();
      }
  }

  public static function get_conn() {
    if (!self::$conn) { self::init(); }
    return self::$conn;
  }

  private static function config() {
    //$config = parse_ini_file('/../'.$cfg_file);
    //$conf = array();

define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT', getenv('OPENSHIFT_MYSQL_DB_PORT'));
define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));

    $conf['user']    = DB_USER;
    $conf['pass']    = DB_PASS;
    $conf['dsn']     = 'pgsql:host='.DB_HOST.';dbname='.DB_NAME.';'; 

    return $conf;
  }
}

// Antes que nada la conexion puff

$db = Conn::get_conn();

//var_dump($db);

if ($db == false){
    echo "No hay conexion a la base de datos :P";
}

?>