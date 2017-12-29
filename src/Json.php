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
     * @param bool|null $assoc
     * @param int|null  $depth
     * @param int|null  $options
     * @return mixed
     * @throws DecodingException
     */
    public static function decode(
        string $json,
        ?bool $assoc = null,
        ?int $depth = null,
        ?int $options = null
    )
    {
        return (new Decoder($assoc, $depth, $options))->decode($json);
    }

    /**
     * @param mixed    $value
     * @param int|null $options
     * @param int|null $depth
     * @return string
     * @throws EncodingException
     */
    public static function encode(
        $value,
        ?int $options = null,
        ?int $depth = null
    )
    {
        return (new Encoder($options, $depth))->encode($value);
    }
}
