<?php
class AdminArticleModel extends Model {

    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = _admin_page_limit;
        $sql="select baiviet.id,tieu_de,noi_dung,ngay_dang,baiviet.hinh_anh,ten_danh_muc,id_danh_muc
          from baiviet,danhmucbaiviet
          where baiviet.id_danh_muc = danhmucbaiviet.id ORDER BY id DESC LIMIT $params,$limit";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Error load list: '. mysqli_error($this->conn);
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        return $data;
    }
    public function loadListCategory($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = _admin_page_limit;
        $sql="select * from danhmucbaiviet ORDER BY id DESC LIMIT $params,$limit";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            // có lỗi
            return 'Error load list: '. mysqli_error($this->conn);
        }
        $data = array();
        while ($row = mysqli_fetch_assoc($res)){
            $data[] = $row;
        }
        return $data;
    }
    public function count($params = null)
    {
        // TODO: Implement count() method.
    }


    public function loadOne($id)
    {
        // TODO: Implement loadOne() method.
    }
}