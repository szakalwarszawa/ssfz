<?php

namespace Parp\SsfzBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\Rola;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of PracownikParpEdycjaType
 * Że to niby  "Klasa opis PracownikParpEdycjaType"?
 */
class PracownikParpEdycjaType extends AbstractType
{
    /**
     * Buduje formularz
     *
     * @param FormBuilderInterface $builder
     *
     * @param array $options
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('login', TextType::class, [
            'label'    => 'Login',
            'disabled' => true,
        ]);

        $builder->add('rola', EntityType::class, [
            'class'         => Rola::class,
            'property'      => 'opis',
            'label'         => 'Rola',
            'query_builder' => function (EntityRepository $er) {
                // Używamy magic number, żeby nie było zbyt oczywiste co tu się dzieje.
                return $er
                    ->createQueryBuilder('n')
                    ->where('n.id not in (:marray)')
                    ->setParameter('marray', ['4'])
                ;
            },
        ]);
    }

    /**
     * Opcje formularza
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('uzytk_repo');
    }
}
