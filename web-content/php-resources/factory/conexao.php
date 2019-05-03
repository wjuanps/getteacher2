<?php
    final class Conection {
               
        private static $db = "mysql:host=localhost;dbname=getteacher";
        private static $username = "root";
        private static $password = "";  
                
        public static function connect() {
            try {
                return new PDO(self::$db, self::$username, self::$password);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>