<?php 

return [
    "
    CREATE TABLE `posts` (
        `id` bigint NOT NULL,
        `title` varchar(191) NOT NULL,
        `body` text NOT NULL,
        `image` text NOT NULL,
        `user_id` bigint NOT NULL,
        `cat_id` int NOT NULL,
        `published_at` datetime NOT NULL,
        `status` tinyint NOT NULL DEFAULT '0',
        `created_at` datetime NOT NULL,
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
        
        ALTER TABLE `posts`
        ADD PRIMARY KEY (`id`);

        ALTER TABLE `posts`
        MODIFY `id` bigint NOT NULL AUTO_INCREMENT;
        COMMIT;
    "
];