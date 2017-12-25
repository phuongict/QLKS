<?php
class AdminRoomController extends Controller{
    public function listAction(){
        $roomModel = new AdminRoomModel();
        $total_records = $roomModel->countRecord('phong');
        $offset = parent::Pagination($total_records);
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $roomModel->loadList($offset);
        $this->view['list']  = $list;
    }
    public function listOrderAction(){
        $orderModel = new AdminRoomModel();
        $total_records = $orderModel->countRecord('dondatphong');
        $offset = parent::Pagination($total_records);
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $orderModel->loadListOrder($offset);
        $this->view['list']  = $list;
    }
}