<?php

declare(strict_types=1);

namespace Suin\Json;

final class Encoder
{
    private const OPTIONS = 0;

    private const DEPTH = 512;

    /**
     * @var null|int
     */
    private $options;

    /**
     * @var null|int
     */
    private $depth;

    /**
     * @param null|int $options
     * @param null|int $depth
     */
    public function __construct(
        ?int $options = null,
        ?int $depth = null
    ) {
        $this->options = $options ?? self::OPTIONS;
        $this->depth = $depth ?? self::DEPTH;
    }

    /**
     * @return self
     */
    public function prettyPrint(): self
    {
        return $this->addOption(JSON_PRETTY_PRINT);
    }

    /**
     * @return self
     */
    public function compactPrint(): self
    {
        return $this->removeOption(JSON_PRETTY_PRINT);
    }

    /**
     * @return self
     */
    public function unescapeSlashes(): self
    {
        return $this->addOption(JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return self
     */
    public function escapeSlashes(): self
    {
        return $this->removeOption(JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return self
     */
    public function unescapeUnicode(): self
    {
        return $this->addOption(JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return self
     */
    public function escapeUnicode(): self
    {
        return $this->removeOption(JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param mixed $value
     * @return string
     */
    public function encode($value): string
    {
        $json = \json_encode($value, $this->options, $this->depth);
        $error = json_last_error();

        if ($error !== JSON_ERROR_NONE) {
            throw EncodingException::create(
                $error,
                json_last_error_msg(),
                new EncodingContext($value, $this->options, $this->depth)
            );
        }
        return $json;
    }

    /**
     * @param int $option
     * @return self
     */
    private function addOption(int $option): self
    {
        return $this->copy('options', $this->options | $option);
    }

    /**
     * @param int $option
     * @return self
     */
    private function removeOption(int $option): self
    {
        return $this->copy('options', $this->options & ~$option);
    }

    /**
     * @param string $name
     * @param mixed  $value
     * @return self
     * @todo make trait
     */
    private function copy(string $name, $value): self
    {
        $copy = clone $this;
        $copy->{$name} = $value;
        return $copy;
    }
}
