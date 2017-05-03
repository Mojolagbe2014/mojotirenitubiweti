<?php
/**
 * Description of News
 *
 * @author Jamiu Mojolagbe
 */
class News implements ContentManipulator{
    private $id;
    private $title;
    private $description;
    private $image;
    private $dateAdded = ' NOW() ';
    private $status = 0;
    
    private static $dbObj;
    private static $tableName;
    
    //Class constructor
    public function News($dbObj, $tableName='news') {
        self::$dbObj =  $dbObj;        self::$tableName = $tableName;
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
     * Method that adds a  news into the database
     * @return JSON JSON encoded string/result
     */
    public function add(){
        $sql = "INSERT INTO ".self::$tableName." (title, description, image, status, date_added) "
                ."VALUES ('{$this->title}','{$this->description}','{$this->image}','{$this->status}',$this->dateAdded)";
        if($this->notEmpty($this->title,$this->description)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, news successfully added!"); }
            else{ $json = array("status" => 2, "msg" => "Error adding  news! ".  mysqli_error(self::$dbObj->connection)); }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted. All fields must be filled."); }
        
        self::$dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** 
     * Method for deleting a  news
     * @return JSON JSON encoded result
     */
    public function delete(){
        $sql = "DELETE FROM ".self::$tableName." WHERE id = $this->id ";
        if($this->notEmpty($this->id)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done,  news successfully deleted!"); }
            else{ $json = array("status" => 2, "msg" => "Error deleting  news! ".  mysqli_error(self::$dbObj->connection));  }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        self::$dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** Method that fetches newss from database for JQuery Data Table
     * @param string $column Column title of the data to be fetched
     * @param string $condition Additional condition e.g  news_id > 9
     * @param string $sort column title to be used as sort parameter
     * @return JSON JSON encoded news details
     */
    public function fetchForJQDT($draw, $totalData, $totalFiltered, $customSql="", $column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM ".self::$tableName." ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM ".self::$tableName." WHERE $condition ORDER BY $sort";}
        if($customSql !=""){ $sql = $customSql; }
        $data = self::$dbObj->fetchAssoc($sql);
        $result =array(); $fetNewsStat = 'icon-check-empty'; $fetNewsRolCol = 'btn-warning'; $fetNewsRolTit = "Activate News";
        if(count($data)>0){
            foreach($data as $r){ 
                $fetNewsStat = 'icon-check-empty'; $fetNewsRolCol = 'btn-warning'; $fetNewsRolTit = "Activate News";
                $multiActionBox = '<input type="checkbox" class="multi-action-box" data-id="'.$r['id'].'" data-image="'.$r['image'].'" data-title="'.$r['title'].'" data-status="'.$r['status'].'"/>';
                if($r['status'] == 1){  $fetNewsStat = 'icon-check'; $fetNewsRolCol = 'btn-success'; $fetNewsRolTit = "De-activate News";}
                $result[] = array(utf8_encode($multiActionBox), $r['id'], utf8_encode('<div style="white-space:nowrap"><button data-id="'.$r['id'].'" data-image="'.$r['image'].'" data-title="'.$r['title'].'" class="btn btn-danger btn-sm delete-news" title="Delete"><i class="btn-icon-only icon-trash"> </i></button> <button  data-id="'.$r['id'].'"  data-image="'.$r['image'].'" data-title="'.$r['title'].'" class="btn btn-info btn-sm edit-news"  title="Edit"><i class="btn-icon-only icon-pencil"> </i> <span class="hidden" id="JQDTdescriptionholder">'.utf8_encode($r['description']).'</span> </button> <button data-id="'.$r['id'].'" data-title="'.$r['title'].'" data-status="'.$r['status'].'"  class="btn '.$fetNewsRolCol.' btn-sm activate-news"  title="'.$fetNewsRolTit.'"><i class="btn-icon-only '.$fetNewsStat.'"> </i></button></div>'), utf8_encode($r['title']), utf8_encode('<img src="../media/news/'.utf8_encode($r['image']).'" width="40" height="30" alt="Pix">'), StringManipulator::trimStringToFullWord(90, strip_tags(utf8_encode($r['description']))), utf8_encode($r['date_added']));//
            }
            $json = array("status" => 1,"draw" => intval($draw), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $result);
        } 
        else{ $json = array("status" => 2, "msg" => "Necessary parameters not set. Or empty result. ".mysqli_error(self::$dbObj->connection), "draw" => intval($draw),  "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => false); }
        self::$dbObj->close();
        //header('Content-type: application/json');
        return json_encode($json);
    }
    
    /** Method that fetches newss from database
     * @param string $column Column title of the data to be fetched
     * @param string $condition Additional condition e.g  news_id > 9
     * @param string $sort column title to be used as sort parameter
     * @return JSON JSON encoded  news details
     */
    public function fetch($column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM ".self::$tableName." ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM ".self::$tableName." WHERE $condition ORDER BY $sort";}
        $data = self::$dbObj->fetchAssoc($sql);
        $result =array(); 
        if(count($data)>0){
            foreach($data as $r){
                $result[] = array("id" => $r['id'], "title" =>  utf8_encode($r['title']), "image" =>  utf8_encode($r['image']), "description" =>  utf8_encode(stripcslashes(strip_tags($r['description']))), "dateAdded" =>  utf8_encode($r['date_added']), "status" =>  utf8_encode($r['status']));
            }
            $json = array("status" => 1, "info" => $result);
        } 
        else{ $json = array("status" => 2, "msg" => "Empty result. ".mysqli_error(self::$dbObj->connection)); }
        self::$dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** Method that fetches newss from database
     * @param string $column Column title of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column title to be used as sort parameter
     * @return Array newss list
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
    
    /** Method that update single field detail of a  news
     * @param string $field Column to be updated 
     * @param string $value New value of $field (Column to be updated)
     * @param int $id Id of the post to be updated
     * @return JSON JSON encoded success or failure message
     */
    public static function updateSingle($dbObj, $field, $value, $id){
        $sql = "UPDATE ".self::$tableName." SET $field = '{$value}' WHERE id = $id ";
        if(!empty($id)){
            $result = $dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done,  news successfully update!"); }
            else{ $json = array("status" => 2, "msg" => "Error updating  news! ".  mysqli_error($dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        $dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** Method that update details of a  news
     * @return JSON JSON encoded success or failure message
     */
    public function update() {
        $sql = "UPDATE ".self::$tableName." SET title = '{$this->title}', image = '{$this->image}', description = '{$this->description}' WHERE id = $this->id ";
        if($this->notEmpty($this->id, $this->description, $this->title)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done,  news successfully update!"); }
            else{ $json = array("status" => 2, "msg" => "Error updating  news! ".  mysqli_error(self::$dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        self::$dbObj->close();
        header('Content-type: application/json');
        return json_encode($json); 
    }

    /** getName() fetches the title of a news using the news $id
     * @param object $dbObj Database connectivity and manipulation object
     * @param int $id Category id of the  news whose title is to be fetched
     * @return string Name of the  news
     */
    public static function getName($dbObj, $id) {
        $thisNewsName = '';
        $thisNewsNames = $dbObj->fetchNum("SELECT title FROM ".self::$tableName." WHERE id = '{$id}' LIMIT 1");
        foreach ($thisNewsNames as $thisNewsNames) { $thisNewsName = $thisNewsNames[0]; }
        return $thisNewsName;
    }
    
    /** getSingle() fetches the column of an news using the news $id
     * @param object $dbObj Database connectivity and manipulation object
     * @param string $column Table's required column in the datatbase
     * @param int $id Course id of the news whose title is to be fetched
     * @return string Name of the news
     */
    public static function getSingle($dbObj, $column, $id) {
        $thisReqColVal = '';
        $thisReqColVals = $dbObj->fetchNum("SELECT $column FROM ".self::$tableName." WHERE id = '{$id}' ");
        foreach ($thisReqColVals as $thisReqColVals) { $thisReqColVal = $thisReqColVals[0]; }
        return $thisReqColVal;
    }
}
