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
define("TX_DILEMMA", "tx_dilemma");
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
define("GSV_HAS_DOUBLES", "gsv_doubles");

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
define("BOX", "type_box");
define("GLASSES", "type_glasses");

define("ARTIFACT", "type_artifact");
define("ARTIFACTS", array(BALLOON, BAT, BEAR, BOOK, BOX, GLASSES));
define("ARTIFACT_I18N", array(
    clienttranslate("Balloon"),
    clienttranslate("Bat"),
    clienttranslate("Bear"),
    clienttranslate("Book"),
    clienttranslate("Box"),
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
define("REGIONS", array(
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
define("MARKETS", array(
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

define("LOCATIONS", array(
    WIND_SALOON => array(
        'name' => clienttranslate("Wind Saloon"),
        'cost' => array(ARTIFACT => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => ICARUS
    ),
    NIMBUS_LOFT => array(
        'name' => clienttranslate("Nimbus Loft"),
        'cost' => array(COMMODITY => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => ICARUS
    ),
    BREEZE_BAR => array(
        'name' => clienttranslate("Breeze Bar"),
        'cost' => array(RESOURCE => 1, BLISS => 1), //TODO: NOT 2x bliss
        'benefit' => array(INFLUENCE => 1, ARTIFACT => 2),
        'region' => ICARUS
    ),
    SKY_LOUNGE => array(
        'name' => clienttranslate("Sky Lounge"),
        'cost' => array(RESOURCE => 1, BLISS => 1), //TODO: NOT 2x bliss
        'benefit' => array(INFLUENCE => 1, RESOURCE => 2), //TODO: resource? commodity?
        'region' => ICARUS
    ),
    CLOUD_MINE => array(
        'name' => clienttranslate("Cloud Mine"),
        'cost' => NULL,
        'benefit' => array(
            array(BLISS => 1, INFLUENCE => 1),
            array(BLISS => 1, KNOWLEDGE => -1),
            array(BLISS => 2, KNOWLEDGE => 1)
        ),
        'region' => ICARUS
    ),
    INCINERATOR => array(
        'name' => clienttranslate("Incinerator of Historical Accuracy"),
        'cost' => array(ARTIFACT => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => EUPHORIA
    ),
    GENERATOR => array(
        'name' => clienttranslate("Generator"),
        'cost' => NULL,
        'benefit' => array(
            array(ENERGY => 1, INFLUENCE => 1),
            array(ENERGY => 1, KNOWLEDGE => -1),
            array(ENERGY => 2, KNOWLEDGE => 1)
        ),
        'region' => EUPHORIA
    ),
    ARK => array(
        'name' => clienttranslate("Ark of Fractured Memories"),
        'cost' => array(ARTIFACT => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => WASTELANDS
    ),
    FARM => array(
        'name' => clienttranslate("Farm"),
        'cost' => NULL,
        'benefit' => array(
            array(FOOD => 1, INFLUENCE => 1),
            array(FOOD => 1, KNOWLEDGE => -1),
            array(FOOD => 2, KNOWLEDGE => 1)
        ),
        'region' => WASTELANDS
    ),
    FREE_PRESS => array(
        'name' => clienttranslate("Free Press of Harsh Reality"),
        'cost' => array(ARTIFACT => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => SUBTERRA
    ),
    AQUIFER => array(
        'name' => clienttranslate("Aquifer"),
        'cost' => NULL,
        'benefit' => array(
            array(WATER => 1, INFLUENCE => 1),
            array(WATER => 1, KNOWLEDGE => -1),
            array(WATER => 2, KNOWLEDGE => 1)
        ),
        'region' => SUBTERRA
    ),
    EUPHORIA_TUNNEL => array(
        'name' => clienttranslate("Euphorian Tunnel"),
        'cost' => array(ENERGY => 1),
        'benefit' => array(GOLD => 1, ARTIFACT => 1), //TODO: choose 1
        'region' => EUPHORIA
    ),
    EUPHORIA_TUNNEL_END => array(
        'name' => clienttranslate("Euphorian Tunnel Exclusive"),
        'cost' => NULL,
        'benefit' => array(WATER => 3),
        'region' => EUPHORIA
    ),
    WASTELANDS_TUNNEL => array(
        'name' => clienttranslate("Wasterlander Tunnel"),
        'cost' => array(WATER => 1),
        'benefit' => array(CLAY => 1, ARTIFACT => 1), //TODO: choose 1
        'region' => WASTELANDS
    ),
    WASTELANDS_TUNNEL_END => array(
        'name' => clienttranslate("Wasterlander Tunnel Exclusive"),
        'cost' => NULL
        'benefit' => array(ENERGY => 3),
        'region' => WASTELANDS
    ),
    SUBTERRA_TUNNEL => array(
        'name' => clienttranslate("Subterran Tunnel"),
        'cost' => array(WATER => 1),
        'benefit' => array(STONE => 1, ARTIFACT => 1), //TODO: choose 1
        'region' => SUBTERRA
    ),
    SUBTERRA_TUNNEL_END => array(
        'name' => clienttranslate("Subterran Tunnel Exclusive"),
        'cost' => NULL,
        'benefit' => array(FOOD => 3),
        'region' => SUBTERRA
    ),
    ICARUS_TERRITORY => array(
        'name' => clienttranslate("Icarite Territory"),
        'cost' => NULL,
        'benefit' => NULL,
        'region' => ICARUS
    ),
    EUPHORIA_TERRITORY => array(
        'name' => clienttranslate("Euphorian Territory"),
        'cost' => NULL,
        'benefit' => NULL,
        'region' => EUPHRORIA
    ),
    WASTELANDS_TERRITORY => array(
        'name' => clienttranslate("Wastelander Territory"),
        'cost' => NULL,
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    SUBTERRA_TERRITORY => array(
        'name' => clienttranslate("Suberran Territory"),
        'cost' => NULL,
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
    WORKER_TANK_E => array(
        'name' => clienttranslate("Worker Activation Tank"),
        'cost' => array(ENERGY => 3),
        'benefit' => array(KNOWLEDGE => -2, WORKER => 1),
        'region' => NULL
    ),
    WORKER_TANK_W => array(
        'name' => clienttranslate("Worker Activation Tank"),
        'cost' => array(WATER => 3),
        'benefit' => array(MORALE => 2, WORKER => 1),
        'region' => NULL
    ),
    MARKET_E1 => array(
        'name' => clienttranslate("Euphorian Market 1"),
        'cost' => NULL, // Depends on market (2 of: 4x resource, any resource, artifact (any/one), commodity (any/one))
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => EUPHORIA
    ),
    MARKET_E1_1 => array(
        'name' => clienttranslate("Euphorian Market 1, Site 1"),
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'market' => MARKET_E1,
        'region' => EUPHORIA
    ),
    MARKET_E1_2 => array(
        'name' => clienttranslate("Euphorian Market 1, Site 2"),
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'market' => MARKET_E1,
        'region' => EUPHORIA
    ),
    MARKET_E1_3 => array(
        'name' => clienttranslate("Euphorian Market 1, Site 3"),
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'market' => MARKET_E1,
        'region' => EUPHORIA
    ),
    MARKET_E1_4 => array(
        'name' => clienttranslate("Euphorian Market 1, Site 4"),
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'market' => MARKET_E1,
        'region' => EUPHORIA
    ),
    MARKET_E2 => array(
        'name' => clienttranslate("Euphorian Market 2"),
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => EUPHORIA
    ),
    MARKET_E2_1 => array(
        'name' => clienttranslate("Euphorian Market 2, Site 1"),
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'market' => MARKET_E2,
        'region' => EUPHORIA
    ),
    MARKET_E2_2 => array(
        'name' => clienttranslate("Euphorian Market 2, Site 2"),
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'market' => MARKET_E2,
        'region' => EUPHORIA
    ),
    MARKET_E2_3 => array(
        'name' => clienttranslate("Euphorian Market 2, Site 3"),
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'market' => MARKET_E2,
        'region' => EUPHORIA
    ),
    MARKET_E2_4 => array(
        'name' => clienttranslate("Euphorian Market 1, Site 4"),
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'market' => MARKET_E2,
        'region' => EUPHORIA
    ),
    MARKET_W1 => array(
        'name' => clienttranslate("Wasterlander Market 1"),
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => WASTELANDS
    ),
    MARKET_W1_1 => array(
        'name' => clienttranslate("Wasterlander Market 1, Site 1"),
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'market' => MARKET_W1,
        'region' => WASTELANDS
    ),
    MARKET_W1_2 => array(
        'name' => clienttranslate("Wasterlander Market 1, Site 2"),
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'market' => MARKET_W1,
        'region' => WASTELANDS
    ),
    MARKET_W1_3 => array(
        'name' => clienttranslate("Wasterlander Market 1, Site 3"),
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'market' => MARKET_W1,
        'region' => WASTELANDS
    ),
    MARKET_W1_4 => array(
        'name' => clienttranslate("Wasterlander Market 1, Site 4"),
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'market' => MARKET_W1,
        'region' => WASTELANDS
    ),
    MARKET_W2 => array(
        'name' => clienttranslate("Wasterlander Market 2"),
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => WASTELANDS
    ),
    MARKET_W2_1 => array(
        'name' => clienttranslate("Wasterlander Market 2, Site 1"),
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'market' => MARKET_W2,
        'region' => WASTELANDS
    ),
    MARKET_W2_2 => array(
        'name' => clienttranslate("Wasterlander Market 2, Site 2"),
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'market' => MARKET_W2,
        'region' => WASTELANDS
    ),
    MARKET_W2_3 => array(
        'name' => clienttranslate("Wasterlander Market 2, Site 3"),
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'market' => MARKET_W2,
        'region' => WASTELANDS
    ),
    MARKET_W2_4 => array(
        'name' => clienttranslate("Wasterlander Market 2, Site 4"),
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'market' => MARKET_W2,
        'region' => WASTELANDS
    ),
    MARKET_S1 => array(
        'name' => clienttranslate("Subterran Market 1"),
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => SUBTERRA
    ),
    MARKET_S1_1 => array(
        'name' => clienttranslate("Subterran Market 1, Site 1"),
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'market' => MARKET_S1,
        'region' => SUBTERRA
    ),
    MARKET_S1_2 => array(
        'name' => clienttranslate("Subterran Market 1, Site 2"),
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'market' => MARKET_S1,
        'region' => SUBTERRA
    ),
    MARKET_S1_3 => array(
        'name' => clienttranslate("Subterran Market 1, Site 3"),
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'market' => MARKET_S1,
        'region' => SUBTERRA
    ),
    MARKET_S1_4 => array(
        'name' => clienttranslate("Subterran Market 1, Site 4"),
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'market' => MARKET_S1,
        'region' => SUBTERRA
    ),
    MARKET_S2 => array(
        'name' => clienttranslate("Subterran Market 2"),
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => SUBTERRA
    ),
    MARKET_S2_1 => array(
        'name' => clienttranslate("Subterran Market 2, Site 1"),
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'market' => MARKET_S2,
        'region' => SUBTERRA
    ),
    MARKET_S2_2 => array(
        'name' => clienttranslate("Subterran Market 2, Site 2"),
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'market' => MARKET_S2,
        'region' => SUBTERRA
    ),
    MARKET_S2_3 => array(
        'name' => clienttranslate("Subterran Market 2, Site 3"),
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'market' => MARKET_S2,
        'region' => SUBTERRA
    ),
    MARKET_S2_4 => array(
        'name' => clienttranslate("Subterran Market 2, Site 4"),
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'market' => MARKET_S2,
        'region' => SUBTERRA
    ),
));
