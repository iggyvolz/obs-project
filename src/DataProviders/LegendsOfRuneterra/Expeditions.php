<?php

namespace iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra;

final class Expeditions
{
    public function __construct(
        public readonly bool $IsActive,
        public readonly string $State,
        /** @var null|list<"win"|"loss"> */
        public readonly ?array $Record,
        /** @var null|list<string> */
        public readonly ?array $Deck,
        public readonly int $Games,
        public readonly int $Wins,
        public readonly int $Losses,
    )
    {
    }
}