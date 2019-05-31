<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Service\LdapDataService;

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
     *
     * @return string[] tablica loginów pracowników PARP
     */
    private function pobierzLoginyPracownikowParp(LdapDataService $ldapService)
    {
        $pracownicy = $ldapService->getUzytkownikLdapListaZEmail();
        $wynik = [];
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
     * @param array $options
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ldapService = $options['ssfz.service.ldap_data_service'];
        $uzytkRepo = $options['uzytk_repo'];
        $builder->add('login', ChoiceType::class, [
            'label' => 'Pracownik',
            'choices' => $this->pobierzLoginyPracownikowParp($ldapService, $uzytkRepo),
            'constraints' => [
                new NotBlank(),
                new Length(['max' => '255']),
                new Callback([
                    'callback' => function ($login, ExecutionContextInterface $context) use ($uzytkRepo) {
                        if ($uzytkRepo->loginIstnieje($login)) {
                            $context->buildViolation('Użytkownik o podanym loginie został już dodany')
                            ->atPath('login')
                            ->addViolation();
                        }
                    }
                ])
            ]
        ]);

        $builder->add('rola', EntityType::class, [
            'class'         => 'SsfzBundle:Rola',
            'property'      => 'opis',
            'label'         => 'Rola',
            'query_builder' => function (EntityRepository $er) {
                $idRoliBeneficjenta = '4';

                return $er
                    ->createQueryBuilder('n')
                    ->where('n.id not in (:marray)')
                    ->setParameter('marray', [$idRoliBeneficjenta]);
            },
            'constraints' => [
                new NotBlank(),
            ]
        ]);
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
