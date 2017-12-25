<?php
/**
 * Created by sonmobi@gmail.com
 * Date: 12/3/2017
 * Time: 11:19 PM
 */

function __autoload($className){
    // Nếu 1 class được gọi bởi từ khóa new không tồn tại

    // thứ tự: ưu tiên controller trước, model, các file khác
    //1. Kiểm tra có file file là controller không?
    $file_path = controller_path.'/'.$className.'.php';
    if(file_exists($file_path)) require_once  $file_path;
    else{
        //2. kiểm tra đến model
        $file_path = model_path.'/'.$className.'.php';
        if(file_exists($file_path)) require_once $file_path;
        else{
            // kiểm tra thư mục core
            $file_path = __DIR__.'/'.$className.'.php';
            if(file_exists($file_path)) require_once $file_path;
            else{
                die("Class name <b>$className</b> not found!");
            }

        }

    }

}

class MyMVC{

    public function run(){
        //2. Lấy tham số truyền vào
        $controller = isset($_GET['controller'])?$_GET['controller']:'index'; //mặc định là index
        $action = isset($_GET['action'])?$_GET['action']:'index';
        $GLOBALS['current_action'] = $action;
        $GLOBALS['current_controller'] = $controller;
/*
        if(!$this->CheckAcl($controller,$action)){
            echo '<b>Ban khong co quyen su dung chuc nang nay</b>';
            echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
            print_r($_SESSION);
            echo '</pre>';
            exit();
        }

*/
        $controllerClass = $this->convertUpperActionAndControllerName($controller).'Controller';
        $action_name = lcfirst($this->convertUpperActionAndControllerName($action)).'Action';

        $objController = new $controllerClass(); //tạo mới obj controller


        if(!method_exists($objController,$action_name)){
            die("Action <b>$action</b> not found!");
        }
        $objController->currentAction = $action;
        $objController->currentController = $controller;
        $objController->$action_name(); //chạy action
//        $objController->renderView();

        $objController->renderLayout();



    }

    function CheckAcl($controller,$action){

        $str_check = $controller.'_'.$action;
        //luôn luôn cho public action này
        $default_allow = array('index_index','index_login','index_logout','index_list','demo_index','demo_list');

        if(in_array($str_check,$default_allow))
            return true;


        if(empty($_SESSION['auth'])){
            return false;
        }


        if(empty($_SESSION['auth']['permission_allow'])){

            $id_nhom_tai_khoan = $_SESSION['auth']['id_nhom_tai_khoan'];

            $sql_check_acl ="SELECT * FROM quyen INNER JOIN chucnang ON quyen.id_chuc_nang = chucnang.id WHERE quyen.id_nhom_tai_khoan =  $id_nhom_tai_khoan AND quyen.trang_thai=1 ";
            $res = mysqli_query($GLOBALS['conn'],$sql_check_acl);

            $auth = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $auth[] = $row['link'];
            }
            $_SESSION['auth']['permission_allow'] = $auth;
        }

        //check acl

        if(in_array($str_check,$_SESSION['auth']['permission_allow'])){
            return true;
        }else
            return false;

    }

    /**
     * Hàm này chuyển chuỗi tham số thành tên controller hoặc tên action. Tên hàm viết sao cho dễ nhớ thôi.
     * @param $string
     * @return string
     *
     */
    function convertUpperActionAndControllerName($string){
        // $string có dạng: admin-group-user
        $tmp = str_replace('-',' ',$string);  // chữ search là tự phần mềm nó gợi ý, mình không sửa được chữ đó, nó chỉ có tác dụng hiển thị cho dễ nhìn
        // khong ảnh hưởng đến mã code nhé.

        // kết quả lệnh trên:  admin group user

        // thay thế dấu - thành dấu cách để chuyển các ký tự đầu thành chữ in hoa:
        $tmp = ucwords($tmp); // hàm này sẽ tìm toàn bộ các từ (phân biệt bởi dấu cách, thay thế kí tự đầu tiên của từ thành chữ in hoa)

        // kết quả lệnh trên:  Admin Group User

        $tmp = str_replace(' ', '', $tmp); // việc này sẽ xóa hết dấu cách trở thành 1 chuỗi liền

        // kết quả lệnh trên:  AdminGroupUser

        return $tmp; // trả về chuỗi vừa xử lý xong

    }
    function validateUsername ($string){
        // biểu thức quy tắc kiểm tra tên đăng nhập
        $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
        if ( !preg_match($partten, $string) ){
            return "Tên đăng nhập phải là ký tự số hoặc chữ cái từ 6 đến 30 ký tự!";
        }
        return true;
    }

}