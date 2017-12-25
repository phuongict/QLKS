<?php
class AdminRoomModel extends Model {

    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = _admin_page_limit;
        $sql="select phong.id,ten_phong,gia,giam_gia,trang_thai,id_khach_san,ten_khach_san,trang_thai_dang
          from phong,khachsan
          where phong.id_khach_san = khachsan.id ORDER BY id DESC LIMIT $params,$limit";
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
    public function loadListOrder($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = _admin_page_limit;
        $sql="select dondatphong.id,ngay_dat,dondatphong.trang_thai,ngay_nhan,ngay_tra,ghi_chu,dondatphong.ho_dem,dondatphong.ten,dondatphong.so_dien_thoai,id_phong,ten_phong,ten_dang_nhap,id_tai_khoan
          from phong,dondatphong,taikhoan
          where dondatphong.id_phong = phong.id and dondatphong.id_tai_khoan = taikhoan.id ORDER BY id DESC LIMIT $params,$limit";
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