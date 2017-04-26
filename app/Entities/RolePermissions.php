<?php


namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * RolePermissions
 *
 * @ORM\Table(name="role_permissions", indexes={@ORM\Index(name="fk_role_permissions", columns={"permission_id"}), @ORM\Index(name="fk_role_permissions_role_id", columns={"role_id"})})
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
 * @var \Permissions
 *
 * @ORM\ManyToOne(targetEntity="Permissions")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="permission_id", referencedColumnName="id", nullable=true)
 * })
 */
private $permission;

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
 * Set permission
 *
 * @param \Permissions $permission
 *
 * @return RolePermissions
 */
public function setPermission(\Permissions $permission = null)
{
$this->permission = $permission;

return $this;
}

/**
 * Get permission
 *
 * @return \Permissions
 */
public function getPermission()
{
return $this->permission;
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

