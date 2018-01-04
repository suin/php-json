<?php

declare(strict_types=1);

namespace Suin\Json;

final class Decoder
{
    private const ASSOC = false;

    private const DEPTH = 512;

    private const OPTIONS = 0;

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
     * @param null|bool $assoc
     * @param null|int  $depth
     * @param null|int  $options
     */
    public function __construct(
        ?bool $assoc = null,
        ?int $depth = null,
        ?int $options = null
    ) {
        $this->assoc = $assoc ?? self::ASSOC;
        $this->depth = $depth ?? self::DEPTH;
        $this->options = $options ?? self::OPTIONS;
    }

    /**
     * @return Decoder
     */
    public function preferArray(): self
    {
        return $this->copy('assoc', true);
    }

    /**
     * @return Decoder
     */
    public function preferObject(): self
    {
        return $this->copy('assoc', false);
    }

    /**
     * @param int $depth
     * @return Decoder
     */
    public function setDepth(int $depth): self
    {
        return $this->copy('depth', $depth);
    }

    /**
     * @param string $json
     * @throws DecodingException
     * @return mixed
     */
    public function decode(string $json)
    {
        $value = \json_decode($json, $this->assoc, $this->depth, $this->options);
        $error = json_last_error();

        if ($error !== JSON_ERROR_NONE) {
            throw DecodingException::create(
                $error,
                json_last_error_msg(),
                new DecodingContext($json, $this->assoc, $this->depth, $this->options)
            );
        }
        return $value;
    }

    /**
     * @param string $name
     * @param mixed  $value
     * @return Decoder
     */
    private function copy(string $name, $value): self
    {
        $copy = clone $this;
        $copy->{$name} = $value;
        return $copy;
    }
}
