CREATE TABLE `users` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `userEmail` VARCHAR(60) UNIQUE NOT NULL,
  `userName` VARCHAR(60) NOT NULL,
  `userSurname` VARCHAR(60) NOT NULL,
  `userPassword` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`userId`)
);

CREATE TABLE `items` (
  `itemId` INT NOT NULL AUTO_INCREMENT,
  `itemName` VARCHAR(60) NOT NULL,
  `itemPrice` DECIMAL(11,4) NOT NULL,
  `itemDescription` VARCHAR(255) NOT NULL,
  `itemQuantity` INT,
  PRIMARY KEY (`itemId`)
);

CREATE TABLE `images` (
  `imageId` INT NOT NULL AUTO_INCREMENT,
  `itemId` INT NOT NULL,
  `imageLink` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`imageId`),
  FOREIGN KEY (`itemId`) REFERENCES items(`itemId`)
);

CREATE TABLE `admins` (
  `adminId` INT NOT NULL AUTO_INCREMENT,
  `adminEmail` VARCHAR(60) NOT NULL,
  `adminLogin` VARCHAR(60) UNIQUE NOT NULL,
  `adminPassword` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`adminId`)
);

CREATE TABLE `messages` (
  `messageId` INT NOT NULL AUTO_INCREMENT,
  `adminId` INT NOT NULL,
  `userId` INT NOT NULL,
  `messageText` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`messageId`),
  FOREIGN KEY (`adminId`) REFERENCES `admins`(`adminId`),
  FOREIGN KEY (`userId`) REFERENCES `users`(`userId`)
);

CREATE TABLE `orders` (
  `orderId` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NOT NULL,
  `orderData` DATETIME NOT NULL,
  `orderValue` DECIMAL(11,4) NOT NULL,
  `orderIsPaid` TINYINT(1) DEFAULT 0,
  `orderIsRealized` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`orderId`),
  FOREIGN KEY (`userId`) REFERENCES `users`(`userId`)
);

CREATE TABLE `ordersSpec` (
  `orderId` INT NOT NULL,
  `itemId` INT NOT NULL,
  `orderedItemQuantity` INT NOT NULL,
  `orderedItemPrice` DECIMAL(11,4) NOT NULL,
  `orderedItemValue` DECIMAL(11,4) NOT NULL,
  FOREIGN KEY (`orderId`) REFERENCES `orders`(`orderId`),
  FOREIGN KEY (`itemId`) REFERENCES `items`(`itemId`)
);