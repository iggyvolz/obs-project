<?php

use Nette\DI\Compiler;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PsrPrinter;

require_once __DIR__ . "/vendor/autoload.php";
$class = ClassType::fromCode('<?php ' . (new Compiler())->loadConfig(__DIR__ . "/config.neon")->compile());
$class->setName("Container");
$class->getMethod("createServiceContainer")->setReturnType("self");
$file = new PhpFile();
$file->setStrictTypes();
$file->addNamespace("iggyvolz\\ObsProject")->add($class);
file_put_contents(__DIR__ . "/src/Container.php", ((new PsrPrinter())->printFile($file)));
