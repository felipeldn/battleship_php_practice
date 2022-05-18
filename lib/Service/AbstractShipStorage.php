<?php

declare(strict_types=1);

abstract class AbstractShipStorage
{
    abstract public function fetchAllShipsData(): array;

    abstract public function fetchSingleShipData(int $id): ?AbstractShip;
}