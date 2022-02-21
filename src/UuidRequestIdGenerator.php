<?php

namespace iggyvolz\ObsProject;

use iggyvolz\obs\RequestIdGenerator;
use Ramsey\Uuid\UuidFactoryInterface;

class UuidRequestIdGenerator implements RequestIdGenerator
{
    public function __construct(
        private readonly UuidFactoryInterface $uuidFactory,
    )
    {
    }

    public function getRequestId(): string
    {
        return $this->uuidFactory->uuid4();
    }
}