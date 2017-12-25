<?php
class AdminHotelModel extends Model {

    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
        $limit = _admin_page_limit;
        $sql="select khachsan.id,ten_khach_san,khachsan.dia_chi,khachsan.so_dien_thoai,khachsan.email,mo_ta,thong_tin,id_tai_khoan,taikhoan.ten_dang_nhap 
          from taikhoan,khachsan
          where khachsan.id_tai_khoan = taikhoan.id ORDER BY id DESC LIMIT $params,$limit";
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
    public function listUser(){
        $sql = "select id,ten_dang_nhap from taikhoan";
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
    public function insertHotel($params = null){
        $ten = addslashes($params['ten_khach_san']);
        $dia_chi = addslashes($params['dia_chi']);
        $email = $params['email'];
        $sdt = $params['sdt'];
        $mo_ta = addslashes($params['mo_ta']);
        $thong_tin = addslashes($params['thong_tin']);
        $tai_khoan = $params['tai_khoan'];
        $hinh_anh = $params['hinh_anh'];
        $sql = "INSERT INTO khachsan (ten_khach_san, dia_chi, so_dien_thoai, email, mo_ta, thong_tin, id_tai_khoan, hinh_anh) VALUES ('$ten','$dia_chi','$sdt','$email','$mo_ta','$thong_tin',$tai_khoan,'$hinh_anh')";
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
    }
}