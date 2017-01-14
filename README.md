# Wav files parser

[![Build Status](https://secure.travis-ci.org/Gemorroj/File_Wav.png?branch=master)](https://travis-ci.org/Gemorroj/FileWav)


Based on classAudioFile (michael kamleitner (mika@ssw.co.at))

Requirements:

- PHP >= 5.3


Example:
```php
<?php
use FileWav\Wav;

$wav = new Wav('path_to/file.wav');

echo '<pre>';

print_r($wav->getInfo());

echo '</pre>';
```
