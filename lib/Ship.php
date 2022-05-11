<?php

declare(strict_types=1);

class Ship
{
    private string $name;

    private int $weaponPower = 0;

    private int $jediFactor = 0;

    private int $strength = 0;

    private bool $underRepair;

    public function __construct($name)
    {
        $this->name = $name;
        $this->underRepair = mt_rand(1, 100) < 30;
    }

    public function isFunctional(): bool
    {
        return !$this->underRepair;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setStrength(int $number): void
    {
        $this->strength = $number;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getNameAndSpecs($useShortFormat = false): string
    {
        if ($useShortFormat) {
            return sprintf(
                '%s: %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );
        }

        return sprintf(
            '%s: w:%s, j:%s, s:%s',
            $this->name,
            $this->weaponPower,
            $this->jediFactor,
            $this->strength
        );

    }

    public function doesGivenShipHaveMoreStrength($givenShip): bool
    {
        return $givenShip->strength > $this->strength;
    }

    public function getWeaponPower(): int
    {
        return $this->weaponPower;
    }

    public function getJediFactor(): int
    {
        return $this->jediFactor;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setWeaponPower(int $weaponPower): void
    {
        $this->weaponPower = $weaponPower;
    }

    public function setJediFactor(int $jediFactor): void
    {
        $this->jediFactor = $jediFactor;
    }

//    public function addDamage(int $damage): void
//    {
//        $this->damage += $damage;
//    }
}
