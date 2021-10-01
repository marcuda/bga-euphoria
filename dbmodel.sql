
-- ------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- euphoria implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

-- dbmodel.sql

-- This is the file where you are describing the database schema of your game
-- Basically, you just have to export from PhpMyAdmin your table structure and copy/paste
-- this export here.
-- Note that the database itself and the standard tables ("global", "stats", "gamelog" and "player") are
-- already created and must not be created here

-- Note: The database schema is created from this file when the game starts. If you modify this file,
--       you have to restart a game to see your changes in database.

-- Cards (artifact and recruit)
CREATE TABLE IF NOT EXISTS `card` (
  `card_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_type` varchar(16) NOT NULL,
  `card_type_arg` int(11) NOT NULL,
  `card_location` varchar(16) NOT NULL,
  `card_location_arg` int(11) NOT NULL,
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Resources
CREATE TABLE IF NOT EXISTS `resource` (
  `player_id` int unsigned NOT NULL,
  `resource_type` varchar(16) unsigned NOT NULL,
  `resource_count` int unsigned NOT NULL,
  PRIMARY KEY (`player_id`,`resource_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE resource ADD CONSTRAINT fk_player_id FOREIGN KEY (player_id) REFERENCES player(player_id);

-- Workers
CREATE TABLE IF NOT EXISTS `worker` (
  `worker_id` int unsigned NOT NULL AUTO_INCREMENT,
  `player_id` int unsigned NOT NULL,
  `worker_val` int unsigned NOT NULL,
  `worker_loc` varchar(16) unsigned NOT NULL,
  PRIMARY KEY (`worker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE worker ADD CONSTRAINT fk_player_id FOREIGN KEY (player_id) REFERENCES player(player_id);
