<?php

declare(strict_types=1);

class Fleet
{
    private Ship $ship;

    private int $numberOfShips;

    private int $damage;

    private bool $jediForceWasUsed;

    public function __construct(Ship $ship, int $numberOfShips)
    {
        $this->ship = $ship;
        $this->numberOfShips = $numberOfShips;
        $this->damage = 0;
        $this->jediForceWasUsed = false;
    }

    public function getShip(): Ship
    {
        return $this->ship;
    }

    public function getNumberOfShips(): int
    {
        return $this->numberOfShips;
    }

    public function getFleetHealth(): int
    {
        return $this->ship->getStrength() * $this->numberOfShips - $this->damage;
    }

    public function damage(Fleet $enemyFleet): void
    {
//        $enemyFleet->ship->addDamage($this->ship->getWeaponPower() * $this->numberOfShips);
        $enemyFleet->damage += $this->ship->getWeaponPower() * $this->numberOfShips;
    }

    public function canFleetUseTheForce(): bool
    {
        $jediHeroProbability = $this->ship->getJediFactor() / 100;

        return random_int(1, 100) <= ($jediHeroProbability*100);
    }

    public function useJediForce(Fleet $enemyFleet): void
    {
        if (!$this->canFleetUseTheForce()) {
            return;
        }

        $enemyFleet->damage += $enemyFleet->ship->getStrength() * $enemyFleet->numberOfShips;
//        $enemyFleet->damage($enemyFleet);
        $this->jediForceWasUsed = true;
    }

    public function wasJediForceUsed(): bool
    {
        return $this->jediForceWasUsed;
    }
}