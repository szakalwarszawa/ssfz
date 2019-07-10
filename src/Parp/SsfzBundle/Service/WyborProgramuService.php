<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Parp\SsfzBundle\Entity\Slownik\Program;

/**
 * Usługa pozwala zapamiętywać wybrany przez użytkownika program.
 */
class WyborProgramuService
{
    /**
     * @var string
     */
    const SESSION_KEY = 'wybrany_program';

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Session
     */
    private $session;

    /**
     * Krótkotrwały cache.
     *
     * @var Program|null
     */
    private $program = null;

    /**
     * Konstruktor.
     *
     * @param EntityManager $entityManager
     * @param Session $session
     */
    public function __construct(EntityManager $entityManager, Session $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;

        // Na wszelki wypadek. Włączy sesję tylko jeśli nie jest aktywna.
        $this->session->start();

        $this->setProgram(Program::PROGRAM_DOMYSLNY);
    }

    /**
     * Ustala w sesji identyfikator wybranego programu.
     *
     * @param int $idProgramu
     *
     * @return WyborProgramuService
     */
    public function setProgram(int $idProgramu)
    {
        $this->session->set(self::SESSION_KEY, $idProgramu);

        return $this;
    }

    /**
     * Zwraca z sesji identyfikator wybranego programu.
     *
     * @return int
     */
    public function getProgramId()
    {
        return $this->session->get(self::SESSION_KEY, Program::PROGRAM_DOMYSLNY);
    }

    /**
     * Zwraca obiekt wybranego programu na podstawie danych z sesji.
     *
     * Metoda używa lekkiego cacheowania. Jeśli instancja usługi jest wielokrotnie
     * używana do zmniejszona zostaje liczba odwoła
     *
     * @return Program
     *
     * @throws EntityNotFoundException Jeśli nie udało się pobrać danych programu
     */
    public function getProgram()
    {
        $idProgramu = $this->getProgramId();

        $isCached = (null !== $this->program) && ($this->program->getId() === $idProgramu);
        if ($isCached) {
            return $this->program;
        }

        $program = $this
            ->entityManager
            ->getRepository(Program::class)
            ->find($idProgramu)
        ;

        if (null === $program) {
            throw new EntityNotFoundException('Nie można pobrać danych wybranego programu.');
        }

        return $program;
    }
}
