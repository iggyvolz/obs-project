<?php

namespace iggyvolz\ObsProject;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

class Logger extends AbstractLogger
{
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        echo "$level: $message\n";
    }
}