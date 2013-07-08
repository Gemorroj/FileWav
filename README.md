# File_Wav

PEAR Package for simple information on WAV files

Based on classAudioFile (michael kamleitner (mika@ssw.co.at))


Example:
```php
<?php
set_include_path(__DIR__);


require_once 'File/Wav.php';

$wav = new File_Wav('./file.wav');

echo '<pre>';

print_r($wav->getInfo());

echo '</pre>';
```