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
 * euphoria recruit cards
 *
 */

define("RECRUITS", array(
    array(
        'name' => clienttranslate("Amanda the Broker"),
        'text' => clienttranslate("When your worker is bumped by any player you may pay BLISS to select that worker's knowledge instead of rolling it."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Flavio the Merchant"),
        'text' => clienttranslate("When you place a worker on a non-Icarite market, after you place STAR, you may gain KNOW to draw CARD."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Gidget the Hypnotist"),
        'text' => clienttranslate("When you pay BLISS to retrieve workers, you may lose KNOW KNOW instead of gaining MORAL MORAL."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Josh the Negotiator"),
        'text' => clienttranslate("When you place a worker on a non-Icarite market that has RESOURCE as part of the cost to visit, you may substitute BLISS for RESOURCE."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Kaden the Infiltrator"),
        'text' => clienttranslate("Regardless of your allegiance, you may gain KNOW KNOW to place a worker on an exclusive action space at the end of any completed tunnel."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Lee the Gossip"),
        'text' => clienttranslate("When you bump another player's worker, you may lose MORAL to make that player gain KNOW. If you do, gain COMMODITY."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Matthew the Thief"),
        'text' => clienttranslate("When you bump another player's worker from a tunnel, you may gain KNOW instead of paying the commodity cost."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Maxime the Ambassador"),
        'text' => clienttranslate("When you bump another player's worker, you may lose MORALE MORALE to make that player gain KNOW. If you do, draw CARD."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Rebecca the Peddler"),
        'text' => clienttranslate("When you bump another player's worker, you may lose MORALE MORALE to make that player gain KNOW. If you do, gain RESOURCE."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Sarinee the Cloud Miner"),
        'text' => clienttranslate("When you place a worker on the Cloud Mine, if that worker is alone, lose KNOW or gain an extra BLISS."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Dr. Sheppard the Lobotomist"),
        'text' => clienttranslate("When you retrieve, before you roll, you may sacrifice one of those workers to gain BLISS BLISS BLISS BLISS and RESOURCE. When you add a new worker, you may lose MORALE MORALE to draw CARD."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Zong the Astronomer"),
        'text' => clienttranslate("When you place a worker on the Cloud Mine, you may gain KNOW to draw CARD. If you do, each opponent may gain BLISS."),
        'region' => ICARUS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Ben the Ludologist"),
        'text' => clienttranslate("When another player's roll results in doubles (at least 2 of their available workers share the same knowledge), you may lose MORALE MORALE to gain RESOURCE."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Bradley the Futurist"),
        'text' => clienttranslate("When you place a worker on a non-Icarite market, after you place STAR, you may gain KNOW KNOW to draw CARD CARD and discard 1 of them."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Esme the Fireman"),
        'text' => clienttranslate("When you place STAR, you may discard CARD to gain ENERGY and either lose KNOW or gain MORALE. If the artifact card is BOOK, instead gain ENERGY ENERGY, lose KNOW KNOW, and gain MORALE MORALE."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Gary the Electrician"),
        'text' => clienttranslate("When you place a worker on the Generator, if that worker has the same knowledge as another worker there, gain MORALE or an extra ENERGY."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Jefferson the Shock Artist"),
        'text' => clienttranslate("When you retrieve workers, you may pay ENERGY instead of FOOD or BLISS. If you do, lose KNOW and gain MORALE."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Julia the Thought Inspector"),
        'text' => clienttranslate("When your worker bumps an opponent's worker, you may lose MORALE to gain RESOURCE. Instead of being rolled, the bumped worker gains the knowledge of your worker."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Katy the Dietician"),
        'text' => clienttranslate("When you place a worker on the Generator, if you have no CARD in hand, also gain FOOD."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Laura the Philanthropist"),
        'text' => clienttranslate("When you bump another player's worker from a tunnel or the Worker Activation Tank, you may give that player GOLD. If you do, draw CARD CARD"),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Michael the Engineer"),
        'text' => clienttranslate("When you place a worker on a construction site, you may use any type of resource. If you use GOLD, gain MORALE and gain KNOW."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Dr. Nakagawa the Tribute"),
        'text' => clienttranslate("When you place a worker on a construction site, you may increase EUPHORIA_ALEG by 1 level."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Ray the Foreman"),
        'text' => clienttranslate("When a market is constructed, you gain MORALE MORALE if you helped build it; otherwise lose KNOW KNOW."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Yordy the Demotivator"),
        'text' => clienttranslate("When you retrieve workers for free, you may pay ENERGY to select the knowledge of 1 worker instead of rolling it. Then roll the other retrieved worker(s) as normal."),
        'region' => EUPHORIA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Brian the Viticulturist"),
        'text' => clienttranslate("You may use FOOD in place of BLISS. When you do this at least once on a non-Icarite market, gain KNOW and increase WASTELANDS_ALEG by 1 level. Lose MORALE to place a worker in Icarus."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Flartner the Scammer"),
        'text' => clienttranslate("You may place workers on construction site by paying CARD instead of RESOURCE. If you do, gain MORALE."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Geek the Oracle"),
        'text' => clienttranslate("When you draw CARD, you may gain KNOW to instead draw CARD CARD CARD and discard CARD CARD from your hand. You may use this ability once per turn."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Ian the Horticulturist"),
        'text' => clienttranslate("When you place a worker on the Farm, if you have no RESOURCE, also gain WATER."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Jacko the Archivist"),
        'text' => clienttranslate("When you place a worker on the Ark of Fractured Memories, you may pay CARD instead of CARD CARD CARD. If you do, each opponent may draw CARD."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Jonathan the Artist"),
        'text' => clienttranslate("When you place a worker on a construction site, if that worker has the highest knowledge there or is alone, you may gain KNOW to draw CARD."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Kyle the Scavenger"),
        'text' => clienttranslate("When you place a worker on the Generator, Farm, or Aquifer, if that worker is alone, you may gain KNOW KNOW to draw CARD."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Nick the Understudy"),
        'text' => clienttranslate("When you gain KNOW, also gain MORALE."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Pete the Cannibal"),
        'text' => clienttranslate("When you retrieve, before you roll, you may sacrifice one of those workers to gain FOOD FOOD FOOD FOOD and RESOURCE. When you add a new worker, you may gain KNOW KNOW to draw CARD."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Professor Reitz the Archaeologist"),
        'text' => clienttranslate("When you place a worker on a tunnel without bumping a worker, you may gain KNOW KNOW. If you do, draw an extra CARD and move the miner meeple forward 1 extra space."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Sir Scarby the Harvester"),
        'text' => clienttranslate("When you place a worker on the Farm, if that worker has the highest knowledge there or is alone, lose KNOW or gain an extra FOOD."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Steven the Scholar"),
        'text' => clienttranslate("When you lose a worker due to a dice roll that exceeds the knowledge limit, gain RESOURCE and draw CARD."),
        'region' => WASTELANDS,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Andrew the Spelunker"),
        'text' => clienttranslate("When you place a worker on a non-Subterran tunnel to gain CLAY or GOLD, if you have no cards in hand, also draw CARD."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Brett the Lockpicker"),
        'text' => clienttranslate("When you place a worker on a non-Icarite market, after you place STAR, you may gain KNOW to gain RESOURCE."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Chase the Miner"),
        'text' => clienttranslate("When you place a worker on a tunnel, you may sacrifice that worker to gain an extra RESOURCE RESOURCE specific to that tunnel. When you add a worker, you may immediately roll and place that worker."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Curtis the Propagandist"),
        'text' => clienttranslate("When you lose MORALE, also lose KNOW."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Major Dave the Demolitionist"),
        'text' => clienttranslate("When you bump an opponent's worker from a tunnel, you may gain KNOW. If you do, gain an extra RESOURCE specific to that tunnel and move the miner meeple forward 1 extra space."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Faith the Hydroelectrician"),
        'text' => clienttranslate("When you palce a worker on the Aquifer, if you have no CARD in hand, also gain ENERGY."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Jonathan the Gambler"),
        'text' => clienttranslate("When you draw CARD, you may draw CARD CARD instead. If you do, reveal your hand. If you have any matching cards, all opponents draw CARD. You may use this ability only once per turn."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Josiah the Hacker"),
        'text' => clienttranslate("When you place a worker on the Generator, Farm, of Cloud Mine, all other players with workers there gain KNOW and you gain MORALE."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Maggie the Outlaw"),
        'text' => clienttranslate("When you retrieve workers, if all of the workers you retrieve were in Subterra, you gain WATER or STONE."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Phil the Spy"),
        'text' => clienttranslate("When you bump a worker of an opponent who does not have an active Subterran recruit, you may gain KNOW to draw CARD."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Soulless the Plumber"),
        'text' => clienttranslate("When you place a worker on the Aquifer, if that worker has the lowest knowledge there or is alone, gain MORALE or an extra WATER."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
    array(
        'name' => clienttranslate("Xander the Excavator"),
        'text' => clienttranslate("When your worker bumps another player's worker of higher knowledge from a tunnel, you may gain KNOW to gain an extra RESOURCE specific to that tunnel."),
        'region' => SUBTERRA,
        'benefit' => //TODO
    ),
));
