# Wav files parser

[![Continuous Integration](https://github.com/Gemorroj/FileWav/workflows/Continuous%20Integration/badge.svg?branch=master)](https://github.com/Gemorroj/FileWav/actions?query=workflow%3A%22Continuous+Integration%22)


Based on classAudioFile (michael kamleitner (mika@ssw.co.at))


### Requirements:
- PHP >= 7.3


### Installation:
```bash
composer require gemorroj/file-wav
```


###Example:
```php
<?php
use FileWav\Wav;

$wav = new Wav('path_to/file.wav');


print_r($wav->getInfo());
/*
FileWav\Info Object
(
    [filesize:FileWav\Info:private] => 1073218
    [filename:FileWav\Info:private] => path_to/file.wav
    [compression:FileWav\Info:private] => 1
    [channels:FileWav\Info:private] => 2
    [framerate:FileWav\Info:private] => 8000
    [byterate:FileWav\Info:private] => 32000
    [bits:FileWav\Info:private] => 16
    [length:FileWav\Info:private] => 33.529625
)
 */
```
