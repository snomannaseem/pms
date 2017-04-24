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
 * @ORM\Column(name="desig_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $desigId;

/**
 * @var string
 *
 * @ORM\Column(name="remember_token", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
 */
private $rememberToken;

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
 * Set desigId
 *
 * @param integer $desigId
 *
 * @return Users
 */
public function setDesigId($desigId)
{
$this->desigId = $desigId;

return $this;
}

/**
 * Get desigId
 *
 * @return integer
 */
public function getDesigId()
{
return $this->desigId;
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
}

