Json
================
[![travis-ci-badge]][travis-ci] [![packagist-dt-badge]][packagist] [![license-badge]][license] [![release-version-badge]][packagist] [![code-climate-maintainability-badge]][code-climate] [![code-climate-test-coverage-badge]][code-climate] ![php-version-badge]

Just a simple wrapper of `json_decode()` and `json_encode()`, but provides better interfaces: exception-based error handling and object oriented APIs.

## Features

### Compatible interface 

This library provides the same interface with built-in functions, so you can replace your code easier.

Built-in function interface:

```php
json_decode(
  string $json, 
  ?bool $assoc = false, 
  ?int $depth = 512, 
  ?int $options = 0
): mixed
json_encode(
  mixed $value, 
  ?int $options = 0,
  ?int $depth = 512 
): string
```

This library interface:

```php
\Suin\Json\json_decode(
  string $json,
  ?bool $assoc = false,
  ?int $depth = 512,
  ?int $options = 0
): mixed
\Suin\Json\json_encode(
  mixed $value,
  ?int $options = 0,
  ?int $depth = 512
): string
```

```php
\Suin\Json::decode(
  string $json,
  ?bool $assoc = false,
  ?int $depth = 512,
  ?int $options = 0
): mixed
\Suin\Json::encode(
  mixed $value,
  ?int $options = 0,
  ?int $depth = 512
): string
```

So that developers easily migrate to this library from the built-in functions. Just adding the following one line in the head of file:

```php
use function Suin\Json\json_decode;
use function Suin\Json\json_encode;
```

For about the full migration example, see [quick migration](./example/00-quick-migration.php).

### Exception-based error handling

* Throws `DecodingException` when failed to decode JSON.
* Throws `EncodingException` when failed to encode values.
* You don't have to treat `json_last_error()` any more.

```php
// Error handling example
$json = "{'Organization': 'PHP Documentation Team'}";
try {
    Json::decode($json);
} catch (Json\DecodingException $e) {
    var_dump($e->getMessage());
    var_dump($e->getContext()->json());
}
// Output:
// string(35) "Failed to decode JSON: Syntax error"
// string(42) "{'Organization': 'PHP Documentation Team'}"
```

### Object-oriented interface

As `Decoder` and `Encoder` class can be instantiated, you can re-use a preconfigured single decoder/encoder in  several places.

```php
// preconfigured decoder
$decoder = (new Decoder)->preferArray();
$array1 = $decoder->decode($json1);
$array2 = $decoder->decode($json2); // re-use it
$array3 = $decoder->decode($json3); // re-use it
  
// preconfigured encoder
$encoder = (new Encoder)->prettyPrint()->unescapeSlashes()->unescapeUnicode();
$json1 = $encoder->encode($value1);
$json2 = $encoder->encode($value2); // re-use it
$json3 = $encoder->encode($value3); // re-use it
```

### Immutable `Decoder` object

As the `Decoder` object setting can not be changed once being instantiated, it is safer even in the case of sharing the object among some modules.

## Installation via Composer

``` bash
$ composer require suin/json
```

## Example

### Decoding JSON to values using `Json` class

```php
<?php

use Suin\Json;

$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
var_dump(Json::decode($json));
var_dump(Json::decode($json, true));
// Output:
// object(stdClass)#%d (5) {
//   ["a"]=>
//   int(1)
//   ["b"]=>
//   int(2)
//   ["c"]=>
//   int(3)
//   ["d"]=>
//   int(4)
//   ["e"]=>
//   int(5)
// }
// array(5) {
//   ["a"]=>
//   int(1)
//   ["b"]=>
//   int(2)
//   ["c"]=>
//   int(3)
//   ["d"]=>
//   int(4)
//   ["e"]=>
//   int(5)
// }
```

### Encoding values to JSON using `Json` class

```php
<?php

use Suin\Json;

$value = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
var_dump(Json::encode($value));
// Output:
// string(31) "{"a":1,"b":2,"c":3,"d":4,"e":5}"
```

To see more examples, visit [./example](./example) folder.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more details.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for more details.

<!-- Badges -->
[travis-ci]: https://travis-ci.org/suin/php-json
[travis-ci-badge]: https://img.shields.io/travis/suin/php-json.svg?style=flat-square
[packagist]: https://packagist.org/packages/suin/json
[packagist-dt-badge]: https://img.shields.io/packagist/dt/suin/json.svg?style=flat-square
[license]: LICENSE.md
[license-badge]: https://img.shields.io/github/license/suin/php-json.svg?style=flat-square
[php-version-badge]: https://img.shields.io/packagist/php-v/suin/json.svg?style=flat-square
[release-version-badge]: https://img.shields.io/packagist/v/suin/json.svg?style=flat-square&label=release
[code-climate]: https://codeclimate.com/github/suin/php-json
[code-climate-maintainability-badge]: https://img.shields.io/codeclimate/maintainability/suin/php-json.svg?style=flat-square
[code-climate-test-coverage-badge]: https://img.shields.io/codeclimate/c/suin/php-json.svg?style=flat-square