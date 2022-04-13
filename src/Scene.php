<?php
namespace iggyvolz\ObsProject;

use iggyvolz\obs\Obs;
use Revolt\EventLoop;
use function Amp\async;
use function Amp\Future\awaitAll;

abstract class Scene
{
    public function __construct(
        public readonly Obs $obs,
        public readonly string $name,
    )
    {
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
                $value->add($this);
            }
        }
        $this->_run();
        EventLoop::run();
    }

    protected abstract function _run(): void;

    protected function clear(): void
    {
        if(empty(array_filter($this->obs->getSceneList()->await()->scenes, fn(array $scene): bool => $scene["sceneName"] === $this->name))) {
            // Create scene _obs if not exists
            $this->obs->createScene("_obs")->await();
        } else {
            // Remove all items from _obs if it does exist
            awaitAll(array_map(fn(array $sceneItem) => $this->obs->removeSceneItem("_obs", $sceneItem["sceneItemId"]), $this->obs->getSceneItemList($this->name)->await()->sceneItems));
        }
    }
}