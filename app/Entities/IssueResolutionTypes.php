<?php


namespace App\Entities;
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
 * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="IDENTITY")
 */
private $id;

/**
 * @var string
 *
 * @ORM\Column(name="name", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
 */
private $name;


/**
 * Get id
 *
 * @return integer
 */
public function getId()
{
return $this->id;
}

/**
 * Set name
 *
 * @param string $name
 *
 * @return IssueResolutionTypes
 */
public function setName($name)
{
$this->name = $name;

return $this;
}

/**
 * Get name
 *
 * @return string
 */
public function getName()
{
return $this->name;
}
}

