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
    public function listHotel(){
        $sql = "select id,ten_khach_san from khachsan";
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
    public function insertRoom($params = null){
        $ten = addslashes($params['ten_phong']);
        $mo_ta = addslashes($params['mo_ta']);
        $thiet_bi = addslashes($params['thiet_bi']);
        $so_giuong = $params['so_giuong'];
        $so_nguoi = $params['so_nguoi'];
        $dien_tich = addslashes($params['dien_tich']);
        $gia = $params['gia'];
        $gia_km = $params['gia_km'];
        $khach_san = $params['khach_san'];
        $hinh_anh = addslashes($params['hinh_anh']);
        $sql = "INSERT INTO phong (ten_phong,gia,giam_gia,id_khach_san,so_giuong,hinh_anh,so_nguoi,dien_tich,thiet_bi,mo_ta) VALUES ('$ten','$gia','$gia_km',$khach_san,$so_giuong,'$hinh_anh',$so_nguoi,'$dien_tich','$thiet_bi','$mo_ta')";
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


    public function loadOne($id)
    {
        // TODO: Implement loadOne() method.
        $sql = "select phong.id,ten_phong,gia,giam_gia,id_khach_san,so_giuong,phong.hinh_anh,so_nguoi,dien_tich,thiet_bi,phong.mo_ta,ten_khach_san
          from phong,khachsan
          where phong.id_khach_san = khachsan.id and phong.id = $id";
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
        $ten = addslashes($params['ten_phong']);
        $mo_ta = addslashes($params['mo_ta']);
        $thiet_bi = addslashes($params['thiet_bi']);
        $so_giuong = $params['so_giuong'];
        $so_nguoi = $params['so_nguoi'];
        $dien_tich = addslashes($params['dien_tich']);
        $gia = $params['gia'];
        $gia_km = $params['gia_km'];
        $khach_san = $params['khach_san'];
        $id = $params['id'];
        if(empty($params['hinh_anh'])){
            $hinh_anh = '';
        }
        else{
            $hinh_anh = ",hinh_anh = '".$params['hinh_anh']."'";
        }
        $sql = "update phong set ten_phong = '$ten',gia = $gia,giam_gia = $gia_km,id_khach_san = $khach_san,so_giuong = $so_giuong $hinh_anh,so_nguoi = $so_nguoi,dien_tich = '$dien_tich',thiet_bi = '$thiet_bi',mo_ta = '$mo_ta'
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