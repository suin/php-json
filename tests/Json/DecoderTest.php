<?php

declare(strict_types=1);

namespace Suin\Json;

use PHPUnit\Framework\TestCase;

class DecoderTest extends TestCase
{
    /**
     * Default decoder prefers returning object than array.
     */
    public function testDefaultDecoderPrefersObject(): void
    {
        $decoder = new Decoder();
        $value = $decoder->decode('{"a":"b"}');
        $this->assertInstanceOf(\stdClass::class, $value);
    }

    /**
     * Decoder is immutable object.
     */
    public function testImmutability(): void
    {
        $decoder1 = new Decoder();
        $decoder2 = $decoder1->preferArray();
        $this->assertNotSame($decoder1, $decoder2);

        $decoder3 = $decoder2->preferArray();
        $this->assertNotSame($decoder2, $decoder3);
        $this->assertEquals($decoder2, $decoder3);
    }

    public function testChangeReturningType(): void
    {
        $json = '{"a":1}';

        // Create object-preferring decoder
        $decoder = new Decoder(false);
        $value = $decoder->decode($json);
        $this->assertEquals(1, $value->a);

        // Change the decoder to prefer array
        $value = $decoder->preferArray()->decode($json);
        $this->assertEquals(['a' => 1], $value);

        // Create array-preferring decoder
        $decoder = new Decoder(true);
        $value = $decoder->decode($json);
        $this->assertEquals(['a' => 1], $value);

        // Change the decoder to prefer object
        $value = $decoder->preferObject()->decode($json);
        $this->assertEquals(1, $value->a);
    }
}
