<?php

class Ship
{
    private string $name;

    private int $weaponPower = 0;

    private int $jediFactor = 0;

    private int $strength = 0;

    private bool $underRepair;

    private int $damage;

    private bool $jediForceWasUsed;

    public function __construct($name)
    {
        $this->name = $name;
        $this->damage = 0;
        $this->jediForceWasUsed = false;
        $this->underRepair = mt_rand(1, 100) < 30;
    }

    public function isFunctional()
    {
        return !$this->underRepair;
    }

    public function sayHello()
    {
        echo 'Hello!';
    }

    public function getName()
    {
        return $this->name;
    }

    public function setStrength($number)
    {
        if (!is_numeric($number)) {
            throw new \Exception('Invalid strength passed '.$number);
        }

        $this->strength = $number;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getNameAndSpecs($useShortFormat = false)
    {
        if ($useShortFormat) {
            return sprintf(
                '%s: %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );
        } else {
            return sprintf(
                '%s: w:%s, j:%s, s:%s',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );
        }
    }

    public function doesGivenShipHaveMoreStrength($givenShip)
    {
        return $givenShip->strength > $this->strength;
    }

    public function getWeaponPower()
    {
        return $this->weaponPower;
    }

    public function getJediFactor()
    {
        return $this->jediFactor;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setWeaponPower($weaponPower)
    {
        $this->weaponPower = $weaponPower;
    }

    public function setJediFactor($jediFactor)
    {
        $this->jediFactor = $jediFactor;
    }

    public function getHealth($shipQuantity)
    {
        return $this->strength * $shipQuantity - $this->damage;
    }

    public function damage(Ship $enemy, $enemyQuantity)
    {
        $enemy->weaponPower * $enemyQuantity;
    }

    public function canShipUseTheForce(Ship $ship): bool
    {
        $jediHeroProbability = $ship->getJediFactor() / 100;

        return random_int(1, 100) <= ($jediHeroProbability*100);
    }

    public function useJediForce(Ship $enemy, int $enemyQuantity): void
    {
        if (!$this->canShipUseTheForce()) {
            return;
        }

        $enemy->damage += $enemy->strength * $enemyQuantity;
        $this->jediForceWasUsed = true;
    }

    public function wasJediForceUsed(): bool
    {
        return $this->jediForceWasUsed;
    }
}
