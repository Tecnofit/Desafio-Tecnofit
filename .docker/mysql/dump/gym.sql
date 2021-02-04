
CREATE TABLE `training` (
  `id` INT AUTO_INCREMENT,
  `name` varchar(255) NULL,
  `status` BOOLEAN DEFAULT TRUE,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
