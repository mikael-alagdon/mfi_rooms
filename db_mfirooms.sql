-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_mfirooms
DROP DATABASE IF EXISTS `db_mfirooms`;
CREATE DATABASE IF NOT EXISTS `db_mfirooms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_mfirooms`;

-- Dumping structure for table db_mfirooms.tbl_building
DROP TABLE IF EXISTS `tbl_building`;
CREATE TABLE IF NOT EXISTS `tbl_building` (
  `building_id` int(11) NOT NULL AUTO_INCREMENT,
  `building_name` varchar(255) NOT NULL,
  PRIMARY KEY (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_building: ~2 rows (approximately)
DELETE FROM `tbl_building`;
/*!40000 ALTER TABLE `tbl_building` DISABLE KEYS */;
INSERT INTO `tbl_building` (`building_id`, `building_name`) VALUES
	(1, 'IT'),
	(2, 'Institute');
/*!40000 ALTER TABLE `tbl_building` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_course
DROP TABLE IF EXISTS `tbl_course`;
CREATE TABLE IF NOT EXISTS `tbl_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(50) NOT NULL,
  `program_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `fk_course_program_id` (`program_id`),
  KEY `fk_course_department_id` (`department_id`),
  CONSTRAINT `fk_course_department_id` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`department_id`),
  CONSTRAINT `fk_course_program_id` FOREIGN KEY (`program_id`) REFERENCES `tbl_program` (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_course: ~2 rows (approximately)
DELETE FROM `tbl_course`;
/*!40000 ALTER TABLE `tbl_course` DISABLE KEYS */;
INSERT INTO `tbl_course` (`course_id`, `course_name`, `program_id`, `department_id`) VALUES
	(1, 'IT', 2, 2),
	(2, 'Networking', 2, 2);
/*!40000 ALTER TABLE `tbl_course` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_department
DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE IF NOT EXISTS `tbl_department` (
  `department_id` int(10) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_department: ~4 rows (approximately)
DELETE FROM `tbl_department`;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
INSERT INTO `tbl_department` (`department_id`, `department_name`) VALUES
	(1, 'N/A'),
	(2, 'IT'),
	(3, 'AUTOMOTIVE'),
	(4, 'ELECTRONICS ');
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_floor
DROP TABLE IF EXISTS `tbl_floor`;
CREATE TABLE IF NOT EXISTS `tbl_floor` (
  `floor_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  `building_id` int(10) NOT NULL,
  PRIMARY KEY (`floor_id`),
  KEY `building_id` (`building_id`),
  CONSTRAINT `fk_floor_building_id` FOREIGN KEY (`building_id`) REFERENCES `tbl_building` (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_floor: ~7 rows (approximately)
DELETE FROM `tbl_floor`;
/*!40000 ALTER TABLE `tbl_floor` DISABLE KEYS */;
INSERT INTO `tbl_floor` (`floor_id`, `level`, `building_id`) VALUES
	(1, 'First', 1),
	(2, 'Second', 1),
	(3, 'Third', 1),
	(4, 'First', 2),
	(5, 'Second', 2),
	(6, 'Third', 2),
	(7, 'Fourth', 2);
/*!40000 ALTER TABLE `tbl_floor` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_program
DROP TABLE IF EXISTS `tbl_program`;
CREATE TABLE IF NOT EXISTS `tbl_program` (
  `program_id` int(10) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(50) NOT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_program: ~2 rows (approximately)
DELETE FROM `tbl_program`;
/*!40000 ALTER TABLE `tbl_program` DISABLE KEYS */;
INSERT INTO `tbl_program` (`program_id`, `program_name`) VALUES
	(1, 'Senior High School'),
	(2, 'Dual Training System');
/*!40000 ALTER TABLE `tbl_program` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_room
DROP TABLE IF EXISTS `tbl_room`;
CREATE TABLE IF NOT EXISTS `tbl_room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` varchar(255) NOT NULL,
  `building_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `room_type_id` int(10) NOT NULL,
  `room_status_id` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`room_id`),
  KEY `building_id_fk` (`building_id`),
  KEY `floor_id` (`floor_id`),
  KEY `room_type_id` (`room_type_id`),
  KEY `fk_room_status_id` (`room_status_id`),
  CONSTRAINT `fk_room_building_id` FOREIGN KEY (`building_id`) REFERENCES `tbl_building` (`building_id`),
  CONSTRAINT `fk_room_floor_id` FOREIGN KEY (`floor_id`) REFERENCES `tbl_floor` (`floor_id`),
  CONSTRAINT `fk_room_roomt_type_id` FOREIGN KEY (`room_type_id`) REFERENCES `tbl_room_type` (`room_type_id`),
  CONSTRAINT `fk_room_status_id` FOREIGN KEY (`room_status_id`) REFERENCES `tbl_room_status` (`room_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_room: ~7 rows (approximately)
DELETE FROM `tbl_room`;
/*!40000 ALTER TABLE `tbl_room` DISABLE KEYS */;
INSERT INTO `tbl_room` (`room_id`, `room_number`, `building_id`, `floor_id`, `room_type_id`, `room_status_id`) VALUES
	(1, '101', 1, 1, 1, 1),
	(2, '102', 1, 1, 1, 1),
	(4, '103', 2, 4, 2, 1),
	(5, '102', 2, 4, 1, 1),
	(6, '103', 2, 4, 2, 1),
	(9, '104', 2, 4, 3, 1);
/*!40000 ALTER TABLE `tbl_room` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_room_status
DROP TABLE IF EXISTS `tbl_room_status`;
CREATE TABLE IF NOT EXISTS `tbl_room_status` (
  `room_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_status` varchar(50) NOT NULL,
  PRIMARY KEY (`room_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_room_status: ~2 rows (approximately)
DELETE FROM `tbl_room_status`;
/*!40000 ALTER TABLE `tbl_room_status` DISABLE KEYS */;
INSERT INTO `tbl_room_status` (`room_status_id`, `room_status`) VALUES
	(1, 'Unoccupied'),
	(2, 'Occupied');
/*!40000 ALTER TABLE `tbl_room_status` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_room_type
DROP TABLE IF EXISTS `tbl_room_type`;
CREATE TABLE IF NOT EXISTS `tbl_room_type` (
  `room_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type` varchar(255) NOT NULL,
  PRIMARY KEY (`room_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_room_type: ~3 rows (approximately)
DELETE FROM `tbl_room_type`;
/*!40000 ALTER TABLE `tbl_room_type` DISABLE KEYS */;
INSERT INTO `tbl_room_type` (`room_type_id`, `room_type`) VALUES
	(1, 'Classroom'),
	(2, 'Office'),
	(3, 'Others');
/*!40000 ALTER TABLE `tbl_room_type` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_schedule
DROP TABLE IF EXISTS `tbl_schedule`;
CREATE TABLE IF NOT EXISTS `tbl_schedule` (
  `schedule_id` int(10) NOT NULL AUTO_INCREMENT,
  `schedule_date_id` int(10) NOT NULL,
  `schedule_desc_id` int(10) NOT NULL DEFAULT '1',
  `schedule_person_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL,
  `schedule_status_id` int(11) NOT NULL DEFAULT '1',
  `schedule_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`schedule_id`),
  KEY `fkschedule_date_id` (`schedule_date_id`),
  KEY `fkschedule_desc_id` (`schedule_desc_id`),
  KEY `fkschedule_room_id` (`room_id`),
  KEY `fkschedule_person_id` (`schedule_person_id`),
  KEY `fkschedule_status_id` (`schedule_status_id`),
  CONSTRAINT `fk_schedule_date_id` FOREIGN KEY (`schedule_date_id`) REFERENCES `tbl_schedule_date` (`schedule_date_id`),
  CONSTRAINT `fk_schedule_desc_id` FOREIGN KEY (`schedule_desc_id`) REFERENCES `tbl_schedule_desc` (`schedule_desc_id`),
  CONSTRAINT `fk_schedule_person_id` FOREIGN KEY (`schedule_person_id`) REFERENCES `tbl_subject` (`subject_id`),
  CONSTRAINT `fk_schedule_room_id` FOREIGN KEY (`room_id`) REFERENCES `tbl_room` (`room_id`),
  CONSTRAINT `fk_schedule_status_id` FOREIGN KEY (`schedule_status_id`) REFERENCES `tbl_schedule_status` (`schedule_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_schedule: ~14 rows (approximately)
DELETE FROM `tbl_schedule`;
/*!40000 ALTER TABLE `tbl_schedule` DISABLE KEYS */;
INSERT INTO `tbl_schedule` (`schedule_id`, `schedule_date_id`, `schedule_desc_id`, `schedule_person_id`, `room_id`, `schedule_status_id`, `schedule_created`) VALUES
	(1, 1, 1, 1, 1, 4, '2020-04-15 14:01:34'),
	(2, 2, 1, 1, 1, 4, '2020-04-15 14:11:47'),
	(3, 3, 1, 1, 1, 4, '2020-04-15 14:33:54'),
	(4, 4, 1, 1, 1, 4, '2020-04-15 14:34:08'),
	(5, 5, 1, 1, 1, 4, '2020-04-15 14:34:17'),
	(6, 6, 1, 1, 1, 4, '2020-04-15 14:47:17'),
	(7, 7, 1, 1, 1, 4, '2020-04-15 14:47:31'),
	(8, 8, 1, 1, 1, 4, '2020-04-15 14:49:27'),
	(16, 16, 1, 1, 1, 4, '2020-04-15 15:10:45'),
	(17, 17, 1, 1, 1, 1, '2020-04-15 15:11:00'),
	(18, 18, 1, 1, 1, 2, '2020-04-16 09:08:03'),
	(19, 19, 1, 1, 2, 4, '2020-04-18 16:56:46'),
	(22, 22, 1, 1, 2, 1, '2020-04-18 19:57:45'),
	(23, 23, 1, 1, 2, 2, '2020-04-18 21:02:16');
/*!40000 ALTER TABLE `tbl_schedule` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_schedule_date
DROP TABLE IF EXISTS `tbl_schedule_date`;
CREATE TABLE IF NOT EXISTS `tbl_schedule_date` (
  `schedule_date_id` int(10) NOT NULL AUTO_INCREMENT,
  `schedule_date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  PRIMARY KEY (`schedule_date_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_schedule_date: ~13 rows (approximately)
DELETE FROM `tbl_schedule_date`;
/*!40000 ALTER TABLE `tbl_schedule_date` DISABLE KEYS */;
INSERT INTO `tbl_schedule_date` (`schedule_date_id`, `schedule_date`, `time_in`, `time_out`) VALUES
	(1, '2020-04-15', '15:00:00', '16:00:00'),
	(2, '2020-04-15', '16:00:00', '17:00:00'),
	(3, '2020-04-15', '19:00:00', '20:00:00'),
	(4, '2020-04-15', '17:00:00', '18:00:00'),
	(5, '2020-04-15', '18:00:00', '19:00:00'),
	(6, '2020-04-15', '22:00:00', '23:00:00'),
	(7, '2020-04-15', '21:00:00', '22:00:00'),
	(8, '2020-04-16', '15:00:00', '16:00:00'),
	(16, '2020-04-21', '01:00:00', '02:00:00'),
	(17, '2020-04-21', '05:00:00', '10:00:00'),
	(18, '2020-04-21', '10:00:00', '12:00:00'),
	(19, '2020-04-21', '00:00:00', '03:00:00'),
	(22, '2020-04-21', '03:00:00', '10:00:00'),
	(23, '2020-04-21', '10:00:00', '12:00:00');
/*!40000 ALTER TABLE `tbl_schedule_date` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_schedule_desc
DROP TABLE IF EXISTS `tbl_schedule_desc`;
CREATE TABLE IF NOT EXISTS `tbl_schedule_desc` (
  `schedule_desc_id` int(10) NOT NULL AUTO_INCREMENT,
  `schedule_purpose` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`schedule_desc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_schedule_desc: ~1 rows (approximately)
DELETE FROM `tbl_schedule_desc`;
/*!40000 ALTER TABLE `tbl_schedule_desc` DISABLE KEYS */;
INSERT INTO `tbl_schedule_desc` (`schedule_desc_id`, `schedule_purpose`) VALUES
	(1, '');
/*!40000 ALTER TABLE `tbl_schedule_desc` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_schedule_status
DROP TABLE IF EXISTS `tbl_schedule_status`;
CREATE TABLE IF NOT EXISTS `tbl_schedule_status` (
  `schedule_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_status` varchar(50) NOT NULL,
  PRIMARY KEY (`schedule_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_schedule_status: ~4 rows (approximately)
DELETE FROM `tbl_schedule_status`;
/*!40000 ALTER TABLE `tbl_schedule_status` DISABLE KEYS */;
INSERT INTO `tbl_schedule_status` (`schedule_status_id`, `schedule_status`) VALUES
	(1, 'Busy'),
	(2, 'Schedule'),
	(3, 'Cancel'),
	(4, 'N/A');
/*!40000 ALTER TABLE `tbl_schedule_status` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_section
DROP TABLE IF EXISTS `tbl_section`;
CREATE TABLE IF NOT EXISTS `tbl_section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `section_name_id` int(11) NOT NULL,
  PRIMARY KEY (`section_id`),
  KEY `fk_section_course_id` (`course_id`),
  KEY `fk_section_name_id` (`section_name_id`),
  CONSTRAINT `fk_section_course_id` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`course_id`),
  CONSTRAINT `fk_section_section_name_id` FOREIGN KEY (`section_name_id`) REFERENCES `tbl_section_name` (`section_name_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_section: ~0 rows (approximately)
DELETE FROM `tbl_section`;
/*!40000 ALTER TABLE `tbl_section` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_section_name
DROP TABLE IF EXISTS `tbl_section_name`;
CREATE TABLE IF NOT EXISTS `tbl_section_name` (
  `section_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(50) NOT NULL,
  PRIMARY KEY (`section_name_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_section_name: ~0 rows (approximately)
DELETE FROM `tbl_section_name`;
/*!40000 ALTER TABLE `tbl_section_name` DISABLE KEYS */;
INSERT INTO `tbl_section_name` (`section_name_id`, `section_name`) VALUES
	(1, 'N/A');
/*!40000 ALTER TABLE `tbl_section_name` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_subject
DROP TABLE IF EXISTS `tbl_subject`;
CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `subject_id` int(10) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(10) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  PRIMARY KEY (`subject_id`),
  KEY `fk_subject_teacher_id` (`teacher_id`),
  CONSTRAINT `fk_subject_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `tbl_teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_subject: ~0 rows (approximately)
DELETE FROM `tbl_subject`;
/*!40000 ALTER TABLE `tbl_subject` DISABLE KEYS */;
INSERT INTO `tbl_subject` (`subject_id`, `teacher_id`, `subject_name`) VALUES
	(1, 2, 'Admin'),
	(2, 3, 'Java'),
	(3, 3, 'Php');
/*!40000 ALTER TABLE `tbl_subject` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_teacher
DROP TABLE IF EXISTS `tbl_teacher`;
CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `teacher_id` int(10) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `department_id` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`teacher_id`),
  UNIQUE KEY `Index 4` (`profile_id`),
  KEY `fk_teacher_department_id` (`department_id`),
  KEY `fk_teacher_profile_id` (`profile_id`),
  CONSTRAINT `fk_teacher_department_id` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`department_id`),
  CONSTRAINT `fk_teacher_profile_id` FOREIGN KEY (`profile_id`) REFERENCES `tbl_userprofile` (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_teacher: ~2 rows (approximately)
DELETE FROM `tbl_teacher`;
/*!40000 ALTER TABLE `tbl_teacher` DISABLE KEYS */;
INSERT INTO `tbl_teacher` (`teacher_id`, `profile_id`, `department_id`) VALUES
	(2, 4, 1),
	(3, 5, 2);
/*!40000 ALTER TABLE `tbl_teacher` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_userprofile
DROP TABLE IF EXISTS `tbl_userprofile`;
CREATE TABLE IF NOT EXISTS `tbl_userprofile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `suffix` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(15) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `profession` varchar(255) NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`profile_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_userprofile_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_userprofile: ~6 rows (approximately)
DELETE FROM `tbl_userprofile`;
/*!40000 ALTER TABLE `tbl_userprofile` DISABLE KEYS */;
INSERT INTO `tbl_userprofile` (`profile_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `address`, `phone`, `email`, `profession`) VALUES
	(4, 4, 'Root', '', 'Admin', '', '', '', 'mfirooms@gmail.com', 'Web admin'),
	(5, 5, 'Tuna', '', 'Flakes', '', '', '', 'cancan@gmail.com', 'IT teacher'),
	(6, 6, 'San', '', 'Marino', '', 'Panama city', '', 'marino@gmail.com', 'Room manage'),
	(7, 7, 'Corned', '', 'Tuna', '', 'Pasig city', '09285561231', 'tuna@gmail.com', 'User manage'),
	(8, 8, 'Pasta', '', 'Salad', '', 'Marikina city', '', 'pasta@gmail.com', 'Receptionist'),
	(9, 9, 'Staff', '', '', '', '', '', '', 'N/A');
/*!40000 ALTER TABLE `tbl_userprofile` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_users
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type_id` int(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_type_id` (`user_type_id`),
  CONSTRAINT `fk_users_user_type_id` FOREIGN KEY (`user_type_id`) REFERENCES `tbl_user_type` (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_users: ~6 rows (approximately)
DELETE FROM `tbl_users`;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `user_type_id`) VALUES
	(4, 'admin', '$2y$10$0tXyBIb0A/66p2W0TXJGRuaRPUngrTtthTSM/FdYR5cyu3SJy35I.', 1),
	(5, 'teacher', '$2y$10$JdgLtxavWdXDrGRkA2CubuIybucT.Lm4EIDgGLp711LtaqX0v299O', 5),
	(6, 'rmanage', '$2y$10$Z70rPdAc7Xahv.K7dVvJXuEa4NYgOhBq2L1OzSInKt7vItSM2g1jy', 3),
	(7, 'umanage', '$2y$10$H8UH8WTs2SAHKM.XTatwkOcjY.OpF4SbK/fCmlagkhw9GcCoUU/Na', 2),
	(8, 'recep', '$2y$10$Z1P4GGzcoXKF/ejhDcV.VeNrD2o6yRFHm0HvcCGqGEEJnAALlAQPO', 4),
	(9, 'staff', '$2y$10$sE2IGP4cYsaxS6FHK6RlbOg5Z.3HKG2JIbEIAuvMOYBjgAlRM3Q82', 6);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

-- Dumping structure for table db_mfirooms.tbl_user_type
DROP TABLE IF EXISTS `tbl_user_type`;
CREATE TABLE IF NOT EXISTS `tbl_user_type` (
  `user_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table db_mfirooms.tbl_user_type: ~6 rows (approximately)
DELETE FROM `tbl_user_type`;
/*!40000 ALTER TABLE `tbl_user_type` DISABLE KEYS */;
INSERT INTO `tbl_user_type` (`user_type_id`, `user_type`) VALUES
	(1, 'Administrator'),
	(2, 'User Management'),
	(3, 'Room Management'),
	(4, 'Receptionist'),
	(5, 'Teacher'),
	(6, 'Staff');
/*!40000 ALTER TABLE `tbl_user_type` ENABLE KEYS */;

-- Dumping structure for view db_mfirooms.vcourse
DROP VIEW IF EXISTS `vcourse`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vcourse` (
	`course_id` INT(11) NOT NULL,
	`course_name` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`program_id` INT(10) NOT NULL,
	`program_name` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`department_id` INT(10) NOT NULL,
	`department_name` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_mfirooms.vroom
DROP VIEW IF EXISTS `vroom`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vroom` (
	`room_id` INT(11) NOT NULL,
	`room_number` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`building_id` INT(11) NOT NULL,
	`building_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`floor_id` INT(11) NOT NULL,
	`level` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`room_type_id` INT(11) NOT NULL,
	`room_type` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`room_status_id` INT(11) NOT NULL,
	`room_status` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_mfirooms.vschedule
DROP VIEW IF EXISTS `vschedule`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vschedule` (
	`schedule_id` INT(10) NOT NULL,
	`building_id` INT(11) NOT NULL,
	`building_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`floor_id` INT(11) NOT NULL,
	`level` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`room_id` INT(11) NOT NULL,
	`room_number` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`profile_id` INT(11) NOT NULL,
	`first_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`last_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`teacher_id` INT(10) NOT NULL,
	`subject_id` INT(10) NOT NULL,
	`subject_name` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`schedule_date_id` INT(10) NOT NULL,
	`schedule_date` DATE NOT NULL,
	`time_in` TIME NOT NULL,
	`time_out` TIME NOT NULL,
	`schedule_desc_id` INT(10) NOT NULL,
	`schedule_purpose` VARCHAR(200) NULL COLLATE 'latin1_swedish_ci',
	`schedule_status_id` INT(11) NOT NULL,
	`schedule_status` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`schedule_created` DATETIME NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_mfirooms.vteacher
DROP VIEW IF EXISTS `vteacher`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vteacher` (
	`user_id` INT(10) NOT NULL,
	`profile_id` INT(11) NOT NULL,
	`first_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`teacher_id` INT(10) NOT NULL,
	`subject_id` INT(10) NOT NULL,
	`subject_name` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`department_id` INT(10) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_mfirooms.vuserlist
DROP VIEW IF EXISTS `vuserlist`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vuserlist` (
	`user_id` INT(10) NOT NULL,
	`username` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`email` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`profile_id` INT(11) NOT NULL,
	`first_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`middle_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`last_name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`suffix` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`address` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`phone` VARCHAR(15) NOT NULL COLLATE 'latin1_swedish_ci',
	`profession` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`user_type_id` INT(10) NOT NULL,
	`user_type` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view db_mfirooms.vcourse
DROP VIEW IF EXISTS `vcourse`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vcourse`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vcourse` AS SELECT co.course_id, co.course_name, po.program_id, 
po.program_name, dep.department_id, dep.department_name
FROM tbl_department dep, tbl_program po, tbl_course co
WHERE co.program_id = po.program_id 
AND co.department_id = dep.department_id ;

-- Dumping structure for view db_mfirooms.vroom
DROP VIEW IF EXISTS `vroom`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vroom`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vroom` AS SELECT ro.room_id, ro.room_number , bu.building_id, bu.building_name, 
fl.floor_id, fl.level, rot.room_type_id, rot.room_type, ros.room_status_id, ros.room_status
FROM tbl_room ro, tbl_building bu , tbl_floor fl, tbl_room_type rot, tbl_room_status ros
WHERE ro.building_id = bu.building_id
AND ro.floor_id = fl.floor_id
AND ro.room_type_id = rot.room_type_id
AND ro.room_status_id = ros.room_status_id ;

-- Dumping structure for view db_mfirooms.vschedule
DROP VIEW IF EXISTS `vschedule`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vschedule`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vschedule` AS SELECT sc.schedule_id, bui.building_id, bui.building_name, flo.floor_id, 
flo.`level`, ro.room_id, ro.room_number, usp.profile_id, usp.first_name, 
usp.last_name, te.teacher_id, su.subject_id, su.subject_name, scd.schedule_date_id,
scd.schedule_date, scd.time_in, scd.time_out, scde.schedule_desc_id, scde.schedule_purpose
, scs.schedule_status_id, scs.schedule_status, sc.schedule_created
FROM tbl_schedule sc, tbl_room ro, tbl_building bui, tbl_floor flo, 
tbl_subject su, tbl_teacher te, tbl_userprofile usp, tbl_schedule_date scd, 
tbl_schedule_desc scde, tbl_schedule_status scs
WHERE sc.room_id = ro.room_id
AND ro.building_id = bui.building_id
AND ro.floor_id = flo.floor_id
AND sc.schedule_person_id = su.subject_id
AND su.teacher_id = te.teacher_id
AND te.profile_id = usp.profile_id
AND sc.schedule_date_id = scd.schedule_date_id
AND sc.schedule_desc_id = scde.schedule_desc_id
AND sc.schedule_status_id = scs.schedule_status_id ;

-- Dumping structure for view db_mfirooms.vteacher
DROP VIEW IF EXISTS `vteacher`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vteacher`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vteacher` AS SELECT up.user_id, up.profile_id, up.first_name, te.teacher_id, 
su.subject_id, su.subject_name, te.department_id 
FROM tbl_userprofile up, tbl_teacher te, tbl_subject su 
WHERE up.profile_id = te.profile_id 
AND te.teacher_id = su.teacher_id ;

-- Dumping structure for view db_mfirooms.vuserlist
DROP VIEW IF EXISTS `vuserlist`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vuserlist`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vuserlist` AS SELECT u.user_id,u.username,u.password,p.email,p.profile_id,p.first_name,p.middle_name,
p.last_name,p.suffix,p.address,p.phone,p.profession,t.user_type_id,t.user_type 
FROM tbl_users u,tbl_userprofile p,tbl_user_type t
WHERE u.user_id = p.user_id AND u.user_type_id = t.user_type_id ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
