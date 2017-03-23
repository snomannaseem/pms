<?php

namespace App\Entities;

/**
 * Projects
 */
class Projects
{
/**
 * @var integer
 */
private $id;

/**
 * @var string
 */
private $title;

/**
 * @var string
 */
private $description;

/**
 * @var integer
 */
private $estTime;

/**
 * @var \DateTime
 */
private $estDeadline;

/**
 * @var string
 */
private $status;

/**
 * @var integer
 */
private $createdBy;

/**
 * @var \DateTime
 */
private $createdOn;

/**
 * @var integer
 */
private $updatedBy;

/**
 * @var \DateTime
 */
private $updatedOn;


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
 * Set title
 *
 * @param string $title
 *
 * @return Projects
 */
public function setTitle($title)
{
$this->title = $title;

return $this;
}

/**
 * Get title
 *
 * @return string
 */
public function getTitle()
{
return $this->title;
}

/**
 * Set description
 *
 * @param string $description
 *
 * @return Projects
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
 * Set estTime
 *
 * @param integer $estTime
 *
 * @return Projects
 */
public function setEstTime($estTime)
{
$this->estTime = $estTime;

return $this;
}

/**
 * Get estTime
 *
 * @return integer
 */
public function getEstTime()
{
return $this->estTime;
}

/**
 * Set estDeadline
 *
 * @param \DateTime $estDeadline
 *
 * @return Projects
 */
public function setEstDeadline($estDeadline)
{
$this->estDeadline = $estDeadline;

return $this;
}

/**
 * Get estDeadline
 *
 * @return \DateTime
 */
public function getEstDeadline()
{
return $this->estDeadline;
}

/**
 * Set status
 *
 * @param string $status
 *
 * @return Projects
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
 * @return Projects
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
 * @return Projects
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
 * @return Projects
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
 * @return Projects
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
}

