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
  * euphoria.game.php
  *
  * This is the main file for your game logic.
  *
  * In this PHP file, you are going to defines the rules of the game.
  *
  */


require_once( APP_GAMEMODULE_PATH.'module/table/table.game.php' );


class euphoria extends Table
{
	function __construct( )
	{
        // Your global variables labels:
        //  Here, you can assign labels to global variables you are using for this game.
        //  You can use any number of global variables with IDs between 10 and 99.
        //  If your game has options (variants), you also have to associate here a label to
        //  the corresponding ID in gameoptions.inc.php.
        // Note: afterwards, you can get/set the global variables with getGameStateValue/setGameStateInitialValue/setGameStateValue
        parent::__construct();
        
        self::initGameStateLabels(array( 
            // Flags for if a market is constructed
            GSV_MARKET_BUILT . MARKET_E1  => 10,
            GSV_MARKET_BUILT . MARKET_E2  => 11,
            GSV_MARKET_BUILT . MARKET_S1  => 12,
            GSV_MARKET_BUILT . MARKET_S2  => 13,
            GSV_MARKET_BUILT . MARKET_W1  => 14,
            GSV_MARKET_BUILT . MARKET_W2  => 15,
            // Allegiance track progress markers
            GSV_TRACK_POS . EUPHORIA => 16,
            GSV_TRACK_POS . SUBTERRA => 17,
            GSV_TRACK_POS . WASTELANDS => 18,
            GSV_TRACK_POS . ICARUS => 19,
            // Miner tunnel positions
            GSV_MINER_POS . EUPHORIA => 20,
            GSV_MINER_POS . SUBTERRA => 21,
            GSV_MINER_POS . WASTELANDS => 22,
            // Tunnel end spaces
            GSV_TUNNEL_OPEN . EUPHORIA => 23,
            GSV_TUNNEL_OPEN . SUBTERRA => 24,
            GSV_TUNNEL_OPEN . WASTELANDS => 25,
            // Recruits activated
            GSV_RECRUIT_ACTIVE . EUPHORIA => 26,
            GSV_RECRUIT_ACTIVE . SUBTERRA => 27,
            GSV_RECRUIT_ACTIVE . WASTELANDS => 28,
            GSV_RECRUIT_ACTIVE . ICARUS => 29,
            // Recruits scored
            GSV_RECRUIT_SCORE . EUPHORIA => 30,
            GSV_RECRUIT_SCORE . SUBTERRA => 31,
            GSV_RECRUIT_SCORE . WASTELANDS => 32,
            GSV_RECRUIT_SCORE . ICARUS => 33,
            // State variables
            GSV_TRADE => 34,
            GSV_ST_PLAYER => 35,
            GSV_ST_LOC => 36,
            GSV_PREV_ST => 37,
            GSV_DOUBLES_VAL => 38,
            GSV_DOUBLES_TURN => 39,

            'LAST_GLOBAL' => 89,
            //      ...
            //    "my_first_game_variant" => 100,
            //    "my_second_game_variant" => 101,
            //      ...
        ));        

        $this->cards = self::getNew("module.common.deck");
        $this->cards->init("cards");
	}
	
    protected function getGameName( )
    {
		// Used for translations and stuff. Please do not modify.
        return "euphoria";
    }	

    /*
        setupNewGame:
        
        This method is called only once, when a new game is launched.
        In this method, you must setup the game according to the game rules, so that
        the game is ready to be played.
    */
    protected function setupNewGame( $players, $options = array() )
    {    
        // Set the colors of the players with HTML color code
        // The default below is red/green/blue/orange/brown
        // The number of colors defined here must correspond to the maximum number of players allowed for the gams
        $gameinfos = self::getGameinfos();
        $default_colors = $gameinfos['player_colors'];
 
        // Create players
        // Note: if you added some extra field on "player" table in the database (dbmodel.sql), you can initialize it there.
        $sql = "INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES ";
        $values = array();
        foreach( $players as $player_id => $player )
        {
            $color = array_shift( $default_colors );
            $values[] = "('".$player_id."','$color','".$player['player_canal']."','".addslashes( $player['player_name'] )."','".addslashes( $player['player_avatar'] )."')";
        }
        $sql .= implode( $values, ',' );
        self::DbQuery( $sql );
        self::reattributeColorsBasedOnPreferences( $players, $gameinfos['player_colors'] );
        self::reloadPlayersBasicInfos();
        
        /************ Start the game initialization *****/

        // Init global values with their initial values
        foreach ($this->GAMESTATELABELS as $value_label => $ID) {
            if ($ID >= 10 && $ID < 90) {
                self::setGameStateInitialValue($value_label, 0);
            }
        }
        
        // Init game statistics
        // (note: statistics used in this file must be defined in your stats.inc.php file)
        //self::initStat( 'table', 'table_teststat1', 0 );    // Init a table statistics
        //self::initStat( 'player', 'player_teststat1', 0 );  // Init a player statistics (for all players)

        // TODO: setup the initial game situation here
       
        $cards = array();
        foreach (ARTIFACTS as $idx => $card_type) {
            $cards[] = array(
                'type' => $card_type,
                'type_arg' => $idx,
                'nbr' => 6
            );
        }
        foreach (RECRUITS as $idx => $card) {
            $cards[] = array(
                'type' = RECRUIT,
                'type_arg' = $idx,
                'nbr' => 1
            );
        }
        foreach (MARKETS as $idx => $card) {
            $cards[] array(
                'type' = MARKET,
                'type_arg' = $idx,
                'nbr' => 1
            );
        }
        for (DILEMMAS as $idx => $card) {
            $cards[] array(
                'type' = DILEMMA,
                'type_arg' = $idx,
                'nbr' => 1
            );
        }
        $this->cards->createCards($cards);

        // Separate and shuffle card decks
        foreach (ARTIFACTS as $idx => $card_type) {
            $cards = $this->cards->getCardsOfType($card_type);
            $this->cards->moveCards(array_column($cards, 'id'), DECK_ARTIFACT);
        }
        $this->cards->shuffle(DECK_ARTIFACT);

        $cards = $this->cards->getCardsOfType(RECRUIT);
        $this->cards->moveCards(array_column($cards, 'id'), DECK_RECRUIT);
        $this->cards->shuffle(DECK_RECRUIT);

        $cards = $this->cards->getCardsOfType(DILEMMA);
        $this->cards->moveCards(array_column($cards, 'id'), DECK_DILEMMA);
        $this->cards->shuffle(DECK_DILEMMA);

        // Place market tiles
        $cards = $this->cards->getCardsOfType(MARKET);
        $this->cards->moveCards(array_column($cards, 'id'), DECK_MARKET);
        $this->cards->shuffle(DECK_MARKET);
        foreach (MARKET_SITES as $market) {
            $this->cards->pickCardForLocation(DECK_MARKET, 'board', $market);
        }

        // Set up players
        $high_roll = 0;
        $first_player = 0;
        foreach ($players as $player_id => $player) {
            // Init resources
            foreach (array_merge(COMMODITIES, RESOURCES) as $resource) {
                $sql = "INSERT INTO resource (player_id, resource_type, resource_count)";
                $sql .= " VALUES (${player_id}, '${resource}', 0)";
                self::DbQuery($sql);
            }
            $sql = "INSERT INTO resource (player_id, resource_type, resource_count)";
            $sql .= " VALUES (${player_id}, '". MORALE ."', 1)";
            self::DbQuery($sql);
            $sql = "INSERT INTO resource (player_id, resource_type, resource_count)";
            $sql .= " VALUES (${player_id}, '". KNOWLEDGE ."', 3)";
            self::DbQuery($sql);

            // Init workers
            for ($i=0; $i<4; $i++) {
                $sql = "INSERT INTO worker (player_id, worker_val, worker_loc)";
                $sql .= " VALUES (${player_id}, 0, ". INACTIVE .")";
                self::DbQuery($sql);
            }

            // Take two workers to start
            $roll = $this->gainWorker($player_id);
            $roll += $this->gainWorker($player_id);

            // First player is highest workers roll
            if ($roll > $high_roll) {
                $high_roll = $roll;
                $first_player = $player_id;
            }

            // Draw four recruit cards and one dilemma
            $this->cards->pickCards(4, DECK_RECRUIT, $player_id); // move to active/hidden after draft
            $this->cards->pickCardForLocation(DECK_DILEMMA, CARD_HIDDEN, $player_id); // not in hand per se
        }

        // Start with all players drafting recruits
        //TODO: do options happen before/after? (e.g. markets)
        $this->gamestate->setAllPlayersMultiactive();
        //TODO: set first player?
        //$this->gamestate->changeActivePlayer($first_player);

        /************ End of the game initialization *****/
    }

    /*
        getAllDatas: 
        
        Gather all informations about current game situation (visible by the current player).
        
        The method is called each time the game interface is displayed to a player, ie:
        _ when the game starts
        _ when a player refreshes the game page (F5)
    */
    protected function getAllDatas()
    {
        $result = array();
    
        $current_player_id = self::getCurrentPlayerId();    // !! We must only return informations visible by this player !!
    
        // Get information about players
        $sql = "SELECT player_id id, player_score score FROM player";
        $result['players'] = self::getCollectionFromDb($sql);
        foreach ($result['players'] as $player_id => $player) {
            $player['cards'] = count($this->cards->getPlayerHand($player_id));
            $player['recruits'] = $this->getCardsOfTypeInLocation(RECRUIT, null, "board", $player_id);
        }
        $result['resources'] = self::getCollectionFromDb("SELECT * FROM resource");
        $result['workers'] = self::getCollectionFromDb("SELECT * FROM worker");
        $result['hand'] = $this->cards->getPlayerHand($current_player_id);

        //XXX debug
        $result['globals'] = array_combine(array_keys($this->GAMESTATELABELS), array_map('self::getGameStateValue', array_keys($this->GAMESTATELABELS)));
  
        return $result;
    }

    /*
        getGameProgression:
        
        Compute and return the current game progression.
        The number returned must be an integer beween 0 (=the game just started) and
        100 (= the game is finished or almost finished).
    
        This method is called each time we are in a game state with the "updateGameProgression" property set to true 
        (see states.inc.php)
    */
    function getGameProgression()
    {
        // TODO: compute and return the game progression

        return 0;
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Utility functions
////////////    

    /*
        In this space, you can put any utility methods useful for your game logic
    */

    /*
     * Set the location, and optionally value, of a worker
     */
    function moveWorker($worker_id, $loc, $val=null)
    {
        // Verify inputs
        if (!is_numeric($worker_id) || !in_array($loc, LOCATIONS) || ($val !== null && !is_numeric($val))) {
            throw new feException("Invalid inputs to moveWorker '${worker_id}, ${loc}, ${val}'");
        }

        $sql = "UPDATE worker SET worker_loc = ${loc}";
        if ($val !== null) {
            $sql .= ", worker_val = ${val}";
        }
        $sql .= " WHERE worker_id = ${worker_id}";
        self::DbQuery($sql);
    }

    /*
     * Helper function to get value of a random die roll (1-6)
     */
    function dieRoll()
    {
        return bga_rand(1, 6);
    }

    /*
     * Roll worker and set to active. Return worker value.
     */
    function activateWorker($worker_id)
    {
        $val = dieRoll();
        $this->moveWorker($worker_id, ACTIVE, $val);
        return $val;
    }

    /*
     * Gain and roll a new active worker
     * Returns the value of the die roll, or zero if no worker can be gained
     */
    function gainWorker($player_id)
    {
        //TODO: check penalty
        $sql = "SELECT worker_id FROM worker WHERE player_id = ${player_id}"
        $sql .= " AND worker_loc = ". INACTIVE ." LIMIT 1";
        $id = self::getUniqueValueFromDb($sql);
        if ($id === null) {
            return 0;
        }

        return $this->activateWorker($id);
    }

    /*
     * Compare a player's active workers to their knowledge
     * Discard the highest worker if necessary
     */
    function knowledgeCheck($player_id)
    {
        $sql = "SELECT SUM(worker_val) FROM worker WHERE worker_loc = ". ACTIVE;
        $sql .= " AND player_id = ${player_id}";
        $val = (int)self::getUniqueValueFromDb($sql);
        $val += $this->getResource($player_id, KNOWLEDGE);

        if ($val >= 16) {
            // Lose 1 worker
            $sql = "SELECT worker_id FROM worker WHERE player_id = ${player_id}";
            $sql .= " ORDER BY worker_val DESC LIMIT 1";
            $worker_id = self::getUniqueValuefromDb($sql);

            $this->moveWorker($worker_id, INACTIVE);
            $msg = clienttranslate('${player_name} knowledge check: ${value}, one worker is lost!');
        } else {
            $msg = clienttranslate('${player_name} knowledge check: ${value}');
            $worker_id = null;
        }


        self::notifyAllPlayers('knowledgeCheck', $msg, array(
            'player_name' => self::getPlayerNameById($player_id),
            'player_id' => $player_id,
            'worker_id' => $worker_id,
            'value' => $val,
        ));
    }

    /*
     * Returns true if card_id exists and matches the given type, location, and player
     */
    function verifyCard($card_id, $type, $location, $player_id)
    {
        $card = $this->cards->getCard($card_id);
        if ($card === null) {
            return false;
        }

        if ($type == ARTIFACT) {
            if (!in_array($card['type'], ARTIFACTS)) {
                return false;
            }
        } else {
            if ($card['type'] != $type) {
                return false;
            }
        }

        return $card['location'] == $location && $card['location_arg'] == $player_id;
    }

    /*
     * Returns true if the player has at least nbr of the given resource type
     */
    function hasResource($player_id, $type, $nbr)
    {
        $sql = "SELECT resource_count FROM resource WHERE player_id = ${player_id} AND resource_name = ${type}";
        $val = self::getUniqueValueFromDB($sql);
        return $val !== null && (int)$val >= $nbr;
    }

    /*
     * Get the number of resource a player has
     */
    function getResource($player_id, $resource)
    {
        $sql = "SELECT resource_count FROM resource WHERE resource_name = '${resource}'";
        $sql .= " AND player_id = ${player_id}";
        return (int)self::getUniqueValueFromDb($sql);
    }

    /*
     * Increment the resource count for a player
     */
    function incResource($player_id, $resource, $nbr)
    {
        $sql = "UPDATE resource SET resource_count = resource_count + ${nbr} WHERE ";
        $sql .= "resource_name = '${resource}' AND player_id = ${player_id}";
        self::DbQuery($sql);
    }

    /*
     * Increment the resource count for a player within set bounds (morale, knowledge)
     */
    function incResourceBounded($player_id, $resource, $nbr)
    {
        $val = $this->getResource($player_id, $resource);
        $new_val = $val + $nbr;
        $new_val = min(6, max(1, $new_val));
        if ($new_val != $val) {
            $this->incResource($player_id, $resource, $new_val - $val);
        }
    }

    function getMarketInfo($market_loc)
    {
        $cards = $this->cards->getCardsInLocation('board', $market_loc)
        $card = array_pop($cards);
        return MARKETS[$card['type_arg']];
    }


    function getRecruitInfo($card_id)
    {
        $card = $this->cards->getCard($card_id);
        return RECRUITS[$card['type_arg']];
    }

    /*
     * Activate all hidden recruits from given region
     */
    function activateRecruits($region)
    {
        if (self::getGameStateValue(GSV_RECRUIT_ACTIVE . $region) != 0) {
            // Already active
            return;
        }

        // Set active
        self::incGameStatevalue(GSV_RECRUIT_ACTIVE . $region);
        $msg = clienttranslate('All recruits from ${region} are activated');
        self::notifyAllPlayers('log', $msg, array(
            'i18n' => array('region'),
            'region' => REGION_I18N[$region]
        ));

        // Check all hidden recruits for region
        $cards = $this->getCardsInLocation(CARD_HIDDEN);
        foreach ($cards as $card_id => $card) {
            if ($this->getRecruitInfo($card_id)['region'] == $region) {
                // This region, activate it
                $this->cards->moveCard($card_id, CARD_IN_PLAY, $card['location_arg']);

                // notify (TODO: all at once? is it even necessary?)
                $msg = clienttranslate('${player_name} activates ${card}');
                self::notifyAllPlayers('activateRecruit', $msg, array(
                    'player_name' => self::getPlayerNameById($player_id),
                    'card' => $this->getRecruitInfo($card_id)['name'],
                    'card_id' => $card_id // for UI to flip card
                ));

            }
        }
    }

    /*
     * Verifies the offered trade resources are legal
     * Raises exceptions if not
     */
    function verifyTrade($player_id, $trade)
    {
        if (count($trade) == 0) {
            throw new feException("Impossible trade: no goods offerred");
        }
        foreach ($trade as $type => $nbr) {
            if (in_array($type, ARTIFACTS)) {
                if (!$this->validateCard($nbr, $type, CARD_HAND, $player_id)) {
                    throw new feException("Impossible trade: invalid card '${nbr}' (${type})");
                }
            } else if (in_array($type, RESOURCES) || in_array($type, COMMODITIES)) {
                if (!$this->hasResource($player_id, $type, $nbr)) {
                    throw new BgaUserException(self::_("You do not have enough ${type}"));
                }
            } else {
                throw new feException("Impossible trade: invalid resource '${type}'");
            }
        }
    }

    /*
     * Transfers resources from player_one to player_two
     */
    function doTrade($player_one, $player_two, $resources)
    {
        foreach ($resources as $type => $nbr) {
            if (in_array($type, ARTIFACTS)) {
                $this->cards->moveCard($nbr, CARD_HAND, $player_two);
            } else {
                $this->incResource($player_one, $type, -$nbr);
                $this->incResource($player_two, $type, $nbr);
            }
        }
    }

    /*
     * Give player the provided benefits
     */
    function gainBenefits($player_id, $benefit, $location, $region)
    {
        foreach ($benefit as $type => $nbr) {
            if (in_array($type, RESOURCES) || in_array($type, COMMODITIES)) {
                $this->incResource($player_id, $type, $nbr);
            } else if ($type == ARTIFACT) {
                $this->cards->pickCards($nbr, DECK_ARTIFACT, $player_id);
            } else if ($type == INFLUENCE) {
                $pos = self::incGameStateValue(GSV_TRACK_POS . $region, 1);
                if ($pos == 8) {
                    $this->activateRecruits($region);
                } else if ($pos == 11) {
                    self::incGameStateValue(GSV_RECRUIT_SCORE . $region, 1);
                    //TODO gain stars
                    //TODO: how track this?
                }
            } else if ($type == KNOWLEDGE || $type == MORALE) {
                $this->incResourceBounded($player_id, $type, $nbr);
            } else if ($type == RESOURCE || $type == COMMODITY) {
                //TODO player must pick
            } else if ($type == WORKER) {
                $val = $this->gainWorker($player_id);
                if ($val > 0) {
                    $this->knowledgeCheck($player_id);
                }//TODO: notify if no gain?
            } else if ($type == STAR) {
                //TODO player must choose loc (except icarus)
                $territory = TERRITORIES[$region];
                if ($region == ICARUS || (in_array($location, MARKET_SITES) &&
                        $this->gamestate->table_globals[OPT_MARKET_STARS] == 0)) {
                    // Territory is only option
                    if ($this->isSpaceOpen($territory)) {
                        $this->addStar($player_id, $territory);
                    } else {
                        //TODO: cannot place star, notify?
                    }
                } else {
                    $open_markets = 0;
                    foreach (MARKETS_BY_REGION[$region] as $market) {
                        if ($this->isSpaceOpen($market)) {
                            $sql = "SELECT resource_count FROM resource WHERE resource_type = '". STAR ."'";
                            $sql .= " AND player_id = ${player_id} AND resource_loc = ${market}";
                            $nbr = self::getUniqueValueFromDb($sql);
                            if ($nbr === null) {
                                $open_markets += 1;
                            }
                        }
                    }

                    if ($open_markets == 0) {
                        // Territory is only option
                        if ($this->isSpaceOpen($territory)) {
                            $this->addStar($player_id, $territory);
                        } else {
                            //TODO: cannot place star, notify?
                        }
                    } else if ($open_markets == 1 && !$this->isSpaceOpen($territory)) {
                        // Market is only choice
                        foreach (MARKETS_BY_REGION[$region] as $market) {
                            if ($this->isSpaceOpen($market)) {
                                $sql = "SELECT resource_count FROM resource WHERE resource_type = '". STAR ."'";
                                $sql .= " AND player_id = ${player_id} AND resource_loc = ${market}";
                                $nbr = self::getUniqueValueFromDb($sql);
                                if ($nbr === null) {
                                    $this->addStar($player_id, $market);
                                    break;
                                }
                            }
                        }
                    } else {
                        //TODO: user must choose
                    }
                }
            } else {
                throw new feException("Impossible benefit value '${type}'");
            }
        }
    }

    /*
     * Returns true if the board space is open and availble
     * That is, market is built, tunnel end is opened, or star territory is not full
     */
    function isSpaceOpen($location, $region=null)
    {
        if (in_array($location, TERRITORIES)) {
            // Territory - check stars again playes
            $sql = "SELECT SUM(resource_count) FROM resource WHERE resource_loc = ${location}";
            $nbr_filled = self::getUniqueValueFromDb($sql);
            $open = $nbr_filled < self::getPlayersNumber();
        } else if (in_array($location, MARKET_SITES)) {
            // Market built?
            $open = self::getGameStateValue(GSV_MARKET_BUILT . $location) != 0;
        } else if (in_array($location, TUNNELS_ENDS)) {
            // Tunnel opened?
            $open = self::getGameStateValue(GSV_TUNNEL_OPEN . $region) != 0;
        } else {
            // Anything else is always open
            $open = true;
        }

        return $open;
    }

    /*
     * Add a star for the player at the given location and score one point
     */
    function addStar($player_id, $loc)
    {
        // Get any stars already in place
        $sql = "SELECT resource_count FROM resource WHERE resource_type = '". STAR ."'";
        $sql .= " AND player_id = ${player_id} AND resource_loc = ${loc}";
        $nbr = self::getUniqueValueFromDb($sql);

        if ($nbr !== null) {
            // Already has some, add another
            if (in_array($loc, MARKET_SITES) || is_numeric($loc)) {
                // Only one star per market or card (recruit/dilemma)
                throw new feException("Impossible score: player '${player_id}' already has a star at '${loc}'");
            }
            $sql = "UPDATE resource SET resource_count = resource_count + 1 WHERE ";
            $sql .= " resource_type = '". STAR ."' AND player_id = ${player_id} ";
            $sql .= " AND resource_loc = ${loc}";
        } else {
            // Add new star
            $sql = "INSERT INTO resource (player_id, resource_type, resource_count, resource_loc)";
            $sql .= " VALUES (${player_id}, '". STAR ."', 1, ${loc})";
        }
        self::DbQuery($sql);

        // Score star
        $sql = "UPDATE player SET player_score = player_score + 1 WHERE player_id = ${player_id}";
        self::DbQuery($sql);

        // Notify
        $msg = clienttranslate('${player_name} gains a star on ${location}');
        self::notifyAllPlayers('gainStar', $msg, array(
            'i18n' => array('location'),
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'location' => LOCATIONS[$loc]['name'],
            'loc_id' => $loc
        ));
    }

    /*
     * Compare everything given as payment to the location cost
     * Ensure all given resources and legal and available, and that nothing extra is given
     * Raise exceptions for errors or if user cannot pay
     */
    function verifyPayment($payment, $cost)
    {
        $paid = array(); // store each resource
        foreach ($cost as $type => $nbr) {
            if ($type == ARTIFACT) {
                // Any artifacts
                $cards = $payment[$type];
                foreach ($cards as $card_id) {
                    if (!$this->verifyCard($card_id, $type, CARD_HAND, $player_id)) {
                        throw new feException("Impossible worker placement: bad card ${card_id}");
                    }
                    $paid[] = array('type' => ARTIFACT, 'nbr' => $card_id);
                }

                if (count($cards) != $nbr) {
                    if ($nbr == 3 && count($cards) == 2) {
                        // Can use 2 of the same to pay for 3
                        $a = $this->cards->getCard($cards[0]);
                        $b = $this->cards->getCard($cards[1]);
                        if ($a['type'] != $b['type']) {
                            throw new feException("Impossible worker placement: wrong number cards");
                        }
                    } else {
                        throw new feException("Impossible worker placement: wrong number cards");
                    }
                }
            } else if ($type == RESOURCE) {
                // Any resources
                $name = $payment[$type];
                if (!in_array($name, RESOURCES)) {
                    throw new feException("Impossible worker placement: invalid resource '${name}'");
                }
                if (!$this->hasResource($player_id, $name, 1)) {
                    throw new BgaUserException(self::_("You do not have enough ${name}"));
                }
                if ($name == BLISS && in_array(BLISS, $cost)) {
                    // Cannot use Bliss as second resource when Bliss is required (Icarus)
                    throw new BgaUserException(self::_("You cannot pay two Bliss for this action"));
                }
                $paid[] = array('type' => $name, 'nbr' => 1);
            } else if ($type == COMMODITY) {
                // Any commodity
                if ($nbr == 1) {
                    $name = $payment[$type];
                    if (!in_array($name, COMMODITIES)) {
                        throw new feException("Impossible worker placement: invalid commodity '${name}'");
                    }
                    if (!$this->hasResource($player_id, $name, 1)) {
                        throw new BgaUserException(self::_("You do not have enough ${name}"));
                    }
                    $paid[] = array('type' => $name, 'nbr' => 1);
                } else {
                    // Any 3 (Nimbus Loft)
                    $cnt = 0;
                    foreach ($payment as $c_name => $c_nbr) {
                        if (!in_array($c_name, COMMODITIES)) {
                            throw new feException("Impossible worker placement: invalid commodity '${c_name}'");
                        }
                        if (!$this->hasResource($player_id, $c_name, $c_nbr)) {
                            throw new BgaUserException(self::_("You do not have enough ${c_name}"));
                        }
                        $cnt += $c_nbr
                        $paid[] = array('type' => $c_name, 'nbr' => $c_nbr);
                        //TODO: this will die because payment isn't updated, won't it?
                    }
                    if ($cnt != $nbr) {
                        throw new feException("Impossible worker placement: wrong number commodities");
                    }
                }
            } else if (in_array($type, RESOURCES) || in_array($type, COMMODITIES)) {
                // Some number of specific resources or commodities
                if (!$this->hasResource($player_id, $type, $nbr) {
                    throw new BgaUserException(self::_("You do not have enough ${type}"));
                }
                $paid[] = array('type' => $type, 'nbr' => $nbr);
            } else if (in_array($type, ARTIFACTS)) {
                // Some specific artifact card
                if (!in_array($type, $payment)) {
                    throw new feException("Impossible worker placement: no given '${type}'");
                }
                if (!$this->verifyCard($payment[$type], $type, CARD_HAND, $player_id)) {
                    throw new feException("Impossible worker placement: bad card ${card_id}");
                }
                $paid[] = array('type' => $type, 'nbr' => $nbr);
            }

            // Record as paid
            $payment[$type] = null;
        }

        // Verify nothing extra sent
        foreach ($payment as $type => $nbr) {
            if ($nbr !== null) {
                throw new feException("Impossible worker placement: extra values in payment payload");
            }
        }

        // Store payment details for state transition
        foreach ($paid as $idx => $resource) {
            $type = $resource['type'];
            $nbr = $resource['nbr'];
            $sql = "INSERT INTO resource (player_id, resource_type, resource_count)";
            $sql .= " VALUES (0, '${type}', ${nbr})";
            self::DbQuery($sql);
        }
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Player actions
//////////// 

    function actDraftRecruits($active_id, $hidden_id, $is_draft)
    {
        self::checkAction('actDraftRecruits'); 
        $player_id = self::getCurrentPlayerId()

        // Verify player active
        if (!$this->gamestate->isPlayerActive($player_id)) {
            throw new BgaUserException(self::_("It is not your turn!"));
        }

        // Verify cards
        if (!$this->verifyCard($active_id, RECRUIT, CARD_HAND, $player_id) ||
            !$this->verifyCard($hidden_id, RECRUIT, CARD_HAND, $player_id)) {
            throw new feException("Impossible recruit: invalid cards '${active_id}' '${hidden_id}'");
        }

        if ($is_draft) {
            // Start of game, give both recruits to player and discard others
            $this->cards->moveCard($active_id, CARD_IN_PLAY, $player_id);
            $this->cards->moveCard($hidden_id, CARD_HIDDEN, $player_id);
            foreach ($this->cards->getPlayerHand($player_id) as $card_id) {
                // Discard remainder
                $this->cards->playCard($card_id);
            }

            $this->gamestate->setPlayerNonMultiactive($player_id);
        } else {
            // Add new recruit (active) and discard other (hidden)
            // Check if new recruit is already active or scored
            $region = $this->getRecruitInfo($active_id)['region'];
            if (self::getGameStateValue(GSV_RECRUIT_ACTIVE . $region) == 1) {
                // New recruit already active
                $this->cards->moveCard($active_id, CARD_IN_PLAY, $player_id);
                if (self::getGameStateValue(GSV_RECRUIT_SCORE . $region) == 1) {
                    // New recruit already scored
                    $this->addStar($player_id, $active_id);
                }

                // notif
                $msg = clienttranslate('${player_name} recruits ${card_name}');
                $card_id = $active_id;
                $card_name = $this->getRecruitInfo($card_id)['name'];
            } else {
                // Recruit not yet revealed
                $this->cards->moveCard($active_id, CARD_HIDDEN, $player_id);

                // notif (hide private info)
                $msg = clienttranslate('${player_name} recruits a hidden recruit');
                $card_id = null;
                $card_name = '';
            }
            $this->cards->playCard($hidden_id);

            self::notifyAllPlayers('draftRecruit', $msg, array(
                'player_name' => self::getCurrentPlayerName(),
                'player_id' => $player_id,
                'card_name' => $card_name,
                'card_id' => $card_id
            ));

            $this->gamestate->nextState(); // only one player active for this action
        }
    }


    function actPlace($worker_id, $loc_id, $payment)
    {
        self::checkAction('actPlace'); 
        $player_id = self::getActivePlayerId();

        // Verify player owns worker and it is available
        $sql = "SELECT worker_loc FROM worker WHERE worker_id = ${worker_id} AND player_id = ${player_id}";
        $loc = self::getUniqueValueFromDB($sql);
        if ($loc === null || $loc != ACTIVE) {
            throw new feException("Impossible worker placement: bad worker '${worker_id}'");
        }

        // Verify location
        if (!in_array($loc_id, LOCATIONS)) {
            throw new feException("Impossible worker placement: invalid location '${loc_id}'");
        }

        $location = LOCATIONS[$loc_id];
        $loc_cost = $location['cost'];
        $loc_benefit = $location['benefit'];
        $loc_name = $location['name'];
        $loc_region = $location['region'];

        // Verify location open (market, mine, etc.)
        if (!$this->isSpaceOpen($loc_id, $loc_region)) {
            throw new BgaUserException(self::_("The ${loc_name} is not available to use"));
        }

        // Verify player paid any cost
        if ($loc_cost !== null) {
            $this->verifyPayment($payment, $loc_cost);
        } else if (count($payment) != 0) {
            throw new feException("Impossible worker placement: no cost but payment given!");
        }

        //TODO: verify penalties

        // Check if player has, and is using, doubles
        $sql = "SELECT double_turn FROM worker WHERE worker_id = ${worker_id}";
        $val = (int)self::getUniqueValueFromDB($sql);
        if ($val != 0) {
            self::setGameStateValue(GSV_DOUBLES_VAL, $val);
            // Check if any other dups remain
            $sql = "SELECT count(1) FROM worker WHERE double_turn = ${val} ";
            $sql .= " AND worker_id != ${worker_id} AND player_id = ${player_id}";
            $cnt = self::getUniqueValueFromDB($sql);
            if ((int)$cnt > 0) {
                // Yes, player gets another turn
                self::setGameStateValue(GSV_DOUBLES_TURN, 1);
            }

            // Mark worker as used
            self::DbQuery("UPDATE worker SET double_turn = 0 WHERE worker_id = ${worker_id}");
        } else {
            self::setGameStateValue(GSV_DOUBLES_VAL, 0);
        }

        // Move is valid, continue
        self::setGameStateValue(GSV_ST_PLAYER, $player_id);
        self::setGameStateValue(GSV_ST_LOC, $loc_id);
        self::setGameStateValue(GSV_PREV_ST, $this->gamestate->state_id());
        $next_state = TX_PLACE;

        // Bump
        if (!in_array($loc_id, COMMODITY_AREAS)) { // no bump in commodities
            $sql = "SELECT worker_id FROM worker WHERE worker_loc = ${loc_id}";
            $worker_id = self::getUniqueValueFromDb($sql);
            if ($worker_id !== null) {
                if (in_array($loc_id, CON_SITES)) {
                    throw new BgaUserException(self::_("You cannot bump a worker from a construction site."));
                }

                $this->moveWorker($worker_id, BUMPED);
                $next_state = TX_BUMP;
            }
        }

        // Move worker
        $this->moveWorker($worker_id, $loc_id);

        $msg = clienttranslate('${player_name} places a worker at ${location}');
        self::notifyAllPlayers('placeWorker', $msg, array(
            'i18n' => array('location'),
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'location' => $loc_name,
            'loc_id' => $loc_id,
            'worker_id' => $worker_id,
        ));

        $this->gamestate->nextState($next_state);
    }

    function actRetrieve($worker_ids, $payment, $discard_id)
    {
        self::checkAction('actRetrieve'); 
        $player_id = self::getActivePlayerId();

        // Verify player isn't taking bonus turn
        if (self::getGameStateValue(GSV_DOUBLES_VAL) != 0) {
            throw new BgaUserException(self::_("You must place a doubles worker or pass"));
        }

        // Verify worker(s)
        if (count($worker_ids) == 0) {
            throw new feException("Impossible retrieve: no workers given");
        }
        foreach ($worker_ids as $idx => $worker_id) {
            $sql = "SELECT count(1) FROM worker WHERE worker_id = ${worker_id} AND ";
            $sql .= "worker_loc != ". ACTIVE ." AND worker_loc != ". INACTIVE ." AND ";
            $sql .= "player_id = ${player_id}";
            if ((int)self::getUniqueValueFromDb($sql) !== 1) {
                throw new feException("Impossible retrieve: bad worker '${worker_id}'");
            }
        }

        // Verify payment valid and available
        if ($payment !== null) {
            if ($payment != BLISS && $payment != FOOD) {
                throw new feException("Impossible retrieve: invalid payment '${payment}'");
            }

            if ($this->getResource($player_id, $payment) == 0) {
                throw new BgaUserException(self::_("You do not have any ${payment}"));
            }
        }

        // Verify discard is valid and requried
        if ($discard_id !== null) {
            if ($payment !== null) {
                throw new feException("Impossible retrieve: payment AND discard sent");
            }

            if (!$this->verifyCard($discard_id, ARTIFACT, CARD_HAND, $player_id)) {
                throw new feException("Impossible retrieve: invalid discard '${discard_id}'");
            }
        }

        // Take payment and adjust morale
        if ($payment !== null) {
            $this->incResource($player_id, $payment, -1);
            $this->incResourceBounded($player_id, MORALE, 2);

            $msg = clienttranslate('${player_name} retrieves ${number} worker(s) with ${payment}');
        } else {
            $this->incResourceBounded($player_id, MORALE, -1);

            $cards = count($this->cards->getPlayerHand($player_id));
            $morale = $this->getResource($player_id, MORALE);
            if ($morale < $cards) {
                if ($discard_id === null) {
                    throw new BgaUserException(self::_("You must discard a card due to lost morale"));
                }
                $this->cards->playCard($discard_id);

                $payment = ARTIFACT;
                $msg = clienttranslate('${player_name} retrieves ${number} worker(s) for free and discards ${payment}');
            } else {
                $msg = clienttranslate('${player_name} retrieves ${number} worker(s) for free');
            }
        }

        // Roll and move worker(s)
        $values = array()
        foreach ($worker_ids as $idx => $worker_id) {
            $val = $this->activateWorker($worker_id);
            $values[] = $val;
            //TODO: penalty
        }

        self::notifyAllPlayers('retrieveWorkers', $msg, array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'number' => count($workers),
            'payment' => $payment,
            'worker_ids' => $worker_ids,
            'worker_vals' => $values,
        ));

        $this->knowledgeCheck($player_id);
    }

    function actDilemma($dilemma_id, $side, $card_ids)
    {
        self::checkAction('actDilemma'); 
        $player_id = self::getActivePlayerId();

        // Verify player isn't taking bonus turn
        if (self::getGameStateValue(GSV_DOUBLES_VAL) != 0) {
            throw new BgaUserException(self::_("You must place a doubles worker or pass"));
        }

        // Verify dilemma card
        if (!$this->verifyCard($dilemma_id, DILEMMA, CARD_HIDDEN, $player_id)) {
            throw new feException("Impossible dilemma: invalid dilemma card '${dilemma_id}'");
        }

        // Verify artifact(s) played
        if (count($cards_ids) == 0) {
            throw new feException("Impossible dilemma: no cards played");
        }
        if (count($cards_ids) > 2) {
            throw new feException("Impossible dilemma: too many cards played");
        }
        foreach ($cards_ids as $id) {
            if (!$this->verifyCard($id, ARTIFACT, CARD_HAND, $player_id)) {
                throw new feException("Impossible dilemma: invalid artifact card '${id}'");
            }
        }

        // Verify action
        if ($side != DILEMMA_LEFT && $side != DILEMMA_RIGHT) {
            throw new feException("Impossible dilemma: invalid choice '${side}'");
        }

        $card = $this->cards->getCard($dilemma_id);
        $cost = ARTIFACTS[$card['type_arg']];

        if (count($card_ids) == 1) {
            if (!$this->verifyCard($card_ids[0], $cost, CARD_HAND, $player_id)) {
                $type = ARTIFACT_I18N[$card['type_arg']];
                throw new BgaUserException(self::_("You must play a ${type} Artifact for this dilemma"));
            }
        }
        //TODO: stop players from being stupid? (play two including the one needed)

        // Play cards
        foreach ($card_ids as $id) {
            $this->cards->playCard($id);
        }
        $this->cards->moveCard($dilemma_id, CARD_IN_PLAY, $player_id);

        $msg = clienttranslate('${player_name} considers their ethical dilemma and chooses to ${action}');
        self::notifyAllPlayers('dilemma', $msg, array(
            'i18n' => array('action'),
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'action' => $this->getDilemmaInfo()[$side], //TODO
            'dilemma_id' => $dilemma_id,
            'card_ids' => $card_ids
        ));

        // Take action (score/recruit)
        if ($side == DILEMMA_LEFT) {
            // Draw two recruits and keep one
            $this->cards->pickCards(2, DECK_RECRUIT, $player_id);
            //TODO: choose one
            $next_state = TX_DRAFT;
        } else {
            // Place star on card (score)
            $this->addStar($player_id, $dilemma_id);
            $next_state = TX_NEXT;
        }

        $this->gamestate->nextState($next_state);
    }

    function actTradeOffer($trade, $other_player)
    {
        self::checkAction('actTradeOffer'); 
        $player_id = self::getActivePlayerId();

        // Verify players
        $player_no = self:getPlayerNoById($other_player);
        if ($other_player === null || $player_no === null || $player_id == $other_player) {
            throw new feException("Impossible trade: invalid player '${other_player}'");
        }

        // Verify trade goods
        $this->verifyTrade($player_id, $trade);

        // Store trade info
        $data = json_encode($trade);
        $trade_id = self::incGameStateValue(GSV_TRADE, 1);
        $sql = "INSERT INTO trade (trade_id, player_one, player_two, trade_offer)";
        $sql .= " VALUES (${trade_id}, ${player_id}, ${other_player}, '${data}')";
        self::DbQuery($sql);

        $msg = clienttranslate('${player_name} offers ${trade_items} to ${player_name2}');
        self::notifyAllPlayers('tradeOffer', $msg, array(
            'player_name' => self::getActivePlayerName(),
            'player_name2' => self:;getPlayerNameById($other_player),
            'trade_items' => $trade
        ));

        $this->gamestate->nextState(TX_TRADE);
    }

    function actTradeAccept($trade)
    {
        self::checkAction('actTradeAccept'); 
        $player_id = self::getActivePlayerId();

        // Verify active trade
        $trade_id = self::getGameStateValue(GSV_TRADE);
        $row = self::getObjectFromDB("SELECT * FROM trade WHERE trade_id = ${trade_id}");
        if ($row === null || $row['player_two'] != $player_id) {
            throw new feException("Impossible trade: no active trade '${trade_id}' for player '${player_id}'");
        }

        // Verify trade goods
        $this->verifyTrade($player_id, $trade);

        // Store trade info
        $data = json_encode($trade);
        $sql = "UPDATE trade SET trade_return = '${data}' WHERE trade_id = ${trade_id}";
        self::DbQuery($sql);

        $msg = clienttranslate('${player_name} accepts and offers in return ${trade_items}');
        self::notifyAllPlayers('tradeAccept', $msg, array(
            'player_name' => self::getActivePlayerName(),
            'trade_items' => $trade
        ));

        $this->gamestate->nextState(TX_TRADE);
    }

    function actTradeConfirm()
    {
        self::checkAction('actTradeConfirm'); 
        $player_id = self::getActivePlayerId();

        // Verify active trade
        $trade_id = self::getGameStateValue(GSV_TRADE);
        $row = self::getObjectFromDB("SELECT * FROM trade WHERE trade_id = ${trade_id}");
        if ($row === null || $row['player_one'] != $player_id) {
            throw new feException("Impossible trade: no active trade '${trade_id}' for player '${player_id}'");
        }

        // Perform trade
        $player_one = $row['player_one'];
        $player_two = $row['player_two'];
        $trade_one = json_decode($row['trade_offer']);
        $this->doTrade($player_one, $player_two, $trade_one);
        $trade_two = json_decode($row['trade_return']);
        $this->doTrade($player_two, $player_one, $trade_two);

        $msg = clienttranslate('${player_name} and ${player_name2} agree to trade');
        self::notifyAllPlayers('tradeConfirm', $msg, array(
            'player_name' => self::getActivePlayerName(),
            'player_name2' => self:getPlayerNameById($player_two),
            'trade_12' => $trade_one,
            'trade_21' => $trade_two,
        ));

        // Current player's turn still
        $this->gamestate->nextState();
    }

    function actTradeCancel()
    {
        self::checkAction('actTradeCancel'); 
        $player_id = self::getActivePlayerId();

        // Verify active trade
        $trade_id = self::getGameStateValue(GSV_TRADE);
        $row = self::getObjectFromDB("SELECT * FROM trade WHERE trade_id = ${trade_id}");
        if ($row === null) {
            throw new feException("Impossible trade: cannot cancel trade '${trade_id}'")
        }

        $msg = clienttranslate('${player_name} cancels the trade');
        self::notifyAllPlayers('log', $msg, array(
            'player_name' => self::getActivePlayerName()
        ));

        $this->gamestate->nextState(TX_CANCEL);
    }

    function actPass()
    {
        self::checkAction('actPass'); 

        // Player has doubles but chooses not to use them (TODO: is there anything else?)
        // Verify this is true
        if (self::getGameStateValue(GSV_DOUBLES_VAL) == 0) {
            throw new BgaUserException(self::_("You cannot pass and must take an action"));
        }

        // Reset doubles
        self::DbQuery("UPDATE worker SET double_turn = 0");

        $msg = clienttranslate('${player_name} passes');
        self::notifyAllPlayers('log', $msg, array(
            'player_name' => self::getActivePlayerName()
        ));

        $this->gamestate->nextState(TX_NEXT);
    }

    function actPenalty($payment)
    {
        self::checkAction('actPenalty'); 
        $player_id = self::getActivePlayerId();
        // VERIFY: _not_ active player
        // TODO: how confirm payment needed?
        // VERIFY: payment available
        // 1. take resources
    }

    function actBenefit($benefit)
    {
        self::checkAction('actBenefit'); 
        $player_id = self::getActivePlayerId();
        // VERIFY: active player?
        // TODO: how confirm benefit?
        // 1. gain resources
    }

    
//////////////////////////////////////////////////////////////////////////////
//////////// Game state arguments
////////////

    /*
        Here, you can create methods defined as "game state arguments" (see "args" property in states.inc.php).
        These methods function is to return some additional information that is specific to the current
        game state.
    */

    /*
    
    Example for game state "MyGameState":
    
    function argMyGameState()
    {
        // Get some values from the current game situation in database...
    
        // return values:
        return array(
            'variable1' => $value1,
            'variable2' => $value2,
            ...
        );
    }    
    */

    function argPlayerTurn()
    {
        $player_id = self::getActivePlayerId();

        $doubles = self::getGameStateValue(GSV_DOBULES_VAL);
        if ($doubles != 0) {
            // Player placed a worker with doubles and can take an extra turn
            // but ONLY to place another double
            $sql = "SELECT worker_id FROM worker WHERE double_turn = ${doubles}";
            $sql .= " AND player_id = ${player_id}";
            $worker_ids = self::getObjectListFromDB($sql, true);

            $possible_moves = array(
                'workers' => $worker_ids,
                'retrieve' => false,
                'dilemma' => false,
                'locs' => $this->getPossibleMoves() //TODO
            );
        }

        // Does player have any workers on the board?
        $sql = "SELECT count(1) FROM worker WHERE player_id = ${player_id} AND ";
        $sql .= " worker_loc != ". ACTIVE ." AND worker_loc != ". INACTIVE;
        $can_retrieve = (int)self::getUniqueValueFromDB($sql) > 0;

        // Does player have the card(s) needed for dilemma?
        //TODO: check dilemma and cards in hand

        //TODO: retrive? dilemma?
        //TODO: private info revealed for some locations?
        return array('locs' => $this->getPossibleMoves());
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Game state actions
////////////

    function stDraftRecruits()
    {
    }

    function stNextPlayer()
    {
        // Check end game
        $score = self::getUniqueValueFromDB("SELECT MAX(player_score) FROM player");
        if ((int)$score >= 10) {
            // Game is over!
            $this->computeTieBreakers(); //TODO
            $this->gamestate->nextState(TX_END);
            return;
        }

        // Check if player has extra turn from doubles
        if (self::getGameStateValue(GSV_DOUBLES_TURN) == 1) {
            self::setGameStateValue(GSV_DOUBLES_TURN, 0);
            $this->gamestate->nextState(TX_NEXT);
            return
        }

        // Next player
        $player_id = self::activeNextPlayer();

        // Note any doubles at start of turn
        // First clear any previously set
        self::DbQuery("UPDATE worker SET double_turn = 0");
        // Get all active workers
        $sql = "SELECT worker_id, worker_val FROM worker WHERE ";
        $sql .= "worker_loc = ". ACTIVE ." AND player_id = ${player_id}";
        $workers = self::getCollectionFromDB($sql);
        // Count values
        $dups = array_count_values($workers);
        foreach ($dups as $val => $cnt) {
            if ($cnt > 1) {
                $sql = "UPDATE worker SET double_turn = ${val} WHERE ";
                $sql .= "worker_loc = ". ACTIVE ." AND player_id = ${player_id}";
                $sql .= " AND worker_val = ${val}";
                self::DbQuery($sql);
            }
        }

        $this->gamestate->nextState(TX_NEXT);
        //TODO: transition to trade???
    }

    function stBump()
    {
        $sql = "SELECT player_id, worker_id FROM worker WHERE worker_loc = ". BUMPED;
        $workers = self::getCollectionFromDB($sql, true);
        if (count($workers) == 0) {
            //TODO: _can_ we get here?
            throw new feException("Illegal BUMP state: no worker to bump!");
        } else if (count($workers) > 1) {
            // Market construction
            // Regroup workers by player to roll all at once
            $players = $this->loadPlayersBasicInfos();
            foreach($players as $player_id) {
                $players['workers'] = array();
            }
            foreach ($workers as $player_id => $worker_id) {
                $players[$player_id]['workers'][] = $worker_id;
            }
        } else {
            $pid = array_keys($workers)[0];
            $players = array($pid => array($workers[$pid]));
        }

        $prev_state = self::getGameStateValue(GSV_PREV_ST);
        if ($prev_state == ST_PLACE) {
            $next_state = "place";
        } else if ($prev_state == ST_MARKET) {
            $next_state = "next";
        } else {
            throw new feException("Invalid state transition to bump '${prev_state}'");
        }

        $active_players = array();
        foreach ($players as $player_id => $player) {
            //TODO: penalties/benefits
            foreach ($player['workers'] as $idx => $worker_id) {
                $val = $this->activateWorker($worker_id);
            }
            $this->knowledgeCheck($player_id);

            //TODO: activate if needed
            //XXX THIS IS GOING TO BE MORE COMPLICATED THAN CURRENTLY SUPPORTED, ISN'T IT???
            //$active_players[] = $player_id
        }

        $this->gamestate->setPlayersMultiactive($active_players, $next_state, true);
    }

    function stPlace()
    {
        $player_id = self::getGameStateValue(GSV_ST_PLAYER);
        $loc_id = self::getGameStateValue(GSV_ST_LOC);
        $location = LOCATIONS[$loc_id];
        $loc_cost = $location['cost'];
        $loc_benefit = $location['benefit'];
        $loc_region = $location['region'];

        $sql = "SELECT resource_type type, resource_count nbr FROM resource WHERE player_id = 0";
        $payment = self::getObjectListFromDB($sql);

        // Clear stored payment resources
        if (count($payment) > 0) {
            self::DbQuery("DELETE FROM resource WHERE player_id = 0");
        }

        // Verify payment still available
        $can_pay = true;
        foreach ($payment as $idx => $resource) {
            $type = $resource['type'];
            if (in_array($type, RESOURCES) || in_array($type, COMMODITIES)) {
                if (!$this->hasResource($player_id, $type, $resource['nbr'])) {
                    $can_pay = false;
                    break;
                }
            }
        }

        if (!$can_pay) {
            // Player lost resources and can no longer pay clost
            // Worker is placed but no benefits gained; skip everything else
            // https://boardgamegeek.com/thread/1994424/timing-bumping-and-market-penalties
            $msg = clienttranslate('${player_name} cannot pay an receives no benefit');
            self::notifyAllPlayers('log', $msg, array(
                'player_name' => self::getActivePlayerName()
            ));
            $this->gamestate->nextState(TX_NEXT);
            return;
        }

        // Take payment
        foreach ($payment as $idx => $resource) {
            $type = $resource['type'];
            $nbr = $resource['nbr'];
            if ($type == ARTIFACT || in_array($type, ARTIFACTS)) {
                $this->cards->playCard($nbr);
            } else if (in_array($type, RESOURCES) || in_array($type, COMMODITIES)) {
                $this->incResource($player_id, $type, -$nbr);
            }
        }

        // Determine benefit
        if (in_array($loc_id, COMMODITIY_AREAS)) {
            // Commodity benefit depends on total knowledge of workers at location
            $sql = "SELECT SUM(worker_val) FROM worker WHERE worker_loc = ${loc_id}";
            $val = self::getUniqueValueFromDb($sql);
            if ($val < 5) {
                $idx = 0;
            } else if ($val < 9) {
                $idx = 1;
            } else {
                $idx = 2;
            }
            $loc_benefit = $loc_benefit[$idx];
            //TODO: aleg benefit
        } else if (in_array($loc_id, TUNNELS) &&
                   !$this->hasLocationBenefit($loc_id, $player_id)) {//TODO
                // player must choose...how?
                //TODO; separate action
                //OR force it to come in with move, yes? Easy, but many Recruits will require choice...
            }
        }

        // Gain benefit
        if ($loc_benefit !== null) {
            $this->gainBenefits($player_id, $loc_benefit, $loc_id, $loc_region);
        }

        $msg = clienttranslate('${player_name} pays ${payment} and gains ${benefit}');
        self::notifyAllPlayers('placeBenefits', $msg, array(
            'player_name' => self::getActivePlayerName(),
            'payment' => $payment,
            'benefit' => $loc_benefit
        ));

        // Possible additional actions
        if (in_array($loc_id, TUNNELS)) {
            $this->gamestate->nextState(TX_MINE);
        } else if (in_array($loc_id, CON_SITES)) {
            $this->gamestate->nextState(TX_MARKET);
        } else {
            $this->gamestate->nextState(TX_NEXT);
        }
    }

    function stMine()
    {
        $loc_id = self::getGameStateValue(GSV_ST_LOC);
        $location = LOCATIONS[$loc_id];
        $loc_region = $location['region'];

        $val = self::incGameStateValue(GSV_MINER_POS . $loc_region, 1);
        if ($val < 9) {
            $msg = clienttranslate('${region} miner moves foward');
        } else if ($val == 9) {
            // Open tunnel action
            self::incGameStateValue(GSV_TUNNEL_OPEN . $loc_region, 1);
            $msg = clienttranslate('${region} miner completes the tunnel and opens a bonus action');
        }
        self::notifyAllPlayers('miner', $msg, array(
            'i18n' => array('region'),
            'region' => REGION_I18N[$loc_region],
            'bonus'=> $val == 9
        ));

        if ($val == 6) {
            $this->activateRecruits($loc_region);
        }

        $this->gamestate->nextState();
    }

    function stMarket()
    {
        $next_state = TX_NEXT;
        $loc_id = self::getGameStateValue(GSV_ST_LOC);

        if (!in_array($loc_id, CON_SITES)) {
            throw new feException("Impossible market state: invalid location '${loc_id}'");
        }

        $location = LOCATIONS[$loc_id];
        $market_loc = $location['market']

        // Determine how many construction sites are filled
        $workers = array();
        $players = array();
        foreach (CONS_BY_MARKET[$market_loc] as $idx => $loc) {
            $sql = "SELECT worker_id wid, player_id pid FROM worker WHERE worker_loc = ${loc}";
            $worker = self::getObjectFromDB($sql);
            if ($worker !== null) {
                $workers[] = $worker['wid'];
                $players[] = $worker['pid'];
            }
        }

        // Numbers sites required for player count
        $num_player = self::getPlayersNumber();
        if ($num_player < 4) {
            $sites_needed = 2;
        } else if ($num_player == 4) {
            $sites_needed = 3;
        } else {
            $sites_needed = 4;
        }

        if (count($workers) == $sites_needed) {
            // Market is complete, bump all players
            foreach ($workers as $idx => $worker_id) {
                $this->moveWorker($worker_id, BUMPED);
            }

            // Flip market
            self::incGameStateValue(GSV_MARKET_BUILT . $market_loc, 1);

            // Get list of players that contributed for notif
            $market = $this->getMarketInfo($market_loc);
            $active_player = self::getActivePlayerId();
            $log = '${player_name}';
            $args = array('player_name' => self::getActivePlayerName());
            $i = 2;
            foreach (array_unique($players) as $idx => $player_id) {
                if ($player_id != $active_player) {
                    $log .= ', ${player_name' . $i . '}';
                    $args['player_name' . $i] = self::getPlayerNameById($player_id);
                    $i += 1;
                }
            }

            $msg = clienttranslate('${players} construct the ${name}');
            self::notifyAllPlayers('buildMarket', $msg, array(
                'i18n' => array('name'),
                'name' => $market['name'],
                'loc' => $market_loc,
                'players' => array('log' => $log, 'args' => $args)
                //TODO: verify this works (i18n, all players highlighted in log)
            ));

            // Place one star on market for each player
            foreach (array_unique($players) as $idx => $player_id) {
                $this->addStar($player_id, $market_loc);
            }

            // Handle bumps in next state
            self::setGameStateValue(GSV_PREV_ST, $this->gamestate->state_id());
            $next_state = TX_BUMP;
        } else if (count($workers) > $sites_needed) {
            throw new feException("Impossible worker placement: too many workers at market?!");
        }

        $this->gamestate->nextState($next_state);
    }

    function stTrade()
    {
        $trade_id = self::getGameStateValue(GSV_TRADE);
        $trade = self::getObjectFromDB("SELECT * FROM trade WHERE trade_id = ${trade_id}");
        if ($trade === null) {
            throw new feException("Impossible trade: no active trade '${trade_id}'");
        }

        if ($trade['trade_return'] === null) {
            // First part of trade
            $this->gamestate->changeActivePlayer($trade['player_two']);
        } else {
            // Second part of trade
            $this->gamestate->changeActivePlayer($trade['player_one']);
        }
        $this->gamestate->nextState(TX_TRADE);
    }

    function stTradeCancel()
    {
        $trade_id = self::getGameStateValue(GSV_TRADE);
        $trade = self::getObjectFromDB("SELECT * FROM trade WHERE trade_id = ${trade_id}");
        if ($trade === null) {
            throw new feException("Impossible trade: no active trade '${trade_id}'");
        }

        // Return play to player offering trade
        $this->gamestate->changeActivePlayer($trade['player_one']);
        $this->gamestate->nextState();
    }



//////////////////////////////////////////////////////////////////////////////
//////////// Zombie
////////////

    /*
        zombieTurn:
        
        This method is called each time it is the turn of a player who has quit the game (= "zombie" player).
        You can do whatever you want in order to make sure the turn of this player ends appropriately
        (ex: pass).
        
        Important: your zombie code will be called when the player leaves the game. This action is triggered
        from the main site and propagated to the gameserver from a server, not from a browser.
        As a consequence, there is no current player associated to this action. In your zombieTurn function,
        you must _never_ use getCurrentPlayerId() or getCurrentPlayerName(), otherwise it will fail with a "Not logged" error message. 
    */

    function zombieTurn( $state, $active_player )
    {
    	$statename = $state['name'];
    	
        if ($state['type'] === "activeplayer") {
            switch ($statename) {
                default:
                    $this->gamestate->nextState( "zombiePass" );
                	break;
            }

            return;
        }

        if ($state['type'] === "multipleactiveplayer") {
            // Make sure player is in a non blocking status for role turn
            $this->gamestate->setPlayerNonMultiactive( $active_player, '' );
            
            return;
        }

        throw new feException( "Zombie mode not supported at this game state: ".$statename );
    }
    
///////////////////////////////////////////////////////////////////////////////////:
////////// DB upgrade
//////////

    /*
        upgradeTableDb:
        
        You don't have to care about this until your game has been published on BGA.
        Once your game is on BGA, this method is called everytime the system detects a game running with your old
        Database scheme.
        In this case, if you change your Database scheme, you just have to apply the needed changes in order to
        update the game database and allow the game to continue to run with your new version.
    
    */
    
    function upgradeTableDb( $from_version )
    {
        // $from_version is the current version of this game database, in numerical form.
        // For example, if the game was running with a release of your game named "140430-1345",
        // $from_version is equal to 1404301345
        
        // Example:
//        if( $from_version <= 1404301345 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "ALTER TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        if( $from_version <= 1405061421 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "CREATE TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        // Please add your future database scheme changes here
//
//


    }    
}
