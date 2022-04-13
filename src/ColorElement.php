<?php

namespace iggyvolz\ObsProject;

use iggyvolz\obs\Requests\SceneItemTransformUpdate;

class ColorElement extends Element
{
    public function __construct(
        public Color $color,
        public int $width,
        public int $height,
        SceneItemTransformUpdate $transform = new SceneItemTransformUpdate(),
    )
    {
        parent::__construct($transform);
    }

    public static function getInputKind(): string
    {
        return "color_source_v3";
    }

    protected function getProperties(): array
    {
        return [
            "width" => $this->width,
            "height" => $this->height,
            "color" => $this->color->toInt(),
        ];
    }
}