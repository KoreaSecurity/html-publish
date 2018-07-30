
CREATE TABLE `SUREData` (
  `SEQNO` int(11) NOT NULL AUTO_INCREMENT,
  `INTIME` char(14) NOT NULL,
  `USERCODE` char(30) NOT NULL,
  `REQNAME` varchar(32) DEFAULT NULL,
  `REQPHONE` varchar(20) DEFAULT NULL,
  `CALLNAME` varchar(32) DEFAULT NULL,
  `COUNTRY` varchar(10) DEFAULT NULL,
  `CALLPHONE` varchar(20) NOT NULL,
  `SUBJECT` varchar(120) DEFAULT NULL,
  `MSG` varchar(4000) NOT NULL,
  `REQTIME` char(14) NOT NULL,
  `SENTTIME` char(14) DEFAULT NULL,
  `RECVTIME` char(14) DEFAULT NULL,
  `RESULT` char(1) NOT NULL DEFAULT '0',
  `ERRCODE` int(11) DEFAULT NULL,
  `KIND` char(1) NOT NULL,
  `FKCONTENT` int(11) DEFAULT NULL,
  `DEPTCODE` char(30) NOT NULL,
  `BATCHFLAG` int(11) NOT NULL DEFAULT '0',
  `RETRY` int(11) NOT NULL DEFAULT '0',
  `TEMPLATECODE` char(14) DEFAULT NULL,
  PRIMARY KEY (`SEQNO`),
  UNIQUE KEY `SEQNO_UNIQUE` (`SEQNO`),
  KEY `IX_SUREData` (`RESULT`,`KIND`)
);



CREATE TABLE `MMSContents` (
  `SEQNO` int(11) NOT NULL AUTO_INCREMENT,
  `FileCnt` int(11) NOT NULL DEFAULT '0',
  `FilePath1` varchar(255) DEFAULT NULL,
  `FilePath2` varchar(255) DEFAULT NULL,
  `FilePath3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SEQNO`),
  UNIQUE KEY `SEQNO_UNIQUE` (`SEQNO`)
);



CREATE TABLE `SUREData_Log` (
  `SEQNO` int(11) NOT NULL,
  `INTIME` char(14) NOT NULL,
  `USERCODE` char(30) NOT NULL,
  `REQNAME` varchar(32) DEFAULT NULL,
  `REQPHONE` varchar(20) DEFAULT NULL,
  `CALLNAME` varchar(32) DEFAULT NULL,
  `COUNTRY` varchar(10) DEFAULT NULL,
  `CALLPHONE` varchar(20) NOT NULL,
  `SUBJECT` varchar(120) DEFAULT NULL,
  `MSG` varchar(4000) NOT NULL,
  `REQTIME` char(14) NOT NULL,
  `SENTTIME` char(14) DEFAULT NULL,
  `RECVTIME` char(14) DEFAULT NULL,
  `RESULT` char(1) NOT NULL DEFAULT '0',
  `ERRCODE` int(11) DEFAULT NULL,
  `KIND` char(1) NOT NULL,
  `FKCONTENT` int(11) DEFAULT NULL,
  `DEPTCODE` char(30) NOT NULL,
  `BATCHFLAG` int(11) NOT NULL DEFAULT '0',
  `RETRY` int(11) NOT NULL DEFAULT '0',
  `TEMPLATECODE` char(14) DEFAULT NULL
);




