<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Helper;

/**
 * Klasa pomocnicza do operacji na kwotach.
 */
class MoneyHelper
{
    /**
     * Konwertuje dowolną wartość na ciąg tekstowy reprezentujący liczbę z określną dokładnością.
     *
     * Wartości, które nie mogą zostać sensowanie przekonwertowane są zamieniane na wartość zerową
     * z zadaną liczbą miejsc po przecinku.
     *
     * @param mixed $input Wartość do konwersji.
     * @param int|null $scale Liczba miejsc po przecinku (null zachowuje stan wejściowy).
     * @param bool $unsigned Czy konwertować do liczby dodatniej?
     * @param string $decimalSeparator Separator części dziesiętnej.
     *
     * @return string
     */
    public static function anyToDecimalString(
        $input,
        ?int $scale = 2,
        bool $unsigned = false,
        string $decimalSeparator = '.'
    ): string {
        $input = trim((string) $input);

        $scale = ($scale !== null) ? abs($scale) : null;
        $isNegative = ('-' === substr($input, 0, 1));
        $input = preg_replace('#[^0-9\\'.$decimalSeparator.']#', '', $input);

        $hasFraction = strpos($input, '.') !== false;
        $inputArr = $hasFraction ?  explode('.', $input) : [$input];

        if (isset($inputArr[0]) && false !== filter_var($inputArr[0], \FILTER_VALIDATE_INT)) {
            $integer = $inputArr[0];
        } else {
            $integer = '0';
        }

        $fraction = '';
        if (isset($inputArr[1])) {
            if ((int) $scale > 0) {
                $fraction = str_pad($inputArr[1], (int) $scale, '0');
                $fraction = substr($fraction, 0, $scale);
            }

            if ($scale === null) {
                $fraction = $inputArr[1];
            }
        } else {
            if ((int) $scale > 0) {
                $fraction = str_pad('', (int) $scale, '0');
            }
        }

        if (strlen($fraction) > 0) {
            $fraction = '.'.$fraction;
        }

        $decimalString = $integer.$fraction;
        if (((float) $decimalString > 0) && $isNegative && !$unsigned) {
            $decimalString = '-' . $decimalString;
        }
        
        return $decimalString;
    }
}
