<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkoweSkladnikWydzielony;

/**
 * Typ formularza sprawozdania
 */
class SprawozdaniePozyczkoweSkladnikWydzielonyType extends SprawozdaniePozyczkoweSkladnikOgolemType
{
    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => SprawozdaniePozyczkoweSkladnikWydzielony::class,
        ]);
    }
}
