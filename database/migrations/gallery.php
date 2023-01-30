<?php 

return [
    "
    CREATE TABLE `galleries` (
        `id` bigint NOT NULL,
        `image` varchar(191) NOT NULL,
        `advertise_id` bigint NOT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
        ALTER TABLE `galleries`
        ADD PRIMARY KEY (`id`);
        ALTER TABLE `galleries`
        MODIFY `id` bigint NOT NULL AUTO_INCREMENT;
        COMMIT;

    "
];