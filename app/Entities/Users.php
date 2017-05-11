<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
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
 * @ORM\Column(name="name", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
 */
private $name;

/**
 * @var string
 *
 * @ORM\Column(name="email", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
 */
private $email;

/**
 * @var string
 *
 * @ORM\Column(name="password", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
 */
private $password;

/**
 * @var integer
 *
 * @ORM\Column(name="role_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $roleId;

/**
 * @var string
 *
 * @ORM\Column(name="remember_token", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
 */
private $rememberToken;

/**
 * @var boolean
 *
 * @ORM\Column(name="status", type="boolean", precision=0, scale=0, nullable=true, unique=false)
 */
private $status;

/**
 * @var string
 *
 * @ORM\Column(name="profile_image", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
 */
private $profileImage;

/**
 * @var integer
 *
 * @ORM\Column(name="created_by", type="integer", precision=0, scale=0, nullable=false, unique=false)
 */
private $createdBy;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="created_on", type="datetime", precision=0, scale=0, nullable=false, unique=false)
 */
private $createdOn;

/**
 * @var integer
 *
 * @ORM\Column(name="updated_by", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $updatedBy;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="updated_on", type="datetime", precision=0, scale=0, nullable=true, unique=false)
 */
private $updatedOn;

/**
 * @var integer
 *
 * @ORM\Column(name="deleted_by", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $deletedBy;

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
 * Set name
 *
 * @param string $name
 *
 * @return Users
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
 * Set email
 *
 * @param string $email
 *
 * @return Users
 */
public function setEmail($email)
{
$this->email = $email;

return $this;
}

/**
 * Get email
 *
 * @return string
 */
public function getEmail()
{
return $this->email;
}

/**
 * Set password
 *
 * @param string $password
 *
 * @return Users
 */
public function setPassword($password)
{
$this->password = $password;

return $this;
}

/**
 * Get password
 *
 * @return string
 */
public function getPassword()
{
return $this->password;
}

/**
 * Set roleId
 *
 * @param integer $roleId
 *
 * @return Users
 */
public function setRoleId($roleId)
{
$this->roleId = $roleId;

return $this;
}

/**
 * Get roleId
 *
 * @return integer
 */
public function getRoleId()
{
return $this->roleId;
}

/**
 * Set rememberToken
 *
 * @param string $rememberToken
 *
 * @return Users
 */
public function setRememberToken($rememberToken)
{
$this->rememberToken = $rememberToken;

return $this;
}

/**
 * Get rememberToken
 *
 * @return string
 */
public function getRememberToken()
{
return $this->rememberToken;
}

/**
 * Set status
 *
 * @param boolean $status
 *
 * @return Users
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

/**
 * Set profileImage
 *
 * @param string $profileImage
 *
 * @return Users
 */
public function setProfileImage($profileImage)
{
$this->profileImage = $profileImage;

return $this;
}

/**
 * Get profileImage
 *
 * @return string
 */
public function getProfileImage()
{
return $this->profileImage;
}

/**
 * Set createdBy
 *
 * @param integer $createdBy
 *
 * @return Users
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
 * @return Users
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
 * Set updatedBy
 *
 * @param integer $updatedBy
 *
 * @return Users
 */
public function setUpdatedBy($updatedBy)
{
$this->updatedBy = $updatedBy;

return $this;
}

/**
 * Get updatedBy
 *
 * @return integer
 */
public function getUpdatedBy()
{
return $this->updatedBy;
}

/**
 * Set updatedOn
 *
 * @param \DateTime $updatedOn
 *
 * @return Users
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
 * Set deletedBy
 *
 * @param integer $deletedBy
 *
 * @return Users
 */
public function setDeletedBy($deletedBy)
{
$this->deletedBy = $deletedBy;

return $this;
}

/**
 * Get deletedBy
 *
 * @return integer
 */
public function getDeletedBy()
{
return $this->deletedBy;
}

/**
 * Set deletedOn
 *
 * @param \DateTime $deletedOn
 *
 * @return Users
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

