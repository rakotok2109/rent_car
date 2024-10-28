<?php 

class PDOUtils {
    private $pdo_;
    private static $sharedInstance_;

    private function __construct() {
        $this->pdo_ = new PDO('mysql:host=localhost;dbname=eemi_carshowcase', 'root', ''); }

      
        public static function getSharedInstance()
        {
            if (self::$sharedInstance_ == null) {
                self::$sharedInstance_ = new PDOUtils();
            }
            return self::$sharedInstance_;
        }

        public function requestSQL($sql, $params = null) {
           $statement = $this->pdo_->prepare($sql);

if($statement && $statement->execute($params)) {

           $result = $statement->execute($params);
           unset($statement);
              return $result;
}
        }

        public function execSQL($sql, $params = null) {
            $statement = $this->pdo_->prepare($sql);
            if($statement && $statement->execute($params)) {
               
                unset($statement);
                return true;
            }
            return false;
           
        }
}