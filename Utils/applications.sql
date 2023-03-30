CREATE TABLE `applications` (
    `application_id` int NOT NULL AUTO_INCREMENT,
    `applicant_id` varchar(256) NOT NULL,
    `job_id` varchar(256) NOT NULL,
    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `is_viewed` int NOT NULL DEFAULT '0',
    `chat_link` varchar(256) NOT NULL DEFAULT 'not_available',
    `resume_file_location` varchar(256) DEFAULT NULL,
    `status` varchar(45) DEFAULT 'not_hired',
    PRIMARY KEY (`application_id`)
)