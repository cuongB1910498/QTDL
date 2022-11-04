-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 04, 2022 lúc 08:13 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qtdl`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `find_usn` (IN `usn` VARCHAR(10))   BEGIN
	SELECT username FROM user WHERE username = usn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tiemphong` (IN `phong` VARCHAR(10))   BEGIN
	SELECT * FROM phong WHERE stt_phong like concat("%", phong , "%");
 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_tb`
--

CREATE TABLE `loai_tb` (
  `id_Loai` varchar(10) NOT NULL,
  `tenloai_tb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loai_tb`
--

INSERT INTO `loai_tb` (`id_Loai`, `tenloai_tb`) VALUES
('BN', 'BÀN HỌC'),
('BNGV', 'BÀNG GV'),
('DN', 'ĐÈN'),
('ĐH', 'ĐIỀU HÒA');

--
-- Bẫy `loai_tb`
--
DELIMITER $$
CREATE TRIGGER `Log_DEL_loaitb` AFTER DELETE ON `loai_tb` FOR EACH ROW INSERT INTO logloai_tb(id_Loai, ten, thaotac, thoigian)
VALUES (old.id_Loai, old.tenloai_tb, 'XÓA LOẠI THIẾT BỊ', now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_Update_loaitb` AFTER UPDATE ON `loai_tb` FOR EACH ROW INSERT INTO logloai_tb(id_Loai, ten, thaotac, thoigian)
VALUES (new.id_Loai, new.tenloai_tb, 'CẬP NHẬT LOẠI TB', now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_insert` AFTER INSERT ON `loai_tb` FOR EACH ROW INSERT INTO logloai_tb(id_Loai, ten, thaotac, thoigian)
VALUES (new.id_Loai, new.tenloai_tb, 'THÊM LOẠI TB', now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logloai_tb`
--

CREATE TABLE `logloai_tb` (
  `id` int(11) NOT NULL,
  `id_Loai` varchar(20) NOT NULL,
  `stt_phong` varchar(30) NOT NULL,
  `ten` varchar(20) NOT NULL,
  `thaotac` varchar(20) NOT NULL,
  `thoigian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `logloai_tb`
--

INSERT INTO `logloai_tb` (`id`, `id_Loai`, `stt_phong`, `ten`, `thaotac`, `thoigian`) VALUES
(5, '', '', 'P5', 'THÊM PHÒNG', '2022-11-04 08:32:15'),
(6, 'BN', 'P5', 'THÊM BN VÀO P5', 'THÊM THIẾT BỊ', '2022-11-04 08:33:05'),
(7, 'ML', '', 'MÁY LẠNH', 'THÊM LOẠI TB', '2022-11-04 08:33:31'),
(8, 'ĐH', '', 'ĐIỀU HÒA', 'CẬP NHẬT LOẠI TB', '2022-11-04 08:33:57'),
(9, '', '', 'P5', 'XÓA PHÒNG', '2022-11-04 08:34:28'),
(10, 'BN', 'P5', 'XÓA BN KHỎI PHÒNG P5', 'XÓA THIẾT BỊ', '2022-11-04 08:34:28'),
(11, '', '', 'P4', 'XÓA PHÒNG', '2022-11-04 08:34:51'),
(12, 'BN', 'P4', 'XÓA BN KHỎI PHÒNG P4', 'XÓA THIẾT BỊ', '2022-11-04 08:34:51'),
(13, 'MT', 'P4', 'XÓA MT KHỎI PHÒNG P4', 'XÓA THIẾT BỊ', '2022-11-04 08:34:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `id_phong` int(11) NOT NULL,
  `stt_phong` varchar(10) NOT NULL,
  `cho` int(11) NOT NULL,
  `tinh_trang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`id_phong`, `stt_phong`, `cho`, `tinh_trang`) VALUES
(1, 'P1', 55, 1),
(2, 'P2', 100, 1),
(3, 'P3', 45, 1);

--
-- Bẫy `phong`
--
DELIMITER $$
CREATE TRIGGER `Log_suaphong` AFTER UPDATE ON `phong` FOR EACH ROW INSERt into logloai_tb(ten, thaotac, thoigian)
VALUES (new.stt_phong , "SỬA PHÒNG" , now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_themPhong` AFTER INSERT ON `phong` FOR EACH ROW INSERt into logloai_tb(ten, thaotac, thoigian)
VALUES (new.stt_phong , "THÊM PHÒNG" , now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_xoaphong` AFTER DELETE ON `phong` FOR EACH ROW INSERt into logloai_tb(ten, thaotac, thoigian)
VALUES (old.stt_phong , "XÓA PHÒNG" , now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb`
--

CREATE TABLE `tb` (
  `id_tb` int(11) NOT NULL,
  `stt_phong` varchar(10) NOT NULL,
  `id_Loai` varchar(10) NOT NULL,
  `ten_tb` varchar(100) NOT NULL,
  `sl` int(11) NOT NULL,
  `sl_hu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tb`
--

INSERT INTO `tb` (`id_tb`, `stt_phong`, `id_Loai`, `ten_tb`, `sl`, `sl_hu`) VALUES
(3, 'P2', 'BN', 'Bàn 1', 10, 0),
(4, 'P3', 'BN', 'ban 1', 100, 0),
(12, 'P1', 'BN', 'BÀN THƯỜNG', 100, 0);

--
-- Bẫy `tb`
--
DELIMITER $$
CREATE TRIGGER `Log_capnhat_tb` AFTER UPDATE ON `tb` FOR EACH ROW INSERt into logloai_tb(id_Loai, stt_phong, ten, thaotac, thoigian)
VALUES (new.id_Loai,new.stt_phong , concat('CẬP NHẬT ',new.id_Loai,' CỦA PHÒNG ',new.stt_phong) , "THÊM THIẾT BỊ" , now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_themtb` AFTER INSERT ON `tb` FOR EACH ROW INSERt into logloai_tb(id_Loai, stt_phong, ten, thaotac, thoigian)
VALUES (new.id_Loai,new.stt_phong , concat('THÊM ',new.id_Loai,' VÀO ',new.stt_phong) , "THÊM THIẾT BỊ" , now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_xoatb` AFTER DELETE ON `tb` FOR EACH ROW INSERt into logloai_tb(id_Loai, stt_phong, ten, thaotac, thoigian)
VALUES (old.id_Loai, old.stt_phong , concat('XÓA ',old.id_Loai,' KHỎI PHÒNG ',old.stt_phong) , "XÓA THIẾT BỊ" , now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`username`, `password`, `ten`, `diachi`, `sdt`, `admin`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', '0123456789', 1),
('luhungcuong100', '4297f44b13955235245b2497399d7a93', 'cuong', 'BH CT AG', '1231231231', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `loai_tb`
--
ALTER TABLE `loai_tb`
  ADD PRIMARY KEY (`id_Loai`);

--
-- Chỉ mục cho bảng `logloai_tb`
--
ALTER TABLE `logloai_tb`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id_phong`) USING BTREE;

--
-- Chỉ mục cho bảng `tb`
--
ALTER TABLE `tb`
  ADD PRIMARY KEY (`id_tb`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `logloai_tb`
--
ALTER TABLE `logloai_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `phong`
--
ALTER TABLE `phong`
  MODIFY `id_phong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tb`
--
ALTER TABLE `tb`
  MODIFY `id_tb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
