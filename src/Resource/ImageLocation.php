<?php

namespace PhotoDNA\Resource;

class ImageLocation extends BaseResource
{
    public function __construct(string $location)
    {
        $this->DataRepresentation = 'URL';
        $this->Value = $location;
    }
}