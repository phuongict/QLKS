<?php
class AdminHotelController extends Controller{
    public function listAction(){
        $hotelModel = new AdminHotelModel();
        $total_records = $hotelModel->countRecord('khachsan');
        $offset = parent::Pagination($total_records);
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $hotelModel->loadList($offset);
        $this->view['list']  = $list;
    }
    public function addAction(){
        $user = new AdminHotelModel();
        $list = $user->listUser();
        if(is_array($list)){
            $this->view['list-user']  = $list;
        }
        else{
            return $this->view['msg'] = $list;
        }
        if(isset($_POST['btnSave'])){
            $data = array();
            $data['ten_khach_san'] = $_POST['txt_ten_ks'];
            $data['dia_chi'] = $_POST['txt_dia_chi'];
            $data['email'] = $_POST['txt_email'];
            $data['sdt'] = $_POST['txt_dien_thoai'];
            $data['mo_ta'] = $_POST['txt_mo_ta'];
            $data['thong_tin'] = $_POST['txt_thong_tin'];
            $data['tai_khoan'] = $_POST['txt_tai_khoan'];
            $data['hinh_anh'] = parent::getNameImg();
            $res = $user->insertHotel($data);
            if($res === true){
                $this->view['msg'] = "Thêm khách sạn thành công!";
            }
            else
                $this->view['msg'] = $res;
        }

    }
}