<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * euphoria implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on https://boardgamearena.com.
 * See http://en.doc.boardgamearena.com/Studio for more information.
 * -----
 *
 * euphoria.action.php
 *
 * euphoria main action entry point
 *
 */


class action_euphoria extends APP_GameAction
{
    // Constructor: please do not modify
    public function __default()
    {
        if(self::isArg('notifwindow')) {
            $this->view = "common_notifwindow";
            $this->viewArgs['table'] = self::getArg("table", AT_posint, true);
        } else {
            $this->view = "euphoria_euphoria";
            self::trace("Complete reinitialization of board game");
        }
    }

    // Select recruits at game start
    public function actDraftRecruits()
    {
        self::setAjaxMode();
        $active = self::getArg("active", AT_posint, true); // id of first active recruit card
        $hidden = self::getArg("hidden", AT_posint, true); // id of second hidden recruit card
        $this->game->actRecruit($active, $hidden, true);
        self::ajaxResponse();
    }

    // Add a new recruit
    public function actGainRecruit()
    {
        self::setAjaxMode();
        $id = self::getArg("id", AT_posint, true); // id of recruit card selected
        $this->game->actRecruit(NULL, $id, false);
        self::ajaxResponse();
    }

    // Place a worker on the board
    public function actPlace()
    {
        self::setAjaxMode();
        $worker = self::getArg("worker", AT_posint, true);       // id of worker placed
        $location = self::getArg("location", AT_alphanum, true); // name of location taken
        $payment = self::getArg("payment", AT_json, false);      // resources paid (conditional)
        if ($payment !== NULL) {
            $this->validateJSonAlphaNum($payment);
        }
        $this->game->actPlace($worker, $location, $payment);
        self::ajaxResponse();
    }

    // Retrieve worker(s) from the board
    public function actRetrieve()
    {
        self::setAjaxMode();
        $workers = $this->getNumberList("workers", true);       // list of worker ids retrieved
        $payment = self::getArg("payment", AT_alphanum, false); // payment option food/bliss
        $discard = self::getArg("discard", AT_posint, false);   // id of card discarded (if forced by morale penalty)
        $this->game->actRetrieve($workers, $payment, $discard);
        self::ajaxResponse();
    }

    // Resolve ethical dilemma
    public function actDilemma()
    {
        self::setAjaxMode();
        $id = $this->getArg("id", AT_posint, true);       // dilemma card id
        $side = $this->getArg("side", AT_alphanum, true); // dilemma side chosen (recruit/score)
        $cards = $this->getNumberList("cards", true);     // list of card id(s) paid
        $this->game->actDilemma($side, $cards);
        self::ajaxResponse();
    }

    // Offer a trade (p1)
    public function actTradeOffer()
    {
        self::setAjaxMode();
        $player = $this->getArg("player", AT_posint, true); // target player id
        $trade = $this->getArg("trade", AT_json, true);     // items offered for trade
        $this->validateJSonAlphaNum($trade, 'trade');
        $this->game->actTradeOffer($trade, $player);
        self::ajaxResponse();
    }

    // Accept a trade (p2)
    public function actTradeAccept()
    {
        self::setAjaxMode();
        $trade = $this->getArg("trade", AT_json, true); // items offered in retrun
        $this->validateJSonAlphaNum($trade, 'trade');
        $this->game->actTradeAccept($trade);
        self::ajaxResponse();
    }

    // Confirm the trade (p1)
    public function actTradeConfirm()
    {
        self::setAjaxMode();
        $this->game->actConfirmTrade();
        self::ajaxResponse();
    }

    // Cancel a trade (p1 or p2)
    public function actTradeCancel()
    {
        self::setAjaxMode();
        $this->game->actTradeCancel();
        self::ajaxResponse();
    }

    // Skip turn (just doubles?)
    public function actPass()
    {
        self::setAjaxMode();
        $this->game->actPass();
        self::ajaxResponse();
    }

    // Pay for market penalty
    public function actPenalty()
    {
        self::setAjaxMode();
        $payment = self::getArg("payment", AT_json, true);
        $this->validateJSonAlphanum();
        $this->game->actPentaly($payment);
        self::ajaxResponse();
    }

    // Choose which benefit(s) to take
    public function actBenefit()
    {
        self::setAjaxMode();
        $benefit = self::getArg("benefit", AT_json, true);
        $this->validateJSonAlphanum();
        $this->game->actBenefit($benefit);
        self::ajaxResponse();
    }


    //////////////////
    ///// UTILS  /////
    //////////////////

    // Validate JSON args
    public function validateJSonAlphaNum($value, $argName = 'unknown')
    {
        if (is_array($value)) {
            foreach ($value as $key => $v) {
                $this->validateJSonAlphaNum($key, $argName);
                $this->validateJSonAlphaNum($v, $argName);
            }
            return true;
        }
        if (is_int($value)) {
            return true;
        }
        $bValid = preg_match("/^[_0-9a-zA-Z- ]*$/", $value) === 1;
        if (!$bValid) {
            throw new feException("Bad value for: $argName", true, true, FEX_bad_input_argument);
        }
        return true;
    }

    // Translate number list to array
    public function getNumberList($arg, $required=true)
    {
        // Get number list argument
        $numbers_raw = self::getArg($arg, AT_numberlist, $required);

        // Remove trailing ;
        if (substr($numbers_raw, -1) == ';') {
            $numbers_raw = substr($numbers_raw, 0, -1);
        }

        if ($numbers_raw == '') {
            $numbers = array();
        } else {
            $numbers = explode(';', $numbers_raw);
        }

        return $numbers;
    }
}
