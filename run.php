<?php


use iggyvolz\obs\Obs;
use iggyvolz\ObsProject\Color;
use iggyvolz\ObsProject\ColorElement;
use iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra\LegendsOfRuneterraApi;
use iggyvolz\ObsProject\Scene;
use iggyvolz\ObsProject\TextElement;
use Psr\Log\AbstractLogger;
use function Amp\async;
use function Amp\Future\awaitAll;


require_once __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . "/secrets.php"; // define OBS_URL, OBS_PASSWORD


$obs = new Obs(OBS_URL, OBS_PASSWORD, logger: new class extends AbstractLogger {

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        echo "$level: $message\n";
    }
});

$obsRunner = async($obs->run(...));
// Wait for OBS to connect before proceeding
$obs->connected->await();

// Ensure a blank _obs scene exists
if (empty(array_filter($obs->getSceneList()->await()->scenes, fn(array $scene): bool => $scene["sceneName"] === "_obs"))) {
    // Create scene _obs if not exists
    $obs->createScene("_obs")->await();
} else {
    // Remove all items from _obs if it does exist
    awaitAll(array_map(fn(array $sceneItem) => $obs->removeSceneItem("_obs", $sceneItem["sceneItemId"]), $obs->getSceneItemList("_obs")->await()->sceneItems));
}
$scene = Scene::newClear($obs, "_obs");

$color = new ColorElement(new Color(155, 103, 60, 255), 1920, 100, $scene);
$color->add();
$text = new TextElement("", 1920, 100, $scene, fontSize: 48);
$text->add();
$legendsOfRuneterra = new LegendsOfRuneterraApi();  // Proxy from windows to WSL: ssh -fNT -L 21337:127.0.0.1:21337 192.168.1.118

\Revolt\EventLoop::repeat(1, function() use($text, $legendsOfRuneterra){
    $cardPositions = $legendsOfRuneterra->getCardPositions();
    $gameResult = $legendsOfRuneterra->getGameResult();
    $lastGameId = $gameResult->GameID;
    $wonLastGame = ($lastGameId === -1) ? null : $gameResult->LocalPlayerWon;

    $text->text = ((is_null($cardPositions->PlayerName) || is_null($cardPositions->OpponentName)) ? "(No active game)" : "$cardPositions->PlayerName vs $cardPositions->OpponentName") . "\n" . match($wonLastGame) {
        true => "Last game (#$lastGameId): " . "Victory",
        false => "Last game (#$lastGameId): " . "Defeat",
        null => "First game of the day",
    };
    $text->update();
});

\Revolt\EventLoop::run();

// Attempted Lua code - kept crashing in random places but I got it 99% of the way there:

//$lua = LuaState::new();
//$forbiddenAccess = LuaValue::new($lua, function (LuaState $lua) {
//    throw new LuaException("Forbidden access");
//});

//// Add ColorElement
//$lua->setGlobal("ColorElement", LuaUserdata::create($lua, $metatable = [
//    "__index" => LuaValue::new($lua, [
//        "new" => function (LuaState $lua) use (&$metatable, $scene) {
//            [$_, $color, $x, $y, $width, $height] = $lua;
//            if (!$color instanceof LuaTable) throw new LuaException("Invalid type for color");
//            $r = $color[1] ?? $color["r"];
//            $g = $color[2] ?? $color["g"];
//            $b = $color[3] ?? $color["b"];
//            $a = $color[4] ?? $color["a"];
//            if (!$r instanceof LuaInt) throw new LuaException("Invalid type for color");
//            if (!$g instanceof LuaInt) throw new LuaException("Invalid type for color");
//            if (!$b instanceof LuaInt) throw new LuaException("Invalid type for color");
//            if (!$a instanceof LuaInt && !$a instanceof LuaNil) throw new LuaException("Invalid type for color");
//            $r = max(0, min(255, $r->value()));
//            $g = max(0, min(255, $g->value()));
//            $b = max(0, min(255, $b->value()));
//            $a = max(0, min(255, $a->value() ?? 255));
//            $color = new Color($r, $g, $b, $a);
//            if (!$x instanceof LuaInt) throw new LuaException("Invalid type for x");
//            $x = $x->value();
//            if (!$y instanceof LuaInt) throw new LuaException("Invalid type for y");
//            $y = $y->value();
//            if (!$width instanceof LuaInt) throw new LuaException("Invalid type for width");
//            $width = $width->value();
//            if (!$height instanceof LuaInt) throw new LuaException("Invalid type for height");
//            $height = $height->value();
//
//            $elem = (new ColorElement($color, $width, $height, $scene, new SceneItemTransformUpdate(
//                positionX: $x,
//                positionY: $y
//            )));
//            $elem->add();
//            return LuaUserdata::create($lua, $metatable);
//        }
//    ]),
//    "__newindex" => $forbiddenAccess,
//    "__metatable" => $forbiddenAccess,
//]));
//// Add TextElement
//$lua->setGlobal("TextElement", LuaUserdata::create($lua, $metatable = [
//    "__index" => LuaValue::new($lua, [
//        "new" => function (LuaState $lua) use (&$metatable, $scene) {
//            [$_, $text, $x, $y, $width, $height, $fontsize] = $lua;
//            if (!$text instanceof LuaString) throw new LuaException("Invalid type for text");
//            $text = $text->value();
//            if (!$x instanceof LuaInt) throw new LuaException("Invalid type for x");
//            $x = $x->value();
//            if (!$y instanceof LuaInt) throw new LuaException("Invalid type for y");
//            $y = $y->value();
//            if (!$width instanceof LuaInt) throw new LuaException("Invalid type for width");
//            $width = $width->value();
//            if (!$height instanceof LuaInt) throw new LuaException("Invalid type for height");
//            $height = $height->value();
//            if (!$fontsize instanceof LuaInt) throw new LuaException("Invalid type for fontsize");
//            $fontsize = $fontsize->value();
//
//            $elem = (new \iggyvolz\ObsProject\TextElement($text, $width, $height, $scene, new SceneItemTransformUpdate(
//                positionX: $x,
//                positionY: $y
//            ), fontSize: $fontsize));
//            $elem->add();
//            return LuaUserdata::create($lua, $metatable);
//        }
//    ]),
//    "__newindex" => $forbiddenAccess,
//    "__metatable" => $forbiddenAccess,
//]));
//
//// Add LegendsOfRuneterra data provider
//$legendsOfRuneterra = new \iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra\LegendsOfRuneterraApi();
//$lua->setGlobal("LegendsOfRuneterra", LuaUserdata::create($lua, [
//    "__index" => $legendsOfRuneterra->dataProvider(...),
//    "__newindex" => $forbiddenAccess,
//    "__metatable" => $forbiddenAccess,
//]));
//$lua->executeFile(__DIR__ . "/scene.lua");
//$updateFunction = $lua->getGlobal("update");
//if(!$updateFunction instanceof LuaFunction) {
//    throw new LogicException("Must define an update() function");
//}
//\Revolt\EventLoop::repeat(1, function() use ($updateFunction) {
//    $updateFunction();
//});
//$x = LuaValue::new($lua, value: ["foo" => []]);
//$x->setMetatable("__index", fn(LuaTable $self, LuaValue $key): array => ["blah blah blah"]);
//$x->setMetatable("__newindex", fn(LuaTable $self, LuaValue $key, LuaValue $value) => $self->rawSet($key, "_" . $value->value()));
//$xMetatable = $x->getMetatable();
//echo "x.foo: " . $x["foo"] . PHP_EOL;
//echo "x.bar: " . $x["bar"] . PHP_EOL;
//$lua->setGlobal("x", $x);
//$lua->setGlobal("print", function(LuaState $lua) {
//    echo "$lua\n";
//});
//try {
//    echo __LINE__ . PHP_EOL;
//    echo "x.foo: " . $lua->execute("return x.foo.bin")[0] . PHP_EOL;
//    echo "x.bar: " . $lua->execute("return x.bar.bak")[0] . PHP_EOL;
//    $lua->execute("print(2+2)");
//} catch(LuaException $e) {
//    var_dump($e->getMessage());
//}
//var_dump(2+2);
