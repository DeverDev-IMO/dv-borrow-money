<?php
if (!session_id()) session_start();
class Connect
{
  public static $instance;

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new PDO(
        "mysql:host=localhost;dbname=dv_borrow_money;",
        "root",
        "",
        // self::$instance = new PDO(
        //   "mysql:host=localhost;dbname=dv_borrow_money;",
        //   "root",
        //   "",
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
      );
      self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return self::$instance;
  }
}
