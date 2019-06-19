<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\DanePozyczki;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;

/**
 * Repozytorium DanePozyczkiRepository.
 */
class DanePozyczkiRepository extends EntityRepository
{
    /**
     * Tworzy nowe dane pożyczki przypisane do sprawozdania.
     *
     * @param SprawozdaniePozyczkowe $sprawozdanie
     * @param bool $persist
     *
     * @return DanePozyczki
     */
    public function create(SprawozdaniePozyczkowe $sprawozdanie, $persist = false): DanePozyczki
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
     * @param SprawozdaniePozyczkowe $sprawozdanie
     *
     * @return array|DanePozyczki[]
     */
    public function findBySprawozdanie(SprawozdaniePozyczkowe $sprawozdanie): array
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
            'liczba_pozyczek_razem' => $result->getLiczbaPozyczekDlaWszystkichPrzeznaczenOgolem(),
            'liczba_pozyczek_na_cele_obrotowe' => $result->getLiczbaPozyczekObrotowychOgolem(),
            'liczba_pozyczek_na_cele_inwestycyjne' => $result->getLiczbaPozyczekInwestycyjnychOgolem(),
            'liczba_pozyczek_na_cele_obrotowo_inwestycyjne' => $result->getLiczbaPozyczekInwestycyjnoObrotowychOgolem(),
            'kwota_pozyczek_razem' => $result->getKwotaPozyczekDlaWszystkichPrzeznaczenOgolem(),
            'kwota_pozyczek_na_cele_obrotowe' => $result->getKwotaPozyczekInwestycyjnychOgolem(),
            'kwota_pozyczek_na_cele_inwestycyjne' => $result->getKwotaPozyczekInwestycyjnoObrotowychOgolem(),
            'kwota_pozyczek_na_cele_obrotowo_inwestycyjne' => $result->getKwotaPozyczekObrotowychOgolem(),
        ];

        $pozyczkiWgDzialanosci = [
            'liczba_pozyczek_razem' => $result->getLiczbaPozyczekOgolemDlaWszystkichSektorowDzialan(),
            'liczba_pozyczek_dzialania_produkcyjne' => $result->getLiczbaPozyczekNaDzialaniaProdykcyjneOgolem(),
            'liczba_pozyczek_dzialania_handlowe' => $result->getLiczbaPozyczekNaDzialaniaHandloweOgolem(),
            'liczba_pozyczek_dzialania_uslugowe' =>$result->getLiczbaPozyczekNaDzialaniaUslugoweOgolem(),
            'liczba_pozyczek_dzialania_budownicze' => $result->getLiczbaPozyczekNaDzialaniaBudowniczeOgolem(),
            'liczba_pozyczek_dzialania_rolnicze' => $result->getLiczbaPozyczekNaDzialaniaRolniczeOgolem(),
            'liczba_pozyczek_dzialania_inne' => $result->getLiczbaPozyczekNaDzialaniaInneOgolem(),
            'kwota_pozyczek_razem' => $result->getKwotaPozyczekOgolemDlaWszystkichSektorowDzialan(),
            'kwota_pozyczek_dzialania_produkcyjne' => $result->getKwotaPozyczekNaDzialaniaProdykcyjneOgolem(),
            'kwota_pozyczek_dzialania_handlowe' => $result->getKwotaPozyczekNaDzialaniaHandloweOgolem(),
            'kwota_pozyczek_dzialania_uslugowe' => $result->getKwotaPozyczekNaDzialaniaUslugoweOgolem(),
            'kwota_pozyczek_dzialania_budownicze' => $result->getKwotaPozyczekNaDzialaniaBudowniczeOgolem(),
            'kwota_pozyczek_dzialania_rolnicze' => $result->getKwotaPozyczekNaDzialaniaRolniczeOgolem(),
            'kwota_pozyczek_dzialania_inne' => $result->getKwotaPozyczekNaDzialaniaInneOgolem(),
        ];

        $pozyczkiWgWielkosciPrzedsiebiorstwa = [
            'liczba_pozyczek_razem' => $result->getLiczbaPozyczekDlaPrzedsiebiorstwOgolem(),
            'liczba_pozyczek_dla_mikro' => $result->getLiczbaPozyczekDlaMikroPrzedsiebiorstwOgolem(),
            'liczba_pozyczek_dla_malych' => $result->getLiczbaPozyczekDlaMalychPrzedsiebiorstwOgolem(),
            'liczba_pozyczek_dla_srednich' => $result->getLiczbaPozyczekDlaSrednichPrzedsiebiorstwOgolem(),
            'kwota_pozyczek_razem' => $result->getKwotaPozyczekDlaPrzedsiebiorstwOgolem(),
            'kwota_pozyczek_dla_mikro' => $result->getKwotaPozyczekDlaMikroPrzedsiebiorstwOgolem(),
            'kwota_pozyczek_dla_malych' => $result->getKwotaPozyczekDlaMalychPrzedsiebiorstwOgolem(),
            'kwota_pozyczek_dla_srednich' => $result->getKwotaPozyczekDlaSrednichPrzedsiebiorstwOgolem(),
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
