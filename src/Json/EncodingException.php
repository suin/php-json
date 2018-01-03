<?php

declare(strict_types=1);

namespace Suin\Json;

use Throwable;

final class EncodingException extends \RuntimeException
{
    /**
     * @var EncodingContext
     */
    private $context;

    /**
     * @param string          $message
     * @param int             $code
     * @param EncodingContext $context
     * @param null|Throwable  $previous
     */
    public function __construct(
        $message,
        $code,
        EncodingContext $context,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->context = $context;
    }

    /**
     * @param int             $errorCode
     * @param string          $errorMessage
     * @param EncodingContext $context
     * @return self
     */
    public static function create(
        int $errorCode,
        string $errorMessage,
        EncodingContext $context
    ) {
        return new self(
            "Failed to encode JSON: ${errorMessage}",
            $errorCode,
            $context
        );
    }

    /**
     * @return EncodingContext
     */
    public function getContext(): EncodingContext
    {
        return $this->context;
    }
}
