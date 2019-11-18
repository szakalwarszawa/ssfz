<?php

namespace Test\Parp\SsfzBundle\Helper;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Helper\MoneyHelper;

/**
 * Testy klasy pomocniczej dla operacji na kwotach.
 */
class MoneyHelperTest extends TestCase
{
    public function testCanConvertAnyValueToDecimalString()
    {
        $input = -100.123;

        // No changes.
        // -100.123 to -100.123
        $decimalString = MoneyHelper::anyToDecimalString($input, 3);
        $this->assertSame('-100.123', $decimalString);

        // Zero int to decimal.
        // 0 to 0.00
        $decimalString = MoneyHelper::anyToDecimalString('0', 2);
        $this->assertSame('0.00', $decimalString);

        // Zero decimal to int.
        // 0.00 to 0
        $decimalString = MoneyHelper::anyToDecimalString('0.00', 0);
        $this->assertSame('0', $decimalString);

        // Trim decimal part.
        // -100.123 to -100.12
        $decimalString = MoneyHelper::anyToDecimalString($input, 2);
        $this->assertSame('-100.12', $decimalString);

        // Trim decimal part and make unsigned.
        // -100.123 to 100.12
        $decimalString = MoneyHelper::anyToDecimalString($input, 2, true);
        $this->assertSame('100.12', $decimalString);

        // Convert to integer.
        // -100.123 to -100
        $decimalString = MoneyHelper::anyToDecimalString($input, 0);
        $this->assertSame('-100', $decimalString);

        // Convert to unsigned integer.
        // -100.123 to 100
        $decimalString = MoneyHelper::anyToDecimalString($input, 0, true);
        $this->assertSame('100', $decimalString);

        // Convert unknown to decimal zero (0.00).
        // xxx to 100
        $decimalString = MoneyHelper::anyToDecimalString('xxx', 2, true);
        $this->assertSame('0.00', $decimalString);

        // Large pretty decimal to large decimal.
        // 100 200 300.400500zł to 100200300.40.
        $decimalString = MoneyHelper::anyToDecimalString('100 200 300.400500zł', 2, true);
        $this->assertSame('100200300.40', $decimalString);
    }
}
