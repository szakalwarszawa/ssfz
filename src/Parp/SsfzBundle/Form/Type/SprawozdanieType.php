<?php

namespace Parp\SsfzBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
use Parp\SsfzBundle\Entity\AbstractSprawozdanie;
use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;

/**
 * Typ formularza sprawozdania
 */
class SprawozdanieType extends AbstractType
{
    /**
     * Buduje formularz do wypełniania sprawozdania
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $czyJestPortfelSpolek = $builder
            ->getData()
            ->getUmowa()
            ->getBeneficjent()
            ->getProgram()
            ->czyJestPortfelSpolek()
        ;

        $this->showRemarks = $options['showRemarks'];

        if ($this->showRemarks === true) {
            $builder->add('uwagi', TextareaType::class, [
                'label' => 'Komentarz PARP',
                'attr'  => [
                    'readonly' => true,
                    'rows'     => '5',
                ],
            ]);
        }

        if ($this->showRemarks === false || $this->showRemarks === null) {
            $builder->add('uwagi', HiddenType::class, [
                'data' => '',
            ]);
        }

        $builder->add('numerUmowy', null, [
            'label' => 'Numer umowy',
            'attr'  => [
                'readonly' => true,
            ],
        ]);

        if ($czyJestPortfelSpolek) {
            $builder->add('sprawozdaniaSpolek', CollectionType::class, [
                'entry_type'    => SprawozdanieSpolkiType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'allow_add'     => true,
                'by_reference'  => false,
                'allow_delete'  => true,
            ]);
        }

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

        $builder->add('przekierowanie', HiddenType::class, [
            'mapped' => false,
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
            'data_class'         => AbstractSprawozdanie::class,
            'attr'               => [
                'novalidate' => 'novalidate',
            ],
            'showRemarks'        => null,
            'lata'               => null,
            'allow_extra_fields' => true,
            'program'            => null,
        ]);
    }
}
