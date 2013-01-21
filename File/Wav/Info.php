<?php
/**
 *
 * This software is distributed under the GNU GPL v3.0 license.
 *
 * @author    Gemorroj
 * @copyright 2012 http://wapinet.ru
 * @license   http://www.gnu.org/licenses/gpl-3.0.txt
 * @link      https://github.com/Gemorroj/File_Wav
 * @version   0.1 alpha
 *
 */

class File_Wav_Info
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
     * @return File_Wav_Info
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
     * @return File_Wav_Info
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
     * @return File_Wav_Info
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
     * @return File_Wav_Info
     */
    public function setCompression($compression)
    {
        $this->compression = $compression;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCompression()
    {
        return $this->compression;
    }

    /**
     * @param string $filename
     *
     * @return File_Wav_Info
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param int $filesize
     *
     * @return File_Wav_Info
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
     * @return File_Wav_Info
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
     * @return File_Wav_Info
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
