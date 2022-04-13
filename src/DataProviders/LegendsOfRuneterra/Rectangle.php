<?php

namespace iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra;

final class Rectangle
{
    public function __construct(
        public readonly int $CardID,
        public readonly string $CardCode,
        public readonly int $TopLeftX,
        public readonly int $TopLeftY,
        public readonly int $Width,
        public readonly int $Height,
        public readonly bool $LocalPlayer,
    )
    {
    }
}