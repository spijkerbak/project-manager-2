SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP TABLE IF EXISTS `TM2_Task`;
DROP TABLE IF EXISTS `TM2_Project`;
DROP TABLE IF EXISTS `TM2_User`;

CREATE TABLE `TM2_Project` (
  `projectId` int(11) PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `manager` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `TM2_Project` (`projectId`, `title`, `description`, `manager`) VALUES
(1, 'Maria\'s kamer', 'Na deze opknapbeurt zal Maria\'s kamer er weer piekfijn uitzien', 'Maria'),
(3, 'Computer opnieuw installeren', 'Van Windows 8.1 naar Windows 10', 'Maria'),
(4, 'Huis schoonmaken', 'Van boven tot onder', 'Frans');

CREATE TABLE `TM2_Task` (
  `projectId` int(11) NOT NULL,
  `taskNumber` int(11) NOT NULL,
  `title` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `employee` varchar(140) DEFAULT NULL,
  CONSTRAINT PRIMARY KEY (`projectId`,`taskNumber`),
  CONSTRAINT FOREIGN KEY (`projectId`) REFERENCES `TM2_Project` (`projectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `TM2_Task` (`projectId`, `taskNumber`, `title`, `description`, `employee`) VALUES
(1, 1, 'Plinten schilderen', 'Graag mat wit RAL9010. Spijkergaten eerst plamuren.', 'Maria'),
(1, 2, 'Vensterbank vastmaken', 'De vensterbank ligt er nu los op. Geen schroeven of spijkers gebruiken, maar montagekit. Randen afwerken met acrilaatkit', 'John'),
(1, 3, 'Behangen', 'De behangrollen liggen al een jaar klaar bij de behangtafel op zolder achter de oude fietsen.', 'Henk'),
(3, 1, 'Juiste versie kiezen', 'PRO?, Nederlandstalig?', 'Latifa');

CREATE TABLE `TM2_User` (
  `userId` int(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `salt` varchar(64) DEFAULT NULL,
  `passwordHash` varchar(64) DEFAULT NULL,
  `Level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `TM2_User` (`userId`, `name`, `salt`, `passwordHash`, `Level`) VALUES
(0, 'Frans', '9f08912d3467', '76216381ffb69164d119bb2897c9dbe2', 2),
(1, 'Mustafa', '3faeacc31559960dbfadf3bb5c7b6986', '7131f44d9cfab534ecc3088a0baf37fb', 1),
(2, 'Maria', 'dc185e4c5117e0c39ccf42c2c7406f29', '87ce69100166a2a711a9ea4391bdec03', 1);

SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
