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
