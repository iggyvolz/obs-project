<?php
namespace iggyvolz\ObsProject;

use iggyvolz\obs\Obs;
use Revolt\EventLoop;
use function Amp\async;
use function Amp\Future\awaitAll;

final class Scene
{
    private function __construct(
        public readonly Obs $obs,
        public readonly string $name,
    )
    {
    }

    public static function newClear(Obs $obs, string $name): self
    {
        $self = self::create($obs, $name);
        awaitAll(array_map(fn(array $sceneItem) => $obs->removeSceneItem($name, $sceneItem["sceneItemId"]), $obs->getSceneItemList($name)->await()->sceneItems));
        return $self;
    }

    public static function create(Obs $obs, string $name): self
    {
        if(!self::sceneExists($obs, $name)) {
            // Create scene _obs if not exists
            $obs->createScene($name)->await();
        }
        return new self($obs, $name);
    }

    public static function get(Obs $obs, string $name): ?self
    {
        return self::sceneExists($obs, $name) ? new self($obs, $name) : null;
    }

    private static function sceneExists(Obs $obs, string $name): bool
    {
        return !empty(array_filter($obs->getSceneList()->await()->scenes, fn(array $scene): bool => $scene["sceneName"] === $name));
    }

    public final function run(): void
    {
        // Run OBS
        async($this->obs->run(...))->catch(function (\Throwable $th): void {
            // Ignore error if it was already running
            if(!($th instanceof \LogicException && $th->getMessage() === "Only one instance of run() at a time")) {
                throw $th;
            }
        });
        // Wait for OBS to connect
        $this->obs->connected->await();
        // Ensure $this->name is a blank scene
        $this->clear();
        // Add all elements
        foreach((new \ReflectionClass($this))->getProperties() as $property) {
            $value = $property->getValue($this);
            if($value instanceof Element) {
                $value->add();
            }
        }
        $this->_run();
        EventLoop::run();
    }
}