<?php
namespace Parp\SsfzBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Service\LdapDataService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Typ dla formularza rejestracj apracownika PARP
 */
class PracownikParpRejestracjaType extends AbstractType
{
    /**
     * Pobiera loginy pracowników PARP z LDAP
     *
     * Korzystając z LdapDataService pobiera loginy pracowników LDAP
     * tylko tych którzy nie dodani zostali do aplikacji.
     *
     * @param  LdapDataService $ldapService usługa LDAP
     * @param  type            $uzytkRepo   repozytorium użytkowników
     * @return string[] tablica loginów pracowników PARP
     */
    private function pobierzLoginyPracownikowParp(LdapDataService $ldapService, $uzytkRepo)
    {
        $pracownicy = $ldapService->getUzytkownikLdapListaZEmail();
        $wynik = array();
        foreach ($pracownicy as $p) {
            $login = $p->getLogin();
            $wynik[$login] = $login;
        }

        return $wynik;
    }

    /**
     * Buduje formularz
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     * @return Response
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //pole testowe, korzystające z powyżej metody
        $ldapService = $options['ssfz.service.ldap_data_service'];
        $uzytkRepo = $options['uzytk_repo'];
        $builder
            ->add(
                'login', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
                'label' => 'Pracownik',
                'choices' => $this->pobierzLoginyPracownikowParp($ldapService, $uzytkRepo),
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => '255']),
                    new Callback(
                        [
                        'callback' => function ($login, ExecutionContextInterface $context) use ($uzytkRepo) {
                            if ($uzytkRepo->loginIstnieje($login)) {
                                $context->buildViolation('Użytkownik o podanym loginie został już dodany')
                                ->atPath('login')
                                ->addViolation();
                            }
                        }]
                    )
                ]
                ]
            )
            ->add(
                'rola', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, [
                'class' => 'SsfzBundle:Rola',
                'property' => 'opis',
                'label' => 'Rola',
                'query_builder' => function (EntityRepository $er ) {
                    return $er->createQueryBuilder('n')
                        ->where('n.id not in (:marray)')
                        ->setParameter('marray', array('4')); //id roli beneficjenta
                },
                'constraints' => [
                    new NotBlank(),
                ]]
            );
    }

    /**
     * Opcje formularza
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('ssfz.service.ldap_data_service');
        $resolver->setRequired('uzytk_repo');
    }
}
