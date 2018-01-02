<?php

class AdminRoomController extends Controller
{
    public function addAction()
    {
        $hotel = new AdminRoomModel();
        $list  = $hotel->listHotel();
        if (is_array($list)) {
            $this->view['list-hotel'] = $list;
        } else {
            return $this->view['msg'] = $list;
        }
        if (isset($_POST['btnSave'])) {
            $data              = array();
            $data['ten_phong'] = $_POST['txt_ten_phong'];
            $data['mo_ta']     = $_POST['txt_mo_ta'];
            $data['thiet_bi']  = $_POST['txt_thiet_bi'];
            $data['so_giuong'] = $_POST['txt_so_giuong'];
            $data['so_nguoi']  = $_POST['txt_so_nguoi'];
            $data['dien_tich'] = $_POST['txt_dien_tich'];
            $data['gia']       = $_POST['txt_gia'];
            $data['gia_km']    = $_POST['txt_gia_km'];
            $data['khach_san'] = $_POST['txt_khach_san'];
            $data['hinh_anh']  = parent::getNameImg('img-room');
            $res               = $hotel->insertRoom($data);
            if ($res === true) {
                $this->view['msg'] = "Thêm phòng thành công!";
            } else
                $this->view['msg'] = $res;
        }
    }

    public function editAction()
    {
        $loadOne = new AdminRoomModel();
        $anh     = null;
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                return $this->view['msg'][] = "ID phòng không đúng";
            }
            $res = $loadOne->loadOne($id);
            if (is_array($res)) {
                $this->view['data'] = $res;
                $anh                = $res['hinh_anh'];
            } else {
                return $this->view['msg'][] = $res;
            }
            //update
            if (isset($_POST['btnSave'])) {
                $data              = array();
                $data['id'] = $id;
                $data['ten_phong'] = $_POST['txt_ten_phong'];
                $data['mo_ta']     = $_POST['txt_mo_ta'];
                $data['thiet_bi']  = $_POST['txt_thiet_bi'];
                $data['so_giuong'] = $_POST['txt_so_giuong'];
                $data['so_nguoi']  = $_POST['txt_so_nguoi'];
                $data['dien_tich'] = $_POST['txt_dien_tich'];
                $data['gia']       = $_POST['txt_gia'];
                $data['gia_km']    = $_POST['txt_gia_km'];
                $data['khach_san'] = $_POST['txt_khach_san'];
                //nếu số lỗi mà khác 0 thì để rỗng không gọi hàm lấy ảnh
                if ($_FILES['txt_hinh_anh']['error'][0] !== 0) {
                    $data['hinh_anh'] = $anh;
                } else {
                    $data['hinh_anh'] = parent::getNameImg('img-room');
                }
                $res2 = $loadOne->update($data);
                if ($res2 === true) {
                    $this->view['msg'][]                 = "Cập nhật phòng thành công!";
                    $this->view['data']['ten_phong'] = $data['ten_phong'];
                    $this->view['data']['gia']       = $data['gia'];
                    $this->view['data']['giam_gia'] = $data['gia_km'];
                    $this->view['data']['id_khach_san']         = $data['khach_san'];
                    $this->view['data']['so_giuong']         = $data['so_giuong'];
                    $this->view['data']['hinh_anh']     = $data['hinh_anh'];
                    $this->view['data']['so_nguoi']  = $data['so_nguoi'];
                    $this->view['data']['dien_tich']      = $data['dien_tich'];
                    $this->view['data']['thiet_bi']      = $data['thiet_bi'];
                    $this->view['data']['mo_ta']      = $data['mo_ta'];
                    $res3                                = $loadOne->select('khachsan', $data['khach_san']);
                    if (is_array($res3)) {
                        $this->view['data']['ten_khach_san'] = $res3['ten_khach_san'];
                    } else
                        $this->view['data']['ten_khach_san'] = $res3;
                } else
                    $this->view['msg'][] = $res2;
            }
        } else {
            $this->view['msg'][] = "Không tìm thấy id phòng";
        }
        //lấy danh sách hotel
        $list = $loadOne->listHotel();
        if (is_array($list)) {
            $this->view['list-hotel'] = $list;
        } else {
            return $this->view['msg'][] = $list;
        }
    }

    public function listAction()
    {
        $roomModel     = new AdminRoomModel();
        $total_records = $roomModel->countRecord('phong');
        $pagination    = parent::Pagination($total_records);
        $offset        = $pagination['offset'];
        if ($offset === false) {
            $this->view['msg'] = "Lỗi lấy dữ liệu";
        }
        $list                      = $roomModel->loadList($offset);
        $this->view['list']        = $list;
        $this->view['total_pages'] = $pagination['total_pages'];
    }

    public function listOrderAction()
    {
        $orderModel    = new AdminRoomModel();
        $total_records = $orderModel->countRecord('dondatphong');
        $pagination    = parent::Pagination($total_records);
        $offset        = $pagination['offset'];
        if ($offset === false) {
            $this->view['msg'] = "Lỗi lấy dữ liệu";
        }
        $list                      = $orderModel->loadListOrder($offset);
        $this->view['list']        = $list;
        $this->view['total_pages'] = $pagination['total_pages'];
    }
    public function deleteAction(){
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
            if(!is_numeric($id)){
                $this->view['msg'] = "id khách sạn không đúng";
                $this->view['flag'] = true;
                return $this->view;
            }
            $delete = new AdminRoomModel();
            $res = $delete->select('phong',$id);
            if(is_array($res)){
                $this->view['data'] = $res;
            }
            else{
                $this->view['msg'] = $res;
                $this->view['flag'] = true;
                return $this->view;
            }
            if(isset($_POST['btnDelete'])){
                $id_ks = $_POST['id_phong'];
                if($id_ks !== $id){
                    return 'ID không đúng';
                }
                $res2 = $delete->delete('phong',$id_ks);
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
            $this->view['msg'] = 'Không tìm thấy id phòng';
            $this->view['flag'] = true;
            return $this->view;
        }
    }

}