<?php
class AdminContactController extends Controller{
    public function listAction(){
        $contactModel = new AdminContactModel();
        $total_records = $contactModel->countRecord('lienhe');
        $offset = parent::Pagination($total_records);
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $contactModel->loadList($offset);
        $this->view['list']  = $list;
    }

}