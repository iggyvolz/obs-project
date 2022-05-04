<?php

namespace iggyvolz\ObsProject\Lua;

final class LuaNumber extends LuaValue
{
    #[MethodBalance]
    public function value(): float
    {
        return $this->lua->luaCall("lua_tonumberx",$this->index, null);
    }
    public function __toString()
    {
        return "<num>" . $this->value();
    }
    #[MethodBalance(+1)]
    protected static function _push(LuaState $lua, mixed $value): void
    {
        $lua->luaCall("lua_pushnumber",$value);
    }
}