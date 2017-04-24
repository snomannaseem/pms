<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * IssueResolutionTypes
 *
 * @ORM\Table(name="issue_resolution_types")
 * @ORM\Entity
 */
class IssueResolutionTypes
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

