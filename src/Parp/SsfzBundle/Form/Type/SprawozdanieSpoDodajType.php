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
 * Typ formularza sprawozdania
 */
class SprawozdanieSpoDodajType extends AbstractType
{
    /**
     * @var CzestotliwoscSprawozdan
     */
    protected $czestotliwoscSprawozdan;
    
    /**
     * Buduje formularz do wypełniania sprawozdania
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->czestotliwoscSprawozdan = $builder->getData()->getCzestotliwoscSprawozdanWProgramie();
        
        $builder->add('numerUmowy', null, array(
            'label' => 'Numer umowy',
            'attr' => array('readonly' => true),
            'constraints' => array()
        ));

        $builder->add(
            'okres',
            EntityType::class,
            array(
                'label'         => 'Sprawozdanie za okres',
                'class'         => OkresSprawozdawczy::class,
                'choice_label'  => 'nazwa',
                'required'      => false,
                'empty_value'   => null,
                'query_builder' => function (EntityRepository $repo) {
                    return $repo
                        ->createQueryBuilder('o')
                        ->where('o.czestotliwoscSprawozdan = :czestotliwosc')
                        ->setParameter('czestotliwosc', $this->czestotliwoscSprawozdan)
                        ->orderBy('o.id', 'ASC')
                    ;
                },
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                ),
            )
        );

        $builder->add('rok', ChoiceType::class, array(
            'label' => 'Rok',
            'choices' => $options['okresy'],
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));
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
            'attr' => array('novalidate' => 'novalidate'),
            'showRemarks' => null,
            'okresy' => null,
            'allow_extra_fields' => true,
        ));
    }
}
