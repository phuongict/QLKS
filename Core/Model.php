<?php
/**
 * Created by sonmobi@gmail.com
 * Date: 12/8/2017
 * Time: 12:45 AM
 */
abstract class Model{

    protected $conn = null;
    public function __construct()
    {
        if(empty($this->conn)){
            require_once app_path.'/Config/connect_db.php';
            $this->conn = $GLOBALS['conn'];
//            $this->conn = $conn;
            unset($GLOBALS['conn']);
        }
    }
    public function countRecord($table){
            $sql = "SELECT COUNT(id) FROM $table";
            $res = mysqli_query($this->conn, $sql);
            if(mysqli_errno($this->conn)){
                return "Lỗi đếm bản ghi: ". mysqli_error($this->conn);
            }
            $row = mysqli_fetch_row($res);
            $tong =  intval($row[0]);
            return $tong;
    }
    abstract public function loadList($params = null);
    abstract public function count($params = null);
    abstract public function loadOne($id);


}