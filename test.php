<?php

use iggyvolz\obs\Obs;
use iggyvolz\obs\RequestIdGenerator;
use Psr\Log\AbstractLogger;
use Ramsey\Uuid\Uuid;
use Revolt\EventLoop;
use function Amp\async;
use function Amp\Future\awaitAll;

require_once __DIR__ . "/vendor/autoload.php";
function texttime(int $time): string
{
    $seconds = $time % 60;
    $time -= $seconds;
    $time /= 60;
    $minutes = $time % 60;
    $time -= $minutes;
    $time /= 60;
    $hours = $time;
    $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
    $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
    $seconds = str_pad($seconds, 2, "0", STR_PAD_LEFT);
    return "$hours:$minutes:$seconds";
}

function color(int $r, int $g, int $b, int $a): int
{
    return $a << 24 | $r | $g << 8 | $b << 16;
}
$obs = new Obs(
    'ws://192.168.1.118:4444',
    'IEAL8ig3QxEcaJiD',
    new class implements RequestIdGenerator {

        public function getRequestId(): string
        {
            return Uuid::uuid4();
        }
    },
    new class extends AbstractLogger {
        public function log($level, \Stringable|string $message, array $context = []): void
        {
            echo "$level: $message\n";
        }
    },
);

async($obs->run(...));
$obs->connected->await();
if(empty(array_filter($obs->getSceneList()->await()->scenes, fn(array $scene): bool => $scene["sceneName"] === "_obs"))) {
    // Create scene _obs if not exists
    $obs->createScene("_obs")->await();
} else {
    // Remove all items from _obs if it does exist
    awaitAll(array_map(fn(array $sceneItem) => $obs->removeSceneItem("_obs", $sceneItem["sceneItemId"]), $obs->getSceneItemList("_obs")->await()->sceneItems));
}
// Create background
$obs->createInput("_obs", $background = Uuid::uuid4(), "color_source_v3", [
    "width" => 1920,
    "height" => 100,
    "color" => color(155, 103, 60, 255),
]);
// Create text display
$time = 0;
$obs->createInput("_obs", $timer = Uuid::uuid4(), "text_gdiplus_v2", [
    "align" => "center",
    "extents" => true,
    "extents_cx" => 1920,
    "extents_cy" => 100,
    "extents_wrap" => true,
    "font" => [
        "face" => "Arial",
        "size" => 72
    ],
    "text" => texttime($time),
    "valign" => "center",
]);
EventLoop::repeat(1, function() use($timer, &$time, $obs): void {
    $time++;
    $obs->setInputSettings($timer, [
        "text" => texttime($time)
    ]);
});
EventLoop::run();