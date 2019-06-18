<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\DanePozyczki;
use Parp\SsfzBundle\Entity\Sprawozdanie;

/**
 * Repozytorium DanePozyczkiRepository.
 */
class DanePozyczkiRepository extends EntityRepository
{
    /**
     * Tworzy nowe dane pożyczki przypisane do sprawozdania.
     *
     * @param Sprawozdanie $sprawozdanie
     * @param bool $persist
     *
     * @return DanePozyczki
     */
    public function create(Sprawozdanie $sprawozdanie, $persist = false): DanePozyczki
    {
        $danePozyczki = new DanePozyczki();
        $danePozyczki->setSprawozdanie($sprawozdanie);
        if ($persist) {
            $this->persist($danePozyczki);
        }

        return $danePozyczki;
    }

    /**
     * Usuwa dane pożyczki.
     *
     * @param DanePozyczki $danepozyczki
     *
     * @return bool
     */
    public function delete(DanePozyczki $danePozyczki)
    {
        $this->_em->remove($danePozyczki);
        $this->_em->flush($danePozyczki);

        return true;
    }

    /**
     * Utrwala dane pożyczki.
     *
     * @param DanePozyczki $danePozyczki
     *
     * @return DanePozyczki
     */
    public function persist(DanePozyczki $danePozyczki)
    {
        $this->_em->persist($danePozyczki);
        $this->_em->flush($danePozyczki);

        return $danePozyczki;
    }

    /**
     * Znajduje dane pożyczek przypisane do zadanego sprawozdania.
     *
     * @param Sprawozdanie $sprawozdanie
     *
     * @return array|DanePozyczki[]
     */
    public function findBySprawozdanie(Sprawozdanie $sprawozdanie): array
    {
        $idSprawozdania = $sprawozdanie->getId();

        return $this->findByIdSprawozdania($idSprawozdania);
    }

    /**
     * Znajduje dane pożyczek przypisane do zadanego ID sprawozdania.
     *
     * @param int $idSprawozdania
     *
     * @return null|DanePozyczki
     */
    public function findOneByIdSprawozdania(int $idSprawozdania): ?DanePozyczki
    {
        $result = $this
            ->createQueryBuilder('dp')
            ->leftJoin('dp.sprawozdanie', 's')
            ->where('s.id = :idSprawozdania')
            ->setParameter('idSprawozdania', $idSprawozdania)
            ->getQuery()
            ->getResult()
        ;

        return (count($result) > 0) ? $result[0] : null;
    }

    /**
     * Znajduje dane pożyczek przypisane do zadanego ID sprawozdania.
     *
     * @param int $idSprawozdania
     *
     * @return null|array
     */
    public function findDaneZagregowaneByIdSprawozdania(int $idSprawozdania): ?array
    {
        $result = $this->findOneByIdSprawozdania($idSprawozdania);
        if (null === $result) {
            return null;
        }

        $pozyczkiWgPrzeznaczenia = [
            'liczba_pozyczek_razem' => $result->getLiczbaPozyczekOgolemDlaWszystkichSektorowDzialan(),
            'liczba_pozyczek_na_cele_obrotowe' => $result->getLiczbaPozyczekObrotowychOgolem(),
            'liczba_pozyczek_na_cele_inwestycyjne' => $result->getLiczbaPozyczekInwestycyjnychOgolem(),
            'liczba_pozyczek_na_cele_obrotowo_inwestycyjne' => $result->getLiczbaPozyczekInwestycyjnoObrotowychOgolem(),
            'kwota_pozyczek_razem' => $result->getKwotaPozyczekObrotowychOgolem(),
            'kwota_pozyczek_na_cele_obrotowe' => $result->getKwotaPozyczekInwestycyjnychOgolem(),
            'kwota_pozyczek_na_cele_inwestycyjne' => $result->getKwotaPozyczekInwestycyjnoObrotowychOgolem(),
            'kwota_pozyczek_na_cele_obrotowo_inwestycyjne' => $result->getKwotaPozyczekObrotowychOgolem(),
        ];

/*
        'liczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekDo10000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd300001PlnNaDzialaniaHandlowe',
        'liczbaPozyczekDo10000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd300001PlnNaDzialaniaUslugowe',
        'liczbaPozyczekDo10000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd300001PlnNaDzialaniaBudownicze',
        'liczbaPozyczekDo10000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd300001PlnNaDzialaniaRolnicze',
        'liczbaPozyczekDo10000PlnNaDzialaniaInne',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne',
        'liczbaPozyczekOd300001PlnNaDzialaniaInne',
*/

        $pozyczkiWgDzialanosci = [
            'liczba_pozyczek_razem' => 0,
            'liczba_pozyczek_dzialania_produkcyjne' => 0,
            'liczba_pozyczek_dzialania_handlowe' => 0,
            'liczba_pozyczek_dzialania_uslugowe' => 0,
            'liczba_pozyczek_dzialania_budownicze' => 0,
            'liczba_pozyczek_dzialania_rolnicze' => 0,
            'liczba_pozyczek_dzialania_inne' => 0,
            'kwota_pozyczek_razem' => '0.00',
            'kwota_pozyczek_dzialania_produkcyjne' => '0.00',
            'kwota_pozyczek_dzialania_handlowe' => '0.00',
            'kwota_pozyczek_dzialania_uslugowe' => '0.00',
            'kwota_pozyczek_dzialania_budownicze' => '0.00',
            'kwota_pozyczek_dzialania_rolnicze' => '0.00',
            'kwota_pozyczek_dzialania_inne' => '0.00',
        ];

        $pozyczkiWgWielkosciPrzedsiebiorstwa = [
            'liczba_pozyczek_razem' => $result->getLiczbaPozyczekOgolemDlaPrzedsiebiorstw(),
            'liczba_pozyczek_dla_mikro' => $result->getLiczbaPozyczekOgolemDlaMikroPrzedsiebiorstw(),
            'liczba_pozyczek_dla_malych' => $result->getLiczbaPozyczekOgolemDlaMalychPrzedsiebiorstw(),
            'liczba_pozyczek_dla_srednich' => $result->getLiczbaPozyczekOgolemDlaSrednichPrzedsiebiorstw(),
            'kwota_pozyczek_razem' => $result->getKwotaPozyczekOgolemDlaPrzedsiebiorstw(),
            'kwota_pozyczek_dla_mikro' => $result->getKwotaPozyczekOgolemDlaMikroPrzedsiebiorstw(),
            'kwota_pozyczek_dla_malych' => $result->getKwotaPozyczekOgolemDlaMalychPrzedsiebiorstw(),
            'kwota_pozyczek_dla_srednich' => $result->getKwotaPozyczekOgolemDlaSrednichPrzedsiebiorstw(),
        ];


        $sprawozdanie = [
            'id_umowy' => $result->getSprawozdanie()->getUmowaId(),
            'numer_umowy' => $result->getSprawozdanie()->getNumerUmowy(),
            'okres' => $result->getSprawozdanie()->getOkres(),
            'rok' => $result->getSprawozdanie()->getRok(),
        ];

        $daneZagregowane = [
            'sprawozdanie' => $sprawozdanie,
            'pozyczki_wg_przeznaczenia' => $pozyczkiWgPrzeznaczenia,
            'pozyczki_wg_dzialanosci' => $pozyczkiWgDzialanosci,
            'pozyczki_wg_wielkosci_przedsiebiorstwa' => $pozyczkiWgWielkosciPrzedsiebiorstwa,
        ];

        return $daneZagregowane;
    }
}
