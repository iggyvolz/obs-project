<?php

namespace iggyvolz\ObsProject;

use Amp\Future;
use Amp\Http\Server\HttpServer;
use iggyvolz\obs\Obs;
use function Amp\async;
use function Amp\delay;
use function Amp\Future\awaitAll;
use function Amp\trapSignal;

class App
{
    public function __construct(
        private HttpServer $server,
        private readonly Obs $obs,
    )
    {
    }

    public function run(): void
    {
        $this->server->start();

        async($this->obs->run(...));
        $this->obs->connected->await();

        $specialInputs = $this->obs->getSpecialInputs()->await();
        $specialInputs = array_filter([$specialInputs->desktop1, $specialInputs->desktop2, $specialInputs->mic1, $specialInputs->mic2, $specialInputs->mic3, $specialInputs->mic4]);
        awaitAll(array_map(fn(array $input) => in_array($input["inputName"], $specialInputs) ? Future::complete() : $this->obs->removeInput($input["inputName"]), $this->obs->getInputList()->await()->inputs));
        delay(1);
        $currentScene = $this->obs->getCurrentProgramScene()->await()->currentProgramSceneName;
        $this->obs->createInput($currentScene, "browser", "browser_source", [
            "css" => "",
            "url" => "http://127.0.0.1:8080/image.png",
            "width" => 1920,
            "height" => 1080
        ])->await();
        \Revolt\EventLoop::repeat(1, fn() => $this->obs->pressInputPropertiesButton("browser", "refreshnocache")->await());

        $signal = trapSignal([\SIGINT, \SIGTERM]);

        $this->server->stop();
    }
}