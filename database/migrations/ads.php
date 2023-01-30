<?php 

return [
    "
    
CREATE TABLE `ads` (
    `id` int NOT NULL,
    `title` varchar(191) NOT NULL,
    `description` text NOT NULL,
    `address` text NOT NULL,
    `amount` varchar(191) NOT NULL,
    `image` varchar(191) NOT NULL,
    `floor` varchar(191) NOT NULL,
    `year` int NOT NULL,
    `storeroom` tinyint(1) NOT NULL,
    `balcony` tinyint(1) NOT NULL,
    `area` int NOT NULL,
    `room` tinyint NOT NULL,
    `toilet` varchar(255) NOT NULL,
    `parking` tinyint NOT NULL,
    `tag` varchar(191) NOT NULL,
    `user_id` bigint NOT NULL,
    `cat_id` bigint NOT NULL,
    `status` tinyint NOT NULL,
    `sell_status` tinyint NOT NULL,
    `type` tinyint NOT NULL,
    `view` int NOT NULL DEFAULT '0',
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL,
    `deleted_at` datetime DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
  
  
  ALTER TABLE `ads`
    ADD PRIMARY KEY (`id`);
  
  ALTER TABLE `ads`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;
  COMMIT;
    "
];