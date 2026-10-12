<?php

namespace FileWav\Tests;

use FileWav\Exception;
use FileWav\Wav;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class WavTest extends TestCase
{
    public function testPcm16bit8000hz2ch(): void
    {
        $info = (new Wav(__DIR__.'/fixtures/pcm_16bit_8000hz_2ch.wav'))->getInfo();

        self::assertSame(1073218, $info->getFilesize());
        self::assertSame(1, $info->getCompression());
        self::assertSame(2, $info->getChannels());
        self::assertSame(8000, $info->getFramerate());
        self::assertSame(32000, $info->getByterate());
        self::assertSame(16, $info->getBits());
        self::assertSame(33.529625, $info->getLength());
    }

    public function testPcm8bit11025hz1ch(): void
    {
        $info = (new Wav(__DIR__.'/fixtures/pcm_8bit_11025hz_1ch.wav'))->getInfo();

        self::assertSame(1, $info->getCompression());
        self::assertSame(1, $info->getChannels());
        self::assertSame(11025, $info->getFramerate());
        self::assertSame(11025, $info->getByterate());
        self::assertSame(8, $info->getBits());
        self::assertSame(1.0, $info->getLength());
    }

    public function testDataChunkAfterListChunk(): void
    {
        $info = (new Wav(__DIR__.'/fixtures/pcm_16bit_44100hz_2ch_list-chunk.wav'))->getInfo();

        self::assertSame(1, $info->getCompression());
        self::assertSame(2, $info->getChannels());
        self::assertSame(44100, $info->getFramerate());
        self::assertSame(176400, $info->getByterate());
        self::assertSame(16, $info->getBits());
        self::assertSame(1.0, $info->getLength());
    }

    public function testFmtChunkWithExtension(): void
    {
        $info = (new Wav(__DIR__.'/fixtures/pcm_16bit_44100hz_2ch_fmt-ext.wav'))->getInfo();

        self::assertSame(1, $info->getCompression());
        self::assertSame(2, $info->getChannels());
        self::assertSame(44100, $info->getFramerate());
        self::assertSame(176400, $info->getByterate());
        self::assertSame(16, $info->getBits());
        self::assertSame(1.0, $info->getLength());
    }

    #[DataProvider('invalidFilesProvider')]
    public function testInvalidFiles(string $file, string $expectedMessage): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage($expectedMessage);

        new Wav(__DIR__.'/fixtures/'.$file);
    }

    public static function invalidFilesProvider(): array
    {
        return [
            'too small' => ['invalid_short.wav', 'Invalid file size'],
            'not riff' => ['invalid_not-riff.wav', 'Invalid file type'],
            'no fmt chunk' => ['invalid_no-fmt.wav', 'Invalid file format'],
        ];
    }

    public function testMissingFile(): void
    {
        $this->expectException(Exception::class);

        new Wav(__DIR__.'/fixtures/fake_path.wav');
    }
}
