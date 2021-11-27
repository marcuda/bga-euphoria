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
 * states.inc.php
 *
 * euphoria game states description
 *
 */

/*
   Game state machine is a tool used to facilitate game developpement by doing common stuff that can be set up
   in a very easy way from this configuration file.

   Please check the BGA Studio presentation about game state to understand this, and associated documentation.

   Summary:

   States types:
   _ activeplayer: in this type of state, we expect some action from the active player.
   _ multipleactiveplayer: in this type of state, we expect some action from multiple players (the active players)
   _ game: this is an intermediary state where we don't expect any actions from players. Your game logic must decide what is the next game state.
   _ manager: special type for initial and final state

   Arguments of game states:
   _ name: the name of the GameState, in order you can recognize it on your own code.
   _ description: the description of the current game state is always displayed in the action status bar on
                  the top of the game. Most of the time this is useless for game state with "game" type.
   _ descriptionmyturn: the description of the current game state when it's your turn.
   _ type: defines the type of game states (activeplayer / multipleactiveplayer / game / manager)
   _ action: name of the method to call when this game state become the current game state. Usually, the
             action method is prefixed by "st" (ex: "stMyGameStateName").
   _ possibleactions: array that specify possible player actions on this step. It allows you to use "checkAction"
                      method on both client side (Javacript: this.checkAction) and server side (PHP: self::checkAction).
   _ transitions: the transitions are the possible paths to go from a game state to another. You must name
                  transitions in order to use transition names in "nextState" PHP method, and use IDs to
                  specify the next game state for each transition.
   _ args: name of the method to call to retrieve arguments for this gamestate. Arguments are sent to the
           client side to be used on "onEnteringState" or to set arguments in the gamestate description.
   _ updateGameProgression: when specified, the game progression is updated (=> call to your getGameProgression
                            method).
*/

//    !! It is not a good idea to modify this file when a game is running !!

 
$machinestates = array(

    // The initial state. Please do not modify.
    ST_GAME_SETUP => array(
        "name" => "gameSetup",
        "description" => "",
        "type" => "manager",
        "action" => "stGameSetup",
        "transitions" => array("" => ST_DRAFT_RECRUITS)
    ),
    
    ST_DRAFT_RECRUITS => array(
        "name" => "draftRecruits",
        "description" => clienttranslate('Other players must select their recruits'),
        "descriptionmyturn" => clienttranslate('${you} must select your recruits'),
        "type" => "multipleactiveplayer",
        "action" => "stDraftRecruits",
        "args" => "argsDraftRecruits",
        "possibleactions" => array("actDraftRecruits", "actDilemmaRecruit"),
        "transitions" => array("" => ST_NEXT)
    ),

    ST_PLAYER_TURN => array(
        "name" => "playerTurn",
        "description" => clienttranslate('${actplayer} must place or retrieve their worker(s)'),
        "descriptionmyturn" => clienttranslate('${you} must place or retrieve worker(s)'),
        "type" => "activeplayer",
        "action" => "stPlay",
        "args" => "argsPlay",
        "possibleactions" => array("actPlace", "actRetrieve", "actDilemma", "actGainRecruit",
                                   "actTradeOffer", "actPass", "actPenalty", "actBenefit"),
        "transitions" => array(
            TX_PLACE => ST_PLACE,
            TX_BUMP => ST_BUMP,
            TX_RETRIEVE => ST_RETRIEVE,
            TX_DILEMMA => ST_RECRUIT,
            TX_TRADE => ST_TRADE,
            TX_NEXT => ST_NEXT,
        )
    ),

    ST_BUMP => array(
        "name" => "bumpWorker",
        "description" => "",
        "type" => "game",
        "action" => "stBump",
        "transitions" => array(
            TX_PLACE => ST_PLACE,
            TX_NEXT => ST_NEXT,
        )
    ),

    ST_RETRIEVE => array(
        "name" => "retrieveWorker",
        "description" => clienttranslate('${actplayer} must place or retrieve their worker(s)'),
        "descriptionmyturn" => clienttranslate('${you} must place or retrieve worker(s)'),
        "type" => "activeplayer",
        "action" => "stRoll",
        "args" => "argsRoll",
        "possibleactions" => array("actPlace", "actRetrieve", "actDilemma", "actGainRecruit",
                                   "actTradeOffer", "actPass", "actPenalty", "actBenefit"),
        "transitions" => array("" => ST_NEXT)
    ),

    ST_PLACE => array(
        "name" => "placeWorker",
        "description" => "",
        "type" => "game",
        "action" => "stPlace",
        "args" => "argsPlace",
        "transitions" => array(
            TX_MINE => ST_MINE,
            TX_MARKET => ST_MARKET,
            TX_NEXT => ST_NEXT,
        )
    ),

    ST_MINE => array(
        "name" => "placeAtMine",
        "description" => "",
        "type" => "game",
        "action" => "stMine",
        "args" => "argsMine",
        "transitions" => array("" => ST_NEXT)
    ),

    ST_MARKET => array(
        "name" => "placeAtMarket",
        "description" => "",
        "type" => "game",
        "action" => "stMarket",
        "args" => "argsMarket",
        "transitions" => array(
            TX_BUMP => ST_BUMP,
            TX_NEXT => ST_NEXT,
        )
    ),

    //actDilemma => (ST_RECRUIT => ST_NEXT | ST_NEXT)
    ST_RECRUIT => array(
        "name" => "playerTurn",
        "description" => clienttranslate('${actplayer} must place or retrieve their worker(s)'),
        "descriptionmyturn" => clienttranslate('${you} must place or retrieve worker(s)'),
        "type" => "activeplayer",
        "action" => "stPlay",
        "args" => "argsPlay",
        "possibleactions" => array("actPlace", "actRetrieve", "actDilemma", "actGainRecruit",
                                   "actTradeOffer", "actPass", "actPenalty", "actBenefit"),
        "transitions" => array(TX_DRAFT => ST_DRAFT_RECRUITS, TX_NEXT => ST_NEXT)
    ),

    ST_TRADE => array(
        "name" => "trade",
        "description" => clienttranslate('${actplayer} must place or retrieve their worker(s)'),
        "descriptionmyturn" => clienttranslate('${you} must place or retrieve worker(s)'),
        "type" => "activeplayer",
        "action" => "stTrade",
        "args" => "argsTrade",
        "possibleactions" => array("actTradeAccept", "actTradeConfirm", "actTradeCancel"),
        "transitions" => array(
            "" => ST_PLAYER_TURN,
            TX_TRADE => ST_TRADE_GAME,
            TX_CANCEL => ST_TRADE_CANCEL,
        )
    ),

    ST_TRADE_GAME => array(
        "name" => "gameTrade",
        "type" => "game",
        "action" => "stTrade",
        "transitions" => array(
            TX_TRADE => ST_TRADE,
            TX_NEXT => ST_PLAYER_TURN,
        ),
    ),

    ST_TRADE_CANCEL => array(
        "name" => "cancelTrade",
        "type" => "game",
        "action" => "stTradeCancel",
        "transitions" => array("", ST_PLAYER_TURN),
    ),

    ST_NEXT => array(
        "name" => "nextPlayer",
        "description" => '',
        "type" => "game",
        "action" => "stNextPlayer",
        "updateGameProgression" => true,
        "transitions" => array("play" => ST_PLAYER_TURN, "trade" => ST_TRADE, "end" => ST_END)
    ),

    // Final state.
    // Please do not modify (and do not overload action/args methods).
    ST_END => array(
        "name" => "gameEnd",
        "description" => clienttranslate("End of game"),
        "type" => "manager",
        "action" => "stGameEnd",
        "args" => "argGameEnd"
    )

);



