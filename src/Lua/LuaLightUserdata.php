<?php

namespace iggyvolz\ObsProject\Lua;

use FFI;
use FFI\CData;

final class LuaLightUserdata extends LuaValue
{
    public function value(): string
    {
        return "<lightuserdata>";
    }

    public function __toString()
    {
        return "<lightuserdata>";
    }

    protected static function _push(LuaState $lua, mixed $value): void
    {
        throw new \LogicException("Light userdata objects cannot be pushed");
    }
}