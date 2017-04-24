<?php

namespace App\Entities;

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
 * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="IDENTITY")
 */
private $id;

/**
 * @var string
 *
 * @ORM\Column(name="name", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
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
 * @return Priorities
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

