<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity
 */
class Teams
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
 * @ORM\Column(name="name", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
 */
private $name;

/**
 * @var string
 *
 * @ORM\Column(name="status", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
 */
private $status;

/**
 * @var integer
 *
 * @ORM\Column(name="created_by", type="integer", precision=0, scale=0, nullable=false, unique=false)
 */
private $createdBy;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="created_on", type="datetime", precision=0, scale=0, nullable=true, unique=false)
 */
private $createdOn;


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
 * @return Teams
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
 * @param string $status
 *
 * @return Teams
 */
public function setStatus($status)
{
$this->status = $status;

return $this;
}

/**
 * Get status
 *
 * @return string
 */
public function getStatus()
{
return $this->status;
}

/**
 * Set createdBy
 *
 * @param integer $createdBy
 *
 * @return Teams
 */
public function setCreatedBy($createdBy)
{
$this->createdBy = $createdBy;

return $this;
}

/**
 * Get createdBy
 *
 * @return integer
 */
public function getCreatedBy()
{
return $this->createdBy;
}

/**
 * Set createdOn
 *
 * @param \DateTime $createdOn
 *
 * @return Teams
 */
public function setCreatedOn($createdOn)
{
$this->createdOn = $createdOn;

return $this;
}

/**
 * Get createdOn
 *
 * @return \DateTime
 */
public function getCreatedOn()
{
return $this->createdOn;
}
}

