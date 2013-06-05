<?php

define('DB_NAME', 'empdb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_DRIVER', 'mysql');

class Config{
protected $driver='mysql';
 protected $username='oot';
 protected $password='';
 protected $dbname='empdb';

public function getDriver() {
    return $this->driver;
}
 public function getUserName() {
    return $this->username;
}
 public function getPassword() {
    return $this->password;
}
 public function getDBName() {
    return $this->dbname;
}

}

?>