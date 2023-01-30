<?php 

return [
    "
    CREATE TABLE `comments` (
        `id` bigint NOT NULL,
        `user_id` bigint NOT NULL,
        `post_id` bigint NOT NULL,
        `comment` text NOT NULL,
        `parent_id` bigint DEFAULT NULL,
        `status` tinyint NOT NULL DEFAULT '0',
        `approved` tinyint NOT NULL DEFAULT '0',
        `created_at` datetime NOT NULL,
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
      ALTER TABLE `comments`
      ADD PRIMARY KEY (`id`);
      ALTER TABLE `comments`
      MODIFY `id` bigint NOT NULL AUTO_INCREMENT;
      COMMIT;
    "
];