<?php

namespace PhotoDNA\Resource;

use TypeError;

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

    public function getBase64()
    {
        return base64_encode($this->getFile());
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function closeFile(): void
    {
        if ($this->file) {
            try {
                fclose($this->file);
            } catch (TypeError $e) {
            }
        }
    }
}