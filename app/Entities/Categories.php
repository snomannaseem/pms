<?php


namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", uniqueConstraints={@ORM\UniqueConstraint(name="idx_name", columns={"name"})})
 * @ORM\Entity
 */
class Categories
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
 * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
 */
private $name;

/**
 * @var boolean
 *
 * @ORM\Column(name="status", type="boolean", precision=0, scale=0, nullable=true, unique=false)
 */
private $status;


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
 * @return Categories
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

/**
 * Set status
 *
 * @param boolean $status
 *
 * @return Categories
 */
public function setStatus($status)
{
$this->status = $status;

return $this;
}

/**
 * Get status
 *
 * @return boolean
 */
public function getStatus()
{
return $this->status;
}
}

