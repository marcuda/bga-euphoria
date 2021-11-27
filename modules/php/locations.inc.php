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
 * locations.inc.php
 *
 * euphoria location details
 *
 */

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
