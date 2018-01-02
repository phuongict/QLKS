<?php
class AdminArticleController extends Controller{
    public function editAction()
    {
        $loadOne = new AdminArticleModel();
        $anh     = null;
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                return $this->view['msg'][] = "ID bài viết không đúng";
            }
            $res = $loadOne->loadOne($id);
            if (is_array($res)) {
                $this->view['data'] = $res;
                $anh                = $res['hinh_anh'];
            } else {
                return $this->view['msg'][] = $res;
            }
            //update
            if (isset($_POST['btnSave'])) {
                $data              = array();
                $data['id'] = $id;
                $data['tieu_de'] = $_POST['txt_tieu_de'];
                $data['noi_dung']     = $_POST['txt_noi_dung'];
                $data['danh_muc']  = $_POST['txt_danh_muc'];
                $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
                //nếu số lỗi mà khác 0 thì để rỗng không gọi hàm lấy ảnh
                if ($_FILES['txt_hinh_anh']['error'][0] !== 0) {
                    $data['hinh_anh'] = $anh;
                } else {
                    $data['hinh_anh'] = parent::getNameImg('img-article');
                }
                $res2 = $loadOne->update($data);
                if ($res2 === true) {
                    $this->view['msg'][]                 = "Cập nhật phòng thành công!";
                    $this->view['data']['tieu_de'] = $data['tieu_de'];
                    $this->view['data']['noi_dung']       = $data['noi_dung'];
                    $this->view['data']['id_danh_muc']         = $data['danh_muc'];
                    $this->view['data']['hinh_anh']         = $data['hinh_anh'];
                    $res3                                = $loadOne->select('danhmucbaiviet', $data['danh_muc']);
                    if (is_array($res3)) {
                        $this->view['data']['ten_danh_muc'] = $res3['ten_danh_muc'];
                    } else
                        $this->view['data']['ten_danh_muc'] = $res3;
                } else
                    $this->view['msg'][] = $res2;
            }
        } else {
            $this->view['msg'][] = "Không tìm thấy id phòng";
        }
        //lấy danh sách hotel
        $list = $loadOne->listCategory();
        if (is_array($list)) {
            $this->view['list-category'] = $list;
        } else {
            return $this->view['msg'][] = $list;
        }
    }
    public function addAction()
    {
        $category = new AdminArticleModel();
        $list  = $category->listCategory();
        if (is_array($list)) {
            $this->view['list-category'] = $list;
        } else {
            return $this->view['msg'] = $list;
        }
        if (isset($_POST['btnSave'])) {
            $data              = array();
            $data['tieu_de'] = $_POST['txt_tieu_de'];
            $data['noi_dung']     = $_POST['txt_noi_dung'];
            $data['danh_muc']  = $_POST['txt_danh_muc'];
            $data['ngay_dang']  = date('Y-m-d H:i:s');
            $data['tai_khoan'] = $_SESSION['userLogin']['id'];
            $data['hinh_anh']  = parent::getNameImg('img-article');
            $res               = $category->insertArticle($data);
            if ($res === true) {
                $this->view['msg'] = "Thêm bài viết thành công!";
            } else
                $this->view['msg'] = $res;
        }
    }
    public function listAction(){
        $articleModel = new AdminArticleModel();
        $total_records = $articleModel->countRecord('baiviet');
        $pagination = parent::Pagination($total_records);
        $offset = $pagination['offset'];
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $articleModel->loadList($offset);
        $this->view['list']  = $list;
        $this->view['total_pages'] = $pagination['total_pages'];
    }
    public function listCategoryAction(){
        $categoryModel = new AdminArticleModel();
        $total_records = $categoryModel->countRecord('danhmucbaiviet');
        $pagination = parent::Pagination($total_records);
        $offset = $pagination['offset'];
        if($offset === false){
            $this->view['msg']  = "Lỗi lấy dữ liệu";
        }
        $list = $categoryModel->loadListCategory($offset);
        $this->view['list']  = $list;
        $this->view['total_pages'] = $pagination['total_pages'];
    }
}