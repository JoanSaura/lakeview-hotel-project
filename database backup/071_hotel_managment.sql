-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2025 a las 20:57:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `071_hotel_managment`
--

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `071_customers`, 
                     `071_room_type`,
                     `071_rooms`,
                     `071_employee`, 
                     `071_employee_position`, 
                     `071_reservations`,
                     `071_invoices`,
                     `071_services`,  
                     `071_reports`;
                     `071_reservation_services` 
SET FOREIGN_KEY_CHECKS = 1;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_customers`
--

DROP TABLE IF EXISTS `071_customers`;
CREATE TABLE IF NOT EXISTS `071_customers` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_first_name` varchar(50) NOT NULL,
  `client_last_name` varchar(50) NOT NULL,
  `client_identification` varchar(20) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_phone_number` varchar(15) DEFAULT NULL,
  `client_password` varchar(100) DEFAULT NULL,
  `customer_rol` enum('guest','admin') DEFAULT 'guest',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_customers`
--

INSERT INTO `071_customers` (`client_id`, `client_first_name`, `client_last_name`, `client_identification`, `client_email`, `client_phone_number`, `client_password`, `customer_rol`) VALUES
(1, 'Leonardo', 'DiCaprio', 'L12345678', 'leo.dicaprio@gmail.com', '+1-555-0101', '1234', 'guest'),
(2, 'Natalie', 'Portman', 'N23456789', 'natalie.portman@gmail.com', '+1-555-0102', '1234', 'guest'),
(3, 'Brad', 'Pitt', 'B34567890', 'brad.pitt@gmail.com', '+1-555-0103', '1234', 'guest'),
(4, 'Angelina', 'Jolie', 'A45678901', 'angelina.jolie@gmail.com', '+1-555-0104', '1234', 'guest'),
(5, 'Scarlett', 'Johansson', 'S56789012', 'scarlett.johansson@gmail.com', '+1-555-0105', '1234', 'guest'),
(6, 'Ryan', 'Reynolds', 'R67890123', 'ryan.reynolds@gmail.com', '+1-555-0106', '1234', 'guest'),
(7, 'Jennifer', 'Lawrence', 'J78901234', 'jennifer.lawrence@example.com', '+1-555-0107', '1234', 'guest'),
(8, 'Tom', 'Hanks', 'T89012345', 'tom.hanks@gmail.com', '+1-555-0108', '1234', 'guest'),
(9, 'Meryl', 'Streep', 'M90123456', 'meryl.streep@gmail.com', '+1-555-0109', '1234', 'guest'),
(10, 'Will', 'Smith', 'W01234567', 'will.smith@gmail.com', '+1-555-0110', '1234', 'guest'),
(11, 'Julia', 'Roberts', 'J12345679', 'julia.roberts@example.com', '+1-555-0111', '1234', 'guest'),
(12, 'George', 'Clooney', 'G23456780', 'george.clooney@gmail.com', '+1-555-0112', '1234', 'guest'),
(13, 'Emma', 'Watson', 'E34567891', 'emma.watson@gmail.com', '+1-555-0113', '1234', 'guest'),
(14, 'Chris', 'Hemsworth', 'C45678902', 'chris.hemsworth@gmail.com', '+1-555-0114', '1234', 'guest'),
(15, 'Kate', 'Winslet', 'K56789013', 'kate.winslet@gmail.com', '+1-555-0115', '1234', 'guest'),
(16, 'Hugh', 'Jackman', 'H67890124', 'hugh.jackman@gmail.com', '+1-555-0116', '1234', 'guest'),
(17, 'Ryan', 'Gosling', 'R78901235', 'ryan.gosling@gmail.com', '+1-555-0117', '1234', 'guest'),
(18, 'Jessica', 'Chastain', 'J89012346', 'jessica.chastain@gmail.com', '+1-555-0118', '1234', 'guest'),
(19, 'Robert', 'Pattinson', 'R90123457', 'robert.pattinson@gmail.com', '+1-555-0119', '1234', 'guest'),
(20, 'Charlize', 'Theron', 'C01234568', 'charlize.theron@gmail.com', '+1-555-0120', '1234', 'guest'),
(21, 'Joan', 'Saura', '2131233221XDS', 'jsaura20489@iesjoanramis.org', '312321213213', '987654321', 'admin'),
(22, 'Enrique', 'Vizcaino', '**', 'enrique', '**', 'dwesteacher', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_employee`
--

DROP TABLE IF EXISTS `071_employee`;
CREATE TABLE IF NOT EXISTS `071_employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_first_name` varchar(50) DEFAULT NULL,
  `employee_last_name` varchar(50) DEFAULT NULL,
  `employee_identification` varchar(20) DEFAULT NULL,
  `employee_email` varchar(100) DEFAULT NULL,
  `employee_phone_number` varchar(15) DEFAULT NULL,
  `employee_position` int(11) NOT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `employee_position` (`employee_position`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_employee`
--

INSERT INTO `071_employee` (`employee_id`, `employee_first_name`, `employee_last_name`, `employee_identification`, `employee_email`, `employee_phone_number`, `employee_position`) VALUES
(1, 'Penélope', 'Cruz', 'PC12345678', 'penelope.cruz@gmail.com', '+34-600-123-456', 1),
(2, 'Javier', 'Bardem', 'JB23456789', 'javier.bardem@gmail.com', '+34-600-234-567', 1),
(3, 'Antonio', 'Banderas', 'AB34567890', 'antonio.banderas@gmail.com', '+34-600-345-678', 3),
(4, 'Salma', 'Hayek', 'SH45678901', 'salma.hayek@gmail.com', '+34-600-456-789', 3),
(5, 'Luis', 'Tosar', 'LT56789012', 'luis.tosar@gmail.com', '+34-600-567-890', 3),
(6, 'Clara', 'Lago', 'CL67890123', 'clara.lago@gmail.com', '+34-600-678-901', 2),
(7, 'Mario', 'Casas', 'MC78901234', 'mario.casas@gmail.com', '+34-600-789-012', 4),
(8, 'Ana', 'de Armas', 'AA89012345', 'ana.dearmas@gmail.com', '+34-600-890-123', 4),
(9, 'Marta', 'Hazas', 'MH90123456', 'marta.hazas@gmail.com', '+34-600-901-234', 1),
(10, 'Paco', 'López', 'PL01234567', 'paco.lopez@gmail.com', '+34-600-012-345', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_employee_position`
--

DROP TABLE IF EXISTS `071_employee_position`;
CREATE TABLE IF NOT EXISTS `071_employee_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) DEFAULT NULL,
  `position_salary` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_employee_position`
--

INSERT INTO `071_employee_position` (`position_id`, `position_name`, `position_salary`) VALUES
(1, 'Manager', 1600.00),
(2, 'Cleaner', 1400.00),
(3, 'General Stuff', 1400.00),
(4, 'Reception', 1500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_invoices`
--

DROP TABLE IF EXISTS `071_invoices`;
CREATE TABLE IF NOT EXISTS `071_invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `total_days` int(11) GENERATED ALWAYS AS (to_days(`date_out`) - to_days(`date_in`)) STORED,
  `invoice_status` varchar(20) DEFAULT NULL,
  `invoice_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `reservation_id` (`reservation_id`),
  KEY `client_id` (`client_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_invoices`
--

INSERT INTO `071_invoices` (`invoice_id`, `reservation_id`, `client_id`, `room_id`, `date_in`, `date_out`, `invoice_status`, `invoice_total`) VALUES
(17, 10, 1, 1, '2024-09-15', '2024-09-20', 'paid', 250.00),
(18, 11, 2, 2, '2024-09-18', '2024-09-22', 'unpaid', 200.00),
(19, 12, 3, 3, '2024-09-25', '2024-09-30', 'paid', 250.00),
(20, 13, 4, 4, '2024-10-01', '2024-10-05', 'cancelled', 0.00),
(21, 14, 5, 5, '2024-10-10', '2024-10-15', 'paid', 250.00),
(22, 15, 1, 6, '2024-10-15', '2024-10-20', 'paid', 375.00),
(23, 16, 2, 7, '2024-10-20', '2024-10-25', 'unpaid', 375.00),
(24, 17, 3, 8, '2024-10-25', '2024-10-30', 'paid', 375.00),
(28, 25, 21, 6, '2024-12-15', '2024-12-28', 'unpaid', 975.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_reports`
--

DROP TABLE IF EXISTS `071_reports`;
CREATE TABLE IF NOT EXISTS `071_reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`report_id`),
  KEY `reservation_id` (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_reports`
--

INSERT INTO `071_reports` (`report_id`, `reservation_id`, `description`) VALUES
(1, 10, 'Break all the stuff in his room');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_reservations`
--

DROP TABLE IF EXISTS `071_reservations`;
CREATE TABLE IF NOT EXISTS `071_reservations` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `reservation_state` enum('Booked','Cancelled','Check-In','Check Out') NOT NULL DEFAULT 'Booked',
  `reservation_extras` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`reservation_extras`)),
  `reservation_price_per_day` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `client_id` (`client_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_reservations`
--

INSERT INTO `071_reservations` (`reservation_id`, `client_id`, `room_id`, `date_in`, `date_out`, `reservation_state`, `reservation_extras`, `reservation_price_per_day`) VALUES
(10, 1, 1, '2024-09-15', '2024-09-20', 'Booked', '{\"Restaurant\":{\"breakfast\":8,\"meal\":16,\"dinner\":16,\"extras\":{\"deserts\":2,\"high_quality_wine\":15}}}', NULL),
(11, 2, 2, '2024-09-18', '2024-09-22', 'Cancelled', NULL, NULL),
(12, 3, 3, '2024-09-25', '2024-09-30', 'Check-In', '{\"Spa\":{\"price\":20,\"quantity\":3},\"Restaurant\":{\"breakfast\":8,\"meal\":16,\"dinner\":16,\"extras\":{\"deserts\":2,\"high_quality_wine\":15,\"terrace\":3}}}', NULL),
(13, 4, 4, '2024-10-01', '2024-10-05', 'Cancelled', NULL, NULL),
(14, 5, 5, '2024-10-10', '2024-10-15', 'Booked', '[]', NULL),
(15, 6, 6, '2024-10-15', '2024-10-20', 'Check Out', NULL, NULL),
(16, 7, 7, '2024-10-20', '2024-10-25', 'Check-In', '{\"GYM\":{\"price\":20,\"quantity\":1},\"Restaurant\":{\"breakfast\":8,\"meal\":16,\"dinner\":16,\"extras\":{\"deserts\":2}}}', NULL),
(17, 8, 8, '2024-10-25', '2024-10-30', 'Check-In', '{\"Spa\":{\"price\":20,\"quantity\":3}}', NULL),
(24, 21, 76, '2024-12-04', '2025-01-10', 'Booked', '{\"Spa\":{\"price\":20,\"quantity\":3},\"Restaurant\":{\"breakfast\":8,\"meal\":16,\"dinner\":16,\"extras\":[]}}', NULL),
(25, 21, 6, '2024-12-15', '2024-12-28', 'Check-In', '{\"Spa\":{\"price\":20,\"quantity\":3},\"Restaurant\":{\"breakfast\":8,\"meal\":16,\"dinner\":16,\"extras\":{\"deserts\":2,\"terrace\":3}}}', 75.00);

--
-- Disparadores `071_reservations`
--
DROP TRIGGER IF EXISTS `update_room_status_on_reservation`;
DELIMITER $$
CREATE TRIGGER `update_room_status_on_reservation` AFTER INSERT ON `071_reservations` FOR EACH ROW BEGIN
    UPDATE 071_rooms
    SET room_status = 'On Reservation'
    WHERE room_id = NEW.room_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `071_reservation_details`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `071_reservation_details`;
CREATE TABLE IF NOT EXISTS `071_reservation_details` (
`071_client_first_name` varchar(50)
,`071_client_last_name` varchar(50)
,`071_room_number` int(11)
,`071_room_type_name` varchar(50)
,`071_room_price_per_day` decimal(10,2)
,`071_date_in` date
,`071_date_out` date
,`071_total_days` int(7)
,`071_total_price` decimal(16,2)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_reservation_services`
--

DROP TABLE IF EXISTS `071_reservation_services`;
CREATE TABLE IF NOT EXISTS `071_reservation_services` (
  `rs_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `rs_price` double NOT NULL CHECK (`rs_price` >= 0),
  `rs_date` date NOT NULL,
  `rs_time` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`rs_time`)),
  `rs_state` enum('Cancelled','Checked') NOT NULL DEFAULT 'Checked',
  PRIMARY KEY (`rs_id`),
  KEY `fk_reservation` (`reservation_id`),
  KEY `fk_service` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_reservation_services`
--

INSERT INTO `071_reservation_services` (`rs_id`, `reservation_id`, `service_id`, `quantity`, `rs_price`, `rs_date`, `rs_time`, `rs_state`) VALUES
(1, 25, 1, 1, 8, '2024-12-15', '{\"type\": \"breakfast\", \"hour\": \"08:00\"}', 'Checked'),
(2, 25, 1, 1, 16, '2024-12-15', '{\"type\": \"meal\", \"hour\": \"13:00\"}', 'Checked'),
(3, 25, 1, 1, 16, '2024-12-15', '{\"type\": \"dinner\", \"hour\": \"20:00\"}', 'Checked'),
(4, 25, 2, 1, 2, '2024-12-15', '{\"type\": \"deserts\", \"hour\": \"14:30\"}', 'Checked'),
(5, 25, 2, 1, 15, '2024-12-15', '{\"type\": \"high quality wine\", \"hour\": \"19:00\"}', 'Checked'),
(6, 25, 2, 1, 3, '2024-12-15', '{\"type\": \"terrace\", \"hour\": \"18:00\"}', 'Checked');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_rooms`
--

DROP TABLE IF EXISTS `071_rooms`;
CREATE TABLE IF NOT EXISTS `071_rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` int(11) DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `room_state` enum('dirty','clean','broken') NOT NULL DEFAULT 'clean',
  `room_status` enum('Free','on Reservation') NOT NULL DEFAULT 'Free',
  PRIMARY KEY (`room_id`),
  KEY `room_type_id` (`room_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_rooms`
--

INSERT INTO `071_rooms` (`room_id`, `room_number`, `room_type_id`, `room_state`, `room_status`) VALUES
(1, 101, 1, 'dirty', 'on Reservation'),
(2, 102, 1, 'clean', 'on Reservation'),
(3, 103, 1, 'dirty', 'on Reservation'),
(4, 104, 1, 'clean', 'Free'),
(5, 105, 1, 'dirty', 'on Reservation'),
(6, 201, 2, 'dirty', 'on Reservation'),
(7, 202, 2, 'dirty', 'on Reservation'),
(8, 203, 2, 'dirty', 'Free'),
(9, 204, 2, 'clean', 'Free'),
(10, 205, 2, 'clean', 'Free'),
(11, 301, 3, 'clean', 'Free'),
(12, 302, 3, 'clean', 'Free'),
(13, 303, 3, 'clean', 'Free'),
(14, 304, 3, 'clean', 'Free'),
(15, 305, 3, 'clean', 'Free'),
(16, 401, 4, 'clean', 'Free'),
(17, 402, 4, 'clean', 'Free'),
(18, 403, 4, 'clean', 'Free'),
(19, 404, 4, 'clean', 'Free'),
(20, 405, 4, 'clean', 'Free'),
(64, 110, 5, 'clean', 'Free'),
(65, 111, 5, 'clean', 'Free'),
(66, 112, 5, 'clean', 'Free'),
(67, 210, 6, 'clean', 'Free'),
(68, 211, 6, 'clean', 'Free'),
(69, 212, 6, 'clean', 'Free'),
(70, 310, 7, 'clean', 'Free'),
(71, 311, 7, 'clean', 'Free'),
(72, 410, 8, 'clean', 'Free'),
(73, 411, 8, 'clean', 'Free'),
(74, 412, 8, 'clean', 'Free'),
(75, 510, 9, 'clean', 'Free'),
(76, 511, 9, 'clean', 'on Reservation'),
(77, 610, 10, 'clean', 'Free'),
(78, 611, 10, 'clean', 'Free'),
(79, 710, 11, 'clean', 'Free'),
(80, 711, 11, 'clean', 'Free'),
(81, 810, 12, 'clean', 'Free'),
(82, 811, 12, 'clean', 'Free'),
(83, 910, 13, 'clean', 'Free'),
(84, 911, 13, 'clean', 'Free');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_room_type`
--

DROP TABLE IF EXISTS `071_room_type`;
CREATE TABLE IF NOT EXISTS `071_room_type` (
  `room_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_name` varchar(50) DEFAULT NULL,
  `room_type_price_per_day` decimal(10,2) DEFAULT NULL,
  `room_type_description` longtext DEFAULT NULL,
  `room_type_capacity` int(100) DEFAULT NULL,
  PRIMARY KEY (`room_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_room_type`
--

INSERT INTO `071_room_type` (`room_type_id`, `room_type_name`, `room_type_price_per_day`, `room_type_description`, `room_type_capacity`) VALUES
(1, 'Single Room', 50.00, 'A small room with a single bed, ideal for one person.', 1),
(2, 'Double Room', 75.00, 'A room with a double bed, perfect for couples or two people.', 2),
(3, 'Suite', 150.00, 'A large room with a separate living area, ideal for families or business travelers.', 3),
(4, 'Deluxe Room', 120.00, 'A luxurious room with premium amenities and a king-size bed.', 1),
(5, 'Family Room', 100.00, 'Spacious room designed for families, with multiple beds and extra space for comfort.', 4),
(6, 'Studio Apartment', 130.00, 'Open-plan living with a fully equipped kitchen, ideal for longer stays.', 2),
(7, 'Penthouse Suite', 250.00, 'Luxury suite with a private terrace, breathtaking views, and top-tier amenities.', 2),
(8, 'Shared Dormitory', 30.00, 'Affordable shared space with bunk beds, perfect for backpackers or budget travelers.', 6),
(9, 'Executive Room', 140.00, 'Premium room designed for business travelers, with a work desk and complimentary Wi-Fi.', 2),
(10, 'Honeymoon Suite', 200.00, 'Romantic suite with elegant decor, a king-size bed, and a private jacuzzi.', 2),
(11, 'Accessible Room', 80.00, 'Room designed for guests with disabilities, featuring accessible facilities and extra space.', 2),
(12, 'Twin Room', 70.00, 'Room with two single beds, ideal for friends or colleagues traveling together.', 2),
(13, 'Presidential Suite', 300.00, 'The epitome of luxury, with a grand living space, private dining area, and top-tier service.', 5),
(14, 'Economy Room', 40.00, 'Basic room with essential amenities for budget-conscious travelers.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_services`
--

DROP TABLE IF EXISTS `071_services`;
CREATE TABLE IF NOT EXISTS `071_services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(50) NOT NULL,
  `standard_price` decimal(10,2) DEFAULT NULL,
  `extra_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_details`)),
  `maximum_capacity` int(10) DEFAULT NULL,
  `open_hours` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_services`
--

INSERT INTO `071_services` (`service_id`, `service_name`, `standard_price`, `extra_details`, `maximum_capacity`, `open_hours`) VALUES
(1, 'GYM', 20.00, NULL, 10, '[\"08\", \"09\", \"10\", \"11\", \"12\", \"13\", \"14\", \"15\", \"16\", \"17\", \"18\", \"19\", \"20\", \"21\", \"22\", \"23\"]'),
(2, 'Spa', 20.00, NULL, 20, '[\"08\", \"09\", \"10\", \"11\", \"12\", \"13\", \"14\", \"15\", \"16\", \"17\", \"18\", \"19\", \"20\", \"21\", \"22\", \"23\"]'),
(3, 'Restaurant', NULL, '{\n    \"breakfast\": \"8.00\",\n    \"meal\": \"16.00\",\n    \"dinner\": \"16.00\",\n    \"extras\": {\n        \"deserts\": \"2.00\",\n        \"high quality wine\": \"15.00\",\n        \"terrace\": \"3.00\"\n    }\n}', 50, '[\"07\", \"08\", \"09\", \"10\", \"11\", \"12\", \"13\", \"14\", \"15\", \"16\", \"17\", \"18\", \"19\", \"20\", \"21\", \"22\", \"23\", \"00\", \"01\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `071_users`
--

DROP TABLE IF EXISTS `071_users`;
CREATE TABLE IF NOT EXISTS `071_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_online` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_mail` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `user_role` enum('guest','customer','admin') NOT NULL DEFAULT 'guest',
  PRIMARY KEY (`user_id`),
  KEY `fk_client_id` (`client_id`),
  KEY `fk_employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `071_users`
--

INSERT INTO `071_users` (`user_id`, `user_online`, `user_password`, `user_mail`, `client_id`, `employee_id`, `user_role`) VALUES
(1, 'Leonardo', '1234', 'leo.dicaprio@gmail.com', 1, NULL, 'guest'),
(2, 'Natalie', '1234', 'natalie.portman@gmail.com', 2, NULL, 'guest'),
(3, 'Brad', '1234', 'brad.pitt@gmail.com', 3, NULL, 'guest'),
(4, 'Angelina', '1234', 'angelina.jolie@gmail.com', 4, NULL, 'guest'),
(5, 'Scarlett', '1234', 'scarlett.johansson@gmail.com', 5, NULL, 'guest'),
(6, 'Ryan', '', 'ryan.reynolds@gmail.com', 6, NULL, 'guest'),
(7, 'Jennifer', '1234', 'jennifer.lawrence@example.com', 7, NULL, 'guest'),
(8, 'Tom', '1234', 'tom.hanks@gmail.com', 8, NULL, 'guest'),
(9, 'Mery', '1234', 'meryl.streep@gmail.com', 9, NULL, 'guest'),
(10, 'Will', '1234', 'will.smith@gmail.com', 10, NULL, 'guest'),
(11, 'Julia', '1234', 'julia.roberts@example.com', 11, NULL, 'guest'),
(12, 'George', '1234', 'george.clooney@gmail.com', 12, NULL, 'guest'),
(13, 'Emma', '1234', 'emma.watson@gmail.com', 13, NULL, 'guest'),
(14, 'Chris', '1234', 'chris.hemsworth@gmail.com', 14, NULL, 'guest'),
(15, 'Kate', '1234', 'kate.winslet@gmail.com', 15, NULL, 'guest'),
(16, 'Hugh', '1234', 'hugh.jackman@gmail.com', 16, NULL, 'guest'),
(17, 'Ryan', '1234', 'ryan.gosling@gmail.com', 17, NULL, 'guest'),
(18, 'Jessica', '1234', 'jessica.chastain@gmail.com', 18, NULL, 'guest'),
(19, 'Robert', '1234', 'robert.pattinson@gmail.com', 19, NULL, 'guest'),
(20, 'Charlize', '', 'charlize.theron@gmail.com', 20, NULL, 'guest'),
(21, 'Joan', '987654321', 'jsaura20489@iesjoanramis.org', 21, NULL, 'admin'),
(22, 'Enrique', 'dwesteacher', 'enrique@gmail.com', 22, NULL, 'admin'),
(32, 'Penelope', NULL, 'penelope.cruz@gmail.com', NULL, 1, 'guest'),
(33, 'Javier', NULL, 'javier.bardem@gmail.com', NULL, 2, 'guest'),
(34, 'Antonio', NULL, 'antonio.banderas@gmail.com', NULL, 3, 'guest'),
(35, 'Salma', NULL, 'salma.hayek@gmail.com', NULL, 4, 'guest'),
(36, 'Luis', NULL, 'luis.tosar@gmail.com', NULL, 5, 'guest'),
(37, 'Clara', NULL, 'clara.lago@gmail.com', NULL, 6, 'guest'),
(38, 'Mario', NULL, 'mario.casas@gmail.com', NULL, 7, 'guest'),
(39, 'Ana', NULL, 'ana.dearmas@gmail.com', NULL, 8, 'guest'),
(40, 'Marta', NULL, 'marta.hazas@gmail.com', NULL, 9, 'guest'),
(41, 'Paco', NULL, 'paco.lopez@gmail.com', NULL, 10, 'guest');

-- --------------------------------------------------------

--
-- Estructura para la vista `071_reservation_details`
--
DROP TABLE IF EXISTS `071_reservation_details`;

DROP VIEW IF EXISTS `071_reservation_details`;
CREATE VIEW `071_reservation_details`  AS SELECT `c`.`client_first_name` AS `071_client_first_name`, `c`.`client_last_name` AS `071_client_last_name`, `rm`.`room_number` AS `071_room_number`, `rt`.`room_type_name` AS `071_room_type_name`, `rt`.`room_type_price_per_day` AS `071_room_price_per_day`, `r`.`date_in` AS `071_date_in`, `r`.`date_out` AS `071_date_out`, to_days(`r`.`date_out`) - to_days(`r`.`date_in`) AS `071_total_days`, (to_days(`r`.`date_out`) - to_days(`r`.`date_in`)) * `rt`.`room_type_price_per_day` AS `071_total_price` FROM (((`071_reservations` `r` join `071_customers` `c` on(`r`.`client_id` = `c`.`client_id`)) join `071_rooms` `rm` on(`r`.`room_id` = `rm`.`room_id`)) join `071_room_type` `rt` on(`rm`.`room_type_id` = `rt`.`room_type_id`)) ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `071_employee`
--
ALTER TABLE `071_employee`
  ADD CONSTRAINT `071_employee_ibfk_1` FOREIGN KEY (`employee_position`) REFERENCES `071_employee_position` (`position_id`);

--
-- Filtros para la tabla `071_invoices`
--
ALTER TABLE `071_invoices`
  ADD CONSTRAINT `071_invoices_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `071_reservations` (`reservation_id`),
  ADD CONSTRAINT `071_invoices_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `071_customers` (`client_id`),
  ADD CONSTRAINT `071_invoices_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `071_rooms` (`room_id`),
  ADD CONSTRAINT `fk_invoice_client` FOREIGN KEY (`client_id`) REFERENCES `071_customers` (`client_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `071_reports`
--
ALTER TABLE `071_reports`
  ADD CONSTRAINT `071_reports_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `071_reservations` (`reservation_id`);

--
-- Filtros para la tabla `071_reservations`
--
ALTER TABLE `071_reservations`
  ADD CONSTRAINT `071_reservations_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `071_customers` (`client_id`),
  ADD CONSTRAINT `071_reservations_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `071_rooms` (`room_id`);

--
-- Filtros para la tabla `071_reservation_services`
--
ALTER TABLE `071_reservation_services`
  ADD CONSTRAINT `fk_reservation` FOREIGN KEY (`reservation_id`) REFERENCES `071_reservations` (`reservation_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_service` FOREIGN KEY (`service_id`) REFERENCES `071_services` (`service_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `071_rooms`
--
ALTER TABLE `071_rooms`
  ADD CONSTRAINT `071_rooms_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `071_room_type` (`room_type_id`);

--
-- Filtros para la tabla `071_users`
--
ALTER TABLE `071_users`
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `071_customers` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `071_employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
