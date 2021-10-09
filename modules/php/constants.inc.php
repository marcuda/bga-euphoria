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
define("ST_PLAY", 20);
define("ST_TRADE", 30);
define("ST_NEXT", 40);
define("ST_END", 99);

// Game labels
define("GSV_MARKET_BUILT", "market_built_");
define("GSV_TRACK_POS", "track_pos_");
define("GSV_MINER_POS", "miner_pos_");
define("GSV_TUNNEL_OPEN", "tunnel_end_");
define("GSV_TRADE", "trade_counter");

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
define("ARTIFACTS", array(BALLON, BAT, BEAR, BOOK, BOX, GLASSES));

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

// Board locations
define("INACTIVE", "loc_inactive");
define("ACTIVE", "loc_active");
define("WIND_SALOON", "loc_wind_saloon");
define("NIMBUS_LOFT", "loc_nimbus_loft");
define("BREEZE_BAR", "loc_breeze_bar");
define("SKY_LOUNGE", "loc_sky_lounge");
define("CLOUD_MINE", "loc_cloud_mine");
define("INCINERATOR", "loc_incinerator");
define("GENERATOR", "loc_generator");
define("ARK", "loc_ark");
define("FARM", "loc_farm");
define("FREE_PRESS", "loc_free_press");
define("AQUIFER", "loc_aquifer");
define("EUPHORIA_TUNNEL", "loc_euph_tunnel");
define("EUPHORIA_TUNNEL_END", "loc_euph_tunnel_end");
define("WASTELANDS_TUNNEL", "loc_waste_tunnel");
define("WASTELANDS_TUNNEL_END", "loc_waste_tunnel_end");
define("SUBTERRA_TUNNEL", "loc_subt_tunnel");
define("SUBTERRA_TUNNEL_END", "loc_subt_tunnel_end");
define("ICARUS_TERRITORY", "loc_icariate_territory");
define("EUPHORIA_TERRITORY", "loc_euph_territory");
define("WASTELANDS_TERRITORY", "loc_waste_territory");
define("SUBTERRA_TERRITORY", "loc_subt_territory");
define("WORKER_TANK_ENERGY", "loc_worker_tank_e");
define("WORKER_TANK_WATER", "loc_worker_tank_w");
define("MARKET_E1", "loc_market_e1");
define("MARKET_E1_0", "loc_market_e1_0");
define("MARKET_E1_1", "loc_market_e1_1");
define("MARKET_E1_2", "loc_market_e1_2");
define("MARKET_E1_3", "loc_market_e1_3");
define("MARKET_E2", "loc_market_e2");
define("MARKET_E2_0", "loc_market_e2_0");
define("MARKET_E2_1", "loc_market_e2_1");
define("MARKET_E2_2", "loc_market_e2_2");
define("MARKET_E2_3", "loc_market_e2_3");
define("MARKET_W1", "loc_market_w1");
define("MARKET_W1_0", "loc_market_w1_0");
define("MARKET_W1_1", "loc_market_w1_1");
define("MARKET_W1_2", "loc_market_w1_2");
define("MARKET_W1_3", "loc_market_w1_3");
define("MARKET_W2", "loc_market_w2");
define("MARKET_W2_0", "loc_market_w2_0");
define("MARKET_W2_1", "loc_market_w2_1");
define("MARKET_W2_2", "loc_market_w2_2");
define("MARKET_W2_3", "loc_market_w2_3");
define("MARKET_S1", "loc_market_s1");
define("MARKET_S1_0", "loc_market_s1_0");
define("MARKET_S1_1", "loc_market_s1_1");
define("MARKET_S1_2", "loc_market_s1_2");
define("MARKET_S1_3", "loc_market_s1_3");
define("MARKET_S2", "loc_market_s2");
define("MARKET_S2_0", "loc_market_s2_0");
define("MARKET_S2_1", "loc_market_s2_1");
define("MARKET_S2_2", "loc_market_s2_2");
define("MARKET_S2_3", "loc_market_s2_3");

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
        'cost' => array(ARTIFACT => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => ICARUS
    ),
    NIMBUS_LOFT => array(
        'cost' => array(COMMODITY => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => ICARUS
    ),
    BREEZE_BAR => array(
        'cost' => array(RESOURCE => 1, BLISS => 1), //TODO: NOT 2x bliss
        'benefit' => array(INFLUENCE => 1, ARTIFACT => 2),
        'region' => ICARUS
    ),
    SKY_LOUNGE => array(
        'cost' => array(RESOURCE => 1, BLISS => 1), //TODO: NOT 2x bliss
        'benefit' => array(INFLUENCE => 1, RESOURCE => 2), //TODO: resource? commodity?
        'region' => ICARUS
    ),
    CLOUD_MINE => array(
        'cost' => NULL,
        'benefit' => array(
            array(BLISS => 1, INFLUENCE => 1),
            array(BLISS => 1, KNOWLEDGE => -1),
            array(BLISS => 2, KNOWLEDGE => 1)
        ),
        'region' => ICARUS
    ),
    INCINERATOR => array(
        'cost' => array(ARTIFACT => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => EUPHORIA
    ),
    GENERATOR => array(
        'cost' => NULL,
        'benefit' => array(
            array(ENERGY => 1, INFLUENCE => 1),
            array(ENERGY => 1, KNOWLEDGE => -1),
            array(ENERGY => 2, KNOWLEDGE => 1)
        ),
        'region' => EUPHORIA
    ),
    ARK => array(
        'cost' => array(ARTIFACT => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => WASTELANDS
    ),
    FARM => array(
        'cost' => NULL,
        'benefit' => array(
            array(FOOD => 1, INFLUENCE => 1),
            array(FOOD => 1, KNOWLEDGE => -1),
            array(FOOD => 2, KNOWLEDGE => 1)
        ),
        'region' => WASTELANDS
    ),
    FREE_PRESS => array(
        'cost' => array(ARTIFACT => 3),
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => SUBTERRA
    ),
    AQUIFER => array(
        'cost' => NULL,
        'benefit' => array(
            array(WATER => 1, INFLUENCE => 1),
            array(WATER => 1, KNOWLEDGE => -1),
            array(WATER => 2, KNOWLEDGE => 1)
        ),
        'region' => SUBTERRA
    ),
    EUPHORIA_TUNNEL => array(
        'cost' => array(ENERGY => 1),
        'benefit' => array(GOLD => 1, ARTIFACT => 1), //TODO: choose 1
        'region' => EUPHORIA
    ),
    EUPHORIA_TUNNEL_END => array(
        'cost' => NULL,
        'benefit' => array(WATER => 3),
        'region' => EUPHORIA
    ),
    WASTELANDS_TUNNEL => array(
        'cost' => array(WATER => 1),
        'benefit' => array(CLAY => 1, ARTIFACT => 1), //TODO: choose 1
        'region' => WASTELANDS
    ),
    WASTELANDS_TUNNEL_END => array(
        'cost' => NULL
        'benefit' => array(ENERGY => 3),
        'region' => WASTELANDS
    ),
    SUBTERRA_TUNNEL => array(
        'cost' => array(WATER => 1),
        'benefit' => array(STONE => 1, ARTIFACT => 1), //TODO: choose 1
        'region' => SUBTERRA
    ),
    SUBTERRA_TUNNEL_END => array(
        'cost' => NULL,
        'benefit' => array(FOOD => 3),
        'region' => SUBTERRA
    ),
    ICARUS_TERRITORY => array(
        'cost' => NULL,
        'benefit' => NULL,
        'region' => ICARUS
    ),
    EUPHORIA_TERRITORY => array(
        'cost' => NULL,
        'benefit' => NULL,
        'region' => EUPHRORIA
    ),
    WASTELANDS_TERRITORY => array(
        'cost' => NULL,
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    SUBTERRA_TERRITORY => array(
        'cost' => NULL,
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
    WORKER_TANK_E => array(
        'cost' => array(ENERGY => 3),
        'benefit' => array(KNOWLEDGE => -2, WORKER => 1),
        'region' => NULL
    ),
    WORKER_TANK_W => array(
        'cost' => array(WATER => 3),
        'benefit' => array(MORALE => 2, WORKER => 1),
        'region' => NULL
    ),
    MARKET_E1 => array(
        'cost' => NULL, // Depends on market (2 of: 4x resource, any resource, artifact (any/one), commodity (any/one))
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => EUPHORIA
    ),
    MARKET_E1_1 => array(
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'region' => EUPHORIA
    ),
    MARKET_E1_2 => array(
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'region' => EUPHORIA
    ),
    MARKET_E1_3 => array(
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'region' => EUPHORIA
    ),
    MARKET_E1_4 => array(
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'region' => EUPHORIA
    ),
    MARKET_E2 => array(
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => EUPHORIA
    ),
    MARKET_E2_1 => array(
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'region' => EUPHORIA
    ),
    MARKET_E2_2 => array(
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'region' => EUPHORIA
    ),
    MARKET_E2_3 => array(
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'region' => EUPHORIA
    ),
    MARKET_E2_4 => array(
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'region' => EUPHORIA
    ),
    MARKET_W1 => array(
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => WASTELANDS
    ),
    MARKET_W1_1 => array(
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    MARKET_W1_2 => array(
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    MARKET_W1_3 => array(
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    MARKET_W1_4 => array(
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    MARKET_W2 => array(
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => WASTELANDS
    ),
    MARKET_W2_1 => array(
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    MARKET_W2_2 => array(
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    MARKET_W2_3 => array(
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    MARKET_W2_4 => array(
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'region' => WASTELANDS
    ),
    MARKET_S1 => array(
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => SUBTERRA
    ),
    MARKET_S1_1 => array(
        'cost' => array(GOLD => 1),
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
    MARKET_S1_2 => array(
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
    MARKET_S1_3 => array(
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
    MARKET_S1_4 => array(
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
    MARKET_S2 => array(
        'cost' => NULL, // Depends on market
        'benefit' => array(STAR => 1, INFLUENCE => 1),
        'region' => SUBTERRA
    ),
    MARKET_S2_1 => array(
        'cost' => array(CLAY => 1),
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
    MARKET_S2_2 => array(
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
    MARKET_S2_3 => array(
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
    MARKET_S2_4 => array(
        'cost' => array(STONE => 1),
        'benefit' => NULL,
        'region' => SUBTERRA
    ),
));
