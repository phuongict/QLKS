<?php
class AdminArticleController extends Controller{
    public function deleteAction(){
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
            if(!is_numeric($id)){
                $this->view['msg'] = "id bài viết không đúng";
                $this->view['flag'] = true;
                return $this->view;
            }
            $delete = new AdminArticleModel();
            $res = $delete->select('baiviet',$id);
            if(is_array($res)){
                $this->view['data'] = $res;
            }
            else{
                $this->view['msg'] = $res;
                $this->view['flag'] = true;
                return $this->view;
            }
            if(isset($_POST['btnDelete'])){
                $id_bv = $_POST['id_bai_viet'];
                if($id_bv !== $id){
                    return 'ID không đúng';
                }
                $res2 = $delete->delete('baiviet',$id_bv);
                if($res2 === true){
                    $this->view['msg'] = 'Xóa thành công!';
                    $this->view['flag'] = true;
                }
                else{
                    $this->view['msg'] = $res2;
                }
            }
        }
        else{
            $this->view['msg'] = 'Không tìm thấy id bài viết';
            $this->view['flag'] = true;
            return $this->view;
        }
    }
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
            $this->view['msg'][] = "Không tìm thấy id bài viết";
        }
        //lấy danh sách danh mục
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
    //Category
    public function deleteCategoryAction(){
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
            if(!is_numeric($id)){
                $this->view['msg'] = "id danh mục không đúng";
                $this->view['flag'] = true;
                return $this->view;
            }
            $delete = new AdminArticleModel();
            $res = $delete->select('danhmucbaiviet',$id);
            if(is_array($res)){
                $this->view['data'] = $res;
            }
            else{
                $this->view['msg'] = $res;
                $this->view['flag'] = true;
                return $this->view;
            }
            if(isset($_POST['btnDelete'])){
                $id_dm = $_POST['id_danh_muc'];
                if($id_dm !== $id){
                    return 'ID không đúng';
                }
                $res2 = $delete->delete('danhmucbaiviet',$id_dm);
                if($res2 === true){
                    $this->view['msg'] = 'Xóa thành công!';
                    $this->view['flag'] = true;
                }
                else{
                    $this->view['msg'] = $res2;
                }
            }
        }
        else{
            $this->view['msg'] = 'Không tìm thấy id bài viết';
            $this->view['flag'] = true;
            return $this->view;
        }
    }
    public function editCategoryAction()
    {
        $loadOne = new AdminArticleModel();
        $anh     = null;
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                return $this->view['msg'][] = "ID danh mục không đúng";
            }
            $res = $loadOne->loadOneCategory($id);
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
                $data['ten_danh_muc'] = $_POST['txt_ten_danh_muc'];
                $data['mo_ta']     = $_POST['txt_mo_ta'];
                //nếu số lỗi mà khác 0 thì để rỗng không gọi hàm lấy ảnh
                if ($_FILES['txt_hinh_anh']['error'][0] !== 0) {
                    $data['hinh_anh'] = $anh;
                } else {
                    $data['hinh_anh'] = parent::getNameImg('img-category');
                }
                $res2 = $loadOne->updateCategory($data);
                if ($res2 === true) {
                    $this->view['msg'][]                 = "Cập nhật danh mục thành công!";
                    $this->view['data']['ten_danh_muc'] = $data['ten_danh_muc'];
                    $this->view['data']['mo_ta']       = $data['mo_ta'];
                    $this->view['data']['hinh_anh']         = $data['hinh_anh'];
                } else
                    $this->view['msg'][] = $res2;
            }
        } else {
            $this->view['msg'][] = "Không tìm thấy id danh mục";
        }
    }
    public function addCategoryAction()
    {
        $category = new AdminArticleModel();
        if (isset($_POST['btnSave'])) {
            $data              = array();
            $data['ten_danh_muc'] = $_POST['txt_ten_danh_muc'];
            $data['mo_ta']     = $_POST['txt_mo_ta'];
            $data['hinh_anh']  = parent::getNameImg('img-category');
            $res               = $category->insertCategoryArticle($data);
            if ($res === true) {
                $this->view['msg'] = "Thêm danh mục thành công!";
            } else
                $this->view['msg'] = $res;
        }
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