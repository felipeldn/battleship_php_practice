<?php

declare(strict_types=1);

class ShipLoader
{
    private AbstractShipStorage $shipStorage;

    public function __construct(AbstractShipStorage $shipStorage)
    {
        $this->shipStorage = $shipStorage;
    }

    public function load(): Ships
    {
        $shipsData = $this->shipStorage->fetchAllShipsData();

        $ships = new Ships();
        foreach ($shipsData as $shipData) {
            if ($shipData['team'] == 'Rebel') {
                $ship = new RebelShip((int) $shipData['id'], $shipData['name']);
            } else {
                $ship = new Ship((int) $shipData['id'], $shipData['name']);
                $ship->setJediFactor((int) $shipData['jedi_factor']);
            }

            $ship->setWeaponPower((int) $shipData['weapon_power']);
            $ship->setStrength((int) $shipData['strength']);
            $ship->setTeam((string) $shipData['team']);

            $ships->add($ship);
        }
        return $ships;
    }

    public function findOneById(int $id): ?AbstractShip
    {
        return $this->shipStorage->fetchSingleShipData($id);
    }
}