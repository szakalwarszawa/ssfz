<?php

namespace Parp\SsfzBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\TypeValidator;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Parp\SsfzBundle\Entity\AbstractSprawozdanieSpo;
use Parp\SsfzBundle\Entity\Slownik\Wojewodztwo;
use Parp\SsfzBundle\Entity\Slownik\FormaPrawnaFunduszu;
use Parp\SsfzBundle\Entity\Slownik\TakNie;
use Parp\SsfzBundle\Constraints\Nip;

/**
 * Typ formularza sprawozdania
 */
class AbstractSprawozdanieSpoType extends AbstractType
{
    /**
     * Buduje formularz do wypełniania sprawozdania
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @SuppressWarnings("unused")
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nazwaFunduszu', TextType::class, [
            'label'       => 'Nazwa Funduszu (Nazwa instytucji prowadzącej fundusz pożyczkowy)',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'nazwa funduszu',
                'maxlength'   => 250,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new Length([
                    'max'        => '250',
                    'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} znaków.',
                ]),
            ],
        ]);

        $builder->add('nip', TextType::class, [
            'label'       => 'NIP',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'NIP',
                'maxlength'   => 10,
                'class'       => 'ssfz-digits',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new Nip(),
            ],
        ]);

        $builder->add('krs', TextType::class, [
            'label'    => 'KRS',
            'required' => false,
            'attr'     => [
                'placeholder' => 'KRS',
                'maxlength'   => 10,
                'class'       => 'ssfz-digits',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new Regex([
                    'message' => 'Niepoprawny format KRS',
                    'pattern' => '/^[0-9]{10}$/',
                ]),
            ],
        ]);

        $builder->add('wojewodztwo', EntityType::class, [
            'label'         => 'Województwo',
            'class'         => Wojewodztwo::class,
            'choice_label'  => 'nazwa',
            'required'      => false,
            'placeholder'   => '',
            'query_builder' => function (EntityRepository $repository) {
                return $repository
                    ->createQueryBuilder('w')
                    ->orderBy('w.id', 'ASC')
                ;
            },
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('miejscowosc', TextType::class, [
            'label'       => 'Miejscowość',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'Miejscowość',
                'maxlength'   => 100,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('ulica', TextType::class, [
            'label'       => 'Ulica',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'Ulica',
                'maxlength'   => 100,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('budynek', TextType::class, [
            'label'       => 'Nr budynku',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'nr budynku',
                'maxlength'   => 10,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('lokal', TextType::class, [
            'label'       => 'Nr lokalu',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'nr lokalu',
                'maxlength'   => 10,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('kodPocztowy', TextType::class, [
            'label'       => 'Kod pocztowy',
            'required'    => false,
            'attr'        => [
                'placeholder' => '',
                'maxlength'   => 6,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new Regex([
                    'message' => 'Niepoprawny format kodu pocztowego',
                    'pattern' => '/^[0-9]{2}\-[0-9]{3}$/',
                ]),
            ],
        ]);

        $builder->add('poczta', TextType::class, [
            'label'       => 'Poczta',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'poczta',
                'maxlength'   => 100,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('telStacjonarny', TextType::class, [
            'label'       => 'Telefon stacjonarny',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'nr tel.',
                'maxlength'   => 15,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('telKomorkowy', TextType::class, [
            'label'    => 'Telefon komórkowy',
            'required' => false,
            'attr'     => [
                'placeholder' => 'nr tel.',
                'maxlength'   => 15,
            ],
        ]);

        $builder->add('email', TextType::class, [
            'label'       => 'Adres e-mail',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'e-mail',
                'maxlength'   => 250,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new Email([
                    'message' => 'Nieprawidłowy format e-mail',
                ]),
            ],
        ]);

        $builder->add('fax', TextType::class, [
            'label'       => 'Fax',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'fax',
                'maxlength'   => 15,
            ],
        ]);

        $builder->add(
            'rokZalozenia',
            TextType::class,
            array(
                'label' => 'Rok założenia',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'rok',
                    'maxlength' => 4,
                ),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Należy wypełnić pole',
                    ]),
                ],
            )
        );

        $builder->add('formaPrawnaFunduszu', EntityType::class, [
            'label'         => 'Forma prawna',
            'class'         => FormaPrawnaFunduszu::class,
            'choice_label'  => 'nazwa',
            'required'      => false,
            'placeholder'   => '',
            'query_builder' => function (EntityRepository $repository) {
                return $repository
                    ->createQueryBuilder('f')
                    ->orderBy('f.id', 'ASC')
                ;
            },
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('czyNieDzialaDlaZysku', EntityType::class, [
            'label'       => 'Fundusz nie działa dla zysku',
            'class'       => TakNie::class,
            'required'    => false,
            'expanded'    => true,
            'placeholder' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('czyOdpowiedniPotencjalEkonomiczny', EntityType::class, [
            'label'       => 'Fundusz posiada odpowiedni potencjał ekonomiczny',
            'class'       => TakNie::class,
            'required'    => false,
            'expanded'    => true,
            'placeholder' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('czyPracownicyPosiadajaKwalifikacje', EntityType::class, [
            'label'       => 'Fundusz zatrudnia pracowników posiadających odpowiednie kwalifikacje',
            'class'       => TakNie::class,
            'required'    => false,
            'expanded'    => true,
            'placeholder' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('inne', TextareaType::class, [
            'label'       => 'Inne (nazwa definiowana przez fundusz)',
            'required'    => false,
            'attr'        => [
                'placeholder' => 'inne',
                'maxlength'   => 1000,
            ],
            'constraints' => [
                new Length([
                    'max'        => '1000',
                    'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} znaków.',
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
            'allow_extra_fields' => true,
            'lata'               => null,
            'showRemarks'        => null,
            'attr'               => [
                'novalidate' => 'novalidate',
            ],
            'program'           => null,
        ]);
    }
}
