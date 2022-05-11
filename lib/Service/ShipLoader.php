<?php

declare(strict_types=1);

class ShipLoader
{
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
        $pdo = new PDO('mysql:host=localhost;dbname=oo_battle', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        $pdo = new PDO('mysql:host=localhost;dbname=oo_battle', 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}