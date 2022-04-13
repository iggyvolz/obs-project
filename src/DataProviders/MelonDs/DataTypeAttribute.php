<?php

namespace iggyvolz\ObsProject\DataProviders\MelonDs;

#[\Attribute(\Attribute::TARGET_CLASS_CONSTANT)]
final class DataTypeAttribute
{
    public function __construct(public readonly DataType $dataType)
    {
    }
}