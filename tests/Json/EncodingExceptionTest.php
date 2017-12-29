<?php
declare(strict_types=1);

namespace Suin\Json;

use PHPUnit\Framework\TestCase;
use Suin\Json;

class EncodingExceptionTest extends TestCase
{
    /**
     * @param EncodingContext $context
     * @param int             $errorCode
     * @param string          $errorMessage
     * @dataProvider dataForTestExceptions
     */
    public function testJsonClass(
        EncodingContext $context,
        int $errorCode,
        string $errorMessage
    )
    {
        $this->expectEncodingException(
            function () use ($context) {
                Json::encode(
                    $context->value(),
                    $context->options(),
                    $context->depth()
                );
            },
            $context,
            $errorCode,
            $errorMessage
        );
    }

    /**
     * @param EncodingContext $context
     * @param int             $errorCode
     * @param string          $errorMessage
     * @dataProvider dataForTestExceptions
     */
    public function testEncoderClass(
        EncodingContext $context,
        int $errorCode,
        string $errorMessage
    )
    {
        $this->expectEncodingException(
            function () use ($context) {
                $encoder = new Encoder(
                    $context->options(),
                    $context->depth()
                );
                $encoder->encode($context->value());
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
        $depth = 512;
        $options = 0;
        return [
            [
                new EncodingContext(INF, $options, $depth),
                JSON_ERROR_INF_OR_NAN,
                'Inf and NaN cannot be JSON encoded',
            ],
            [
                new EncodingContext(fopen('php://memory', 'r'), $options, $depth),
                JSON_ERROR_UNSUPPORTED_TYPE,
                'Type is not supported',
            ],
        ];
    }

    /**
     * @param callable        $errorCausingEncoder
     * @param EncodingContext $context
     * @param int             $errorCode
     * @param string          $errorMessage
     */
    private function expectEncodingException(
        callable $errorCausingEncoder,
        EncodingContext $context,
        int $errorCode,
        string $errorMessage
    )
    {
        try {
            $errorCausingEncoder();
            $this->fail('Exception expected');
        } catch (EncodingException $e) {
            $this->assertSame($errorCode, $e->getCode());
            $this->assertSame("Failed to encode JSON: $errorMessage", $e->getMessage());
            $this->assertEquals($context, $e->getContext(), null, 0.0, 10);
        }
    }
}
