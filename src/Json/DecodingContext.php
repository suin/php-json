<?php

declare(strict_types=1);

namespace Suin\Json;

final class DecodingContext
{
    /**
     * @var string
     */
    private $json;

    /**
     * @var bool
     */
    private $assoc;

    /**
     * @var int
     */
    private $depth;

    /**
     * @var int
     */
    private $options;

    /**
     * @param string $json
     * @param bool   $assoc
     * @param int    $depth
     * @param int    $options
     */
    public function __construct(
        string $json,
        bool $assoc,
        int $depth,
        int $options
    ) {
        $this->json = $json;
        $this->assoc = $assoc;
        $this->depth = $depth;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function json(): string
    {
        return $this->json;
    }

    /**
     * @return bool
     */
    public function assoc(): bool
    {
        return $this->assoc;
    }

    /**
     * @return int
     */
    public function depth(): int
    {
        return $this->depth;
    }

    /**
     * @return int
     */
    public function options(): int
    {
        return $this->options;
    }
}
