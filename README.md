# File_Wav

[![Build Status](https://secure.travis-ci.org/Gemorroj/File_Wav.png?branch=master)](https://travis-ci.org/Gemorroj/File_Wav)


PEAR Package for simple information on WAV files

Based on classAudioFile (michael kamleitner (mika@ssw.co.at))

Requirements:

- PHP >= 5.2


Example:
```php
<?php
set_include_path(dirname(__FILE__));


require_once 'File/Wav.php';

$wav = new File_Wav('./file.wav');

echo '<pre>';

print_r($wav->getInfo());

echo '</pre>';
```