<?php
namespace Parp\SsfzBundle\Form\Type;

use Parp\SsfzBundle\Entity\Beneficjent;
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

/**
 * Typ formularza sprawozdania
 */
class SprawozdanieType extends AbstractType
{

    /**
     * Buduje formularz do wypełniania sprawozdania
     * 
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $this->showRemarks = $options['showRemarks'];
        if ($this->showRemarks === true) {
            $builder->add('uwagi', TextareaType::class, array(
                'label' => 'Komentarz PARP',  
                'attr' => array('readonly' => true, 'rows' => '5'),
                'constraints' => array( )
            ));
        }
        if ($this->showRemarks === false || $this->showRemarks === null) {
            $builder->add('uwagi', HiddenType::class, array(
                'data' => '',
            ));
        }

        $builder->add(
            'numerUmowy', null, array(
            'label' => 'Numer umowy',
            'attr' => array('readonly' => true),
            'constraints' => array()
            )
        );
        $builder->add(
            'sprawozdaniaSpolek', CollectionType::class, array(
            'entry_type' => SprawozdanieSpolkiType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            )
        );
        $builder->add(
            'okres', ChoiceType::class, array(
            'label' => 'Sprawozdanie za okres',
            'choices' => array(
                '' => '',
                'styczeń - czerwiec' => 'styczeń - czerwiec',
                'lipiec - grudzień' => 'lipiec - grudzień',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'rok', ChoiceType::class, array(
            'label' => 'Rok',
            'choices' => $options['okresy'],
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'przekierowanie', HiddenType::class, array(
            'mapped' => false,
            )
        );
    }

    /**
     * Ustawia opcje konfiguracji
     * 
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \Parp\SsfzBundle\Entity\Sprawozdanie::class,
            'attr' => array('novalidate' => 'novalidate'),
            'showRemarks' => null,
            'okresy' => null,
            'allow_extra_fields' => true,
        ));
    }
}
