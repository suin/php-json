<?php

use Suin\Json;
use Suin\Json\Encoder;

$invalidValue = NAN;

try {
    Json::encode($invalidValue);
} catch (Json\EncodingException $e) {
    var_dump($e->getMessage());
    var_dump($e->getContext()->value());
    var_dump($e->getContext()->options());
}
// Output:
// string(57) "Failed to encode JSON: Inf and NaN cannot be JSON encoded"
// float(NAN)
// int(0)

try {
    $encoder = (new Encoder)->prettyPrint();
    $encoder->encode($invalidValue);
} catch (Json\EncodingException $e) {
    var_dump($e->getMessage());
    var_dump($e->getContext()->value());
    var_dump($e->getContext()->options());
}
// Output:
// string(57) "Failed to encode JSON: Inf and NaN cannot be JSON encoded"
// float(NAN)
// int(128)
