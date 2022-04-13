<?php

namespace iggyvolz\ObsProject;

use iggyvolz\obs\Obs;
use iggyvolz\obs\Requests\SceneItemTransformUpdate;
use iggyvolz\ObsProject\DataProviders\MelonDs\MalbisMemoryAddress;
use iggyvolz\ObsProject\DataProviders\MelonDs\MelonDsApi;
use Revolt\EventLoop;

class MyScene extends Scene
{
    protected readonly ColorElement $backgroundElement;
    protected readonly TextElement $textElement;

    public function __construct(Obs $obs, private readonly MelonDsApi $melonDs)
    {
        parent::__construct($obs, "_obs");
        $this->backgroundElement = new ColorElement(new Color(155, 103, 60, 255), 1920, 100, new SceneItemTransformUpdate(
            positionY: 100
        ));
        $this->textElement = new TextElement("", 1920, 100, new SceneItemTransformUpdate(
            positionY: 100
        ));
    }

    protected function _run(): void
    {
        EventLoop::repeat(1000, function(){
            $this->textElement->text = "You have " . MalbisMemoryAddress::Coins->get($this->melonDs) . " coins";
            $this->textElement->update();
        });
    }
}