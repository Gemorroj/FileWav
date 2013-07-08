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

require_once 'File/Wav/Info.php';
require_once 'File/Wav/Exception.php';

class File_Wav
{
    /**
     * @var string
     */
    protected $file;
    /**
     * @var File_Wav_Info
     */
    protected $info;



    /**
     * @param string $file
     *
     * @throws File_Wav_Exception
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->info = new File_Wav_Info();
        $this->read();
    }


    /**
     * @return File_Wav_Info
     */
    public function getInfo()
    {
        return $this->info;
    }


    /**
     * @throws File_Wav_Exception
     */
    private function read ()
    {
        $this->info->setFilename(realpath($this->file));

        $file = fopen($this->file, 'r');
        if ($file === false) {
            throw new File_Wav_Exception('Can not read file');
        }

        $this->info->setFilesize(filesize($this->info->getFilename()));

        if ($this->info->getFilesize() <= 16) {
            fclose($file);
            throw new File_Wav_Exception('Invalid file size');
        }

        $chunkId = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);

        fgetc($file);
        fgetc($file);
        fgetc($file);
        fgetc($file);

        $chunkType = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);

        if ($chunkId !== 'RIFF' || $chunkType !== 'WAVE') {
            fclose($file);
            throw new File_Wav_Exception('Invalid file type');
        }

        $chunkId = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);
        $chunkSize = $this->longCalc(fgetc($file), fgetc($file), fgetc($file), fgetc($file), 0);
        if ($chunkId !== 'fmt ') {
            fclose($file);
            throw new File_Wav_Exception('Invalid file format');
        }

        $this->info->setCompression($this->shortCalc(fgetc($file), fgetc($file), 0));
        $this->info->setChannels($this->shortCalc(fgetc($file), fgetc($file), 0));
        $this->info->setFramerate($this->longCalc(fgetc($file), fgetc($file), fgetc($file), fgetc($file), 0));
        $this->info->setByterate($this->longCalc(fgetc($file), fgetc($file), fgetc($file), fgetc($file), 0));

        fgetc($file);
        fgetc($file);

        $this->info->setBits($this->shortCalc(fgetc($file), fgetc($file), 0));
        if (16 < $chunkSize) {
            $extra_bytes = $this->shortCalc(fgetc($file), fgetc($file), 1);
            $j = 0;
            while ($j < $extra_bytes && !feof($file)) {
                fgetc($file);
                $j++;
            }
        }
        $chunkId = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);
        $chunkSize = $this->longCalc(fgetc($file), fgetc($file), fgetc($file), fgetc($file), 0);
        if ($chunkId === 'data') {
            $this->info->setLength((($chunkSize / $this->info->getChannels()) / ($this->info->getBits() / 8)) / $this->info->getFramerate());
        } else {
            while ($chunkId !== 'data' && !feof($file)) {
                $j = 1;
                while ($j <= $chunkSize && !feof($file)) {
                    fgetc($file);
                    $j++;
                }
                $chunkId = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);
                $chunkSize = $this->longCalc(fgetc($file), fgetc($file), fgetc($file), fgetc($file), 0);
            }
            if ($chunkId === 'data') {
                $this->info->setLength((($chunkSize / $this->info->getChannels()) / ($this->info->getBits() / 8)) / $this->info->getFramerate());
            }
        }

        fclose($file);
    }


    /**
     * longCalc calculates the decimal value of 4 bytes
     *
     * @param string $b1
     * @param string $b2
     * @param string $b3
     * @param string $b4
     * @param int $mode 0 - b1 is the byte with least value. 1 - b1 is the byte with most value
     *
     * @return int
     */
    private function longCalc($b1, $b2, $b3, $b4, $mode = 0)
    {
        $b1 = hexdec(bin2hex($b1));
        $b2 = hexdec(bin2hex($b2));
        $b3 = hexdec(bin2hex($b3));
        $b4 = hexdec(bin2hex($b4));
        if (!$mode) {
            return ($b1 + ($b2 * 256) + ($b3 * 65536) + ($b4 * 16777216));
        } else {
            return ($b4 + ($b3 * 256) + ($b2 * 65536) + ($b1 * 16777216));
        }
    }


    /**
     * shortCalc calculates the decimal value of 2 bytes
     *
     * @param string $b1
     * @param string $b2
     * @param int $mode 0 - b1 is the byte with least value. 1 - b1 is the byte with most value
     *
     * @return int
     */
    private function shortCalc($b1, $b2, $mode = 0)
    {
        $b1 = hexdec(bin2hex($b1));
        $b2 = hexdec(bin2hex($b2));
        if (!$mode) {
            return ($b1 + ($b2 * 256));
        } else {
            return ($b2 + ($b1 * 256));
        }
    }

}
