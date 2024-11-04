<?php


use App\Helpers\BarCode;
use PHPUnit\Framework\TestCase;

class BarCodeTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_barcode_is_true_code(): void
    {
        $barcode = BarCode::generateBarCode();

        $this->assertIsInt($barcode);
        $this->assertGreaterThanOrEqual(10000000, $barcode);
        $this->assertLessThanOrEqual(99999999, $barcode);
    }
}
