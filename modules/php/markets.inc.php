<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * euphoria implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * markets.inc.php
 *
 * euphoria market tiles
 *
 */

define("MARKETS", array(
    array(
        'name' => clienttranslate("Academy of Mandatory Equality"),
        'text' => clienttranslate("You may not use your recruits' special abilities"),
        'cost' => array(FOOD => 4, GOLD => 1),
        'penalty_type' => RECRUIT
    ),
    array(
        'name' => clienttranslate("Apothecary of Productive Dreams"),
        'text' => clienttranslate("You may not place workers in Icarus"),
        'cost' => array(BLISS => 4, RESOURCE => 1),
        'penalty_type' => PLACE  //TODO
    ),
    array(
        'name' => clienttranslate("Arena of Peaceful Conflict"),
        'text' => clienttranslate("You may not place more than 1 worker on each commodity area"),
        'cost' => array(FOOD => 4, STONE => 1),
        'penalty_type' => PLACE //TODO
    ),
    array(
        'name' => clienttranslate("Bemusement Park"),
        'text' => clienttranslate("Every time you roll a 3, lose XXX"),//TODO any res/com
        'cost' => array(COMMOTIDY => 1, BALOON => 1),
        'penalty_type' => ROLL //TODO
    ),
    array(
        'name' => clienttranslate("Cafeteria of Nameless Meat"),
        'text' => clienttranslate("You lose an extra XXX when you retrieve for free"), //TODO moral
        'cost' => array(FOOD => 4, ARTIFACT => 1),
        'penalty_type' => RETRIEVE //TODO
    ),
    array(
        'name' => clienttranslate("Center for Reduced Literacy"),
        'text' => clienttranslate("Every time you roll a 6, lose xxx"),//TODO
        'cost' => array(COMMODITY => 1, BOOK => 1),
        'penalty_type' => ROLL
    ),
    array(
        'name' => clienttranslate("Clinic of Blind Hindsight"),
        'text' => clienttranslate("Every time you roll a 2, lose xxx"),//TODO
        'cost' => array(COMMODITY => 1, GLASSES => 1),
        'penalty_type' => ROLL
    ),
    array(
        'name' => clienttranslate("Courthouse of Hasty Judgment"),
        'text' => clienttranslate("You may not use pairs of ART at artifact markets"),//TODO
        'cost' => array(ENGERY => 4, STONE => 1),
        'penalty_type' => PAYMENT
    ),
    array(
        'name' => clienttranslate("Disassemble-a-teddy-bear Shop"),
        'text' => clienttranslate("Every time you roll a 1, lose a xxx"),//TODO
        'cost' => array(COMMODITY => 1, BEAR => 1),
        'penalty_type' => ROLL
    ),
    array(
        'name' => clienttranslate("Fountain of Wishful Thinking"),
        'text' => clienttranslate("You may not place more than 1 worker per turn"),
        'cost' => array(WATER => 4, GOLD => 1),
        'penalty_type' => PLACE
    ),
    array(
        'name' => clienttranslate("Friendly Local Game Bonfire"),
        'text' => clienttranslate("Every time you roll a 4, lose xxx"),//TODO
        'cost' => array(COMMODITY => 1, GAME => 1),
        'penalty_type' => ROLL
    ),
    array(
        'name' => clienttranslate("Laboratory of Selective Genetics"),
        'text' => clienttranslate("You may not add workers when you have 2 or 3 workers"),
        'cost' => array(ARTIFACT => 1, RESOURCE => 1),
        'penalty_type' => WORKER??
    ),
    array(
        'name' => clienttranslate("Lounge of Opulent Frugality"),
        'text' => clienttranslate("You may not place workers on construction sites occupied by other players' workers"),
        'cost' => array(ENERGEY => 4, ARTIFACT => 1),
        'penalty_type' => PLACE
    ),
    array(
        'name' => clienttranslate("Plaza of Immortalized Humility"),
        'text' => clienttranslate("You may not place workers on constructed markets missing your STAR"),//TODO
        'cost' => array(WATER => 4, CLAY => 1),
        'penalty_type' => PLACE
    ),
    array(
        'name' => clienttranslate("Registry of Personal Secrets"),
        'text' => clienttranslate("You may not use 1st and 2nd tier allegiance track bonuses"),
        'cost' => array(BLISS => 4, ARTIFACT => 1),
        'penalty_type' => RECRUIT
    ),
    array(
        'name' => clienttranslate("Spa of Fleeting Pleasure"),
        'text' => clienttranslate("You may not bump your own workers from action spaces"),
        'cost' => array(WATER => 4, ARTIFACT => 1),
        'penalty_type' => PLACE
    ),
    array(
        'name' => clienttranslate("Stadium of Guaranteed Home Runs"),
        'text' => clienttranslate("Every time you roll a 5, lose XXX"), //TODO
        'cost' => array(COMMODITY => 1, BAT => 1),
        'penalty_type' => ROLL
    ),
    array(
        'name' => clienttranslate("Theater of Revelatory Propaganda"),
        'text' => clienttranslate("You gain KNOW when you place STAR"), //TODO
        'cost' => array(ENERGY => 4, CLAY => 1),
        'penalty_type' => SCORE
    ),
));
