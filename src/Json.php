<?php

declare(strict_types=1);

namespace Suin;

use Suin\Json\Decoder;
use Suin\Json\DecodingException;
use Suin\Json\Encoder;
use Suin\Json\EncodingException;

final class Json
{
    /**
     * @param string    $json
     * @param null|bool $assoc
     * @param null|int  $depth
     * @param null|int  $options
     * @throws DecodingException
     * @return mixed
     */
    public static function decode(
        string $json,
        ?bool $assoc = null,
        ?int $depth = null,
        ?int $options = null
    ) {
        return (new Decoder($assoc, $depth, $options))->decode($json);
    }

    /**
     * @param mixed    $value
     * @param null|int $options
     * @param null|int $depth
     * @throws EncodingException
     * @return string
     */
    public static function encode(
        $value,
        ?int $options = null,
        ?int $depth = null
    ) {
        return (new Encoder($options, $depth))->encode($value);
    }
}
