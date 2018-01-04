<?php

declare(strict_types=1);

namespace Suin\Json;

use Suin\Json;

/**
 * @param string    $json
 * @param null|bool $assoc
 * @param null|int  $depth
 * @param null|int  $options
 * @throws DecodingException
 * @return mixed
 */
function json_decode(
    string $json,
    ?bool $assoc = null,
    ?int $depth = null,
    ?int $options = null
) {
    return Json::decode($json, $assoc, $depth, $options);
}

/**
 * @param mixed    $value
 * @param null|int $options
 * @param null|int $depth
 * @throws EncodingException
 * @return string
 */
function json_encode(
    $value,
    ?int $options = null,
    ?int $depth = null
) {
    return Json::encode($value, $options, $depth);
}
