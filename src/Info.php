<?php

namespace FileWav;

class Info
{
    /**
     * @var int|null
     */
    private $filesize;
    /**
     * @var string|null
     */
    private $filename;
    /**
     * @var string|null
     */
    private $compression;
    /**
     * @var int|null
     */
    private $channels;
    /**
     * @var int|null
     */
    private $framerate;
    /**
     * @var int|null
     */
    private $byterate;
    /**
     * @var int|null
     */
    private $bits;
    /**
     * @var int|null
     */
    private $length;

    /**
     * @param int $bits
     *
     * @return $this
     */
    public function setBits($bits)
    {
        $this->bits = $bits;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBits()
    {
        return $this->bits;
    }

    /**
     * @param int $byterate
     *
     * @return $this
     */
    public function setByterate($byterate)
    {
        $this->byterate = $byterate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getByterate()
    {
        return $this->byterate;
    }

    /**
     * @param int $channels
     *
     * @return $this
     */
    public function setChannels($channels)
    {
        $this->channels = $channels;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * @param string $compression
     *
     * @return $this
     */
    public function setCompression($compression)
    {
        $this->compression = $compression;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompression()
    {
        return $this->compression;
    }

    /**
     * @param string $filename
     *
     * @return $this
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param int $filesize
     *
     * @return $this
     */
    public function setFilesize($filesize)
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFilesize()
    {
        return $this->filesize;
    }

    /**
     * @param int $framerate
     *
     * @return $this
     */
    public function setFramerate($framerate)
    {
        $this->framerate = $framerate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFramerate()
    {
        return $this->framerate;
    }

    /**
     * @param int $length
     *
     * @return $this
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLength()
    {
        return $this->length;
    }
}
