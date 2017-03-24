<?php

namespace App\Entities;

/**
 * Issues
 */
class Issues
{
/**
 * @var integer
 */
private $id;

/**
 * @var integer
 */
private $issueType;

/**
 * @var string
 */
private $title;

/**
 * @var string
 */
private $description;

/**
 * @var string
 */
private $estTime;

/**
 * @var string
 */
private $status;

/**
 * @var integer
 */
private $resolution;

/**
 * @var integer
 */
private $parentIssueId;

/**
 * @var \DateTime
 */
private $createdOn;

/**
 * @var integer
 */
private $createdBy;

/**
 * @var integer
 */
private $updatedBy;

/**
 * @var \DateTime
 */
private $updatedOn;

/**
 * @var \Categories
 */
private $category;

/**
 * @var \Priorities
 */
private $priority;

/**
 * @var \Users
 */
private $assignedTo;


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
 * Set issueType
 *
 * @param integer $issueType
 *
 * @return Issues
 */
public function setIssueType($issueType)
{
$this->issueType = $issueType;

return $this;
}

/**
 * Get issueType
 *
 * @return integer
 */
public function getIssueType()
{
return $this->issueType;
}

/**
 * Set title
 *
 * @param string $title
 *
 * @return Issues
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
 * @return Issues
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
 * @param string $estTime
 *
 * @return Issues
 */
public function setEstTime($estTime)
{
$this->estTime = $estTime;

return $this;
}

/**
 * Get estTime
 *
 * @return string
 */
public function getEstTime()
{
return $this->estTime;
}

/**
 * Set status
 *
 * @param string $status
 *
 * @return Issues
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
 * Set resolution
 *
 * @param integer $resolution
 *
 * @return Issues
 */
public function setResolution($resolution)
{
$this->resolution = $resolution;

return $this;
}

/**
 * Get resolution
 *
 * @return integer
 */
public function getResolution()
{
return $this->resolution;
}

/**
 * Set parentIssueId
 *
 * @param integer $parentIssueId
 *
 * @return Issues
 */
public function setParentIssueId($parentIssueId)
{
$this->parentIssueId = $parentIssueId;

return $this;
}

/**
 * Get parentIssueId
 *
 * @return integer
 */
public function getParentIssueId()
{
return $this->parentIssueId;
}

/**
 * Set createdOn
 *
 * @param \DateTime $createdOn
 *
 * @return Issues
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
 * Set createdBy
 *
 * @param integer $createdBy
 *
 * @return Issues
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
 * Set updatedBy
 *
 * @param integer $updatedBy
 *
 * @return Issues
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
 * @return Issues
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
 * Set category
 *
 * @param \Categories $category
 *
 * @return Issues
 */
public function setCategory(\Categories $category = null)
{
$this->category = $category;

return $this;
}

/**
 * Get category
 *
 * @return \Categories
 */
public function getCategory()
{
return $this->category;
}

/**
 * Set priority
 *
 * @param \Priorities $priority
 *
 * @return Issues
 */
public function setPriority(\Priorities $priority = null)
{
$this->priority = $priority;

return $this;
}

/**
 * Get priority
 *
 * @return \Priorities
 */
public function getPriority()
{
return $this->priority;
}

/**
 * Set assignedTo
 *
 * @param \Users $assignedTo
 *
 * @return Issues
 */
public function setAssignedTo(\Users $assignedTo = null)
{
$this->assignedTo = $assignedTo;

return $this;
}

/**
 * Get assignedTo
 *
 * @return \Users
 */
public function getAssignedTo()
{
return $this->assignedTo;
}

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
 * Set issueType
 *
 * @param integer $issueType
 *
 * @return Issues
 */
public function setIssueType($issueType)
{
$this->issueType = $issueType;

return $this;
}

/**
 * Get issueType
 *
 * @return integer
 */
public function getIssueType()
{
return $this->issueType;
}

/**
 * Set title
 *
 * @param string $title
 *
 * @return Issues
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
 * @return Issues
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
 * @param string $estTime
 *
 * @return Issues
 */
public function setEstTime($estTime)
{
$this->estTime = $estTime;

return $this;
}

/**
 * Get estTime
 *
 * @return string
 */
public function getEstTime()
{
return $this->estTime;
}

/**
 * Set status
 *
 * @param string $status
 *
 * @return Issues
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
 * Set resolution
 *
 * @param integer $resolution
 *
 * @return Issues
 */
public function setResolution($resolution)
{
$this->resolution = $resolution;

return $this;
}

/**
 * Get resolution
 *
 * @return integer
 */
public function getResolution()
{
return $this->resolution;
}

/**
 * Set parentIssueId
 *
 * @param integer $parentIssueId
 *
 * @return Issues
 */
public function setParentIssueId($parentIssueId)
{
$this->parentIssueId = $parentIssueId;

return $this;
}

/**
 * Get parentIssueId
 *
 * @return integer
 */
public function getParentIssueId()
{
return $this->parentIssueId;
}

/**
 * Set createdOn
 *
 * @param \DateTime $createdOn
 *
 * @return Issues
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
 * Set createdBy
 *
 * @param integer $createdBy
 *
 * @return Issues
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
 * Set updatedBy
 *
 * @param integer $updatedBy
 *
 * @return Issues
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
 * @return Issues
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
 * Set category
 *
 * @param \Categories $category
 *
 * @return Issues
 */
public function setCategory(\Categories $category = null)
{
$this->category = $category;

return $this;
}

/**
 * Get category
 *
 * @return \Categories
 */
public function getCategory()
{
return $this->category;
}

/**
 * Set priority
 *
 * @param \Priorities $priority
 *
 * @return Issues
 */
public function setPriority(\Priorities $priority = null)
{
$this->priority = $priority;

return $this;
}

/**
 * Get priority
 *
 * @return \Priorities
 */
public function getPriority()
{
return $this->priority;
}

/**
 * Set assignedTo
 *
 * @param \Users $assignedTo
 *
 * @return Issues
 */
public function setAssignedTo(\Users $assignedTo = null)
{
$this->assignedTo = $assignedTo;

return $this;
}

/**
 * Get assignedTo
 *
 * @return \Users
 */
public function getAssignedTo()
{
return $this->assignedTo;
}
}
