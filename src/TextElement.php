<?php

namespace iggyvolz\ObsProject;

use iggyvolz\obs\Requests\SceneItemTransformUpdate;

class TextElement extends Element
{
    public function __construct(
        public string $text,
        public int    $width,
        public int    $height,
        Scene $scene,
        SceneItemTransformUpdate $transform = new SceneItemTransformUpdate(),
        public string $horizontalAlignment = "center",
        public string $verticalAlignment = "center",
        public bool   $wrap = true,
        public string $font = "Arial",
        public int    $fontSize = 72,
    )
    {
        parent::__construct($transform, $scene);
    }

    public static function getInputKind(): string
    {
        return "text_gdiplus_v2";
    }

    protected function getProperties(): array
    {
        return [
            "align" => $this->horizontalAlignment,
            "extents" => true,
            "extents_cx" => $this->width,
            "extents_cy" => $this->height,
            "extents_wrap" => $this->wrap,
            "font" => [
                "face" => $this->font,
                "size" => $this->fontSize,
            ],
            "text" => $this->text,
            "valign" => $this->verticalAlignment,
        ];
    }
}