<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Issues
 *
 * @ORM\Table(name="issues", indexes={@ORM\Index(name="fk_issue_priority_id", columns={"priority_id"}), @ORM\Index(name="fk_issue_category_id", columns={"category_id"}), @ORM\Index(name="fk_issue_user_id", columns={"assigned_to"}), @ORM\Index(name="fk_issue_resolution_id", columns={"resolution_id"}), @ORM\Index(name="fk_issue_type_id", columns={"issue_type_id"})})
 * @ORM\Entity
 */
class Issues
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
 * @var integer
 *
 * @ORM\Column(name="project_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
 */
private $projectId;

/**
 * @var string
 *
 * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
 */
private $title;

/**
 * @var string
 *
 * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
 */
private $description;

/**
 * @var string
 *
 * @ORM\Column(name="est_time", type="decimal", precision=9, scale=2, nullable=true, unique=false)
 */
private $estTime;

/**
 * @var string
 *
 * @ORM\Column(name="status", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
 */
private $status;

/**
 * @var integer
 *
 * @ORM\Column(name="parent_issue_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
 */
private $parentIssueId;

/**
 * @var integer
 *
 * @ORM\Column(name="created_by", type="integer", precision=0, scale=0, nullable=true, unique=false)
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
 * @var \Categories
 *
 * @ORM\ManyToOne(targetEntity="Categories")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
 * })
 */
private $category;

/**
 * @var \Priorities
 *
 * @ORM\ManyToOne(targetEntity="Priorities")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="priority_id", referencedColumnName="id", nullable=true)
 * })
 */
private $priority;

/**
 * @var \IssueResolutionTypes
 *
 * @ORM\ManyToOne(targetEntity="IssueResolutionTypes")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="resolution_id", referencedColumnName="id", nullable=true)
 * })
 */
private $resolution;

/**
 * @var \IssueTypes
 *
 * @ORM\ManyToOne(targetEntity="IssueTypes")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="issue_type_id", referencedColumnName="id", nullable=true)
 * })
 */
private $issueType;

/**
 * @var \Users
 *
 * @ORM\ManyToOne(targetEntity="Users")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="assigned_to", referencedColumnName="id", nullable=true)
 * })
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
 * Set projectId
 *
 * @param integer $projectId
 *
 * @return Issues
 */
public function setProjectId($projectId)
{
$this->projectId = $projectId;

return $this;
}

/**
 * Get projectId
 *
 * @return integer
 */
public function getProjectId()
{
return $this->projectId;
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
 * Set deletedBy
 *
 * @param integer $deletedBy
 *
 * @return Issues
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
 * @return Issues
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
 * Set category
 *
 * @param \Categories $category
 *
 * @return Issues
 */
public function setCategory(Categories $category = null)
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
public function setPriority(Priorities $priority = null)
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
 * Set resolution
 *
 * @param \IssueResolutionTypes $resolution
 *
 * @return Issues
 */
public function setResolution(IssueResolutionTypes $resolution = null)
{
$this->resolution = $resolution;

return $this;
}

/**
 * Get resolution
 *
 * @return \IssueResolutionTypes
 */
public function getResolution()
{
return $this->resolution;
}

/**
 * Set issueType
 *
 * @param \IssueTypes $issueType
 *
 * @return Issues
 */
public function setIssueType(IssueTypes $issueType = null)
{
$this->issueType = $issueType;

return $this;
}

/**
 * Get issueType
 *
 * @return \IssueTypes
 */
public function getIssueType()
{
return $this->issueType;
}

/**
 * Set assignedTo
 *
 * @param \Users $assignedTo
 *
 * @return Issues
 */
public function setAssignedTo(Users $assignedTo = null)
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

