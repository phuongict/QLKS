<?php
class AdminUserModel extends Model {

    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = _admin_page_limit;
        $sql="select taikhoan.id,ten_dang_nhap,email,ho_dem,ten,so_dien_thoai,gioi_tinh,dia_chi,diem_tich_luy,nhomtaikhoan.ten_nhom 
          from taikhoan,nhomtaikhoan
          where taikhoan.id_nhom_tai_khoan = nhomtaikhoan.id ORDER BY id DESC LIMIT $params,$limit";
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
    public function loadGroupList($params = null)
    {
        $limit = _admin_page_limit;
        $sql="select * from nhomtaikhoan ORDER BY id DESC LIMIT $params,$limit";
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
    public function loadFuncList($params = null)
    {
        $limit = _admin_page_limit;
        $sql="select * from chucnang ORDER BY id DESC LIMIT $params,$limit";
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