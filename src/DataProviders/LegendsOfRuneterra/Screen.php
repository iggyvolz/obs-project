<?php

namespace iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra;

final class Screen
{
    public function __construct(
        public readonly int $ScreenWidth,
        public readonly int $ScreenHeight,
    )
    {
    }
}