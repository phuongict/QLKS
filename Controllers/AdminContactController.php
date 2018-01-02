<?php
class AdminContactController extends Controller{
    public function listAction(){
        $contactModel = new AdminContactModel();
        $total_records = $contactModel->countRecord('lienhe');
        $pagination = parent::Pagination($total_records);
        $offset = $pagination['offset'];
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $contactModel->loadList($offset);
        $this->view['list']  = $list;
        $this->view['total_pages'] = $pagination['total_pages'];
    }

}