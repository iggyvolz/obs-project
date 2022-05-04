<?php

namespace iggyvolz\ObsProject\Lua;

use FFI;

final class LuaString extends LuaValue
{
    #[MethodBalance]
    public function value(): string
    {
        $length = FFI::new("uint64_t");
        $str = $this->lua->luaCall("lua_tolstring",$this->index, FFI::addr($length));
        return FFI::string($str, $length->cdata);
    }
    public function __toString()
    {
        return "<string>" . $this->value();
    }

    #[MethodBalance(+1)]
    protected static function _push(LuaState $lua, mixed $value): void
    {
        $lua->luaCall("lua_pushlstring",$value, strlen($value));
    }
}