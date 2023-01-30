<?php 

return [
    "
    CREATE TABLE `categories` (
        `id` int NOT NULL,
        `name` varchar(191) NOT NULL,
        `parent_id` bigint DEFAULT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
      ALTER TABLE `categories`
    ADD PRIMARY KEY (`id`);
    ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;
    "
];