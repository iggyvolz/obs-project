<?php

namespace iggyvolz\ObsProject\DataProviders\MelonDs;

enum DataType
{
    case Boolean; // Byte, returned as 1 => true, 0 => false
    case Byte;
    case Short;
    case Int3; // 3 byte integer for some reason
    case Int;

    public function get(int $address, MelonDsApi $melonDs): bool|int
    {
        return match($this) {
            DataType::Boolean => $melonDs->get(ArmRegion::Arm9, $address, 1) === 1,
            DataType::Byte => $melonDs->get(ArmRegion::Arm9, $address, 1),
            DataType::Short => $melonDs->get(ArmRegion::Arm9, $address, 2),
            DataType::Int3 => $melonDs->get(ArmRegion::Arm9, $address, 4) & 0xffffff00,
            DataType::Int => $melonDs->get(ArmRegion::Arm9, $address, 4),
        };
    }
}