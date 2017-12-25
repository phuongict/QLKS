<?php
class IndexModel extends Model {

    public function loadList($params = null)
    {
        // TODO: Implement loadList() method.
    }

    public function LoginDB($username, $pass){
        $sql = "select * from taikhoan where ten_dang_nhap = '$username'";
        $res = mysqli_query($this->conn,$sql);
        if($res === false){
            return 'Lỗi lấy tài khoản '.mysqli_error($this->conn);
        }
        if(mysqli_num_rows($res)==1){
            $row = mysqli_fetch_assoc($res);
            if($row['mat_khau'] == $pass){
                return $row;
            }
            else{
                return 'Sai mật khẩu!';
            }
        }
        else{
            return 'Không tồn tại tài khoản: '.$username;
        }
    }
    public function insertUser($params = null){
        $ten_dang_nhap = $params['ten_dang_nhap'];
        $mat_khau = $params['mat_khau'];
        $email = $params['email'];
        $sdt = $params['sdt'];
        $ho_dem = $params['ho_dem'];
        $ten = $params['ten'];
        $gioi_tinh = $params['gioi_tinh'];
        $dia_chi = $params['dia_chi'];

        $sql = "INSERT INTO taikhoan (ten_dang_nhap,mat_khau,email,so_dien_thoai,dia_chi,gioi_tinh,ho_dem,ten) VALUES ('$ten_dang_nhap','$mat_khau','$email','$sdt','$dia_chi',$gioi_tinh,'$ho_dem','$ten')";

        $res = mysqli_query($this->conn,$sql);

        if($res ===false){
            return "Lỗi INSERT: ". mysqli_error($this->conn);
        }
        return true;
    }
    public function count($params = null)
    {
        // TODO: Implement count() method.
    }


    public function loadOne($id)
    {
        // TODO: Implement loadOne() method.
    }
}