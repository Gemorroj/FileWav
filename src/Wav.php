<?php

namespace FileWav;

class Wav
{
    /**
     * @var string
     */
    protected $file;
    /**
     * @var Info
     */
    protected $info;

    /**
     * @param string $file
     *
     * @throws Exception
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->info = new Info();
        $this->read();
    }

    public function getInfo(): Info
    {
        return $this->info;
    }

    /**
     * @throws Exception
     */
    private function read(): void
    {
        $this->info->setFilename(\realpath($this->file));

        $file = @\fopen($this->file, 'rb');
        if (false === $file) {
            throw new Exception('Can not read file');
        }

        $this->info->setFilesize(\filesize($this->info->getFilename()));

        if ($this->info->getFilesize() <= 16) {
            \fclose($file);
            throw new Exception('Invalid file size');
        }

        $chunkId = \fgetc($file).\fgetc($file).\fgetc($file).\fgetc($file);

        \fgetc($file);
        \fgetc($file);
        \fgetc($file);
        \fgetc($file);

        $chunkType = \fgetc($file).\fgetc($file).\fgetc($file).\fgetc($file);

        if ('RIFF' !== $chunkId || 'WAVE' !== $chunkType) {
            \fclose($file);
            throw new Exception('Invalid file type');
        }

        $chunkId = \fgetc($file).\fgetc($file).\fgetc($file).\fgetc($file);
        $chunkSize = $this->longCalc(\fgetc($file), \fgetc($file), \fgetc($file), \fgetc($file), 0);
        if ('fmt ' !== $chunkId) {
            \fclose($file);
            throw new Exception('Invalid file format');
        }

        $this->info->setCompression($this->shortCalc(\fgetc($file), \fgetc($file), 0));
        $this->info->setChannels($this->shortCalc(\fgetc($file), \fgetc($file), 0));
        $this->info->setFramerate($this->longCalc(\fgetc($file), \fgetc($file), \fgetc($file), \fgetc($file), 0));
        $this->info->setByterate($this->longCalc(\fgetc($file), \fgetc($file), \fgetc($file), \fgetc($file), 0));

        \fgetc($file);
        \fgetc($file);

        $this->info->setBits($this->shortCalc(\fgetc($file), \fgetc($file), 0));
        if (16 < $chunkSize) {
            $extra_bytes = $this->shortCalc(\fgetc($file), \fgetc($file), 1);
            $j = 0;
            while ($j < $extra_bytes && !\feof($file)) {
                \fgetc($file);
                ++$j;
            }
        }
        $chunkId = \fgetc($file).\fgetc($file).\fgetc($file).\fgetc($file);
        $chunkSize = $this->longCalc(\fgetc($file), \fgetc($file), \fgetc($file), \fgetc($file), 0);
        if ('data' === $chunkId) {
            $this->info->setLength((($chunkSize / $this->info->getChannels()) / ($this->info->getBits() / 8)) / $this->info->getFramerate());
        } else {
            while ('data' !== $chunkId && !\feof($file)) {
                $j = 1;
                while ($j <= $chunkSize && !\feof($file)) {
                    \fgetc($file);
                    ++$j;
                }
                $chunkId = \fgetc($file).\fgetc($file).\fgetc($file).\fgetc($file);
                $chunkSize = $this->longCalc(\fgetc($file), \fgetc($file), \fgetc($file), \fgetc($file), 0);
            }
            if ('data' === $chunkId) {
                $this->info->setLength((($chunkSize / $this->info->getChannels()) / ($this->info->getBits() / 8)) / $this->info->getFramerate());
            }
        }

        \fclose($file);
    }

    /**
     * longCalc calculates the decimal value of 4 bytes.
     *
     * @param string $b1
     * @param string $b2
     * @param string $b3
     * @param string $b4
     * @param int    $mode 0 - b1 is the byte with least value. 1 - b1 is the byte with most value
     *
     * @return int
     */
    private function longCalc($b1, $b2, $b3, $b4, $mode = 0)
    {
        $b1 = \hexdec(\bin2hex($b1));
        $b2 = \hexdec(\bin2hex($b2));
        $b3 = \hexdec(\bin2hex($b3));
        $b4 = \hexdec(\bin2hex($b4));
        if (!$mode) {
            return $b1 + ($b2 * 256) + ($b3 * 65536) + ($b4 * 16777216);
        }

        return $b4 + ($b3 * 256) + ($b2 * 65536) + ($b1 * 16777216);
    }

    /**
     * shortCalc calculates the decimal value of 2 bytes.
     *
     * @param string $b1
     * @param string $b2
     * @param int    $mode 0 - b1 is the byte with least value. 1 - b1 is the byte with most value
     *
     * @return int
     */
    private function shortCalc($b1, $b2, $mode = 0)
    {
        $b1 = \hexdec(\bin2hex($b1));
        $b2 = \hexdec(\bin2hex($b2));
        if (!$mode) {
            return $b1 + ($b2 * 256);
        }

        return $b2 + ($b1 * 256);
    }
}
