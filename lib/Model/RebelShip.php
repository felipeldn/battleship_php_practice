<?php

declare(strict_types=1);

class RebelShip extends AbstractShip
{
    public function getFavouriteJedi()
    {
        $coolJedis = array('Yoda', 'Ben Kenobi');
        $key = array_rand($coolJedis);

        return $coolJedis[$key];
    }

    public function isFunctional(): bool
    {
        return true;
    }

    public function getJediFactor(): int
    {
        return rand(10, 30);
    }
}