<?php

namespace iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra;

final class CardPositions
{
    public function __construct(
        public readonly ?string $PlayerName,
        public readonly ?string $OpponentName,
        public readonly string $GameState,
        public readonly Screen $Screen,
        /** @var list<Rectangle> */
        public readonly array $Rectangles,
    )
    {
    }
}