<?php

require_once(LIB_PATH.DS.'database.php');

class User {

    public $id;
    public $username;
    public $password;
    protected $hashed_password;
    public $firstName;
    public $lastName;
    public $companyName;
    public $email;
    public $phone;
    public $ackSigned;

    public static function find_all() {
        return self::find_by_sql("SELECT * from users");
    }

    public static function find_by_id($id=1) {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM users WHERE id = {$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array): false;
    }

    public static function find_by_sql($sql="") {
        global $db;
        $result_set = $db->query($sql);
        $object_array = array();
        while ($row = $db->fetch_array($result_set)){
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }

    public static function authenticate($username="", $password="") {
        global $db;
        $username = $db->escape_value($username);
        $password = $db->escape_value($password);

        $sql = "SELECT * FROM users ";
        $sql .= "WHERE  username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array): false;
    }

    public function full_name() {
        if(isset($this->firstName) && isset($this->lastName)){
            return $this->firstName . " " . $this->lastName;
        } else {
            return "";
        }
    }

    private static function instantiate($record) {
        $object = new self;

        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)){
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute) {
        $object_vars = get_object_vars($this);
        return array_key_exists($attribute, $object_vars);
    }

    protected function hash_password() {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function create() {
        global $db;

        $this->hash_password();

        $sql = "INSERT INTO users (";
        $sql .= "username, password, firstName, lastName, companyName, email, phone";
        $sql .= ") VALUES ('";
        $sql .= $db->escape_value($this->username)    ."','";
        $sql .= $db->escape_value($this->hashed_password)    ."','";
        $sql .= $db->escape_value($this->firstName)   ."','";
        $sql .= $db->escape_value($this->lastName)    ."','";
        $sql .= $db->escape_value($this->companyName) ."','";
        $sql .= $db->escape_value($this->email)       ."','";
        $sql .= $db->escape_value($this->phone)       ."')";

        if($db->query($sql)){
            $this->id = $db->insert_id();
            return true;
        }else {
            return false;
        }
    }

    public function update(){
        global $db;
        $sql = "UPDATE users SET ";
        $sql .= "ackSigned='". $db->escape_value($this->ackSigned) ."' ";
        $sql .= "WHERE id=" . $db->escape_value($this->id); 
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }
}

?>