CREATE TABLE `games` (
    `id` int NOT NULL AUTO_INCREMENT,
    `players` int NOT NULL,
    `choices` int NOT NULL,
    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `finished` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `choices` (
    `ip` varchar(15) NOT NULL,
    `game` int NOT NULL,
    `choice` int NOT NULL,
    PRIMARY KEY (`ip`, `game`),
    CONSTRAINT `game_id` FOREIGN KEY (`game`) REFERENCES `games` (`id`)
);