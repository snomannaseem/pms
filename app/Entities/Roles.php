<?php
namespace App\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles", uniqueConstraints={@ORM\UniqueConstraint(name="role", columns={"role"})})
 * @ORM\Entity
 */
class Roles
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
 * @ORM\Column(name="role", type="string", length=30, precision=0, scale=0, nullable=true, unique=false)
 */
private $role;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="created_on", type="datetime", precision=0, scale=0, nullable=false, unique=false)
 */
private $createdOn;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="updated_on", type="datetime", precision=0, scale=0, nullable=true, unique=false)
 */
private $updatedOn;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="deleted_on", type="datetime", precision=0, scale=0, nullable=true, unique=false)
 */
private $deletedOn;


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
 * Set role
 *
 * @param string $role
 *
 * @return Roles
 */
public function setRole($role)
{
$this->role = $role;

return $this;
}

/**
 * Get role
 *
 * @return string
 */
public function getRole()
{
return $this->role;
}

/**
 * Set createdOn
 *
 * @param \DateTime $createdOn
 *
 * @return Roles
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

/**
 * Set updatedOn
 *
 * @param \DateTime $updatedOn
 *
 * @return Roles
 */
public function setUpdatedOn($updatedOn)
{
$this->updatedOn = $updatedOn;

return $this;
}

/**
 * Get updatedOn
 *
 * @return \DateTime
 */
public function getUpdatedOn()
{
return $this->updatedOn;
}

/**
 * Set deletedOn
 *
 * @param \DateTime $deletedOn
 *
 * @return Roles
 */
public function setDeletedOn($deletedOn)
{
$this->deletedOn = $deletedOn;

return $this;
}

/**
 * Get deletedOn
 *
 * @return \DateTime
 */
public function getDeletedOn()
{
return $this->deletedOn;
}
}

