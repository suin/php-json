Json
================
[![travis-ci-badge]][travis-ci] [![packagist-dt-badge]][packagist]

A Simple wrapper of `json_decode()` and `json_encode()`.

### Features

1. Provides the same interface with built-in functions, so you can replace your code easier.
    * Built-in function interface:
      ```php
      json_decode(
        string $json, 
        ?bool $assoc = false, 
        ?int $depth = 512, 
        ?int $options = 0
      ): mixed
      ```
    * This library interface:
      ```php
      \Suin\Json::decode(
        string $json,
        ?bool $assoc = false,
        ?int $depth = 512,
        ?int $options = 0
      ): mixed
      ```
1. Exception-based error handling.
    * Throws `DecodingException` when failed to decode JSON.
    * You don't have to treat `json_last_error()` any more.
1. Object-oriented interface.
    * As `Decoder` class can be instantiated, you can re-use a preconfigured single decoder in  several places.
      ```php
      // preconfigured decoder
      $decoder = (new Decoder)->preferArray();
      $array1 = $decoder->decode($json1);
      $array2 = $decoder->decode($json2); // re-use it
      $array3 = $decoder->decode($json3); // re-use it
      ```
1. Immutable `Decoder` object.
    * As the `Decoder` object setting can not be changed once being instantiated, it is safer even in the case of sharing the object among some modules.

#### Example usage

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

To see more examples, visit [./example](./example) folder.

#### Installation via Composer
``` bash
$ composer require suin/json
```

#### Running tests
``` bash
$ composer test
```

#### License
This library is licensed under the MIT license. Please see [LICENSE](LICENSE.md) for more details.

#### Changelog
Please see [CHANGELOG](CHANGELOG.md) for more details.

#### Contributing
Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for more details.

<!-- Badges -->
[travis-ci]: https://travis-ci.org/suin/php-json
[travis-ci-badge]: https://img.shields.io/travis/suin/php-json.svg?style=flat-square
[packagist]: https://packagist.org/packages/suin/json
[packagist-dt-badge]: https://img.shields.io/packagist/dt/suin/json.svg?style=flat-square
