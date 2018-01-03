<?php

declare(strict_types=1);

namespace Suin\Json;

use PHPUnit\Framework\TestCase;

class EncoderTest extends TestCase
{
    public function testOptions(): void
    {
        $encoder = new Encoder();

        // Pretty print
        $value = [1, 2];
        self::assertSame('[1,2]', $encoder->encode($value));
        self::assertSame("[\n    1,\n    2\n]", $encoder->prettyPrint()->encode($value));
        self::assertSame('[1,2]', $encoder->prettyPrint()->compactPrint()->encode($value));

        // Escape slashes
        self::assertSame('"\/"', $encoder->encode('/'));
        self::assertSame('"/"', $encoder->unescapeSlashes()->encode('/'));
        self::assertSame('"\/"', $encoder->unescapeSlashes()->escapeSlashes()->encode('/'));

        // Escape unicode
        self::assertSame('"\u00e0"', $encoder->encode('à'));
        self::assertSame('"à"', $encoder->unescapeUnicode()->encode('à'));
        self::assertSame('"\u00e0"', $encoder->unescapeUnicode()->escapeUnicode()->encode('à'));
    }
}
