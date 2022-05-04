<?php

namespace iggyvolz\ObsProject\Lua;

final class LuaBoolean extends LuaValue
{
    #[MethodBalance]
    public function value(): bool
    {
        return $this->lua->luaCall("lua_toboolean",$this->index);
    }
    #[MethodBalance]
    public function __toString()
    {
        return "<bool>" . ($this->value() ? "true" : "false");
    }

    #[MethodBalance(+1)]
    protected static function _push(LuaState $lua, mixed $value): void
    {
        $lua->luaCall("lua_pushboolean",$value ? 1 : 0);
    }
}