/*
 Navicat Premium Data Transfer

 Source Server         : DB
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : reporting

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 28/05/2020 14:21:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for event_test
-- ----------------------------
DROP TABLE IF EXISTS `event_test`;
CREATE TABLE `event_test` (
  `id_event` int(50) NOT NULL AUTO_INCREMENT,
  `periode` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `instruktur` varchar(255) NOT NULL,
  `aktif` enum('y','n') NOT NULL DEFAULT 'y',
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_test
-- ----------------------------
BEGIN;
INSERT INTO `event_test` VALUES (1, '2010', '2019-12-11', 'bjb', 'mega', 'n');
INSERT INTO `event_test` VALUES (2, '2002', '2019-12-03', 'banjarmasin', 'nadila mega syafitri', 'n');
INSERT INTO `event_test` VALUES (3, '2019', '2019-12-12', 'banjarmasin', 'nadila mega syafitri', 'y');
COMMIT;

-- ----------------------------
-- Table structure for hasil_test
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of hasil_test
-- ----------------------------
BEGIN;
INSERT INTO `hasil_test` VALUES (31, 4, 3, 13, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (32, 4, 3, 13, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (33, 4, 3, 13, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (34, 4, 3, 13, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (35, 4, 3, 13, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (36, 4, 3, 13, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (37, 4, 3, 13, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (38, 4, 3, 13, 13, '8', 'A', 'B');
INSERT INTO `hasil_test` VALUES (39, 4, 3, 13, 14, '9', 'A', 'B');
INSERT INTO `hasil_test` VALUES (40, 4, 3, 13, 15, '10', 'C', 'B');
INSERT INTO `hasil_test` VALUES (41, 5, 3, 18, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (42, 5, 3, 18, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (43, 5, 3, 18, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (44, 5, 3, 18, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (45, 5, 3, 18, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (46, 5, 3, 18, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (47, 5, 3, 18, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (48, 5, 3, 18, 13, '8', 'A', 'B');
INSERT INTO `hasil_test` VALUES (49, 5, 3, 18, 14, '9', 'A', 'B');
INSERT INTO `hasil_test` VALUES (50, 5, 3, 18, 15, '10', 'D', 'S');
INSERT INTO `hasil_test` VALUES (51, 6, 3, 17, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (52, 6, 3, 17, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (53, 6, 3, 17, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (54, 6, 3, 17, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (55, 6, 3, 17, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (56, 6, 3, 17, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (57, 6, 3, 17, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (58, 6, 3, 17, 13, '8', 'A', 'B');
INSERT INTO `hasil_test` VALUES (59, 6, 3, 17, 14, '9', 'B', 'S');
INSERT INTO `hasil_test` VALUES (60, 6, 3, 17, 15, '10', 'B', 'S');
INSERT INTO `hasil_test` VALUES (61, 7, 3, 15, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (62, 7, 3, 15, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (63, 7, 3, 15, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (64, 7, 3, 15, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (65, 7, 3, 15, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (66, 7, 3, 15, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (67, 7, 3, 15, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (68, 7, 3, 15, 13, '8', 'B', 'S');
INSERT INTO `hasil_test` VALUES (69, 7, 3, 15, 14, '9', 'B', 'S');
INSERT INTO `hasil_test` VALUES (70, 7, 3, 15, 15, '10', 'B', 'S');
INSERT INTO `hasil_test` VALUES (71, 8, 3, 19, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (72, 8, 3, 19, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (73, 8, 3, 19, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (74, 8, 3, 19, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (75, 8, 3, 19, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (76, 8, 3, 19, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (77, 8, 3, 19, 12, '7', 'B', 'S');
INSERT INTO `hasil_test` VALUES (78, 8, 3, 19, 13, '8', 'B', 'S');
INSERT INTO `hasil_test` VALUES (79, 8, 3, 19, 14, '9', 'B', 'S');
INSERT INTO `hasil_test` VALUES (80, 8, 3, 19, 15, '10', 'B', 'S');
INSERT INTO `hasil_test` VALUES (81, 9, 3, 22, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (82, 9, 3, 22, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (83, 9, 3, 22, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (84, 9, 3, 22, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (85, 9, 3, 22, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (86, 9, 3, 22, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (87, 9, 3, 22, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (88, 9, 3, 22, 13, '8', 'A', 'B');
INSERT INTO `hasil_test` VALUES (89, 9, 3, 22, 14, '9', 'A', 'B');
INSERT INTO `hasil_test` VALUES (90, 9, 3, 22, 15, '10', 'D', 'S');
INSERT INTO `hasil_test` VALUES (91, 10, 3, 23, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (92, 10, 3, 23, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (93, 10, 3, 23, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (94, 10, 3, 23, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (95, 10, 3, 23, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (96, 10, 3, 23, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (97, 10, 3, 23, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (98, 10, 3, 23, 13, '8', 'C', 'S');
INSERT INTO `hasil_test` VALUES (99, 10, 3, 23, 14, '9', 'A', 'B');
INSERT INTO `hasil_test` VALUES (100, 10, 3, 23, 15, '10', 'C', 'B');
INSERT INTO `hasil_test` VALUES (101, 11, 3, 25, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (102, 11, 3, 25, 7, '2', 'D', 'S');
INSERT INTO `hasil_test` VALUES (103, 11, 3, 25, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (104, 11, 3, 25, 9, '4', 'C', 'S');
INSERT INTO `hasil_test` VALUES (105, 11, 3, 25, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (106, 11, 3, 25, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (107, 11, 3, 25, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (108, 11, 3, 25, 13, '8', 'A', 'B');
INSERT INTO `hasil_test` VALUES (109, 11, 3, 25, 14, '9', 'A', 'B');
INSERT INTO `hasil_test` VALUES (110, 11, 3, 25, 15, '10', 'C', 'B');
INSERT INTO `hasil_test` VALUES (111, 12, 3, 24, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (112, 12, 3, 24, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (113, 12, 3, 24, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (114, 12, 3, 24, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (115, 12, 3, 24, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (116, 12, 3, 24, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (117, 12, 3, 24, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (118, 12, 3, 24, 13, '8', 'B', 'S');
INSERT INTO `hasil_test` VALUES (119, 12, 3, 24, 14, '9', 'D', 'S');
INSERT INTO `hasil_test` VALUES (120, 12, 3, 24, 15, '10', 'C', 'B');
INSERT INTO `hasil_test` VALUES (121, 13, 3, 26, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (122, 13, 3, 26, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (123, 13, 3, 26, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (124, 13, 3, 26, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (125, 13, 3, 26, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (126, 13, 3, 26, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (127, 13, 3, 26, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (128, 13, 3, 26, 13, '8', 'C', 'S');
INSERT INTO `hasil_test` VALUES (129, 13, 3, 26, 14, '9', 'D', 'S');
INSERT INTO `hasil_test` VALUES (130, 13, 3, 26, 15, '10', 'C', 'B');
INSERT INTO `hasil_test` VALUES (131, 14, 3, 28, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (132, 14, 3, 28, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (133, 14, 3, 28, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (134, 14, 3, 28, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (135, 14, 3, 28, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (136, 14, 3, 28, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (137, 14, 3, 28, 12, '7', 'D', 'S');
INSERT INTO `hasil_test` VALUES (138, 14, 3, 28, 13, '8', 'C', 'S');
INSERT INTO `hasil_test` VALUES (139, 14, 3, 28, 14, '9', 'C', 'S');
INSERT INTO `hasil_test` VALUES (140, 14, 3, 28, 15, '10', 'C', 'B');
INSERT INTO `hasil_test` VALUES (141, 15, 3, 27, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (142, 15, 3, 27, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (143, 15, 3, 27, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (144, 15, 3, 27, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (145, 15, 3, 27, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (146, 15, 3, 27, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (147, 15, 3, 27, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (148, 15, 3, 27, 13, '8', 'A', 'B');
INSERT INTO `hasil_test` VALUES (149, 15, 3, 27, 14, '9', 'A', 'B');
INSERT INTO `hasil_test` VALUES (150, 15, 3, 27, 15, '10', 'C', 'B');
INSERT INTO `hasil_test` VALUES (151, 16, 3, 29, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (152, 16, 3, 29, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (153, 16, 3, 29, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (154, 16, 3, 29, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (155, 16, 3, 29, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (156, 16, 3, 29, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (157, 16, 3, 29, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (158, 16, 3, 29, 13, '8', 'C', 'S');
INSERT INTO `hasil_test` VALUES (159, 16, 3, 29, 14, '9', 'A', 'B');
INSERT INTO `hasil_test` VALUES (160, 16, 3, 29, 15, '10', 'C', 'B');
INSERT INTO `hasil_test` VALUES (161, 17, 3, 32, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (162, 17, 3, 32, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (163, 17, 3, 32, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (164, 17, 3, 32, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (165, 17, 3, 32, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (166, 17, 3, 32, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (167, 17, 3, 32, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (168, 17, 3, 32, 13, '8', 'A', 'B');
INSERT INTO `hasil_test` VALUES (169, 17, 3, 32, 14, '9', 'A', 'B');
INSERT INTO `hasil_test` VALUES (170, 17, 3, 32, 15, '10', 'D', 'S');
INSERT INTO `hasil_test` VALUES (171, 18, 3, 31, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (172, 18, 3, 31, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (173, 18, 3, 31, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (174, 18, 3, 31, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (175, 18, 3, 31, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (176, 18, 3, 31, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (177, 18, 3, 31, 12, '7', 'A', 'S');
INSERT INTO `hasil_test` VALUES (178, 18, 3, 31, 13, '8', 'D', 'S');
INSERT INTO `hasil_test` VALUES (179, 18, 3, 31, 14, '9', 'D', 'S');
INSERT INTO `hasil_test` VALUES (180, 18, 3, 31, 15, '10', 'C', 'B');
INSERT INTO `hasil_test` VALUES (181, 19, 3, 30, 6, '1', 'A', 'B');
INSERT INTO `hasil_test` VALUES (182, 19, 3, 30, 7, '2', 'A', 'B');
INSERT INTO `hasil_test` VALUES (183, 19, 3, 30, 8, '3', 'D', 'B');
INSERT INTO `hasil_test` VALUES (184, 19, 3, 30, 9, '4', 'D', 'B');
INSERT INTO `hasil_test` VALUES (185, 19, 3, 30, 10, '5', 'C', 'B');
INSERT INTO `hasil_test` VALUES (186, 19, 3, 30, 11, '6', 'A', 'B');
INSERT INTO `hasil_test` VALUES (187, 19, 3, 30, 12, '7', 'C', 'B');
INSERT INTO `hasil_test` VALUES (188, 19, 3, 30, 13, '8', 'A', 'B');
INSERT INTO `hasil_test` VALUES (189, 19, 3, 30, 14, '9', 'A', 'B');
INSERT INTO `hasil_test` VALUES (190, 19, 3, 30, 15, '10', 'C', 'B');
COMMIT;

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kelas
-- ----------------------------
BEGIN;
INSERT INTO `kelas` VALUES (1, 'Kelas d');
INSERT INTO `kelas` VALUES (2, 'kelas f');
COMMIT;

-- ----------------------------
-- Table structure for mapel
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mapel
-- ----------------------------
BEGIN;
INSERT INTO `mapel` VALUES (1, 1, 1, 'MTK', 'Ts deskripsi');
INSERT INTO `mapel` VALUES (2, 2, 1, 'UPA', '-');
COMMIT;

-- ----------------------------
-- Table structure for penjadwalan
-- ----------------------------
DROP TABLE IF EXISTS `penjadwalan`;
CREATE TABLE `penjadwalan` (
  `id_penjadwalan` int(255) NOT NULL,
  `id_mapel` int(255) NOT NULL,
  `id_kelas` int(255) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tanggal_upload` date NOT NULL,
  PRIMARY KEY (`id_penjadwalan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of penjadwalan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for peserta_event
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of peserta_event
-- ----------------------------
BEGIN;
INSERT INTO `peserta_event` VALUES (4, 3, 12, 'l');
INSERT INTO `peserta_event` VALUES (5, 3, 16, 'l');
INSERT INTO `peserta_event` VALUES (6, 3, 13, 'l');
INSERT INTO `peserta_event` VALUES (7, 3, 18, 'l');
INSERT INTO `peserta_event` VALUES (8, 3, 17, 'l');
INSERT INTO `peserta_event` VALUES (9, 3, 15, 'l');
INSERT INTO `peserta_event` VALUES (10, 3, 19, 'l');
INSERT INTO `peserta_event` VALUES (11, 3, 22, 'l');
INSERT INTO `peserta_event` VALUES (12, 3, 23, 'l');
INSERT INTO `peserta_event` VALUES (13, 3, 24, 'l');
INSERT INTO `peserta_event` VALUES (14, 3, 25, 'l');
INSERT INTO `peserta_event` VALUES (15, 3, 26, 'l');
INSERT INTO `peserta_event` VALUES (16, 3, 28, 'l');
INSERT INTO `peserta_event` VALUES (17, 3, 27, 'l');
INSERT INTO `peserta_event` VALUES (18, 3, 29, 'l');
INSERT INTO `peserta_event` VALUES (19, 3, 32, 'l');
INSERT INTO `peserta_event` VALUES (20, 3, 31, 'l');
INSERT INTO `peserta_event` VALUES (21, 3, 30, 'l');
COMMIT;

-- ----------------------------
-- Table structure for soal
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of soal
-- ----------------------------
BEGIN;
INSERT INTO `soal` VALUES (6, 'A00001', 'Perawatan adalah suatu tindakan terhadap unit agar :', 'Unit dapat bekerja dengan baik dan siap pakai', 'Penampilan dapat melebihi dari standarnya', 'Dapat terlihat lebih bersih dan cantik', 'Engine tidak over heat (panas berlebih)', 'A', '', 'Y');
INSERT INTO `soal` VALUES (7, 'A00002', 'Kapan pengecekan oli hidrolik dilakukan :', 'Pada saat engine mati', 'Pada saat engine hidup low idle ( putaran engine rendah)', 'Pada saat engine mati dan engine low iddle( putaran engine rendah)', 'Setelah selesai operasi', 'A', '', 'Y');
INSERT INTO `soal` VALUES (8, 'A00003', 'Jika jumlah dari oil engine berlebih maka efek yang akan terjadi adalah :', 'Engine akan cepat panas ', 'Engine akan low power (tenaga kurang)', 'Tenaga engine bertambah', 'Jawaban A dan B benar', 'D', '', 'Y');
INSERT INTO `soal` VALUES (9, 'A00004', 'Syarat â€“ syarat pemeriksaan Hydraulic oil (oli hidrolik) pada PC45MR-3 yang paling tepat adalah :', 'Parkir ditempat sembarang, turunkan attachment, matikan engine serta periksalah gelas penduga yang terdapat pada tangki Hydraulic', 'Parkir ditempat yang rata, engine dalam keadan hidup , periksa gelas penduga oil Hydraulicnya', 'Parkir ditempat yang rata dengan melepas safety lever', 'Periksa ditempat yang rata turunkan semua Attachment (alat kerja), matikan engine serta periksalah gelas penduga yang terdapat pada tangki Hydraulic', 'D', '', 'Y');
INSERT INTO `soal` VALUES (10, 'A00005', 'Jenis cairan yang di rekomendasikan untuk pengisian radiator :', 'Sembarangan air asalkan tidak mengandung lumpur', 'Air sumur', 'Komposisi 30 â€“ 68% Supercoolant AFNAC dengan air.', 'Air sungai yang sudah di saring dengan kain', 'C', '', 'Y');
INSERT INTO `soal` VALUES (11, 'A00006', 'Apakah nama gambar/simbol diatas :', 'Charge level monitor (Monitor battrey charging).', 'Engine water temperatur monitor (Pengukur Suhu Air Engine).', 'Hydraulic oil temperature gauge (Pengukur Suhu Oli Hidrolik).', 'Torque converter oil temperatur (Pengukur Suhu Oli Torque Converter).', 'A', '601.PNG', 'Y');
INSERT INTO `soal` VALUES (12, 'A00007', 'Apakah nama gambar/simbol diatas ini :', 'Nomer seri unit', 'Engine Code', 'Hours Meter', 'Maintenance meter', 'C', '412.PNG', 'Y');
INSERT INTO `soal` VALUES (13, 'A00008', 'Apakah nama gambar/simbol diatas ini :', 'Engine water level monitor (Pengukur jumlah Air Engine). ', 'Engine water temperatur monitor (Pengukur Suhu Air Engine).', 'Hydraulic oil temperature gauge (Pengukur Suhu Oli Hidrolik)', 'Torque converter oil temperatur monitor (Pengukur Suhu Oli Torque Converter).', 'A', '703.PNG', 'Y');
INSERT INTO `soal` VALUES (14, 'A00009', 'Apakah maksud dari gambar/simbol diatas:', 'Menginformasikan waktu maintenance telah lewat', 'Menginformasikan waktu maintenance akan masuk 30 HM lagi', 'Menginformasikan waktu service berkala pertama', 'Menginformasikan ada kerusakan komponen pada unit', 'A', '214.PNG', 'Y');
INSERT INTO `soal` VALUES (15, 'A00010', 'Apa nama switch diatas ini :', 'AC switch', 'Function switch', 'Monitor panel switch', 'Mirror heater switch', 'C', '125.PNG', 'Y');
COMMIT;

-- ----------------------------
-- Table structure for test
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of test
-- ----------------------------
BEGIN;
INSERT INTO `test` VALUES (2, 12, 3, '100', 'l', 'Wheel Loader', '50', 'tl');
INSERT INTO `test` VALUES (3, 16, 3, '50', 'tl', '', '', NULL);
INSERT INTO `test` VALUES (4, 13, 3, '100', 'l', 'Wheel Loader', '90', 'l');
INSERT INTO `test` VALUES (5, 18, 3, '90', 'l', 'Wheel Loader', '90', 'l');
INSERT INTO `test` VALUES (6, 17, 3, '80', 'l', 'Wheel Loader', '70', 'l');
INSERT INTO `test` VALUES (7, 15, 3, '70', 'l', 'Wheel Loader', '85', 'l');
INSERT INTO `test` VALUES (8, 19, 3, '60', 'tl', '', '', NULL);
INSERT INTO `test` VALUES (9, 22, 3, '90', 'l', 'Wheel Loader', '65', 'tl');
INSERT INTO `test` VALUES (10, 23, 3, '90', 'l', 'Wheel Loader', '70', 'l');
INSERT INTO `test` VALUES (11, 25, 3, '80', 'l', 'Wheel Loader', '56', 'tl');
INSERT INTO `test` VALUES (12, 24, 3, '80', 'l', 'Wheel Loader', '77', 'l');
INSERT INTO `test` VALUES (13, 26, 3, '80', 'l', 'Wheel Loader', '66', 'tl');
INSERT INTO `test` VALUES (14, 28, 3, '70', 'l', 'Wheel Loader', '60', 'tl');
INSERT INTO `test` VALUES (15, 27, 3, '100', 'l', 'Wheel Loader', '97', 'l');
INSERT INTO `test` VALUES (16, 29, 3, '90', 'l', 'Wheel Loader', '88', 'l');
INSERT INTO `test` VALUES (17, 32, 3, '90', 'l', 'Wheel Loader', '89', 'l');
INSERT INTO `test` VALUES (18, 31, 3, '70', 'l', 'Wheel Loader', '77', 'l');
INSERT INTO `test` VALUES (19, 30, 3, '100', 'l', 'Wheel Loader', '75', 'l');
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, '12345', 'nadila mega syafitri', 'banjarmasin', '1998-03-05', 'Laki-laki', 'nadilamegaysyafitri@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', 'Instruktur/admin', '45mega1.jpg', 'Admin');
INSERT INTO `user` VALUES (11, '1111', 'admin', 'Pasuruan', '1998-01-15', 'Laki-laki', 'admin@gmail.com', 'admin', 'Banjarbaru', 'Admin', '', 'Admin');
INSERT INTO `user` VALUES (12, '4675657', 'Dewi Indriani', 'Pasuruan', '1998-01-02', 'Laki-laki', 'dewi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'PT TIRTA KENCANA', 'Mekanik', '26blehhh.jpg', 'User');
INSERT INTO `user` VALUES (13, '91217063', 'wili', 'Pasuruan', '0019-03-05', 'Laki-laki', 'wili@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'PT SEJAHTERA ABADI', 'Mekanik', '29kebo.png', 'User');
INSERT INTO `user` VALUES (15, '6789678', 'sella', 'Bandung', '1996-01-07', 'Perempuan', 'sella@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'PT Sabumi', 'Operator', '', 'User');
INSERT INTO `user` VALUES (16, '', 'cantik', '', '0000-00-00', 'Laki-laki', 'cantik@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (17, '', 'Suci Indari', '', '0000-00-00', 'Laki-laki', 'suci@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (18, '', 'Tamzidillah', '', '0000-00-00', 'Laki-laki', 'tamzidillah@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (19, '', 'Nadia Meilanda', '', '0000-00-00', 'Laki-laki', 'nadia@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (20, '', 'Naufal Fadilah', '', '0000-00-00', 'Laki-laki', 'naufal@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (21, '', 'Syafitri Nadia', '', '0000-00-00', 'Laki-laki', 'syafitri@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (22, '', 'Muhammad Fadlan Noor', '', '0000-00-00', 'Laki-laki', 'memed@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (23, '', 'Maulita Yasmin', '', '0000-00-00', 'Laki-laki', 'yasmin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (24, '', 'Andre Taulani', '', '0000-00-00', 'Laki-laki', 'andre@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (25, '', 'Panji Laras', '', '0000-00-00', 'Laki-laki', 'panji@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (26, '', 'Fadel Muhammad', '', '0000-00-00', 'Laki-laki', 'fadel@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (27, '', 'Akhmad Reza', '', '0000-00-00', 'Laki-laki', 'reza@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (28, '', 'Thomas Yuda', '', '0000-00-00', 'Laki-laki', 'yuda@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (29, '', 'Gilang Dirga', '', '0000-00-00', 'Laki-laki', 'gilang@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (30, '', 'Fajar', '', '0000-00-00', 'Laki-laki', 'fajar@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (31, '', 'ginanjar', '', '0000-00-00', 'Laki-laki', 'ginanjar@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
INSERT INTO `user` VALUES (32, '', 'putra Ari', '', '0000-00-00', 'Laki-laki', 'putra@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 'User');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
