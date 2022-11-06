-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 06, 2022 lúc 02:14 PM
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
('BN', 'BÀN'),
('DN', 'ĐÈN'),
('QT', 'QUẠT'),
('TC', 'MÁY CHIẾU'),
('TV', 'TIVI'),
('ĐH', 'ĐIỀU HÒA');

--
-- Bẫy `loai_tb`
--
DELIMITER $$
CREATE TRIGGER `Log_capnhat_id_loai` AFTER UPDATE ON `loai_tb` FOR EACH ROW INSERT INTO system_log(thaotac, ten)
VALUES ("CẬP NHẬT", concat("CẬP NHẬT CÁC THÀNH PHẦN CỦA LOẠI '", old.id_Loai, "'"))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_them_loai_tb` AFTER INSERT ON `loai_tb` FOR EACH ROW INSERT INTO system_log(thaotac, ten)
VALUES ("THÊM", concat("THÊM LOẠI TB: '",new.id_Loai,"'"))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_xoa_loaitb` AFTER DELETE ON `loai_tb` FOR EACH ROW INSERT INTO system_log(thaotac, ten)
VALUES ("Xóa", concat("XÓA LOẠI THIẾT BỊ: ", old.tenloai_tb))
$$
DELIMITER ;

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
(16, 'P1', 50, 1),
(17, 'P2', 45, 0),
(21, 'P3', 12, 1);

--
-- Bẫy `phong`
--
DELIMITER $$
CREATE TRIGGER `Log_sua_phong` AFTER UPDATE ON `phong` FOR EACH ROW INSERt into system_log(thaotac, ten)
VALUES ("CẬP NHẬT", 
        concat("CẬP NHẬT PHÒNG: '", new.stt_phong, "'"))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_themPhong` AFTER INSERT ON `phong` FOR EACH ROW INSERt into system_log( thaotac, ten)
VALUES ("THÊM", concat("THÊM PHÒNG: '", new.stt_phong, "'"))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_xoaphong` AFTER DELETE ON `phong` FOR EACH ROW INSERt into system_log(thaotac, ten)
VALUES ("XÓA", concat("XÓA PHÒNG: '",old.stt_phong,"'"))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `system_log`
--

CREATE TABLE `system_log` (
  `id` int(11) NOT NULL,
  `thaotac` varchar(30) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `thoigian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `system_log`
--

INSERT INTO `system_log` (`id`, `thaotac`, `ten`, `thoigian`) VALUES
(24, 'THÊM', 'THÊM PHÒNG: \'P4\'', '2022-11-06 03:46:01'),
(25, 'CẬP NHẬT', 'CẬP NHẬT PHÒNG: \'P4\'', '2022-11-06 03:46:13'),
(26, 'XÓA', 'XÓA PHÒNG: \'P4\'', '2022-11-06 03:46:21'),
(27, 'THÊM', 'THÊM LOẠI TB: \'ML\'', '2022-11-06 03:47:55'),
(28, 'CẬP NHẬT', 'CẬP NHẬT CÁC THÀNH PHẦN CỦA LOẠI \'ML\'', '2022-11-06 03:48:32'),
(29, 'Xóa', 'XÓA LOẠI THIẾT BỊ: MÁY LẠNH 1', '2022-11-06 03:48:44'),
(30, 'THÊM', 'THÊM THIẾT BỊ MỚI \'BÀN\' VÀO PHÒNG P1', '2022-11-06 03:49:14'),
(31, 'CẬP NHẬT', 'CẬP NHẬT \'BÀN\' CỦA PHÒNG P1', '2022-11-06 03:49:18'),
(32, 'XÓA', 'XÓA THIẾT BỊ: \'BÀN\' KHỎI PHÒNG P1', '2022-11-06 03:49:20');

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
(16, 'P3', 'BN', '100', 2331, 0),
(17, 'P3', 'BN', 'sá', 12, 0),
(18, 'P3', 'QT', 'QUTAJ', 12, 0),
(19, 'P3', 'TC', 'mc', 1, 0);

--
-- Bẫy `tb`
--
DELIMITER $$
CREATE TRIGGER `Log_capnhat_ten_tb` AFTER UPDATE ON `tb` FOR EACH ROW INSERt into system_log(thaotac, ten)
VALUES ("CẬP NHẬT", 
        concat("CẬP NHẬT '", old.ten_tb ,"' CỦA PHÒNG ", new.stt_phong))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_themtb` AFTER INSERT ON `tb` FOR EACH ROW INSERt into system_log(thaotac, ten)
VALUES ("THÊM", 
        concat("THÊM THIẾT BỊ MỚI '",new.ten_tb, "' VÀO PHÒNG ", new.stt_phong))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Log_xoatb` AFTER DELETE ON `tb` FOR EACH ROW INSERt into system_log(thaotac, ten)
VALUES ("XÓA", 
        concat("XÓA THIẾT BỊ: '",old.ten_tb ,"' KHỎI PHÒNG ", old.stt_phong))
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
('luhungcuong100', '4297f44b13955235245b2497399d7a93', 'cuong', 'BH CT AG', '1231231231', 0),
('theb1910577', '4297f44b13955235245b2497399d7a93', 'THẾ GIÁM ĐỐC', 'AN GIANG', '1232123144', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `loai_tb`
--
ALTER TABLE `loai_tb`
  ADD PRIMARY KEY (`id_Loai`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id_phong`) USING BTREE;

--
-- Chỉ mục cho bảng `system_log`
--
ALTER TABLE `system_log`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT cho bảng `phong`
--
ALTER TABLE `phong`
  MODIFY `id_phong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `system_log`
--
ALTER TABLE `system_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tb`
--
ALTER TABLE `tb`
  MODIFY `id_tb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
