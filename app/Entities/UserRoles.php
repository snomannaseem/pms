<?php
namespace App\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * UserRoles
 *
 * @ORM\Table(name="user_roles", uniqueConstraints={@ORM\UniqueConstraint(name="fk_user_roles_ids", columns={"role_id", "user_id"})}, indexes={@ORM\Index(name="fk_user_roles_user_id", columns={"user_id"}), @ORM\Index(name="IDX_54FCD59FD60322AC", columns={"role_id"})})
 * @ORM\Entity
 */
class UserRoles
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
 * @var \Roles
 *
 * @ORM\ManyToOne(targetEntity="Roles")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
 * })
 */
private $role;

/**
 * @var \Users
 *
 * @ORM\ManyToOne(targetEntity="Users")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
 * })
 */
private $user;


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
 * @return UserRoles
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
 * @return UserRoles
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
 * @return UserRoles
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
 * Set role
 *
 * @param \Roles $role
 *
 * @return UserRoles
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

/**
 * Set user
 *
 * @param \Users $user
 *
 * @return UserRoles
 */
public function setUser(\Users $user = null)
{
$this->user = $user;

return $this;
}

/**
 * Get user
 *
 * @return \Users
 */
public function getUser()
{
return $this->user;
}
}

