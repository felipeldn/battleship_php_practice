<?php

declare(strict_types=1);

class ShipLoader
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function load(): Ships
    {
        $shipsData = $this->queryForShips();

        $ships = new Ships();
        foreach ($shipsData as $shipData) {
            $ship = new Ship((int) $shipData['id'], $shipData['name']);
            $ship->setWeaponPower((int) $shipData['weapon_power']);
            $ship->setJediFactor((int) $shipData['jedi_factor']);
            $ship->setStrength((int) $shipData['strength']);

            $ships->add($ship);
        }

        return $ships;
    }

    public function findOneById(int $id): ?Ship
    {
        $pdo = $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
        $statement->execute(array('id' => $id));

        $shipData = $statement->fetch(PDO::FETCH_ASSOC);
        if (empty($shipData)) {
            return null;
        }
        $ship = new Ship(
            (int) $shipData['id'],
            $shipData['name']
        );

        $ship->setWeaponPower((int) $shipData['weapon_power']);
        $ship->setJediFactor((int) $shipData['jedi_factor']);
        $ship->setStrength((int) $shipData['strength']);

        return $ship;
    }

    private function queryForShips()
    {
        $pdo = $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getPDO(): PDO
    {
        return $this->pdo;
    }
}