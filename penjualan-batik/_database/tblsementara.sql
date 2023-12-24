/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50624
 Source Host           : localhost:3306
 Source Schema         : test1

 Target Server Type    : MySQL
 Target Server Version : 50624
 File Encoding         : 65001

 Date: 04/08/2022 18:49:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tblsementara
-- ----------------------------
DROP TABLE IF EXISTS `tblsementara`;
CREATE TABLE `tblsementara`  (
  `kd_menu` char(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga` int(10) NULL DEFAULT NULL,
  `jumlah` int(5) NULL DEFAULT NULL,
  `subtotal` int(10) NULL DEFAULT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  INDEX `kd_menu`(`kd_menu`) USING BTREE,
  CONSTRAINT `tblsementara_ibfk_1` FOREIGN KEY (`kd_menu`) REFERENCES `tb_menu` (`kd_menu`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
