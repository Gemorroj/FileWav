<?php

namespace FileWav\Tests;

use FileWav\Exception;
use FileWav\Wav;
use PHPUnit\Framework\TestCase;

class WavTest extends TestCase
{
    public function testWav(): void
    {
        $wav = new Wav(__DIR__.'/fixtures/example.wav');

        $info = $wav->getInfo();

        self::assertSame(1073218, $info->getFilesize());
        self::assertSame(8000, $info->getFramerate());
        self::assertSame(32000, $info->getByterate());
        self::assertSame(16, $info->getBits());
        self::assertSame(33.529625, $info->getLength());
    }

    public function testFail(): void
    {
        $this->expectException(Exception::class);
        new Wav(__DIR__.'/fake_path.wav');
    }
}
