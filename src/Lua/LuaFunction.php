<?php

namespace iggyvolz\ObsProject\Lua;

use FFI;
use FFI\CData;

final class LuaFunction extends LuaValue
{
    private bool $isWrapped = false;
    public function value(): self
    {
        return $this;
    }
    public function jsonSerialize(): mixed
    {
        return "<function>";
    }

    public function __toString()
    {
        return "<function>";
    }

    #[MethodBalance(+1)]
    protected static function _push(LuaState $lua, mixed $value): void
    {
        $lua->luaCall("lua_pushcclosure",self::wrap($value), 0);
    }

    public static function wrap(\Closure $closure): \Closure
    {
        return function(CData $state) use($closure){
            $state = new LuaState($state, false);
            $refl = new \ReflectionFunction($closure);
            $params = [];
            for($i = 0; $i < $refl->getNumberOfParameters(); $i++) {
                $type = $refl->getParameters()[$i]->getType();
                if($type instanceof \ReflectionNamedType && ($type->getName() === LuaValue::class || is_subclass_of($type->getName(), LuaValue::class))) {
                    $params[] = LuaValue::fromIndex($state, $i + 1, managed: false);
                } elseif($type instanceof \ReflectionNamedType && $type->getName() === LuaState::class) {
                    $params[] = $state;
                } else {
                    $params[] = LuaValue::fromIndex($state, $i + 1, managed: false)->value();
                }
            }
            try {
                $ret = $closure(...$params);
            } catch(\Throwable $throwable) {
                // Push exception to the top
                LuaValue::new($state, $throwable, true, false, true);
                // Trigger an error
                $state->luaCall("lua_error");
                // Never returns
                throw new \LogicException();
            }
            if($refl->getReturnType() instanceof \ReflectionNamedType && $refl->getReturnType()->getName() === "void") {
                $ret = [];
            }
            if(!is_array($ret)) {
                $ret = [$ret];
            }
            foreach($ret as $value) {
                LuaValue::new($state, $value, false, false, true);
            }
            return count($ret);
        };
    }

    #[MethodBalance(+1)]
    public static function fromString(LuaState $lua, string $code, string $name, bool $managed = true): self
    {
        $lua->luaCall("luaL_loadbufferx", $code, strlen($code), $name, null);
        return new self($lua, -1, managed: $managed);
    }

    #[MethodBalance(-1)]
    /**
     * @internal
     * Invokes the function (must be on the top of the stack) and frees it from the stack (aka doesn't make a copy)
     * @param mixed ...$params
     * @return list<LuaValue>
     */
    public function invokeAndFree(mixed ...$params): array
    {
        if($this->managed) {
            throw new \LogicException("Cannot invokeAndFree a managed function");
        }
        $top = $this->lua->luaCall("lua_gettop");
        if($this->index !== $top) {
            throw new \LogicException("Cannot invokeAndFree a function not on top");
        }
        foreach ($params as $param) {
            LuaValue::new($this->lua, $param, false, false, true);
        }
        if($this->lua->luaCall("lua_pcallk",count($params), -1, 0, 0, null)) {
            $value = LuaValue::fromIndex($this->lua, -1)->value();
            if($value instanceof \Throwable) {
                throw $value;
            }
            if(is_string($value)) {
                throw new LuaException($value);
            }
            throw new LuaException("Unhandled error type " . get_debug_type($value));
        }
        $returns = [];
        // Be sure to create *managed* LuaValue pointers from this point on
        for($i = $top; $i <= $this->lua->luaCall("lua_gettop"); $i++) {
            $returns[] = LuaValue::fromIndex($this->lua, $i);
        }
        return $returns;
    }

    #[MethodBalance(0)]
    /** @return list<LuaValue> */
    public function __invoke(mixed ...$params): array
    {
        return ($this->clone(managed: false, forceTop: true))->invokeAndFree(...$params);
    }
}