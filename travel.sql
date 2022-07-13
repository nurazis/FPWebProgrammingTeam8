-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2021 at 03:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `f_name`, `l_name`, `tanggal_lahir`, `no_telp`, `email`, `username`, `password`) VALUES
(1, 'Muhammad', 'Nur Azis Mujiono', '2001-06-08', '085348371038', 'muhammad.nurazis27@gmail.com', 'nurazis', '1915026044');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `f_name`, `l_name`, `tanggal_lahir`, `no_telp`, `email`, `username`, `password`) VALUES
(1, 'Muhammad', 'Risqi Maulana', '2001-11-09', '081253830786', 'risqimaulana59@gmail.com', 'mrisqimaulana', '$2y$10$JINqsTRrFTnyDLZ/JVfOcOLya0/yOfYYx4d1f.eIquRdoE0ZBZH3C'),
(3, 'Afif', 'Ali Imron', '2001-02-26', '085243515416', 'afifaliimron@gmail.com', 'apipbaik', '$2y$10$M2FyaGxh0PjrvzpEnHA4ueV8iNFOE.qbq5PVYbhEbRciQkKPN1FgS');

-- --------------------------------------------------------

--
-- Table structure for table `kupon`
--

CREATE TABLE `kupon` (
  `id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `disc` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kupon`
--

INSERT INTO `kupon` (`id`, `kode`, `disc`) VALUES
(3, 'NEWYEAR2022', 0.3),
(4, 'BYE2021', 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `harga` int(11) NOT NULL,
  `image` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `nama`, `deskripsi`, `keterangan`, `tanggal_berangkat`, `harga`, `image`) VALUES
(1, 'Tour Ubud', 'Apabila anda bertanya, dimanakah pusat seni dan budaya di Bali? Pastilah sebagian besar orang yang telah mengenal Bali akan menjawab, Ubud. Tidak hanya seni dan budaya, Ubud juga menawarkan keindahan alam pedesaan yang masih alami dan sangat terjaga pelestariaanya. Selain terkenal akan pusat seni dan budaya, Ubud juga terkenal akan pusat perbelanjaan, baik barang cendramata ataupun barang bermerk. Selain toko-toko yang menjual kerajinan, di tempat wisata Ubud, banyak tersedia tempat makan dari berbagai negara. Bagi yang suka dengan wisata kuliner Bali, Ubud memberikan banyak fasilitas tempat makan, mulai dari warung sederhana sampai ke restoran mewah.', 'Durasi dari paket tour Ubud, 12 Jam. Paket tour Ubud sudah termasuk transportasi pariwisata full AC dengan supir + BBM. Harga paket wisata sudah termasuk tiket masuk ke obyek wisata di Bali, sesuai dengan objek wisata yang tercantum dalam paket tour Ubud. Termasuk biaya parkir. Biaya makan siang di restoran Bebek Bengil Ubud.', '2021-11-29', 74000, 'https://drive.google.com/uc?export=view&id=1NEONRlTcweyGnALYn8KzysXndE1O1ert'),
(2, 'Tour Gili', 'Gili Trawangan bisa menjadi jawaban atas kebingungan anda. Paket wisata yang kami tawarkan sudah termasuk antar jemput hotel, glass bottom boat untuk snorkeling dan trip keliling Gili Trawangan menggunakan sepeda. Anda dapat menikmati keindahan pulaunya, suasana, pantai hingga alam bawah lautnya dengan terumbu karang yang indah dan ikan-ikan yang berenang mengelilingi anda saat sedang bersnorkeling.', 'Transportasi AC untuk antar jemput dari hotel ke Pelabuhan Teluk Nare PP, Private Glass Bottom Boat untuk trip snorkeling di Gili Trawangan, Gili Air dan Gili Meno, Perlengkapan snorkeling, Sewa sepeda saat di Gili Trawangan, Satu kali makan siang di Gili Trawangan, Profesional Guide.', '2022-01-31', 1050000, 'https://drive.google.com/uc?export=view&id=1bD7Yf_hnFiE17M-6chGJFrtKMPB54gLW'),
(3, 'Tour Raja Ampat', 'Raja Ampat merupakan salah satu kabupaten yang berada di provinsi papua barat, 75% wilayah raja ampat adalah lautan dengan bukit batu karts atau karang yang menjulang tinggi sejak ratusan tahun lalu. Wilayah perairan merupakan daya tarik utama Raja Ampat, mengingat perairan Raja Ampat adalah salah satu dari 10 perairan terbaik di seluruh dunia dan hal ini menjadikannya benar benar istimewa serta harus senantiasa terjaga alam dan kekayaan flora faunanya. Hasil penelitian ini berdasarkan riset mendalam yang dilakukan oleh sejumlah pakar profesioanl di bidang kelautan dan wisata terhadap kekayaaan flora fauna. Sampai disini kami harap Anda sudah mengerti mengapa Anda harus ke raja ampat.', 'Tiket Pesawat Pulang Pergi, Private Car, Private Speedboat, Pemandu Profesional, Berbahasa Indonesia, Makan Siang dan Makan Malam.', '2022-02-14', 2500000, 'https://drive.google.com/uc?export=view&id=1lGuGFcG3vGVOYorQ-2CGBYZufdjiG03n'),
(9, 'Tour Wakatobi', 'Wakatobi menyimpan sejuta pesona wisata, mulai dari keindahan wisata bawah laut, wisata pantai, peninggalan bersejarah, hingga seni budaya. Setelah ditetapkan sebagai salah satu dari sepuluh destinasi wisata prioritas oleh pemerintah pusat, Wakatobi terus berbenah. Wakatobi pada 2016 memang ditetapkan pemerintah menjadi salah satu dari sepuluh destinasi pariwisata prioritas di Indonesia. Destinasi prioritas lainnya adalah Borobudur, Danau Toba, Taman Nasional Bromo, Tengger, Semeru; Pulau Komodo, Pulau Seribu, Tanjung Kelayang, Mandalika, Wakatobi, Morotai, dan Tanjung Lesung.', 'Antar jemput di bandara Wangi-wangi/wakatobi, Rental mobil untuk city tour, Makan 8x, Sewa peralatan snorkeling dan pelampung, Biaya taman nasional (tidak ada harga tiket khusus, bentuknya berupa sumbangan ke TN tiap pulau harus berdonasi), Snack dan air mineral, Guide, Asuransi selama kegiatan tour sampai dengan Rp. 50.000.000', '2021-12-26', 800000, 'https://drive.google.com/uc?export=view&id=1WJoXspFy6VxBfKzvTgn1eEH7ZYxIpd2k');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_resev` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_kupon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_resev`, `tanggal`, `jumlah`, `total`, `id_user`, `id_paket`, `id_kupon`) VALUES
(1, '2021-11-23', 5, 1000000, 1, 1, 3),
(2, '2021-11-30', 3, 600000, 1, 3, 3),
(3, '2021-11-24', 2, 3750000, 1, 3, 3),
(6, '2021-11-27', 5, 277500, 1, 1, 3),
(7, '2021-11-29', 2, 1470000, 1, 2, 3),
(8, '2021-11-30', 2, 1120000, 3, 9, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kupon`
--
ALTER TABLE `kupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_resev`),
  ADD KEY `FK_kupon` (`id_kupon`),
  ADD KEY `FK_user` (`id_user`),
  ADD KEY `FK_paket` (`id_paket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kupon`
--
ALTER TABLE `kupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_resev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `FK_kupon` FOREIGN KEY (`id_kupon`) REFERENCES `kupon` (`id`),
  ADD CONSTRAINT `FK_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id`),
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`id_user`) REFERENCES `akun` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
