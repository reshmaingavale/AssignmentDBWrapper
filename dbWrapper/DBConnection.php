    <?php
    require_once "Config.php";
    class DBConnection {
        public static $_connection = null;
        
        private function __construct () {
        }
        private function __clone() {
        }
        private function __wakeup(){}   
        public static function getConnection(){
                
        try {
            if (!(self::$_connection)) {
                   self::$_connection = new PDO("mysql:host=localhost;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
                echo "<br>";
              echo "object PDO created";
              echo "<br>";
            } else {
                echo "<br>";
                echo "object PDO  not created";
                echo "<br>";
                
            }
          return self::$_connection;
            
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        }
    }
   
    ?>