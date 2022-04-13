<?php

namespace iggyvolz\ObsProject;

use iggyvolz\obs\Requests\SceneItemTransform;
use iggyvolz\obs\Requests\SceneItemTransformUpdate;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class Element
{
    public readonly UuidInterface $id;

    public function __construct(protected SceneItemTransformUpdate $transform, protected readonly Scene $scene)
    {
        $this->id = Uuid::uuid4();
    }
    public static abstract function getInputKind(): string;
    protected abstract function getProperties(): array;
    public function add(): void
    {
        $sceneItemId = $this->scene->obs->createInput($this->scene->name, $this->id, $this->getInputKind(), $this->getProperties())->await()->sceneItemId;
        $this->scene->obs->setSceneItemTransform($this->scene->name, $sceneItemId, $this->transform)->await();
    }
    public function update(): void
    {
        $this->scene->obs->setInputSettings($this->id, $this->getProperties())->await();
    }
    public function remove(): void
    {
        $this->scene->obs->removeInput($this->id)->await();
    }
}