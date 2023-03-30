CREATE TABLE `hiring_admins` (
    `id` varchar(256) NOT NULL,
    `name` char(64) DEFAULT NULL,
    `email` varchar(64) DEFAULT NULL,
    `number` varchar(10) DEFAULT NULL,
    `password` varchar(256) DEFAULT NULL,
    `last_updated_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `company_name` text,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`),
    UNIQUE KEY `email_UNIQUE` (`email`),
    UNIQUE KEY `number_UNIQUE` (`number`)
)