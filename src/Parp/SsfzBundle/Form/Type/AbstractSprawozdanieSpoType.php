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
use Parp\SsfzBundle\Entity\Wojewodztwo;
use Parp\SsfzBundle\Entity\Slownik\FormaPrawna;
use Parp\SsfzBundle\Entity\Slownik\TakNie;
use Parp\SsfzBundle\Constraints\Nip;

/**
 * Typ formularza sprawozdania
 */
class AbstractSprawozdanieSpoType extends AbstractType
{
    /**
     * Informuje, czy dany formularz dotyczy pożyczek.
     *
     * @var boolean
     */
    protected $czyPozyczkowy = false;

    /**
     * Buduje formularz do wypełniania sprawozdania
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @SuppressWarnings("unused")
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'nazwaFunduszu',
            TextType::class,
            array(
                'label' => 'Nazwa Funduszu (Nazwa instytucji prowadzącej fundusz pożyczkowy)',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'nazwa funduszu',
                    'maxlength' => 250,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    ),
                    new Length(
                        array('max' => '250', 'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} znaków.')
                    ),
                )
            )
        );

        $builder->add(
            'nip',
            TextType::class,
            array(
                'label' => 'NIP',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'NIP',
                    'maxlength' => 10,
                    'class' => 'ssfz-digits',
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    ),
                    new Nip()
                )
            )
        );

        $builder->add(
            'krs',
            TextType::class,
            array(
                'label' => 'KRS',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'KRS',
                    'maxlength' => 10,
                    'class' => 'ssfz-digits',
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    ),
                    new Regex(
                        array('message' => 'Niepoprawny format KRS', 'pattern' => '/^[0-9]{10}$/')
                    )
                )
            )
        );

        $builder->add(
            'wojewodztwo',
            EntityType::class,
            array(
                'label'         => 'Województwo',
                'class'         => Wojewodztwo::class,
                'choice_label'  => 'nazwa',
                'required'      => false,
                'placeholder'   => '',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo
                        ->createQueryBuilder('w')
                        ->orderBy('w.id', 'ASC')
                    ;
                },
                'constraints'   => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'miejscowosc',
            TextType::class,
            array(
                'label' => 'Miejscowość',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Miejscowość',
                    'maxlength' => 100,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'ulica',
            TextType::class,
            array(
                'label' => 'Ulica',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Ulica',
                    'maxlength' => 100,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'budynek',
            TextType::class,
            array(
                'label' => 'Nr budynku',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'nr budynku',
                    'maxlength' => 10,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'lokal',
            TextType::class,
            array(
                'label' => 'Nr lokalu',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'nr lokalu',
                    'maxlength' => 10,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'kodPocztowy',
            TextType::class,
            array(
                'label' => 'Kod pocztowy',
                'required' => false,
                'attr' => array(
                    'placeholder' => '',
                    'maxlength' => 6,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    ),
                    new Regex(
                        array('message' => 'Niepoprawny format kodu pocztowego', 'pattern' => '/^[0-9]{2}\-[0-9]{3}$/')
                    )
                )
            )
        );

        $builder->add(
            'poczta',
            TextType::class,
            array(
                'label' => 'Poczta',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'poczta',
                    'maxlength' => 100,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'telStacjonarny',
            TextType::class,
            array(
                'label' => 'Telefon stacjonarny',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'nr tel.',
                    'maxlength' => 15,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'telKomorkowy',
            TextType::class,
            array(
                'label' => 'Telefon komórkowy',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'nr tel.',
                    'maxlength' => 15,
                ),
            )
        );

        $builder->add(
            'email',
            TextType::class,
            array(
                'label' => 'Adres e-mail',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'e-mail',
                    'maxlength' => 250,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    ),
                    new Email(
                        array('message' => 'Nieprawidłowy format e-mail')
                    )
                )
            )
        );

        $builder->add(
            'fax',
            TextType::class,
            array(
                'label' => 'Fax',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'fax',
                    'maxlength' => 15,
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

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
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'formaPrawna',
            EntityType::class,
            array(
                'label'         => 'Forma prawna',
                'class'         => FormaPrawna::class,
                'choice_label'  => 'nazwa',
                'required'      => false,
                'placeholder'   => '',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo
                        ->createQueryBuilder('f')
                        ->orderBy('f.id', 'ASC')
                    ;
                },
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $label = $this->czyPozyczkowy
            ? 'Data zatwierdzenia zasad gospodarowania funduszem pożyczkowym przez PARP'
            : 'Data zatwierdzenia zasad gospodarowania funduszem poręczeniowym przez PARP'
        ;
        $builder->add(
            'dataZatwierdzeniaZasadGospodarowania',
            DateType::class,
            [
                'label'      => $label,
                'required' => false,
                'html5'      => false,
                'widget'     => 'single_text',
                'format'     => 'yyyy-MM-dd',
                    'mapped' => true,
                'attr' => array(
                    'class' => 'js-datepicker width-date',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd'
                ),
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    ),
                )
            ]
        );

        $builder->add(
            'czyNieDzialaDlaZysku',
            EntityType::class,
            array(
                'label'     => 'Fundusz nie działa dla zysku',
                'class'     => TakNie::class,
                'required'  => false,
                'expanded' => true,
                'placeholder' => false,
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $label = $this->czyPozyczkowy
            ? 'Fundusz udziela pożyczek po analizie ryzyka niespłacenia i po ustanowieniu zabezpieczenia'
            : 'Poręczenia są udzielane po przeprowadzeniu analizy ryzyka'
        ;
        $builder->add(
            'czyUdzielaPoAnalizieRyzyka',
            EntityType::class,
            array(
                'label'     => $label,
                'class'     => TakNie::class,
                'required'  => false,
                'expanded' => true,
                'placeholder' => false,
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $label = $this->czyPozyczkowy
            ? 'Pożyczki udzielane są przedsiębiorcom nie będącym w trudniej sytuacji'
            : 'Poręczenia udzielane są przedsiębiorcom nie będącym w trudniej sytuacji'
        ;
        $builder->add(
            'czyNieWTrudnejSytuacji',
            EntityType::class,
            array(
                'label'     => $label,
                'class'     => TakNie::class,
                'required'  => false,
                'expanded' => true,
                'placeholder' => false,
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'czyOdpowiedniPotencjalEkonomiczny',
            EntityType::class,
            array(
                'label'     => 'Fundusz posiada odpowiedni potencjał ekonomiczny',
                'class'     => TakNie::class,
                'required'  => false,
                'expanded' => true,
                'placeholder' => false,
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'czyPracownicyPosiadajaKwalifikacje',
            EntityType::class,
            array(
                'label'     => 'Fundusz zatrudnia pracowników posiadających odpowiednie kwalifikacje',
                'class'     => TakNie::class,
                'required'  => false,
                'expanded' => true,
                'placeholder' => false,
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'inne',
            TextareaType::class,
            array(
                'label' => 'Inne (nazwa definiowana przez fundusz)',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'inne',
                    'maxlength' => 1000,
                ),
                'constraints' => array(
                    new Length(
                        array('max' => '1000', 'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} znaków.')
                    ),
                )
            )
        );

//        $builder->add(
//            'zapisz',
//            SubmitType::class,
//                array(
//                    'label' => 'Zapisz',
//                    'attr' => array(
//                        'class' => 'btn btn-primary pull-right width-short',
//                    ),
//            )
//        );
    }

    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AbstractSprawozdanieSpo::class,
            'allow_extra_fields' => true,
            'okresy' => null, // nieużywane, tylko dla zgodności ze starym kodem
        ));
    }
}
