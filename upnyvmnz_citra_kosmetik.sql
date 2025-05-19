-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2025 at 09:21 PM
-- Server version: 10.6.21-MariaDB-cll-lve
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upnyvmnz_citra_kosmetik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama`, `email`, `password`) VALUES
(1, 'aulia', 'auliafitri0813@gmail.com', '12345678'),
(2, 'putri', 'putri@gmail.com', '12345678'),
(3, 'Elin Ardina', 'elin@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alamat`
--

CREATE TABLE `tbl_alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` char(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jalan` varchar(100) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_alamat`
--

INSERT INTO `tbl_alamat` (`id_alamat`, `id_user`, `id_pembeli`, `nama`, `no_telp`, `alamat`, `jalan`, `detail`, `flag`) VALUES
(20, 13, 12, 'Putri Iqlima', '081269814116', 'Aceh, Lhokseumawe', 'Blangpulo', 'Gg. Inmaraf', 1),
(11, 14, 13, 'pipit', '089617833718', 'provinsi aceh, kota bireuen, 2425', 'jl laksamana malahayati, kecamatan kota juang, kabuppaten bireuen', 'desa pulo kiton lorong family', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favorite`
--

CREATE TABLE `tbl_favorite` (
  `id_favorite` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_favorite`
--

INSERT INTO `tbl_favorite` (`id_favorite`, `id_user`, `id_pembeli`, `id_produk`, `merek`, `harga`) VALUES
(27, 13, 12, 1, 'Wardah Perfect Bright + Oil Control', 30000),
(28, 13, 12, 16, 'Pixy Intense To Last Pen Eyeliner', 67000),
(35, 15, 14, 1, 'Wardah Perfect Bright + Oil Control', 30000),
(40, 13, 12, 12, 'Pixy UV Whitening Loose Powder', 33000),
(41, 14, 13, 1, 'Wardah Perfect Bright + Oil Control', 30000),
(43, 13, 12, 10, 'Wardah Lightening Night Cream', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id_keranjang`, `id_user`, `id_pembeli`, `id_produk`, `merek`, `quantity`) VALUES
(20, 14, 13, 1, 'Wardah Perfect Bright + Oil Control', 4),
(21, 14, 13, 3, 'Wardah Nature Daily', 1),
(31, 15, 14, 7, 'THE ORIGINOTE', 1),
(38, 13, 12, 3, 'Wardah Nature Daily', 4),
(40, 13, 12, 1, 'Wardah Perfect Bright + Oil Control', 2),
(41, 13, 12, 8, 'Facetology', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id_laporan` int(11) NOT NULL,
  `rentang_waktu` int(11) NOT NULL,
  `total` decimal(15,0) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `keuntungan` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_laporan`
--

INSERT INTO `tbl_laporan` (`id_laporan`, `rentang_waktu`, `total`, `merek`, `keuntungan`) VALUES
(1, 70, 45000, 'wardah', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembeli`
--

CREATE TABLE `tbl_pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Perempuan','Laki-laki') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` char(20) NOT NULL,
  `id_alamat` int(11) DEFAULT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pembeli`
--

INSERT INTO `tbl_pembeli` (`id_pembeli`, `id_user`, `nama`, `jenis_kelamin`, `tgl_lahir`, `email`, `no_telp`, `id_alamat`, `gambar`) VALUES
(12, 13, 'putri iqlima', 'Perempuan', '2004-07-13', 'putriiqlima04@gmail.com', '081269814116', 20, 'Gambar WhatsApp 2025-05-12 pukul 06.23.53_aaa1069f.jpg'),
(13, 14, 'aulia', 'Perempuan', '0000-00-00', 'auliafitri0813@gmail.com', '089617833718', 0, ''),
(14, 15, 'Elin Ardina', 'Perempuan', '0000-00-00', 'elin@gmail.com', '082276029561', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jumlah_terjual` int(11) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `harga` decimal(15,0) NOT NULL,
  `total` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `produk` varchar(100) NOT NULL,
  `harga` decimal(15,0) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(15,0) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `kategori`, `jenis`, `merek`, `deskripsi`, `harga`, `stok`, `gambar`) VALUES
(1, 'Skincare Dasar', 'Facial Wash', 'Wardah Perfect Bright + Oil Control', 'Mengontrol produksi minyak hingga 12 jam dan membersihkan kulit tanpa rasa ketarik, cerah, sehat dan bebas kilap', 30000, 0, 'Picture1.jpg,681f7fa2ed414-Picture1.jpg,681f7fb45c4ae-Picture2.jpg'),
(3, 'Skincare Dasar', 'Toner', 'Wardah Nature Daily', 'Mengandung ekstrak 100% aloe vera untuk melembabkan dan menyegarkan kulit. Terdapat juga allantoin untuk menenangkan dan melembutkan kulit', 20000, 58, 'toner.jpg,681f80efa8b51-Picture3.jpg,681f810209ff7-Picture4.jpg'),
(6, 'Skincare Dasar', 'Moisturizer', 'Glad2Glow', 'Moisturizer dengan kandungan Pomegranate dan Niacinamide yang dapat mencerahkan sekaligus membantu meratakan warna kulit. Memiliki tekstur ringan yang mudah meresap, dapat digunankan pada pagi dan malam hari.', 45000, 19, '681f7cf47b9a7-image_750x_669a2032205be.jpg,681f7d4f71b4f-eBay-2.jpg,681f7d60712f1-audit-si.jpg'),
(7, 'Perawatan Wajah', 'Serum', 'THE ORIGINOTE', 'Serum yang diformulasikan dengan 5 jenis Ceramide dan Duo Poptides dan Honey Blend yang dapat membantu merawat skin barrier, menjaga kelembaban kulit, menyegarkan kulit serta menyejukkan kulit yang teriritasi ringan.', 38000, 29, '681f802c1e493-serum 1.jpg,681f802c1e92e-serum 2.jpg,681f802c1ecfc-serum 3.jpg'),
(8, 'Perawatan Wajah', 'Sunscreen', 'Facetology', 'Facetology Triple Care Sunscreen memiliki beberapa kegunaan utama: melindungi kulit dari sinar matahari (UVA, UVB, dan blue light), mencerahkan kulit, dan menenangkan kulit. Produk ini juga mengandung bahan yang membantu mengontrol minyak dan mencegah jerawat. ', 60000, 29, '681f8125d2e99-sun 1.jpg,681f8125d3107-sun 2.jpg,681f8125d326a-sun 3.jpg'),
(10, 'Perawatan Wajah', 'Night Cream', 'Wardah Lightening Night Cream', 'WARDAH LIGHTENING NIGHT CREAM merupakan krim pelembab malam yang membantu mencerahkan, melembabkan, dan menutrisi kulit wajah sepanjang malam.', 40000, 26, '681f824da488f-cream wardah 1.jpg,681f824da4d59-cream wardah 2.jpg,681f824da508c-cream wardah 3.jpg'),
(11, 'Makeup Wajah', 'Cushion', 'Pixy Make It Glow Dewi Cushion', 'Dewy Cushion merupakan base makeup yang memiliki formula cair dan dipadukan dengan sponge khusus untuk menciptakan makeup yang memiliki daya tutup tinggi namun tetap terasa ringan saat digunakan. Kandungan Olive Oil, Jojoba Oil, dan Yuzu ekstrak berfungsi sebagai pelembab sekaligus dapat mencerahkan wajah. Memberikan hasil makeup yang glowy secara maksimal tanpa membuat kulit wajah terasa berminyak. Mengandung SPF 23 & PA++. Cara pemakaian yang praktis, hanya dengan sekali tap-tap pada wajah, membuat tampilan makeup tampak sempurna dan natural. ', 127000, 30, '681f82c042a6e-Picture5.jpg,681f82dbe4313-Picture6.jpg,681f82f8942de-Picture7.jpg'),
(12, 'Makeup Wajah', 'Compact Powder', 'Pixy UV Whitening Loose Powder', 'Bedak dengan tekstur sangat halus, memberikan tampilan wajah tampak halus sempurna, pori-pori tersamarkan dan tahan lama.', 33000, 25, '681f839a1ac32-Powder 1.jpg,681f839a1b084-powder 2.jpg,681f839a1b22c-Powder 3.jpg'),
(13, 'Makeup Wajah', 'Blush On', 'Pixy Twin Blush', 'PIXY Blush Blush on powder dengan tekstur yang lembut dan pigmentasi yang dapat di-build up. Membuat wajah terlihat segar, sehat, dan merona dengan hasil akhir glow sesuai dengan tampilan makeup glam. Tekstur Lembut Non-cakey Ringan dikulit Buildable Pigmentation Mudah diblend', 50000, 25, '681f845674067-Picture9.jpg,681f845674563-Picture8.jpg,681fa0a7e6079-pixy1.jpg'),
(14, 'Makeup Mata', 'Mascara', 'ESENSES', 'Mascara Esenses umumnya digunakan untuk menambah volume dan panjang bulu mata, serta membuatnya tampak lebih lentik dan indah. Maskara ini juga seringkali memiliki formula waterproof yang membuat riasan mata tahan lama, tidak luntur saat terkena air atau keringat. ', 29000, 38, '681f84d774554-mas 1.jpg,681f84d77488d-mas 2.jpg,681f84d774a64-mas 3.jpg'),
(15, 'Makeup Mata', 'Eyeshadow', 'PinkFlash', 'Dengan formula yang berpigmen tinggi memiliki hasil warna yang intens. Mudah di aplikasikan dengan halus dan merata. Memberikan adhesi fantastis yang mudah dibaurkan dengan tekstur yang berbeda.', 52000, 50, '681f8616ba73a-Picture12.jpg,681f8616ba94f-Picture11.jpg,681fa0e4a7698-eyeshadow.jpg'),
(16, 'Makeup Wajah', 'Eyeliner', 'Pixy Intense To Last Pen Eyeliner', 'Eyeliner smudge proof berbentuk pen dengan hasil akhir matte yang tahan hingga 14 jam. Aplikator mudah untuk membentuk garis tipis maupun tebal yang presisi dengan warna hitam yang intens dalam sekali oles.', 67000, 34, '681f864bea57f-eye 1.jpg,681f864bea9c2-eye 2.jpg,681f864beacbe-eye 3.jpg'),
(17, 'Haircare', 'Shampoo', 'Sunsilk', 'Dengan ekstrak urang aring dan diamond shine technology untuk rambut hitam berkilau sehingga rambut terlihat lebih tebal, terjaga kelembabannya indah dan berkilau mempesona, mengembalikan warna rambut kusam serta rambut tampak lebih sehat.', 17000, 25, '681f87dd9ed6e-Picture14.jpg,681f87dd9efc7-Picture15.jpg,681f87dd9f14e-Picture16.jpg'),
(18, 'Haircare', 'Vitamin Rambut', 'ellips', 'Vitamin rambut Ellips berguna untuk merawat dan menutrisi rambut, terutama yang rusak, kering, dan bercabang. Ellips juga membantu melindungi rambut dari kerusakan akibat proses kimiawi, panas dari alat styling, dan paparan sinar matahari. Selain itu, vitamin rambut ini dapat membantu menjaga warna rambut hitam tetap berkilau dan sehat. ', 17000, 40, '681f88242f259-vit r 1.jpg,681f88242f6b0-vit r 2.jpg,681f88242f9b8-vit r 3.jpg'),
(19, 'Haircare', 'Pengharum Rambut', 'Makarizo', 'Makarizo Hair Energy Scentsations memiliki beberapa kegunaan utama sebagai pengharum rambut. Selain memberikan aroma yang harum dan segar, produk ini juga dapat membantu menetralkan bau tidak sedap pada rambut, membantu mengembalikan kelembapan dan kekuatan rambut, serta memberikan perlindungan UV. Produk ini juga dapat membantu mengurangi rambut mengembang dan membuat rambut lebih berkilau. ', 31000, 19, '681f88a70469a-pengharum r 1.jpg,681f88a7048ca-pengharum r 2.jpg,681f88a704a2b-pengharum r 3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `email`, `password`, `no_telp`) VALUES
(13, 'putri iqlima', 'putriiqlima04@gmail.com', '$2y$10$ZW/p8M9jvR5U9aBEz4hdkOETfog1sfmSCSiuPcfykV0K/bT0E3urS', '081269814116'),
(14, 'aulia', 'auliafitri0813@gmail.com', '$2y$10$Ez8UtMs3j9hbEDUY3PTuUelZ.ivrwY4H2TwwivDlh8A0pRShzlJ9m', '089617833718'),
(15, 'Elin Ardina', 'elin@gmail.com', '$2y$10$sBsQvgSzBy/rO8tULFhZZuf6PgQxyenmHuy4JrBAtUh4V890lYz2q', '082276029561');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_alamat`
--
ALTER TABLE `tbl_alamat`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indexes for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  ADD PRIMARY KEY (`id_favorite`),
  ADD KEY `fk_user_favorite` (`id_user`),
  ADD KEY `fk_pembeli_favorite` (`id_pembeli`),
  ADD KEY `fk_produk_favorite` (`id_produk`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `fk_user_keranjang` (`id_user`),
  ADD KEY `fk_produk_keranjang` (`id_produk`),
  ADD KEY `fk_pembeli` (`id_pembeli`);

--
-- Indexes for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tbl_pembeli`
--
ALTER TABLE `tbl_pembeli`
  ADD PRIMARY KEY (`id_pembeli`) USING BTREE,
  ADD KEY `fk_user` (`id_user`) USING BTREE;

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_alamat`
--
ALTER TABLE `tbl_alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  MODIFY `id_favorite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pembeli`
--
ALTER TABLE `tbl_pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  ADD CONSTRAINT `fk_pembeli_favorite` FOREIGN KEY (`id_pembeli`) REFERENCES `tbl_pembeli` (`id_pembeli`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_produk_favorite` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_favorite` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD CONSTRAINT `fk_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `tbl_pembeli` (`id_pembeli`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_produk_keranjang` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_keranjang` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_pembeli`
--
ALTER TABLE `tbl_pembeli`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
