/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : databaseama

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-09-08 16:00:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for accthistory
-- ----------------------------
DROP TABLE IF EXISTS `accthistory`;
CREATE TABLE `accthistory` (
  `acctno` char(23) DEFAULT NULL,
  `subject` char(23) DEFAULT NULL,
  `grade` char(23) DEFAULT NULL,
  `lab` double(5,2) DEFAULT NULL,
  `lec` double(5,2) DEFAULT NULL,
  `totalunit` double(5,1) DEFAULT NULL,
  `term` char(23) DEFAULT NULL,
  `sy` char(23) DEFAULT NULL,
  `particular` char(23) DEFAULT NULL,
  `unit` double DEFAULT NULL,
  `amt1` double DEFAULT NULL,
  `ornum` char(23) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amt2` double(23,2) DEFAULT NULL,
  `termyear` char(20) DEFAULT NULL,
  `tuition` double DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accthistory
-- ----------------------------

-- ----------------------------
-- Table structure for attendance
-- ----------------------------
DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `acctno` char(255) DEFAULT NULL,
  `datein` date DEFAULT NULL,
  `timein` time DEFAULT NULL,
  `timeout` time DEFAULT NULL,
  `stat` char(5) DEFAULT NULL,
  `Topic` char(100) DEFAULT NULL,
  `Trainer` char(15) DEFAULT NULL,
  `in` int(11) NOT NULL AUTO_INCREMENT,
  `ap` int(11) DEFAULT NULL,
  PRIMARY KEY (`in`)
) ENGINE=InnoDB AUTO_INCREMENT=2358 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of attendance
-- ----------------------------

-- ----------------------------
-- Table structure for attenpass
-- ----------------------------
DROP TABLE IF EXISTS `attenpass`;
CREATE TABLE `attenpass` (
  `acctno` char(10) NOT NULL DEFAULT '',
  `password` char(25) DEFAULT NULL,
  PRIMARY KEY (`acctno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of attenpass
-- ----------------------------

-- ----------------------------
-- Table structure for barcode
-- ----------------------------
DROP TABLE IF EXISTS `barcode`;
CREATE TABLE `barcode` (
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `EmployeeNo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of barcode
-- ----------------------------

-- ----------------------------
-- Table structure for budget
-- ----------------------------
DROP TABLE IF EXISTS `budget`;
CREATE TABLE `budget` (
  `code` char(20) DEFAULT NULL,
  `description` char(50) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `datebud` date DEFAULT NULL,
  `Sy` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of budget
-- ----------------------------

-- ----------------------------
-- Table structure for cashvou
-- ----------------------------
DROP TABLE IF EXISTS `cashvou`;
CREATE TABLE `cashvou` (
  `payto` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `VouNo` varchar(50) NOT NULL,
  `Vdate` date DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `amtwrd` varchar(3000) DEFAULT NULL,
  `Particulars` varchar(3000) DEFAULT NULL,
  `sem` char(10) DEFAULT NULL,
  `yr` char(10) DEFAULT NULL,
  `description` char(100) DEFAULT NULL,
  PRIMARY KEY (`VouNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cashvou
-- ----------------------------

-- ----------------------------
-- Table structure for checkday
-- ----------------------------
DROP TABLE IF EXISTS `checkday`;
CREATE TABLE `checkday` (
  `time_id` int(11) DEFAULT NULL,
  `Subject_code` varchar(20) DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL,
  `Max_enrollment` int(11) DEFAULT NULL,
  `duration` double(5,2) DEFAULT NULL,
  `instructor` varchar(50) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `no_of_enrollees` varchar(50) DEFAULT NULL,
  `rem_of_enrollees` varchar(50) DEFAULT NULL,
  `subject_type` varchar(20) DEFAULT NULL,
  `dayCode` varchar(20) DEFAULT NULL,
  `sem_sched` varchar(20) DEFAULT NULL,
  `year_sched` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of checkday
-- ----------------------------

-- ----------------------------
-- Table structure for collectionrep
-- ----------------------------
DROP TABLE IF EXISTS `collectionrep`;
CREATE TABLE `collectionrep` (
  `particular` char(55) DEFAULT NULL,
  `total` char(20) DEFAULT NULL,
  `royaltyfee` char(20) DEFAULT NULL,
  `financialfee` char(20) DEFAULT NULL,
  `ads` char(20) DEFAULT NULL,
  `dateref1` char(20) DEFAULT NULL,
  `dateref2` char(20) DEFAULT NULL,
  `level` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of collectionrep
-- ----------------------------

-- ----------------------------
-- Table structure for collection_report1
-- ----------------------------
DROP TABLE IF EXISTS `collection_report1`;
CREATE TABLE `collection_report1` (
  `index` int(4) NOT NULL AUTO_INCREMENT,
  `acctno` char(10) DEFAULT NULL,
  `OR` char(20) DEFAULT NULL,
  `Tuition_Fee` double DEFAULT NULL,
  `Lab_Fee` double DEFAULT NULL,
  `Internet_Fee` double DEFAULT NULL,
  `Office365` double DEFAULT NULL,
  `Miscellaneous` double DEFAULT NULL,
  `Networking` double DEFAULT NULL,
  `Physics` double DEFAULT NULL,
  `STCAB1` double DEFAULT NULL,
  `Special_Exam_50P1` double DEFAULT NULL,
  `Others1` double DEFAULT NULL,
  `Others` double DEFAULT NULL,
  `Merchandise` double DEFAULT NULL,
  `SC` double DEFAULT NULL,
  `Newsletter` double DEFAULT NULL,
  `Special_Exam_50P2` double DEFAULT NULL,
  `Others2` double DEFAULT NULL,
  `Ncc_uk` double DEFAULT NULL,
  `MS_Fee` double DEFAULT NULL,
  `STCAB2` double DEFAULT NULL,
  `E_learning` double DEFAULT NULL,
  `Cultural_fee` double DEFAULT NULL,
  `Insurance` double DEFAULT NULL,
  `oracle` double DEFAULT NULL,
  `hp` double DEFAULT NULL,
  `sap` double DEFAULT NULL,
  `seniorhigh` double DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `yr` char(10) DEFAULT NULL,
  `pdate` date DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `ched_deped` double DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=441494 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 5120 kB';

-- ----------------------------
-- Records of collection_report1
-- ----------------------------

-- ----------------------------
-- Table structure for collection_report_copy
-- ----------------------------
DROP TABLE IF EXISTS `collection_report_copy`;
CREATE TABLE `collection_report_copy` (
  `index` int(4) NOT NULL AUTO_INCREMENT,
  `acctno` char(10) DEFAULT NULL,
  `OR` char(6) DEFAULT NULL,
  `Tuition_Fee` double DEFAULT NULL,
  `Lab_Fee` double DEFAULT NULL,
  `Internet_Fee` double DEFAULT NULL,
  `Miscellaneous` double DEFAULT NULL,
  `Networking` double DEFAULT NULL,
  `Physics` double DEFAULT NULL,
  `STCAB1` double DEFAULT NULL,
  `Special_Exam_50P1` double DEFAULT NULL,
  `Others1` double DEFAULT NULL,
  `Merchandise` double DEFAULT NULL,
  `SC` double DEFAULT NULL,
  `Newsletter` double DEFAULT NULL,
  `Special_Exam_50P2` double DEFAULT NULL,
  `Others2` double DEFAULT NULL,
  `Ncc_uk` double DEFAULT NULL,
  `MS Fee` double DEFAULT NULL,
  `STCAB2` double DEFAULT NULL,
  `E_learning` double DEFAULT NULL,
  `Cultural_fee` double DEFAULT NULL,
  `Insurance` double DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=4059 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of collection_report_copy
-- ----------------------------

-- ----------------------------
-- Table structure for collection_report_copy1
-- ----------------------------
DROP TABLE IF EXISTS `collection_report_copy1`;
CREATE TABLE `collection_report_copy1` (
  `index` int(4) NOT NULL AUTO_INCREMENT,
  `acctno` char(10) DEFAULT NULL,
  `OR` char(6) DEFAULT NULL,
  `Tuition_Fee` double DEFAULT NULL,
  `Lab_Fee` double DEFAULT NULL,
  `Internet_Fee` double DEFAULT NULL,
  `Miscellaneous` double DEFAULT NULL,
  `Networking` double DEFAULT NULL,
  `Physics` double DEFAULT NULL,
  `STCAB1` double DEFAULT NULL,
  `Special_Exam_50P1` double DEFAULT NULL,
  `Others1` double DEFAULT NULL,
  `Merchandise` double DEFAULT NULL,
  `SC` double DEFAULT NULL,
  `Newsletter` double DEFAULT NULL,
  `Special_Exam_50P2` double DEFAULT NULL,
  `Others2` double DEFAULT NULL,
  `Ncc_uk` double DEFAULT NULL,
  `MS_Fee` double DEFAULT NULL,
  `STCAB2` double DEFAULT NULL,
  `E_learning` double DEFAULT NULL,
  `Cultural_fee` double DEFAULT NULL,
  `Insurance` double DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `yr` char(10) DEFAULT NULL,
  `pdate` date DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=4687 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of collection_report_copy1
-- ----------------------------

-- ----------------------------
-- Table structure for collection_report_daily
-- ----------------------------
DROP TABLE IF EXISTS `collection_report_daily`;
CREATE TABLE `collection_report_daily` (
  `acctno` varchar(255) DEFAULT NULL,
  `or` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of collection_report_daily
-- ----------------------------

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course` char(20) DEFAULT NULL,
  `type` char(5) DEFAULT NULL,
  `DESCRIPTION` char(100) DEFAULT NULL,
  `Unit` double DEFAULT NULL,
  `type2` int(11) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of course
-- ----------------------------

-- ----------------------------
-- Table structure for course2
-- ----------------------------
DROP TABLE IF EXISTS `course2`;
CREATE TABLE `course2` (
  `course` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of course2
-- ----------------------------

-- ----------------------------
-- Table structure for crsforweb
-- ----------------------------
DROP TABLE IF EXISTS `crsforweb`;
CREATE TABLE `crsforweb` (
  `course` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of crsforweb
-- ----------------------------

-- ----------------------------
-- Table structure for cs
-- ----------------------------
DROP TABLE IF EXISTS `cs`;
CREATE TABLE `cs` (
  `daycode` varchar(20) DEFAULT NULL,
  `acctno` varchar(20) DEFAULT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `Day` varchar(20) DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL,
  `instructor` varchar(50) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `sem_load` varchar(20) DEFAULT NULL,
  `yearLoad` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cs
-- ----------------------------

-- ----------------------------
-- Table structure for cs1
-- ----------------------------
DROP TABLE IF EXISTS `cs1`;
CREATE TABLE `cs1` (
  `daycode` varchar(20) DEFAULT NULL,
  `acctno` varchar(20) DEFAULT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `Day` varchar(20) DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL,
  `instructor` varchar(50) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `sem_load` varchar(20) DEFAULT NULL,
  `yearLoad` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cs1
-- ----------------------------

-- ----------------------------
-- Table structure for ctr
-- ----------------------------
DROP TABLE IF EXISTS `ctr`;
CREATE TABLE `ctr` (
  `CTR2` char(10) NOT NULL DEFAULT '',
  `CTR4` char(10) NOT NULL DEFAULT '',
  `counter` int(100) DEFAULT NULL,
  PRIMARY KEY (`CTR2`,`CTR4`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ctr
-- ----------------------------

-- ----------------------------
-- Table structure for discounts
-- ----------------------------
DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts` (
  `ID` char(15) DEFAULT NULL,
  `acctno` char(15) DEFAULT NULL,
  `Discount` char(15) DEFAULT NULL,
  `sy` char(15) DEFAULT NULL,
  `sem` char(15) DEFAULT NULL,
  `Training` int(11) DEFAULT NULL,
  `TF` char(10) DEFAULT NULL,
  `SB` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 177152 kB';

-- ----------------------------
-- Records of discounts
-- ----------------------------

-- ----------------------------
-- Table structure for discounttype
-- ----------------------------
DROP TABLE IF EXISTS `discounttype`;
CREATE TABLE `discounttype` (
  `disID` char(10) DEFAULT NULL,
  `Description` char(25) DEFAULT NULL,
  `perc` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of discounttype
-- ----------------------------

-- ----------------------------
-- Table structure for enrolled
-- ----------------------------
DROP TABLE IF EXISTS `enrolled`;
CREATE TABLE `enrolled` (
  `acctno` varchar(50) DEFAULT NULL,
  `course` char(50) DEFAULT NULL,
  `yearl` char(11) DEFAULT NULL,
  `sem` char(10) DEFAULT NULL,
  `sy` char(11) DEFAULT NULL,
  `coursetype` tinyint(4) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  KEY `acctno` (`acctno`),
  CONSTRAINT `enrolled_ibfk_1` FOREIGN KEY (`acctno`) REFERENCES `students` (`acctno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of enrolled
-- ----------------------------

-- ----------------------------
-- Table structure for enrolled_copy
-- ----------------------------
DROP TABLE IF EXISTS `enrolled_copy`;
CREATE TABLE `enrolled_copy` (
  `acctno` varchar(50) DEFAULT NULL,
  `yearl` int(11) DEFAULT NULL,
  `sem` char(5) DEFAULT NULL,
  `sy` char(11) DEFAULT NULL,
  KEY `acctno` (`acctno`),
  CONSTRAINT `enrolled_copy_ibfk_1` FOREIGN KEY (`acctno`) REFERENCES `students` (`acctno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of enrolled_copy
-- ----------------------------

-- ----------------------------
-- Table structure for examresult
-- ----------------------------
DROP TABLE IF EXISTS `examresult`;
CREATE TABLE `examresult` (
  `acctno` char(20) NOT NULL DEFAULT '',
  `MathResult` char(10) DEFAULT NULL,
  `EnglishResult` char(10) DEFAULT NULL,
  `Linguistic` char(255) DEFAULT NULL,
  `logical_math` char(255) DEFAULT NULL,
  `musical` char(255) DEFAULT NULL,
  `bodily_kin` char(255) DEFAULT NULL,
  `Spatial_Visual` char(255) DEFAULT NULL,
  `Interpersonal` char(255) DEFAULT NULL,
  `Intrapersonal` char(255) DEFAULT NULL,
  PRIMARY KEY (`acctno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of examresult
-- ----------------------------

-- ----------------------------
-- Table structure for graduates
-- ----------------------------
DROP TABLE IF EXISTS `graduates`;
CREATE TABLE `graduates` (
  `course` varchar(255) DEFAULT NULL,
  `last` varchar(255) DEFAULT NULL,
  `first` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of graduates
-- ----------------------------

-- ----------------------------
-- Table structure for graduate_fee
-- ----------------------------
DROP TABLE IF EXISTS `graduate_fee`;
CREATE TABLE `graduate_fee` (
  `particular` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of graduate_fee
-- ----------------------------

-- ----------------------------
-- Table structure for grad_personnel
-- ----------------------------
DROP TABLE IF EXISTS `grad_personnel`;
CREATE TABLE `grad_personnel` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `first` varchar(120) DEFAULT NULL,
  `middle` varchar(120) DEFAULT NULL,
  `last` varchar(120) DEFAULT NULL,
  `suffix` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of grad_personnel
-- ----------------------------

-- ----------------------------
-- Table structure for grad_users
-- ----------------------------
DROP TABLE IF EXISTS `grad_users`;
CREATE TABLE `grad_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `user_role` varchar(120) DEFAULT NULL,
  `status` varchar(120) DEFAULT NULL,
  `user_level` varchar(120) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `possition` varchar(120) DEFAULT NULL,
  `department` varchar(120) DEFAULT NULL,
  `division` varchar(120) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `grad_users_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `grad_personnel` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of grad_users
-- ----------------------------

-- ----------------------------
-- Table structure for id_issue
-- ----------------------------
DROP TABLE IF EXISTS `id_issue`;
CREATE TABLE `id_issue` (
  `acctno` varchar(255) DEFAULT NULL,
  `issueddate` date DEFAULT NULL,
  `change` varchar(255) DEFAULT NULL,
  `cOR` varchar(255) DEFAULT NULL,
  `cridate` date DEFAULT NULL,
  `lost` varchar(255) DEFAULT NULL,
  `lOR` varchar(255) DEFAULT NULL,
  `lridate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of id_issue
-- ----------------------------

-- ----------------------------
-- Table structure for inslod
-- ----------------------------
DROP TABLE IF EXISTS `inslod`;
CREATE TABLE `inslod` (
  `subject_code` char(22) DEFAULT NULL,
  `subject_title` char(100) DEFAULT NULL,
  `type_Lec` char(22) DEFAULT NULL,
  `type_lab` char(22) DEFAULT NULL,
  `unit_lec` char(22) DEFAULT NULL,
  `unit_lab` char(22) DEFAULT NULL,
  `timein` time DEFAULT NULL,
  `timeout` time DEFAULT NULL,
  `day` char(22) DEFAULT NULL,
  `room` char(22) DEFAULT NULL,
  `orderby` int(22) DEFAULT NULL,
  `instructor` char(30) DEFAULT NULL,
  `studno` char(11) DEFAULT NULL,
  `section` char(25) DEFAULT NULL,
  `remarks` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inslod
-- ----------------------------

-- ----------------------------
-- Table structure for label
-- ----------------------------
DROP TABLE IF EXISTS `label`;
CREATE TABLE `label` (
  `level` char(50) DEFAULT NULL,
  `label1` char(50) DEFAULT NULL,
  `label2` char(50) DEFAULT NULL,
  `label3` char(50) DEFAULT NULL,
  `label4` char(50) DEFAULT NULL,
  `label5` char(50) DEFAULT NULL,
  `label6` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of label
-- ----------------------------

-- ----------------------------
-- Table structure for lab_room
-- ----------------------------
DROP TABLE IF EXISTS `lab_room`;
CREATE TABLE `lab_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room` varchar(255) DEFAULT NULL,
  `lab_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lab_room
-- ----------------------------

-- ----------------------------
-- Table structure for lookassessment
-- ----------------------------
DROP TABLE IF EXISTS `lookassessment`;
CREATE TABLE `lookassessment` (
  `particular` char(50) DEFAULT NULL,
  `lab_type` char(10) DEFAULT NULL,
  `amt` char(20) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `sy` char(10) DEFAULT NULL,
  `sem` char(10) DEFAULT NULL,
  `coursetype` char(255) DEFAULT NULL,
  `collection_report_group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lookassessment
-- ----------------------------

-- ----------------------------
-- Table structure for lookforassess
-- ----------------------------
DROP TABLE IF EXISTS `lookforassess`;
CREATE TABLE `lookforassess` (
  `particular` char(30) DEFAULT NULL,
  `orderby` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lookforassess
-- ----------------------------

-- ----------------------------
-- Table structure for mdparticulars
-- ----------------------------
DROP TABLE IF EXISTS `mdparticulars`;
CREATE TABLE `mdparticulars` (
  `Particulars` varchar(255) DEFAULT NULL,
  `Amt` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `SY` varchar(255) DEFAULT NULL,
  `SEM` varchar(255) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `coursetype` varchar(255) DEFAULT NULL,
  `collection_report_group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mdparticulars
-- ----------------------------

-- ----------------------------
-- Table structure for mdparticulars_copy
-- ----------------------------
DROP TABLE IF EXISTS `mdparticulars_copy`;
CREATE TABLE `mdparticulars_copy` (
  `Particulars` varchar(255) DEFAULT NULL,
  `Amt` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `SY` varchar(255) DEFAULT NULL,
  `SEM` varchar(255) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `coursetype` varchar(255) DEFAULT NULL,
  `collection_report_group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mdparticulars_copy
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for myob
-- ----------------------------
DROP TABLE IF EXISTS `myob`;
CREATE TABLE `myob` (
  `COURSE` char(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`COURSE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of myob
-- ----------------------------

-- ----------------------------
-- Table structure for ordetails
-- ----------------------------
DROP TABLE IF EXISTS `ordetails`;
CREATE TABLE `ordetails` (
  `acctno` char(20) DEFAULT NULL,
  `OR` char(50) DEFAULT NULL,
  `Particular` char(50) DEFAULT NULL,
  `PAmt` double DEFAULT NULL,
  `SubParticular` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ordetails
-- ----------------------------

-- ----------------------------
-- Table structure for ordetails1
-- ----------------------------
DROP TABLE IF EXISTS `ordetails1`;
CREATE TABLE `ordetails1` (
  `acctno` char(20) DEFAULT NULL,
  `OR` char(50) DEFAULT NULL,
  `Particular` char(50) DEFAULT NULL,
  `PAmt` double DEFAULT NULL,
  `SubParticular` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ordetails1
-- ----------------------------

-- ----------------------------
-- Table structure for ordetails_copy
-- ----------------------------
DROP TABLE IF EXISTS `ordetails_copy`;
CREATE TABLE `ordetails_copy` (
  `acctno` char(20) DEFAULT NULL,
  `OR` char(50) DEFAULT NULL,
  `Particular` char(50) DEFAULT NULL,
  `PAmt` double DEFAULT NULL,
  `SubParticular` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ordetails_copy
-- ----------------------------

-- ----------------------------
-- Table structure for ordetails_copy1
-- ----------------------------
DROP TABLE IF EXISTS `ordetails_copy1`;
CREATE TABLE `ordetails_copy1` (
  `acctno` char(20) DEFAULT NULL,
  `OR` char(50) DEFAULT NULL,
  `Particular` char(50) DEFAULT NULL,
  `PAmt` double DEFAULT NULL,
  `SubParticular` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ordetails_copy1
-- ----------------------------

-- ----------------------------
-- Table structure for ordetails_copy2
-- ----------------------------
DROP TABLE IF EXISTS `ordetails_copy2`;
CREATE TABLE `ordetails_copy2` (
  `acctno` char(20) DEFAULT NULL,
  `OR` char(50) DEFAULT NULL,
  `Particular` char(50) DEFAULT NULL,
  `PAmt` double DEFAULT NULL,
  `SubParticular` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ordetails_copy2
-- ----------------------------

-- ----------------------------
-- Table structure for otherdetails
-- ----------------------------
DROP TABLE IF EXISTS `otherdetails`;
CREATE TABLE `otherdetails` (
  `acctno` char(20) DEFAULT NULL,
  `OR` char(50) DEFAULT NULL,
  `Particular` char(50) DEFAULT NULL,
  `PAmt` double DEFAULT NULL,
  `Qty` double DEFAULT NULL,
  KEY `qqqq` (`OR`),
  CONSTRAINT `qqqq` FOREIGN KEY (`OR`) REFERENCES `payment_2` (`OR`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of otherdetails
-- ----------------------------

-- ----------------------------
-- Table structure for otherpayment
-- ----------------------------
DROP TABLE IF EXISTS `otherpayment`;
CREATE TABLE `otherpayment` (
  `Acctno` char(100) DEFAULT NULL,
  `particular` char(200) DEFAULT NULL,
  `Date` char(20) DEFAULT NULL,
  `OR` char(50) NOT NULL DEFAULT '',
  `Amt` double DEFAULT NULL,
  `MODE` char(30) DEFAULT NULL,
  `Issuuer` char(50) DEFAULT NULL,
  `bank` char(50) DEFAULT NULL,
  `chaeckno` char(50) DEFAULT NULL,
  `cashier` char(30) DEFAULT NULL,
  `SY` char(30) DEFAULT NULL,
  `SEM` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of otherpayment
-- ----------------------------

-- ----------------------------
-- Table structure for particulars
-- ----------------------------
DROP TABLE IF EXISTS `particulars`;
CREATE TABLE `particulars` (
  `Particular` char(100) DEFAULT NULL,
  `Amt` char(50) DEFAULT NULL,
  `college` char(50) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `prior` char(50) DEFAULT NULL,
  `sy` char(10) DEFAULT NULL,
  `sem` char(10) DEFAULT NULL,
  `collection_report_group` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of particulars
-- ----------------------------

-- ----------------------------
-- Table structure for particulars_copy
-- ----------------------------
DROP TABLE IF EXISTS `particulars_copy`;
CREATE TABLE `particulars_copy` (
  `Particular` char(100) DEFAULT NULL,
  `Amt` char(50) DEFAULT NULL,
  `college` char(50) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `prior` char(50) DEFAULT NULL,
  `sy` char(10) DEFAULT NULL,
  `sem` char(10) DEFAULT NULL,
  `collection_report_group` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of particulars_copy
-- ----------------------------

-- ----------------------------
-- Table structure for password_rec
-- ----------------------------
DROP TABLE IF EXISTS `password_rec`;
CREATE TABLE `password_rec` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_no` varchar(100) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `school_year` varchar(255) DEFAULT NULL,
  `prelim_username` varchar(255) DEFAULT NULL,
  `prelim_password` varchar(255) DEFAULT NULL,
  `midterm_username` varchar(255) DEFAULT NULL,
  `midterm_password` varchar(255) DEFAULT NULL,
  `prefinal_username` varchar(255) DEFAULT NULL,
  `prefinal_password` varchar(255) DEFAULT NULL,
  `final_username` varchar(255) DEFAULT NULL,
  `final_password` varchar(255) DEFAULT NULL,
  `prelim_accept_status` varchar(255) DEFAULT NULL,
  `midterm_accept_status` varchar(255) DEFAULT NULL,
  `prefinal_accept_status` varchar(255) DEFAULT NULL,
  `final_accept_status` varchar(255) DEFAULT NULL,
  `prelim_uploaded_date` varchar(255) DEFAULT NULL,
  `midterm_upload_date` varchar(255) DEFAULT NULL,
  `prefinal_uploaded_date` varchar(255) DEFAULT NULL,
  `final_uploaded_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4420 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of password_rec
-- ----------------------------

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `acctno` char(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `OR` char(50) NOT NULL DEFAULT '',
  `Amt` double DEFAULT NULL,
  `MODE` char(30) DEFAULT NULL,
  `Issuuer` char(50) DEFAULT NULL,
  `bank` char(50) DEFAULT NULL,
  `chaeckno` char(50) DEFAULT NULL,
  `cashier` char(30) DEFAULT NULL,
  `SY` char(30) DEFAULT NULL,
  `SEM` char(30) DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment
-- ----------------------------

-- ----------------------------
-- Table structure for payment2
-- ----------------------------
DROP TABLE IF EXISTS `payment2`;
CREATE TABLE `payment2` (
  `acctno` char(20) DEFAULT NULL,
  `Date` char(20) DEFAULT NULL,
  `OR` char(50) NOT NULL DEFAULT '',
  `Amt` double DEFAULT NULL,
  `MODE` char(30) DEFAULT NULL,
  `Issuuer` char(50) DEFAULT NULL,
  `bank` char(50) DEFAULT NULL,
  `chaeckno` char(50) DEFAULT NULL,
  `cashier` char(30) DEFAULT NULL,
  `SY` char(30) DEFAULT NULL,
  `SEM` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment2
-- ----------------------------

-- ----------------------------
-- Table structure for payment_2
-- ----------------------------
DROP TABLE IF EXISTS `payment_2`;
CREATE TABLE `payment_2` (
  `acctno` char(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `OR` char(50) NOT NULL DEFAULT '',
  `Amt` double DEFAULT 2,
  `MODE` char(30) DEFAULT NULL,
  `Issuuer` char(50) DEFAULT NULL,
  `bank` char(50) DEFAULT NULL,
  `chaeckno` char(50) DEFAULT NULL,
  `cashier` char(30) DEFAULT NULL,
  `SY` char(30) DEFAULT NULL,
  `SEM` char(30) DEFAULT NULL,
  KEY `OR` (`OR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_2
-- ----------------------------

-- ----------------------------
-- Table structure for payment_copy
-- ----------------------------
DROP TABLE IF EXISTS `payment_copy`;
CREATE TABLE `payment_copy` (
  `acctno` char(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `OR` char(50) NOT NULL DEFAULT '',
  `Amt` double DEFAULT NULL,
  `MODE` char(30) DEFAULT NULL,
  `Issuuer` char(50) DEFAULT NULL,
  `bank` char(50) DEFAULT NULL,
  `chaeckno` char(50) DEFAULT NULL,
  `cashier` char(30) DEFAULT NULL,
  `SY` char(30) DEFAULT NULL,
  `SEM` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_copy
-- ----------------------------

-- ----------------------------
-- Table structure for pc_admin
-- ----------------------------
DROP TABLE IF EXISTS `pc_admin`;
CREATE TABLE `pc_admin` (
  `admin_id` int(50) NOT NULL AUTO_INCREMENT,
  `admin_fn` varchar(100) DEFAULT NULL,
  `admin_mn` varchar(100) DEFAULT NULL,
  `admin_ls` varchar(100) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `password` char(50) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1009 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pc_admin
-- ----------------------------

-- ----------------------------
-- Table structure for pc_printing
-- ----------------------------
DROP TABLE IF EXISTS `pc_printing`;
CREATE TABLE `pc_printing` (
  `printing_id` int(50) NOT NULL AUTO_INCREMENT,
  `printing_limit` int(50) DEFAULT NULL,
  `printing_left` int(50) DEFAULT NULL,
  `printing_total` int(50) DEFAULT NULL,
  `semester` varchar(100) NOT NULL,
  `schoolYear` varchar(50) DEFAULT NULL,
  `stud_acctno` char(50) DEFAULT NULL,
  PRIMARY KEY (`printing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43696 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pc_printing
-- ----------------------------

-- ----------------------------
-- Table structure for pdc
-- ----------------------------
DROP TABLE IF EXISTS `pdc`;
CREATE TABLE `pdc` (
  `particular` char(30) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `dateissued` date DEFAULT NULL,
  `bank` char(100) DEFAULT NULL,
  `dateref1` date DEFAULT NULL,
  `dateref2` date DEFAULT NULL,
  `checknum` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pdc
-- ----------------------------

-- ----------------------------
-- Table structure for pdc1
-- ----------------------------
DROP TABLE IF EXISTS `pdc1`;
CREATE TABLE `pdc1` (
  `particular` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `check` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `coursetype` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pdc1
-- ----------------------------

-- ----------------------------
-- Table structure for pendingpay
-- ----------------------------
DROP TABLE IF EXISTS `pendingpay`;
CREATE TABLE `pendingpay` (
  `acctno` char(20) DEFAULT NULL,
  `OR` char(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `ramnt` char(20) DEFAULT NULL,
  `status` char(20) DEFAULT NULL,
  KEY `q` (`OR`),
  CONSTRAINT `q` FOREIGN KEY (`OR`) REFERENCES `refpayment` (`OR`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pendingpay
-- ----------------------------

-- ----------------------------
-- Table structure for period
-- ----------------------------
DROP TABLE IF EXISTS `period`;
CREATE TABLE `period` (
  `term` char(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `sy` char(12) DEFAULT NULL,
  `sem` char(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of period
-- ----------------------------

-- ----------------------------
-- Table structure for period_copy
-- ----------------------------
DROP TABLE IF EXISTS `period_copy`;
CREATE TABLE `period_copy` (
  `term` char(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `sy` char(12) DEFAULT NULL,
  `sem` char(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of period_copy
-- ----------------------------

-- ----------------------------
-- Table structure for photo
-- ----------------------------
DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `acctno` char(11) NOT NULL DEFAULT '',
  `photo` longblob DEFAULT NULL,
  `SIGNATURE` longblob DEFAULT NULL,
  `sec` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`acctno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of photo
-- ----------------------------

-- ----------------------------
-- Table structure for photo_copy
-- ----------------------------
DROP TABLE IF EXISTS `photo_copy`;
CREATE TABLE `photo_copy` (
  `acctno` char(11) NOT NULL DEFAULT '',
  `photo` longblob DEFAULT NULL,
  `SIGNATURE` longblob DEFAULT NULL,
  PRIMARY KEY (`acctno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of photo_copy
-- ----------------------------

-- ----------------------------
-- Table structure for print_counter
-- ----------------------------
DROP TABLE IF EXISTS `print_counter`;
CREATE TABLE `print_counter` (
  `pc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sta_id` bigint(50) NOT NULL,
  `quantity` varchar(40) DEFAULT NULL,
  `left` varchar(40) DEFAULT NULL,
  `total_printed` varchar(40) DEFAULT NULL,
  `school_year` varchar(40) DEFAULT NULL,
  `semester` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`pc_id`),
  KEY `stud_account_print_counter` (`sta_id`),
  CONSTRAINT `print_counter_ibfk_1` FOREIGN KEY (`sta_id`) REFERENCES `stud_account` (`sta_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15709 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of print_counter
-- ----------------------------

-- ----------------------------
-- Table structure for redcross
-- ----------------------------
DROP TABLE IF EXISTS `redcross`;
CREATE TABLE `redcross` (
  `acctno` char(255) DEFAULT NULL,
  `ornum` char(255) DEFAULT NULL,
  `tsoban` double DEFAULT NULL,
  `prisaa` double DEFAULT NULL,
  `redcross` double DEFAULT NULL,
  `sy` char(255) DEFAULT NULL,
  `sem` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of redcross
-- ----------------------------

-- ----------------------------
-- Table structure for refcollec
-- ----------------------------
DROP TABLE IF EXISTS `refcollec`;
CREATE TABLE `refcollec` (
  `particular` char(20) DEFAULT NULL,
  `share` double DEFAULT NULL,
  `Indexs` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of refcollec
-- ----------------------------

-- ----------------------------
-- Table structure for refcollection
-- ----------------------------
DROP TABLE IF EXISTS `refcollection`;
CREATE TABLE `refcollection` (
  `particular` char(30) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `level` char(10) DEFAULT NULL,
  `share` double(10,2) DEFAULT NULL,
  `ifrom` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of refcollection
-- ----------------------------

-- ----------------------------
-- Table structure for refcollec_copy
-- ----------------------------
DROP TABLE IF EXISTS `refcollec_copy`;
CREATE TABLE `refcollec_copy` (
  `particular` char(20) DEFAULT NULL,
  `share` double DEFAULT NULL,
  `Indexs` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of refcollec_copy
-- ----------------------------

-- ----------------------------
-- Table structure for refpayment
-- ----------------------------
DROP TABLE IF EXISTS `refpayment`;
CREATE TABLE `refpayment` (
  `payee` char(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `OR` char(50) NOT NULL DEFAULT '',
  `Amt` char(30) DEFAULT NULL,
  `MODE` char(30) DEFAULT NULL,
  `Issuuer` char(50) DEFAULT NULL,
  `bank` char(50) DEFAULT NULL,
  `chaeckno` char(50) DEFAULT NULL,
  `cashier` char(30) DEFAULT NULL,
  `SY` char(30) DEFAULT NULL,
  `SEM` char(30) DEFAULT NULL,
  KEY `OR` (`OR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of refpayment
-- ----------------------------

-- ----------------------------
-- Table structure for refprint
-- ----------------------------
DROP TABLE IF EXISTS `refprint`;
CREATE TABLE `refprint` (
  `Acctno` char(20) NOT NULL,
  `Miscellaneous` double DEFAULT NULL,
  `Tuition Fee` double DEFAULT NULL,
  `Lab. Fee` double DEFAULT NULL,
  `Internet Fee` double DEFAULT NULL,
  `Networking` double DEFAULT NULL,
  `Physics` double DEFAULT NULL,
  `STCAB` double DEFAULT NULL,
  `NCC-UK` double DEFAULT NULL,
  `SC` double DEFAULT NULL,
  `Newsletter` double DEFAULT NULL,
  `E-Learning` double DEFAULT NULL,
  `Cultural Fee` double DEFAULT NULL,
  `Insurance` double DEFAULT NULL,
  `Discount` double DEFAULT NULL,
  `Surcharge` double DEFAULT NULL,
  `Digital` double DEFAULT NULL,
  `MYOB` double DEFAULT NULL,
  `MS Fee` double DEFAULT NULL,
  `TotalAmt` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of refprint
-- ----------------------------

-- ----------------------------
-- Table structure for sem
-- ----------------------------
DROP TABLE IF EXISTS `sem`;
CREATE TABLE `sem` (
  `sem_load` char(20) DEFAULT NULL,
  `sem_discription` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sem
-- ----------------------------

-- ----------------------------
-- Table structure for sequence
-- ----------------------------
DROP TABLE IF EXISTS `sequence`;
CREATE TABLE `sequence` (
  `sequence` char(20) DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sequence
-- ----------------------------

-- ----------------------------
-- Table structure for sirpatch
-- ----------------------------
DROP TABLE IF EXISTS `sirpatch`;
CREATE TABLE `sirpatch` (
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sirpatch
-- ----------------------------

-- ----------------------------
-- Table structure for sr
-- ----------------------------
DROP TABLE IF EXISTS `sr`;
CREATE TABLE `sr` (
  `Iname` char(255) DEFAULT NULL,
  `course` char(255) DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sr
-- ----------------------------

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `picture` longblob DEFAULT NULL,
  `Father` varchar(90) DEFAULT NULL,
  `Faddress` varchar(90) DEFAULT NULL,
  `Foccupation` varchar(90) DEFAULT NULL,
  `Fcell` varchar(90) DEFAULT NULL,
  `Fphone` varchar(90) DEFAULT NULL,
  `Fage` varchar(90) DEFAULT NULL,
  `Mother` varchar(90) DEFAULT NULL,
  `Maddress` varchar(90) DEFAULT NULL,
  `Moccupation` varchar(90) DEFAULT NULL,
  `Mcell` varchar(90) DEFAULT NULL,
  `Mphone` varchar(90) DEFAULT NULL,
  `Mage` varchar(90) DEFAULT NULL,
  `Gardian` varchar(90) DEFAULT NULL,
  `Gaddress` varchar(100) DEFAULT NULL,
  `Grelation` varchar(90) DEFAULT NULL,
  `Gphone` varchar(90) DEFAULT NULL,
  `Gcell` varchar(90) DEFAULT NULL,
  `Cname` varchar(90) DEFAULT NULL,
  `Caddress` varchar(90) DEFAULT NULL,
  `Crelation` varchar(90) DEFAULT NULL,
  `Cphone` varchar(90) DEFAULT NULL,
  `Ccell` varchar(90) DEFAULT NULL,
  `ext` varchar(50) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `sclass` varchar(50) DEFAULT NULL,
  `adrq` varchar(200) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `Pcell` varchar(50) DEFAULT NULL,
  `Pphone` varchar(50) DEFAULT NULL,
  `Bdate` varchar(50) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `BPlace` varchar(100) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `CStatus` varchar(50) DEFAULT NULL,
  `Citizenship` varchar(50) DEFAULT NULL,
  `Weight` varchar(50) DEFAULT NULL,
  `Height` varchar(50) DEFAULT NULL,
  `NForiegn` varchar(50) DEFAULT NULL,
  `HighS` varchar(100) DEFAULT NULL,
  `Highadd` varchar(100) DEFAULT NULL,
  `Highdate` varchar(50) DEFAULT NULL,
  `ES` varchar(100) DEFAULT NULL,
  `Eadd` varchar(100) DEFAULT NULL,
  `Edate` varchar(50) DEFAULT NULL,
  `Lat` varchar(100) DEFAULT NULL,
  `Ladd` varchar(100) DEFAULT NULL,
  `Haddress` varchar(80) DEFAULT NULL,
  `MunCity` varchar(80) DEFAULT NULL,
  `Bhouse` varchar(80) DEFAULT NULL,
  `Bhousetel` varchar(80) DEFAULT NULL,
  `acctno` char(20) NOT NULL,
  `USN` varchar(50) DEFAULT NULL,
  `usnpassword` varchar(255) DEFAULT NULL,
  `ID` varchar(50) DEFAULT NULL,
  `gstatus` char(10) DEFAULT NULL,
  `last` varchar(90) DEFAULT NULL,
  `middle` varchar(90) DEFAULT NULL,
  `first` varchar(90) DEFAULT NULL,
  `emailadd` varchar(90) DEFAULT NULL,
  `Syear` char(20) DEFAULT NULL,
  `Ssem` char(20) DEFAULT NULL,
  `Admission_date` date DEFAULT NULL,
  `College` varchar(50) DEFAULT NULL,
  `Ldate` varchar(20) DEFAULT NULL,
  `Admission_status` varchar(20) DEFAULT NULL,
  `grad_date` varchar(50) DEFAULT NULL,
  `yearlevel` char(5) DEFAULT NULL,
  `srcrem` text DEFAULT NULL,
  `freebie` varchar(255) DEFAULT NULL,
  `buddy` varchar(255) DEFAULT NULL,
  `Highsector` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`acctno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of students
-- ----------------------------

-- ----------------------------
-- Table structure for stud_account
-- ----------------------------
DROP TABLE IF EXISTS `stud_account`;
CREATE TABLE `stud_account` (
  `sta_id` bigint(50) NOT NULL AUTO_INCREMENT,
  `acctno` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`sta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16003043001 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stud_account
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_allow
-- ----------------------------
DROP TABLE IF EXISTS `tbl_allow`;
CREATE TABLE `tbl_allow` (
  `dateline` date DEFAULT NULL,
  `trans` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_allow
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_assessment_copy
-- ----------------------------
DROP TABLE IF EXISTS `tbl_assessment_copy`;
CREATE TABLE `tbl_assessment_copy` (
  `acctno` char(20) DEFAULT NULL,
  `particular` char(50) DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `sy` char(20) DEFAULT NULL,
  `sem` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_assessment_copy
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_assessment_ref
-- ----------------------------
DROP TABLE IF EXISTS `tbl_assessment_ref`;
CREATE TABLE `tbl_assessment_ref` (
  `acctno` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `refNo` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_assessment_ref
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_assessment_sum
-- ----------------------------
DROP TABLE IF EXISTS `tbl_assessment_sum`;
CREATE TABLE `tbl_assessment_sum` (
  `acctno` char(10) DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `sy` char(10) DEFAULT NULL,
  `sem` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_assessment_sum
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_balance_1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_balance_1`;
CREATE TABLE `tbl_balance_1` (
  `acctno` char(20) DEFAULT NULL,
  `Assessment` double(9,2) DEFAULT NULL,
  `Paid` double(9,2) DEFAULT NULL,
  `Balance` double(9,2) DEFAULT NULL,
  `Prelim` double(9,2) DEFAULT NULL,
  `Midterm` double(9,2) DEFAULT NULL,
  `PreFinal` double(9,2) DEFAULT NULL,
  `Final` double(9,2) DEFAULT NULL,
  `SY` char(20) DEFAULT NULL,
  `SEM` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_balance_1
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_balance_copy
-- ----------------------------
DROP TABLE IF EXISTS `tbl_balance_copy`;
CREATE TABLE `tbl_balance_copy` (
  `acctno` char(20) DEFAULT NULL,
  `Assessment` double(9,2) DEFAULT NULL,
  `Paid` double(9,2) DEFAULT NULL,
  `Balance` double(9,2) DEFAULT NULL,
  `Prelim` double(9,2) DEFAULT NULL,
  `Midterm` double(9,2) DEFAULT NULL,
  `PreFinal` double(9,2) DEFAULT NULL,
  `Final` double(9,2) DEFAULT NULL,
  `SY` char(20) DEFAULT NULL,
  `SEM` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_balance_copy
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_bridging_payment
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bridging_payment`;
CREATE TABLE `tbl_bridging_payment` (
  `tut_bridging_ID` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` char(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cashier` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tut_bridging_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=68025 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_bridging_payment
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_bridging_payment_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bridging_payment_detail`;
CREATE TABLE `tbl_bridging_payment_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tut_bridging_ID` int(11) DEFAULT NULL,
  `Subject_code` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=507 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_bridging_payment_detail
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_bridging_subj
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bridging_subj`;
CREATE TABLE `tbl_bridging_subj` (
  `bridging_id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject_code` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bridging_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_bridging_subj
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_cashier_timer
-- ----------------------------
DROP TABLE IF EXISTS `tbl_cashier_timer`;
CREATE TABLE `tbl_cashier_timer` (
  `or` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `tellername` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_cashier_timer
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_counter
-- ----------------------------
DROP TABLE IF EXISTS `tbl_counter`;
CREATE TABLE `tbl_counter` (
  `ctr` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_counter
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_curriculum
-- ----------------------------
DROP TABLE IF EXISTS `tbl_curriculum`;
CREATE TABLE `tbl_curriculum` (
  `Subject_order` int(11) DEFAULT NULL,
  `course_revision` varchar(20) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `semester` varchar(100) DEFAULT NULL,
  `subject_title` varchar(20) DEFAULT NULL,
  `Equivalent_sTitle` varchar(20) DEFAULT NULL,
  `Equivalent3` varchar(20) DEFAULT NULL,
  `subject_description` varchar(200) DEFAULT NULL,
  `pre_requisite_2yr` varchar(20) DEFAULT NULL,
  `pre_requisite_4yr` varchar(20) DEFAULT NULL,
  `lab_unit` double(5,0) DEFAULT NULL,
  `lab_type` varchar(20) DEFAULT NULL,
  `lec_unit` double(5,0) DEFAULT NULL,
  `total_unit` double(5,0) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `pre_requisite1` varchar(20) DEFAULT NULL,
  `pre_requisite2` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_curriculum
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_discount1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_discount1`;
CREATE TABLE `tbl_discount1` (
  `discount` char(40) DEFAULT NULL,
  `type` char(40) DEFAULT NULL,
  `percent` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_discount1
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_discount2
-- ----------------------------
DROP TABLE IF EXISTS `tbl_discount2`;
CREATE TABLE `tbl_discount2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` char(15) DEFAULT NULL,
  `discount` char(45) DEFAULT NULL,
  `type` char(10) DEFAULT NULL,
  `percent` double DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `sem` char(15) DEFAULT NULL,
  `sy` char(15) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8987 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_discount2
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_discount3
-- ----------------------------
DROP TABLE IF EXISTS `tbl_discount3`;
CREATE TABLE `tbl_discount3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` char(15) DEFAULT NULL,
  `discount` char(45) DEFAULT NULL,
  `type` char(10) DEFAULT NULL,
  `percent` double DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `sem` char(15) DEFAULT NULL,
  `sy` char(15) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8987 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_discount3
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_employee
-- ----------------------------
DROP TABLE IF EXISTS `tbl_employee`;
CREATE TABLE `tbl_employee` (
  `Employee_No` varchar(30) DEFAULT NULL,
  `Firstname` varchar(60) DEFAULT NULL,
  `Lastname` varchar(60) DEFAULT NULL,
  `Middlename` varchar(60) DEFAULT NULL,
  `Position` varchar(60) DEFAULT NULL,
  `Nature_of_attainment` varchar(100) DEFAULT NULL,
  `Degree` varchar(100) DEFAULT NULL,
  `Subject_handled` varchar(150) DEFAULT NULL,
  `Industry_Experience` varchar(100) DEFAULT NULL,
  `Competency` varchar(100) DEFAULT NULL,
  `Remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_employee
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_enrollment
-- ----------------------------
DROP TABLE IF EXISTS `tbl_enrollment`;
CREATE TABLE `tbl_enrollment` (
  `enroll_start` date DEFAULT NULL,
  `enroll_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_enrollment
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_facility
-- ----------------------------
DROP TABLE IF EXISTS `tbl_facility`;
CREATE TABLE `tbl_facility` (
  `room` varchar(30) DEFAULT NULL,
  `Capacity` int(5) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_facility
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_faculty
-- ----------------------------
DROP TABLE IF EXISTS `tbl_faculty`;
CREATE TABLE `tbl_faculty` (
  `Faculty_ID` char(21) DEFAULT NULL,
  `Faculty_name` char(50) DEFAULT NULL,
  `Faculty_Degree` char(50) DEFAULT NULL,
  `Faculty_Status` char(21) DEFAULT NULL,
  `Password` char(15) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_faculty
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_fullpayment
-- ----------------------------
DROP TABLE IF EXISTS `tbl_fullpayment`;
CREATE TABLE `tbl_fullpayment` (
  `fullID` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fullID`)
) ENGINE=InnoDB AUTO_INCREMENT=705 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_fullpayment
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_gradpaymentdetails
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gradpaymentdetails`;
CREATE TABLE `tbl_gradpaymentdetails` (
  `id` int(11) NOT NULL DEFAULT 0,
  `acctno` varchar(255) DEFAULT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_gradpaymentdetails
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_graduating
-- ----------------------------
DROP TABLE IF EXISTS `tbl_graduating`;
CREATE TABLE `tbl_graduating` (
  `sy` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `coursetype` varchar(255) DEFAULT NULL,
  `acctno` varchar(255) NOT NULL,
  `gradID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`gradID`)
) ENGINE=InnoDB AUTO_INCREMENT=682 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_graduating
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_graduating_subj
-- ----------------------------
DROP TABLE IF EXISTS `tbl_graduating_subj`;
CREATE TABLE `tbl_graduating_subj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_title` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_graduating_subj
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_graduationfee
-- ----------------------------
DROP TABLE IF EXISTS `tbl_graduationfee`;
CREATE TABLE `tbl_graduationfee` (
  `particular` varchar(255) DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=870 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_graduationfee
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_graduationpayment
-- ----------------------------
DROP TABLE IF EXISTS `tbl_graduationpayment`;
CREATE TABLE `tbl_graduationpayment` (
  `id` int(255) DEFAULT NULL,
  `acctno` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amt` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `cashier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_graduationpayment
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_graduation_others_subj
-- ----------------------------
DROP TABLE IF EXISTS `tbl_graduation_others_subj`;
CREATE TABLE `tbl_graduation_others_subj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_title` varchar(255) DEFAULT NULL,
  `grad_fee_id` int(11) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_graduation_others_subj
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_grad_login
-- ----------------------------
DROP TABLE IF EXISTS `tbl_grad_login`;
CREATE TABLE `tbl_grad_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_grad_login
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_grad_p
-- ----------------------------
DROP TABLE IF EXISTS `tbl_grad_p`;
CREATE TABLE `tbl_grad_p` (
  `indx` int(11) NOT NULL AUTO_INCREMENT,
  `particular` char(30) DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  PRIMARY KEY (`indx`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_grad_p
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_grantlist
-- ----------------------------
DROP TABLE IF EXISTS `tbl_grantlist`;
CREATE TABLE `tbl_grantlist` (
  `grants` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_grantlist
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_grants
-- ----------------------------
DROP TABLE IF EXISTS `tbl_grants`;
CREATE TABLE `tbl_grants` (
  `acctno` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_grants
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_idpath
-- ----------------------------
DROP TABLE IF EXISTS `tbl_idpath`;
CREATE TABLE `tbl_idpath` (
  `picpath` varchar(255) DEFAULT NULL,
  `sigpath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_idpath
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_idrecords
-- ----------------------------
DROP TABLE IF EXISTS `tbl_idrecords`;
CREATE TABLE `tbl_idrecords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `or` varchar(255) DEFAULT NULL,
  `recorded_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4152 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_idrecords
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_list
-- ----------------------------
DROP TABLE IF EXISTS `tbl_list`;
CREATE TABLE `tbl_list` (
  `list` char(35) DEFAULT NULL,
  `description` char(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_list
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_loading_sis
-- ----------------------------
DROP TABLE IF EXISTS `tbl_loading_sis`;
CREATE TABLE `tbl_loading_sis` (
  `ext` varchar(20) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  `sclass` varchar(20) DEFAULT NULL,
  `Acctno` varchar(20) DEFAULT NULL,
  `USN` varchar(20) DEFAULT NULL,
  `ID` varchar(20) DEFAULT NULL,
  `last` varchar(50) DEFAULT NULL,
  `middle` varchar(50) DEFAULT NULL,
  `first` varchar(50) DEFAULT NULL,
  KEY `Acctno` (`Acctno`),
  CONSTRAINT `Acctno` FOREIGN KEY (`Acctno`) REFERENCES `students` (`acctno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_loading_sis
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_logs
-- ----------------------------
DROP TABLE IF EXISTS `tbl_logs`;
CREATE TABLE `tbl_logs` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `logDate` datetime DEFAULT NULL,
  `mac` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`logID`)
) ENGINE=InnoDB AUTO_INCREMENT=25922 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_logs
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_misc
-- ----------------------------
DROP TABLE IF EXISTS `tbl_misc`;
CREATE TABLE `tbl_misc` (
  `acctno` char(20) DEFAULT NULL,
  `particular` char(50) DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `sy` char(20) DEFAULT NULL,
  `sem` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_misc
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_miscd
-- ----------------------------
DROP TABLE IF EXISTS `tbl_miscd`;
CREATE TABLE `tbl_miscd` (
  `acctno` char(10) DEFAULT NULL,
  `or` char(10) DEFAULT NULL,
  `particular` char(20) DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(25) DEFAULT NULL,
  `sy` char(15) DEFAULT NULL,
  `sem` char(10) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=506814 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_miscd
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_miscellaneous
-- ----------------------------
DROP TABLE IF EXISTS `tbl_miscellaneous`;
CREATE TABLE `tbl_miscellaneous` (
  `particular` varchar(255) DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_miscellaneous
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_nstp
-- ----------------------------
DROP TABLE IF EXISTS `tbl_nstp`;
CREATE TABLE `tbl_nstp` (
  `subject_title` char(255) DEFAULT NULL,
  `discredit` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_nstp
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_orremarks
-- ----------------------------
DROP TABLE IF EXISTS `tbl_orremarks`;
CREATE TABLE `tbl_orremarks` (
  `acctno` varchar(255) DEFAULT NULL,
  `or` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `cash` varchar(255) DEFAULT NULL,
  `change` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `ldate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_orremarks
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_paymentremarks
-- ----------------------------
DROP TABLE IF EXISTS `tbl_paymentremarks`;
CREATE TABLE `tbl_paymentremarks` (
  `acctno` varchar(255) DEFAULT NULL,
  `remarks` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_paymentremarks
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_permission
-- ----------------------------
DROP TABLE IF EXISTS `tbl_permission`;
CREATE TABLE `tbl_permission` (
  `permitID` int(11) NOT NULL AUTO_INCREMENT,
  `permitName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`permitID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_permission
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_permit
-- ----------------------------
DROP TABLE IF EXISTS `tbl_permit`;
CREATE TABLE `tbl_permit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permitNo` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `acctno` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `rdate` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40300 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_permit
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_permit_log
-- ----------------------------
DROP TABLE IF EXISTS `tbl_permit_log`;
CREATE TABLE `tbl_permit_log` (
  `permitlogID` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `permitNo` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `acctno` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `rdate` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `action_date` datetime DEFAULT NULL,
  `action_taken` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`permitlogID`)
) ENGINE=InnoDB AUTO_INCREMENT=40299 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_permit_log
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_preenrolled
-- ----------------------------
DROP TABLE IF EXISTS `tbl_preenrolled`;
CREATE TABLE `tbl_preenrolled` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_preenrolled
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_promisory
-- ----------------------------
DROP TABLE IF EXISTS `tbl_promisory`;
CREATE TABLE `tbl_promisory` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `pdate` date DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `promiseAmount` varchar(225) DEFAULT NULL,
  `promiseDate` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `period` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=13896 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_promisory
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_promisory_log
-- ----------------------------
DROP TABLE IF EXISTS `tbl_promisory_log`;
CREATE TABLE `tbl_promisory_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `acctno` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `pdate` date DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `promiseAmount` varchar(225) DEFAULT NULL,
  `promiseDate` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `period` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `action_taken` varchar(255) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14731 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_promisory_log
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_queue
-- ----------------------------
DROP TABLE IF EXISTS `tbl_queue`;
CREATE TABLE `tbl_queue` (
  `last` varchar(255) DEFAULT NULL,
  `first` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_queue
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_refund
-- ----------------------------
DROP TABLE IF EXISTS `tbl_refund`;
CREATE TABLE `tbl_refund` (
  `refundId` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `cashier` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`refundId`)
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_refund
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_roles
-- ----------------------------
DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE `tbl_roles` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_roles
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `tbl_role_permission`;
CREATE TABLE `tbl_role_permission` (
  `roleID` int(11) DEFAULT NULL,
  `permitID` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_role_permission
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_schedule
-- ----------------------------
DROP TABLE IF EXISTS `tbl_schedule`;
CREATE TABLE `tbl_schedule` (
  `Subject_code` varchar(20) DEFAULT NULL,
  `subject_title` varchar(50) DEFAULT NULL,
  `Course_Revision` varchar(20) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `semester` varchar(25) DEFAULT NULL,
  `Current_school_year` varchar(10) DEFAULT NULL,
  `Subject_order` int(20) DEFAULT NULL,
  `Equivalent_sTitle` varchar(20) DEFAULT NULL,
  `Subject_description` varchar(150) DEFAULT NULL,
  `Pre_requisite_2yr` varchar(20) DEFAULT NULL,
  `Pre_requisite_4yr` varchar(20) DEFAULT NULL,
  `Lab_unit` varchar(20) DEFAULT NULL,
  `Laboratory_type` varchar(20) DEFAULT NULL,
  `Lecture_unit` double(5,2) DEFAULT NULL,
  `Total_credit_unit` double(5,2) DEFAULT NULL,
  `Max_enrollment` double(5,2) DEFAULT NULL,
  `Min_enrollment` double(5,2) DEFAULT NULL,
  `Remarks` varchar(150) DEFAULT NULL,
  `no_of_enrollees` varchar(50) DEFAULT NULL,
  `rem_of_enrollees` varchar(50) DEFAULT NULL,
  `year_sched` varchar(50) DEFAULT NULL,
  `sem_sched` varchar(50) DEFAULT NULL,
  `section` char(50) DEFAULT NULL,
  `instructorid` char(25) DEFAULT NULL,
  KEY `Subject_code` (`Subject_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_schedule2
-- ----------------------------
DROP TABLE IF EXISTS `tbl_schedule2`;
CREATE TABLE `tbl_schedule2` (
  `Subject_code` varchar(20) DEFAULT NULL,
  `subject_title` varchar(20) DEFAULT NULL,
  `Course_Revision` varchar(20) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `Current_school_year` varchar(10) DEFAULT NULL,
  `Subject_order` int(20) DEFAULT NULL,
  `Equivalent_sTitle` varchar(20) DEFAULT NULL,
  `Subject_description` varchar(150) DEFAULT NULL,
  `Pre_requisite_2yr` varchar(20) DEFAULT NULL,
  `Pre_requisite_4yr` varchar(20) DEFAULT NULL,
  `Lab_unit` varchar(20) DEFAULT NULL,
  `Laboratory_type` varchar(20) DEFAULT NULL,
  `Lecture_unit` double(5,2) DEFAULT NULL,
  `Total_credit_unit` double(5,2) DEFAULT NULL,
  `Max_enrollment` double(5,2) DEFAULT NULL,
  `Remarks` varchar(150) DEFAULT NULL,
  `no_of_enrollees` varchar(50) DEFAULT NULL,
  `rem_of_enrollees` varchar(50) DEFAULT NULL,
  `year_sched` varchar(50) DEFAULT NULL,
  `sem_sched` varchar(50) DEFAULT NULL,
  KEY `Subject_code` (`Subject_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_schedule2
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_schedule_copy
-- ----------------------------
DROP TABLE IF EXISTS `tbl_schedule_copy`;
CREATE TABLE `tbl_schedule_copy` (
  `Subject_code` varchar(20) DEFAULT NULL,
  `subject_title` varchar(20) DEFAULT NULL,
  `Course_Revision` varchar(20) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `Current_school_year` varchar(10) DEFAULT NULL,
  `Subject_order` int(20) DEFAULT NULL,
  `Equivalent_sTitle` varchar(20) DEFAULT NULL,
  `Subject_description` varchar(150) DEFAULT NULL,
  `Pre_requisite_2yr` varchar(20) DEFAULT NULL,
  `Pre_requisite_4yr` varchar(20) DEFAULT NULL,
  `Lab_unit` varchar(20) DEFAULT NULL,
  `Laboratory_type` varchar(20) DEFAULT NULL,
  `Lecture_unit` double(5,2) DEFAULT NULL,
  `Total_credit_unit` double(5,2) DEFAULT NULL,
  `Max_enrollment` double(5,2) DEFAULT NULL,
  `Remarks` varchar(150) DEFAULT NULL,
  `no_of_enrollees` varchar(50) DEFAULT NULL,
  `rem_of_enrollees` varchar(50) DEFAULT NULL,
  `year_sched` varchar(50) DEFAULT NULL,
  `sem_sched` varchar(50) DEFAULT NULL,
  KEY `Subject_code` (`Subject_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_schedule_copy
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_schedule_copy1
-- ----------------------------
DROP TABLE IF EXISTS `tbl_schedule_copy1`;
CREATE TABLE `tbl_schedule_copy1` (
  `Subject_code` varchar(20) DEFAULT NULL,
  `subject_title` varchar(50) DEFAULT NULL,
  `Course_Revision` varchar(20) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `semester` varchar(25) DEFAULT NULL,
  `Current_school_year` varchar(10) DEFAULT NULL,
  `Subject_order` int(20) DEFAULT NULL,
  `Equivalent_sTitle` varchar(20) DEFAULT NULL,
  `Subject_description` varchar(150) DEFAULT NULL,
  `Pre_requisite_2yr` varchar(20) DEFAULT NULL,
  `Pre_requisite_4yr` varchar(20) DEFAULT NULL,
  `Lab_unit` varchar(20) DEFAULT NULL,
  `Laboratory_type` varchar(20) DEFAULT NULL,
  `Lecture_unit` double(5,2) DEFAULT NULL,
  `Total_credit_unit` double(5,2) DEFAULT NULL,
  `Max_enrollment` double(5,2) DEFAULT NULL,
  `Min_enrollment` double(5,2) DEFAULT NULL,
  `Remarks` varchar(150) DEFAULT NULL,
  `no_of_enrollees` varchar(50) DEFAULT NULL,
  `rem_of_enrollees` varchar(50) DEFAULT NULL,
  `year_sched` varchar(50) DEFAULT NULL,
  `sem_sched` varchar(50) DEFAULT NULL,
  `section` char(50) DEFAULT NULL,
  `instructorid` char(25) DEFAULT NULL,
  KEY `Subject_code` (`Subject_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_schedule_copy1
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_school
-- ----------------------------
DROP TABLE IF EXISTS `tbl_school`;
CREATE TABLE `tbl_school` (
  `slid` int(11) NOT NULL AUTO_INCREMENT,
  `saddress` char(100) DEFAULT NULL,
  `sname` char(100) DEFAULT NULL,
  PRIMARY KEY (`slid`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_school
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_section_sequence
-- ----------------------------
DROP TABLE IF EXISTS `tbl_section_sequence`;
CREATE TABLE `tbl_section_sequence` (
  `sequenceID` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) DEFAULT NULL,
  `slot` varchar(255) DEFAULT NULL,
  `yearlevel` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `sequence` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sequenceID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_section_sequence
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_sl_time
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sl_time`;
CREATE TABLE `tbl_sl_time` (
  `id` int(50) DEFAULT NULL,
  `Subject_code` varchar(20) DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL,
  `Max_enrollment` int(10) DEFAULT NULL,
  `duration` double(10,2) DEFAULT NULL,
  `instructor` varchar(50) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `acctno` varchar(20) DEFAULT NULL,
  `daycode` varchar(20) DEFAULT NULL,
  `sem_load` varchar(20) DEFAULT NULL,
  `yearLoad` varchar(20) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `tbl_stud_load` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_sl_time
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_stud_load
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stud_load`;
CREATE TABLE `tbl_stud_load` (
  `Subject_code` varchar(20) DEFAULT NULL,
  `subject_title` varchar(50) DEFAULT NULL,
  `Course_Revision` varchar(20) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `date_enrolled` char(20) DEFAULT NULL,
  `Subject_order` int(20) DEFAULT NULL,
  `Subject_description` varchar(200) DEFAULT NULL,
  `Lab_unit` varchar(5) DEFAULT NULL,
  `Laboratory_type` varchar(20) DEFAULT NULL,
  `Lecture_unit` double(11,2) DEFAULT NULL,
  `Total_credit_unit` double(11,2) DEFAULT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  `acctno` char(20) DEFAULT NULL,
  `sem_load` varchar(20) DEFAULT NULL,
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `grades` varchar(20) DEFAULT NULL,
  `yearLoad` varchar(20) DEFAULT NULL,
  `tor_credit_unit` double(20,2) DEFAULT NULL,
  `tor_remarks` varchar(20) DEFAULT NULL,
  `encoder` char(52) DEFAULT NULL,
  `section` char(255) DEFAULT NULL,
  `slid` int(11) DEFAULT NULL,
  `PG` char(25) DEFAULT NULL,
  `MG` char(25) DEFAULT NULL,
  `PFG` char(25) DEFAULT NULL,
  `FG` char(25) DEFAULT NULL,
  `SG` varchar(255) DEFAULT NULL,
  `gremarks` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `acctno` (`acctno`)
) ENGINE=InnoDB AUTO_INCREMENT=299196 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_stud_load
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_stud_load12
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stud_load12`;
CREATE TABLE `tbl_stud_load12` (
  `Subject_code` varchar(20) DEFAULT NULL,
  `subject_title` varchar(20) DEFAULT NULL,
  `Course_Revision` varchar(20) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `date_enrolled` char(20) DEFAULT NULL,
  `Subject_order` int(20) DEFAULT NULL,
  `Equivalent_sTitle` varchar(20) DEFAULT NULL,
  `Subject_description` varchar(100) DEFAULT NULL,
  `Pre_requisite_2yr` varchar(20) DEFAULT NULL,
  `Pre_requisite_4yr` varchar(20) DEFAULT NULL,
  `Lab_unit` varchar(5) DEFAULT NULL,
  `Laboratory_type` varchar(20) DEFAULT NULL,
  `Lecture_unit` int(11) DEFAULT NULL,
  `Total_credit_unit` int(11) DEFAULT NULL,
  `Max_enrollment` int(11) DEFAULT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  `acctno` varchar(20) DEFAULT NULL,
  `sem_load` varchar(20) DEFAULT NULL,
  `id` int(100) DEFAULT NULL,
  `grades` varchar(20) DEFAULT NULL,
  `yearLoad` varchar(20) DEFAULT NULL,
  `tor_credit_unit` int(20) DEFAULT NULL,
  `tor_remarks` varchar(20) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_stud_load12
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_stud_load_delete_history
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stud_load_delete_history`;
CREATE TABLE `tbl_stud_load_delete_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject_code` varchar(255) DEFAULT NULL,
  `acctno` varchar(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `encoder` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `deleter` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16374 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_stud_load_delete_history
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_tellerinfo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tellerinfo`;
CREATE TABLE `tbl_tellerinfo` (
  `tellername` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tellername`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tellerinfo
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_term
-- ----------------------------
DROP TABLE IF EXISTS `tbl_term`;
CREATE TABLE `tbl_term` (
  `sy` char(255) DEFAULT NULL,
  `sem` char(255) DEFAULT NULL,
  `enrollement` date DEFAULT NULL,
  `prelim` date DEFAULT NULL,
  `midterm` date DEFAULT NULL,
  `semifinal` date DEFAULT NULL,
  `final` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_term
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_thesis_capstone_subject
-- ----------------------------
DROP TABLE IF EXISTS `tbl_thesis_capstone_subject`;
CREATE TABLE `tbl_thesis_capstone_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_thesis_capstone_subject
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_time
-- ----------------------------
DROP TABLE IF EXISTS `tbl_time`;
CREATE TABLE `tbl_time` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject_code` char(20) DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `day` char(20) DEFAULT NULL,
  `room` char(20) DEFAULT NULL,
  `duration` double(5,2) DEFAULT NULL,
  `instructor` char(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `subject_type` varchar(20) DEFAULT NULL,
  `dayCode` varchar(20) DEFAULT NULL,
  `sem_sched` varchar(20) DEFAULT NULL,
  `year_sched` varchar(20) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  PRIMARY KEY (`time_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13161 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_time
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_tr
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tr`;
CREATE TABLE `tbl_tr` (
  `Name` char(255) DEFAULT NULL,
  `Username` char(15) DEFAULT NULL,
  `Password` char(15) DEFAULT NULL,
  `Stat` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tr
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_tutorial_balance
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tutorial_balance`;
CREATE TABLE `tbl_tutorial_balance` (
  `tutId` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` varchar(255) DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `Subject_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tutId`)
) ENGINE=InnoDB AUTO_INCREMENT=2346 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tutorial_balance
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_tutorial_min_enrollee
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tutorial_min_enrollee`;
CREATE TABLE `tbl_tutorial_min_enrollee` (
  `tutorial_min_enrollee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tutorial_min_enrollee
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_tutorial_payment
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tutorial_payment`;
CREATE TABLE `tbl_tutorial_payment` (
  `tut_payment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `acctno` char(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cashier` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tut_payment_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=823 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tutorial_payment
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_tutorial_subj
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tutorial_subj`;
CREATE TABLE `tbl_tutorial_subj` (
  `tut_Subject_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Subject_code` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tut_Subject_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tutorial_subj
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_tut_payment_details
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tut_payment_details`;
CREATE TABLE `tbl_tut_payment_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tut_payment_ID` int(11) DEFAULT NULL,
  `Subject_code` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1044 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tut_payment_details
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `username` char(52) DEFAULT NULL,
  `password` char(20) DEFAULT NULL,
  `user_level` char(20) DEFAULT NULL,
  `FORm` char(255) DEFAULT NULL,
  `Validity` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `roleID` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------

-- ----------------------------
-- Table structure for temp
-- ----------------------------
DROP TABLE IF EXISTS `temp`;
CREATE TABLE `temp` (
  `last` char(50) DEFAULT NULL,
  `first` char(50) DEFAULT NULL,
  `middle` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of temp
-- ----------------------------

-- ----------------------------
-- Table structure for tempforgrad
-- ----------------------------
DROP TABLE IF EXISTS `tempforgrad`;
CREATE TABLE `tempforgrad` (
  `firstname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tempforgrad
-- ----------------------------

-- ----------------------------
-- Table structure for tempgrad
-- ----------------------------
DROP TABLE IF EXISTS `tempgrad`;
CREATE TABLE `tempgrad` (
  `Name` char(20) DEFAULT NULL,
  `TempGrad` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tempgrad
-- ----------------------------

-- ----------------------------
-- Table structure for testvoucher
-- ----------------------------
DROP TABLE IF EXISTS `testvoucher`;
CREATE TABLE `testvoucher` (
  `payto` varchar(100) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `VouNo` char(20) NOT NULL DEFAULT '',
  `Vdate` date DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `Particulars` varchar(500) DEFAULT NULL,
  `explain` varchar(3500) DEFAULT NULL,
  `jacct1` varchar(255) DEFAULT NULL,
  `jacct2` varchar(255) DEFAULT NULL,
  `Jentry1` varchar(50) DEFAULT NULL,
  `Jentry2` varchar(50) DEFAULT NULL,
  `Debit1` double DEFAULT NULL,
  `Debit2` double DEFAULT NULL,
  `Recvdby` varchar(50) DEFAULT NULL,
  `ORNo` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Cheque` varchar(50) DEFAULT NULL,
  `dateissued` date DEFAULT NULL,
  `Bank` varchar(50) DEFAULT NULL,
  `Print` tinyint(4) DEFAULT NULL,
  `sem` char(6) DEFAULT NULL,
  `sy` char(20) DEFAULT NULL,
  `description` char(50) DEFAULT NULL,
  `rb` char(50) DEFAULT NULL,
  `Note` varchar(50) DEFAULT NULL,
  `remarks` int(11) DEFAULT NULL,
  `cnum` varchar(255) DEFAULT NULL,
  `purpose` varchar(3500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of testvoucher
-- ----------------------------

-- ----------------------------
-- Table structure for tuition
-- ----------------------------
DROP TABLE IF EXISTS `tuition`;
CREATE TABLE `tuition` (
  `college` char(30) DEFAULT NULL,
  `amt` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tuition
-- ----------------------------

-- ----------------------------
-- Table structure for voucher
-- ----------------------------
DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher` (
  `payto` varchar(100) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `VouNo` char(20) NOT NULL,
  `Vdate` date DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `Particulars` varchar(500) DEFAULT NULL,
  `explain` varchar(3500) DEFAULT NULL,
  `Jentry1` varchar(50) DEFAULT NULL,
  `Jentry2` varchar(50) DEFAULT NULL,
  `Debit1` double DEFAULT NULL,
  `Debit2` double DEFAULT NULL,
  `Recvdby` varchar(50) DEFAULT NULL,
  `ORNo` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Cheque` varchar(50) DEFAULT NULL,
  `dateissued` date DEFAULT NULL,
  `Bank` varchar(50) DEFAULT NULL,
  `Print` tinyint(4) DEFAULT NULL,
  `sem` char(6) DEFAULT NULL,
  `sy` char(20) DEFAULT NULL,
  `description` char(50) DEFAULT NULL,
  `rb` char(50) DEFAULT NULL,
  `Note` char(50) DEFAULT NULL,
  `remarks` int(11) DEFAULT NULL,
  PRIMARY KEY (`VouNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of voucher
-- ----------------------------

-- ----------------------------
-- Table structure for voucher_copy
-- ----------------------------
DROP TABLE IF EXISTS `voucher_copy`;
CREATE TABLE `voucher_copy` (
  `payto` varchar(100) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `VouNo` char(20) NOT NULL,
  `Vdate` date DEFAULT NULL,
  `amt` double DEFAULT NULL,
  `Particulars` varchar(500) DEFAULT NULL,
  `explain` varchar(3500) DEFAULT NULL,
  `Jentry1` varchar(50) DEFAULT NULL,
  `Jentry2` varchar(50) DEFAULT NULL,
  `Debit1` double DEFAULT NULL,
  `Debit2` double DEFAULT NULL,
  `Recvdby` varchar(50) DEFAULT NULL,
  `ORNo` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Cheque` varchar(50) DEFAULT NULL,
  `dateissued` date DEFAULT NULL,
  `Bank` varchar(50) DEFAULT NULL,
  `Print` tinyint(4) DEFAULT NULL,
  `sem` char(6) DEFAULT NULL,
  `sy` char(20) DEFAULT NULL,
  `description` char(50) DEFAULT NULL,
  `rb` char(50) DEFAULT NULL,
  `Note` char(50) DEFAULT NULL,
  `remarks` int(11) DEFAULT NULL,
  PRIMARY KEY (`VouNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of voucher_copy
-- ----------------------------

-- ----------------------------
-- Table structure for weekly_report
-- ----------------------------
DROP TABLE IF EXISTS `weekly_report`;
CREATE TABLE `weekly_report` (
  `time` time NOT NULL DEFAULT '00:00:00',
  `remarks` varchar(1000) DEFAULT NULL,
  `instructor_name` varchar(255) DEFAULT NULL,
  `present_date` date NOT NULL DEFAULT '0000-00-00',
  `acctno` varchar(30) NOT NULL DEFAULT '0',
  `last` varchar(255) DEFAULT NULL,
  `subject_code` varchar(255) DEFAULT NULL,
  `attendance` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `sy` varchar(255) DEFAULT NULL,
  `computer_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of weekly_report
-- ----------------------------
