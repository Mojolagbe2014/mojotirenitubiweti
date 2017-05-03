<?php
/**
 * Description of User
 *
 * @author Kaiste
 */
class User implements ContentManipulator{
    private $id;
    private $email;
    private $name;
    private $company;
    private $timeEntered;
    private static $dbObj;
    public static $tableName = 'user';

    //Class constructor
    public function User($dbObj=null, $tableName='user') {
        self::$dbObj = $dbObj;        
        self::$tableName = $tableName;
    }
    
    //Using Magic__set and __get
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
    
    /**  
     * Method that adds a user into the database
     * @return JSON JSON encoded string/result
     */
    function add(){
        $sql = "INSERT INTO ".self::$tableName." (email, name, company) "
                ."VALUES ('{$this->email}','{$this->name}','{$this->company}')";
        if($this->notEmpty($this->name,$this->email,$this->company)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, user successfully added!"); }
            else{ $json = array("status" => 2, "msg" => "Error adding user! ".  mysqli_error(self::$dbObj->connection)); }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted. All fields must be filled."); }
        
        self::$dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }
    
    /**  
     * Method that adds a user into the database
     * @return string Sucess|Error
     */
    function addRaw(){
        $sql = "INSERT INTO ".self::$tableName." (email, name, company) "
                ."VALUES ('{$this->email}','{$this->name}','{$this->company}')";
        if($this->notEmpty($this->name,$this->email)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ return 'success'; }
            else{ return 'error';    }
        }
        else{return 'error'; }
    }

    /** 
     * Method for deleting a user
     * @return string Sucess|Error
     */
    public function deleteRaw(){
        $sql = "DELETE FROM ".self::$tableName." WHERE id = $this->id ";
        if($this->notEmpty($this->id)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ return 'success'; }
            else{ return 'error';    }
        }
        else{ return 'error'; }
    }

    /** 
     * Method for deleting a user
     * @return JSON JSON encoded result
     */
    public function delete(){
        $sql = "DELETE FROM ".self::$tableName." WHERE id = $this->id ";
        if($this->notEmpty($this->id)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, user successfully deleted!"); }
            else{ $json = array("status" => 2, "msg" => "Error deleting user! ".  mysqli_error(self::$dbObj->connection));  }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        self::$dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }

    
    /** Method that fetches users from database for JQuery Data Table
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return JSON JSON encoded user details
     */
    public function fetchForJQDT($draw, $totalData, $totalFiltered, $customSql="", $column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM ".self::$tableName." ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM ".self::$tableName." WHERE $condition ORDER BY $sort";}
        if($customSql !=""){ $sql = $customSql; }
        $data = self::$dbObj->fetchAssoc($sql);
        $result =array(); 
        if(count($data)>0){
            foreach($data as $r){ 
                $actionButtons = '<div style="white-space:nowrap"> <button data-id="'.$r['id'].'" data-email="'.$r['email'].'" data-name="'.$r['name'].'" class="btn btn-danger btn-sm delete-user" title="Delete"><i class="btn-icon-only icon-trash"> </i></button>  </div>';//'<button data-email="'.$r['email'].'" data-id="'.$r['id'].'" data-name="'.$r['name'].'" class="btn btn-primary btn-sm message-user"  title="Send Message"><i class="btn-icon-only icon-envelope"> </i></button> ';
                $multiActionBox = '<input type="checkbox" class="multi-action-box" data-id="'.$r['id'].'"  data-name="'.$r['name'].'" data-email="'.$r['email'].'" />';
                $result[] = array(utf8_encode($multiActionBox), $r['id'], utf8_encode($r['name']), utf8_encode($r['email']), utf8_encode($r['company']), utf8_encode($actionButtons));
            }
            $json = array("status" => 1,"draw" => intval($draw), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $result);
        } 
        else{ $json = array("status" => 2, "msg" => "Necessary parameters not set. Or empty result. ".mysqli_error(self::$dbObj->connection), "draw" => intval($draw),  "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => false); }
        self::$dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }
    
    /** Method that fetches users from database
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return JSON JSON encoded user details
     */
    public function fetch($column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM ".self::$tableName." ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM ".self::$tableName." WHERE $condition ORDER BY $sort";}
        $data = self::$dbObj->fetchAssoc($sql);
        $result =array(); 
        if(count($data)>0){
            foreach($data as $r){
                $result[] = array("id" => $r['id'], "email" =>  utf8_encode($r['email']), 'name' =>  utf8_encode($r['name']), 'company' =>  utf8_encode($r['company']));
            }
            $json = array("status" => 1, "info" => $result);
        } 
        else{ $json = array("status" => 2, "msg" => "Necessary parameters not set. Or empty result. ".mysqli_error(self::$dbObj->connection)); }
        self::$dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** Method that fetches user from database
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return Array User list
     */
    public function fetchRaw($column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM ".self::$tableName." ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM ".self::$tableName." WHERE $condition ORDER BY $sort";}
        $result = self::$dbObj->fetchAssoc($sql);
        return $result;
    }
    
    /** Empty string checker  
     * @return Booloean True|False
     */
    public function notEmpty() {
        foreach (func_get_args() as $arg) {
            if (empty($arg)) { return false; } 
            else {continue; }
        }
        return true;
    }
    
    /** Method that update single field detail of a user
     * @param string $field Column to be updated 
     * @param string $value New value of $field (Column to be updated)
     * @param int $id Id or email of the user to be updated
     * @return JSON JSON encoded success or failure message
     */
    public static function updateSingle($dbObj, $field, $value, $id){
        $det = intval($id) ? "id" : "email";
        $sql = "UPDATE ".self::$tableName." SET $field = '{$value}' WHERE $det = '$id' ";
        if(!empty($id)){
            $result = $dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, user successfully updated!"); }
            else{ $json = array("status" => 2, "msg" => "Error updating user! ".  mysqli_error($dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        $dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }
    
    /** Method that update single field detail of a user
     * @param string $field Column to be updated 
     * @param string $value New value of $field (Column to be updated)
     * @param int $id Id or email of the user to be updated
     * @return string success|error
     */
    public static function updateSingleRaw($dbObj, $field, $value, $id){
        $det = intval($id) ? "id" : "email";
        $sql = "UPDATE ".self::$tableName." SET $field = '{$value}' WHERE $det = '$id' ";
        if(!empty($id)){
            $result = $dbObj->query($sql);
            if($result !== false){ return 'success'; }
            else{ return 'error';    }
        }
        else{return 'error'; }
    }

    /** Method that update details of a user
     * @return JSON JSON encoded success or failure message
     */
    public function update() {
        $sql = "UPDATE ".self::$tableName." SET name = '{$this->name}', email = '{$this->email}', company = '{$this->company}' WHERE id = $this->id ";
        if(!empty($this->id)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, user successfully update!"); }
            else{ $json = array("status" => 2, "msg" => "Error updating user! ".  mysqli_error(self::$dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        self::$dbObj->close();
        header('Content-type: application/json');
        return json_encode($json); 
    }
    
    /** Method that update details of a user
     * @return string Sucess|Error
     */
    public function updateRaw() {
        $sql = "UPDATE ".self::$tableName." SET name = '{$this->name}', email = '{$this->email}', company = '{$this->company}' WHERE email = '{$this->id}' ";
        if(!empty($this->email)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ return 'success'; }
            else{ return 'error';    }
        }
        else{return 'error'; }
    }

    
    /** emailExists checks if an email truely exists in the database
     * @return Boolean True for exists, while false for not
     */
    public function emailExists(){//password_verify($password, $hash)
        $sql =  "SELECT * FROM ".self::$tableName." WHERE email = '$this->email' LIMIT 1 ";
        $storedEmail = '';
        $results = self::$dbObj->fetchAssoc($sql);
        foreach ($results as $result) {
            $storedEmail = $result['email'];
        }
        if($this->email == $storedEmail){ return true; }
        else{ return false;    }
    } 
    
    /** getSingle() fetches a single column of an user using $email or $id
     * @param object $dbObj Database connectivity and manipulation object
     * @param string $column Table's required column in the datatbase
     * @param string $email User email or ID of the user whose name is to be fetched
     * @return string Name of the user
     */
    public static function getSingle($dbObj, $column, $email) {
        $field = intval($email) ? "id" : "email";
        $thisReqVal = '';
        $thisReqVals = $dbObj->fetchNum("SELECT $column FROM ".self::$tableName." WHERE $field = '{$email}' ");
        foreach ($thisReqVals as $thisReqVals) { $thisReqVal = $thisReqVals[0]; }
        return $thisReqVal;
    }
}