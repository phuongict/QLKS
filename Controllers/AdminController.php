<?php
class AdminController extends Controller{
    public function indexAction(){
        $this->view['msg'] ="Đây là nội dung gán trong controller";
        $this->layout['abc'] ="Nội dung truyền ra layout";
    }
    public function loginAction(){
        $this->view['msg'] ="Đây là nội dung gán trong controller";
        $this->layout['abc'] ="Nội dung truyền ra layout";
    }
    public function listAction(){
        $md = new DemoModel();
        $list = $md->loadList();
        $this->view['list'] = $list;

    }

}