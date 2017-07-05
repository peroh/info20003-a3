-- Setup Tables ------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `Spatula`;

CREATE TABLE IF NOT EXISTS `Spatula` (
	`idSpatula` INT auto_increment,
	`ProductName` VARCHAR(50) NOT NULL,
    `Type` ENUM('Cooking','Drugs','Generic','Painting','Plaster') NOT NULL,
    `Size` VARCHAR(50) NOT NULL,
    `Colour` VARCHAR(50) NOT NULL,
    `Price` DECIMAL(10,2) NOT NULL,
    `QuantityInStock` INT NOT NULL,
    PRIMARY KEY (`idSpatula`))
ENGINE = InnoDB;

DROP TABLE IF EXISTS `Order`;

CREATE TABLE IF NOT EXISTS `Order` (
	`idOrder` INT auto_increment,
    `RequestedTime` DATETIME NOT NULL,
    `ResponsibleStaffMember` VARCHAR(100) NOT NULL,
    `CustomerDetails` VARCHAR(300) NOT NULL,
    PRIMARY KEY (`idOrder`))
Engine = InnoDB;

DROP TABLE IF EXISTS `OrderLineItem`;

CREATE TABLE IF NOT EXISTS `OrderLineItem` (
	`idSpatula` INT,
    `idOrder` INT,
    `Quantity` INT NOT NULL,
    PRIMARY KEY (`idSpatula`,`idOrder`),
    FOREIGN KEY (`idSpatula`)
    REFERENCES `Spatula` (`idSpatula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`idOrder`)
    REFERENCES `Order` (`idOrder`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
Engine = InnoDB;

-- Insert Dummy Data -----------------------------------

-- Spatulas

INSERT INTO Spatula VALUES (DEFAULT, 'Egg Flippah', 'Cooking', '10', 'Green', '4.00', '100');
INSERT INTO Spatula VALUES (DEFAULT, 'Egg Flippah', 'Cooking', '20', 'Green', '4.50', '50');
INSERT INTO Spatula VALUES (DEFAULT, 'Egg Flippah', 'Cooking', '30', 'Yellow', '4.00', '0');
INSERT INTO Spatula VALUES (DEFAULT, 'Druggo', 'Drugs', '50', 'Black', '2.00', '10');
INSERT INTO Spatula VALUES (DEFAULT, 'Druggo', 'Drugs', '10', 'Grey', '10.00', '3');
INSERT INTO Spatula VALUES (DEFAULT, 'Van Gogh', 'Painting', '10', 'Blue', '6.00', '0');
INSERT INTO Spatula VALUES (DEFAULT, 'Pitch and Patcher', 'Plaster', '30', 'Red', '6.50', '69');
INSERT INTO Spatula VALUES (DEFAULT, 'Chocolate Caker', 'Cooking', '40', 'Blue', '4.00', '768');
INSERT INTO Spatula VALUES (DEFAULT, 'Healthatula', 'Drugs', '50', 'Orange', '5.00', '43');
INSERT INTO Spatula VALUES (DEFAULT, 'Banksy Beater', 'Painting', '10', 'Purple', '6.00', '12');
INSERT INTO Spatula VALUES (DEFAULT, 'Plastchoice', 'Plaster', '10', 'White', '6.50', '15');
INSERT INTO Spatula VALUES (DEFAULT, 'Yummy Spatch', 'Cooking', '20', 'Green', '4.00', '100');
INSERT INTO Spatula VALUES (DEFAULT, 'Eccies', 'Drugs', '30', 'White', '5.00', '0');
INSERT INTO Spatula VALUES (DEFAULT, 'Raffaele', 'Painting', '10', 'Blue', '6.00', '0');
INSERT INTO Spatula VALUES (DEFAULT, 'Plastered', 'Plaster', '50', 'Orange', '6.50', '0');
INSERT INTO Spatula VALUES (DEFAULT, 'Get Cooked', 'Cooking', '50', 'Orange', '4.00', '0');
INSERT INTO Spatula VALUES (DEFAULT, 'Revolver', 'Drugs', '10', 'Green', '5.00', '0');
INSERT INTO Spatula VALUES (DEFAULT, 'Oil Painter', 'Painting', '10', 'Green', '6.00', '10');
INSERT INTO Spatula VALUES (DEFAULT, 'Plasteraster', 'Plaster', '10', 'Green', '10.50', '0');

-- Orders

INSERT INTO `Order` VALUES (DEFAULT, CURRENT_TIMESTAMP(),'Matt','Customer1');
INSERT INTO `Order` VALUES (DEFAULT, CURRENT_TIMESTAMP(),'Matt','Customer2');
INSERT INTO `Order` VALUES (DEFAULT, CURRENT_TIMESTAMP(),'Matt','Customer3');
INSERT INTO `Order` VALUES (DEFAULT, CURRENT_TIMESTAMP(),'Matt','Customer4');
INSERT INTO `Order` VALUES (DEFAULT, CURRENT_TIMESTAMP(),'Matt','Customer5');

-- Order Line Items

INSERT INTO OrderLineItem VALUES (1,1,1);
INSERT INTO OrderLineItem VALUES (2,2,2);
INSERT INTO OrderLineItem VALUES (3,2,3);
INSERT INTO OrderLineItem VALUES (4,3,4);
INSERT INTO OrderLineItem VALUES (5,3,5);
INSERT INTO OrderLineItem VALUES (6,3,4);
INSERT INTO OrderLineItem VALUES (7,4,3);
INSERT INTO OrderLineItem VALUES (8,4,2);
INSERT INTO OrderLineItem VALUES (9,4,1);
INSERT INTO OrderLineItem VALUES (10,4,2);
INSERT INTO OrderLineItem VALUES (11,5,3);
INSERT INTO OrderLineItem VALUES (12,5,4);
INSERT INTO OrderLineItem VALUES (13,5,5);
INSERT INTO OrderLineItem VALUES (14,5,4);
INSERT INTO OrderLineItem VALUES (15,5,3);

SET FOREIGN_KEY_CHECKS = 1;