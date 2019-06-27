<?php

namespace Parp\SsfzBundle\Form\Type;

use Parp\SsfzBundle\Entity\Beneficjent;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Parp\SsfzBundle\Entity\AbstractSprawozdanieSpo;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;
use Parp\SsfzBundle\Entity\Slownik\CzestotliwoscSprawozdan;

/**
 * Formuularz DodanieSprawozdaniaSpoType
 */
class DodanieSprawozdaniaSpoType extends AbstractType
{
    /**
     * Buduje formularz do wypełniania sprawozdania
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $czestotliwoscSprawozdan = $builder->getData()->getCzestotliwoscSprawozdanWProgramie();
        
        $builder->add('numerUmowy', null, [
            'label'       => 'Numer umowy',
            'attr'        => [
                'readonly' => true,
            ],
        ]);

        $builder->add('okres', EntityType::class, [
            'label'         => 'Sprawozdanie za okres',
            'class'         => OkresSprawozdawczy::class,
            'choice_label'  => 'nazwa',
            'required'      => false,
            'empty_value'   => null,
            'query_builder' => function (EntityRepository $repozytorium) use ($czestotliwoscSprawozdan) {
                return $repozytorium
                    ->createQueryBuilder('o')
                    ->where('o.czestotliwoscSprawozdan = :czestotliwosc')
                    ->setParameter('czestotliwosc', $czestotliwoscSprawozdan)
                    ->orderBy('o.id', 'ASC')
                ;
            },
            'constraints'   => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('rok', ChoiceType::class, [
            'label'       => 'Rok',
            'choices'     => $options['okresy'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);
    }

    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => AbstractSprawozdanieSpo::class,
            'attr'               => [
                'novalidate' => 'novalidate',
            ],
            'showRemarks'        => null,
            'okresy'             => null,
            'allow_extra_fields' => true,
        ]);
    }
}
