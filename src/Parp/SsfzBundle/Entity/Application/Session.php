<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sesja PHP.
 *
 * @ORM\Table(name="sessions")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SessionRepository")
 */
class Session
{
    /**
     * Id.
     *
     * @var string
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(
     *     name="sess_id",
     *     type="string",
     *     length=128,
     *     nullable=false
     * )
     */
    protected $id;

    /**
     * Data.
     *
     * @var string
     *
     * MEDIUMBLOB
     *
     * @ORM\Column(
     *     name="sess_data",
     *     type="blob",
     *     nullable=false
     * )
     */
    protected $data;

    /**
     * Time.
     *
     * @var string
     *
     * MEDIUMBLOB
     *
     * @ORM\Column(
     *     name="sess_time",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "unsigned"=true
     *     }
     * )
     */
    protected $time;

    /**
     * Lifetime.
     *
     * @var string
     *
     * MEDIUMBLOB
     *
     * @ORM\Column(
     *     name="sess_lifetime",
     *     type="integer",
     *     nullable=false
     * )
     */
    protected $lifetime;
}
