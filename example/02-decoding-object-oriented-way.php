<?php
use Suin\Json\Decoder;

$decoder = new Decoder();

$json = '{"a": 1, "b": 2}';

var_dump($decoder->preferArray()->decode($json));
// Output:
// array(2) {
//   ["a"]=>
//   int(1)
//   ["b"]=>
//   int(2)
// }

var_dump($decoder->preferObject()->decode($json));
// Output:
// object(stdClass)#%d (2) {
//   ["a"]=>
//   int(1)
//   ["b"]=>
//   int(2)
// }
