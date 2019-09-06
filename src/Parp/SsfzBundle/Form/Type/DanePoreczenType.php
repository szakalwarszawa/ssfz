<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Parp\SsfzBundle\Entity\DanePoreczen;

/**
 * Formularz do wprowadzania danych o poręczeniach.
 */
class DanePoreczenType extends AbstractType
{
    const DECIMAL_FIELDS = [
        // Według typu przedsiębiorstwa
        'kwotaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw',
        // Według przeznaczenia
        'kwotaPoreczenNaKredytObrotowyDo50000Pln',
        'kwotaPoreczenNaKredytObrotowyOd50001Do100000Pln',
        'kwotaPoreczenNaKredytObrotowyOd100001Do500000Pln',
        'kwotaPoreczenNaKredytObrotowyOd500001Pln',
        'kwotaPoreczenNaKredytInwestycyjnyDo50000Pln',
        'kwotaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln',
        'kwotaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln',
        'kwotaPoreczenNaKredytInwestycyjnyOd500001Pln',
        'kwotaPoreczenNaPozyczkeObrotowaDo50000Pln',
        'kwotaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln',
        'kwotaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln',
        'kwotaPoreczenNaPozyczkeObrotowaOd500001Pln',
        'kwotaPoreczenNaPozyczkeInwestycyjnaDo50000Pln',
        'kwotaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln',
        'kwotaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln',
        'kwotaPoreczenNaPozyczkeInwestycyjnaOd500001Pln',
        'kwotaPoreczenPozostalychDo50000Pln',
        'kwotaPoreczenPozostalychOd50001Do100000Pln',
        'kwotaPoreczenPozostalychOd100001Do500000Pln',
        'kwotaPoreczenPozostalychOd500001Pln',
        'kwotaWadiowPoreczenPozostalychDo50000Pln',
        'kwotaWadiowPoreczenPozostalychOd50001Do100000Pln',
        'kwotaWadiowPoreczenPozostalychOd100001Do500000Pln',
        'kwotaWadiowPoreczenPozostalychOd500001Pln',
        // Według działania poręczeniobiorcy
        'kwotaPoreczenDo50000PlnNaDzialaniaProdukcyjne',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne',
        'kwotaPoreczenOd500001PlnNaDzialaniaProdukcyjne',
        'kwotaPoreczenDo50000PlnNaDzialaniaHandlowe',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe',
        'kwotaPoreczenOd500001PlnNaDzialaniaHandlowe',
        'kwotaPoreczenDo50000PlnNaDzialaniaUslugowe',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe',
        'kwotaPoreczenOd500001PlnNaDzialaniaUslugowe',
        'kwotaPoreczenDo50000PlnNaDzialaniaBudownicze',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze',
        'kwotaPoreczenOd500001PlnNaDzialaniaBudownicze',
        'kwotaPoreczenDo50000PlnNaDzialaniaInne',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaInne',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaInne',
        'kwotaPoreczenOd500001PlnNaDzialaniaInne',
        'kwotaPoreczenDo50000PlnDlaBankow',
        'kwotaPoreczenOd50001Do100000PlnDlaBankow',
        'kwotaPoreczenOd100001Do500000PlnDlaBankow',
        'kwotaPoreczenOd500001PlnDlaBankow',
        'kwotaPoreczenDo50000PlnDlaFunduszyPozyczkowych',
        'kwotaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych',
        'kwotaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych',
        'kwotaPoreczenOd500001PlnDlaFunduszyPozyczkowych',
        'kwotaPoreczenDo50000PlnDlaInnychPodmiotow',
        'kwotaPoreczenOd50001Do100000PlnDlaInnychPodmiotow',
        'kwotaPoreczenOd100001Do500000PlnDlaInnychPodmiotow',
        'kwotaPoreczenOd500001PlnDlaInnychPodmiotow',
        // Poręczenia wypłacone
        'kwotaPoreczenWyplaconychDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenWyplaconychNaKredytObrotowy',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy',
        'kwotaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy',
        'kwotaPoreczenWyplaconychNaKredytInwestycyjny',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny',
        'kwotaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny',
        'kwotaPoreczenWyplaconychNaPozyczkeObrotowa',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa',
        'kwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa',
        'kwotaPoreczenWyplaconychNaPozyczkeInwestycyjna',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna',
        'kwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna',
        'kwotaPoreczenPozostalychWyplaconych',
        'kwotaPoreczenPozostalychWyplaconychCzesciowoSplaconych',
        'kwotaPoreczenPozostalychWyplaconychCalkowicieSplaconych',
        'kwotaPoreczenPozostalychWyplaconychNieodzyskanych',
        'kwotaWadiowPoreczenPozostalychWyplaconych',
        'kwotaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych',
        'kwotaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych',
        'kwotaWadiowPoreczenPozostalychWyplaconychNieodzyskanych',
        'kwotaPoreczenWyplaconychNaDzialaniaProdukcyjne',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne',
        'kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne',
        'kwotaPoreczenWyplaconychNaDzialaniaHandlowe',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe',
        'kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe',
        'kwotaPoreczenWyplaconychNaDzialaniaUslugowe',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe',
        'kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe',
        'kwotaPoreczenWyplaconychNaDzialaniaBudownicze',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze',
        'kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze',
        'kwotaPoreczenWyplaconychNaDzialaniaInne',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne',
        'kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne',
        'kwotaPoreczenWyplaconychDlaBankow',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychDlaBankow',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychDlaBankow',
        'kwotaPoreczenWyplaconychNieodzyskanychDlaBankow',
        'kwotaPoreczenWyplaconychDlaFunduszyPozyczkowych',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych',
        'kwotaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych',
        'kwotaPoreczenWyplaconychDlaInnychPodmiotow',
        'kwotaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow',
        'kwotaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow',
        'kwotaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow',
    ];

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($options['action_url']);
        $this->addIntegerFields($builder, $options);
        $this->addDecimalFields($builder, $options);
    }

    /**
     * Dodaje zestaw pól na wartości liczbowe całkowite dodatni z zakresu 0-99999.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    private function addIntegerFields(FormBuilderInterface $builder, array $options)
    {
        $constraints = [
            new Assert\NotBlank([
                'message' => 'Należy wypełnić pole',
            ]),
            new Assert\Type([
                'type'    => 'integer',
                'message' => 'Pole może zawierać tylko liczby całkowite',
            ]),
            new Assert\Range([
                'min'            => 0,
                'max'            => 99999,
                'invalidMessage' => 'Pole może zawierać wartości od 0 do 99999',
            ]),
        ];

        $fields = [
            // Według typu przedsiębiorstwa
            'liczbaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw',
            // Według przeznaczenia
            'liczbaPoreczenNaKredytObrotowyDo50000Pln',
            'liczbaPoreczenNaKredytObrotowyOd50001Do100000Pln',
            'liczbaPoreczenNaKredytObrotowyOd100001Do500000Pln',
            'liczbaPoreczenNaKredytObrotowyOd500001Pln',
            'liczbaPoreczenNaKredytInwestycyjnyDo50000Pln',
            'liczbaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln',
            'liczbaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln',
            'liczbaPoreczenNaKredytInwestycyjnyOd500001Pln',
            'liczbaPoreczenNaPozyczkeObrotowaDo50000Pln',
            'liczbaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln',
            'liczbaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln',
            'liczbaPoreczenNaPozyczkeObrotowaOd500001Pln',
            'liczbaPoreczenNaPozyczkeInwestycyjnaDo50000Pln',
            'liczbaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln',
            'liczbaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln',
            'liczbaPoreczenNaPozyczkeInwestycyjnaOd500001Pln',
            'liczbaPoreczenPozostalychDo50000Pln',
            'liczbaPoreczenPozostalychOd50001Do100000Pln',
            'liczbaPoreczenPozostalychOd100001Do500000Pln',
            'liczbaPoreczenPozostalychOd500001Pln',
            'liczbaWadiowPoreczenPozostalychDo50000Pln',
            'liczbaWadiowPoreczenPozostalychOd50001Do100000Pln',
            'liczbaWadiowPoreczenPozostalychOd100001Do500000Pln',
            'liczbaWadiowPoreczenPozostalychOd500001Pln',
            // Według działania poręczeniobiorcy
            'liczbaPoreczenDo50000PlnNaDzialaniaProdukcyjne',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne',
            'liczbaPoreczenOd500001PlnNaDzialaniaProdukcyjne',
            'liczbaPoreczenDo50000PlnNaDzialaniaHandlowe',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe',
            'liczbaPoreczenOd500001PlnNaDzialaniaHandlowe',
            'liczbaPoreczenDo50000PlnNaDzialaniaUslugowe',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe',
            'liczbaPoreczenOd500001PlnNaDzialaniaUslugowe',
            'liczbaPoreczenDo50000PlnNaDzialaniaBudownicze',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze',
            'liczbaPoreczenOd500001PlnNaDzialaniaBudownicze',
            'liczbaPoreczenDo50000PlnNaDzialaniaInne',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaInne',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaInne',
            'liczbaPoreczenOd500001PlnNaDzialaniaInne',
            'liczbaPoreczenDo50000PlnDlaBankow',
            'liczbaPoreczenOd50001Do100000PlnDlaBankow',
            'liczbaPoreczenOd100001Do500000PlnDlaBankow',
            'liczbaPoreczenOd500001PlnDlaBankow',
            'liczbaPoreczenDo50000PlnDlaFunduszyPozyczkowych',
            'liczbaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych',
            'liczbaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych',
            'liczbaPoreczenOd500001PlnDlaFunduszyPozyczkowych',
            'liczbaPoreczenDo50000PlnDlaInnychPodmiotow',
            'liczbaPoreczenOd50001Do100000PlnDlaInnychPodmiotow',
            'liczbaPoreczenOd100001Do500000PlnDlaInnychPodmiotow',
            'liczbaPoreczenOd500001PlnDlaInnychPodmiotow',
            // Poręczenia wypłacone
            'liczbaPoreczenWyplaconychDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenWyplaconychNaKredytObrotowy',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy',
            'liczbaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy',
            'liczbaPoreczenWyplaconychNaKredytInwestycyjny',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny',
            'liczbaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny',
            'liczbaPoreczenWyplaconychNaPozyczkeObrotowa',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa',
            'liczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa',
            'liczbaPoreczenWyplaconychNaPozyczkeInwestycyjna',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna',
            'liczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna',
            'liczbaPoreczenPozostalychWyplaconych',
            'liczbaPoreczenPozostalychWyplaconychCzesciowoSplaconych',
            'liczbaPoreczenPozostalychWyplaconychCalkowicieSplaconych',
            'liczbaPoreczenPozostalychWyplaconychNieodzyskanych',
            'liczbaWadiowPoreczenPozostalychWyplaconych',
            'liczbaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych',
            'liczbaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych',
            'liczbaWadiowPoreczenPozostalychWyplaconychNieodzyskanych',
            'liczbaPoreczenWyplaconychNaDzialaniaProdukcyjne',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne',
            'liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne',
            'liczbaPoreczenWyplaconychNaDzialaniaHandlowe',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe',
            'liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe',
            'liczbaPoreczenWyplaconychNaDzialaniaUslugowe',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe',
            'liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe',
            'liczbaPoreczenWyplaconychNaDzialaniaBudownicze',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze',
            'liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze',
            'liczbaPoreczenWyplaconychNaDzialaniaInne',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne',
            'liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne',
            'liczbaPoreczenWyplaconychDlaBankow',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychDlaBankow',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychDlaBankow',
            'liczbaPoreczenWyplaconychNieodzyskanychDlaBankow',
            'liczbaPoreczenWyplaconychDlaFunduszyPozyczkowych',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych',
            'liczbaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych',
            'liczbaPoreczenWyplaconychDlaInnychPodmiotow',
            'liczbaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow',
            'liczbaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow',
            'liczbaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow',
            // Poręczenia udzielone dla
            'liczbaWspolpracujacychBankow',
            'liczbaWspolpracujacychFunduszyPozyczkowych',
            'liczbaInnychPodmiotowWspolpracujacych',
        ];

        foreach ($fields as $field) {
            $builder->add($field, IntegerType::class, [
                'label'       => false,
                'attr'        => [
                    'class' => 'uint-5',
                ],
                'constraints' => $constraints,
            ]);
        }
    }

    /**
     * Dodaje zestaw pól na wartości liczbowe dziesiętne dodatnie z zakresu 0-999999999.99.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
      *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    private function addDecimalFields(FormBuilderInterface $builder, array $options)
    {
        $constraints = [
            new Assert\NotBlank([
                'message' => 'Należy wypełnić pole',
            ]),
            new Assert\Regex([
                'pattern' => '/^((([1-9])([\d\ ])*)|0)\.([\d]){2,2}$/',
                'message' => 'Pole może zawierać tylko liczby dziesiętne z zakresu 0.00 - 999 999 999.99',
            ]),
        ];

        foreach (self::DECIMAL_FIELDS as $field) {
            $builder->add($field, TextType::class, [
                'label'       => false,
                'attr'        => [
                    'class' => 'decimal-11-2',
                ],
                'constraints' => $constraints,
                'by_reference' => false,
            ]);
        }
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'form_dane_poreczen';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DanePoreczen::class,
        ]);

        $resolver->setRequired([
            'action_url',
        ]);

        $resolver->setAllowedTypes('action_url', 'string');
    }
}
