-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 02, 2018 lúc 12:00 PM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanly_khachsan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baiviet`
--

CREATE TABLE `baiviet` (
  `id` int(11) NOT NULL,
  `tieu_de` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ngay_dang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hinh_anh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_danh_muc` int(11) NOT NULL,
  `ngay_cap_nhat` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_tai_khoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baiviet`
--

INSERT INTO `baiviet` (`id`, `tieu_de`, `noi_dung`, `ngay_dang`, `hinh_anh`, `id_danh_muc`, `ngay_cap_nhat`, `id_tai_khoan`) VALUES
(6, 'sdasdas', '<p>đ&acirc;s</p>\r\n', '2017-12-30 04:26:07', 'a:1:{i:0;s:50:\"25552304_271848566677737_3687025192655770253_n.jpg\";}', 1, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucnang`
--

CREATE TABLE `chucnang` (
  `id` int(11) NOT NULL,
  `ten_chuc_nang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chucnang`
--

INSERT INTO `chucnang` (`id`, `ten_chuc_nang`, `link`) VALUES
(1, 'Danh sách bài viết', 'admin_article-list');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmucbaiviet`
--

CREATE TABLE `danhmucbaiviet` (
  `id` int(11) NOT NULL,
  `ten_danh_muc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `hinh_anh` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmucbaiviet`
--

INSERT INTO `danhmucbaiviet` (`id`, `ten_danh_muc`, `mo_ta`, `hinh_anh`) VALUES
(1, 'du lịch', 'danh mục về du lịch', 'https://cdn3.ivivu.com/2015/10/du-lich-moc-chau-ivivu.com-3.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dichvu`
--

CREATE TABLE `dichvu` (
  `id` int(11) NOT NULL,
  `ten_dich_vu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_khach_san` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dondatphong`
--

CREATE TABLE `dondatphong` (
  `id` int(11) NOT NULL,
  `ngay_dat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trang_thai` smallint(6) DEFAULT '0',
  `ngay_nhan` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ngay_tra` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `ho_dem` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_phong` int(11) NOT NULL,
  `id_tai_khoan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dondatphong`
--

INSERT INTO `dondatphong` (`id`, `ngay_dat`, `trang_thai`, `ngay_nhan`, `ngay_tra`, `ghi_chu`, `ho_dem`, `ten`, `so_dien_thoai`, `id_phong`, `id_tai_khoan`) VALUES
(1, '2017-12-23 16:49:12', 0, '2017-12-23 17:00:00', '2017-12-24 17:00:00', 'abcabc', 'nguyen van', 'a', '0123485245', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachsan`
--

CREATE TABLE `khachsan` (
  `id` int(11) NOT NULL,
  `ten_khach_san` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci NOT NULL,
  `thong_tin` text COLLATE utf8_unicode_ci NOT NULL,
  `id_tai_khoan` int(11) NOT NULL,
  `hinh_anh` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachsan`
--

INSERT INTO `khachsan` (`id`, `ten_khach_san`, `dia_chi`, `so_dien_thoai`, `email`, `mo_ta`, `thong_tin`, `id_tai_khoan`, `hinh_anh`) VALUES
(1, 'Hanoi Emotion Hotelâsaac', 'Hà nội2', '0981234566', 'shbasd@hjd.vnd', '<p>sdagsduasbdadasdsada&aacute;daa222222222222a</p>\r\n', '<p>sfafsafasfasfasfsa</p>\r\n', 4, 0x613a333a7b693a303b733a35313a2232353434363037345f313539353639383336303532373039335f323837333334373537373935363430373830305f6e2e6a7067223b693a313b733a35303a2232353535323330345f3237313834383536363637373733375f333638373032353139323635353737303235335f6e2e6a7067223b693a323b733a373a2276636c2e6a7067223b7d),
(2, 'âsdasdasdas', 'sadas', 'sadasdas', 'aa@fm.comss', '<p>đasadasd</p>\r\n', '<p>sadsad</p>\r\n', 16, 0x613a323a7b693a303b733a35313a2232353434363037345f313539353639383336303532373039335f323837333334373537373935363430373830305f6e2e6a7067223b693a313b733a35303a2232353535323330345f3237313834383536363637373733375f333638373032353139323635353737303235335f6e2e6a7067223b7d);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL,
  `tieu_de` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_gui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `so_dien_thoai` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ho_dem` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id`, `tieu_de`, `noi_dung`, `ngay_gui`, `so_dien_thoai`, `email`, `dia_chi`, `ho_dem`, `ten`) VALUES
(1, 'Yêu cầu hỗ trợ', 'abc abc', '2017-12-24 07:10:51', '09817356173', 'sdadas@hamd.nc', 'ha noi', 'nguyen van', 'b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhomtaikhoan`
--

CREATE TABLE `nhomtaikhoan` (
  `id` int(11) NOT NULL,
  `ten_nhom` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhomtaikhoan`
--

INSERT INTO `nhomtaikhoan` (`id`, `ten_nhom`) VALUES
(4, 'Khách'),
(2, 'Nhân Viên Dịch Vụ'),
(3, 'Nhân Viên Khách Sạn'),
(1, 'Quản Trị Website');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `id` int(11) NOT NULL,
  `ten_phong` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gia` double NOT NULL,
  `giam_gia` double DEFAULT NULL,
  `trang_thai` bit(1) DEFAULT b'0',
  `id_khach_san` int(11) NOT NULL,
  `trang_thai_dang` bit(1) DEFAULT b'0',
  `so_giuong` int(11) NOT NULL,
  `hinh_anh` blob NOT NULL,
  `so_nguoi` int(11) NOT NULL,
  `dien_tich` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `thiet_bi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`id`, `ten_phong`, `gia`, `giam_gia`, `trang_thai`, `id_khach_san`, `trang_thai_dang`, `so_giuong`, `hinh_anh`, `so_nguoi`, `dien_tich`, `thiet_bi`, `mo_ta`) VALUES
(1, 'Phòng 01', 2000000, 1500000, b'0', 1, b'0', 0, '', 0, '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `id_nhom_tai_khoan` int(11) NOT NULL,
  `id_chuc_nang` int(11) NOT NULL,
  `trang_thai` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `ten_dang_nhap` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mat_khau` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gioi_tinh` bit(1) DEFAULT NULL,
  `diem_tich_luy` int(11) DEFAULT '0',
  `id_nhom_tai_khoan` int(11) NOT NULL DEFAULT '4',
  `ho_dem` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `ten_dang_nhap`, `mat_khau`, `email`, `so_dien_thoai`, `dia_chi`, `gioi_tinh`, `diem_tich_luy`, `id_nhom_tai_khoan`, `ho_dem`, `ten`) VALUES
(1, 'administration', '123456', 'phamphuong.svit@gmail.com', '0981914596', 'moc chau', b'1', 0, 1, 'Phạm Văn', 'Phương'),
(2, 'nhanvien', '123456', 'nguyan@dsnjfnsd.vn', '091273239', 'kdsbfksdfsdn', b'1', 0, 4, 'djkhfsnsnf', 'kjfgkdskb'),
(3, 'test', '123456', 'abc@gmail.com', '0954312345', 'sadsad', b'0', 0, 4, 'sad', 'sadsad'),
(4, 'test2', 'sadsadsa', 'abcdef@gmail.com', 'sadsda', 'sadsad', b'0', 0, 4, 'sdas', 'dsad'),
(5, 'sdsadsada', 'đasadasdasdasd', 'sdasda', 'sdasd', 'ád', NULL, 0, 4, '', ''),
(6, 'ádasdas', 'ádad', '', '', '', NULL, 0, 4, '', ''),
(9, 'sadasdádasd', 'sadadada', 'ádasd', 'da', 'đâ', b'0', 0, 4, '', ''),
(12, 'aaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaa', 'ádas', 'adad', 'dấd', b'1', 0, 4, '', ''),
(13, 'aaaaaaaaaaaaaa', 'aaaaaaaaaaa', 'aaaaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaa', NULL, 0, 4, '', ''),
(15, 'assssssssssss', 'ssssssssssssss', 'sssssssssssss', 'ssssssss', '', NULL, 0, 4, '', ''),
(16, 'sssssssssss', 'ssssssssssssss', 'ssssssssss', 'ssssss', 'ssssssssssssssssssssss', NULL, 0, 4, '', ''),
(18, 'dddddđ', 'ddd', 'dddddđ', 'ddddddd', '', NULL, 0, 4, '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uudai`
--

CREATE TABLE `uudai` (
  `id` int(11) NOT NULL,
  `ten_uu_dai` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gia_tri` float NOT NULL,
  `ngay_bat_dau` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ngay_ket_thuc` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ngay_su_dung` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `don_vi_tao_ma` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` bit(1) DEFAULT b'0',
  `id_tai_khoan` int(11) NOT NULL,
  `id_khach_san` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tieu_de` (`tieu_de`),
  ADD KEY `id_danh_muc` (`id_danh_muc`),
  ADD KEY `id_tai_khoan` (`id_tai_khoan`);

--
-- Chỉ mục cho bảng `chucnang`
--
ALTER TABLE `chucnang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_chuc_nang` (`ten_chuc_nang`),
  ADD UNIQUE KEY `link` (`link`);

--
-- Chỉ mục cho bảng `danhmucbaiviet`
--
ALTER TABLE `danhmucbaiviet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_danh_muc` (`ten_danh_muc`);

--
-- Chỉ mục cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_dich_vu` (`ten_dich_vu`),
  ADD KEY `id_khach_san` (`id_khach_san`);

--
-- Chỉ mục cho bảng `dondatphong`
--
ALTER TABLE `dondatphong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_phong` (`id_phong`);

--
-- Chỉ mục cho bảng `khachsan`
--
ALTER TABLE `khachsan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_khach_san` (`ten_khach_san`),
  ADD UNIQUE KEY `dia_chi` (`dia_chi`),
  ADD UNIQUE KEY `so_dien_thoai` (`so_dien_thoai`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_tai_khoan` (`id_tai_khoan`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhomtaikhoan`
--
ALTER TABLE `nhomtaikhoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_nhom` (`ten_nhom`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_phong` (`ten_phong`),
  ADD KEY `id_khach_san` (`id_khach_san`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id_nhom_tai_khoan`,`id_chuc_nang`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `so_dien_thoai` (`so_dien_thoai`),
  ADD KEY `id_nhom_tai_khoan` (`id_nhom_tai_khoan`);

--
-- Chỉ mục cho bảng `uudai`
--
ALTER TABLE `uudai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tai_khoan` (`id_tai_khoan`),
  ADD KEY `id_khach_san` (`id_khach_san`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `chucnang`
--
ALTER TABLE `chucnang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `danhmucbaiviet`
--
ALTER TABLE `danhmucbaiviet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `dondatphong`
--
ALTER TABLE `dondatphong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `khachsan`
--
ALTER TABLE `khachsan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `nhomtaikhoan`
--
ALTER TABLE `nhomtaikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `phong`
--
ALTER TABLE `phong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT cho bảng `uudai`
--
ALTER TABLE `uudai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD CONSTRAINT `baiviet_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `danhmucbaiviet` (`id`),
  ADD CONSTRAINT `baiviet_ibfk_2` FOREIGN KEY (`id_tai_khoan`) REFERENCES `taikhoan` (`id`);

--
-- Các ràng buộc cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  ADD CONSTRAINT `dichvu_ibfk_1` FOREIGN KEY (`id_khach_san`) REFERENCES `khachsan` (`id`);

--
-- Các ràng buộc cho bảng `dondatphong`
--
ALTER TABLE `dondatphong`
  ADD CONSTRAINT `dondatphong_ibfk_1` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id`);

--
-- Các ràng buộc cho bảng `khachsan`
--
ALTER TABLE `khachsan`
  ADD CONSTRAINT `khachsan_ibfk_1` FOREIGN KEY (`id_tai_khoan`) REFERENCES `taikhoan` (`id`);

--
-- Các ràng buộc cho bảng `phong`
--
ALTER TABLE `phong`
  ADD CONSTRAINT `phong_ibfk_1` FOREIGN KEY (`id_khach_san`) REFERENCES `khachsan` (`id`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`id_nhom_tai_khoan`) REFERENCES `nhomtaikhoan` (`id`);

--
-- Các ràng buộc cho bảng `uudai`
--
ALTER TABLE `uudai`
  ADD CONSTRAINT `uudai_ibfk_1` FOREIGN KEY (`id_tai_khoan`) REFERENCES `taikhoan` (`id`),
  ADD CONSTRAINT `uudai_ibfk_2` FOREIGN KEY (`id_khach_san`) REFERENCES `khachsan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
