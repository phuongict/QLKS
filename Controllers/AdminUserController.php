<?php
class AdminUserController extends Controller{
    public function listAction(){
        $userModel = new AdminUserModel();
        $total_records = $userModel->countRecord('taikhoan');
        $offset = parent::Pagination($total_records);
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $userModel->loadList($offset);
        $this->view['list']  = $list;
    }
    public function listGroupAction(){
        $GroupModel = new AdminUserModel();
        $total_records = $GroupModel->countRecord('nhomtaikhoan');
        $offset = parent::Pagination($total_records);
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $GroupModel->loadGroupList($offset);
        $this->view['list']  = $list;
    }
    public function listFuncAction(){
        $funcModel = new AdminUserModel();
        $total_records = $funcModel->countRecord('chucnang');
        $offset = parent::Pagination($total_records);
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $funcModel->loadFuncList($offset);
        $this->view['list']  = $list;
    }
}