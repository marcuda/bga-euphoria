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
 * contants.inc.php
 *
 * euphoria game constants
 *
 */

// Game states
define("ST_GAME_SETUP", 1);
define("ST_DRAFT_RECRUITS", 10);
define("ST_PLAYER_TURN", 20);
define("ST_BUMP", 30);
define("ST_RETRIEVE", 40);
define("ST_PLACE", 50);
define("ST_MINE", 60);
define("ST_MARKET", 70);
define("ST_RECRUIT", 75);
define("ST_TRADE", 80);
define("ST_TRADE_GAME", 81);
define("ST_TRADE_CANCEL", 82);
define("ST_NEXT", 90);
define("ST_END", 99);

define("TX_BUMP", "tx_bump");
define("TX_DRAFT", "tx_draft");
define("TX_DILEMMA", "tx_dilemma");
define("TX_END", "tx_end");
define("TX_MARKET", "tx_market");
define("TX_MINE", "tx_mine");
define("TX_NEXT", "tx_next");
define("TX_PLACE", "tx_place");
define("TX_RETRIEVE", "tx_retrieve");
define("TX_TRADE", "tx_trade");
define("TX_CANCEL", "tx_trade_canx");

// Game labels
define("GSV_MARKET_BUILT", "gsv_market_built_");
define("GSV_TRACK_POS", "gsv_track_pos_");
define("GSV_MINER_POS", "gsv_miner_pos_");
define("GSV_TUNNEL_OPEN", "gsv_tunnel_end_");
define("GSV_TRADE", "gsv_trade_counter");
define("GSV_ST_PLAYER", "gsv_st_player");
define("GSV_ST_LOC", "gsv_st_loc");
define("GSV_PREV_ST", "gsv_prev_state");
define("GSV_DOUBLES_VAL", "gsv_doubles_val");
define("GSV_DOUBLES_TURN", "gsv_doubles_turn");

// Game options
define("OPT_MARKET_STARS", 100);
define("OPT_HOUSE_DOUBLES", 101);
define("OPT_MARKET_DRAFT", 102);
define("OPT_MORALE_DRAFT", 103);
define("OPT_RECRUIT_DRAFT", 104);

// Resources
define("BLISS", "resource_bliss");
define("CLAY", "resource_clay");
define("ENERGY", "resource_energy");
define("FOOD", "resource_food");
define("GOLD", "resource_gold");
define("STONE", "resource_stone");
define("WATER", "resource_water");

define("COMMODITY", "resource_commodity");
define("COMMODITIES", array(BLISS, ENERGY, FOOD, WATER));
define("RESOURCE", "resource_resource");
define("RESOURCES", array(CLAY, GOLD, STONE));

define("INFLUENCE", "resource_influence");
define("KNOWLEDGE", "resource_knowledge");
define("MORALE", "resource_morale");
define("WORKER", "resource_worker");
define("STAR", "resource_star");

// Artifacts
define("BALLOON", "type_balloon");
define("BAT", "type_bat");
define("BEAR", "type_bear");
define("BOOK", "type_book");
define("GAME", "type_game");
define("GLASSES", "type_glasses");

define("ARTIFACT", "type_artifact");
define("ARTIFACTS", array(BALLOON, BAT, BEAR, BOOK, GAME, GLASSES));
define("ARTIFACT_I18N", array(
    clienttranslate("Balloon"),
    clienttranslate("Bat"),
    clienttranslate("Bear"),
    clienttranslate("Book"),
    clienttranslate("Game"),
    clienttranslate("Glasses")
));

// Cards
define("RECRUIT", "type_recruit");
define("MARKET", "type_market");
define("DILEMMA", "type_dilemma");
define("DECK_ARTIFACT", "deck_" . ARTIFACT);
define("DECK_RECRUIT", "deck_" . RECRUIT);
define("DECK_MARKET", "deck_" . MARKET);
define("DECK_DILEMMA", "deck_" . DILEMMA);
define("DILEMMA_LEFT", "dilemma_left");
define("DILEMMA_RIGHT", "dilemma_right");

define("CARD_HAND", "hand");
define("CARD_IN_PLAY", "card_active");
define("CARD_HIDDEN", "card_hidden");

// Board regions
define("ICARUS", "region_icarus");
define("EUPHORIA", "region_euphoria");
define("WASTELANDS", "region_wastelands");
define("SUBTERRA", "region_subterra");
define("REGION_I18N", array(
    ICARUS => clienttranslate('Icarus')
    EUPHORIA => clienttranslate('Euphoria')
    WASTELANDS => clienttranslate('Wastelands')
    SUBTERRA => clienttranslate('Subterra')
));

// Board locations
define("INACTIVE", 100);
define("ACTIVE", 101);
define("BUMPED", 102);
// Icarus
define("ICARUS_TERRITORY", 200);
define("WIND_SALOON", 201);
define("NIMBUS_LOFT", 202);
define("BREEZE_BAR", 203);
define("SKY_LOUNGE", 204);
define("CLOUD_MINE", 205);
// Euphoria
define("EUPHORIA_TERRITORY", 300);
define("INCINERATOR", 301);
define("GENERATOR", 302);
define("EUPHORIA_TUNNEL", 303);
define("EUPHORIA_TUNNEL_END", 304);
define("MARKET_E1", 310);
define("MARKET_E1_0", 311);
define("MARKET_E1_1", 312);
define("MARKET_E1_2", 313);
define("MARKET_E1_3", 314);
define("MARKET_E2", 315);
define("MARKET_E2_0", 316);
define("MARKET_E2_1", 317);
define("MARKET_E2_2", 318);
define("MARKET_E2_3", 319);
// Wastelands
define("WASTELANDS_TERRITORY", 400);
define("ARK", 401);
define("FARM", 402);
define("WASTELANDS_TUNNEL", 403);
define("WASTELANDS_TUNNEL_END", 404);
define("MARKET_W1", 410);
define("MARKET_W1_0", 411);
define("MARKET_W1_1", 412);
define("MARKET_W1_2", 413);
define("MARKET_W1_3", 414);
define("MARKET_W2", 415);
define("MARKET_W2_0", 416);
define("MARKET_W2_1", 417);
define("MARKET_W2_2", 418);
define("MARKET_W2_3", 419);
// Subterra
define("SUBTERRA_TERRITORY", 500);
define("FREE_PRESS", 501);
define("AQUIFER", 502);
define("SUBTERRA_TUNNEL", 503);
define("SUBTERRA_TUNNEL_END", 504);
define("MARKET_S1", 510);
define("MARKET_S1_0", 511);
define("MARKET_S1_1", 512);
define("MARKET_S1_2", 513);
define("MARKET_S1_3", 514);
define("MARKET_S2", 515);
define("MARKET_S2_0", 516);
define("MARKET_S2_1", 517);
define("MARKET_S2_2", 518);
define("MARKET_S2_3", 519);
// Other
define("WORKER_TANK_ENERGY", 600);
define("WORKER_TANK_WATER", 601);

define("COMMODITY_AREAS", array(CLOUD_MINE, GENERATOR, FARM, AQUIFER));
define("CON_SITES", array(
    MARKET_E1_0, MARKET_E1_1, MARKET_E1_2, MARKET_E1_3,
    MARKET_E2_0, MARKET_E2_1, MARKET_E2_2, MARKET_E2_3,
    MARKET_W1_0, MARKET_W1_1, MARKET_W1_2, MARKET_W1_3,
    MARKET_W2_0, MARKET_W2_1, MARKET_W2_2, MARKET_W2_3,
    MARKET_S1_0, MARKET_S1_1, MARKET_S1_2, MARKET_S1_3,
    MARKET_S2_0, MARKET_S2_1, MARKET_S2_2, MARKET_S2_3
));
define("MARKET_SITES", array(
    MARKET_E1, MARKET_E2,
    MARKET_S1, MARKET_S2,
    MARKET_W1, MARKET_W2
));
define("MARKETS_BY_REGION", array(
    EUPHORIA => array(MARKET_E1, MARKET_E2),
    WASTELANDS => array(MARKET_W1, MARKET_W2),
    SUBTERRA => array(MARKET_S1, MARKET_S2)
));
define("CONS_BY_MARKET", array(
    MARKET_E1 => array(MARKET_E1_0, MARKET_E1_1, MARKET_E1_2, MARKET_E1_3),
    MARKET_E2 => array(MARKET_E2_0, MARKET_E2_1, MARKET_E2_2, MARKET_E2_3),
    MARKET_W1 => array(MARKET_W1_0, MARKET_W1_1, MARKET_W1_2, MARKET_W1_3),
    MARKET_W2 => array(MARKET_W2_0, MARKET_W2_1, MARKET_W2_2, MARKET_W2_3),
    MARKET_S1 => array(MARKET_S1_0, MARKET_S1_1, MARKET_S1_2, MARKET_S1_3),
    MARKET_S2 => array(MARKET_S2_0, MARKET_S2_1, MARKET_S2_2, MARKET_S2_3)
));
define("TERRITORIES", array(
    ICARUS => ICARUS_TERRITORY,
    EUPHORIA => EUPHORIA_TERRITORY,
    WASTELANDS => WASTELANDS_TERRITORY,
    SUBTERRA => SUBTERRA_TERRITORY
));
define("TUNNELS", array(EUPHORIA_TUNNEL, WASTELANDS_TUNNEL, SUBTERRA_TUNNEL));
define("TUNNEL_ENDS", array(EUPHORIA_TUNNEL_END, WASTELANDS_TUNNEL_END, SUBTERRA_TUNNEL_END));

require_once 'modules/php/locations.inc.php';
require_once 'modules/php/markets.inc.php';
require_once 'modules/php/recruits.inc.php';
require_once 'modules/php/dilemmas.inc.php';
