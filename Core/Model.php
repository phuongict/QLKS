<?php
abstract class Model{

    protected $conn = null;
    public function __construct()
    {
        if(empty($this->conn)){
            $conn = null;
            require app_path.'/Config/connect_db.php';
            $this->conn = $conn;
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
    public function select($table,$id){
        $sql = "select * from $table WHERE id = $id";
        $res = mysqli_query($this->conn,$sql);
        if($res === false){
            return 'Lỗi lấy dữ liệu'.mysqli_error($this->conn);
        }
        else
            $row = mysqli_fetch_assoc($res);
        if($row == null){
            return 'Không có bản ghi nào';
        }
        return $row;
        mysqli_free_result($res);
    }
    public function delete($table,$id){
        $sql = "delete from $table where id = $id LIMIT 1";
        $res = mysqli_query($this->conn,$sql);
        if($res === false){
            return 'Không thể xóa: '.mysqli_error($this->conn);
        }
        return true;
    }
    abstract public function loadList($params = null);
    abstract public function count($params = null);
    abstract public function loadOne($id);


}