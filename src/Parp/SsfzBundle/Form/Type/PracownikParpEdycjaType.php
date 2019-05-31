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
 */
class PracownikParpEdycjaType extends AbstractType
{
    /**
     * Buduje formularz
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return Response
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('login', TextType::class, [
            'label' => 'Login',
            'disabled' => true,
        ]);

        $builder->add('rola', EntityType::class, [
            'class' => Rola::class,
            'property' => 'opis',
            'label' => 'Rola',
            'query_builder' => function (EntityRepository $er ) {
                return $er->createQueryBuilder('n')
                    ->where('n.id not in (:marray)')
                    ->setParameter('marray', array('4'))
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
