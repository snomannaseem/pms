<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * IssueTypes
 *
 * @ORM\Table(name="issue_types")
 * @ORM\Entity
 */
class IssueTypes
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
     * @ORM\Column(name="name", type="string", length=20, nullable=false)
     */
    private $name;


}

