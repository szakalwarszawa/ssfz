<?php

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\Spolka;
use Parp\SsfzBundle\Entity\SpolkaHistoria;
use Parp\SsfzBundle\Entity\SpolkaHistoriaZmian;
use Carbon\Carbon;
use stdClass;

/**
 * SpolkaRepository
 */
class SpolkaRepository extends EntityRepository
{
    /**
     * persists spolka
     *
     * @param Spolka $spolka
     * @param Spolka $spolkaP
     * @param int    $idUzytkownika
     */
    public function persistSpolka(Spolka $spolka, $spolkaP, $idUzytkownika)
    {
        if (null === $spolka->getLp()) {
            $spolka->setLp($this->getNastepnaLp($spolka->getUmowa()->getId()));
        }
        if (1 !== $spolka->getZakonczona()) {
            $spolka->setDataWyjscia(null);
            $spolka->setKwDezinwestycji(null);
            $spolka->setZwrotInwestycji(null);
            $spolka->setNpv(null);
        }
        $this->_em->persist($spolka);

        $historia = new stdClass;
        $historia->dataZmiany = new Carbon('Europe/Warsaw');
        $historia->uzytkownikId = $idUzytkownika;
        $historia->umowaId = $spolka->getUmowa()->getId();
        $historia->lp = $spolka->getLp();
        $historia->nazwa = $spolka->getNazwa();
        $historia->forma = $spolka->getForma();
        $historia->siedzibaMiasto = $spolka->getSiedzibaMiasto();
        $historia->siedzibaWojewodztwo = $spolka->getSiedzibaWojewodztwo();
        $historia->branza = $spolka->getBranza();
        $historia->opis = $spolka->getOpis();
        $historia->dataPowolania = $spolka->getDataPowolania();
        $historia->krs = $spolka->getKrs();
        $historia->nip = $spolka->getNip();
        $historia->kwInwestycji = $spolka->getKwInwestycji();
        $historia->kwWsparcia = $spolka->getKwWsparcia();
        $historia->kwPryw = $spolka->getKwPryw();
        $historia->zakonczona = $spolka->getZakonczona();
        $historia->dataWyjscia = $spolka->getDataWyjscia();
        $historia->kwDezinwestycji = $spolka->getKwDezinwestycji();
        $historia->zwrotInwestycji = $spolka->getZwrotInwestycji();
        $historia->npv = $spolka->getNpv();
        $historia->udzialowcy = $spolka->getUdzialowcy();
        $historia->prezes = $spolka->getPrezes();
        $historia->zarzadPozostali = $spolka->getZarzadPozostali();
        $historia->lpP = null;
        $historia->nazwaP = null;
        $historia->formaP = null;
        $historia->siedzibaMiastoP = null;
        $historia->siedzibaWojewodztwoP = null;
        $historia->branzaP = null;
        $historia->opisP = null;
        $historia->dataPowolaniaP = null;
        $historia->krsP = null;
        $historia->nipP = null;
        $historia->kwInwestycjiP = null;
        $historia->kwWsparciaP = null;
        $historia->kwPrywP = null;
        $historia->zakonczonaP = null;
        $historia->dataWyjsciaP = null;
        $historia->kwDezinwestycjiP = null;
        $historia->zwrotInwestycjiP = null;
        $historia->npvP = null;
        $historia->udzialowcyP = null;
        $historia->prezesP = null;
        $historia->zarzadPozostaliP = null;

        if ($spolkaP) {
            $historia->lpP = $spolkaP->getLp();
            $historia->nazwaP = $spolkaP->getNazwa();
            $historia->formaP = $spolkaP->getForma();
            $historia->siedzibaMiastoP = $spolkaP->getSiedzibaMiasto();
            $historia->siedzibaWojewodztwoP = $spolkaP->getSiedzibaWojewodztwo();
            $historia->branzaP = $spolkaP->getBranza();
            $historia->opisP = $spolkaP->getOpis();
            $historia->dataPowolaniaP = $spolkaP->getDataPowolania();
            $historia->krsP = $spolkaP->getKrs();
            $historia->nipP = $spolkaP->getNip();
            $historia->kwInwestycjiP = $spolkaP->getKwInwestycji();
            $historia->kwWsparciaP = $spolkaP->getKwWsparcia();
            $historia->kwPrywP = $spolkaP->getKwPryw();
            $historia->zakonczonaP = $spolkaP->getZakonczona();
            $historia->dataWyjsciaP = $spolkaP->getDataWyjscia();
            $historia->kwDezinwestycjiP = $spolkaP->getKwDezinwestycji();
            $historia->zwrotInwestycjiP = $spolkaP->getZwrotInwestycji();
            $historia->npvP = $spolkaP->getNpv();
            $historia->udzialowcyP = $spolkaP->getUdzialowcy();
            $historia->prezesP = $spolkaP->getPrezes();
            $historia->zarzadPozostaliP = $spolkaP->getZarzadPozostali();
        }

        $this->_em->flush();
        $historia->spolkaId = $spolka->getId();
        $this->compareHistoricalData($historia);
    }

    /**
     * Porównuje dane historyczne
     *
     * @param SpolkaHistoria $historia
     */
    private function compareHistoricalData($historia)
    {
        if (strcmp($historia->nazwa, $historia->nazwaP)) {
            $this->createEntry('nazwa', $historia->nazwa, $historia->nazwaP, $historia);
        }
        if (strcmp($historia->forma, $historia->formaP)) {
            $this->createEntry('forma', $historia->forma, $historia->formaP, $historia);
        }
        if (strcmp($historia->siedzibaMiasto, $historia->siedzibaMiastoP)) {
            $this->createEntry('siedziba_miasto', $historia->siedzibaMiasto, $historia->siedzibaMiastoP, $historia);
        }
        if (strcmp($historia->siedzibaWojewodztwo, $historia->siedzibaWojewodztwoP)) {
            $this->createEntry('siedziba_wojewodztwo', $historia->siedzibaWojewodztwo, $historia->siedzibaWojewodztwoP, $historia);
        }
        if (strcmp($historia->branza, $historia->branzaP)) {
            $this->createEntry('branza', $historia->branza, $historia->branzaP, $historia);
        }
        if (strcmp($historia->opis, $historia->opisP)) {
            $this->createEntry('opis', $historia->opis, $historia->opisP, $historia);
        }
        if ($historia->dataPowolania != $historia->dataPowolaniaP) {
            $this->createEntry('data_powolania', $historia->dataPowolania != null ? $historia->dataPowolania->format('Y-m-d H:i:s') : null, $historia->dataPowolaniaP != null ? $historia->dataPowolaniaP->format('Y-m-d H:i:s') : null, $historia);
        }
        if (strcmp($historia->krs, $historia->krsP)) {
            $this->createEntry('krs', $historia->krs, $historia->krsP, $historia);
        }
        if (strcmp($historia->nip, $historia->nipP)) {
            $this->createEntry('nip', $historia->nip, $historia->nip, $historia);
        }
        if (strcmp($historia->kwInwestycji, $historia->kwInwestycjiP)) {
            $this->createEntry('kw_inwestycji', $historia->kwInwestycji, $historia->kwInwestycjiP, $historia);
        }
        if (strcmp($historia->kwWsparcia, $historia->kwWsparciaP)) {
            $this->createEntry('kw_wsparcia', $historia->kwWsparcia, $historia->kwWsparciaP, $historia);
        }
        if (strcmp($historia->kwPryw, $historia->kwPrywP)) {
            $this->createEntry('kw_pryw', $historia->kwPryw, $historia->kwPrywP, $historia);
        }
        if ($historia->zakonczona != $historia->zakonczonaP) {
            $this->createEntry('zakonczona', $historia->zakonczona, $historia->zakonczonaP, $historia);
        }
        if ($historia->dataWyjscia != $historia->dataWyjsciaP) {
            $this->createEntry('data_wyjscia', $historia->dataWyjscia != null ? $historia->dataWyjscia->format('Y-m-d H:i:s') : null, $historia->dataWyjsciaP != null ? $historia->dataWyjsciaP->format('Y-m-d H:i:s') : null, $historia);
        }
        if (strcmp($historia->kwDezinwestycji, $historia->kwDezinwestycjiP)) {
            $this->createEntry('kw_dezinwestycji', $historia->kwDezinwestycji, $historia->kwDezinwestycjiP, $historia);
        }
        if (strcmp($historia->zwrotInwestycji, $historia->zwrotInwestycjiP)) {
            $this->createEntry('zwrot_inwestycji', $historia->zwrotInwestycji, $historia->zwrotInwestycjiP, $historia);
        }
        if (strcmp($historia->npv, $historia->npvP)) {
            $this->createEntry('npv', $historia->npv, $historia->npvP, $historia);
        }
        if (strcmp($historia->udzialowcy, $historia->udzialowcyP)) {
            $this->createEntry('udzialowcy', $historia->udzialowcy, $historia->udzialowcyP, $historia);
        }
        if (strcmp($historia->prezes, $historia->prezesP)) {
            $this->createEntry('prezes', $historia->prezes, $historia->prezesP, $historia);
        }
        if (strcmp($historia->zarzadPozostali, $historia->zarzadPozostaliP)) {
            $this->createEntry('zarzad_pozostali', $historia->zarzadPozostali, $historia->zarzadPozostaliP, $historia);
        }
    }

    /**
     * Wykonanie wpisu w tabeli
     * sfz_spolka_historia_zmian
     *
     * @param string         $fieldName
     * @param string         $actual
     * @param string         $previous
     * @param SpolkaHistoria $historia
     */
    public function createEntry($fieldName, $actual, $previous, $historia)
    {
        $spolkaHistoriaZmian = new SpolkaHistoriaZmian();
        $spolkaHistoriaZmian->setSpolkaId($historia->spolkaId);
        $spolkaHistoriaZmian->setNazwa($historia->nazwa);
        $spolkaHistoriaZmian->setPole($fieldName);
        $spolkaHistoriaZmian->setStaraWartosc($previous);
        $spolkaHistoriaZmian->setNowaWartosc($actual);
        $spolkaHistoriaZmian->setDataModyfikacji($historia->dataZmiany);
        $this->_em->persist($spolkaHistoriaZmian);
        $this->_em->flush();
    }

    /**
     * Pobiera wartość Lp dla dodawanej spółki
     *
     * @param  type $umowaId
     *
     * @return int
     */
    public function getNastepnaLp($umowaId)
    {
        $spolki = $this->findBy(['umowaId' => $umowaId]);
        if (!$spolki) {
            return 1;
        }
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->select('MAX(s.liczbaPorzadkowa) as maxLp')
            ->where('s.umowaId = :umowaId')
            ->setParameter('umowaId', $umowaId);

        return $queryBuilder->getQuery()->getSingleScalarResult() + 1;
    }
}
