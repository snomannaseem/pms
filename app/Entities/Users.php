<?php

namespace App\Entities;

/**
 * Users
 */
class Users
{
/**
 * @var integer
 */
private $id;

/**
 * @var string
 */
private $name;

/**
 * @var string
 */
private $email;

/**
 * @var string
 */
private $password;

/**
 * @var integer
 */
private $desigId;

/**
 * @var boolean
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

