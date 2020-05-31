# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.26)
# Database: reporting
# Generation Time: 2020-05-30 02:30:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table event_test
# ------------------------------------------------------------

DROP TABLE IF EXISTS `event_test`;

CREATE TABLE `event_test` (
  `id_event` int(50) NOT NULL AUTO_INCREMENT,
  `periode` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `instruktur` varchar(255) NOT NULL,
  `aktif` enum('y','n') NOT NULL DEFAULT 'y',
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `event_test` WRITE;
/*!40000 ALTER TABLE `event_test` DISABLE KEYS */;

INSERT INTO `event_test` (`id_event`, `periode`, `tanggal`, `tempat`, `instruktur`, `aktif`)
VALUES
	(1,'2010','2019-12-11','bjb','mega','n'),
	(2,'2002','2019-12-03','banjarmasin','nadila mega syafitri','n'),
	(3,'2019','2019-12-12','banjarmasin','nadila mega syafitri','y');

/*!40000 ALTER TABLE `event_test` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table hasil_test
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hasil_test`;

CREATE TABLE `hasil_test` (
  `id_hasil_test` int(255) NOT NULL AUTO_INCREMENT,
  `id_test` int(255) NOT NULL,
  `id_event` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_soal` int(255) NOT NULL,
  `nomor_soal` varchar(255) NOT NULL,
  `jawaban` varchar(15) NOT NULL,
  `b_s` varchar(1) NOT NULL,
  PRIMARY KEY (`id_hasil_test`),
  KEY `id_event` (`id_event`),
  KEY `id_soal` (`id_soal`),
  KEY `id_user` (`id_user`),
  KEY `id_test` (`id_test`),
  CONSTRAINT `hasil_test_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event_test` (`id_event`),
  CONSTRAINT `hasil_test_ibfk_2` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`),
  CONSTRAINT `hasil_test_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `hasil_test_ibfk_4` FOREIGN KEY (`id_test`) REFERENCES `test` (`id_test`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `hasil_test` WRITE;
/*!40000 ALTER TABLE `hasil_test` DISABLE KEYS */;

INSERT INTO `hasil_test` (`id_hasil_test`, `id_test`, `id_event`, `id_user`, `id_soal`, `nomor_soal`, `jawaban`, `b_s`)
VALUES
	(31,4,3,13,6,'1','A','B'),
	(32,4,3,13,7,'2','A','B'),
	(33,4,3,13,8,'3','D','B'),
	(34,4,3,13,9,'4','D','B'),
	(35,4,3,13,10,'5','C','B'),
	(36,4,3,13,11,'6','A','B'),
	(37,4,3,13,12,'7','C','B'),
	(38,4,3,13,13,'8','A','B'),
	(39,4,3,13,14,'9','A','B'),
	(40,4,3,13,15,'10','C','B'),
	(41,5,3,18,6,'1','A','B'),
	(42,5,3,18,7,'2','A','B'),
	(43,5,3,18,8,'3','D','B'),
	(44,5,3,18,9,'4','D','B'),
	(45,5,3,18,10,'5','C','B'),
	(46,5,3,18,11,'6','A','B'),
	(47,5,3,18,12,'7','C','B'),
	(48,5,3,18,13,'8','A','B'),
	(49,5,3,18,14,'9','A','B'),
	(50,5,3,18,15,'10','D','S'),
	(61,7,3,15,6,'1','A','B'),
	(62,7,3,15,7,'2','A','B'),
	(63,7,3,15,8,'3','D','B'),
	(64,7,3,15,9,'4','D','B'),
	(65,7,3,15,10,'5','C','B'),
	(66,7,3,15,11,'6','A','B'),
	(67,7,3,15,12,'7','C','B'),
	(68,7,3,15,13,'8','B','S'),
	(69,7,3,15,14,'9','B','S'),
	(70,7,3,15,15,'10','B','S'),
	(71,8,3,19,6,'1','A','B'),
	(72,8,3,19,7,'2','A','B'),
	(73,8,3,19,8,'3','D','B'),
	(74,8,3,19,9,'4','D','B'),
	(75,8,3,19,10,'5','C','B'),
	(76,8,3,19,11,'6','A','B'),
	(77,8,3,19,12,'7','B','S'),
	(78,8,3,19,13,'8','B','S'),
	(79,8,3,19,14,'9','B','S'),
	(80,8,3,19,15,'10','B','S'),
	(81,9,3,22,6,'1','A','B'),
	(82,9,3,22,7,'2','A','B'),
	(83,9,3,22,8,'3','D','B'),
	(84,9,3,22,9,'4','D','B'),
	(85,9,3,22,10,'5','C','B'),
	(86,9,3,22,11,'6','A','B'),
	(87,9,3,22,12,'7','C','B'),
	(88,9,3,22,13,'8','A','B'),
	(89,9,3,22,14,'9','A','B'),
	(90,9,3,22,15,'10','D','S'),
	(91,10,3,23,6,'1','A','B'),
	(92,10,3,23,7,'2','A','B'),
	(93,10,3,23,8,'3','D','B'),
	(94,10,3,23,9,'4','D','B'),
	(95,10,3,23,10,'5','C','B'),
	(96,10,3,23,11,'6','A','B'),
	(97,10,3,23,12,'7','C','B'),
	(98,10,3,23,13,'8','C','S'),
	(99,10,3,23,14,'9','A','B'),
	(100,10,3,23,15,'10','C','B'),
	(101,11,3,25,6,'1','A','B'),
	(102,11,3,25,7,'2','D','S'),
	(103,11,3,25,8,'3','D','B'),
	(104,11,3,25,9,'4','C','S'),
	(105,11,3,25,10,'5','C','B'),
	(106,11,3,25,11,'6','A','B'),
	(107,11,3,25,12,'7','C','B'),
	(108,11,3,25,13,'8','A','B'),
	(109,11,3,25,14,'9','A','B'),
	(110,11,3,25,15,'10','C','B'),
	(111,12,3,24,6,'1','A','B'),
	(112,12,3,24,7,'2','A','B'),
	(113,12,3,24,8,'3','D','B'),
	(114,12,3,24,9,'4','D','B'),
	(115,12,3,24,10,'5','C','B'),
	(116,12,3,24,11,'6','A','B'),
	(117,12,3,24,12,'7','C','B'),
	(118,12,3,24,13,'8','B','S'),
	(119,12,3,24,14,'9','D','S'),
	(120,12,3,24,15,'10','C','B'),
	(121,13,3,26,6,'1','A','B'),
	(122,13,3,26,7,'2','A','B'),
	(123,13,3,26,8,'3','D','B'),
	(124,13,3,26,9,'4','D','B'),
	(125,13,3,26,10,'5','C','B'),
	(126,13,3,26,11,'6','A','B'),
	(127,13,3,26,12,'7','C','B'),
	(128,13,3,26,13,'8','C','S'),
	(129,13,3,26,14,'9','D','S'),
	(130,13,3,26,15,'10','C','B'),
	(131,14,3,28,6,'1','A','B'),
	(132,14,3,28,7,'2','A','B'),
	(133,14,3,28,8,'3','D','B'),
	(134,14,3,28,9,'4','D','B'),
	(135,14,3,28,10,'5','C','B'),
	(136,14,3,28,11,'6','A','B'),
	(137,14,3,28,12,'7','D','S'),
	(138,14,3,28,13,'8','C','S'),
	(139,14,3,28,14,'9','C','S'),
	(140,14,3,28,15,'10','C','B'),
	(141,15,3,27,6,'1','A','B'),
	(142,15,3,27,7,'2','A','B'),
	(143,15,3,27,8,'3','D','B'),
	(144,15,3,27,9,'4','D','B'),
	(145,15,3,27,10,'5','C','B'),
	(146,15,3,27,11,'6','A','B'),
	(147,15,3,27,12,'7','C','B'),
	(148,15,3,27,13,'8','A','B'),
	(149,15,3,27,14,'9','A','B'),
	(150,15,3,27,15,'10','C','B'),
	(151,16,3,29,6,'1','A','B'),
	(152,16,3,29,7,'2','A','B'),
	(153,16,3,29,8,'3','D','B'),
	(154,16,3,29,9,'4','D','B'),
	(155,16,3,29,10,'5','C','B'),
	(156,16,3,29,11,'6','A','B'),
	(157,16,3,29,12,'7','C','B'),
	(158,16,3,29,13,'8','C','S'),
	(159,16,3,29,14,'9','A','B'),
	(160,16,3,29,15,'10','C','B'),
	(161,17,3,32,6,'1','A','B'),
	(162,17,3,32,7,'2','A','B'),
	(163,17,3,32,8,'3','D','B'),
	(164,17,3,32,9,'4','D','B'),
	(165,17,3,32,10,'5','C','B'),
	(166,17,3,32,11,'6','A','B'),
	(167,17,3,32,12,'7','C','B'),
	(168,17,3,32,13,'8','A','B'),
	(169,17,3,32,14,'9','A','B'),
	(170,17,3,32,15,'10','D','S'),
	(171,18,3,31,6,'1','A','B'),
	(172,18,3,31,7,'2','A','B'),
	(173,18,3,31,8,'3','D','B'),
	(174,18,3,31,9,'4','D','B'),
	(175,18,3,31,10,'5','C','B'),
	(176,18,3,31,11,'6','A','B'),
	(177,18,3,31,12,'7','A','S'),
	(178,18,3,31,13,'8','D','S'),
	(179,18,3,31,14,'9','D','S'),
	(180,18,3,31,15,'10','C','B'),
	(181,19,3,30,6,'1','A','B'),
	(182,19,3,30,7,'2','A','B'),
	(183,19,3,30,8,'3','D','B'),
	(184,19,3,30,9,'4','D','B'),
	(185,19,3,30,10,'5','C','B'),
	(186,19,3,30,11,'6','A','B'),
	(187,19,3,30,12,'7','C','B'),
	(188,19,3,30,13,'8','A','B'),
	(189,19,3,30,14,'9','A','B'),
	(190,19,3,30,15,'10','C','B');

/*!40000 ALTER TABLE `hasil_test` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kelas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;

INSERT INTO `kelas` (`id_kelas`, `kelas`)
VALUES
	(1,'Kelas d'),
	(2,'kelas f');

/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mapel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mapel`;

CREATE TABLE `mapel` (
  `id_mapel` int(255) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_mapel`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `id_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `mapel` WRITE;
/*!40000 ALTER TABLE `mapel` DISABLE KEYS */;

INSERT INTO `mapel` (`id_mapel`, `id_kelas`, `id_user`, `mapel`, `deskripsi`)
VALUES
	(1,1,1,'MTK','Ts deskripsi'),
	(2,2,1,'UPA','-');

/*!40000 ALTER TABLE `mapel` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table materi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `materi`;

CREATE TABLE `materi` (
  `id_materi` int(255) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(255) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tanggal_upload` date NOT NULL,
  PRIMARY KEY (`id_materi`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `materi` WRITE;
/*!40000 ALTER TABLE `materi` DISABLE KEYS */;

INSERT INTO `materi` (`id_materi`, `id_mapel`, `judul`, `file`, `tanggal_upload`)
VALUES
	(5,1,'Baru','62HASIL-SEMINAR-PROPOSAL-16630624 (3).pdf','2020-05-29');

/*!40000 ALTER TABLE `materi` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table penjadwalan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `penjadwalan`;

CREATE TABLE `penjadwalan` (
  `id_penjadwalan` int(255) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(255) NOT NULL,
  `id_kelas` int(255) NOT NULL,
  `file` varchar(255) DEFAULT '',
  `tanggal_upload` date NOT NULL,
  PRIMARY KEY (`id_penjadwalan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table peserta_event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `peserta_event`;

CREATE TABLE `peserta_event` (
  `id_peserta` int(255) NOT NULL AUTO_INCREMENT,
  `id_event` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `pembayaran` enum('l','bl') NOT NULL,
  PRIMARY KEY (`id_peserta`),
  KEY `id_event` (`id_event`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `peserta_event_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event_test` (`id_event`),
  CONSTRAINT `peserta_event_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `peserta_event` WRITE;
/*!40000 ALTER TABLE `peserta_event` DISABLE KEYS */;

INSERT INTO `peserta_event` (`id_peserta`, `id_event`, `id_user`, `pembayaran`)
VALUES
	(4,3,12,'l'),
	(6,3,13,'l'),
	(7,3,18,'l'),
	(9,3,15,'l'),
	(10,3,19,'l'),
	(11,3,22,'l'),
	(12,3,23,'l'),
	(13,3,24,'l'),
	(14,3,25,'l'),
	(15,3,26,'l'),
	(16,3,28,'l'),
	(17,3,27,'l'),
	(18,3,29,'l'),
	(19,3,32,'l'),
	(20,3,31,'l'),
	(21,3,30,'l'),
	(24,3,17,'l');

/*!40000 ALTER TABLE `peserta_event` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table soal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `soal`;

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `kode_soal` varchar(10) NOT NULL,
  `soal` text NOT NULL,
  `a` varchar(255) NOT NULL,
  `b` varchar(255) NOT NULL,
  `c` varchar(255) NOT NULL,
  `d` varchar(255) NOT NULL,
  `jawaban` varchar(1) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `soal` WRITE;
/*!40000 ALTER TABLE `soal` DISABLE KEYS */;

INSERT INTO `soal` (`id_soal`, `kode_soal`, `soal`, `a`, `b`, `c`, `d`, `jawaban`, `gambar`, `aktif`)
VALUES
	(6,'A00001','Perawatan adalah suatu tindakan terhadap unit agar :','Unit dapat bekerja dengan baik dan siap pakai','Penampilan dapat melebihi dari standarnya','Dapat terlihat lebih bersih dan cantik','Engine tidak over heat (panas berlebih)','A','','Y'),
	(7,'A00002','Kapan pengecekan oli hidrolik dilakukan :','Pada saat engine mati','Pada saat engine hidup low idle ( putaran engine rendah)','Pada saat engine mati dan engine low iddle( putaran engine rendah)','Setelah selesai operasi','A','','Y'),
	(8,'A00003','Jika jumlah dari oil engine berlebih maka efek yang akan terjadi adalah :','Engine akan cepat panas ','Engine akan low power (tenaga kurang)','Tenaga engine bertambah','Jawaban A dan B benar','D','','Y'),
	(9,'A00004','Syarat â€“ syarat pemeriksaan Hydraulic oil (oli hidrolik) pada PC45MR-3 yang paling tepat adalah :','Parkir ditempat sembarang, turunkan attachment, matikan engine serta periksalah gelas penduga yang terdapat pada tangki Hydraulic','Parkir ditempat yang rata, engine dalam keadan hidup , periksa gelas penduga oil Hydraulicnya','Parkir ditempat yang rata dengan melepas safety lever','Periksa ditempat yang rata turunkan semua Attachment (alat kerja), matikan engine serta periksalah gelas penduga yang terdapat pada tangki Hydraulic','D','','Y'),
	(10,'A00005','Jenis cairan yang di rekomendasikan untuk pengisian radiator :','Sembarangan air asalkan tidak mengandung lumpur','Air sumur','Komposisi 30 â€“ 68% Supercoolant AFNAC dengan air.','Air sungai yang sudah di saring dengan kain','C','','Y'),
	(11,'A00006','Apakah nama gambar/simbol diatas :','Charge level monitor (Monitor battrey charging).','Engine water temperatur monitor (Pengukur Suhu Air Engine).','Hydraulic oil temperature gauge (Pengukur Suhu Oli Hidrolik).','Torque converter oil temperatur (Pengukur Suhu Oli Torque Converter).','A','601.PNG','Y'),
	(12,'A00007','Apakah nama gambar/simbol diatas ini :','Nomer seri unit','Engine Code','Hours Meter','Maintenance meter','C','412.PNG','Y'),
	(13,'A00008','Apakah nama gambar/simbol diatas ini :','Engine water level monitor (Pengukur jumlah Air Engine). ','Engine water temperatur monitor (Pengukur Suhu Air Engine).','Hydraulic oil temperature gauge (Pengukur Suhu Oli Hidrolik)','Torque converter oil temperatur monitor (Pengukur Suhu Oli Torque Converter).','A','703.PNG','Y'),
	(14,'A00009','Apakah maksud dari gambar/simbol diatas:','Menginformasikan waktu maintenance telah lewat','Menginformasikan waktu maintenance akan masuk 30 HM lagi','Menginformasikan waktu service berkala pertama','Menginformasikan ada kerusakan komponen pada unit','A','214.PNG','Y'),
	(15,'A00010','Apa nama switch diatas ini :','AC switch','Function switch','Monitor panel switch','Mirror heater switch','C','125.PNG','Y');

/*!40000 ALTER TABLE `soal` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table test
# ------------------------------------------------------------

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `id_test` int(255) NOT NULL AUTO_INCREMENT,
  `id_user` int(255) NOT NULL,
  `id_event` int(255) NOT NULL,
  `nilai_teori` varchar(255) NOT NULL,
  `status_teori` enum('l','tl') NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `nilai_praktek` varchar(255) NOT NULL,
  `status_praktek` enum('l','tl') DEFAULT NULL,
  PRIMARY KEY (`id_test`),
  KEY `id_user` (`id_user`),
  KEY `id_event` (`id_event`),
  CONSTRAINT `test_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `test_ibfk_2` FOREIGN KEY (`id_event`) REFERENCES `event_test` (`id_event`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;

INSERT INTO `test` (`id_test`, `id_user`, `id_event`, `nilai_teori`, `status_teori`, `kategori`, `nilai_praktek`, `status_praktek`)
VALUES
	(2,12,3,'100','l','Wheel Loader','50','tl'),
	(4,13,3,'100','l','Wheel Loader','90','l'),
	(5,18,3,'90','l','Wheel Loader','90','l'),
	(7,15,3,'70','l','Wheel Loader','85','l'),
	(8,19,3,'60','tl','','',NULL),
	(9,22,3,'90','l','Wheel Loader','65','tl'),
	(10,23,3,'90','l','Wheel Loader','70','l'),
	(11,25,3,'80','l','Wheel Loader','56','tl'),
	(12,24,3,'80','l','Wheel Loader','77','l'),
	(13,26,3,'80','l','Wheel Loader','66','tl'),
	(14,28,3,'70','l','Wheel Loader','60','tl'),
	(15,27,3,'100','l','Wheel Loader','97','l'),
	(16,29,3,'90','l','Wheel Loader','88','l'),
	(17,32,3,'90','l','Wheel Loader','89','l'),
	(18,31,3,'70','l','Wheel Loader','77','l'),
	(19,30,3,'100','l','Wheel Loader','75','l');

/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL AUTO_INCREMENT,
  `nrp` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `level` enum('Admin','User') NOT NULL DEFAULT 'User',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id_user`, `nrp`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jk`, `email`, `pass`, `asal`, `jabatan`, `foto`, `level`)
VALUES
	(1,'12345','nadila mega syafitri','banjarmasin','1998-03-05','Laki-laki','nadilamegaysyafitri@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','','Instruktur/admin','45mega1.jpg','Admin'),
	(11,'1111','admin','Pasuruan','1998-01-15','Laki-laki','admin@gmail.com','admin','Banjarbaru','Admin','','Admin'),
	(12,'4675657','Dewi Indriani','Pasuruan','1998-01-02','Laki-laki','dewi@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','PT TIRTA KENCANA','Mekanik','26blehhh.jpg','User'),
	(13,'91217063','wili','Pasuruan','0019-03-05','Laki-laki','wili@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','PT SEJAHTERA ABADI','Mekanik','29kebo.png','User'),
	(15,'6789678','sella','Bandung','1996-01-07','Perempuan','sella@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','PT Sabumi','Operator','','User'),
	(17,'123121','Tri Angga Utama, S.kom','Banjarbaru','1997-03-04','Laki-laki','trianggategarutama@gmail.com','1fd5cd9766249f170035b7251e2c6b61','Banjarbaru','Staff','71avatar.png','User');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
