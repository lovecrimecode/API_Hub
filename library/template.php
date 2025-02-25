<?php
class Template {

     static $instance = null;

     public static function apply(){
          if(self::$instance === null) {
               self::$instance = new Template();
          }
          return self::$instance;
               
     }

     public function __construct() {
          require("template/header.php");
     }

     public function __destruct() {
          require("template/footer.php");
     }
}