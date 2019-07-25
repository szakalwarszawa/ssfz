<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Constraints;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Klasa sprawdzająca poprawność numeru umowy dla konkretnego programu.
 */
class NumerUmowyValidator extends ConstraintValidator
{
    /**
     * Regexp dla numeru umowy funduszu zalążkowego (bez delimiterów).
     *
     * @var string
     */
    const REGEXP_FUNDUSZ_ZALAZKOWY = '^POIG\.03\.01\.00\-00\-[0-9][0-9][1-9]\/(08|09|10|11|12|13)\-00$';

    /**
     * Regexp dla numeru umowy funduszu pożyczkowego (bez delimiterów).
     *
     * @var string
     */
    const REGEXP_FUNDUSZ_POZYCZKOWY = '^WKP\_1\/1\.2\.1\/[0-9]\/2([0-9]){3,3}\/(([1-9][0-9])|([1-9]))\/(([1-9][0-9])|([1-9]))\/u$';

    /**
     * Regexp dla numeru umowy funduszu poręczeniowego (bez delimiterów).
     *
     * @var string
     */
    const REGEXP_FUNDUSZ_PORECZENIOWY = '^WKP\_1\/1\.2\.2\/[0-9]\/2([0-9]){3,3}\/(([1-9][0-9])|([1-9]))\/(([1-9][0-9])|([1-9]))\/u$';

    /**
     * @var string
     */
    private $pattern;

    /**
     * Sprawdza poprawność numeru umowy.
     *
     * @param string $value
     * @param Constraint $constraint
     *
     * @return bool
     */
    public function validate($value, Constraint $constraint)
    {
        // Nie są walidowane puste wartości. Dla zabezpieczenia przez niewypełnieniem
        // pola należy użyć sprawdzenia typu NotBlank() lub podobnego.
        if ('' === trim((string) $value)) {
            return true;
        }

        $this->pattern = $this->getRegexp($constraint->program);

        $result = $this->sprawdzNumerUmowy($value);
        if (true !== $result) {
            $this->context->addViolation($this->getMessage($constraint));
        }

        return $result;
    }

    /**
     * Generuje wyrażenie regularne dla zadanego programu.
     *
     * Jeśli program nie jest określony wyrażenie będzie zawierało alternatywy
     * dla wszystkich programów. Każdy numer, zgodny ze wzorem dla min. jednego
     * programu będzie uznawany za prawidłowy.
     *
     * Z parametrów został usunięty typehint "Program". Formularz (pole Collection) przekazywał
     * obiekty proxy zamiast realnych obiektów. Wygląda to na błąd Sf lub Doctrine.
     * Zamiast "Parp\SsfzBundle\Entity\Slownik\Program" przekazywany był
     * "Proxies\__CG__\Parp\SsfzBundle\Entity\Slownik\Program".
     * Nie pomagało wymuszenie w encjach EAGER LOADING.
     *
     * @param Program|null $program
     *
     * @return string
     *
     * @throws InvalidArgumentException Jeśli dla wskazanego programu nie istnieje regexp numeru umowy.
     */
    private function getRegexp($program = null): string
    {
        if (null === $program) {
            return '/('.self::REGEXP_FUNDUSZ_ZALAZKOWY.')|('.self::REGEXP_FUNDUSZ_POZYCZKOWY.')|('.self::REGEXP_FUNDUSZ_PORECZENIOWY.')/';
        }

        if ($program->czyFunduszZalazkowy()) {
            return '/'.self::REGEXP_FUNDUSZ_ZALAZKOWY.'/';
        }

        if ($program->czyFunduszPozyczkowy()) {
            return '/'.self::REGEXP_FUNDUSZ_POZYCZKOWY.'/';
        }

        if ($program->czyFunduszPoreczeniowy()) {
            return '/'.self::REGEXP_FUNDUSZ_PORECZENIOWY.'/';
        }

        throw new InvalidArgumentException('Nie można określić zasad numeracji umów dla wskazanego programu.');
    }

    /**
     * Generuje komunikat błędu walidacji specyficzny dla zadanego programu.
     *
     * @param Constraint $constraint
     *
     * @return string
     */
    private function getMessage(Constraint $constraint): string
    {
        $program = $constraint->program;

        if (null === $program) {
            return $constraint->message;
        }

        if ($program->czyFunduszZalazkowy()) {
            return $constraint->message.' '.$constraint->messageFunduszZalazkowy;
        }

        if ($program->czyFunduszPozyczkowy()) {
            return $constraint->message.' '.$constraint->messageFunduszPozyczkowy;
        }

        if ($program->czyFunduszPoreczeniowy()) {
            return $constraint->message.' '.$constraint->messageFunduszPoreczeniowy;
        }
    }

    /**
     * Sprawdza zgodność numeru umowy z wyrażeniem regularnym specyficznym dla programu.
     *
     * @param string $nrUmowy
     *
     * @return bool
     */
    private function sprawdzNumerUmowy(string $nrUmowy): bool
    {
        return (preg_match($this->pattern, $nrUmowy) === 1);
    }
}
