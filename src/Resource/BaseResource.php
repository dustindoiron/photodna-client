<?php

namespace PhotoDNA\Resource;

class BaseResource
{
    protected array $values;

    public function getResourceParameters(): array
    {
        return $this->values;
    }

    public function __get(string $name): mixed
    {
        return $this->values[$name];
    }

    public function __set(string $name, mixed $value): void
    {
        $this->values[$name] = $value;
    }
}