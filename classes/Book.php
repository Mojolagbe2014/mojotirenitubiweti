<?php
/**
 * Description of Book
 *
 * @author Jamiu Babatunde Mojolagbe <mojolagbe@gmail.com>
 */
class Book implements ContentManipulator{
    private $id;
    private $name;
    private $category;
    private $description;
    private $media;
    private $dateRegistered = " CURRENT_DATE ";
    private $status = 1;
    private $amount = 0;
    private $image;
    private $currency;
    private $message = '';
    private $dbObj;
    private $tableName;
    
    //Class constructor
    public function Book($dbObj, $tableName='book') {
        $this->dbObj = $dbObj;        $this->tableName = $tableName;
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
     * Method that adds a book into the database
     * @return JSON JSON encoded string/result
     */
    function add(){
        $sql = "INSERT INTO book (name, category, description, media, amount, status, date_registered, image, currency, message) "
                ."VALUES ('{$this->name}','{$this->category}','{$this->description}','{$this->media}','{$this->amount}','{$this->status}',$this->dateRegistered,'{$this->image}','{$this->currency}','{$this->message}')";
        if($this->notEmpty($this->name,$this->description,$this->image)){
            $result = $this->dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, book successfully added!"); }
            else{ $json = array("status" => 2, "msg" => "Error adding book! ".  mysqli_error($this->dbObj->connection)); }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted. All fields must be filled."); }
        
        $this->dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** 
     * Method for deleting a book
     * @return JSON JSON encoded result
     */
    public function delete(){
        $sql = "DELETE FROM book WHERE id = $this->id ";
        if($this->notEmpty($this->id)){
            $result = $this->dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, book successfully deleted!"); }
            else{ $json = array("status" => 2, "msg" => "Error deleting book! ".  mysqli_error($this->dbObj->connection));  }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        $this->dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** Method that fetches books from database for JQuery Data Table
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return JSON JSON encoded book details
     */
    public function fetchForJQDT($draw, $totalData, $totalFiltered, $customSql="", $column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM book ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM book WHERE $condition ORDER BY $sort";}
        if($customSql !=""){ $sql = $customSql; }
        $data = $this->dbObj->fetchAssoc($sql);
        $result =array();  $fetBookStat = 'icon-check-empty'; $fetBookRolCol = 'btn-warning'; $fetBookRolTit = "Activate Book";
        if(count($data)>0){
            foreach($data as $r){ 
                $bookMediaLink = ''; $itemCat = array(1 => "e-Book", 2 => "Other");
                $fetBookStat = 'icon-check-empty'; $fetBookRolCol = 'btn-warning'; $fetBookRolTit = "Activate Book";
                if($r['status'] == 1){  $fetBookStat = 'icon-check'; $fetBookRolCol = 'btn-success'; $fetBookRolTit = "De-activate Book";}
                if($r['media'] !=''){ $bookMediaLink = '<a href="'.SITE_URL.'media/book/'.$r['media'].'">View Media</a>'; }
                $multiActionBox = '<input type="checkbox" class="multi-action-box" data-id="'.$r['id'].'" data-name="'.$r['name'].'" data-status="'.$r['status'].'" data-image="'.$r['image'].'" data-media="'.$r['media'].'" data-featured="'.$r['featured'].'" />';
                $actionLink = ' <button data-id="'.$r['id'].'" data-name="'.$r['name'].'" data-category="'.$r['category'].'" data-currency="'.$r['currency'].'" data-description =""  data-message ="" data-media="'.$r['media'].'"  data-image="'.$r['image'].'" data-amount="'.$r['amount'].'" data-date-registered="'.$r['date_registered'].'" class="btn btn-info btn-sm edit-book"  title="Edit"><i class="btn-icon-only icon-pencil"> </i> <span class="hidden" id="JQDTdescriptionholder">'.$r['description'].'</span>  <span class="hidden" id="JQDTmessageholder">'.$r['message'].'</span> </button> <button data-id="'.$r['id'].'" data-name="'.$r['name'].'" data-status="'.$r['status'].'"  class="btn '.$fetBookRolCol.' btn-sm activate-book"  title="'.$fetBookRolTit.'"><i class="btn-icon-only '.$fetBookStat.'"> </i></button> <button data-id="'.$r['id'].'" data-media="'.$r['media'].'"  data-image="'.$r['image'].'" data-name="'.$r['name'].'" class="btn btn-danger btn-sm delete-book" title="Delete"><i class="btn-icon-only icon-trash"> </i></button>';
                $result[] = array(utf8_encode($multiActionBox), utf8_encode($actionLink), $r['id'], utf8_encode($r['name']), $itemCat[intval($r['category'])], StringManipulator::trimStringToFullWord(60, utf8_encode(stripcslashes(strip_tags($r['description'])))), utf8_encode($bookMediaLink), utf8_encode($r['currency'].' '.number_format($r['amount'])), StringManipulator::trimStringToFullWord(60, utf8_encode(stripcslashes(strip_tags($r['message'])))), utf8_encode('<img src="../media/book-image/'.utf8_encode($r['image']).'" width="60" height="50" style="width:60px; height:50px;" alt="Pix">'), utf8_encode($r['date_registered']));//
            }
            $json = array("status" => 1,"draw" => intval($draw), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $result);
        } 
        else{ $json = array("status" => 2, "msg" => "Necessary parameters not set. Or empty result. ".mysqli_error($this->dbObj->connection), "draw" => intval($draw),  "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => false); }
        $this->dbObj->close();
        //header('Content-type: application/json');
        return json_encode($json);
    }
    
    /** Method that fetches books from database
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return JSON JSON encoded book details
     */
    public function fetch($column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM book ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM book WHERE $condition ORDER BY $sort";}
        $data = $this->dbObj->fetchAssoc($sql);
        $result =array(); 
        if(count($data)>0){
            foreach($data as $r){
                $result[] = array("id" => $r['id'], "name" =>  utf8_encode($r['name']), "image" =>  utf8_encode($r['image']), 'category' => utf8_encode($r['category']), 'description' => utf8_encode(StringManipulator::trimStringToFullWord(200, stripcslashes(strip_tags($r['description'])))), 'message' => utf8_encode(StringManipulator::trimStringToFullWord(200, stripcslashes(strip_tags($r['message'])))), 'media' =>  utf8_encode($r['media']), 'currency' =>  utf8_encode($r['currency']), 'amount' =>  utf8_encode($r['amount']), 'cost' =>  utf8_encode($r['currency'].number_format($r['amount'], 2)), 'status' =>  utf8_encode($r['status']), 'dateRegistered' => utf8_encode($r['date_registered']), 'categoryName' => utf8_encode($r['category']));
            }
            $json = array("status" => 1, "info" => $result);
        } 
        else{ $json = array("status" => 2, "msg" => "Necessary parameters not set. Or empty result. ".mysqli_error($this->dbObj->connection)); }
        $this->dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** Method that fetches books from database
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return Array Books list
     */
    public function fetchRaw($column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM book ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM book WHERE $condition ORDER BY $sort";}
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
    
    /** Method that update single field detail of a book
     * @param string $field Column to be updated 
     * @param string $value New value of $field (Column to be updated)
     * @param int $id Id of the post to be updated
     * @return JSON JSON encoded success or failure message
     */
    public static function updateSingle($dbObj, $field, $value, $id){
        $sql = "UPDATE book SET $field = '{$value}' WHERE id = $id ";
        if(!empty($id)){
            $result = $dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, book successfully updated!"); }
            else{ $json = array("status" => 2, "msg" => "Error updating book! ".  mysqli_error($dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        $dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** Method that update details of a book
     * @return JSON JSON encoded success or failure message
     */
    public function update() {
        $sql = "UPDATE book SET name = '{$this->name}', image = '{$this->image}', category = '{$this->category}', description = '{$this->description}', message = '{$this->message}', media = '{$this->media}', amount = '{$this->amount}', currency = '{$this->currency}' WHERE id = $this->id ";
        if(!empty($this->id)){
            $result = $this->dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, book successfully updated!"); }
            else{ $json = array("status" => 2, "msg" => "Error updating book! ".  mysqli_error($this->dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        $this->dbObj->close();
        header('Content-type: application/json');
        return json_encode($json); 
    }
    
    /** getName() fetches the name of a book using the book $id
     * @param object $dbObj Database connectivity and manipulation object
     * @param int $id Category id of the category whose name is to be fetched
     * @return string Name of the category
     */
    public static function getName($dbObj, $id) {
        $thisBookName = '';
        $thisBookNames = $dbObj->fetchNum("SELECT name FROM book WHERE id = '{$id}' LIMIT 1");
        foreach ($thisBookNames as $thisBookNames) { $thisBookName = $thisBookNames[0]; }
        return $thisBookName;
    }

    
    /** getSingle() fetches the title of an book using the book $id
     * @param object $dbObj Database connectivity and manipulation object
     * @param string $column Table's required column in the datatbase
     * @param int $id Book id of the book whose name is to be fetched
     * @return string Name of the book
     */
    public static function getSingle($dbObj, $column, $id) {
        $thisAsstReqVal = '';
        $thisAsstReqVals = $dbObj->fetchNum("SELECT $column FROM book WHERE id = '{$id}' ");
        foreach ($thisAsstReqVals as $thisAsstReqVals) { $thisAsstReqVal = $thisAsstReqVals[0]; }
        return $thisAsstReqVal;
    }
    
    /**
     * Method that returns count/total number of a particular book
     * @param Object $dbObj Datatbase connectivity object
     * @param Object $condition Additional optional condition
     * @return int Number of books
     */
    public static function getRawCount($dbObj, $condition=" 1=1 "){
        $sql = "SELECT * FROM book WHERE $condition ";
        $count = "";
        $result = $dbObj->query($sql);
        $totalData = mysqli_num_rows($result);
        if($result !== false){ $count = $totalData; }
        return $count;
    }
    
    /** fetchByCategory fetches books in a category and sub-categories
     * @param int $categoryId Category id
     * @param string $categoryTable Category table name
     * @param string $condition Additional condition
     */
    public function fetchByCategory($categoryId, $categoryTable, $condition=''){
        $bookArr = array();
        if($categoryId !=0){
            $bookArr = array_merge($bookArr, $this->dbObj->fetchAssoc("SELECT * FROM $this->tableName WHERE category = ".$categoryId." $condition "));
            $catDetails = $this->dbObj->fetchAssoc("SELECT * FROM $categoryTable WHERE parent = $categoryId $condition ");
            foreach ($catDetails as $catDetail){
                $bookArr = array_merge($bookArr, $this->fetchByCategory($catDetail['id'], $categoryTable));
            }
            return $bookArr;
        }
    }
    
    /**
     * Method that returns count/total number of a particular lesson
     * @param object $dbObj Database connectivity and manipulation object
     * @param int $id Book id of the lessons whose titles are to be fetched
     * @param string $dbPrefix Database table prefix
     * @return int Number of books
     */
    public static function getSingleCategoryCount($dbObj, $id, $dbPrefix=''){
        $tableName = $dbPrefix.'book';
        $sql = "SELECT * FROM $tableName WHERE category = $id ";
        $count = "";
        $result = $dbObj->query($sql);
        $totalData = mysqli_num_rows($result);
        if($result !== false){ $count = $totalData; }
        return $count;
    }
}
