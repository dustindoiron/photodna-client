<?php

namespace PhotoDNA\Resource;

class ImageFile
{
    protected string $filename;

    protected $file;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->file = fopen($this->filename, 'r');
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }
}