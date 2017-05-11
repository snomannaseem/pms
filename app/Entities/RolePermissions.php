<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * RolePermissions
 *
 * @ORM\Table(name="role_permissions", indexes={@ORM\Index(name="idx_role_permissions_role_id", columns={"role_id"}), @ORM\Index(name="idx_role_permissions_module_permission_id", columns={"module_permission_id"})})
 * @ORM\Entity
 */
class RolePermissions
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
 * @var \ModuleActions
 *
 * @ORM\ManyToOne(targetEntity="ModuleActions")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="module_permission_id", referencedColumnName="id", nullable=true)
 * })
 */
private $modulePermission;

/**
 * @var \Roles
 *
 * @ORM\ManyToOne(targetEntity="Roles")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
 * })
 */
private $role;


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
 * Set isActive
 *
 * @param boolean $isActive
 *
 * @return RolePermissions
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
 * @return RolePermissions
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
 * @return RolePermissions
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
 * @return RolePermissions
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

/**
 * Set modulePermission
 *
 * @param \ModuleActions $modulePermission
 *
 * @return RolePermissions
 */
public function setModulePermission(\ModuleActions $modulePermission = null)
{
$this->modulePermission = $modulePermission;

return $this;
}

/**
 * Get modulePermission
 *
 * @return \ModuleActions
 */
public function getModulePermission()
{
return $this->modulePermission;
}

/**
 * Set role
 *
 * @param \Roles $role
 *
 * @return RolePermissions
 */
public function setRole(\Roles $role = null)
{
$this->role = $role;

return $this;
}

/**
 * Get role
 *
 * @return \Roles
 */
public function getRole()
{
return $this->role;
}
}

