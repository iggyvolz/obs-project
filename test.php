<?php

use iggyvolz\ObsProject\App;

require_once __DIR__ . "/vendor/autoload.php";

(new \iggyvolz\ObsProject\Container())->getByType(App::class)->run();

