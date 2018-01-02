<?php
class AdminHotelController extends Controller{
    public function listAction(){
        $hotelModel = new AdminHotelModel();
        $total_records = $hotelModel->countRecord('khachsan');
        $pagination = parent::Pagination($total_records);
        $offset = $pagination['offset'];
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $hotelModel->loadList($offset);
        $this->view['list']  = $list;
        $this->view['total_pages'] = $pagination['total_pages'];
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
            $data['hinh_anh'] = parent::getNameImg('img-hotel');
            $res = $user->insertHotel($data);
            if($res === true){
                 $this->view['msg'] = "Thêm khách sạn thành công!";
            }
            else
                $this->view['msg'] = $res;
        }
    }
    public function editAction(){
        $loadOne = new AdminHotelModel();
        $anh = null;
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
            if(!is_numeric($id)){
                return $this->view['msg'][] = "ID khách sạn không đúng";
            }
            $res = $loadOne->loadOne($id);
            if(is_array($res)){
                $this->view['data'] = $res;
                $anh = $res['hinh_anh'];
            }
            else{
                return $this->view['msg'][] = $res;
            }
            //update
            if(isset($_POST['btnSave'])){
                $data = array();
                $data['id'] = $id;
                $data['ten_khach_san'] = $_POST['txt_ten_ks'];
                $data['dia_chi'] = $_POST['txt_dia_chi'];
                $data['email'] = $_POST['txt_email'];
                $data['sdt'] = $_POST['txt_dien_thoai'];
                $data['mo_ta'] = $_POST['txt_mo_ta'];
                $data['thong_tin'] = $_POST['txt_thong_tin'];
                $data['tai_khoan'] = $_POST['txt_tai_khoan'];
                //nếu số lỗi mà khác 0 thì để rỗng không gọi hàm lấy ảnh
                if($_FILES['txt_hinh_anh']['error'][0] !== 0){
                    $data['hinh_anh'] = $anh;
                }
                else {
                    $data['hinh_anh'] = parent::getNameImg('img-hotel');
                }
//            $data['hinh_anh'] = parent::getNameImg();
                $res2 = $loadOne->update($data);
                if($res2 === true){
                    $this->view['msg'][] = "Cập nhật khách sạn thành công!";
                    $this->view['data']['ten_khach_san'] =  $data['ten_khach_san'];
                    $this->view['data']['dia_chi'] = $data['dia_chi'];
                    $this->view['data']['so_dien_thoai'] = $data['sdt'];
                    $this->view['data']['email'] = $data['email'];
                    $this->view['data']['mo_ta'] = $data['mo_ta'];
                    $this->view['data']['thong_tin'] = $data['thong_tin'];
                    $this->view['data']['id_tai_khoan'] = $data['tai_khoan'];
                    $this->view['data']['hinh_anh'] = $data['hinh_anh'];
                    $res3 = $loadOne->select('taikhoan',$data['tai_khoan']);
                    if(is_array($res3)){
                        $this->view['data']['ten_dang_nhap'] = $res3['ten_dang_nhap'];
                    }
                    else
                        $this->view['data']['ten_dang_nhap'] = $res3;
                }
                else
                    $this->view['msg'][] = $res2;
            }
        }
        else{
            $this->view['msg'][] = "Không tìm thấy id khách sạn";
        }


        //lấy danh sách user
        $list = $loadOne->listUser();
        if(is_array($list)){
            $this->view['list-user']  = $list;
        }
        else{
            return $this->view['msg'][] = $list;
        }
    }
    public function deleteAction(){
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
            if(!is_numeric($id)){
                $this->view['msg'] = "id khách sạn không đúng";
                $this->view['flag'] = true;
                return $this->view;
            }
            $delete = new AdminHotelModel();
            $res = $delete->select('khachsan',$id);
            if(is_array($res)){
                $this->view['data'] = $res;
            }
            else{
                $this->view['msg'] = $res;
                $this->view['flag'] = true;
                return $this->view;
            }
            if(isset($_POST['btnDelete'])){
                $id_ks = $_POST['id_khach_san'];
                if($id_ks !== $id){
                    return 'ID không đúng';
                }
                $res2 = $delete->delete('khachsan',$id_ks);
                if($res2 === true){
                    $this->view['msg'] = 'Xóa thành công!';
                    $this->view['flag'] = true;
                }
                else{
                    $this->view['msg'] = $res2;
                }
            }
        }
        else{
            $this->view['msg'] = 'Không tìm thấy id khách sạn';
            $this->view['flag'] = true;
            return $this->view;
        }
    }
}