-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2020 at 09:40 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--
CREATE DATABASE IF NOT EXISTS `database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `database`;

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `maDH` int(10) NOT NULL,
  `ngayxuatDH` date NOT NULL,
  `maNCC` varchar(50) NOT NULL,
  `maxe` varchar(50) NOT NULL,
  `soLuongXe` int(11) NOT NULL,
  `dongia` varchar(20) NOT NULL,
  `thue` varchar(11) NOT NULL,
  `id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`maDH`, `ngayxuatDH`, `maNCC`, `maxe`, `soLuongXe`, `dongia`, `thue`, `id`) VALUES
(1, '2020-12-05', 'HD', 'WA110cc', 2, '18,000,000', '2%', 'admin'),
(2, '2020-12-05', 'SZK', 'RDR150', 1, '49,190,000', '1%', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `maNCC` varchar(50) NOT NULL,
  `tenNCC` varchar(255) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhacungcap`
--

INSERT INTO `nhacungcap` (`maNCC`, `tenNCC`, `sdt`, `diachi`, `state`) VALUES
('HD', 'Honda', '18008001', 'Phường Phúc Thắng, Thành Phố Phúc Yên, Tỉnh Vĩnh Phúc, Việt Nam', 1),
('SYM', 'SYM', '0251381208', 'KP5, Phường Tam Hiệp, Thành phố Biên Hoà, Tỉnh Đồng Nai', 1),
('SZK', 'Suziki', '0963870033', 'Đường số 2, KCN Long Bình, P. Long Bình, TP. Biên Hòa, Đồng Nai', 1),
('YMH', 'Yamaha', '18001588', 'Thôn Bình An, Xã Trung Giã, Huyện Sóc Sơn, TP. Hà Nội', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phieunhaphang`
--

CREATE TABLE `phieunhaphang` (
  `maPhieuNH` int(11) NOT NULL,
  `ngayNhap` date NOT NULL,
  `nvLap` varchar(255) NOT NULL,
  `maNCC` varchar(100) NOT NULL,
  `maxe` varchar(100) NOT NULL,
  `soluong` int(10) NOT NULL,
  `dongia` varchar(100) NOT NULL,
  `thue` varchar(20) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieunhaphang`
--

INSERT INTO `phieunhaphang` (`maPhieuNH`, `ngayNhap`, `nvLap`, `maNCC`, `maxe`, `soluong`, `dongia`, `thue`, `state`) VALUES
(1, '2020-12-05', 'admin', 'HD', 'WA110cc', 100, '18,000,000', '2%', 1),
(2, '2020-12-05', 'admin', 'HD', 'FT125FI', 100, '30,000,000', '2%', 1),
(3, '2020-12-05', 'admin', 'YMH', 'SRCPD', 100, '19,500,000', '2%', 1),
(4, '2020-12-05', 'admin', 'SYM', 'A110', 100, '25,990,000', '2%', 1),
(5, '2020-12-05', 'admin', 'SZK', 'RDR150', 10, '49,190,000', '1%', 1);

-- --------------------------------------------------------

--
-- Table structure for table `thongke`
--

CREATE TABLE `thongke` (
  `maTK` int(10) NOT NULL,
  `loaiTK` varchar(50) NOT NULL,
  `thoigianLap` date NOT NULL,
  `soLuongXeNhap` int(11) NOT NULL,
  `soLuongXeBan` int(11) NOT NULL,
  `soLuongXeTon` int(11) NOT NULL,
  `tongTienNhap` varchar(50) NOT NULL,
  `tongTienBan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thongke`
--

INSERT INTO `thongke` (`maTK`, `loaiTK`, `thoigianLap`, `soLuongXeNhap`, `soLuongXeBan`, `soLuongXeTon`, `tongTienNhap`, `tongTienBan`) VALUES
(1, 'Theo tháng', '2020-12-05', 410, 3, 407, '10,032,799,000', '86,401,900'),
(2, 'Theo năm', '2020-12-05', 410, 3, 407, '10,032,799,000', '86,401,900');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(30) NOT NULL COMMENT 'ID khi dang nhap',
  `pass` varchar(255) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `gioitinh` varchar(5) NOT NULL COMMENT 'nam, nu',
  `namsinh` date NOT NULL COMMENT ' 4 chu so',
  `diachi` varchar(255) NOT NULL,
  `sdt` varchar(10) NOT NULL COMMENT '10 chu so',
  `chucvu` varchar(20) NOT NULL COMMENT 'quanli,banhang, kho',
  `luongcb` varchar(20) NOT NULL DEFAULT '0',
  `state` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `pass`, `ten`, `gioitinh`, `namsinh`, `diachi`, `sdt`, `chucvu`, `luongcb`, `state`) VALUES
('admin', '$2y$10$A8uXsfJDt2Wukk2X5Y9CsuQkFM.q1VywbM0UlhWRctQLbyic173gS', 'chủ quản lí', 'nam', '2020-05-18', 'Nguyen Huu tho quan 7', '1234567890', 'quanli', '0', 1),
('banhang', '$2y$10$A8uXsfJDt2Wukk2X5Y9CsuQkFM.q1VywbM0UlhWRctQLbyic173gS', 'Nhân viên bán hàng', 'nam', '2020-12-21', '123456', '1234567890', 'banhang', '10,000,000', 1),
('banhang1', '$2y$10$A8uXsfJDt2Wukk2X5Y9CsuQkFM.q1VywbM0UlhWRctQLbyic173gS', 'Nhân viên bán hàng 1', 'Nữ', '2020-12-24', '120 Nguyễn Chí Thanh', '123456789', 'banhang', '10,000,000', 1),
('kho', '$2y$10$A8uXsfJDt2Wukk2X5Y9CsuQkFM.q1VywbM0UlhWRctQLbyic173gS', 'Nhân viên kho', 'nu', '2020-12-23', '123456', '1234567890', 'kho', '10,000,000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xe`
--

CREATE TABLE `xe` (
  `maxe` varchar(50) NOT NULL,
  `tenxe` varchar(50) NOT NULL,
  `mota` varchar(255) NOT NULL,
  `baohanh` varchar(50) NOT NULL,
  `maNCC` varchar(50) NOT NULL,
  `soluongkho` int(11) NOT NULL,
  `dongia` varchar(20) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `xe`
--

INSERT INTO `xe` (`maxe`, `tenxe`, `mota`, `baohanh`, `maNCC`, `soluongkho`, `dongia`, `state`) VALUES
('A110', 'Abela 110 Màu Đỏ', 'Xy lanh đơn, 4 kỳ, SOHC, làm mát bằng nước', '2 năm', 'SYM', 100, '25,990,000', 1),
('FT125FI', 'Future 125 FI', 'Thiết kế Kế thừa danh tiếng vốn có của Future, thiết kế mới cao cấp và lịch lãm hơn - thể hiện được khí chất của người lái - với cảm giác sang trọng được tạo nên bởi những đường cong dọc thân xe cùng thiết kế liền khối và mạnh mẽ.', '2 năm', 'HD', 100, '30,000,000', 1),
('RDR150', 'RAIDER R150 Đen Đỏ', 'động cơ mạnh mẽ 150cc, DOHC, 4 thì, 4 vales, 6 số, 18,5 mã lực và làm mát bằng dung dịch cho khả năng vận hành mạnh mẽ và tăng tốc vượt trội.', '2 năm', 'SZK', 9, '49,190,000', 1),
('SRCPD', 'Sirius RC Phanh đĩa', '4 thì, 2 van SOHC, làm mát bằng không khí', '2 năm', 'YMH', 100, '19,500,000', 1),
('WA110cc', 'Wave Alpha 110cc', 'Wave Alpha 110cc phiên bản 2020 trẻ trung và cá tính với thiết kế bộ tem mới, tạo những điểm nhấn ấn tượng, thu hút ánh nhìn, cho bạn tự tin ghi lại dấu ấn cùng bạn bè của mình trên mọi hành trình.', '2 năm ', 'HD', 98, '18,000,000', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`maDH`),
  ADD KEY `id` (`id`),
  ADD KEY `maNCC` (`maNCC`),
  ADD KEY `maxe` (`maxe`);

--
-- Indexes for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`maNCC`);

--
-- Indexes for table `phieunhaphang`
--
ALTER TABLE `phieunhaphang`
  ADD PRIMARY KEY (`maPhieuNH`),
  ADD KEY `id` (`nvLap`),
  ADD KEY `maNCC` (`maNCC`),
  ADD KEY `maxe` (`maxe`);

--
-- Indexes for table `thongke`
--
ALTER TABLE `thongke`
  ADD PRIMARY KEY (`maTK`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xe`
--
ALTER TABLE `xe`
  ADD PRIMARY KEY (`maxe`),
  ADD KEY `maNCC` (`maNCC`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `maDH` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phieunhaphang`
--
ALTER TABLE `phieunhaphang`
  MODIFY `maPhieuNH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thongke`
--
ALTER TABLE `thongke`
  MODIFY `maTK` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
