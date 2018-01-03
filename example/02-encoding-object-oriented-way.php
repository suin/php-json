<?php

declare(strict_types=1);
use Suin\Json\Encoder;

$encoder = new Encoder();
$value = ['àö', 'こんにちは', '✅'];

echo $encoder
    ->prettyPrint()
    ->unescapeSlashes()
    ->unescapeUnicode()
    ->encode($value), PHP_EOL;
// Output:
// [
//     "àö",
//     "こんにちは",
//     "✅"
// ]
