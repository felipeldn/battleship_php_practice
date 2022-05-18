<?php

declare(strict_types=1);

class Container
{
    private array $configuration;
    private ShipLoader $shipLoader;
    private AbstractShipStorage $shipStorage;
    private Battle $battle;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getShipLoader(): ShipLoader
    {
        $this->shipLoader = new ShipLoader($this->getShipStorage());

        return $this->shipLoader;
    }

    public function getShipStorage(): AbstractShipStorage
    {
        $this->shipStorage = new JsonFileShipStorage(__DIR__.'/../../resources/ships.json');

        return $this->shipStorage;

    }

    public function getBattle(): Battle
    {
        $this->battle = new Battle(new BattleDecider());

        return $this->battle;
    }
}