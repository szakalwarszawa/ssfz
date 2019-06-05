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
     *
     * @param string $kernelRootDir
     */
    public function __construct($kernelRootDir = '')
    {
        $config = HTMLPurifier_Config::createDefault();
        $cacheDir = $kernelRootDir.\DIRECTORY_SEPARATOR.'cache/htmlpurifier';
        if (!file_exists($cacheDir)) {
            mkdir($cacheDir, 0775, true);
        }
        $config->set('Cache.SerializerPath', $cacheDir);
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
