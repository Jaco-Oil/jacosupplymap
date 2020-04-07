# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.1.77 (MySQL 5.7.28-0ubuntu0.16.04.2-log)
# Database: terminals.test
# Generation Time: 2020-03-04 20:36:49 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table terminals
# ------------------------------------------------------------

DROP TABLE IF EXISTS `terminals`;

CREATE TABLE `terminals` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inner_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `latitude` decimal(11,6) DEFAULT NULL,
  `longitude` decimal(11,6) DEFAULT NULL,
  `type_id` int(3) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `county` varchar(100) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip_code` varchar(6) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `cadec_terminal_id` int(11) DEFAULT NULL,
  `cadec_group_key` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `terminals` WRITE;
/*!40000 ALTER TABLE `terminals` DISABLE KEYS */;

INSERT INTO `terminals` (`id`, `inner_id`, `name`, `latitude`, `longitude`, `type_id`, `address1`, `address2`, `city`, `county`, `state`, `zip_code`, `website`, `cadec_terminal_id`, `cadec_group_key`, `status`)
VALUES
	(1,1001,'AVON - Test',38.018685,-122.063741,1,'611 Solano Way','','Martinez','','CA','94553','',101,NULL,0),
	(2,1002,'BAKERSFIELD WFI',35.296812,-118.918428,1,'7724 E. Panama Lane','','BAKERSFIELD','KERN','CA','93307','',102,NULL,1),
	(3,1003,'COLTON - KINDERMORGAN',34.060774,-117.369864,1,'2359 South Riverside Dr.','','BLOOMINGTON','SAN BERNARDINO','CA','92316','',103,NULL,1),
	(4,1005,'CHICO - KINDERMORGAN',39.708553,-121.813148,1,'2570 HEGAN LANE','','CHICO','BUTTE','CA','95928','',110,NULL,1),
	(5,1006,'KOR - HARPERTOWN',35.296803,-118.918428,1,'7724 E. Panama Lane','','BAKERSFIELD','KERN','CA','93307','',106,NULL,1),
	(6,1007,'IMPERIAL',32.825543,-115.564933,1,'345 West Aten Rd.','','IMPERIAL','IMPERIAL','CA','92251','',107,NULL,0),
	(7,1008,'LAS VEGAS - KINDERMORGAN',36.253292,-115.045683,1,'5049 N. Sloan Ln.','','LAS VEGAS','CLARK','NV','89115','',108,NULL,1),
	(8,1012,'EL SEGUNDO',33.915923,-118.418999,1,'324 EL SEGUNDO BLVD','','EL SEGUNDO','LOS ANGELES','CA','90245','',112,NULL,0),
	(9,1013,'RICHMOND - BP',37.912697,-122.366246,1,'1306 CANAL BLVD','','RICHMOND','CONTRA COSTA','CA','94804','',100,NULL,0),
	(10,1014,'WEST SACRAMENTO',NULL,NULL,1,'','','SACRAMENTO','','CA','95818','',114,NULL,1),
	(11,1016,'SAN JOSE - KINDERMORGAN',37.390870,-121.912139,1,'2150 KRUSE DRIVE','','SAN JOSE','SANTA CLARA','CA','95131','',116,NULL,1),
	(12,1017,'CARSON - KINDERMORGAN',33.806858,-118.232241,1,'2000 E. SEPULVEDA BLVD','','CARSON','LOS ANGELES','CA','90810','GATX',120,NULL,1),
	(13,1019,'STOCKTON - ST SERVICES',37.940989,-121.332802,1,'2941 NAVY DRIVE','','STOCKTON','SAN JOAQUIN','CA','95376','',119,NULL,1),
	(14,1020,'BRADSHAW - KINDERMORGAN',38.571861,-121.335439,1,'2901 Bradshaw Rd.','SEE : SAC km 2085 X REF','SACRAMENTO','SACRAMENTO','CA','95827','',113,NULL,1),
	(15,1022,'DAGGETT',34.864221,-116.884064,1,'34277 Yermo Daggett Rd.','','DAGGETT','SAN BERNARDINO','CA','92327','',118,NULL,0),
	(16,1023,'LA - WILMINGTON - VALERO',33.779960,-118.230918,1,'2402 E. Anaheim St.','','WILMINGTON','LOS ANGELES','CA','90744','Valero Refinery Terminal',123,NULL,1),
	(17,1024,'LA - LAT',33.776998,-118.288714,1,'1660 West Anaheim St.','','Wilmington','LOS ANGELES','CA','90748','',124,NULL,1),
	(18,1025,'LA - ATWOOD',NULL,NULL,1,'','','LOS ANGELES','LOS ANGELES','CA','93301','',122,NULL,1),
	(19,1030,'PHOENIX - KINDERMORGAN',33.447743,-112.175052,1,'49 N. 53rd Ave.','','PHOENIX','','AZ','85043','',109,NULL,1),
	(20,1091,'BENECIA',NULL,NULL,1,'???','','SAN FRANCISCO','SOLANO','CA','','',105,NULL,1),
	(21,2009,'LA - VINVALE',33.952280,-118.163273,1,'8600 S. Garfield Ave.','','Southgate','LOS ANGELES','CA','90280','',121,NULL,1),
	(22,2010,'LA - EAST HYNES',33.863069,-118.161508,1,'5905 PARAMOUNT AVE.','','LONG BEACH','LOS ANGELES','CA','90805','',131,NULL,1),
	(23,2022,'NORTH COLES LEVEE',35.279285,-119.308724,1,'9224 Tupman Rd.','','TUPMAN','KERN','CA','93276','',109,NULL,1),
	(24,2028,'FRESNO - KINDERMORGAN',36.675247,-119.747942,1,'4149 S. Maple Ave.','','Fresno','FRESNO','CA','93725','',104,NULL,1),
	(25,2034,'TUCSON - KINDERMORGAN',32.178279,-110.910924,1,'3841 E. Refinery Way','','Tucson','','AZ','85713','',115,NULL,1),
	(26,2035,'MONTEBELLO',34.005419,-118.123293,1,'605 South Vail','','Montebello','LOS ANGELES','CA','90640','',125,NULL,0),
	(27,2036,'EL PASO',NULL,NULL,1,'4200 JC Varamontes Rd.','','El Paso','','TX','79938','',126,NULL,1),
	(28,2038,'BAKERSFIELD (SJR)',35.395405,-119.046527,1,'3542 Shell St.','','Bakersfield','KERN','CA','93308','',130,NULL,1),
	(29,2039,'LA - LONG BEACH - PDI',33.776688,-118.219783,1,'1920 Lugger Way','','Long Beach','LOS ANGELES','CA','90813','Petro Diamond',129,NULL,1),
	(30,2040,'RICHMOND - CHEVRON',NULL,NULL,1,'','','','','CA','','',100,NULL,0),
	(31,2041,'PHOENIX - CAL - JET',NULL,NULL,1,'','','','','AZ','','',110,NULL,1),
	(32,2043,'BAKERSFIELD (Delta Trading)',35.178212,-119.161572,1,'17731 Millux Road','','Bakersfield','','CA','93311','',126,NULL,1),
	(33,2045,'WFI Yard',35.354561,-118.966772,4,'2200 E. Brundage Lane','','Bakersfield','','CA','93307','',804,NULL,1),
	(34,2046,'LAS VEGAS - AZ Purchase',NULL,NULL,99,'','','',NULL,'','',NULL,108,NULL,1),
	(35,2049,'PARAMOUNT',33.896735,-118.144315,1,'8835 SOMERSET BLVD','','PARAMOUNT',NULL,'CA','90723',NULL,300,NULL,0),
	(36,2050,'CITGO TERMINAL',33.953304,-118.061374,2,'9520 JOHN STREET','','SANTA FE SPRINGS',NULL,'CA','',NULL,300,NULL,0),
	(37,2052,'LA - CONOCO (LUBES)',34.040643,-117.749014,2,'142 E. FRANKLIN AVE','','POMONA',NULL,'CA','91766',NULL,301,NULL,0),
	(38,2053,'NORTH AMERICAN LUBRICANTS',34.010562,-118.190980,2,'4000 E WASHINGTON BLVD','','LOS ANGELES',NULL,'CA','90023',NULL,302,NULL,0),
	(39,2054,'North West Promenade',35.397785,-119.113450,4,'Calloway / Rosedale','','Bakersfield',NULL,'CA','93312',NULL,801,NULL,1),
	(40,2055,'Elmco Shop Trl Drop',35.891757,-119.053455,4,'Hwy 65 / Ave 56','','Ducor',NULL,'CA','',NULL,802,NULL,1),
	(41,2056,'West Mark',35.357998,-118.966727,5,'303-B Mt. Vernon Av','','Bakersfield',NULL,'CA','93307',NULL,701,NULL,1),
	(42,2057,'Fresno Truck Center',36.677306,-119.738521,5,'2727 E. Central','','Fresno',NULL,'CA','93725',NULL,702,NULL,1),
	(43,2058,'Nevada Truck & Trailer Repair',36.249967,-115.044482,5,'4915 N. Sloan Ln','','Las Vegas',NULL,'NV','89115',NULL,703,NULL,1),
	(44,2060,'Beall Trailer',36.703467,-119.766423,5,'2695 S. Fourth St.','','Fresno',NULL,'CA','93725',NULL,704,NULL,1),
	(45,2061,'Sully & Sons',35.354741,-118.962098,5,'2500 E Brundage Ln','','Bakersfield',NULL,'CA','93307',NULL,705,NULL,1),
	(46,2062,'Wheelers Truck Repair',35.379847,-119.074821,5,'2305 Fruitvale Av','','Bakersfield',NULL,'CA','93308',NULL,706,NULL,1),
	(47,2063,'Bakersfield Truck Center',35.389869,-119.023457,5,'8140 Golden State Av','','Bakersfield',NULL,'CA','93308',NULL,707,NULL,1),
	(48,2064,'Jerry and Keiths',35.385633,-119.058084,5,'2814 Landco Dr','','Bakersfield',NULL,'CA','93308',NULL,708,NULL,1),
	(49,2065,'Weld It',34.005305,-118.177752,5,'4477 Sheila Av','','Los Angeles',NULL,'Ca','90023',NULL,709,NULL,1),
	(50,2066,'VBI Painting',35.417488,-119.055210,5,'1808 Robers Ln','','Bakersfield',NULL,'Ca','93308',NULL,710,NULL,1),
	(51,2067,'3 Brand Cattle',35.499523,-119.097750,4,'34731 Lerdo Hwy','','Bakersfield',NULL,'CA','93308',NULL,803,NULL,0),
	(52,2072,'GOLDEN EMPIRE FLEET SERVICE',35.347244,-119.006928,5,'490 BELLE TERRACE','','BAKERSFIELD',NULL,'CA','93309',NULL,711,NULL,1),
	(53,2073,'JUMPER PROPANE STORAGE',NULL,NULL,3,'JUMPER AVE','','WASCO',NULL,'CA','',NULL,601,NULL,0),
	(54,2074,'HWY 65 PROPANE STORAGE',NULL,NULL,3,'HWY 65','','BAKERSFIELD',NULL,'CA','',NULL,602,NULL,0),
	(55,2075,'BUTTONWILLOW RAIL CAR',35.378847,-119.467490,2,'2510 MIRASOL AVE','','BUTTONWILLOW',NULL,'CA','93206',NULL,0,NULL,0),
	(56,2076,'WFI Yard - Propane',35.354578,-118.966772,3,'2200 E. Brundage Lane','','Bakersfield',NULL,'CA','93307',NULL,804,NULL,1),
	(57,2078,'WFI Fresno Yard OD',NULL,NULL,4,'Malaga','','Fresno',NULL,'ca','',NULL,805,NULL,0),
	(58,2080,'R V  JENSEN',36.677308,-119.747570,5,'4029 MAPLE AVE','','FRESNO',NULL,'CA','93725',NULL,806,NULL,0),
	(59,2081,'WFI BKFLD LUBE WAREHOUSE',35.354578,-118.966783,2,'2200 East Brundage Lane','','Bakersfield',NULL,'ca','93307',NULL,804,NULL,1),
	(60,2082,'WFI Fuel Storage',35.354578,-118.966783,1,'2200 E. Brundage Ln','','Bakersfield',NULL,'CA','93307',NULL,2082,NULL,1),
	(61,2084,'SACRAMENTO COP',38.566961,-121.514697,1,'76 BROADWAY','','SACRAMENTO',NULL,'CA','95818',NULL,0,NULL,1),
	(62,2085,'SACRAMENTO KM',38.566961,-121.514697,1,'76 BROADWAY','XR RNCH KMEP/ BRADSHAW','SACRAMENTO',NULL,'CA','95818',NULL,0,NULL,1),
	(63,2087,'LAS VEGAS CAL NEV',36.253283,-115.045694,1,'5049  N SLOAN','','LAS VEGAS',NULL,'NV','89115',NULL,0,NULL,1),
	(64,2088,'TUCSON - ST SERVICE',32.178288,-110.910924,1,'3841 E. REFINERY WAY','','TUCSON',NULL,'AZ','85713',NULL,0,NULL,1),
	(65,2090,'test internal storage 1',35.403346,-119.042129,6,'3101 State Road','','Bakersfield',NULL,'CA','93308',NULL,0,NULL,1),
	(66,2093,'test Internal Storage 2',NULL,NULL,6,'','','',NULL,'','',NULL,0,NULL,1),
	(67,2095,'test Internal Storage 3',NULL,NULL,6,'','','',NULL,'','',NULL,0,NULL,1),
	(68,2096,'LA-LAT SPOT',33.776989,-118.288714,1,'1660 WEST ANAHEIM ST.','','Wilmington',NULL,'Ca','90748',NULL,305,NULL,0),
	(69,2097,'TEHACHAPI PROPANE STORAGE',35.110895,-118.600755,3,'20030 PELLISIER ROAD','','TEHACHAPI',NULL,'CA','93561',NULL,603,NULL,1),
	(70,2098,'PARKER',34.002300,-114.227140,1,'31645  industrial Lane','','Parker',NULL,'AZ','85344',NULL,250,NULL,0),
	(71,2099,'LAS VEGAS - OVERLAND AZ',36.253301,-115.045705,1,'5049 N Sloan','','Las Vegas',NULL,'NV','89115',NULL,0,NULL,1),
	(72,2100,'LAS VEGAS OVERLAND LV',36.253292,-115.045683,1,'5049 N SLOAN','','LAS VEGAS',NULL,'NV','89115',NULL,0,NULL,1),
	(73,2106,'LAS VEGAS PROPET',36.253292,-115.045683,1,'5049 N SLOAN','','LAS VEGAS',NULL,'NV','89115',NULL,0,NULL,1),
	(74,2107,'WFI Fresno Yard',36.670170,-119.742910,1,'2525 E. Malaga','','Fresno',NULL,'CA','93725',NULL,2107,NULL,1),
	(75,2119,'Pump Out',NULL,NULL,1,'Elks Hills Road','','Tupman',NULL,'CA','',NULL,2119,NULL,1),
	(76,2125,'LAS VEGAS UNEV',36.381466,-114.926751,1,'13420 GRAND VALLEY PARKWAY','P.O. BOX 750100','LAS VEGAS',NULL,'NV','89165',NULL,0,NULL,1),
	(77,2127,'PACIFIC ETHANOL',36.922750,-119.976113,1,'31470 Ave 12','','Madera',NULL,'CA','93638',NULL,2127,NULL,1),
	(78,2128,'Van Nuys',34.179484,-118.358881,1,'5359 Oxnard Street','','Van Nuys',NULL,'Ca','91411',NULL,0,NULL,0),
	(79,2132,'SCOTTSDALE CONVENTIONAL',33.447743,-112.175052,1,'49 N 53RD AVENUE','','PHOENIX',NULL,'AZ','85043',NULL,2131,NULL,1),
	(80,2133,'PIXLEY',36.002759,-119.303840,1,'11704 ROAD 120','','PIXLEY',NULL,'CA','93256',NULL,0,NULL,1);

/*!40000 ALTER TABLE `terminals` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
