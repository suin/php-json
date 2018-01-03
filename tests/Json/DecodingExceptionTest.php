<?php

declare(strict_types=1);

namespace Suin\Json;

use PHPUnit\Framework\TestCase;
use Suin\Json;

class DecodingExceptionTest extends TestCase
{
    /**
     * @param DecodingContext $context
     * @param int             $errorCode
     * @param string          $errorMessage
     * @dataProvider dataForTestExceptions
     */
    public function testJsonClass(DecodingContext $context, int $errorCode, string $errorMessage): void
    {
        $this->expectDecodingException(
            function () use ($context): void {
                Json::decode(
                    $context->json(),
                    $context->assoc(),
                    $context->depth(),
                    $context->options()
                );
            },
            $context,
            $errorCode,
            $errorMessage
        );
    }

    /**
     * @param DecodingContext $context
     * @param int             $errorCode
     * @param string          $errorMessage
     * @dataProvider dataForTestExceptions
     */
    public function testDecoderClass(DecodingContext $context, int $errorCode, string $errorMessage): void
    {
        $this->expectDecodingException(
            function () use ($context): void {
                $decoder = new Decoder(
                    $context->assoc(),
                    $context->depth(),
                    $context->options()
                );
                $decoder->decode($context->json());
            },
            $context,
            $errorCode,
            $errorMessage
        );
    }

    /**
     * @return array
     */
    public function dataForTestExceptions()
    {
        $assoc = false;
        $depth = 512;
        $options = 0;
        return [
            [
                new DecodingContext('[[1]]', $assoc, 2, $options),
                JSON_ERROR_DEPTH,
                'Maximum stack depth exceeded',
            ],
            [
                new DecodingContext('[1}', $assoc, $depth, $options),
                JSON_ERROR_STATE_MISMATCH,
                'State mismatch (invalid or malformed JSON)',
            ],
            [
                new DecodingContext('["' . chr(0) . 'aaa"]', $assoc, $depth, $options),
                JSON_ERROR_CTRL_CHAR,
                'Control character error, possibly incorrectly encoded',
            ],
            [
                new DecodingContext('[1', $assoc, $depth, $options),
                JSON_ERROR_SYNTAX,
                'Syntax error',
            ],
            [
                new DecodingContext("\"a\xb0b\"", $assoc, $depth, $options),
                JSON_ERROR_UTF8,
                'Malformed UTF-8 characters, possibly incorrectly encoded',
            ],
        ];
    }

    /**
     * @param callable        $errorCausingDecoder
     * @param DecodingContext $context
     * @param int             $errorCode
     * @param string          $errorMessage
     */
    private function expectDecodingException(
        callable $errorCausingDecoder,
        DecodingContext $context,
        int $errorCode,
        string $errorMessage
    ): void {
        try {
            $errorCausingDecoder();
            $this->fail('Exception expected');
        } catch (DecodingException $e) {
            $this->assertSame($errorCode, $e->getCode());
            $this->assertSame("Failed to decode JSON: ${errorMessage}", $e->getMessage());
            $this->assertEquals($context, $e->getContext());
        }
    }
}
