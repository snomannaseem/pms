<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Priorities
 *
 * @ORM\Table(name="priorities")
 * @ORM\Entity
 */
class Priorities
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;


}

