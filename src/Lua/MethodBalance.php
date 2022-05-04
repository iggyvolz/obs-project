<?php

namespace iggyvolz\ObsProject\Lua;

//use iggyvolz\hooks\PostHook;
//use iggyvolz\hooks\PreHook;
use Iggyvolz\SimpleAttributeReflection\AttributeReflection;
use ReflectionFunction;
use ReflectionMethod;

/* TODO fix the hooks extension */
#[\Attribute(\Attribute::TARGET_METHOD)]
class MethodBalance// implements PreHook, PostHook
{
    public static array $assertions = [];

    public function __construct(private readonly int $expectedChange = 0)
    {
    }

    private static array $values = [];
    private static array $lua = [];
    private static function getLua(object|string|null $target, array $params): LuaState
    {
        if($target instanceof LuaState) {
            return $target;
        } elseif($target instanceof LuaValue) {
            return $target->lua;
        }
        foreach($params as $param) {
            if($param instanceof LuaState) return $param;
        }
        throw new \LogicException("Could not find Lua in a " . get_debug_type($target));
    }
    public function before(string $method, object|string|null $target, array $params): void
    {
        $lua = self::getLua($target, $params);
        self::$lua[] = $lua;
        self::$values[] = $lua->count();
    }

    public function after(string $method, object|string|null $target, mixed $retval): void
    {
        $originalStackSize = array_pop(self::$values);
        $lua = array_pop(self::$lua);
        $newStackSize = $lua->count();
        if($newStackSize !== $originalStackSize + $this->expectedChange) {
            // TODO: throwing in a hook causes a segfault
            self::$assertions[] =  new LuaException("Invalid balance assertion - went from a stack size of $originalStackSize to $newStackSize, expected change of ".($this->expectedChange >= 0 ? "+" : ""). "{$this->expectedChange}");
        }
    }
}
register_shutdown_function(function(){
    foreach(MethodBalance::$assertions as $assertion) {
        throw $assertion;
    }
});