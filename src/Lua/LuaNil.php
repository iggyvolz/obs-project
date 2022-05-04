<?php

namespace iggyvolz\ObsProject\Lua;

final class LuaNil extends LuaValue
{
    #[MethodBalance(+1)]
    public static function _push(LuaState $lua, mixed $value): void
    {
        $lua->luaCall("lua_pushnil");
    }
    public function __toString()
    {
        return "<nil>";
    }

    public function value(): ?int
    {
        return null;
    }
}