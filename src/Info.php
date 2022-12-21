<?php

namespace FileWav;

class Info
{
    private ?int $filesize = null;
    private ?string $filename = null;
    private ?string $compression = null;
    private ?int $channels = null;
    private ?int $framerate = null;
    private ?int $byterate = null;
    private ?int $bits = null;
    private ?float $length = null;

    public function setBits(int $bits): self
    {
        $this->bits = $bits;

        return $this;
    }

    public function getBits(): ?int
    {
        return $this->bits;
    }

    public function setByterate(int $byterate): self
    {
        $this->byterate = $byterate;

        return $this;
    }

    public function getByterate(): ?int
    {
        return $this->byterate;
    }

    public function setChannels(int $channels): self
    {
        $this->channels = $channels;

        return $this;
    }

    public function getChannels(): ?int
    {
        return $this->channels;
    }

    public function setCompression(string $compression): self
    {
        $this->compression = $compression;

        return $this;
    }

    public function getCompression(): ?string
    {
        return $this->compression;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilesize(int $filesize): self
    {
        $this->filesize = $filesize;

        return $this;
    }

    public function getFilesize(): ?int
    {
        return $this->filesize;
    }

    public function setFramerate(int $framerate): self
    {
        $this->framerate = $framerate;

        return $this;
    }

    public function getFramerate(): ?int
    {
        return $this->framerate;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }
}
