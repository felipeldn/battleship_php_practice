<?php
declare(strict_types=1);

class Battle
{

    public function fight(Ship $ship1, $ship1Quantity, Ship $ship2, $ship2Quantity)
    {
        $ship1Health = $ship1->getHealth($ship1Quantity);
        $ship2Health = $ship2->getHealth($ship2Quantity);

        $ship1UsedJediPowers = false;
        $ship2UsedJediPowers = false;
        while ($ship1Health > 0 && $ship2Health > 0) {
            // first, see if we have a rare Jedi hero event!
            if ($ship1->canShipUseTheForce()) {
                $ship1->useJediForce($ship2, $ship2Quantity);

            }
            if ($ship2->canShipUseTheForce()) {
                $ship2->useJediForce($ship1, $ship1Quantity);

            }

            // now battle them normally
            $ship1->damage($ship2, $ship1Quantity);
            $ship2->damage($ship1, $ship2Quantity);

            $ship1Health = $ship1->getHealth($ship1Quantity);
            $ship2Health = $ship2->getHealth($ship2Quantity);
        }

        if ($ship1Health <= 0 && $ship2Health <= 0) {
            // they destroyed each other
            $winningShip = null;
            $losingShip = null;
            $usedJediPowers = $ship1UsedJediPowers || $ship2UsedJediPowers;
        } elseif ($ship1Health <= 0) {
            $winningShip = $ship2;
            $losingShip = $ship1;
            $usedJediPowers = $ship2UsedJediPowers;
        } else {
            $winningShip = $ship1;
            $losingShip = $ship2;
            $usedJediPowers = $ship1UsedJediPowers;
        }

        return array(
            'winning_ship' => $winningShip,
            'losing_ship' => $losingShip,
            'used_jedi_powers' => $usedJediPowers,
        );
    }
}