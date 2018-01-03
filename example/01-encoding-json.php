<?php

declare(strict_types=1);
use Suin\Json;

$value = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
var_dump(Json::encode($value));
// Output:
// string(31) "{"a":1,"b":2,"c":3,"d":4,"e":5}"

$a = ['<foo>', "'bar'", '"baz"', '&blong&', "\xc3\xa9"];
echo 'Normal: ', Json::encode($a), "\n";
echo 'Tags: ', Json::encode($a, JSON_HEX_TAG), "\n";
echo 'Apos: ', Json::encode($a, JSON_HEX_APOS), "\n";
echo 'Quot: ', Json::encode($a, JSON_HEX_QUOT), "\n";
echo 'Amp: ', Json::encode($a, JSON_HEX_AMP), "\n";
echo 'Unicode: ', Json::encode($a, JSON_UNESCAPED_UNICODE), "\n";
echo 'All: ', Json::encode($a, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE), "\n\n";
// Output:
// Normal: ["<foo>","'bar'","\"baz\"","&blong&","\u00e9"]
// Tags: ["\u003Cfoo\u003E","'bar'","\"baz\"","&blong&","\u00e9"]
// Apos: ["<foo>","\u0027bar\u0027","\"baz\"","&blong&","\u00e9"]
// Quot: ["<foo>","'bar'","\u0022baz\u0022","&blong&","\u00e9"]
// Amp: ["<foo>","'bar'","\"baz\"","\u0026blong\u0026","\u00e9"]
// Unicode: ["<foo>","'bar'","\"baz\"","&blong&","é"]
// All: ["\u003Cfoo\u003E","\u0027bar\u0027","\u0022baz\u0022","\u0026blong\u0026","é"]
//

$b = [];
echo 'Empty array output as array: ', Json::encode($b), "\n";
echo 'Empty array output as object: ', Json::encode($b, JSON_FORCE_OBJECT), "\n\n";
// Output:
// Empty array output as array: []
// Empty array output as object: {}
//

$c = [[1, 2, 3]];
echo 'Non-associative array output as array: ', Json::encode($c), "\n";
echo 'Non-associative array output as object: ', Json::encode($c, JSON_FORCE_OBJECT), "\n\n";
// Output:
// Non-associative array output as array: [[1,2,3]]
// Non-associative array output as object: {"0":{"0":1,"1":2,"2":3}}
//

$d = ['foo' => 'bar', 'baz' => 'long'];
echo 'Associative array always output as object: ', Json::encode($d), "\n";
echo 'Associative array always output as object: ', Json::encode($d, JSON_FORCE_OBJECT), "\n\n";
// Output:
// Associative array always output as object: {"foo":"bar","baz":"long"}
// Associative array always output as object: {"foo":"bar","baz":"long"}
//
