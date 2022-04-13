<?php

// define HANDSHAKE_URL, HANDSHAKE_PASSWORD

use iggyvolz\ObsProject\DataProviders\MelonDs\MalbisMemoryAddress;
use iggyvolz\ObsProject\DataProviders\MelonDs\MelonDsApi;

require_once __DIR__ . "/secrets.php";

require_once __DIR__ . "/vendor/autoload.php";
//$melonds = new MelonDsApi();
//var_dump(MalbisMemoryAddress::Coins->get($melonds));

$obs = new \iggyvolz\obs\Obs(HANDSHAKE_URL, HANDSHAKE_PASSWORD);
$scene = new \iggyvolz\ObsProject\MyScene($obs);
$scene->run();