<?php
/**
 * Description of Transaction
 *
 * @author Jamiu Babatunde <mojolagbe@gmail.com>
 */
class Transaction implements ContentManipulator{
    //book details
    private $id;
    private $transactionId;
    private $book;
    private $units;
    private $amount;
    private $currency;
    private $category;
    private $datePurchased = 'CURRENT_DATE';
    
    //card details
    private $cardHolder;
    private $cardNumber;
    private $expiryDate;
    private $cardCVC;
    
    //buyer details
    private $buyerName;
    private $buyerEmail;
    private $buyerPhone;
    private $buyerAddress;
    
    private $status = 0;
    private $tableName;
    private $dbObj;
    
    
    //Class constructor
    public function Transaction($dbObj, $tableName = 'transaction') {
        $this->dbObj = $dbObj; $this->tableName = $tableName;
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
     * Method that adds a user's purchase books into the database
     * @return JSON JSON encoded string/result
     */
    function add(){
        $sql = "INSERT INTO $this->tableName (`transaction_id`, `book`, `units`, `amount`, `currency`, `category`, `date_purchased`, `card_holder`, `card_number`, `expiry_date`, `card_cvc`, `buyer_name`, `buyer_email`, `buyer_phone`, `buyer_address`, `status`) "
                ."VALUES ('{$this->transactionId}','{$this->book}','{$this->units}','{$this->amount}','{$this->currency}','{$this->category}','{$this->datePurchased}','{$this->cardHolder}','{$this->cardNumber}','{$this->expiryDate}','{$this->cardCVC}','{$this->buyerName}','{$this->buyerEmail}','{$this->buyerPhone}','{$this->buyerAddress}','{$this->status}')";
        if($this->notEmpty($this->transactionId, $this->cardNumber)){
            $result = $this->dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, user's purchase record successfully added!"); }
            else{ $json = array("status" => 2, "msg" => "Error adding user's purchase record! ".  mysqli_error($this->dbObj->connection)); }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted. All fields must be filled."); }
        
        $this->dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** 
     * Method for deleting a purchased book record
     * @return JSON JSON encoded result
     */
    public function delete(){
        $sql = "DELETE FROM $this->tableName WHERE id = $this->id ";
        if($this->notEmpty($this->id)){
            $result = $this->dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, user's  purchase record successfully deleted!"); }
            else{ $json = array("status" => 2, "msg" => "Error deleting user's  purchase record! ".  mysqli_error($this->dbObj->connection));  }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        $this->dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }

    
    /** Method that fetches purchased books from database
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return JSON JSON encoded book details
     */
    public function fetch($column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM $this->tableName ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM $this->tableName WHERE $condition ORDER BY $sort";}
        $data = $this->dbObj->fetchAssoc($sql);
        $result =array(); 
        if(count($data)>0){
            foreach($data as $r){
                $result[] = array("id" => $r['id'], "transactionId" =>  utf8_encode($r['transaction_id']), "book" =>  utf8_encode($r['book']), "units" =>  utf8_encode($r['units']),
                    "amount" =>  utf8_encode($r['amount']), "currency" =>  utf8_encode($r['currency']), "category" =>  utf8_encode($r['category']), "datePurchased" =>  utf8_encode($r['date_purchased']), 
                    "cardHolder" =>  utf8_encode($r['card_holder']), "cardNumber" =>  utf8_encode($r['card_number']), 'expiryDate' => utf8_encode($r['expiry_date']), 'cardCVC' => utf8_encode($r['card_cvc']),
                    'buyerName' => utf8_encode($r['buyer_name']), 'buyerEmail' => utf8_encode($r['buyer_email']), 'buyerPhone' => utf8_encode($r['buyer_phone']), 
                    'buyerAddress' => utf8_encode($r['buyer_address']));
            }
            $json = array("status" => 1, "info" => $result);
        } 
        else{ $json = array("status" => 2, "msg" => "Necessary parameters not set. Or empty result. ".mysqli_error($this->dbObj->connection)); }
        $this->dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }
    
    /** Method that fetches book purchase record from database for JQuery Data Table
     * @param string $draw 
     * @param string $totalData 
     * @param string $totalFiltered 
     * @param string $customSql 
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g  transaction_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return JSON JSON encoded book purchase record details
     */
    public function fetchForJQDT($draw, $totalData, $totalFiltered, $customSql="", $column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM $this->tableName ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM $this->tableName WHERE $condition ORDER BY $sort";}
        if($customSql !=""){ $sql = $customSql; }
        $data = $this->dbObj->fetchAssoc($sql);
        $result =array(); $fetBookStat = 'icon-check-empty'; $fetBookRolCol = 'btn-warning'; $fetBookRolTit = "Activate Payment";
        if(count($data)>0){
            foreach($data as $r){ 
                $fetBookStat = 'icon-check-empty'; $fetBookRolCol = 'btn-warning'; $fetBookRolTit = "Activate Payment";
                if($r['status'] == 1){  $fetBookStat = 'icon-check'; $fetBookRolCol = 'btn-success'; $fetBookRolTit = "De-activate Book";}
                $multiActionBox = '<input type="checkbox" class="multi-action-box" data-id="'.$r['id'].'" data-status="'.$r['status'].'" data-user="'.$r['user'].'" data-transaction-id="'.$r['transaction_id'].'" />';
                $actionLink = ' <button data-id="'.$r['id'].'" data-transaction-id="'.$r['transaction_id'].'" data-status="'.$r['status'].'"  class="btn '.$fetBookRolCol.' btn-sm activate-book"  title="'.$fetBookRolTit.'"><i class="btn-icon-only '.$fetBookStat.'"> </i></button> <button data-id="'.$r['id'].'" data-transaction-id="'.$r['transaction_id'].'" class="btn btn-danger btn-sm delete-book" title="Delete"><i class="btn-icon-only icon-trash"> </i></button>';
                $result[] = array(utf8_encode($multiActionBox), utf8_encode($actionLink), utf8_encode($r['transaction_id']), utf8_encode($r['user']), utf8_encode($r['book']), utf8_encode($r['item_type']), utf8_encode($r['amount']), utf8_encode($r['currency']), utf8_encode($r['method']), utf8_encode($r['date_purchased']), utf8_encode($r['mode']));//
            }
            $json = array("status" => 1,"draw" => intval($draw), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $result);
        } 
        else{ $json = array("status" => 2, "msg" => "Empty result. ".mysqli_error($this->dbObj->connection), "draw" => intval($draw),  "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => false); }
        $this->dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }
    
    /** Method that fetches purchase record from database
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return Array Purchase record list
     */
    public function fetchRaw($column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM $this->tableName ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM $this->tableName WHERE $condition ORDER BY $sort";}
        $result = $this->dbObj->fetchAssoc($sql);
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
    
    /** Method that update single field detail of a purchased book record
     * @param string $field Column to be updated 
     * @param string $value New value of $field (Column to be updated)
     * @param int $id Id of the post to be updated
     * @return JSON JSON encoded success or failure message
     */
    public static function updateSingle($dbObj, $field, $value, $id){
        $sql = "UPDATE transaction SET $field = '{$value}' WHERE id = $id ";
        if(!empty($id)){
            $result = $dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, purchased book record successfully update!"); }
            else{ $json = array("status" => 2, "msg" => "Error updating purchased book record! ".  mysqli_error($dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        $dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }

    public function update() { }
    
    /**
     * Method that returns count/total number of a particular user purchased books<br/>
     */
    public function getPurchasedCourseCount(){
        $sql = "SELECT * FROM transaction WHERE user = $this->user";
        if(!empty($this->user)){
            $result = $this->dbObj->query($sql);
            $totalData = mysqli_num_rows($result);
            if($result !== false){ $json = array("status" => 1, "count" => $totalData); }
            else{ $json = array("status" => 2, "msg" => "Error fetching book count! ".  mysqli_error($this->dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        $this->dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }
}
