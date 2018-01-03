<?php

declare(strict_types=1);

namespace Suin\Json;

final class EncodingContext
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var int
     */
    private $options;

    /**
     * @var int
     */
    private $depth;

    /**
     * @param mixed $value
     * @param int   $options
     * @param int   $depth
     */
    public function __construct(
        $value,
        int $options,
        int $depth
    ) {
        $this->value = $value;
        $this->options = $options;
        $this->depth = $depth;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function options(): int
    {
        return $this->options;
    }

    /**
     * @return int
     */
    public function depth(): int
    {
        return $this->depth;
    }
}
