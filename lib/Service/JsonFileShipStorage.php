<?php

class JsonFileShipStorage extends AbstractShipStorage
{
    private $filename;

    public function __construct($jsonFilePath)
    {
        $this->filename = $jsonFilePath;
    }

    public function fetchAllShipsData(): array
    {
        $jsonContents = file_get_contents($this->filename);

        return json_decode($jsonContents, true);
    }

    public function fetchSingleShipData($id): ?AbstractShip
    {
        $ships = $this->fetchAllShipsData();

        foreach ($ships as $ship) {
            if ((int) $ship['id'] === $id) {
                $constructedShip =  new Ship(
                    $ship['id'],
                    $ship['name'],
                );

                $constructedShip->setWeaponPower((int) $ship['weapon_power']);
                $constructedShip->setJediFactor((int) $ship['jedi_factor']);
                $constructedShip->setStrength((int) $ship['strength']);
                $constructedShip->setTeam((string) $ship['team']);

                return $constructedShip;
            }
        }

        return null;
    }
}
