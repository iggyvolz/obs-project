<?php

namespace iggyvolz\ObsProject\Lua;

final class LuaTable extends LuaValue
{

    public function __toString()
    {
        return "<table>";
    }

    #[MethodBalance]
    public function value(): array
    {
        $data = [];
        /*
        lua_pushnil(L);  /-* first key *-/
        while (lua_next(L, t) != 0) {
            /* uses 'key' (at index -2) and 'value' (at index -1) *-/
            printf("%s - %s\n",
                lua_typename(L, lua_type(L, -2)),
                lua_typename(L, lua_type(L, -1)));
            /* removes 'value'; keeps 'key' for next iteration *-/
            lua_pop(L, 1);
        }
         */
        echo __LINE__ . ": $this->lua\n";
        LuaValue::new($this->lua, null, managed: false, forcetop: true);
        var_dump($this->managed);
        var_dump("It is " . spl_object_id($this));
        echo __LINE__ . ":$this->index $this->lua\n";
        while($this->lua->luaCall("lua_next", $this->index)) {
            echo __LINE__ . ": $this->lua\n";
            $key = LuaValue::fromIndex($this->lua, -2, managed: false);
            echo __LINE__ . ": $this->lua\n";
            $value = LuaValue::fromIndex($this->lua, -1, managed: false);
            echo __LINE__ . ": $this->lua\n";
            $data[$key->value()] = $value;
            echo __LINE__ . ": $this->lua\n";
            $this->lua->luaCall("lua_settop", -2);
            echo __LINE__ . ": $this->lua\n";
        }
        echo __LINE__ . ": $this->lua\n";
        return $data;
        /*
        $key = LuaValue::new($this->lua, null);
        while(true) {
            // Copy key to the top of the stack
            $key->clone(false, forceTop: true);
            // Call lua_next
            if(!$this->lua->luaCall("lua_next",$this->index)) {
                // key got popped off, we can just return
                break;
            }
            // stack goes from <key> to <key> <value>
            $key = LuaValue::fromIndex($this->lua, -2); // same key as above
            $value = LuaValue::fromIndex($this->lua, -1);
            yield $key => $value;
        }
         */
    }

    #[MethodBalance(+100)]
    protected static function _push(LuaState $lua, mixed $value): void
    {
        $lua->luaCall("lua_createtable",0, 0);
        $self = new self($lua, -1, false);
        foreach($value as $k => $v) {
            $self[$k] = $v;
        }
    }
}