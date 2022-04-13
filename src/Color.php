<?php

namespace iggyvolz\ObsProject;

final class Color
{
    public function __construct(
        public readonly int $r,
        public readonly int $g,
        public readonly int $b,
        public readonly int $a,
    )
    {
    }

    public function toInt(): int
    {
        return $this->a << 24 | $this->r | $this->g << 8 | $this->b << 16;
    }
}