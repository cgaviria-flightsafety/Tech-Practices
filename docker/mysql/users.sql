CREATE TABLE `users` (
    `id` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    `name` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    `email` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    `password` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
    `createdAt` DATETIME NOT NULL,
    PRIMARY KEY (`id`) USING BTREE,
    UNIQUE INDEX `UNIQ_email_index_users` (`email`) USING BTREE
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;