<?php

namespace iggyvolz\ObsProject\Lua;

use FFI;
use FFI\CData;

final class LuaThread extends LuaValue
{
    public function value(): string
    {
        return "<thread>";
    }

    public function __toString()
    {
        return "<thread>";
    }

    protected static function _push(LuaState $lua, mixed $value): void
    {
        throw new \LogicException("Threads cannot be pushed");
    }
}