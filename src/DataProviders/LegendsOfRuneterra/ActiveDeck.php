<?php

namespace iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra;

final class ActiveDeck
{
    public function __construct(
        public readonly ?string $DeckCode,
        /** @var null|array<string,int> */
        public readonly ?array $CardsInDeck,
    )
    {
    }
}