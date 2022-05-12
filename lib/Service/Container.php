<?php

declare(strict_types=1);

class Container
{

    private array $configuration;
    private PDO $pdo;
    private ShipLoader $shipLoader;
    private Battle $battle;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getPDO(): PDO
    {
        $pdo = new PDO(
            $this->configuration['db_dsn'],
            $this->configuration['db_user'],
            $this->configuration['db_pass']
        );

        return $pdo;
    }

    public function getShipLoader(): ShipLoader
    {
        $this->shipLoader = new ShipLoader($this->getPDO());
        return $this->shipLoader;
    }

    public function getBattle(): Battle
    {
        $this->battle = new Battle(new BattleDecider());
        return $this->battle;
    }
}