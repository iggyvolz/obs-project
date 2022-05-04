<?php

namespace iggyvolz\ObsProject\DataProviders;

use iggyvolz\ObsProject\Lua\LuaState;

abstract class DataProvider
{
    public abstract function dataProvider(LuaState $lua): mixed;
}