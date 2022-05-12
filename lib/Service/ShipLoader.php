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
        $ship->setTeam((string) $shipData['team']);

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