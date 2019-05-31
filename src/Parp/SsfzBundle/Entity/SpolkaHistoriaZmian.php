<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpolkaHistoriaZmian
 *
 * Historia zmian w spółkach
 * Encja niezbędna do wykonania raportu wg Jasperreports
 *
 * @ORM\Table(name="sfz_spolka_historia_zmian")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SpolkaHistoriaZmianRepository")
 */
class SpolkaHistoriaZmian
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="spolka_id", type="integer")
     */
    private $spolkaId;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=140, nullable=true)
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="pole", type="string", nullable=true)
     */
    private $pole;

    /**
     * @var string
     *
     * @ORM\Column(name="stara_wartosc", type="string", nullable=true)
     */
    private $staraWartosc;

    /**
     * @var string
     *
     * @ORM\Column(name="nowa_wartosc", type="string", nullable=true)
     */
    private $nowaWartosc;

    /**
     * @var Carbon\Carbon
     *
     * @ORM\Column(name="data_modyfikacji", type="datetime", nullable=true)
     */
    private $dataModyfikacji;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSpolkaId()
    {
        return $this->spolkaId;
    }

    /**
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * @return string
     */
    public function getPole()
    {
        return $this->pole;
    }

    /**
     * @return string
     */
    public function getStaraWartosc()
    {
        return $this->staraWartosc;
    }

    /**
     * @return string
     */
    public function getNowaWartosc()
    {
        return $this->nowaWartosc;
    }

    /**
     * @return \Parp\SsfzBundle\Entity\Carbon\Carbon
     */
    public function getDataModyfikacji()
    {
        return $this->dataModyfikacji;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param integer $spolkaId
     */
    public function setSpolkaId($spolkaId)
    {
        $this->spolkaId = $spolkaId;
    }

    /**
     * @param string $nazwa
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
    }

    /**
     * @param string $pole
     */
    public function setPole($pole)
    {
        $this->pole = $pole;
    }

    /**
     * @param string $staraWartosc
     */
    public function setStaraWartosc($staraWartosc)
    {
        $this->staraWartosc = $staraWartosc;
    }

    /**
     * @param string $nowaWartosc
     */
    public function setNowaWartosc($nowaWartosc)
    {
        $this->nowaWartosc = $nowaWartosc;
    }

    /**
     * @param \Parp\SsfzBundle\Entity\Carbon\Carbon $dataModyfikacji
     */
    public function setDataModyfikacji(\Carbon\Carbon $dataModyfikacji)
    {
        $this->dataModyfikacji = $dataModyfikacji;
    }

    /**
     * Wyzwalane przy operacji INSERT
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->dataModyfikacji = new Carbon('Europe/Warsaw');
    }

    /**
     * Wyzwalane przy operacji UPDATE
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->dataModyfikacji = new Carbon('Europe/Warsaw');
    }
}
