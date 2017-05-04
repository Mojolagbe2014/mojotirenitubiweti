<?php
/* 
 * Class Slider describes individual sliders
 * @author Jamiu Mojolagbe
 */
class Slider implements ContentManipulator{
    //class properties/data
    private $id;
    private $image;
    private $title;
    private $content;
    private $orders;
    private $status = 1;
    
    private static $dbObj;
    private static $tableName;

    //class constructor
    public function Slider($dbObj, $tableName='slider') {
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
     * Method that submits a slider into the database
     * @return JSON JSON encoded string/result
     */
    public function add(){
        $sql = "INSERT INTO ".self::$tableName." (title, content, image, orders, status) "
                ."VALUES ('{$this->title}','{$this->content}','{$this->image}','{$this->orders}','{$this->status}')";
        if($this->notEmpty($this->title,$this->content,$this->orders)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, slider successfully added!"); }
            else{ $json = array("status" => 2, "msg" => "Error adding slider! ".  mysqli_error(self::$dbObj->connection)); }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted. All fields must be filled."); }
        
        self::$dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** 
     * Method for deleting a slider
     * @return JSON JSON encoded string/result
     */
    public function delete(){
        $sql = "DELETE FROM ".self::$tableName." WHERE id = $this->id ";
        if($this->notEmpty($this->id)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, slider successfully deleted!"); }
            else{ $json = array("status" => 2, "msg" => "Error deleting slider! ".  mysqli_error(self::$dbObj->connection));  }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        self::$dbObj->close();//Close Database Connection
        header('Content-type: application/json');
        return json_encode($json);
    }

    /** Method that fetches sliders from database
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g slider_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return JSON JSON encoded string/result
     */
    public function fetch($column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM ".self::$tableName." ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM ".self::$tableName." WHERE $condition ORDER BY $sort";}
        $data = self::$dbObj->fetchAssoc($sql);
        $result =array(); 
        if(count($data)>0){
            foreach($data as $r){
                $result[] = array("id" => $r['id'], "title" =>  utf8_encode($r['title']), "content" =>  utf8_encode($r['content']), "image" =>  utf8_encode($r['image']), 'orders' =>  utf8_encode($r['orders']), "status" =>  utf8_encode($r['status']));
            }
            $json = array("status" => 1, "info" => $result);
        } else{ $json = array("status" => 2, "msg" => "Necessary parameters not set. Or empty result. ".mysqli_error(self::$dbObj->connection)); }
        
        self::$dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }
    
    /** Method that fetches sliders from database
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g category_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return Array slider list
     */
    public function fetchRaw($column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM ".self::$tableName." ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM ".self::$tableName." WHERE $condition ORDER BY $sort";}
        $result = self::$dbObj->fetchAssoc($sql);
        return $result;
    }
    
    /** Method that fetches sliders from database for JQuery Data Table
     * @param string $column Column name of the data to be fetched
     * @param string $condition Additional condition e.g slider_id > 9
     * @param string $sort column name to be used as sort parameter
     * @return JSON JSON encoded slider details
     */
    public function fetchForJQDT($draw, $totalData, $totalFiltered, $customSql="", $column="*", $condition="", $sort="id"){
        $sql = "SELECT $column FROM ".self::$tableName." ORDER BY $sort";
        if(!empty($condition)){$sql = "SELECT $column FROM ".self::$tableName." WHERE $condition ORDER BY $sort";}
        if($customSql !=""){ $sql = $customSql; }
        $data = self::$dbObj->fetchAssoc($sql);
        $result =array(); $fetSliderStat = 'icon-check-empty'; $fetSliderRolCol = 'btn-warning'; $fetSliderRolTit = "Activate Slider";
        if(count($data)>0){
            foreach($data as $r){ 
                $fetSliderStat = 'icon-check-empty'; $fetSliderRolCol = 'btn-warning'; $fetSliderRolTit = "Activate Slider";
                if($r['status'] == 1){  $fetSliderStat = 'icon-check'; $fetSliderRolCol = 'btn-success'; $fetSliderRolTit = "De-activate Slider";}
                $multiActionBox = '<input type="checkbox" class="multi-action-box" data-id="'.$r['id'].'" data-image="'.$r['image'].'" data-orders="'.$r['orders'].'"  data-status="'.$r['status'].'" />';
                $result[] = array(utf8_encode($multiActionBox), $r['id'], utf8_encode(' <button data-id="'.$r['id'].'" data-title="'.$r['title'].'" data-image="'.$r['image'].'" data-orders="'.$r['orders'].'" class="btn btn-danger btn-sm delete-slider" title="Delete"><i class="btn-icon-only icon-trash"> </i></button> <button data-id="'.$r['id'].'" data-title="'.$r['title'].'" data-image="'.$r['image'].'" data-orders="'.$r['orders'].'" data-status="'.$r['status'].'" class="btn btn-info btn-sm edit-slider"  title="Edit"><i class="btn-icon-only icon-pencil"> </i> <span id="JQDTcontentholder" data-content="" class="hidden">'.$r['content'].'</span> </button> <button data-id="'.$r['id'].'" data-title="'.$r['title'].'" data-image="'.$r['image'].'" data-status="'.$r['status'].'"  class="btn '.$fetSliderRolCol.' btn-sm activate-slider"  title="'.$fetSliderRolTit.'"><i class="btn-icon-only '.$fetSliderStat.'"> </i></button>'), StringManipulator::trimStringToFullWord(80, utf8_encode(stripslashes(strip_tags($r['title'])))), StringManipulator::trimStringToFullWord(250, utf8_encode(stripslashes(strip_tags($r['content'])))), utf8_encode('<img src="../media/slider/'.utf8_encode($r['image']).'" style="width:60px; height:50px;" alt="Pix">'), StringManipulator::trimStringToFullWord(40, utf8_encode(stripslashes(strip_tags($r['orders'])))));//
            }
            $json = array("status" => 1,"draw" => intval($draw), "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $result);
        } 
        else{ $json = array("status" => 2, "msg" => "Necessary parameters not set. Or empty result. ".mysqli_error(self::$dbObj->connection), "draw" => intval($draw),  "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => false); }
        self::$dbObj->close();
        header('Content-type: application/json');
        return json_encode($json);
    }
    
    /** Method that update details of a slider
     * @return JSON JSON encoded success or failure message
     */
    public function update() {
        $sql = "UPDATE ".self::$tableName." SET title = '{$this->title}', content = '{$this->content}', image = '{$this->image}', orders = '{$this->orders}' WHERE id = $this->id ";
        if(!empty($this->id)){
            $result = self::$dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, slider successfully update!"); }
            else{ $json = array("status" => 2, "msg" => "Error updating slider! ".  mysqli_error(self::$dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        self::$dbObj->close();
        header('Content-type: application/json');
        return json_encode($json); 
    }
    
    /** Method that update single field detail of a slider
     * @param string $field Column to be updated 
     * @param string $value New value of $field (Column to be updated)
     * @param int $id Id of the post to be updated
     * @return JSON JSON encoded success or failure message
     */
    public static function updateSingle($dbObj, $field, $value, $id){
        $sql = "UPDATE ".self::$tableName." SET $field = '{$value}' WHERE id = $id ";
        if(!empty($id)){
            $result = $dbObj->query($sql);
            if($result !== false){ $json = array("status" => 1, "msg" => "Done, slider successfully update!"); }
            else{ $json = array("status" => 2, "msg" => "Error updating slider! ".  mysqli_error($dbObj->connection));   }
        }
        else{ $json = array("status" => 3, "msg" => "Request method not accepted."); }
        $dbObj->close();
        header('Content-type: application/json');
        echo json_encode($json);
    }
    
    /** Empty string checker  */
    public function notEmpty() {
        foreach (func_get_args() as $arg) {
            if (empty($arg)) { return false; } 
            else {continue; }
        }
        return true;
    }
    
    /** getSingle() fetches the name of a slider using the slider $id
     * @param object $dbObj Database connectivity and manipulation object
     * @param int $column Requested column from the database
     * @param int $id Slider id of the slider whose name is to be fetched
     * @return string Name of the slider
     */
    public static function getSingle($dbObj, $column, $id) {
        $thisSliderName = '';
        $thisSliderNames = $dbObj->fetchNum("SELECT $column FROM ".self::$tableName." WHERE id = '{$id}' LIMIT 1");
        foreach ($thisSliderNames as $thisSliderNames) { $thisSliderName = $thisSliderNames[0]; }
        return $thisSliderName;
    }
}