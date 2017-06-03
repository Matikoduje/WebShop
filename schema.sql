CREATE TABLE `users` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `userFirstName` VARCHAR(60) NOT NULL,
  `userLastName` VARCHAR(60) NOT NULL,
  `userLogin` VARCHAR(60) UNIQUE NOT NULL,
  `userPassword` VARCHAR(255) NOT NULL,
  `userEmail` VARCHAR(60) UNIQUE NOT NULL,
  `addressCity` VARCHAR(60),
  `addressCode` VARCHAR(6),
  `addressStreet` VARCHAR(255),
  `addressNumber` VARCHAR(10),
  PRIMARY KEY (`userId`)
);

CREATE TABLE `admins` (
  `adminId` INT NOT NULL AUTO_INCREMENT,
  `adminEmail` VARCHAR(60) UNIQUE NOT NULL,
  `adminLogin` VARCHAR(60) UNIQUE NOT NULL,
  `adminPassword` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`adminId`)
);

CREATE TABLE `messages` (
  `messageId` INT NOT NULL AUTO_INCREMENT,
  `adminId` INT NOT NULL,
  `userId` INT NOT NULL,
  `messageText` VARCHAR(255) NOT NULL,
  `messageTitle` VARCHAR(255) NOT NULL,
  `messageDate` DATETIME NOT NULL,
  PRIMARY KEY (`messageId`),
  FOREIGN KEY (`adminId`) REFERENCES `admins`(`adminId`),
  FOREIGN KEY (`userId`) REFERENCES `users`(`userId`)
);
ALTER TABLE `messages`  ADD `isMessageSent` TINYINT(1) NOT NULL DEFAULT '0'  AFTER `messageText`,  ADD `isMessageRead` TINYINT(1) NOT NULL DEFAULT '0'  AFTER `isMessageSent`;

CREATE TABLE `products_category` (
  `productCategoryId` INT NOT NULL AUTO_INCREMENT,
  `productCategoryName` VARCHAR(60) UNIQUE NOT NULL,
  PRIMARY KEY (`productCategoryId`)
);

CREATE TABLE `products` (
  `productId` INT NOT NULL AUTO_INCREMENT,
  `productName` VARCHAR(60) NOT NULL,
  `productPrice` DECIMAL(11,2) NOT NULL,
  `productDescription` VARCHAR(255) NOT NULL,
  `productCategory` INT NOT NULL,
  `productQuantity` INT,
  PRIMARY KEY (`productId`),
  FOREIGN KEY (`productCategory`) REFERENCES `products_category`(`productCategoryId`)
);

CREATE TABLE `images` (
  `imageId` INT NOT NULL AUTO_INCREMENT,
  `productId` INT NOT NULL,
  `imageLink` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`imageId`),
  FOREIGN KEY (`productId`) REFERENCES products(`productId`)
);

CREATE TABLE `orders_status` (
  `orderStatusId` INT NOT NULL AUTO_INCREMENT,
  `orderStatusDescription` VARCHAR(255),
  PRIMARY KEY (`orderStatusId`)
);

CREATE TABLE `payment_method` (
  `paymentMethodId` INT NOT NULL AUTO_INCREMENT,
  `paymentMethodDesc` VARCHAR(255),
  PRIMARY KEY (`paymentMethodId`)
);

CREATE TABLE `orders` (
  `orderId` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NOT NULL,
  `orderStatusId` INT,
  `paymentMethodId` INT,
  `orderDate` DATETIME NOT NULL,
  `isOrderEdited` TINYINT(1) DEFAULT 1,
  `isOrderConfirmed` TINYINT(1) DEFAULT 0,
  `orderValue` DECIMAL(11,4),
  PRIMARY KEY (`orderId`),
  FOREIGN KEY (`userId`) REFERENCES `users`(`userId`),
  FOREIGN KEY (`orderStatusId`) REFERENCES `orders_status`(`orderStatusId`),
  FOREIGN KEY (`paymentMethodId`) REFERENCES `payment_method` (`paymentMethodId`)
);

CREATE TABLE `invoices` (
  `invoiceId` INT NOT NULL AUTO_INCREMENT,
  `isInvoiceIssued` TINYINT(1) DEFAULT 0,
  `isInvoicePaid` TINYINT(1) DEFAULT 0,
  `invoiceDate` DATETIME,
  `orderId` INT NOT NULL,
  PRIMARY KEY (`invoiceId`),
  FOREIGN KEY (`orderId`) REFERENCES `orders`(`orderId`)
);

CREATE TABLE `order_products` (
  `orderProductId` INT NOT NULL AUTO_INCREMENT,
  `orderId` INT NOT NULL,
  `productId` INT NOT NULL,
  `orderProductQuantity` INT NOT NULL,
  `orderProductPrice` DECIMAL(11,4) NOT NULL,
  `orderProductValue` DECIMAL(11,4) NOT NULL,
  PRIMARY KEY (`orderProductId`),
  FOREIGN KEY (`orderId`) REFERENCES `orders`(`orderId`),
  FOREIGN KEY (`productId`) REFERENCES `products`(`productId`)
);
