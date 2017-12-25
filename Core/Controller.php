<?php
/**
 * Created by sonmobi@gmail.com
 * Date: 12/3/2017
 * Time: 11:19 PM
 */
class  Controller{
    protected $view = array();
    protected $layout = array();
    public $currentAction;
    public $currentController;
    public $offset;
    private function showContent(){

        require_once app_path.'/Views/'.strtolower($this->currentController).'/'.strtolower($this->currentAction).'.phtml';
        //hàm strtolower có tác dụng chuyển toàn bộ chuỗi thành chữ thường
    }

    public  function renderLayout(){
        $checkController = substr($this->currentController, 0,5); // nó vừa hiển thị string trước. Lấy ra 5 ký tự đầu của chuỗi
        if(strtolower($checkController) =='admin'){
            // chuyển hết về chữ thường (phòng trường hợp người dùng nhập không đúng)
            //người dùng vào phần backend
            if(file_exists(layout_path.'/admin.phtml'))
                require_once layout_path.'/admin.phtml';
            else{
                echo '<b>Layout admin not found! </b>';
                exit();
            }

        }else{
            // không phải người dùng gọi controller admin
            if(file_exists(layout_path.'/master.phtml'))
                require_once layout_path.'/master.phtml';
            else{
                echo '<b>Layout public not found! </b>';
                exit();
            }
        }
    }
    public function Pagination($total_records){
        if(!is_numeric($total_records)){
            return false;
        }
        $total_pages = ceil($total_records/_admin_page_limit);
        if($total_pages<1){
            return false;
        }
        $current_page = @intval($_GET['page']);
        if ($current_page < 1)
            $current_page = 1;
        if ($current_page > $total_pages)
            $current_page = $total_pages;
        return  $this->offset =  ($current_page - 1) * _admin_page_limit;
    }

    public function validateUsername ($string){
        $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
        if ( !preg_match($partten, $string) ){
            return "Tên đăng nhập phải là ký tự số hoặc chữ cái từ 6 đến 30 ký tự!";
        }
        return true;
    }
    public function getNameImg(){
        $file_uploaded = $_FILES['txt_hinh_anh'];
        $file_type = array();
        $file_tmp = array();
        $file_name = array();
        $array_type = array('image/jpeg','image/jpg','image/gif','image/bmp','image/png');
        foreach ($file_uploaded['type'] as $value) {
            $file_type[] = $value;
        }
        foreach ($file_uploaded['tmp_name'] as $value) {
            $file_tmp[] = $value;
        }
        foreach ($file_uploaded['name'] as $value) {
            $file_name[] = $value;
        }
        //kiểm tra kiểu file trước
        for($i=0;$i<count($file_type);$i++){
            if(!in_array($file_type[$i],$array_type))
            {
                echo '<meta charset="utf-8"><b>Cần upload file có dạng jpg,png,gif hoạc bmp</b>';
                echo '<script>function goback() {history.back(-1)}</script>';
                echo "<a href='javascript:goback()'>Quay lại</a>";
                return;
            }
        }
        //chuyển file vào mục

        for($i=0;$i<count($file_type);$i++){
            if (!file_exists(template_url.'images/img-hotel'))//kiểm tra và tạo thư mục hinh-anh
            {
                mkdir(template_url.'images/img-hotel');
            }
            move_uploaded_file($file_tmp[$i], template_url.'images/img-hotel/'.$file_name[$i]);
        }
//        return $name_img = implode(' ',$file_name);
        return serialize($file_name);
    }


}