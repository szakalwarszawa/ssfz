<?php

namespace Parp\SsfzBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    private $htmlPurifier;

    public function __construct()
    {
        $config = \HTMLPurifier_Config::createDefault();
        $this->htmlPurifier = new \HTMLPurifier($config);
    }
    public function getFilters()
    {
        return array(
            new TwigFilter('purify', array($this, 'purify')),
        );
    }

    public function purify($string)
    {
        return $this->htmlPurifier->purify($string);
    }
}
