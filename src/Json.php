<?php
declare(strict_types=1);

namespace Suin;

use Suin\Json\Decoder;
use Suin\Json\DecodingException;

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
}
