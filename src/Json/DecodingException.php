<?php

declare(strict_types=1);

namespace Suin\Json;

use Throwable;

final class DecodingException extends \RuntimeException
{
    /**
     * @var DecodingContext
     */
    private $context;

    /**
     * @param string          $message
     * @param int             $code
     * @param DecodingContext $context
     * @param null|Throwable  $previous
     */
    public function __construct(
        $message,
        $code,
        DecodingContext $context,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->context = $context;
    }

    /**
     * @param int             $errorCode
     * @param string          $errorMessage
     * @param DecodingContext $context
     * @return DecodingException
     */
    public static function create(
        int $errorCode,
        string $errorMessage,
        DecodingContext $context
    ) {
        return new self(
            "Failed to decode JSON: ${errorMessage}",
            $errorCode,
            $context
        );
    }

    /**
     * @return DecodingContext
     */
    public function getContext(): DecodingContext
    {
        return $this->context;
    }
}
