<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permissions
 *
 * @ORM\Table(name="permissions", uniqueConstraints={@ORM\UniqueConstraint(name="const_permissions_name", columns={"permission"})})
 * @ORM\Entity
 */
class Permissions
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
 * @ORM\Column(name="permission", type="string", length=30, precision=0, scale=0, nullable=false, unique=false)
 */
private $permission;

/**
 * @var string
 *
 * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
 */
private $description;

/**
 * @var boolean
 *
 * @ORM\Column(name="is_active", type="boolean", precision=0, scale=0, nullable=true, unique=false)
 */
private $isActive;

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
 * Set permission
 *
 * @param string $permission
 *
 * @return Permissions
 */
public function setPermission($permission)
{
$this->permission = $permission;

return $this;
}

/**
 * Get permission
 *
 * @return string
 */
public function getPermission()
{
return $this->permission;
}

/**
 * Set description
 *
 * @param string $description
 *
 * @return Permissions
 */
public function setDescription($description)
{
$this->description = $description;

return $this;
}

/**
 * Get description
 *
 * @return string
 */
public function getDescription()
{
return $this->description;
}

/**
 * Set isActive
 *
 * @param boolean $isActive
 *
 * @return Permissions
 */
public function setIsActive($isActive)
{
$this->isActive = $isActive;

return $this;
}

/**
 * Get isActive
 *
 * @return boolean
 */
public function getIsActive()
{
return $this->isActive;
}

/**
 * Set createdOn
 *
 * @param \DateTime $createdOn
 *
 * @return Permissions
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
 * @return Permissions
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
 * @return Permissions
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

