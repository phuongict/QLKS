<?php
/**
 * Created by sonmobi@gmail.com
 * Date: 12/3/2017
 * Time: 11:53 PM
 */
class IndexController extends Controller{
    public function indexAction(){
        echo __METHOD__;
    }

    public function listAction(){
        $userModel = new UsersModel();
        $list = $userModel->loadList();

        $this->view['list']  = $list;
    }
    public function loginAction(){
        if(isset($_SESSION['userLogin'])){
            echo "<script>window.location='index.php';</script>";
        }
        if(isset($_POST['btnSave'])){
            $username = $_POST['txt_tai_khoan'];
            $pass = $_POST['txt_mat_khau'];
            $check_username = parent::validateUsername($username);
            if($check_username === true){
                $login = new IndexModel();
                $res_login = $login->LoginDB($username, $pass);
                if(is_array($res_login)){
                    $this->view['msg'] = "Đăng nhập thành công!<br> Tự động chuyển trang trong 3s...";
                    unset($res_login['mat_khau']);
                    $_SESSION['userLogin'] = $res_login;
                    echo "<script type='text/javascript'>
                            function Redirect() {
                               window.location='index.php';
                            }
                            setTimeout('Redirect()', 3000);
                    </script>";
                }
                else{
                    $this->view['msg'] = $res_login;
                }
            }
            else{
                $this->view['msg'] = $check_username;
            }
        }
    }
    public function logoutAction(){
        if(isset($_SESSION['userLogin'])){
            unset($_SESSION['userLogin']);
            echo "<script>window.location='?controller=index&action=login';</script>";
        }
    }
    public function registerAction(){
        if(isset($_POST['btnSave'])){
            $data = array();
            $data['ten_dang_nhap'] = $_POST['txt_tai_khoan'];
            $data['mat_khau'] = $_POST['txt_mat_khau'];
            $data['email'] = $_POST['txt_email'];
            $data['sdt'] = $_POST['txt_dien_thoai'];
            $data['ho_dem'] = $_POST['txt_ho_dem'];
            $data['ten'] = $_POST['txt_ten'];
            $data['gioi_tinh'] = $_POST['txt_gt'];
            $data['dia_chi'] = $_POST['txt_dia_chi'];
            $inserUser = new IndexModel();
            $res = $inserUser->insertUser($data);
            if($res === true){
                $this->view['msg'] = "Đăng ký thành công!";
                $this->view['flag'] = true;
            }
            else
                $this->view['msg'] = $res;
        }
    }
}