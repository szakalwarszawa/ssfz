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
        $builder->add('numerUmowy', null, [
            'label'       => 'Numer umowy',
            'attr'        => [
                'readonly' => true,
            ],
        ]);

        $builder->add('okres', ChoiceType::class, [
            'label'             => 'Sprawozdanie za okres',
            'choices'           => $options['program']->getOkresySprawozdawcze(),
            'choices_as_values' => true,
            'choice_label'      => 'nazwa',
            'choice_name'       => 'id',
            'required'          => false,
            'placeholder'       => '',
            'constraints'       => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('rok', ChoiceType::class, [
            'label'       => 'Rok',
            'choices'     => $options['lata'],
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
            'lata'               => null,
            'allow_extra_fields' => true,
        ]);
    }
}
