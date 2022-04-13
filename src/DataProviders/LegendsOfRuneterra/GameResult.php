<?php

namespace iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra;

final class GameResult
{
    public function __construct(
        public readonly int $GameID,
        public readonly bool $LocalPlayerWon,
    )
    {
    }
}