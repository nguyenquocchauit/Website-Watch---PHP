-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2022 at 12:12 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_watch`
--

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

CREATE TABLE `administration` (
  `ID_Administration` varchar(10) NOT NULL COMMENT 'administration table primary key',
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Create_At` datetime NOT NULL COMMENT 'the time the account was created',
  `ID_Role` varchar(10) NOT NULL COMMENT 'Foreign key querying the role . table'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`ID_Administration`, `First_Name`, `Last_Name`, `Email`, `UserName`, `Password`, `Create_At`, `ID_Role`) VALUES
('Admin001', 'Nguyễn Quốc', 'Châu', 'chauquocnguyen.cun1@gmail.com', 'nguyenquocchauit', 'chauit', '2022-10-19 08:11:00', 'Admin'),
('Admin002', 'Phan Thị Huyền', 'Trâm', 'trampt001@gmail.com', 'huyenchamm', 'tramxinhdep', '2022-10-19 08:17:00', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `ID_Brand` varchar(15) NOT NULL COMMENT 'brand table primary key',
  `Name` varchar(25) NOT NULL COMMENT 'Name brand'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`ID_Brand`, `Name`) VALUES
('Avia', 'Aviator'),
('Baby', 'Baby-G'),
('Bentley', 'Bentley'),
('c', 'cd'),
('Citizen', 'Citizen'),
('Olym', 'Olym Pianus'),
('Shock', 'G-Shock');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID_Customer` varchar(30) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Address` text DEFAULT NULL,
  `Create_At` datetime NOT NULL COMMENT 'the time the account was created',
  `ID_Role` varchar(10) NOT NULL COMMENT 'foreign key table roles'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ID_Customer`, `First_Name`, `Last_Name`, `Phone`, `Email`, `UserName`, `Password`, `Address`, `Create_At`, `ID_Role`) VALUES
('MaKH00001', 'Nguyễn Trần Hoàn', 'Kim', '0386818888', 'nguyentranhoankim.nt@gmail.com', 'bekimcute', 'kimbeiu', 'Phước Đồng, Nha Trang, Khánh Hòa', '2022-10-19 08:20:00', 'User'),
('MaKH00002', 'Nguyễn Khánh', 'Nam', '0926555565', 'nguyenkhanhnam.hn@gmail.com', 'nam123', 'knam123', 'Nha Trang', '2022-10-19 08:25:00', 'User'),
('MaKH00003', 'Nguyễn Yến', 'Nhi', '0926300000', 'nguyenyennhi.dn@gmail.com', 'benhi', 'nynhi123', 'Đà Nẵng', '2022-10-19 08:25:00', 'User'),
('MaKH00004', 'Phạm Hồ Thu', 'Oanh', '0926123456', 'phamhothuoanh.nt@gmail.com', 'phtoanh123', 'thuoanh123', 'Nha Trang, Khánh Hòa', '2022-10-19 08:25:00', 'User'),
('MaKH00005', 'Nguyễn Yến', 'Vy', '0926356789', 'nguyenyenvy.nt@gmail.com', 'yenvy1', 'yenvynhatrang', 'Nha Trang, Khánh Hòa', '2022-10-19 08:25:00', 'User'),
('MaKH00006', 'Nguyễn Anh', 'Thư', '0920023456', 'nguyenanhthu.nt@gmail.com', 'anhthunguyen', 'anhthucute', 'Nha Trang, Khánh Hòa', '2022-10-19 08:25:00', 'User'),
('MaKH00007', 'Phạm Nguyễn Bảo', 'Trân', '0926888888', 'phamnguyenbaotran.nt@gmail.com', 'baotran123', 'baotranxinhdep', 'Nha Trang, Khánh Hòa', '2022-10-19 08:25:00', 'User'),
('MaKH00008', 'Phan Quang', 'Khải', '0920045056', 'phanquankhai.nt@gmail.com', 'quangkhaidz', 'khaidzai', 'Nha Trang, Khánh Hòa', '2022-10-19 08:25:00', 'User'),
('MaKH00009', 'Nguyễn Thành', 'Lãnh', '0921123456', 'nguyenthanhlanh.nt@gmail.com', 'lanhlanh', 'thanhlanh123', 'Nha Trang, Khánh Hòa', '2022-10-19 08:25:00', 'User'),
('MaKH00010', 'Trần Lê Nguyên', 'Hoàng', '0920023888', 'tranlenguyenhoang.nt@gmail.com', 'anhhoangdzai', 'nguyenhoang159', 'Nha Trang, Khánh Hòa', '2022-10-19 08:25:00', 'User'),
('MaKH00011', 'Nguyen Quoc', 'Chau', '0926383006', '723mailtrang11@gmail.com', 'chau12388', 'chau1234', 'Hà Nội', '2022-11-02 17:28:39', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `ID_Gender` varchar(5) NOT NULL COMMENT 'Gender table primary key',
  `Name` varchar(10) NOT NULL COMMENT 'Gender: Men or women'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`ID_Gender`, `Name`) VALUES
('IDM', 'Men'),
('IDWM', 'Women');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `ID_Method` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL COMMENT 'payment methods'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `method`
--

INSERT INTO `method` (`ID_Method`, `Name`) VALUES
('Card', 'Debit/Credit Card'),
('Cod', 'Cash On Delivery'),
('Ebp', 'E-Banking Payment'),
('Momo', 'Momo E-Wallet'),
('Zalo', 'ZaloPay');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID_Order` varchar(30) NOT NULL,
  `ID_Customer` varchar(30) NOT NULL COMMENT 'foreign key table customer',
  `Create_At` datetime NOT NULL COMMENT 'time the order was created',
  `Total` decimal(10,0) NOT NULL COMMENT 'total amount of the order'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID_Order`, `ID_Customer`, `Create_At`, `Total`) VALUES
('Order0000001', 'MaKH00001', '2022-10-22 23:22:23', '25278000'),
('Order0000002', 'MaKH00002', '2022-10-31 23:29:27', '78647600'),
('Order0000003', 'MaKH00009', '2022-10-31 23:30:05', '19697400'),
('Order0000004', 'MaKH00003', '2022-10-31 23:31:05', '4350000'),
('Order0000005', 'MaKH00011', '2022-11-02 17:30:55', '45854400');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `ID_Detail` varchar(30) NOT NULL,
  `ID_Order` varchar(30) NOT NULL COMMENT 'foreign key table order',
  `ID_Product` varchar(30) NOT NULL COMMENT 'foreign key table product',
  `Create_At` datetime NOT NULL COMMENT 'time the order detail was created	',
  `Quantity` tinyint(4) NOT NULL COMMENT 'The number of products selected to buy',
  `Price` decimal(10,0) NOT NULL COMMENT 'product price',
  `Total` decimal(10,0) NOT NULL COMMENT 'total product cost'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`ID_Detail`, `ID_Order`, `ID_Product`, `Create_At`, `Quantity`, `Price`, `Total`) VALUES
('Detail0000001', 'Order0000001', 'Product0018', '2022-10-30 22:29:50', 1, '4816500', '4816500'),
('Detail0000002', 'Order0000001', 'Product0017', '2022-10-30 22:29:50', 1, '8661500', '8661500'),
('Detail0000003', 'Order0000001', 'Product0006', '2022-10-30 22:36:47', 1, '2550000', '2550000'),
('Detail0000004', 'Order0000001', 'Product0003', '2022-10-30 22:56:34', 1, '9250000', '9250000'),
('Detail0000005', 'Order0000002', 'Product0004', '2022-10-31 23:29:27', 1, '16200000', '16200000'),
('Detail0000006', 'Order0000002', 'Product0002', '2022-10-31 23:29:27', 1, '14850000', '14850000'),
('Detail0000007', 'Order0000002', 'Product0010', '2022-10-31 23:29:27', 1, '7327800', '7327800'),
('Detail0000008', 'Order0000002', 'Product0009', '2022-10-31 23:29:27', 1, '4671000', '4671000'),
('Detail0000009', 'Order0000002', 'Product0006', '2022-10-31 23:29:27', 1, '2550000', '2550000'),
('Detail0000010', 'Order0000002', 'Product0003', '2022-10-31 23:29:27', 1, '9250000', '9250000'),
('Detail0000011', 'Order0000003', 'Product0022', '2022-10-31 23:30:05', 1, '3956000', '3956000'),
('Detail0000012', 'Order0000003', 'Product0021', '2022-10-31 23:30:05', 1, '4743900', '4743900'),
('Detail0000013', 'Order0000003', 'Product0020', '2022-10-31 23:30:05', 1, '7410000', '7410000'),
('Detail0000014', 'Order0000003', 'Product0019', '2022-10-31 23:30:05', 1, '3587500', '3587500'),
('Detail0000015', 'Order0000004', 'Product0008', '2022-10-31 23:31:05', 1, '1890000', '1890000'),
('Detail0000016', 'Order0000004', 'Product0007', '2022-10-31 23:31:05', 1, '2460000', '2460000'),
('Detail0000017', 'Order0000002', 'Product0010', '2022-11-02 00:19:12', 1, '7327800', '7327800'),
('Detail0000018', 'Order0000002', 'Product0009', '2022-11-02 00:19:12', 1, '4671000', '4671000'),
('Detail0000019', 'Order0000002', 'Product0006', '2022-11-02 00:19:12', 1, '2550000', '2550000'),
('Detail0000020', 'Order0000002', 'Product0003', '2022-11-02 00:19:12', 1, '9250000', '9250000'),
('Detail0000021', 'Order0000005', 'Product0010', '2022-11-02 17:30:55', 3, '7327800', '21983400'),
('Detail0000022', 'Order0000005', 'Product0009', '2022-11-02 17:30:55', 1, '4671000', '4671000'),
('Detail0000023', 'Order0000005', 'Product0006', '2022-11-02 17:30:55', 1, '2550000', '2550000'),
('Detail0000024', 'Order0000005', 'Product0014', '2022-11-02 17:30:55', 1, '16650000', '16650000');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID_Product` varchar(30) NOT NULL,
  `Name` varchar(45) NOT NULL COMMENT 'Product''s name',
  `Description` text NOT NULL COMMENT 'Product Description',
  `Image` text NOT NULL COMMENT 'store 6 image file names',
  `Quantity` int(4) NOT NULL COMMENT 'number of products available',
  `Price` int(12) NOT NULL COMMENT 'The price of the product is listed',
  `Discount` float NOT NULL COMMENT '% discount of the product',
  `Create_At` datetime NOT NULL COMMENT 'time the product was first created',
  `Update_At` datetime NOT NULL COMMENT 'when the product was first updated',
  `ID_Brand` varchar(12) NOT NULL COMMENT 'foreign key table brand',
  `ID_Gender` varchar(5) NOT NULL COMMENT 'foreign key table gender'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID_Product`, `Name`, `Description`, `Image`, `Quantity`, `Price`, `Discount`, `Create_At`, `Update_At`, `ID_Brand`, `ID_Gender`) VALUES
('Product0001', 'DOUGLAS DAY-DATE 41', 'Cách mạng hóa hoạt động du lịch, Douglas DC-3 vận chuyển hành khách với phong cách Hạng Nhất và trở thành công cụ trong Thời kỳ Vàng của ngành hàng không. Bằng cách pha trộn sự tinh tế của chuyến du lịch sang trọng với công nghệ tiên tiến và tay nghề thủ công, chiếc đồng hồ AVIATOR Douglas Day Date 41 vinh danh chiếc máy bay vĩ đại nhất thời đại.', 'douglas-day-date-41-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 1000, 18000000, 0, '2022-10-19 08:11:00', '2022-10-19 08:11:00', 'Avia', 'IDM'),
('Product0002', 'DOUGLAS MOONFLIGHT', 'Vào những năm 1930, các nhà thiết kế thời trang cao cấp đã mang đến sự quyến rũ cho đường băng và lên chiếc Douglas DC-3, chiếc máy bay đã thiết kế lại hành trình bằng cách mang đến sự sang trọng cho mỗi chuyến bay. Kết hợp các tính năng Art Deco cổ điển được đặt theo các giai đoạn của mặt trăng, AVIATOR MoonFlight cho phép bạn hạ cánh giữa các ngôi sao và tín đồ thời trang với phong cách cao cấp nhằm tôn vinh chiếc máy bay vĩ đại nhất của thời đại đó.', 'douglas-moonflight-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 500, 16500000, 0.1, '2022-10-21 08:52:55', '2022-10-21 08:52:55', 'Avia', 'IDWM'),
('Product0003', 'AIRACOBRA P45 CHRONO 1', 'Tận dụng chiến lược tầm nhìn chim của mình trong suốt Thế chiến II, Airacobra là một máy bay chiến đấu ổn định mà Đồng minh có thể dựa vào để hỗ trợ quân đội trên mặt đất. Bằng cách kết hợp tinh thần đáng tin cậy của nó đã chứng tỏ là công cụ trong mọi nhiệm vụ, đồng hồ AVIATOR Airacobra P45 Chrono mang đến một vẻ ngoài giống như một công cụ xứng đáng được đề cập đến.', 'airacobra-p45-chrono-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 0, 18500000, 0.5, '2022-10-21 03:59:53', '2022-10-21 03:59:53', 'Avia', 'IDM'),
('Product0004', 'AIRACOBRA P45 CHRONO', 'Tận dụng chiến lược tầm nhìn chim của mình trong suốt Thế chiến II, Airacobra là một máy bay chiến đấu ổn định mà Đồng minh có thể dựa vào để hỗ trợ quân đội trên mặt đất. Bằng cách kết hợp tinh thần đáng tin cậy của nó đã chứng tỏ là công cụ trong mọi nhiệm vụ, đồng hồ AVIATOR Airacobra P45 Chrono mang đến một vẻ ngoài giống như một công cụ xứng đáng được đề cập đến.', 'airacobra-p45-chrono-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 400, 18000000, 0.1, '2022-10-21 04:02:51', '2022-10-21 04:02:51', 'Avia', 'IDWM'),
('Product0005', 'BABY G BGA-310-7A2', 'Thỏa sức ngao du ngoài trời với mẫu đồng hồ BGA-310 sành điệu và mạnh mẽ. Ngoài ra bạn cũng có thể chọn màu be sáng nếu yêu thích phong cách ngoài trời. Mặt đồng hồ tròn và rộng kết hợp dây đeo lớn và vạch chỉ giờ nổi làm tôn lên vẻ ngoài nghịch ngợm và giúp bạn dễ đọc. Dây đeo màu sáng giúp hiển thị giờ rõ ràng ngay cả trong bóng tối để bạn xem nhanh hơn. Chiếc đồng hồ có phần vấu nối dây đeo vừa vặn phù hợp với mọi chuyển động. Chiếc đồng hồ này còn cung cấp nhiều chức năng thực tiễn như cấu trúc chống va đập và khả năng chống nước ở độ sâu lên đến 100 mét. Nút bấm phía trước giúp bạn dễ mở đèn LED đôi chiếu sáng mặt đồng hồ và mở màn mình LCD khi đi cắm trại hoặc phiêu lưu.', 'baby-g-bga-310-7a2-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 900, 5000000, 0, '2022-10-21 04:13:42', '2022-10-21 04:13:42', 'Baby', 'IDM'),
('Product0006', 'BABY G BA-110XSM-2A', 'Từ BABY-G, dòng đồng hồ đơn giản dành cho giới nữ năng động, đã phát triển mẫu đồng hồ mới được hợp tác sản xuất cùng với thương hiệu Thủy thủ Mặt Trăng. Thương hiệu anime Thủy thủ Mặt Trăng và BABY-G nổi tiếng từ những năm 1990 và đã trở thành đối tác hoàn hảo của nhau. Chủ đề của mẫu đồng hồ mới này khả năng biến hình mang phong cách lãng mạn của Thủy thủ Mặt Trăng. Dựa trên mẫu đồng hồ BABY-G BA-110 nổi tiếng, chiếc đồng hồ mới này kết hợp nhiều yếu tố nguyên bản lung linh lấy cảm hứng từ phiên bản biến hình của Thủy thủ Mặt Trăng. Phần thân bán trong suốt màu xanh hải quân gợi lên hình ảnh bầu trời đêm, được trang trí bằng các ngôi sao, mặt trăng, trái tim và các hình ảnh Thủy thủ Mặt Trăng màu xanh lam, đỏ và vàng, tạo nên diện mạo vô cùng quyến rũ. Mặt đồng hồ được trang trí bằng những hình ảnh lấp lánh kết hợp dây đeo màu vàng hồng. Thiết kế đặc biệt này gợi lên hình ảnh Thủy thủ Mặt Trăng biến hình vô cùng cuốn hút và khó quên. Vòng dây đeo in hình Thủy thủ Mặt Trăng cũng được khắc trên nắp sau của đồng hồ. Thiết kế bao bì của mẫu đồng hồ này được lấy cảm hứng từ Thủy thủ Mặt Trăng. Mọi chi tiết liên quan đến mẫu đồng hồ này đều được thiết kế nhằm tôn vinh sự hợp tác đặc biệt giữa BABY-G và Thủy thủ Mặt Trăng, nữ anh hùng trong mơ của mọi cô gái.', 'baby-g-ba-110xsm-2a-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 500, 5100000, 0.5, '2022-10-21 04:25:28', '2022-10-21 04:25:28', 'Baby', 'IDM'),
('Product0007', 'BABY G BA-130PM-4A', 'Đồng hồ BABY-G pastel nhiều màu kết hợp kim loại vừa dễ thương vừa đơn giản, phù hợp với nhịp sống năng động của bạn. Mẫu đồng hồ với các dải và khối màu tông pastel mang phong cách pop nữ tính, kết hợp với những sắc màu dịu nhẹ tạo nên phong cách thiết kế đẹp mắt. Kim đồng hồ, vạch chỉ giờ và các thành phần mặt số khác đều được phủ lớp kim loại sáng bóng, tinh tế, kết hợp với vỏ và dây đeo mờ tạo nên phong cách độc đáo. Chiếc đồng hồ này không chỉ đẹp mắt mà còn cung cấp nhiều chức năng hữu ích hàng ngày như cấu trúc chống va đập và khả năng chống nước ở độ sâu lên đến 100 mét. Thể hiện phong cách huyền bí cùng sự tương phản ấn tượng bên trong mẫu đồng hồ kim loại mạnh mẽ với màu pastel dịu nhẹ.', 'baby-g-ba-130pm-4a-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 350, 4100000, 0.4, '2022-10-21 04:26:34', '2022-10-21 04:26:34', 'Baby', 'IDWM'),
('Product0008', 'BABY G BGA-310-4A', 'Thỏa sức ngao du ngoài trời với mẫu đồng hồ BGA-310 sành điệu và mạnh mẽ. Ngoài ra bạn cũng có thể chọn màu be sáng nếu yêu thích phong cách ngoài trời. Mặt đồng hồ tròn và rộng kết hợp dây đeo lớn và vạch chỉ giờ nổi làm tôn lên vẻ ngoài nghịch ngợm và giúp bạn dễ đọc. Dây đeo màu sáng giúp hiển thị giờ rõ ràng ngay cả trong bóng tối để bạn xem nhanh hơn. Chiếc đồng hồ có phần vấu nối dây đeo vừa vặn phù hợp với mọi chuyển động. Chiếc đồng hồ này còn cung cấp nhiều chức năng thực tiễn như cấu trúc chống va đập và khả năng chống nước ở độ sâu lên đến 100 mét. Nút bấm phía trước giúp bạn dễ mở đèn LED đôi chiếu sáng mặt đồng hồ và mở màn mình LCD khi đi cắm trại hoặc phiêu lưu. Bạn đang không rảnh tay? Chỉ cần nghiêng cổ tay và bật chức năng phát sáng tự động để xem giờ ngay cả trong bóng tối. Đồng hồ BABY-G giúp bạn luôn có phong cách riêng dù là khi ở nhà giữa đô thị nhộn nhịp hay đang trên đường leo núi, sẵn sàng đối mặt với mọi chuyện xảy ra trong đời sống năng động của mình.', 'baby-g-bga-310-4a-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 500, 2100000, 0.1, '2022-10-21 04:32:44', '2022-10-21 04:32:44', 'Baby', 'IDWM'),
('Product0009', 'BENTLEY BL1831-25MKNN', 'Đồng hồ Bentley là thương hiệu được thành lập vào năm 1948 tại La Chaux-de-Fonds, Thụy Sĩ. Thị trấn được biết đến như cái nôi của đồng hồ hiện đại. Tuy là thương hiệu của Thụy Sĩ nhưng lại được thiết kế gia công tại Đức – một quốc gia với nền công nghiệp chủ đạo về cơ khí, điện tử, sản xuất ôtô. Vào đầu thập niên 90, Bentley đã phát triển thành Tập đoàn Bentley Luxury Group và mở rộng danh mục sản phẩm của mình bao gồm các phụ kiện thời trang, đồ da cao cấp với phương châm “BE IN CONTROL”.', 'bentley-bl1831-25mknn-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 1000, 5190000, 0.1, '2022-10-21 04:53:08', '2022-10-21 04:53:08', 'Bentley', 'IDM'),
('Product0010', 'BENTLEY BL2080-252MKKI', 'BENTLEY 2080-152MKKI là mẫu đồng hồ cơ mới nhất hiện nay, xuất xứ thương hiệu đồng hồ của Đức nổi tiếng hàng đầu về sự chính xác và bền bỉ trong nghệ thuật chế tác đồng hồ. Nổi bật với 30 viên kim cương ( 12 viên tại cọc số, 18 viên còn lại được trải khắp đường viền của mặt phụ small second) và > 400 viên đá sapphire đầy sang trọng với độ tinh xảo cao mang tới phong cách sang trọng quý tộc và thanh lịch.', 'bently-bl2080-252mkki-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 350, 8142000, 0.1, '2022-10-21 04:58:48', '2022-10-21 04:58:48', 'Bentley', 'IDM'),
('Product0011', 'BENTLY BL1805-20LKWD', 'Đồng hồ Bentley BL1805-20LKWD là mẫu đồng hồ nữ mới nhất hiện nay, xuất xứ thương hiệu đồng hồ của Đức nổi tiếng hàng đầu về sự chính xác và bền bỉ trong nghệ thuật chế tác đồng hồ, sản phẩm mang phong cách sang trọng quý tộc và thanh lịch, cuốn hút ngay từ cái nhìn đầu tiên với phong cách classic đầy tinh tế.', 'bentley-bl1805-20lkwd-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 350, 5000000, 0, '2022-10-21 05:09:26', '2022-10-21 05:09:26', 'Bentley', 'IDWM'),
('Product0012', 'BENTLY BL1707-101LWWW', 'Đồng hồ Bentley BL1707-101LWWW là mẫu đồng hồ nữ mới nhất hiện nay, xuất xứ thương hiệu đồng hồ của Đức nổi tiếng hàng đầu về sự chính xác và bền bỉ trong nghệ thuật chế tác đồng hồ, sản phẩm mang phong cách sang trọng quý tộc và thanh lịch, cuốn hút ngay từ cái nhìn đầu tiên với phong cách classic đầy tinh tế khi trang bị cho mình vòng bezel đính đá Swarovski', 'bentley-bl1707-101lwww-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 350, 5000000, 0.1, '2022-10-21 05:15:36', '2022-10-21 05:15:36', 'Bentley', 'IDWM'),
('Product0013', 'CITIZEN ECO DRIVE-BM7480', 'Đồng hồ Citizen BM7480-81L chính hãng, một thiết kế mới nhất của Citizen Japan năm 2022. Với chất liệu thép không gỉ 316L cao cấp, thiết kế măt số học trò to rõ đễ quan sát cùng bộ kim dạ quang sáng rõ cả trong bóng tối, mặt xanh lam dâyd sang trong. Bộ máy Eco-Drive bền bỉ có thể hoạt động với tuổi thọ trên 10 năm.', 'citizen-eco-drive-bm7480-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 500, 5000000, 0.1, '2022-10-21 05:26:06', '2022-10-21 05:26:06', 'Citizen', 'IDM'),
('Product0014', 'CITIZEN AG835186E', 'Đồng hồ nam Citizen AG8351-86E nổi bật đồng hồ 6 kim và các chức năng lịch ngày với thiết kế độc đáo phân ra 3 ô riêng biệt mang đậm nét cá tính trên nền mặt số tone đen mạnh mẽ.', 'citizen-ag835186e-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 500, 18500000, 0.1, '2022-10-21 05:29:38', '2022-10-21 05:29:38', 'Citizen', 'IDM'),
('Product0015', 'CITIZEN EM0710-54Y', 'Đồng Hồ Nữ Citizen EM0710-54Y Chính Hãng. Đồng Hồ CitizenEco-Drive Women\'s Jolie Diamond EM0710-54Y có mặt số tròn, kim chỉ thanh mãnh,các nút chỉ giờ đính kim cương nổi bật trên nền số xà cừ màu hồng hiếm có, dây đeo stainless steel đem đến phong cách sang trọng và đẳng cấp cho phái nữ.', 'citizen-em0710-54y-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 660, 2200000, 0.1, '2022-10-21 05:35:37', '2022-10-21 05:35:37', 'Citizen', 'IDWM'),
('Product0016', 'CITIZEN ER0212-50D', 'Citizen Quartz ER0212-50D có đường kính 30 mm và độ dày 6.7 mm. Mặt kính được làm bằng chất liệu kính khoáng. Khung vỏ được làm bằng chất liệu thép không gỉ 316L. Bên trong khung vỏ là bộ máy quartz có độ chính xác cao. Dây đeo được làm bằng thép không gỉ và được mạ màu vàng gold (yellow gold) bằng công nghệ PVD.', 'citizen-er0212-50d-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 420, 1230000, 0.35, '2022-10-21 05:40:29', '2022-10-21 05:40:29', 'Citizen', 'IDWM'),
('Product0017', 'OLYM PIANUS OP99141-71AGK-T', 'Đồng hồ Olym Pianus OP99141-71AGK-GL-T là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99141-71AGK-GL-T kính cong vòm huyền thoại là một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế hiện đại cũng như chất lượng sản phẩm mang tới cho khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99141-71agk-t-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 900, 10190000, 0.15, '2022-10-21 11:57:54', '2022-10-21 11:57:54', 'Olym', 'IDM'),
('Product0018', 'OLYM PIANUS OP9946.1AGK-T', 'Đồng hồ Olym Pianus được ra đời từ những thập niên 50, trải qua suốt quá trình phát triển trên thị trường đồng hồ OP đã dần khẳng định là một trong những thương hiệu tầm trung có tiếng và được nhiều người yêu thích sử dụng. Mỗi thiết kế trong dòng OP luôn được cải tiến đổi mới cho phù hợp với lứa tuổi và thời gian hiện đại. Trong những năm trở lại đây đồng hồ OP được đưa vào thị trường Việt Nam, đã làm hài lòng đại đa số những người sử dụng về chất lượng cũng như mẫu mã sản phẩm.', 'olym-pianus-op9946-1agk-t-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 510, 7410000, 0.35, '2022-10-21 12:03:21', '2022-10-21 12:03:21', 'Olym', 'IDM'),
('Product0019', 'OLYM PIANUS OP990-143AGR-GL-XL', 'Olym Pianus OP990-45ADGS-GL-T  là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội, mang một diện mạo phong thái phóng khoáng và vô cùng sang trọng giúp nó nổi bật ở bất cứ nơi đâu, đây là một trong những sản phẩm nổi bật của thương hiệu Olym Pianus, có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op990-143agr-gl-xl-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 1000, 5125000, 0.3, '2022-10-21 12:09:02', '2022-10-21 12:09:02', 'Olym', 'IDM'),
('Product0020', 'OLYM PIANUS OP9941-84AGK-GL-V', 'Đồng hồ Olym Pianus OP99411-84AGK-GL-T là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGK-GL-T là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op9941-84agk-gl-v-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 888, 9500000, 0.22, '2022-10-21 12:14:32', '2022-10-21 12:14:32', 'Olym', 'IDM'),
('Product0021', 'OLYM PIANUS OP9908-88AGSK-XL', 'Mẫu đồng hồ Automatic khẳng định giá trị của mình ở ngay thiết kế lộ máy, được biết đến như “trái tym” của OP9908-88AGSK-GL-T. Đối với anh em thích khám phá chắc hẳn rất thích nhìn chuyển động của bộ máy dưới lớp kính.Tuyệt vời hơn khi nhà sản xuất chế tác thang đo dự trữ với chiếc kim xăng hiển thị thời gian trữ cót đặt ngay giờ thứ 12. Niềm khao khát của nhiều quý ông khi hầu như thiết kế này chỉ thấy ở phân khúc đắt tiền. Ở vị trí 6h lộ diện chiếc đồng hồ 60 giây và chiếc kim nhỏ. Một tính năng được hoàn thiện thêm nhưng càng giúp OP9908-88AGSK-GL-T đánh bóng thêm đẳng cấp của mình.', 'op9908-88agsk-xl-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 756, 7530000, 0.37, '2022-10-21 12:16:51', '2022-10-21 12:16:51', 'Olym', 'IDM'),
('Product0022', 'OLYM PIANUS OP990-15AMSK-T', 'Đồng hồ Olym Pianuss Skeleton OP990-15AMSK-T chính hãng, chất liệu thép không gỉ mạ đờmi, thiết kế thời trang cao cấp, thấy máy hoạt động cùng kính chống trầy, máy auotmmatic', 'olym-pianus-op990-15amsk-t-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 1500, 4300000, 0.08, '2022-10-21 12:28:16', '2022-10-21 12:28:16', 'Olym', 'IDM'),
('Product0023', 'OLYM PIANUS OP99411-84AGSK-V', 'Đồng hồ Olym Pianus OP99411-84AGSK-V là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGSK-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99411-84agsk-v-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 100, 3500000, 0.45, '2022-10-21 12:32:40', '2022-10-21 12:32:40', 'Olym', 'IDM'),
('Product0024', 'OLYM PIANUS OP99411-84AGS-X', 'Đồng hồ Olym Pianus OP99411-84AGS-X là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99411-84ags-x-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 795, 6000000, 0.25, '2022-10-21 12:38:37', '2022-10-21 12:38:37', 'Olym', 'IDM'),
('Product0025', 'OLYM PIANUS OP99411-84AGS-D', 'Đồng hồ Olym Pianus OP99411-84AGS-D là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99411-84ags-d-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 154, 4586000, 0.13, '2022-10-21 12:41:14', '2022-10-21 12:41:14', 'Olym', 'IDM'),
('Product0026', 'OLYM PIANUS LA BÀN OP9943AGS-GL-D-KD', 'Đồng hồ Olym Pianus La Bàn OP9943AGS-GL-D-KD là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-la-ban-op9943ags-gl-d-kd-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 426, 12500000, 0.35, '2022-10-21 12:46:25', '2022-10-21 12:46:25', 'Olym', 'IDM'),
('Product0027', 'Olym Pianus Fusion OP990-45ADDGR-X', 'Olym Pianus Fusion OP990-45ADDGR-X. Sở hữu Case size 42mm, bezel size 40mm cực vừa vặn, tay nhỏ cũng đeo được. Có 2 phiên bản dây thép (SS) và dây cao su rất phù hợp cho mùa hè nóng bức và hay dùng nước, độ bền cực cao. Kính sapphire nguyên khối + bezel đính đá cực chắc chắn và sáng giúp tổng thể thiết kế trở lên Sang trọng - Đẳng cấp. Bộ máy Automatic quen thuộc của nhà OP - độ trữ cót 40H, chạy chính xác + bền bỉ.', 'olym-pianus-fusion-op990-45addgr-x-op990-45-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 956, 11510000, 0.13, '2022-10-21 12:49:17', '2022-10-21 12:49:17', 'Olym', 'IDM'),
('Product0028', 'OLYM PIANUS OP99411-84AGK-GL-XL', 'Đồng hồ Olym Pianus OP99411-84AGK-GL-XL là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGK-GL-T là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op99411-84agk-gl-xl-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 426, 9900000, 0.05, '2022-10-21 12:53:09', '2022-10-21 12:53:09', 'Olym', 'IDM'),
('Product0029', 'OLYM PIANUS OP990-45ADGS-GL-T', 'Olym Pianus OP990-45ADGS-GL-T  là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội, mang một diện mạo phong thái phóng khoáng và vô cùng sang trọng giúp nó nổi bật ở bất cứ nơi đâu, đây là một trong những sản phẩm nổi bật của thương hiệu Olym Pianus, có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op990-45adgs-gl-t-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 642, 99500000, 0.33, '2022-10-21 13:01:05', '2022-10-21 13:01:05', 'Olym', 'IDM'),
('Product0030', 'OLYM PIANUS OP990-45ADGR-GL-D', 'Đồng hồ Olym Pianus OP990-45ADGR-GL-D là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-op990-45adgr-gl-d-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 36, 2200000, 0.13, '2022-10-21 13:07:11', '2022-10-21 13:07:11', 'Olym', 'IDM'),
('Product0031', 'OLYM PIANUS 9946.1AGS', 'Đồng hồ Olym Pianus 9946.1AGS là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-9946-1ags-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 100, 99142000, 0.35, '2022-10-21 13:09:53', '2022-10-21 13:09:53', 'Olym', 'IDM'),
('Product0032', 'OLYM PIANUS 899833G1B', 'Đồng hồ Olym Pianus 899833G1B là một thương hiệu đồng hồ Nhật Bản nổi tiếng bền bỉ với chất lượng vượt trội. Đồng hồ Olym Pianus OP99411-84AGS-X là mẫu đồng hồ cơ mới nhất 2019 với độ hoàn thiện hoàn hảo, một trong những thương hiệu đồng hồ hiếm hoi có giá thành vừa phải mà vẫn đáp ứng đầy đủ các tiêu chí về thiết kế cũng như chất lượng sản phẩm mang tới khách hàng có những trải nghiệm tuyệt vời nhất.', 'olym-pianus-899833g1b-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 55, 2200000, 0.35, '2022-10-21 13:14:06', '2022-10-21 13:14:06', 'Olym', 'IDM'),
('Product0033', 'OLYM PIANUS OP2467LK-T', 'Thiết kế nhẹ nhàng nhưng đầy nét quý phái. Chắc chắn là điểm thu hút trên cổ tay của người phụ nữ sở hữu chiếc đồng hồ này.Tựa như một thứ trang sức lộng lẫy trên cổ tay người đẹp, OP2467LK-T là sự hòa điệu của sắc vàng quý phái, 4 viên đá quý lấp lánh trên mặt số cùng kiểu thiết kế lắc tay điệu đàng, độc lạ. Từng nấc từng nấc để lộ làn da quyến rũ của chị em trong những khoảng hổng đầy ngụ ý.', 'op2467lk-t-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 451, 10440000, 0.35, '2022-10-21 13:25:31', '2022-10-21 13:25:31', 'Olym', 'IDWM'),
('Product0034', 'OLYM PIANUS OP130-06LS-GL-T', 'Thiết kế nhẹ nhàng nhưng đầy nét quý phái. Chắc chắn là điểm thu hút trên cổ tay của người phụ nữ sở hữu chiếc đồng hồ này.Tựa như một thứ trang sức lộng lẫy trên cổ tay người đẹp, OP130-06LS-GL-T là sự hòa điệu của sắc vàng quý phái, 4 viên đá quý lấp lánh trên mặt số cùng kiểu thiết kế lắc tay điệu đàng, độc lạ. Từng nấc từng nấc để lộ làn da quyến rũ của chị em trong những khoảng hổng đầy ngụ ý.', 'op130-06ls-gl-t-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 333, 1250000, 0, '2022-10-21 13:31:37', '2022-10-21 13:31:37', 'Olym', 'IDWM'),
('Product0035', 'G-SHOCK GM-S5600GB-1', 'Chiếc đồng hồ G-SHOCK màu vàng kim trên nền đen phủ kim loại sở hữu thiết kế nhỏ và gọn hơn. Đường gờ kim loại phủ lớp ion màu vàng kim làm tôn lên vẻ ngoài trang nhã, sang trọng. Nút bấm và chốt cũng được phủ ion màu vàng kim tương phản với phần nền đen tạo nên lớp kim loại thực sự tỏa sáng. Sự kết hợp giữa màu vàng kim sang trọng và màu đen mạnh mẽ làm tôn lên vẻ đẹp lung linh độc đáo của riêng bạn.', 'g-shock-gm-s5600gb-1-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 1000, 6810000, 0.01, '2022-10-21 13:35:39', '2022-10-21 13:35:39', 'Shock', 'IDM'),
('Product0036', 'G-SHOCK GMA-S2100SK-2A', 'Hãy đeo lên tay chiếc đồng hồ GA-2100 kết hợp kim-số, phủ kim loại trong suốt, vốn được ưa chuộng nay càng trở nên thu hút với thiết kế thanh mảnh và nhỏ gọn hơn. Chiếc đồng hồ sở hữu thiết kế kim loại trong suốt với nhiều màu cho bạn lựa chọn là phụ kiện linh hoạt, phù hợp với mọi loại trang phục trong suốt cả năm. Các vạch chỉ giờ được xử lý bằng phương pháp lắng đọng hơi bán mờ tạo nên vẻ ngoài bằng kim loại trong suốt sống động như thật.', 'g-shock-gma-s2100sk-2a-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 858, 4242000, 0.09, '2022-10-21 13:40:32', '2022-10-21 13:40:32', 'Shock', 'IDM'),
('Product0037', 'G-SHOCK GMA-S120SR-7A', 'Xin trân trọng giới thiệu mẫu G-SHOCK . Xuất hiện từ những năm 1990, phong cách trong suốt từng rất phổ biến và trở thành một phần không thể thiếu trong lịch sử của G-SHOCK .\r\nPhần mặt được dát lớp vỏ kim loại màu vàng hồng kết hợp cùng thiết kế chắc chắn đã tạo nên một mẫu đồng hồ đeo tay phù hợp với mọi hoàn cảnh, từ thời trang hiện đại cho đến thời trang đường phố và thường nhật.', 'g-shock-gma-s120sr-7a-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 444, 5010000, 0.11, '2022-10-21 13:47:11', '2022-10-21 13:47:11', 'Shock', 'IDWM'),
('Product0038', 'G-SHOCK GMA-S110CW-7A2', 'Xin trân trọng giới thiệu mẫu G-SHOCK . Xuất hiện từ những năm 1990, phong cách trong suốt từng rất phổ biến và trở thành một phần không thể thiếu trong lịch sử của G-SHOCK .\r\nPhần mặt được dát lớp vỏ kim loại màu vàng hồng kết hợp cùng thiết kế chắc chắn đã tạo nên một mẫu đồng hồ đeo tay phù hợp với mọi hoàn cảnh, từ thời trang hiện đại cho đến thời trang đường phố và thường nhật.', 'gma-s110cw-7a2-1.png,cat.gif,cat.gif,cat.gif,cat.gif,cat.gif', 222, 4984000, 0.31, '2022-10-21 13:47:11', '2022-10-21 13:47:11', 'Shock', 'IDWM');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID_Role` varchar(10) NOT NULL COMMENT 'role table primary key',
  `Type` tinyint(1) NOT NULL COMMENT '0 is admin or 1 is user',
  `Type_Name` varchar(20) NOT NULL COMMENT 'Admin or user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID_Role`, `Type`, `Type_Name`) VALUES
('Admin', 0, 'administration'),
('User', 1, 'customter');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction` varchar(20) NOT NULL,
  `ID_Order` varchar(30) NOT NULL COMMENT 'foreign key table order',
  `Create_At` datetime NOT NULL COMMENT 'the time the order is paid',
  `Status` varchar(15) NOT NULL COMMENT 'Is the order status paid?',
  `Update_At` datetime NOT NULL COMMENT 'payment status update',
  `Description` text DEFAULT NULL COMMENT 'payment status description',
  `ID_Method` varchar(20) NOT NULL COMMENT 'foreign key table payment methods'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction`, `ID_Order`, `Create_At`, `Status`, `Update_At`, `Description`, `ID_Method`) VALUES
('Transac00001', 'Order0000001', '2022-10-31 17:35:41', 'Chưa thanh toán', '2022-10-31 17:35:41', 'Giao hàng COD', 'Cod'),
('Transac00002', 'Order0000002', '2022-10-31 17:37:29', 'Đã thanh toán', '2022-10-31 17:37:29', NULL, 'Card'),
('Transac00003', 'Order0000003', '2022-10-31 17:38:12', 'Đã thanh toán', '2022-10-31 17:38:12', NULL, 'Ebp'),
('Transac00004', 'Order0000004', '2022-10-31 17:38:12', 'Đã thanh toán', '2022-10-31 17:38:12', NULL, 'Momo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`ID_Administration`),
  ADD KEY `ID_Role` (`ID_Role`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`ID_Brand`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID_Customer`),
  ADD KEY `ID_Role` (`ID_Role`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`ID_Gender`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`ID_Method`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID_Order`),
  ADD KEY `ID_Customer` (`ID_Customer`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`ID_Detail`),
  ADD KEY `ID_Product` (`ID_Product`),
  ADD KEY `ID_Order` (`ID_Order`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID_Product`),
  ADD KEY `ID_Gender` (`ID_Gender`),
  ADD KEY `ID_Brand` (`ID_Brand`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_Role`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD KEY `ID_Order` (`ID_Order`),
  ADD KEY `ID_Method` (`ID_Method`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administration`
--
ALTER TABLE `administration`
  ADD CONSTRAINT `administration_ibfk_1` FOREIGN KEY (`ID_Role`) REFERENCES `roles` (`ID_Role`) ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`ID_Role`) REFERENCES `roles` (`ID_Role`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ID_Customer`) REFERENCES `customers` (`ID_Customer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`ID_Order`) REFERENCES `orders` (`ID_Order`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`ID_Brand`) REFERENCES `brands` (`ID_Brand`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`ID_Gender`) REFERENCES `gender` (`ID_Gender`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`ID_Method`) REFERENCES `method` (`ID_Method`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`ID_Order`) REFERENCES `orders` (`ID_Order`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
