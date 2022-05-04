<?php

namespace iggyvolz\ObsProject\Lua;

final class LuaInt extends LuaValue
{
    #[MethodBalance]
    public function value(): int
    {
        return $this->lua->luaCall("lua_tointegerx",$this->index, null);
    }
    public function __toString()
    {
        return "<int>" . $this->value();
    }
    #[MethodBalance(+1)]
    protected static function _push(LuaState $lua, mixed $value): void
    {
        $lua->luaCall("lua_pushinteger",$value);
    }
}