<?php

namespace Parp\SsfzBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use HTMLPurifier;
use HTMLPurifier_Config;

/**
 * Dodaje specyficzne dla aplikacji rozszerzenia systemu szablonów Twig.
 */
class AppExtension extends AbstractExtension
{
    /**
     * @var HTMLPurifier
     */
    private $htmlPurifier;

    /**
     * Konstruktor.
     */
    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();
        $this->htmlPurifier = new HTMLPurifier($config);
    }

    /**
     * Zwraca wykaz filtrów dodanych do systemu szablonów.
     *
     * @return array|TwigFiler[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('purify', [$this, 'purify']),
        ];
    }

    /**
     * Wykomuje filtr "purify".
     *
     * @param string $string
     *
     * @return string
     */
    public function purify($string)
    {
        return $this->htmlPurifier->purify($string);
    }
}
