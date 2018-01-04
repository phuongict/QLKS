<?php
class AdminArticleModel extends Model {

    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = _admin_page_limit;
        $sql="select baiviet.id,tieu_de,noi_dung,ngay_dang,baiviet.hinh_anh,ten_danh_muc,id_danh_muc,ten_dang_nhap
          from baiviet,danhmucbaiviet,taikhoan
          where baiviet.id_danh_muc = danhmucbaiviet.id and baiviet.id_tai_khoan = taikhoan.id ORDER BY id DESC LIMIT $params,$limit";
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
    public function listCategory(){
        $sql = "select id,ten_danh_muc from danhmucbaiviet";
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
        mysqli_free_result($res);
    }
    public function insertArticle($params = null){
        $tieu_de = addslashes($params['tieu_de']);
        $noi_dung = addslashes($params['noi_dung']);
        $danh_muc = $params['danh_muc'];
        $ngay_dang = $params['ngay_dang'];
        $hinh_anh = addslashes($params['hinh_anh']);
        $tai_khoan = $params['tai_khoan'];
        $sql = "INSERT INTO baiviet (tieu_de, noi_dung,ngay_dang,hinh_anh, id_danh_muc,id_tai_khoan) VALUES ('$tieu_de', '$noi_dung','$ngay_dang','$hinh_anh', '$danh_muc',$tai_khoan)";
        $res = mysqli_query($this->conn,$sql);
        if($res === false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }
        else {
            return true;
        }
    }
    //category
    public function insertCategoryArticle($params = null){
        $ten_danh_muc = addslashes($params['ten_danh_muc']);
        $mo_ta = addslashes($params['mo_ta']);
        $hinh_anh = addslashes($params['hinh_anh']);
        $sql = "INSERT INTO danhmucbaiviet (ten_danh_muc, mo_ta,hinh_anh) VALUES ('$ten_danh_muc', '$mo_ta','$hinh_anh')";
        $res = mysqli_query($this->conn,$sql);
        if($res === false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }
        else {
            return true;
        }
    }
    public function count($params = null)
    {
        // TODO: Implement count() method.
    }

    public function loadOneCategory($id)
    {
        // TODO: Implement loadOne() method.
        $sql = "select * from danhmucbaiviet where id = $id";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            return 'Lỗi truy vấn: '.mysqli_error($this->conn);
        }
        $row = mysqli_fetch_assoc($res);
        if($row == null){
            return 'Không tìm thấy bản ghi nào';
        }
        return $row;
        mysqli_free_result($res);
    }
    public function updateCategory($params = null){
        $ten_danh_muc = addslashes($params['ten_danh_muc']);
        $mo_ta = addslashes($params['mo_ta']);
        $id = $params['id'];
        if(empty($params['hinh_anh'])){
            $hinh_anh = '';
        }
        else{
            $hinh_anh = ",hinh_anh = '".$params['hinh_anh']."'";
        }
        $sql = "update danhmucbaiviet set ten_danh_muc = '$ten_danh_muc',mo_ta = '$mo_ta' $hinh_anh
                where id = $id";
        $res = mysqli_query($this->conn,$sql);
        if($res === false){
            return "Lỗi Update: ". mysqli_error($this->conn);
        }
        else {
            return true;
        }
    }
    // bài viết
    public function loadOne($id)
    {
        // TODO: Implement loadOne() method.
        $sql = "select baiviet.id,tieu_de, noi_dung,baiviet.hinh_anh, id_danh_muc, ten_danh_muc
          from baiviet,danhmucbaiviet
          where baiviet.id_danh_muc = danhmucbaiviet.id and baiviet.id = $id";
        $res = mysqli_query($this->conn, $sql);
        if($res === false){
            return 'Lỗi truy vấn: '.mysqli_error($this->conn);
        }
        $row = mysqli_fetch_assoc($res);
        if($row == null){
            return 'Không tìm thấy bản ghi nào';
        }
        return $row;
        mysqli_free_result($res);
    }
    public function update($params = null){
        $tieu_de = addslashes($params['tieu_de']);
        $noi_dung = addslashes($params['noi_dung']);
        $danh_muc = $params['danh_muc'];
        $ngay_cap_nhat = $params['ngay_cap_nhat'];
        $id = $params['id'];
        if(empty($params['hinh_anh'])){
            $hinh_anh = '';
        }
        else{
            $hinh_anh = ",hinh_anh = '".$params['hinh_anh']."'";
        }
        $sql = "update baiviet set tieu_de = '$tieu_de',noi_dung = '$noi_dung',id_danh_muc = $danh_muc,ngay_cap_nhat = '$ngay_cap_nhat' $hinh_anh
                where id = $id";
        $res = mysqli_query($this->conn,$sql);
        if($res === false){
            return "Lỗi Update: ". mysqli_error($this->conn);
        }
        else {
            return true;
        }
    }
}