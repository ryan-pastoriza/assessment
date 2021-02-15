/*
Navicat MySQL Data Transfer

Source Server         : DATASERVER
Source Server Version : 50505
Source Host           : 10.80.20.200:3306
Source Database       : acs

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-02-10 10:07:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for assessment
-- ----------------------------
DROP TABLE IF EXISTS `assessment`;
CREATE TABLE `assessment` (
  `assessmentId` int(11) NOT NULL AUTO_INCREMENT,
  `ssi_id` int(11) DEFAULT NULL,
  `particular` varchar(100) DEFAULT NULL,
  `amt1` double DEFAULT NULL,
  `amt2` double DEFAULT NULL,
  `feeType` varchar(100) DEFAULT NULL,
  `semId` int(11) NOT NULL,
  `syId` int(11) NOT NULL,
  `collectionReportGroup` varchar(100) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`assessmentId`),
  KEY `sem_assessment` (`semId`),
  KEY `sy_assessment` (`syId`),
  CONSTRAINT `sem_assessment` FOREIGN KEY (`semId`) REFERENCES `sem` (`semId`),
  CONSTRAINT `sy_assessment` FOREIGN KEY (`syId`) REFERENCES `sy` (`syId`)
) ENGINE=InnoDB AUTO_INCREMENT=30753 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for collectionreport
-- ----------------------------
DROP TABLE IF EXISTS `collectionreport`;
CREATE TABLE `collectionreport` (
  `collectionReportId` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) DEFAULT NULL,
  `or` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `particular` text,
  `grossReceipt` double DEFAULT NULL,
  `merchandise` double DEFAULT NULL,
  `others` double DEFAULT NULL,
  `unifast` double DEFAULT NULL,
  `specialExam` double DEFAULT NULL,
  `scnl` double DEFAULT NULL,
  `elearning` double DEFAULT NULL,
  `nccuk` double DEFAULT NULL,
  `msfee` double DEFAULT NULL,
  `oracle` double DEFAULT NULL,
  `hp` double DEFAULT NULL,
  `studentServices` double DEFAULT NULL,
  `sap` double DEFAULT NULL,
  `stcab` double DEFAULT NULL,
  `insurance` double DEFAULT NULL,
  `office365` double DEFAULT NULL,
  `shs` double DEFAULT NULL,
  `netR` double DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`collectionReportId`)
) ENGINE=MyISAM AUTO_INCREMENT=3777 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for collectionreportdaily
-- ----------------------------
DROP TABLE IF EXISTS `collectionreportdaily`;
CREATE TABLE `collectionreportdaily` (
  `collectionDailyId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `or` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `CollectionReportGroup` varchar(255) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`collectionDailyId`)
) ENGINE=MyISAM AUTO_INCREMENT=27398 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for discount
-- ----------------------------
DROP TABLE IF EXISTS `discount`;
CREATE TABLE `discount` (
  `discountId` int(11) NOT NULL AUTO_INCREMENT,
  `ssi_id` int(11) DEFAULT NULL,
  `discountDesc` varchar(100) DEFAULT NULL,
  `amt1` double(10,2) DEFAULT NULL,
  `amt2` double(10,2) DEFAULT NULL,
  `semId` int(11) NOT NULL,
  `syId` int(11) NOT NULL,
  PRIMARY KEY (`discountId`),
  KEY `sem_discount` (`semId`),
  KEY `sy_discount` (`syId`),
  CONSTRAINT `sem_discount` FOREIGN KEY (`semId`) REFERENCES `sem` (`semId`),
  CONSTRAINT `sy_discount` FOREIGN KEY (`syId`) REFERENCES `sy` (`syId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for fee_schedule
-- ----------------------------
DROP TABLE IF EXISTS `fee_schedule`;
CREATE TABLE `fee_schedule` (
  `feeSchedId` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(40) DEFAULT NULL,
  `year` varchar(40) DEFAULT NULL,
  `percent` varchar(40) DEFAULT NULL,
  `label` varchar(40) DEFAULT NULL,
  `semId` int(11) NOT NULL,
  `syId` int(11) NOT NULL,
  `payDate` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`feeSchedId`),
  KEY `sem_fee_schedule` (`semId`),
  KEY `sy_fee_schedule` (`syId`),
  CONSTRAINT `sem_fee_schedule` FOREIGN KEY (`semId`) REFERENCES `sem` (`semId`),
  CONSTRAINT `sy_fee_schedule` FOREIGN KEY (`syId`) REFERENCES `sy` (`syId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for or_served
-- ----------------------------
DROP TABLE IF EXISTS `or_served`;
CREATE TABLE `or_served` (
  `os_id` int(11) NOT NULL AUTO_INCREMENT,
  `or` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`os_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for other_payee
-- ----------------------------
DROP TABLE IF EXISTS `other_payee`;
CREATE TABLE `other_payee` (
  `otherPayeeId` int(11) NOT NULL AUTO_INCREMENT,
  `payeeLast` varchar(40) NOT NULL,
  `payeeFirst` varchar(40) DEFAULT NULL,
  `payeeMiddle` varchar(40) DEFAULT NULL,
  `payeeExt` varchar(40) DEFAULT NULL,
  `payeeAddress` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`otherPayeeId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for particulars
-- ----------------------------
DROP TABLE IF EXISTS `particulars`;
CREATE TABLE `particulars` (
  `particularId` int(11) NOT NULL AUTO_INCREMENT,
  `particularName` varchar(100) DEFAULT NULL,
  `amt1` double DEFAULT NULL,
  `amt2` double DEFAULT NULL,
  `courseType` varchar(100) DEFAULT NULL,
  `studentStatus` varchar(100) DEFAULT NULL,
  `feeType` varchar(40) DEFAULT NULL,
  `billType` varchar(20) DEFAULT NULL,
  `semId` int(11) NOT NULL,
  `syId` int(11) NOT NULL,
  `collectionReportGroup` varchar(100) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`particularId`),
  KEY `sy_particulars` (`syId`),
  KEY `sem_particulars` (`semId`),
  CONSTRAINT `sem_particulars` FOREIGN KEY (`semId`) REFERENCES `sem` (`semId`),
  CONSTRAINT `sy_particulars` FOREIGN KEY (`syId`) REFERENCES `sy` (`syId`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for paymentbackup
-- ----------------------------
DROP TABLE IF EXISTS `paymentbackup`;
CREATE TABLE `paymentbackup` (
  `backupId` int(11) NOT NULL AUTO_INCREMENT,
  `ssi_id` int(11) DEFAULT NULL,
  `acctno` varchar(255) DEFAULT NULL,
  `otherPayeeId` int(11) DEFAULT NULL,
  `orNo` varchar(255) DEFAULT NULL,
  `paymentDate` date DEFAULT NULL,
  `amt1` double DEFAULT NULL,
  `amt2` double DEFAULT NULL,
  `paymentMode` varchar(255) DEFAULT NULL,
  `cashier` varchar(255) DEFAULT NULL,
  `syId` varchar(255) DEFAULT '',
  `semId` varchar(255) DEFAULT '',
  `printingType` varchar(255) DEFAULT NULL,
  `paymentStatus` varchar(255) DEFAULT NULL,
  `orStatus` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text,
  PRIMARY KEY (`backupId`)
) ENGINE=MyISAM AUTO_INCREMENT=924 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for paymentdetails
-- ----------------------------
DROP TABLE IF EXISTS `paymentdetails`;
CREATE TABLE `paymentdetails` (
  `paymentDetailsId` int(11) NOT NULL AUTO_INCREMENT,
  `assessmentId` int(11) DEFAULT NULL,
  `particularId` int(11) DEFAULT NULL,
  `oldParticular` varchar(225) DEFAULT NULL,
  `amt1` double DEFAULT NULL,
  `amt2` double DEFAULT NULL,
  `paymentId` int(11) NOT NULL,
  PRIMARY KEY (`paymentDetailsId`),
  KEY `payments_paymentdetails` (`paymentId`),
  CONSTRAINT `payments_paymentdetails` FOREIGN KEY (`paymentId`) REFERENCES `payments` (`paymentId`)
) ENGINE=InnoDB AUTO_INCREMENT=17193 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `paymentId` int(11) NOT NULL AUTO_INCREMENT,
  `ssi_id` int(11) DEFAULT NULL,
  `acctno` varchar(12) DEFAULT NULL,
  `otherPayeeId` int(11) DEFAULT NULL,
  `orNo` varchar(40) DEFAULT NULL,
  `paymentDate` date DEFAULT NULL,
  `amt1` double DEFAULT NULL,
  `amt2` double DEFAULT NULL,
  `paymentMode` varchar(40) DEFAULT NULL,
  `cashier` varchar(100) DEFAULT NULL,
  `semId` int(11) DEFAULT NULL,
  `syId` int(11) DEFAULT NULL,
  `printingType` varchar(10) DEFAULT NULL,
  `paymentStatus` varchar(255) DEFAULT NULL,
  `orStatus` varchar(255) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`paymentId`),
  KEY `sem_payments` (`semId`),
  KEY `sy_payments` (`syId`),
  CONSTRAINT `sem_payments` FOREIGN KEY (`semId`) REFERENCES `sem` (`semId`),
  CONSTRAINT `sy_payments` FOREIGN KEY (`syId`) REFERENCES `sy` (`syId`)
) ENGINE=InnoDB AUTO_INCREMENT=3277 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for personnel
-- ----------------------------
DROP TABLE IF EXISTS `personnel`;
CREATE TABLE `personnel` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `first` varchar(255) DEFAULT NULL,
  `middle` varchar(255) DEFAULT NULL,
  `last` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for refund
-- ----------------------------
DROP TABLE IF EXISTS `refund`;
CREATE TABLE `refund` (
  `refundId` int(255) NOT NULL AUTO_INCREMENT,
  `ssi_id` int(11) DEFAULT NULL,
  `or` varchar(255) DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `syId` int(11) DEFAULT NULL,
  `semId` int(11) DEFAULT NULL,
  `cashier` varchar(255) DEFAULT NULL,
  `note` text,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`refundId`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for sem
-- ----------------------------
DROP TABLE IF EXISTS `sem`;
CREATE TABLE `sem` (
  `semId` int(11) NOT NULL AUTO_INCREMENT,
  `sem` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`semId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sy
-- ----------------------------
DROP TABLE IF EXISTS `sy`;
CREATE TABLE `sy` (
  `syId` int(11) NOT NULL AUTO_INCREMENT,
  `sy` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`syId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for userlog
-- ----------------------------
DROP TABLE IF EXISTS `userlog`;
CREATE TABLE `userlog` (
  `logId` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`logId`)
) ENGINE=MyISAM AUTO_INCREMENT=434 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `per_id` int(11) DEFAULT NULL,
  `userRole` varchar(255) DEFAULT NULL,
  `userStatus` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_salt` varchar(255) DEFAULT NULL,
  `mastercode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  KEY `fk_users_personnel_1` (`per_id`),
  CONSTRAINT `fk_users_personnel_1` FOREIGN KEY (`per_id`) REFERENCES `personnel` (`per_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
