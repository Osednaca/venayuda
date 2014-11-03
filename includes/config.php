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

    $conf['user']    = "postgres";
    $conf['pass']    = "On.1953";
    $conf['dsn']     = 'pgsql:host=localhost;dbname=venayuda_db;'; 

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