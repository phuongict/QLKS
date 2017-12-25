<?php
class AdminArticleController extends Controller{
    public function listAction(){
        $articleModel = new AdminArticleModel();
        $total_records = $articleModel->countRecord('baiviet');
        $offset = parent::Pagination($total_records);
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $articleModel->loadList($offset);
        $this->view['list']  = $list;
    }
    public function listCategoryAction(){
        $categoryModel = new AdminArticleModel();
        $total_records = $categoryModel->countRecord('danhmucbaiviet');
        $offset = parent::Pagination($total_records);
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $categoryModel->loadListCategory($offset);
        $this->view['list']  = $list;
    }
}