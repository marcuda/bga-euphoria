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
 * dilemma.inc.php
 *
 * euphoria dilemma cards
 *
 */

define("DILEMMA_LEFT_BENEFIT", clienttranslte("Draw 2 recruits, keep 1"));
define("DILEMMA_RIGHT_BENEFIT", clienttranslte("Place STAR on this card"));
define("DILEMMAS", array(
    array(
        'cost' => BALLOON,
        DILEMMA_LEFT => clienttranslate("Help a friend escape"),
        DILEMMA_RIGHT => clienttranslate("Turn in a friend")
    ),
    array(
        'cost' => BAT,
        DILEMMA_LEFT => clienttranslate("Fight the oppressor"),
        DILEMMA_RIGHT => clienttranslate("Serve the oppressor")
    ),
    array(
        'cost' => BEAR,
        DILEMMA_LEFT => clienttranslate("Choose true love"),
        DILEMMA_RIGHT => clienttranslate("Accept assigned match")
    ),
    array(
        'cost' => BOOK,
        DILEMMA_LEFT => clienttranslate("Read a book"),
        DILEMMA_RIGHT => clienttranslate("Burn a book")
    ),
    array(
        'cost' => GAME,
        DILEMMA_LEFT => clienttranslate("Let workers relax"),
        DILEMMA_RIGHT => clienttranslate("Make workers toil")
    ),
    array(
        'cost' => GLASSES,
        DILEMMA_LEFT => clienttranslate("Publish an exposé"),
        DILEMMA_RIGHT => clienttranslate("Publish propaganda")
    ),
));
