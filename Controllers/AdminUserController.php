<?php
class AdminUserController extends Controller{
    public function listAction(){
        $userModel = new AdminUserModel();
        $total_records = $userModel->countRecord('taikhoan');
        $pagination = parent::Pagination($total_records);
        $offset = $pagination['offset'];
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $userModel->loadList($offset);
        $this->view['list']  = $list;
        $this->view['total_pages'] = $pagination['total_pages'];
    }
    public function listGroupAction(){
        $GroupModel = new AdminUserModel();
        $total_records = $GroupModel->countRecord('nhomtaikhoan');
        $pagination = parent::Pagination($total_records);
        $offset = $pagination['offset'];
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $GroupModel->loadGroupList($offset);
        $this->view['list']  = $list;
        $this->view['total_pages'] = $pagination['total_pages'];
    }
    public function listFuncAction(){
        $funcModel = new AdminUserModel();
        $total_records = $funcModel->countRecord('chucnang');
        $pagination = parent::Pagination($total_records);
        $offset = $pagination['offset'];
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $funcModel->loadFuncList($offset);
        $this->view['list']  = $list;
        $this->view['total_pages'] = $pagination['total_pages'];
    }
}